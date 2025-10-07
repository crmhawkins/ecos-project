<div style="background: white; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); border: 1px solid #e2e8f0; margin-bottom: 24px; overflow: hidden;">
    <div style="background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%); padding: 20px 24px; border-bottom: 1px solid #e2e8f0; display: flex; align-items: center; justify-content: space-between;">
        <h3 style="margin: 0; font-size: 1.4rem; font-weight: 700; color: #2d3748; display: flex; align-items: center; gap: 12px;">
            <i class="fas fa-link" style="font-size: 1.2rem; color: #D93690;"></i>
            Enlaces Útiles
        </h3>
        <button style="background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); border: none; border-radius: 8px; padding: 8px 16px; color: white; font-weight: 600; cursor: pointer;">
            <i class="fas fa-plus" style="margin-right: 6px;"></i> Nuevo Enlace
        </button>
    </div>
    <div style="padding: 24px;">
        <p style="color: #6b7280; margin-bottom: 20px;">Gestiona los enlaces que el asistente puede recomendar a los usuarios.</p>
        
        <div style="background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
            <table style="width: 100%; border-collapse: collapse; font-size: 0.9rem;">
                <thead>
                    <tr style="background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%); border-bottom: 2px solid #e2e8f0;">
                        <th style="padding: 16px 20px; text-align: left; font-weight: 600; color: #2d3748; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px;">Título</th>
                        <th style="padding: 16px 20px; text-align: left; font-weight: 600; color: #2d3748; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px;">URL</th>
                        <th style="padding: 16px 20px; text-align: center; font-weight: 600; color: #2d3748; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px;">Categoría</th>
                        <th style="padding: 16px 20px; text-align: center; font-weight: 600; color: #2d3748; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px;">Prioridad</th>
                        <th style="padding: 16px 20px; text-align: center; font-weight: 600; color: #2d3748; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px;">Estado</th>
                        <th style="padding: 16px 20px; text-align: center; font-weight: 600; color: #2d3748; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($links) && count($links) > 0)
                        @foreach($links as $index => $link)
                        <tr style="border-bottom: 1px solid #f1f5f9; transition: all 0.2s ease; {{ $index % 2 == 0 ? 'background: #fafbfc;' : 'background: white;' }}">
                            <td style="padding: 16px 20px; font-weight: 600; color: #2d3748;">{{ $link->title }}</td>
                            <td style="padding: 16px 20px; color: #6b7280; max-width: 300px;">
                                <a href="{{ $link->url }}" target="_blank" style="color: #3b82f6; text-decoration: none; font-weight: 500; display: inline-block; max-width: 100%; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                    {{ $link->url }}
                                </a>
                            </td>
                            <td style="padding: 16px 20px; text-align: center;">
                                <span style="background: linear-gradient(135deg, #D93690 0%, #667eea 100%); color: white; padding: 4px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">
                                    {{ $link->category }}
                                </span>
                            </td>
                            <td style="padding: 16px 20px; text-align: center;">
                                <span style="background: #f1f5f9; color: #475569; padding: 4px 8px; border-radius: 6px; font-weight: 600; font-size: 0.8rem;">
                                    {{ $link->priority }}
                                </span>
                            </td>
                            <td style="padding: 16px 20px; text-align: center;">
                                <span style="background: {{ $link->is_active ? 'linear-gradient(135deg, #10b981 0%, #059669 100%)' : '#f1f5f9' }}; color: {{ $link->is_active ? 'white' : '#6b7280' }}; padding: 6px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">
                                    {{ $link->is_active ? 'Activo' : 'Inactivo' }}
                                </span>
                            </td>
                            <td style="padding: 16px 20px; text-align: center;">
                                <div style="display: flex; gap: 8px; justify-content: center;">
                                    <button style="background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); border: none; border-radius: 6px; padding: 8px 12px; color: white; cursor: pointer; transition: all 0.2s ease; box-shadow: 0 2px 4px rgba(59, 130, 246, 0.3);" onmouseover="this.style.transform='translateY(-1px)'; this.style.boxShadow='0 4px 8px rgba(59, 130, 246, 0.4)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 4px rgba(59, 130, 246, 0.3)'" onclick="editLink({{ $link->id }})">
                                        <i class="fas fa-edit" style="font-size: 0.8rem;"></i>
                                    </button>
                                    <a href="{{ route('admin.ai-assistant.delete-link', $link->id) }}"
                                       style="background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); border: none; border-radius: 6px; padding: 8px 12px; color: white; cursor: pointer; transition: all 0.2s ease; box-shadow: 0 2px 4px rgba(239, 68, 68, 0.3); text-decoration: none; display: inline-block;"
                                       onmouseover="this.style.transform='translateY(-1px)'; this.style.boxShadow='0 4px 8px rgba(239, 68, 68, 0.4)'" 
                                       onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 4px rgba(239, 68, 68, 0.3)'"
                                       onclick="event.preventDefault(); if(confirm('¿Estás seguro de eliminar este enlace?')) { document.getElementById('delete-link-{{ $link->id }}').submit(); }">
                                        <i class="fas fa-trash" style="font-size: 0.8rem;"></i>
                                    </a>
                                    <form id="delete-link-{{ $link->id }}" action="{{ route('admin.ai-assistant.delete-link', $link->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6" style="text-align: center; padding: 60px 20px; color: #6b7280; background: #fafbfc;">
                                <div style="display: flex; flex-direction: column; align-items: center; gap: 16px;">
                                    <div style="background: linear-gradient(135deg, #D93690 0%, #667eea 100%); color: white; width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                                        <i class="fas fa-link"></i>
                                    </div>
                                    <div>
                                        <h4 style="margin: 0 0 8px 0; color: #2d3748; font-weight: 600;">No hay enlaces configurados</h4>
                                        <p style="margin: 0; color: #6b7280; font-size: 0.9rem;">Crea tu primer enlace para que el asistente pueda recomendarlo</p>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
