@extends('webacademia.layouts.web_layout')

@section('title', 'Inicio')

@section('css')
<style>
    .tp_feature .container-fluid {
        display: flex;
        justify-content: center;
    }

    .tp_feature .row {
        display: flex;
        flex-wrap: wrap;
        width: 100%;
    }

    .tp_feature .col-lg-2 {
        flex: 1;
        display: flex;
        padding: 0;
        min-width: 16.66%; /* 6 columnas en fila */
    }

    .tp_feature .single_tp {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        align-items: center;
        text-align: center;
        width: 100%;
        padding: 20px;
        background: #f8f8f8; /* Ajusta el color de fondo si es necesario */
        border: 1px solid #ddd; /* Opcional, para separar visualmente */
    }

    .tp_feature .single_tp h3 {
        margin-bottom: 15px;
    }

    .tp_feature .single_tp a.cta {
        margin-top: auto;
        text-decoration: none;
        color: #007bff;
        font-weight: bold;
    }

    .tp_feature .single_tp svg {
        vertical-align: middle;
    }

    .marketing_content_area .container {
        display: flex;
        flex-direction: column;
    }

    .marketing_content_area .row {
        display: flex;
        flex-wrap: wrap;
    }

    .marketing_content_area .col-lg-4 {
        flex: 1 1 33.33%; /* Hace que cada columna tenga el mismo ancho */
        display: flex;
        padding: 15px;
    }

    .single_feature_one {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        width: 100%;
        padding: 20px;
        min-height: 200px; /* Asegura una altura mínima */
        height: 100%; /* Hace que todos ocupen la misma altura */
    }

    .sf_top {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
    }


    .single_feature_one p {
        flex-grow: 1; /* Permite que el texto crezca sin afectar la altura */
    }

    .single_feature_one a.cta {
        text-decoration: none;
        color: #007bff;
        font-weight: bold;
        margin-top: auto; /* Empuja el botón al fondo */
    }
</style>
@endsection

