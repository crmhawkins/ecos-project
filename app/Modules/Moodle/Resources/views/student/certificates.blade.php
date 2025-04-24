<?php

namespace App\Modules\Moodle\Resources\views\student;

?>

@extends('moodle::student.layout')

@section('title', 'Mis Certificados')
@section('subtitle', 'Certificados obtenidos por cursos completados')

@section('content')
    <!-- Certificates List -->
    <div class="row">
        @if(isset($certificates) && count($certificates) > 0)
            @foreach($certificates as $certificate)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100">
                        <div class="card-header bg-success text-white">
                            <i class="fas fa-certificate me-2"></i> Certificado
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $certificate->course_name }}</h5>
                            <p class="card-text">
                                <strong>Fecha de emisión:</strong> {{ $certificate->issued_at->format('d/m/Y') }}
                            </p>
                            <p class="card-text">
                                <strong>ID de verificación:</strong> {{ $certificate->certificate_id }}
                            </p>
                            
                            <div class="text-center mt-4">
                                <img src="{{ asset('storage/certificates/thumbnails/' . $certificate->filename) }}" 
                                     class="img-fluid border" alt="Vista previa del certificado">
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            <a href="{{ route('moodle.certificates.download', $certificate->filename) }}" class="btn btn-primary" target="_blank">
                                <i class="fas fa-download me-2"></i> Descargar
                            </a>
                            <a href="{{ route('moodle.certificates.verify.get', $certificate->certificate_id) }}" class="btn btn-info" target="_blank">
                                <i class="fas fa-check-circle me-2"></i> Verificar
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col-12">
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i> No tienes certificados disponibles. Completa tus cursos para obtener certificados.
                </div>
            </div>
        @endif
    </div>
    
    <!-- Pagination if needed -->
    @if(isset($certificates) && method_exists($certificates, 'links'))
        <div class="d-flex justify-content-center mt-4">
            {{ $certificates->links() }}
        </div>
    @endif
    
    <!-- Completed Courses Without Certificates -->
    @if(isset($completedCoursesWithoutCertificates) && count($completedCoursesWithoutCertificates) > 0)
        <div class="card mt-5">
            <div class="card-header">
                <i class="fas fa-graduation-cap me-2"></i> Cursos Completados Sin Certificado
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Curso</th>
                                <th>Fecha de Finalización</th>
                                <th>Calificación Final</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($completedCoursesWithoutCertificates as $course)
                                <tr>
                                    <td>{{ $course['fullname'] }}</td>
                                    <td>{{ isset($course['completiondate']) ? date('d/m/Y', $course['completiondate']) : 'No disponible' }}</td>
                                    <td>
                                        @if(isset($course['finalgrade']))
                                            {{ $course['finalgrade'] }}
                                            @if(isset($course['grademax']))
                                                / {{ $course['grademax'] }}
                                            @endif
                                        @else
                                            No disponible
                                        @endif
                                    </td>
                                    <td>
                                        <form action="{{ route('moodle.student.certificates.request') }}" method="POST" class="d-inline">
                                            @csrf
                                            <input type="hidden" name="course_id" value="{{ $course['id'] }}">
                                            <button type="submit" class="btn btn-success btn-sm">
                                                <i class="fas fa-certificate me-1"></i> Solicitar Certificado
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
    
    <!-- Certificate Verification -->
    <div class="card mt-5">
        <div class="card-header">
            <i class="fas fa-check-circle me-2"></i> Verificar Certificado
        </div>
        <div class="card-body">
            <p>Puedes verificar la autenticidad de cualquier certificado utilizando su ID de verificación.</p>
            
            <form action="{{ route('moodle.certificates.verify.post') }}" method="POST" class="row g-3">
                @csrf
                <div class="col-md-8">
                    <input type="text" class="form-control" id="certificate_id" name="certificate_id" placeholder="Ingresa el ID de verificación del certificado" required>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-search me-2"></i> Verificar
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
