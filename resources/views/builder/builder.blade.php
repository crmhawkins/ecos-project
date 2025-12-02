<!DOCTYPE html>
<html>
<head>
    <title>Editor Visual</title>


    {{-- CSS del editor --}}
    <link href="https://unpkg.com/grapesjs/dist/css/grapes.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    {{-- CodeMirror para editor de CSS --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/codemirror.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/theme/monokai.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/codemirror.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/mode/css/css.min.js"></script>
    <style>
        body, html { margin: 0; padding: 0; height: 100%; }
        #gjs { height: 100% !important; }
        
        /* Animación de spin para iconos de carga */
        .spin {
            animation: spin 1s linear infinite;
        }
        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        
        /* Estilos para drag & drop del menú */
        .menu-item-draggable {
            transition: background-color 0.2s;
        }
        .menu-item-draggable:hover {
            background-color: #f8f9fa;
        }
        .menu-item-draggable.dragging {
            opacity: 0.5;
        }
        
        /* Estilos para CodeMirror */
        .CodeMirror {
            border: 1px solid #ddd;
            border-radius: 8px;
            height: auto;
            min-height: 400px;
            font-size: 14px;
        }
        .CodeMirror-scroll {
            min-height: 400px;
        }
    </style>
    <style>
        #builderToggle {
            position: fixed;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1050;
            background: #ffffff;
            border: 1px solid #ccc;
            border-bottom-left-radius: 20px;
            border-bottom-right-radius: 20px;
            padding: 1px 12px;
            cursor: pointer;
            font-weight: 600;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            transition: background 0.3s;
        }

        #builderToggle:hover {
            background: #f8f9fa;
        }

       #builderPanel {
            display: none;
            position: fixed;
            top: 28px;
            left: 50%;
            transform: translateX(-50%) translateY(-10px);
            opacity: 0;
            transition: opacity 0.3s ease, transform 0.3s ease;
            z-index: 1040;
            background: #ffffff;
            border: 1px solid #ddd;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 90%;
            max-width: 900px;
            pointer-events: none; /* evita clics cuando está oculto */
        }

        #builderPanel.show {
            display: block;
            opacity: 1;
            transform: translateX(-50%) translateY(0);
            pointer-events: auto;
        }
        #builderPanel .form-label {
            font-weight: 500;
            margin-bottom: 4px;
        }

        .rotate-180 {
            transform: rotate(180deg);
            transition: transform 0.3s ease;
        }
    </style>
