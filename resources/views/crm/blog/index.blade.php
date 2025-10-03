@extends('crm.layouts.clean_app')

@section('titulo', 'Gestión de Blog')

@section('css')
<style>
    .blog-header {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        color: white;
        padding: 32px;
        border-radius: 12px;
        margin-bottom: 32px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .blog-header h1 {
        margin: 0;
        font-size: 2.2rem;
        font-weight: 800;
        display: flex;
        align-items: center;
        gap: 12px;
    }
    
    .btn-create {
        background: white;
        color: var(--primary-color);
        padding: 12px 24px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        transition: var(--transition);
        display: flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }
    
    .btn-create:hover {
        background: #f8f9fa;
        color: var(--primary-color);
        text-decoration: none;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0,0,0,0.2);
    }
    
    .filters-card {
        background: white;
        border-radius: 12px;
        box-shadow: var(--shadow);
        padding: 24px;
        margin-bottom: 24px;
    }
    
    .filters-row {
        display: grid;
        grid-template-columns: 2fr 1fr 1fr auto auto;
        gap: 16px;
        align-items: end;
    }
    
    .filter-group {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }
    
    .filter-group label {
        font-weight: 600;
        color: var(--text-primary);
        font-size: 0.9rem;
    }
    
    .form-control {
        padding: 10px 14px;
        border: 2px solid var(--border-color);
        border-radius: 8px;
        font-size: 0.95rem;
        transition: var(--transition);
        background: white;
        color: var(--text-primary);
    }
    
    .form-control:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(217, 54, 144, 0.1);
    }
    
    .btn-filter {
        background: var(--primary-color);
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
        display: flex;
        align-items: center;
        gap: 6px;
    }
    
    .btn-filter:hover {
        background: #c2185b;
    }
    
    .btn-clear {
        background: var(--text-secondary);
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
        display: flex;
        align-items: center;
        gap: 6px;
    }
    
    .btn-clear:hover {
        background: #4b5563;
    }
    
    .blog-table-card {
        background: white;
        border-radius: 12px;
        box-shadow: var(--shadow);
        overflow: hidden;
    }
    
    .table-header {
        background: #f8fafc;
        padding: 20px 24px;
        border-bottom: 1px solid var(--border-color);
    }
    
    .table-header h3 {
        margin: 0;
        font-size: 1.3rem;
        font-weight: 700;
        color: var(--text-primary);
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .blog-table {
        width: 100%;
        border-collapse: collapse;
    }
    
    .blog-table th {
        background: #f8fafc;
        padding: 16px 20px;
        text-align: left;
        font-weight: 700;
        color: var(--text-primary);
        border-bottom: 2px solid var(--border-color);
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .blog-table td {
        padding: 20px;
        border-bottom: 1px solid #f1f5f9;
        vertical-align: top;
    }
    
    .blog-table tr:hover {
        background: #f8fafc;
    }
    
    .post-image {
        width: 60px;
        height: 60px;
        border-radius: 8px;
        object-fit: cover;
        box-shadow: var(--shadow);
    }
    
    .post-image-placeholder {
        width: 60px;
        height: 60px;
        border-radius: 8px;
        background: linear-gradient(135deg, #e5e7eb, #d1d5db);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--text-secondary);
        font-size: 1.5rem;
    }
    
    .post-title {
        font-weight: 700;
        color: var(--text-primary);
        margin: 0 0 6px 0;
        font-size: 1.1rem;
        line-height: 1.4;
    }
    
    .post-excerpt {
        color: var(--text-secondary);
        font-size: 0.9rem;
        margin: 0;
        line-height: 1.4;
    }
    
    .category-badge {
        background: rgba(217, 54, 144, 0.1);
        color: var(--primary-color);
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        display: inline-block;
    }
    
    .author-info {
        display: flex;
        align-items: center;
        gap: 8px;
        color: var(--text-primary);
        font-weight: 500;
    }
    
    .author-avatar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: var(--primary-color);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 0.9rem;
    }
    
    .status-badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }
    
    .status-published {
        background: rgba(16, 185, 129, 0.1);
        color: var(--success-color);
    }
    
    .status-draft {
        background: rgba(107, 114, 128, 0.1);
        color: var(--text-secondary);
    }
    
    .views-count {
        display: flex;
        align-items: center;
        gap: 6px;
        color: var(--text-secondary);
        font-weight: 500;
    }
    
    .post-date {
        color: var(--text-secondary);
        font-size: 0.9rem;
        font-weight: 500;
    }
    
    .actions-group {
        display: flex;
        gap: 8px;
        align-items: center;
    }
    
    .btn-action {
        width: 36px;
        height: 36px;
        border-radius: 8px;
        border: none;
        cursor: pointer;
        transition: var(--transition);
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        font-size: 0.9rem;
    }
    
    .btn-view {
        background: rgba(59, 130, 246, 0.1);
        color: var(--info-color);
    }
    
    .btn-view:hover {
        background: var(--info-color);
        color: white;
    }
    
    .btn-edit {
        background: rgba(217, 54, 144, 0.1);
        color: var(--primary-color);
    }
    
    .btn-edit:hover {
        background: var(--primary-color);
        color: white;
    }
    
    .btn-delete {
        background: rgba(239, 68, 68, 0.1);
        color: var(--danger-color);
    }
    
    .btn-delete:hover {
        background: var(--danger-color);
        color: white;
    }
    
    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: var(--text-secondary);
    }
    
    .empty-state i {
        font-size: 4rem;
        margin-bottom: 16px;
        opacity: 0.5;
    }
    
    .empty-state h3 {
        margin: 0 0 8px 0;
        color: var(--text-primary);
    }
    
    .empty-state p {
        margin: 0 0 20px 0;
    }
    
    @media (max-width: 1024px) {
        .filters-row {
            grid-template-columns: 1fr;
            gap: 12px;
        }
        
        .blog-header {
            flex-direction: column;
            gap: 16px;
            text-align: center;
        }
        
        .blog-table {
            font-size: 0.9rem;
        }
        
        .blog-table th,
        .blog-table td {
            padding: 12px 16px;
        }
    }
    
    @media (max-width: 768px) {
        .blog-table-card {
            overflow-x: auto;
        }
        
        .blog-table {
            min-width: 800px;
        }
        
        .actions-group {
            flex-direction: column;
            gap: 4px;
        }
    }
