@extends('crm.layouts.clean_app')

@section('titulo', 'Calendario de Reservas')

@section('css')
<style>
    .calendar-header {
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
    .calendar-header h1 {
        margin: 0;
        font-size: 2rem;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .calendar-controls {
        display: flex;
        align-items: center;
        gap: 15px;
        flex-wrap: wrap;
    }
    .month-nav {
        display: flex;
        align-items: center;
        gap: 10px;
        background: rgba(255, 255, 255, 0.2);
        padding: 8px 15px;
        border-radius: 25px;
    }
    .month-nav button {
        background: none;
        border: none;
        color: white;
        font-size: 1.2rem;
        cursor: pointer;
        padding: 5px 10px;
        border-radius: 50%;
        transition: var(--transition);
    }
    .month-nav button:hover {
        background: rgba(255, 255, 255, 0.2);
    }
    .current-month {
        font-weight: 600;
        font-size: 1.1rem;
        min-width: 150px;
        text-align: center;
    }
    .calendar-actions {
        display: flex;
        gap: 10px;
    }
    .calendar-actions .btn {
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
        font-size: 0.9rem;
    }
    .calendar-actions .btn:hover {
        background: #f0f0f0;
        color: var(--primary-color);
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }

    .legend-card {
        background: white;
        border-radius: 16px;
        box-shadow: var(--shadow);
        padding: 1.5rem;
        margin-bottom: 2rem;
        border: 1px solid var(--border-color);
    }
    .legend-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .legend-items {
        display: flex;
        gap: 20px;
        flex-wrap: wrap;
    }
    .legend-item {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.9rem;
    }
    .legend-color {
        width: 16px;
        height: 16px;
        border-radius: 4px;
        border: 2px solid rgba(0,0,0,0.1);
    }
    .legend-color.confirmada {
        background-color: #10b981;
    }
    .legend-color.pendiente {
        background-color: #f59e0b;
    }
    .legend-color.cancelada {
        background-color: #ef4444;
    }

    /* Estilos para los filtros de aulas */
    .aula-filter {
        accent-color: var(--primary-color);
    }
    
    .form-check-input:checked {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
    }
    
    .form-check-input:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.25rem rgba(217, 54, 144, 0.25);
    }
    
    .form-check-label {
        cursor: pointer;
        transition: color 0.2s ease;
    }
    
    .form-check-label:hover {
        color: var(--primary-color) !important;
    }
    
    .btn-outline-primary {
        border-color: var(--primary-color);
        color: var(--primary-color);
    }
    
    .btn-outline-primary:hover {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
        color: white;
    }
    
    .btn-primary {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
    }
    
    .btn-primary:hover {
        background-color: #c02d7a;
        border-color: #c02d7a;
    }
    
    .btn-outline-secondary {
        border-color: #6c757d;
        color: #6c757d;
    }
    
    .btn-outline-secondary:hover {
        background-color: #6c757d;
        border-color: #6c757d;
        color: white;
    }
    
    /* Animación para los filtros */
    .form-check {
        transition: transform 0.2s ease;
    }
    
    .form-check:hover {
        transform: translateX(5px);
    }
    
    /* Estilo para el contador de aulas seleccionadas */
    .aulas-counter {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        color: white;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        margin-left: 10px;
    }

    .calendar-container {
        background: white;
        border-radius: 16px;
        box-shadow: var(--shadow);
        overflow: hidden;
        border: 1px solid var(--border-color);
    }
    .calendar-wrapper {
        padding: 2rem;
    }
    
    /* Estilos del calendario */
    .fc {
        font-family: 'Inter', sans-serif;
    }
    .fc-header-toolbar {
        margin-bottom: 1.5rem !important;
        padding: 0 !important;
    }
    .fc-toolbar-title {
        font-size: 1.5rem !important;
        font-weight: 700 !important;
        color: var(--text-primary) !important;
    }
    .fc-button-primary {
        background-color: var(--primary-color) !important;
        border-color: var(--primary-color) !important;
        font-weight: 600 !important;
        border-radius: 8px !important;
        padding: 8px 16px !important;
        transition: var(--transition) !important;
    }
    .fc-button-primary:hover {
        background-color: #c2185b !important;
        border-color: #c2185b !important;
        transform: translateY(-2px) !important;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1) !important;
    }
    .fc-button-primary:disabled {
        background-color: #d1d5db !important;
        border-color: #d1d5db !important;
        transform: none !important;
        box-shadow: none !important;
    }
    .fc-daygrid-day {
        border: 1px solid var(--border-color) !important;
        transition: var(--transition) !important;
    }
    .fc-daygrid-day:hover {
        background-color: rgba(var(--primary-color-rgb, 217, 54, 144), 0.05) !important;
    }
    .fc-daygrid-day-number {
        color: var(--text-primary) !important;
        font-weight: 600 !important;
        padding: 8px !important;
    }
    .fc-day-today {
        background-color: rgba(var(--primary-color-rgb, 217, 54, 144), 0.1) !important;
    }
    .fc-day-today .fc-daygrid-day-number {
        color: var(--primary-color) !important;
        font-weight: 700 !important;
    }
    .fc-event {
        border-radius: 6px !important;
        border: none !important;
        padding: 2px 6px !important;
        font-size: 0.85rem !important;
        font-weight: 500 !important;
        cursor: pointer !important;
        transition: var(--transition) !important;
        margin: 1px 0 !important;
    }
    .fc-event:hover {
        transform: translateY(-1px) !important;
        box-shadow: 0 2px 8px rgba(0,0,0,0.15) !important;
    }
    .fc-event-title {
        font-weight: 600 !important;
    }
    .fc-daygrid-event-dot {
        display: none !important;
    }
    .fc-col-header-cell {
        background-color: var(--bg-light) !important;
        border: 1px solid var(--border-color) !important;
        font-weight: 600 !important;
        color: var(--text-secondary) !important;
        text-transform: uppercase !important;
        letter-spacing: 0.5px !important;
        font-size: 0.85rem !important;
        padding: 12px 8px !important;
    }

    /* Modal de detalles */
    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        display: none;
        justify-content: center;
        align-items: center;
        z-index: 1000;
        backdrop-filter: blur(4px);
    }
    .modal-content {
        background: white;
        border-radius: 16px;
        box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        max-width: 600px;
        width: 90%;
        max-height: 80vh;
        overflow-y: auto;
        animation: modalSlideIn 0.3s ease-out;
    }
    @keyframes modalSlideIn {
        from {
            opacity: 0;
            transform: translateY(-50px) scale(0.95);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }
    .modal-header {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        color: white;
        padding: 24px 32px;
        border-radius: 16px 16px 0 0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .modal-header h3 {
        margin: 0;
        font-size: 1.5rem;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .modal-close {
        background: none;
        border: none;
        color: white;
        font-size: 1.5rem;
        cursor: pointer;
        padding: 5px;
        border-radius: 50%;
        transition: var(--transition);
    }
    .modal-close:hover {
        background: rgba(255, 255, 255, 0.2);
    }
    .modal-body {
        padding: 32px;
    }
    .detail-section {
        margin-bottom: 24px;
    }
    .detail-section:last-child {
        margin-bottom: 0;
    }
    .detail-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--primary-color);
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .detail-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 16px;
    }
    .detail-item {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }
    .detail-label {
        font-size: 0.85rem;
        font-weight: 600;
        color: var(--text-secondary);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .detail-value {
        font-size: 1rem;
        color: var(--text-primary);
        font-weight: 500;
    }
    .detail-value.empty {
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
        width: fit-content;
    }
    .status-confirmada {
        background: rgba(16, 185, 129, 0.1);
        color: #10b981;
        border: 1px solid rgba(16, 185, 129, 0.2);
    }
    .status-pendiente {
        background: rgba(245, 158, 11, 0.1);
        color: #f59e0b;
        border: 1px solid rgba(245, 158, 11, 0.2);
    }
    .status-cancelada {
        background: rgba(239, 68, 68, 0.1);
        color: #ef4444;
        border: 1px solid rgba(239, 68, 68, 0.2);
    }
    .priority-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 12px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.85rem;
        width: fit-content;
    }
    .priority-baja {
        background: rgba(16, 185, 129, 0.1);
        color: #10b981;
        border: 1px solid rgba(16, 185, 129, 0.2);
    }
    .priority-media {
        background: rgba(245, 158, 11, 0.1);
        color: #f59e0b;
        border: 1px solid rgba(245, 158, 11, 0.2);
    }
    .priority-alta {
        background: rgba(239, 68, 68, 0.1);
        color: #ef4444;
        border: 1px solid rgba(239, 68, 68, 0.2);
    }
    .modal-actions {
        display: flex;
        gap: 12px;
        justify-content: flex-end;
        padding: 24px 32px;
        background: var(--bg-light);
        border-top: 1px solid var(--border-color);
        border-radius: 0 0 16px 16px;
    }
    .modal-actions .btn {
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 600;
        transition: var(--transition);
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.9rem;
    }
    .btn-primary {
        background: var(--primary-color);
        color: white;
        border: none;
    }
    .btn-primary:hover {
        background: #c2185b;
        color: white;
    }
    .btn-secondary {
        background: var(--text-secondary);
        color: white;
        border: none;
    }
    .btn-secondary:hover {
        background: #4b5563;
        color: white;
    }

    @media (max-width: 768px) {
        .calendar-header {
            flex-direction: column;
            align-items: flex-start;
            text-align: center;
        }
        .calendar-controls {
            width: 100%;
            justify-content: center;
        }
        .legend-items {
            justify-content: center;
        }
        .calendar-wrapper {
            padding: 1rem;
        }
        .modal-content {
            width: 95%;
            margin: 10px;
        }
        .modal-header, .modal-body, .modal-actions {
            padding: 20px;
        }
        .detail-grid {
            grid-template-columns: 1fr;
        }
        .modal-actions {
            flex-direction: column;
        }
    }
</style>
<link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.css' rel='stylesheet' />
@endsection

@section('content')
<div class="container-fluid">
    <!-- Header del Calendario -->
    <div class="calendar-header">
        <h1><i class="fas fa-calendar-alt"></i> Calendario de Reservas</h1>
        <div class="calendar-controls">
            <div class="calendar-actions">
                <a href="{{ route('reservas.create') }}" class="btn">
                    <i class="fas fa-plus-circle"></i> Nueva Reserva
                </a>
                <a href="{{ route('reservas.index') }}" class="btn">
                    <i class="fas fa-list"></i> Lista de Reservas
                </a>
            </div>
        </div>
    </div>

    <!-- Filtros de Aulas -->
    <div class="legend-card">
        <div class="legend-title">
            <i class="fas fa-filter"></i>
            Filtros de Aulas
            <span id="aulasCounter" class="aulas-counter">0 seleccionadas</span>
        </div>
        <form id="aulasFilterForm" method="GET" action="{{ route('calendario.index') }}">
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label class="form-label" style="font-weight: 600; color: var(--text-primary); margin-bottom: 15px; display: block;">Seleccionar Aulas:</label>
                        <div class="row">
                            @if($aulas && $aulas->count() > 0)
                                @foreach($aulas as $aula)
                                    <div class="col-md-4 col-sm-6 mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input aula-filter" 
                                                   type="checkbox" 
                                                   name="aulas[]" 
                                                   value="{{ $aula->id }}" 
                                                   id="aula_{{ $aula->id }}"
                                                   {{ in_array($aula->id, $selectedAulas) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="aula_{{ $aula->id }}" style="font-weight: 500; color: var(--text-primary); cursor: pointer;">
                                                {{ $aula->name }}
                                                @if($aula->capacity)
                                                    <small class="text-muted">({{ $aula->capacity }} plazas)</small>
                                                @endif
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="col-12">
                                    <p class="text-muted">No hay aulas disponibles para filtrar.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="d-flex flex-column gap-2">
                        <button type="button" class="btn btn-outline-primary btn-sm" onclick="selectAllAulas()">
                            <i class="fas fa-check-double me-1"></i> Seleccionar Todas
                        </button>
                        <button type="button" class="btn btn-outline-secondary btn-sm" onclick="clearAllAulas()">
                            <i class="fas fa-times me-1"></i> Limpiar Filtros
                        </button>
                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="fas fa-filter me-1"></i> Aplicar Filtros
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Leyenda -->
    <div class="legend-card">
        <div class="legend-title">
            <i class="fas fa-info-circle"></i>
            Leyenda de Estados
        </div>
        <div class="legend-items">
            <div class="legend-item">
                <div class="legend-color confirmada"></div>
                <span>Confirmada</span>
            </div>
            <div class="legend-item">
                <div class="legend-color pendiente"></div>
                <span>Pendiente</span>
            </div>
            <div class="legend-item">
                <div class="legend-color cancelada"></div>
                <span>Cancelada</span>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    <!-- Calendario -->
    <div class="calendar-container">
        <div class="calendar-wrapper">
            <div id="calendar"></div>
        </div>
    </div>
</div>

<!-- Modal de Detalles de Reserva -->
<div id="reservaModal" class="modal-overlay">
    <div class="modal-content">
        <div class="modal-header">
            <h3><i class="fas fa-calendar-check"></i> <span id="modalTitle">Detalles de la Reserva</span></h3>
            <button class="modal-close" onclick="closeModal()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <div class="detail-section">
                <div class="detail-title">
                    <i class="fas fa-info-circle"></i>
                    Información General
                </div>
                <div class="detail-grid">
                    <div class="detail-item">
                        <div class="detail-label">Solicitante</div>
                        <div class="detail-value" id="modalSolicitante">-</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Email de Contacto</div>
                        <div class="detail-value" id="modalEmail">-</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Estado</div>
                        <div class="detail-value" id="modalEstado">-</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Prioridad</div>
                        <div class="detail-value" id="modalPrioridad">-</div>
                    </div>
                </div>
            </div>

            <div class="detail-section">
                <div class="detail-title">
                    <i class="fas fa-clock"></i>
                    Fecha y Horario
                </div>
                <div class="detail-grid">
                    <div class="detail-item">
                        <div class="detail-label">Fecha de Inicio</div>
                        <div class="detail-value" id="modalFechaInicio">-</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Fecha de Fin</div>
                        <div class="detail-value" id="modalFechaFin">-</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Hora de Inicio</div>
                        <div class="detail-value" id="modalHoraInicio">-</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Hora de Fin</div>
                        <div class="detail-value" id="modalHoraFin">-</div>
                    </div>
                </div>
            </div>

            <div class="detail-section">
                <div class="detail-title">
                    <i class="fas fa-door-open"></i>
                    Aula y Asistentes
                </div>
                <div class="detail-grid">
                    <div class="detail-item">
                        <div class="detail-label">Aula Asignada</div>
                        <div class="detail-value" id="modalAula">-</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Número de Asistentes</div>
                        <div class="detail-value" id="modalAsistentes">-</div>
                    </div>
                </div>
            </div>

            <div class="detail-section">
                <div class="detail-title">
                    <i class="fas fa-align-left"></i>
                    Descripción
                </div>
                <div class="detail-value" id="modalDescripcion">-</div>
            </div>

            <div class="detail-section" id="equipamientoSection" style="display: none;">
                <div class="detail-title">
                    <i class="fas fa-tools"></i>
                    Equipamiento Requerido
                </div>
                <div class="detail-value" id="modalEquipamiento">-</div>
            </div>

            <div class="detail-section" id="observacionesSection" style="display: none;">
                <div class="detail-title">
                    <i class="fas fa-sticky-note"></i>
                    Observaciones
                </div>
                <div class="detail-value" id="modalObservaciones">-</div>
            </div>
        </div>
        <div class="modal-actions">
            <button class="btn btn-secondary" onclick="closeModal()">
                <i class="fas fa-times"></i> Cerrar
            </button>
            <a href="#" id="modalEditLink" class="btn btn-primary">
                <i class="fas fa-edit"></i> Editar Reserva
            </a>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/locales/es.global.min.js'></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const calendarEl = document.getElementById('calendar');
    let currentDate = new Date();

    const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'es',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,dayGridWeek'
        },
        buttonText: {
            today: 'Hoy',
            month: 'Mes',
            week: 'Semana'
        },
        height: 'auto',
        eventDisplay: 'block',
        dayMaxEvents: 3,
        moreLinkText: function(num) {
            return '+' + num + ' más';
        },
        events: function(fetchInfo, successCallback, failureCallback) {
            const year = fetchInfo.start.getFullYear();
            const month = fetchInfo.start.getMonth() + 1;
            
            fetch(`{{ route('calendario.api', ['year' => ':year', 'month' => ':month']) }}`.replace(':year', year).replace(':month', month))
                .then(response => response.json())
                .then(data => {
                    successCallback(data);
                })
                .catch(error => {
                    console.error('Error loading events:', error);
                    failureCallback(error);
                });
        },
        eventClick: function(info) {
            showReservaModal(info.event);
        },
        eventMouseEnter: function(info) {
            info.el.style.transform = 'translateY(-2px)';
            info.el.style.boxShadow = '0 4px 15px rgba(0,0,0,0.2)';
        },
        eventMouseLeave: function(info) {
            info.el.style.transform = 'translateY(0)';
            info.el.style.boxShadow = 'none';
        }
    });

    calendar.render();

    // Función para mostrar el modal con los detalles de la reserva
    function showReservaModal(event) {
        const props = event.extendedProps;
        
        document.getElementById('modalTitle').textContent = event.title;
        document.getElementById('modalSolicitante').textContent = props.solicitante || 'No especificado';
        document.getElementById('modalEmail').textContent = props.email_contacto || 'No especificado';
        document.getElementById('modalAula').textContent = props.aula || 'Sin aula';
        document.getElementById('modalAsistentes').textContent = props.numero_asistentes || 'No especificado';
        document.getElementById('modalDescripcion').textContent = props.descripcion || 'Sin descripción';
        
        // Fechas y horarios
        const startDate = new Date(event.start);
        const endDate = event.end ? new Date(event.end) : startDate;
        
        document.getElementById('modalFechaInicio').textContent = startDate.toLocaleDateString('es-ES');
        document.getElementById('modalFechaFin').textContent = endDate.toLocaleDateString('es-ES');
        document.getElementById('modalHoraInicio').textContent = startDate.toLocaleTimeString('es-ES', {hour: '2-digit', minute: '2-digit'});
        document.getElementById('modalHoraFin').textContent = endDate.toLocaleTimeString('es-ES', {hour: '2-digit', minute: '2-digit'});
        
        // Estado
        const estadoElement = document.getElementById('modalEstado');
        estadoElement.innerHTML = `<span class="status-badge status-${props.estado}">
            <i class="fas fa-${getStatusIcon(props.estado)}"></i> ${capitalizeFirst(props.estado)}
        </span>`;
        
        // Prioridad
        const prioridadElement = document.getElementById('modalPrioridad');
        prioridadElement.innerHTML = `<span class="priority-badge priority-${props.prioridad}">
            <i class="fas fa-${getPriorityIcon(props.prioridad)}"></i> ${capitalizeFirst(props.prioridad)}
        </span>`;
        
        // Equipamiento (mostrar solo si existe)
        const equipamientoSection = document.getElementById('equipamientoSection');
        if (props.equipamiento_requerido) {
            document.getElementById('modalEquipamiento').textContent = props.equipamiento_requerido;
            equipamientoSection.style.display = 'block';
        } else {
            equipamientoSection.style.display = 'none';
        }
        
        // Observaciones (mostrar solo si existe)
        const observacionesSection = document.getElementById('observacionesSection');
        if (props.observaciones) {
            document.getElementById('modalObservaciones').textContent = props.observaciones;
            observacionesSection.style.display = 'block';
        } else {
            observacionesSection.style.display = 'none';
        }
        
        // Link de edición
        document.getElementById('modalEditLink').href = `{{ route('reservas.edit', ':id') }}`.replace(':id', props.reserva_id);
        
        // Mostrar modal
        document.getElementById('reservaModal').style.display = 'flex';
    }

    // Funciones auxiliares
    function getStatusIcon(estado) {
        switch(estado) {
            case 'confirmada': return 'check-circle';
            case 'pendiente': return 'clock';
            case 'cancelada': return 'times-circle';
            default: return 'question-circle';
        }
    }

    function getPriorityIcon(prioridad) {
        switch(prioridad) {
            case 'alta': return 'arrow-up';
            case 'media': return 'minus';
            case 'baja': return 'arrow-down';
            default: return 'minus';
        }
    }

    function capitalizeFirst(str) {
        return str.charAt(0).toUpperCase() + str.slice(1);
    }

    // Hacer la función global para que pueda ser llamada desde el HTML
    window.showReservaModal = showReservaModal;
});

