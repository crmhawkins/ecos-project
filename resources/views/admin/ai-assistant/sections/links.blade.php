<div style="background: white; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); border: 1px solid #e2e8f0; margin-bottom: 24px; overflow: hidden;">
    <div style="background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%); padding: 20px 24px; border-bottom: 1px solid #e2e8f0; display: flex; align-items: center; justify-content: space-between;">
        <h3 style="margin: 0; font-size: 1.4rem; font-weight: 700; color: #2d3748; display: flex; align-items: center; gap: 12px;">
            <i class="fas fa-link" style="font-size: 1.2rem; color: #D93690;"></i>
            Enlaces Útiles
        </h3>
        <button onclick="openNewLinkModal()" style="background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); border: none; border-radius: 8px; padding: 8px 16px; color: white; font-weight: 600; cursor: pointer;">
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

<!-- Modal Enlace -->
<div id="linkModalOverlay" onclick="if(event.target===this)closeLinkModal()" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.5); z-index:9999; align-items:center; justify-content:center; padding:20px;">
    <div style="background:white; border-radius:16px; width:100%; max-width:580px; box-shadow:0 20px 60px rgba(0,0,0,0.3); overflow:hidden;">
        <div style="background:linear-gradient(135deg,#3b82f6 0%,#2563eb 100%); padding:20px 24px; display:flex; align-items:center; justify-content:space-between;">
            <h5 style="margin:0; color:white; font-size:1.1rem; font-weight:700; display:flex; align-items:center; gap:8px;">
                <i class="fas fa-link"></i>
                <span id="linkModalTitle">Nuevo Enlace</span>
            </h5>
            <button onclick="closeLinkModal()" style="background:rgba(255,255,255,0.2); border:none; color:white; width:32px; height:32px; border-radius:8px; cursor:pointer; font-size:1rem;">&times;</button>
        </div>
        <form id="linkForm" method="POST" action="{{ route('admin.ai-assistant.create-link') }}">
            @csrf
            <input type="hidden" name="_method" id="linkFormMethod" value="POST">
            <div style="padding:24px; display:flex; flex-direction:column; gap:16px;">
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
                    <div>
                        <label style="display:block; font-size:0.78rem; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:0.5px; margin-bottom:6px;">Título *</label>
                        <input type="text" id="linkTitle" name="title" required style="width:100%; padding:10px 14px; border:1px solid #e5e7eb; border-radius:8px; font-size:0.9rem; box-sizing:border-box;">
                    </div>
                    <div>
                        <label style="display:block; font-size:0.78rem; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:0.5px; margin-bottom:6px;">Categoría *</label>
                        <input type="text" id="linkCategory" name="category" required style="width:100%; padding:10px 14px; border:1px solid #e5e7eb; border-radius:8px; font-size:0.9rem; box-sizing:border-box;">
                    </div>
                </div>
                <div>
                    <label style="display:block; font-size:0.78rem; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:0.5px; margin-bottom:6px;">URL *</label>
                    <input type="url" id="linkUrl" name="url" required style="width:100%; padding:10px 14px; border:1px solid #e5e7eb; border-radius:8px; font-size:0.9rem; box-sizing:border-box;">
                </div>
                <div>
                    <label style="display:block; font-size:0.78rem; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:0.5px; margin-bottom:6px;">Descripción</label>
                    <input type="text" id="linkDescription" name="description" style="width:100%; padding:10px 14px; border:1px solid #e5e7eb; border-radius:8px; font-size:0.9rem; box-sizing:border-box;">
                </div>
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px; align-items:end;">
                    <div>
                        <label style="display:block; font-size:0.78rem; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:0.5px; margin-bottom:6px;">Prioridad (0-100)</label>
                        <input type="number" id="linkPriority" name="priority" min="0" max="100" value="0" required style="width:100%; padding:10px 14px; border:1px solid #e5e7eb; border-radius:8px; font-size:0.9rem; box-sizing:border-box;">
                    </div>
                    <div style="display:flex; align-items:center; gap:10px; padding-bottom:2px;">
                        <label style="position:relative; display:inline-flex; align-items:center; cursor:pointer; gap:10px;">
                            <input type="hidden" name="is_active" value="0">
                            <input type="checkbox" id="linkIsActive" name="is_active" value="1" checked style="display:none;">
                            <span id="linkToggleTrack" onclick="toggleLinkActive()" style="width:44px; height:24px; background:#3b82f6; border-radius:12px; display:inline-block; position:relative; cursor:pointer; transition:background 0.2s;">
                                <span id="linkToggleThumb" style="position:absolute; top:2px; left:22px; width:20px; height:20px; background:white; border-radius:50%; transition:left 0.2s;"></span>
                            </span>
                            <span style="font-size:0.9rem; font-weight:600; color:#374151;">Activo</span>
                        </label>
                    </div>
                </div>
            </div>
            <div style="padding:16px 24px; border-top:1px solid #f0f0f0; display:flex; gap:10px; justify-content:flex-end; background:#fafafa;">
                <button type="button" onclick="closeLinkModal()" style="padding:10px 20px; border-radius:8px; border:1px solid #e5e7eb; background:white; color:#6b7280; font-weight:600; cursor:pointer;">Cancelar</button>
                <button type="submit" style="padding:10px 20px; border-radius:8px; border:none; background:linear-gradient(135deg,#3b82f6,#2563eb); color:white; font-weight:700; cursor:pointer;"><i class="fas fa-save"></i> Guardar</button>
            </div>
        </form>
    </div>
