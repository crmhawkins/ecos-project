@extends('webacademia.layouts.web_layout')

@section('title', 'Pago Exitoso')

@section('css')
<style>
.success-container {
    text-align: center;
    padding: 60px 0;
}

.success-icon {
    width: 100px;
    height: 100px;
    background: #28a745;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 30px;
    animation: pulse 2s infinite;
}

.success-icon i {
    font-size: 50px;
    color: white;
}

@keyframes pulse {
    0% {
        transform: scale(1);
        box-shadow: 0 0 0 0 rgba(40, 167, 69, 0.7);
    }
    70% {
        transform: scale(1.05);
        box-shadow: 0 0 0 10px rgba(40, 167, 69, 0);
    }
    100% {
        transform: scale(1);
        box-shadow: 0 0 0 0 rgba(40, 167, 69, 0);
    }
}

.course-list {
    background: #f8f9fa;
    border-radius: 8px;
    padding: 20px;
    margin: 30px 0;
}

.course-item {
    display: flex;
    align-items: center;
    padding: 10px 0;
    border-bottom: 1px solid #dee2e6;
}

.course-item:last-child {
    border-bottom: none;
}

.course-item i {
    color: #28a745;
    margin-right: 10px;
}

.next-steps {
    background: white;
    border: 2px solid #D93690;
    border-radius: 8px;
    padding: 25px;
    margin: 30px 0;
}

.step {
    display: flex;
    align-items: center;
    margin-bottom: 15px;
}

.step-number {
    width: 30px;
    height: 30px;
    background: #D93690;
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    margin-right: 15px;
}
</style>
@endsection

@section('content')

<!-- START SECTION TOP -->
<section class="section-top">
    <div class="container">
        <div class="col-lg-10 offset-lg-1 text-center">
            <div class="section-top-title wow fadeInRight">
                <h1>¡Pago Exitoso!</h1>
                <ul>
                    <li><a href="/">Inicio</a></li>
                    <li> / Pago Exitoso</li>
                </ul>
            </div>
        </div>
    </div>
</section>
<!-- END SECTION TOP -->

<section class="section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <div class="success-container">
                    <div class="success-icon">
                        <i class="fa fa-check"></i>
                    </div>
                    
                    <h2 class="mb-4">¡Felicidades! Tu compra se ha completado exitosamente</h2>
                    <p class="lead text-muted mb-4">
                        Hemos procesado tu pago correctamente y ya tienes acceso a tus nuevos cursos.
                    </p>

                    @if(session('enrolled_courses'))
                        <div class="course-list">
                            <h4 class="mb-3">Cursos adquiridos:</h4>
                            @foreach(session('enrolled_courses') as $course)
                                <div class="course-item">
                                    <i class="fa fa-graduation-cap"></i>
                                    <span>{{ $course }}</span>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <div class="next-steps">
                        <h4 class="mb-4">¿Qué sigue ahora?</h4>
                        
                        <div class="step">
                            <div class="step-number">1</div>
                            <div>
                                <strong>Accede a tu perfil</strong><br>
                                <small class="text-muted">Revisa tus cursos adquiridos en tu área personal</small>
                            </div>
                        </div>
                        
                        <div class="step">
                            <div class="step-number">2</div>
                            <div>
                                <strong>Comienza a aprender</strong><br>
                                <small class="text-muted">Accede a la plataforma de formación y empieza tus cursos</small>
                            </div>
                        </div>
                        
                        <div class="step">
                            <div class="step-number">3</div>
                            <div>
                                <strong>Obtén tu certificado</strong><br>
                                <small class="text-muted">Completa el curso y descarga tu certificado oficial</small>
                            </div>
                        </div>
                    </div>

                    <div class="action-buttons mt-5">
                        <a href="{{ route('webacademia.perfil') }}" class="btn_one me-3">
                            <i class="fa fa-user"></i> Ir a Mi Perfil
                        </a>
                        <a href="{{ route('webacademia.courses') }}" class="btn_two">
                            <i class="fa fa-book"></i> Ver Más Cursos
                        </a>
                    </div>

                    <div class="contact-info mt-5">
                        <p class="text-muted">
                            <i class="fa fa-envelope"></i> 
                            Si tienes alguna pregunta, contáctanos en 
                            <a href="mailto:soporte@grupoecos.net">soporte@grupoecos.net</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
