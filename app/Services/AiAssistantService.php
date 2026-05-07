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
        $this->hawkinsBaseUrl = env('OLLAMA_BASE_URL', 'http://217.160.39.79:11434');
        $this->hawkinsApiKey = '';
        $this->useHawkinsAi = true;
        Log::channel('single')->debug('AiAssistant: usando Ollama', ['url' => $this->hawkinsBaseUrl]);
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

        $prompt = $basePrompt . "\n\n";
        $prompt .= "Reglas importantes de estilo de respuesta:\n";
        $prompt .= "- Habla siempre en nombre de ECOS (\"en ECOS hacemos...\", \"en ECOS ofrecemos...\"), nunca digas que eres una IA ni un asistente virtual.\n";
        $prompt .= "- No menciones problemas técnicos internos ni frases como \"no tengo acceso al modelo\".\n";
        $prompt .= "- Si hubiera cualquier problema interno, responde de forma útil y neutra.\n";
        $prompt .= "- Responde siempre en español, de forma cálida, profesional y concisa.\n\n";

        // Incorporar prompts activos de la BD (ordenados por prioridad)
        try {
            $activePrompts = AiPrompt::where('is_active', true)
                ->orderByDesc('priority')
                ->get();

            if ($activePrompts->count() > 0) {
                $prompt .= "=== INFORMACIÓN CORPORATIVA ECOS ===\n";
                foreach ($activePrompts as $ap) {
                    $prompt .= "\n[{$ap->name}]\n{$ap->prompt}\n";
                }
                $prompt .= "\n=== FIN INFORMACIÓN CORPORATIVA ===\n\n";
            }
        } catch (\Throwable $e) {
            // Silencioso si falla la BD
        }

        if ($context) {
            $prompt .= "Contexto de navegación actual: {$context}\n";
        }

        if ($coursesInfo) {
            $prompt .= "Cursos disponibles que coinciden con la consulta:\n{$coursesInfo}\n";
        }

        $prompt .= "\nResponde de manera útil, amable y directa. Si hay cursos relevantes, menciónalos con su nombre.";

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
     * Llamar a Ollama directamente (217.160.39.79:11434)
     */
    protected function callHawkinsAI(array $messages): string
    {
        $prompt = $this->buildPromptForHawkins($messages);
        $modelo = $this->config->ai_model ?: 'qwen3:latest';
        $ollamaUrl = env('OLLAMA_BASE_URL', 'http://217.160.39.79:11434') . '/api/generate';
        $mensajeAmigable = 'Lo siento, no he podido conectar con el asistente en este momento. Por favor, inténtalo de nuevo más tarde.';

        try {
            $response = Http::timeout(120)->post($ollamaUrl, [
                'model'  => $modelo,
                'prompt' => $prompt,
                'stream' => false,
            ]);

            if (!$response->successful()) {
                Log::error('Ollama falló: HTTP ' . $response->status() . ' — ' . $response->body());
                return $mensajeAmigable;
            }

            $data = $response->json();
            return (string) ($data['response'] ?? $mensajeAmigable);

        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error('Ollama: timeout o sin conexión. ' . $e->getMessage());
            return $mensajeAmigable;
        } catch (\Throwable $e) {
            Log::error('Ollama: excepción. ' . $e->getMessage());
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
        $msg = strtolower($userMessage);

        $category = match(true) {
            str_contains($msg, 'oposic')                                                   => 'oposiciones',
            str_contains($msg, 'seguridad') || str_contains($msg, 'vigilant')              => 'seguridad',
            str_contains($msg, 'certificado') || str_contains($msg, 'profesionalidad')     => 'certificados',
            str_contains($msg, 'campus') || str_contains($msg, 'online') || str_contains($msg, 'moodle') || str_contains($msg, 'virtual') => 'campus',
            str_contains($msg, 'inscri') || str_contains($msg, 'matric') || str_contains($msg, 'precio') || str_contains($msg, 'coste') => 'inscripcion',
            str_contains($msg, 'curso') || str_contains($msg, 'formaci')                   => 'courses',
            str_contains($msg, 'contacto') || str_contains($msg, 'tel') || str_contains($msg, 'email') || str_contains($msg, 'sede') || str_contains($msg, 'direcci') || str_contains($msg, 'horario') || str_contains($msg, 'donde estai') => 'contact',
            default                                                                        => 'general',
        };

        $links = AiLink::getActiveByCategory($category);

        // Fallback a general si la categoría específica no tiene enlaces
        if ($links->isEmpty()) {
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
