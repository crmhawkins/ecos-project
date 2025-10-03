<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('titulo', 'CRM') - {{ config('app.name', 'Ecos') }}</title>
    
    <!-- Fonts y CDN -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    @livewireStyles
    
    <!-- CSS específico para tablas -->
    <link href="{{ asset('css/cursos-table.css') }}" rel="stylesheet">
    <link href="{{ asset('css/reservas-table.css') }}" rel="stylesheet">
    
    <style>
        /* Reset y Variables */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        :root {
            --primary-color: #D93690;
            --secondary-color: #8B5CF6;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
            --info-color: #3b82f6;
            --dark-color: #1f2937;
            --light-color: #f8fafc;
            --border-color: #e5e7eb;
            --text-primary: #111827;
            --text-secondary: #6b7280;
            --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            --border-radius: 8px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: var(--light-color);
            color: var(--text-primary);
            line-height: 1.6;
        }
        
        /* NAVBAR */
        .navbar {
            background: white;
            border-bottom: 1px solid var(--border-color);
            box-shadow: var(--shadow);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            height: 70px;
        }
        
        .navbar-container {
            max-width: 100%;
            margin: 0 auto;
            padding: 0 24px;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        .navbar-brand {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: var(--text-primary);
            font-weight: 700;
            font-size: 18px;
            transition: var(--transition);
        }
        
        .navbar-brand:hover {
            color: var(--primary-color);
        }
        
        .navbar-brand img {
            height: 32px;
            margin-right: 12px;
        }
        
        .navbar-menu {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .nav-item {
            position: relative;
        }
        
        .nav-link {
            display: flex;
            align-items: center;
            padding: 10px 16px;
            color: var(--text-primary);
            text-decoration: none;
            border-radius: var(--border-radius);
            font-weight: 500;
            transition: var(--transition);
            cursor: pointer;
            border: none;
            background: none;
        }
        
        .nav-link:hover,
        .nav-link.active {
            background: rgba(217, 54, 144, 0.1);
            color: var(--primary-color);
        }
        
        .nav-link i {
            margin-right: 8px;
            font-size: 14px;
        }
        
        .dropdown-menu {
            position: absolute;
            top: 100%;
            left: 50%;
            transform: translateX(-50%);
            background: white;
            border: 1px solid var(--border-color);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-lg);
            padding: 8px 0;
            min-width: 220px;
            display: none;
            z-index: 1001;
            margin-top: 8px;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .dropdown:hover .dropdown-menu,
        .dropdown-menu:hover {
            display: block;
            opacity: 1;
            visibility: visible;
        }
        
        /* Crear un puente invisible entre el trigger y el dropdown */
        .dropdown::before {
            content: '';
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            height: 8px;
            background: transparent;
            z-index: 1000;
        }
        
        /* Mejorar la experiencia de hover en los elementos del dropdown */
        .dropdown-item {
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
        }
        
        .dropdown-item:hover {
            background: var(--primary-color);
            color: white;
            transform: translateX(4px);
        }
        
        .dropdown-item:hover i {
            color: white;
        }
        
        /* Asegurar que el dropdown se mantenga visible durante la navegación */
        .dropdown-menu:hover {
            display: block !important;
            opacity: 1 !important;
            visibility: visible !important;
        }
        
        .dropdown-header {
            padding: 8px 16px;
            font-size: 11px;
            color: var(--text-secondary);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 1px solid var(--border-color);
            margin-bottom: 4px;
        }
        
        .dropdown-item {
            display: flex;
            align-items: center;
            padding: 10px 16px;
            color: var(--text-primary);
            text-decoration: none;
            font-size: 14px;
            transition: var(--transition);
        }
        
        .dropdown-item:hover,
        .dropdown-item.active {
            background: var(--primary-color);
            color: white;
        }
        
        .dropdown-item i {
            margin-right: 10px;
            width: 16px;
            font-size: 13px;
        }
        
        .dropdown-divider {
            height: 1px;
            background: var(--border-color);
            margin: 8px 0;
        }
        
        .navbar-user {
            display: flex;
            align-items: center;
            position: relative;
        }
        
        .user-menu {
            position: absolute;
            top: 100%;
            right: 0;
            background: white;
            border: 1px solid var(--border-color);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-lg);
            padding: 8px 0;
            min-width: 180px;
            display: none;
            z-index: 1001;
            margin-top: 8px;
        }
        
        .navbar-user:hover .user-menu {
            display: block;
        }
        
        .user-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            margin-right: 8px;
            border: 2px solid var(--border-color);
        }
        
        /* MAIN CONTENT */
        .main-content {
            margin-top: 70px;
            min-height: calc(100vh - 70px);
            padding: 24px;
        }
        
        /* RESPONSIVE */
        @media (max-width: 768px) {
            .navbar-menu {
                display: none;
            }
            
            .navbar-container {
                padding: 0 16px;
            }
            
            .main-content {
                padding: 16px;
            }
            
            .dropdown-menu {
                left: 0;
                transform: none;
            }
        }
        
        /* UTILITIES */
        .btn {
            display: inline-flex;
            align-items: center;
            padding: 10px 20px;
            border: none;
            border-radius: var(--border-radius);
            font-weight: 500;
            text-decoration: none;
            cursor: pointer;
            transition: var(--transition);
        }
        
        .btn-primary {
            background: var(--primary-color);
            color: white;
        }
        
        .btn-primary:hover {
            background: #c2185b;
            color: white;
        }
        
        .card {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            overflow: hidden;
        }
        
        .card-header {
            padding: 20px 24px;
            border-bottom: 1px solid var(--border-color);
            background: #fafafa;
        }
        
        .card-body {
            padding: 24px;
        }
    </style>
    
    @yield('css')
    <link href="{{ asset('resources/css/cursos-table.css') }}" rel="stylesheet">
