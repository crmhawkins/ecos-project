<?php

namespace App\Modules\Moodle\Resources\views\admin;

?>

@extends('moodle::admin.layout')

@section('title', 'Categorías de Cursos')
@section('subtitle', 'Administrar categorías de Moodle')

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <!-- Botón para crear categoría -->
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div><i class="fas fa-folder-open me-2"></i> Categorías</div>
            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#createCategoryModal">
                <i class="fas fa-plus me-2"></i> Nueva Categoría
            </button>
        </div>
        <div class="card-body">
            @if(count($categories) > 0)
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Padre</th>
                                <th>Descripción</th>
                                <th>Visibilidad</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{ $category['id'] }}</td>
                                    <td>{{ $category['name'] }}</td>
                                    <td>
                                        @php
                                            $parentName = collect($categories)->firstWhere('id', $category['parent'])['name'] ?? 'Ninguna';
                                        @endphp
                                        {{ $category['parent'] > 0 ? $parentName : 'Ninguna' }}
                                    </td>
                                    <td>{{ $category['description'] ?? '-' }}</td>
                                    <td>
                                        <span class="badge bg-{{ $category['visible'] ? 'success' : 'secondary' }}">
                                            {{ $category['visible'] ? 'Visible' : 'Oculta' }}
                                        </span>
                                    </td>
                                    <td>
                                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editCategoryModal{{ $category['id'] }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteCategoryModal{{ $category['id'] }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>

                                <!-- Modal de edición -->
                                <div class="modal fade" id="editCategoryModal{{ $category['id'] }}" tabindex="-1" aria-labelledby="editCategoryModalLabel{{ $category['id'] }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <form action="{{ route('moodle.admin.categories.update', $category['id']) }}" method="POST" class="modal-content">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editCategoryModalLabel{{ $category['id'] }}">Editar Categoría</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label class="form-label">Nombre</label>
                                                    <input type="text" name="name" class="form-control" value="{{ $category['name'] }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Categoría Padre</label>
                                                    <select name="parent" class="form-select">
                                                        <option value="">Ninguna</option>
                                                        @foreach($categories as $cat)
                                                            <option value="{{ $cat['id'] }}" {{ $category['parent'] == $cat['id'] ? 'selected' : '' }}>
                                                                {{ $cat['name'] }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Descripción</label>
                                                    <textarea name="description" class="form-control" rows="2">{{ $category['description'] }}</textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Visibilidad</label>
                                                    <select name="visible" class="form-select">
                                                        <option value="1" {{ $category['visible'] ? 'selected' : '' }}>Sí</option>
                                                        <option value="0" {{ !$category['visible'] ? 'selected' : '' }}>No</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-muted">No se encontraron categorías.</p>
            @endif
        </div>
    </div>

    <!-- Modal de creación -->
    <div class="modal fade" id="createCategoryModal" tabindex="-1" aria-labelledby="createCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('moodle.admin.categories.store') }}" method="POST" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="createCategoryModalLabel">Nueva Categoría</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Categoría Padre</label>
                        <select name="parent" class="form-select">
                            <option value="">Ninguna</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat['id'] }}">{{ $cat['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Descripción</label>
                        <textarea name="description" class="form-control" rows="2"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Visibilidad</label>
                        <select name="visible" class="form-select">
                            <option value="1" selected>Sí</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Crear Categoría</button>
                </div>
            </form>
        </div>
    </div>
        <!-- Modal de eliminación -->
    <div class="modal fade" id="deleteCategoryModal{{ $category['id'] }}" tabindex="-1" aria-labelledby="deleteCategoryModalLabel{{ $category['id'] }}" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('moodle.admin.categories.destroy', $category['id']) }}" method="POST" class="modal-content">
                @csrf
                @method('DELETE')
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteCategoryModalLabel{{ $category['id'] }}">Eliminar Categoría</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <p>¿Estás seguro de que deseas eliminar la categoría <strong>{{ $category['name'] }}</strong>?</p>
                    <p class="text-danger">Esta acción es irreversible y podría eliminar también cursos y subcategorías si existen.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </div>
            </form>
        </div>
    </div>
@endsection
