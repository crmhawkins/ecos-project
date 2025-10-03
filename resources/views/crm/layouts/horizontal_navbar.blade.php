<!-- Navegación Horizontal con Clases Únicas -->
<div class="crm-navbar-custom" style="background: white; border-bottom: 1px solid #e2e8f0; padding: 12px 0; position: relative; z-index: 1000;">
    <div class="crm-navbar-container" style="max-width: 100%; margin: 0 auto; padding: 0 24px; display: flex; align-items: center; justify-content: space-between;">
        
        <!-- Logo más pequeño -->
        <div class="crm-navbar-brand" style="display: flex; align-items: center;">
            <a href="{{ route('dashboard') }}" style="display: flex; align-items: center; text-decoration: none; color: #2d3748; font-weight: 600; font-size: 16px;">
                <img src="{{ asset('assets/images/logo/logo.png') }}" alt="Logo" style="height: 18px; margin-right: 8px;">
                CRM Ecos
            </a>
        </div>

        <!-- Menú principal -->
        <div class="crm-navbar-menu" style="display: flex; align-items: center; gap: 8px;">
            
            <!-- Dashboard -->
            <div class="crm-menu-item">
                <a href="{{ route('dashboard') }}" class="crm-menu-link {{ request()->routeIs('dashboard') ? 'crm-active' : '' }}" 
                   style="display: flex; align-items: center; padding: 8px 16px; color: #2d3748; text-decoration: none; border-radius: 6px; font-weight: 500; transition: all 0.3s;">
                    <i class="fas fa-tachometer-alt" style="margin-right: 6px; font-size: 14px;"></i>
                    Dashboard
                </a>
            </div>

            @php
                $blogActive = request()->routeIs('crm.blog.*');
                $alumnosActive = request()->routeIs('crm.alumnos.*');
                $CursosActive = request()->routeIs('cursos.*');
                $CategoriasCursosActive = request()->routeIs('cursosCategoria.*');
                $aulasActive = request()->routeIs('aulas.*');
                $reservasActive = request()->routeIs('reservas.*');
            @endphp

            <!-- Academia -->
            <div class="crm-menu-item crm-dropdown" style="position: relative;">
                <button class="crm-menu-link crm-dropdown-toggle {{ $blogActive || $alumnosActive || $CursosActive || $CategoriasCursosActive || $aulasActive || $reservasActive ? 'crm-active' : '' }}" 
                        style="display: flex; align-items: center; padding: 8px 16px; color: #2d3748; background: none; border: none; border-radius: 6px; font-weight: 500; cursor: pointer; transition: all 0.3s;">
                    <i class="fas fa-graduation-cap" style="margin-right: 6px; font-size: 14px;"></i>
                    Academia
                    <i class="fas fa-chevron-down" style="margin-left: 6px; font-size: 12px;"></i>
                </button>
                
                <div class="crm-dropdown-menu" style="position: absolute; top: 100%; left: 50%; transform: translateX(-50%); background: white; border: 1px solid #e2e8f0; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); padding: 12px 0; min-width: 220px; display: none; z-index: 1001; margin-top: 4px;">
                    
                    <!-- Blog/Noticias -->
                    <div style="padding: 4px 16px; font-size: 11px; color: #6b7280; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">Blog/Noticias</div>
                    <a href="{{ route('crm.blog.index') }}" class="crm-dropdown-item {{ request()->routeIs('crm.blog.index') ? 'crm-active' : '' }}" 
                       style="display: flex; align-items: center; padding: 8px 16px; color: #2d3748; text-decoration: none; font-size: 14px; transition: all 0.3s;">
                        <i class="fas fa-list" style="margin-right: 8px; width: 16px; font-size: 12px;"></i>
                        Ver Noticias
                    </a>
                    <a href="{{ route('crm.blog.create') }}" class="crm-dropdown-item {{ request()->routeIs('crm.blog.create') ? 'crm-active' : '' }}" 
                       style="display: flex; align-items: center; padding: 8px 16px; color: #2d3748; text-decoration: none; font-size: 14px; transition: all 0.3s;">
                        <i class="fas fa-plus" style="margin-right: 8px; width: 16px; font-size: 12px;"></i>
                        Nueva Noticia
                    </a>
                    
                    <div style="height: 1px; background: #e2e8f0; margin: 8px 0;"></div>
                    
                    <!-- Alumnos -->
                    <div style="padding: 4px 16px; font-size: 11px; color: #6b7280; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">Alumnos</div>
                    <a href="{{ route('crm.alumnos.index') }}" class="crm-dropdown-item {{ request()->routeIs('crm.alumnos.index') ? 'crm-active' : '' }}" 
                       style="display: flex; align-items: center; padding: 8px 16px; color: #2d3748; text-decoration: none; font-size: 14px; transition: all 0.3s;">
                        <i class="fas fa-list" style="margin-right: 8px; width: 16px; font-size: 12px;"></i>
                        Ver Alumnos
                    </a>
                    <a href="{{ route('crm.alumnos.create') }}" class="crm-dropdown-item {{ request()->routeIs('crm.alumnos.create') ? 'crm-active' : '' }}" 
                       style="display: flex; align-items: center; padding: 8px 16px; color: #2d3748; text-decoration: none; font-size: 14px; transition: all 0.3s;">
                        <i class="fas fa-plus" style="margin-right: 8px; width: 16px; font-size: 12px;"></i>
                        Nuevo Alumno
                    </a>
                    
                    <div style="height: 1px; background: #e2e8f0; margin: 8px 0;"></div>
                    
                    <!-- Cursos -->
                    <div style="padding: 4px 16px; font-size: 11px; color: #6b7280; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">Cursos</div>
                    <a href="{{ route('cursos.index') }}" class="crm-dropdown-item {{ request()->routeIs('cursos.index') ? 'crm-active' : '' }}" 
                       style="display: flex; align-items: center; padding: 8px 16px; color: #2d3748; text-decoration: none; font-size: 14px; transition: all 0.3s;">
                        <i class="fas fa-list" style="margin-right: 8px; width: 16px; font-size: 12px;"></i>
                        Cursos
                    </a>
                    <a href="{{ route('cursos.create') }}" class="crm-dropdown-item {{ request()->routeIs('cursos.create') ? 'crm-active' : '' }}" 
                       style="display: flex; align-items: center; padding: 8px 16px; color: #2d3748; text-decoration: none; font-size: 14px; transition: all 0.3s;">
                        <i class="fas fa-plus" style="margin-right: 8px; width: 16px; font-size: 12px;"></i>
                        Añadir Curso
                    </a>
                    <a href="{{ route('cursosCategoria.index') }}" class="crm-dropdown-item {{ request()->routeIs('cursosCategoria.index') ? 'crm-active' : '' }}" 
                       style="display: flex; align-items: center; padding: 8px 16px; color: #2d3748; text-decoration: none; font-size: 14px; transition: all 0.3s;">
                        <i class="fas fa-tags" style="margin-right: 8px; width: 16px; font-size: 12px;"></i>
                        Categorías
                    </a>
                    
                    <div style="height: 1px; background: #e2e8f0; margin: 8px 0;"></div>
                    
                    <!-- Aulas -->
                    <div style="padding: 4px 16px; font-size: 11px; color: #6b7280; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">Aulas</div>
                    <a href="{{ route('aulas.index') }}" class="crm-dropdown-item {{ request()->routeIs('aulas.index') ? 'crm-active' : '' }}" 
                       style="display: flex; align-items: center; padding: 8px 16px; color: #2d3748; text-decoration: none; font-size: 14px; transition: all 0.3s;">
                        <i class="fas fa-chalkboard" style="margin-right: 8px; width: 16px; font-size: 12px;"></i>
                        Aulas
                    </a>
                    <a href="{{ route('reservas.index') }}" class="crm-dropdown-item {{ request()->routeIs('reservas.index') ? 'crm-active' : '' }}" 
                       style="display: flex; align-items: center; padding: 8px 16px; color: #2d3748; text-decoration: none; font-size: 14px; transition: all 0.3s;">
                        <i class="fas fa-calendar-alt" style="margin-right: 8px; width: 16px; font-size: 12px;"></i>
                        Reservas
                    </a>
                </div>
            </div>

            <!-- Empresa -->
            <div class="crm-menu-item">
                <a href="#" class="crm-menu-link" 
                   style="display: flex; align-items: center; padding: 8px 16px; color: #2d3748; text-decoration: none; border-radius: 6px; font-weight: 500; transition: all 0.3s;">
                    <i class="fas fa-building" style="margin-right: 6px; font-size: 14px;"></i>
                    Empresa
                </a>
            </div>
        </div>

        <!-- Usuario -->
        <div class="crm-navbar-user" style="display: flex; align-items: center;">
            <div class="crm-menu-item crm-dropdown" style="position: relative;">
                <button class="crm-user-toggle" 
                        style="display: flex; align-items: center; padding: 6px 12px; color: #2d3748; background: none; border: none; border-radius: 6px; cursor: pointer; transition: all 0.3s;">
                    <img src="{{ Auth::user()->avatar ?? asset('assets/images/faces/1.jpg') }}" 
                         alt="Avatar" style="width: 24px; height: 24px; border-radius: 50%; margin-right: 8px; border: 1px solid #e2e8f0;">
                    <span style="font-weight: 500; font-size: 14px;">{{ Auth::user()->name }}</span>
                    <i class="fas fa-chevron-down" style="margin-left: 6px; font-size: 12px;"></i>
                </button>
                
                <div class="crm-user-menu" style="position: absolute; top: 100%; right: 0; background: white; border: 1px solid #e2e8f0; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); padding: 8px 0; min-width: 180px; display: none; z-index: 1001; margin-top: 4px;">
                    <a href="#" class="crm-dropdown-item" 
                       style="display: flex; align-items: center; padding: 8px 16px; color: #2d3748; text-decoration: none; font-size: 14px; transition: all 0.3s;">
                        <i class="fas fa-user" style="margin-right: 8px; width: 16px; font-size: 12px;"></i>
                        Perfil
                    </a>
                    <a href="#" class="crm-dropdown-item" 
                       style="display: flex; align-items: center; padding: 8px 16px; color: #2d3748; text-decoration: none; font-size: 14px; transition: all 0.3s;">
                        <i class="fas fa-cog" style="margin-right: 8px; width: 16px; font-size: 12px;"></i>
                        Configuración
                    </a>
                    <div style="height: 1px; background: #e2e8f0; margin: 8px 0;"></div>
                    <a href="{{ route('logout') }}" class="crm-dropdown-item" 
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                       style="display: flex; align-items: center; padding: 8px 16px; color: #dc2626; text-decoration: none; font-size: 14px; transition: all 0.3s;">
                        <i class="fas fa-sign-out-alt" style="margin-right: 8px; width: 16px; font-size: 12px;"></i>
                        Cerrar Sesión
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Estilos para navbar CRM personalizado */
.crm-menu-link:hover,
.crm-dropdown-toggle:hover,
.crm-user-toggle:hover {
    background-color: rgba(217, 54, 144, 0.1) !important;
    color: #D93690 !important;
}

