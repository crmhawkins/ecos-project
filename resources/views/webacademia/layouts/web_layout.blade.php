<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Default Title') - Grupo Ecos</title>
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
<main style="margin-top: 90px;">
    @yield('content')
</main>

@include('webacademia.partials.footer')

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
