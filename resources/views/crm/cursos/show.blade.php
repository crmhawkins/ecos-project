@extends('crm.layouts.clean_app')

@section('titulo', 'Detalle del Curso')

@section('css')
<style>
    .course-header {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        color: white;
        padding: 2rem;
        border-radius: 16px;
        margin-bottom: 2rem;
        position: relative;
        overflow: hidden;
    }
    .course-header::before {
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
    .course-header-content {
        position: relative;
        z-index: 2;
        display: flex;
        align-items: center;
        gap: 2rem;
        flex-wrap: wrap;
    }
    .course-image {
        width: 200px;
        height: 150px;
        border-radius: 12px;
        object-fit: cover;
        border: 4px solid white;
        box-shadow: 0 8px 30px rgba(0,0,0,0.2);
    }
    .course-image-placeholder {
        width: 200px;
        height: 150px;
        border-radius: 12px;
        background: rgba(255, 255, 255, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
        color: white;
        border: 4px solid white;
        box-shadow: 0 8px 30px rgba(0,0,0,0.2);
    }
    .course-info h1 {
        margin: 0 0 10px 0;
        font-size: 2.5rem;
        font-weight: 700;
    }
    .course-info .subtitle {
        font-size: 1.2rem;
        opacity: 0.9;
        margin-bottom: 15px;
    }
    .course-actions {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }
    .course-actions .btn {
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
    .course-actions .btn:hover {
        background: #f0f0f0;
        color: var(--primary-color);
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
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
    .status-published {
        background: rgba(var(--success-color-rgb, 16, 185, 129), 0.1);
        color: var(--success-color);
        border: 1px solid rgba(var(--success-color-rgb, 16, 185, 129), 0.2);
    }
    .status-draft {
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

    .price-display {
        font-size: 2rem;
        font-weight: 700;
        color: var(--primary-color);
        text-align: center;
        padding: 20px;
        background: var(--bg-light);
        border-radius: 12px;
        border: 1px solid var(--border-color);
        margin-bottom: 20px;
    }
    .price-display .currency {
        font-size: 1.2rem;
        vertical-align: top;
    }
    .price-display .free {
        color: var(--success-color);
    }

    .description-content {
        line-height: 1.6;
        color: var(--text-primary);
        font-size: 1rem;
    }
    .description-content p {
        margin-bottom: 1rem;
    }
    .description-content:empty::before {
        content: "Sin descripción disponible";
        color: var(--text-secondary);
        font-style: italic;
    }

    .students-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 16px;
    }
    .student-card {
        background: white;
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 15px;
        text-align: center;
        transition: var(--transition);
    }
    .student-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 30px rgba(0,0,0,0.12);
    }
    .student-avatar {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid var(--border-color);
        margin-bottom: 10px;
    }
    .student-avatar-placeholder {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: var(--secondary-color);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        font-weight: 600;
        margin: 0 auto 10px;
        border: 2px solid var(--border-color);
    }
    .student-name {
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 5px;
        font-size: 0.9rem;
    }
    .student-email {
        color: var(--text-secondary);
        font-size: 0.8rem;
    }

    @media (max-width: 992px) {
        .content-grid {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }
        .course-header-content {
            flex-direction: column;
            text-align: center;
            gap: 1.5rem;
        }
        .course-info h1 {
            font-size: 2rem;
        }
        .stats-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px) {
        .course-header {
            padding: 1.5rem;
        }
        .course-image, .course-image-placeholder {
            width: 150px;
            height: 100px;
        }
        .course-info h1 {
            font-size: 1.8rem;
        }
        .course-actions {
            justify-content: center;
            width: 100%;
        }
        .info-row {
            flex-direction: column;
            align-items: flex-start;
            gap: 5px;
        }
        .students-grid {
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
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

    <!-- Header del Curso -->
    <div class="course-header">
        <div class="course-header-content">
            <div>
                @if($curso->imagen)
                    <img src="{{ asset('storage/' . $curso->imagen) }}" alt="{{ $curso->titulo }}" class="course-image">
                @else
                    <div class="course-image-placeholder">
                        <i class="fas fa-book"></i>
                    </div>
                @endif
            </div>
            <div class="course-info">
                <h1>{{ $curso->titulo }}</h1>
                <div class="subtitle">{{ $curso->categoria->nombre ?? 'Sin categoría' }}</div>
                <div class="course-actions">
                    <a href="{{ route('cursos.edit', $curso->id) }}" class="btn">
                        <i class="fas fa-edit"></i> Editar Curso
                    </a>
                    <a href="{{ route('cursos.index') }}" class="btn">
                        <i class="fas fa-arrow-left"></i> Volver al Listado
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Contenido Principal -->
    <div class="content-grid">
        <!-- Información del Curso -->
        <div>
            <div class="info-card" style="margin-bottom: 1.5rem;">
                <div class="info-card-header">
                    <i class="fas fa-info-circle"></i>
                    <h3>Información del Curso</h3>
                </div>
                <div class="info-card-body">
                    <div class="info-row">
                        <span class="info-label">Título</span>
                        <span class="info-value">{{ $curso->titulo }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Categoría</span>
                        <span class="info-value">{{ $curso->categoria->nombre ?? 'Sin categoría' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Nivel</span>
                        <span class="info-value {{ !$curso->nivel ? 'empty' : '' }}">
                            {{ $curso->nivel ?? 'No especificado' }}
                        </span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Duración</span>
                        <span class="info-value {{ !$curso->duracion ? 'empty' : '' }}">
                            {{ $curso->duracion ? $curso->duracion . ' horas' : 'No especificada' }}
                        </span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Fecha de Inicio</span>
                        <span class="info-value {{ !$curso->fecha_inicio ? 'empty' : '' }}">
                            {{ $curso->fecha_inicio ? $curso->fecha_inicio->format('d/m/Y') : 'No especificada' }}
                        </span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Fecha de Fin</span>
                        <span class="info-value {{ !$curso->fecha_fin ? 'empty' : '' }}">
                            {{ $curso->fecha_fin ? $curso->fecha_fin->format('d/m/Y') : 'No especificada' }}
                        </span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Creado</span>
                        <span class="info-value">{{ $curso->created_at->format('d/m/Y H:i') }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Última Actualización</span>
                        <span class="info-value">{{ $curso->updated_at->format('d/m/Y H:i') }}</span>
                    </div>
                </div>
            </div>

            <!-- Descripción -->
            <div class="info-card" style="margin-bottom: 1.5rem;">
                <div class="info-card-header">
                    <i class="fas fa-align-left"></i>
                    <h3>Descripción</h3>
                </div>
                <div class="info-card-body">
                    <div class="description-content">
                        {!! $curso->descripcion ? nl2br(e($curso->descripcion)) : '<em style="color: var(--text-secondary);">Sin descripción disponible</em>' !!}
                    </div>
                </div>
            </div>

            <!-- Requisitos y Objetivos -->
            @if($curso->requisitos || $curso->objetivos)
                <div class="info-card">
                    <div class="info-card-header">
                        <i class="fas fa-list-check"></i>
                        <h3>Requisitos y Objetivos</h3>
                    </div>
                    <div class="info-card-body">
                        @if($curso->requisitos)
                            <h4 style="color: var(--primary-color); margin-bottom: 10px;">Requisitos Previos</h4>
                            <div class="description-content" style="margin-bottom: 20px;">
                                {!! nl2br(e($curso->requisitos)) !!}
                            </div>
                        @endif
                        
                        @if($curso->objetivos)
                            <h4 style="color: var(--primary-color); margin-bottom: 10px;">Objetivos del Curso</h4>
                            <div class="description-content">
                                {!! nl2br(e($curso->objetivos)) !!}
                            </div>
                        @endif
                    </div>
                </div>
            @endif
        </div>

        <!-- Panel Lateral -->
        <div>
            <!-- Estado de Publicación -->
            <div class="info-card" style="margin-bottom: 1.5rem;">
                <div class="info-card-header">
                    <i class="fas fa-globe"></i>
                    <h3>Estado Web</h3>
                </div>
                <div class="info-card-body">
                    <div style="text-align: center;">
                        @if($curso->published)
                            <span class="status-badge status-published">
                                <i class="fas fa-check-circle"></i> Publicado
                            </span>
                            <p style="margin: 15px 0 0 0; color: var(--text-secondary); font-size: 0.9rem;">
                                Este curso es visible en la web pública.
                            </p>
                        @else
                            <span class="status-badge status-draft">
                                <i class="fas fa-clock"></i> Borrador
                            </span>
                            <p style="margin: 15px 0 0 0; color: var(--text-secondary); font-size: 0.9rem;">
                                Este curso no es visible en la web pública.
                            </p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Precio -->
            <div class="price-display {{ $curso->precio == 0 ? 'free' : '' }}">
                @if($curso->precio == 0)
                    <i class="fas fa-gift"></i> GRATUITO
                @else
                    <span class="currency">€</span>{{ number_format($curso->precio, 2) }}
                @endif
            </div>

            <!-- Estadísticas -->
            <div class="info-card" style="margin-bottom: 1.5rem;">
                <div class="info-card-header">
                    <i class="fas fa-chart-bar"></i>
                    <h3>Estadísticas</h3>
                </div>
                <div class="info-card-body">
                    <div class="stats-grid">
                        <div class="stat-item">
                            <div class="stat-number">{{ $curso->alumnos ? $curso->alumnos->count() : 0 }}</div>
                            <div class="stat-label">Estudiantes</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">{{ $curso->created_at->diffInDays(now()) }}</div>
                            <div class="stat-label">Días Creado</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Estudiantes Inscritos -->
    @if($curso->alumnos && $curso->alumnos->count() > 0)
        <div class="info-card">
            <div class="info-card-header">
                <i class="fas fa-users"></i>
                <h3>Estudiantes Inscritos ({{ $curso->alumnos ? $curso->alumnos->count() : 0 }})</h3>
            </div>
            <div class="info-card-body">
                <div class="students-grid">
                    @foreach($curso->alumnos as $alumno)
                        <div class="student-card">
                            @if($alumno->avatar)
                                <img src="{{ asset('storage/' . $alumno->avatar) }}" alt="{{ $alumno->name }}" class="student-avatar">
                            @else
                                <div class="student-avatar-placeholder">
                                    {{ strtoupper(substr($alumno->name, 0, 1)) }}{{ strtoupper(substr($alumno->surname ?? '', 0, 1)) }}
                                </div>
                            @endif
                            <div class="student-name">{{ $alumno->name }} {{ $alumno->surname }}</div>
                            <div class="student-email">{{ $alumno->email }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @else
        <div class="info-card">
            <div class="info-card-header">
                <i class="fas fa-users"></i>
                <h3>Estudiantes Inscritos</h3>
            </div>
            <div class="info-card-body" style="text-align: center; padding: 3rem 1rem;">
                <i class="fas fa-user-graduate" style="font-size: 3rem; color: var(--text-secondary); margin-bottom: 1rem;"></i>
                <h4 style="color: var(--text-primary); margin-bottom: 0.5rem;">Sin Estudiantes Inscritos</h4>
                <p style="color: var(--text-secondary); margin: 0;">Aún no hay estudiantes inscritos en este curso.</p>
            </div>
        </div>
    @endif
</div>
@endsection
