
@extends('layouts.web_layout')

@section('title', 'Index 3')

@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/slider.css') }}">
@endsection

@section('content')

	<!-- START HOME -->
	<div id="kenburns_061" class="carousel slide ps_indicators_txt_icon ps_control_txt_icon data-bs-target kbrns_zoomInOut thumb_scroll_x swipe_x ps_easeOutQuart" data-ride="carousel" data-pause="hover" data-interval="10000" data-duration="2000">
		<!-- Wrapper For Slides -->
		<div class="carousel-inner" role="listbox">
			<!-- First Slide -->
			<div class="carousel-item active">
				<!-- Slide Background -->
				<img src="assets/images/banner/slide1.jpg" alt="slider-image" />
				<!-- Left Slide Text Layer -->
				<div class="kenburns_061_slide" data-animation="animated fadeInRight">
					<h2>welcom to Ecos</h2>
					<h1>Classical <span><u>Education</u></span> For The Future</h1>
					<h3>Lorem ipsum dolor sit amet consectetuer adipiscing elit Nam nibh</h3>
					<a href="about">learn more</a>
				</div><!-- /Left Slide Text Layer -->
			</div><!-- /item -->
			<!-- End of Slide -->
			<!-- Second Slide -->
			<div class="carousel-item">
				<!-- Slide Background -->
				<img src="assets/images/banner/slide2.jpg" alt="slider-image" />
				<!-- Right Slide Text Layer -->
				<div class="kenburns_061_slide kenburns_061_slide_right" data-animation="animated fadeInLeft">
					<h2>welcom to Ecos</h2>
					<h1>Get your <span><u>best career</u></span> and get job with Ecos</h1>
					<h3>Lorem ipsum dolor sit amet consectetuer adipiscing elit Nam nibh</h3>
					<a href="about">learn more</a>
				</div><!-- /Right Slide Text Layer -->
			</div><!-- /item -->
			<!-- End of Slide -->
			<!-- Third Slide -->
			<div class="carousel-item">
				<!-- Slide Background -->
				<img src="assets/images/banner/slide3.jpg" alt="slider-image" />
				<!-- Center Slide Text Layer -->
				<div class="kenburns_061_slide kenburns_061_slide_center" data-animation="animated fadeInDown">
					<h2>welcom to Ecos</h2>
					<h1>Refresh your <span><u>Mind & skill</u></span> For The Future</h1>
					<h3>Lorem ipsum dolor sit amet consectetuer adipiscing elit Nam nibh</h3>
					<a href="about">learn more</a>
				</div><!-- /Center Slide Text Layer -->
			</div><!-- /item -->
			<!-- End of Slide -->
		</div><!-- End of Wrapper For Slides -->
		<!-- Left Control -->
		<button class="carousel-control-prev" type="button" data-bs-target="#kenburns_061" data-bs-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="visually-hidden">Previous</span>
		</button>
		<button class="carousel-control-next" type="button" data-bs-target="#kenburns_061" data-bs-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="visually-hidden">Next</span>
		</button>
	</div>
	<!-- END  HOME -->

	<!-- START COMPANY PARTNER LOGO  -->
	<div class="partner-logo pl_bg section-padding">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 text-center">
					<div class="partner">
						<a href="#"><img src="assets/images/all-img/clients/b1.svg" alt="image"></a>
						<a href="#"><img src="assets/images/all-img/clients/b2.svg" alt="image"></a>
						<a href="#"><img src="assets/images/all-img/clients/b3.svg" alt="image"></a>
						<a href="#"><img src="assets/images/all-img/clients/b4.svg" alt="image"></a>
						<a href="#"><img src="assets/images/all-img/clients/b5.svg" alt="image"></a>
						<a href="#"><img src="assets/images/all-img/clients/b2.svg" alt="image"></a>
						<a href="#"><img src="assets/images/all-img/clients/b1.svg" alt="image"></a>
						<a href="#"><img src="assets/images/all-img/clients/b3.svg" alt="image"></a>
						<a href="#"><img src="assets/images/all-img/clients/b4.svg" alt="image"></a>
					</div>
				</div><!-- END COL  -->
			</div><!--END  ROW  -->
		</div><!-- END CONTAINER  -->
	</div>
	<!-- END COMPANY PARTNER LOGO -->

	<!-- START TOP PROMO FEATURES -->
	<section class="tp_feature">
	   <div class="container-fluid">
			<div class="row">
				<div class="col-lg-4 col-sm-4 col-xs-12 no-padding wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s" data-wow-offset="0">
					<div class="single_tp">
						<h3>Quality Education</h3>
						<p>Lorem ipsum dolor sit amet, consectetur notted adipisicing elit sed do eiusmod tempor incididunt ut labore.</p>
						<a href="#" class="cta"><span>Explore</span>
						  <svg width="13px" height="10px" viewBox="0 0 13 10">
							<path d="M1,5 L11,5"></path>
							<polyline points="8 1 12 5 8 9"></polyline>
						  </svg>
						</a>
					</div>
				</div><!-- END COL -->
				<div class="col-lg-4 col-sm-4 col-xs-12 no-padding wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.3s" data-wow-offset="0">
					<div class="single_tp">
						<h3>Experienced Teachers</h3>
						<p>Lorem ipsum dolor sit amet, consectetur notted adipisicing elit sed do eiusmod tempor incididunt ut labore.</p>
						<a href="#" class="cta"><span>Explore</span>
						  <svg width="13px" height="10px" viewBox="0 0 13 10">
							<path d="M1,5 L11,5"></path>
							<polyline points="8 1 12 5 8 9"></polyline>
						  </svg>
						</a>
					</div>
				</div><!-- END COL -->
				<div class="col-lg-4 col-sm-4 col-xs-12 no-padding wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.4s" data-wow-offset="0">
					<div class="single_tp">
						<h3>Delicious Food</h3>
						<p>Lorem ipsum dolor sit amet, consectetur notted adipisicing elit sed do eiusmod tempor incididunt ut labore.</p>
						<a href="#" class="cta"><span>Explore</span>
						  <svg width="13px" height="10px" viewBox="0 0 13 10">
							<path d="M1,5 L11,5"></path>
							<polyline points="8 1 12 5 8 9"></polyline>
						  </svg>
						</a>
					</div>
				</div><!-- END COL -->
			</div><!-- END ROW -->
		</div><!-- END CONTAINER -->
	</section>
	<!-- END TOP PROMO FEATURES -->

	<!-- START ABOUT US HOME ONE -->
	<section class="ab_one section-padding">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-sm-12 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s" data-wow-offset="0">
					<div class="ab_img">
						<img src="assets/images/all-img/about5.png" class="img-fluid" alt="image">
						<!-- <div class="wc_year">
							<h3><span>6k+</span> <br />Happy Clients</h3>
						</div> -->
					</div>
				</div><!--- END COL -->
				<div class="col-lg-6 col-sm-12 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s" data-wow-offset="0">
					<div class="ab_content">
						<h2>Learn new skills to go <u><span>ahead for your </span></u> career.</h2>
						<p>Lorem ipsum dolor sit amet, consectetur notted adipisicing elit sed do eiusmod tempor incididunt ut labore et simply.</p>
					</div>
					<div class="abmv">
						<span class="ti-medall"></span>
						<h4>Our Mission</h4>
						<p>Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor ut labore.</p>
					</div>
					<div class="abmv">
						<span class="ti-wand"></span>
						<h4>Our Vision</h4>
						<p>Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor ut labore.</p>
					</div>
				</div><!--- END COL -->
			</div><!--- END ROW -->
		</div><!--- END CONTAINER -->
	</section>
	<!-- END ABOUT US HOME ONE -->

	<!--START COURSE -->
	<div class="bc_three section-padding">
		<div class="container">
			<div class="section-title">
			  <h2>Popular Courses</h2>
			  <p>Choose Our <span><u>Top Courses</u></span></p>
			</div>
			<div class="row">
				<div class="col-lg-4 col-sm-12 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s" data-wow-offset="0">
					<div class="course-slide3">
						<div class="course-img3">
							<div class="co_bg_img" style="background-image: url(assets/images/all-img/c1.png);">
								<a class="co-video-play" href="https://www.youtube.com/watch?v=RXv_uIN6e-Y"><i class="fa fa-play"></i> <span class="video-title"</span></a>
							</div>
						</div>
						<div class="course-content3">
							<a class="c_btn2" href="single_course">Arts & Design</a>
							<a class="c_btn3" href="single_course">29$</a>
							<h3><a href="single_course">Basic Fundamentals of Interior & Graphics Design</a></h3>
						</div>
					</div><!--END COURSE SLIDE -->
				</div><!--END COL -->
				<div class="col-lg-4 col-sm-12 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s" data-wow-offset="0">
					<div class="course-slide3">
						<div class="course-img3">
							<div class="co_bg_img" style="background-image: url(assets/images/all-img/c2.png);">
								<a class="co-video-play" href="https://www.youtube.com/watch?v=RXv_uIN6e-Y"><i class="fa fa-play"></i> <span class="video-title"</span></a>
							</div>
						</div>
						<div class="course-content3">
							<a class="c_btn2" href="single_course">Arts & Design</a>
							<a class="c_btn3" href="single_course">29$</a>
							<h3><a href="single_course">Basic Fundamentals of Interior & Graphics Design</a></h3>
						</div>
					</div><!--END COURSE SLIDE -->
				</div><!--END COL -->
				<div class="col-lg-4 col-sm-12 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s" data-wow-offset="0">
					<div class="course-slide3">
						<div class="course-img3">
							<div class="co_bg_img" style="background-image: url(assets/images/all-img/c3.png);">
								<a class="co-video-play" href="https://www.youtube.com/watch?v=RXv_uIN6e-Y"><i class="fa fa-play"></i> <span class="video-title"</span></a>
							</div>
						</div>
						<div class="course-content3">
							<a class="c_btn2" href="single_course">Arts & Design</a>
							<a class="c_btn3" href="single_course">29$</a>
							<h3><a href="single_course">Basic Fundamentals of Interior & Graphics Design</a></h3>
						</div>
					</div><!--END COURSE SLIDE -->
				</div><!--END COL -->
				<div class="col-lg-4 col-sm-12 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s" data-wow-offset="0">
					<div class="course-slide3">
						<div class="course-img3">
							<div class="co_bg_img" style="background-image: url(assets/images/all-img/c4.png);">
								<a class="co-video-play" href="https://www.youtube.com/watch?v=RXv_uIN6e-Y"><i class="fa fa-play"></i> <span class="video-title"</span></a>
							</div>
						</div>
						<div class="course-content3">
							<a class="c_btn2" href="single_course">Arts & Design</a>
							<a class="c_btn3" href="single_course">29$</a>
							<h3><a href="single_course">Basic Fundamentals of Interior & Graphics Design</a></h3>
						</div>
					</div><!--END COURSE SLIDE -->
				</div><!--END COL -->
				<div class="col-lg-4 col-sm-12 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s" data-wow-offset="0">
					<div class="course-slide3">
						<div class="course-img3">
							<div class="co_bg_img" style="background-image: url(assets/images/all-img/c5.png);">
								<a class="co-video-play" href="https://www.youtube.com/watch?v=RXv_uIN6e-Y"><i class="fa fa-play"></i> <span class="video-title"</span></a>
							</div>
						</div>
						<div class="course-content3">
							<a class="c_btn2" href="single_course">Arts & Design</a>
							<a class="c_btn3" href="single_course">29$</a>
							<h3><a href="single_course">Basic Fundamentals of Interior & Graphics Design</a></h3>
						</div>
					</div><!--END COURSE SLIDE -->
				</div><!--END COL -->
				<div class="col-lg-4 col-sm-12 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s" data-wow-offset="0">
					<div class="course-slide3">
						<div class="course-img3">
							<div class="co_bg_img" style="background-image: url(assets/images/all-img/c6.png);">
								<a class="co-video-play" href="https://www.youtube.com/watch?v=RXv_uIN6e-Y"><i class="fa fa-play"></i> <span class="video-title"</span></a>
							</div>
						</div>
						<div class="course-content3">
							<a class="c_btn2" href="single_course">Arts & Design</a>
							<a class="c_btn3" href="single_course">29$</a>
							<h3><a href="single_course">Basic Fundamentals of Interior & Graphics Design</a></h3>
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
	</div>
	<!--END COURSE -->

	<!-- START TEAM-->
	<section class="team_member section-padding">
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
	</section>
	<!-- END TEAM -->

	<!-- START EVENT -->
	<section class="our-event section-padding">
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
					<div class="event-slide">
						<div class="event-img">
							<img src="assets/images/event/e3.png" alt="">
							<div class="event-date">
								<span class="date">26</span>
								<span class="month">Oct</span>
							</div>
						</div>
						<div class="event-content">
							<h3><a href="event">World Famous Chiter astana event</a></h3>
							<span><i class="fa fa-clock-o"></i>10.00AM - 12.00PM</span>
							<span><i class="fa fa-table"></i><strong>At Ecos School</strong></span>
							<p>Lorem ipsum dolor sit amet magna consectetur adipisicing elit.</p>
						</div>
					</div><!-- END EVENT -->
				</div><!-- END COL -->
			</div><!-- END ROW -->
		</div><!-- END CONTAINER -->
	</section>
	<!-- END EVENT -->

	<!-- START COUNTER -->
    <section id="counts" class="counts section-padding">
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
    </section>
	<!-- END COUNTER -->

	<!-- START INSTRUCTOR+FREE COURSE -->
	<section class="insfreecourse section-padding">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-sm-12 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s" data-wow-offset="0">
					<div class="single_ins">
						<div class="single_ins_content">
							<h4>Build Your Career</h4>
							<h1>Become an Instructor</h1>
							<p>Learn at your own pace, move the between multiple courses. </p>
							<a href="#" class="cta"><span>Apply Now</span>
							  <svg width="13px" height="10px" viewBox="0 0 13 10">
								<path d="M1,5 L11,5"></path>
								<polyline points="8 1 12 5 8 9"></polyline>
							  </svg>
							</a>
						</div>
						<div class="single_ins_img">
							<img src="assets/images/all-img/become-ins.png" class="img-fluid" alt="image">
						</div>
					</div>
				</div><!--- END COL -->
				<div class="col-lg-6 col-sm-12 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s" data-wow-offset="0">
					<div class="single_ins">
						<div class="single_ins_content">
							<h4>Build Your Career</h4>
							<h1>Get Free Courses</h1>
							<p>Learn at your own pace, move the between multiple courses. </p>
							<a href="#" class="cta"><span>Contact Us</span>
							  <svg width="13px" height="10px" viewBox="0 0 13 10">
								<path d="M1,5 L11,5"></path>
								<polyline points="8 1 12 5 8 9"></polyline>
							  </svg>
							</a>
						</div>
						<div class="single_ins_img">
							<img src="assets/images/all-img/free-course.png" class="img-fluid" alt="image">
						</div>
					</div>
				</div><!--- END COL -->
			</div><!--- END ROW -->
		</div><!--- END CONTAINER -->
	</section>
	<!-- END INSTRUCTOR+FREE COURSE -->

	<!-- START COURSE PROMOTION -->
	<section class="course_promo section-padding">
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
						<a href="#" class="cta"><span>Explore Our Courses</span>
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
	</section>
	<!-- END COURSE PROMOTION -->

	<!-- START NEWSLETTER -->
	<section class="newsletter_area section-padding">
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
	</section>
	<!-- END NEWSLETTER -->

	<!-- START FAQ -->
	<section class="faq_area section-padding">
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
	</section>
	<!-- END FAQ -->

	<!-- START BLOG -->
	<section id="blog" class="blog_area section-padding">
		<div class="container">
			<div class="section-title">
				<h2>News</h2>
				<p>Our Latest <span><u>Blogs</u></span></p>
			</div>
			<div class="row">
				<div class="col-lg-4 col-sm-4 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s" data-wow-offset="0">
					<div class="single_blog">
						<img src="assets/images/blog/1.png" class="img-fluid" alt="image" />
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
	</section>
	<!-- END BLOG -->

@endsection
