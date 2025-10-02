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
    background: linear-gradient(135deg, #f8fafc 0%, #e9ecef 100%);
    padding: 80px 0;
    position: relative;
}

.related-courses::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(135deg, #D93690 0%, #ff6b9d 50%, #667eea 100%);
}

.related-courses h2 {
    color: #2d3748;
    font-weight: 800;
    font-size: 36px;
    margin-bottom: 15px;
    background: linear-gradient(135deg, #D93690 0%, #667eea 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.related-courses p {
    color: #718096;
    font-size: 18px;
    margin-bottom: 50px;
}

.course-card {
    background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    margin-bottom: 30px;
    border: 1px solid #e2e8f0;
    height: 100%;
    display: flex;
    flex-direction: column;
}

.course-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.15);
}

.course-card img {
    width: 100%;
    height: 220px;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.course-card:hover img {
    transform: scale(1.05);
}

.course-card-body {
    padding: 25px;
    flex: 1;
    display: flex;
    flex-direction: column;
}

.course-card h5 {
    color: #2d3748;
    font-weight: 700;
    font-size: 18px;
    line-height: 1.4;
    margin-bottom: 12px;
    min-height: 50px;
}

.course-card .text-muted {
    color: #718096 !important;
    font-size: 14px;
    line-height: 1.5;
    margin-bottom: 20px;
    flex: 1;
}

.course-card .d-flex {
    margin-top: auto;
    align-items: center;
    padding-top: 15px;
    border-top: 1px solid #e2e8f0;
}

.course-card .h5 {
    color: #D93690 !important;
    font-weight: 800;
    font-size: 20px;
}

.course-card .btn {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border: none;
    padding: 8px 16px;
    border-radius: 20px;
    font-weight: 600;
    font-size: 13px;
    transition: all 0.3s ease;
    text-decoration: none;
}

.course-card .btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
    color: white;
    text-decoration: none;
}

.badge-certificate {
    background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
    color: white;
    padding: 8px 12px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    box-shadow: 0 4px 15px rgba(72, 187, 120, 0.3);
}

.badge-no-certificate {
    background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
    color: white;
    padding: 8px 12px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    box-shadow: 0 4px 15px rgba(108, 117, 125, 0.3);
}

/* Responsive para cursos relacionados */
@media (max-width: 768px) {
    .related-courses {
        padding: 60px 0;
    }
    
    .related-courses h2 {
        font-size: 28px;
    }
    
    .course-card {
        margin-bottom: 20px;
    }
    
    .course-card-body {
        padding: 20px;
    }
    
    .course-meta {
        flex-direction: column;
        align-items: flex-start !important;
        gap: 8px !important;
    }
}

/* Mejoras adicionales para la alineación */
.row.g-4 {
    --bs-gutter-x: 1.5rem;
    --bs-gutter-y: 1.5rem;
}

/* Fix para evitar superposición con el header */
body {
    padding-top: 0 !important;
}

main {
    position: relative;
    z-index: 1;
}

#navigation {
    z-index: 1030 !important;
}

.course-card .course-meta span {
    white-space: nowrap;
}

.course-card .d-flex.justify-content-between {
    flex-wrap: wrap;
    gap: 10px;
}

