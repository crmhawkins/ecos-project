@extends('crm.layouts.app')

@section('titulo', 'Asignar Aula')

@section('css')
<link rel="stylesheet" href="{{ asset('assets/vendors/choices.js/choices.min.css') }}" />
<style>
    .libre { background-color: #28a745 !important; color: white !important; }
    .ocupado { background-color: #dc3545 !important; color: white !important; }
</style>
@endsection

@section('content')
<div class="page-heading card" style="box-shadow: none !important">
    <div class="page-title card-body">
        <div class="row">
            <div class="col-12 col-md-6">
                <h3>Asignar Aula - Curso {{ $reserva->curso }}</h3>
                <p class="text-subtitle text-muted">Fechas: {{ $reserva->fecha_inicio }} a {{ $reserva->fecha_fin }}<br>
                    Horario: {{ $reserva->hora_inicio }} - {{ $reserva->hora_fin }}
                </p>
            </div>
            <div class="col-12 col-md-6 text-end">
                <a href="{{ route('reservas.index') }}" class="btn btn-secondary mt-3">← Volver</a>
            </div>
        </div>
    </div>

    <section class="section mt-4">
        <div class="card">
            <div class="card-body">

                <h5 class="mb-3">Disponibilidad de Aulas</h5>

                <div class="table-responsive">
                    <table class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                @foreach($aulas as $aula)
                                    <th>{{ $aula->name }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($disponibilidad as $fecha => $estadoPorAula)
                                <tr>
                                    <td>{{ $fecha }}</td>
                                    @foreach($aulas as $aula)
                                        @php
                                            $estado = $estadoPorAula[$aula->id] ?? 'Libre';
                                        @endphp
                                        <td class="{{ strtolower($estado) }}">{{ $estado }}</td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <form action="{{ route('reservas.asignar') }}" method="POST" class="mt-4">
                    @csrf
                    <input type="hidden" name="id" id="aulas" value="{{ $reserva->id }}">
                    <div class="form-group">
                        <label for="aula_id">Seleccionar Aula para asignar este curso</label>
                        <select name="aula_id" id="aula_id" class="form-control choices" required>
                            <option value="">-- Selecciona un aula --</option>
                            @foreach($aulas as $aula)
                                <option value="{{ $aula->id }}">{{ $aula->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Asignar Aula</button>
                </form>

                @if(!empty($conflictos))
                <div class="alert alert-warning mt-4">
                    <strong>Conflictos detectados:</strong>
                    <ul>
                        @foreach($conflictos as $conflicto)
                            <li>{{ $conflicto }}</li>
                        @endforeach
                    </ul>
                    <p class="mt-2 text-muted">
                        Puedes optar por:<br>
                        - Asignar de todos modos si solo afecta a algunas fechas puntuales<br>
                        - Reasignar el curso a otra aula manualmente
                    </p>
                </div>
                @endif

            </div>
        </div>
    </section>
</div>
@endsection

@section('scripts')
<script src="{{ asset('assets/vendors/choices.js/choices.min.js') }}"></script>
<script>
    new Choices('.choices');
</script>
@include('crm.partials.toast')
@endsection