</style>
@endsection

@section('content')
<div>
    <!-- Header -->
    <div class="blog-header">
        <h1>
            <i class="fas fa-newspaper"></i>
            Gestión de Blog
        </h1>
        <a href="{{ route('crm.blog.create') }}" class="btn-create">
            <i class="fas fa-plus"></i>
            Nueva Noticia
        </a>
    </div>

    <!-- Filtros -->
    <div class="filters-card">
        <form method="GET" action="{{ route('crm.blog.index') }}">
            <div class="filters-row">
                <div class="filter-group">
                    <label for="search">Buscar</label>
                    <input type="text" id="search" name="search" class="form-control" 
                           placeholder="Buscar por título o contenido..." 
                           value="{{ request('search') }}">
                </div>
                
                <div class="filter-group">
                    <label for="category">Categoría</label>
                    <select id="category" name="category" class="form-control">
                        <option value="">Todas las categorías</option>
                        @foreach($categories as $category)
                            <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>
                                {{ $category }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="filter-group">
                    <label for="status">Estado</label>
                    <select id="status" name="status" class="form-control">
                        <option value="">Todos los estados</option>
                        <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Publicado</option>
                        <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Borrador</option>
                    </select>
                </div>
                
                <button type="submit" class="btn-filter">
                    <i class="fas fa-search"></i>
                    Filtrar
                </button>
                
                <a href="{{ route('crm.blog.index') }}" class="btn-clear">
                    <i class="fas fa-times"></i>
                    Limpiar
                </a>
            </div>
        </form>
    </div>

    <!-- Tabla de Posts -->
    <div class="blog-table-card">
        <div class="table-header">
            <h3>
                <i class="fas fa-list"></i>
                Artículos del Blog ({{ $posts->total() }} total)
            </h3>
        </div>
        
        @if($posts->count() > 0)
            <table class="blog-table">
                <thead>
                    <tr>
                        <th>Imagen</th>
                        <th>Título</th>
                        <th>Categoría</th>
                        <th>Autor</th>
                        <th>Estado</th>
                        <th>Vistas</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $post)
                    <tr>
                        <td>
                            @if($post->featured_image)
                                <img src="{{ asset('storage/' . $post->featured_image) }}" 
                                     alt="{{ $post->title }}" class="post-image">
                            @else
                                <div class="post-image-placeholder">
                                    <i class="fas fa-image"></i>
                                </div>
                            @endif
                        </td>
                        
                        <td>
                            <h4 class="post-title">{{ Str::limit($post->title, 50) }}</h4>
                            @if($post->excerpt)
                                <p class="post-excerpt">{{ Str::limit($post->excerpt, 80) }}</p>
                            @endif
                        </td>
                        
                        <td>
                            @if($post->category)
                                <span class="category-badge">{{ $post->category }}</span>
                            @else
                                <span style="color: var(--text-secondary); font-style: italic;">Sin categoría</span>
                            @endif
                        </td>
                        
                        <td>
                            <div class="author-info">
                                <div class="author-avatar">
                                    {{ substr($post->author->name ?? 'A', 0, 1) }}
                                </div>
                                <span>{{ $post->author->name ?? 'Admin' }}</span>
                            </div>
                        </td>
                        
                        <td>
                            <span class="status-badge {{ $post->published ? 'status-published' : 'status-draft' }}">
                                <i class="fas fa-{{ $post->published ? 'check-circle' : 'clock' }}"></i>
                                {{ $post->published ? 'Publicado' : 'Borrador' }}
                            </span>
                        </td>
                        
                        <td>
                            <div class="views-count">
                                <i class="fas fa-eye"></i>
                                {{ $post->views ?? 0 }}
                            </div>
                        </td>
                        
                        <td>
                            <div class="post-date">
                                {{ $post->created_at->format('d/m/Y') }}<br>
                                <small style="color: var(--text-secondary);">{{ $post->created_at->format('H:i') }}</small>
                            </div>
                        </td>
                        
                        <td>
                            <div class="actions-group">
                                <a href="{{ route('crm.blog.show', $post->id) }}" 
                                   class="btn-action btn-view" title="Ver">
                                    <i class="fas fa-eye"></i>
                                </a>
                                
                                <a href="{{ route('crm.blog.edit', $post->id) }}" 
                                   class="btn-action btn-edit" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                                
                                <form method="POST" action="{{ route('crm.blog.destroy', $post->id) }}" 
                                      style="display: inline;" 
                                      onsubmit="return confirm('¿Estás seguro de que quieres eliminar este artículo?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action btn-delete" title="Eliminar">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="empty-state">
                <i class="fas fa-newspaper"></i>
                <h3>No hay artículos</h3>
                <p>No se encontraron artículos que coincidan con los filtros seleccionados.</p>
                <a href="{{ route('crm.blog.create') }}" class="btn-create">
                    <i class="fas fa-plus"></i>
                    Crear primer artículo
                </a>
            </div>
        @endif
    </div>

    <!-- Paginación -->
    @if($posts->hasPages())
        <div style="margin-top: 24px; display: flex; justify-content: center;">
            {{ $posts->appends(request()->query())->links() }}
        </div>
    @endif
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('Blog index cargado correctamente');
    console.log('Total de posts:', {{ $posts->total() }});
});
</script>
@endsection