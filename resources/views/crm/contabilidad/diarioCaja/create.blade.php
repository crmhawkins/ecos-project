@extends('crm.layouts.app')

@section('titulo', 'Agregar Ingreso')

@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
<style>
    .inactive-sort {
        color: #0F1739;
        text-decoration: none;
    }
    .active-sort {
        color: #757191;
    }
    .page-heading {
        box-shadow: none !important;
    }
    .breadcrumb-header {
        float: right;
    }
    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }
</style>
@endsection

@section('content')
<div class="page-heading card">
    <div class="card-body">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Agregar Ingreso</h3>
                <p class="text-subtitle text-muted">Formulario para registrar un nuevo ingreso</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Agregar Ingreso</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section pt-4">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('diarioCaja.store') }}" class="row" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="col-lg col-md-12">
                        <div class="form-group mb-3">
                            <label for="asientoContable">Asiento Contable</label>
                            <input type="text" class="form-control" id="asientoContable" name="asientoContable" value="{{$numeroAsiento}}" disabled>
                            <input type="hidden" name="asiento_contable" value="{{$numeroAsiento}}">
                        </div>

                        <div class="form-group mb-3">
                            <label for="cuenta_id">Cuenta Contable</label>
                            <select name="cuenta_id" id="cuenta_id" class="select2 form-control {{ $errors->has('cuenta_id') ? 'is-invalid' : '' }}">
                                <option value="">-- Seleccione Cuenta Contable --</option>
                                @foreach($response as $grupos)
                                    @foreach($grupos as $itemGroup)
                                        <option value="">- {{$itemGroup['grupo']->numero .'. '. $itemGroup['grupo']->nombre}} -</option>
                                        @foreach($itemGroup['subGrupo'] as $subGrupo)
                                            <option value="">-- {{ $subGrupo['item']->numero .'. '. $subGrupo['item']->nombre}} --</option>
                                            @foreach($subGrupo['cuentas'] as $cuentas)
                                                <option value="{{$cuentas['item']->numero}}">--- {{ $cuentas['item']->numero .'. '. $cuentas['item']->nombre}} ---</option>
                                                @if(count($cuentas['subCuentas']) > 0)
                                                    @foreach($cuentas['subCuentas'] as $subCuentas)
                                                        <option value="{{$subCuentas['item']->numero}}">---- {{ $subCuentas['item']->numero .'. '. $subCuentas['item']->nombre}} ----</option>
                                                        @if(count($subCuentas['subCuentasHija']) > 0)
                                                            @foreach($subCuentas['subCuentasHija'] as $subCuentasHijas)
                                                                <option value="{{$subCuentasHijas->numero}}">---- {{ $subCuentasHijas->numero .'. '. $subCuentasHijas->nombre}} ----</option>
                                                            @endforeach
                                                        @endif
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        @endforeach
                                    @endforeach
                                @endforeach
                            </select>
                            @error('cuenta_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="estado_id">Estado</label>
                            <select name="estado_id" id="estado_id" class="select2 form-control {{ $errors->has('estado_id') ? 'is-invalid' : '' }}">
                                <option value="">-- Seleccione Estado --</option>
                                @foreach ($estados as $estado)
                                    <option value="{{$estado->id}}">{{$estado->nombre}}</option>
                                @endforeach
                            </select>
                            @error('estado_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="ingreso_id">Ingreso</label>
                            <select name="ingreso_id" id="ingreso_id" class="select2_ingresos form-control {{ $errors->has('ingreso_id') ? 'is-invalid' : '' }}">
                                <option value="">-- Seleccione Ingreso Asociado --</option>
                                @foreach ($ingresos as $ingreso)
                                    <option value="{{$ingreso->id}}">{{$ingreso->title}}</option>
                                @endforeach
                            </select>
                            @error('ingreso_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="date">Fecha</label>
                            <input type="date" class="form-control {{ $errors->has('date') ? 'is-invalid' : '' }}" id="date" name="date">
                            @error('date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="concepto">Concepto</label>
                            <input type="text" class="form-control {{ $errors->has('concepto') ? 'is-invalid' : '' }}" id="concepto" name="concepto">
                            @error('concepto')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="haber">Importe</label>
                            <input type="number" class="form-control {{ $errors->has('haber') ? 'is-invalid' : '' }}" id="haber" name="haber" step="any">
                            @error('haber')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2();
        $('.select2_ingresos').select2();
    });
</script>
@endsection