</head>
<body>
    <div id="builderToggle">
        <i class="bi bi-chevron-down" id="arrowIcon"></i>
    </div>
    <div id="builderPanel">
        <div class="row g-3">
            {{-- Crear nueva vista --}}
            <div class="col-md-6">
                <form method="POST" action="{{ route('builder.create') }}" class="d-flex flex-column gap-2">
                    @csrf
                    <label for="new_view" class="form-label">Crear nueva vista:</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-file-earmark-plus"></i></span>
                        <input type="text" name="new_view" id="new_view" class="form-control" placeholder="ej. nueva_pagina" required>
                        <button class="btn btn-success" type="submit">Crear</button>
                    </div>
                </form>
            </div>

            {{-- Editar vista --}}
            <div class="col-md-6">
                <form method="GET" action="{{ route('builder') }}" class="d-flex flex-column gap-2">
                    <label for="view" class="form-label">Editar vista:</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-pencil-square"></i></span>
                        <select name="view" id="view" class="form-select" onchange="this.form.submit()">
                            @foreach ($views as $key => $label)
                                <option value="{{ $key }}" {{ $currentView === $key ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                        <button type="button" class="btn btn-outline-primary" onclick="showDuplicateModal()" title="Duplicar vista actual">
                            <i class="bi bi-files"></i>
                        </button>
                            <button type="button" class="btn btn-outline-danger" onclick="showDeleteViewModal()" title="Borrar vista actual">
                                <i class="bi bi-trash"></i>
                            </button>
                    </div>
                </form>
            </div>
        </div>
        
        {{-- Botón de guardar y estado --}}
        <div class="row g-3 mt-2">
            <div class="col-12">
                <div class="d-flex align-items-center justify-content-between p-3" style="background: #f8f9fa; border-radius: 8px;">
                    <div class="d-flex align-items-center gap-2">
                        <span id="saveStatus" class="badge bg-secondary">
                            <i class="bi bi-check-circle"></i> Sin cambios
                        </span>
                        <small class="text-muted" id="lastSaveTime"></small>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-info text-white" onclick="showMenuManager()" title="Gestionar menú de navegación">
                            <i class="bi bi-list-ul"></i> Menú
                        </button>
                        <button type="button" class="btn btn-warning text-white" onclick="showCssEditor()" title="Editor CSS personalizado">
                            <i class="bi bi-code-slash"></i> CSS
                        </button>
                        <button id="saveButton" class="btn btn-primary" onclick="confirmSave()" disabled>
                            <i class="bi bi-save"></i> Guardar Cambios
                        </button>
                        <button type="button" class="btn btn-outline-danger btn-sm" onclick="resetSaveState()" title="Resetear estado de guardado">
                            <i class="bi bi-arrow-clockwise"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal de duplicar vista --}}
    <div id="duplicateModal" class="modal fade" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title">
                        <i class="bi bi-files"></i> Duplicar Vista
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Duplicar la vista actual creará una copia con un nuevo nombre.</p>
                    <div class="mb-3">
                        <label for="duplicateViewName" class="form-label">Nombre de la nueva vista:</label>
                        <input type="text" class="form-control" id="duplicateViewName" placeholder="ej. nueva_pagina" required>
                        <small class="form-text text-muted">Solo letras, números y guiones bajos. Se convertirán a minúsculas automáticamente.</small>
                        <div id="duplicateError" class="text-danger mt-2" style="display: none;"></div>
                    </div>
                    <div class="alert alert-info mb-0">
                        <i class="bi bi-info-circle"></i> 
                        <strong>Vista origen:</strong> <span id="duplicateSourceView">{{ str_replace('webacademia/pages/', '', $currentView) }}</span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" onclick="executeDuplicate()">
                        <i class="bi bi-files"></i> Duplicar Vista
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal de borrar vista --}}
    <div id="deleteViewModal" class="modal fade" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">
                        <i class="bi bi-exclamation-triangle"></i> Borrar vista
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Vas a borrar la vista <strong id="deleteViewName">{{ str_replace('webacademia/pages/', '', $currentView) }}</strong>.</p>
                    <p class="text-danger small mb-0">
                        Esta acción no se puede deshacer. Asegúrate de que la vista no se usa en el menú ni en enlaces externos.
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" onclick="executeDeleteView()">
                        <i class="bi bi-trash"></i> Sí, borrar vista
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal de gestión del menú --}}
    <div id="menuManagerModal" class="modal fade" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title">
                        <i class="bi bi-list-ul"></i> Gestión del Menú de Navegación
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6>Items del Menú</h6>
                                <button type="button" class="btn btn-sm btn-success" onclick="showMenuItemForm()">
                                    <i class="bi bi-plus-circle"></i> Añadir Item
                                </button>
                            </div>
                            <div id="menuItemsList" class="list-group" style="min-height: 300px;">
                                <!-- Los items se cargarán aquí dinámicamente -->
                                <div class="text-center text-muted py-5">
                                    <i class="bi bi-arrow-repeat spin"></i> Cargando...
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div id="menuItemFormContainer" style="display: none;">
                                <h6 id="menuFormTitle">Nuevo Item</h6>
                                <form id="menuItemForm" onsubmit="saveMenuItem(event)">
                                    <input type="hidden" id="menuItemId" name="id">
                                    
                                    <div class="mb-3">
                                        <label for="menuItemLabel" class="form-label">Etiqueta *</label>
                                        <input type="text" class="form-control" id="menuItemLabel" name="label" required>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="menuItemUrl" class="form-label">URL *</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="menuItemUrl" name="url" required>
                                            <button type="button" class="btn btn-outline-secondary" onclick="showPageSelector()" title="Seleccionar página">
                                                <i class="bi bi-folder"></i>
                                            </button>
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="menuItemIcon" class="form-label">Icono (opcional)</label>
                                        <input type="text" class="form-control" id="menuItemIcon" name="icon" placeholder="ej: fas fa-home">
                                        <small class="form-text text-muted">Clase de Font Awesome o Bootstrap Icons</small>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="menuItemTarget" class="form-label">Abrir en</label>
                                        <select class="form-select" id="menuItemTarget" name="target">
                                            <option value="_self">Misma ventana</option>
                                            <option value="_blank">Nueva ventana</option>
                                        </select>
                                    </div>
                                    
                                    <div class="mb-3 form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="menuItemActive" name="active" checked>
                                        <label class="form-check-label" for="menuItemActive">Activo</label>
                                    </div>
                                    
                                    <div class="d-grid gap-2">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="bi bi-save"></i> Guardar
                                        </button>
                                        <button type="button" class="btn btn-secondary" onclick="cancelMenuItemForm()">
                                            Cancelar
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div id="menuItemFormPlaceholder" class="text-center text-muted py-5">
                                <i class="bi bi-info-circle"></i>
                                <p class="mt-2">Selecciona un item para editar o crea uno nuevo</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal selector de páginas --}}
    <div id="pageSelectorModal" class="modal fade" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Seleccionar Página</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="availablePagesList">
                        <div class="text-center text-muted py-3">
                            <i class="bi bi-arrow-repeat spin"></i> Cargando...
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Editor CSS Personalizado --}}
    <div id="cssEditorModal" class="modal fade" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-warning text-dark">
                    <h5 class="modal-title">
                        <i class="bi bi-code-slash"></i> Editor CSS Personalizado
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-info">
                        <i class="bi bi-info-circle"></i> 
                        <strong>Nota:</strong> Este CSS se añadirá además del CSS generado por el editor. 
                        Úsalo para estilos personalizados que no se pueden aplicar desde el editor visual.
                    </div>
                    <div class="mb-3">
                        <label for="customCssEditor" class="form-label">Código CSS Personalizado:</label>
                        <textarea id="customCssEditor" class="form-control" rows="15" placeholder="/* Inserta tu CSS personalizado aquí */"></textarea>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <small class="text-muted">
                            <i class="bi bi-lightbulb"></i> 
                            Tip: Usa selectores específicos para evitar conflictos con los estilos del editor.
                        </small>
                        <button type="button" class="btn btn-sm btn-outline-secondary" onclick="clearCustomCss()">
                            <i class="bi bi-trash"></i> Limpiar
                        </button>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="saveCustomCss()">
                        <i class="bi bi-save"></i> Guardar CSS
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Editor de Atributos (como código JSON) --}}
    <div id="attributesCodeModal" class="modal fade" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-secondary text-white">
                    <h5 class="modal-title">
                        <i class="bi bi-code"></i> Atributos del elemento
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-info">
                        <i class="bi bi-info-circle"></i>
                        Edita los atributos del elemento en formato JSON. Solo modifica esto si sabes lo que haces.
                    </div>
                    <textarea id="attributesCodeTextarea" class="form-control" rows="14" style="font-family: monospace;"></textarea>
                    <small class="text-muted d-block mt-2">
                        Ejemplo: { "href": "#", "title": "Mi enlace" }
                    </small>
                    <div id="attributesCodeError" class="text-danger mt-2" style="display:none;"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" onclick="saveAttributesFromModal()">
                        <i class="bi bi-save"></i> Guardar atributos
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal de confirmación --}}
    <div id="saveConfirmModal" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">
                        <i class="bi bi-exclamation-triangle-fill"></i> Confirmar Guardado
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>¿Estás seguro de que deseas guardar los cambios en esta vista?</p>
                    <p class="text-muted small mb-0">
                        <strong>Vista actual:</strong> <span id="modalViewName">{{ str_replace('webacademia/pages/', '', $currentView) }}</span>
                    </p>
                    <div class="alert alert-warning mt-3 mb-0">
                        <i class="bi bi-info-circle"></i> Los cambios se aplicarán inmediatamente a la web.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" onclick="executeSave()">
                        <i class="bi bi-save"></i> Sí, Guardar Cambios
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div id="gjs">{!! $html !!}</div>

    <script src="https://unpkg.com/grapesjs"></script>
    <script src="https://unpkg.com/grapesjs-blocks-basic"></script>
    <script src="https://unpkg.com/grapesjs-preset-webpage"></script>
    <script src="https://unpkg.com/grapesjs-tabs"></script>
    <script src="{{ asset('js/builder-custom-blocks.js') }}"></script>
    <script>
    let editor;
    
    // Función para limpiar HTML antes de que GrapesJS lo procese
    function cleanHtmlForGrapesJS(html) {
        // Limpiar atributos SVG problemáticos en URLs de data:image/svg
        // Esto previene el error InvalidCharacterError con atributos mal formados
        html = html.replace(/background:\s*url\(['"]?data:image\/svg\+xml[^'"]*['"]?\)/gi, '');
        
        // Crear un elemento temporal para parsear el HTML
        const temp = document.createElement('div');
        temp.innerHTML = html;
        
        // Remover atributos data-wow-* que pueden causar problemas
        const allElements = temp.querySelectorAll('*');
        allElements.forEach(el => {
            // Remover todos los atributos data-wow-*
            Array.from(el.attributes).forEach(attr => {
                if (attr.name.startsWith('data-wow-')) {
                    el.removeAttribute(attr.name);
                }
                // Remover atributos con nombres numéricos (como "0")
                if (/^\d+$/.test(attr.name)) {
                    el.removeAttribute(attr.name);
                }
                // Remover atributos con nombres inválidos que contengan comillas escapadas
                if (attr.name.includes('svg"') || attr.name.includes('svg\\"')) {
                    el.removeAttribute(attr.name);
                }
            });
        });
        
        return temp.innerHTML;
    }
    
    // Esperar a que el DOM esté completamente cargado
    document.addEventListener('DOMContentLoaded', function() {
        try {
            // Verificar que el contenedor existe
            const container = document.getElementById('gjs');
            if (!container) {
                console.error('Contenedor #gjs no encontrado');
                return;
            }
            
            // Limpiar el HTML antes de que GrapesJS lo procese
            const originalHtml = container.innerHTML;
            container.innerHTML = cleanHtmlForGrapesJS(originalHtml);
            
            editor = grapesjs.init({
                container: '#gjs',
                fromElement: true,
                autoload: false, // Desactivar autoload para evitar conflictos
                plugins: [
                    'gjs-blocks-basic',
                    'grapesjs-preset-webpage',
                    'grapesjs-tabs',
                    'custom-blocks'
                ],
                pluginsOpts: {
                    'gjs-blocks-basic': {},
                    'grapesjs-preset-webpage': {},
                    'grapesjs-tabs': {},
                    'custom-blocks': {}
                },
        assetManager: {
            upload: '/builder/upload', // Tu ruta Laravel para POST
            uploadName: 'file',
            autoAdd: true,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
            custom: false,
            modalTitle: 'Gestor de medios',
        },
        storageManager: {
            type: 'laravel',
            autoload: false, // Desactivado porque usamos fromElement: true
            autosave: false, // Desactivado - se guarda manualmente
            stepsBeforeSave: 999, // Número alto para evitar autoguardado
        },
        canvas: {
            styles: [
                '{{ asset("assets/bootstrap/css/bootstrap.min.css") }}',
                'https://fonts.googleapis.com/css?family=Mulish:300,400,500,600,700,800&display=swap',
                'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css',
                '{{ asset("assets/fonts/font-awesome.min.css") }}',
                '{{ asset("assets/fonts/themify-icons.css") }}',
                '{{ asset("assets/owlcarousel/css/owl.carousel.css") }}',
                '{{ asset("assets/owlcarousel/css/owl.theme.css") }}',
                '{{ asset("assets/css/slicknav.css") }}',
                '{{ asset("assets/css/magnific-popup.css") }}',
                '{{ asset("assets/css/animate.css") }}',
                '{{ asset("assets/css/style.css") }}'
            ],
        },
        i18n: {
            locale: 'es',
            messages: {
                es: {
                    'styleManager.properties.width': 'Ancho',
                    'styleManager.properties.height': 'Alto',
                    'styleManager.properties.margin': 'Margen',
                    'styleManager.properties.padding': 'Relleno',
                    'styleManager.properties.background-color': 'Color de fondo',
                    'styleManager.properties.color': 'Color del texto',
                    'styleManager.properties.display': 'Visualización',
                    'styleManager.properties.flex-direction': 'Dirección Flex',
                    'styleManager.properties.justify-content': 'Justificar contenido',
                    'styleManager.properties.align-items': 'Alinear elementos',
                    'styleManager.properties.object-fit': 'Ajuste de objeto',
                    'styleManager.properties.object-position': 'Posición de objeto',
                    'styleManager.properties.background-size': 'Tamaño de fondo',
                    'assetManager.modalTitle': 'Selecciona una imagen',
                    'blocks.categories.basic': 'Elementos básicos',
                    'blocks.categories.layout': 'Diseño',
                    'blocks.categories.Preestilizados': 'Preestilizados',
                    'deviceManager.device.desktop': 'Escritorio',
                    'deviceManager.device.tablet': 'Tablet',
                    'deviceManager.device.mobile': 'Móvil',
                    'traitManager.empty': 'Selecciona un elemento para editar',
                    'selectors.label': 'Clases',
                    'blocks.label': 'Bloques',
                    'styleManager.label': 'Estilo',
                    'traitManager.label': 'Atributos',
                    'layers.label': 'Capas',
                }
            }
        }
    });
    
    // Función para añadir CSS al canvas de GrapesJS
    function addCssToCanvas(cssText) {
        if (!cssText || !editor) return;
        
        // Si el CSS contiene "CSS generado por el editor", extraer solo el CSS del editor
        // para añadirlo a GrapesJS, y el resto (CSS personalizado) inyectarlo directamente
        if (cssText.includes('CSS generado por el editor')) {
            // Extraer el CSS del editor (entre "CSS generado por el editor" y "CSS Personalizado")
            const editorMatch = cssText.match(/\/\*\s*CSS generado por el editor\s*\*\/(.*?)(?:\/\*\s*CSS Personalizado|$)/s);
            if (editorMatch && editorMatch[1]) {
                const editorCss = editorMatch[1].trim();
                // Añadir el CSS del editor a GrapesJS (para que se guarde)
                editor.Css.add(editorCss);
                console.log('CSS del editor añadido a GrapesJS:', editorCss.length, 'caracteres');
            }
            
            // Extraer el CSS personalizado si existe
            const customMatch = cssText.match(/\/\*\s*CSS Personalizado\s*\*\/(.*?)$/s);
            if (customMatch && customMatch[1]) {
                const customCssOnly = customMatch[1].trim();
                // El CSS personalizado se maneja por separado
                console.log('CSS personalizado detectado:', customCssOnly.length, 'caracteres');
            }
        } else {
            // Es CSS original o personalizado, añadirlo directamente a GrapesJS
            editor.Css.add(cssText);
            console.log('CSS añadido a GrapesJS:', cssText.length, 'caracteres');
        }
        
        // Añadir TODO el CSS directamente al canvas iframe para que se renderice
        const canvas = editor.Canvas;
        const canvasDoc = canvas.getDocument();
        const canvasHead = canvasDoc.head;
        
        // Verificar si ya existe un style tag para CSS completo
        let styleTag = canvasHead.querySelector('style[data-full-css]');
        if (!styleTag) {
            styleTag = canvasDoc.createElement('style');
            styleTag.setAttribute('data-full-css', 'true');
            canvasHead.appendChild(styleTag);
        }
        
        // Añadir TODO el CSS al style tag para que se renderice
        styleTag.textContent = cssText;
        
        console.log('CSS completo inyectado en el canvas:', cssText.substring(0, 50) + '...');
    }
    
    // Función para encontrar la imagen dentro de un contenedor
    function findImageInComponent(component) {
        if (!component) return null;
        
        // Si el componente es una imagen, devolverlo
        if (component.get('type') === 'image' || component.get('tagName') === 'img') {
            return component;
        }
        
        // Buscar imagen dentro del componente
        const components = component.components();
        if (components && components.length > 0) {
            for (let i = 0; i < components.length; i++) {
                const child = components.at(i);
                if (child.get('type') === 'image' || child.get('tagName') === 'img') {
                    return child;
                }
                // Buscar recursivamente
                const nestedImg = findImageInComponent(child);
                if (nestedImg) return nestedImg;
            }
        }
        
        return null;
    }
    
    // Asegurar que los estilos de los bloques personalizados se añadan
    editor.on('load', () => {
        // Los estilos ya se añaden automáticamente por el plugin
        console.log('Editor cargado con bloques personalizados');
        
        // Añadir propiedades personalizadas al Style Manager
        const styleManager = editor.StyleManager;
        const sector = styleManager.getSector('dimension');
        
        if (sector) {
            // Añadir object-fit después de height
            const objectFitProp = sector.addProperty({
                name: 'object-fit',
                property: 'object-fit',
                type: 'select',
                defaults: 'fill',
                options: [
                    { value: 'fill', name: 'Fill' },
                    { value: 'contain', name: 'Contain' },
                    { value: 'cover', name: 'Cover' },
                    { value: 'none', name: 'None' },
                    { value: 'scale-down', name: 'Scale Down' }
                ],
                changeProp: 1,
            }, { at: sector.getProperties().length });
            
            // Listener para cuando se cambia object-fit
            objectFitProp.on('change', function() {
                setTimeout(() => {
                    const component = editor.getSelected();
                    if (!component) return;
                    
                    // Buscar imagen dentro del componente si es un contenedor
                    const imgComponent = findImageInComponent(component);
                    const targetComponent = imgComponent || component;
                    
                    // Solo aplicar a elementos img
                    if (targetComponent && (targetComponent.get('type') === 'image' || targetComponent.get('tagName') === 'img')) {
                        const objectFit = targetComponent.getStyle('object-fit');
                        if (objectFit === 'cover') {
                            // Asegurar que tiene width y height para que cover funcione
                            const currentWidth = targetComponent.getStyle('width');
                            const currentHeight = targetComponent.getStyle('height');
                            
                            if (!currentWidth || currentWidth === 'auto') {
                                targetComponent.addStyle({ width: '100%' });
                            }
                            if (!currentHeight || currentHeight === 'auto') {
                                targetComponent.addStyle({ height: '100%' });
                            }
                            
                            // Forzar actualización del componente
                            targetComponent.view.render();
                        }
                    } else if (component && component.get('tagName') === 'div' && component.get('classes') && component.get('classes').includes('ab_img')) {
                        // Si es el div contenedor, seleccionar la imagen dentro
                        const imgComponent = findImageInComponent(component);
                        if (imgComponent) {
                            editor.select(imgComponent);
                            // Aplicar object-fit: cover a la imagen
                            imgComponent.addStyle({ 
                                'object-fit': 'cover',
                                'width': '100%',
                                'height': '100%'
                            });
                            imgComponent.view.render();
                        }
                    }
                }, 100);
            });
            
            // Añadir object-position después de object-fit
            sector.addProperty({
                name: 'object-position',
                property: 'object-position',
                type: 'select',
                defaults: 'center',
                options: [
                    { value: 'center', name: 'Centro' },
                    { value: 'top', name: 'Arriba' },
                    { value: 'bottom', name: 'Abajo' },
                    { value: 'left', name: 'Izquierda' },
                    { value: 'right', name: 'Derecha' },
                    { value: 'top left', name: 'Arriba Izquierda' },
                    { value: 'top right', name: 'Arriba Derecha' },
                    { value: 'bottom left', name: 'Abajo Izquierda' },
                    { value: 'bottom right', name: 'Abajo Derecha' },
                    { value: '50% 50%', name: '50% 50%' }
                ],
                changeProp: 1,
            }, { at: sector.getProperties().length });
        }
        
        // También añadir a la sección de decoraciones como alternativa
        const decorSector = styleManager.getSector('decorations');
        if (decorSector) {
            // Añadir background-size para imágenes de fondo
            decorSector.addProperty({
                name: 'background-size',
                property: 'background-size',
                type: 'select',
                defaults: 'auto',
                options: [
                    { value: 'auto', name: 'Auto' },
                    { value: 'cover', name: 'Cover' },
                    { value: 'contain', name: 'Contain' },
                    { value: '100% 100%', name: '100% 100%' }
                ],
                changeProp: 1,
            }, { at: decorSector.getProperties().length });
        }

        // ================================
        // Panel de PRESETS DE ESTILO
        // ================================
        const stylePresets = [
            { id: 'preset-btn-primary', label: 'Botón primario', className: 'btn-primary-custom' },
            { id: 'preset-btn-secondary', label: 'Botón secundario', className: 'btn-secondary-custom' },
            { id: 'preset-card-modern', label: 'Card moderna', className: 'modern-card' },
            { id: 'preset-section-gradient', label: 'Sección degradada', className: 'gradient-section' },
        ];

        editor.Commands.add('open-style-presets', {
            run(ed) {
                const modal = ed.Modal;

                const wrapper = document.createElement('div');
                wrapper.style.padding = '10px';

                const info = document.createElement('p');
                info.textContent = 'Selecciona un elemento en el lienzo y luego aplica uno de los presets de estilo:';
                info.style.fontSize = '13px';
                info.style.marginBottom = '10px';
                wrapper.appendChild(info);

                const grid = document.createElement('div');
                grid.style.display = 'grid';
                grid.style.gridTemplateColumns = 'repeat(auto-fit, minmax(120px, 1fr))';
                grid.style.gap = '8px';

                stylePresets.forEach(preset => {
                    const btn = document.createElement('button');
                    btn.type = 'button';
                    btn.textContent = preset.label;
                    btn.dataset.presetClass = preset.className;
                    btn.style.border = '1px solid #e5e7eb';
                    btn.style.borderRadius = '6px';
                    btn.style.padding = '8px 10px';
                    btn.style.fontSize = '12px';
                    btn.style.cursor = 'pointer';
                    btn.style.background = '#f9fafb';
                    btn.style.textAlign = 'left';
                    btn.style.transition = 'background 0.15s ease';
                    btn.onmouseenter = () => btn.style.background = '#eef2ff';
                    btn.onmouseleave = () => btn.style.background = '#f9fafb';
                    grid.appendChild(btn);
                });

                wrapper.appendChild(grid);

                const status = document.createElement('div');
                status.style.marginTop = '10px';
                status.style.fontSize = '12px';
                status.style.color = '#6b7280';
                wrapper.appendChild(status);

                wrapper.querySelectorAll('[data-preset-class]').forEach(btn => {
                    btn.addEventListener('click', () => {
                        const selected = ed.getSelected();
                        if (!selected) {
                            status.textContent = 'Selecciona primero un elemento en el lienzo.';
                            status.style.color = '#dc2626';
                            return;
                        }

                        const cls = btn.dataset.presetClass;
                        if (!cls) return;

                        // Añadir la clase de preset y dejar que el usuario gestione otras clases desde el panel de selectores
                        selected.addClass(cls);
                        status.textContent = `Preset "${btn.textContent}" aplicado.`;
                        status.style.color = '#16a34a';
                    });
                });

                modal.setTitle('Presets de estilo');
                modal.setContent(wrapper);
                modal.open();
            },
        });

        // Botón en la barra de opciones para abrir los presets
        editor.Panels.addButton('options', {
            id: 'open-style-presets',
            className: 'fa fa-magic',
            command: 'open-style-presets',
            attributes: { title: 'Presets de estilo' },
        });

        // ================================
        // Estilos por defecto en bloques básicos
        // ================================
        editor.on('component:add', comp => {
            const tag = (comp.get('tagName') || '').toLowerCase();
            const type = comp.get('type');

            // Botones básicos → estilo primario por defecto
            if (tag === 'button' || (tag === 'a' && (comp.getAttributes() || {}).role === 'button')) {
                if (!comp.getClasses().includes('btn-primary-custom')) {
                    comp.addClass('btn-primary-custom');
                }
            }

            // Tarjetas/div contenedor con intención de card → estilo de card moderna
            if (tag === 'div' && type === 'default') {
                const classes = comp.getClasses() || [];
                if (classes.includes('card') && !classes.includes('modern-card')) {
                    comp.addClass('modern-card');
                }
            }

            // Secciones vacías → sección degradada por defecto
            if (tag === 'section' && comp.components().length === 0) {
                if (!comp.getClasses().includes('gradient-section')) {
                    comp.addClass('gradient-section');
                }
            }
        });

        // ================================
        // Editor de atributos como JSON (modal)
        // ================================
        editor.Commands.add('open-attributes-code-modal', {
            run(ed) {
                const selected = ed.getSelected();
                if (!selected) {
                    showNotification('Selecciona primero un elemento para ver sus atributos.', 'info');
                    return;
                }
                currentAttributesComponent = selected;
                const attrs = selected.getAttributes() || {};
                const textarea = document.getElementById('attributesCodeTextarea');
                const errorDiv = document.getElementById('attributesCodeError');
                if (textarea) {
                    textarea.value = JSON.stringify(attrs, null, 2);
                }
                if (errorDiv) {
                    errorDiv.style.display = 'none';
                    errorDiv.textContent = '';
                }
                if (attributesCodeModal) {
                    attributesCodeModal.show();
                }
            },
        });

        editor.Panels.addButton('options', {
            id: 'open-attributes-code-modal',
            className: 'fa fa-code',
            command: 'open-attributes-code-modal',
            attributes: { title: 'Editar atributos como código (JSON)' },
        });

        // ================================
        // Duplicar bloque sin solaparlo
        // ================================
        editor.Commands.add('clone-clean', {
            run(ed) {
                const selected = ed.getSelected();
                if (!selected) {
                    return;
                }

                const parent = selected.parent();
                if (!parent) {
                    return;
                }

                const collection = parent.components();
                const index = collection.indexOf(selected);
                const clone = selected.clone();

                // Quitar estilos de posicionamiento absoluto que provocan solapamientos
                const styleToClean = ['position', 'top', 'left', 'right', 'bottom'];
                const currentStyle = clone.getStyle() || {};
                styleToClean.forEach(prop => {
                    if (prop in currentStyle) {
                        delete currentStyle[prop];
                    }
                });
                clone.setStyle(currentStyle);

                // Insertar el clon justo después del bloque original
                collection.add(clone, { at: index + 1 });
                ed.select(clone);
            },
        });

        // Botón global para duplicar el bloque seleccionado usando el comando anterior
        editor.Panels.addButton('options', {
            id: 'clone-clean',
            className: 'fa fa-clone',
            command: 'clone-clean',
            attributes: { title: 'Duplicar bloque (sin solapar)' },
        });
        
        // Añadir CSS inicial del archivo si existe
        @if(!empty($initialCss))
            const initialCss = @json($initialCss);
            if (initialCss) {
                // Si el CSS contiene "CSS generado por el editor", extraer solo el CSS personalizado
                // para el editor de CSS, pero inyectar TODO el CSS en el canvas
                if (initialCss.includes('CSS generado por el editor')) {
                    // Extraer solo el CSS personalizado para el editor
                    const customMatch = initialCss.match(/\/\*\s*CSS Personalizado\s*\*\/(.*?)$/s);
                    if (customMatch && customMatch[1]) {
                        customCss = customMatch[1].trim();
                        console.log('CSS personalizado extraído:', customCss.length, 'caracteres');
                    }
                    
                    // Inyectar TODO el CSS (del editor + personalizado) en el canvas
                    addCssToCanvas(initialCss);
                    console.log('CSS completo cargado desde el archivo:', initialCss.length, 'caracteres');
                } else {
                    // Es CSS original, usarlo como CSS personalizado
                    addCssToCanvas(initialCss);
                    customCss = initialCss;
                    console.log('CSS inicial cargado desde el archivo:', initialCss.length, 'caracteres');
                }
            }
        @endif
        
        // Cargar CSS personalizado si existe (desde el método load)
        let view = '{{ str_replace("webacademia/pages/", "", $currentView) }}';
        fetch(`/builder/load?view=${encodeURIComponent(view)}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error al cargar la vista');
                }
                return response.json();
            })
            .then(data => {
                if (data && data.custom_css) {
                    // Solo actualizar si no hay CSS inicial ya cargado
                    if (!customCss) {
                        customCss = data.custom_css;
                        if (data.custom_css) {
                            addCssToCanvas(data.custom_css);
                        }
                    }
                }
            })
            .catch(error => {
                console.error('Error al cargar CSS personalizado:', error);
            });
    });
    
    // También añadir CSS cuando el canvas se renderiza
    editor.on('canvas:frame:load', () => {
        @if(!empty($initialCss))
            const initialCss = @json($initialCss);
            if (initialCss && customCss === initialCss) {
                addCssToCanvas(initialCss);
            }
        @endif
    });

    // Listener para cuando se actualiza el estilo de un componente
    editor.on('component:styleUpdate', (component) => {
        // Buscar imagen dentro del componente si es un contenedor
        const imgComponent = findImageInComponent(component);
        const targetComponent = imgComponent || component;
        
        // Aplicar object-fit: cover automáticamente si la imagen tiene width y height
        if (targetComponent && (targetComponent.get('type') === 'image' || targetComponent.get('tagName') === 'img')) {
            const objectFit = targetComponent.getStyle('object-fit');
            if (objectFit === 'cover') {
                const width = targetComponent.getStyle('width');
                const height = targetComponent.getStyle('height');
                
                // Si tiene object-fit: cover pero no tiene dimensiones, añadirlas
                if (!width || width === 'auto') {
                    targetComponent.addStyle({ width: '100%' });
                }
                if (!height || height === 'auto') {
                    targetComponent.addStyle({ height: '100%' });
                }
                targetComponent.view.render();
            }
        }
    });
    
    // Listener para cuando se selecciona un componente
    editor.on('component:selected', (component) => {
        // Si se selecciona un div con clase ab_img, mostrar ayuda para seleccionar la imagen
        if (component && component.get('tagName') === 'div') {
            const classes = component.get('classes');
            if (classes && (classes.includes('ab_img') || classes.includes('img-fluid'))) {
                // Buscar imagen dentro
                const imgComponent = findImageInComponent(component);
                if (imgComponent) {
                    console.log('Imagen encontrada dentro del contenedor. Usa doble clic o navega en Layers para seleccionarla directamente.');
                }
            }
        }
        
        if (component && (component.get('type') === 'video' || component.get('type') === 'image')) {
            const assetManager = editor.AssetManager;

            assetManager.open({
                select: (asset) => {
                    const src = asset.get('src');

                    // Establece el atributo src en el componente seleccionado
                    component.setAttributes({ src: src });

                    // Actualiza también el trait "src" para que quede sincronizado
                    const traits = component.get('traits');
                    if (traits && traits.length) {
                        const srcTrait = traits.find(tr => tr.get('name') === 'src');
                        if (srcTrait) {
                            srcTrait.set('value', src);
                        }
                    }

                    component.view && component.view.render(); // fuerza render

                    assetManager.close();
                }
            });
        }
    });
    // REGISTRO DEL STORAGE PERSONALIZADO
    editor.StorageManager.add('laravel', {
        async load(options) {
            // No cargar nada porque usamos fromElement: true
            // El contenido ya está en el DOM
            // Retornar null para indicar que no hay datos que cargar
            return null;
        },
        async store(data, options) {
            const view = '{{ urlencode($currentView) }}';
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const html = editor.getHtml();
            const css = editor.getCss();
            
            // Combinar CSS del editor con CSS personalizado
            const finalCss = customCss ? `${css}\n\n/* CSS Personalizado */\n${customCss}` : css;
            
            const res = await fetch(`/builder/save?view=${encodeURIComponent(view)}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token,
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({
                    html: html,
                    css: css,
                    custom_css: customCss
                }),
            });
            
            if (!res.ok) {
                throw new Error('Error al guardar');
            }
            
            return await res.json();
        }
    });
        } catch (error) {
            console.error('Error al inicializar GrapesJS:', error);
            const container = document.getElementById('gjs');
            if (container) {
                container.innerHTML = '<div style="padding: 20px; color: red; background: #fff; border-radius: 8px; margin: 20px;"><h3>Error al cargar el editor</h3><p>' + error.message + '</p><p>Por favor, recarga la página.</p></div>';
            }
        }
    }); // Cierre del DOMContentLoaded
    </script>
