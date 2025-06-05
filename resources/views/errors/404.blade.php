@extends('webacademia.layouts.web_layout')

@section('title', 'Página no encontrada')

@section('css')
@endsection

@section('content')

<!-- START SECTION TOP -->
<section class="section-top">
    <div class="container">
        <div class="col-lg-10 offset-lg-1 text-center">
            <div class="section-top-title wow fadeInRight">
                <h1>Página no encontrada</h1>
                <ul>
                    <li><a href="{{ url('/') }}">Inicio</a></li>
                    <li> / Error 404</li>
                </ul>
            </div>
        </div>
    </div>
</section>
<!-- END SECTION TOP -->

<!-- START 404 -->
<section class="zero_area section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="error_page">
                    <img src="/assets/images/all-img/404.svg" class="img-fluid" alt="Error 404" />
                    <h2>¡Vaya! No hemos encontrado esta página</h2>
                    <p>Es posible que la dirección esté mal escrita o que la página ya no exista.</p>
                    <div class="home_btn mt-3">
                        <a href="{{ url('/') }}" class="btn_one">Volver al inicio</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END 404 -->

@endsection
