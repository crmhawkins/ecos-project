@extends('crm.layouts.clean_app')

@section('titulo', 'Categorías de Cursos')

@section('css')
<style>
    /* Estilos específicos para la gestión de categorías */
    .header-gradient {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        color: white;
        padding: 2rem;
        border-radius: 16px;
        margin-bottom: 2rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
    }
    .header-gradient h1 {
        margin: 0;
        font-size: 2rem;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .header-gradient .btn {
        background: white;
        color: var(--primary-color);
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-weight: 600;
        transition: var(--transition);
        display: flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
    }
    .header-gradient .btn:hover {
        background: #f0f0f0;
        color: var(--primary-color);
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }

    .stats-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }
    .stat-card {
        background: white;
        border-radius: 16px;
        padding: 1.5rem;
        box-shadow: var(--shadow);
        border: 1px solid var(--border-color);
        transition: var(--transition);
    }
    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 30px rgba(0,0,0,0.12);
    }
    .stat-card .icon {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        margin-bottom: 1rem;
    }
    .stat-card.total .icon {
        background: rgba(var(--primary-color-rgb, 217, 54, 144), 0.1);
        color: var(--primary-color);
    }
    .stat-card.courses .icon {
        background: rgba(var(--info-color-rgb, 6, 182, 212), 0.1);
        color: var(--info-color);
    }
    .stat-card.active .icon {
        background: rgba(var(--success-color-rgb, 16, 185, 129), 0.1);
        color: var(--success-color);
    }
    .stat-card .number {
        font-size: 2rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 0.5rem;
    }
    .stat-card .label {
        color: var(--text-secondary);
        font-size: 0.9rem;
        font-weight: 500;
    }

    .filters-card {
        background: white;
        border-radius: 16px;
        box-shadow: var(--shadow);
        padding: 1.5rem;
        margin-bottom: 2rem;
        border: 1px solid var(--border-color);
    }
    .filters-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1rem;
        align-items: flex-end;
    }
    .form-group {
        margin-bottom: 0;
    }
    .form-group label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 600;
        color: var(--text-primary);
        font-size: 0.9rem;
    }
    .form-control {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 1px solid var(--border-color);
        border-radius: 8px;
        font-size: 0.9rem;
        color: var(--text-primary);
        background-color: white;
        transition: var(--transition);
    }
    .form-control:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(var(--primary-color-rgb, 217, 54, 144), 0.1);
        outline: none;
    }
    .filter-buttons {
        display: flex;
        gap: 0.75rem;
    }
    .filter-buttons .btn {
        padding: 0.75rem 1.25rem;
        font-size: 0.9rem;
        border-radius: 8px;
        font-weight: 600;
        transition: var(--transition);
    }
    .btn-filter {
        background-color: var(--primary-color);
        color: white;
    }
    .btn-filter:hover {
        background-color: #c2185b;
        color: white;
    }
    .btn-clear {
        background-color: var(--text-secondary);
        color: white;
    }
    .btn-clear:hover {
        background-color: #4b5563;
        color: white;
    }

    .table-responsive {
        overflow-x: auto;
    }
    .categories-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 10px;
    }
    .categories-table th {
        background-color: var(--bg-light);
        color: var(--text-secondary);
        font-weight: 600;
        padding: 12px 18px;
        text-align: left;
        border-bottom: 1px solid var(--border-color);
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .categories-table td {
        background-color: white;
        padding: 15px 18px;
        border-bottom: 1px solid var(--border-color);
        font-size: 0.9rem;
        color: var(--text-primary);
        vertical-align: middle;
    }
    .categories-table tbody tr {
        transition: var(--transition);
    }
    .categories-table tbody tr:hover {
        background-color: #fdf2f8;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        transform: translateY(-2px);
    }
    .categories-table tbody tr:first-child td {
        border-top-left-radius: 12px;
        border-top-right-radius: 12px;
    }
    .categories-table tbody tr:last-child td {
        border-bottom-left-radius: 12px;
        border-bottom-right-radius: 12px;
        border-bottom: none;
    }

    .category-icon {
        width: 40px;
        height: 40px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        color: white;
        margin-right: 15px;
    }
    .category-info {
        min-width: 200px;
    }
    .category-name {
        font-weight: 600;
        color: var(--primary-color);
        margin-bottom: 5px;
        display: block;
    }
    .category-description {
        font-size: 0.8rem;
        color: var(--text-secondary);
        display: block;
    }
    .courses-count {
        display: flex;
        align-items: center;
        gap: 8px;
        color: var(--text-primary);
        font-weight: 600;
    }
    .courses-count i {
        color: var(--info-color);
    }
    .category-actions .btn {
        padding: 6px 10px;
        font-size: 0.8rem;
        border-radius: 6px;
        margin-right: 5px;
    }
    .btn-view {
        background-color: var(--info-color);
        color: white;
    }
    .btn-view:hover {
        background-color: #0a93b0;
        color: white;
    }
    .btn-edit {
        background-color: var(--warning-color);
        color: white;
    }
    .btn-edit:hover {
        background-color: #d48a00;
        color: white;
    }
    .btn-delete {
        background-color: var(--danger-color);
        color: white;
    }
    .btn-delete:hover {
        background-color: #c0392b;
        color: white;
    }

    .empty-state {
        text-align: center;
        padding: 3rem 1rem;
        background: white;
        border-radius: 16px;
        box-shadow: var(--shadow);
        border: 1px solid var(--border-color);
    }
    .empty-state i {
        font-size: 3rem;
        color: var(--text-muted);
        margin-bottom: 1rem;
    }
    .empty-state h4 {
        color: var(--text-primary);
        font-weight: 600;
        margin-bottom: 0.5rem;
    }
    .empty-state p {
        color: var(--text-secondary);
        font-size: 0.95rem;
        margin-bottom: 1.5rem;
    }

    @media (max-width: 768px) {
        .header-gradient {
            flex-direction: column;
            align-items: flex-start;
        }
        .stats-cards {
            grid-template-columns: 1fr;
        }
        .filters-grid {
            grid-template-columns: 1fr;
        }
        .filter-buttons {
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
            border: 1px solid var(--border-color);
            border-radius: 12px;
            overflow: hidden;
        }
        .categories-table td {
            border-bottom: 1px solid var(--border-color);
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
            color: var(--text-secondary);
            font-size: 0.85rem;
        }
        .categories-table td:last-child {
            border-bottom: none;
        }
    }
    
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="header-gradient">
        <h1><i class="fas fa-tags"></i> Categorías de Cursos</h1>
        <a href="{{ route('cursosCategoria.create') }}" class="btn">
            <i class="fas fa-plus-circle"></i> Nueva Categoría
        </a>
    </div>

    <!-- Estadísticas rápidas -->
    <div class="stats-cards">
        <div class="stat-card total">
            <div class="icon">
                <i class="fas fa-tags"></i>
            </div>
            <div class="number">{{ $totalCategorias ?? 0 }}</div>
            <div class="label">Total Categorías</div>
        </div>
        <div class="stat-card courses">
            <div class="icon">
                <i class="fas fa-book"></i>
            </div>
            <div class="number">{{ $totalCursos ?? 0 }}</div>
            <div class="label">Cursos Asociados</div>
        </div>
        <div class="stat-card active">
            <div class="icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="number">{{ $categoriasActivas ?? 0 }}</div>
            <div class="label">Categorías Activas</div>
        </div>
    </div>


    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    <!-- Integración del componente Livewire existente -->
    <div class="card">
        <div class="card-body" style="padding: 0;">
            @livewire('cursos-categories-table')
        </div>
    </div>

</div>
@endsection