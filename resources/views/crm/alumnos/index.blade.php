@extends('crm.layouts.clean_app')

@section('titulo', 'Gestión de Alumnos')

@section('css')
<style>
    /* Estilos específicos para la gestión de alumnos */
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
    .stat-card.sync .icon {
        background: rgba(var(--success-color-rgb, 16, 185, 129), 0.1);
        color: var(--success-color);
    }
    .stat-card.unsync .icon {
        background: rgba(var(--warning-color-rgb, 245, 158, 11), 0.1);
        color: var(--warning-color);
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
    .alumnos-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 10px;
    }
    .alumnos-table th {
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
    .alumnos-table td {
        background-color: white;
        padding: 15px 18px;
        border-bottom: 1px solid var(--border-color);
        font-size: 0.9rem;
        color: var(--text-primary);
        vertical-align: middle;
    }
    .alumnos-table tbody tr {
        transition: var(--transition);
    }
    .alumnos-table tbody tr:hover {
        background-color: #fdf2f8;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        transform: translateY(-2px);
    }
    .alumnos-table tbody tr:first-child td {
        border-top-left-radius: 12px;
        border-top-right-radius: 12px;
    }
    .alumnos-table tbody tr:last-child td {
        border-bottom-left-radius: 12px;
        border-bottom-right-radius: 12px;
        border-bottom: none;
    }

    .avatar-col {
        width: 80px;
    }
    .student-avatar {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid var(--border-color);
    }
    .avatar-initials {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background-color: var(--secondary-color);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        font-weight: 600;
    }
    .student-info {
        min-width: 200px;
    }
    .student-name {
        font-weight: 600;
        color: var(--primary-color);
        margin-bottom: 3px;
        display: block;
    }
    .student-email {
        font-size: 0.8rem;
        color: var(--text-secondary);
        display: block;
    }
    .sync-status .badge {
        padding: 5px 10px;
        border-radius: 5px;
        font-size: 0.75rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 5px;
        width: fit-content;
    }
    .status-synced {
        background-color: var(--success-color);
        color: white;
    }
    .status-unsynced {
        background-color: var(--warning-color);
        color: white;
    }
    .student-actions .btn {
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
    .btn-sync {
        background-color: var(--success-color);
        color: white;
    }
    .btn-sync:hover {
        background-color: #059669;
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
        .alumnos-table thead {
            display: none;
        }
        .alumnos-table, .alumnos-table tbody, .alumnos-table tr, .alumnos-table td {
            display: block;
            width: 100%;
        }
        .alumnos-table tr {
            margin-bottom: 1rem;
            border: 1px solid var(--border-color);
            border-radius: 12px;
            overflow: hidden;
        }
        .alumnos-table td {
            border-bottom: 1px solid var(--border-color);
            text-align: right;
            position: relative;
            padding-left: 50%;
        }
        .alumnos-table td::before {
            content: attr(data-label);
            position: absolute;
            left: 15px;
            width: calc(50% - 30px);
            text-align: left;
            font-weight: 600;
            color: var(--text-secondary);
            font-size: 0.85rem;
        }
        .alumnos-table td:last-child {
            border-bottom: none;
        }
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="header-gradient">
        <h1><i class="fas fa-user-graduate"></i> Gestión de Alumnos</h1>
        <a href="{{ route('crm.alumnos.create') }}" class="btn">
            <i class="fas fa-plus-circle"></i> Nuevo Alumno
        </a>
    </div>

    <!-- Estadísticas rápidas -->
    <div class="stats-cards">
        <div class="stat-card total">
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
            <div class="number">{{ $totalAlumnos }}</div>
            <div class="label">Total Alumnos</div>
        </div>
        <div class="stat-card sync">
            <div class="icon">
                <i class="fas fa-sync-alt"></i>
            </div>
            <div class="number">{{ $alumnosSincronizados }}</div>
            <div class="label">Sincronizados</div>
        </div>
        <div class="stat-card unsync">
            <div class="icon">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            <div class="number">{{ $alumnosNoSincronizados }}</div>
            <div class="label">No Sincronizados</div>
        </div>
    </div>

    <!-- Filtros -->
    <div class="filters-card">
        <form action="{{ route('crm.alumnos.index') }}" method="GET">
            <div class="filters-grid">
                <div class="form-group">
                    <label for="search">Buscar</label>
                    <input type="text" name="search" id="search" class="form-control" 
                           placeholder="Nombre, email, teléfono..." value="{{ request('search') }}">
                </div>
                <div class="form-group">
                    <label for="sync_status">Estado de Sincronización</label>
                    <select name="sync_status" id="sync_status" class="form-control">
                        <option value="">Todos los estados</option>
                        <option value="synced" {{ request('sync_status') == 'synced' ? 'selected' : '' }}>Sincronizados</option>
                        <option value="unsynced" {{ request('sync_status') == 'unsynced' ? 'selected' : '' }}>No Sincronizados</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="date_from">Fecha Desde</label>
                    <input type="date" name="date_from" id="date_from" class="form-control" value="{{ request('date_from') }}">
                </div>
                <div class="filter-buttons">
                    <button type="submit" class="btn btn-filter"><i class="fas fa-filter"></i> Filtrar</button>
                    <a href="{{ route('crm.alumnos.index') }}" class="btn btn-clear"><i class="fas fa-times"></i> Limpiar</a>
                </div>
            </div>
        </form>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    @if($alumnos->isEmpty())
        <div class="empty-state">
            <i class="fas fa-user-graduate"></i>
            <h4>No hay alumnos registrados</h4>
            <p>Parece que aún no tienes alumnos registrados en el sistema. ¡Comienza añadiendo el primer alumno!</p>
            <a href="{{ route('crm.alumnos.create') }}" class="btn btn-primary">
                <i class="fas fa-plus-circle"></i> Crear Primer Alumno
            </a>
        </div>
    @else
        <div class="card">
            <div class="card-body" style="padding: 0;">
                <div class="table-responsive">
                    <table class="alumnos-table">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Alumno</th>
                                <th>Teléfono</th>
                                <th>Estado Moodle</th>
                                <th>Fecha Registro</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($alumnos as $alumno)
                                <tr>
                                    <td data-label="Avatar" class="avatar-col">
                                        @if($alumno->avatar)
                                            <img src="{{ asset('storage/' . $alumno->avatar) }}" 
                                                 alt="{{ $alumno->name }}" class="student-avatar">
                                        @else
                                            <div class="avatar-initials">
                                                {{ strtoupper(substr($alumno->name, 0, 1)) }}{{ strtoupper(substr($alumno->surname ?? '', 0, 1)) }}
                                            </div>
                                        @endif
                                    </td>
                                    <td data-label="Alumno" class="student-info">
                                        <span class="student-name">{{ $alumno->name }} {{ $alumno->surname }}</span>
                                        <span class="student-email">{{ $alumno->email }}</span>
                                    </td>
                                    <td data-label="Teléfono">{{ $alumno->phone ?? 'No especificado' }}</td>
                                    <td data-label="Estado Moodle" class="sync-status">
                                        @if($alumno->moodle_id)
                                            <span class="badge status-synced">
                                                <i class="fas fa-check-circle"></i> Sincronizado
                                            </span>
                                        @else
                                            <span class="badge status-unsynced">
                                                <i class="fas fa-exclamation-triangle"></i> No Sincronizado
                                            </span>
                                        @endif
                                    </td>
                                    <td data-label="Fecha Registro">{{ $alumno->created_at->format('d/m/Y') }}</td>
                                    <td data-label="Acciones" class="student-actions">
                                        <a href="{{ route('crm.alumnos.show', $alumno->id) }}" 
                                           class="btn btn-view" title="Ver Alumno">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('crm.alumnos.edit', $alumno->id) }}" 
                                           class="btn btn-edit" title="Editar Alumno">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        @if(!$alumno->moodle_id)
                                            <form action="{{ route('crm.alumnos.sync', $alumno->id) }}" 
                                                  method="POST" style="display:inline-block;">
                                                @csrf
                                                <button type="submit" class="btn btn-sync" 
                                                        title="Sincronizar con Moodle">
                                                    <i class="fas fa-sync-alt"></i>
                                                </button>
                                            </form>
                                        @endif
                                        <form action="{{ route('crm.alumnos.destroy', $alumno->id) }}" 
                                              method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-delete" 
                                                    title="Eliminar Alumno"
                                                    onclick="return confirm('¿Estás seguro de que quieres eliminar este alumno?');">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Paginación -->
        @if($alumnos->hasPages())
            <div class="pagination-container" style="display: flex; justify-content: center; margin-top: 2rem;">
                {{ $alumnos->links('pagination::bootstrap-5') }}
            </div>
        @endif
    @endif
</div>
@endsection