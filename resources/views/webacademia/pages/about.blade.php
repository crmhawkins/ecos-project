<style>
/* Hero de About con estilo del Blog */
.about-hero {
    background: linear-gradient(135deg, #D93690 0%, #667eea 100%);
    padding: 80px 0 40px 0;
    color: white;
    position: relative;
    overflow: hidden;
}

.about-hero::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0; bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="50" cy="50" r="1" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
    opacity: 0.3;
}

.about-hero h1 {
    font-size: 48px;
    font-weight: 800;
    margin-bottom: 15px;
    text-shadow: 0 2px 10px rgba(0,0,0,0.2);
    color: white !important;
}

.about-hero .breadcrumb {
    background: rgba(255,255,255,0.1);
    border-radius: 25px;
    padding: 10px 20px;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255,255,255,0.2);
    display: inline-flex;
    align-items: center;
    gap: 8px;
    margin-top: 15px;
}

.about-hero .breadcrumb a { color: white; text-decoration: none; font-weight: 500; transition: all 0.3s ease; }
.about-hero .breadcrumb a:hover { color: #ff6b9d; }
.about-hero .breadcrumb span { color: rgba(255,255,255,0.8); }

@media (max-width: 768px) {
  .about-hero { padding: 60px 0 30px 0; }
  .about-hero h1 { font-size: 32px; }
}
</style>

<!-- HERO SECTION (estilo blog) -->
<section class="about-hero">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h1>Quiénes Somos</h1>
                <p>Conoce nuestra historia, misión, visión y valores</p>
                <div class="breadcrumb">
                    <a href="/"><i class="fas fa-home"></i> Inicio</a>
                    <span>/</span>
                    <span>Quiénes Somos</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- START ABOUT US HOME ONE -->
<section class="ab_one section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-sm-12 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s" data-wow-offset="0">
                <div class="ab_img" style="width: 100%; height: 100%; overflow: hidden; border-radius: 15px; display: block;">
                    <img src="/assets/images/all-img/about2.png" class="img-fluid" style="width: 100%; height: 100%; object-fit: cover; border-radius: 15px; box-shadow: 0 20px 40px rgba(217, 54, 144, 0.2); display: block;" alt="image">
                </div>
            </div><!--- ENAD COL -->
            <div class="col-lg-6 col-sm-12 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s" data-wow-offset="0">
                <div class="ab_content">
                    <h4 style="color: #D93690; font-weight: 700; margin-bottom: 1.5rem;">Historia completa</h4>
                    <h2 style="color: #333; font-size: 2.5rem; font-weight: 700; margin-bottom: 1.5rem;"><span style="color: #333;">Grupo</span> <span style="color: #D93690;">ECOS</span></h2>
                    <p style="color: #666; line-height: 1.8; margin-bottom: 1.5rem;">GRUPO ECOS nace en mayo de 1996, fruto de las inquietudes de profesionales de la enseñanza, dedicándose desde entonces al sector de la formación para todo tipo de clientes potenciales: desde personas desempleados, trabajadores en activo, pymes, etc.). Su ámbito de actuación se divide entre la Ciudad Autónoma de Ceuta (Sede Central), la Ciudad de Estepona (Málaga) y la Ciudad de Melilla, disponiendo de una amplia plantilla conformada por personal técnico de dilatada experiencia.</p>
                    <p style="color: #666; line-height: 1.8; margin-bottom: 1.5rem;">La sede central está situada en Poblado Marinero, balcón del Voraz nº 25, 44, 46 y 47 (Ceuta), en Estepona, se localiza en Calle Las Camelias nº2b (junto a la Policía Local) y en Melilla, se localiza en Calle Comandante García Morato, 17. Nuestras tres sedes disponen de medidas de accesibilidad universal.</p>
                    <p style="color: #666; line-height: 1.8; margin-bottom: 1.5rem;">Desde hace más de 15 años es Entidad Organizadora de Formación Programada/Bonificada ante la Fundación Estatal para la Formación en el Empleo, estando igualmente registrada y acreditada ante el Servicio Público de Empleo Estatal y la Consejería Junta de Andalucía para la impartición de Certificados de Profesionalidad y Programas Formativos.</p>
                </div>
            </div><!--- END COL -->
        </div><!--- END ROW -->
    </div><!--- END CONTAINER -->
</section>