<script>
    const toggle = document.getElementById('builderToggle');
    const panel = document.getElementById('builderPanel');

    toggle.addEventListener('click', () => {
        const isOpen = panel.classList.contains('show');

        if (isOpen) {
            panel.classList.remove('show');
            setTimeout(() => panel.style.display = 'none', 300); // esperar a que acabe la animación
        } else {
            panel.style.display = 'block';
            setTimeout(() => panel.classList.add('show'), 10); // pequeña pausa para activar transición
        }

        const icon = document.getElementById('arrowIcon');
        icon.classList.remove('bi-chevron-down', 'bi-chevron-up');
        icon.classList.add(isOpen ? 'bi-chevron-down' : 'bi-chevron-up');

        if (!isOpen) {
            toggle.style.borderBottomLeftRadius = '0';
            toggle.style.borderBottomRightRadius = '0';
            toggle.style.borderTopLeftRadius = '20px';
            toggle.style.borderTopRightRadius = '20px';
        } else {
            toggle.style.borderTopLeftRadius = '0';
            toggle.style.borderTopRightRadius = '0';
            toggle.style.borderBottomLeftRadius = '20px';
            toggle.style.borderBottomRightRadius = '20px';
        }
    });

// ============================================
// SISTEMA DE GUARDADO MANUAL Y CONFIRMACIÓN
// ============================================

