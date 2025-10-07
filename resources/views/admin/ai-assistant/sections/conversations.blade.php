<div style="background: white; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); border: 1px solid #e2e8f0; margin-bottom: 24px; overflow: hidden;">
    <div style="background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%); padding: 20px 24px; border-bottom: 1px solid #e2e8f0;">
        <h3 style="margin: 0; font-size: 1.4rem; font-weight: 700; color: #2d3748; display: flex; align-items: center; gap: 12px;">
            <i class="fas fa-comments" style="font-size: 1.2rem; color: #D93690;"></i>
            Historial de Conversaciones
        </h3>
    </div>
    <div style="padding: 24px;">
        <p style="color: #6b7280; margin-bottom: 20px;">Revisa las conversaciones que los usuarios han tenido con el asistente de IA.</p>
        
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Mensaje Usuario</th>
                        <th>Respuesta Asistente</th>
                        <th>URL Página</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($conversations) && count($conversations) > 0)
                        @foreach($conversations as $conversation)
                        <tr>
                            <td>{{ $conversation->created_at->format('d/m/Y H:i') }}</td>
                            <td>{{ Str::limit($conversation->user_message, 50) }}</td>
                            <td>{{ Str::limit($conversation->assistant_response, 50) }}</td>
                            <td>{{ $conversation->page_url }}</td>
                            <td>
                                <a href="{{ route('admin.ai-assistant.delete-conversation', $conversation->id) }}"
                                   class="btn btn-sm btn-danger"
                                   onclick="event.preventDefault(); if(confirm('¿Estás seguro de eliminar esta conversación?')) { document.getElementById('delete-conversation-{{ $conversation->id }}').submit(); }">
                                    <i class="fas fa-trash"></i>
                                </a>
                                <form id="delete-conversation-{{ $conversation->id }}" action="{{ route('admin.ai-assistant.delete-conversation', $conversation->id) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5" style="text-align: center; padding: 40px; color: #6b7280;">
                                <i class="fas fa-comments" style="font-size: 2rem; margin-bottom: 10px; display: block;"></i>
                                No hay conversaciones registradas aún
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
