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
    <style>
        body, html { margin: 0; padding: 0; height: 100%; }
        #gjs { height: 100% !important; }
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
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="gjs">{!! $html !!}</div>

    <script src="https://unpkg.com/grapesjs"></script>
    <script src="https://unpkg.com/grapesjs-blocks-basic"></script>
    <script src="https://unpkg.com/grapesjs-preset-webpage"></script>
    <script src="https://unpkg.com/grapesjs-tabs"></script>
    <script>
    const editor = grapesjs.init({
        container: '#gjs',
        fromElement: true,
        plugins: [
            'gjs-blocks-basic',
            'grapesjs-preset-webpage',
            'grapesjs-tabs'
        ],
        pluginsOpts: {
            'gjs-blocks-basic': {},
            'grapesjs-preset-webpage': {},
            'grapesjs-tabs': {}
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
            autoload: true,
            autosave: true,
            stepsBeforeSave: 1,
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
                    'assetManager.modalTitle': 'Selecciona una imagen',
                    'blocks.categories.basic': 'Elementos básicos',
                    'blocks.categories.layout': 'Diseño',
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

    editor.on('component:selected', (component) => {
        if (component && component.get('type') === 'video') {
            const assetManager = editor.AssetManager;

            assetManager.open({
                select: (asset) => {
                    const src = asset.get('src');

                    // Establece el atributo src en el componente
                    component.setAttributes({ src: src });

                    // ✅ Actualiza el trait manualmente
                    const traits = component.get('traits');
                    const srcTrait = traits.find(tr => tr.get('name') === 'src');
                    if (srcTrait) {
                        srcTrait.set('value', src);
                    }

                    component.view.render(); // fuerza render

                    assetManager.close();
                }
            });
        }
    });
    // REGISTRO DEL STORAGE PERSONALIZADO
    editor.StorageManager.add('laravel', {
        async load(options) {
            const view = '{{ urlencode($currentView) }}';
            const res = await fetch(`/builder/load?view=${view}`);
            const data = await res.json();
            return data;
        },
        async store(data, options) {
            const view = '{{ urlencode($currentView) }}';
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const html = editor.getHtml();
            const css = editor.getCss();
            const res = await fetch(`/builder/save?view=${view}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token,
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({
                    html: html,
                    css: css
                }),
            });
            return await res.json();
        }
    });
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
</script>
</body>
</html>
