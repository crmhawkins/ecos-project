@extends('crm.layouts.clean_app')

@section('titulo', 'Editar Reserva')

@section('css')
<style>
    .form-header-gradient {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        color: white;
        padding: 24px 32px;
        border-radius: 16px 16px 0 0;
        margin: 0;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
    }
    .form-header-gradient h1 {
        margin: 0;
        font-size: 1.8rem;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .form-header-gradient .btn-back {
        background: white;
        color: var(--primary-color);
        border: none;
        padding: 8px 16px;
        border-radius: 8px;
        font-weight: 600;
        transition: var(--transition);
        display: flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
    }
    .form-header-gradient .btn-back:hover {
        background: #f0f0f0;
        color: var(--primary-color);
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }

    .form-container {
        background: white;
        border-radius: 16px;
        box-shadow: var(--shadow);
        overflow: hidden;
        margin-bottom: 24px;
        border: 1px solid var(--border-color);
    }
    .form-body {
        padding: 32px;
    }
    .form-section-title {
        font-size: 1.4rem;
        font-weight: 600;
        color: var(--primary-color);
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid rgba(var(--primary-color-rgb, 217, 54, 144), 0.1);
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .form-group {
        margin-bottom: 24px;
    }
    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: var(--text-primary);
        font-size: 0.95rem;
    }
    .form-control {
        width: 100%;
        padding: 12px 16px;
        border: 2px solid var(--border-color);
        border-radius: 8px;
        font-size: 1rem;
        transition: var(--transition);
        background: white;
        color: var(--text-primary);
    }
    .form-control:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(var(--primary-color-rgb, 217, 54, 144), 0.1);
    }
    .form-control::placeholder {
        color: var(--text-secondary);
        opacity: 0.7;
    }
    textarea.form-control {
        resize: vertical;
        min-height: 120px;
    }
    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 24px;
    }
    .form-row-3 {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        gap: 24px;
    }
    .stats-card {
        background: var(--bg-light);
        border: 1px solid var(--border-color);
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 20px;
    }
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
        gap: 16px;
    }
    .stat-item {
        text-align: center;
        padding: 15px;
        background: white;
        border-radius: 8px;
        border: 1px solid var(--border-color);
    }
    .stat-number {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--primary-color);
        margin-bottom: 5px;
    }
    .stat-label {
        color: var(--text-secondary);
        font-size: 0.85rem;
        font-weight: 500;
    }
    .aula-selector {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 16px;
        margin-top: 10px;
    }
    .aula-option {
        border: 2px solid var(--border-color);
        border-radius: 12px;
        padding: 20px;
        cursor: pointer;
        transition: var(--transition);
        background: white;
        position: relative;
    }
    .aula-option:hover {
        border-color: var(--primary-color);
        background: rgba(var(--primary-color-rgb, 217, 54, 144), 0.05);
    }
    .aula-option.selected {
        border-color: var(--primary-color);
        background: rgba(var(--primary-color-rgb, 217, 54, 144), 0.1);
    }
    .aula-option input[type="radio"] {
        position: absolute;
        opacity: 0;
        pointer-events: none;
    }
    .aula-option .aula-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 12px;
    }
    .aula-option .aula-icon {
        width: 40px;
        height: 40px;
        border-radius: 8px;
        background: var(--primary-color);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
    }
    .aula-option .aula-name {
        font-weight: 600;
        color: var(--text-primary);
        font-size: 1.1rem;
    }
    .aula-option .aula-details {
        color: var(--text-secondary);
        font-size: 0.9rem;
        line-height: 1.4;
    }
    .aula-option .aula-capacity {
        display: flex;
        align-items: center;
        gap: 6px;
        margin-top: 8px;
        color: var(--info-color);
        font-weight: 500;
        font-size: 0.9rem;
    }
    .priority-selector {
        display: flex;
        gap: 12px;
        margin-top: 10px;
    }
    .priority-option {
        flex: 1;
        padding: 12px 16px;
        border: 2px solid var(--border-color);
        border-radius: 8px;
        text-align: center;
        cursor: pointer;
        transition: var(--transition);
        background: white;
        position: relative;
    }
    .priority-option input[type="radio"] {
        position: absolute;
        opacity: 0;
        pointer-events: none;
    }
    .priority-option.low {
        color: var(--success-color);
    }
    .priority-option.medium {
        color: var(--warning-color);
    }
    .priority-option.high {
        color: var(--danger-color);
    }
    .priority-option:hover {
        border-color: currentColor;
        background: rgba(currentColor, 0.05);
    }
    .priority-option.selected {
        border-color: currentColor;
        background: rgba(currentColor, 0.1);
        font-weight: 600;
    }
    .btn-group-form {
        display: flex;
        gap: 12px;
        padding: 24px 32px;
        background: var(--bg-light);
        border-top: 1px solid var(--border-color);
        border-radius: 0 0 16px 16px;
        justify-content: flex-end;
    }
    .btn-submit {
        background: var(--primary-color);
        color: white;
        padding: 12px 24px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        transition: var(--transition);
        border: none;
        cursor: pointer;
        font-size: 1rem;
    }
    .btn-submit:hover {
        background: #c2185b;
        color: white;
    }
    .btn-cancel {
        background: var(--text-secondary);
        color: white;
        padding: 12px 24px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        transition: var(--transition);
        border: none;
        cursor: pointer;
        font-size: 1rem;
    }
    .btn-cancel:hover {
        background: #4b5563;
        color: white;
        text-decoration: none;
    }

    @media (max-width: 768px) {
        .form-row, .form-row-3 {
            grid-template-columns: 1fr;
            gap: 16px;
        }
        .form-body {
            padding: 24px;
        }
        .form-header-gradient {
            padding: 18px 24px;
        }
        .form-header-gradient h1 {
            font-size: 1.5rem;
        }
        .btn-group-form {
            flex-direction: column;
            padding: 18px 24px;
        }
        .aula-selector {
            grid-template-columns: 1fr;
        }
        .priority-selector {
            flex-direction: column;
        }
        .stats-grid {
            grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
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

    @if($errors->any())
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-triangle"></i>
            <strong>Error:</strong>
            <ul style="margin: 8px 0 0 0; padding-left: 20px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('reservas.update', $reserva->id) }}">
        @csrf
        @method('PUT')
        
        <div class="form-container">
            <div class="form-header-gradient">
                <h1><i class="fas fa-edit"></i> Editar Reserva: {{ $reserva->titulo }}</h1>
                <a href="{{ route('reservas.index') }}" class="btn-back">
                    <i class="fas fa-arrow-left"></i> Volver al Listado
                </a>
            </div>

            <div class="form-body">
                <!-- Estadísticas de la Reserva -->
                <div class="stats-card">
                    <h4 style="margin: 0 0 15px 0; color: var(--text-primary);">Estadísticas de la Reserva</h4>
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
                            <div class="stat-number">{{ ucfirst($reserva->prioridad ?? 'media') }}</div>
                            <div class="stat-label">Prioridad</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">{{ ucfirst($reserva->estado ?? 'pendiente') }}</div>
                            <div class="stat-label">Estado</div>
            </div>
        </div>
    </div>

                <h3 class="form-section-title"><i class="fas fa-info-circle"></i> Información de la Reserva</h3>
                
                <div class="form-group">
                    <label for="titulo">Título de la Reserva <span style="color: red;">*</span></label>
                    <input type="text" name="titulo" id="titulo" class="form-control" 
                           value="{{ old('titulo', $reserva->titulo) }}" placeholder="Ej: Reunión de equipo, Clase de matemáticas" required>
                </div>

                <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <textarea name="descripcion" id="descripcion" class="form-control" 
                              placeholder="Descripción detallada del evento o actividad">{{ old('descripcion', $reserva->descripcion) }}</textarea>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="solicitante">Solicitante <span style="color: red;">*</span></label>
                        <input type="text" name="solicitante" id="solicitante" class="form-control" 
                               value="{{ old('solicitante', $reserva->solicitante) }}" placeholder="Nombre del solicitante" required>
                    </div>
                    <div class="form-group">
                        <label for="email_contacto">Email de Contacto</label>
                        <input type="email" name="email_contacto" id="email_contacto" class="form-control" 
                               value="{{ old('email_contacto', $reserva->email_contacto) }}" placeholder="correo@ejemplo.com">
                    </div>
                </div>

                <h3 class="form-section-title"><i class="fas fa-calendar-alt"></i> Fechas y Horarios</h3>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="fecha_inicio">Fecha de Inicio <span style="color: red;">*</span></label>
                        <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" 
                               value="{{ old('fecha_inicio', $reserva->fecha_inicio ? \Carbon\Carbon::parse($reserva->fecha_inicio)->format('Y-m-d') : '') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="fecha_fin">Fecha de Fin</label>
                        <input type="date" name="fecha_fin" id="fecha_fin" class="form-control" 
                               value="{{ old('fecha_fin', $reserva->fecha_fin ? \Carbon\Carbon::parse($reserva->fecha_fin)->format('Y-m-d') : '') }}">
                        <small style="color: var(--text-secondary); font-size: 0.85rem; margin-top: 5px; display: block;">
                            Dejar vacío si es un evento de un solo día
                        </small>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="hora_inicio">Hora de Inicio <span style="color: red;">*</span></label>
                        <input type="time" name="hora_inicio" id="hora_inicio" class="form-control" 
                               value="{{ old('hora_inicio', $reserva->hora_inicio) }}" required>
                    </div>
                    <div class="form-group">
                        <label for="hora_fin">Hora de Fin <span style="color: red;">*</span></label>
                        <input type="time" name="hora_fin" id="hora_fin" class="form-control" 
                               value="{{ old('hora_fin', $reserva->hora_fin) }}" required>
                                </div>
                            </div>

                <h3 class="form-section-title"><i class="fas fa-door-open"></i> Selección de Aula</h3>
                
                <div class="form-group">
                    <label>Aula Solicitada <span style="color: red;">*</span></label>
                    <div class="aula-selector">
                        @if(isset($aulas))
                            @foreach($aulas as $aula)
                                <div class="aula-option {{ old('aula_id', $reserva->aula_id) == $aula->id ? 'selected' : '' }}" data-aula="{{ $aula->id }}">
                                    <input type="radio" name="aula_id" value="{{ $aula->id }}" 
                                           {{ old('aula_id', $reserva->aula_id) == $aula->id ? 'checked' : '' }} required>
                                    <div class="aula-header">
                                        <div class="aula-icon">
                                            <i class="fas fa-chalkboard"></i>
                                        </div>
                                        <div class="aula-name">{{ $aula->nombre }}</div>
                                    </div>
                                    <div class="aula-details">
                                        {{ $aula->descripcion ?? 'Aula disponible para reservas' }}
                                    </div>
                                    <div class="aula-capacity">
                                        <i class="fas fa-users"></i>
                                        Capacidad: {{ $aula->capacidad }} personas
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p style="color: var(--text-secondary); font-style: italic;">No hay aulas disponibles</p>
                        @endif
                    </div>
                </div>

                <h3 class="form-section-title"><i class="fas fa-cog"></i> Configuración Adicional</h3>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="numero_asistentes">Número de Asistentes</label>
                        <input type="number" name="numero_asistentes" id="numero_asistentes" class="form-control" 
                               value="{{ old('numero_asistentes', $reserva->numero_asistentes) }}" min="1" placeholder="Ej: 25">
                    </div>
                    <div class="form-group">
                        <label for="estado">Estado de la Reserva</label>
                        <select name="estado" id="estado" class="form-control">
                            <option value="pendiente" {{ old('estado', $reserva->estado) == 'pendiente' ? 'selected' : '' }}>Pendiente de Aprobación</option>
                            <option value="confirmada" {{ old('estado', $reserva->estado) == 'confirmada' ? 'selected' : '' }}>Confirmada</option>
                            <option value="cancelada" {{ old('estado', $reserva->estado) == 'cancelada' ? 'selected' : '' }}>Cancelada</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label>Prioridad de la Reserva</label>
                    <div class="priority-selector">
                        <div class="priority-option low {{ old('prioridad', $reserva->prioridad) == 'baja' ? 'selected' : '' }}" data-priority="baja">
                            <input type="radio" name="prioridad" value="baja" {{ old('prioridad', $reserva->prioridad) == 'baja' ? 'checked' : '' }}>
                            <i class="fas fa-arrow-down"></i>
                            <div>Baja</div>
                        </div>
                        <div class="priority-option medium {{ old('prioridad', $reserva->prioridad ?? 'media') == 'media' ? 'selected' : '' }}" data-priority="media">
                            <input type="radio" name="prioridad" value="media" {{ old('prioridad', $reserva->prioridad ?? 'media') == 'media' ? 'checked' : '' }}>
                            <i class="fas fa-minus"></i>
                            <div>Media</div>
                            </div>
                        <div class="priority-option high {{ old('prioridad', $reserva->prioridad) == 'alta' ? 'selected' : '' }}" data-priority="alta">
                            <input type="radio" name="prioridad" value="alta" {{ old('prioridad', $reserva->prioridad) == 'alta' ? 'checked' : '' }}>
                            <i class="fas fa-arrow-up"></i>
                            <div>Alta</div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="equipamiento_requerido">Equipamiento Requerido</label>
                    <textarea name="equipamiento_requerido" id="equipamiento_requerido" class="form-control" 
                              placeholder="Ej: Proyector, sistema de audio, ordenadores...">{{ old('equipamiento_requerido', $reserva->equipamiento_requerido) }}</textarea>
                </div>

                <div class="form-group">
                    <label for="observaciones">Observaciones</label>
                    <textarea name="observaciones" id="observaciones" class="form-control" 
                              placeholder="Notas adicionales, requisitos especiales, etc.">{{ old('observaciones', $reserva->observaciones) }}</textarea>
                    </div>
            </div>
        </div>

        <div class="btn-group-form" style="background: white; border-radius: 16px; box-shadow: var(--shadow); border: 1px solid var(--border-color);">
            <a href="{{ route('reservas.index') }}" class="btn-cancel">
                <i class="fas fa-times"></i> Cancelar
            </a>
            <button type="submit" class="btn-submit">
                <i class="fas fa-save"></i> Actualizar Reserva
            </button>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Selector de aulas
    const aulaOptions = document.querySelectorAll('.aula-option');
    aulaOptions.forEach(option => {
        option.addEventListener('click', function() {
            aulaOptions.forEach(opt => opt.classList.remove('selected'));
            this.classList.add('selected');
            this.querySelector('input[type="radio"]').checked = true;
        });
    });

    // Selector de prioridad
    const priorityOptions = document.querySelectorAll('.priority-option');
    priorityOptions.forEach(option => {
        option.addEventListener('click', function() {
            priorityOptions.forEach(opt => opt.classList.remove('selected'));
            this.classList.add('selected');
            this.querySelector('input[type="radio"]').checked = true;
        });
    });

    // Validación de fechas
    const fechaInicio = document.getElementById('fecha_inicio');
    const fechaFin = document.getElementById('fecha_fin');
    
    fechaInicio.addEventListener('change', function() {
        if (fechaFin.value && fechaInicio.value > fechaFin.value) {
            alert('La fecha de inicio no puede ser posterior a la fecha de fin');
            fechaInicio.value = '';
        }
    });
    
    fechaFin.addEventListener('change', function() {
        if (fechaInicio.value && fechaFin.value < fechaInicio.value) {
            alert('La fecha de fin no puede ser anterior a la fecha de inicio');
            fechaFin.value = '';
        }
    });

    // Validación de horarios
    const horaInicio = document.getElementById('hora_inicio');
    const horaFin = document.getElementById('hora_fin');
    
    function validarHorarios() {
        if (horaInicio.value && horaFin.value && horaInicio.value >= horaFin.value) {
            alert('La hora de inicio debe ser anterior a la hora de fin');
            horaFin.value = '';
        }
    }
    
    horaInicio.addEventListener('change', validarHorarios);
    horaFin.addEventListener('change', validarHorarios);
});
</script>
@endsection