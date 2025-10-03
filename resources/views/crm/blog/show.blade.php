@extends('crm.layouts.clean_app')

@section('titulo', 'Ver Artículo')

@section('css')
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

    .action-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 32px;
        padding: 20px 24px;
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    }
    
    .action-group {
        display: flex;
        gap: 12px;
        align-items: center;
    }
    
    .btn {
        padding: 12px 24px;
        border-radius: 12px;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.95rem;
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
    
    .btn-danger {
        background: #ef4444;
        color: white;
    }
    
    .btn-danger:hover {
        background: #dc2626;
        color: white;
    }

    .article-header {
        background: linear-gradient(135deg, #D93690 0%, #8B5CF6 100%);
        color: white;
        padding: 40px;
        border-radius: 16px;
        margin-bottom: 32px;
        box-shadow: 0 10px 30px rgba(217, 54, 144, 0.3);
        position: relative;
        overflow: hidden;
    }
    
    .article-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
        animation: pulse 6s ease-in-out infinite;
    }
    
    @keyframes pulse {
        0%, 100% { transform: scale(1) rotate(0deg); opacity: 0.3; }
        50% { transform: scale(1.1) rotate(180deg); opacity: 0.6; }
    }
    
    .article-title {
        font-size: 2.5rem;
        font-weight: 900;
        margin: 0 0 16px 0;
        line-height: 1.2;
        position: relative;
        z-index: 1;
    }
    
    .article-excerpt {
        font-size: 1.2rem;
        opacity: 0.9;
        margin: 0 0 24px 0;
        line-height: 1.5;
        position: relative;
        z-index: 1;
    }
    
    .article-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 24px;
        align-items: center;
        font-size: 1rem;
        position: relative;
        z-index: 1;
    }
    
    .meta-item {
        display: flex;
        align-items: center;
        gap: 8px;
        opacity: 0.9;
    }
    
    .meta-item i {
        font-size: 1.1rem;
    }
    
    .status-badge {
        padding: 8px 16px;
        border-radius: 25px;
        font-size: 0.9rem;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .status-published {
        background: rgba(255, 255, 255, 0.2);
        color: white;
        border: 2px solid rgba(255, 255, 255, 0.3);
    }
    
    .status-draft {
        background: rgba(255, 255, 255, 0.1);
        color: rgba(255, 255, 255, 0.8);
        border: 2px solid rgba(255, 255, 255, 0.2);
    }

    .content-layout {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 32px;
        margin-bottom: 32px;
    }
    
    .main-content {
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }
    
    .featured-image {
        width: 100%;
        height: 300px;
        object-fit: cover;
        display: block;
    }
    
    .content-body {
        padding: 40px;
    }
    
    .content-text {
        font-size: 1.1rem;
        line-height: 1.8;
        color: #1f2937;
    }
    
    .content-text h1, .content-text h2, .content-text h3 {
        color: #1f2937;
        margin-top: 2rem;
        margin-bottom: 1rem;
    }
    
    .content-text p {
        margin-bottom: 1.5rem;
    }
    
    .content-text img {
        max-width: 100%;
        height: auto;
        border-radius: 12px;
        margin: 24px 0;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
    
    .sidebar {
        display: flex;
        flex-direction: column;
        gap: 24px;
    }
    
    .sidebar-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }
    
    .sidebar-header {
        background: linear-gradient(135deg, #f8fafc, #e5e7eb);
        padding: 20px 24px;
        border-bottom: 1px solid #e5e7eb;
    }
    
    .sidebar-header h3 {
        margin: 0;
        font-size: 1.2rem;
        font-weight: 700;
        color: #1f2937;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .sidebar-body {
        padding: 24px;
    }
    
    .info-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 0;
        border-bottom: 1px solid #f1f5f9;
    }
    
    .info-item:last-child {
        border-bottom: none;
    }
    
    .info-label {
        font-weight: 600;
        color: #4b5563;
    }
    
    .info-value {
        color: #1f2937;
        font-weight: 500;
    }
    
    .tags-container {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }
    
    .tag {
        background: rgba(217, 54, 144, 0.1);
        color: #D93690;
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        border: 1px solid rgba(217, 54, 144, 0.2);
    }
    
    .no-tags {
        color: var(--text-secondary);
        font-style: italic;
        font-size: 0.9rem;
    }
    
    .stats-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }
    
    .stat-item {
        text-align: center;
        padding: 16px;
        background: #f8fafc;
        border-radius: 12px;
        border: 1px solid #e5e7eb;
    }
    
    .stat-number {
        font-size: 1.5rem;
        font-weight: 800;
        color: #D93690;
        margin-bottom: 4px;
    }
    
    .stat-label {
        font-size: 0.85rem;
        color: #6b7280;
        font-weight: 500;
    }
    
    .seo-info {
        background: #f8fafc;
        padding: 16px;
        border-radius: 12px;
        border-left: 4px solid #D93690;
    }
    
    .seo-item {
        margin-bottom: 12px;
    }
    
    .seo-item:last-child {
        margin-bottom: 0;
    }
    
    .seo-label {
        font-weight: 600;
        color: #4b5563;
        font-size: 0.9rem;
        display: block;
        margin-bottom: 4px;
    }
    
    .seo-value {
        color: #1f2937;
        font-size: 0.9rem;
        line-height: 1.4;
    }
    
    .empty-value {
        color: #9ca3af;
        font-style: italic;
    }
    
    @media (max-width: 1024px) {
        .content-layout {
            grid-template-columns: 1fr;
            gap: 24px;
        }
        
        .action-bar {
            flex-direction: column;
            gap: 16px;
            align-items: stretch;
        }
        
        .action-group {
            justify-content: center;
        }
    }
    
    @media (max-width: 768px) {
        .article-header {
            padding: 24px;
            text-align: center;
        }
        
        .article-title {
            font-size: 2rem;
        }
        
        .article-excerpt {
            font-size: 1.1rem;
        }
        
        .article-meta {
            justify-content: center;
            gap: 16px;
        }
        
        .content-body {
            padding: 24px;
        }
        
        .sidebar-body {
            padding: 20px;
        }
        
        .stats-grid {
            grid-template-columns: 1fr;
        }
        
        .btn {
            width: 100%;
            justify-content: center;
        }
    }