let hasUnsavedChanges = false;
let saveModal = null;

// Inicializar modal de Bootstrap cuando esté disponible
setTimeout(function() {
    const modalElement = document.getElementById('saveConfirmModal');
    if (modalElement) {
        saveModal = new bootstrap.Modal(modalElement);
    }
    
    // Detectar cambios en el editor
    if (typeof editor !== 'undefined') {
        editor.on('update', function() {
            markAsChanged();
        });
        
        editor.on('component:add', function() {
            markAsChanged();
        });
        
        editor.on('component:remove', function() {
            markAsChanged();
        });
        
        editor.on('component:update', function() {
            markAsChanged();
        });
        
        editor.on('style:custom', function() {
            markAsChanged();
        });
    }
}, 500);

function markAsChanged() {
    hasUnsavedChanges = true;
    const saveButton = document.getElementById('saveButton');
    const saveStatus = document.getElementById('saveStatus');
    
    if (saveButton) {
        saveButton.disabled = false;
        saveButton.classList.remove('btn-primary');
        saveButton.classList.add('btn-warning');
    }
    
    if (saveStatus) {
        saveStatus.className = 'badge bg-warning';
        saveStatus.innerHTML = '<i class="bi bi-exclamation-circle"></i> Cambios sin guardar';
    }
}

