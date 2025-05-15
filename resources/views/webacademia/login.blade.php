@extends('webacademia.layouts.web_layout')

@section('title', 'Login')

@section('css')
@endsection

@section('content')

	<!-- START SECTION TOP -->
	<section class="section-top">
		<div class="container">
			<div class="col-lg-10 offset-lg-1 text-center">
				<div class="section-top-title wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.3s" data-wow-offset="0">
					<h1>Inicio de Sesión</h1>
					{{-- <ul>
						<li><a href="index">Inicio</a></li>
						<li> / Login Page</li>
					</ul> --}}
				</div><!-- //.HERO-TEXT -->
			</div><!--- END COL -->
		</div><!--- END CONTAINER -->
	</section>
	<!-- END SECTION TOP -->

	<!-- START LOGIN -->
	<section class="login_register section-padding">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 offset-lg-3 col-xs-12">
					<div class="login">
						<h4 class="login_register_title">Iniciar Sesión</h4>
						<div class="form-group">
							<label for="">Usuario</label>
							<input type="text" id="contact-name" class=" form-control requiredField input-label" name="name">
						</div>
						<div class="form-group">
							<label for="">Contraseña</label>
							<input type="password" id="contact-email" class="form-control requiredField input-label" name="password" >
						</div>
						<div class="form-group col-lg-12">
							<button class="btn_one" type="submit" name="submit">Iniciar Sesión</button>
						</div>
						<p>No tienes cuenta? <a href="webregister">Registrate</a></p>
					</div>
				</div><!--- END COL -->
			</div><!--- END ROW -->
		</div><!--- END CONTAINER -->
	</section>
	<!-- END LOGIN -->
@endsection
@section('scripts')
@endsection
