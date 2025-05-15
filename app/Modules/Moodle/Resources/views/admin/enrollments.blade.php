<?php

namespace App\Modules\Moodle\Resources\views\admin;

?>

@extends('moodle::admin.layout')

@section('title', 'Gestión de Matriculaciones')
@section('subtitle', 'Administrar matriculaciones de estudiantes en cursos')

@section('content')
    <!-- Course Selection -->
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-book me-2"></i> Seleccionar Curso
        </div>
        <div class="card-body">
            <form action="{{ route('moodle.admin.enrollments') }}" method="GET" class="row g-3">
                <div class="col-md-8">
                    <label for="course_id" class="form-label">Curso</label>
                    <select class="form-select" id="course_id" name="course_id" required>
                        <option value="">Seleccione un curso</option>
                        @if(isset($courses) && count($courses) > 0)
                            @foreach($courses as $course)
                                <option value="{{ $course['id'] }}" {{ isset($selectedCourseId) && $selectedCourseId == $course['id'] ? 'selected' : '' }}>
                                    {{ $course['fullname'] }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-search me-2"></i> Ver Matriculaciones
                    </button>
                </div>
            </form>
        </div>
    </div>

    @if(isset($selectedCourseId) && $selectedCourseId)
        <!-- Enrolled Users -->
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <i class="fas fa-user-graduate me-2"></i> Usuarios Matriculados
                </div>
                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#enrollUserModal">
                    <i class="fas fa-plus me-2"></i> Matricular Usuario
                </button>
            </div>
            <div class="card-body">
                @if(isset($enrolledUsers) && count($enrolledUsers) > 0)
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Email</th>
                                    <th>Rol</th>
                                    <th>Progreso</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($enrolledUsers as $user)
                                    <tr>
                                        <td>{{ $user['id'] }}</td>
                                        <td>{{ $user['firstname'] }} {{ $user['lastname'] }}</td>
                                        <td>{{ $user['email'] }}</td>
                                        <td>
                                            @if(isset($user['roles']) && count($user['roles']) > 0)
                                                @foreach($user['roles'] as $role)
                                                    <span class="badge bg-info">{{ $role['shortname'] }}</span>
                                                @endforeach
                                            @else
                                                <span class="badge bg-secondary">Sin rol</span>
                                            @endif
                                        </td>
                                        <td>
                                            @php
                                                // Simulate progress calculation - in real implementation this would come from Moodle
                                                $progress = isset($user['progress']) ? $user['progress'] : rand(0, 100);
                                            @endphp
                                            <div class="progress" style="height: 10px;">
                                                <div class="progress-bar" role="progressbar" style="width: {{ $progress }}%;" aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100">{{ $progress }}%</div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editEnrollmentModal{{ $user['id'] }}">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#unenrollUserModal{{ $user['id'] }}">
                                                    <i class="fas fa-user-minus"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination if needed -->
                    @if(isset($enrolledUsers) && method_exists($enrolledUsers, 'links'))
                        <div class="d-flex justify-content-center mt-4">
                            {{ $enrolledUsers->links('vendor.pagination.bootstrap-5') }}
                        </div>
                    @endif
                @else
                    <p class="text-muted">No hay usuarios matriculados en este curso.</p>
                @endif
            </div>
        </div>

        <!-- Enroll User Modal -->
        <div class="modal fade" id="enrollUserModal" tabindex="-1" aria-labelledby="enrollUserModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="enrollUserModalLabel">Matricular Usuario</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('moodle.admin.enrollments.enroll') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <input type="hidden" name="course_id" value="{{ $selectedCourseId }}">

                            <div class="mb-3">
                                <label for="user_search" class="form-label">Buscar Usuario</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="user_search" placeholder="Nombre">
                                    <button class="btn btn-outline-secondary" type="button" id="searchUserBtn">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                                <small class="form-text text-muted">Busque un usuario para matricularlo en el curso.</small>
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
                                <label for="role_id" class="form-label">Rol</label>
                                <select class="form-select" id="role_id" name="role_id" required>
                                    <option value="5">Estudiante</option>
                                    <option value="3">Profesor</option>
                                    <option value="4">Profesor sin permiso de edición</option>
                                    <option value="1">Gestor</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="send_notification" name="send_notification" checked>
                                    <label class="form-check-label" for="send_notification">
                                        Enviar notificación al usuario
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary" id="enrollBtn" disabled>Matricular</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Edit Enrollment Modals -->
        @if(isset($enrolledUsers) && count($enrolledUsers) > 0)
            @foreach($enrolledUsers as $user)
                <div class="modal fade" id="editEnrollmentModal{{ $user['id'] }}" tabindex="-1" aria-labelledby="editEnrollmentModalLabel{{ $user['id'] }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editEnrollmentModalLabel{{ $user['id'] }}">Editar Matriculación</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{ route('moodle.admin.enrollments.update') }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-body">
                                    <input type="hidden" name="course_id" value="{{ $selectedCourseId }}">
                                    <input type="hidden" name="user_id" value="{{ $user['id'] }}">

                                    <div class="mb-3">
                                        <label class="form-label">Usuario</label>
                                        <input type="text" class="form-control" value="{{ $user['firstname'] }} {{ $user['lastname'] }} ({{ $user['email'] }})" readonly>
                                    </div>

                                    <div class="mb-3">
                                        <label for="role_id{{ $user['id'] }}" class="form-label">Rol</label>
                                        <select class="form-select" id="role_id{{ $user['id'] }}" name="role_id" required>
                                            @php
                                                $currentRoleId = 5; // Default to student
                                                if(isset($user['roles']) && count($user['roles']) > 0) {
                                                    foreach($user['roles'] as $role) {
                                                        if($role['shortname'] == 'editingteacher') $currentRoleId = 3;
                                                        elseif($role['shortname'] == 'teacher') $currentRoleId = 4;
                                                        elseif($role['shortname'] == 'manager') $currentRoleId = 1;
                                                    }
                                                }
                                            @endphp
                                            <option value="5" {{ $currentRoleId == 5 ? 'selected' : '' }}>Estudiante</option>
                                            <option value="3" {{ $currentRoleId == 3 ? 'selected' : '' }}>Profesor</option>
                                            <option value="4" {{ $currentRoleId == 4 ? 'selected' : '' }}>Profesor sin permiso de edición</option>
                                            <option value="1" {{ $currentRoleId == 1 ? 'selected' : '' }}>Gestor</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="send_notification{{ $user['id'] }}" name="send_notification">
                                            <label class="form-check-label" for="send_notification{{ $user['id'] }}">
                                                Enviar notificación al usuario
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

                <!-- Unenroll User Modal -->
                <div class="modal fade" id="unenrollUserModal{{ $user['id'] }}" tabindex="-1" aria-labelledby="unenrollUserModalLabel{{ $user['id'] }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="unenrollUserModalLabel{{ $user['id'] }}">Confirmar Desmatriculación</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>¿Está seguro de que desea desmatricular a <strong>{{ $user['firstname'] }} {{ $user['lastname'] }}</strong> del curso?</p>
                                <p class="text-danger">Esta acción eliminará al usuario del curso y perderá acceso a todas las actividades y recursos.</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <form action="{{ route('moodle.admin.enrollments.unenroll') }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="course_id" value="{{ $selectedCourseId }}">
                                    <input type="hidden" name="user_id" value="{{ $user['id'] }}">
                                    <button type="submit" class="btn btn-danger">Desmatricular</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
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

        // Enable enroll button when a user is selected
        $(document).on('change', '.user-select', function() {
            $('#enrollBtn').prop('disabled', false);
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
