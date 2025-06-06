<?php

namespace App\Modules\Moodle\Resources\views\admin;

?>

@extends('moodle::admin.layout')

@section('title', 'Gestión de Certificados')
@section('subtitle', 'Administrar certificados emitidos')

@section('content')
    <!-- Search and Filter -->
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-search me-2"></i> Buscar Certificados
        </div>
        <div class="card-body">
            <form action="{{ route('moodle.admin.certificates') }}" method="GET" class="row g-3">
                <div class="col-md-4">
                    <label for="search" class="form-label">Buscar</label>
                    <input type="text" class="form-control" id="search" name="search" placeholder="Nombre de usuario o curso" value="{{ $search ?? '' }}">
                </div>
                <div class="col-md-3">
                    <label for="course_id" class="form-label">Curso</label>
                    <select class="form-select" id="course_id" name="course_id">
                        <option value="">Todos los cursos</option>
                        @if(isset($courses) && count($courses) > 0)
                            @foreach($courses as $course)
                                <option value="{{ $course['id'] }}" {{ isset($selectedCourseId) && $selectedCourseId == $course['id'] ? 'selected' : '' }}>
                                    {{ $course['fullname'] }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="dateRange" class="form-label">Fecha de emisión</label>
                    <select class="form-select" id="dateRange" name="dateRange">
                        <option value="">Cualquier fecha</option>
                        <option value="today" {{ isset($dateRange) && $dateRange == 'today' ? 'selected' : '' }}>Hoy</option>
                        <option value="week" {{ isset($dateRange) && $dateRange == 'week' ? 'selected' : '' }}>Última semana</option>
                        <option value="month" {{ isset($dateRange) && $dateRange == 'month' ? 'selected' : '' }}>Último mes</option>
                        <option value="year" {{ isset($dateRange) && $dateRange == 'year' ? 'selected' : '' }}>Último año</option>
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

    <!-- Certificates List -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <i class="fas fa-certificate me-2"></i> Certificados
            </div>
            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#generateCertificateModal">
                <i class="fas fa-plus me-2"></i> Generar Certificado
            </button>
        </div>
        <div class="card-body">
            @if(isset($certificates) && count($certificates) > 0)
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Usuario</th>
                                <th>Curso</th>
                                <th>Fecha de Emisión</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($certificates as $certificate)
                                <tr>
                                    <td>{{ $certificate->certificate_id }}</td>
                                    <td>
                                        @if(isset($certificate->user_data))
                                            {{ $certificate->user_data['firstname'] ?? '' }} {{ $certificate->user_data['lastname'] ?? '' }}
                                        @else
                                            Usuario #{{ $certificate->user_id }}
                                        @endif
                                    </td>
                                    <td>
                                        @if(isset($certificate->course_data))
                                            {{ $certificate->course_data['fullname'] ?? 'Curso desconocido' }}
                                        @else
                                            Curso #{{ $certificate->course_id }}
                                        @endif
                                    </td>
                                    <td>{{ $certificate->issued_at->format('d/m/Y H:i') }}</td>

                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('moodle.certificates.download', $certificate->id) }}" class="btn btn-primary btn-sm" target="_blank">
                                                <i class="fas fa-download"></i>
                                            </a>
                                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteCertificateModal{{ $certificate->id }}">
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
                    {{ $certificates->links() }}
                </div>
            @else
                <p class="text-muted">No se encontraron certificados.</p>
            @endif
        </div>
    </div>

    <!-- Generate Certificate Modal -->
    <div class="modal fade" id="generateCertificateModal" tabindex="-1" aria-labelledby="generateCertificateModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="generateCertificateModalLabel">Generar Certificado</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('moodle.certificates.generate') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i> Para generar un certificado, el usuario debe haber completado el curso.
                        </div>

                        <div class="mb-3">
                            <label for="user_search" class="form-label">Buscar Usuario</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="user_search" placeholder="Nombre, email o username">
                                <button class="btn btn-outline-secondary" type="button" id="searchUserBtn">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                            <small class="form-text text-muted">Busque un usuario para generar su certificado.</small>
                        </div>

                        <div id="userSearchResults" class="mb-3" style="display: none;">
                            <label class="form-label">Resultados de la búsqueda</label>
                            <div class="table-responsive">
                                <table class="table table-sm table-hover">
                                    <thead>
                                        <tr>
                                            <th>Seleccionar</th>
                                            <th>Nombre</th>
                                            <th>Email</th>
                                            <th>Username</th>
                                        </tr>
                                    </thead>
                                    <tbody id="userSearchResultsBody">
                                        <!-- Search results will be populated here -->
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="course_id_select" class="form-label">Curso</label>
                            <select class="form-select" id="course_id_select" name="course_id" required disabled>
                                <option value="">Seleccione un curso</option>
                                @if(isset($courses) && count($courses) > 0)
                                    @foreach($courses as $course)
                                        <option value="{{ $course['id'] }}">{{ $course['fullname'] }}</option>
                                    @endforeach
                                @endif
                            </select>
                            <small class="form-text text-muted">Seleccione primero un usuario para ver sus cursos completados.</small>
                        </div>

                        <div class="mb-3">
                            <label for="options" class="form-label">Opciones adicionales</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="send_email" name="options[send_email]" checked>
                                <label class="form-check-label" for="send_email">
                                    Enviar certificado por email
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="custom_date" name="options[custom_date]">
                                <label class="form-check-label" for="custom_date">
                                    Usar fecha personalizada
                                </label>
                            </div>
                            <div id="custom_date_container" class="mt-2" style="display: none;">
                                <input type="date" class="form-control" id="custom_date_value" name="options[custom_date_value]">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary" id="generateBtn" disabled>Generar Certificado</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Certificate Modals -->
    @if(isset($certificates) && count($certificates) > 0)
        @foreach($certificates as $certificate)
            <div class="modal fade" id="deleteCertificateModal{{ $certificate->id }}" tabindex="-1" aria-labelledby="deleteCertificateModalLabel{{ $certificate->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteCertificateModalLabel{{ $certificate->id }}">Confirmar Eliminación</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>¿Está seguro de que desea eliminar este certificado?</p>
                            <p><strong>ID:</strong> {{ $certificate->certificate_id }}</p>
                            <p><strong>Usuario:</strong>
                               @if(isset($certificate->user_data))
                                    {{ $certificate->user_data['firstname'] ?? '' }} {{ $certificate->user_data['lastname'] ?? '' }}
                                @else
                                    Usuario #{{ $certificate->user_id }}
                                @endif
                            </p>
                            <p><strong>Curso:</strong>
                                @if(isset($certificate->course_data))
                                    {{ $certificate->course_data['fullname'] ?? 'Curso desconocido' }}
                                @else
                                    Curso #{{ $certificate->course_id }}
                                @endif
                            </p>
                            <p class="text-danger">Esta acción no se puede deshacer.</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <form action="{{ route('moodle.admin.certificates.destroy', $certificate->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar Certificado</button>
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
        // User search functionality
        $('#searchUserBtn').click(function() {
            const searchTerm = $('#user_search').val().trim();
            if (searchTerm.length < 3) {
                alert('Por favor, ingrese al menos 3 caracteres para buscar.');
                return;
            }

            // Show loading indicator
            $('#userSearchResultsBody').html('<tr><td colspan="4" class="text-center"><i class="fas fa-spinner fa-spin me-2"></i> Buscando usuarios...</td></tr>');
            $('#userSearchResults').show();

            // Make AJAX request to search users
            $.ajax({
                url: '{{ route("moodle.admin.users.search") }}',
                type: 'GET',
                data: { search: searchTerm },
                success: function(response) {
                    if (response.success) {
                        let html = '';
                        if (response.users && response.users.length > 0) {
                            response.users.forEach(function(user) {
                                html += '<tr>';
                                html += '<td><input type="radio" name="user_id" value="' + user.id + '" class="form-check-input user-select"></td>';
                                html += '<td>' + user.firstname + ' ' + user.lastname + '</td>';
                                html += '<td>' + user.email + '</td>';
                                html += '<td>' + user.username + '</td>';
                                html += '</tr>';
                            });
                        } else {
                            html = '<tr><td colspan="4" class="text-center">No se encontraron usuarios.</td></tr>';
                        }

                        $('#userSearchResultsBody').html(html);
                    } else {
                        $('#userSearchResultsBody').html('<tr><td colspan="4" class="text-center text-danger">' + response.message + '</td></tr>');
                    }
                },
                error: function() {
                    $('#userSearchResultsBody').html('<tr><td colspan="4" class="text-center text-danger">Error al buscar usuarios. Por favor, inténtelo de nuevo.</td></tr>');
                }
            });
        });

        // When a user is selected, enable course selection and load completed courses
        $(document).on('change', '.user-select', function() {
            const userId = $(this).val();

            // Enable course dropdown
            $('#course_id_select').prop('disabled', false);

            // Load completed courses for the selected user
            $.ajax({
                url: '{{ route("moodle.admin.users.completed-courses") }}',
                type: 'GET',
                data: { user_id: userId },
                success: function(response) {
                    if (response.success) {
                        let html = '<option value="">Seleccione un curso</option>';
                        if (response.courses && response.courses.length > 0) {
                            response.courses.forEach(function(course) {
                                html += '<option value="' + course.id + '">' + course.fullname + '</option>';
                            });
                            $('#generateBtn').prop('disabled', false);
                        } else {
                            html = '<option value="">No hay cursos completados</option>';
                            $('#generateBtn').prop('disabled', true);
                        }

                        $('#course_id_select').html(html);
                    } else {
                        $('#course_id_select').html('<option value="">Error al cargar cursos</option>');
                        $('#generateBtn').prop('disabled', true);
                    }
                },
                error: function() {
                    $('#course_id_select').html('<option value="">Error al cargar cursos</option>');
                    $('#generateBtn').prop('disabled', true);
                }
            });
        });

        // Toggle custom date input
        $('#custom_date').change(function() {
            if ($(this).is(':checked')) {
                $('#custom_date_container').show();
            } else {
                $('#custom_date_container').hide();
            }
        });

        // Also trigger search when pressing Enter in the search field
        $('#user_search').keypress(function(e) {
            if (e.which === 13) {
                e.preventDefault();
                $('#searchUserBtn').click();
            }
        });
    });
</script>
@endsection
