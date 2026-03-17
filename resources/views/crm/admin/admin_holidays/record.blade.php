@extends('crm.layouts.app')

@section('titulo', 'Historial de asignaciones')

@section('content')
    <div class="page-heading card" style="box-shadow: none !important">
        <div class="page-title card-body">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3><i class="fa-solid fa-history"></i> Historial de asignaciones de vacaciones</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('holiday.admin.index') }}">Admin Vacaciones</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Historial</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Usuario</th>
                                    <th>Antes</th>
                                    <th>Añadido</th>
                                    <th>Ahora</th>
                                    <th>Fecha</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($holidaysAdditions as $r)
                                    <tr>
                                        <td>{{ $r->admin_user_id }}</td>
                                        <td>{{ $r->quantity_before ?? '-' }}</td>
                                        <td>{{ $r->quantity_to_add ?? '-' }}</td>
                                        <td>{{ $r->quantity_now ?? '-' }}</td>
                                        <td>{{ $r->created_at?->format('d/m/Y H:i') ?? '-' }}</td>
                                    </tr>
                                @empty
                                    <tr><td colspan="5" class="text-center text-muted">No hay registros</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
