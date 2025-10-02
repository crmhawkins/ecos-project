<div id="navigation" class="fixed-top navbar-light bg-faded site-navigation">
    <div class="container">
        <div class="row align-items-center">
            <!-- Logo -->
            <div class="col-6 col-md-3 col-lg-2">
                <div class="site-logo">
                    <a href="{{ url('index') }}">
                        <img src="/assets/images/all-img/logo.png" alt="logo" id="ima3" />
                    </a>
                </div>
            </div>



            <!-- Menú principal -->
            <div class="col-12 col-md-9 col-lg-6">
                <div class="header_right">
                    <nav id="main-menu" class="ms-auto">
                        <ul id="in4wk">
                            <li><a href="/web/index" class="nav-link">INICIO</a></li>
                            <li><a href="/course" class="nav-link">CURSOS</a></li>
                            <li><a href="/blog" class="nav-link">NOTICIAS</a></li>
                            <li><a href="/web/about" class="nav-link">¿QUIÉNES SOMOS?</a></li>
                            <li><a href="/contact" class="nav-link">CONTACTA</a></li>

                            {{-- Botones para móvil/tablet --}}
                            <li class="d-lg-none mt-2">
                                @auth('alumno')
                                    <a href="{{ route('webacademia.perfil') }}" class="btn_one w-100 mb-2 text-center">Mi Perfil</a>
                                    <a href="{{ route('carrito.ver') }}" class="btn_two w-100 mb-2 text-center">Mi Carrito</a>
                                    <form method="POST" action="{{ route('webacademia.logout') }}" class="w-100">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-danger w-100 text-center">Cerrar Sesión</button>
                                    </form>
                                @else
                                    <a href="{{ url('/weblogin') }}" class="btn_one w-100 mb-2 text-center">Iniciar Sesión</a>
                                    <a href="{{ url('/webregister') }}" class="btn_two w-100 text-center">Registro</a>
                                @endauth
                            </li>
                        </ul>
                    </nav>
                    <div id="mobile_menu"></div>
                </div>
            </div>

            <!-- Carrito + botones (solo escritorio) -->
            <div class="col-lg-4 col-md-12 mt-3 mt-lg-0 d-none d-lg-flex flex-row justify-content-end align-items-center">
                @auth('alumno')
                    <!-- Usuario autenticado -->
                    <div class="home_lc me-3">
                        <a href="{{ route('carrito.ver') }}" class="hlc">
                            <i class="ti-shopping-cart-full"></i>
                            <span class="gactive">{{ $cartCount ?? 0 }}</span>
                        </a>
                    </div>
                    
                    <div class="user-menu-container position-relative">
                        <button class="user-menu-button" onclick="toggleUserMenu()" title="Menú de usuario">
                            👤 {{ Auth::guard('alumno')->user()->name }} ▼
                        </button>
                        <div class="user-menu" id="userMenu" style="display: none;">
                            <a href="{{ route('webacademia.perfil') }}" class="user-menu-item">Mi Perfil</a>
                            <a href="{{ route('carrito.ver') }}" class="user-menu-item">Mi Carrito</a>
                            <hr class="user-menu-divider">
                            <form method="POST" action="{{ route('webacademia.logout') }}" class="d-inline w-100">
                                @csrf
                                <button type="submit" class="user-menu-item user-menu-logout">Cerrar Sesión</button>
                            </form>
                        </div>
                    </div>
                @else
                    <!-- Usuario no autenticado -->
                    <div class="home_lc me-3">
                        <a href="{{ route('carrito.ver') }}" class="hlc">
                            <i class="ti-shopping-cart-full"></i>
                            <span class="gactive">{{ $cartCount ?? 0 }}</span>
                        </a>
                    </div>
                    <div class="call_to_action">
                        <a href="{{ url('/weblogin') }}" class="btn_one me-2">Iniciar Sesión</a>
                        <a href="{{ url('/webregister') }}" class="btn_two">Registro</a>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</div>
<a href="https://wa.me/34651130874">
    <div class="whatsapp_btn">
        <i class="fa-brands fa-whatsapp fa-2xl" style="color: #ffffff;"></i>
    </div>
</a>

