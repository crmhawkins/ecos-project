<div>
    {{-- Filtros --}}
    <div class="filtros row mb-4">
        <div class="col-md-6">
            <div class="flex flex-row justify-start">
                <div class="mr-3">
                    <label for="">Nº</label>
                    <select wire:change="aplicarFiltro()" wire:model="perPage" class="form-select">
                        <option value="10">10 por página</option>
                        <option value="25">25 por página</option>
                        <option value="15">50 por página</option>
                        <option value="all">Todo</option>
                    </select>
                </div>
                <div class="w-75">
                    <label for="">Buscar</label>
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
                        id="inputBuscar"
                        class="form-control w-100"
                        placeholder="Escriba la palabra a buscar..."
                    >                 </div>
            </div>
        </div>


    @if ( $servicios )

        {{-- Tabla --}}
        <div class="table-responsive">
             <table class="table table-hover">
                <thead class="header-table">
                    <tr>
                        @foreach ([
                            'curso' => 'CURSO',
                            'profesor' => 'PROFESOR',
                            'fecha_inicio' => 'FECHA DE INICIO',
                            'estado' => 'ESTADO',
                        ] as $field => $label)
                            <th class="px-3" style="font-size:0.75rem">
                                <a href="#" wire:click.prevent="sortBy('{{ $field }}')">
                                    {{ $label }}
                                    @if ($sortColumn == $field)
                                        <span>{!! $sortDirection == 'asc' ? '&#9650;' : '&#9660;' !!}</span>
                                    @endif
                                </a>
                            </th>
                        @endforeach
                        <th class="text-center" style="font-size:0.75rem">ACCIONES</th>
                </thead>
                <tbody>
                    {{-- Recorremos los servicios --}}
                    @foreach ( $servicios as $servicio )
                        <tr class="clickable-row" data-href="{{route('reservas.edit', $servicio->id)}}">
                            <td class="px-3">{{$servicio->curso}}</td>
                            <td class="px-3">{{$servicio->profesor}}</td>
                            <td class="px-3">{{$servicio->fecha_inicio}}</td>
                            <td class="px-3"><span class="badge {{ $servicio->estado == 'pendiente' ? 'text-bg-secondary' : ($servicio->estado == 'aceptada' ? 'text-bg-success' : ($servicio->estado == 'rechazada' ? 'text-bg-danger' : 'text-bg-secondary')) }}">{{ucfirst($servicio->estado)}}</span></td>
                            <td class="flex flex-row justify-evenly align-middle" style="min-width: 120px">
                                <button class="btn btn-secondary" wire:click="verDetalle({{ $servicio->id }})">Ver Detalles</button>
                                @if ($servicio->estado != 'aceptada')
                                <a class="btn btn-success" href="{{route('reservas.asignarVista', $servicio->id)}}">Aceptar</a>
                                @endif
                                <button class="btn btn-danger" wire:click="rechazarReserva({{ $servicio->id }})">Rechazar</button>
                                <button class="btn btn-warning" wire:click="Observaciones({{ $servicio->id }})">Observaciones</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- Si los servicios vienen vacio --}}
            @if( count($servicios) == 0 )
                <div class="text-center py-4">
                    <h3 class="text-center fs-3">No se encontraron registros de <strong>Aulas</strong></h3>
                </div>
            @endif

            {{-- Paginacion --}}
            @if($perPage !== 'all')
                {{ $servicios->links() }}
            @endif
        </div>
    @else
        <div class="text-center py-4">
            <h3 class="text-center fs-3">No se encontraron registros de <strong>Aulas</strong></h3>
        </div>
    @endif
    {{-- {{$users}} --}}
    <!-- Modal Detalle -->
<div wire:ignore.self class="modal fade" id="detalleReservaModal" tabindex="-1" aria-labelledby="detalleReservaLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Detalles de la Reserva</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body">
        @if ($reservaSeleccionada)
        <table class="table table-bordered">
          <tr><th>Nombre Curso</th><td>{{ $reservaSeleccionada->curso }}</td></tr>
          <tr><th>Nombre Profesor</th><td>{{ $reservaSeleccionada->profesor }}</td></tr>
          <tr><th>Datos Profesor</th><td>{{ $reservaSeleccionada->contacto_profesor }}</td></tr>
          <tr><th>Horario</th><td> {{ $this->traducirDiasFormateados($reservaSeleccionada->dias) }} de {{ $reservaSeleccionada->hora_inicio }} - {{ $reservaSeleccionada->hora_fin }} </td></tr>
          <tr><th>Fecha Inicio</th><td>{{ $reservaSeleccionada->fecha_inicio }}</td></tr>
          <tr><th>Fecha Fin</th><td>{{ $reservaSeleccionada->fecha_fin }}</td></tr>
          <tr><th>Numero Alumno</th><td>{{ $reservaSeleccionada->alumnos }}</td></tr>
          <tr><th>Aula Infor</th><td>{{ $reservaSeleccionada->informatica ? 'sí' : 'no' }}</td></tr>
          <tr><th>Aula Homologada</th><td>{{ $reservaSeleccionada->homologada ? 'sí' : 'no' }}</td></tr>
          <tr><th>Notas</th><td>{{ $reservaSeleccionada->observaciones }}</td></tr>
          <tr><th>Contacto Solicitante</th><td>{{ $reservaSeleccionada->contacto_profesor }}</td></tr>
        </table>
        @endif
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<div wire:ignore.self class="modal fade" id="ModalObservaciones" tabindex="-1" aria-labelledby="ModalObservaciones" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Observaciones</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
            @if ($reservaSeleccionada)
            <textarea class="form-control" name="observaciones" id="observaciones" cols="30" rows="10" wire:model="observaciones"></textarea>
            @endif
            </div>
            <div class="modal-footer">
            @if ($reservaSeleccionada)
                <button type="button" class="btn btn-primary" wire:click="guardarObservaciones({{ $reservaSeleccionada->id }}) " data-bs-dismiss="modal">Guardar</button>
            @endif
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
</div>
@section('scripts')


    @include('crm.partials.toast')

<script>
    window.addEventListener('mostrarModalDetalle', () => {
        console.log('Evento recibido desde Livewire 3');
        const modal = new bootstrap.Modal(document.getElementById('detalleReservaModal'));
        modal.show();
    });
    window.addEventListener('mostrarModalObservaciones', () => {
        const modal = new bootstrap.Modal(document.getElementById('ModalObservaciones'));
        modal.show();
    });

</script>
@endsection
