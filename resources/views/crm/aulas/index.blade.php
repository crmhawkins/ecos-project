@extends('crm.layouts.clean_app')

@section('titulo', 'Gestión de Aulas')

@section('css')
<style>
    /* Estilos específicos para la gestión de aulas */
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
    .stat-card.available .icon {
        background: rgba(var(--success-color-rgb, 16, 185, 129), 0.1);
        color: var(--success-color);
    }
    .stat-card.occupied .icon {
        background: rgba(var(--warning-color-rgb, 245, 158, 11), 0.1);
        color: var(--warning-color);
    }
    .stat-card.maintenance .icon {
        background: rgba(var(--danger-color-rgb, 239, 68, 68), 0.1);
        color: var(--danger-color);
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
    .aulas-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 10px;
    }
    .aulas-table th {
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
    .aulas-table td {
        background-color: white;
        padding: 15px 18px;
        border-bottom: 1px solid var(--border-color);
        font-size: 0.9rem;
        color: var(--text-primary);
        vertical-align: middle;
    }
    .aulas-table tbody tr {
        transition: var(--transition);
    }
    .aulas-table tbody tr:hover {
        background-color: #fdf2f8;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        transform: translateY(-2px);
    }
    .aulas-table tbody tr:first-child td {
        border-top-left-radius: 12px;
        border-top-right-radius: 12px;
    }
    .aulas-table tbody tr:last-child td {
        border-bottom-left-radius: 12px;
        border-bottom-right-radius: 12px;
        border-bottom: none;
    }

    .aula-info {
        min-width: 200px;
    }
    .aula-name {
        font-weight: 600;
        color: var(--primary-color);
        margin-bottom: 5px;
        display: block;
    }
    .aula-description {
        font-size: 0.8rem;
        color: var(--text-secondary);
        display: block;
    }
    .aula-capacity {
        display: flex;
        align-items: center;
        gap: 8px;
        color: var(--text-primary);
        font-weight: 600;
    }
    .aula-capacity i {
        color: var(--info-color);
    }
    .aula-status .badge {
        padding: 5px 10px;
        border-radius: 5px;
        font-size: 0.75rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 5px;
        width: fit-content;
    }
    .status-available {
        background-color: var(--success-color);
        color: white;
    }
    .status-occupied {
        background-color: var(--warning-color);
        color: white;
    }
    .status-maintenance {
        background-color: var(--danger-color);
        color: white;
    }
    .aula-equipment {
        display: flex;
        flex-wrap: wrap;
        gap: 5px;
    }
    .equipment-tag {
        background: rgba(var(--info-color-rgb, 6, 182, 212), 0.1);
        color: var(--info-color);
        padding: 3px 8px;
        border-radius: 12px;
        font-size: 0.7rem;
        font-weight: 500;
    }
    .aula-actions .btn {
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
        .aulas-table thead {
            display: none;
        }
        .aulas-table, .aulas-table tbody, .aulas-table tr, .aulas-table td {
            display: block;
            width: 100%;
        }
        .aulas-table tr {
            margin-bottom: 1rem;
            border: 1px solid var(--border-color);
            border-radius: 12px;
            overflow: hidden;
        }
        .aulas-table td {
            border-bottom: 1px solid var(--border-color);
            text-align: right;
            position: relative;
            padding-left: 50%;
        }
        .aulas-table td::before {
            content: attr(data-label);
            position: absolute;
            left: 15px;
            width: calc(50% - 30px);
            text-align: left;
            font-weight: 600;
            color: var(--text-secondary);
            font-size: 0.85rem;
        }
        .aulas-table td:last-child {
            border-bottom: none;
        }
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="header-gradient">
        <h1><i class="fas fa-chalkboard"></i> Gestión de Aulas</h1>
        <a href="{{ route('aulas.create') }}" class="btn">
            <i class="fas fa-plus-circle"></i> Nueva Aula
        </a>
    </div>

    <!-- Estadísticas rápidas -->
    <div class="stats-cards">
        <div class="stat-card total">
            <div class="icon">
                <i class="fas fa-door-open"></i>
            </div>
            <div class="number">{{ $totalAulas ?? 0 }}</div>
            <div class="label">Total Aulas</div>
        </div>
        <div class="stat-card available">
            <div class="icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="number">{{ $aulasDisponibles ?? 0 }}</div>
            <div class="label">Disponibles</div>
        </div>
        <div class="stat-card occupied">
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
            <div class="number">{{ $aulasOcupadas ?? 0 }}</div>
            <div class="label">Ocupadas</div>
        </div>
        <div class="stat-card maintenance">
            <div class="icon">
                <i class="fas fa-tools"></i>
            </div>
            <div class="number">{{ $aulasMantenimiento ?? 0 }}</div>
            <div class="label">Mantenimiento</div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    <!-- Filtros fuera del contenedor de la tabla -->
    <div class="filters-card" style="background: white; border-radius: 16px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); border: 1px solid #e5e7eb; margin-bottom: 24px; overflow: hidden;">
        <div class="filters-header" style="background: #f8fafc; padding: 18px 24px; border-bottom: 1px solid #e5e7eb;">
            <h3 style="margin: 0; font-size: 1.1rem; font-weight: 600; color: #111827; display: flex; align-items: center; gap: 8px;">
                <i class="fas fa-filter"></i> Filtros Avanzados
            </h3>
        </div>
        <form method="GET" class="filters-form" style="padding: 24px;">
            <div class="filters-grid" style="display: grid; grid-template-columns: 2fr 1fr 1fr auto; gap: 20px; align-items: end;">
                <div class="filter-group" style="display: flex; flex-direction: column; gap: 8px;">
                    <label for="buscar" style="font-size: 0.9rem; font-weight: 600; color: #6b7280; margin: 0;">Buscar Aula</label>
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
                        style="padding: 12px 16px; border: 1px solid #e5e7eb; border-radius: 8px; font-size: 0.9rem; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); background: white;"
                        placeholder="Buscar por nombre..."
                        id="buscar"
                    >
                </div>
                <div class="filter-group" style="display: flex; flex-direction: column; gap: 8px;">
                    <label for="perPage" style="font-size: 0.9rem; font-weight: 600; color: #6b7280; margin: 0;">Por Página</label>
                    <select wire:change="aplicarFiltro()" wire:model="perPage" style="padding: 12px 16px; border: 1px solid #e5e7eb; border-radius: 8px; font-size: 0.9rem; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); background: white;" id="perPage">
                        <option value="10">10 por página</option>
                        <option value="25">25 por página</option>
                        <option value="50">50 por página</option>
                        <option value="all">Todos</option>
                    </select>
                </div>
                <div class="filter-actions" style="display: flex; gap: 12px; align-items: end;">
                    <button type="button" wire:click="aplicarFiltro" style="padding: 12px 20px; border-radius: 8px; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); border: none; cursor: pointer; font-size: 0.9rem; background: #D93690; color: white;">
                        <i class="fas fa-search"></i> Filtrar
                    </button>
                    <button type="button" wire:click="limpiarFiltros" style="padding: 12px 20px; border-radius: 8px; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); border: none; cursor: pointer; font-size: 0.9rem; background: #6b7280; color: white;">
                        <i class="fas fa-times"></i> Limpiar
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Tabla sin filtros -->
    <div class="card" style="background: white; border-radius: 16px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); border: 1px solid #e5e7eb; overflow: hidden; margin-bottom: 24px;">
        <div class="card-body" style="padding: 0;">
            @livewire('aulas-table')
        </div>
    </div>
</div>
@endsection