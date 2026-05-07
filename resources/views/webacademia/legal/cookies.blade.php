@extends('webacademia.layouts.web_layout')

@section('title', 'Politica de Cookies')

@section('content')
<section class="section-top">
    <div class="container">
        <div class="col-lg-10 offset-lg-1 text-center">
            <div class="section-top-title">
                <h1>Politica de Cookies</h1>
                <ul>
                    <li><a href="/">Inicio</a></li>
                    <li> / Politica de Cookies</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="section" style="padding: 60px 0;">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <h2>Que son las cookies</h2>
                <p>Las cookies son archivos que se descargan en el equipo del usuario al acceder a determinadas paginas web y permiten almacenar y recuperar informacion sobre los habitos de navegacion.</p>

                <h2>Tipos de cookies utilizadas</h2>
                <ul>
                    <li><strong>Tecnicas:</strong> necesarias para el funcionamiento del sitio web.</li>
                    <li><strong>Analiticas:</strong> permiten analizar el comportamiento de los usuarios.</li>
                    <li><strong>De personalizacion:</strong> recuerdan preferencias del usuario.</li>
                </ul>

                <h2>Como gestionar las cookies</h2>
                <p>El usuario puede configurar su navegador para aceptar o rechazar las cookies. Para mas informacion consulte la ayuda de su navegador.</p>
            </div>
        </div>
    </div>
</section>
@endsection