// Función para cerrar el modal
function closeModal() {
    document.getElementById('reservaModal').style.display = 'none';
}

// Cerrar modal al hacer clic fuera de él
document.getElementById('reservaModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeModal();
    }
});

// Cerrar modal con la tecla Escape
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeModal();
    }
});

// Funciones para manejar filtros de aulas
function selectAllAulas() {
    const checkboxes = document.querySelectorAll('.aula-filter');
    checkboxes.forEach(checkbox => {
        checkbox.checked = true;
    });
    updateAulasCounter();
}

function clearAllAulas() {
    const checkboxes = document.querySelectorAll('.aula-filter');
    checkboxes.forEach(checkbox => {
        checkbox.checked = false;
    });
    updateAulasCounter();
}

function updateAulasCounter() {
    const checkedBoxes = document.querySelectorAll('.aula-filter:checked');
    const counter = document.getElementById('aulasCounter');
    const count = checkedBoxes.length;
    
    if (count === 0) {
        counter.textContent = '0 seleccionadas';
        counter.style.background = '#6c757d';
    } else if (count === document.querySelectorAll('.aula-filter').length) {
        counter.textContent = 'Todas seleccionadas';
        counter.style.background = 'linear-gradient(135deg, #10b981 0%, #059669 100%)';
    } else {
        counter.textContent = `${count} seleccionada${count > 1 ? 's' : ''}`;
        counter.style.background = 'linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%)';
    }
}

// Inicializar contador y eventos cuando se carga la página
document.addEventListener('DOMContentLoaded', function() {
    const checkboxes = document.querySelectorAll('.aula-filter');
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            updateAulasCounter();
        });
    });
    
    // Inicializar contador
    updateAulasCounter();
});
</script>
@endsection