</head>
<body>
    <!-- NAVBAR -->
    <nav class="navbar">
        <div class="navbar-container">
            <!-- Brand -->
            <a href="{{ route('dashboard') }}" class="navbar-brand">
                <img src="{{ asset('assets/images/logo/logo.png') }}" alt="Logo">
                CRM Ecos
            </a>
            
            <!-- Menu -->
            <div class="navbar-menu">
                <!-- Dashboard -->
                <div class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="fas fa-tachometer-alt"></i>
                        Dashboard
                    </a>
                </div>
                
                <!-- Moodle -->
                <div class="nav-item">
                    <a href="{{ route('moodle.admin.dashboard') }}" class="nav-link {{ request()->routeIs('moodle.admin.dashboard') ? 'active' : '' }}" target="_blank" rel="noopener noreferrer">
                        <img src="{{ asset('assets/icons/Moodle.svg') }}" alt="Moodle" style="width: 16px; height: 16px; margin-right: 8px;">
                        Moodle
                        <i class="fas fa-external-link-alt" style="margin-left: 6px; font-size: 10px; opacity: 0.7;"></i>
                    </a>
                </div>
                
                <!-- Builder -->
                <div class="nav-item">
                    <a href="{{ route('builder') }}" class="nav-link" target="_blank" rel="noopener noreferrer">
                        <i class="fas fa-paint-brush"></i>
                        Builder
                        <i class="fas fa-external-link-alt" style="margin-left: 6px; font-size: 10px; opacity: 0.7;"></i>
                    </a>
                </div>
                
                <!-- Academia -->
                @php
                    $blogActive = request()->routeIs('crm.blog.*');
                    $alumnosActive = request()->routeIs('crm.alumnos.*');
                    $cursosActive = request()->routeIs('cursos.*');
                    $categoriasActive = request()->routeIs('cursosCategoria.*');
                    $aulasActive = request()->routeIs('aulas.*');
                    $reservasActive = request()->routeIs('reservas.*');
                    $calendarioActive = request()->routeIs('calendario.*');
                    $academiaActive = $blogActive || $alumnosActive || $cursosActive || $categoriasActive || $aulasActive || $reservasActive || $calendarioActive;
                @endphp
                
                <div class="nav-item dropdown">
                    <button class="nav-link {{ $academiaActive ? 'active' : '' }}">
                        <i class="fas fa-graduation-cap"></i>
                        Academia
                        <i class="fas fa-chevron-down" style="margin-left: 8px; font-size: 12px;"></i>
                    </button>
                    
                    <div class="dropdown-menu">
                        <div class="dropdown-header">Blog/Noticias</div>
                        <a href="{{ route('crm.blog.index') }}" class="dropdown-item {{ request()->routeIs('crm.blog.index') ? 'active' : '' }}">
                            <i class="fas fa-list"></i>
                            Ver Noticias
                        </a>
                        <a href="{{ route('crm.blog.create') }}" class="dropdown-item {{ request()->routeIs('crm.blog.create') ? 'active' : '' }}">
                            <i class="fas fa-plus"></i>
                            Nueva Noticia
                        </a>
                        
                        <div class="dropdown-divider"></div>
                        
                        <div class="dropdown-header">Alumnos</div>
                        <a href="{{ route('crm.alumnos.index') }}" class="dropdown-item {{ request()->routeIs('crm.alumnos.index') ? 'active' : '' }}">
                            <i class="fas fa-users"></i>
                            Ver Alumnos
                        </a>
                        <a href="{{ route('crm.alumnos.create') }}" class="dropdown-item {{ request()->routeIs('crm.alumnos.create') ? 'active' : '' }}">
                            <i class="fas fa-user-plus"></i>
                            Nuevo Alumno
                        </a>
                        
                        <div class="dropdown-divider"></div>
                        
                        <div class="dropdown-header">Cursos</div>
                        <a href="{{ route('cursos.index') }}" class="dropdown-item {{ request()->routeIs('cursos.index') ? 'active' : '' }}">
                            <i class="fas fa-book"></i>
                            Ver Cursos
                        </a>
                        <a href="{{ route('cursos.create') }}" class="dropdown-item {{ request()->routeIs('cursos.create') ? 'active' : '' }}">
                            <i class="fas fa-plus"></i>
                            Nuevo Curso
                        </a>
                        <a href="{{ route('cursosCategoria.index') }}" class="dropdown-item {{ request()->routeIs('cursosCategoria.index') ? 'active' : '' }}">
                            <i class="fas fa-tags"></i>
                            Categorías
                        </a>
                        
                        <div class="dropdown-divider"></div>
                        
                        <div class="dropdown-header">Aulas & Reservas</div>
                        <a href="{{ route('aulas.index') }}" class="dropdown-item {{ request()->routeIs('aulas.index') ? 'active' : '' }}">
                            <i class="fas fa-chalkboard"></i>
                            Aulas
                        </a>
                        <a href="{{ route('reservas.index') }}" class="dropdown-item {{ request()->routeIs('reservas.index') ? 'active' : '' }}">
                            <i class="fas fa-list"></i>
                            Lista de Reservas
                        </a>
                        <a href="{{ route('calendario.index') }}" class="dropdown-item {{ request()->routeIs('calendario.*') ? 'active' : '' }}">
                            <i class="fas fa-calendar-alt"></i>
                            Calendario de Reservas
                        </a>
                    </div>
                </div>
                
                <!-- Empresa -->
                <div class="nav-item">
                    <a href="{{ route('empresa.index') }}" class="nav-link {{ request()->routeIs('empresa.*') ? 'active' : '' }}">
                        <i class="fas fa-building"></i>
                        Empresa
                    </a>
                </div>
            </div>
            
            <!-- User Menu -->
            <div class="navbar-user">
                <img src="{{ Auth::user()->avatar ?? asset('assets/images/faces/1.jpg') }}" alt="Avatar" class="user-avatar">
                <span style="font-weight: 500; margin-right: 8px;">{{ Auth::user()->name }}</span>
                <i class="fas fa-chevron-down" style="font-size: 12px;"></i>
                
                <div class="user-menu">
                    <a href="{{ route('user.profile') }}" class="dropdown-item">
                        <i class="fas fa-user"></i>
                        Mi Perfil
                    </a>
                    <a href="{{ route('user.settings') }}" class="dropdown-item">
                        <i class="fas fa-cog"></i>
                        Configuración
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item" 
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i>
                        Cerrar Sesión
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </nav>
    
    <!-- MAIN CONTENT -->
    <main class="main-content">
        @yield('content')
    </main>
    
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    @livewireScripts
    
    @yield('scripts')
    
    <script>
        // Dropdown functionality with improved hover experience
        document.addEventListener('DOMContentLoaded', function() {
            const dropdownButtons = document.querySelectorAll('.nav-link');
            
            dropdownButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    if (window.innerWidth <= 768) {
                        e.preventDefault();
                        const dropdown = this.nextElementSibling;
                        if (dropdown && dropdown.classList.contains('dropdown-menu')) {
                            dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
                        }
                    }
                });
            });
            
            // Mejorar la experiencia de dropdown en desktop
            const dropdowns = document.querySelectorAll('.dropdown');
            
            dropdowns.forEach(dropdown => {
                const menu = dropdown.querySelector('.dropdown-menu');
                let hoverTimeout;
                
                // Al entrar al dropdown
                dropdown.addEventListener('mouseenter', function() {
                    clearTimeout(hoverTimeout);
                    menu.style.display = 'block';
                    menu.style.opacity = '1';
                    menu.style.visibility = 'visible';
                });
                
                // Al salir del dropdown
                dropdown.addEventListener('mouseleave', function() {
                    hoverTimeout = setTimeout(() => {
                        menu.style.opacity = '0';
                        menu.style.visibility = 'hidden';
                        setTimeout(() => {
                            if (menu.style.opacity === '0') {
                                menu.style.display = 'none';
                            }
                        }, 300);
                    }, 150); // Pequeño delay para permitir navegación
                });
                
                // Al entrar al menú
                menu.addEventListener('mouseenter', function() {
                    clearTimeout(hoverTimeout);
                });
                
                // Al salir del menú
                menu.addEventListener('mouseleave', function() {
                    hoverTimeout = setTimeout(() => {
                        menu.style.opacity = '0';
                        menu.style.visibility = 'hidden';
                        setTimeout(() => {
                            if (menu.style.opacity === '0') {
                                menu.style.display = 'none';
                            }
                        }, 300);
                    }, 100);
                });
            });
            
            // Close dropdowns when clicking outside
            document.addEventListener('click', function(e) {
                if (!e.target.closest('.dropdown')) {
                    document.querySelectorAll('.dropdown-menu').forEach(menu => {
                        menu.style.opacity = '0';
                        menu.style.visibility = 'hidden';
                        setTimeout(() => {
                            menu.style.display = 'none';
                        }, 300);
                    });
                }
            });
        });
    </script>
</body>
</html>
