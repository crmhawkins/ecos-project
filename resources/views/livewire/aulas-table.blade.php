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
                    >
               </div>
            </div>
        </div>


    @if ( $servicios )

        {{-- Tabla --}}
        <div class="table-responsive">
             <table class="table table-hover">
                <thead class="header-table">
                    <tr>
                        @foreach ([
                            'name' => 'NOMBRE',
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
                        <tr class="clickable-row" data-href="{{route('aulas.edit', $servicio->id)}}">
                            <td class="px-3">{{$servicio->name}}</td>
                            <td class="flex flex-row justify-evenly align-middle" style="min-width: 120px">
                                <a class="" href="{{route('aulas.edit', $servicio->id)}}"><img src="{{asset('assets/icons/edit.svg')}}" alt="Editar curso"></a>
                                <a class="delete" data-id="{{$servicio->id}}" href=""><img src="{{asset('assets/icons/trash.svg')}}" alt="Eliminar curso"></a>
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
</div>
@section('scripts')


    @include('crm.partials.toast')

    <script>
        $(document).ready(() => {
            $('.delete').on('click', function(e) {
                e.preventDefault();
                let id = $(this).data('id'); // Usa $(this) para obtener el atributo data-id
                botonAceptar(id);
            });
        });

        function botonAceptar(id){
            // Salta la alerta para confirmar la eliminacion
            Swal.fire({
                title: "¿Estas seguro que quieres eliminar este aula?",
                html: "<p>Esta acción es irreversible.</p>", // Corrige aquí
                showDenyButton: false,
                showCancelButton: true,
                confirmButtonText: "Borrar",
                cancelButtonText: "Cancelar",
                // denyButtonText: `No Borrar`
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    // Llamamos a la funcion para borrar el usuario
                    $.when( getDelete(id) ).then(function( data, textStatus, jqXHR ) {
                        if (data.error) {
                            // Si recibimos algun error
                            Toast.fire({
                                icon: "error",
                                title: data.mensaje
                            })
                        } else {
                            // Todo a ido bien
                            Toast.fire({
                                icon: "success",
                                title: data.mensaje
                            })
                            .then(() => {
                                location.reload()
                            })
                        }
                    });
                }
            });
        }
        function getDelete(id) {
            // Ruta de la peticion
            const url = '{{route("aulas.delete")}}'
            // Peticion
            return $.ajax({
                type: "POST",
                url: url,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                data: {
                    'id': id,
                },
                dataType: "json"
            });
        }
    </script>

@endsection
