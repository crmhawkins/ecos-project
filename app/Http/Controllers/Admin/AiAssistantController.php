<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AiAssistantConfig;
use App\Models\AiPrompt;
use App\Models\AiLink;
use App\Models\AiConversation;
use Illuminate\Http\Request;

class AiAssistantController extends Controller
{
    /**
     * Mostrar configuración del asistente
     */
    public function index()
    {
        $config = AiAssistantConfig::getActiveConfig();
        return view('admin.ai-assistant.index', compact('config'));
    }

    /**
     * Mostrar sección de configuración general
     */
    public function config()
    {
        $config = AiAssistantConfig::getActiveConfig();
        return view('admin.ai-assistant.config', compact('config'));
    }

    /**
     * Mostrar sección de prompts
     */
    public function prompts()
    {
        $config = AiAssistantConfig::getActiveConfig();
        $prompts = AiPrompt::getAllActive();
        return view('admin.ai-assistant.prompts', compact('config', 'prompts'));
    }

    /**
     * Mostrar sección de enlaces
     */
    public function links()
    {
        $config = AiAssistantConfig::getActiveConfig();
        $links = AiLink::getAllActive();
        return view('admin.ai-assistant.links', compact('config', 'links'));
    }

    /**
     * Mostrar sección de conversaciones
     */
    public function conversations()
    {
        $config = AiAssistantConfig::getActiveConfig();
        $conversations = AiConversation::getRecent(10);
        return view('admin.ai-assistant.conversations', compact('config', 'conversations'));
    }

    /**
     * Actualizar configuración del asistente
     */
    public function updateConfig(Request $request)
    {
        $request->validate([
            'assistant_name' => 'required|string|max:255',
            'welcome_message' => 'required|string|max:500',
            'system_prompt' => 'required|string|max:2000',
            'ai_model' => 'required|string',
            'temperature' => 'required|numeric|between:0,2',
            'max_tokens' => 'required|integer|min:100|max:4000',
            'is_active' => 'boolean',
            'show_courses' => 'boolean',
            'show_contact_info' => 'boolean',
            'primary_color' => 'required|string',
            'secondary_color' => 'required|string'
        ]);

        $config = AiAssistantConfig::getActiveConfig();
        $config->update($request->all());

        return redirect()->back()->with('success', 'Configuración actualizada correctamente.');
    }

    /**
     * Crear nuevo prompt
     */
    public function createPrompt(Request $request)
    {
        $request->validate([
            'category' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'prompt' => 'required|string|max:2000',
            'priority' => 'required|integer|min:0|max:100',
            'is_active' => 'boolean',
            'variables' => 'nullable|array'
        ]);

        AiPrompt::create($request->all());

        return redirect()->back()->with('success', 'Prompt creado correctamente.');
    }

    /**
     * Actualizar prompt
     */
    public function updatePrompt(Request $request, $id)
    {
        $request->validate([
            'category' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'prompt' => 'required|string|max:2000',
            'priority' => 'required|integer|min:0|max:100',
            'is_active' => 'boolean',
            'variables' => 'nullable|array'
        ]);

        $prompt = AiPrompt::findOrFail($id);
        $prompt->update($request->all());

        return redirect()->back()->with('success', 'Prompt actualizado correctamente.');
    }

    /**
     * Eliminar prompt
     */
    public function deletePrompt($id)
    {
        $prompt = AiPrompt::findOrFail($id);
        $prompt->delete();

        return redirect()->back()->with('success', 'Prompt eliminado correctamente.');
    }

    /**
     * Crear nuevo enlace
     */
    public function createLink(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'required|url|max:500',
            'description' => 'nullable|string|max:500',
            'category' => 'required|string|max:255',
            'priority' => 'required|integer|min:0|max:100',
            'is_active' => 'boolean',
            'icon' => 'nullable|string|max:255'
        ]);

        AiLink::create($request->all());

        return redirect()->back()->with('success', 'Enlace creado correctamente.');
    }

    /**
     * Actualizar enlace
     */
    public function updateLink(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'required|url|max:500',
            'description' => 'nullable|string|max:500',
            'category' => 'required|string|max:255',
            'priority' => 'required|integer|min:0|max:100',
            'is_active' => 'boolean',
            'icon' => 'nullable|string|max:255'
        ]);

        $link = AiLink::findOrFail($id);
        $link->update($request->all());

        return redirect()->back()->with('success', 'Enlace actualizado correctamente.');
    }

    /**
     * Eliminar enlace
     */
    public function deleteLink($id)
    {
        $link = AiLink::findOrFail($id);
        $link->delete();

        return redirect()->back()->with('success', 'Enlace eliminado correctamente.');
    }


    /**
     * Eliminar conversación
     */
    public function deleteConversation($id)
    {
        $conversation = AiConversation::findOrFail($id);
        $conversation->delete();

        return redirect()->back()->with('success', 'Conversación eliminada correctamente.');
    }
}
