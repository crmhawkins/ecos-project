<?php

namespace App\Modules\Moodle\Resources\views\student;

?>

@extends('moodle::student.layout')

@section('title', 'Dashboard')
@section('subtitle', 'Bienvenido a tu panel de estudiante')

@section('content')
    <!-- User Information -->
    @if(isset($userInfo))
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-user me-2"></i> Información del Usuario
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-2 text-center mb-3 mb-md-0">
                    @if(isset($userInfo['profileimageurl']) && !empty($userInfo['profileimageurl']))
                        <img src="{{ $userInfo['profileimageurl'] }}" alt="Foto de perfil" class="img-fluid rounded-circle" style="max-width: 100px;">
                    @else
                        <div class="bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 100px; height: 100px; font-size: 2.5rem; margin: 0 auto;">
                            <i class="fas fa-user"></i>
                        </div>
                    @endif
                </div>
                <div class="col-md-10">
                    <h4>{{ $userInfo['firstname'] }} {{ $userInfo['lastname'] }}</h4>
                    <p class="text-muted">{{ $userInfo['email'] }}</p>
                    <div class="row mt-3">
                        <div class="col-md-4">
                            <p><strong>Usuario:</strong> {{ $userInfo['username'] }}</p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>Idioma:</strong> {{ $userInfo['lang'] }}</p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>Último acceso:</strong> {{ isset($userInfo['lastaccess']) ? date('d/m/Y H:i', $userInfo['lastaccess']) : 'N/A' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Course Progress Summary -->
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-graduation-cap me-2"></i> Resumen de Progreso
        </div>
        <div class="card-body">
            @if(isset($enrollments) && count($enrollments) > 0)
                <div class="row">
                    @foreach($enrollments as $index => $enrollment)
                        @if($index < 4) <!-- Show only first 4 courses in dashboard -->
                            <div class="col-md-6 mb-4">
                                <div class="card h-100 course-card">
                                    <div class="course-image" style="background-image: url('{{ $enrollment['overviewfiles'][0]['fileurl'] ?? 'https://via.placeholder.com/300x160?text=Curso' }}')"></div>
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $enrollment['fullname'] }}</h5>
                                        <p class="card-text text-muted">{{ Str::limit($enrollment['summary'] ?? 'Sin descripción', 100) }}</p>
                                        
                                        @php
                                            // Simulate progress calculation - in real implementation this would come from Moodle
                                            $progress = isset($enrollment['progress']) ? $enrollment['progress'] : rand(0, 100);
                                        @endphp
                                        
                                        <div class="progress mb-3" style="height: 10px;">
                                            <div class="progress-bar" role="progressbar" style="width: {{ $progress }}%;" aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100">{{ $progress }}%</div>
                                        </div>
                                        
                                        <a href="{{ route('moodle.student.course', $enrollment['id']) }}" class="btn btn-primary btn-sm">Ver curso</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                
                @if(count($enrollments) > 4)
                    <div class="text-center mt-3">
                        <a href="{{ route('moodle.student.courses') }}" class="btn btn-outline-primary">Ver todos los cursos ({{ count($enrollments) }})</a>
                    </div>
                @endif
            @else
                <p class="text-muted">No estás matriculado en ningún curso actualmente.</p>
                <p>Contacta con el administrador para obtener acceso a los cursos disponibles.</p>
            @endif
        </div>
    </div>

    <!-- Recent Certificates -->
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-certificate me-2"></i> Certificados Recientes
        </div>
        <div class="card-body">
            @php
                // Simulate certificates - in real implementation this would come from the database
                $certificates = isset($recentCertificates) ? $recentCertificates : [];
            @endphp
            
            @if(count($certificates) > 0)
                <div class="row">
                    @foreach($certificates as $certificate)
                        <div class="col-md-6 mb-3">
                            <div class="certificate-card d-flex align-items-center">
                                <div class="certificate-icon">
                                    <i class="fas fa-certificate"></i>
                                </div>
                                <div>
                                    <h5 class="mb-1">{{ $certificate['course_name'] }}</h5>
                                    <p class="text-muted mb-2">Completado el {{ $certificate['completion_date'] }}</p>
                                    <a href="{{ route('moodle.certificates.download', $certificate['certificate_file']) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-download me-1"></i> Descargar
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <div class="text-center mt-3">
                    <a href="{{ route('moodle.student.certificates') }}" class="btn btn-outline-primary">Ver todos los certificados</a>
                </div>
            @else
                <p class="text-muted">No tienes certificados disponibles.</p>
                <p>Completa tus cursos para obtener certificados.</p>
            @endif
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="card">
        <div class="card-header">
            <i class="fas fa-history me-2"></i> Actividad Reciente
        </div>
        <div class="card-body">
            @php
                // Simulate recent activity - in real implementation this would come from Moodle
                $recentActivity = isset($recentActivity) ? $recentActivity : [];
            @endphp
            
            @if(count($recentActivity) > 0)
                <div class="list-group">
                    @foreach($recentActivity as $activity)
                        <div class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">{{ $activity['title'] }}</h5>
                                <small>{{ $activity['date'] }}</small>
                            </div>
                            <p class="mb-1">{{ $activity['description'] }}</p>
                            <small class="text-muted">{{ $activity['course'] }}</small>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-muted">No hay actividad reciente para mostrar.</p>
            @endif
        </div>
    </div>
@endsection

@section('scripts')
<script>
    // Dashboard specific scripts can be added here
    $(document).ready(function() {
        console.log('Student dashboard loaded');
    });
</script>
@endsection