@section('content')
	<!-- START HOME -->
	<section  id="home" class="home_bg" style="background-image: url(assets/images/banner/home.png);  background-size:cover; background-position: center center;">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-sm-6 col-xs-12">
					<div class="home_content">
						<h1><span>I</span>mpulsa tu <span>F</span>uturo</h1>
                        <p>Descubre cursos diseñados para llevarte al próximo nivel profesional.</p>
					</div>
					<div class="home_btn">
						<a href="#" class="cta"><span>Nuestros Cursos</span>
						  <svg width="13px" height="10px" viewBox="0 0 13 10">
							<path d="M1,5 L11,5"></path>
							<polyline points="8 1 12 5 8 9"></polyline>
						  </svg>
						</a>
					</div>
				</div><!-- END COL-->
				<div class="col-lg-6 col-sm-6 col-xs-12">
					<div class="home_me_img">
						<img src="assets/images/all-img/home-image.png" class="img-fluid" alt="" />
					</div>
				</div><!-- END COL-->
			</div><!--- END ROW -->
		</div><!--- END CONTAINER -->
	</section>
	<!-- END  HOME -->

	<!-- START TOP PROMO FEATURES -->
	<section class="tp_feature">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-2 col-sm-4 col-xs-12 no-padding wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s" data-wow-offset="0">
                    <div class="single_tp">
                        <h3>Campus Virtual</h3>
                        <a href="#" class="cta"><span>Ver mas</span>
                            <svg width="13px" height="10px" viewBox="0 0 13 10">
                                <path d="M1,5 L11,5"></path>
                                <polyline points="8 1 12 5 8 9"></polyline>
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="col-lg-2 col-sm-4 col-xs-12 no-padding wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.3s" data-wow-offset="0">
                    <div class="single_tp">
                        <h3>Formación Continua</h3>
                        <a href="#" class="cta"><span>Ver mas</span>
                            <svg width="13px" height="10px" viewBox="0 0 13 10">
                                <path d="M1,5 L11,5"></path>
                                <polyline points="8 1 12 5 8 9"></polyline>
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="col-lg-2 col-sm-4 col-xs-12 no-padding wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.4s" data-wow-offset="0">
                    <div class="single_tp">
                        <h3>Oposiciones</h3>
                        <a href="#" class="cta"><span>Ver mas</span>
                            <svg width="13px" height="10px" viewBox="0 0 13 10">
                                <path d="M1,5 L11,5"></path>
                                <polyline points="8 1 12 5 8 9"></polyline>
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="col-lg-2 col-sm-4 col-xs-12 no-padding wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.4s" data-wow-offset="0">
                    <div class="single_tp">
                        <h3>Certificados de Profesionalidad</h3>
                        <a href="#" class="cta"><span>Ver mas</span>
                            <svg width="13px" height="10px" viewBox="0 0 13 10">
                                <path d="M1,5 L11,5"></path>
                                <polyline points="8 1 12 5 8 9"></polyline>
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="col-lg-2 col-sm-4 col-xs-12 no-padding wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.4s" data-wow-offset="0">
                    <div class="single_tp">
                        <h3>Seguridad Privada</h3>
                        <a href="#" class="cta"><span>Ver mas</span>
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
	<!-- END TOP PROMO FEATURES -->

	<!-- START ABOUT US HOME ONE -->
	<section class="ab_one section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-sm-12 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s" data-wow-offset="0">
                    <div class="ab_img position-relative">
                        <img src="assets/images/all-img/about1.png" class="img-fluid" alt="Grupo ECOS">
                        <!-- Puedes agregar un pequeño distintivo si quieres destacar los años de experiencia -->
                        {{-- <div class="wc_year position-absolute top-0 start-0 bg-primary text-white p-3 rounded">
                            <h3><span>28+</span><br />Años de experiencia</h3>
                        </div> --}}
                    </div>
                </div><!--- END COL -->
                <div class="col-lg-6 col-sm-12 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s" data-wow-offset="0">
                    <div class="ab_content">
                        <h2><u><span>Impulsa tu futuro</span></u> con formación de calidad</h2>
                        <p>En Grupo ECOS llevamos más de 28 años ayudando a personas como tú a alcanzar sus metas personales y profesionales a través de la formación. Con sedes en Ceuta, Estepona y Melilla, ofrecemos un amplio abanico de programas educativos adaptados a las demandas actuales del mercado laboral.</p>
                    </div>
                    <div class="abmv">
                        <span class="ti-medall"></span>
                        <h4>Nuestra Misión</h4>
                        <p>Impulsar el desarrollo profesional y personal mediante una formación accesible, actualizada y alineada con las necesidades del mundo laboral.</p>
                    </div>
                    <div class="abmv">
                        <span class="ti-wand"></span>
                        <h4>Nuestra Visión</h4>
                        <p>Ser referentes en formación para el empleo, contribuyendo al crecimiento de la sociedad a través del aprendizaje constante y la mejora continua.</p>
                    </div>
                    <a class="btn_one" href="about">Conócenos más</a>
                </div><!--- END COL -->
            </div><!--- END ROW -->
        </div><!--- END CONTAINER -->
    </section>
	<!-- END ABOUT US HOME ONE -->

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

	<!-- START WHY CHOOSE US-->
	<section class="marketing_content_area section-padding">
        <div class="container">
           <div class="section-title">
              <h2>¿Por qué elegir Ecos?</h2>
              <p>Descubre las <span><u>mejores cualidades</u></span> de Ecos.</p>
           </div>
           <div class="row">
              <div class="col-lg-4 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s" data-wow-offset="0">
                 <div class="single_feature_one">
                    <div class="sf_top">
                       <span class="ti-book ss_one"></span>
                       <h2><a href="single-service" target="_blank">Aprende desde cualquier lugar</a></h2>
                    </div>
                    <p>Accede a nuestra formación de calidad sin importar dónde te encuentres, con recursos adaptados a tu ritmo y necesidades.</p>
                 </div>
              </div><!-- END COL -->
              <div class="col-lg-4 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s" data-wow-offset="0">
                 <div class="single_feature_one">
                    <div class="sf_top">
                       <span class="ti-heart ss_two"></span>
                       <h2><a href="single-service" target="_blank">Instructores expertos</a></h2>
                    </div>
                    <p>Contamos con un equipo de profesionales altamente cualificados, dispuestos a guiarte en cada paso de tu formación.</p>
                 </div>
              </div><!-- END COL -->
              <div class="col-lg-4 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.3s" data-wow-offset="0">
                 <div class="single_feature_one">
                    <div class="sf_top">
                       <span class="ti-user ss_three"></span>
                       <h2><a href="single-service" target="_blank">Gestión eficiente del equipo</a></h2>
                    </div>
                    <p>Una organización estructurada que garantiza la mejor experiencia de aprendizaje, con coordinación y apoyo constante.</p>
                 </div>
              </div><!-- END COL -->
              <div class="col-lg-4 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.4s" data-wow-offset="0">
                 <div class="single_feature_one">
                    <div class="sf_top">
                       <span class="ti-eye ss_four"></span>
                       <h2><a href="single-service" target="_blank">Planificación de cursos</a></h2>
                    </div>
                    <p>Diseñamos programas de estudio adaptados a las necesidades del mercado y las expectativas de nuestros alumnos.</p>
                 </div>
              </div><!-- END COL -->
              <div class="col-lg-4 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.5s" data-wow-offset="0">
                 <div class="single_feature_one">
                    <div class="sf_top">
                       <span class="ti-light-bulb ss_five"></span>
                       <h2><a href="single-service" target="_blank">Seguimiento docente</a></h2>
                    </div>
                    <p>Monitoreamos el desempeño de nuestros profesores para garantizar la mejor calidad educativa y la satisfacción de los estudiantes.</p>
                 </div>
              </div><!-- END COL -->
              <div class="col-lg-4 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.6s" data-wow-offset="0">
                 <div class="single_feature_one">
                    <div class="sf_top">
                       <span class="ti-email ss_six"></span>
                       <h2><a href="single-service" target="_blank">Soporte 24/7</a></h2>
                    </div>
                    <p>Atención constante para resolver tus dudas y acompañarte en cada etapa de tu formación.</p>
                 </div>
              </div><!-- END COL -->
           </div><!-- END ROW -->
        </div><!-- END CONTAINER -->
     </section>

	<!-- END WHY CHOOSE US -->

	<!--START COURSE -->
	{{-- <div class="best-cpurse section-padding">
		<div class="container">
			<div class="section-title">
			  <h2>Popular Courses</h2>
			  <p>Choose Our <span><u>Top Courses</u></span></p>
			</div>
			<div class="row">
				<div class="col-lg-4 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s" data-wow-offset="0">
					<div class="course-slide">
						<div class="course-img">
							<img src="assets/images/all-img/c1.png" alt="">
							<div class="course-date">
								<span class="month">$49</span>
							</div>
						</div>
						<div class="course-content"><a class="c_btn" href="single_course">Arts & Design</a>
							<h3><a href="single_course">Basic Fundamentals of Interior & Graphics Design</a></h3>
							<span><i class="fa fa-calendar"></i>3 Lessons</span>
							<span><i class="fa fa-clock-o"></i>3h 45m</span>
							<span><i class="fa fa-star"></i>4.9</span>
							<span><i class="fa fa-table"></i><strong>30 Seats Available</strong></span>

						</div>
					</div><!--END COURSE SLIDE -->
				</div><!--END COL -->
				<div class="col-lg-4 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s" data-wow-offset="0">
					<div class="course-slide">
						<div class="course-img">
							<img src="assets/images/all-img/c2.png" alt="">
							<div class="course-date">
								<span class="month">$39</span>
							</div>
						</div>
						<div class="course-content"><a class="c_btn" href="single_course">Social</a>
							<h3><a href="single_course">Increasing Engagement with Instagram & Facebook</a></h3>
							<span><i class="fa fa-calendar"></i>5 Lessons</span>
							<span><i class="fa fa-clock-o"></i>4h 15m</span>
							<span><i class="fa fa-star"></i>4.7</span>
							<span><i class="fa fa-table"></i><strong>21 Seats Available</strong></span>

						</div>
					</div><!--END COURSE SLIDE -->
				</div><!--END COL -->
				<div class="col-lg-4 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s" data-wow-offset="0">
					<div class="course-slide">
						<div class="course-img">
							<img src="assets/images/all-img/c3.png" alt="">
							<div class="course-date">
								<span class="month">$29</span>
							</div>
						</div>
						<div class="course-content"><a class="c_btn" href="single_course">Design</a>
							<h3><a href="single_course">Introduction to Color Theory & Basic UI/UX</a></h3>
							<span><i class="fa fa-calendar"></i>4 Lessons</span>
							<span><i class="fa fa-clock-o"></i>6h 25m</span>
							<span><i class="fa fa-star"></i>4.8</span>
							<span><i class="fa fa-table"></i><strong>33 Seats Available</strong></span>

						</div>
					</div><!--END COURSE SLIDE -->
				</div><!--END COL -->
				<div class="col-lg-4 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s" data-wow-offset="0">
					<div class="course-slide">
						<div class="course-img">
							<img src="assets/images/all-img/c4.png" alt="">
							<div class="course-date">
								<span class="month">$59</span>
							</div>
						</div>
						<div class="course-content"><a class="c_btn" href="single_course">Technology</a>
							<h3><a href="single_course">Financial Security Thinking and Principles Theory</a></h3>
							<span><i class="fa fa-calendar"></i>7 Lessons</span>
							<span><i class="fa fa-clock-o"></i>7h 45m</span>
							<span><i class="fa fa-star"></i>4.7</span>
							<span><i class="fa fa-table"></i><strong>11 Seats Available</strong></span>

						</div>
					</div><!--END COURSE SLIDE -->
				</div><!--END COL -->
				<div class="col-lg-4 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s" data-wow-offset="0">
					<div class="course-slide">
						<div class="course-img">
							<img src="assets/images/all-img/c5.png" alt="">
							<div class="course-date">
								<span class="month">$69</span>
							</div>
						</div>
						<div class="course-content"><a class="c_btn" href="single_course">Data Science</a>
							<h3><a href="single_course">Logo Design: From Concept to Presentation</a></h3>
							<span><i class="fa fa-calendar"></i>5 Lessons</span>
							<span><i class="fa fa-clock-o"></i>4h 55m</span>
							<span><i class="fa fa-star"></i>4.9</span>
							<span><i class="fa fa-table"></i><strong>41 Seats Available</strong></span>

						</div>
					</div><!--END COURSE SLIDE -->
				</div><!--END COL -->
				<div class="col-lg-4 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s" data-wow-offset="0">
					<div class="course-slide">
						<div class="course-img">
							<img src="assets/images/all-img/c6.png" alt="">
							<div class="course-date">
								<span class="month">$99</span>
							</div>
						</div>
						<div class="course-content"><a class="c_btn" href="single_course">Development</a>
							<h3><a href="single_course">Professional Ceramic Moulding for Beginners</a></h3>
							<span><i class="fa fa-calendar"></i>3 Lessons</span>
							<span><i class="fa fa-clock-o"></i>3h 10m</span>
							<span><i class="fa fa-star"></i>4.9</span>
							<span><i class="fa fa-table"></i><strong>37 Seats Available</strong></span>

						</div>
					</div><!--END COURSE SLIDE -->
				</div><!--END COL -->
				<div class="col-lg-12 text-center">
					<div class="cc_btn">
						<a class="btn_one" href="course">View All Course</a>
					</div>
				</div><!--END COL -->
			</div><!--END ROW -->
		</div><!--END CONTAINER -->
	</div> --}}
	<!--END COURSE -->

	<!-- START COURSE PROMOTION -->
	{{-- <section class="course_promo section-padding">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-sm-12 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s" data-wow-offset="0">
					<div class="cp_content">
						<h4>Best Online Learning Platform</h4>
						<h2>One Platfrom & Many <span><u>Courses</u></span> For You</h2>
						<p>From blogs to emails to ad copies, auto-generate catchy, original, and high-converting copies in popular tones languages.</p>
						<ul>
							<li><span class="ti-check"></span>9/10 Average Satisfaction Rate</li>
							<li><span class="ti-check"></span>96% Completitation Rate</li>
							<li><span class="ti-check"></span>Friendly Environment & Expert Teacher</li>
						</ul>
					</div>
					<div class="cp_btn">
						<a href="#" class="cta"><span>Ver mas Our Courses</span>
						  <svg width="13px" height="10px" viewBox="0 0 13 10">
							<path d="M1,5 L11,5"></path>
							<polyline points="8 1 12 5 8 9"></polyline>
						  </svg>
						</a>
					</div>
				</div><!--- END COL -->
				<div class="col-lg-6 col-sm-12 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s" data-wow-offset="0">
					<div class="cp_img">
						<img src="assets/images/all-img/promo.png" class="img-fluid" alt="image">
						<!-- <div class="wc_year">
							<h3>20 Years of Experience <br />from 2002</h3>
						</div> -->
					</div>
				</div><!--- END COL -->
			</div><!--- END ROW -->
		</div><!--- END CONTAINER -->
	</section> --}}
	<!-- END COURSE PROMOTION -->

	<!-- START NEWSLETTER -->
	{{-- <section class="newsletter_area section-padding">
		<div class="container">
			<div class="row text-center">
				<div class="col-lg-6 offset-lg-3 col-sm-12 col-xs-12">
					<div class="subs_form">
						<h3>Subscripbe to our newsletter, We don't make any spam.</h3>
						<p>Lorem ipsum dolor sit amet consectetur adipisicing elitsed eiusmod tempor enim minim</p>
						<form action="#" class="home_subs">
							<input type="text" class="subscribe__input" placeholder="Enter your Email Address">
							<button type="button" class="subscribe__btn"><i class="fa fa-paper-plane-o"></i></button>
						</form>
					</div>
				</div><!-- END COL -->
			</div><!-- END ROW -->
		</div><!--- END CONTAINER -->
	</section> --}}
	<!-- END NEWSLETTER -->

	<!-- START TOPIC-->
	{{-- <section class="topic_content_area section-padding">
	   <div class="container">
			<div class="section-title">
				<h2>Start Learning </h2>
				<p>Popular <span><u>Topics To Learn</u></span> From Today.</p>
			</div>
			<div class="row">
				<div class="col-lg-4 col-sm-6 col-xs-12">
					<div class="single_tca">
						<img src="assets/images/icon/ct1.svg" alt="" />
						<h2><a href="#">UI/UX Design</a></h2>
						<span>71 Courses</span>
					</div>
				</div><!-- END COL -->
				<div class="col-lg-4 col-sm-6 col-xs-12">
					<div class="single_tca">
						<img src="assets/images/icon/ct2.svg" alt="" />
						<h2><a href="#">Digital Program</a></h2>
						<span>59 Courses</span>
					</div>
				</div><!-- END COL -->
				<div class="col-lg-4 col-sm-6 col-xs-12">
					<div class="single_tca">
						<img src="assets/images/icon/ct3.svg" alt="" />
						<h2><a href="#">Finance</a></h2>
						<span>68 Courses</span>
					</div>
				</div><!-- END COL -->
				<div class="col-lg-4 col-sm-6 col-xs-12">
					<div class="single_tca">
						<img src="assets/images/icon/ct4.svg" alt="" />
						<h2><a href="#">Modern Physics</a></h2>
						<span>83 Courses</span>
					</div>
				</div><!-- END COL -->
				<div class="col-lg-4 col-sm-6 col-xs-12">
					<div class="single_tca">
						<img src="assets/images/icon/ct5.svg" alt="" />
						<h2><a href="#">Music Production</a></h2>
						<span>37 Courses</span>
					</div>
				</div><!-- END COL -->
				<div class="col-lg-4 col-sm-6 col-xs-12">
					<div class="single_tca">
						<img src="assets/images/icon/ct6.svg" alt="" />
						<h2><a href="#">Data Science</a></h2>
						<span>51 Courses</span>
					</div>
				</div><!-- END COL -->
			</div><!-- END ROW -->
		</div><!-- END CONTAINER -->
	</section> --}}
	<!-- END TOPIC -->

	<!-- START EVENT -->
	{{-- <section class="our-event section-padding">
		<div class="container">
			<div class="section-title">
				<h2>Upcoming Events</h2>
				<p>Join With Us <span><u>Our Events</u></span></p>
			</div>
			<div class="row">
				<div class="col-lg-4 col-sm-6 col-xs-12">
					<div class="event-slide">
						<div class="event-img">
							<img src="assets/images/event/e1.png" alt="">
							<div class="event-date">
								<span class="date">20</span>
								<span class="month">Oct</span>
							</div>
						</div>
						<div class="event-content">
							<h3><a href="event">Electrical Engineering of Batparder new event</a></h3>
							<span><i class="fa fa-clock-o"></i>10.00AM - 12.00PM</span>
							<span><i class="fa fa-table"></i><strong>At Ecos School</strong></span>
							<p>Lorem ipsum dolor sit amet magna consectetur adipisicing elit.</p>
						</div>
					</div><!-- END EVENT -->
				</div><!-- END COL -->
				<div class="col-lg-4 col-sm-6 col-xs-12">
					<div class="event-slide">
						<div class="event-img">
							<img src="assets/images/event/e2.png" alt="">
							<div class="event-date">
								<span class="date">22</span>
								<span class="month">Oct</span>
							</div>
						</div>
						<div class="event-content">
							<h3><a href="event">Architecture Design of International Art Fair 2023</a></h3>
							<span><i class="fa fa-clock-o"></i>10.00AM - 12.00PM</span>
							<span><i class="fa fa-table"></i><strong>At Ecos School</strong></span>
							<p>Lorem ipsum dolor sit amet magna consectetur adipisicing elit.</p>
						</div>
					</div><!-- END EVENT -->
				</div><!-- END COL -->
				<div class="col-lg-4 col-sm-6 col-xs-12">
					<div class="event-slide es">
						<div class="ed_mb">
							<span class="date">26</span>
							<span class="month">Oct</span>
						</div>
						<div class="event-content ec_pd">
							<h3><a href="event">Chiter astana event</a></h3>
							<span><i class="fa fa-clock-o"></i>10.00AM - 12.00PM</span>
							<span><i class="fa fa-table"></i><strong>At Ecos School</strong></span>
							<p>Lorem ipsum dolor sit amet magna consectetur adipisicing elit.</p>
						</div>
					</div><!-- END EVENT -->
					<div class="event-slide es">
						<div class="ed_mb">
							<span class="date">29</span>
							<span class="month">Oct</span>
						</div>
						<div class="event-content ec_pd">
							<h3><a href="event">Dasel Bhai Program</a></h3>
							<span><i class="fa fa-clock-o"></i>10.00AM - 12.00PM</span>
							<span><i class="fa fa-table"></i><strong>At Ecos School</strong></span>
							<p>Lorem ipsum dolor sit amet magna consectetur adipisicing elit.</p>
						</div>
					</div><!-- END EVENT -->
				</div><!-- END COL -->
			</div><!-- END ROW -->
		</div><!-- END CONTAINER -->
	</section> --}}
	<!-- END EVENT -->

	<!-- START TESTIMONIALS-->
	{{-- <section class="testi_home_area section-padding">
	   <div class="container">
			<div class="section-title">
				<h2>Testimonial</h2>
				<p>What Says <span><u>Our Students</u></span></p>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div id="testimonial-slider" class="owl-carousel">
						<div class="testimonial">
							<div class="testimonial_content">
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr sed diam nonumy eirmod tempor.</p>
							</div>
							<div class="testi_pic_title tpt_one">
								<div class="pic">
									<img src="assets/images/all-img/t1.png" alt="">
								</div>
								<h4>James Clayton</h4>
								<small class="post">- Design Expert</small>
							</div>
						</div><!-- END TESTIMONIAL -->
						<div class="testimonial">
							<div class="testimonial_content">
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr sed diam nonumy eirmod tempor.</p>
							</div>
							<div class="testi_pic_title tpt_two">
								<div class="pic">
									<img src="assets/images/all-img/t2.png" alt="">
								</div>
								<h4>James Simmons</h4>
								<small class="post">- Marketing Expert</small>
							</div>
						</div><!-- END TESTIMONIAL -->
						<div class="testimonial">
							<div class="testimonial_content">
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr sed diam nonumy eirmod tempor.</p>
							</div>
							<div class="testi_pic_title tpt_three">
								<div class="pic">
									<img src="assets/images/all-img/t3.png" alt="">
								</div>
								<h4>Alex feroundo</h4>
								<small class="post">- Founder</small>
							</div>
						</div><!-- END TESTIMONIAL -->
						<div class="testimonial">
							<div class="testimonial_content">
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr sed diam nonumy eirmod tempor.</p>
							</div>
							<div class="testi_pic_title tpt_one">
								<div class="pic">
									<img src="assets/images/all-img/t4.png" alt="">
								</div>
								<h4>Kallu Mastan</h4>
								<small class="post">- Mastan group</small>
							</div>
						</div><!-- END TESTIMONIAL -->
						<div class="testimonial">
							<div class="testimonial_content">
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr sed diam nonumy eirmod tempor.</p>
							</div>
							<div class="testi_pic_title tpt_two">
								<div class="pic">
									<img src="assets/images/all-img/t1.png" alt="">
								</div>
								<h4>Devid max</h4>
								<small class="post">- Max iNC</small>
							</div>
						</div><!-- END TESTIMONIAL -->
					</div><!-- END TESTIMONIAL SLIDER -->
				</div><!-- END COL  -->
			</div><!-- END ROW -->
		</div><!-- END CONTAINER -->
	</section> --}}
	<!-- END TESTIMONIALS -->

	<!-- START TEAM-->
	{{-- <section class="team_home_area section-padding">
	   <div class="container">
			<div class="section-title">
				<h2>Team Member</h2>
				<p>Our Expert <span><u>Instructors</u></span></p>
			</div>
			<div class="row">
				<div class="col-lg-3 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s" data-wow-offset="0">
					<div class="single-team-home">
						<div class="img"><img src="assets/images/all-img/team1.jpg" class="img-fluid" alt=""></div>
						<div class="team-content-home">
							<h3>Marina Mojo</h3>
							<p>Developer</p>
							<div class="sth_det">
								<span class="ti-file"> <u>5 Course</u></span>
								<span class="ti-user"> <u>12 Student</u></span>
							</div>
							<ul class="social-home">
								<li><a href="#" class="facebook-home"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#" class="twitter-home"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#" class="instagram-home"><i class="fa fa-instagram"></i></a></li>
							</ul>
						</div>
					</div>
				</div><!-- END COL -->
				<div class="col-lg-3 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s" data-wow-offset="0">
					<div class="single-team-home">
						<div class="img"><img src="assets/images/all-img/team2.jpg" class="img-fluid" alt=""></div>
						<div class="team-content-home">
							<h3>Ayoub Fennouni</h3>
							<p>Logo Expert</p>
							<div class="sth_det">
								<span class="ti-file"> <u>5 Course</u></span>
								<span class="ti-user"> <u>7 Student</u></span>
							</div>
							<ul class="social-home">
								<li><a href="#" class="facebook-home"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#" class="twitter-home"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#" class="instagram-home"><i class="fa fa-instagram"></i></a></li>
							</ul>
						</div>
					</div>
				</div><!-- END COL -->
				<div class="col-lg-3 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.3s" data-wow-offset="0">
					<div class="single-team-home">
						<div class="img"><img src="assets/images/all-img/team3.jpg" class="img-fluid" alt=""></div>
						<div class="team-content-home">
							<h3>Mark Linomi</h3>
							<p>Marketer</p>
							<div class="sth_det">
								<span class="ti-file"> <u>9 Course</u></span>
								<span class="ti-user"> <u>17 Student</u></span>
							</div>
							<ul class="social-home">
								<li><a href="#" class="facebook-home"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#" class="twitter-home"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#" class="instagram-home"><i class="fa fa-instagram"></i></a></li>
							</ul>
						</div>
					</div>
				</div><!-- END COL -->
				<div class="col-lg-3 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.4s" data-wow-offset="0">
					<div class="single-team-home">
						<div class="img"><img src="assets/images/all-img/team4.jpg" class="img-fluid" alt=""></div>
						<div class="team-content-home">
							<h3>Amira Yerden</h3>
							<p>UI/UX Designer</p>
							<div class="sth_det">
								<span class="ti-file"> <u>15 Course</u></span>
								<span class="ti-user"> <u>31 Student</u></span>
							</div>
							<ul class="social-home">
								<li><a href="#" class="facebook-home"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#" class="twitter-home"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#" class="instagram-home"><i class="fa fa-instagram"></i></a></li>
							</ul>
						</div>
					</div>
				</div><!-- END COL -->
			</div><!-- END ROW -->
		</div><!-- END CONTAINER -->
	</section> --}}
	<!-- END TEAM -->

	<!-- START BLOG -->
	{{-- <section id="blog" class="blog_area section-padding">
		<div class="container">
			<div class="section-title">
				<h2>News</h2>
				<p>Our Latest <span><u>Blogs</u></span></p>
			</div>
			<div class="row">
				<div class="col-lg-4 col-sm-4 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s" data-wow-offset="0">
					<div class="single_blog">
						<div class="content_box">
							<span>August 25, 2023 | <a href="blog_single">Design</a></span>
							<h2><a href="blog_single">Professional Mobile Painting and Sculpting</a></h2>
							<a href="#" class="cta"><span>READ MORE</span>
							  <svg width="13px" height="10px" viewBox="0 0 13 10">
								<path d="M1,5 L11,5"></path>
								<polyline points="8 1 12 5 8 9"></polyline>
							  </svg>
							</a>
						</div>
					</div>
					<div class="single_blog">
						<div class="content_box">
							<span>August 25, 2023 | <a href="blog_single">Design</a></span>
							<h2><a href="blog_single">Professional Mobile Painting and Sculpting</a></h2>
							<a href="#" class="cta"><span>READ MORE</span>
							  <svg width="13px" height="10px" viewBox="0 0 13 10">
								<path d="M1,5 L11,5"></path>
								<polyline points="8 1 12 5 8 9"></polyline>
							  </svg>
							</a>
						</div>
					</div>
				</div><!-- END COL-->
				<div class="col-lg-4 col-sm-4 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s" data-wow-offset="0">
					<div class="single_blog">
						<img src="assets/images/blog/2.png" class="img-fluid" alt="image" />
						<div class="content_box">
							<span>August 26, 2023 | <a href="blog_single">Education</a></span>
							<h2><a href="blog_single">Professional Ceramic Moulding for Beginner</a></h2>
							<a href="#" class="cta"><span>READ MORE</span>
							  <svg width="13px" height="10px" viewBox="0 0 13 10">
								<path d="M1,5 L11,5"></path>
								<polyline points="8 1 12 5 8 9"></polyline>
							  </svg>
							</a>
						</div>
					</div>
				</div><!-- END COL-->
				<div class="col-lg-4 col-sm-4 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.3s" data-wow-offset="0">
					<div class="single_blog">
						<img src="assets/images/blog/3.png" class="img-fluid" alt="image" />
						<div class="content_box">
							<span>August 28, 2023 | <a href="blog_single">Programing</a></span>
							<h2><a href="blog_single">Education Is About Create Leaders For Tomorrow </a></h2>
							<a href="#" class="cta"><span>READ MORE</span>
							  <svg width="13px" height="10px" viewBox="0 0 13 10">
								<path d="M1,5 L11,5"></path>
								<polyline points="8 1 12 5 8 9"></polyline>
							  </svg>
							</a>
						</div>
					</div>
				</div><!-- END COL-->
			</div><!-- / END ROW -->
		</div><!-- END CONTAINER  -->
	</section> --}}
	<!-- END BLOG -->

    @endsection