function markAsSaved() {
    hasUnsavedChanges = false;
    const saveButton = document.getElementById('saveButton');
    const saveStatus = document.getElementById('saveStatus');
    const lastSaveTime = document.getElementById('lastSaveTime');
    
    if (saveButton) {
        // Restaurar el texto original del botón
        saveButton.innerHTML = '<i class="bi bi-save"></i> Guardar Cambios';
        saveButton.disabled = false; // Habilitar el botón para futuros cambios
        saveButton.classList.remove('btn-warning');
        saveButton.classList.add('btn-primary');
    }
    
    if (saveStatus) {
        saveStatus.className = 'badge bg-success';
        saveStatus.innerHTML = '<i class="bi bi-check-circle"></i> Guardado';
    }
    
    if (lastSaveTime) {
        const now = new Date();
        lastSaveTime.textContent = `Último guardado: ${now.toLocaleTimeString('es-ES')}`;
    }
    
    // Resetear después de 3 segundos
    setTimeout(() => {
        if (saveStatus) {
            saveStatus.className = 'badge bg-secondary';
            saveStatus.innerHTML = '<i class="bi bi-check-circle"></i> Sin cambios';
        }
    }, 3000);
}

function confirmSave() {
    if (!hasUnsavedChanges) {
        return;
    }
    
    // Mostrar modal de confirmación
    if (saveModal) {
        saveModal.show();
    } else {
        // Si el modal no está inicializado, inicializarlo
        const modalElement = document.getElementById('saveConfirmModal');
        if (modalElement) {
            saveModal = new bootstrap.Modal(modalElement);
            saveModal.show();
        }
    }
}

