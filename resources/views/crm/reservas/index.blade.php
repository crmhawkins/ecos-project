@extends('crm.layouts.clean_app')

@section('titulo', 'Gestión de Reservas')

@section('css')
<style>
    /* Estilos específicos para la gestión de reservas */
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
    .stat-card.confirmed .icon {
        background: rgba(var(--success-color-rgb, 16, 185, 129), 0.1);
        color: var(--success-color);
    }
    .stat-card.pending .icon {
        background: rgba(var(--warning-color-rgb, 245, 158, 11), 0.1);
        color: var(--warning-color);
    }
    .stat-card.cancelled .icon {
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
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="header-gradient">
        <h1><i class="fas fa-calendar-alt"></i> Gestión de Reservas</h1>
        <a href="{{ route('reservas.create') }}" class="btn">
            <i class="fas fa-plus-circle"></i> Nueva Reserva
        </a>
    </div>

    <!-- Estadísticas rápidas -->
    <div class="stats-cards">
        <div class="stat-card total">
            <div class="icon">
                <i class="fas fa-calendar-check"></i>
            </div>
            <div class="number">{{ $totalReservas ?? 0 }}</div>
            <div class="label">Total Reservas</div>
        </div>
        <div class="stat-card confirmed">
            <div class="icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="number">{{ $reservasConfirmadas ?? 0 }}</div>
            <div class="label">Confirmadas</div>
        </div>
        <div class="stat-card pending">
            <div class="icon">
                <i class="fas fa-clock"></i>
            </div>
            <div class="number">{{ $reservasPendientes ?? 0 }}</div>
            <div class="label">Pendientes</div>
        </div>
        <div class="stat-card cancelled">
            <div class="icon">
                <i class="fas fa-times-circle"></i>
            </div>
            <div class="number">{{ $reservasCanceladas ?? 0 }}</div>
            <div class="label">Canceladas</div>
        </div>
    </div>

    <!-- Filtros -->
    <div class="filters-card">
        <form action="{{ route('reservas.index') }}" method="GET">
            <div class="filters-grid">
                <div class="form-group">
                    <label for="search">Buscar</label>
                    <input type="text" name="search" id="search" class="form-control" 
                           placeholder="Título, aula, usuario..." value="{{ request('search') }}">
                </div>
                <div class="form-group">
                    <label for="estado">Estado</label>
                    <select name="estado" id="estado" class="form-control">
                        <option value="">Todos los estados</option>
                        <option value="confirmada" {{ request('estado') == 'confirmada' ? 'selected' : '' }}>Confirmada</option>
                        <option value="pendiente" {{ request('estado') == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                        <option value="cancelada" {{ request('estado') == 'cancelada' ? 'selected' : '' }}>Cancelada</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="aula_id">Aula</label>
                    <select name="aula_id" id="aula_id" class="form-control">
                        <option value="">Todas las aulas</option>
                        @if(isset($aulas))
                            @foreach($aulas as $aula)
                                <option value="{{ $aula->id }}" {{ request('aula_id') == $aula->id ? 'selected' : '' }}>
                                    {{ $aula->nombre }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="form-group">
                    <label for="fecha_desde">Fecha Desde</label>
                    <input type="date" name="fecha_desde" id="fecha_desde" class="form-control" 
                           value="{{ request('fecha_desde') }}">
                </div>
                <div class="filter-buttons">
                    <button type="submit" class="btn btn-filter"><i class="fas fa-filter"></i> Filtrar</button>
                    <a href="{{ route('reservas.index') }}" class="btn btn-clear"><i class="fas fa-times"></i> Limpiar</a>
                </div>
            </div>
        </form>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    <!-- Integración del componente Livewire existente -->
    <div class="card">
        <div class="card-body" style="padding: 0;">
            @livewire('reservas-table')
        </div>
    </div>

    <!-- Paginación fuera del contenedor de la tabla -->
    <div class="pagination-card" style="background: white; border-radius: 16px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); border: 1px solid #e5e7eb; padding: 20px 24px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px; margin-top: 24px;">
        <div class="pagination-info" style="color: #6b7280; font-size: 0.9rem;">
            <span>Mostrando {{ $servicios->firstItem() ?? 0 }} a {{ $servicios->lastItem() ?? 0 }} de {{ $servicios->total() }} resultados</span>
        </div>
        <div class="pagination-links" style="display: flex; gap: 8px;">
            {{ $servicios->links('vendor.pagination.bootstrap-5') }}
        </div>
    </div>
</div>
@endsection
