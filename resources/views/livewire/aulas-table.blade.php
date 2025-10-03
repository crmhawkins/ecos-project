<div>

<style>
    /* Estilos para aulas-table */
    .table-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        border: 1px solid #e5e7eb;
        overflow: hidden;
        margin-bottom: 24px;
    }
    
    .table-responsive {
        overflow-x: auto;
    }
    
    .modern-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.9rem;
    }
    
    .modern-table thead {
        background: #f8fafc;
    }
    
    .modern-table th {
        padding: 16px 20px;
        text-align: left;
        font-weight: 600;
        color: #374151;
        border-bottom: 1px solid #e5e7eb;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    
    .modern-table td {
        padding: 16px 20px;
        border-bottom: 1px solid #f3f4f6;
        vertical-align: middle;
    }
    
    .modern-table tbody tr:hover {
        background: #f9fafb;
    }
    
    .course-info strong {
        color: #111827;
        font-weight: 600;
        font-size: 0.95rem;
    }
    
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 500;
    }
    
    .status-active {
        background: rgba(16, 185, 129, 0.1);
        color: #059669;
    }
    
    .status-inactive {
        background: rgba(239, 68, 68, 0.1);
        color: #dc2626;
    }
    
    .action-buttons {
        display: flex;
        gap: 8px;
        justify-content: center;
    }
    
    .btn-action {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 0.8rem;
    }
    
    .btn-edit {
        background: rgba(59, 130, 246, 0.1);
        color: #3b82f6;
    }
    
    .btn-edit:hover {
        background: #3b82f6;
        color: white;
        transform: translateY(-1px);
    }
    
    .btn-delete {
        background: rgba(239, 68, 68, 0.1);
        color: #ef4444;
    }
    
    .btn-delete:hover {
        background: #ef4444;
        color: white;
        transform: translateY(-1px);
    }
    
    .empty-state {
        text-align: center;
        padding: 60px 20px;
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        border: 1px solid #e5e7eb;
    }
    
    .empty-icon {
        font-size: 4rem;
        color: #9ca3af;
        margin-bottom: 20px;
    }
    
    .empty-state h3 {
        color: #374151;
        font-size: 1.2rem;
        font-weight: 600;
        margin-bottom: 8px;
    }
    
    .empty-state p {
        color: #6b7280;
        font-size: 0.9rem;
    }
    
    /* Paginación - CORREGIDA Y EN ESPAÑOL */
    .pagination-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        border: 1px solid #e5e7eb;
        padding: 20px 24px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 16px;
        margin-top: 24px;
    }
    
    .pagination-info {
        color: #6b7280;
        font-size: 0.9rem;
        font-weight: 500;
    }
    
    .pagination-links {
        display: flex;
        gap: 8px;
        align-items: center;
    }
    
    .pagination-links .pagination {
        margin: 0 !important;
        display: flex !important;
        gap: 4px !important;
        align-items: center !important;
        list-style: none !important;
        padding: 0 !important;
    }
    
    .pagination-links .pagination .page-item {
        margin: 0 !important;
        display: inline-flex !important;
        align-items: center !important;
    }
    
    .pagination-links .pagination .page-link {
        padding: 10px 14px !important;
        border: 1px solid #e5e7eb !important;
        border-radius: 8px !important;
        color: #6b7280 !important;
        text-decoration: none !important;
        transition: all 0.3s ease !important;
        background: white !important;
        font-size: 0.9rem !important;
        font-weight: 500 !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        min-width: 40px !important;
        height: 40px !important;
        margin: 0 !important;
    }
    
    .pagination-links .pagination .page-link:hover {
        background: #D93690 !important;
        color: white !important;
        border-color: #D93690 !important;
        transform: translateY(-1px) !important;
        box-shadow: 0 4px 12px rgba(217, 54, 144, 0.3) !important;
    }
    
    .pagination-links .pagination .page-item.active .page-link {
        background: #D93690 !important;
        color: white !important;
        border-color: #D93690 !important;
        font-weight: 600 !important;
    }
    
    .pagination-links .pagination .page-item.disabled .page-link {
        background: #f9fafb !important;
        color: #9ca3af !important;
        border-color: #e5e7eb !important;
        cursor: not-allowed !important;
        opacity: 0.5 !important;
    }
    
    .pagination-links .pagination .page-item.disabled .page-link:hover {
        background: #f9fafb !important;
        color: #9ca3af !important;
        border-color: #e5e7eb !important;
        transform: none !important;
        box-shadow: none !important;
    }
    
    /* Modal styles */
    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 9999;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .modal-content {
        background: white;
        border-radius: 16px;
        padding: 32px;
        max-width: 500px;
        width: 90%;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
    }
    
    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }
    
    .modal-header h3 {
        margin: 0;
        color: #111827;
        font-size: 1.2rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .modal-close {
        background: none;
        border: none;
        font-size: 1.2rem;
        color: #6b7280;
        cursor: pointer;
        padding: 4px;
        border-radius: 4px;
        transition: all 0.3s ease;
    }
    
    .modal-close:hover {
        background: #f3f4f6;
        color: #374151;
    }
    
    .modal-body p {
        margin: 0 0 12px 0;
        color: #374151;
        line-height: 1.5;
    }
    
    .modal-actions {
        display: flex;
        gap: 12px;
        justify-content: flex-end;
        margin-top: 24px;
    }
    
    .btn {
        padding: 10px 20px;
        border-radius: 8px;
        border: none;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.9rem;
    }
    
    .btn-secondary {
        background: #f3f4f6;
        color: #374151;
    }
    
    .btn-secondary:hover {
        background: #e5e7eb;
    }
    
    .btn-danger {
        background: #ef4444;
        color: white;
    }
    
    .btn-danger:hover {
        background: #dc2626;
        transform: translateY(-1px);
    }
</style>

    @if ( $servicios )

        <!-- Tabla moderna -->
        <div class="table-card">
            <div class="table-responsive">
                <table class="modern-table">
                    <thead>
                        <tr>
                            @foreach ([
                                'name' => 'NOMBRE',
                                'inactive' => 'ESTADO',
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
                            <th class="text-center">ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($servicios as $aula)
                            <tr class="table-row">
                                <td class="course-cell">
                                    <div class="course-info">
                                        <strong>{{ $aula->name }}</strong>
                                    </div>
                                </td>
                                <td class="status-cell">
                                    <span class="status-badge {{ $aula->inactive ? 'status-inactive' : 'status-active' }}">
                                        <i class="fas fa-{{ $aula->inactive ? 'times-circle' : 'check-circle' }}"></i>
                                        {{ $aula->inactive ? 'Inactiva' : 'Activa' }}
                                    </span>
                                </td>
                                <td class="actions-cell">
                                    <div class="action-buttons">
                                        <a href="{{ route('aulas.edit', $aula->id) }}" class="btn-action btn-edit" title="Editar aula">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button @click="aulaToDelete = {{ $aula->id }}; showDeleteModal = true" class="btn-action btn-delete" title="Eliminar aula">
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
                <i class="fas fa-door-open"></i>
            </div>
            <h3>No hay aulas disponibles</h3>
            <p>No se encontraron aulas que coincidan con los filtros aplicados.</p>
            <a href="{{ route('aulas.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Crear Primera Aula
            </a>
        </div>
    @endif

    <!-- Modal de confirmación de eliminación -->
    <div x-data="{ showDeleteModal: false, aulaToDelete: null }" x-show="showDeleteModal" class="modal-overlay" style="display: none;">
        <div class="modal-content">
            <div class="modal-header">
                <h3><i class="fas fa-exclamation-triangle"></i> Confirmar Eliminación</h3>
                <button @click="showDeleteModal = false" class="modal-close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <p>¿Estás seguro de que deseas eliminar esta aula?</p>
                <p><strong>Esta acción no se puede deshacer.</strong></p>
            </div>
            <div class="modal-actions">
                <button @click="showDeleteModal = false" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Cancelar
                </button>
                <button x-show="aulaToDelete" wire:click="delete(aulaToDelete)" @click="showDeleteModal = false" class="btn btn-danger">
                    <i class="fas fa-trash"></i> Eliminar
                </button>
            </div>
        </div>
    </div>
</div>