<div style="background: white; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); border: 1px solid #e2e8f0; margin-bottom: 24px; overflow: hidden;">
    <div style="background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%); padding: 20px 24px; border-bottom: 1px solid #e2e8f0; display: flex; align-items: center; justify-content: space-between;">
        <h3 style="margin: 0; font-size: 1.4rem; font-weight: 700; color: #2d3748; display: flex; align-items: center; gap: 12px;">
            <i class="fas fa-lightbulb" style="font-size: 1.2rem; color: #D93690;"></i>
            Gestión de Prompts
        </h3>
        <button type="button"
                onclick="openNewPromptModal()"
                style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); border: none; border-radius: 8px; padding: 8px 16px; color: white; font-weight: 600; cursor: pointer;">
            <i class="fas fa-plus" style="margin-right: 6px;"></i> Nuevo Prompt
        </button>
    </div>
    <div style="padding: 24px;">
        <p style="color: #6b7280; margin-bottom: 20px;">Gestiona los prompts personalizados del asistente de IA.</p>
        
        <div style="background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
            <table style="width: 100%; border-collapse: collapse; font-size: 0.9rem;">
                <thead>
                    <tr style="background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%); border-bottom: 2px solid #e2e8f0;">
                        <th style="padding: 16px 20px; text-align: left; font-weight: 600; color: #2d3748; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px;">Categoría</th>
                        <th style="padding: 16px 20px; text-align: left; font-weight: 600; color: #2d3748; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px;">Nombre</th>
                        <th style="padding: 16px 20px; text-align: left; font-weight: 600; color: #2d3748; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px;">Prompt</th>
                        <th style="padding: 16px 20px; text-align: center; font-weight: 600; color: #2d3748; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px;">Prioridad</th>
                        <th style="padding: 16px 20px; text-align: center; font-weight: 600; color: #2d3748; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px;">Estado</th>
                        <th style="padding: 16px 20px; text-align: center; font-weight: 600; color: #2d3748; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($prompts) && count($prompts) > 0)
                        @foreach($prompts as $index => $prompt)
                        <tr style="border-bottom: 1px solid #f1f5f9; transition: all 0.2s ease; {{ $index % 2 == 0 ? 'background: #fafbfc;' : 'background: white;' }}">
                            <td style="padding: 16px 20px;">
                                <span style="background: linear-gradient(135deg, #D93690 0%, #667eea 100%); color: white; padding: 4px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">
                                    {{ $prompt->category }}
                                </span>
                            </td>
                            <td style="padding: 16px 20px; font-weight: 600; color: #2d3748;">{{ $prompt->name }}</td>
                            <td style="padding: 16px 20px; color: #6b7280; max-width: 300px;">
                                <div style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; line-height: 1.4;">
                                    {{ $prompt->prompt }}
                                </div>
                            </td>
                            <td style="padding: 16px 20px; text-align: center;">
                                <span style="background: #f1f5f9; color: #475569; padding: 4px 8px; border-radius: 6px; font-weight: 600; font-size: 0.8rem;">
                                    {{ $prompt->priority }}
                                </span>
                            </td>
                            <td style="padding: 16px 20px; text-align: center;">
                                <span style="background: {{ $prompt->is_active ? 'linear-gradient(135deg, #10b981 0%, #059669 100%)' : '#f1f5f9' }}; color: {{ $prompt->is_active ? 'white' : '#6b7280' }}; padding: 6px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">
                                    {{ $prompt->is_active ? 'Activo' : 'Inactivo' }}
                                </span>
                            </td>
                            <td style="padding: 16px 20px; text-align: center;">
                                <div style="display: flex; gap: 8px; justify-content: center;">
                                    <button style="background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); border: none; border-radius: 6px; padding: 8px 12px; color: white; cursor: pointer; transition: all 0.2s ease; box-shadow: 0 2px 4px rgba(59, 130, 246, 0.3);" onmouseover="this.style.transform='translateY(-1px)'; this.style.boxShadow='0 4px 8px rgba(59, 130, 246, 0.4)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 4px rgba(59, 130, 246, 0.3)'" onclick="editPrompt({{ $prompt->id }})">
                                        <i class="fas fa-edit" style="font-size: 0.8rem;"></i>
                                    </button>
                                    <a href="{{ route('admin.ai-assistant.delete-prompt', $prompt->id) }}"
                                       style="background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); border: none; border-radius: 6px; padding: 8px 12px; color: white; cursor: pointer; transition: all 0.2s ease; box-shadow: 0 2px 4px rgba(239, 68, 68, 0.3); text-decoration: none; display: inline-block;"
                                       onmouseover="this.style.transform='translateY(-1px)'; this.style.boxShadow='0 4px 8px rgba(239, 68, 68, 0.4)'" 
                                       onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 4px rgba(239, 68, 68, 0.3)'"
                                       onclick="event.preventDefault(); if(confirm('¿Estás seguro de eliminar este prompt?')) { document.getElementById('delete-prompt-{{ $prompt->id }}').submit(); }">
                                        <i class="fas fa-trash" style="font-size: 0.8rem;"></i>
                                    </a>
                                    <form id="delete-prompt-{{ $prompt->id }}" action="{{ route('admin.ai-assistant.delete-prompt', $prompt->id) }}" method="POST" style="display: none;">
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
                                        <i class="fas fa-lightbulb"></i>
                                    </div>
                                    <div>
                                        <h4 style="margin: 0 0 8px 0; color: #2d3748; font-weight: 600;">No hay prompts configurados</h4>
                                        <p style="margin: 0; color: #6b7280; font-size: 0.9rem;">Crea tu primer prompt para personalizar el asistente</p>
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

