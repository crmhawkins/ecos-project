@extends('webacademia.layouts.web_layout')

@section('title', 'Single course')

@section('css')
@endsection

@section('content')

	<!-- START SECTION TOP -->
	<section class="section-top">
		<div class="container">
			<div class="col-lg-10 offset-lg-1 text-center">
				<div class="section-top-title wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.3s" data-wow-offset="0">
					<h1>Course Details</h1>
					<ul>
						<li><a href="index">Home</a></li>
						<li> / Course Details</li>
					</ul>
				</div><!-- //.HERO-TEXT -->
			</div><!--- END COL -->
		</div><!--- END CONTAINER -->
	</section>
	<!-- END SECTION TOP -->

		<!-- START EVENT -->
		<section class="our_event section-padding">
			<div class="container">
				<div class="row">
					<div class="col-lg-8 col-sm-8 col-xs-12">
						<div class="single_event_single">
							<img alt="" class="img-fluid" src="assets/images/all-img/c5.png"/>
							<div class="single_event_text_single">
								 <h4>Professional Ceramic Moulding for Beginners</h4>
								<span><i class="fa fa-calendar"></i>10 Oct 2023</span>
								<span><i class="fa fa-clock-o"></i>7 days</span>
								<span><i class="fa fa-table"></i><strong>30 Seats Available</strong></span>
								 <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
								 <p>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
							</div>
						</div><!--- END SINGLE EVENT -->
                            <div class="course-details-content section-bg">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a href="#overview" class="nav-link active" data-bs-toggle="tab">Overview</a>
                                    </li>
                                    <li>
                                        <a href="#curriculum" class="nav-link" data-bs-toggle="tab">Curriculum </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#instructor" class="nav-link" data-bs-toggle="tab">instructor</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#reviews" class="nav-link" data-bs-toggle="tab">reviews</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane show fade active" id="overview">
                                        <div class="overview">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                                                labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                                                laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                                                voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                                                non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
												<iframe width="900" height="506" src="https://www.youtube.com/embed/RXv_uIN6e-Y" title="10 Excel Formula used daily at WORK (Excel formula for job interview)" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                                            <p>roin et eros varius, ornare turpis ac, dapibus nisi. Morbi luctus arcu non massa consequat, et
                                                tristique velit semper. Curabitur interdum vulputate sagittis. Donec erat massa, tincidunt sed
                                                feugiat id, suscipit in est. Proin laoreet orci quis augue eleifend varius. Donec hendrerit ex ut
                                                lacus blandit euismod. </p>
                                            <div class="details-buttons-area">
                                                <a href="#0" class="custom-button theme-one">Enroll Now <i class="fa fa-angle-right"></i></a>
                                                <a href="#0" class="custom-button bg-white">get membership</a>
                                                <ul class="social-icons">
                                                    <li>
                                                        <a href="#0" class="active"><i class="fa fa-facebook"></i></a>
                                                    </li>
                                                    <li>
                                                        <a href="#0"><i class="fa fa-twitter"></i></a>
                                                    </li>
                                                    <li>
                                                        <a href="#0"><i class="fa fa-instagram"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" role="tabpanel" id="curriculum">
                                        <div class="overview">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                                                labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                                                laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                                                voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                                                non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                                                labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                                                laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                                                voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                                                non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                            <p>roin et eros varius, ornare turpis ac, dapibus nisi. Morbi luctus arcu non massa consequat, et
                                                tristique velit semper. Curabitur interdum vulputate sagittis. Donec erat massa, tincidunt sed
                                                feugiat id, suscipit in est. Proin laoreet orci quis augue eleifend varius. Donec hendrerit ex ut
                                                lacus blandit euismod. </p>
                                            <div class="details-buttons-area">
                                                <a href="#0" class="custom-button theme-one">Enroll Now <i class="fa fa-angle-right"></i></a>
                                                <a href="#0" class="custom-button bg-white">get membership</a>
                                                <ul class="social-icons">
                                                    <li>
                                                        <a href="#0"><i class="fa fa-facebook"></i></a>
                                                    </li>
                                                    <li>
                                                        <a href="#0"><i class="fa fa-twitter"></i></a>
                                                    </li>
                                                    <li>
                                                        <a href="#0"><i class="fa fa-instagram"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="instructor">
                                        <div class="overview text-center">
                                            <div class="instructor-item">
                                                <div class="instructor-thumb">
                                                    <a href="#0"><img src="assets/images/all-img/ins-details.png" alt="instructor"></a>
                                                </div>
                                                <div class="instructor-content">
                                                    <h6 class="title"><a href="#0">Manuel Nuer</a></h6>
                                                    <span class="details">TEACHER</span>
                                                </div>
                                            </div>
                                            <p>Sed do eiusmod tempor incididunt ut
                                                labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                                                laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                                                voluptate velit esse cillum dolore eu fugiat nulla pariatur..</p>
                                            <div class="details-buttons-area">
                                                <ul class="social-icons justify-content-center w-100">
                                                    <li>
                                                        <a href="#0"><i class="fa fa-facebook"></i></a>
                                                    </li>
                                                    <li>
                                                        <a href="#0" class="active"><i class="fa fa-twitter"></i></a>
                                                    </li>
                                                    <li>
                                                        <a href="#0"><i class="fa fa-instagram"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="reviews">
                                        <div class="client-review">
                                            <div class="review-comments">
                                                <h6 class="review-title">Reviews (03)</h6>
                                                <ul class="review-contents">
                                                    <li>
                                                        <div class="thumb">
                                                            <img src="assets/images/all-img/client04.png" alt="course">
                                                        </div>
                                                        <div class="cont">
                                                            <h6 class="subtitle">Robot Smith</h6>
                                                            <div class="ratings cl-theme">
                                                                <span><i class="fa fa-star"></i></span>
                                                                <span><i class="fa fa-star"></i></span>
                                                                <span><i class="fa fa-star"></i></span>
                                                                <span><i class="fa fa-star"></i></span>
                                                                <span><i class="fa fa-star"></i></span>
                                                            </div>
                                                            <p>
                                                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim unde et culpa voluptatibus repellat voluptates aliquid minima
                                                            </p>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="thumb">
                                                            <img src="assets/images/all-img/client02.png" alt="course">
                                                        </div>
                                                        <div class="cont">
                                                            <h6 class="subtitle">Nicolas Anelca</h6>
                                                            <div class="ratings cl-theme">
                                                                <span><i class="fa fa-star"></i></span>
                                                                <span><i class="fa fa-star"></i></span>
                                                                <span><i class="fa fa-star"></i></span>
                                                                <span><i class="fa fa-star"></i></span>
                                                                <span class="cl-theme-light"><i class="fa fa-star"></i></span>
                                                            </div>
                                                            <p>
                                                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim unde et culpa voluptatibus repellat voluptates aliquid minima
                                                            </p>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="thumb">
                                                            <img src="assets/images/all-img/client03.png" alt="course">
                                                        </div>
                                                        <div class="cont">
                                                            <h6 class="subtitle">Harry Johnshon</h6>
                                                            <div class="ratings cl-theme">
                                                                <span><i class="fa fa-star"></i></span>
                                                                <span><i class="fa fa-star"></i></span>
                                                                <span><i class="fa fa-star"></i></span>
                                                                <span><i class="fa fa-star"></i></span>
                                                                <span><i class="fa fa-star"></i></span>
                                                            </div>
                                                            <p>
                                                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim unde et culpa voluptatibus repellat voluptates aliquid minima
                                                            </p>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="review-form">
                                                <h6 class="review-title">Add a Review</h6>
                                                <form class="row client-form align-items-center">
                                                    <div class="col-md-4 col-12">
                                                        <input type="text" name="name" placeholder="Full Name">
                                                    </div>
                                                    <div class="col-md-4 col-12">
                                                        <input type="text" name="email" placeholder="Email Adress">
                                                    </div>
                                                    <div class="col-md-4 col-12">
                                                        <div class="rating">
                                                            <span class="rating-title">Your Rating : </span>
                                                            <ul class="ratings">
                                                                <li>
                                                                    <a href="#0" title="Give Me One Star"><i class="fa fa-star"></i></a>
                                                                </li>
                                                                <li>
                                                                    <a href="#0" title="Give Me Two Star"><i class="fa fa-star"></i></a>
                                                                </li>
                                                                <li>
                                                                    <a href="#0" title="Give Me Three Star"><i class="fa fa-star"></i></a>
                                                                </li>
                                                                <li>
                                                                    <a href="#0" title="Give Me Four Star"><i class="fa fa-star"></i></a>
                                                                </li>
                                                                <li>
                                                                    <a href="#0" title="Give Me Five Star"><i class="fa fa-star"></i></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 col-12 d-inline-flex">
                                                        <textarea rows="5" placeholder="Type Here Message"></textarea>
                                                    </div>
                                                    <div class="col-12">
                                                        <button type="submit" class="custom-button rounded">Submit Review</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
					</div><!--- END COL -->
					<div class="col-lg-4 col-sm-4 col-xs-12">
						<div class="course_features">
							<h3>Course features</h3>
							<ul>
								<li><i class="fa fa-calendar"></i> Course duration <b>10 days</b></li>
								<li><i class="fa fa-user"></i> Total Lectures <b>30</b></li>
								<li><i class="fa fa-user"></i> Total Students <b>1000</b></li>
								<li><i class="fa fa-trophy"></i> Certification <b>YES</b></li>
							</ul>
						</div>
						<div class="event_info_price">
							<h4>Price - 60$</h4>
						</div>
						<div class="event_info_register">
							<a class="btn_one" href="#">Register Today</a>
						</div>
						<div class="related_course">
							<h3>Related Course</h3>
							<div class="single_rc">
								<div class="rc_img">
									<img src="assets/images/all-img/rc-1.png" alt="" />
								</div>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<h4><a href="#">UI/UX Design and...</a></h4>
								<span>$42.00</span>
							</div><!--- END SINGLE RELATED COURSE -->
							<div class="single_rc">
								<div class="rc_img">
									<img src="assets/images/all-img/rc-2.png" alt="" />
								</div>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<h4><a href="#">Greatest Passion In...</a></h4>
								<span>$37.00</span>
							</div><!--- END SINGLE RELATED COURSE -->
							<div class="single_rc">
								<div class="rc_img">
									<img src="assets/images/all-img/rc-3.png" alt="" />
								</div>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<h4><a href="#">incorporate your art ...</a></h4>
								<span>$21.00</span>
							</div><!--- END SINGLE RELATED COURSE -->
						</div><!--- END RELATED COURSE -->
						<div class="sidebar-post">
							<div class="sidebar_title"><h4>CATEGORIES</h4></div>
							<div class="single_category">
								<ul>
									<li><a href="#">Education <sup>11</sup></a></li>
									<li><a href="#">Ai Content <sup>44</sup></a></li>
									<li><a href="#">New Course <sup>33</sup></a></li>
									<li><a href="#">Marketing <sup>14</sup></a></li>
									<li><a href="#">Software <sup>21</sup></a></li>
									<li><a href="#">Design <sup>01</sup></a></li>
								</ul>
							</div><!-- END SOCIAL MEDIA POST -->
						</div><!-- END SIDEBAR POST -->
						<div class="sidebar-post">
							<div class="sidebar_title"><h4>Follow us</h4></div>
							<div class="single_social">
								<ul>
									<li><div class="social_item b_facebook"><a href="#" title="facebook"><i class="fa fa-facebook"></i><span class="item-list">150K Likes</span></a></div></li>

									<li><div class="social_item b_twitter"><a href="#" title="twitter"><i class="fa fa-twitter"></i><span class="item-list">138K Followers</span></a></div></li>

									<li><div class="social_item b_youtube"><a href="#" title="youtube"><i class="fa fa-youtube"></i><span class="item-list">90K Subscribers</span></a></div></li>

									<li><div class="social_item b_pinterest"><a href="#" title="pinterest"><i class="fa fa-pinterest"></i><span class="item-list">350K Followers</span></a></div></li>

									<li><div class="social_item b_tumblr"><a href="#" title="rss"><i class="fa fa-tumblr"></i><span class="item-list">901 Followers</span></a></div></li>

									<li><div class="social_item b_rss"><a href="#" title="rss"><i class="fa fa-rss"></i><span class="item-list">411 Followers</span></a></div></li>
								</ul>
							</div><!-- END SOCIAL MEDIA POST -->
						</div><!-- END SIDEBAR POST -->
					</div><!--- END COL -->
				</div><!-- END ROW -->
			</div><!-- END CONTAINER -->
		</section>
		<!-- END EVENT -->

@endsection
