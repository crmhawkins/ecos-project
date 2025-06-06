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
                                <a href="{{ url('/weblogin') }}" class="btn_one w-100 mb-2 text-center">Iniciar Sesión</a>
                                <a href="{{ url('/webregister') }}" class="btn_two w-100 text-center">Registro</a>
                            </li>
                        </ul>
                    </nav>
                    <div id="mobile_menu"></div>
                </div>
            </div>

            <!-- Carrito + botones (solo escritorio) -->
            <div class="col-lg-4 col-md-12 mt-3 mt-lg-0  flex-column flex-lg-row justify-content-lg-end align-items-start align-items-lg-center d-none d-lg-flex">
                <div class="home_lc me-lg-3 mb-2 mb-lg-0">
                    <a href="{{ url('cart') }}" class="hlc">
                        <i class="ti-shopping-cart-full"></i>
                        <span class="gactive">0</span>
                    </a>
                </div>
                <div class="call_to_action ">
                    <a href="{{ url('/weblogin') }}" class="btn_one me-2">Iniciar Sesión</a>
                    <a href="{{ url('/webregister') }}" class="btn_two">Registro</a>
                </div>
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
    // Cerrar menú al hacer clic en un enlace (opcional)
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
