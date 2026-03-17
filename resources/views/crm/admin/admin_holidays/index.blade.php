@extends('crm.layouts.app')

@section('titulo', 'Administrar Vacaciones')

@section('content')
    <div class="page-heading card" style="box-shadow: none !important">
        <div class="page-title card-body">
            <div class="row justify-content-between">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3><i class="fa-solid fa-umbrella-beach"></i> Administrar Vacaciones</h3>
                    <p class="text-subtitle text-muted">Gestión de días de vacaciones por usuario</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Admin Vacaciones</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="card-title mb-0">Usuarios y días de vacaciones</h5>
                        <a href="{{ route('holiday.admin.create') }}" class="btn btn-primary btn-sm">
                            <i class="fa-solid fa-plus"></i> Asignar días
                        </a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Usuario</th>
                                    <th>Días</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($holidays as $h)
                                    <tr>
                                        <td>{{ $h->adminUser->name ?? 'N/A' }}</td>
                                        <td>{{ $h->quantity ?? 0 }}</td>
                                        <td>
                                            <a href="{{ route('holiday.admin.edit', $h->id) }}" class="btn btn-sm btn-outline-primary">Editar</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="3" class="text-center text-muted">No hay registros</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
