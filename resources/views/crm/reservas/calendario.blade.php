@extends('crm.layouts.app')

@section('titulo', 'Calendario Mensual')

@section('css')
@endsection

@section('content')

    <div class="page-heading card" style="box-shadow: none !important">

        {{-- Título --}}
        <div class="page-title card-body">
            <div class="row justify-content-between">
                <div class="col-12 col-md-4 order-md-1 order-last">
                    <h3><i class="bi bi-calendar-event"></i> Calendario Mensual</h3>
                    <p class="text-subtitle text-muted">Visualización de cursos por día</p>
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
        </div>

        <section class="section pt-4">
            <div class="card">
                <div class="card-body">
                    <div id="calendar"></div>
                </div>
            </div>
        </section>

    </div>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.17/index.global.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const calendarEl = document.getElementById('calendar');

            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                weekends: false,
                locale: 'es',
                height: 700,
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'timeGridDay,timeGridWeek,dayGridMonth'
                },
                events: '/crm/api/eventos',
                editable: true,
                buttonText: {
                    today:    'Hoy',
                    month:    'Mes',
                    week:     'Semana',
                    day:      'Día',
                    list:     'Lista'
                },
                dayHeaders: true,
                dayHeaderFormat: { weekday: 'long' }, // muestra "lunes", "martes", etc.
                eventDrop: function(info) {
                    const evento = info.event;

                    fetch('/crm/api/evento-actualizar', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            id: evento.id,
                            fecha: evento.startStr.split('T')[0],
                            hora_inicio: evento.startStr.split('T')[1],
                            hora_fin: evento.endStr.split('T')[1]
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (!data.success) {
                            info.revert(); // Revertir si falla
                            alert('Error al mover el evento');
                        }
                    }).catch(() => {
                        info.revert();
                        alert('Error de red');
                    });
                },
            });

            calendar.render();
        });
    </script>
@endsection
