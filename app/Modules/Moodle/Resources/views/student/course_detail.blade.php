<?php

namespace App\Modules\Moodle\Resources\views\student;

?>

@extends('moodle::student.layout')

@section('title', 'Detalle del Curso')
@section('subtitle', isset($course) ? $course['fullname'] : 'Información del curso')

@section('content')
    @if(isset($course))
        <!-- Course Header -->
        <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 text-center mb-3 mb-md-0">
                        @if(isset($course['imageurl']) && !empty($course['imageurl']))
                            <img src="{{ $course['imageurl'] }}" class="img-fluid rounded" alt="{{ $course['fullname'] }}" style="max-height: 200px;">
                        @else
                            <div class="bg-light d-flex align-items-center justify-content-center rounded" style="height: 200px; width: 100%;">
                                <i class="fas fa-book fa-5x text-muted"></i>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-9">
                        <h3>{{ $course['fullname'] }}</h3>
                        <p class="text-muted">{{ $course['shortname'] }}</p>
                        
                        <div class="mb-3">
                            <div class="progress" style="height: 20px;">
                                <div class="progress-bar" role="progressbar" style="width: {{ $course['progress'] ?? 0 }}%;" aria-valuenow="{{ $course['progress'] ?? 0 }}" aria-valuemin="0" aria-valuemax="100">{{ $course['progress'] ?? 0 }}%</div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Categoría:</strong> 
                                    @if(isset($category))
                                        {{ $category['name'] }}
                                    @else
                                        {{ $course['categoryid'] }}
                                    @endif
                                </p>
                                <p><strong>Formato:</strong> {{ ucfirst($course['format'] ?? 'topics') }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Fecha de inicio:</strong> {{ isset($course['startdate']) ? date('d/m/Y', $course['startdate']) : 'No especificada' }}</p>
                                <p><strong>Fecha de fin:</strong> {{ isset($course['enddate']) ? date('d/m/Y', $course['enddate']) : 'No especificada' }}</p>
                            </div>
                        </div>
                        
                        <div class="mt-3">
                            <a href="{{ $moodleUrl }}/course/view.php?id={{ $course['id'] }}" class="btn btn-primary" target="_blank">
                                <i class="fas fa-external-link-alt me-2"></i> Abrir en Moodle
                            </a>
                            
                            @if(($course['progress'] ?? 0) >= 100)
                                <a href="{{ route('moodle.student.certificates', ['course_id' => $course['id']]) }}" class="btn btn-success ms-2">
                                    <i class="fas fa-certificate me-2"></i> Ver Certificado
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Course Summary -->
        @if(isset($course['summary']) && !empty($course['summary']))
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-info-circle me-2"></i> Descripción del Curso
                </div>
                <div class="card-body">
                    {!! $course['summary'] !!}
                </div>
            </div>
        @endif
        
        <!-- Course Content -->
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-list me-2"></i> Contenido del Curso
            </div>
            <div class="card-body">
                @if(isset($sections) && count($sections) > 0)
                    <div class="accordion" id="courseContentAccordion">
                        @foreach($sections as $index => $section)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading{{ $index }}">
                                    <button class="accordion-button {{ $index > 0 ? 'collapsed' : '' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}" aria-expanded="{{ $index === 0 ? 'true' : 'false' }}" aria-controls="collapse{{ $index }}">
                                        {{ $section['name'] }}
                                        
                                        @if(isset($section['progress']))
                                            <span class="badge bg-primary ms-2">{{ $section['progress'] }}%</span>
                                        @endif
                                    </button>
                                </h2>
                                <div id="collapse{{ $index }}" class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}" aria-labelledby="heading{{ $index }}" data-bs-parent="#courseContentAccordion">
                                    <div class="accordion-body">
                                        @if(isset($section['summary']) && !empty($section['summary']))
                                            <div class="mb-3">
                                                {!! $section['summary'] !!}
                                            </div>
                                        @endif
                                        
                                        @if(isset($section['modules']) && count($section['modules']) > 0)
                                            <ul class="list-group">
                                                @foreach($section['modules'] as $module)
                                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                                        <div>
                                                            @php
                                                                // Module icon based on modname
                                                                $icon = 'fa-file';
                                                                if ($module['modname'] === 'forum') $icon = 'fa-comments';
                                                                elseif ($module['modname'] === 'quiz') $icon = 'fa-question-circle';
                                                                elseif ($module['modname'] === 'assign') $icon = 'fa-tasks';
                                                                elseif ($module['modname'] === 'resource') $icon = 'fa-file-alt';
                                                                elseif ($module['modname'] === 'url') $icon = 'fa-link';
                                                            @endphp
                                                            
                                                            <i class="fas {{ $icon }} me-2"></i>
                                                            
                                                            @if(isset($module['url']) && !empty($module['url']))
                                                                <a href="{{ $module['url'] }}" target="_blank">{{ $module['name'] }}</a>
                                                            @else
                                                                {{ $module['name'] }}
                                                            @endif
                                                        </div>
                                                        
                                                        <div>
                                                            @if(isset($module['completion']) && $module['completion'] === 1)
                                                                <span class="badge bg-success">Completado</span>
                                                            @elseif(isset($module['completion']) && $module['completion'] === 0)
                                                                <span class="badge bg-warning">Pendiente</span>
                                                            @endif
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <p class="text-muted">No hay contenido en esta sección.</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-muted">No hay contenido disponible para este curso.</p>
                @endif
            </div>
        </div>
        
        <!-- Course Grades -->
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-chart-line me-2"></i> Calificaciones
            </div>
            <div class="card-body">
                @if(isset($grades) && count($grades) > 0)
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Actividad</th>
                                    <th>Calificación</th>
                                    <th>Rango</th>
                                    <th>Porcentaje</th>
                                    <th>Retroalimentación</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($grades as $grade)
                                    <tr>
                                        <td>{{ $grade['itemname'] }}</td>
                                        <td>{{ $grade['gradeformatted'] }}</td>
                                        <td>{{ $grade['rangeformatted'] }}</td>
                                        <td>
                                            @if(isset($grade['percentage']))
                                                <div class="progress" style="height: 10px;">
                                                    <div class="progress-bar" role="progressbar" style="width: {{ $grade['percentage'] }}%;" aria-valuenow="{{ $grade['percentage'] }}" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <small>{{ $grade['percentage'] }}%</small>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>{{ $grade['feedback'] ?? '-' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-muted">No hay calificaciones disponibles para este curso.</p>
                @endif
            </div>
        </div>
        
        <!-- Course Participants -->
        <div class="card">
            <div class="card-header">
                <i class="fas fa-users me-2"></i> Participantes
            </div>
            <div class="card-body">
                @if(isset($participants) && count($participants) > 0)
                    <div class="row">
                        @foreach($participants as $participant)
                            <div class="col-md-6 col-lg-4 mb-3">
                                <div class="card h-100">
                                    <div class="card-body d-flex">
                                        <div class="me-3">
                                            @if(isset($participant['profileimageurl']) && !empty($participant['profileimageurl']))
                                                <img src="{{ $participant['profileimageurl'] }}" class="rounded-circle" alt="{{ $participant['fullname'] }}" style="width: 50px; height: 50px;">
                                            @else
                                                <div class="bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                                    <i class="fas fa-user"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div>
                                            <h6 class="card-title mb-1">{{ $participant['fullname'] }}</h6>
                                            <p class="card-text text-muted mb-1">
                                                @if(isset($participant['roles']) && count($participant['roles']) > 0)
                                                    @foreach($participant['roles'] as $role)
                                                        <span class="badge bg-info">{{ $role['shortname'] }}</span>
                                                    @endforeach
                                                @else
                                                    <span class="badge bg-secondary">Estudiante</span>
                                                @endif
                                            </p>
                                            <small class="text-muted">
                                                @if(isset($participant['lastaccess']))
                                                    Último acceso: {{ date('d/m/Y', $participant['lastaccess']) }}
                                                @else
                                                    Nunca ha accedido
                                                @endif
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    <!-- Pagination if needed -->
                    @if(isset($participants) && method_exists($participants, 'links'))
                        <div class="d-flex justify-content-center mt-4">
                            {{ $participants->links() }}
                        </div>
                    @endif
                @else
                    <p class="text-muted">No hay participantes disponibles para este curso.</p>
                @endif
            </div>
        </div>
    @else
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-circle me-2"></i> No se pudo cargar la información del curso.
        </div>
    @endif
@endsection
