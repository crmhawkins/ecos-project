@extends('layouts.web_layout')

@section('title', 'Tienda')

@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/shop.css') }}">
@endsection

@section('content')

	<!-- START SECTION TOP -->
	<section class="section-top">
		<div class="container">
			<div class="col-lg-10 offset-lg-1 text-center">
				<div class="section-top-title wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.3s" data-wow-offset="0">
					<h1>Shop Page</h1>
					<ul>
						<li><a href="index">Home</a></li>
						<li> / shop</li>
					</ul>
				</div><!-- //.HERO-TEXT -->
			</div><!--- END COL -->
		</div><!--- END CONTAINER -->
	</section>
	<!-- END SECTION TOP -->

	<!-- Start product Area -->
	<section id="product_area" class="section-padding">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="section-title">
					  <h2>Our Products</h2>
					  <p>Check Our <span><u>All Products</u></span></p>
					</div>
				</div>
			</div>

			<div class="text-center">
				<div class="product_filter">
					<ul>
						<li class=" active filter" data-filter="all">All</li>
						<li class="filter" data-filter=".sale">Sale</li>
						<li class="filter" data-filter=".bslr">Bestseller</li>
						<li class="filter" data-filter=".ftrd">Featured</li>
					</ul>
				</div>

				<div class="product_item">
					<div class="row">
						<div class="col-lg-3 col-md-4 col-sm-6 mix sale">
							<div class="product-grid">
								<div class="product-image">
									<a href="single_shop">
										<img class="pic-1" src="assets/images/shop/1.jpg" alt="product image">
										<img class="pic-2" src="assets/images/shop/2.jpg" alt="product image">
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
									<h3 class="title"><a href="single_shop">Product Title</a></h3>
									<div class="price">$16.00
										<span>$20.00</span>
									</div>
									<a class="add-to-cart" href="">+ Add To Cart</a>
								</div>
							</div>
						</div><!-- End Col -->

						<div class="col-lg-3 col-md-4 col-sm-6 mix ftrd">
							<div class="product-grid">
								<div class="product-image">
									<a href="single_shop">
										<img class="pic-1" src="assets/images/shop/3.jpg" alt="product image">
										<img class="pic-2" src="assets/images/shop/4.jpg" alt="product image">
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
									<h3 class="title"><a href="single_shop">Product Title</a></h3>
									<div class="price">$16.00
										<span>$20.00</span>
									</div>
									<a class="add-to-cart" href="">+ Add To Cart</a>
								</div>
							</div>
						</div><!-- End Col -->

						<div class="col-lg-3 col-md-4 col-sm-6 mix">
							<div class="product-grid">
								<div class="product-image">
									<a href="single_shop">
										<img class="pic-1" src="assets/images/shop/5.jpg" alt="product image">
										<img class="pic-2" src="assets/images/shop/6.jpg" alt="product image">
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
									<h3 class="title"><a href="single_shop">Product Title</a></h3>
									<div class="price">$16.00
										<span>$20.00</span>
									</div>
									<a class="add-to-cart" href="">+ Add To Cart</a>
								</div>
							</div>
						</div><!-- End Col -->


						<div class="col-lg-3 col-md-4 col-sm-6 mix sale bslr">
							<div class="product-grid">
								<div class="product-image">
									<a href="single_shop">
										<img class="pic-1" src="assets/images/shop/7.jpg" alt="product image">
										<img class="pic-2" src="assets/images/shop/8.jpg" alt="product image">
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
									<h3 class="title"><a href="single_shop">Product Title</a></h3>
									<div class="price">$16.00
										<span>$20.00</span>
									</div>
									<a class="add-to-cart" href="">+ Add To Cart</a>
								</div>
							</div>
						</div><!-- End Col -->


						<div class="col-lg-3 col-md-4 col-sm-6 mix ftrd">
							<div class="product-grid">
								<div class="product-image">
									<a href="single_shop">
										<img class="pic-1" src="assets/images/shop/5.jpg" alt="product image">
										<img class="pic-2" src="assets/images/shop/6.jpg" alt="product image">
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
									<h3 class="title"><a href="single_shop">Product Title</a></h3>
									<div class="price">$16.00
										<span>$20.00</span>
									</div>
									<a class="add-to-cart" href="">+ Add To Cart</a>
								</div>
							</div>
						</div><!-- End Col -->

						<div class="col-lg-3 col-md-4 col-sm-6 mix sale bslr">
							<div class="product-grid">
								<div class="product-image">
									<a href="single_shop">
										<img class="pic-1" src="assets/images/shop/1.jpg" alt="product image">
										<img class="pic-2" src="assets/images/shop/2.jpg" alt="product image">
									</a>
									<ul class="social">
										<li><a href="" data-tip="Quick View"><i class="ti-zoom-in"></i></a></li>
										<li><a href="" data-tip="Add to Wishlist"><i class="ti-bag"></i></a></li>
										<li><a href="" data-tip="Add to Cart"><i class="ti-shopping-cart"></i></a></li>
									</ul>
									<span class="product-new-label">-30%</span>
								</div>
								<ul class="rating">
									<li class="fa fa-star"></li>
									<li class="fa fa-star"></li>
									<li class="fa fa-star"></li>
									<li class="fa fa-star"></li>
									<li class="fa fa-star"></li>
								</ul>
								<div class="product-content">
									<h3 class="title"><a href="single_shop">Product Title</a></h3>
									<div class="price">$16.00
										<span>$20.00</span>
									</div>
									<a class="add-to-cart" href="">+ Add To Cart</a>
								</div>
							</div>
						</div><!-- End Col -->

						<div class="col-lg-3 col-md-4 col-sm-6 mix sale bslr">
							<div class="product-grid">
								<div class="product-image">
									<a href="single_shop">
										<img class="pic-1" src="assets/images/shop/7.jpg" alt="product image">
										<img class="pic-2" src="assets/images/shop/8.jpg" alt="product image">
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
									<h3 class="title"><a href="single_shop">Product Title</a></h3>
									<div class="price">$16.00
										<span>$20.00</span>
									</div>
									<a class="add-to-cart" href="">+ Add To Cart</a>
								</div>
							</div>
						</div><!-- End Col -->


						<div class="col-lg-3 col-md-4 col-sm-6 mix sale bslr">
							<div class="product-grid">
								<div class="product-image">
									<a href="single_shop">
										<img class="pic-1" src="assets/images/shop/3.jpg" alt="product image">
										<img class="pic-2" src="assets/images/shop/4.jpg" alt="product image">
									</a>
									<ul class="social">
										<li><a href="" data-tip="Quick View"><i class="ti-zoom-in"></i></a></li>
										<li><a href="" data-tip="Add to Wishlist"><i class="ti-bag"></i></a></li>
										<li><a href="" data-tip="Add to Cart"><i class="ti-shopping-cart"></i></a></li>
									</ul>
									<span class="product-new-label">-50%</span>
								</div>
								<ul class="rating">
									<li class="fa fa-star"></li>
									<li class="fa fa-star"></li>
									<li class="fa fa-star"></li>
									<li class="fa fa-star"></li>
									<li class="fa fa-star"></li>
								</ul>
								<div class="product-content">
									<h3 class="title"><a href="single_shop">Product Title</a></h3>
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
		</div>
	</section>
	<!-- End product Area -->

@endsection