</div>

<script>
    window.aiLinks = @json($links ?? []);

    function openNewLinkModal() {
        document.getElementById('linkModalTitle').innerText = 'Nuevo Enlace';
        document.getElementById('linkForm').action = '{{ route('admin.ai-assistant.create-link') }}';
        document.getElementById('linkFormMethod').value = 'POST';
        document.getElementById('linkTitle').value = '';
        document.getElementById('linkCategory').value = '';
        document.getElementById('linkUrl').value = '';
        document.getElementById('linkDescription').value = '';
        document.getElementById('linkPriority').value = 0;
        document.getElementById('linkIsActive').checked = true;
        syncLinkToggle(true);
        document.getElementById('linkModalOverlay').style.display = 'flex';
    }

    function editLink(id) {
        const links = window.aiLinks || [];
        const link = links.find(l => parseInt(l.id) === parseInt(id));
        if (!link) { alert('No se encontró la información de este enlace.'); return; }
        document.getElementById('linkModalTitle').innerText = 'Editar Enlace';
        document.getElementById('linkForm').action = '{{ url('crm/ai-assistant/links') }}/' + id;
        document.getElementById('linkFormMethod').value = 'PUT';
        document.getElementById('linkTitle').value = link.title || '';
        document.getElementById('linkCategory').value = link.category || '';
        document.getElementById('linkUrl').value = link.url || '';
        document.getElementById('linkDescription').value = link.description || '';
        document.getElementById('linkPriority').value = link.priority ?? 0;
        const active = !!link.is_active;
        document.getElementById('linkIsActive').checked = active;
        syncLinkToggle(active);
        document.getElementById('linkModalOverlay').style.display = 'flex';
    }

    function closeLinkModal() {
        document.getElementById('linkModalOverlay').style.display = 'none';
    }

    function toggleLinkActive() {
        const cb = document.getElementById('linkIsActive');
        cb.checked = !cb.checked;
        syncLinkToggle(cb.checked);
    }

    function syncLinkToggle(active) {
        document.getElementById('linkToggleTrack').style.background = active ? '#3b82f6' : '#d1d5db';
        document.getElementById('linkToggleThumb').style.left = active ? '22px' : '2px';
    }

    document.addEventListener('keydown', function(e) { if (e.key === 'Escape') closeLinkModal(); });
</script>
