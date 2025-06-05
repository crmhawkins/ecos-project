@extends('webacademia.layouts.web_layout')

@section('title', 'Single course')

@section('css')
@endsection

@section('content')

<!-- START SECTION TOP -->
<section class="section-top">
    <div class="container">
        <div class="col-lg-10 offset-lg-1 text-center">
            <div class="section-top-title wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.3s">
                <h1>Detalles del Curso</h1>
                <ul>
                    <li><a href="{{ url('/') }}">Inicio</a></li>
                    <li> / Curso</li>
                </ul>
            </div>
        </div>
    </div>
</section>
<!-- END SECTION TOP -->

<!-- START EVENT -->
<section class="our_event section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-sm-8 col-xs-12">
                <div class="single_event_single">
                    <div style="height: 500px; overflow: hidden; border-radius: 12px;">
                        <img src="{{ $curso->image }}" alt="{{ $curso->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <div class="single_event_text_single">
                        <h4>{{ $curso->name }}</h4>
                        @if (isset($curso->inicio))
                        <span><i class="fa fa-calendar"></i> {{ optional($curso->inicio)->format('d M Y') }}</span>
                        @endif
                        @if (isset($curso->duracion))
                        <span><i class="fa fa-clock-o"></i> {{ $curso->duracion }} Horas</span>
                        @endif
                        @if (isset($curso->plazas))
                        <span><i class="fa fa-table"></i><strong>{{ $curso->plazas }} Plazas</strong></span>
                        @endif
                        <p>{{ $curso->description }}</p>
                    </div>
                </div>

                <div class="course-details-content section-bg">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a href="#overview" class="nav-link active" data-bs-toggle="tab">Overview</a>
                        </li>
                        <li class="nav-item">
                            <a href="#curriculum" class="nav-link" data-bs-toggle="tab">Curriculum</a>
                        </li>
                        <li class="nav-item">
                            <a href="#instructor" class="nav-link" data-bs-toggle="tab">Instructor</a>
                        </li>
                        {{-- <li class="nav-item">
                            <a href="#reviews" class="nav-link" data-bs-toggle="tab">Reviews</a>
                        </li> --}}
                    </ul>

                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane show fade active" id="overview">
                            <div class="overview">
                                <p>{{ $curso->description }}</p>

                                @if (!empty($curso->video_url))
                                <iframe width="100%" height="400" src="{{ $curso->video_url }}" frameborder="0" allowfullscreen></iframe>
                                @endif

                                <div class="details-buttons-area mt-4">
                                    <a href="#" class="custom-button theme-one">Inscribirse <i class="fa fa-angle-right"></i></a>
                                    <a href="#" class="custom-button bg-white">Obtener membresía</a>
                                    <ul class="social-icons">
                                        <li><a href="#" class="active"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="curriculum">
                            <div class="overview">
                                <p>Contenido del curso próximamente...</p>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="instructor">
                            <div class="overview text-center">
                                <p>Instructor del curso próximamente...</p>
                            </div>
                        </div>

                        {{-- <div class="tab-pane fade" id="reviews">
                            <div class="client-review">
                                <p>Sección de reseñas próximamente...</p>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>

            <!-- SIDEBAR -->
            <div class="col-lg-4 col-sm-4 col-xs-12">
                <div class="course_features">
                    <h3>Características del curso</h3>
                    <ul>
                        <li><i class="fa fa-calendar"></i> Duración <b>{{ $curso->duracion }} Horas</b></li>
                        <li><i class="fa fa-user"></i> Lecciones <b>{{ $curso->lecciones }}</b></li>
                        <li><i class="fa fa-trophy"></i> Certificación <b>{{ $curso->certificacion ? 'Si' : 'No' }}</b></li>
                    </ul>
                </div>
                <div class="event_info_price">
                    <h4>Precio - ${{ number_format($curso->price, 2) }}</h4>
                </div>
                <div class="event_info_register">
                    <a class="btn_one" href="#">Registrar ahora</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END EVENT -->

@endsection
