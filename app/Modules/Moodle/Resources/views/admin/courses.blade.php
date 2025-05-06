<?php

namespace App\Modules\Moodle\Resources\views\admin;

?>

@extends('moodle::admin.layout')

@section('title', 'Gestión de Cursos')
@section('subtitle', 'Administrar cursos de Moodle')

@section('content')
    <!-- Search and Filter -->
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-search me-2"></i> Buscar Cursos
        </div>
        <div class="card-body">
            <form action="{{ route('moodle.admin.courses') }}" method="GET" class="row g-3">
                <div class="col-md-4">
                    <label for="search" class="form-label">Buscar</label>
                    <input type="text" class="form-control" id="search" name="search" placeholder="Nombre o ID del curso" value="{{ $search ?? '' }}">
                </div>
                <div class="col-md-3">
                    <label for="category" class="form-label">Categoría</label>
                    <select class="form-select" id="category" name="category">
                        <option value="">Todas las categorías</option>
                        @if(isset($categories) && count($categories) > 0)
                            @foreach($categories as $category)
                                <option value="{{ $category['id'] }}" {{ isset($selectedCategory) && $selectedCategory == $category['id'] ? 'selected' : '' }}>
                                    {{ $category['name'] }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="visibility" class="form-label">Visibilidad</label>
                    <select class="form-select" id="visibility" name="visibility">
                        <option value="">Todos</option>
                        <option value="visible" {{ isset($visibility) && $visibility == 'visible' ? 'selected' : '' }}>Visible</option>
                        <option value="hidden" {{ isset($visibility) && $visibility == 'hidden' ? 'selected' : '' }}>Oculto</option>
                    </select>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-search me-2"></i> Buscar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Courses List -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <i class="fas fa-book me-2"></i> Cursos
            </div>
            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#createCourseModal">
                <i class="fas fa-plus me-2"></i> Nuevo Curso
            </button>
        </div>
        <div class="card-body">
            @if(isset($courses) && count($courses) > 0)
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Categoría</th>
                                <th>Formato</th>
                                <th>Visibilidad</th>
                                <th>Estudiantes</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($courses as $course)
                                <tr>
                                    <td>{{ $course['id'] }}</td>
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
                                    <td>{{ ucfirst($course['format'] ?? 'topics') }}</td>
                                    <td>
                                        @if(isset($course['visible']) && $course['visible'])
                                            <span class="badge bg-success">Visible</span>
                                        @else
                                            <span class="badge bg-secondary">Oculto</span>
                                        @endif
                                    </td>
                                    <td>{{ $course['enrolleduserscount'] ?? 0 }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editCourseModal{{ $course['id'] }}">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#viewCourseModal{{ $course['id'] }}">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <a href="{{ route('moodle.admin.enrollments') }}?course_id={{ $course['id'] }}" class="btn btn-warning btn-sm">
                                                <i class="fas fa-user-graduate"></i>
                                            </a>
                                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteCourseModal{{ $course['id'] }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $courses->links() }}
                </div>
            @else
                <p class="text-muted">No se encontraron cursos.</p>
            @endif
        </div>
    </div>

    <!-- Create Course Modal -->
    <div class="modal fade" id="createCourseModal" tabindex="-1" aria-labelledby="createCourseModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createCourseModalLabel">Crear Nuevo Curso</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('moodle.admin.courses.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="fullname" class="form-label">Nombre completo</label>
                                <input type="text" class="form-control" id="fullname" name="fullname" required>
                            </div>
                            <div class="col-md-6">
                                <label for="shortname" class="form-label">Nombre corto</label>
                                <input type="text" class="form-control" id="shortname" name="shortname" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="categoryid" class="form-label">Categoría</label>
                                <select class="form-select" id="categoryid" name="categoryid" required>
                                    @if(isset($categories) && count($categories) > 0)
                                        @foreach($categories as $category)
                                            <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="format" class="form-label">Formato</label>
                                <select class="form-select" id="format" name="format">
                                    <option value="topics">Temas</option>
                                    <option value="weeks">Semanas</option>
                                    <option value="social">Social</option>
                                    <option value="singleactivity">Actividad única</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="summary" class="form-label">Resumen</label>
                            <textarea class="form-control" id="summary" name="summary" rows="3"></textarea>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="startdate" class="form-label">Fecha de inicio</label>
                                <input type="date" class="form-control" id="startdate" name="startdate">
                            </div>
                            <div class="col-md-6">
                                <label for="enddate" class="form-label">Fecha de fin</label>
                                <input type="date" class="form-control" id="enddate" name="enddate">
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="visible" name="visible" checked>
                                <label class="form-check-label" for="visible">
                                    Curso visible
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Crear Curso</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Course Modals -->
    @if(isset($courses) && count($courses) > 0)
        @foreach($courses as $course)
            <div class="modal fade" id="editCourseModal{{ $course['id'] }}" tabindex="-1" aria-labelledby="editCourseModalLabel{{ $course['id'] }}" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editCourseModalLabel{{ $course['id'] }}">Editar Curso</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('moodle.admin.courses.update', $course['id']) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="fullname{{ $course['id'] }}" class="form-label">Nombre completo</label>
                                        <input type="text" class="form-control" id="fullname{{ $course['id'] }}" name="fullname" value="{{ $course['fullname'] }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="shortname{{ $course['id'] }}" class="form-label">Nombre corto</label>
                                        <input type="text" class="form-control" id="shortname{{ $course['id'] }}" name="shortname" value="{{ $course['shortname'] }}" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="categoryid{{ $course['id'] }}" class="form-label">Categoría</label>
                                        <select class="form-select" id="categoryid{{ $course['id'] }}" name="categoryid" required>
                                            @if(isset($categories) && count($categories) > 0)
                                                @foreach($categories as $category)
                                                    <option value="{{ $category['id'] }}" {{ $course['categoryid'] == $category['id'] ? 'selected' : '' }}>
                                                        {{ $category['name'] }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="format{{ $course['id'] }}" class="form-label">Formato</label>
                                        <select class="form-select" id="format{{ $course['id'] }}" name="format">
                                            <option value="topics" {{ ($course['format'] ?? 'topics') == 'topics' ? 'selected' : '' }}>Temas</option>
                                            <option value="weeks" {{ ($course['format'] ?? 'topics') == 'weeks' ? 'selected' : '' }}>Semanas</option>
                                            <option value="social" {{ ($course['format'] ?? 'topics') == 'social' ? 'selected' : '' }}>Social</option>
                                            <option value="singleactivity" {{ ($course['format'] ?? 'topics') == 'singleactivity' ? 'selected' : '' }}>Actividad única</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="summary{{ $course['id'] }}" class="form-label">Resumen</label>
                                    <textarea class="form-control" id="summary{{ $course['id'] }}" name="summary" rows="3">{{ $course['summary'] ?? '' }}</textarea>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="startdate{{ $course['id'] }}" class="form-label">Fecha de inicio</label>
                                        <input type="date" class="form-control" id="startdate{{ $course['id'] }}" name="startdate" value="{{ isset($course['startdate']) ? date('Y-m-d', $course['startdate']) : '' }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="enddate{{ $course['id'] }}" class="form-label">Fecha de fin</label>
                                        <input type="date" class="form-control" id="enddate{{ $course['id'] }}" name="enddate" value="{{ isset($course['enddate']) ? date('Y-m-d', $course['enddate']) : '' }}">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="visible{{ $course['id'] }}" name="visible" {{ isset($course['visible']) && $course['visible'] ? 'checked' : '' }}>
                                        <label class="form-check-label" for="visible{{ $course['id'] }}">
                                            Curso visible
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- View Course Modal -->
            <div class="modal fade" id="viewCourseModal{{ $course['id'] }}" tabindex="-1" aria-labelledby="viewCourseModalLabel{{ $course['id'] }}" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="viewCourseModalLabel{{ $course['id'] }}">Detalles del Curso</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <h4>{{ $course['fullname'] }}</h4>
                                    <p class="text-muted">{{ $course['shortname'] }}</p>
                                </div>
                            </div>
                            
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <p><strong>ID:</strong> {{ $course['id'] }}</p>
                                    <p><strong>Categoría:</strong> 
                                        @if(isset($categories))
                                            @foreach($categories as $category)
                                                @if($category['id'] == $course['categoryid'])
                                                    {{ $category['name'] }}
                                                @endif
                                            @endforeach
                                        @else
                                            {{ $course['categoryid'] }}
                                        @endif
                                    </p>
                                    <p><strong>Formato:</strong> {{ ucfirst($course['format'] ?? 'topics') }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Visibilidad:</strong> 
                                        @if(isset($course['visible']) && $course['visible'])
                                            <span class="badge bg-success">Visible</span>
                                        @else
                                            <span class="badge bg-secondary">Oculto</span>
                                        @endif
                                    </p>
                                    <p><strong>Fecha de inicio:</strong> {{ isset($course['startdate']) ? date('d/m/Y', $course['startdate']) : 'No especificada' }}</p>
                                    <p><strong>Fecha de fin:</strong> {{ isset($course['enddate']) ? date('d/m/Y', $course['enddate']) : 'No especificada' }}</p>
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <h5>Resumen</h5>
                                <div class="card">
                                    <div class="card-body">
                                        {!! $course['summary'] ?? 'Sin resumen' !!}
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <h5>Estudiantes Matriculados</h5>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span>Total: <strong>{{ $course['enrolleduserscount'] ?? 0 }}</strong> estudiantes</span>
                                    <a href="{{ route('moodle.admin.enrollments') }}?course_id={{ $course['id'] }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-user-graduate me-1"></i> Gestionar Matriculaciones
                                    </a>
                                </div>
                            </div>
                            
                            <div>
                                <h5>Contenido del Curso</h5>
                                <div id="courseContent{{ $course['id'] }}">
                                    <p class="text-center"><i class="fas fa-spinner fa-spin"></i> Cargando contenido...</p>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <a href="{{ route('moodle.admin.courses.content', $course['id']) }}" class="btn btn-primary">
                                <i class="fas fa-edit me-1"></i> Editar Contenido
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Delete Course Modal -->
            <div class="modal fade" id="deleteCourseModal{{ $course['id'] }}" tabindex="-1" aria-labelledby="deleteCourseModalLabel{{ $course['id'] }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteCourseModalLabel{{ $course['id'] }}">Confirmar Eliminación</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>¿Está seguro de que desea eliminar el curso <strong>{{ $course['fullname'] }}</strong>?</p>
                            <p class="text-danger">Esta acción no se puede deshacer y eliminará todo el contenido del curso, incluyendo actividades, recursos y calificaciones.</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <form action="{{ route('moodle.admin.courses.destroy', $course['id']) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar Curso</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Load course content when viewing details
        @if(isset($courses) && count($courses) > 0)
            @foreach($courses as $course)
                $('#viewCourseModal{{ $course['id'] }}').on('shown.bs.modal', function () {
                    $.ajax({
                        url: '{{ route("moodle.admin.courses.content.get", $course["id"]) }}',
                        type: 'GET',
                        success: function(response) {
                            if (response.success) {
                                let html = '';
                                if (response.contents && response.contents.length > 0) {
                                    html = '<div class="accordion" id="courseContentAccordion{{ $course['id'] }}">';
                                    
                                    response.contents.forEach(function(section, index) {
                                        html += '<div class="accordion-item">';
                                        html += '<h2 class="accordion-header" id="heading' + index + '">';
                                        html += '<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse' + index + '" aria-expanded="false" aria-controls="collapse' + index + '">';
                                        html += section.name;
                                        html += '</button></h2>';
                                        
                                        html += '<div id="collapse' + index + '" class="accordion-collapse collapse" aria-labelledby="heading' + index + '" data-bs-parent="#courseContentAccordion{{ $course['id'] }}">';
                                        html += '<div class="accordion-body">';
                                        
                                        if (section.summary) {
                                            html += '<div class="mb-3">' + section.summary + '</div>';
                                        }
                                        
                                        if (section.modules && section.modules.length > 0) {
                                            html += '<ul class="list-group">';
                                            section.modules.forEach(function(module) {
                                                html += '<li class="list-group-item d-flex justify-content-between align-items-center">';
                                                html += '<div>';
                                                
                                                // Module icon based on modname
                                                let icon = 'fa-file';
                                                if (module.modname === 'forum') icon = 'fa-comments';
                                                else if (module.modname === 'quiz') icon = 'fa-question-circle';
                                                else if (module.modname === 'assign') icon = 'fa-tasks';
                                                else if (module.modname === 'resource') icon = 'fa-file-alt';
                                                else if (module.modname === 'url') icon = 'fa-link';
                                                
                                                html += '<i class="fas ' + icon + ' me-2"></i> ';
                                                html += module.name;
                                                html += '</div>';
                                                
                                                // Visibility badge
                                                if (module.visible) {
                                                    html += '<span class="badge bg-success">Visible</span>';
                                                } else {
                                                    html += '<span class="badge bg-secondary">Oculto</span>';
                                                }
                                                
                                                html += '</li>';
                                            });
                                            html += '</ul>';
                                        } else {
                                            html += '<p class="text-muted">No hay contenido en esta sección.</p>';
                                        }
                                        
                                        html += '</div></div></div>';
                                    });
                                    
                                    html += '</div>';
                                } else {
                                    html = '<p class="text-muted">No hay contenido disponible para este curso.</p>';
                                }
                                
                                $('#courseContent{{ $course['id'] }}').html(html);
                            } else {
                                $('#courseContent{{ $course['id'] }}').html('<p class="text-danger">Error al cargar el contenido: ' + response.message + '</p>');
                            }
                        },
                        error: function() {
                            $('#courseContent{{ $course['id'] }}').html('<p class="text-danger">Error al cargar el contenido. Por favor, inténtelo de nuevo.</p>');
                        }
                    });
                });
            @endforeach
        @endif
    });
</script>
@endsection