@media (max-width: 576px) {
    .course-card .d-flex.justify-content-between {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .course-card .btn {
        align-self: stretch;
        text-align: center;
    }
}
</style>
@endsection

@section('content')

<!-- Course Hero Section -->
<section class="course-hero" style="margin-top: 20px;">
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
                <h1 class="display-4 mb-3 text-white">{{ $curso->title ?? $curso->name }}</h1>
                <p class="lead mb-4">{{ Str::limit($curso->description, 150) }}</p>
                
                @if($curso->category)
                    <span class="badge bg-light text-dark px-3 py-2">
                        <i class="fa fa-tag"></i> {{ $curso->category->name }}
                    </span>
                @endif
            </div>
            <div class="col-lg-4">
                <div class="course-image">
                    @if($curso->image && file_exists(storage_path('app/public/' . $curso->image)))
                        <img src="{{ asset('storage/' . $curso->image) }}" alt="{{ $curso->title ?? $curso->name }}">
                    @else
                        <img src="{{ asset('assets/images/default-course.svg') }}" alt="Curso por defecto">
                    @endif
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
                    @if($curso->description && trim($curso->description) !== '')
                        <div class="course-description">
                            {!! nl2br(e($curso->description)) !!}
                        </div>
                    @else
                        <div class="alert alert-info">
                            <h5><i class="fa fa-info-circle"></i> Descripción no disponible</h5>
                            <p class="mb-0">La descripción detallada de este curso se está actualizando. Para más información sobre el contenido y objetivos del curso, puedes contactar con nuestro equipo de soporte.</p>
                        </div>
                    @endif

                    <h4 class="mt-4">Contenido del curso</h4>
                    @if(isset($curso->moodle_details) && isset($curso->moodle_details['contents']) && count($curso->moodle_details['contents']) > 0)
                        <div class="accordion" id="courseContent">
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
                        </div>
                    @else
                        <div class="alert alert-warning">
                            <h5><i class="fa fa-exclamation-triangle"></i> Contenido en preparación</h5>
                            <p class="mb-3">El contenido detallado de este curso se está sincronizando desde nuestra plataforma de aprendizaje. Mientras tanto, aquí tienes un resumen de lo que aprenderás:</p>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <h6><i class="fa fa-check-circle text-success"></i> Módulos principales:</h6>
                                    <ul class="list-unstyled ms-3">
                                        <li><i class="fa fa-arrow-right text-primary"></i> Introducción y conceptos básicos</li>
                                        <li><i class="fa fa-arrow-right text-primary"></i> Desarrollo de competencias prácticas</li>
                                        <li><i class="fa fa-arrow-right text-primary"></i> Casos de estudio reales</li>
                                        <li><i class="fa fa-arrow-right text-primary"></i> Evaluación y certificación</li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <h6><i class="fa fa-star text-warning"></i> Características destacadas:</h6>
                                    <ul class="list-unstyled ms-3">
                                        <li><i class="fa fa-arrow-right text-primary"></i> Contenido actualizado</li>
                                        <li><i class="fa fa-arrow-right text-primary"></i> Ejercicios prácticos</li>
                                        <li><i class="fa fa-arrow-right text-primary"></i> Soporte del instructor</li>
                                        <li><i class="fa fa-arrow-right text-primary"></i> Certificado oficial</li>
                                    </ul>
                                </div>
                            </div>
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
        
        <div class="row g-4">
            @foreach($cursosRelacionados as $cursoRelacionado)
                <div class="col-lg-4 col-md-6 col-sm-12 d-flex">
                    <div class="course-card w-100">
                        <div class="course-image-container" style="position: relative; overflow: hidden;">
                            @if($cursoRelacionado->image && file_exists(storage_path('app/public/' . $cursoRelacionado->image)))
                                <img src="{{ asset('storage/' . $cursoRelacionado->image) }}" alt="{{ $cursoRelacionado->title ?? $cursoRelacionado->name }}">
                            @else
                                <img src="{{ asset('assets/images/default-course.svg') }}" alt="Curso por defecto">
                            @endif
                            
                            @if($cursoRelacionado->certificado)
                                <div style="position: absolute; top: 15px; right: 15px;">
                                    <span class="badge-certificate">
                                        <i class="fa fa-certificate"></i> Certificado
                                    </span>
                                </div>
                            @endif
                        </div>
                        
                        <div class="course-card-body">
                            <h5>{{ $cursoRelacionado->title ?? $cursoRelacionado->name }}</h5>
                            
                            @if($cursoRelacionado->description && trim($cursoRelacionado->description) !== '')
                                <p class="text-muted">{{ Str::limit($cursoRelacionado->description, 100) }}</p>
                            @else
                                <p class="text-muted">Curso de formación profesional con certificación oficial.</p>
                            @endif
                            
                            <div class="course-meta mb-3">
                                <small class="text-muted d-flex align-items-center gap-3">
                                    @if($cursoRelacionado->duracion)
                                        <span><i class="fa fa-clock text-primary"></i> {{ $cursoRelacionado->duracion }}h</span>
                                    @endif
                                    @if($cursoRelacionado->lecciones)
                                        <span><i class="fa fa-book text-primary"></i> {{ $cursoRelacionado->lecciones }} lecciones</span>
                                    @endif
                                </small>
                            </div>
                            
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="h5 mb-0" style="color: #D93690; font-weight: 800;">{{ number_format($cursoRelacionado->price, 2) }}€</span>
                                <a href="{{ route('webacademia.single_course', $cursoRelacionado->id) }}" 
                                   class="btn">
                                   <i class="fa fa-arrow-right"></i> Ver curso
                                </a>
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