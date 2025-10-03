@extends('crm.layouts.clean_app')

@section('titulo', 'Editar Curso')

@section('css')
<style>
    .form-header-gradient {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        color: white;
        padding: 24px 32px;
        border-radius: 16px 16px 0 0;
        margin: 0;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
    }
    .form-header-gradient h1 {
        margin: 0;
        font-size: 1.8rem;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .form-header-gradient .btn-back {
        background: white;
        color: var(--primary-color);
        border: none;
        padding: 8px 16px;
        border-radius: 8px;
        font-weight: 600;
        transition: var(--transition);
        display: flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
    }
    .form-header-gradient .btn-back:hover {
        background: #f0f0f0;
        color: var(--primary-color);
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }

    .form-container {
        background: white;
        border-radius: 16px;
        box-shadow: var(--shadow);
        overflow: hidden;
        margin-bottom: 24px;
        border: 1px solid var(--border-color);
    }
    .form-body {
        padding: 32px;
    }
    .form-section-title {
        font-size: 1.4rem;
        font-weight: 600;
        color: var(--primary-color);
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid rgba(var(--primary-color-rgb, 217, 54, 144), 0.1);
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .form-group {
        margin-bottom: 24px;
    }
    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: var(--text-primary);
        font-size: 0.95rem;
    }
    .form-control {
        width: 100%;
        padding: 12px 16px;
        border: 2px solid var(--border-color);
        border-radius: 8px;
        font-size: 1rem;
        transition: var(--transition);
        background: white;
        color: var(--text-primary);
    }
    .form-control:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(var(--primary-color-rgb, 217, 54, 144), 0.1);
    }
    .form-control::placeholder {
        color: var(--text-secondary);
        opacity: 0.7;
    }
    textarea.form-control {
        resize: vertical;
        min-height: 120px;
    }
    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 24px;
    }
    .checkbox-group {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-top: 8px;
    }
    .checkbox-group input[type="checkbox"] {
        width: 18px;
        height: 18px;
        accent-color: var(--primary-color);
    }
    .current-image {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 15px;
        padding: 15px;
        background: var(--bg-light);
        border-radius: 8px;
        border: 1px solid var(--border-color);
    }
    .current-image img {
        width: 120px;
        height: 80px;
        border-radius: 8px;
        object-fit: cover;
        border: 2px solid var(--border-color);
    }
    .current-image-info h4 {
        margin: 0 0 5px 0;
        color: var(--text-primary);
        font-size: 1.1rem;
    }
    .current-image-info p {
        margin: 0;
        color: var(--text-secondary);
        font-size: 0.9rem;
    }
    .file-upload-wrapper {
        border: 2px dashed var(--border-color);
        border-radius: 8px;
        padding: 20px;
        text-align: center;
        cursor: pointer;
        transition: var(--transition);
        position: relative;
        overflow: hidden;
    }
    .file-upload-wrapper:hover {
        border-color: var(--primary-color);
        background-color: rgba(var(--primary-color-rgb, 217, 54, 144), 0.05);
    }
    .file-upload-wrapper input[type="file"] {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
    }
    .file-upload-wrapper i {
        font-size: 2.5rem;
        color: var(--text-secondary);
        margin-bottom: 10px;
    }
    .file-upload-wrapper p {
        margin: 0;
        color: var(--text-secondary);
        font-weight: 500;
    }
    .image-preview {
        margin-top: 20px;
        border: 1px solid var(--border-color);
        border-radius: 8px;
        padding: 10px;
        display: inline-block;
        max-width: 100%;
    }
    .image-preview img {
        max-width: 100%;
        height: auto;
        border-radius: 4px;
    }
    .status-card {
        background: var(--bg-light);
        border: 1px solid var(--border-color);
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 20px;
    }
    .status-card .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 16px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.9rem;
    }
    .status-card .status-published {
        background: rgba(var(--success-color-rgb, 16, 185, 129), 0.1);
        color: var(--success-color);
        border: 1px solid rgba(var(--success-color-rgb, 16, 185, 129), 0.2);
    }
    .status-card .status-draft {
        background: rgba(var(--warning-color-rgb, 245, 158, 11), 0.1);
        color: var(--warning-color);
        border: 1px solid rgba(var(--warning-color-rgb, 245, 158, 11), 0.2);
    }
    .btn-group-form {
        display: flex;
        gap: 12px;
        padding: 24px 32px;
        background: var(--bg-light);
        border-top: 1px solid var(--border-color);
        border-radius: 0 0 16px 16px;
        justify-content: flex-end;
    }
    .btn-submit {
        background: var(--primary-color);
        color: white;
        padding: 12px 24px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        transition: var(--transition);
        border: none;
        cursor: pointer;
        font-size: 1rem;
    }
    .btn-submit:hover {
        background: #c2185b;
        color: white;
    }
    .btn-cancel {
        background: var(--text-secondary);
        color: white;
        padding: 12px 24px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        transition: var(--transition);
        border: none;
        cursor: pointer;
        font-size: 1rem;
    }
    .btn-cancel:hover {
        background: #4b5563;
        color: white;
        text-decoration: none;
    }

    @media (max-width: 768px) {
        .form-row {
            grid-template-columns: 1fr;
            gap: 16px;
        }
        .form-body {
            padding: 24px;
        }
        .form-header-gradient {
            padding: 18px 24px;
        }
        .form-header-gradient h1 {
            font-size: 1.5rem;
        }
        .btn-group-form {
            flex-direction: column;
            padding: 18px 24px;
        }
        .current-image {
            flex-direction: column;
            text-align: center;
        }
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-triangle"></i>
            <strong>Error:</strong>
            <ul style="margin: 8px 0 0 0; padding-left: 20px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('cursos.update', $curso->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="form-container">
            <div class="form-header-gradient">
                <h1><i class="fas fa-edit"></i> Editar Curso: {{ $curso->titulo }}</h1>
                <a href="{{ route('cursos.index') }}" class="btn-back">
                    <i class="fas fa-arrow-left"></i> Volver al Listado
                </a>
            </div>
            
            <div class="form-body">
                <!-- Estado de Publicación -->
                <div class="status-card">
                    <h4 style="margin: 0 0 10px 0; color: var(--text-primary);">Estado de Publicación</h4>
                    @if($curso->published)
                        <span class="status-badge status-published">
                            <i class="fas fa-check-circle"></i> Publicado en la Web
                        </span>
                    @else
                        <span class="status-badge status-draft">
                            <i class="fas fa-clock"></i> Borrador (No Visible)
                        </span>
                    @endif
                </div>

                <h3 class="form-section-title"><i class="fas fa-book"></i> Información Básica</h3>
                
                <div class="form-group">
                    <label for="titulo">Título del Curso <span style="color: red;">*</span></label>
                    <input type="text" name="titulo" id="titulo" class="form-control" 
                           value="{{ old('titulo', $curso->titulo) }}" placeholder="Título del curso" required>
                </div>

                <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <textarea name="descripcion" id="descripcion" class="form-control" 
                              placeholder="Descripción detallada del curso">{{ old('descripcion', $curso->descripcion) }}</textarea>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="categoria_id">Categoría <span style="color: red;">*</span></label>
                        <select name="categoria_id" id="categoria_id" class="form-control" required>
                            <option value="">Selecciona una categoría</option>
                            @foreach($categorias as $categoria)
                                <option value="{{ $categoria->id }}" 
                                    {{ old('categoria_id', $curso->categoria_id) == $categoria->id ? 'selected' : '' }}>
                                    {{ $categoria->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="precio">Precio (€)</label>
                        <input type="number" name="precio" id="precio" class="form-control" 
                               value="{{ old('precio', $curso->precio) }}" min="0" step="0.01" placeholder="0.00">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="duracion">Duración (horas)</label>
                        <input type="number" name="duracion" id="duracion" class="form-control" 
                               value="{{ old('duracion', $curso->duracion) }}" min="1" placeholder="Número de horas">
                    </div>
                    <div class="form-group">
                        <label for="nivel">Nivel</label>
                        <select name="nivel" id="nivel" class="form-control">
                            <option value="">Selecciona un nivel</option>
                            <option value="Principiante" {{ old('nivel', $curso->nivel) == 'Principiante' ? 'selected' : '' }}>Principiante</option>
                            <option value="Intermedio" {{ old('nivel', $curso->nivel) == 'Intermedio' ? 'selected' : '' }}>Intermedio</option>
                            <option value="Avanzado" {{ old('nivel', $curso->nivel) == 'Avanzado' ? 'selected' : '' }}>Avanzado</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="imagen">Imagen del Curso</label>
                    
                    @if($curso->imagen)
                        <div class="current-image">
                            <img src="{{ asset('storage/' . $curso->imagen) }}" alt="Imagen actual del curso">
                            <div class="current-image-info">
                                <h4>Imagen Actual</h4>
                                <p>Selecciona una nueva imagen para reemplazar la actual</p>
                            </div>
                        </div>
                    @endif
                    
                    <div class="file-upload-wrapper" id="fileUploadWrapper">
                        <input type="file" name="imagen" id="imagen" accept="image/*">
                        <i class="fas fa-cloud-upload-alt"></i>
                        <p>Arrastra y suelta una imagen aquí o haz clic para seleccionar</p>
                    </div>
                    <div id="imagePreview" class="image-preview" style="display: none;">
                        <img src="#" alt="Previsualización de imagen" style="max-width: 300px; height: auto;">
                    </div>
                </div>

                <h3 class="form-section-title"><i class="fas fa-cog"></i> Configuración</h3>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="fecha_inicio">Fecha de Inicio</label>
                        <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" 
                               value="{{ old('fecha_inicio', $curso->fecha_inicio ? $curso->fecha_inicio->format('Y-m-d') : '') }}">
                    </div>
                    <div class="form-group">
                        <label for="fecha_fin">Fecha de Fin</label>
                        <input type="date" name="fecha_fin" id="fecha_fin" class="form-control" 
                               value="{{ old('fecha_fin', $curso->fecha_fin ? $curso->fecha_fin->format('Y-m-d') : '') }}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="requisitos">Requisitos Previos</label>
                    <textarea name="requisitos" id="requisitos" class="form-control" 
                              placeholder="Conocimientos o requisitos necesarios para el curso">{{ old('requisitos', $curso->requisitos) }}</textarea>
                </div>

                <div class="form-group">
                    <label for="objetivos">Objetivos del Curso</label>
                    <textarea name="objetivos" id="objetivos" class="form-control" 
                              placeholder="Qué aprenderán los estudiantes al completar este curso">{{ old('objetivos', $curso->objetivos) }}</textarea>
                </div>

                <div class="form-group">
                    <div class="checkbox-group">
                        <input type="checkbox" name="published" id="published" value="1" 
                               {{ old('published', $curso->published) ? 'checked' : '' }}>
                        <label for="published">Publicar curso en la web</label>
                    </div>
                    <small style="color: var(--text-secondary); font-size: 0.85rem; margin-top: 5px; display: block;">
                        Si está marcado, el curso será visible en la página web pública
                    </small>
                </div>
            </div>
        </div>

        <div class="btn-group-form" style="background: white; border-radius: 16px; box-shadow: var(--shadow); border: 1px solid var(--border-color);">
            <a href="{{ route('cursos.index') }}" class="btn-cancel">
                <i class="fas fa-times"></i> Cancelar
            </a>
            <button type="submit" class="btn-submit">
                <i class="fas fa-save"></i> Actualizar Curso
            </button>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Preview de imagen
    const imagenInput = document.getElementById('imagen');
    const imagePreview = document.getElementById('imagePreview');
    const previewImg = imagePreview.querySelector('img');

    imagenInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                imagePreview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        } else {
            imagePreview.style.display = 'none';
        }
    });

    // Validación de fechas
    const fechaInicio = document.getElementById('fecha_inicio');
    const fechaFin = document.getElementById('fecha_fin');
    
    fechaInicio.addEventListener('change', function() {
        if (fechaFin.value && fechaInicio.value > fechaFin.value) {
            alert('La fecha de inicio no puede ser posterior a la fecha de fin');
            fechaInicio.value = '';
        }
    });
    
    fechaFin.addEventListener('change', function() {
        if (fechaInicio.value && fechaFin.value < fechaInicio.value) {
            alert('La fecha de fin no puede ser anterior a la fecha de inicio');
            fechaFin.value = '';
        }
    });
});
</script>
@endsection