<style>


    #ima3 {
        float: none;
        max-height: 50px;
    }

    #in4wk {
        list-style: none;
        padding-left: 0;
        margin-bottom: 0;
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        float: none;
    }

    #in4wk li {
        display: inline-block;
    }

    #mobile-toggle {
        display: none;
    }
    .whatsapp_btn {
        position: fixed;
        bottom: 10px;
        left: 10px;
        z-index: 100;
        height: 55px;
        width: 55px;
        border-radius: 50%;
        background-color: #25d366;
        display: flex;
        justify-content: center;
        align-items: center;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        transition: transform 0.2s ease-in-out;
    }

    .whatsapp_btn:hover {
        transform: scale(1.1);
    }

    .whatsapp_btn i {
        color: #ffffff;
        font-size: 34px; /* ajusta el tamaño a gusto */
    }

    /* Estilos para el menú de usuario */
    .user-menu-container {
        position: relative;
        display: inline-block;
    }

    .user-menu-button {
        background: #D93690 !important;
        color: #fff !important;
        border: 2px solid #fff !important;
        padding: 12px 24px !important;
        border-radius: 25px !important;
        font-size: 15px !important;
        font-weight: 700 !important;
        cursor: pointer !important;
        transition: all 0.3s ease !important;
        display: inline-block !important;
        text-decoration: none !important;
        box-shadow: 0 4px 12px rgba(217, 54, 144, 0.4) !important;
        z-index: 999 !important;
        position: relative !important;
        min-width: 120px !important;
        text-align: center !important;
        white-space: nowrap !important;
        vertical-align: middle !important;
        line-height: 1.2 !important;
    }

    .user-menu-button:hover {
        background: #262526 !important;
        color: #fff !important;
        transform: translateY(-1px) !important;
        box-shadow: 0 4px 8px rgba(217, 54, 144, 0.4) !important;
    }

    .user-menu {
        position: absolute;
        top: 100%;
        right: 0;
        background: white !important;
        border: 1px solid #ddd !important;
        border-radius: 8px !important;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15) !important;
        min-width: 200px !important;
        z-index: 9999 !important;
        margin-top: 8px !important;
        overflow: hidden !important;
    }

    .user-menu-item {
        display: block;
        padding: 10px 15px;
        color: #333;
        text-decoration: none;
        border: none;
        background: none;
        width: 100%;
        text-align: left;
        font-size: 14px;
        transition: background-color 0.2s;
    }

    .user-menu-item:hover {
        background-color: #f8f9fa;
        color: #333;
        text-decoration: none;
    }

    .user-menu-logout {
        color: #dc3545 !important;
    }

    .user-menu-logout:hover {
        background-color: #f8d7da !important;
    }

    .user-menu-divider {
        margin: 5px 0;
        border: 0;
        border-top: 1px solid #eee;
    }

    .user-menu-toggle {
        cursor: pointer;
        border: none;
        background: none;
    }

    @media (max-width: 991px) {
        #in4wk {
            flex-direction: column;
            display: none;
        }

        #in4wk.show {
            display: flex;
        }

        #mobile-toggle {
            display: block;
            background: none;
            border: none;
            font-size: 1.8rem;
            margin-bottom: 10px;
            color: #000;
        }

        .call_to_action {
            display: flex;
            flex-direction: column;
            gap: 5px;
            margin-top: 10px;
        }

        .home_lc {
            margin-bottom: 10px;
        }
    }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script>
    // Función para toggle del menú de usuario
    function toggleUserMenu() {
        const menu = document.getElementById('userMenu');
        if (menu.style.display === 'none' || menu.style.display === '') {
            menu.style.display = 'block';
        } else {
            menu.style.display = 'none';
        }
    }

    // Cerrar menú al hacer clic fuera
    document.addEventListener('click', function(event) {
        const userMenuContainer = document.querySelector('.user-menu-container');
        const userMenu = document.getElementById('userMenu');
        
        if (userMenuContainer && !userMenuContainer.contains(event.target)) {
            if (userMenu) {
                userMenu.style.display = 'none';
            }
        }
    });

    // Cerrar menú de navegación al hacer clic en un enlace (opcional)
    document.addEventListener('DOMContentLoaded', () => {
        const links = document.querySelectorAll('#in4wk a');
        links.forEach(link => {
            link.addEventListener('click', () => {
                const menu = document.getElementById('in4wk');
                if (menu.classList.contains('show')) {
                    menu.classList.remove('show');
                }
            });
        });
    });
</script>
