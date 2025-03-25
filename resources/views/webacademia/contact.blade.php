@extends('webacademia.layouts.web_layout')

@section('title', 'Contact')

@section('css')
@endsection

@section('content')

	<!-- START SECTION TOP -->
	<section class="section-top">
		<div class="container">
			<div class="col-lg-10 offset-lg-1 text-center">
				<div class="section-top-title wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.3s" data-wow-offset="0">
					<h1>CONTACTA CON NOSOTROS</h1>
					{{-- <ul>
						<li><a href="index">Home</a></li>
						<li> / Contact</li>
					</ul> --}}
				</div><!-- //.HERO-TEXT -->
			</div><!--- END COL -->
		</div><!--- END CONTAINER -->
	</section>
	<!-- END SECTION TOP -->

		<!-- START ADDRESS -->
		<section class="address_area section-padding">
            <div class="container">
                <div class="row text-center">
                    <div class="col-lg-4 col-sm-4 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s" data-wow-offset="0">
                        <div class="single_address">
                            <i class="ti-map"></i>
                            <h4>Ceuta</h4>
                            <p>Poblado Marinero, locales 25, 44, 45 y 46</p>
                            <p><strong>Tel.:</strong> 956 52 50 68</p>
                            <p><strong>Email:</strong></p>
                            <p><a href="mailto:academia@grupoecos.net">academia@grupoecos.net</a></p>
                            <p><a href="mailto:comercial@grupoecos.net">comercial@grupoecos.net</a></p>
                            <p><a href="mailto:informacion@grupoecos.net">informacion@grupoecos.net</a></p>
                        </div>
                    </div><!-- END COL -->

                    <div class="col-lg-4 col-sm-4 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s" data-wow-offset="0">
                        <div class="single_address">
                            <i class="ti-map"></i>
                            <h4>Estepona</h4>
                            <p>Calle Las Camelias, 2B<br>(junto a la Policía Local)</p>
                            <p><strong>Tel.:</strong> 952 80 51 64</p>
                            <p><strong>Email:</strong></p>
                            <p><a href="mailto:estepona@grupoecos.net">estepona@grupoecos.net</a></p>
                        </div>
                    </div><!-- END COL -->

                    <div class="col-lg-4 col-sm-4 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.3s" data-wow-offset="0">
                        <div class="single_address">
                            <i class="ti-map"></i>
                            <h4>Melilla</h4>
                            <p>Calle Comandante García Morato, 17</p>
                            <p><strong>Tel.:</strong> 951 53 23 10</p>
                            <p><strong>Email:</strong></p>
                            <p><a href="mailto:melilla@grupoecos.net">melilla@grupoecos.net</a></p>
                        </div>
                    </div><!-- END COL -->
                </div><!-- END ROW -->
            </div><!-- END CONTAINER -->
        </section>
		<!-- END ADDRESS -->

		<!-- CONTACT -->
		<div id="contact" class="contact_area section-padding">
            <div class="container">
                <div class="section-title-two">
                    <h2>Envíanos tu mensaje</h2>
                </div>
                <div class="row">
                    <div class="offset-lg-1 col-lg-10 col-sm-12 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s" data-wow-offset="0">
                        <div class="contact">
                            <form class="form" name="enq" method="post" action="contact.php" onsubmit="return validation();">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="">Nombre</label>
                                        <input type="text" name="name" class="form-control" required="required">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="">Tu correo electrónico</label>
                                        <input type="email" name="email" class="form-control" required="required">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="">Asunto</label>
                                        <input type="text" name="subject" class="form-control" required="required">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="">Mensaje</label>
                                        <textarea rows="6" name="message" class="form-control" required="required"></textarea>
                                    </div>
                                    <div class="col-md-12 text-center">
                                        <button type="submit" value="Enviar mensaje" name="submit" id="submitButton" class="btn_one" title="¡Enviar tu mensaje!">Enviar mensaje</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div><!-- END COL -->
                </div><!-- END ROW -->
            </div><!-- END CONTAINER -->
        </div>
		<!-- END CONTACT -->

@endsection
@section('scripts')
@endsection