.crm-menu-link.crm-active,
.crm-dropdown-toggle.crm-active {
    background-color: rgba(217, 54, 144, 0.15) !important;
    color: #D93690 !important;
}

.crm-dropdown-item:hover {
    background-color: #D93690 !important;
    color: white !important;
}

.crm-dropdown-item.crm-active {
    background-color: #D93690 !important;
    color: white !important;
}

.crm-navbar-brand a:hover {
    color: #D93690 !important;
    text-decoration: none;
}

/* Mostrar dropdown al hacer hover */
.crm-dropdown:hover .crm-dropdown-menu,
.crm-dropdown:hover .crm-user-menu {
    display: block !important;
}

/* Responsive */
@media (max-width: 768px) {
    .crm-navbar-menu {
        display: none !important;
    }
    
    .crm-navbar-container {
        flex-direction: column !important;
        gap: 16px !important;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Manejar clicks en dropdowns
    const dropdownToggles = document.querySelectorAll('.crm-dropdown-toggle, .crm-user-toggle');
    
    dropdownToggles.forEach(toggle => {
        toggle.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            // Cerrar otros dropdowns
            document.querySelectorAll('.crm-dropdown-menu, .crm-user-menu').forEach(menu => {
                if (menu !== this.nextElementSibling) {
                    menu.style.display = 'none';
                }
            });
            
            // Toggle del dropdown actual
            const menu = this.nextElementSibling;
            if (menu) {
                menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
            }
        });
    });
    
    // Cerrar dropdowns al hacer click fuera
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.crm-dropdown')) {
            document.querySelectorAll('.crm-dropdown-menu, .crm-user-menu').forEach(menu => {
                menu.style.display = 'none';
            });
        }
    });
    
    // Manejar hover en dropdowns (desktop)
    const dropdowns = document.querySelectorAll('.crm-dropdown');
    
    dropdowns.forEach(dropdown => {
        let timeout;
        
        dropdown.addEventListener('mouseenter', function() {
            clearTimeout(timeout);
            const menu = this.querySelector('.crm-dropdown-menu, .crm-user-menu');
            if (menu && window.innerWidth > 768) {
                menu.style.display = 'block';
            }
        });
        
        dropdown.addEventListener('mouseleave', function() {
            const menu = this.querySelector('.crm-dropdown-menu, .crm-user-menu');
            timeout = setTimeout(() => {
                if (menu) {
                    menu.style.display = 'none';
                }
            }, 150);
        });
    });
