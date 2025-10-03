@extends('webacademia.layouts.web_layout')

@section('title', $post->meta_title ?: $post->title)

@section('css')
<!-- SEO Meta Tags -->
<meta name="description" content="{{ $post->meta_description ?: $post->excerpt }}">
@if($post->meta_keywords)
    <meta name="keywords" content="{{ implode(', ', $post->meta_keywords) }}">
@endif

<!-- Open Graph Meta Tags -->
<meta property="og:title" content="{{ $post->og_title ?: $post->title }}">
<meta property="og:description" content="{{ $post->og_description ?: $post->excerpt }}">
<meta property="og:type" content="article">
<meta property="og:url" content="{{ $post->url }}">
@if($post->og_image)
    <meta property="og:image" content="{{ asset('storage/' . $post->og_image) }}">
@elseif($post->featured_image)
    <meta property="og:image" content="{{ asset('storage/' . $post->featured_image) }}">
@endif

<!-- Twitter Card Meta Tags -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $post->og_title ?: $post->title }}">
<meta name="twitter:description" content="{{ $post->og_description ?: $post->excerpt }}">
@if($post->og_image)
    <meta name="twitter:image" content="{{ asset('storage/' . $post->og_image) }}">
@elseif($post->featured_image)
    <meta name="twitter:image" content="{{ asset('storage/' . $post->featured_image) }}">
@endif

<!-- Article Meta Tags -->
<meta property="article:published_time" content="{{ $post->published_at->toISOString() }}">
<meta property="article:modified_time" content="{{ $post->updated_at->toISOString() }}">
<meta property="article:author" content="{{ $post->author->name ?? 'Grupo Ecos' }}">
<meta property="article:section" content="{{ ucfirst($post->category) }}">
@if($post->tags)
    @foreach($post->tags as $tag)
        <meta property="article:tag" content="{{ $tag }}">
    @endforeach
@endif

<style>
/* Estilo para el artículo individual */
.article-hero {
    background: linear-gradient(135deg, #D93690 0%, #667eea 100%);
    padding: 80px 0 40px 0;
    color: white;
    position: relative;
    overflow: hidden;
}

.article-hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="50" cy="50" r="1" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
    opacity: 0.3;
}

.article-meta {
    background: rgba(255,255,255,0.1);
    border-radius: 25px;
    padding: 15px 25px;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255,255,255,0.2);
    display: inline-flex;
    align-items: center;
    gap: 20px;
    margin-top: 20px;
    flex-wrap: wrap;
}

.article-meta-item {
    display: flex;
    align-items: center;
    gap: 8px;
    color: rgba(255,255,255,0.9);
    font-size: 14px;
    font-weight: 500;
}

.custom-breadcrumb {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 14px;
    font-weight: 500;
    flex-wrap: wrap;
}

.custom-breadcrumb a {
    color: rgba(255,255,255,0.9);
    text-decoration: none;
    padding: 8px 12px;
    border-radius: 20px;
    background: rgba(255,255,255,0.1);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255,255,255,0.2);
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 5px;
}

.custom-breadcrumb a:hover {
    background: rgba(255,255,255,0.2);
    color: white;
    text-decoration: none;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

.custom-breadcrumb .separator {
    color: rgba(255,255,255,0.6);
    font-weight: 300;
    margin: 0 5px;
}

.custom-breadcrumb .current {
    color: white;
    font-weight: 600;
    padding: 8px 12px;
    border-radius: 20px;
    background: rgba(255,255,255,0.15);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255,255,255,0.3);
}

