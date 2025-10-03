@extends('crm.layouts.clean_app')

@section('titulo', 'Detalle de la Reserva')

@section('css')
<style>
    .reserva-header {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        color: white;
        padding: 2rem;
        border-radius: 16px;
        margin-bottom: 2rem;
        position: relative;
        overflow: hidden;
    }
    .reserva-header::before {
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
    .reserva-header-content {
        position: relative;
        z-index: 2;
        display: flex;
        align-items: center;
        gap: 2rem;
        flex-wrap: wrap;
    }
    .reserva-icon-large {
        width: 120px;
        height: 120px;
        border-radius: 20px;
        background: rgba(255, 255, 255, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
        color: white;
        border: 4px solid white;
        box-shadow: 0 8px 30px rgba(0,0,0,0.2);
    }
    .reserva-info h1 {
        margin: 0 0 10px 0;
        font-size: 2.5rem;
        font-weight: 700;
    }
    .reserva-info .subtitle {
        font-size: 1.2rem;
        opacity: 0.9;
        margin-bottom: 15px;
    }
    .reserva-actions {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }
    .reserva-actions .btn {
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
    .reserva-actions .btn:hover {
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
    .status-confirmed {
        background: rgba(var(--success-color-rgb, 16, 185, 129), 0.1);
        color: var(--success-color);
        border: 1px solid rgba(var(--success-color-rgb, 16, 185, 129), 0.2);
    }
    .status-pending {
        background: rgba(var(--warning-color-rgb, 245, 158, 11), 0.1);
        color: var(--warning-color);
        border: 1px solid rgba(var(--warning-color-rgb, 245, 158, 11), 0.2);
    }
    .status-cancelled {
        background: rgba(var(--danger-color-rgb, 239, 68, 68), 0.1);
        color: var(--danger-color);
        border: 1px solid rgba(var(--danger-color-rgb, 239, 68, 68), 0.2);
    }

    .priority-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 12px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.85rem;
    }
    .priority-baja {
        background: rgba(var(--success-color-rgb, 16, 185, 129), 0.1);
        color: var(--success-color);
        border: 1px solid rgba(var(--success-color-rgb, 16, 185, 129), 0.2);
    }
    .priority-media {
        background: rgba(var(--warning-color-rgb, 245, 158, 11), 0.1);
        color: var(--warning-color);
        border: 1px solid rgba(var(--warning-color-rgb, 245, 158, 11), 0.2);
    }
    .priority-alta {
        background: rgba(var(--danger-color-rgb, 239, 68, 68), 0.1);
        color: var(--danger-color);
        border: 1px solid rgba(var(--danger-color-rgb, 239, 68, 68), 0.2);
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

    .timeline {
        position: relative;
        padding-left: 30px;
    }
    .timeline::before {
        content: '';
        position: absolute;
        left: 15px;
        top: 0;
        bottom: 0;
        width: 2px;
        background: var(--border-color);
    }
    .timeline-item {
        position: relative;
        margin-bottom: 20px;
        padding: 15px 20px;
        background: white;
        border-radius: 8px;
        border: 1px solid var(--border-color);
    }
    .timeline-item::before {
        content: '';
        position: absolute;
        left: -27px;
        top: 20px;
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: var(--primary-color);
        border: 3px solid white;
        box-shadow: 0 0 0 2px var(--border-color);
    }
    .timeline-date {
        font-size: 0.85rem;
        color: var(--text-secondary);
        margin-bottom: 5px;
    }
    .timeline-content {
        color: var(--text-primary);
        font-weight: 500;
    }

    .aula-preview {
        background: var(--bg-light);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 20px;
    }
    .aula-preview-header {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 15px;
    }
    .aula-preview-icon {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        background: var(--primary-color);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }
    .aula-preview-info h4 {
        margin: 0 0 5px 0;
        color: var(--text-primary);
        font-size: 1.2rem;
    }
    .aula-preview-info p {
        margin: 0;
        color: var(--text-secondary);
        font-size: 0.9rem;
    }
    .aula-preview-details {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
        font-size: 0.9rem;
    }
    .aula-preview-details .detail-item {
        display: flex;
        align-items: center;
        gap: 8px;
        color: var(--text-secondary);
    }
    .aula-preview-details .detail-item i {
        color: var(--info-color);
        width: 16px;
    }

    @media (max-width: 992px) {
        .content-grid {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }
        .reserva-header-content {
            flex-direction: column;
            text-align: center;
            gap: 1.5rem;
        }
        .reserva-info h1 {
            font-size: 2rem;
        }
        .stats-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px) {
        .reserva-header {
            padding: 1.5rem;
        }
        .reserva-icon-large {
            width: 100px;
            height: 100px;
            font-size: 2.5rem;
        }
        .reserva-info h1 {
            font-size: 1.8rem;
        }
        .reserva-actions {
            justify-content: center;
            width: 100%;
        }
        .info-row {
            flex-direction: column;
            align-items: flex-start;
            gap: 5px;
        }
        .aula-preview-details {
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

    <!-- Header de la Reserva -->
    <div class="reserva-header">
        <div class="reserva-header-content">
            <div class="reserva-icon-large">
                <i class="fas fa-calendar-check"></i>
            </div>
            <div class="reserva-info">
                <h1>{{ $reserva->titulo }}</h1>
                <div class="subtitle">{{ $reserva->aula->nombre ?? 'Aula no especificada' }}</div>
                <div class="reserva-actions">
                    <a href="{{ route('reservas.edit', $reserva->id) }}" class="btn">
                        <i class="fas fa-edit"></i> Editar Reserva
                    </a>
                    <a href="{{ route('reservas.index') }}" class="btn">
                        <i class="fas fa-arrow-left"></i> Volver al Listado
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Contenido Principal -->
    <div class="content-grid">
        <!-- Información de la Reserva -->
        <div>
            <div class="info-card" style="margin-bottom: 1.5rem;">
                <div class="info-card-header">
                    <i class="fas fa-info-circle"></i>
                    <h3>Información de la Reserva</h3>
                </div>
                <div class="info-card-body">
                    <div class="info-row">
                        <span class="info-label">Título</span>
                        <span class="info-value">{{ $reserva->titulo }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Solicitante</span>
                        <span class="info-value">{{ $reserva->solicitante ?? 'No especificado' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Email de Contacto</span>
                        <span class="info-value {{ !$reserva->email_contacto ? 'empty' : '' }}">
                            {{ $reserva->email_contacto ?? 'No especificado' }}
                        </span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Estado</span>
                        <span class="info-value">
                            @if($reserva->estado == 'confirmada')
                                <span class="status-badge status-confirmed">
                                    <i class="fas fa-check-circle"></i> Confirmada
                                </span>
                            @elseif($reserva->estado == 'pendiente')
                                <span class="status-badge status-pending">
                                    <i class="fas fa-clock"></i> Pendiente
                                </span>
                            @elseif($reserva->estado == 'cancelada')
                                <span class="status-badge status-cancelled">
                                    <i class="fas fa-times-circle"></i> Cancelada
                                </span>
                            @endif
                        </span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Prioridad</span>
                        <span class="info-value">
                            @php $prioridad = $reserva->prioridad ?? 'media'; @endphp
                            @if($prioridad == 'baja')
                                <span class="priority-badge priority-baja">
                                    <i class="fas fa-arrow-down"></i> Baja
                                </span>
                            @elseif($prioridad == 'media')
                                <span class="priority-badge priority-media">
                                    <i class="fas fa-minus"></i> Media
                                </span>
                            @elseif($prioridad == 'alta')
                                <span class="priority-badge priority-alta">
                                    <i class="fas fa-arrow-up"></i> Alta
                                </span>
                            @endif
                        </span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Número de Asistentes</span>
                        <span class="info-value {{ !$reserva->numero_asistentes ? 'empty' : '' }}">
                            {{ $reserva->numero_asistentes ?? 'No especificado' }}
                        </span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Fecha de Inicio</span>
                        <span class="info-value">
                            {{ $reserva->fecha_inicio ? \Carbon\Carbon::parse($reserva->fecha_inicio)->format('d/m/Y') : 'No especificada' }}
                        </span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Fecha de Fin</span>
                        <span class="info-value {{ !$reserva->fecha_fin ? 'empty' : '' }}">
                            {{ $reserva->fecha_fin ? \Carbon\Carbon::parse($reserva->fecha_fin)->format('d/m/Y') : 'Evento de un día' }}
                        </span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Horario</span>
                        <span class="info-value">
                            {{ $reserva->hora_inicio ?? 'No especificada' }} - {{ $reserva->hora_fin ?? 'No especificada' }}
                        </span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Creada</span>
                        <span class="info-value">{{ $reserva->created_at->format('d/m/Y H:i') }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Última Actualización</span>
                        <span class="info-value">{{ $reserva->updated_at->format('d/m/Y H:i') }}</span>
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
                        {!! $reserva->descripcion ? nl2br(e($reserva->descripcion)) : '<em style="color: var(--text-secondary);">Sin descripción disponible</em>' !!}
                    </div>
                </div>
            </div>

            <!-- Equipamiento y Observaciones -->
            @if($reserva->equipamiento_requerido || $reserva->observaciones)
                <div class="info-card">
                    <div class="info-card-header">
                        <i class="fas fa-tools"></i>
                        <h3>Información Adicional</h3>
                    </div>
                    <div class="info-card-body">
                        @if($reserva->equipamiento_requerido)
                            <h4 style="color: var(--primary-color); margin-bottom: 10px;">Equipamiento Requerido</h4>
                            <div class="description-content" style="margin-bottom: 20px;">
                                {!! nl2br(e($reserva->equipamiento_requerido)) !!}
                            </div>
                        @endif
                        
                        @if($reserva->observaciones)
                            <h4 style="color: var(--primary-color); margin-bottom: 10px;">Observaciones</h4>
                            <div class="description-content">
                                {!! nl2br(e($reserva->observaciones)) !!}
                            </div>
                        @endif
                    </div>
                </div>
            @endif
        </div>

        <!-- Panel Lateral -->
        <div>
            <!-- Estadísticas -->
            <div class="info-card" style="margin-bottom: 1.5rem;">
                <div class="info-card-header">
                    <i class="fas fa-chart-bar"></i>
                    <h3>Estadísticas</h3>
                </div>
                <div class="info-card-body">
                    <div class="stats-grid">
                        <div class="stat-item">
                            <div class="stat-number">{{ $reserva->numero_asistentes ?? 0 }}</div>
                            <div class="stat-label">Asistentes</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">{{ $reserva->created_at->diffInDays(now()) }}</div>
                            <div class="stat-label">Días Creada</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">
                                @if($reserva->fecha_inicio && $reserva->fecha_fin)
                                    {{ $reserva->fecha_inicio->diffInDays($reserva->fecha_fin) + 1 }}
                                @else
                                    1
                                @endif
                            </div>
                            <div class="stat-label">Días Duración</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">
                                @if($reserva->hora_inicio && $reserva->hora_fin)
                                    @php
                                        $inicio = \Carbon\Carbon::createFromFormat('H:i:s', $reserva->hora_inicio);
                                        $fin = \Carbon\Carbon::createFromFormat('H:i:s', $reserva->hora_fin);
                                        $horas = $fin->diffInHours($inicio);
                                    @endphp
                                    {{ $horas }}h
                                @else
                                    0h
                                @endif
                            </div>
                            <div class="stat-label">Duración</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Aula Asignada -->
            @if($reserva->aula)
                <div class="info-card" style="margin-bottom: 1.5rem;">
                    <div class="info-card-header">
                        <i class="fas fa-door-open"></i>
                        <h3>Aula Asignada</h3>
                    </div>
                    <div class="info-card-body">
                        <div class="aula-preview">
                            <div class="aula-preview-header">
                                <div class="aula-preview-icon">
                                    <i class="fas fa-chalkboard"></i>
                                </div>
                                <div class="aula-preview-info">
                                    <h4>{{ $reserva->aula->nombre }}</h4>
                                    <p>{{ $reserva->aula->descripcion ?? 'Aula disponible para reservas' }}</p>
                                </div>
                            </div>
                            <div class="aula-preview-details">
                                <div class="detail-item">
                                    <i class="fas fa-users"></i>
                                    <span>Capacidad: {{ $reserva->aula->capacidad }} personas</span>
                                </div>
                                <div class="detail-item">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span>{{ $reserva->aula->planta ?? 'Planta no especificada' }}</span>
                                </div>
                                <div class="detail-item">
                                    <i class="fas fa-building"></i>
                                    <span>{{ $reserva->aula->edificio ?? 'Edificio no especificado' }}</span>
                                </div>
                                <div class="detail-item">
                                    <i class="fas fa-info-circle"></i>
                                    <span>Estado: {{ ucfirst($reserva->aula->estado ?? 'disponible') }}</span>
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('aulas.show', $reserva->aula->id) }}" class="btn-primary" style="width: 100%; text-align: center; padding: 12px; border-radius: 8px; text-decoration: none;">
                            <i class="fas fa-eye"></i> Ver Detalles del Aula
                        </a>
                    </div>
                </div>
            @endif

            <!-- Estado Actual -->
            <div class="info-card" style="margin-bottom: 1.5rem;">
                <div class="info-card-header">
                    <i class="fas fa-info-circle"></i>
                    <h3>Estado Actual</h3>
                </div>
                <div class="info-card-body" style="text-align: center;">
                    @if($reserva->estado == 'confirmada')
                        <div style="color: var(--success-color); margin-bottom: 15px;">
                            <i class="fas fa-check-circle" style="font-size: 3rem;"></i>
                        </div>
                        <h4 style="color: var(--success-color); margin-bottom: 10px;">Confirmada</h4>
                        <p style="color: var(--text-secondary); margin: 0;">La reserva ha sido aprobada y confirmada</p>
                    @elseif($reserva->estado == 'pendiente')
                        <div style="color: var(--warning-color); margin-bottom: 15px;">
                            <i class="fas fa-clock" style="font-size: 3rem;"></i>
                        </div>
                        <h4 style="color: var(--warning-color); margin-bottom: 10px;">Pendiente</h4>
                        <p style="color: var(--text-secondary); margin: 0;">La reserva está pendiente de aprobación</p>
                    @elseif($reserva->estado == 'cancelada')
                        <div style="color: var(--danger-color); margin-bottom: 15px;">
                            <i class="fas fa-times-circle" style="font-size: 3rem;"></i>
                        </div>
                        <h4 style="color: var(--danger-color); margin-bottom: 10px;">Cancelada</h4>
                        <p style="color: var(--text-secondary); margin: 0;">La reserva ha sido cancelada</p>
                    @endif
                </div>
            </div>

            <!-- Acciones Rápidas -->
            <div class="info-card">
                <div class="info-card-header">
                    <i class="fas fa-bolt"></i>
                    <h3>Acciones Rápidas</h3>
                </div>
                <div class="info-card-body">
                    <div style="display: flex; flex-direction: column; gap: 10px;">
                        <a href="{{ route('reservas.edit', $reserva->id) }}" class="btn-primary" style="text-align: center; padding: 12px; border-radius: 8px; text-decoration: none;">
                            <i class="fas fa-edit"></i> Editar Reserva
                        </a>
                        @if($reserva->estado != 'confirmada')
                            <button class="btn-secondary" style="text-align: center; padding: 12px; border-radius: 8px; border: none; cursor: pointer;" onclick="cambiarEstado('confirmada')">
                                <i class="fas fa-check"></i> Confirmar Reserva
                            </button>
                        @endif
                        @if($reserva->estado != 'cancelada')
                            <button class="btn-secondary" style="text-align: center; padding: 12px; border-radius: 8px; border: none; cursor: pointer;" onclick="cambiarEstado('cancelada')">
                                <i class="fas fa-times"></i> Cancelar Reserva
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Timeline de la Reserva -->
    <div class="info-card">
        <div class="info-card-header">
            <i class="fas fa-history"></i>
            <h3>Historial de la Reserva</h3>
        </div>
        <div class="info-card-body">
            <div class="timeline">
                <div class="timeline-item">
                    <div class="timeline-date">{{ $reserva->created_at->format('d/m/Y H:i') }}</div>
                    <div class="timeline-content">Reserva creada por {{ $reserva->solicitante ?? 'Usuario' }}</div>
                </div>
                @if($reserva->updated_at != $reserva->created_at)
                    <div class="timeline-item">
                        <div class="timeline-date">{{ $reserva->updated_at->format('d/m/Y H:i') }}</div>
                        <div class="timeline-content">Reserva actualizada - Estado: {{ ucfirst($reserva->estado ?? 'pendiente') }}</div>
                    </div>
                @endif
                @if($reserva->fecha_inicio)
                    <div class="timeline-item">
                        <div class="timeline-date">{{ \Carbon\Carbon::parse($reserva->fecha_inicio)->format('d/m/Y') }} {{ $reserva->hora_inicio ?? '' }}</div>
                        <div class="timeline-content">Inicio programado del evento</div>
                    </div>
                @endif
                @if($reserva->fecha_fin)
                    <div class="timeline-item">
                        <div class="timeline-date">{{ \Carbon\Carbon::parse($reserva->fecha_fin)->format('d/m/Y') }} {{ $reserva->hora_fin ?? '' }}</div>
                        <div class="timeline-content">Fin programado del evento</div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
function cambiarEstado(nuevoEstado) {
    if (confirm(`¿Estás seguro de que quieres cambiar el estado de la reserva a "${nuevoEstado}"?`)) {
        // Aquí podrías hacer una petición AJAX para cambiar el estado
        // Por ahora, redirigimos a la página de edición
        window.location.href = '{{ route("reservas.edit", $reserva->id) }}';
    }
}
</script>
@endsection
