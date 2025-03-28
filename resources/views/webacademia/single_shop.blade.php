@extends('webacademia.layouts.web_layout')

@section('title', 'Single shop')

@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/niceselect.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/shop.css') }}">
@endsection

@section('content')

	<!-- START SECTION TOP -->
	<section class="section-top">
		<div class="container">
			<div class="col-lg-10 offset-lg-1 text-center">
				<div class="section-top-title wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.3s" data-wow-offset="0">
					<h1>Single Shop Page</h1>
					<ul>
						<li><a href="index">Home</a></li>
						<li> / single shop</li>
					</ul>
				</div><!-- //.HERO-TEXT -->
			</div><!--- END COL -->
		</div><!--- END CONTAINER -->
	</section>
	<!-- END SECTION TOP -->

<!-- Product Details Area  -->
	<div class="prdct_dtls_page_area section-padding">
		<div class="container">
			<div class="row">
				<!-- Product Details Image -->
				<div class="col-md-6 col-xs-12">
					<div class="pd_img fix">
						<a class="venobox" href="assets/images/shop/3.jpg"><img src="assets/images/shop/3.jpg" class="img-fluid" alt=""/></a>
					</div>
				</div>
				<!-- Product Details Content -->
				<div class="col-md-6 col-xs-12">
					<div class="prdct_dtls_content">
						<a class="pd_title" href="#">Best Selling ebook</a>
						<div class="pd_price_dtls fix">
							<!-- Product Price -->
							<div class="pd_price">
								<span class="new">$ 20.00</span>
								<span class="old">(60.00)</span>
							</div>
							<!-- Product Ratting -->
							<div class="pd_ratng">
								<div class="rtngs">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star-half-o"></i>
								</div>
							</div>
						</div>
						<div class="pd_text">
							<h4>overview:</h4>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tem portul indunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud  exercitation ullamco laboris nisi ut aliquip.</p>
						</div>
						<div class="pd_img_size fix">
							<h4>size:</h4>
							<a href="#">s</a>
							<a href="#">m</a>
							<a href="#">l</a>
							<a href="#">xl</a>
							<a href="#">xxl</a>
						</div>
						<div class="pd_clr_qntty_dtls fix">
							<div class="pd_clr">
								<h4>color:</h4>
								<a href="#" class="active" style="background: #ffac9a;">color 1</a>
								<a href="#" style="background: #ddd;">color 2</a>
								<a href="#" style="background: #000000;">color 3</a>
							</div>
							<div class="pd_qntty_area">
								<h4>quantity:</h4>
								<div class="pd_qty fix">
									<input value="1" name="qttybutton" class="cart-plus-minus-box" type="number">
								</div>
							</div>
						</div>
						<!-- Product Action -->
						<div class="pd_btn fix">
							<a class="btn btn-default acc_btn">add to bag</a>
							<a class="btn btn-default acc_btn btn_icn"><i class="fa fa-heart"></i></a>
							<a class="btn btn-default acc_btn btn_icn"><i class="fa fa-refresh"></i></a>
						</div>
						<div class="pd_share_area fix">
							<h4>share this on:</h4>
							<div class="pd_social_icon">
								<a href="#"><i class="fa fa-facebook"></i></a>
								<a href="#"><i class="fa fa-twitter"></i></a>
								<a href="#"><i class="fa fa-vimeo"></i></a>
								<a href="#"><i class="fa fa-google-plus"></i></a>
								<a href="#"><i class="fa fa-tumblr"></i></a>
								<a href="#"><i class="fa fa-pinterest"></i></a>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-xs-12">
					<div class="pd_tab_area fix">
						<ul class="pd_tab_btn nav nav-tabs" role="tablist">
						  <li>
							<a class="active" href="#description" role="tab" data-bs-toggle="tab">Description</a>
						  </li>
						  <li>
							<a href="#information" role="tab" data-bs-toggle="tab">Information</a>
						  </li>
						  <li>
							<a href="#reviews" role="tab" data-bs-toggle="tab">Reviews</a>
						  </li>
						</ul>

						<!-- Tab panes -->
						<div class="tab-content">
							<div role="tabpanel" class="tab-pane fade show active" id="description">
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
								incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
								exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure
								dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
								Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit
								anim id est laborum.</p>
								<ul>
									<li>Lorem ipsum dolor sit amet, consectetur product</li>
									<li>Duis aute irure dolor in reprehenderit in voluptate velit esse</li>
									<li>Excepteur sinted occaecat cupidatat non proident products</li>
									<li>Voluptate velit esse cillum.</li>
								</ul>
							</div>

							<div role="tabpanel" class="tab-pane fade" id="information">
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
								incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
								exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure
								dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. </p>
							</div>

								<div role="tabpanel" class="tab-pane fade" id="reviews">
									<div class="pda_rtng_area fix">
										<h4>4.5 <span>(Overall)</span></h4>
										<span>Based on 9 Comments</span>
									</div>
									<div class="rtng_cmnt_area fix">
										<div class="single_rtng_cmnt">
											<div class="rtngs">
												<i class="fa fa-star"></i>
												<i class="fa fa-star"></i>
												<i class="fa fa-star"></i>
												<i class="fa fa-star"></i>
												<i class="fa fa-star-o"></i>
											<span>(4)</span>
											</div>
											<div class="rtng_author">
												<h3>John Doe</h3>
												<span>11:20</span>
												<span>6 May 2023</span>
											</div>
											<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Utenim ad minim veniam, quis nost rud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Utenim ad minim veniam, quis nost.</p>
										</div>

									</div>
									<div class="col-md-6 rcf_pdnglft">
										<div class="rtng_cmnt_form_area fix">
											<h3>Add your Comments</h3>
											<div class="rtng_form">
												<form action="#">
													<div class="input-area"><input type="text" placeholder="Type your name" /></div>
													<div class="input-area"><input type="text" placeholder="Type your email address" /></div>
													<div class="input-area"><textarea name="message" placeholder="Write a review"></textarea></div>
													<input class="btn acc_btn" type="submit" value="Add Review" />
												</form>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>


	<!-- Related Product Area -->
	<div class="related_prdct_area text-center">
		<div class="container">
				<!-- Section Title -->
				<div class="rp_title text-center"><h3>Related products</h3></div>

				<div class="row">
					<div class="col-lg-3 col-md-4 col-sm-6">
						<div class="product-grid">
							<div class="product-image">
								<a href="#">
									<img class="pic-1" src="assets/images/shop/1.jpg" alt="Product Image">
									<img class="pic-2" src="assets/images/shop/2.jpg" alt="Product Image">
								</a>
								<ul class="social">
									<li><a href="" data-tip="Quick View"><i class="ti-zoom-in"></i></a></li>
									<li><a href="" data-tip="Add to Wishlist"><i class="ti-bag"></i></a></li>
									<li><a href="" data-tip="Add to Cart"><i class="ti-shopping-cart"></i></a></li>
								</ul>
								<span class="product-new-label">Sale</span>
							</div>
							<ul class="rating">
								<li class="fa fa-star"></li>
								<li class="fa fa-star"></li>
								<li class="fa fa-star"></li>
								<li class="fa fa-star"></li>
								<li class="fa fa-star"></li>
							</ul>
							<div class="product-content">
								<h3 class="title"><a href="#">Product Title</a></h3>
								<div class="price">$16.00
									<span>$20.00</span>
								</div>
								<a class="add-to-cart" href="">+ Add To Cart</a>
							</div>
						</div>
					</div><!-- End Col -->

					<div class="col-lg-3 col-md-4 col-sm-6">
						<div class="product-grid">
							<div class="product-image">
								<a href="#">
									<img class="pic-1" src="assets/images/shop/3.jpg" alt="Product Image">
									<img class="pic-2" src="assets/images/shop/4.jpg" alt="Product Image">
								</a>
								<ul class="social">
									<li><a href="" data-tip="Quick View"><i class="ti-zoom-in"></i></a></li>
									<li><a href="" data-tip="Add to Wishlist"><i class="ti-bag"></i></a></li>
									<li><a href="" data-tip="Add to Cart"><i class="ti-shopping-cart"></i></a></li>
								</ul>
								<span class="product-new-label">-20%</span>
							</div>
							<ul class="rating">
								<li class="fa fa-star"></li>
								<li class="fa fa-star"></li>
								<li class="fa fa-star"></li>
								<li class="fa fa-star"></li>
								<li class="fa fa-star"></li>
							</ul>
							<div class="product-content">
								<h3 class="title"><a href="#">Product Title</a></h3>
								<div class="price">$16.00
									<span>$20.00</span>
								</div>
								<a class="add-to-cart" href="">+ Add To Cart</a>
							</div>
						</div>
					</div><!-- End Col -->

					<div class="col-lg-3 col-md-4 col-sm-6">
						<div class="product-grid">
							<div class="product-image">
								<a href="#">
									<img class="pic-1" src="assets/images/shop/5.jpg" alt="Product Image">
									<img class="pic-2" src="assets/images/shop/6.jpg" alt="Product Image">
								</a>
								<ul class="social">
									<li><a href="" data-tip="Quick View"><i class="ti-zoom-in"></i></a></li>
									<li><a href="" data-tip="Add to Wishlist"><i class="ti-bag"></i></a></li>
									<li><a href="" data-tip="Add to Cart"><i class="ti-shopping-cart"></i></a></li>
								</ul>
								<span class="product-new-label">Sale</span>
							</div>
							<ul class="rating">
								<li class="fa fa-star"></li>
								<li class="fa fa-star"></li>
								<li class="fa fa-star"></li>
								<li class="fa fa-star"></li>
								<li class="fa fa-star disable"></li>
							</ul>
							<div class="product-content">
								<h3 class="title"><a href="#">Product Title</a></h3>
								<div class="price">$16.00
									<span>$20.00</span>
								</div>
								<a class="add-to-cart" href="">+ Add To Cart</a>
							</div>
						</div>
					</div><!-- End Col -->


					<div class="col-lg-3 col-md-4 col-sm-6">
						<div class="product-grid">
							<div class="product-image">
								<a href="#">
									<img class="pic-1" src="assets/images/shop/7.jpg" alt="Product Image">
									<img class="pic-2" src="assets/images/shop/8.jpg" alt="Product Image">
								</a>
								<ul class="social">
									<li><a href="" data-tip="Quick View"><i class="ti-zoom-in"></i></a></li>
									<li><a href="" data-tip="Add to Wishlist"><i class="ti-bag"></i></a></li>
									<li><a href="" data-tip="Add to Cart"><i class="ti-shopping-cart"></i></a></li>
								</ul>
								<span class="product-new-label">New</span>
							</div>
							<ul class="rating">
								<li class="fa fa-star"></li>
								<li class="fa fa-star"></li>
								<li class="fa fa-star"></li>
								<li class="fa fa-star"></li>
								<li class="fa fa-star"></li>
							</ul>
							<div class="product-content">
								<h3 class="title"><a href="#">Product Title</a></h3>
								<div class="price">$16.00
									<span>$20.00</span>
								</div>
								<a class="add-to-cart" href="">+ Add To Cart</a>
							</div>
						</div>
					</div><!-- End Col -->
			</div>
		</div>
	</div>

	<!-- START FOOTER -->
	<div class="footer section-padding">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-sm-6 col-xs-12">
					<div class="single_footer">
						<a href="index"><img src="assets/images/all-img/logo2.png" alt=""></a>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce vitae risus nec dui venenatis dignissim.</p>
					</div>
					<div class="foot_social">
						<ul>
							<li><a href="#">TW</a></li>
							<li><a href="#">FB</a></li>
							<li><a href="#">INS</a></li>
							<li><a href="#">YT</a></li>
						</ul>
					</div>
				</div><!--- END COL -->
				<div class="col-lg-3 col-sm-6 col-xs-12">
					<div class="single_footer">
						<h4>Courses</h4>
						<ul>
							<li><a href="#">Creative Writing</a></li>
							<li><a href="#">Digital Marketing</a></li>
							<li><a href="#">SEO Business</a></li>
							<li><a href="#">Social Marketing</a></li>
							<li><a href="#">Graphic Design</a></li>
							<li><a href="#">Website Development</a></li>
						</ul>
					</div>
				</div><!--- END COL -->
				<div class="col-lg-3 col-sm-6 col-xs-12">
					<div class="single_footer">
						<h4>Company</h4>
						<ul>
							<li><a href="#">About us</a></li>
							<li><a href="#">Knowledge Base</a></li>
							<li><a href="#">Affiliate Program</a></li>
							<li><a href="#">Community</a></li>
							<li><a href="#">Market API</a></li>
							<li><a href="#">Support team</a></li>
						</ul>
					</div>
				</div><!--- END COL -->
				<div class="col-lg-3 col-sm-6 col-xs-12">
					<div class="single_footer">
						<h4>Contact Info</h4>
						<div class="sf_contact">
							<span class="ti-mobile"></span>
							<h3>Phone number</h3>
							<p>+88 457 845 695</p>
						</div>
						<div class="sf_contact">
							<span class="ti-email"></span>
							<h3>Email Address</h3>
							<p>example#yourmail.com</p>
						</div>
						<div class="sf_contact">
							<span class="ti-map"></span>
							<h3>Office Address</h3>
							<p>California, USA</p>
						</div>
					</div>
				</div><!--- END COL -->
			</div><!--- END ROW -->
			<div class="row fc">
				<div class="col-lg-6 col-sm-6 col-xs-12">
					<div class="footer_copyright">
						<p>&copy; 2023. All Rights Reserved.</p>
					</div>
				</div>
				<div class="col-lg-6 col-sm-6 col-xs-12">
					<div class="footer_menu">
						<ul>
							<li><a href="#">Terms of use</a></li>
							<li><a href="#">Privacy Policy</a></li>
							<li><a href="#">Cookie Policy</a></li>
						</ul>
					</div>
				</div><!-- END COL -->
			</div>
		</div><!--- END CONTAINER -->
	</div>
	<!-- END FOOTER -->

	<!-- Latest jQuery -->
		<script src="assets/js/jquery-1.12.4.min.js"></script>
	<!-- Latest compiled and minified Bootstrap -->
		<script src="assets/bootstrap/js/bootstrap.min.js"></script>
	<!-- owl-carousel min js  -->
		<script src="assets/owlcarousel/js/owl.carousel.min.js"></script>
	<!-- jquery.slicknav -->
		<script src="assets/js/jquery.slicknav.js"></script>
	<!-- magnific-popup js -->
		<script src="assets/js/jquery.magnific-popup.min.js"></script>
	<!-- scrolltopcontrol js -->
		<script src="assets/js/scrolltopcontrol.js"></script>
	<!-- jquery mixitup min js -->
		<script src="assets/js/jquery.mixitup.js"></script>
	<!-- jquery purecounter vanilla js -->
		<script src="assets/js/purecounter_vanilla.js"></script>
		<script src="assets/js/nicesellect.js"></script>
	<!-- WOW - Reveal Animations When You Scroll -->
		<script src="assets/js/wow.min.js"></script>
	<!-- scripts js -->
		<script src="assets/js/scripts.js"></script>
		<script type="text/javascript">
			$('select').niceSelect();
		</script>
</body>
</html>
