<div x-data="{
    pendingText: '',
    captureAndSend() {
        var inp = document.getElementById('ecos-chat-input');
        if (!inp) return;
        var val = inp.value.trim();
        if (!val) return;
        this.pendingText = val;
    },
    clearPending() {
        this.pendingText = '';
        this.$nextTick(() => {
            var c = document.getElementById('chat-messages');
            if (c) {
                c.scrollTop = c.scrollHeight;
                this.typewriterLast(c);
            }
        });
    },
    typewriterLast(container) {
        var bubbles = container.querySelectorAll('.ecos-ai-bubble[data-typed=\'0\']');
        if (!bubbles.length) return;
        var bubble = bubbles[bubbles.length - 1];
        bubble.setAttribute('data-typed', '1');
        var full = bubble.getAttribute('data-text');
        if (!full) return;
        var p = bubble.querySelector('.bubble-text');
        if (!p) return;
        p.textContent = '';
        var i = 0;
        var scroll = function() {
            container.scrollTop = container.scrollHeight;
        };
        var step = function() {
            if (i < full.length) {
                p.textContent += full[i++];
                scroll();
                setTimeout(step, 25);
            }
        };
        step();
    }
}" @ecos-response-ready.window="clearPending()">

    @if($config['is_active'] ?? false)

        {{-- Botón flotante --}}
        <div wire:click="toggleChat"
             style="position:fixed; bottom:80px; left:10px; z-index:9998; cursor:pointer;">
            <div style="
                width:60px; height:60px;
                background: linear-gradient(135deg, {{ $config['primary_color'] ?? '#D93690' }} 0%, {{ $config['secondary_color'] ?? '#667eea' }} 100%);
                border-radius:50%;
                display:flex; align-items:center; justify-content:center;
                box-shadow: 0 8px 32px rgba(217,54,144,0.45);
                transition: transform 0.2s ease, box-shadow 0.2s ease;
            " onmouseover="this.style.transform='scale(1.1)'; this.style.boxShadow='0 12px 40px rgba(217,54,144,0.55)'"
               onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='0 8px 32px rgba(217,54,144,0.45)'">
                @if($isOpen)
                    <i class="fas fa-times" style="color:white; font-size:22px;"></i>
                @else
                    <i class="fas fa-comments" style="color:white; font-size:24px;"></i>
                @endif
            </div>
            @if(!$isOpen)
                <div style="
                    position:absolute; bottom:68px; left:0;
                    background:white; border-radius:12px; padding:6px 12px;
                    box-shadow:0 4px 20px rgba(0,0,0,0.12);
                    font-size:13px; font-weight:600; color:#333;
                    white-space:nowrap; pointer-events:none;
                ">¿Necesitas ayuda? 💬</div>
            @endif
        </div>

        @if($isOpen)
        {{-- Ventana del chat --}}
        <div style="
            position:fixed; bottom:150px; left:10px; z-index:9999;
            width:min(480px, calc(100vw - 48px));
            height:min(680px, calc(100vh - 140px));
            background:#fff;
            border-radius:24px;
            box-shadow: 0 24px 64px rgba(0,0,0,0.18), 0 4px 16px rgba(217,54,144,0.12);
            display:flex; flex-direction:column; overflow:hidden;
            animation: chatSlideIn 0.25s cubic-bezier(0.34,1.56,0.64,1);
        ">

            {{-- Header --}}
            <div style="
                background: linear-gradient(135deg, {{ $config['primary_color'] ?? '#D93690' }} 0%, {{ $config['secondary_color'] ?? '#667eea' }} 100%);
                padding:18px 20px;
                display:flex; justify-content:space-between; align-items:center;
                flex-shrink:0;
            ">
                <div style="display:flex; align-items:center; gap:12px;">
                    <div style="
                        width:42px; height:42px; border-radius:50%;
                        background:rgba(255,255,255,0.25);
                        display:flex; align-items:center; justify-content:center;
                        font-size:20px;
                    ">🤖</div>
                    <div>
                        <div style="color:white; font-weight:700; font-size:15px; line-height:1.2;">
                            {{ $config['assistant_name'] ?? 'Asistente ECOS' }}
                        </div>
                        <div style="display:flex; align-items:center; gap:5px; margin-top:2px;">
                            <div style="width:7px; height:7px; border-radius:50%; background:#4ade80;"></div>
                            <span style="color:rgba(255,255,255,0.85); font-size:12px;">En línea</span>
                        </div>
                    </div>
                </div>
                <div style="display:flex; gap:8px;">
                    <button wire:click="clearChat"
                            title="Limpiar chat"
                            style="background:rgba(255,255,255,0.15); border:none; color:white; width:32px; height:32px; border-radius:8px; cursor:pointer; font-size:13px; display:flex; align-items:center; justify-content:center; transition:background 0.2s;"
                            onmouseover="this.style.background='rgba(255,255,255,0.3)'"
                            onmouseout="this.style.background='rgba(255,255,255,0.15)'">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                    <button wire:click="toggleChat"
                            title="Cerrar"
                            style="background:rgba(255,255,255,0.15); border:none; color:white; width:32px; height:32px; border-radius:8px; cursor:pointer; font-size:13px; display:flex; align-items:center; justify-content:center; transition:background 0.2s;"
                            onmouseover="this.style.background='rgba(255,255,255,0.3)'"
                            onmouseout="this.style.background='rgba(255,255,255,0.15)'">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>

            {{-- Área de mensajes --}}
            <div id="chat-messages" style="
                flex:1; overflow-y:auto; padding:20px 16px;
                background: linear-gradient(180deg, #f8fafc 0%, #f1f5f9 100%);
                display:flex; flex-direction:column; gap:12px;
            ">
                @foreach($messages as $idx => $message)
                    @if($message['type'] === 'user')
                        <div style="display:flex; justify-content:flex-end; animation:msgFadeIn 0.2s ease;">
                            <div style="
                                max-width:75%; padding:12px 16px; border-radius:18px 18px 4px 18px;
                                background: linear-gradient(135deg, {{ $config['primary_color'] ?? '#D93690' }}, {{ $config['secondary_color'] ?? '#667eea' }});
                                color:white; box-shadow:0 2px 12px rgba(217,54,144,0.25);
                            ">
                                <p style="margin:0; font-size:14px; line-height:1.5; white-space:pre-wrap;">{{ $message['content'] }}</p>
                                <small style="opacity:0.75; font-size:11px; margin-top:4px; display:block; text-align:right;">{{ $message['timestamp'] }}</small>
                            </div>
                        </div>
                    @else
                        <div style="display:flex; justify-content:flex-start; gap:8px; animation:msgFadeIn 0.2s ease;">
                            <div style="width:28px; height:28px; border-radius:50%; background:linear-gradient(135deg,{{ $config['primary_color'] ?? '#D93690' }},{{ $config['secondary_color'] ?? '#667eea' }}); display:flex; align-items:center; justify-content:center; font-size:13px; flex-shrink:0; margin-top:4px;">🤖</div>
                            <div class="ecos-ai-bubble"
                                 data-typed="{{ $idx === $newestMessageIndex ? '0' : '1' }}"
                                 data-text="{{ $message['content'] }}"
                                 style="
                                    max-width:75%; padding:12px 16px; border-radius:18px 18px 18px 4px;
                                    background:white; color:#1e293b;
                                    box-shadow:0 2px 12px rgba(0,0,0,0.08);
                                ">
                                <p class="bubble-text" style="margin:0; font-size:14px; line-height:1.6; white-space:pre-wrap;">{{ $message['content'] }}</p>
                                @if(isset($message['links']) && count($message['links']) > 0)
                                    <div style="margin-top:10px; display:flex; flex-direction:column; gap:6px;">
                                        @foreach($message['links'] as $link)
                                            <a href="{{ $link['url'] }}"
                                               style="display:flex; align-items:center; gap:8px; padding:8px 12px; background:rgba(217,54,144,0.08); border-radius:10px; text-decoration:none; color:#D93690; font-size:13px; font-weight:500; transition:background 0.2s;"
                                               onmouseover="this.style.background='rgba(217,54,144,0.15)'"
                                               onmouseout="this.style.background='rgba(217,54,144,0.08)'">
                                                <i class="{{ $link['icon'] ?? 'fas fa-link' }}"></i>
                                                {{ $link['title'] }}
                                            </a>
                                        @endforeach
                                    </div>
                                @endif
                                <small style="opacity:0.45; font-size:11px; margin-top:4px; display:block;">{{ $message['timestamp'] }}</small>
                            </div>
                        </div>
                    @endif
                @endforeach

                {{-- Mensaje optimista del usuario (aparece inmediatamente) --}}
                <template x-if="pendingText">
                    <div style="display:flex; justify-content:flex-end;">
                        <div style="
                            max-width:75%; padding:12px 16px; border-radius:18px 18px 4px 18px;
                            background: linear-gradient(135deg, {{ $config['primary_color'] ?? '#D93690' }}, {{ $config['secondary_color'] ?? '#667eea' }});
                            color:white; box-shadow:0 2px 12px rgba(217,54,144,0.25); opacity:0.85;
                        ">
                            <p x-text="pendingText" style="margin:0; font-size:14px; line-height:1.5;"></p>
                        </div>
                    </div>
                </template>

                {{-- Burbuja streaming (controlada por Alpine store, no wire:loading) --}}
                <div x-data x-show="$store.ecosChat.sending" x-cloak
                     class="ecos-streaming-bubble">
                    <div style="width:28px; height:28px; border-radius:50%; background:linear-gradient(135deg,{{ $config['primary_color'] ?? '#D93690' }},{{ $config['secondary_color'] ?? '#667eea' }}); display:flex; align-items:center; justify-content:center; font-size:13px; flex-shrink:0; margin-top:4px;">🤖</div>
                    <div class="ecos-stream-wrap" style="max-width:75%; padding:12px 16px; border-radius:18px 18px 18px 4px; background:white; box-shadow:0 2px 12px rgba(0,0,0,0.08);">
                        <div class="typing-indicator ecos-stream-dots">
                            <span></span><span></span><span></span>
                        </div>
                        <p wire:stream="streamingMessage" class="ecos-stream-text" style="margin:0; font-size:14px; line-height:1.6; white-space:pre-wrap;"></p>
                    </div>
                </div>
            </div>

            {{-- Input --}}
            <div style="padding:14px 16px; background:white; border-top:1px solid #f1f5f9; flex-shrink:0;">
                <form wire:submit.prevent="sendMessage"
                      @submit="captureAndSend(); $store.ecosChat.sending = true"
                      style="display:flex; gap:10px; align-items:center;">
                    <input id="ecos-chat-input"
                           type="text"
                           wire:model.defer="newMessage"
                           placeholder="Escribe tu mensaje..."
                           autocomplete="off"
                           style="
                               flex:1; padding:12px 18px;
                               border:1.5px solid #e2e8f0; border-radius:25px;
                               outline:none; font-size:14px; color:#1e293b;
                               background:#f8fafc; transition:border-color 0.2s, box-shadow 0.2s;
                           "
                           onfocus="this.style.borderColor='{{ $config['primary_color'] ?? '#D93690' }}'; this.style.boxShadow='0 0 0 3px rgba(217,54,144,0.1)'; this.style.background='white';"
                           onblur="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none'; this.style.background='#f8fafc';">
                    <button type="submit"
                            wire:loading.attr="disabled"
                            wire:target="sendMessage"
                            style="
                                width:44px; height:44px; flex-shrink:0;
                                background: linear-gradient(135deg, {{ $config['primary_color'] ?? '#D93690' }} 0%, {{ $config['secondary_color'] ?? '#667eea' }} 100%);
                                border:none; border-radius:50%; color:white; cursor:pointer;
                                display:flex; align-items:center; justify-content:center;
                                box-shadow:0 4px 14px rgba(217,54,144,0.35);
                                transition: transform 0.15s, box-shadow 0.15s;
                            "
                            onmouseover="this.style.transform='scale(1.08)'; this.style.boxShadow='0 6px 18px rgba(217,54,144,0.5)'"
                            onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='0 4px 14px rgba(217,54,144,0.35)'">
                        <span wire:loading.remove wire:target="sendMessage">
                            <i class="fas fa-paper-plane" style="font-size:15px; margin-left:2px;"></i>
                        </span>
                        <span wire:loading wire:target="sendMessage">
                            <i class="fas fa-circle-notch fa-spin" style="font-size:14px;"></i>
                        </span>
                    </button>
                </form>
                <div style="text-align:center; margin-top:8px;">
                    <span style="font-size:11px; color:#94a3b8;">Powered by ECOS IA</span>
                </div>
            </div>
        </div>
        @endif

    @endif
</div>

<style>
[x-cloak] { display: none !important; }
.ecos-streaming-bubble { display: flex; justify-content: flex-start; gap: 8px; }
@keyframes chatSlideIn {
    from { opacity:0; transform: translateY(20px) scale(0.95); }
    to   { opacity:1; transform: translateY(0) scale(1); }
}
@keyframes msgFadeIn {
    from { opacity:0; transform: translateY(6px); }
    to   { opacity:1; transform: translateY(0); }
}
.typing-indicator { display:flex; gap:5px; align-items:center; padding:2px 0; }
.typing-indicator span {
    width:8px; height:8px; border-radius:50%;
    background: linear-gradient(135deg, #D93690, #667eea);
    animation: typingBounce 1.4s infinite ease-in-out;
}
.typing-indicator span:nth-child(1) { animation-delay:-0.32s; }
.typing-indicator span:nth-child(2) { animation-delay:-0.16s; }
@keyframes typingBounce {
    0%,80%,100% { transform:scale(0.7); opacity:0.5; }
    40% { transform:scale(1.1); opacity:1; }
}
#chat-messages::-webkit-scrollbar { width:4px; }
#chat-messages::-webkit-scrollbar-track { background:transparent; }
#chat-messages::-webkit-scrollbar-thumb { background:#D93690; border-radius:4px; }
.ecos-stream-text:not(:empty) ~ .ecos-stream-dots,
.ecos-stream-wrap:has(.ecos-stream-text:not(:empty)) .ecos-stream-dots { display:none; }
</style>

<script>
document.addEventListener('alpine:init', function () {
    Alpine.store('ecosChat', { sending: false });
});
document.addEventListener('livewire:initialized', function () {
    Livewire.on('scrollToBottom', function () {
        Alpine.store('ecosChat').sending = false;
        var el = document.getElementById('chat-messages');
        if (el) el.scrollTop = el.scrollHeight;
        window.dispatchEvent(new CustomEvent('ecos-response-ready'));
    });
    var el = document.getElementById('chat-messages');
    if (el) el.scrollTop = el.scrollHeight;
});
</script>
