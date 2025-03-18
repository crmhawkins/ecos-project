@extends('webacademia.layouts.web_layout')

@section('title', 'Event Single')

@section('css')
@endsection

@section('content')

	<!-- START SECTION TOP -->
	<section class="section-top">
		<div class="container">
			<div class="col-lg-10 offset-lg-1 text-center">
				<div class="section-top-title wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.3s" data-wow-offset="0">
					<h1>Single Event</h1>
					<ul>
						<li><a href="index">Home</a></li>
						<li> / Single Event</li>
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
					<div class="col-md-8 col-sm-8 col-xs-12">
						<div class="single_event_single">
							<img alt="" class="img-responsive" src="assets/images/event/e1.png"/>
							<div class="single_event_text_single">
								 <h4>Architecture Design of International Art Fair 2023</h4>
								 <span><i class="fa fa-calendar"></i>10 Oct 2023</span>
								 <span><i class="fa fa-clock-o"></i>9.00 AM-01.00 PM</span>
								 <span><i class="fa fa-table"></i><strong>3783 Columbia Mine Road Shinnston</strong></span>
								 <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the when an unknown printer.</p>
							</div>
							<div class="single_event_text_single_description">
								<h3>Event Descriptions</h3>
								<p>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
							 </div>
						</div><!--- END SINGLE EVENT -->
					</div><!--- END COL -->
					<div class="col-md-4 col-sm-4 col-xs-12">
						<div class="event_info">
							<h3>Buy Ticket</h3>
							<ul>
								<li>
									<i class="fa fa-calendar"></i>
									<h4>Total Seats</h4>
									<p>1200</p>
								</li>
								<li>
									<i class="fa fa-clock-o"></i>
									<h4>Ticket price</h4>
									<p>$50</p>
								</li>
								<li>
									<i class="fa fa-phone"></i>
									<h4>Contact for details</h4>
									<p>+88 123 456 789</p>
								</li>
								<li>
									<i class="fa fa-map"></i>
									<h4>Event Venue</h4>
									<p>3783 Columbia Mine Road Shinnston, WV 26431 </p>
								</li>
							</ul>
							<div class="event_info_register">
								<a class="btn_one" href="course">Register For book</a>
							</div>
						</div>

					</div><!--- END COL -->
				</div><!-- END ROW -->
			</div><!-- END CONTAINER -->
		</section>
		<!-- END EVENT -->

@endsection
