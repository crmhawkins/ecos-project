<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('titulo') - {{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts y estilos -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/iconly/bold.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/laravel-views.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/tailwind.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.svg') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <!-- CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/choices.js/1.1.6/choices.min.js" integrity="sha512-7PQ3MLNFhvDn/IQy12+1+jKcc1A/Yx4KuL62Bn6+ztkiitRVW1T/7ikAh675pOs3I+8hyXuRknDpTteeptw4Bw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@livewireStyles

    @yield('css')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('build/assets/app-d2e38ed8.css') }}" crossorigin="anonymous" referrerpolicy="no-referrer">
    <script src="{{ asset('build/assets/app-bf7e6802.js') }}"></script>
    {{-- <link rel="stylesheet" href="{{ asset('build/assets/app-C7Dj0nv1.css') }}" crossorigin="anonymous" referrerpolicy="no-referrer">
    <script src="{{ asset('build/assets/app-D03Ay3w-.js') }}"></script> --}}

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    </head>
    <body class="" style="overflow-x: hidden">
    <div id="app">
        <div id="loadingOverlay" style="display: block; position: fixed; width: 100%; height: 100%; top: 0; left: 0; right: 0; bottom: 0; background-color: rgba(255,255,255,0.5); z-index: 50000; cursor: pointer;">
            <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
                <div class="spinner-border text-black" role="status">
                    <span class="sr-only">Cargando...</span>
                </div>
            </div>
        </div>
        <div class="css-96uzu9"></div>

        @include('crm.layouts.sidebar')

        <main id="main">
            @include('crm.layouts.topBar')
            <div class="contenedor p-4">
                @yield('content')
            </div>
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/laravel-views.js') }}"></script>

    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
    @livewireScripts

    {{-- <script src="{{ asset('assets/js/main.js') }}"></script> --}}
    @yield('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
         document.addEventListener('DOMContentLoaded', function() {
            let accessLevel = {{ auth()->user()->access_level_id}};
            // Verificar si el nivel de acceso del usuario es 4
            if (accessLevel == 5 || accessLevel == 6) {
                $("#sidebar").remove();
                $("#main").css("margin-left", "0px");
            }
        });
        document.addEventListener("DOMContentLoaded", function() {
            var loader = document.getElementById('loadingOverlay');
            if (loader) {
                    loader.style.display = 'none';
            }
        });

        document.addEventListener("DOMContentLoaded", function() {
            const rows = document.querySelectorAll("tr.clickable-row");

            // Agregar evento de clic a las filas
            rows.forEach(row => {
                row.addEventListener("click", () => {
                    const href = row.dataset.href;
                    if (href) {
                        window.location.href = href;
                    }
                });
            });

            // Detener la propagación de los eventos de clic en los enlaces dentro de las filas
            const links = document.querySelectorAll("tr.clickable-row a");

            links.forEach(link => {
                link.addEventListener("click", (event) => {
                    event.stopPropagation(); // Detiene la propagación del evento
                });
            });

            // Si tienes botones o cualquier otro elemento interactivo, repite el proceso anterior para ellos
            const buttons = document.querySelectorAll("tr.clickable-row button");
            buttons.forEach(button => {
                button.addEventListener("click", (event) => {
                    event.stopPropagation();
                });
            });
        });
    </script>
</body>
</html>
