<div>
    @if($config['is_active'] ?? false)
        <!-- Botón flotante del chat -->
        <div class="ai-chat-toggle" 
             style="position: fixed; bottom: 75px; left: 10px; z-index: 1000;"
             wire:click="toggleChat">
            <div class="ai-chat-button" 
                 style="width: 55px; height: 55px; background: linear-gradient(135deg, {{ $config['primary_color'] ?? '#D93690' }} 0%, {{ $config['secondary_color'] ?? '#667eea' }} 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3); transition: transform 0.2s ease-in-out;">
                <i class="fas fa-comments" style="color: white; font-size: 34px;"></i>
            </div>
        </div>

        <!-- Ventana del chat -->
        @if($isOpen)
            <div class="ai-chat-window" 
                 style="position: fixed; bottom: 140px; left: 10px; width: 350px; height: 500px; background: white; border-radius: 20px; box-shadow: 0 10px 40px rgba(0,0,0,0.15); z-index: 1001; display: flex; flex-direction: column; overflow: hidden;">
                
                <!-- Header del chat -->
                <div class="ai-chat-header" 
                     style="background: linear-gradient(135deg, {{ $config['primary_color'] ?? '#D93690' }} 0%, {{ $config['secondary_color'] ?? '#667eea' }} 100%); padding: 15px 20px; color: white; display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        <h4 style="margin: 0; font-size: 16px; font-weight: 600;">{{ $config['assistant_name'] ?? 'Asistente ECOS' }}</h4>
                        <p style="margin: 0; font-size: 12px; opacity: 0.9;">En línea</p>
                    </div>
                    <div style="display: flex; gap: 10px;">
                        <button wire:click="clearChat" 
                                style="background: rgba(255,255,255,0.2); border: none; color: white; padding: 5px 8px; border-radius: 5px; cursor: pointer; font-size: 12px;">
                            <i class="fas fa-trash"></i>
                        </button>
                        <button wire:click="toggleChat" 
                                style="background: rgba(255,255,255,0.2); border: none; color: white; padding: 5px 8px; border-radius: 5px; cursor: pointer; font-size: 12px;">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>

                <!-- Mensajes del chat -->
                <div class="ai-chat-messages" 
                     style="flex: 1; padding: 20px; overflow-y: auto; background: #f8fafc;" 
                     id="chat-messages">
                    @foreach($messages as $message)
                        <div class="ai-message {{ $message['type'] }}" 
                             style="margin-bottom: 15px; display: flex; {{ $message['type'] === 'user' ? 'justify-content: flex-end;' : 'justify-content: flex-start;' }}">
                            <div style="max-width: 80%; padding: 12px 16px; border-radius: 18px; {{ $message['type'] === 'user' ? 'background: linear-gradient(135deg, #D93690 0%, #667eea 100%); color: white;' : 'background: white; color: #333; box-shadow: 0 2px 10px rgba(0,0,0,0.1);' }}">
                                <p style="margin: 0; font-size: 14px; line-height: 1.4;">{{ $message['content'] }}</p>
                                <small style="opacity: 0.7; font-size: 11px; margin-top: 5px; display: block;">{{ $message['timestamp'] }}</small>
                                
                                @if(isset($message['links']) && count($message['links']) > 0)
                                    <div style="margin-top: 10px;">
                                        @foreach($message['links'] as $link)
                                            <a href="{{ $link['url'] }}" 
                                               style="display: block; padding: 8px 12px; background: rgba(217, 54, 144, 0.1); border-radius: 8px; margin-bottom: 5px; text-decoration: none; color: #D93690; font-size: 12px; transition: all 0.3s ease;"
                                               onmouseover="this.style.background='rgba(217, 54, 144, 0.2)'" 
                                               onmouseout="this.style.background='rgba(217, 54, 144, 0.1)'">
                                                <i class="{{ $link['icon'] ?? 'fas fa-link' }}" style="margin-right: 5px;"></i>
                                                {{ $link['title'] }}
                                            </a>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                    
                    @if($isLoading)
                        <div class="ai-message assistant" style="margin-bottom: 15px; display: flex; justify-content: flex-start;">
                            <div style="max-width: 80%; padding: 12px 16px; border-radius: 18px; background: white; color: #333; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
                                <div style="display: flex; align-items: center; gap: 5px;">
                                    <div class="typing-indicator">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </div>
                                    <span style="font-size: 12px; color: #666;">Escribiendo...</span>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Input del chat -->
                <div class="ai-chat-input" 
                     style="padding: 15px 20px; background: white; border-top: 1px solid #e2e8f0;">
                    <div style="display: flex; gap: 10px; align-items: center;">
                        <input type="text" 
                               wire:model="newMessage" 
                               wire:keydown.enter="sendMessage"
                               placeholder="Escribe tu mensaje..."
                               style="flex: 1; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 25px; outline: none; font-size: 14px;"
                               onfocus="this.style.borderColor='#D93690'" 
                               onblur="this.style.borderColor='#e2e8f0'">
                        <button wire:click="sendMessage" 
                                style="width: 40px; height: 40px; background: linear-gradient(135deg, #D93690 0%, #667eea 100%); border: none; border-radius: 50%; color: white; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all 0.3s ease;"
                                onmouseover="this.style.transform='scale(1.1)'" 
                                onmouseout="this.style.transform='scale(1)'">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </div>
                </div>
            </div>
        @endif
    @endif

    <style>
        /* Separación de botones flotantes: Asistente IA (arriba) y WhatsApp (abajo) */
        .ai-chat-button:hover {
            transform: scale(1.1);
        }
        
        .typing-indicator {
            display: flex;
            gap: 3px;
        }
        
        .typing-indicator span {
            width: 6px;
            height: 6px;
            background: #D93690;
            border-radius: 50%;
            animation: typing 1.4s infinite ease-in-out;
        }
        
        .typing-indicator span:nth-child(1) { animation-delay: -0.32s; }
        .typing-indicator span:nth-child(2) { animation-delay: -0.16s; }
        
        @keyframes typing {
            0%, 80%, 100% { transform: scale(0.8); opacity: 0.5; }
            40% { transform: scale(1); opacity: 1; }
        }
        
        .ai-chat-button:hover {
            transform: scale(1.1);
        }
        
        .ai-chat-messages::-webkit-scrollbar {
            width: 4px;
        }
        
        .ai-chat-messages::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        
        .ai-chat-messages::-webkit-scrollbar-thumb {
            background: #D93690;
            border-radius: 2px;
        }
    </style>

    <script>
        document.addEventListener('livewire:load', function () {
            Livewire.on('scrollToBottom', () => {
                const messagesContainer = document.getElementById('chat-messages');
                if (messagesContainer) {
                    messagesContainer.scrollTop = messagesContainer.scrollHeight;
                }
            });
        });
    </script>
</div>
