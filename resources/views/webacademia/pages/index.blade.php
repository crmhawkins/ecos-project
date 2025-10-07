<style>
/* Hero Section moderno */
.hero-section {
    background: linear-gradient(135deg, #D93690 0%, #667eea 100%);
    padding: 120px 0 80px 0;
    color: white;
    position: relative;
    overflow: hidden;
    min-height: 100vh;
    display: flex;
    align-items: center;
}

.hero-section::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0; bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="50" cy="50" r="1" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
    opacity: 0.3;
}

.hero-content h1 {
    font-size: 4rem;
    font-weight: 800;
    margin-bottom: 20px;
    text-shadow: 0 2px 10px rgba(0,0,0,0.2);
    color: white !important;
    line-height: 1.2;
}

.hero-content p {
    font-size: 1.3rem;
    margin-bottom: 30px;
    opacity: 0.9;
    line-height: 1.6;
}

.hero-btn {
    background: rgba(255, 255, 255, 0.2);
    color: white;
    border: 2px solid rgba(255, 255, 255, 0.3);
    padding: 15px 40px;
    border-radius: 50px;
    font-weight: 600;
    font-size: 16px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    backdrop-filter: blur(10px);
}

.hero-btn:hover {
    background: rgba(255, 255, 255, 0.3);
    color: white;
    text-decoration: none;
    transform: translateY(-2px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.2);
}

.hero-image {
    position: relative;
    z-index: 2;
}

.hero-image img {
    border-radius: 20px;
    box-shadow: 0 30px 60px rgba(0,0,0,0.3);
    transition: transform 0.3s ease;
}

.hero-image:hover img {
    transform: scale(1.05);
}