function executeSave() {
    if (typeof editor === 'undefined' || !editor) {
        alert('Error: El editor no está disponible');
        // Cerrar modal si está abierto
        if (saveModal) {
            saveModal.hide();
        }
        return;
    }
    
    const saveButton = document.getElementById('saveButton');
    if (!saveButton) {
        console.error('Botón de guardar no encontrado');
        return;
    }
    
    const originalText = saveButton.innerHTML;
    
    // Deshabilitar botón y mostrar loading
    saveButton.disabled = true;
    saveButton.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Guardando...';
    
    // Cerrar modal inmediatamente
    if (saveModal) {
        saveModal.hide();
    }
    
    // Extraer solo el nombre del archivo de la vista actual
    let view = '{{ str_replace("webacademia/pages/", "", $currentView) }}';
    const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    
    if (!token) {
        console.error('Token CSRF no encontrado');
        saveButton.disabled = false;
        saveButton.innerHTML = originalText;
        alert('Error: Token de seguridad no encontrado. Por favor, recarga la página.');
        return;
    }
    
    const html = editor.getHtml();
    const css = editor.getCss();
    
    // Combinar CSS del editor con CSS personalizado
    const finalCss = customCss ? `${css}\n\n/* CSS Personalizado */\n${customCss}` : css;
    
    // Crear un AbortController para timeout
    const controller = new AbortController();
    const timeoutId = setTimeout(() => controller.abort(), 30000); // 30 segundos timeout
    
    // Codificar solo una vez
    fetch(`/builder/save?view=${encodeURIComponent(view)}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token,
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: JSON.stringify({
            html: html,
            css: finalCss,
            custom_css: customCss
        }),
        signal: controller.signal
    })
    .then(response => {
        clearTimeout(timeoutId);
        
        // Log para debugging
        console.log('Respuesta del servidor:', response.status, response.statusText);
        
        if (!response.ok) {
            return response.json().then(data => {
                console.error('Error del servidor:', data);
                throw new Error(data.error || `Error HTTP: ${response.status}`);
            });
        }
        return response.json();
    })
    .then(data => {
        console.log('Datos recibidos del servidor:', data);
        
        if (data && (data.status === 'ok' || (data.error === undefined && data.status !== 'error'))) {
            // Éxito - restaurar botón inmediatamente
            const saveButton = document.getElementById('saveButton');
            if (saveButton) {
                saveButton.disabled = false;
                saveButton.innerHTML = '<i class="bi bi-save"></i> Guardar Cambios';
                saveButton.classList.remove('btn-warning');
                saveButton.classList.add('btn-primary');
            }
            
            // Marcar como guardado
            markAsSaved();
            
            // Mostrar notificación de éxito
            showNotification('Cambios guardados correctamente', 'success');
            
            console.log('Guardado completado exitosamente');
        } else {
            // Error en la respuesta
            console.error('Error en la respuesta:', data);
            throw new Error(data.error || 'Error desconocido');
        }
    })
    .catch(error => {
        clearTimeout(timeoutId);
        console.error('Error al guardar:', error);
        
        let errorMessage = 'Error al guardar los cambios. ';
        if (error.name === 'AbortError') {
            errorMessage += 'La operación tardó demasiado. Por favor, verifica tu conexión e inténtalo de nuevo.';
        } else {
            errorMessage += error.message || 'Por favor, inténtalo de nuevo.';
        }
        
        alert(errorMessage);
        saveButton.disabled = false;
        saveButton.innerHTML = originalText;
        markAsChanged(); // Volver a marcar como con cambios
    });
}

function resetSaveState() {
    const saveButton = document.getElementById('saveButton');
    if (saveButton) {
        saveButton.disabled = false;
        saveButton.innerHTML = '<i class="bi bi-save"></i> Guardar Cambios';
        saveButton.classList.remove('btn-warning');
        saveButton.classList.add('btn-primary');
    }
    
    const saveStatus = document.getElementById('saveStatus');
    if (saveStatus) {
        saveStatus.className = 'badge bg-secondary';
        saveStatus.innerHTML = '<i class="bi bi-check-circle"></i> Sin cambios';
    }
    
    // Cerrar modal si está abierto
    if (saveModal) {
        saveModal.hide();
    }
    
    hasUnsavedChanges = true;
    markAsChanged();
    console.log('Estado de guardado reseteado');
}

function showNotification(message, type = 'info') {
    // Crear notificación temporal
    const notification = document.createElement('div');
    notification.className = `alert alert-${type === 'success' ? 'success' : 'info'} alert-dismissible fade show`;
    notification.style.cssText = 'position: fixed; top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
    notification.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    `;
    document.body.appendChild(notification);
    
    // Auto-remover después de 3 segundos
    setTimeout(() => {
        notification.remove();
    }, 3000);
}

// Advertencia al salir si hay cambios sin guardar
window.addEventListener('beforeunload', function(e) {
    if (hasUnsavedChanges) {
        e.preventDefault();
        e.returnValue = 'Tienes cambios sin guardar. ¿Estás seguro de que deseas salir?';
        return e.returnValue;
    }
});

// ============================================
// SISTEMA DE DUPLICAR VISTAS
// ============================================

let duplicateModal = null;
let deleteViewModal = null;

// Inicializar modal de duplicar
setTimeout(function() {
    const modalElement = document.getElementById('duplicateModal');
    if (modalElement) {
        duplicateModal = new bootstrap.Modal(modalElement);
    }
    const deleteModalElement = document.getElementById('deleteViewModal');
    if (deleteModalElement) {
        deleteViewModal = new bootstrap.Modal(deleteModalElement);
    }
}, 500);

function showDuplicateModal() {
    const modalElement = document.getElementById('duplicateModal');
    if (!duplicateModal && modalElement) {
        duplicateModal = new bootstrap.Modal(modalElement);
    }
    
    // Limpiar campos
    document.getElementById('duplicateViewName').value = '';
    document.getElementById('duplicateError').style.display = 'none';
    document.getElementById('duplicateError').textContent = '';
    
    // Mostrar modal
    if (duplicateModal) {
        duplicateModal.show();
    }
}

function showDeleteViewModal() {
    const modalElement = document.getElementById('deleteViewModal');
    if (!deleteViewModal && modalElement) {
        deleteViewModal = new bootstrap.Modal(modalElement);
    }
    const nameSpan = document.getElementById('deleteViewName');
    if (nameSpan) {
        nameSpan.textContent = '{{ str_replace('webacademia/pages/', '', $currentView) }}';
    }
    if (deleteViewModal) {
        deleteViewModal.show();
    }
}

function executeDeleteView() {
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const view = '{{ str_replace('webacademia/pages/', '', $currentView) }}';

    if (!view) {
        alert('Vista no válida');
        return;
    }

    fetch('/builder/delete', {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token,
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: JSON.stringify({ view: view })
    })
    .then(res => res.json())
    .then(data => {
        if (data.status === 'ok') {
            showNotification('Vista borrada correctamente', 'success');
            if (deleteViewModal) {
                deleteViewModal.hide();
            }
            // Redirigir a la home del builder
            window.location.href = '/builder';
        } else {
            alert(data.error || 'Error al borrar la vista');
        }
    })
    .catch(err => {
        console.error(err);
        alert('Error al borrar la vista');
    });
}

function executeDuplicate() {
    const newViewName = document.getElementById('duplicateViewName').value.trim();
    const errorDiv = document.getElementById('duplicateError');
    const sourceView = '{{ str_replace("webacademia/pages/", "", $currentView) }}';
    
    // Validar nombre
    if (!newViewName) {
        errorDiv.textContent = 'Por favor, ingresa un nombre para la nueva vista.';
        errorDiv.style.display = 'block';
        return;
    }
    
    // Validar formato (solo letras, números y guiones bajos)
    if (!/^[a-zA-Z0-9_]+$/.test(newViewName)) {
        errorDiv.textContent = 'El nombre solo puede contener letras, números y guiones bajos.';
        errorDiv.style.display = 'block';
        return;
    }
    
    // Ocultar error
    errorDiv.style.display = 'none';
    
    // Deshabilitar botón y mostrar loading
    const duplicateButton = event.target;
    const originalText = duplicateButton.innerHTML;
    duplicateButton.disabled = true;
    duplicateButton.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Duplicando...';
    
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
    fetch('/builder/duplicate', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token,
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: JSON.stringify({
            source_view: sourceView,
            new_view_name: newViewName
        }),
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'ok') {
            // Éxito
            showNotification('Vista duplicada correctamente', 'success');
            
            // Cerrar modal
            if (duplicateModal) {
                duplicateModal.hide();
            }
            
            // Redirigir a la nueva vista después de 1 segundo
            setTimeout(() => {
                window.location.href = `/builder?view=${encodeURIComponent(data.new_view)}`;
            }, 1000);
        } else {
            // Error
            errorDiv.textContent = data.error || 'Error al duplicar la vista';
            errorDiv.style.display = 'block';
            duplicateButton.disabled = false;
            duplicateButton.innerHTML = originalText;
        }
    })
    .catch(error => {
        console.error('Error:', error);
        errorDiv.textContent = 'Error al duplicar la vista. Por favor, inténtalo de nuevo.';
        errorDiv.style.display = 'block';
        duplicateButton.disabled = false;
        duplicateButton.innerHTML = originalText;
    });
}

