@extends('crm.layouts.clean_app')

@section('titulo', 'Editar Aula')

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
    .equipment-selector {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 12px;
        margin-top: 10px;
        padding: 15px;
        background: var(--bg-light);
        border-radius: 8px;
        border: 1px solid var(--border-color);
    }
    .equipment-item {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 8px 12px;
        background: white;
        border-radius: 6px;
        border: 1px solid var(--border-color);
        transition: var(--transition);
        cursor: pointer;
    }
    .equipment-item:hover {
        border-color: var(--primary-color);
        background: rgba(var(--primary-color-rgb, 217, 54, 144), 0.05);
    }
    .equipment-item input[type="checkbox"] {
        width: 16px;
        height: 16px;
        accent-color: var(--primary-color);
    }
    .equipment-item label {
        margin: 0;
        font-size: 0.9rem;
        cursor: pointer;
        flex: 1;
    }
    .equipment-item i {
        color: var(--primary-color);
        font-size: 1rem;
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
        .equipment-selector {
            grid-template-columns: 1fr;
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

    <form method="POST" action="{{ route('aulas.update', $aula->id) }}">
        @csrf
        @method('PUT')
        
        <div class="form-container">
            <div class="form-header-gradient">
                <h1><i class="fas fa-edit"></i> Editar Aula: {{ $aula->nombre }}</h1>
                <a href="{{ route('aulas.index') }}" class="btn-back">
                    <i class="fas fa-arrow-left"></i> Volver al Listado
                </a>
            </div>
            
            <div class="form-body">
                <!-- Estadísticas del Aula -->
                <div class="stats-card">
                    <h4 style="margin: 0 0 15px 0; color: var(--text-primary);">Estadísticas del Aula</h4>
                    <div class="stats-grid">
                        <div class="stat-item">
                            <div class="stat-number">{{ $aula->capacidad ?? 0 }}</div>
                            <div class="stat-label">Capacidad</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">{{ $aula->reservas->count() ?? 0 }}</div>
                            <div class="stat-label">Reservas</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">{{ $aula->created_at->diffInDays(now()) }}</div>
                            <div class="stat-label">Días Creada</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">{{ is_array($aula->equipamiento) ? count($aula->equipamiento) : 0 }}</div>
                            <div class="stat-label">Equipos</div>
                        </div>
                    </div>
                </div>

                <h3 class="form-section-title"><i class="fas fa-door-open"></i> Información Básica</h3>
                
                <div class="form-group">
                    <label for="nombre">Nombre del Aula <span style="color: red;">*</span></label>
                    <input type="text" name="nombre" id="nombre" class="form-control" 
                           value="{{ old('nombre', $aula->nombre) }}" placeholder="Ej: Aula 101, Laboratorio de Informática" required>
                </div>

                <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <textarea name="descripcion" id="descripcion" class="form-control" 
                              placeholder="Descripción detallada del aula y sus características">{{ old('descripcion', $aula->descripcion) }}</textarea>
                </div>

                <div class="form-row-3">
                    <div class="form-group">
                        <label for="capacidad">Capacidad <span style="color: red;">*</span></label>
                        <input type="number" name="capacidad" id="capacidad" class="form-control" 
                               value="{{ old('capacidad', $aula->capacidad) }}" min="1" placeholder="Ej: 30" required>
                        <small style="color: var(--text-secondary); font-size: 0.85rem; margin-top: 5px; display: block;">
                            Número máximo de personas
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="planta">Planta/Piso</label>
                        <input type="text" name="planta" id="planta" class="form-control" 
                               value="{{ old('planta', $aula->planta) }}" placeholder="Ej: Planta Baja, 1º Piso">
                    </div>
                    <div class="form-group">
                        <label for="edificio">Edificio</label>
                        <input type="text" name="edificio" id="edificio" class="form-control" 
                               value="{{ old('edificio', $aula->edificio) }}" placeholder="Ej: Edificio A, Principal">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="estado">Estado del Aula <span style="color: red;">*</span></label>
                        <select name="estado" id="estado" class="form-control" required>
                            <option value="">Selecciona un estado</option>
                            <option value="disponible" {{ old('estado', $aula->estado) == 'disponible' ? 'selected' : '' }}>Disponible</option>
                            <option value="ocupada" {{ old('estado', $aula->estado) == 'ocupada' ? 'selected' : '' }}>Ocupada</option>
                            <option value="mantenimiento" {{ old('estado', $aula->estado) == 'mantenimiento' ? 'selected' : '' }}>En Mantenimiento</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tipo">Tipo de Aula</label>
                        <select name="tipo" id="tipo" class="form-control">
                            <option value="">Selecciona un tipo</option>
                            <option value="aula_teorica" {{ old('tipo', $aula->tipo) == 'aula_teorica' ? 'selected' : '' }}>Aula Teórica</option>
                            <option value="laboratorio" {{ old('tipo', $aula->tipo) == 'laboratorio' ? 'selected' : '' }}>Laboratorio</option>
                            <option value="taller" {{ old('tipo', $aula->tipo) == 'taller' ? 'selected' : '' }}>Taller</option>
                            <option value="auditorio" {{ old('tipo', $aula->tipo) == 'auditorio' ? 'selected' : '' }}>Auditorio</option>
                            <option value="sala_reuniones" {{ old('tipo', $aula->tipo) == 'sala_reuniones' ? 'selected' : '' }}>Sala de Reuniones</option>
                            <option value="biblioteca" {{ old('tipo', $aula->tipo) == 'biblioteca' ? 'selected' : '' }}>Biblioteca</option>
                        </select>
                    </div>
                </div>

                <h3 class="form-section-title"><i class="fas fa-tools"></i> Equipamiento y Recursos</h3>
                
                <div class="form-group">
                    <label>Equipamiento Disponible</label>
                    <div class="equipment-selector">
                        @php
                            $currentEquipment = old('equipamiento', is_array($aula->equipamiento) ? $aula->equipamiento : []);
                        @endphp
                        <div class="equipment-item">
                            <input type="checkbox" name="equipamiento[]" id="proyector" value="proyector" 
                                   {{ in_array('proyector', $currentEquipment) ? 'checked' : '' }}>
                            <i class="fas fa-video"></i>
                            <label for="proyector">Proyector</label>
                        </div>
                        <div class="equipment-item">
                            <input type="checkbox" name="equipamiento[]" id="pizarra_digital" value="pizarra_digital" 
                                   {{ in_array('pizarra_digital', $currentEquipment) ? 'checked' : '' }}>
                            <i class="fas fa-chalkboard"></i>
                            <label for="pizarra_digital">Pizarra Digital</label>
                        </div>
                        <div class="equipment-item">
                            <input type="checkbox" name="equipamiento[]" id="ordenadores" value="ordenadores" 
                                   {{ in_array('ordenadores', $currentEquipment) ? 'checked' : '' }}>
                            <i class="fas fa-desktop"></i>
                            <label for="ordenadores">Ordenadores</label>
                        </div>
                        <div class="equipment-item">
                            <input type="checkbox" name="equipamiento[]" id="wifi" value="wifi" 
                                   {{ in_array('wifi', $currentEquipment) ? 'checked' : '' }}>
                            <i class="fas fa-wifi"></i>
                            <label for="wifi">WiFi</label>
                        </div>
                        <div class="equipment-item">
                            <input type="checkbox" name="equipamiento[]" id="aire_acondicionado" value="aire_acondicionado" 
                                   {{ in_array('aire_acondicionado', $currentEquipment) ? 'checked' : '' }}>
                            <i class="fas fa-snowflake"></i>
                            <label for="aire_acondicionado">Aire Acondicionado</label>
                        </div>
                        <div class="equipment-item">
                            <input type="checkbox" name="equipamiento[]" id="sistema_audio" value="sistema_audio" 
                                   {{ in_array('sistema_audio', $currentEquipment) ? 'checked' : '' }}>
                            <i class="fas fa-volume-up"></i>
                            <label for="sistema_audio">Sistema de Audio</label>
                        </div>
                        <div class="equipment-item">
                            <input type="checkbox" name="equipamiento[]" id="microfono" value="microfono" 
                                   {{ in_array('microfono', $currentEquipment) ? 'checked' : '' }}>
                            <i class="fas fa-microphone"></i>
                            <label for="microfono">Micrófono</label>
                        </div>
                        <div class="equipment-item">
                            <input type="checkbox" name="equipamiento[]" id="camara" value="camara" 
                                   {{ in_array('camara', $currentEquipment) ? 'checked' : '' }}>
                            <i class="fas fa-camera"></i>
                            <label for="camara">Cámara</label>
                        </div>
                        <div class="equipment-item">
                            <input type="checkbox" name="equipamiento[]" id="impresora" value="impresora" 
                                   {{ in_array('impresora', $currentEquipment) ? 'checked' : '' }}>
                            <i class="fas fa-print"></i>
                            <label for="impresora">Impresora</label>
                        </div>
                        <div class="equipment-item">
                            <input type="checkbox" name="equipamiento[]" id="scanner" value="scanner" 
                                   {{ in_array('scanner', $currentEquipment) ? 'checked' : '' }}>
                            <i class="fas fa-scanner"></i>
                            <label for="scanner">Escáner</label>
                        </div>
                    </div>
                    <small style="color: var(--text-secondary); font-size: 0.85rem; margin-top: 10px; display: block;">
                        Selecciona todo el equipamiento disponible en esta aula
                    </small>
                </div>

                <h3 class="form-section-title"><i class="fas fa-info-circle"></i> Información Adicional</h3>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="responsable">Responsable del Aula</label>
                        <input type="text" name="responsable" id="responsable" class="form-control" 
                               value="{{ old('responsable', $aula->responsable) }}" placeholder="Nombre del responsable">
                    </div>
                    <div class="form-group">
                        <label for="telefono_contacto">Teléfono de Contacto</label>
                        <input type="tel" name="telefono_contacto" id="telefono_contacto" class="form-control" 
                               value="{{ old('telefono_contacto', $aula->telefono_contacto) }}" placeholder="+34 600 000 000">
                    </div>
                </div>

                <div class="form-group">
                    <label for="horario_disponible">Horario de Disponibilidad</label>
                    <textarea name="horario_disponible" id="horario_disponible" class="form-control" 
                              placeholder="Ej: Lunes a Viernes de 8:00 a 20:00">{{ old('horario_disponible', $aula->horario_disponible) }}</textarea>
                </div>

                <div class="form-group">
                    <label for="observaciones">Observaciones</label>
                    <textarea name="observaciones" id="observaciones" class="form-control" 
                              placeholder="Notas adicionales, restricciones, etc.">{{ old('observaciones', $aula->observaciones) }}</textarea>
                </div>
            </div>
        </div>

        <div class="btn-group-form" style="background: white; border-radius: 16px; box-shadow: var(--shadow); border: 1px solid var(--border-color);">
            <a href="{{ route('aulas.index') }}" class="btn-cancel">
                <i class="fas fa-times"></i> Cancelar
            </a>
            <button type="submit" class="btn-submit">
                <i class="fas fa-save"></i> Actualizar Aula
            </button>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Hacer clickeable toda la caja del equipamiento
    const equipmentItems = document.querySelectorAll('.equipment-item');
    equipmentItems.forEach(item => {
        item.addEventListener('click', function(e) {
            if (e.target.type !== 'checkbox') {
                const checkbox = this.querySelector('input[type="checkbox"]');
                checkbox.checked = !checkbox.checked;
            }
        });
    });

    // Validación de capacidad
    const capacidadInput = document.getElementById('capacidad');
    capacidadInput.addEventListener('input', function() {
        if (this.value < 1) {
            this.setCustomValidity('La capacidad debe ser al menos 1 persona');
        } else {
            this.setCustomValidity('');
        }
    });
});
</script>
@endsection