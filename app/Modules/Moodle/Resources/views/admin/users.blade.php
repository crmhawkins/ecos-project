<?php

namespace App\Modules\Moodle\Resources\views\admin;

?>

@extends('moodle::admin.layout')

@section('title', 'Gestión de Usuarios')
@section('subtitle', 'Administrar usuarios de Moodle')

@section('content')
    <!-- Search and Filter -->
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-search me-2"></i> Buscar Usuarios
        </div>
        <div class="card-body">
            <form action="{{ route('moodle.admin.users') }}" method="GET" class="row g-3">
                <div class="col-md-4">
                    <label for="search" class="form-label">Buscar</label>
                    <input type="text" class="form-control" id="search" name="search" placeholder="Nombre, email o username" value="{{ $search ?? '' }}">
                </div>
                <div class="col-md-3">
                    <label for="role" class="form-label">Rol</label>
                    <select class="form-select" id="role" name="role">
                        <option value="">Todos los roles</option>
                        <option value="student" {{ isset($role) && $role == 'student' ? 'selected' : '' }}>Estudiante</option>
                        <option value="teacher" {{ isset($role) && $role == 'teacher' ? 'selected' : '' }}>Profesor</option>
                        <option value="manager" {{ isset($role) && $role == 'manager' ? 'selected' : '' }}>Gestor</option>
                        <option value="admin" {{ isset($role) && $role == 'admin' ? 'selected' : '' }}>Administrador</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="status" class="form-label">Estado</label>
                    <select class="form-select" id="status" name="status">
                        <option value="">Todos los estados</option>
                        <option value="active" {{ isset($status) && $status == 'active' ? 'selected' : '' }}>Activo</option>
                        <option value="suspended" {{ isset($status) && $status == 'suspended' ? 'selected' : '' }}>Suspendido</option>
                        <option value="deleted" {{ isset($status) && $status == 'deleted' ? 'selected' : '' }}>Eliminado</option>
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

    <!-- Users List -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <i class="fas fa-users me-2"></i> Usuarios
            </div>
            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#createUserModal">
                <i class="fas fa-plus me-2"></i> Nuevo Usuario
            </button>
        </div>
        <div class="card-body">
            @if(isset($users) && count($users) > 0)
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Username</th>
                                <th>Último Acceso</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user['id'] }}</td>
                                    <td>{{ $user['firstname'] }} {{ $user['lastname'] }}</td>
                                    <td>{{ $user['email'] }}</td>
                                    <td>{{ $user['username'] }}</td>
                                    <td>{{ isset($user['lastaccess']) ? date('d/m/Y H:i', $user['lastaccess']) : 'Nunca' }}</td>
                                    <td>
                                        @if(isset($user['suspended']) && $user['suspended'])
                                            <span class="badge bg-warning">Suspendido</span>
                                        @elseif(isset($user['deleted']) && $user['deleted'])
                                            <span class="badge bg-danger">Eliminado</span>
                                        @else
                                            <span class="badge bg-success">Activo</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editUserModal{{ $user['id'] }}">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#viewUserModal{{ $user['id'] }}">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteUserModal{{ $user['id'] }}">
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
                    {{ $users->links() }}
                </div>
            @else
                <p class="text-muted">No se encontraron usuarios.</p>
            @endif
        </div>
    </div>

    <!-- Create User Modal -->
    <div class="modal fade" id="createUserModal" tabindex="-1" aria-labelledby="createUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createUserModalLabel">Crear Nuevo Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('moodle.admin.users.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="firstname" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="firstname" name="firstname" required>
                            </div>
                            <div class="col-md-6">
                                <label for="lastname" class="form-label">Apellidos</label>
                                <input type="text" class="form-control" id="lastname" name="lastname" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="col-md-6">
                                <label for="username" class="form-label">Nombre de usuario</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="password" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="col-md-6">
                                <label for="role" class="form-label">Rol</label>
                                <select class="form-select" id="role" name="role" required>
                                    <option value="student">Estudiante</option>
                                    <option value="teacher">Profesor</option>
                                    <option value="manager">Gestor</option>
                                    <option value="admin">Administrador</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="createaccount" name="createaccount" checked>
                                <label class="form-check-label" for="createaccount">
                                    Crear cuenta en Moodle
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Crear Usuario</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit User Modals -->
    @if(isset($users) && count($users) > 0)
        @foreach($users as $user)
            <div class="modal fade" id="editUserModal{{ $user['id'] }}" tabindex="-1" aria-labelledby="editUserModalLabel{{ $user['id'] }}" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editUserModalLabel{{ $user['id'] }}">Editar Usuario</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('moodle.admin.users.update', $user['id']) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="firstname{{ $user['id'] }}" class="form-label">Nombre</label>
                                        <input type="text" class="form-control" id="firstname{{ $user['id'] }}" name="firstname" value="{{ $user['firstname'] }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="lastname{{ $user['id'] }}" class="form-label">Apellidos</label>
                                        <input type="text" class="form-control" id="lastname{{ $user['id'] }}" name="lastname" value="{{ $user['lastname'] }}" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="email{{ $user['id'] }}" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email{{ $user['id'] }}" name="email" value="{{ $user['email'] }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="username{{ $user['id'] }}" class="form-label">Nombre de usuario</label>
                                        <input type="text" class="form-control" id="username{{ $user['id'] }}" name="username" value="{{ $user['username'] }}" readonly>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="password{{ $user['id'] }}" class="form-label">Nueva Contraseña (dejar en blanco para mantener)</label>
                                        <input type="password" class="form-control" id="password{{ $user['id'] }}" name="password">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="status{{ $user['id'] }}" class="form-label">Estado</label>
                                        <select class="form-select" id="status{{ $user['id'] }}" name="status">
                                            <option value="active" {{ !isset($user['suspended']) || !$user['suspended'] ? 'selected' : '' }}>Activo</option>
                                            <option value="suspended" {{ isset($user['suspended']) && $user['suspended'] ? 'selected' : '' }}>Suspendido</option>
                                        </select>
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

            <!-- View User Modal -->
            <div class="modal fade" id="viewUserModal{{ $user['id'] }}" tabindex="-1" aria-labelledby="viewUserModalLabel{{ $user['id'] }}" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="viewUserModalLabel{{ $user['id'] }}">Detalles del Usuario</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-3 text-center mb-3">
                                    @if(isset($user['profileimageurl']) && !empty($user['profileimageurl']))
                                        <img src="{{ $user['profileimageurl'] }}" alt="Foto de perfil" class="img-fluid rounded-circle" style="max-width: 150px;">
                                    @else
                                        <div class="bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 150px; height: 150px; font-size: 4rem; margin: 0 auto;">
                                            <i class="fas fa-user"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-9">
                                    <h4>{{ $user['firstname'] }} {{ $user['lastname'] }}</h4>
                                    <p class="text-muted">{{ $user['email'] }}</p>
                                    
                                    <div class="row mt-3">
                                        <div class="col-md-6">
                                            <p><strong>ID:</strong> {{ $user['id'] }}</p>
                                            <p><strong>Nombre de usuario:</strong> {{ $user['username'] }}</p>
                                            <p><strong>Idioma:</strong> {{ $user['lang'] ?? 'No especificado' }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p><strong>Estado:</strong> 
                                                @if(isset($user['suspended']) && $user['suspended'])
                                                    <span class="badge bg-warning">Suspendido</span>
                                                @elseif(isset($user['deleted']) && $user['deleted'])
                                                    <span class="badge bg-danger">Eliminado</span>
                                                @else
                                                    <span class="badge bg-success">Activo</span>
                                                @endif
                                            </p>
                                            <p><strong>Último acceso:</strong> {{ isset($user['lastaccess']) ? date('d/m/Y H:i', $user['lastaccess']) : 'Nunca' }}</p>
                                            <p><strong>Fecha de creación:</strong> {{ isset($user['firstaccess']) ? date('d/m/Y', $user['firstaccess']) : 'No disponible' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mt-4">
                                <h5>Cursos Matriculados</h5>
                                <div id="enrolledCourses{{ $user['id'] }}">
                                    <p class="text-center"><i class="fas fa-spinner fa-spin"></i> Cargando cursos...</p>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Delete User Modal -->
            <div class="modal fade" id="deleteUserModal{{ $user['id'] }}" tabindex="-1" aria-labelledby="deleteUserModalLabel{{ $user['id'] }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteUserModalLabel{{ $user['id'] }}">Confirmar Eliminación</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>¿Está seguro de que desea eliminar al usuario <strong>{{ $user['firstname'] }} {{ $user['lastname'] }}</strong>?</p>
                            <p class="text-danger">Esta acción no se puede deshacer.</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <form action="{{ route('moodle.admin.users.destroy', $user['id']) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar Usuario</button>
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
        // Load enrolled courses for each user when viewing details
        @if(isset($users) && count($users) > 0)
            @foreach($users as $user)
                $('#viewUserModal{{ $user['id'] }}').on('shown.bs.modal', function () {
                    $.ajax({
                        url: '{{ route("moodle.admin.users.courses", $user["id"]) }}',
                        type: 'GET',
                        success: function(response) {
                            if (response.success) {
                                let html = '';
                                if (response.courses.length > 0) {
                                    html = '<div class="table-responsive"><table class="table table-striped table-sm">';
                                    html += '<thead><tr><th>ID</th><th>Curso</th><th>Fecha de matriculación</th><th>Progreso</th></tr></thead>';
                                    html += '<tbody>';
                                    
                                    response.courses.forEach(function(course) {
                                        html += '<tr>';
                                        html += '<td>' + course.id + '</td>';
                                        html += '<td>' + course.fullname + '</td>';
                                        html += '<td>' + (course.enrollmentdate ? course.enrollmentdate : 'No disponible') + '</td>';
                                        html += '<td><div class="progress" style="height: 10px;">';
                                        html += '<div class="progress-bar" role="progressbar" style="width: ' + (course.progress ? course.progress : 0) + '%;" aria-valuenow="' + (course.progress ? course.progress : 0) + '" aria-valuemin="0" aria-valuemax="100">' + (course.progress ? course.progress : 0) + '%</div>';
                                        html += '</div></td>';
                                        html += '</tr>';
                                    });
                                    
                                    html += '</tbody></table></div>';
                                } else {
                                    html = '<p class="text-muted">El usuario no está matriculado en ningún curso.</p>';
                                }
                                
                                $('#enrolledCourses{{ $user['id'] }}').html(html);
                            } else {
                                $('#enrolledCourses{{ $user['id'] }}').html('<p class="text-danger">Error al cargar los cursos: ' + response.message + '</p>');
                            }
                        },
                        error: function() {
                            $('#enrolledCourses{{ $user['id'] }}').html('<p class="text-danger">Error al cargar los cursos. Por favor, inténtelo de nuevo.</p>');
                        }
                    });
                });
            @endforeach
        @endif
    });
</script>
@endsection
