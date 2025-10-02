@extends('webacademia.layouts.web_layout')

@section('title', $curso->title ?? $curso->name)

@section('css')
<style>
.course-hero {
    background: linear-gradient(135deg, #D93690 0%, #262526 100%);
    color: white;
    padding: 60px 0;
}

.course-image {
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.3);
    overflow: hidden;
}

.course-image img {
    width: 100%;
    height: 300px;
    object-fit: cover;
}

.course-info-card {
    background: white;
    border-radius: 15px;
    padding: 30px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    margin-top: -50px;
    position: relative;
    z-index: 10;
}

.course-feature {
    display: flex;
    align-items: center;
    margin-bottom: 15px;
}

.course-feature i {
    width: 40px;
    height: 40px;
    background: #f8f9fa;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 15px;
    color: #D93690;
}

.price-section {
    background: linear-gradient(135deg, #D93690, #e94ca3);
    color: white;
    padding: 25px;
    border-radius: 15px;
    text-align: center;
    margin-bottom: 20px;
}

.price-section .original-price {
    font-size: 1.2em;
    margin-bottom: 10px;
}

.price-section .current-price {
    font-size: 2.5em;
    font-weight: bold;
    margin-bottom: 15px;
}

.action-button {
    width: 100%;
    padding: 15px;
    border-radius: 10px;
    font-weight: bold;
    text-transform: uppercase;
    margin-bottom: 10px;
    transition: all 0.3s ease;
}

.btn-add-cart {
    background: #28a745;
    border: none;
    color: white;
}

.btn-add-cart:hover {
    background: #218838;
    transform: translateY(-2px);
}

.btn-login {
    background: #007bff;
    border: none;
    color: white;
}

.btn-purchased {
    background: #6c757d;
    border: none;
    color: white;
    cursor: not-allowed;
}

.btn-in-cart {
    background: #ffc107;
    border: none;
    color: #212529;
}

.related-courses {
    background: #f8f9fa;
    padding: 60px 0;
}

.course-card {
    background: white;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
    margin-bottom: 20px;
}

.course-card:hover {
    transform: translateY(-5px);
}

.course-card img {
    width: 100%;
    height: 200px;
    object-fit: cover;
}

.course-card-body {
    padding: 20px;
}

.badge-certificate {
    background: #28a745;
    color: white;
    padding: 5px 10px;
    border-radius: 15px;
    font-size: 0.8em;
}

.badge-no-certificate {
    background: #6c757d;
    color: white;
    padding: 5px 10px;
    border-radius: 15px;
    font-size: 0.8em;
}
</style>
@endsection

@section('content')

<!-- Course Hero Section -->
<section class="course-hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-white">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('webacademia.courses') }}" class="text-white">Cursos</a></li>
                        <li class="breadcrumb-item active text-white">{{ $curso->title ?? $curso->name }}</li>
                    </ol>
                </nav>
                <h1 class="display-4 mb-3">{{ $curso->title ?? $curso->name }}</h1>
                <p class="lead mb-4">{{ Str::limit($curso->description, 150) }}</p>
                
                @if($curso->category)
                    <span class="badge bg-light text-dark px-3 py-2">
                        <i class="fa fa-tag"></i> {{ $curso->category->name }}
                    </span>
                @endif
            </div>
            <div class="col-lg-4">
                <div class="course-image">
                    <img src="{{ $curso->image ? asset('storage/' . $curso->image) : asset('assets/images/default-course.jpg') }}" 
                         alt="{{ $curso->title ?? $curso->name }}">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Course Details Section -->
