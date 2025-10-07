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

    public function __construct()
    {
        $this->config = AiAssistantConfig::getActiveConfig();
        $this->apiKey = config('services.openai.api_key', env('OPENAI_API_KEY'));
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
            
            // Llamar a la API de OpenAI
            $response = $this->callOpenAI($messages);
            
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
     * Llamar a la API de OpenAI
     */
    protected function callOpenAI($messages)
    {
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
        
        throw new \Exception('Error en la API de OpenAI: ' . $response->body());
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