<!-- START TOP PROMO FEATURES -->
<section class="tp_feature" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); padding: 80px 0;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-sm-3 col-xs-12 no-padding wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s" data-wow-offset="0">
                <div class="single_tp" style="background: white; padding: 40px 30px; border-radius: 15px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1); transition: all 0.3s ease; height: 100%; position: relative; overflow: hidden; margin: 15px;">
                    <div style="position: absolute; top: 0; left: 0; right: 0; height: 4px; background: #D93690;"></div>
                    <h3 style="color: #D93690; font-weight: 700; margin-bottom: 20px; font-size: 1.5rem;">Excelencia</h3>
                    <p style="color: #666; line-height: 1.7; margin: 0;">Desde Grupo ECOS, apostamos por la excelencia de una formación para que se puedan recoger los frutos de un buen trabajo aportado por la simbiosis entre el profesor y sus alumnos.</p>
                </div>
            </div><!-- END COL -->
            <div class="col-lg-3 col-sm-3 col-xs-12 no-padding wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.3s" data-wow-offset="0">
                <div class="single_tp" style="background: white; padding: 40px 30px; border-radius: 15px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1); transition: all 0.3s ease; height: 100%; position: relative; overflow: hidden; margin: 15px;">
                    <div style="position: absolute; top: 0; left: 0; right: 0; height: 4px; background: #D93690;"></div>
                    <h3 style="color: #D93690; font-weight: 700; margin-bottom: 20px; font-size: 1.5rem;">Compromiso</h3>
                    <p style="color: #666; line-height: 1.7; margin: 0;">Nos comprometemos a maximizar la satisfacción y el entusiasmo de nuestros alumnos durante su formación, asegurando también que nuestros profesores se mantengan altamente motivados para ofrecer la mejor enseñanza posible.</p>
                </div>
            </div><!-- END COL -->
            <div class="col-lg-3 col-sm-3 col-xs-12 no-padding wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.4s" data-wow-offset="0">
                <div class="single_tp" style="background: white; padding: 40px 30px; border-radius: 15px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1); transition: all 0.3s ease; height: 100%; position: relative; overflow: hidden; margin: 15px;">
                    <div style="position: absolute; top: 0; left: 0; right: 0; height: 4px; background: #D93690;"></div>
                    <h3 style="color: #D93690; font-weight: 700; margin-bottom: 20px; font-size: 1.5rem;">Organización</h3>
                    <p style="color: #666; line-height: 1.7; margin: 0;">La buena organización de la entidad, con la correcta atribución de responsabilidades a cada uno de sus profesionales, nos permite ofrecer una mayor calidad de los servicios formativos, así como mayor rendimiento y satisfacción de nuestros alumnos.</p>
                </div>
            </div><!-- END COL -->
            <div class="col-lg-3 col-sm-3 col-xs-12 no-padding wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.4s" data-wow-offset="0">
                <div class="single_tp" style="background: white; padding: 40px 30px; border-radius: 15px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1); transition: all 0.3s ease; height: 100%; position: relative; overflow: hidden; margin: 15px;">
                    <div style="position: absolute; top: 0; left: 0; right: 0; height: 4px; background: #D93690;"></div>
                    <h3 style="color: #D93690; font-weight: 700; margin-bottom: 20px; font-size: 1.5rem;">Superación</h3>
                    <p style="color: #666; line-height: 1.7; margin: 0;">En Grupo ECOS, contamos con profesionales con alto afán de superación, con el objetivo de aportar lo mejor de sí mismos a todo el alumnado que confíe en nuestros servicios.</p>
                </div>
            </div><!-- END COL -->
        </div><!-- END ROW -->
    </div><!-- END CONTAINER -->
</section>
<!-- END TOP PROMO FEATURES -->

<!-- END ABOUT US HOME ONE -->
<section class="ab_one section-padding">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s">
                <div class="ab_content pe-lg-5">
                    <h2 class="mb-4" style="color: #D93690; font-weight: 700; margin-bottom: 1.5rem; position: relative;"><span style="color: #D93690;">Nuestro</span> Propósito</h2>
                    <p class="lead" style="color: #666; line-height: 1.8; margin-bottom: 1.5rem; font-size: 1.1rem;">Contribuir al desarrollo y progreso de nuestro alumnado a través de formaciones de alta calidad y gran eficiencia, con el objetivo de facilitar la inserción laboral y/o mejorar su situación profesional.</p>
                    <p style="color: #666; line-height: 1.8; margin-bottom: 1.5rem;">Formarse es sinónimo de actualizarse y evolucionar profesionalmente. Apostar por la formación significa ampliar horizontes, mejorar condiciones laborales y alcanzar una mejor calidad de vida.</p>
                </div>
            </div>
            <div class="col-lg-6 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s">
                <div class="ab_img" style="width: 100%; height: 100%; overflow: hidden; border-radius: 15px; display: block;">
                    <img src="/assets/images/all-img/about3.png" class="img-fluid" alt="Propósito Ecos" style="width: 100%; height: 100%; object-fit: cover; border-radius: 15px; box-shadow: 0 20px 40px rgba(217, 54, 144, 0.2); display: block;">
                </div>
            </div>
        </div>
    </div>
