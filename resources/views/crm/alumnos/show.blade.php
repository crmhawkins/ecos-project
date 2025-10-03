@extends('crm.layouts.clean_app')

@section('titulo', 'Detalle del Alumno')

@section('css')
<style>
    .profile-header {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        color: white;
        padding: 2rem;
        border-radius: 16px;
        margin-bottom: 2rem;
        position: relative;
        overflow: hidden;
    }
    .profile-header::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 200px;
        height: 200px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        transform: translate(50px, -50px);
    }
    .profile-header-content {
        position: relative;
        z-index: 2;
        display: flex;
        align-items: center;
        gap: 2rem;
        flex-wrap: wrap;
    }
    .profile-avatar {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid white;
        box-shadow: 0 8px 30px rgba(0,0,0,0.2);
    }
    .avatar-placeholder {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
        font-weight: 700;
        color: white;
        border: 4px solid white;
        box-shadow: 0 8px 30px rgba(0,0,0,0.2);
    }
    .profile-info h1 {
        margin: 0 0 10px 0;
        font-size: 2.5rem;
        font-weight: 700;
    }
    .profile-info .subtitle {
        font-size: 1.2rem;
        opacity: 0.9;
        margin-bottom: 15px;
    }
    .profile-actions {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }
    .profile-actions .btn {
        background: white;
        color: var(--primary-color);
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 600;
        transition: var(--transition);
        display: flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
    }
    .profile-actions .btn:hover {
        background: #f0f0f0;
        color: var(--primary-color);
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    .profile-actions .btn-sync {
        background: var(--success-color);
        color: white;
    }
    .profile-actions .btn-sync:hover {
        background: #059669;
        color: white;
    }

    .content-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 2rem;
        margin-bottom: 2rem;
    }
    .info-card {
        background: white;
        border-radius: 16px;
        box-shadow: var(--shadow);
        border: 1px solid var(--border-color);
        overflow: hidden;
    }
    .info-card-header {
        background: var(--bg-light);
        padding: 20px 24px;
        border-bottom: 1px solid var(--border-color);
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .info-card-header h3 {
        margin: 0;
        font-size: 1.3rem;
        font-weight: 600;
        color: var(--text-primary);
    }
    .info-card-header i {
        color: var(--primary-color);
        font-size: 1.2rem;
    }
    .info-card-body {
        padding: 24px;
    }
    .info-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 0;
        border-bottom: 1px solid var(--border-color);
    }
    .info-row:last-child {
        border-bottom: none;
    }
    .info-label {
        font-weight: 600;
        color: var(--text-secondary);
        font-size: 0.9rem;
    }
    .info-value {
        color: var(--text-primary);
        font-weight: 500;
    }
    .info-value.empty {
        color: var(--text-secondary);
        font-style: italic;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 12px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.85rem;
    }
    .status-synced {
        background: rgba(var(--success-color-rgb, 16, 185, 129), 0.1);
        color: var(--success-color);
        border: 1px solid rgba(var(--success-color-rgb, 16, 185, 129), 0.2);
    }
    .status-unsynced {
        background: rgba(var(--warning-color-rgb, 245, 158, 11), 0.1);
        color: var(--warning-color);
        border: 1px solid rgba(var(--warning-color-rgb, 245, 158, 11), 0.2);
    }

    .stats-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
        margin-bottom: 20px;
    }
    .stat-item {
        text-align: center;
        padding: 20px;
        background: var(--bg-light);
        border-radius: 12px;
        border: 1px solid var(--border-color);
    }
    .stat-number {
        font-size: 2rem;
        font-weight: 700;
        color: var(--primary-color);
        margin-bottom: 5px;
    }
    .stat-label {
        color: var(--text-secondary);
        font-size: 0.9rem;
        font-weight: 500;
    }

    .activity-item {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 15px 0;
        border-bottom: 1px solid var(--border-color);
    }
    .activity-item:last-child {
        border-bottom: none;
    }
    .activity-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
        color: white;
    }
    .activity-icon.created {
        background: var(--success-color);
    }
    .activity-icon.updated {
        background: var(--info-color);
    }
    .activity-icon.synced {
        background: var(--primary-color);
    }
    .activity-content h4 {
        margin: 0 0 5px 0;
        font-size: 0.95rem;
        font-weight: 600;
        color: var(--text-primary);
    }
    .activity-content p {
        margin: 0;
        font-size: 0.85rem;
        color: var(--text-secondary);
    }

    .courses-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 16px;
    }
    .course-card {
        background: white;
        border: 1px solid var(--border-color);
        border-radius: 12px;
        overflow: hidden;
        transition: var(--transition);
    }
    .course-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 30px rgba(0,0,0,0.12);
    }
    .course-image {
        width: 100%;
        height: 120px;
        object-fit: cover;
        background: var(--bg-light);
    }
    .course-content {
        padding: 15px;
    }
    .course-title {
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 8px;
        font-size: 0.95rem;
    }
    .course-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 0.8rem;
        color: var(--text-secondary);
    }

    @media (max-width: 992px) {
        .content-grid {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }
        .profile-header-content {
            flex-direction: column;
            text-align: center;
            gap: 1.5rem;
        }
        .profile-info h1 {
            font-size: 2rem;
        }
        .stats-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px) {
        .profile-header {
            padding: 1.5rem;
        }
        .profile-avatar, .avatar-placeholder {
            width: 100px;
            height: 100px;
        }
        .profile-info h1 {
            font-size: 1.8rem;
        }
        .profile-actions {
            justify-content: center;
            width: 100%;
        }
        .info-row {
            flex-direction: column;
            align-items: flex-start;
            gap: 5px;
        }
        .courses-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    <!-- Header del Perfil -->
    <div class="profile-header">
        <div class="profile-header-content">
            <div>
                @if($alumno->avatar)
                    <img src="{{ asset('storage/' . $alumno->avatar) }}" alt="{{ $alumno->name }}" class="profile-avatar">
                @else
                    <div class="avatar-placeholder">
                        {{ strtoupper(substr($alumno->name, 0, 1)) }}{{ strtoupper(substr($alumno->surname ?? '', 0, 1)) }}
                    </div>
                @endif
            </div>
            <div class="profile-info">
                <h1>{{ $alumno->name }} {{ $alumno->surname }}</h1>
                <div class="subtitle">{{ $alumno->email }}</div>
                <div class="profile-actions">
                    <a href="{{ route('crm.alumnos.edit', $alumno->id) }}" class="btn">
                        <i class="fas fa-edit"></i> Editar Perfil
                    </a>
                    @if(!$alumno->moodle_id)
                        <form action="{{ route('crm.alumnos.sync', $alumno->id) }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-sync">
                                <i class="fas fa-sync-alt"></i> Sincronizar con Moodle
                            </button>
                        </form>
                    @endif
                    <a href="{{ route('crm.alumnos.index') }}" class="btn">
                        <i class="fas fa-arrow-left"></i> Volver al Listado
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Contenido Principal -->
    <div class="content-grid">
        <!-- Información Personal -->
        <div class="info-card">
            <div class="info-card-header">
                <i class="fas fa-user"></i>
                <h3>Información Personal</h3>
            </div>
            <div class="info-card-body">
                <div class="info-row">
                    <span class="info-label">Nombre Completo</span>
                    <span class="info-value">{{ $alumno->name }} {{ $alumno->surname }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Email</span>
                    <span class="info-value">{{ $alumno->email }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Teléfono</span>
                    <span class="info-value {{ !$alumno->phone ? 'empty' : '' }}">
                        {{ $alumno->phone ?? 'No especificado' }}
                    </span>
                </div>
                <div class="info-row">
                    <span class="info-label">Nombre de Usuario</span>
                    <span class="info-value {{ !$alumno->username ? 'empty' : '' }}">
                        {{ $alumno->username ?? 'No especificado' }}
                    </span>
                </div>
                <div class="info-row">
                    <span class="info-label">Fecha de Registro</span>
                    <span class="info-value">{{ $alumno->created_at->format('d/m/Y H:i') }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Última Actualización</span>
                    <span class="info-value">{{ $alumno->updated_at->format('d/m/Y H:i') }}</span>
                </div>
            </div>
        </div>

        <!-- Panel Lateral -->
        <div>
            <!-- Estado de Sincronización -->
            <div class="info-card" style="margin-bottom: 1.5rem;">
                <div class="info-card-header">
                    <i class="fas fa-sync-alt"></i>
                    <h3>Estado Moodle</h3>
                </div>
                <div class="info-card-body">
                    @if($alumno->moodle_id)
                        <div style="text-align: center;">
                            <span class="status-badge status-synced">
                                <i class="fas fa-check-circle"></i> Sincronizado
                            </span>
                            <div style="margin-top: 15px;">
                                <div class="info-row">
                                    <span class="info-label">ID Moodle</span>
                                    <span class="info-value">{{ $alumno->moodle_id }}</span>
                                </div>
                            </div>
                        </div>
                    @else
                        <div style="text-align: center;">
                            <span class="status-badge status-unsynced">
                                <i class="fas fa-exclamation-triangle"></i> No Sincronizado
                            </span>
                            <p style="margin: 15px 0; color: var(--text-secondary); font-size: 0.9rem;">
                                Este alumno aún no ha sido sincronizado con Moodle.
                            </p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Estadísticas Rápidas -->
            <div class="info-card" style="margin-bottom: 1.5rem;">
                <div class="info-card-header">
                    <i class="fas fa-chart-bar"></i>
                    <h3>Estadísticas</h3>
                </div>
                <div class="info-card-body">
                    <div class="stats-grid">
                        <div class="stat-item">
                            <div class="stat-number">{{ $alumno->cursos->count() }}</div>
                            <div class="stat-label">Cursos</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">{{ $alumno->created_at->diffInDays(now()) }}</div>
                            <div class="stat-label">Días Registrado</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actividad Reciente -->
            <div class="info-card">
                <div class="info-card-header">
                    <i class="fas fa-history"></i>
                    <h3>Actividad Reciente</h3>
                </div>
                <div class="info-card-body">
                    <div class="activity-item">
                        <div class="activity-icon created">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <div class="activity-content">
                            <h4>Cuenta Creada</h4>
                            <p>{{ $alumno->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>
                    @if($alumno->updated_at != $alumno->created_at)
                        <div class="activity-item">
                            <div class="activity-icon updated">
                                <i class="fas fa-edit"></i>
                            </div>
                            <div class="activity-content">
                                <h4>Perfil Actualizado</h4>
                                <p>{{ $alumno->updated_at->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>
                    @endif
                    @if($alumno->moodle_id)
                        <div class="activity-item">
                            <div class="activity-icon synced">
                                <i class="fas fa-sync-alt"></i>
                            </div>
                            <div class="activity-content">
                                <h4>Sincronizado con Moodle</h4>
                                <p>ID: {{ $alumno->moodle_id }}</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Cursos del Alumno -->
    @if($alumno->cursos && $alumno->cursos->count() > 0)
        <div class="info-card">
            <div class="info-card-header">
                <i class="fas fa-graduation-cap"></i>
                <h3>Cursos Inscritos ({{ $alumno->cursos->count() }})</h3>
            </div>
            <div class="info-card-body">
                <div class="courses-grid">
                    @foreach($alumno->cursos as $curso)
                        <div class="course-card">
                            @if($curso->imagen)
                                <img src="{{ asset('storage/' . $curso->imagen) }}" alt="{{ $curso->titulo }}" class="course-image">
                            @else
                                <div class="course-image" style="display: flex; align-items: center; justify-content: center; background: var(--bg-light);">
                                    <i class="fas fa-book" style="font-size: 2rem; color: var(--text-secondary);"></i>
                                </div>
                            @endif
                            <div class="course-content">
                                <div class="course-title">{{ $curso->titulo }}</div>
                                <div class="course-meta">
                                    <span><i class="fas fa-calendar-alt"></i> {{ $curso->created_at->format('d/m/Y') }}</span>
                                    @if($curso->published)
                                        <span style="color: var(--success-color);"><i class="fas fa-check-circle"></i> Publicado</span>
                                    @else
                                        <span style="color: var(--warning-color);"><i class="fas fa-clock"></i> Borrador</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @else
        <div class="info-card">
            <div class="info-card-header">
                <i class="fas fa-graduation-cap"></i>
                <h3>Cursos Inscritos</h3>
            </div>
            <div class="info-card-body" style="text-align: center; padding: 3rem 1rem;">
                <i class="fas fa-book-open" style="font-size: 3rem; color: var(--text-secondary); margin-bottom: 1rem;"></i>
                <h4 style="color: var(--text-primary); margin-bottom: 0.5rem;">Sin Cursos Inscritos</h4>
                <p style="color: var(--text-secondary); margin: 0;">Este alumno aún no está inscrito en ningún curso.</p>
            </div>
        </div>
    @endif
</div>
@endsection
