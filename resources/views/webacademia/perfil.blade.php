@extends('webacademia.layouts.web_layout')

@section('title', 'Mi perfil')

@section('css')
<style>
    .perfil-card {
        border: 1px solid #ddd;
        border-radius: 10px;
        padding: 25px;
        background: #fff;
        box-shadow: 0 3px 6px rgba(0,0,0,0.1);
    }
    .perfil-card h4 {
        margin-bottom: 20px;
        font-weight: bold;
    }
</style>
@endsection

@section('content')

<!-- START SECTION TOP -->
<section class="section-top">
    <div class="container">
        <div class="col-lg-10 offset-lg-1 text-center">
            <div class="section-top-title wow fadeInRight">
                <h1>Mi perfil</h1>
            </div>
        </div>
    </div>
</section>
<!-- END SECTION TOP -->

<section class="section-padding">
    <div class="container">
        <div class="row">
            <!-- FORMULARIO DE PERFIL -->
            <div class="col-lg-6 mb-5">
                <div class="perfil-card">
                    <h4>Editar mis datos</h4>
                    {{-- <form action="{{ route('alumno.perfil.update') }}" method="POST" enctype="multipart/form-data"> --}}
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', auth('alumno')->user()->name) }}" required>
                        </div>

                        <div class="form-group">
                            <label>Apellidos</label>
                            <input type="text" name="surname" class="form-control" value="{{ old('surname', auth('alumno')->user()->surname) }}" required>
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email', auth('alumno')->user()->email) }}" required>
                        </div>

                        <div class="form-group">
                            <label>Teléfono</label>
                            <input type="text" name="phone" class="form-control" value="{{ old('phone', auth('alumno')->user()->phone) }}">
                        </div>

                        <div class="form-group">
                            <label>Avatar</label>
                            <input type="file" name="avatar" class="form-control">
                            @if(auth('alumno')->user()->avatar)
                                <img src="{{ asset('storage/' . auth('alumno')->user()->avatar) }}" alt="avatar" width="100" class="mt-2 rounded">
                            @endif
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn_one">Guardar cambios</button>
                        </div>
                    {{-- </form> --}}
                </div>
            </div>

            <!-- CURSOS COMPRADOS -->
            <div class="col-lg-6">
                <div class="perfil-card">
                    <h4>Mis cursos comprados</h4>
                    @forelse(auth('alumno')->user()->cursos as $curso)
                        <div class="mb-3 border-bottom pb-2">
                            <strong>{{ $curso->titulo }}</strong><br>
                            <small>{{ $curso->descripcion_corta }}</small><br>
                            <a href="{{ route('curso.detalle', $curso->id) }}" class="btn btn-sm btn-outline-primary mt-2">Ver curso</a>
                        </div>
                    @empty
                        <p>No has comprado ningún curso aún.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
