<?php

namespace App\Services;

use App\Models\AiAssistantConfig;
use App\Models\AiPrompt;
use App\Models\AiLink;
use App\Models\AiConversation;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AiAssistantService
{
    protected $config;
    protected $apiKey;
    /** @var bool */
    protected $useHawkinsAi;
    /** @var string */
    protected $hawkinsBaseUrl;
    /** @var string */
    protected $hawkinsApiKey;

    public function __construct()
    {
        // En entorno de desarrollo/CI puede fallar la inicialización de la BD (p.ej. sin driver sqlite).
        // Para no romper comandos de consola (route:list, etc.), aplicamos un fallback in-memory.
        try {
            $this->config = AiAssistantConfig::getActiveConfig();
        } catch (\Throwable $e) {
            Log::warning('AiAssistantService: no se pudo cargar configuración desde BD. Usando fallback en memoria.', [
                'error' => $e->getMessage(),
            ]);

            $fallback = new \stdClass();
            $fallback->id = null;
            $fallback->is_active = true;
            $fallback->assistant_name = 'Asistente ECOS';
            $fallback->welcome_message = '¡Hola! Bienvenido a ECOS. ¿En qué podemos ayudarte hoy?';
            $fallback->system_prompt = 'Hablas en nombre de ECOS, una empresa de formación con más de 28 años de experiencia. Ayudas a los usuarios con información sobre cursos, formación y servicios. No menciones que eres una IA ni que eres un asistente virtual; céntrate en la información práctica y útil.';
            $fallback->ai_model = 'gpt-3.5-turbo';
            $fallback->temperature = 0.7;
            $fallback->max_tokens = 1000;
            $fallback->show_courses = true;
            $fallback->show_contact_info = true;
            $fallback->primary_color = '#D93690';
            $fallback->secondary_color = '#667eea';

            $this->config = $fallback;
        }
        $this->apiKey = config('services.openai.api_key', env('OPENAI_API_KEY'));
        $hawkins = config('services.hawkins_ai', []);
        $this->hawkinsBaseUrl = rtrim($hawkins['base_url'] ?? '', '/');
        $this->hawkinsApiKey = $hawkins['api_key'] ?? '';
        $this->useHawkinsAi = $this->hawkinsBaseUrl !== '' && $this->hawkinsApiKey !== '';
        if ($this->useHawkinsAi) {
            Log::channel('single')->debug('AiAssistant: usando Hawkins AI', ['base_url' => $this->hawkinsBaseUrl]);
        } else {
            Log::channel('single')->warning('AiAssistant: Hawkins no configurada (base_url o api_key vacío). Se usará OpenAI o mensaje de fallo.', [
                'base_url_set' => $this->hawkinsBaseUrl !== '',
                'api_key_set' => $this->hawkinsApiKey !== '',
            ]);
        }
    }

    /**
     * Procesar mensaje del usuario y generar respuesta
     */
    public function processMessage($userMessage, $sessionId = null, $pageUrl = null)
    {
        try {
            // Obtener contexto de la página actual
            $context = $this->getPageContext($pageUrl);

            // Obtener información de cursos si es relevante
            $coursesInfo = $this->getCoursesInfo($userMessage);

            // Construir prompt del sistema
            $systemPrompt = $this->buildSystemPrompt($context, $coursesInfo);

            // Obtener historial de conversación
            $conversationHistory = $this->getConversationHistory($sessionId);

            // Preparar mensajes para la API
            $messages = $this->prepareMessages($systemPrompt, $conversationHistory, $userMessage);

            // Llamar a la IA: Hawkins (local) si está configurada, si no OpenAI
            $response = $this->useHawkinsAi
                ? $this->callHawkinsAI($messages)
                : $this->callOpenAI($messages);

            // Guardar conversación
            $this->saveConversation($sessionId, $userMessage, $response, $pageUrl);

            // Obtener enlaces relevantes
            $relevantLinks = $this->getRelevantLinks($userMessage);

            return [
                'message' => $response,
                'links' => $relevantLinks,
                'config' => $this->config
            ];

        } catch (\Exception $e) {
            Log::error('Error en AiAssistantService: ' . $e->getMessage());

            return [
                'message' => 'Lo siento, ha ocurrido un error. Por favor, inténtalo de nuevo más tarde.',
                'links' => [],
                'config' => $this->config
            ];
        }
    }

    /**
     * Obtener contexto de la página actual
     */
    protected function getPageContext($pageUrl)
    {
        if (!$pageUrl) return '';

        $context = '';

        // Determinar el contexto según la URL
        if (str_contains($pageUrl, '/course')) {
            $context = 'El usuario está en la página de cursos.';
        } elseif (str_contains($pageUrl, '/web/about')) {
            $context = 'El usuario está en la página "Quiénes somos".';
        } elseif (str_contains($pageUrl, '/web/contact')) {
            $context = 'El usuario está en la página de contacto.';
        } elseif (str_contains($pageUrl, '/web/index')) {
            $context = 'El usuario está en la página principal.';
        }

        return $context;
    }

    /**
     * Obtener información de cursos relevante
     */
    protected function getCoursesInfo($userMessage)
    {
        $coursesInfo = '';

        // Buscar cursos que coincidan con la consulta
        $courses = \App\Models\Cursos\Cursos::where('inactive', 0)
                         ->where('published', 1)
                         ->whereNotNull('moodle_id')
                         ->where(function($query) use ($userMessage) {
                             $query->where('name', 'like', '%' . $userMessage . '%')
                                   ->orWhere('description', 'like', '%' . $userMessage . '%');
                         })
                         ->limit(5)
                         ->get();

        if ($courses->count() > 0) {
            $coursesInfo = "Cursos disponibles relacionados:\n";
            foreach ($courses as $course) {
                $coursesInfo .= "- {$course->name}: {$course->description}\n";
            }
        }

        return $coursesInfo;
    }

    /**
     * Construir prompt del sistema
     */
    protected function buildSystemPrompt($context, $coursesInfo)
    {
        $basePrompt = $this->config->system_prompt;

        // Refuerzo de instrucciones para evitar que hable de IA o de problemas de conexión
        $prompt = $basePrompt . "\n\n";
        $prompt .= "Reglas importantes de estilo de respuesta:\n";
        $prompt .= "- Habla siempre en nombre de ECOS (\"en ECOS hacemos...\"), no digas que eres una IA ni que eres un asistente virtual.\n";
        $prompt .= "- No digas nunca frases como \"no tengo conexión con el modelo de IA\", \"no tengo acceso al modelo\" ni menciones problemas técnicos internos.\n";
        $prompt .= "- Si hubiera cualquier problema interno, responde igualmente de forma útil y neutra, como si todo funcionara con normalidad.\n\n";

        if ($context) {
            $prompt .= "Contexto actual: {$context}\n";
        }

        if ($coursesInfo) {
            $prompt .= "Información de cursos:\n{$coursesInfo}\n";
        }

        $prompt .= "\nResponde de manera útil y amable. Si mencionas cursos, incluye enlaces relevantes.";

        return $prompt;
    }

    /**
     * Obtener historial de conversación
     */
    protected function getConversationHistory($sessionId)
    {
        if (!$sessionId) return [];

        $conversations = AiConversation::getBySession($sessionId);
        $history = [];

        foreach ($conversations as $conv) {
            $history[] = [
                'role' => 'user',
                'content' => $conv->user_message
            ];
            $history[] = [
                'role' => 'assistant',
                'content' => $conv->assistant_response
            ];
        }

        return $history;
    }

    /**
     * Preparar mensajes para la API
     */
    protected function prepareMessages($systemPrompt, $conversationHistory, $userMessage)
    {
        $messages = [
            [
                'role' => 'system',
                'content' => $systemPrompt
            ]
        ];

        // Añadir historial de conversación
        foreach ($conversationHistory as $message) {
            $messages[] = $message;
        }

        // Añadir mensaje actual del usuario
        $messages[] = [
            'role' => 'user',
            'content' => $userMessage
        ];

        return $messages;
    }

    /**
     * Llamar a la API Hawkins (IA local)
     * POST /chat/chat con {"prompt":"", "modelo":""}, header x-api-key
     */
    protected function callHawkinsAI(array $messages): string
    {
        $prompt = $this->buildPromptForHawkins($messages);
        $url = $this->hawkinsBaseUrl . '/chat/chat';
        $modelo = $this->config->ai_model ?: 'gpt-oss:120b-cloud';
        $mensajeAmigable = 'Lo siento, no he podido conectar con el asistente en este momento. Por favor, inténtalo de nuevo más tarde.';

        try {
            $response = Http::withHeaders([
                'x-api-key' => $this->hawkinsApiKey,
                'Content-Type' => 'application/json',
            ])->timeout(120)->post($url, [
                'prompt' => $prompt,
                'modelo' => $modelo,
            ]);

            if (!$response->successful()) {
                Log::error('Hawkins AI falló: HTTP ' . $response->status() . '. URL: ' . $url . '. Respuesta: ' . $response->body());
                return $mensajeAmigable;
            }

            $data = $response->json();
            if (!empty($data['respuesta'])) {
                return (string) $data['respuesta'];
            }
            $fallback = $data['metadata']['message']['content'] ?? null;
            if ($fallback) {
                return (string) $fallback;
            }
            if (!empty($data['success'])) {
                Log::warning('Hawkins AI: success=true pero sin campo respuesta ni metadata.message.content');
                return $mensajeAmigable;
            }
            Log::warning('Hawkins AI: respuesta sin contenido válido', ['keys' => $data ? array_keys($data) : [], 'body' => $response->body()]);
            return $mensajeAmigable;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error('Hawkins AI falló: no se pudo conectar (timeout o red). ' . $e->getMessage());
            return $mensajeAmigable;
        } catch (\Throwable $e) {
            Log::error('Hawkins AI falló: excepción. ' . $e->getMessage(), ['exception' => get_class($e)]);
            return $mensajeAmigable;
        }
    }

    /**
     * Construir un único prompt para Hawkins a partir de mensajes (system + historial + user)
     */
    protected function buildPromptForHawkins(array $messages): string
    {
        $parts = [];
        foreach ($messages as $m) {
            $role = $m['role'] ?? '';
            $content = $m['content'] ?? '';
            if ($role === 'system') {
                $parts[] = "Instrucciones del sistema:\n" . $content;
            } elseif ($role === 'user') {
                $parts[] = "Usuario: " . $content;
            } elseif ($role === 'assistant') {
                $parts[] = "Asistente: " . $content;
            }
        }
        return implode("\n\n", $parts);
    }

    /**
     * Llamar a la API de OpenAI (solo si no se usa Hawkins)
     */
    protected function callOpenAI($messages)
    {
        if (empty($this->apiKey)) {
            Log::warning('AiAssistantService: OpenAI sin clave y Hawkins no disponible');
            return 'Lo siento, no he podido conectar con el asistente en este momento. Por favor, inténtalo de nuevo más tarde.';
        }

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Content-Type' => 'application/json',
        ])->post('https://api.openai.com/v1/chat/completions', [
            'model' => $this->config->ai_model,
            'messages' => $messages,
            'temperature' => (float) $this->config->temperature,
            'max_tokens' => (int) $this->config->max_tokens,
        ]);

        if ($response->successful()) {
            $data = $response->json();
            return $data['choices'][0]['message']['content'] ?? 'Lo siento, no pude generar una respuesta.';
        }

        Log::error('OpenAI API error: ' . $response->body());
        return 'Lo siento, no he podido conectar con el asistente en este momento. Por favor, inténtalo de nuevo más tarde.';
    }

    /**
     * Listar modelos disponibles en la API Hawkins (GET /chat/models)
     */
    public function getAvailableModels(): array
    {
        if (!$this->useHawkinsAi) {
            return [];
        }
        $url = $this->hawkinsBaseUrl . '/chat/models';
        try {
            $response = Http::withHeaders([
                'x-api-key' => $this->hawkinsApiKey,
                'Accept' => 'application/json',
            ])->timeout(10)->get($url);

            if (!$response->successful()) {
                Log::warning('Hawkins AI models request failed', ['status' => $response->status()]);
                return [];
            }

            $data = $response->json();
            if (is_array($data) && isset($data['models']) && is_array($data['models'])) {
                return array_values($data['models']);
            }
            if (is_array($data) && isset($data['data']) && is_array($data['data'])) {
                $list = [];
                foreach ($data['data'] as $item) {
                    $list[] = is_string($item) ? $item : ($item['id'] ?? $item['name'] ?? (string) $item);
                }
                return $list;
            }
            if (is_array($data) && array_is_list($data)) {
                $list = [];
                foreach ($data as $item) {
                    $list[] = is_string($item) ? $item : ($item['id'] ?? $item['name'] ?? (string) $item);
                }
                return $list;
            }
        } catch (\Throwable $e) {
            Log::warning('Hawkins AI getAvailableModels error: ' . $e->getMessage());
        }
        return [];
    }

    /**
     * Guardar conversación
     */
    protected function saveConversation($sessionId, $userMessage, $assistantResponse, $pageUrl)
    {
        if (!$sessionId) return;

        AiConversation::create([
            'session_id' => $sessionId,
            'user_message' => $userMessage,
            'assistant_response' => $assistantResponse,
            'page_url' => $pageUrl,
            'metadata' => [
                'timestamp' => now()->toISOString(),
                'config_id' => $this->config->id
            ]
        ]);
    }

    /**
     * Obtener enlaces relevantes
     */
    protected function getRelevantLinks($userMessage)
    {
        $links = [];

        // Buscar enlaces por categoría según el mensaje
        if (str_contains(strtolower($userMessage), 'curso') || str_contains(strtolower($userMessage), 'formación')) {
            $links = AiLink::getActiveByCategory('courses');
        } elseif (str_contains(strtolower($userMessage), 'contacto') || str_contains(strtolower($userMessage), 'teléfono')) {
            $links = AiLink::getActiveByCategory('contact');
        } else {
            $links = AiLink::getActiveByCategory('general');
        }

        return $links->take(3)->toArray();
    }

    /**
     * Obtener configuración del asistente
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Verificar si el asistente está activo
     */
    public function isActive()
    {
        return $this->config->is_active;
    }
}