// ============================================
// EDITOR CSS PERSONALIZADO
// ============================================

let cssEditorModal = null;
let customCssEditor = null;
let customCss = '';

// Modal y estado para editor de atributos como código
let attributesCodeModal = null;
let currentAttributesComponent = null;

// Inicializar modal y editor CSS
setTimeout(function() {
    const modalElement = document.getElementById('cssEditorModal');
    if (modalElement) {
        cssEditorModal = new bootstrap.Modal(modalElement);
    }
    
    // Inicializar modal de atributos
    const attrsModalElement = document.getElementById('attributesCodeModal');
    if (attrsModalElement) {
        attributesCodeModal = new bootstrap.Modal(attrsModalElement);
    }
    
    // Inicializar CodeMirror cuando el modal se muestre
    const textarea = document.getElementById('customCssEditor');
    if (textarea && typeof CodeMirror !== 'undefined') {
        customCssEditor = CodeMirror.fromTextArea(textarea, {
            mode: 'css',
            theme: 'monokai',
            lineNumbers: true,
            indentUnit: 2,
            indentWithTabs: false,
            lineWrapping: true,
            autofocus: true
        });
    }
}, 500);

function showCssEditor() {
    if (!cssEditorModal) {
        const modalElement = document.getElementById('cssEditorModal');
        if (modalElement) {
            cssEditorModal = new bootstrap.Modal(modalElement);
        }
    }
    
    // Cargar CSS personalizado actual si existe
    if (customCssEditor) {
        customCssEditor.setValue(customCss);
    } else {
        // Si CodeMirror no está inicializado, inicializarlo ahora
        const textarea = document.getElementById('customCssEditor');
        if (textarea && typeof CodeMirror !== 'undefined') {
            customCssEditor = CodeMirror.fromTextArea(textarea, {
                mode: 'css',
                theme: 'monokai',
                lineNumbers: true,
                indentUnit: 2,
                indentWithTabs: false,
                lineWrapping: true,
                autofocus: true
            });
            customCssEditor.setValue(customCss);
        }
    }
    
    if (cssEditorModal) {
        cssEditorModal.show();
    }
}

function saveCustomCss() {
    if (customCssEditor) {
        customCss = customCssEditor.getValue();
        showNotification('CSS personalizado guardado. Se aplicará al guardar la vista.', 'success');
        if (cssEditorModal) {
            cssEditorModal.hide();
        }
    } else {
        const textarea = document.getElementById('customCssEditor');
        if (textarea) {
            customCss = textarea.value;
            showNotification('CSS personalizado guardado. Se aplicará al guardar la vista.', 'success');
            if (cssEditorModal) {
                cssEditorModal.hide();
            }
        }
    }
}

function clearCustomCss() {
    if (confirm('¿Estás seguro de que deseas limpiar todo el CSS personalizado?')) {
        if (customCssEditor) {
            customCssEditor.setValue('');
            customCss = '';
        } else {
            const textarea = document.getElementById('customCssEditor');
            if (textarea) {
                textarea.value = '';
                customCss = '';
            }
        }
        showNotification('CSS personalizado limpiado', 'info');
    }
}

function saveAttributesFromModal() {
    if (!currentAttributesComponent) {
        return;
    }

    const textarea = document.getElementById('attributesCodeTextarea');
    const errorDiv = document.getElementById('attributesCodeError');
    if (!textarea) return;

    errorDiv.style.display = 'none';
    errorDiv.textContent = '';

    try {
        const parsed = JSON.parse(textarea.value || '{}');
        if (typeof parsed !== 'object' || Array.isArray(parsed)) {
            throw new Error('El JSON debe representar un objeto de atributos (clave/valor).');
        }

        currentAttributesComponent.setAttributes(parsed);
        currentAttributesComponent.view && currentAttributesComponent.view.render();

        if (attributesCodeModal) {
            attributesCodeModal.hide();
        }

        showNotification('Atributos actualizados correctamente', 'success');
    } catch (e) {
        errorDiv.textContent = 'Error al parsear JSON: ' + e.message;
        errorDiv.style.display = 'block';
    }
}

// ============================================
// SISTEMA DE GESTIÓN DEL MENÚ
// ============================================

let menuManagerModal = null;
let pageSelectorModal = null;
let menuItems = [];
let availablePages = [];

// Inicializar modales
setTimeout(function() {
    const menuModalElement = document.getElementById('menuManagerModal');
    const pageModalElement = document.getElementById('pageSelectorModal');
    
    if (menuModalElement) {
        menuManagerModal = new bootstrap.Modal(menuModalElement);
    }
    if (pageModalElement) {
        pageSelectorModal = new bootstrap.Modal(pageModalElement);
    }
}, 500);

function showMenuManager() {
    if (!menuManagerModal) {
        const modalElement = document.getElementById('menuManagerModal');
        if (modalElement) {
            menuManagerModal = new bootstrap.Modal(modalElement);
        }
    }
    
    if (menuManagerModal) {
        loadMenuItems();
        menuManagerModal.show();
    }
}

