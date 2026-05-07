@extends('webacademia.layouts.web_layout')
@section('title', 'Política de Cookies')
@section('content')
<section style="padding: 80px 0; background: #f8fafc; min-height: 60vh;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div style="background: white; border-radius: 20px; padding: 48px; box-shadow: 0 10px 30px rgba(0,0,0,0.08);">
                    <h1 style="color: #D93690; font-weight: 800; margin-bottom: 32px;">Política de Cookies</h1>
                    <h5>¿Qué son las cookies?</h5>
                    <p>Las cookies son pequeños archivos de texto que se almacenan en tu dispositivo cuando visitas nuestra web. Nos permiten mejorar tu experiencia de navegación.</p>
                    <h5>Tipos de cookies que utilizamos</h5>
                    <ul>
                        <li><strong>Cookies técnicas:</strong> necesarias para el funcionamiento del sitio web y la gestión de la sesión.</li>
                        <li><strong>Cookies de análisis:</strong> nos permiten conocer el uso que haces del sitio para mejorar nuestros servicios.</li>
                        <li><strong>Cookies de personalización:</strong> recuerdan tus preferencias para ofrecerte una experiencia personalizada.</li>
                    </ul>
                    <h5>Gestión de cookies</h5>
                    <p>Puedes configurar tu navegador para rechazar todas las cookies o para recibir un aviso cuando se envíe una cookie. Consulta la ayuda de tu navegador para más información.</p>
                    <h5>Cookies de terceros</h5>
                    <p>Este sitio puede utilizar servicios de terceros como Google Analytics que instalan sus propias cookies. Consulta las políticas de privacidad de dichos servicios para más información.</p>
                    <p style="color: #9ca3af; font-size: 0.9rem; margin-top: 32px;">Última actualización: {{ date('d/m/Y') }}</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