</section>

<section class="ab_one section-padding" style="background: linear-gradient(135deg, #D93690 0%, #D93690 100%); color: white;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s">
                <div class="ab_img" style="width: 100%; height: 100%; overflow: hidden; border-radius: 15px; display: block;">
                    <img src="/assets/images/all-img/about4.png" class="img-fluid" alt="Visión Ecos" style="width: 100%; height: 100%; object-fit: cover; border-radius: 15px; box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2); display: block;">
                </div>
            </div>
            <div class="col-lg-6 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s">
                <div class="ab_content ps-lg-5">
                    <h2 class="mb-4" style="color: white; font-weight: 700; margin-bottom: 1.5rem;">Nuestra <span style="color: white;">Visión</span></h2>
                    <p class="mb-3" style="color: rgba(255, 255, 255, 0.9); line-height: 1.8;">Nuestra visión se enfoca en ofrecer acciones formativas competentes y alineadas con las necesidades reales de quienes desean formarse, así como del mercado laboral actual.</p>
                    <p class="mb-3" style="color: rgba(255, 255, 255, 0.9); line-height: 1.8;">Formarse es sinónimo de actualizarse y evolucionar profesionalmente. Apostar por la formación significa ampliar horizontes, mejorar condiciones laborales y alcanzar una mejor calidad de vida.</p>
                    <p style="color: rgba(255, 255, 255, 0.9); line-height: 1.8;">En Grupo ECOS nos comprometemos, con más de 28 años de experiencia, a aportar nuestro saber-hacer para hacer crecer a quienes confían en nosotros.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="ab_one section-padding" style="background: #f8f9fa;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s">
                <div class="ab_content pe-lg-5">
                    <h2 class="mb-4" style="color: #D93690; font-weight: 700; margin-bottom: 1.5rem;"><span style="color: #D93690;">Misión</span></h2>
                    <p class="lead" style="color: #666; line-height: 1.8; margin-bottom: 1.5rem; font-size: 1.1rem;">Optimizar la formación de nuestros/as alumnos/as, aportándoles nuevos conocimientos, experiencia práctica y habilidades profesionales que les permitan acceder a un empleo, promocionar o ampliar sus oportunidades laborales.</p>
                    <p style="color: #666; line-height: 1.8; margin-bottom: 1.5rem;">Nuestro compromiso se extiende más allá de la formación teórica, proporcionando herramientas prácticas y experiencias reales que preparen a nuestros estudiantes para los desafíos del mercado laboral actual.</p>
                </div>
            </div>
            <div class="col-lg-6 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s">
                <div class="ab_img" style="width: 100%; height: 100%; overflow: hidden; border-radius: 15px; display: block;">
                    <img src="/assets/images/all-img/about5.png" class="img-fluid" alt="Misión Ecos" style="width: 100%; height: 100%; object-fit: cover; border-radius: 15px; box-shadow: 0 20px 40px rgba(217, 54, 144, 0.2); display: block;">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- STATS SECTION -->
<section class="section-padding" style="background: linear-gradient(135deg, #D93690 0%, #D93690 100%); color: white; text-align: center;">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stat-item wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s" style="padding: 20px;">
                    <span class="stat-number" style="font-size: 3rem; font-weight: 800; color: white; display: block; margin-bottom: 10px;">28+</span>
                    <span class="stat-label" style="font-size: 1.1rem; color: rgba(255, 255, 255, 0.9); font-weight: 500;">Años de Experiencia</span>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stat-item wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s" style="padding: 20px;">
                    <span class="stat-number" style="font-size: 3rem; font-weight: 800; color: white; display: block; margin-bottom: 10px;">3</span>
                    <span class="stat-label" style="font-size: 1.1rem; color: rgba(255, 255, 255, 0.9); font-weight: 500;">Sedes en España</span>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stat-item wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.3s" style="padding: 20px;">
                    <span class="stat-number" style="font-size: 3rem; font-weight: 800; color: white; display: block; margin-bottom: 10px;">1000+</span>
                    <span class="stat-label" style="font-size: 1.1rem; color: rgba(255, 255, 255, 0.9); font-weight: 500;">Estudiantes Formados</span>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stat-item wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.4s" style="padding: 20px;">
                    <span class="stat-number" style="font-size: 3rem; font-weight: 800; color: white; display: block; margin-bottom: 10px;">50+</span>
                    <span class="stat-label" style="font-size: 1.1rem; color: rgba(255, 255, 255, 0.9); font-weight: 500;">Cursos Disponibles</span>
                </div>
            </div>
        </div>
    </div>
</section>