<div style="background: white; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); border: 1px solid #e2e8f0; margin-bottom: 24px; overflow: hidden;">
    <div style="background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%); padding: 20px 24px; border-bottom: 1px solid #e2e8f0;">
        <h3 style="margin: 0; font-size: 1.4rem; font-weight: 700; color: #2d3748; display: flex; align-items: center; gap: 12px;">
            <i class="fas fa-comments" style="font-size: 1.2rem; color: #D93690;"></i>
            Historial de Conversaciones
        </h3>
    </div>
    <div style="padding: 24px;">
        <p style="color: #6b7280; margin-bottom: 20px;">Revisa las conversaciones que los usuarios han tenido con el asistente de IA.</p>
        
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; font-size: 0.9rem;">
                <thead>
                    <tr style="background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);">
                        <th style="padding: 16px 20px; text-align: left; border-bottom: 1px solid #f1f5f9; font-weight: 600; color: #2d3748; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px;">Fecha</th>
                        <th style="padding: 16px 20px; text-align: left; border-bottom: 1px solid #f1f5f9; font-weight: 600; color: #2d3748; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px;">Mensaje Usuario</th>
                        <th style="padding: 16px 20px; text-align: left; border-bottom: 1px solid #f1f5f9; font-weight: 600; color: #2d3748; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px;">Respuesta Asistente</th>
                        <th style="padding: 16px 20px; text-align: left; border-bottom: 1px solid #f1f5f9; font-weight: 600; color: #2d3748; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px;">URL Página</th>
                        <th style="padding: 16px 20px; text-align: left; border-bottom: 1px solid #f1f5f9; font-weight: 600; color: #2d3748; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($conversations) && count($conversations) > 0)
                        @foreach($conversations as $conversation)
                        <tr style="border-bottom: 1px solid #f1f5f9; {{ $loop->even ? 'background: #fafbfc;' : '' }} transition: background-color 0.2s ease;" onmouseover="this.style.background='#f0f4f8'" onmouseout="this.style.background='{{ $loop->even ? '#fafbfc' : 'white' }}'">
                            <td style="padding: 16px 20px; text-align: left; border-bottom: 1px solid #f1f5f9; color: #475569; font-weight: 500;">{{ $conversation->created_at->format('d/m/Y H:i') }}</td>
                            <td style="padding: 16px 20px; text-align: left; border-bottom: 1px solid #f1f5f9; color: #2d3748; max-width: 200px;">
                                <div style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" title="{{ $conversation->user_message }}">
                                    {{ Str::limit($conversation->user_message, 50) }}
                                </div>
                            </td>
                            <td style="padding: 16px 20px; text-align: left; border-bottom: 1px solid #f1f5f9; color: #2d3748; max-width: 200px;">
                                <div style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" title="{{ $conversation->assistant_response }}">
                                    {{ Str::limit($conversation->assistant_response, 50) }}
                                </div>
                            </td>
                            <td style="padding: 16px 20px; text-align: left; border-bottom: 1px solid #f1f5f9; color: #6b7280; font-size: 0.85rem;">
                                <a href="{{ $conversation->page_url }}" target="_blank" style="color: #D93690; text-decoration: none; font-weight: 500;" title="{{ $conversation->page_url }}">
                                    {{ Str::limit($conversation->page_url, 30) }}
                                </a>
                            </td>
                            <td style="padding: 16px 20px; text-align: left; border-bottom: 1px solid #f1f5f9;">
                                <div style="display: flex; gap: 8px; align-items: center;">
                                    <button onclick="showConversationModal('{{ addslashes($conversation->user_message) }}', '{{ addslashes($conversation->assistant_response) }}', '{{ $conversation->created_at->format('d/m/Y H:i') }}')" 
                                            style="background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); border: none; border-radius: 6px; padding: 8px 12px; color: white; cursor: pointer; transition: all 0.2s ease; box-shadow: 0 2px 4px rgba(0,0,0,0.1); display: inline-flex; align-items: center; justify-content: center; gap: 5px;"
                                            onmouseover="this.style.transform='translateY(-1px)'; this.style.boxShadow='0 4px 8px rgba(59, 130, 246, 0.4)'"
                                            onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 4px rgba(0,0,0,0.1)'">
                                        <i class="fas fa-eye" style="font-size: 0.8rem;"></i>
                                        <span style="font-size: 0.8rem; margin-left: 4px;">Ver</span>
                                    </button>
                                    
                                    <button onclick="deleteConversation({{ $conversation->id }})" 
                                            style="background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); border: none; border-radius: 6px; padding: 8px 12px; color: white; cursor: pointer; transition: all 0.2s ease; box-shadow: 0 2px 4px rgba(0,0,0,0.1); display: inline-flex; align-items: center; justify-content: center; gap: 5px;"
                                            onmouseover="this.style.transform='translateY(-1px)'; this.style.boxShadow='0 4px 8px rgba(239, 68, 68, 0.4)'"
                                            onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 4px rgba(0,0,0,0.1)'">
                                        <i class="fas fa-trash" style="font-size: 0.8rem;"></i>
                                    </button>
                                </div>
                                <form id="delete-conversation-{{ $conversation->id }}" action="{{ route('admin.ai-assistant.delete-conversation', $conversation->id) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5" style="text-align: center; padding: 60px 20px; color: #6b7280; background: #fafbfc; border-radius: 8px; margin-top: 20px;">
                                <div style="background: linear-gradient(135deg, #D93690 0%, #667eea 100%); color: white; width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin: 0 auto 16px auto;">
                                    <i class="fas fa-comments"></i>
                                </div>
                                <h4 style="margin: 0 0 8px 0; color: #2d3748; font-weight: 600;">No hay conversaciones</h4>
                                <p style="margin: 0; color: #6b7280; font-size: 0.9rem;">Aún no se han registrado conversaciones con el asistente de IA.</p>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <!-- Modal para mostrar conversación completa -->
        <div id="conversationModal" style="display: none; position: fixed; z-index: 1050; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(0,0,0,0.4);">
            <div style="background-color: #fefefe; margin: 5% auto; padding: 30px; border: 1px solid #888; width: 90%; max-width: 800px; border-radius: 12px; box-shadow: 0 10px 30px rgba(0,0,0,0.3); position: relative;">
                <span onclick="closeConversationModal()" style="position: absolute; top: 15px; right: 20px; color: #aaa; font-size: 28px; font-weight: bold; cursor: pointer; z-index: 1051;">&times;</span>
                
                <div style="border-bottom: 2px solid #e2e8f0; padding-bottom: 20px; margin-bottom: 25px;">
                    <h2 style="margin: 0; font-size: 1.8rem; color: #2d3748; display: flex; align-items: center; gap: 12px;">
                        <i class="fas fa-comments" style="color: #D93690; font-size: 1.5rem;"></i>
                        Conversación Completa
                    </h2>
                    <p id="conversationDate" style="margin: 8px 0 0 0; color: #6b7280; font-size: 0.9rem;"></p>
                </div>
                
                <div style="margin-bottom: 25px;">
                    <div style="background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%); padding: 20px; border-radius: 12px; border-left: 4px solid #D93690;">
                        <h4 style="margin: 0 0 12px 0; color: #D93690; font-size: 1.1rem; font-weight: 600; display: flex; align-items: center; gap: 8px;">
                            <i class="fas fa-user" style="font-size: 1rem;"></i>
                            Mensaje del Usuario
                        </h4>
                        <p id="modalUserMessage" style="margin: 0; color: #2d3748; line-height: 1.6; white-space: pre-wrap; background: white; padding: 15px; border-radius: 8px; border: 1px solid #e2e8f0;"></p>
                    </div>
                </div>
                
                <div>
                    <div style="background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%); padding: 20px; border-radius: 12px; border-left: 4px solid #667eea;">
                        <h4 style="margin: 0 0 12px 0; color: #667eea; font-size: 1.1rem; font-weight: 600; display: flex; align-items: center; gap: 8px;">
                            <i class="fas fa-robot" style="font-size: 1rem;"></i>
                            Respuesta del Asistente
                        </h4>
                        <p id="modalAssistantResponse" style="margin: 0; color: #2d3748; line-height: 1.6; white-space: pre-wrap; background: white; padding: 15px; border-radius: 8px; border: 1px solid #e2e8f0;"></p>
                    </div>
                </div>
            </div>
        </div>

        <script>
        function showConversationModal(userMessage, assistantResponse, date) {
            document.getElementById('modalUserMessage').textContent = userMessage;
            document.getElementById('modalAssistantResponse').textContent = assistantResponse;
            document.getElementById('conversationDate').textContent = 'Fecha: ' + date;
            document.getElementById('conversationModal').style.display = 'block';
        }

        function closeConversationModal() {
            document.getElementById('conversationModal').style.display = 'none';
        }

        function deleteConversation(id) {
            if (confirm('¿Estás seguro de eliminar esta conversación?')) {
                document.getElementById('delete-conversation-' + id).submit();
            }
        }

        // Cerrar modal al hacer clic fuera de él
        window.onclick = function(event) {
            const modal = document.getElementById('conversationModal');
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        }

        // Cerrar modal con tecla Escape
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeConversationModal();
            }
        });
        </script>
    </div>
</div>
