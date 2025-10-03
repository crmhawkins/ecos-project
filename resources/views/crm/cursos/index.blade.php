@extends('crm.layouts.clean_app')

@section('titulo', 'Gestión de Cursos')

@section('css')
<!-- CSS específico para tablas -->
<link href="{{ asset('css/cursos-table.css') }}" rel="stylesheet">

<style>
    /* Estilos específicos para la gestión de cursos */
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
    .stat-card.published .icon {
        background: rgba(var(--success-color-rgb, 16, 185, 129), 0.1);
        color: var(--success-color);
    }
    .stat-card.draft .icon {
        background: rgba(var(--warning-color-rgb, 245, 158, 11), 0.1);
        color: var(--warning-color);
    }
    .stat-card.categories .icon {
        background: rgba(var(--info-color-rgb, 6, 182, 212), 0.1);
        color: var(--info-color);
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


    @media (max-width: 768px) {
        .header-gradient {
            flex-direction: column;
            align-items: flex-start;
        }
        .stats-cards {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="header-gradient">
        <h1><i class="fas fa-graduation-cap"></i> Gestión de Cursos</h1>
        <a href="{{ route('cursos.create') }}" class="btn">
            <i class="fas fa-plus-circle"></i> Nuevo Curso
        </a>
    </div>

    <!-- Estadísticas rápidas -->
    <div class="stats-cards">
        <div class="stat-card total">
            <div class="icon">
                <i class="fas fa-book"></i>
            </div>
            <div class="number">{{ $totalCursos ?? 0 }}</div>
            <div class="label">Total Cursos</div>
        </div>
        <div class="stat-card published">
            <div class="icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="number">{{ $cursosPublicados ?? 0 }}</div>
            <div class="label">Publicados</div>
        </div>
        <div class="stat-card draft">
            <div class="icon">
                <i class="fas fa-clock"></i>
            </div>
            <div class="number">{{ $cursosBorrador ?? 0 }}</div>
            <div class="label">Borradores</div>
        </div>
        <div class="stat-card categories">
            <div class="icon">
                <i class="fas fa-tags"></i>
            </div>
            <div class="number">{{ $totalCategorias ?? 0 }}</div>
            <div class="label">Categorías</div>
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
                    <label for="buscar" style="font-size: 0.9rem; font-weight: 600; color: #6b7280; margin: 0;">Buscar Curso</label>
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
                        placeholder="Buscar por nombre de curso..."
                        id="buscar"
                    >
                </div>
                <div class="filter-group" style="display: flex; flex-direction: column; gap: 8px;">
                    <label for="categoria" style="font-size: 0.9rem; font-weight: 600; color: #6b7280; margin: 0;">Categoría</label>
                    <select wire:change="aplicarFiltro()" wire:model="selectedCategoria" style="padding: 12px 16px; border: 1px solid #e5e7eb; border-radius: 8px; font-size: 0.9rem; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); background: white;" id="categoria">
                        <option value="">Todas las categorías</option>
                        @foreach ($categorias as $categoria)
                            <option value="{{$categoria->id}}">{{$categoria->name}}</option>
                        @endforeach
                    </select>
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
            @livewire('cursos-table')
        </div>
    </div>
</div>
@endsection