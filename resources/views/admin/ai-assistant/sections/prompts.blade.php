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

<!-- Modal Overlay -->
<div id="promptModalOverlay" onclick="if(event.target===this)closePromptModal()" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.5); z-index:9999; align-items:center; justify-content:center; padding:20px;">
    <div style="background:white; border-radius:16px; width:100%; max-width:600px; box-shadow:0 20px 60px rgba(0,0,0,0.3); overflow:hidden;">
        <!-- Header -->
        <div style="background:linear-gradient(135deg,#D93690 0%,#667eea 100%); padding:20px 24px; display:flex; align-items:center; justify-content:space-between;">
            <h5 style="margin:0; color:white; font-size:1.1rem; font-weight:700; display:flex; align-items:center; gap:8px;">
                <i class="fas fa-lightbulb"></i>
                <span id="promptModalTitle">Nuevo Prompt</span>
            </h5>
            <button onclick="closePromptModal()" style="background:rgba(255,255,255,0.2); border:none; color:white; width:32px; height:32px; border-radius:8px; cursor:pointer; font-size:1rem; display:flex; align-items:center; justify-content:center;">&times;</button>
        </div>

        <!-- Form -->
        <form id="promptForm" method="POST" action="{{ route('admin.ai-assistant.create-prompt') }}">
            @csrf
            <input type="hidden" name="_method" id="promptFormMethod" value="POST">
            <input type="hidden" id="promptIdHidden">

            <div style="padding:24px; display:flex; flex-direction:column; gap:18px;">
                <!-- Categoría + Nombre en 2 cols -->
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
                    <div>
                        <label style="display:block; font-size:0.78rem; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:0.5px; margin-bottom:6px;">Categoría *</label>
                        <input type="text" id="promptCategory" name="category" required
                               style="width:100%; padding:10px 14px; border:1px solid #e5e7eb; border-radius:8px; font-size:0.9rem; color:#111827; box-sizing:border-box; transition:border-color 0.2s;"
                               onfocus="this.style.borderColor='#D93690';this.style.boxShadow='0 0 0 3px rgba(217,54,144,0.1)'"
                               onblur="this.style.borderColor='#e5e7eb';this.style.boxShadow='none'">
                    </div>
                    <div>
                        <label style="display:block; font-size:0.78rem; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:0.5px; margin-bottom:6px;">Nombre *</label>
                        <input type="text" id="promptName" name="name" required
                               style="width:100%; padding:10px 14px; border:1px solid #e5e7eb; border-radius:8px; font-size:0.9rem; color:#111827; box-sizing:border-box; transition:border-color 0.2s;"
                               onfocus="this.style.borderColor='#D93690';this.style.boxShadow='0 0 0 3px rgba(217,54,144,0.1)'"
                               onblur="this.style.borderColor='#e5e7eb';this.style.boxShadow='none'">
                    </div>
                </div>

                <!-- Prompt textarea -->
                <div>
                    <label style="display:block; font-size:0.78rem; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:0.5px; margin-bottom:6px;">Prompt *</label>
                    <textarea id="promptText" name="prompt" rows="5" required
                              style="width:100%; padding:10px 14px; border:1px solid #e5e7eb; border-radius:8px; font-size:0.9rem; color:#111827; box-sizing:border-box; resize:vertical; font-family:inherit; transition:border-color 0.2s;"
                              onfocus="this.style.borderColor='#D93690';this.style.boxShadow='0 0 0 3px rgba(217,54,144,0.1)'"
                              onblur="this.style.borderColor='#e5e7eb';this.style.boxShadow='none'"></textarea>
                </div>

                <!-- Prioridad + Activo -->
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px; align-items:end;">
                    <div>
                        <label style="display:block; font-size:0.78rem; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:0.5px; margin-bottom:6px;">Prioridad (0-100)</label>
                        <input type="number" id="promptPriority" name="priority" min="0" max="100" value="0" required
                               style="width:100%; padding:10px 14px; border:1px solid #e5e7eb; border-radius:8px; font-size:0.9rem; color:#111827; box-sizing:border-box; transition:border-color 0.2s;"
                               onfocus="this.style.borderColor='#D93690';this.style.boxShadow='0 0 0 3px rgba(217,54,144,0.1)'"
                               onblur="this.style.borderColor='#e5e7eb';this.style.boxShadow='none'">
                    </div>
                    <div style="display:flex; align-items:center; gap:10px; padding-bottom:2px;">
                        <label style="position:relative; display:inline-flex; align-items:center; cursor:pointer; gap:10px;">
                            <input type="checkbox" id="promptIsActive" name="is_active" value="1" checked style="display:none;">
                            <span id="toggleTrack" onclick="toggleActive()" style="width:44px; height:24px; background:#D93690; border-radius:12px; display:inline-block; position:relative; cursor:pointer; transition:background 0.2s;">
                                <span id="toggleThumb" style="position:absolute; top:2px; left:2px; width:20px; height:20px; background:white; border-radius:50%; transition:left 0.2s; left:22px;"></span>
                            </span>
                            <span style="font-size:0.9rem; font-weight:600; color:#374151;">Activo</span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div style="padding:16px 24px; border-top:1px solid #f0f0f0; display:flex; gap:10px; justify-content:flex-end; background:#fafafa;">
                <button type="button" onclick="closePromptModal()" style="padding:10px 20px; border-radius:8px; border:1px solid #e5e7eb; background:white; color:#6b7280; font-weight:600; font-size:0.85rem; cursor:pointer;">
                    Cancelar
                </button>
                <button type="submit" style="padding:10px 20px; border-radius:8px; border:none; background:linear-gradient(135deg,#D93690,#667eea); color:white; font-weight:700; font-size:0.85rem; cursor:pointer; display:flex; align-items:center; gap:6px;">
                    <i class="fas fa-save"></i> Guardar
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    window.aiPrompts = @json($prompts ?? []);

    function openPromptModal() {
        const overlay = document.getElementById('promptModalOverlay');
        overlay.style.display = 'flex';
    }

    function closePromptModal() {
        document.getElementById('promptModalOverlay').style.display = 'none';
    }

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
        syncToggle(true);
        openPromptModal();
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
        const active = !!prompt.is_active;
        document.getElementById('promptIsActive').checked = active;
        syncToggle(active);
        openPromptModal();
    }

    function toggleActive() {
        const cb = document.getElementById('promptIsActive');
        cb.checked = !cb.checked;
        syncToggle(cb.checked);
    }

    function syncToggle(active) {
        const track = document.getElementById('toggleTrack');
        const thumb = document.getElementById('toggleThumb');
        track.style.background = active ? '#D93690' : '#d1d5db';
        thumb.style.left = active ? '22px' : '2px';
    }

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closePromptModal();
    });
</script>