.article-content {
    padding: 80px 0;
    background: linear-gradient(135deg, #f8fafc 0%, #e9ecef 100%);
}

.article-body {
    background: white;
    border-radius: 20px;
    padding: 50px;
    box-shadow: 0 20px 60px rgba(0,0,0,0.1);
    border: 1px solid #e2e8f0;
    margin-bottom: 40px;
}

.article-body h1, .article-body h2, .article-body h3, .article-body h4 {
    color: #2d3748;
    font-weight: 700;
    margin-top: 30px;
    margin-bottom: 15px;
}

.article-body h2 {
    font-size: 28px;
    border-bottom: 3px solid #D93690;
    padding-bottom: 10px;
}

.article-body h3 {
    font-size: 22px;
    color: #4a5568;
}

.article-body p {
    line-height: 1.8;
    margin-bottom: 20px;
    color: #4a5568;
    font-size: 16px;
}

.article-body ul, .article-body ol {
    margin: 20px 0;
    padding-left: 30px;
}

.article-body li {
    margin-bottom: 8px;
    line-height: 1.6;
    color: #4a5568;
}

.article-body blockquote {
    background: linear-gradient(135deg, #f7fafc 0%, #edf2f7 100%);
    border-left: 4px solid #D93690;
    padding: 20px 25px;
    margin: 30px 0;
    border-radius: 8px;
    font-style: italic;
    color: #2d3748;
}

.article-body strong {
    color: #2d3748;
    font-weight: 600;
}

.article-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-top: 30px;
    padding-top: 30px;
    border-top: 1px solid #e2e8f0;
}

.article-tag {
    background: linear-gradient(135deg, #D93690 0%, #ff6b9d 100%);
    color: white;
    padding: 6px 15px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    text-decoration: none;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    transition: all 0.3s ease;
}

.article-tag:hover {
    background: linear-gradient(135deg, #ff6b9d 0%, #D93690 100%);
    color: white;
    text-decoration: none;
    transform: scale(1.05);
}

.article-author {
    background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
    border-radius: 20px;
    padding: 30px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    border: 1px solid #e2e8f0;
    text-align: center;
}

.article-author h4 {
    color: #2d3748;
    margin-bottom: 10px;
}

.article-author p {
    color: #718096;
    margin: 0;
}

.related-articles {
    background: white;
    padding: 60px 0;
}

.related-article-card {
    background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
    border: 1px solid #e2e8f0;
    height: 100%;
}

.related-article-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.15);
}

.related-article-image {
    height: 150px;
    background: linear-gradient(135deg, #D93690 0%, #667eea 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 16px;
    font-weight: 600;
}

.related-article-content {
    padding: 20px;
}

.related-article-title {
    font-size: 16px;
    font-weight: 700;
    color: #2d3748;
    margin-bottom: 10px;
    line-height: 1.4;
}

.related-article-title a {
    color: inherit;
    text-decoration: none;
    transition: all 0.3s ease;
}

.related-article-title a:hover {
    color: #D93690;
}

.related-article-meta {
    font-size: 12px;
    color: #718096;
    margin-bottom: 10px;
}

.related-article-excerpt {
    font-size: 14px;
    color: #718096;
    line-height: 1.5;
}

/* Responsive */
@media (max-width: 768px) {
    .article-hero {
        padding: 60px 0 30px 0;
    }
    
    .article-body {
        padding: 30px 20px;
    }
    
    .article-content {
        padding: 60px 0;
    }
    
    .article-meta {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
    }
    
    .custom-breadcrumb {
        font-size: 12px;
        gap: 5px;
    }
    
    .custom-breadcrumb a,
    .custom-breadcrumb .current {
        padding: 6px 10px;
        font-size: 12px;
    }
    
    .custom-breadcrumb .current {
        max-width: 200px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
}
</style>
@endsection

@section('content')

<!-- HERO SECTION DEL ARTÍCULO -->
<section class="article-hero">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <nav class="custom-breadcrumb mb-4">
                    <a href="{{ url('/web/index') }}">
                        <i class="fas fa-home"></i> Inicio
                    </a>
                    <span class="separator">/</span>
                    <a href="{{ route('webacademia.blog') }}">Noticias</a>
                    <span class="separator">/</span>
                    <span class="current">{{ Str::limit($post->title, 50) }}</span>
                </nav>
                
                <h1 class="display-4 mb-3 text-white">{{ $post->title }}</h1>
                
                @if($post->excerpt)
                    <p class="lead text-white-50 mb-4">{{ $post->excerpt }}</p>
                @endif
                
                <div class="article-meta">
                    <div class="article-meta-item">
                        <i class="fas fa-calendar-alt"></i>
                        <span>{{ $post->formatted_published_at }}</span>
                    </div>
                    <div class="article-meta-item">
                        <i class="fas fa-user"></i>
                        <span>{{ $post->author->name ?? 'Grupo Ecos' }}</span>
                    </div>
                    <div class="article-meta-item">
                        <i class="fas fa-clock"></i>
                        <span>{{ $post->reading_time }} min lectura</span>
                    </div>
                    <div class="article-meta-item">
                        <i class="fas fa-eye"></i>
                        <span>{{ number_format($post->views_count) }} vistas</span>
                    </div>
                    @php
                        $categories = [
                            'formacion' => 'Formación',
                            'tecnologia' => 'Tecnología',
                            'educacion' => 'Educación',
                            'certificaciones' => 'Certificaciones',
                            'innovacion' => 'Innovación',
                            'empresa' => 'Empresa',
                            'noticias' => 'Noticias'
                        ];
                    @endphp
                    <div class="article-meta-item">
                        <i class="fas fa-folder"></i>
                        <span>{{ $categories[$post->category] ?? $post->category }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CONTENIDO DEL ARTÍCULO -->
<section class="article-content">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <!-- Imagen destacada -->
                @if($post->featured_image)
                    <div class="mb-4">
                        <img src="{{ asset('storage/' . $post->featured_image) }}" 
                             alt="{{ $post->title }}" 
                             class="img-fluid rounded shadow-lg"
                             style="width: 100%; height: 400px; object-fit: cover;">
                    </div>
                @endif
                
                <!-- Cuerpo del artículo -->
                <div class="article-body">
                    {!! $post->content !!}
                    
                    <!-- Tags -->
                    @if($post->tags && count($post->tags) > 0)
                        <div class="article-tags">
                            <strong style="color: #2d3748; margin-right: 10px;">Etiquetas:</strong>
                            @foreach($post->tags as $tag)
                                <span class="article-tag">{{ $tag }}</span>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
            
            <div class="col-lg-4">
                <!-- Información del autor -->
                <div class="article-author mb-4">
                    <h4>📝 Autor</h4>
                    <h5>{{ $post->author->name ?? 'Equipo Grupo Ecos' }}</h5>
                    <p>Especialistas en formación profesional y tecnología educativa, comprometidos con la excelencia en la educación online.</p>
                </div>
                
                <!-- Compartir en redes sociales -->
                <div class="article-author mb-4">
                    <h4>📢 Compartir</h4>
                    <div class="d-flex gap-2 justify-content-center">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($post->url) }}" 
                           target="_blank" 
                           class="btn btn-primary btn-sm">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode($post->url) }}&text={{ urlencode($post->title) }}" 
                           target="_blank" 
                           class="btn btn-info btn-sm">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode($post->url) }}" 
                           target="_blank" 
                           class="btn btn-primary btn-sm">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="https://wa.me/?text={{ urlencode($post->title . ' ' . $post->url) }}" 
                           target="_blank" 
                           class="btn btn-success btn-sm">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ARTÍCULOS RELACIONADOS -->
