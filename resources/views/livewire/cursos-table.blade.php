<div>

    @if ( $servicios )

        <!-- Tabla moderna -->
        <div class="table-card">
            <div class="table-responsive">
                <table class="modern-table">
                    <thead>
                        <tr>
                            @foreach ([
                                'name' => 'NOMBRE',
                                'categoria_nombre' => 'CATEGORÍA',
                                'price' => 'PRECIO',
                                'inactive' => 'VISIBLE',
                                'published' => 'PUBLICADO',
                            ] as $field => $label)
                                <th>
                                    <a href="#" wire:click.prevent="sortBy('{{ $field }}')" class="sort-link">
                                        {{ $label }}
                                        @if ($sortColumn == $field)
                                            <i class="fas fa-sort-{{ $sortDirection == 'asc' ? 'up' : 'down' }}"></i>
                                        @else
                                            <i class="fas fa-sort"></i>
                                        @endif
                                    </a>
                                </th>
                            @endforeach
                            <th>IMAGEN</th>
                            <th class="text-center">ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($servicios as $servicio)
                            <tr class="table-row">
                                <td class="course-name">
                                    <div class="course-info">
                                        <strong>{{ $servicio->name }}</strong>
                                        @if($servicio->description)
                                            <small class="course-description">{{ Str::limit($servicio->description, 100) }}</small>
                                        @endif
                                    </div>
                                </td>
                                <td class="category-cell">
                                    <span class="category-badge">{{ $servicio->categoria_nombre ?? 'Sin categoría' }}</span>
                                </td>
                                <td class="price-cell">
                                    <span class="price">{{ number_format($servicio->price, 2, ',', '.') }} €</span>
                                </td>
                                <td class="status-cell">
                                    <span class="status-badge status-{{ $servicio->inactive ? 'inactive' : 'active' }}">
                                        <i class="fas fa-{{ $servicio->inactive ? 'eye-slash' : 'eye' }}"></i>
                                        {{ $servicio->inactive ? 'No' : 'Sí' }}
                                    </span>
                                </td>
                                <td class="published-cell">
                                    <span class="status-badge status-{{ $servicio->published ? 'published' : 'draft' }}">
                                        <i class="fas fa-{{ $servicio->published ? 'check-circle' : 'clock' }}"></i>
                                        {{ $servicio->published ? 'Sí' : 'No' }}
                                    </span>
                                </td>
                                <td class="image-cell">
                                    <div class="image-placeholder">
                                        @if($servicio->image)
                                            <img src="{{ asset('storage/' . $servicio->image) }}" alt="Imagen del curso" class="course-image">
                                        @else
                                            <i class="fas fa-image"></i>
                                        @endif
                                    </div>
                                </td>
                                <td class="actions-cell">
                                    <div class="action-buttons">
                                        <a href="{{ route('cursos.show', $servicio->id) }}" class="btn-action btn-view" title="Ver detalles">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('cursos.edit', $servicio->id) }}" class="btn-action btn-edit" title="Editar curso">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button @click="courseToDelete = {{ $servicio->id }}; showDeleteModal = true" class="btn-action btn-delete" title="Eliminar curso">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Paginación moderna -->
        <div class="pagination-card">
            <div class="pagination-info">
                <span>Mostrando {{ $servicios->firstItem() ?? 0 }} a {{ $servicios->lastItem() ?? 0 }} de {{ $servicios->total() }} resultados</span>
            </div>
            <div class="pagination-links">
                {{ $servicios->links('vendor.pagination.bootstrap-5') }}
            </div>
        </div>

    @else
        <div class="empty-state">
            <div class="empty-icon">
                <i class="fas fa-graduation-cap"></i>
            </div>
            <h3>No hay cursos disponibles</h3>
            <p>No se encontraron cursos que coincidan con los filtros aplicados.</p>
            <a href="{{ route('cursos.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Crear Primer Curso
            </a>
        </div>
    @endif

    <!-- Modal de confirmación de eliminación -->
    <div x-data="{ showDeleteModal: false, courseToDelete: null }" x-show="showDeleteModal" class="modal-overlay" style="display: none;">
        <div class="modal-content">
            <div class="modal-header">
                <h3><i class="fas fa-exclamation-triangle"></i> Confirmar Eliminación</h3>
                <button @click="showDeleteModal = false" class="modal-close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <p>¿Estás seguro de que deseas eliminar este curso?</p>
                <p><strong>Esta acción no se puede deshacer.</strong></p>
            </div>
            <div class="modal-actions">
                <button @click="showDeleteModal = false" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Cancelar
                </button>
                <button x-show="courseToDelete" wire:click="delete(courseToDelete)" @click="showDeleteModal = false" class="btn btn-danger">
                    <i class="fas fa-trash"></i> Eliminar
                </button>
            </div>
        </div>
    </div>
</div>