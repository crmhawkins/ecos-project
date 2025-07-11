@section('css')
<link rel="stylesheet" href="{{asset('assets/vendors/choices.js/choices.min.css')}}" />
@endsection

<div>
    <div class="filtros row mb-4">
        <div class="col-md-6 col-sm-12">
            <div class="flex flex-row justify-start">
                <div class="mr-3">
                    <label for="">Nº</label>
                    <select wire:change="aplicarFiltro()" wire:model="perPage" class="form-select">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
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
        <div class="col-md-6 col-sm-12">
            <div class="flex flex-row justify-end">
                <div class="mr-3" style="width: 100px">
                    <label for="">Banco</label>
                    <select wire:change="aplicarFiltro()" wire:model="selectedBanco" class="form-select">
                        <option value=""> Banco </option>
                        @foreach ($Bancos as $banco)
                            <option value="{{ $banco->id }}">{{ $banco->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mr-3" style="width: 150px">
                    <label for="">Fecha inicio</label>
                    <input wire:model="startDate" type="date" class="form-control" placeholder="Fecha de inicio">
                </div>
                <div class="mr-3" style="width: 150px">
                    <label for="">Fecha fin</label>
                    <input wire:model="endDate" type="date" class="form-control" placeholder="Fecha de fin">
                </div>
                <div class="mr-3" style="width: 100px">
                    <label for="">Año</label>
                    <select wire:change="aplicarFiltro()" wire:model="selectedYear" class="form-select">
                        <option value=""> Año </option>
                        @for ($year = date('Y'); $year >= 2000; $year--)
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endfor
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="flex flex-row justify-end">
        <button wire:click="exportToExcel" class="btn btn-success mx-2">
            Descargar Excel
        </button>
    </div>
    @if ($gastos->count())
        <div class="table-responsive">
             <table class="table table-hover">
                <thead class="header-table">
                    <tr>
                        @foreach ([
                            'bank_id' => 'BANCO',
                            'title' => 'TITULO',
                            'quantity' => 'CANTIDAD',
                            'iva_amount' => 'IVA',
                            'total_with_iva' => 'TOTAL',
                            'received_date' => 'F.RECEPCION',
                            'date' => 'F.PAGO',
                            'state' => 'ESTADO',
                            'categoria_id' => 'CATEGORIA',
                            'transfer_movement' => 'TRAN',


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
                        <th class="" style="font-size:0.75rem">DOCUMENTO</th>
                        <th class="text-center" style="font-size:0.75rem">ACCIONES</th>
                </thead>
                <tbody>
                    @foreach ($gastos as $gasto)
                        <tr class="clickable-row" data-href="{{route('gasto.edit', $gasto->id)}}">
                            <td>{{$gasto->bankAccount->name ?? 'Banco no asignado'}}</td>
                            <td>{{$gasto->title}}</td>
                            <td>{{ number_format($gasto->quantity, 2) }}€</td>
                            <td>{{ number_format($gasto->iva_amount, 2) }}€</td>
                            <td>{{ number_format($gasto->total_with_iva, 2) }}€</td>
                            <td>{{ $gasto->received_date ? \Carbon\Carbon::parse($gasto->received_date)->format('d/m/Y') : 'Sin Fecha'}}</td>
                            <td>{{ \Carbon\Carbon::parse($gasto->date)->format('d/m/Y') }}</td>
                            <td>{{$gasto->state}}</td>
                            <td>{{optional($gasto->categoria)->nombre ?? 'Sin categoria asignada'}}</td>
                            <td>
                                @if($gasto->transfer_movement == 1)
                                <i class="fa-solid fa-check"></i>
                                @endif

                            </td>
                            <td>
                                @if (isset($gasto->documents))
                                @php
                                try {
                                    // Intentar verificar si el archivo existe en el disco 'public'
                                    $exists = Storage::disk('public')->exists($gasto->documents);

                                    if ($exists) {
                                        // Si el archivo existe, muestra el enlace
                                        echo "<a href='" . asset('storage/' . $gasto->documents) . "' target='_blank'>Ver</a>";
                                    }
                                } catch (\Exception $e) {
                                    // Si hay un error (por ejemplo, ruta corrupta), no hacer nada
                                    // Loguear el error si es necesario
                                    Log::error("Error checking file existence: " . $e->getMessage());
                                }
                                @endphp
                            @endif
                            </td>
                            <td class="flex flex-row justify-evenly align-middle" style="min-width: 120px">
                                <a class="" href="{{route('gasto.edit', $gasto->id)}}"><img src="{{asset('assets/icons/edit.svg')}}" alt="Editar gasto"></a>
                                <a class="delete" data-id="{{$gasto->id}}" href=""><img src="{{asset('assets/icons/trash.svg')}}" alt="Eliminar gasto"></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="1"></td>
                        <th>Sumatorio:</th>
                        <td>{{number_format((float)$gastos->sum('quantity'), 2, '.', '') }}€</td>
                        <td>{{number_format((float)$gastos->sum('iva_amount'), 2, '.', '') }}€</td>
                        <td>{{number_format((float)$gastos->sum('total_with_iva'), 2, '.', '') }}€</td>
                    </tr>
                </tfoot>
            </table>
            @if($perPage !== 'all')
                {{ $gastos->links() }}
            @endif
        </div>
    @else
        <div class="text-center py-4">
            <h3 class="text-center fs-3">No se encontraron registros de <strong>Gastos</strong></h3>
        </div>
    @endif
</div>

@section('scripts')
    @include('crm.partials.toast')
    <script src="{{asset('assets/vendors/choices.js/choices.min.js')}}"></script>
    <script>
        $(document).ready(() => {
            $('.delete').on('click', function(e) {
                e.preventDefault();
                let id = $(this).data('id');
                botonAceptar(id);
            });
        });

        function botonAceptar(id){
            Swal.fire({
                title: "¿Estas seguro que quieres eliminar este gasto?",
                html: "<p>Esta acción es irreversible.</p>",
                showDenyButton: false,
                showCancelButton: true,
                confirmButtonText: "Borrar",
                cancelButtonText: "Cancelar",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.when(getDelete(id)).then(function(data, textStatus, jqXHR) {
                        if (!data.status) {
                            Toast.fire({
                                icon: "error",
                                title: data.mensaje
                            });
                        } else {
                            Toast.fire({
                                icon: "success",
                                title: data.mensaje
                            }).then(() => {
                                location.reload();
                            });
                        }
                    });
                }
            });
        }

        function getDelete(id) {
            const url = '{{route("gasto.delete")}}';
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