/* Sección de características */
.features-section {
    padding: 100px 0;
    background: linear-gradient(135deg, #f8fafc 0%, #e9ecef 100%);
    position: relative;
}

.features-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(135deg, #D93690 0%, #ff6b9d 50%, #667eea 100%);
}

.feature-card {
    background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
    border-radius: 25px;
    padding: 50px 30px;
    text-align: center;
    box-shadow: 0 15px 35px rgba(0,0,0,0.08);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    margin-bottom: 30px;
    border: 1px solid rgba(217, 54, 144, 0.1);
    height: 100%;
    position: relative;
    overflow: hidden;
    backdrop-filter: blur(10px);
}

.feature-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(135deg, #D93690 0%, #667eea 100%);
    border-radius: 25px 25px 0 0;
}

.feature-card:hover {
    transform: translateY(-12px);
    box-shadow: 0 25px 50px rgba(217, 54, 144, 0.2);
    border-color: rgba(217, 54, 144, 0.2);
}

.feature-icon {
    width: 90px;
    height: 90px;
    background: linear-gradient(135deg, #D93690 0%, #667eea 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 30px;
    color: white;
    font-size: 35px;
    box-shadow: 0 10px 25px rgba(217, 54, 144, 0.3);
    transition: all 0.3s ease;
}

.feature-card:hover .feature-icon {
    transform: scale(1.1);
    box-shadow: 0 15px 35px rgba(217, 54, 144, 0.4);
}

.feature-card h3 {
    color: #D93690;
    font-weight: 700;
    margin-bottom: 20px;
    font-size: 1.4rem;
    line-height: 1.3;
}

.feature-card p {
    color: #666;
    line-height: 1.7;
    margin-bottom: 25px;
    font-size: 0.95rem;
}

.feature-link {
    color: #D93690;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.feature-link:hover {
    color: #ff6b9d;
    text-decoration: none;
    transform: translateX(5px);
}

/* Sección About */
.about-section {
    padding: 100px 0;
    background: white;
}

.about-content h2 {
    color: #D93690;
    font-weight: 700;
    margin-bottom: 30px;
    font-size: 2.5rem;
    position: relative;
}

.about-content h2::after {
    content: '';
    position: absolute;
    bottom: -10px;
    left: 0;
    width: 60px;
    height: 3px;
    background: linear-gradient(90deg, #D93690, #667eea);
    border-radius: 2px;
}

.about-content h2 span {
    color: #667eea;
}

.about-content p {
    color: #666;
    line-height: 1.8;
    margin-bottom: 25px;
    font-size: 1.1rem;
}

.about-image {
    position: relative;
    overflow: hidden;
    border-radius: 20px;
    box-shadow: 0 20px 40px rgba(217, 54, 144, 0.2);
}

.about-image img {
    transition: transform 0.3s ease;
    width: 100%;
    height: auto;
    border-radius: 20px;
}

.about-image:hover img {
    transform: scale(1.05);
}

.mission-vision {
    background: linear-gradient(135deg, #f8fafc 0%, #e9ecef 100%);
    padding: 40px 30px;
    border-radius: 15px;
    margin: 30px 0;
    border-left: 4px solid #D93690;
}

.mission-vision h4 {
    color: #D93690;
    font-weight: 700;
    margin-bottom: 15px;
    font-size: 1.3rem;
}

.mission-vision p {
    color: #666;
    line-height: 1.7;
    margin: 0;
}

.about-btn {
    background: linear-gradient(135deg, #D93690 0%, #667eea 100%);
    color: white;
    border: none;
    padding: 15px 40px;
    border-radius: 25px;
    font-weight: 600;
    font-size: 16px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-block;
}

.about-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 20px rgba(217, 54, 144, 0.3);
    color: white;
    text-decoration: none;
}

/* Sección Why Choose Us */
.why-choose-section {
    padding: 100px 0;
    background: linear-gradient(135deg, #D93690 0%, #667eea 100%);
    color: white;
    position: relative;
    overflow: hidden;
}

.why-choose-section::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0; bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="dots" width="20" height="20" patternUnits="userSpaceOnUse"><circle cx="10" cy="10" r="1" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23dots)"/></svg>');
    opacity: 0.3;
}

.why-choose-section h2 {
    color: white;
    font-weight: 700;
    margin-bottom: 20px;
    font-size: 2.5rem;
    text-align: center;
}

.why-choose-section .subtitle {
    color: rgba(255, 255, 255, 0.9);
    font-size: 1.2rem;
    text-align: center;
    margin-bottom: 60px;
}

.why-card {
    background: rgba(255, 255, 255, 0.1);
    border-radius: 20px;
    padding: 40px 30px;
    text-align: center;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    transition: all 0.3s ease;
    height: 100%;
    margin-bottom: 30px;
}

.why-card:hover {
    background: rgba(255, 255, 255, 0.2);
    transform: translateY(-5px);
}

.why-icon {
    width: 80px;
    height: 80px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 25px;
    color: white;
    font-size: 30px;
    border: 2px solid rgba(255, 255, 255, 0.3);
}

.why-card h3 {
    color: white;
    font-weight: 700;
    margin-bottom: 20px;
    font-size: 1.3rem;
}

.why-card p {
    color: rgba(255, 255, 255, 0.9);
    line-height: 1.7;
    margin: 0;
}

/* Responsive */
@media (max-width: 768px) {
    .hero-section { padding: 80px 0 60px 0; min-height: auto; }
    .hero-content h1 { font-size: 2.5rem; }
    .features-section { padding: 80px 0; }
    .about-section { padding: 80px 0; }
    .why-choose-section { padding: 80px 0; }
    .feature-card { padding: 30px 20px; }
    .why-card { padding: 30px 20px; }
}

/* Animaciones */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.feature-card, .why-card {
    animation: fadeInUp 0.6s ease-out;
    animation-fill-mode: both;
}

.feature-card:nth-child(1) { animation-delay: 0.1s; }
.feature-card:nth-child(2) { animation-delay: 0.2s; }
.feature-card:nth-child(3) { animation-delay: 0.3s; }
.feature-card:nth-child(4) { animation-delay: 0.4s; }
.feature-card:nth-child(5) { animation-delay: 0.5s; }
.feature-card:nth-child(6) { animation-delay: 0.6s; }
</style>

<!-- HERO SECTION -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="hero-content">
                    <h1>Impulsa tu <span style="color: #FFD700;">Futuro</span></h1>
                    <p>Descubre cursos diseñados para llevarte al próximo nivel profesional. Más de 28 años formando profesionales.</p>
                    <a href="/course" class="hero-btn">
                        <span>Nuestros Cursos</span>
                        <svg width="13px" height="10px" viewBox="0 0 13 10">
                            <path d="M1,5 L11,5"></path>
                            <polyline points="8 1 12 5 8 9"></polyline>
                        </svg>
                    </a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="hero-image">
                    <img src="/assets/images/all-img/home-image.png" alt="Formación Profesional" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CARACTERÍSTICAS PRINCIPALES -->
<section class="features-section">
    <div class="container">
        <!-- Primera fila -->
        <div class="row justify-content-center mb-4">
            <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-laptop"></i>
                    </div>
                    <h3>Campus Virtual</h3>
                    <p>Accede a tu formación desde cualquier lugar con nuestra plataforma online.</p>
                    <a href="#" class="feature-link">
                        <span>Ver más</span>
                        <svg width="13px" height="10px" viewBox="0 0 13 10">
                            <path d="M1,5 L11,5"></path>
                            <polyline points="8 1 12 5 8 9"></polyline>
                        </svg>
                    </a>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <h3>Formación Continua</h3>
                    <p>Programas actualizados para mantenerte al día con las últimas tendencias.</p>
                    <a href="#" class="feature-link">
                        <span>Ver más</span>
                        <svg width="13px" height="10px" viewBox="0 0 13 10">
                            <path d="M1,5 L11,5"></path>
                            <polyline points="8 1 12 5 8 9"></polyline>
                        </svg>
                    </a>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-book"></i>
                    </div>
                    <h3>Oposiciones</h3>
                    <p>Preparación especializada para superar con éxito tus oposiciones.</p>
                    <a href="#" class="feature-link">
                        <span>Ver más</span>
                        <svg width="13px" height="10px" viewBox="0 0 13 10">
                            <path d="M1,5 L11,5"></path>
                            <polyline points="8 1 12 5 8 9"></polyline>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Segunda fila -->
        <div class="row justify-content-center">
            <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-certificate"></i>
                    </div>
                    <h3>Certificados de Profesionalidad</h3>
                    <p>Obtén certificaciones oficiales que acrediten tu formación profesional.</p>
                    <a href="#" class="feature-link">
                        <span>Ver más</span>
                        <svg width="13px" height="10px" viewBox="0 0 13 10">
                            <path d="M1,5 L11,5"></path>
                            <polyline points="8 1 12 5 8 9"></polyline>
                        </svg>
                    </a>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3>Seguridad Privada</h3>
                    <p>Formación especializada en seguridad y vigilancia privada.</p>
                    <a href="#" class="feature-link">
                        <span>Ver más</span>
                        <svg width="13px" height="10px" viewBox="0 0 13 10">
                            <path d="M1,5 L11,5"></path>
                            <polyline points="8 1 12 5 8 9"></polyline>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SECCIÓN ABOUT -->
<section class="about-section">
    <div class="container">
        <div class="row" style="min-height: 500px;">
            <div class="col-lg-6" style="display: flex; align-items: stretch; padding-right: 30px;">
                <div class="about-image" style="width: 100%; height: 100%; min-height: 500px; overflow: hidden; border-radius: 20px; box-shadow: 0 20px 40px rgba(217, 54, 144, 0.2);">
                    <img src="/assets/images/all-img/about1.png" alt="Grupo ECOS" style="width: 100%; height: 100%; min-height: 500px; object-fit: cover; border-radius: 20px;">
                </div>
            </div>
            <div class="col-lg-6" style="padding-left: 30px;">
                <div class="about-content">
                    <h2><span>Impulsa tu futuro</span> con formación de calidad</h2>
                    <p>En Grupo ECOS llevamos más de 28 años ayudando a personas como tú a alcanzar sus metas personales y profesionales a través de la formación. Con sedes en Ceuta, Estepona y Melilla, ofrecemos un amplio abanico de programas educativos adaptados a las demandas actuales del mercado laboral.</p>
                    
                    <div class="mission-vision">
                        <h4><i class="fas fa-medal" style="color: #D93690; margin-right: 10px;"></i>Nuestra Misión</h4>
                        <p>Impulsar el desarrollo profesional y personal mediante una formación accesible, actualizada y alineada con las necesidades del mundo laboral.</p>
                    </div>
                    
                    <div class="mission-vision">
                        <h4><i class="fas fa-eye" style="color: #D93690; margin-right: 10px;"></i>Nuestra Visión</h4>
                        <p>Ser referentes en formación para el empleo, contribuyendo al crecimiento de la sociedad a través del aprendizaje constante y la mejora continua.</p>
                    </div>
                    
                    <a href="/web/about" class="about-btn">Conócenos más</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ¿POR QUÉ ELEGIR ECOS? -->
<section class="why-choose-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center mb-5">
                <h2>¿Por qué elegir ECOS?</h2>
                <p class="subtitle">Descubre las mejores cualidades de ECOS</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="why-card">
                    <div class="why-icon">
                        <i class="fas fa-book"></i>
                    </div>
                    <h3>Aprende desde cualquier lugar</h3>
                    <p>Accede a nuestra formación de calidad sin importar dónde te encuentres, con recursos adaptados a tu ritmo y necesidades.</p>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="why-card">
                    <div class="why-icon">
                        <i class="fas fa-heart"></i>
                    </div>
                    <h3>Instructores expertos</h3>
                    <p>Contamos con un equipo de profesionales altamente cualificados, dispuestos a guiarte en cada paso de tu formación.</p>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="why-card">
                    <div class="why-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3>Gestión eficiente del equipo</h3>
                    <p>Una organización estructurada que garantiza la mejor experiencia de aprendizaje, con coordinación y apoyo constante.</p>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="why-card">
                    <div class="why-icon">
                        <i class="fas fa-eye"></i>
                    </div>
                    <h3>Planificación de cursos</h3>
                    <p>Diseñamos programas de estudio adaptados a las necesidades del mercado y las expectativas de nuestros alumnos.</p>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="why-card">
                    <div class="why-icon">
                        <i class="fas fa-lightbulb"></i>
                    </div>
                    <h3>Seguimiento docente</h3>
                    <p>Monitoreamos el desempeño de nuestros profesores para garantizar la mejor calidad educativa y la satisfacción de los estudiantes.</p>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="why-card">
                    <div class="why-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <h3>Soporte 24/7</h3>
                    <p>Atención constante para resolver tus dudas y acompañarte en cada etapa de tu formación.</p>
                </div>
            </div>
        </div>
    </div>
</section>