function loadMenuItems() {
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
    fetch('/builder/menu', {
        headers: {
            'X-CSRF-TOKEN': token,
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        menuItems = data;
        renderMenuItems();
    })
    .catch(error => {
        console.error('Error:', error);
        document.getElementById('menuItemsList').innerHTML = 
            '<div class="alert alert-danger">Error al cargar los items del menú</div>';
    });
}

function renderMenuItems() {
    const container = document.getElementById('menuItemsList');
    
    if (menuItems.length === 0) {
        container.innerHTML = `
            <div class="text-center text-muted py-5">
                <i class="bi bi-inbox"></i>
                <p class="mt-2">No hay items en el menú. Crea uno nuevo para comenzar.</p>
            </div>
        `;
        return;
    }
    
    let html = '';
    menuItems.forEach((item, index) => {
        const activeBadge = item.active 
            ? '<span class="badge bg-success">Activo</span>' 
            : '<span class="badge bg-secondary">Inactivo</span>';
        
        html += `
            <div class="list-group-item d-flex justify-content-between align-items-center menu-item-draggable" 
                 data-id="${item.id}" style="cursor: move;">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-grip-vertical text-muted"></i>
                    ${item.icon ? `<i class="${item.icon}"></i>` : ''}
                    <strong>${item.label}</strong>
                    <span class="text-muted">(${item.url})</span>
                    ${activeBadge}
                </div>
                <div class="btn-group btn-group-sm">
                    <button class="btn btn-outline-primary" onclick="editMenuItem(${item.id})" title="Editar">
                        <i class="bi bi-pencil"></i>
                    </button>
                    <button class="btn btn-outline-danger" onclick="deleteMenuItem(${item.id})" title="Eliminar">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
            </div>
        `;
    });
    
    container.innerHTML = html;
    
    // Inicializar drag & drop (usando SortableJS si está disponible, o implementación básica)
    initDragAndDrop();
}

function initDragAndDrop() {
    const container = document.getElementById('menuItemsList');
    const items = container.querySelectorAll('.menu-item-draggable');
    
    items.forEach(item => {
        item.draggable = true;
        item.addEventListener('dragstart', handleDragStart);
        item.addEventListener('dragover', handleDragOver);
        item.addEventListener('drop', handleDrop);
        item.addEventListener('dragend', handleDragEnd);
    });
}

let draggedElement = null;

function handleDragStart(e) {
    draggedElement = this;
    this.style.opacity = '0.5';
    e.dataTransfer.effectAllowed = 'move';
}

function handleDragOver(e) {
    if (e.preventDefault) {
        e.preventDefault();
    }
    e.dataTransfer.dropEffect = 'move';
    return false;
}

function handleDrop(e) {
    if (e.stopPropagation) {
        e.stopPropagation();
    }
    
    if (draggedElement !== this) {
        const container = document.getElementById('menuItemsList');
        const items = Array.from(container.querySelectorAll('.menu-item-draggable'));
        const draggedIndex = items.indexOf(draggedElement);
        const targetIndex = items.indexOf(this);
        
        if (draggedIndex < targetIndex) {
            container.insertBefore(draggedElement, this.nextSibling);
        } else {
            container.insertBefore(draggedElement, this);
        }
        
        // Actualizar orden en servidor
        updateMenuOrder();
    }
    
    return false;
}

function handleDragEnd(e) {
    this.style.opacity = '1';
    draggedElement = null;
}

function updateMenuOrder() {
    const container = document.getElementById('menuItemsList');
    const items = container.querySelectorAll('.menu-item-draggable');
    const orderData = Array.from(items).map((item, index) => ({
        id: parseInt(item.dataset.id),
        order: index + 1
    }));
    
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
    fetch('/builder/menu/reorder', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token,
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: JSON.stringify({ items: orderData })
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'ok') {
            loadMenuItems(); // Recargar para sincronizar
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

function showMenuItemForm(itemId = null) {
    const formContainer = document.getElementById('menuItemFormContainer');
    const placeholder = document.getElementById('menuItemFormPlaceholder');
    const formTitle = document.getElementById('menuFormTitle');
    
    formContainer.style.display = 'block';
    placeholder.style.display = 'none';
    
    if (itemId) {
        formTitle.textContent = 'Editar Item';
        const item = menuItems.find(i => i.id === itemId);
        if (item) {
            document.getElementById('menuItemId').value = item.id;
            document.getElementById('menuItemLabel').value = item.label;
            document.getElementById('menuItemUrl').value = item.url;
            document.getElementById('menuItemIcon').value = item.icon || '';
            document.getElementById('menuItemTarget').value = item.target || '_self';
            document.getElementById('menuItemActive').checked = item.active;
        }
    } else {
        formTitle.textContent = 'Nuevo Item';
        document.getElementById('menuItemForm').reset();
        document.getElementById('menuItemId').value = '';
        document.getElementById('menuItemActive').checked = true;
    }
}

function cancelMenuItemForm() {
    const formContainer = document.getElementById('menuItemFormContainer');
    const placeholder = document.getElementById('menuItemFormPlaceholder');
    
    formContainer.style.display = 'none';
    placeholder.style.display = 'block';
    document.getElementById('menuItemForm').reset();
}

function editMenuItem(id) {
    showMenuItemForm(id);
}

function saveMenuItem(event) {
    event.preventDefault();
    
    const formData = new FormData(event.target);
    const data = {
        label: formData.get('label'),
        url: formData.get('url'),
        icon: formData.get('icon') || null,
        target: formData.get('target') || '_self',
        active: formData.get('active') === 'on'
    };
    
    const itemId = formData.get('id');
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const url = itemId ? `/builder/menu/${itemId}` : '/builder/menu';
    const method = itemId ? 'PUT' : 'POST';
    
    fetch(url, {
        method: method,
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token,
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(result => {
        if (result.status === 'ok') {
            showNotification('Item guardado correctamente', 'success');
            loadMenuItems();
            cancelMenuItemForm();
        } else {
            alert('Error: ' + (result.error || 'Error desconocido'));
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error al guardar el item');
    });
}

function deleteMenuItem(id) {
    if (!confirm('¿Estás seguro de que deseas eliminar este item del menú?')) {
        return;
    }
    
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
    fetch(`/builder/menu/${id}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': token,
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(result => {
        if (result.status === 'ok') {
            showNotification('Item eliminado correctamente', 'success');
            loadMenuItems();
            cancelMenuItemForm();
        } else {
            alert('Error: ' + (result.error || 'Error desconocido'));
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error al eliminar el item');
    });
}

function showPageSelector() {
    if (!pageSelectorModal) {
        const modalElement = document.getElementById('pageSelectorModal');
        if (modalElement) {
            pageSelectorModal = new bootstrap.Modal(modalElement);
        }
    }
    
    loadAvailablePages();
    
    if (pageSelectorModal) {
        pageSelectorModal.show();
    }
}

function loadAvailablePages() {
    const container = document.getElementById('availablePagesList');
    container.innerHTML = '<div class="text-center text-muted py-3"><i class="bi bi-arrow-repeat spin"></i> Cargando...</div>';
    
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
    fetch('/builder/menu/pages', {
        headers: {
            'X-CSRF-TOKEN': token,
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        availablePages = [...data.pages, ...data.common_routes];
        renderAvailablePages();
    })
    .catch(error => {
        console.error('Error:', error);
        container.innerHTML = '<div class="alert alert-danger">Error al cargar las páginas</div>';
    });
}

function renderAvailablePages() {
    const container = document.getElementById('availablePagesList');
    
    let html = '<div class="list-group">';
    
    if (availablePages.length === 0) {
        html += '<div class="text-center text-muted py-3">No hay páginas disponibles</div>';
    } else {
        availablePages.forEach(page => {
            html += `
                <button type="button" class="list-group-item list-group-item-action" 
                        onclick="selectPage('${page.url}', '${page.label}')">
                    <strong>${page.label}</strong>
                    <br><small class="text-muted">${page.url}</small>
                </button>
            `;
        });
    }
    
    html += '</div>';
    container.innerHTML = html;
}

function selectPage(url, label) {
    document.getElementById('menuItemUrl').value = url;
    if (!document.getElementById('menuItemLabel').value) {
        document.getElementById('menuItemLabel').value = label;
    }
    
    if (pageSelectorModal) {
        pageSelectorModal.hide();
    }
}
</script>
</body>
</html>
