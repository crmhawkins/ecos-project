<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Services\AiAssistantService;
use Illuminate\Support\Facades\Http;

class AiChat extends Component
{
    public $isOpen = false;
    public $messages = [];
    public $newMessage = '';
    public $isLoading = false;
    public $config = [];
    public $sessionId;
    public $currentPageUrl;

    protected $listeners = ['toggleChat', 'sendMessage'];

    public function mount()
    {
        $this->sessionId = session()->getId();
        $this->currentPageUrl = request()->url();
        $this->loadConfig();
        $this->addWelcomeMessage();
    }

    public function loadConfig()
    {
        try {
            $config = \App\Models\AiAssistantConfig::getActiveConfig();
            $this->config = [
                'is_active' => $config->is_active,
                'assistant_name' => $config->assistant_name,
                'welcome_message' => $config->welcome_message,
                'primary_color' => $config->primary_color,
                'secondary_color' => $config->secondary_color,
                'show_courses' => $config->show_courses,
                'show_contact_info' => $config->show_contact_info
            ];
            
        } catch (\Exception $e) {
            \Log::error('AiChat Config error:', ['error' => $e->getMessage()]);
            $this->config = [
                'is_active' => false,
                'assistant_name' => 'Asistente ECOS',
                'welcome_message' => '¡Hola! ¿En qué puedo ayudarte?',
                'primary_color' => '#D93690',
                'secondary_color' => '#667eea',
                'show_courses' => true,
                'show_contact_info' => true
            ];
        }
    }

    public function addWelcomeMessage()
    {
        if (!empty($this->config['welcome_message'])) {
            $this->messages[] = [
                'type' => 'assistant',
                'content' => $this->config['welcome_message'],
                'timestamp' => now()->format('H:i')
            ];
        }
    }

    public function toggleChat()
    {
        $this->isOpen = !$this->isOpen;
    }

    public function sendMessage()
    {
        if (empty($this->newMessage)) return;

        // Añadir mensaje del usuario inmediatamente al chat
        $this->messages[] = [
            'type' => 'user',
            'content' => $this->newMessage,
            'timestamp' => now()->format('H:i')
        ];

        $userMessage = $this->newMessage;
        $this->newMessage = '';
        $this->isLoading = true;

        // Disparar evento al navegador para que haga la llamada AJAX
        $this->dispatch(
            'aiChatSend',
            message: $userMessage,
            sessionId: $this->sessionId,
            pageUrl: $this->currentPageUrl
        );

        $this->dispatch('scrollToBottom');
    }

    /**
     * Recibir la respuesta de la IA desde JavaScript (fetch a la API)
     */
    public function receiveAssistantMessage(string $message, array $links = []): void
    {
        $this->messages[] = [
            'type' => 'assistant',
            'content' => $message,
            'timestamp' => now()->format('H:i'),
            'links' => $links,
        ];

        $this->isLoading = false;
        $this->dispatch('scrollToBottom');
    }

    public function clearChat()
    {
        $this->messages = [];
        $this->addWelcomeMessage();
    }

    public function render()
    {
        return view('livewire.ai-chat');
    }
}
