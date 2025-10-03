@extends('crm.layouts.clean_app')

@section('titulo', 'Editar Categoría')

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
    .color-picker-wrapper {
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .color-preview {
        width: 40px;
        height: 40px;
        border-radius: 8px;
        border: 2px solid var(--border-color);
        cursor: pointer;
        transition: var(--transition);
    }
    .color-preview:hover {
        transform: scale(1.1);
    }
    .color-input {
        flex: 1;
    }
    .icon-selector {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(60px, 1fr));
        gap: 10px;
        margin-top: 10px;
        padding: 15px;
        background: var(--bg-light);
        border-radius: 8px;
        border: 1px solid var(--border-color);
    }
    .icon-option {
        width: 50px;
        height: 50px;
        border: 2px solid var(--border-color);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: var(--transition);
        background: white;
        font-size: 1.2rem;
        color: var(--text-secondary);
    }
    .icon-option:hover {
        border-color: var(--primary-color);
        color: var(--primary-color);
        transform: scale(1.05);
    }
    .icon-option.selected {
        border-color: var(--primary-color);
        background: var(--primary-color);
        color: white;
    }
    .stats-card {
        background: var(--bg-light);
        border: 1px solid var(--border-color);
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 20px;
    }
    .stats-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }
    .stat-item {
        text-align: center;
        padding: 15px;
        background: white;
        border-radius: 8px;
        border: 1px solid var(--border-color);
    }
    .stat-number {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--primary-color);
        margin-bottom: 5px;
    }
    .stat-label {
        color: var(--text-secondary);
        font-size: 0.85rem;
        font-weight: 500;
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
        .icon-selector {
            grid-template-columns: repeat(auto-fit, minmax(50px, 1fr));
        }
        .stats-grid {
            grid-template-columns: 1fr;
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

    <form method="POST" action="{{ route('cursosCategoria.update', $categoria->id) }}">
        @csrf
        @method('PUT')
        
        <div class="form-container">
            <div class="form-header-gradient">
                <h1><i class="fas fa-edit"></i> Editar Categoría: {{ $categoria->nombre }}</h1>
                <a href="{{ route('cursosCategoria.index') }}" class="btn-back">
                    <i class="fas fa-arrow-left"></i> Volver al Listado
                </a>
            </div>
            
            <div class="form-body">
                <!-- Estadísticas de la Categoría -->
                <div class="stats-card">
                    <h4 style="margin: 0 0 15px 0; color: var(--text-primary);">Estadísticas de la Categoría</h4>
                    <div class="stats-grid">
                        <div class="stat-item">
                            <div class="stat-number">{{ $categoria->cursos->count() ?? 0 }}</div>
                            <div class="stat-label">Cursos Asociados</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">{{ $categoria->created_at->diffInDays(now()) }}</div>
                            <div class="stat-label">Días Creada</div>
                        </div>
                    </div>
                </div>

                <h3 class="form-section-title"><i class="fas fa-tag"></i> Información Básica</h3>
                
                <div class="form-group">
                    <label for="nombre">Nombre de la Categoría <span style="color: red;">*</span></label>
                    <input type="text" name="nombre" id="nombre" class="form-control" 
                           value="{{ old('nombre', $categoria->nombre) }}" placeholder="Nombre de la categoría" required>
                </div>

                <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <textarea name="descripcion" id="descripcion" class="form-control" 
                              placeholder="Descripción detallada de la categoría">{{ old('descripcion', $categoria->descripcion) }}</textarea>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="slug">Slug (URL amigable)</label>
                        <input type="text" name="slug" id="slug" class="form-control" 
                               value="{{ old('slug', $categoria->slug) }}" placeholder="categoria-ejemplo">
                        <small style="color: var(--text-secondary); font-size: 0.85rem; margin-top: 5px; display: block;">
                            URL amigable para esta categoría
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="orden">Orden de Visualización</label>
                        <input type="number" name="orden" id="orden" class="form-control" 
                               value="{{ old('orden', $categoria->orden ?? 0) }}" min="0" placeholder="0">
                        <small style="color: var(--text-secondary); font-size: 0.85rem; margin-top: 5px; display: block;">
                            Orden en el que aparecerá en los listados
                        </small>
                    </div>
                </div>

                <h3 class="form-section-title"><i class="fas fa-palette"></i> Personalización Visual</h3>
                
                <div class="form-group">
                    <label for="color">Color de la Categoría</label>
                    <div class="color-picker-wrapper">
                        <div class="color-preview" id="colorPreview" style="background-color: {{ $categoria->color ?? '#D93690' }};"></div>
                        <input type="color" name="color" id="color" class="form-control color-input" 
                               value="{{ old('color', $categoria->color ?? '#D93690') }}">
                    </div>
                    <small style="color: var(--text-secondary); font-size: 0.85rem; margin-top: 5px; display: block;">
                        Color que se usará para identificar visualmente esta categoría
                    </small>
                </div>

                <div class="form-group">
                    <label for="icono">Icono de la Categoría</label>
                    <input type="hidden" name="icono" id="icono" value="{{ old('icono', $categoria->icono ?? 'fas fa-book') }}">
                    <div class="icon-selector">
                        <div class="icon-option {{ (old('icono', $categoria->icono ?? 'fas fa-book') == 'fas fa-book') ? 'selected' : '' }}" data-icon="fas fa-book">
                            <i class="fas fa-book"></i>
                        </div>
                        <div class="icon-option {{ (old('icono', $categoria->icono) == 'fas fa-graduation-cap') ? 'selected' : '' }}" data-icon="fas fa-graduation-cap">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <div class="icon-option {{ (old('icono', $categoria->icono) == 'fas fa-laptop-code') ? 'selected' : '' }}" data-icon="fas fa-laptop-code">
                            <i class="fas fa-laptop-code"></i>
                        </div>
                        <div class="icon-option {{ (old('icono', $categoria->icono) == 'fas fa-paint-brush') ? 'selected' : '' }}" data-icon="fas fa-paint-brush">
                            <i class="fas fa-paint-brush"></i>
                        </div>
                        <div class="icon-option {{ (old('icono', $categoria->icono) == 'fas fa-chart-line') ? 'selected' : '' }}" data-icon="fas fa-chart-line">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <div class="icon-option {{ (old('icono', $categoria->icono) == 'fas fa-camera') ? 'selected' : '' }}" data-icon="fas fa-camera">
                            <i class="fas fa-camera"></i>
                        </div>
                        <div class="icon-option {{ (old('icono', $categoria->icono) == 'fas fa-music') ? 'selected' : '' }}" data-icon="fas fa-music">
                            <i class="fas fa-music"></i>
                        </div>
                        <div class="icon-option {{ (old('icono', $categoria->icono) == 'fas fa-dumbbell') ? 'selected' : '' }}" data-icon="fas fa-dumbbell">
                            <i class="fas fa-dumbbell"></i>
                        </div>
                        <div class="icon-option {{ (old('icono', $categoria->icono) == 'fas fa-utensils') ? 'selected' : '' }}" data-icon="fas fa-utensils">
                            <i class="fas fa-utensils"></i>
                        </div>
                        <div class="icon-option {{ (old('icono', $categoria->icono) == 'fas fa-car') ? 'selected' : '' }}" data-icon="fas fa-car">
                            <i class="fas fa-car"></i>
                        </div>
                        <div class="icon-option {{ (old('icono', $categoria->icono) == 'fas fa-heart') ? 'selected' : '' }}" data-icon="fas fa-heart">
                            <i class="fas fa-heart"></i>
                        </div>
                        <div class="icon-option {{ (old('icono', $categoria->icono) == 'fas fa-globe') ? 'selected' : '' }}" data-icon="fas fa-globe">
                            <i class="fas fa-globe"></i>
                        </div>
                    </div>
                    <small style="color: var(--text-secondary); font-size: 0.85rem; margin-top: 5px; display: block;">
                        Selecciona un icono que represente esta categoría
                    </small>
                </div>

                <div class="form-group">
                    <label for="meta_descripcion">Meta Descripción (SEO)</label>
                    <textarea name="meta_descripcion" id="meta_descripcion" class="form-control" 
                              placeholder="Descripción para motores de búsqueda (máximo 160 caracteres)">{{ old('meta_descripcion', $categoria->meta_descripcion) }}</textarea>
                    <small style="color: var(--text-secondary); font-size: 0.85rem; margin-top: 5px; display: block;">
                        Descripción que aparecerá en los resultados de búsqueda de Google
                    </small>
                </div>
            </div>
        </div>

        <div class="btn-group-form" style="background: white; border-radius: 16px; box-shadow: var(--shadow); border: 1px solid var(--border-color);">
            <a href="{{ route('cursosCategoria.index') }}" class="btn-cancel">
                <i class="fas fa-times"></i> Cancelar
            </a>
            <button type="submit" class="btn-submit">
                <i class="fas fa-save"></i> Actualizar Categoría
            </button>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Generar slug automático
    const nombreInput = document.getElementById('nombre');
    const slugInput = document.getElementById('slug');
    
    nombreInput.addEventListener('input', function() {
        if (!slugInput.value || slugInput.dataset.auto !== 'false') {
            const slug = this.value
                .toLowerCase()
                .replace(/[áàäâ]/g, 'a')
                .replace(/[éèëê]/g, 'e')
                .replace(/[íìïî]/g, 'i')
                .replace(/[óòöô]/g, 'o')
                .replace(/[úùüû]/g, 'u')
                .replace(/[ñ]/g, 'n')
                .replace(/[^a-z0-9]/g, '-')
                .replace(/-+/g, '-')
                .replace(/^-|-$/g, '');
            slugInput.value = slug;
        }
    });
    
    slugInput.addEventListener('input', function() {
        this.dataset.auto = 'false';
    });

    // Color picker
    const colorInput = document.getElementById('color');
    const colorPreview = document.getElementById('colorPreview');
    
    colorInput.addEventListener('change', function() {
        colorPreview.style.backgroundColor = this.value;
    });

    // Icon selector
    const iconOptions = document.querySelectorAll('.icon-option');
    const iconInput = document.getElementById('icono');
    
    iconOptions.forEach(option => {
        option.addEventListener('click', function() {
            iconOptions.forEach(opt => opt.classList.remove('selected'));
            this.classList.add('selected');
            iconInput.value = this.dataset.icon;
        });
    });

    // Meta descripción contador
    const metaDescripcion = document.getElementById('meta_descripcion');
    if (metaDescripcion) {
        const maxLength = 160;
        const counter = document.createElement('div');
        counter.style.cssText = 'font-size: 0.8rem; color: var(--text-secondary); text-align: right; margin-top: 5px;';
        metaDescripcion.parentNode.appendChild(counter);
        
        function updateCounter() {
            const remaining = maxLength - metaDescripcion.value.length;
            counter.textContent = `${metaDescripcion.value.length}/${maxLength} caracteres`;
            counter.style.color = remaining < 0 ? 'var(--danger-color)' : 'var(--text-secondary)';
        }
        
        metaDescripcion.addEventListener('input', updateCounter);
        updateCounter();
    }
});
</script>
@endsection