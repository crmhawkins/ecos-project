@extends('layouts.web_layout')

@section('title', 'Index 2')

@section('css')
@endsection

@section('content')

	<!-- START HOME -->
	<section  id="home" class="home_bg2" style="background-image: url(assets/images/banner/home2.png);  background-size:cover; background-position: center center;">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-sm-12 col-xs-12 text-center">
					<div class="home_content hc_pt">
						<h1>Get smart <span><u>opportunity for</u></span> your best future</h1>
						<p>It is a long established fact that reader will be distracted readable content of a page when.</p>
					</div>
					<div class="home_sb">
						<form action="#" class="banner_subs">
							<input type="text" class="form-control home_si" placeholder="Search your course here" required="required">
							<button type="button" class="subscribe__btn">Search <i class="fa fa-paper-plane-o"></i></button>
						</form>
					</div>
					<div class="home_tag">
						<span>Popular Topic:</span>
						<a href="#">Design, </a>
						<a href="#">Development, </a>
						<a href="#">Graphics, </a>
						<a href="#">Marketing </a>
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
				<div class="col-lg-4 col-sm-4 col-xs-12 no-padding wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s" data-wow-offset="0">
					<div class="single_tp">
						<h3>Quality Education</h3>
						<p>Lorem ipsum dolor sit amet, consectetur notted adipisicing elit sed do eiusmod tempor incididunt ut labore. </p>
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
						<h3>Life Time Support</h3>
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

	<!-- START TOPIC-->
	<section class="topic_content_p2 section-padding">
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
				<div class="col-lg-12 text-center">
					<div class="cc_btn">
						<a class="btn_one" href="course">View All category</a>
					</div>
				</div><!--END COL -->
			</div><!-- END ROW -->
		</div><!-- END CONTAINER -->
	</section>
	<!-- END TOPIC -->

	<!-- START ABOUT US HOME ONE -->
	<section class="ab_one section-padding">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-sm-12 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s" data-wow-offset="0">
					<div class="ab_img">
						<img src="assets/images/all-img/about2.png" class="img-fluid" alt="image">
					</div>
				</div><!--- END COL -->
				<div class="col-lg-6 col-sm-12 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s" data-wow-offset="0">
					<div class="ab_content">
						<h2>Learn new skills to go <u><span>ahead for your </span></u> career.</h2>
						<p>Lorem ipsum dolor sit amet, consectetur notted adipisicing elit sed do eiusmod tempor incididunt ut labore et simply. From blogs to emails to ad copies, auto-generate catchy, original, and high-converting copies in popular tones languages.From blogs to emails to ad copies, auto-generate catchy, original and high-converting copies.</p>
						<p><strong>Auto-generate catchy original and high-converting copies in popular tones languages. From blogs to emails to ad copies auto-generate catchy</strong></p>
						<a class="btn_one" href="about">Read More us</a>
					</div>
				</div><!--- END COL -->
			</div><!--- END ROW -->
		</div><!--- END CONTAINER -->
	</section>
	<!-- END ABOUT US HOME ONE -->

	<!--START COURSE -->
	<div class="bc_bg_two section-padding">
		<div class="container">
			<div class="section-title">
			  <h2>Popular Courses</h2>
			  <p>Choose Our <span><u>Top Courses</u></span></p>
			</div>
			<div class="row">
				<div class="col-lg-6 col-sm-12 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s" data-wow-offset="0">
					<div class="course-slide2">
						<div class="course-img2">
							<img src="assets/images/all-img/c1.png" alt="">
							<div class="course-date2">
								<span class="month2">$49</span>
							</div>
						</div>
						<div class="course-content2"><a class="c_btn2" href="single_course">Arts & Design</a>
							<h3><a href="single_course">Basic Fundamentals of Interior & Graphics Design</a></h3>
							<div class="co_list">
								<span><i class="fa fa-calendar"></i>3 Lessons</span>
								<span><i class="fa fa-clock-o"></i>3h 45m</span>
								<span><i class="fa fa-star"></i>4.9</span>
								<span><i class="fa fa-table"></i><strong>30 Seats Available</strong></span>
							</div>
						</div>
					</div><!--END COURSE SLIDE -->
				</div><!--END COL -->
				<div class="col-lg-6 col-sm-12 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s" data-wow-offset="0">
					<div class="course-slide2">
						<div class="course-img2">
							<img src="assets/images/all-img/c2.png" alt="">
							<div class="course-date2">
								<span class="month2">$39</span>
							</div>
						</div>
						<div class="course-content2"><a class="c_btn2" href="single_course">Social</a>
							<h3><a href="single_course">Increasing Engagement with Instagram & Facebook</a></h3>
							<div class="co_list">
								<span><i class="fa fa-calendar"></i>3 Lessons</span>
								<span><i class="fa fa-clock-o"></i>3h 45m</span>
								<span><i class="fa fa-star"></i>4.9</span>
								<span><i class="fa fa-table"></i><strong>30 Seats Available</strong></span>
							</div>
						</div>
					</div><!--END COURSE SLIDE -->
				</div><!--END COL -->
				<div class="col-lg-6 col-sm-12 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s" data-wow-offset="0">
					<div class="course-slide2">
						<div class="course-img2">
							<img src="assets/images/all-img/c3.png" alt="">
							<div class="course-date2">
								<span class="month2">$29</span>
							</div>
						</div>
						<div class="course-content2"><a class="c_btn2" href="single_course">Design</a>
							<h3><a href="single_course">Introduction to Color Theory & Basic UI/UX</a></h3>
							<div class="co_list">
								<span><i class="fa fa-calendar"></i>3 Lessons</span>
								<span><i class="fa fa-clock-o"></i>3h 45m</span>
								<span><i class="fa fa-star"></i>4.9</span>
								<span><i class="fa fa-table"></i><strong>30 Seats Available</strong></span>
							</div>
						</div>
					</div><!--END COURSE SLIDE -->
				</div><!--END COL -->
				<div class="col-lg-6 col-sm-12 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s" data-wow-offset="0">
					<div class="course-slide2">
						<div class="course-img2">
							<img src="assets/images/all-img/c4.png" alt="">
							<div class="course-date2">
								<span class="month2">$59</span>
							</div>
						</div>
						<div class="course-content2"><a class="c_btn2" href="single_course">Technology</a>
							<h3><a href="single_course">Financial Security Thinking and Principles Theory</a></h3>
							<div class="co_list">
								<span><i class="fa fa-calendar"></i>3 Lessons</span>
								<span><i class="fa fa-clock-o"></i>3h 45m</span>
								<span><i class="fa fa-star"></i>4.9</span>
								<span><i class="fa fa-table"></i><strong>30 Seats Available</strong></span>
							</div>
						</div>
					</div><!--END COURSE SLIDE -->
				</div><!--END COL -->
				<div class="col-lg-6 col-sm-12 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s" data-wow-offset="0">
					<div class="course-slide2">
						<div class="course-img2">
							<img src="assets/images/all-img/c5.png" alt="">
							<div class="course-date2">
								<span class="month2">$69</span>
							</div>
						</div>
						<div class="course-content2"><a class="c_btn2" href="single_course">Data Science</a>
							<h3><a href="single_course">Logo Design: From Concept to Presentation</a></h3>
							<div class="co_list">
								<span><i class="fa fa-calendar"></i>3 Lessons</span>
								<span><i class="fa fa-clock-o"></i>3h 45m</span>
								<span><i class="fa fa-star"></i>4.9</span>
								<span><i class="fa fa-table"></i><strong>30 Seats Available</strong></span>
							</div>
						</div>
					</div><!--END COURSE SLIDE -->
				</div><!--END COL -->
				<div class="col-lg-6 col-sm-12 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s" data-wow-offset="0">
					<div class="course-slide2">
						<div class="course-img2">
							<img src="assets/images/all-img/c6.png" alt="">
							<div class="course-date2">
								<span class="month2">$99</span>
							</div>
						</div>
						<div class="course-content2"><a class="c_btn2" href="single_course">Development</a>
							<h3><a href="single_course">Professional Ceramic Moulding for Beginners</a></h3>
							<div class="co_list">
								<span><i class="fa fa-calendar"></i>3 Lessons</span>
								<span><i class="fa fa-clock-o"></i>3h 45m</span>
								<span><i class="fa fa-star"></i>4.9</span>
								<span><i class="fa fa-table"></i><strong>30 Seats Available</strong></span>
							</div>
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

	<!-- START VIDEO -->
	<section class="vid_area section-padding" style="background-image: url(assets/images/banner/video.jpg);  background-size:cover; background-position: center center;background-attachment:fixed;">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 vp_top wow fadeInUDown" data-wow-duration="1s" data-wow-delay="0.2s" data-wow-offset="0">
					<div class="video-area">
						<a href="https://www.youtube.com/watch?v=RXv_uIN6e-Y" class="magnific_popup video-button"><i class="fa fa-play"></i></a>
					</div>
				</div><!--- END COL -->
			</div><!--- END ROW -->
		</div><!--- END CONTAINER -->
	</section>
	<!-- END VIDEO -->

	<!-- START COMPANY PARTNER LOGO  -->
	<div class="partner-logo section-padding">
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
	</div>
	<!-- END COMPANY PARTNER LOGO -->

	<!-- START COURSE PROMOTION -->
	<section class="course_promo section-padding">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-sm-12 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s" data-wow-offset="0">
					<div class="cp_content">
						<h4>Best Online Learning Platform</h4>
						<h2>Grow Your Skill, Define Your <span><u>Bright Future</u></span> For You</h2>
						<p>From blogs to emails to ad copies, auto-generate catchy, original, and high-converting copies in popular tones languages.</p>
						<ul>
							<li><span class="ti-check"></span>Learn At Your Own Multiple Courses </li>
							<li><span class="ti-check"></span>We Provide Study Materials </li>
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
						<img src="assets/images/all-img/about5.png" class="img-fluid" alt="image">
					</div>
				</div><!--- END COL -->
			</div><!--- END ROW -->
		</div><!--- END CONTAINER -->
	</section>
	<!-- END COURSE PROMOTION -->

	<!-- START PRICING -->
	<section id="pricing" class="price_area section-padding">
		<div class="container">
			<div class="section-title">
				<h2>Pricing Plan</h2>
				<p>Take A Look At The <span><u>pricing plan</u></span></p>
			</div>
			<div class="row">
				<div class="col-lg-4 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s" data-wow-offset="0">
					<div class="pricing_design">
						<div class="single-pricing">
							<div class="price-head">
								<h2>Free</h2>
								<h1>$0</h1>
								<span>/Monthly</span>
								<span class="upgrade_price">Upgrade as you need</span>
							</div>
							<ul>
								<li><span class="ti-notepad"></span> Learn at your own pace</li>
								<li><span class="ti-file"></span> Learn at your own pace</li>
								<li><span class="ti-light-bulb"></span> Learn at your own pace</li>
								<li><span class="ti-star"></span> Learn at your own pace</li>
								<li><span class="ti-image"></span> Learn at your own pace</li>
								<li><span class="ti-flag"></span> Learn at your own pace</li>
							</ul>
							<div class="pricing-price">

							</div>
							<a href="#" class="price_btn">Start Now</a>
						</div>
					</div>
				</div><!--- END COL -->
				<div class="col-lg-4 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s" data-wow-offset="0">
					<div class="pricing_design">
						<div class="single-pricing">
							<div class="price-head">
								<h2>Saver plan</h2>
								<h1 class="price">$29</h1>
								<span>/Monthly</span>
								<span class="upgrade_price">$348 Per Year</span>
							</div>
							<ul>
								<li><span class="ti-notepad"></span> Learn at your own pace</li>
								<li><span class="ti-file"></span> Learn at your own pace</li>
								<li><span class="ti-light-bulb"></span> Learn at your own pace</li>
								<li><span class="ti-star"></span> Learn at your own pace</li>
								<li><span class="ti-image"></span> Learn at your own pace</li>
								<li><span class="ti-flag"></span> Learn at your own pace</li>
							</ul>
							<div class="pricing-price">

							</div>
							<a href="#" class="price_btn">Subscribe Now</a>
						</div>
					</div>
				</div><!--- END COL -->
				<div class="col-lg-4 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.3s" data-wow-offset="0">
					<div class="pricing_design">
						<div class="single-pricing">
							<div class="price-head">
								<h2>Unlimited plan</h2>
								<h1 class="price">$49</h1>
								<span>/Monthly</span>
								<span class="upgrade_price">$588 Per Year</span>
							</div>
							<ul>
								<li><span class="ti-notepad"></span> Learn at your own pace</li>
								<li><span class="ti-file"></span> Learn at your own pace</li>
								<li><span class="ti-light-bulb"></span> Learn at your own pace</li>
								<li><span class="ti-star"></span> Learn at your own pace</li>
								<li><span class="ti-image"></span> Learn at your own pace</li>
								<li><span class="ti-flag"></span> Learn at your own pace</li>
							</ul>
							<div class="pricing-price">

							</div>
							<a href="#" class="price_btn">Subscribe Now</a>
						</div>
					</div>
				</div><!--- END COL -->
			</div><!--- END ROW -->
		</div><!--- END CONTAINER -->
	</section>
	<!-- END PRICING -->

	<!-- START NEWSLETTER -->
	<section class="newsletter_area section-padding">
		<div class="container">
			<div class="row text-center">
				<div class="col-lg-6 offset-lg-3 col-sm-12 col-xs-12">
					<div class="subs_form">
						<h3>Subscripbe to our newsletter, We don't make any spam.</h3>
						<p>Lorem ipsum dolor sit amet consectetur adipisicing elitsed eiusmod tempor enim minim</p>
						<form action="#" class="home_subs">
							<input type="text" class="form-control subscribe__input" placeholder="Enter your Email Address" required="required">
							<button type="button" class="subscribe__btn"><i class="fa fa-paper-plane-o"></i></button>
						</form>
					</div>
				</div><!-- END COL -->
			</div><!-- END ROW -->
		</div><!--- END CONTAINER -->
	</section>
	<!-- END NEWSLETTER -->

	<!-- START BLOG -->
	<section id="blog" class="blog_area section-padding">
		<div class="container">
			<div class="section-title">
				<h2>Blog & Airticle</h2>
				<p>Take A Look At The <span><u>Latest Articles</u></span></p>
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
					<div class="single_blog">
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
