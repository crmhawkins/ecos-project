@extends('crm.layouts.app')

@section('titulo', 'Editar Curso')

@section('css')
<link rel="stylesheet" href="{{asset('assets/vendors/choices.js/choices.min.css')}}" />
@endsection

@section('content')
 <div class="page-heading card" style="box-shadow: none !important" >
    <div class="page-title card-body">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Editar Producto</h3>
                <p class="text-subtitle text-muted">Formulario para editar un producto</p>
            </div>

            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('cursos.index')}}">Cursos</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Editar Producto</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section mt-4">
        <div class="card">
            <div class="card-body">
                <form action="{{route('cursos.update',$servicio->id )}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="bloque-formulario">
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group mb-3">
                                    <label for="name">Nombre:</label>
                                    <input placeholder="Titulo del servicio" type="text" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name',$servicio->name) }}" name="name">
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
                                                <option {{$servicio->category_id == $categoria->id ? 'selected' : '' }} value="{{ $categoria->id }}">{{ $categoria->name }}</option>
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
                                    <input placeholder="Precio..." type="number" class="form-control @error('price') is-invalid @enderror" id="price" value="{{ old('price',$servicio->price) }}" name="price" step="0.01">
                                    @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-12">
                                <div class="form-group mb-3">
                                    <label for="image">Imagen del curso:</label>
                                    <small class="form-text text-muted mb-2">Sube una imagen representativa del curso (recomendado: 400x300px). Si no subes ninguna, se usará una imagen por defecto.</small>
                                    <input type="file" class="form-control" id="image" name="image" accept="image/*">
                                    @if($servicio->image && file_exists(storage_path('app/public/' . $servicio->image)))
                                        <div class="mt-2">
                                            <small class="text-muted">Imagen actual:</small><br>
                                            <img src="{{ asset('storage/' . $servicio->image) }}" alt="Imagen actual" style="max-width: 200px; height: auto; border-radius: 8px; border: 1px solid #ddd;">
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group mb-3">
                                    <label for="description">Descripción del curso:</label>
                                    <small class="form-text text-muted mb-2">Esta descripción aparecerá en la página de detalle del curso. Puedes usar saltos de línea para organizar el contenido.</small>
                                    <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" rows="8" placeholder="Describe aquí los objetivos, contenido y beneficios del curso...">{{ old('description', $servicio->description) }}</textarea>
                                    @error('description')
                                    <span class="invalid-feedback d-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="inicio">Fecha de Inicio:</label>
                                    <input type="date" class="form-control @error('inicio') is-invalid @enderror" name="inicio" id="inicio" value="{{ old('inicio', \Carbon\Carbon::parse($servicio->inicio)->format('Y-m-d')) }}">
                                    @error('inicio')
                                    <span class="invalid-feedback d-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="duracion">Duración (horas):</label>
                                    <input type="text" class="form-control @error('duracion') is-invalid @enderror" name="duracion" id="duracion" value="{{ old('duracion', $servicio->duracion) }}">
                                    @error('duracion')
                                    <span class="invalid-feedback d-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="plazas">Plazas:</label>
                                    <input type="number" class="form-control @error('plazas') is-invalid @enderror" name="plazas" id="plazas" value="{{ old('plazas', $servicio->plazas) }}">
                                    @error('plazas')
                                    <span class="invalid-feedback d-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="lecciones">Lecciones:</label>
                                    <input type="number" class="form-control @error('lecciones') is-invalid @enderror" name="lecciones" id="lecciones" value="{{ old('lecciones', $servicio->lecciones) }}">
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
                                        <option value="1" {{ old('certificado', $servicio->certificado) == '1' ? 'selected' : '' }}>Sí</option>
                                        <option value="0" {{ old('certificado', $servicio->certificado) == '0' ? 'selected' : '' }}>No</option>
                                    </select>
                                    @error('certificado')
                                    <span class="invalid-feedback d-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 d-flex align-items-center">
                                <div class="form-group mb-3">
                                    <label class="text-left" for="inactive">Ocultar:</label>
                                    <input type="checkbox" id="inactive" name="inactive" value="1" {{ old('inactive', $servicio->inactive) ? 'checked' : '' }}>
                                    @error('inactive')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mt-5">
                        <button type="submit" class="btn btn-success w-100 text-uppercase">
                            {{ __('Actualizar') }}
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
@include('crm.partials.toast')

@endsection
