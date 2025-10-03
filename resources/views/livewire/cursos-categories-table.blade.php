<div>
    <style>
        /* Estilos para filtros y tabla */
        .filters-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            border: 1px solid #e5e7eb;
            margin-bottom: 24px;
            overflow: hidden;
        }
        .filters-header {
            background: #f8fafc;
            padding: 18px 24px;
            border-bottom: 1px solid #e5e7eb;
        }
        .filters-header h3 {
            margin: 0;
            font-size: 1.1rem;
            font-weight: 600;
            color: #111827;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .filters-form {
            padding: 24px;
        }
        .filters-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr auto;
            gap: 20px;
            align-items: end;
        }
        .filter-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }
        .filter-group label {
            font-size: 0.9rem;
            font-weight: 600;
            color: #6b7280;
            margin: 0;
        }
        .filter-group input,
        .filter-group select {
            padding: 12px 16px;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            font-size: 0.9rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            background: white;
        }
        .filter-group input:focus,
        .filter-group select:focus {
            outline: none;
            border-color: #D93690;
            box-shadow: 0 0 0 3px rgba(217, 54, 144, 0.1);
        }
        .filter-actions {
            display: flex;
            gap: 12px;
            align-items: end;
        }
        .btn-filter {
            padding: 12px 20px;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: none;
            cursor: pointer;
            font-size: 0.9rem;
        }
        .btn-filter-primary {
            background: #D93690;
            color: white;
        }
        .btn-filter-primary:hover {
            background: #c2185b;
            color: white;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(217, 54, 144, 0.3);
        }
        .btn-filter-secondary {
            background: #6b7280;
            color: white;
        }
        .btn-filter-secondary:hover {
            background: #4b5563;
            color: white;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(107, 114, 128, 0.3);
        }
        
        /* Estilos para tabla - Igual que cursos */
        .table-container {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            border: 1px solid #e5e7eb;
            overflow: hidden;
        }
        .table-header {
            background: #f8fafc;
            padding: 20px 24px;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 16px;
        }
        .table-title {
            font-size: 1.2rem;
            font-weight: 700;
            color: #111827;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .table-actions {
            display: flex;
            gap: 12px;
            align-items: center;
        }
        .btn-new {
            background: #D93690;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }
        .btn-new:hover {
            background: #c2185b;
            color: white;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(217, 54, 144, 0.3);
        }
        .categories-table {
            width: 100%;
            border-collapse: collapse;
            margin: 0;
        }
        .categories-table th {
            background: #f8fafc;
            color: #374151;
            font-weight: 600;
            padding: 16px 20px;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            position: relative;
        }
        .categories-table th .sort-icon {
            margin-left: 8px;
            opacity: 0.5;
            font-size: 0.8rem;
        }
        .categories-table td {
            padding: 16px 20px;
            border-bottom: 1px solid #f3f4f6;
            color: #374151;
            vertical-align: middle;
        }
        .categories-table tr:hover {
            background: #f9fafb;
        }
        .category-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .category-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1.1rem;
            color: white;
        }
        .category-details h4 {
            margin: 0;
            font-size: 1rem;
            font-weight: 600;
            color: #111827;
        }
        .category-details p {
            margin: 4px 0 0 0;
            font-size: 0.85rem;
            color: #6b7280;
        }
        .badge-modern {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .badge-modern-success {
            background: rgba(16, 185, 129, 0.1);
            color: #10b981;
        }
        .badge-modern-danger {
            background: rgba(239, 68, 68, 0.1);
            color: #ef4444;
        }
        .badge-modern-warning {
            background: rgba(245, 158, 11, 0.1);
            color: #f59e0b;
        }
        .badge-modern-info {
            background: rgba(59, 130, 246, 0.1);
            color: #3b82f6;
        }
        .badge-modern-primary {
            background: rgba(217, 54, 144, 0.1);
            color: #D93690;
        }
        .action-buttons {
            display: flex;
            gap: 8px;
            align-items: center;
        }
        .btn-action {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            font-size: 0.9rem;
        }
        .btn-action-primary {
            background: rgba(59, 130, 246, 0.1);
            color: #3b82f6;
        }
        .btn-action-primary:hover {
            background: #3b82f6;
            color: white;
            transform: translateY(-1px);
        }
        .btn-action-secondary {
            background: rgba(16, 185, 129, 0.1);
            color: #10b981;
        }
        .btn-action-secondary:hover {
            background: #10b981;
            color: white;
            transform: translateY(-1px);
        }
        .btn-action-danger {
            background: rgba(239, 68, 68, 0.1);
            color: #ef4444;
        }
        .btn-action-danger:hover {
            background: #ef4444;
            color: white;
            transform: translateY(-1px);
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
        
        /* Responsive */
        @media (max-width: 768px) {
            .filters-grid {
                grid-template-columns: 1fr;
            }
            .filter-actions {
                flex-direction: column;
            }
            .categories-table thead {
                display: none;
            }
            .categories-table, .categories-table tbody, .categories-table tr, .categories-table td {
                display: block;
                width: 100%;
            }
            .categories-table tr {
                margin-bottom: 1rem;
                border: 1px solid #e5e7eb;
                border-radius: 12px;
                overflow: hidden;
            }
            .categories-table td {
                border-bottom: 1px solid #e5e7eb;
                text-align: right;
                position: relative;
                padding-left: 50%;
            }
            .categories-table td::before {
                content: attr(data-label);
                position: absolute;
                left: 15px;
                width: calc(50% - 30px);
                text-align: left;
                font-weight: 600;
                color: #6b7280;
                font-size: 0.85rem;
            }
            .categories-table td:last-child {
                border-bottom: none;
            }
        }
    </style>
    
    <!-- Filtros modernos -->
    <div class="filters-card">
        <div class="filters-header">
            <h3><i class="fas fa-filter"></i> Filtros Avanzados</h3>
        </div>
        <form method="GET" class="filters-form">
            <div class="filters-grid">
                <div class="filter-group">
                    <label for="buscar">Buscar Categoría</label>
                    <input 
                        wire:model="buscar"
                        x-data="{ enterPresionado: false }"
                        @keydown.enter="
                            enterPresionado = true;
                            $wire.aplicarFiltro();
                        "
                        @blur="
                            if (!enterPresionado) $wire.aplicarFiltro();
                            enterPresionado = false;
                        "
                        type="text" 
                        placeholder="Buscar por nombre..."
                        id="buscar"
                    >
                </div>
                <div class="filter-group">
                    <label for="perPage">Por Página</label>
                    <select wire:change="aplicarFiltro()" wire:model="perPage" id="perPage">
                        <option value="10">10 por página</option>
                        <option value="25">25 por página</option>
                        <option value="50">50 por página</option>
                        <option value="all">Todos</option>
                    </select>
                </div>
                <div class="filter-actions">
                    <button type="button" wire:click="aplicarFiltro" class="btn-filter btn-filter-primary">
                        <i class="fas fa-search"></i> Filtrar
                    </button>
                    <button type="button" wire:click="limpiarFiltros" class="btn-filter btn-filter-secondary">
                        <i class="fas fa-times"></i> Limpiar
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Tabla moderna -->
    <div class="table-container">
        <div class="table-header">
            <h3 class="table-title">
                <i class="fas fa-list"></i> Categorías de Cursos
            </h3>
            <div class="table-actions">
                <a href="{{ route('cursosCategoria.create') }}" class="btn-table btn-table-primary">
                    <i class="fas fa-plus"></i> Nueva Categoría
                </a>
            </div>
        </div>
        
        <div class="table-responsive">
            <table class="categories-table">
                <thead>
                    <tr>
                        <th>
                            NOMBRE
                            <i class="fas fa-sort sort-icon"></i>
                        </th>
                        <th>
                            SLUG
                            <i class="fas fa-sort sort-icon"></i>
                        </th>
                        <th>
                            ESTADO
                            <i class="fas fa-sort sort-icon"></i>
                        </th>
                        <th>
                            CREADO
                            <i class="fas fa-sort sort-icon"></i>
                        </th>
                        <th>
                            ACCIONES
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categorias as $categoria)
                        <tr>
                            <td>
                                <div class="category-info">
                                    <div class="category-icon" style="background: linear-gradient(135deg, #D93690 0%, #8B5CF6 100%);">
                                        {{ strtoupper(substr($categoria->name, 0, 1)) }}
                                    </div>
                                    <div class="category-details">
                                        <h4>{{ $categoria->name }}</h4>
                                        @if($categoria->description)
                                            <p>{{ Str::limit($categoria->description, 50) }}</p>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td>
                                <code style="background: #f1f5f9; padding: 4px 8px; border-radius: 4px; font-size: 0.8rem; color: #475569;">{{ $categoria->slug ?? 'N/A' }}</code>
                            </td>
                            <td>
                                @if($categoria->inactive)
                                    <span class="badge-modern badge-modern-danger">
                                        <i class="fas fa-times-circle"></i> Inactiva
                                    </span>
                                @else
                                    <span class="badge-modern badge-modern-success">
                                        <i class="fas fa-check-circle"></i> Activa
                                    </span>
                                @endif
                            </td>
                            <td>
                                <div style="font-size: 0.8rem; color: #6b7280;">
                                    {{ $categoria->created_at ? $categoria->created_at->format('d/m/Y') : 'N/A' }}
                                </div>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('cursosCategoria.show', $categoria->id) }}" class="btn-action btn-action-primary" title="Ver detalles">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('cursosCategoria.edit', $categoria->id) }}" class="btn-action btn-action-secondary" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button 
                                        wire:click="confirmarEliminacion({{ $categoria->id }})" 
                                        class="btn-action btn-action-danger" 
                                        title="Eliminar"
                                        x-data="{ categoryToDelete: null }"
                                        @click="categoryToDelete = {{ $categoria->id }}; showDeleteModal = true"
                                    >
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align: center; padding: 40px; color: #6b7280;">
                                <div style="display: flex; flex-direction: column; align-items: center; gap: 16px;">
                                    <i class="fas fa-folder-open" style="font-size: 3rem; opacity: 0.5;"></i>
                                    <div>
                                        <h4 style="margin-bottom: 8px; color: #111827;">No hay categorías</h4>
                                        <p style="margin: 0;">No se encontraron categorías de cursos.</p>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Paginación moderna - EXACTAMENTE igual que cursos -->
    <div class="pagination-card">
        <div class="pagination-info">
            <span>Mostrando {{ $categorias->firstItem() ?? 0 }} a {{ $categorias->lastItem() ?? 0 }} de {{ $categorias->total() }} resultados</span>
        </div>
        <div class="pagination-links">
            {{ $categorias->links('vendor.pagination.bootstrap-5') }}
        </div>
    </div>

    <!-- Modal de confirmación de eliminación -->
    <div x-data="{ showDeleteModal: false, categoryToDelete: null }" x-show="showDeleteModal" style="display: none;">
        <div style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); z-index: 9999; display: flex; align-items: center; justify-content: center;">
            <div style="background: white; border-radius: 16px; padding: 32px; max-width: 500px; width: 90%; box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);">
                <div style="text-align: center; margin-bottom: 24px;">
                    <div style="width: 80px; height: 80px; background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px; font-size: 2rem; color: #dc2626;">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <h3 style="margin: 0 0 8px 0; color: #111827; font-size: 1.3rem;">¿Eliminar Categoría?</h3>
                    <p style="margin: 0; color: #6b7280;">Esta acción no se puede deshacer. Se eliminará permanentemente la categoría y todos sus datos asociados.</p>
                </div>
                <div style="display: flex; gap: 12px; justify-content: center;">
                    <button @click="showDeleteModal = false" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Cancelar
                    </button>
                    <button x-show="categoryToDelete" wire:click="delete(categoryToDelete)" @click="showDeleteModal = false" class="btn btn-danger">
                        <i class="fas fa-trash"></i> Eliminar
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>