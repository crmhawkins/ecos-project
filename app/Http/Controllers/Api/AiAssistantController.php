<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\AiAssistantService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AiAssistantController extends Controller
{
    protected $aiService;

    public function __construct(AiAssistantService $aiService)
    {
        $this->aiService = $aiService;
    }

    /**
     * Enviar mensaje al asistente
     */
    public function sendMessage(Request $request): JsonResponse
    {
        $request->validate([
            'message' => 'required|string|max:1000',
            'session_id' => 'nullable|string',
            'page_url' => 'nullable|string'
        ]);

        if (!$this->aiService->isActive()) {
            return response()->json([
                'success' => false,
                'message' => 'El asistente no está disponible en este momento.'
            ], 503);
        }

        try {
            $result = $this->aiService->processMessage(
                $request->message,
                $request->session_id,
                $request->page_url
            );

            return response()->json([
                'success' => true,
                'response' => $result['response'],
                'links' => $result['links'],
                'config' => $result['config']
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al procesar el mensaje. Inténtalo de nuevo.'
            ], 500);
        }
    }

    /**
     * Obtener configuración del asistente
     */
    public function getConfig(): JsonResponse
    {
        $config = $this->aiService->getConfig();
        
        return response()->json([
            'success' => true,
            'config' => [
                'is_active' => $config->is_active,
                'assistant_name' => $config->assistant_name,
                'welcome_message' => $config->welcome_message,
                'primary_color' => $config->primary_color,
                'secondary_color' => $config->secondary_color,
                'show_courses' => $config->show_courses,
                'show_contact_info' => $config->show_contact_info
            ]
        ]);
    }

    /**
     * Obtener historial de conversación
     */
    public function getHistory(Request $request): JsonResponse
    {
        $request->validate([
            'session_id' => 'required|string'
        ]);

        $history = \App\Models\AiConversation::getBySession($request->session_id);
        
        return response()->json([
            'success' => true,
            'history' => $history
        ]);
    }
}
