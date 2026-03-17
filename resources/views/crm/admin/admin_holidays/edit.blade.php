@extends('crm.layouts.app')

@section('titulo', 'Editar Vacaciones')

@section('content')
    <div class="page-heading card" style="box-shadow: none !important">
        <div class="page-title card-body">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3><i class="fa-solid fa-umbrella-beach"></i> Editar días de vacaciones</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('holiday.admin.index') }}">Admin Vacaciones</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Editar</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('holiday.admin.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="holiday" value="{{ $holiday->id }}">
                        <div class="mb-3">
                            <label for="quantity" class="form-label">Días a añadir</label>
                            <input type="number" step="0.01" name="quantity" id="quantity" class="form-control" value="0" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                        <a href="{{ route('holiday.admin.index') }}" class="btn btn-secondary">Volver</a>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