<section class="section-padding">
    <div class="container">
        <div class="row">
            <!-- Course Content -->
            <div class="col-lg-8">
                <div class="course-info-card">
                    <h3 class="mb-4">Características del curso</h3>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="course-feature">
                                <i class="fa fa-clock"></i>
                                <div>
                                    <strong>Duración</strong><br>
                                    <span class="text-muted">{{ $curso->duracion ?? '40 Horas' }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="course-feature">
                                <i class="fa fa-users"></i>
                                <div>
                                    <strong>Plazas</strong><br>
                                    <span class="text-muted">{{ $curso->plazas ?? '25' }} estudiantes</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="course-feature">
                                <i class="fa fa-book"></i>
                                <div>
                                    <strong>Lecciones</strong><br>
                                    <span class="text-muted">{{ $curso->lecciones ?? '8' }} lecciones</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="course-feature">
                                <i class="fa fa-certificate"></i>
                                <div>
                                    <strong>Certificación</strong><br>
                                    @if($curso->certificado)
                                        <span class="badge-certificate">Incluido</span>
                                    @else
                                        <span class="badge-no-certificate">No incluido</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <h4>Descripción del curso</h4>
                    <p class="text-muted">{{ $curso->description }}</p>

                    @if(isset($curso->moodle_details))
                        <h4 class="mt-4">Contenido del curso</h4>
                        <div class="accordion" id="courseContent">
                            @if(isset($curso->moodle_details['contents']))
                                @foreach($curso->moodle_details['contents'] as $index => $section)
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button" 
                                                    data-bs-toggle="collapse" data-bs-target="#section{{ $index }}">
                                                {{ $section['name'] ?? "Sección " . ($index + 1) }}
                                            </button>
                                        </h2>
                                        <div id="section{{ $index }}" class="accordion-collapse collapse">
                                            <div class="accordion-body">
                                                @if(isset($section['modules']))
                                                    <ul class="list-unstyled">
                                                        @foreach($section['modules'] as $module)
                                                            <li class="mb-2">
                                                                <i class="fa fa-play-circle text-primary"></i>
                                                                {{ $module['name'] ?? 'Módulo' }}
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    @endif
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="sticky-top" style="top: 20px;">
                    <!-- Price Section -->
                    <div class="price-section">
                        <div class="current-price">{{ number_format($curso->price, 2) }}€</div>
                        <p class="mb-0">Precio del curso</p>
                    </div>

                    <!-- Action Buttons -->
                    @if($isLoggedIn)
                        @if($userHasCourse)
                            <button class="btn action-button btn-purchased" disabled>
                                <i class="fa fa-check"></i> Ya tienes este curso
                            </button>
                            <a href="{{ route('webacademia.perfil') }}" class="btn action-button btn-info">
                                <i class="fa fa-user"></i> Ir a mi perfil
                            </a>
                        @elseif($isInCart)
                            <button class="btn action-button btn-in-cart" disabled>
                                <i class="fa fa-shopping-cart"></i> Ya está en tu carrito
                            </button>
                            <a href="{{ route('carrito.ver') }}" class="btn action-button btn-info">
                                <i class="fa fa-eye"></i> Ver carrito
                            </a>
                        @else
                            <form method="POST" action="{{ route('carrito.agregar', $curso->id) }}">
                                @csrf
                                <button type="submit" class="btn action-button btn-add-cart">
                                    <i class="fa fa-shopping-cart"></i> Agregar al carrito
                                </button>
                            </form>
                        @endif
                    @else
                        <a href="{{ url('/weblogin') }}" class="btn action-button btn-login">
                            <i class="fa fa-sign-in"></i> Inicia sesión para comprar
                        </a>
                        <p class="text-center text-muted mt-2">
                            <small>¿No tienes cuenta? <a href="{{ url('/webregister') }}">Regístrate aquí</a></small>
                        </p>
                    @endif

                    <!-- Course Info -->
                    <div class="mt-4 p-3 bg-light rounded">
                        <h6><i class="fa fa-info-circle"></i> Información adicional</h6>
                        <ul class="list-unstyled mb-0">
                            <li><i class="fa fa-check text-success"></i> Acceso de por vida</li>
                            <li><i class="fa fa-check text-success"></i> Soporte 24/7</li>
                            <li><i class="fa fa-check text-success"></i> Certificado al completar</li>
                            <li><i class="fa fa-check text-success"></i> Acceso móvil</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Related Courses -->
@if($cursosRelacionados->count() > 0)
<section class="related-courses">
    <div class="container">
        <div class="text-center mb-5">
            <h2>Cursos relacionados</h2>
            <p class="text-muted">Otros cursos que podrían interesarte</p>
        </div>
        
        <div class="row">
            @foreach($cursosRelacionados as $cursoRelacionado)
                <div class="col-lg-4 col-md-6">
                    <div class="course-card">
                        <img src="{{ $cursoRelacionado->image ? asset('storage/' . $cursoRelacionado->image) : asset('assets/images/default-course.jpg') }}" 
                             alt="{{ $cursoRelacionado->title ?? $cursoRelacionado->name }}">
                        <div class="course-card-body">
                            <h5>{{ $cursoRelacionado->title ?? $cursoRelacionado->name }}</h5>
                            <p class="text-muted">{{ Str::limit($cursoRelacionado->description, 80) }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="h5 text-primary mb-0">{{ number_format($cursoRelacionado->price, 2) }}€</span>
                                <a href="{{ route('webacademia.single_course', $cursoRelacionado->id) }}" 
                                   class="btn btn-outline-primary btn-sm">Ver curso</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@endsection