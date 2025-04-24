<?php

namespace App\Modules\Moodle\Resources\views\student;

?>

@extends('moodle::student.layout')

@section('title', 'Mis Cursos')
@section('subtitle', 'Cursos en los que estás matriculado')

@section('content')
    <!-- Courses List -->
    <div class="row">
        @if(isset($courses) && count($courses) > 0)
            @foreach($courses as $course)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100">
                        @if(isset($course['imageurl']) && !empty($course['imageurl']))
                            <img src="{{ $course['imageurl'] }}" class="card-img-top" alt="{{ $course['fullname'] }}">
                        @else
                            <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 160px;">
                                <i class="fas fa-book fa-4x text-muted"></i>
                            </div>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $course['fullname'] }}</h5>
                            <p class="card-text text-muted">{{ $course['shortname'] }}</p>
                            
                            @if(isset($course['summary']) && !empty($course['summary']))
                                <p class="card-text">{{ Str::limit(strip_tags($course['summary']), 100) }}</p>
                            @endif
                            
                            <div class="progress mb-3" style="height: 10px;">
                                <div class="progress-bar" role="progressbar" style="width: {{ $course['progress'] ?? 0 }}%;" aria-valuenow="{{ $course['progress'] ?? 0 }}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p class="text-center">
                                <strong>Progreso: {{ $course['progress'] ?? 0 }}%</strong>
                            </p>
                        </div>
                        <div class="card-footer d-flex justify-content-between align-items-center">
                            <small class="text-muted">
                                @if(isset($course['startdate']))
                                    Inicio: {{ date('d/m/Y', $course['startdate']) }}
                                @endif
                            </small>
                            <a href="{{ route('moodle.student.course', $course['id']) }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-eye me-1"></i> Ver Curso
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col-12">
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i> No estás matriculado en ningún curso.
                </div>
            </div>
        @endif
    </div>
    
    <!-- Pagination if needed -->
    @if(isset($courses) && method_exists($courses, 'links'))
        <div class="d-flex justify-content-center mt-4">
            {{ $courses->links() }}
        </div>
    @endif
    
    <!-- Available Courses -->
    <div class="card mt-5">
        <div class="card-header">
            <i class="fas fa-graduation-cap me-2"></i> Cursos Disponibles
        </div>
        <div class="card-body">
            @if(isset($availableCourses) && count($availableCourses) > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Curso</th>
                                <th>Categoría</th>
                                <th>Descripción</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($availableCourses as $course)
                                <tr>
                                    <td>{{ $course['fullname'] }}</td>
                                    <td>
                                        @if(isset($categories))
                                            @foreach($categories as $category)
                                                @if($category['id'] == $course['categoryid'])
                                                    {{ $category['name'] }}
                                                @endif
                                            @endforeach
                                        @else
                                            {{ $course['categoryid'] }}
                                        @endif
                                    </td>
                                    <td>{{ Str::limit(strip_tags($course['summary'] ?? ''), 100) }}</td>
                                    <td>
                                        <a href="{{ route('moodle.student.course.preview', $course['id']) }}" class="btn btn-info btn-sm">
                                            <i class="fas fa-info-circle me-1"></i> Información
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination if needed -->
                @if(isset($availableCourses) && method_exists($availableCourses, 'links'))
                    <div class="d-flex justify-content-center mt-4">
                        {{ $availableCourses->links() }}
                    </div>
                @endif
            @else
                <p class="text-muted">No hay cursos disponibles para matriculación.</p>
            @endif
        </div>
    </div>
@endsection
