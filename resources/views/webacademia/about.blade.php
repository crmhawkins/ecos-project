@extends('webacademia.layouts.web_layout')

@section('title', 'About')

@section('css')
<style>
    .container-fluid {
    display: flex;
    flex-wrap: wrap;
    align-items: stretch;
}

.col-lg-3-p {
    flex: 1 1 25%; /* Asegura que cada caja toma exactamente el 25% del espacio y se ajusta según la pantalla */
    display: flex;
    padding: 0;
}

.single_tp {
    display: flex;
    flex-direction: column;
    justify-content: space-between; /* Espaciado interno para alinear los elementos internos desde el principio hasta el final */
    width: 100%;
}
</style>
@endsection

@section('content')

	<!-- START SECTION TOP -->
	<section class="section-top">
		<div class="container">
			<div class="col-lg-10 offset-lg-1 text-center">
				<div class="section-top-title wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.3s" data-wow-offset="0">
					<h1>Quiénes somos</h1>
					<ul>
						<li><a href="index">Home</a></li>
						<li> / About</li>
					</ul>
				</div><!-- //.HERO-TEXT -->
			</div><!--- END COL -->
		</div><!--- END CONTAINER -->
	</section>
	<!-- END SECTION TOP -->

    	<!-- START ABOUT US HOME ONE -->
	<section class="ab_one section-padding">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-sm-12 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s" data-wow-offset="0">
					<div class="ab_img">
						<img src="assets/images/all-img/about2.png" class="img-fluid" style="max-height: 1084px;" alt="image">
					</div>
				</div><!--- ENAD COL -->
				<div class="col-lg-6 col-sm-12 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s" data-wow-offset="0">
					<div class="ab_content">
                        <h4>Historia completa</h4>
						<h2><span>Grupo</span> E<span>COS</span></h2>
						<p>GRUPO ECOS nace en mayo de 1996, fruto de las inquietudes de profesionales de la enseñanza, dedicándose desde entonces al sector de la formación para todo tipo de clientes potenciales: desde personas desempleados, trabajadores en activo, pymes, etc.). Su ámbito de actuación se divide entre la Ciudad Autónoma de Ceuta (Sede Central), la Ciudad de Estepona (Málaga) y la Ciudad de Melilla, disponiendo de una amplia plantilla conformada por personal técnico de dilatada experiencia.</p>
						<p>La sede central está situada en Poblado Marinero, balcón del Voraz nº 25, 44, 46 y 47 (Ceuta), en Estepona, se localiza en Calle Las Camelias nº2b (junto a la Policía Local) y en Melilla, se localiza en Calle Comandante García Morato, 17. Nuestras tres sedes disponen de medidas de accesibilidad universal.</p>
                        <p>Desde hace más de 15 años es Entidad Organizadora de Formación Programada/Bonificada ante la Fundación Estatal para la Formación en el Empleo, estando igualmente registrada y acreditada ante el Servicio Público de Empleo Estatal y la Consejería Junta de Andalucía para la impartición de Certificados de Profesionalidad y Programas Formativos.</p>

					</div>
				</div><!--- END COL -->
			</div><!--- END ROW -->
		</div><!--- END CONTAINER -->
	</section>

	<!-- START TOP PROMO FEATURES -->
	<section class="tp_feature">
	   <div class="container-fluid">
			<div class="row">
				<div class="col-lg-3-p col-sm-3 col-xs-12 no-padding wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s" data-wow-offset="0">
					<div class="single_tp">
						<h3>Excelencia </h3>
						<p>Desde Grupo ECOS, apostamos por la excelencia de una formación para que se puedan recoger los frutos de un buen trabajo aportado por la simbiosis entre el profesor y sus alumnos.</p>
						{{-- <a href="#" class="cta"><span>Explore</span>
						  <svg width="13px" height="10px" viewBox="0 0 13 10">
							<path d="M1,5 L11,5"></path>
							<polyline points="8 1 12 5 8 9"></polyline>
						  </svg>
						</a> --}}
					</div>
				</div><!-- END COL -->
				<div class="col-lg-3-p col-sm-3 col-xs-12 no-padding wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.3s" data-wow-offset="0">
					<div class="single_tp">
						<h3>Compromiso</h3>
						<p>Nos comprometemos a maximizar la satisfacción y el entusiasmo de nuestros alumnos durante su formación, asegurando también que nuestros profesores se mantengan altamente motivados para ofrecer la mejor enseñanza posible.</p>
						{{-- <a href="#" class="cta"><span>Explore</span>
						  <svg width="13px" height="10px" viewBox="0 0 13 10">
							<path d="M1,5 L11,5"></path>
							<polyline points="8 1 12 5 8 9"></polyline>
						  </svg>
						</a> --}}
					</div>
				</div><!-- END COL -->
				<div class="col-lg-3-p col-sm-3 col-xs-12 no-padding wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.4s" data-wow-offset="0">
					<div class="single_tp">
						<h3>Organización</h3>
						<p>La buena organización de la entidad, con la correcta atribución de responsabilidades a cada uno de sus profesionales, nos permite ofrecer una mayor calidad de los servicios formativos, así como mayor rendimiento y satisfacción de nuestros alumnos.</p>
						{{-- <a href="#" class="cta"><span>Explore</span>
						  <svg width="13px" height="10px" viewBox="0 0 13 10">
							<path d="M1,5 L11,5"></path>
							<polyline points="8 1 12 5 8 9"></polyline>
						  </svg>
						</a> --}}
					</div>
				</div><!-- END COL -->
				<div class="col-lg-3-p col-sm-3 col-xs-12 no-padding wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.4s" data-wow-offset="0">
					<div class="single_tp">
						<h3>Superación</h3>
						<p>En Grupo ECOS, contamos con profesionales con alto afán de superación, con el objetivo de aportar lo mejor de sí mismos a todo el alumnado que confíe en nuestros servicios.</p>
						{{-- <a href="#" class="cta"><span>Explore</span>
						  <svg width="13px" height="10px" viewBox="0 0 13 10">
							<path d="M1,5 L11,5"></path>
							<polyline points="8 1 12 5 8 9"></polyline>
						  </svg>
						</a> --}}
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
                        <h2 class="mb-4"><span>Nuestro</span> Propósito</h2>
                        <p class="lead">Contribuir al desarrollo y progreso de nuestro alumnado a través de formaciones de alta calidad y gran eficiencia, con el objetivo de facilitar la inserción laboral y/o mejorar su situación profesional.</p>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s">
                    <div class="ab_img">
                        <img src="assets/images/all-img/about3.png" class="img-fluid rounded shadow-sm" alt="Propósito Ecos">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ab_one section-padding bg-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s">
                    <div class="ab_img">
                        <img src="assets/images/all-img/about4.png" class="img-fluid rounded shadow-sm" alt="Visión Ecos">
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s">
                    <div class="ab_content ps-lg-5">
                        <h2 class="mb-4">Nuestra <span>Visión</span></h2>
                        <p class="mb-3">Nuestra visión se enfoca en ofrecer acciones formativas competentes y alineadas con las necesidades reales de quienes desean formarse, así como del mercado laboral actual.</p>
                        <p class="mb-3">Formarse es sinónimo de actualizarse y evolucionar profesionalmente. Apostar por la formación significa ampliar horizontes, mejorar condiciones laborales y alcanzar una mejor calidad de vida.</p>
                        <p>En Grupo ECOS nos comprometemos, con más de 28 años de experiencia, a aportar nuestro saber-hacer para hacer crecer a quienes confían en nosotros.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ab_one section-padding">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s">
                    <div class="ab_content pe-lg-5">
                        <h2 class="mb-4"><span>Misión</span></h2>
                        <p class="lead">Optimizar la formación de nuestros/as alumnos/as, aportándoles nuevos conocimientos, experiencia práctica y habilidades profesionales que les permitan acceder a un empleo, promocionar o ampliar sus oportunidades laborales.</p>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s">
                    <div class="ab_img">
                        <img src="assets/images/all-img/about5.png" class="img-fluid rounded shadow-sm" alt="Misión Ecos">
                    </div>
                </div>
            </div>
        </div>
    </section>

	<!-- END ABOUT US HOME ONE -->

	<!-- START WHY CHOOSE US-->
	{{-- <section class="marketing_content_area section-padding">
	   <div class="container">
			<div class="section-title">
				<h2>Por qué nosotros</h2>
				<p>encuentra las <span><u>mejores características</u></span> de Grupo ECOS.</p>
			</div>
			<div class="row">
				<div class="col-lg-4 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s" data-wow-offset="0">
					<div class="single_feature_one">
						<div class="sf_top">
							<span class="ti-book ss_one"></span>
							<h2><a href="single-service" target="_blank">Aprende más de cualquier lugar</a></h2>
						</div>
						<p></p>
					</div>
				</div><!-- END COL -->
				<div class="col-lg-4 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s" data-wow-offset="0">
					<div class="single_feature_one">
						<div class="sf_top">
							<span class="ti-heart ss_two"></span>
							<h2><a href="single-service" target="_blank">Expert <br />Instructor</a></h2>
						</div>
						<p>Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor ut labore.</p>
					</div>
				</div><!-- END COL -->
				<div class="col-lg-4 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.3s" data-wow-offset="0">
					<div class="single_feature_one">
						<div class="sf_top">
							<span class="ti-user ss_three"></span>
							<h2><a href="single-service" target="_blank">Team <br />Management</a></h2>
						</div>
						<p>Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor ut labore.</p>
					</div>
				</div><!-- END COL -->
				<div class="col-lg-4 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.4s" data-wow-offset="0">
					<div class="single_feature_one">
						<div class="sf_top">
							<span class="ti-eye ss_four"></span>
							<h2><a href="single-service" target="_blank">Course <br /> Planing</a></h2>
						</div>
						<p>Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor ut labore.</p>
					</div>
				</div><!-- END COL -->
				<div class="col-lg-4 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.5s" data-wow-offset="0">
					<div class="single_feature_one">
						<div class="sf_top">
							<span class="ti-light-bulb ss_five"></span>
							<h2><a href="single-service" target="_blank">Teacher Monitoring</a></h2>
						</div>
						<p>Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor ut labore.</p>
					</div>
				</div><!-- END COL -->
				<div class="col-lg-4 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.6s" data-wow-offset="0">
					<div class="single_feature_one">
						<div class="sf_top">
							<span class="ti-email ss_six"></span>
							<h2><a href="single-service" target="_blank">24/7 Strong Support</a></h2>
						</div>
						<p>Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor ut labore.</p>
					</div>
				</div><!-- END COL -->
			</div><!-- END ROW -->
		</div><!-- END CONTAINER -->
	</section> --}}
	<!-- END WHY CHOOSE US -->

	<!-- START COUNTER -->
    {{-- <section id="counts" class="counts section-padding">
      <div class="container" data-aos="fade-up">
		<div class="section-title">
		  <h2>Some Fun Fact</h2>
		  <p>Our Great <span><u>Achievement</u></span></p>
		</div>
        <div class="row gy-4">
          <div class="col-lg-3 col-md-6">
            <div class="count-box">
              <i class="ti-face-smile"></i>
              <div>
                <span data-purecounter-start="0" data-purecounter-end="8232" data-purecounter-duration="1" class="purecounter"></span>
                <p>Enrolled Students</p>
              </div>
            </div>
          </div><!--- END COL -->
          <div class="col-lg-3 col-md-6">
            <div class="count-box">
              <i class="ti-files" style="color: #ee6c20;"></i>
              <div>
                <span data-purecounter-start="0" data-purecounter-end="521" data-purecounter-duration="1" class="purecounter"></span>
                <p>Academic Programs</p>
              </div>
            </div>
          </div><!--- END COL -->
          <div class="col-lg-3 col-md-6">
            <div class="count-box">
              <i class="ti-headphone-alt" style="color: #15be56;"></i>
              <div>
                <span data-purecounter-start="0" data-purecounter-end="163" data-purecounter-duration="1" class="purecounter"></span>
                <p>Winning Award</p>
              </div>
            </div>
          </div><!--- END COL -->
          <div class="col-lg-3 col-md-6">
            <div class="count-box">
              <i class="ti-user" style="color: #bb0852;"></i>
              <div>
                <span data-purecounter-start="0" data-purecounter-end="93" data-purecounter-duration="1" class="purecounter"></span>
                <p>Certified Students</p>
              </div>
            </div>
          </div><!--- END COL -->
        </div><!--- END ROW -->
      </div><!--- END CONTAINER -->
    </section> --}}
	<!-- END COUNTER -->

	<!-- START TEAM-->
	{{-- <section class="team_member section-padding">
	   <div class="container">
			<div class="section-title">
				<h2>Team Member</h2>
				<p>Our Expert <span><u>Instructors</u></span></p>
			</div>
			<div class="row text-center">
				<div class="col-md-3 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s" data-wow-offset="0">
					<div class="our-team">
						<div class="team_img">
							<img src="assets/images/all-img/team5.png" alt="team-image">
							<ul class="social">
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
								<li><a href="#"><i class="fa fa-instagram"></i></a></li>
							</ul>
						</div>
						<div class="team-content">
							<h3 class="title">Stephen Cronin</h3>
							<span class="post">Designer</span>
							<div class="sth_det2">
								<span class="ti-file"> <u>5 Course</u></span>
								<span class="ti-user"> <u>12 Student</u></span>
							</div>
						</div>
					</div>
				</div><!--- END COL -->
				<div class="col-md-3 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s" data-wow-offset="0">
					<div class="our-team">
						<div class="team_img">
							<img src="assets/images/all-img/team6.png" alt="team-image">
							<ul class="social">
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
								<li><a href="#"><i class="fa fa-instagram"></i></a></li>
							</ul>
						</div>
						<div class="team-content">
							<h3 class="title">Rachel Park</h3>
							<span class="post">Developer</span>
							<div class="sth_det2">
								<span class="ti-file"> <u>5 Course</u></span>
								<span class="ti-user"> <u>12 Student</u></span>
							</div>
						</div>
					</div>
				</div><!--- END COL -->
				<div class="col-md-3 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.3s" data-wow-offset="0">
					<div class="our-team">
						<div class="team_img">
							<img src="assets/images/all-img/team7.png" alt="team-image">
							<ul class="social">
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
								<li><a href="#"><i class="fa fa-instagram"></i></a></li>
							</ul>
						</div>
						<div class="team-content">
							<h3 class="title">Dan Billson</h3>
							<span class="post">Marketer</span>
							<div class="sth_det2">
								<span class="ti-file"> <u>5 Course</u></span>
								<span class="ti-user"> <u>12 Student</u></span>
							</div>
						</div>
					</div>
				</div><!--- END COL -->
				<div class="col-md-3 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.4s" data-wow-offset="0">
					<div class="our-team">
						<div class="team_img">
							<img src="assets/images/all-img/team8.png" alt="team-image">
							<ul class="social">
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
								<li><a href="#"><i class="fa fa-instagram"></i></a></li>
							</ul>
						</div>
						<div class="team-content">
							<h3 class="title">Gina Mellow</h3>
							<span class="post">Co-founder</span>
							<div class="sth_det2">
								<span class="ti-file"> <u>5 Course</u></span>
								<span class="ti-user"> <u>12 Student</u></span>
							</div>
						</div>
					</div>
				</div><!--- END COL -->
				<div class="col-md-3 col-sm-6 col-xs-12">
				</div><!--- END COL -->
				<div class="col-md-3 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.5s" data-wow-offset="0">
					<div class="our-team">
						<div class="team_img">
							<img src="assets/images/all-img/team9.png" alt="team-image">
							<ul class="social">
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
								<li><a href="#"><i class="fa fa-instagram"></i></a></li>
							</ul>
						</div>
						<div class="team-content">
							<h3 class="title">John Stuart</h3>
							<span class="post">Graphics Expert</span>
							<div class="sth_det2">
								<span class="ti-file"> <u>5 Course</u></span>
								<span class="ti-user"> <u>12 Student</u></span>
							</div>
						</div>
					</div>
				</div><!--- END COL -->
				<div class="col-md-3 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.6s" data-wow-offset="0">
					<div class="our-team">
						<div class="team_img">
							<img src="assets/images/all-img/team10.png" alt="team-image">
							<ul class="social">
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
								<li><a href="#"><i class="fa fa-instagram"></i></a></li>
							</ul>
						</div>
						<div class="team-content">
							<h3 class="title">Maikel Clark</h3>
							<span class="post">Animator</span>
							<div class="sth_det2">
								<span class="ti-file"> <u>5 Course</u></span>
								<span class="ti-user"> <u>12 Student</u></span>
							</div>
						</div>
					</div>
				</div><!--- END COL -->
			</div><!-- END ROW -->
		</div><!-- END CONTAINER -->
	</section> --}}
	<!-- END TEAM -->

	<!-- START FAQ -->
	{{-- <section class="faq_area section-padding">
		<div class="container">
			<div class="section-title">
				<h2>Frequently Asked Question</h2>
				<p>General <span><u>Questions</u></span></p>
			</div>
			<div class="row justify-content-center">
				<div class="col-lg-6 col-sm-6 col-xs-12">
					<div class="accordion" id="accordionExample">
					  <div class="accordion-item">
						<h2 class="accordion-header" id="headingOne">
						  <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
							What does it take excellent author?
						  </button>
						</h2>
						<div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
						  <div class="accordion-body">
							Great value and so easy to use and saves me so much time! I was shocked by how much time and brain energy it saved me. Simple & easy gotta love that. Great value and so easy to use.
						  </div>
						</div>
					  </div><!-- END ACCORDION ITEM  -->
					  <div class="accordion-item">
						<h2 class="accordion-header" id="headingTwo">
						  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
							Who will view my content?
						  </button>
						</h2>
						<div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
						  <div class="accordion-body">
							Great value and so easy to use and saves me so much time! I was shocked by how much time and brain energy it saved me. Simple & easy gotta love that. Great value and so easy to use.
						  </div>
						</div>
					  </div><!-- END ACCORDION ITEM  -->
					  <div class="accordion-item">
						<h2 class="accordion-header" id="headingThree">
						  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
							What does it take become an author?
						  </button>
						</h2>
						<div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
						  <div class="accordion-body">
							Great value and so easy to use and saves me so much time! I was shocked by how much time and brain energy it saved me. Simple & easy gotta love that. Great value and so easy to use.
						  </div>
						</div>
					  </div><!-- END ACCORDION ITEM  -->
					  <div class="accordion-item">
						<h2 class="accordion-header" id="headingFour">
						  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
							How to Change my Password easily?
						  </button>
						</h2>
						<div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
						  <div class="accordion-body">
							Great value and so easy to use and saves me so much time! I was shocked by how much time and brain energy it saved me. Simple & easy gotta love that. Great value and so easy to use.
						  </div>
						</div>
					  </div><!-- END ACCORDION ITEM  -->
					  <div class="accordion-item">
						<h2 class="accordion-header" id="headingFive">
						  <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
							How does it create content?
						  </button>
						</h2>
						<div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
						  <div class="accordion-body">
							Great value and so easy to use and saves me so much time! I was shocked by how much time and brain energy it saved me. Simple & easy gotta love that. Great value and so easy to use.
						  </div>
						</div>
					  </div><!-- END ACCORDION ITEM  -->
					</div>
				</div><!-- END COL  -->
				<div class="col-lg-6 col-sm-6 col-xs-12">
					<div class="pt_faq">
						<img src="assets/images/all-img/faq.png" class="img-fluid" alt="image" />
					</div>
				</div><!-- END COL  -->
			</div><!--END  ROW  -->
		</div><!--- END CONTAINER -->
	</section> --}}
	<!-- END FAQ -->

	<!-- START COMPANY PARTNER LOGO  -->
	{{-- <div class="partner-logo section-padding">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 text-center">
					<div class="partner_title">
						<h3>Trusted Company Arround The World! </h3>
					</div>
					<div class="partner">
						<a href="#"><img src="assets/images/all-img/clients/1.png" alt="image"></a>
						<a href="#"><img src="assets/images/all-img/clients/2.png" alt="image"></a>
						<a href="#"><img src="assets/images/all-img/clients/3.png" alt="image"></a>
						<a href="#"><img src="assets/images/all-img/clients/4.png" alt="image"></a>
						<a href="#"><img src="assets/images/all-img/clients/5.png" alt="image"></a>
						<a href="#"><img src="assets/images/all-img/clients/2.png" alt="image"></a>
						<a href="#"><img src="assets/images/all-img/clients/1.png" alt="image"></a>
						<a href="#"><img src="assets/images/all-img/clients/3.png" alt="image"></a>
						<a href="#"><img src="assets/images/all-img/clients/4.png" alt="image"></a>
					</div>
				</div><!-- END COL  -->
			</div><!--END  ROW  -->
		</div><!-- END CONTAINER  -->
	</div> --}}
	<!-- END COMPANY PARTNER LOGO -->

@endsection
