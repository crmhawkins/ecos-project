@extends('crm.layouts.app')

@section('titulo', 'Pedir Aula')

@section('css')
<link rel="stylesheet" href="{{asset('assets/vendors/choices.js/choices.min.css')}}" />
@endsection

@section('content')
<div class="page-heading card" style="box-shadow: none !important">
    <div class="page-title card-body">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Pedir Aula</h3>
                <p class="text-subtitle text-muted">Formulario para registrar la reserva de un aula</p>
            </div>

            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('reservas.index')}}">Reservas</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Pedir Aula</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section mt-4">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('reservas.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="curso">Nombre del Curso</label>
                            <input type="text" name="curso" class="form-control" value="{{ old('curso') }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="profesor">Profesor</label>
                            <input type="text" name="profesor" class="form-control" value="{{ old('profesor') }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="contacto_profesor">Contacto</label>
                            <input type="text" name="contacto_profesor" value="{{ old('contacto_profesor') }}" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="alumnos">Nº de Alumnos</label>
                            <input type="number" name="alumnos" value="{{ old('alumnos') }}" class="form-control" required>

                        <div class="col-md-6 mb-3">
                            <label for="fecha_inicio">Fecha de Inicio</label>
                            <input type="date" name="fecha_inicio" class="form-control" value="{{ old('fecha_inicio') }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="fecha_fin">Fecha de Fin</label>
                            <input type="date" name="fecha_fin" class="form-control" value="{{ old('fecha_fin') }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="dias">Días de la Semana</label>
                            <select name="dias[]" class="form-control choices" multiple required>
                                <option value="Monday" {{ in_array('Monday', old('dias', [])) ? 'selected' : '' }}>Lunes</option>
                                <option value="Tuesday"  {{ in_array('Tuesday', old('dias', [])) ? 'selected' : '' }}>Martes</option>
                                <option value="Wednesday"  {{ in_array('Wednesday', old('dias', [])) ? 'selected' : '' }}>Miércoles</option>
                                <option value="Thursday"  {{ in_array('Thursday', old('dias', [])) ? 'selected' : '' }}>Jueves</option>
                                <option value="Friday"  {{ in_array('Friday', old('dias', [])) ? 'selected' : '' }}>Viernes</option>
                            </select>
                        </div>

                        <div class="col-md-6 row">
                            <div class="col-md-6 mb-3">
                                <label for="horario">Horario inicio</label>
                                <input type="time" name="hora_inicio" class="form-control" value="{{ old('hora_inicio') }}" required>
                            </div> <div class="col-md-6 mb-3">
                                <label for="horario">Horario fin</label>
                                <input type="time" name="hora_fin" class="form-control" value="{{ old('hora_fin') }}" required>
                            </div>
                        </div>


                        <div class="col-md-6 mb-3">
                            <label for="archivo">Archivo</label>
                            <input type="file" name="archivo" class="form-control">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label><input type="checkbox" name="informatica" {{ old('informatica') ? 'checked' : '' }}> Aula Informática</label><br>
                            <label><input type="checkbox" name="homologada" {{ old('homologada') ? 'checked' : '' }}> Aula Homologada</label>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="observaciones">Observaciones</label>
                            <textarea name="observaciones" class="form-control" rows="3" value="{{ old('observaciones') }}"></textarea>
                        </div>
                    </div>

                    <div class="form-group mt-4">
                        <button type="submit" class="btn btn-primary w-100">Enviar Solicitud</button>
                    </div>

                </form>
            </div>
        </div>
    </section>
</div>
@endsection

@section('scripts')
<script src="{{asset('assets/vendors/choices.js/choices.min.js')}}"></script>
<script>
    new Choices('.choices', {
        removeItemButton: true,
        placeholder: true,
        placeholderValue: 'Selecciona...',
        searchPlaceholderValue: 'Buscar...',
    });
</script>
@endsection
