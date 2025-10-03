@extends('crm.layouts.clean_app')

@section('titulo', 'Editar Artículo')

@section('css')
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<style>
    /* Variables específicas para el blog */
    :root {
        --blog-primary: #D93690;
        --blog-secondary: #8B5CF6;
        --blog-success: #10b981;
        --blog-danger: #ef4444;
        --blog-warning: #f59e0b;
        --blog-info: #3b82f6;
        --blog-text: #1f2937;
        --blog-text-light: #6b7280;
        --blog-border: #e5e7eb;
        --blog-bg: #f8fafc;
    }

    .page-header {
        background: linear-gradient(135deg, #D93690 0%, #8B5CF6 100%);
        color: white;
        padding: 32px;
        border-radius: 16px;
        margin-bottom: 32px;
        box-shadow: 0 10px 30px rgba(217, 54, 144, 0.3);
    }
    
    .page-header h1 {
        margin: 0;
        font-size: 2.2rem;
        font-weight: 800;
        display: flex;
        align-items: center;
        gap: 12px;
    }
    
    .page-header p {
        margin: 8px 0 0 0;
        opacity: 0.9;
        font-size: 1.1rem;
    }
    
    .form-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        margin-bottom: 24px;
    }
    
    .form-body {
        padding: 40px;
    }
    
    .form-section {
        margin-bottom: 32px;
    }
    
    .section-title {
        font-size: 1.3rem;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 20px;
        padding-bottom: 8px;
        border-bottom: 2px solid #D93690;
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
        color: #1f2937;
        font-size: 1rem;
    }
    
    .form-control {
        width: 100%;
        padding: 14px 18px;
        border: 2px solid #e5e7eb;
        border-radius: 12px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: white;
        color: #1f2937;
        font-family: inherit;
    }
    
    .form-control:focus {
        outline: none;
        border-color: #D93690;
        box-shadow: 0 0 0 4px rgba(217, 54, 144, 0.1);
        transform: translateY(-1px);
    }
    
    .form-control::placeholder {
        color: #9ca3af;
        opacity: 1;
    }
    
    textarea.form-control {
        resize: vertical;
        min-height: 120px;
        line-height: 1.6;
    }
    
    select.form-control {
        cursor: pointer;
    }
    
    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 24px;
        margin-bottom: 24px;
    }
    
    .checkbox-wrapper {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-top: 16px;
        padding: 16px;
        background: #f8fafc;
        border-radius: 12px;
        border: 2px solid #e5e7eb;
        transition: all 0.3s ease;
    }
    
    .checkbox-wrapper:hover {
        border-color: #D93690;
        background: rgba(217, 54, 144, 0.05);
    }
    
    .checkbox-wrapper input[type="checkbox"] {
        width: 20px;
        height: 20px;
        accent-color: #D93690;
        cursor: pointer;
    }
    
    .checkbox-wrapper label {
        margin: 0;
        cursor: pointer;
        font-weight: 600;
        color: #1f2937;
    }
    
    .file-upload-area {
        position: relative;
        border: 3px dashed #d1d5db;
        border-radius: 16px;
        padding: 40px 20px;
        text-align: center;
        transition: all 0.3s ease;
        background: #fafafa;
        cursor: pointer;
    }
    
    .file-upload-area:hover {
        border-color: #D93690;
        background: rgba(217, 54, 144, 0.05);
    }
    
    .file-upload-area input[type="file"] {
        position: absolute;
        opacity: 0;
        width: 100%;
        height: 100%;
        cursor: pointer;
    }
    
    .upload-icon {
        font-size: 3rem;
        color: #9ca3af;
        margin-bottom: 16px;
        transition: all 0.3s ease;
    }
    
    .file-upload-area:hover .upload-icon {
        color: #D93690;
        transform: scale(1.1);
    }
    
    .upload-text {
        font-size: 1.1rem;
        font-weight: 600;
        color: #4b5563;
        margin-bottom: 8px;
    }
    
    .upload-hint {
        font-size: 0.9rem;
        color: #9ca3af;
    }
    
    .current-image {
        margin-top: 20px;
        padding: 20px;
        background: #f8fafc;
        border-radius: 12px;
        border: 2px solid #e5e7eb;
    }
    
    .current-image img {
        max-width: 300px;
        height: auto;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        display: block;
        margin: 0 auto;
    }
    
    .current-image-label {
        font-weight: 600;
        color: #1f2937;
        margin-bottom: 12px;
        text-align: center;
    }
    
    .help-text {
        font-size: 0.875rem;
        color: #6b7280;
        margin-top: 6px;
        font-style: italic;
    }
    
    .btn-group {
        display: flex;
        gap: 16px;
        padding: 32px 40px;
        background: linear-gradient(135deg, #f8fafc, #e5e7eb);
        border-top: 1px solid #e5e7eb;
        justify-content: space-between;
        align-items: center;
    }
    
    .btn-primary-group {
        display: flex;
        gap: 12px;
    }
    
    .btn {
        padding: 14px 28px;
        border-radius: 12px;
        text-decoration: none;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }
    
    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.15);
        text-decoration: none;
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #D93690, #c2185b);
        color: white;
    }
    
    .btn-primary:hover {
        background: linear-gradient(135deg, #c2185b, #ad1457);
        color: white;
    }
    
    .btn-secondary {
        background: #6b7280;
        color: white;
    }
    
    .btn-secondary:hover {
        background: #4b5563;
        color: white;
    }
    
    .btn-info {
        background: #3b82f6;
        color: white;
    }
    
    .btn-info:hover {
        background: #2563eb;
        color: white;
    }
    
    .alert {
        padding: 16px 20px;
        border-radius: 12px;
        margin-bottom: 24px;
        border-left: 4px solid;
        display: flex;
        align-items: flex-start;
        gap: 12px;
    }
    
    .alert-success {
        background: rgba(16, 185, 129, 0.1);
        color: #065f46;
        border-left-color: #10b981;
    }
    
    .alert-danger {
        background: rgba(239, 68, 68, 0.1);
        color: #991b1b;
        border-left-color: #ef4444;
    }
    
    .alert ul {
        margin: 0;
        padding-left: 20px;
    }
    
    .alert li {
        margin: 4px 0;
    }
    
    /* TinyMCE custom styles */
    .tox-tinymce {
        border-radius: 12px !important;
        border: 2px solid #e5e7eb !important;
        box-shadow: none !important;
    }
    
    .tox-tinymce:focus-within {
        border-color: #D93690 !important;
        box-shadow: 0 0 0 4px rgba(217, 54, 144, 0.1) !important;
    }
    
    @media (max-width: 768px) {
        .form-row {
            grid-template-columns: 1fr;
            gap: 16px;
        }
        
        .form-body {
            padding: 24px;
        }
        
        .btn-group {
            padding: 24px;
            flex-direction: column;
            gap: 12px;
        }
        
        .btn-primary-group {
            width: 100%;
            flex-direction: column;
        }
        
        .btn {
            width: 100%;
            justify-content: center;
        }
        
        .page-header {
            padding: 24px;
            text-align: center;
        }
        
        .page-header h1 {
            font-size: 1.8rem;
        }
    }
</style>
@endsection

@section('content')
<div>
    <!-- Header -->
    <div class="page-header">
        <h1>
            <i class="fas fa-edit"></i>
            Editar Artículo
        </h1>
        <p>Modificando: "{{ Str::limit($blogPost->title, 60) }}"</p>
    </div>

    <!-- Alertas -->
    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i>
            <div>
                <strong>¡Éxito!</strong> {{ session('success') }}
            </div>
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

    <!-- Formulario -->
    <form method="POST" action="{{ route('crm.blog.update', $blogPost->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="form-card">
            <div class="form-body">
                <!-- Información Básica -->
                <div class="form-section">
                    <h2 class="section-title">
                        <i class="fas fa-info-circle"></i>
                        Información Básica
                    </h2>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="title">Título del Artículo *</label>
                            <input type="text" id="title" name="title" class="form-control" 
                                   value="{{ old('title', $blogPost->title) }}" 
                                   placeholder="Escribe un título atractivo..." required>
                        </div>
                        
                        <div class="form-group">
                            <label for="excerpt">Extracto</label>
                            <input type="text" id="excerpt" name="excerpt" class="form-control" 
                                   value="{{ old('excerpt', $blogPost->excerpt) }}" 
                                   placeholder="Breve descripción del artículo...">
                            <div class="help-text">Resumen que aparecerá en las listas de artículos</div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="content">Contenido del Artículo *</label>
                        <textarea id="content" name="content" class="form-control" required>{{ old('content', $blogPost->content) }}</textarea>
                        <div class="help-text">Usa el editor para dar formato a tu contenido</div>
                    </div>
                </div>

                <!-- Categorización -->
                <div class="form-section">
                    <h2 class="section-title">
                        <i class="fas fa-tags"></i>
                        Categorización
                    </h2>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="category">Categoría</label>
                            <select id="category" name="category" class="form-control">
                                <option value="">Seleccionar categoría...</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category }}" {{ old('category', $blogPost->category) == $category ? 'selected' : '' }}>
                                        {{ $category }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="tags">Etiquetas</label>
                            <input type="text" id="tags" name="tags" class="form-control" 
                                   value="{{ old('tags', is_array($blogPost->tags) ? implode(', ', $blogPost->tags) : $blogPost->tags) }}" 
                                   placeholder="etiqueta1, etiqueta2, etiqueta3...">
                            <div class="help-text">
                                Sugerencias: {{ implode(', ', $suggestedTags ?? []) }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Imagen Destacada -->
                <div class="form-section">
                    <h2 class="section-title">
                        <i class="fas fa-image"></i>
                        Imagen Destacada
                    </h2>
                    
                    <div class="form-group">
                        <div class="file-upload-area">
                            <input type="file" id="featured_image" name="featured_image" accept="image/*">
                            <div class="upload-icon">
                                <i class="fas fa-cloud-upload-alt"></i>
                            </div>
                            <div class="upload-text">Cambiar imagen</div>
                            <div class="upload-hint">o arrastra y suelta aquí (JPG, PNG, máx. 2MB)</div>
                        </div>
                        
                        @if($blogPost->featured_image)
                            <div class="current-image">
                                <div class="current-image-label">Imagen actual:</div>
                                <img src="{{ asset('storage/' . $blogPost->featured_image) }}" alt="Imagen actual">
                            </div>
                        @endif
                    </div>
                </div>

                <!-- SEO y Metadatos -->
                <div class="form-section">
                    <h2 class="section-title">
                        <i class="fas fa-search"></i>
                        SEO y Metadatos
                    </h2>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="meta_title">Meta Título</label>
                            <input type="text" id="meta_title" name="meta_title" class="form-control" 
                                   value="{{ old('meta_title', $blogPost->meta_title) }}" 
                                   placeholder="Título para motores de búsqueda...">
                            <div class="help-text">Recomendado: 50-60 caracteres</div>
                        </div>
                        
                        <div class="form-group">
                            <label for="meta_description">Meta Descripción</label>
                            <textarea id="meta_description" name="meta_description" class="form-control" 
                                      placeholder="Descripción para motores de búsqueda...">{{ old('meta_description', $blogPost->meta_description) }}</textarea>
                            <div class="help-text">Recomendado: 150-160 caracteres</div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="og_title">Título Open Graph</label>
                            <input type="text" id="og_title" name="og_title" class="form-control" 
                                   value="{{ old('og_title', $blogPost->og_title) }}" 
                                   placeholder="Título para redes sociales...">
                        </div>
                        
                        <div class="form-group">
                            <label for="og_description">Descripción Open Graph</label>
                            <textarea id="og_description" name="og_description" class="form-control" 
                                      placeholder="Descripción para redes sociales...">{{ old('og_description', $blogPost->og_description) }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Estado de Publicación -->
                <div class="form-section">
                    <h2 class="section-title">
                        <i class="fas fa-globe"></i>
                        Publicación
                    </h2>
                    
                    <div class="checkbox-wrapper">
                        <input type="checkbox" id="published" name="published" value="1" 
                               {{ old('published', $blogPost->published) ? 'checked' : '' }}>
                        <label for="published">Artículo publicado</label>
                    </div>
                    <div class="help-text">Si no está marcado, se guardará como borrador</div>
                </div>
            </div>
            
            <!-- Botones de Acción -->
            <div class="btn-group">
                <a href="{{ route('crm.blog.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i>
                    Volver al Blog
                </a>
                
                <div class="btn-primary-group">
                    <a href="{{ route('crm.blog.show', $blogPost->id) }}" class="btn btn-info">
                        <i class="fas fa-eye"></i>
                        Ver Artículo
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i>
                        Actualizar Artículo
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Inicializar TinyMCE
    tinymce.init({
        selector: '#content',
        height: 500,
        menubar: false,
        plugins: [
            'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
            'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
            'insertdatetime', 'media', 'table', 'help', 'wordcount'
        ],
        toolbar: 'undo redo | blocks | bold italic forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
        content_style: 'body { font-family: Inter, Arial, sans-serif; font-size: 16px; line-height: 1.6; }',
        language: 'es',
        branding: false,
        promotion: false,
    });

    // Manejo de archivo
    const fileInput = document.getElementById('featured_image');
    const uploadArea = document.querySelector('.file-upload-area');
    const uploadText = document.querySelector('.upload-text');
    const uploadHint = document.querySelector('.upload-hint');
    
    fileInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            uploadText.innerHTML = `<i class="fas fa-check text-success"></i> ${file.name}`;
            uploadHint.textContent = `Nueva imagen seleccionada (${(file.size / 1024 / 1024).toFixed(2)} MB)`;
            uploadArea.style.borderColor = '#10b981';
            uploadArea.style.background = 'rgba(16, 185, 129, 0.1)';
        }
    });

    // Drag and drop
    uploadArea.addEventListener('dragover', function(e) {
        e.preventDefault();
        uploadArea.style.borderColor = '#D93690';
        uploadArea.style.background = 'rgba(217, 54, 144, 0.1)';
    });

    uploadArea.addEventListener('dragleave', function(e) {
        e.preventDefault();
        uploadArea.style.borderColor = '#d1d5db';
        uploadArea.style.background = '#fafafa';
    });

    uploadArea.addEventListener('drop', function(e) {
        e.preventDefault();
        uploadArea.style.borderColor = '#d1d5db';
        uploadArea.style.background = '#fafafa';
        
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            fileInput.files = files;
            fileInput.dispatchEvent(new Event('change'));
        }
    });

    console.log('Editor de blog (edición) inicializado correctamente');
});
</script>
@endsection