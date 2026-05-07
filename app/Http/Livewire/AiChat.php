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
    public int $newestMessageIndex = -1;

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

        $this->messages[] = [
            'type' => 'user',
            'content' => $this->newMessage,
            'timestamp' => now()->format('H:i')
        ];

        $userMessage = $this->newMessage;
        $this->newMessage = '';
        $this->isLoading = true;

        try {
            $aiService = app(AiAssistantService::class);
            $response = $aiService->processMessageStreaming(
                $userMessage,
                $this->sessionId,
                $this->currentPageUrl,
                fn($chunk) => $this->stream(to: 'streamingMessage', content: $chunk, replace: false)
            );

            $this->messages[] = [
                'type' => 'assistant',
                'content' => $response['message'],
                'timestamp' => now()->format('H:i'),
                'links' => $response['links'] ?? []
            ];
            $this->newestMessageIndex = -1; // ya visto en streaming, no typewriter
        } catch (\Exception $e) {
            \Log::error('AiChat sendMessage error:', ['error' => $e->getMessage()]);
            $this->messages[] = [
                'type' => 'assistant',
                'content' => 'Lo siento, hay un problema técnico. Por favor, inténtalo de nuevo más tarde.',
                'timestamp' => now()->format('H:i')
            ];
            $this->newestMessageIndex = count($this->messages) - 1;
        }

        $this->isLoading = false;
        $this->dispatch('scrollToBottom');
    }

    public function clearChat()
    {
        $this->messages = [];
        $this->newestMessageIndex = -1;
        $this->addWelcomeMessage();
    }

    public function render()
    {
        return view('livewire.ai-chat');
    }
}