<!-- Modal Crear / Editar Prompt -->
<div class="modal fade" id="promptModal" tabindex="-1" aria-labelledby="promptModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background: linear-gradient(135deg, #D93690 0%, #667eea 100%); color: white;">
                <h5 class="modal-title" id="promptModalLabel">
                    <i class="fas fa-lightbulb" style="margin-right: 8px;"></i>
                    <span id="promptModalTitle">Nuevo Prompt</span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="promptForm" method="POST" action="{{ route('admin.ai-assistant.create-prompt') }}">
                @csrf
                <input type="hidden" name="_method" id="promptFormMethod" value="POST">
                <input type="hidden" id="promptIdHidden">
                <div class="modal-body" style="padding: 24px;">
                    <div class="form-group mb-3">
                        <label for="promptCategory" class="font-weight-semibold">Categoría</label>
                        <input type="text" id="promptCategory" name="category" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="promptName" class="font-weight-semibold">Nombre</label>
                        <input type="text" id="promptName" name="name" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="promptText" class="font-weight-semibold">Prompt</label>
                        <textarea id="promptText" name="prompt" class="form-control" rows="6" required></textarea>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6 mb-3">
                            <label for="promptPriority" class="font-weight-semibold">Prioridad (0-100)</label>
                            <input type="number" id="promptPriority" name="priority" class="form-control" min="0" max="100" value="0" required>
                        </div>
                        <div class="form-group col-md-6 mb-3 d-flex align-items-center">
                            <div class="form-check mt-3">
                                <input type="checkbox" class="form-check-input" id="promptIsActive" name="is_active" value="1" checked>
                                <label class="form-check-label" for="promptIsActive">Activo</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save" style="margin-right: 6px;"></i>
                        Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    window.aiPrompts = @json($prompts ?? []);
    let promptModalInstance = null;

    document.addEventListener('DOMContentLoaded', function () {
        const modalElement = document.getElementById('promptModal');
        if (modalElement && typeof $ !== 'undefined' && typeof $(modalElement).modal === 'function') {
            // Bootstrap 4 (usado en el layout CRM)
            promptModalInstance = $(modalElement);
        }
    });

    function openNewPromptModal() {
        document.getElementById('promptModalTitle').innerText = 'Nuevo Prompt';
        document.getElementById('promptForm').action = '{{ route('admin.ai-assistant.create-prompt') }}';
        document.getElementById('promptFormMethod').value = 'POST';
        document.getElementById('promptIdHidden').value = '';
        document.getElementById('promptCategory').value = '';
        document.getElementById('promptName').value = '';
        document.getElementById('promptText').value = '';
        document.getElementById('promptPriority').value = 0;
        document.getElementById('promptIsActive').checked = true;

        if (promptModalInstance) {
            promptModalInstance.modal('show');
        }
    }

    function editPrompt(id) {
        const prompts = window.aiPrompts || [];
        const prompt = prompts.find(p => parseInt(p.id) === parseInt(id));
        if (!prompt) {
            alert('No se ha encontrado la información de este prompt.');
            return;
        }

        document.getElementById('promptModalTitle').innerText = 'Editar Prompt';
        document.getElementById('promptForm').action = '{{ url('crm/ai-assistant/prompts') }}/' + id;
        document.getElementById('promptFormMethod').value = 'PUT';
        document.getElementById('promptIdHidden').value = id;
        document.getElementById('promptCategory').value = prompt.category || '';
        document.getElementById('promptName').value = prompt.name || '';
        document.getElementById('promptText').value = prompt.prompt || '';
        document.getElementById('promptPriority').value = prompt.priority ?? 0;
        document.getElementById('promptIsActive').checked = !!prompt.is_active;

        if (promptModalInstance) {
            promptModalInstance.modal('show');
        }
    }
</script>
