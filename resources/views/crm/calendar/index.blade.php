@extends('crm.layouts.app')

@section('titulo', 'Calendario')

@section('css')
<link rel="stylesheet" href="{{asset('assets/vendors/simple-datatables/style.css')}}">
<style>
    /* Estilos para los filtros de aulas */
    .aula-filter {
        accent-color: #D93690;
    }
    
    .form-check-input:checked {
        background-color: #D93690;
        border-color: #D93690;
    }
    
    .form-check-input:focus {
        border-color: #D93690;
        box-shadow: 0 0 0 0.25rem rgba(217, 54, 144, 0.25);
    }
    
    .form-check-label {
        cursor: pointer;
        transition: color 0.2s ease;
    }
    
    .form-check-label:hover {
        color: #D93690 !important;
    }
    
    .btn-outline-primary {
        border-color: #D93690;
        color: #D93690;
    }
    
    .btn-outline-primary:hover {
        background-color: #D93690;
        border-color: #D93690;
        color: white;
    }
    
    .btn-primary {
        background-color: #D93690;
        border-color: #D93690;
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
        background: linear-gradient(135deg, #D93690 0%, #667eea 100%);
        color: white;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        margin-left: 10px;
    }
</style>
@endsection

@section('content')
<div class="page-heading card" style="box-shadow: none !important" >

    {{-- Titulos --}}
    <div class="page-title card-body">
        <div class="row justify-content-between">
            <div class="col-12 col-md-4 order-md-1 order-last">
                <h3><i class="bi bi-diagram-2"></i> Calendario</h3>
                <p class="text-subtitle text-muted">Google Calendar</p>
                {{-- {{$campanias->count()}} --}}
            </div>
            <div class="col-12 col-md-4 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Calendario</li>
                    </ol>
                </nav>

            </div>
        </div>
        {{-- <div class="row mt-3">
            <div class="col-12 col-md-4 order-md-1 order-last">
                @if($campanias->count() >= 0)
                    <a href="{{route('campania.create')}}" class="btn btn-primary"><i class="fa-solid fa-plus me-2 mx-auto"></i>  Crear campaña</a>
                @endif
            </div>
        </div> --}}
    </div>

    <section class="section pt-4">
        <div class="card">
            <div class="card-body">
                <!-- Filtros de Aulas -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card" style="background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%); border: 1px solid #e2e8f0;">
                            <div class="card-body">
                                <h5 class="card-title mb-3" style="color: #2d3748; font-weight: 600;">
                                    <i class="fas fa-filter me-2" style="color: #D93690;"></i>
                                    Filtros de Aulas
                                    <span id="aulasCounter" class="aulas-counter">0 seleccionadas</span>
                                </h5>
                                <form id="aulasFilterForm" method="GET" action="{{ route('calendar.index') }}">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label class="form-label" style="font-weight: 600; color: #2d3748;">Seleccionar Aulas:</label>
                                                <div class="row">
                                                    @foreach($aulas as $aula)
                                                        <div class="col-md-4 col-sm-6 mb-2">
                                                            <div class="form-check">
                                                                <input class="form-check-input aula-filter" 
                                                                       type="checkbox" 
                                                                       name="aulas[]" 
                                                                       value="{{ $aula->id }}" 
                                                                       id="aula_{{ $aula->id }}"
                                                                       {{ in_array($aula->id, $selectedAulas) ? 'checked' : '' }}>
                                                                <label class="form-check-label" for="aula_{{ $aula->id }}" style="font-weight: 500; color: #2d3748;">
                                                                    {{ $aula->name }}
                                                                    @if($aula->capacity)
                                                                        <small class="text-muted">({{ $aula->capacity }} plazas)</small>
                                                                    @endif
                                                                </label>
                                                            </div>
                                                        </div>
                                                    @endforeach
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
                        </div>
                    </div>
                </div>

                <div class="d-flex space-around justify-content-between">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#calendarFeedModal">
                        Añadir Google Calendar
                    </button>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#calendarApiModal">
                        Api Key
                    </button>
                </div>

                <div id="calendar" class="p-4" style="min-height: 600px; margin-top: 0.75rem; margin-bottom: 0.75rem; overflow-y: auto; border-color:black; border-width: thin; border-radius: 20px;" >
                    <!-- Aquí se renderizarán las tareas según la vista seleccionada -->
                </div>
                <div class="list-group mt-3">
                    @foreach($feed as $f)
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            Google Calendar ID: {{ $f['googleCalendarId'] }}
                            <span>
                                <button type="button" class="btn btn-danger btn-sm" onclick="deleteFeed('{{ $f['id'] }}')">Eliminar</button>
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- Modal para añadir feed de calendario -->
    <div class="modal fade" id="calendarFeedModal" tabindex="-1" aria-labelledby="calendarFeedModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="calendarFeedModalLabel">Añadir api de Calendario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="feedForm" method="POST" action="{{ route('calendar.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="googleCalendarId" class="form-label">Google Calendar ID</label>
                            <input type="text" class="form-control" id="googleCalendarId" name="googleCalendarId" required>
                        </div>
                        <div class="mb-3">
                            <label for="color" class="form-label">Color del Evento</label>
                            <input type="color" class="form-control p-0" id="color" name="color" value="#377dff">
                        </div>
                        <div class="mb-3">
                            <label for="textColor" class="form-label">Color del Texto</label>
                            <input type="color" class="form-control p-0" id="textColor" name="textColor" value="#ffffff">
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar Feed</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="calendarApiModal" tabindex="-1" aria-labelledby="calendarApiModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="calendarApiModalLabel">Añadir api de Google</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="feedForm" method="POST" action="{{ route('api.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="api_key" class="form-label">Api Key Google</label>
                            <input type="text" class="form-control" id="api_key" name="api_key" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar Api</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/google-calendar@6.1.15/index.global.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.15/locales-all.global.min.js"></script>
    @include('crm.partials.toast')
    <script>
        var feed = @json($feed);
        var api = @json($api);

        console.log(feed);
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var tooltip = document.getElementById('tooltip');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                googleCalendarApiKey: api.api_key,
                initialView: 'dayGridMonth',
                locale: 'es',
                navLinks: true,
                nowIndicator: true,
                businessHours: [
                    { daysOfWeek: [1], startTime: '08:00', endTime: '15:00' },
                    { daysOfWeek: [2], startTime: '08:00', endTime: '15:00' },
                    { daysOfWeek: [3], startTime: '08:00', endTime: '15:00' },
                    { daysOfWeek: [4], startTime: '08:00', endTime: '15:00' },
                    { daysOfWeek: [5], startTime: '08:00', endTime: '15:00' }
                ],
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridDay,listWeek'
                },
                eventSources:feed,


        });
            calendar.render();
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
                counter.style.background = 'linear-gradient(135deg, #D93690 0%, #667eea 100%)';
            }
        }

        // Aplicar filtros automáticamente cuando cambien los checkboxes
        document.addEventListener('DOMContentLoaded', function() {
            const checkboxes = document.querySelectorAll('.aula-filter');
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    updateAulasCounter();
                    // Opcional: aplicar filtros automáticamente sin recargar la página
                    // applyAulasFilter();
                });
            });
            
            // Inicializar contador
            updateAulasCounter();
        });

        // Función para aplicar filtros dinámicamente (opcional)
        function applyAulasFilter() {
            const selectedAulas = Array.from(document.querySelectorAll('.aula-filter:checked'))
                .map(checkbox => checkbox.value);
            
            // Aquí podrías filtrar los eventos del calendario dinámicamente
            // sin recargar la página, pero por simplicidad usamos el formulario
            document.getElementById('aulasFilterForm').submit();
        }

        function deleteFeed(id) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/calendar-feeds/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json'
                        }
                    }).then(response => {
                        if (response.ok) {
                            Swal.fire(
                                '¡Eliminado!',
                                'El feed ha sido eliminado.',
                                'success'
                            ).then(() => {
                                window.location.reload();
                            });
                        } else {
                            Swal.fire(
                                'Error!',
                                'Algo salió mal al intentar eliminar el feed.',
                                'error'
                            );
                        }
                    }).catch(error => {
                        console.error('Error:', error);
                        Swal.fire(
                            'Error!',
                            'Algo salió mal al intentar eliminar el feed.',
                            'error'
                        );
                    });
                }
            })
        }
</script>
@endsection