</style>
@endsection

@section('content')
<div>
    <!-- Barra de Acciones -->
    <div class="action-bar">
        <div class="action-group">
            <a href="{{ route('crm.blog.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i>
                Volver al Blog
            </a>
        </div>
        
        <div class="action-group">
            <a href="{{ route('crm.blog.edit', $blogPost->id) }}" class="btn btn-primary">
                <i class="fas fa-edit"></i>
                Editar Artículo
            </a>
            <form method="POST" action="{{ route('crm.blog.destroy', $blogPost->id) }}" style="display: inline;" 
                  onsubmit="return confirm('¿Estás seguro de que quieres eliminar este artículo? Esta acción no se puede deshacer.')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-trash"></i>
                    Eliminar
                </button>
            </form>
        </div>
    </div>

    <!-- Header del Artículo -->
    <div class="article-header">
        <h1 class="article-title">{{ $blogPost->title }}</h1>
        
        @if($blogPost->excerpt)
            <p class="article-excerpt">{{ $blogPost->excerpt }}</p>
        @endif
        
        <div class="article-meta">
            <div class="meta-item">
                <i class="fas fa-user"></i>
                <span>{{ $blogPost->author->name ?? 'Autor desconocido' }}</span>
            </div>
            
            <div class="meta-item">
                <i class="fas fa-calendar"></i>
                <span>{{ $blogPost->created_at->format('d/m/Y H:i') }}</span>
            </div>
            
            <div class="meta-item">
                <i class="fas fa-eye"></i>
                <span>{{ $blogPost->views ?? 0 }} visualizaciones</span>
            </div>
            
            <div class="meta-item">
                <span class="status-badge {{ $blogPost->published ? 'status-published' : 'status-draft' }}">
                    <i class="fas fa-{{ $blogPost->published ? 'check-circle' : 'clock' }}"></i>
                    {{ $blogPost->published ? 'Publicado' : 'Borrador' }}
                </span>
            </div>
        </div>
    </div>

    <!-- Contenido Principal -->
    <div class="content-layout">
        <!-- Artículo -->
        <div class="main-content">
            @if($blogPost->featured_image)
                <img src="{{ asset('storage/' . $blogPost->featured_image) }}" 
                     alt="{{ $blogPost->title }}" 
                     class="featured-image">
            @endif
            
            <div class="content-body">
                <div class="content-text">
                    {!! $blogPost->content !!}
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Información General -->
            <div class="sidebar-card">
                <div class="sidebar-header">
                    <h3>
                        <i class="fas fa-info-circle"></i>
                        Información
                    </h3>
                </div>
                <div class="sidebar-body">
                    <div class="info-item">
                        <span class="info-label">Categoría:</span>
                        <span class="info-value">{{ $blogPost->category ?: 'Sin categoría' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Tiempo de lectura:</span>
                        <span class="info-value">{{ $blogPost->reading_time ?? 5 }} min</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Publicado:</span>
                        <span class="info-value">
                            {{ $blogPost->published_at ? $blogPost->published_at->format('d/m/Y H:i') : 'No publicado' }}
                        </span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Slug:</span>
                        <span class="info-value" style="font-family: monospace; font-size: 0.85rem;">{{ $blogPost->slug }}</span>
                    </div>
                </div>
            </div>

            <!-- Etiquetas -->
            @if($blogPost->tags)
            <div class="sidebar-card">
                <div class="sidebar-header">
                    <h3>
                        <i class="fas fa-tags"></i>
                        Etiquetas
                    </h3>
                </div>
                <div class="sidebar-body">
                    <div class="tags-container">
                        @if($blogPost->tags)
                            @php
                                $tags = is_array($blogPost->tags) ? $blogPost->tags : explode(',', $blogPost->tags);
                            @endphp
                            @foreach($tags as $tag)
                                <span class="tag">{{ trim($tag) }}</span>
                            @endforeach
                        @else
                            <span class="no-tags">Sin etiquetas</span>
                        @endif
                    </div>
                </div>
            </div>
            @endif

            <!-- Estadísticas -->
            <div class="sidebar-card">
                <div class="sidebar-header">
                    <h3>
                        <i class="fas fa-chart-bar"></i>
                        Estadísticas
                    </h3>
                </div>
                <div class="sidebar-body">
                    <div class="stats-grid">
                        <div class="stat-item">
                            <div class="stat-number">{{ $blogPost->views ?? 0 }}</div>
                            <div class="stat-label">Visualizaciones</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">{{ str_word_count(strip_tags($blogPost->content)) }}</div>
                            <div class="stat-label">Palabras</div>
                        </div>
                    </div>
                    
                    <div class="info-item" style="margin-top: 16px;">
                        <span class="info-label">Creado:</span>
                        <span class="info-value">{{ $blogPost->created_at->diffForHumans() }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Actualizado:</span>
                        <span class="info-value">{{ $blogPost->updated_at->diffForHumans() }}</span>
                    </div>
                </div>
            </div>

            <!-- SEO -->
            <div class="sidebar-card">
                <div class="sidebar-header">
                    <h3>
                        <i class="fas fa-search"></i>
                        SEO
                    </h3>
                </div>
                <div class="sidebar-body">
                    <div class="seo-info">
                        <div class="seo-item">
                            <span class="seo-label">Meta Título:</span>
                            <div class="seo-value">
                                {{ $blogPost->meta_title ?: 'No definido' }}
                            </div>
                        </div>
                        
                        <div class="seo-item">
                            <span class="seo-label">Meta Descripción:</span>
                            <div class="seo-value">
                                {{ $blogPost->meta_description ? Str::limit($blogPost->meta_description, 120) : 'No definida' }}
                            </div>
                        </div>
                        
                        <div class="seo-item">
                            <span class="seo-label">Open Graph Título:</span>
                            <div class="seo-value">
                                {{ $blogPost->og_title ?: 'No definido' }}
                            </div>
                        </div>
                        
                        <div class="seo-item">
                            <span class="seo-label">Open Graph Descripción:</span>
                            <div class="seo-value">
                                {{ $blogPost->og_description ? Str::limit($blogPost->og_description, 120) : 'No definida' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('Vista de artículo cargada correctamente');
    console.log('Artículo:', {
        id: {{ $blogPost->id }},
        title: '{{ addslashes($blogPost->title) }}',
        published: {{ $blogPost->published ? 'true' : 'false' }},
        views: {{ $blogPost->views ?? 0 }}
    });
});
</script>
@endsection