@extends('crm.layouts.app')

@section('titulo', 'Crear Curso')

@section('css')
<link rel="stylesheet" href="{{asset('assets/vendors/choices.js/choices.min.css')}}" />
@endsection

@section('content')
 <div class="page-heading card" style="box-shadow: none !important" >
    <div class="page-title card-body">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Crear Curso</h3>
                <p class="text-subtitle text-muted">Formulario para registrar un curso</p>
            </div>

            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('cursos.index')}}">Cursos</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Crear Producto</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section mt-4">
        <div class="card">
            <div class="card-body">
                <form action="{{route('cursos.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="bloque-formulario">
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group mb-3">
                                    <label for="name">Nombre:</label>
                                    <input placeholder="Titulo del curso" type="text" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name') }}" name="name">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group mb-3">
                                    <label class="mb-2 text-left" for="category_id">Categoria</label>
                                    <div class="flex flex-row align-items-start mb-0">
                                        <select id="category_id" class="choices w-100 form-select  @error('category_id') is-invalid @enderror" name="category_id">
                                            <option value="">Seleccione una Categoria</option>
                                            @foreach ($categorias as $categoria)
                                                <option {{old('category_id') == $categoria->id ? 'selected' : '' }} value="{{ $categoria->id }}">{{ $categoria->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('category_id')
                                    <p class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group mb-3">
                                    <label for="price">Precio:</label>
                                    <input placeholder="Precio..." type="text" class="form-control @error('price') is-invalid @enderror" id="precio" value="{{ old('price') }}" name="price" step="0.01">
                                    @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group mb-3">
                                    <label for="concept">Imagen:</label>
                                    {{-- imput de archivo  --}}
                                    <input type="file" class="form-control" id="image" name="image">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label for="description">Descripción:</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" rows="4">{{ old('description') }}</textarea>
                                    @error('description')
                                    <span class="invalid-feedback d-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="inicio">Fecha de Inicio:</label>
                                    <input type="date" class="form-control @error('inicio') is-invalid @enderror" name="inicio" id="inicio" value="{{ old('inicio') }}">
                                    @error('inicio')
                                    <span class="invalid-feedback d-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="duracion">Duración (horas):</label>
                                    <input type="text" class="form-control @error('duracion') is-invalid @enderror" name="duracion" id="duracion" value="{{ old('duracion') }}">
                                    @error('duracion')
                                    <span class="invalid-feedback d-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="plazas">Plazas:</label>
                                    <input type="number" class="form-control @error('plazas') is-invalid @enderror" name="plazas" id="plazas" value="{{ old('plazas') }}">
                                    @error('plazas')
                                    <span class="invalid-feedback d-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="lecciones">Lecciones:</label>
                                    <input type="number" class="form-control @error('lecciones') is-invalid @enderror" name="lecciones" id="lecciones" value="{{ old('lecciones') }}">
                                    @error('lecciones')
                                    <span class="invalid-feedback d-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="certificado">¿Incluye Certificación?</label>
                                    <select name="certificado" id="certificado" class="form-select @error('certificado') is-invalid @enderror">
                                        <option value="">Seleccione...</option>
                                        <option value="1" {{ old('certificado') == '1' ? 'selected' : '' }}>Sí</option>
                                        <option value="0" {{ old('certificado') == '0' ? 'selected' : '' }}>No</option>
                                    </select>
                                    @error('certificado')
                                    <span class="invalid-feedback d-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 d-flex align-items-center">
                                <div class="form-check form-switch mt-4">
                                    <input class="form-check-input" type="checkbox" id="inactive" name="inactive" value="1" {{ old('inactive') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inactive">Ocultar</label>
                                </div>
                            </div>

                            <div class="col-md-6 d-flex align-items-center">
                                <div class="form-check form-switch mt-4">
                                    <input class="form-check-input" type="checkbox" id="published" name="published" value="1" {{ old('published') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="published">
                                        <i class="fas fa-globe text-success me-2"></i>Publicar en Web
                                    </label>
                                    <small class="form-text text-muted d-block">Si está marcado, el curso aparecerá en la web pública</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mt-5">
                        <button type="submit" class="btn btn-success w-100 text-uppercase">
                            {{ __('Registrar') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>

@endsection

@section('scripts')
<script src="{{asset('assets/vendors/choices.js/choices.min.js')}}"></script>

@endsection
