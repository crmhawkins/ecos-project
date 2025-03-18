@extends('webacademia.layouts.web_layout')

@section('title', 'Team details')

@section('css')
@endsection

@section('content')

	<!-- START SECTION TOP -->
	<section class="section-top">
		<div class="container">
			<div class="col-lg-10 offset-lg-1 text-center">
				<div class="section-top-title wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.3s" data-wow-offset="0">
					<h1>Instructor Details</h1>
					<ul>
						<li><a href="index">Home</a></li>
						<li> / Team Details</li>
					</ul>
				</div><!-- //.HERO-TEXT -->
			</div><!--- END COL -->
		</div><!--- END CONTAINER -->
	</section>
	<!-- END SECTION TOP -->

	<!-- START AGENT PROFILE -->
	<section class="template_agent section-padding">
		<div class="container">
			<div class="row">
			  <div class="col-lg-12 col-sm-12 col-xs-12">
					<div class="single_agent">
						<div class="single_agent_image">
							<img src="assets/images/all-img/team-details.png" class="img-fluid" alt=""/>
						</div>
						<div class="single_agent_content">
							<h4>Bondo Kader Khan</h4>
							<h5>Digital Marketer</h5>
							<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever type book.</p>
							<ul>
								<li><i class="fa fa-envelope-o"></i>yourmail@gmail.com</li>
								<li><i class="fa fa-phone"></i>(+123) 123 123 123</li>
								<li><i class="fa fa-plane"></i>www.yourdomainname.com</li>
								<li><i class="fa fa-skype"></i>skype.address</li>
							</ul>
						</div>
						<div class="agent_social">
							<ul class="list-inline">
								<li><a href="#" class="top_f_facebook"><img src="assets/images/icon/fb.svg" alt="" /></a></li>
								<li><a href="#" class="top_f_facebook"><img src="assets/images/icon/tw.svg" alt="" /></a></li>
								<li><a href="#" class="top_f_facebook"><img src="assets/images/icon/pn.svg" alt="" /></a></li>
								<li><a href="#" class="top_f_facebook"><img src="assets/images/icon/ins.svg" alt="" /></a></li>
							</ul>
						</div>
					</div><!--- END SINGLE ITEM -->
			  </div><!--- END COL -->
			</div><!--- END ROW -->
		</div><!--- END CONTAINER -->
	</section>
	<!-- END AGENT PROFILE -->

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

	<!--START COURSE -->
	<div class="best-cpurse section-padding">
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
	</div>
	<!--END COURSE -->

@endsection
