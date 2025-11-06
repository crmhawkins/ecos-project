<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        {{-- SEO Dinámico --}}
    @php
        $slug = $slug ?? request()->route('slug') ?? 'home';
        $seoView = 'webacademia.seo.seo_' . $slug;
    @endphp

    @if (View::exists($seoView))
        @include($seoView)
    @endif
    <title>Grupo Ecos</title>
    <!-- Latest Bootstrap min CSS -->
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Mulish:300,400,500,600,700,800&display=swap" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/themify-icons.css') }}">
	<!--- owl carousel Css-->
    <link rel="stylesheet" href="{{ asset('assets/owlcarousel/css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/owlcarousel/css/owl.theme.css') }}">
    <!--slicknav Css-->
    <link rel="stylesheet" href="{{ asset('assets/css/slicknav.css') }}">
	<!-- MAGNIFIC CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.css') }}">
    <!-- animate CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
    <!-- Style CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    @yield('css')
    
    @if(!empty($contentView))
        @php
            // Renderizar la vista una sola vez y almacenar el contenido en el contenedor de la app
            $cacheKey = 'page_content_' . md5($contentView);
            if (!app()->bound($cacheKey)) {
                app()->instance($cacheKey, view($contentView)->render());
            }
            $pageContent = app($cacheKey);
            // Extraer todos los bloques <style> y mostrarlos en el <head>
            // IMPORTANTE: Esto se carga DESPUÉS de style.css para que tenga prioridad
            if (preg_match_all('/<style>(.*?)<\/style>/s', $pageContent, $styleMatches)) {
                foreach ($styleMatches[0] as $styleBlock) {
                    echo $styleBlock . "\n";
                }
            }
        @endphp
    @endif
</head>
<body>
@include('webacademia.partials.navbar')
	<!-- START PRELOADER -->
    <div id="loader-wrapper">
        <div id="loader"></div>
        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>
    </div>
	<!-- END PRELOADER -->
<main style="margin-top: 110px;">
  @if(!empty($contentView))
        @php
            // Usar el contenido ya renderizado y remover los bloques <style> (ya están en el <head>)
            $cacheKey = 'page_content_' . md5($contentView);
            $pageContent = app($cacheKey);
            // Remover bloques <style> del contenido
            $pageContent = preg_replace('/<style>.*?<\/style>/s', '', $pageContent);
            echo $pageContent;
        @endphp
    @endif
</main>

@include('webacademia.partials.footer')

<!-- Asistente de IA -->
@livewire('ai-chat')

@if(!request()->is('builder*'))
<!-- Forzar sobrescritura de estilos problemáticos del theme - MÁXIMA PRIORIDAD -->
<!-- Solo aplicar si NO estamos en el builder -->
<style>
/* Sobrescritura forzada para .ab_img img - se aplica al final del body para máxima prioridad */
html body .ab_img img,
html body .ab_img > img,
html body section .ab_img img,
html body .container .ab_img img,
html body .row .ab_img img,
html body .col-lg-6 .ab_img img,
html body .col-sm-12 .ab_img img,
html body .wow.fadeInUp .ab_img img {
    padding-right: 0 !important;
    padding-left: 0 !important;
    margin-right: 0 !important;
    margin-left: 0 !important;
}
</style>
@endif
<script>
// Forzar aplicación de estilos después de que todo se cargue
// SOLO si NO estamos en el builder (GrapesJS)
document.addEventListener('DOMContentLoaded', function() {
    // Verificar si estamos en el builder - si existe el contenedor de GrapesJS, no ejecutar
    if (window.location.pathname.includes('/builder') || document.getElementById('gjs') || window.gjs) {
        return; // No ejecutar en el builder
    }
    
    // Aplicar padding-right: 0 a todas las imágenes dentro de .ab_img
    const abImgImages = document.querySelectorAll('.ab_img img');
    abImgImages.forEach(function(img) {
        img.style.setProperty('padding-right', '0', 'important');
        img.style.setProperty('padding-left', '0', 'important');
        img.style.setProperty('margin-right', '0', 'important');
        img.style.setProperty('margin-left', '0', 'important');
    });
});
</script>

<!-- Livewire Scripts -->
@livewireScripts

<!-- Latest jQuery -->
<script src="{{ asset('assets/js/jquery-1.12.4.min.js') }}"></script>
<!-- Latest compiled and minified Bootstrap -->
<script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
<!-- owl-carousel min js  -->
<script src="{{ asset('assets/owlcarousel/js/owl.carousel.min.js') }}"></script>
<!-- jquery.slicknav -->
<script src="{{ asset('assets/js/jquery.slicknav.js') }}"></script>
<!-- magnific-popup js -->
<script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
<!-- scrolltopcontrol js -->
<script src="{{ asset('assets/js/scrolltopcontrol.js') }}"></script>
<!-- jquery purecounter vanilla js -->
<script src="{{ asset('assets/js/purecounter_vanilla.js') }}"></script>
<!-- WOW - Reveal Animations When You Scroll -->
<script src="{{ asset('assets/js/wow.min.js') }}"></script>
<!-- scripts js -->
<script src="{{ asset('assets/js/scripts.js') }}"></script>
<script src="{{ asset('assets/js/jquery.mixitup.js') }}"></script>
@yield('scripts')

</body>
</html>