@if($relatedPosts->count() > 0)
<section class="related-articles">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 mb-3">📚 Artículos Relacionados</h2>
            <p class="lead text-muted">Continúa explorando contenido de tu interés</p>
        </div>
        
        <div class="row g-4">
            @foreach($relatedPosts as $relatedPost)
                <div class="col-lg-4 col-md-6">
                    <div class="related-article-card">
                        <div class="related-article-image">
                            @if($relatedPost->featured_image)
                                <img src="{{ asset('storage/' . $relatedPost->featured_image) }}" 
                                     alt="{{ $relatedPost->title }}" 
                                     style="width: 100%; height: 100%; object-fit: cover;">
                            @else
                                @php
                                    $icons = [
                                        'formacion' => 'fas fa-graduation-cap',
                                        'tecnologia' => 'fas fa-code',
                                        'educacion' => 'fas fa-book',
                                        'certificaciones' => 'fas fa-certificate',
                                        'innovacion' => 'fas fa-lightbulb',
                                        'empresa' => 'fas fa-building',
                                        'noticias' => 'fas fa-newspaper'
                                    ];
                                    $icon = $icons[$relatedPost->category] ?? 'fas fa-newspaper';
                                @endphp
                                <i class="{{ $icon }} fa-2x"></i>
                            @endif
                        </div>
                        <div class="related-article-content">
                            <div class="related-article-meta">
                                <i class="fas fa-calendar-alt"></i> {{ $relatedPost->formatted_published_at }}
                                <span class="mx-2">•</span>
                                <i class="fas fa-clock"></i> {{ $relatedPost->reading_time }} min
                            </div>
                            <h5 class="related-article-title">
                                <a href="{{ route('webacademia.blog.show', $relatedPost->slug) }}">
                                    {{ $relatedPost->title }}
                                </a>
                            </h5>
                            <p class="related-article-excerpt">
                                {{ Str::limit($relatedPost->excerpt, 100) }}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <div class="text-center mt-5">
            <a href="{{ route('webacademia.blog') }}" class="btn btn-outline-primary btn-lg">
                <i class="fas fa-arrow-left"></i> Ver Todas las Noticias
            </a>
        </div>
    </div>
</section>
@endif

@endsection

@section('scripts')
<script>
// Structured Data para SEO
const structuredData = {
    "@context": "https://schema.org",
    "@type": "Article",
    "headline": "{{ $post->title }}",
    "description": "{{ $post->excerpt }}",
    "author": {
        "@type": "Person",
        "name": "{{ $post->author->name ?? 'Grupo Ecos' }}"
    },
    "publisher": {
        "@type": "Organization",
        "name": "Grupo Ecos",
        "logo": {
            "@type": "ImageObject",
            "url": "{{ asset('assets/images/logo.png') }}"
        }
    },
    "datePublished": "{{ $post->published_at->toISOString() }}",
    "dateModified": "{{ $post->updated_at->toISOString() }}",
    @if($post->featured_image)
    "image": "{{ asset('storage/' . $post->featured_image) }}",
    @endif
    "mainEntityOfPage": {
        "@type": "WebPage",
        "@id": "{{ $post->url }}"
    }
};

// Insertar structured data
const script = document.createElement('script');
script.type = 'application/ld+json';
script.text = JSON.stringify(structuredData);
document.head.appendChild(script);
</script>
@endsection
