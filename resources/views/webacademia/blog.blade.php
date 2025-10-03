@extends('webacademia.layouts.web_layout')

@section('title', 'Blog')

@section('css')
<style>
/* Estilo moderno para el blog */
.blog-hero {
    background: linear-gradient(135deg, #D93690 0%, #667eea 100%);
    padding: 80px 0 40px 0;
    color: white;
    position: relative;
    overflow: hidden;
}

.blog-hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="50" cy="50" r="1" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
    opacity: 0.3;
}

.blog-hero h1 {
    font-size: 48px;
    font-weight: 800;
    margin-bottom: 15px;
    text-shadow: 0 2px 10px rgba(0,0,0,0.2);
    color: white !important;
}

.blog-hero .breadcrumb {
    background: rgba(255,255,255,0.1);
    border-radius: 25px;
    padding: 10px 20px;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255,255,255,0.2);
    display: inline-flex;
    align-items: center;
    gap: 8px;
    margin-top: 15px;
}

.blog-hero .breadcrumb a {
    color: white;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s ease;
}

.blog-hero .breadcrumb a:hover {
    color: #ff6b9d;
}

.blog-hero .breadcrumb span {
    color: rgba(255,255,255,0.8);
}

/* Sección del blog moderna */
.blog-section {
    padding: 80px 0;
    background: linear-gradient(135deg, #f8fafc 0%, #e9ecef 100%);
    position: relative;
}

.blog-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(135deg, #D93690 0%, #ff6b9d 50%, #667eea 100%);
}

/* Tarjetas de blog modernas */
.blog-card {
    background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    margin-bottom: 30px;
    border: 1px solid #e2e8f0;
    height: 100%;
    display: flex;
    flex-direction: column;
}

.blog-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.15);
}

.blog-card-image {
    height: 200px;
    background: linear-gradient(135deg, #D93690 0%, #667eea 100%);
    position: relative;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 18px;
    font-weight: 600;
}

.blog-card-image::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="dots" width="20" height="20" patternUnits="userSpaceOnUse"><circle cx="10" cy="10" r="1" fill="white" opacity="0.2"/></pattern></defs><rect width="100" height="100" fill="url(%23dots)"/></svg>');
}

.blog-card-content {
    padding: 25px;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
}

.blog-card-meta {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 15px;
    font-size: 13px;
    color: #718096;
    font-weight: 500;
}

.blog-card-date {
    display: flex;
    align-items: center;
    gap: 5px;
}

.blog-card-category {
    background: linear-gradient(135deg, #D93690 0%, #ff6b9d 100%);
    color: white;
    padding: 4px 12px;
    border-radius: 15px;
    text-decoration: none;
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    transition: all 0.3s ease;
}

.blog-card-category:hover {
    background: linear-gradient(135deg, #ff6b9d 0%, #D93690 100%);
    color: white;
    text-decoration: none;
    transform: scale(1.05);
}

.blog-card-title {
    font-size: 20px;
    font-weight: 700;
    color: #2d3748;
    margin-bottom: 15px;
    line-height: 1.4;
    flex-grow: 1;
}

.blog-card-title a {
    color: inherit;
    text-decoration: none;
    transition: all 0.3s ease;
}

.blog-card-title a:hover {
    color: #D93690;
}

.blog-read-more {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    color: #D93690;
    text-decoration: none;
    font-weight: 600;
    font-size: 14px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    transition: all 0.3s ease;
    margin-top: auto;
}

.blog-read-more:hover {
    color: #ff6b9d;
    text-decoration: none;
    transform: translateX(5px);
}

.blog-read-more svg {
    transition: all 0.3s ease;
    stroke: currentColor;
    fill: none;
    stroke-width: 2;
    stroke-linecap: round;
    stroke-linejoin: round;
}

.blog-read-more:hover svg {
    transform: translateX(3px);
}

/* Responsive */
@media (max-width: 768px) {
    .blog-hero {
        padding: 60px 0 30px 0;
    }
    
    .blog-hero h1 {
        font-size: 32px;
    }
    
    .blog-section {
        padding: 60px 0;
    }
    
    .blog-card-content {
        padding: 20px;
    }
    
    .blog-card-title {
        font-size: 18px;
    }
}

/* Animaciones */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.blog-card {
    animation: fadeInUp 0.6s ease-out;
    animation-fill-mode: both;
}

.blog-card:nth-child(1) { animation-delay: 0.1s; }
.blog-card:nth-child(2) { animation-delay: 0.2s; }
.blog-card:nth-child(3) { animation-delay: 0.3s; }
.blog-card:nth-child(4) { animation-delay: 0.4s; }
.blog-card:nth-child(5) { animation-delay: 0.5s; }
.blog-card:nth-child(6) { animation-delay: 0.6s; }

/* Grid responsive */
.blog-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 30px;
    align-items: stretch;
}

@media (max-width: 768px) {
    .blog-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }
}
</style>
@endsection

@section('content')

<!-- HERO SECTION DEL BLOG -->
<section class="blog-hero">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h1>📰 Últimas Noticias</h1>
                <p>Mantente al día con las últimas tendencias en formación profesional y tecnología</p>
                <div class="breadcrumb">
                    <a href="{{ url('/web/index') }}">
                        <i class="fas fa-home"></i> Inicio
                    </a>
                    <span>/</span>
                    <span>Noticias</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SECCIÓN DEL BLOG -->
<section class="blog-section">
    <div class="container">
        @if($posts->count() > 0)
            <div class="blog-grid">
                @foreach($posts as $index => $post)
                    <article class="blog-card" style="animation-delay: {{ 0.1 + ($index * 0.1) }}s;">
                        <div class="blog-card-image">
                            @if($post->featured_image)
                                <img src="{{ asset('storage/' . $post->featured_image) }}" 
                                     alt="{{ $post->title }}" 
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
                                    $icon = $icons[$post->category] ?? 'fas fa-newspaper';
                                @endphp
                                <i class="{{ $icon }} fa-3x"></i>
                                <span style="position: absolute; bottom: 15px; font-size: 14px;">{{ $post->title }}</span>
                            @endif
                        </div>
                        <div class="blog-card-content">
                            <div class="blog-card-meta">
                                <div class="blog-card-date">
                                    <i class="fas fa-calendar-alt"></i>
                                    <span>{{ $post->formatted_published_at }}</span>
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
                                <span class="blog-card-category">{{ $categories[$post->category] ?? $post->category }}</span>
                            </div>
                            <h2 class="blog-card-title">
                                <a href="{{ route('webacademia.blog.show', $post->slug) }}">{{ $post->title }}</a>
                            </h2>
                            <p style="color: #718096; margin-bottom: 20px; line-height: 1.6;">
                                {{ $post->excerpt }}
                            </p>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <small class="text-muted">
                                    <i class="fas fa-clock"></i> {{ $post->reading_time }} min lectura
                                </small>
                                <small class="text-muted">
                                    <i class="fas fa-eye"></i> {{ number_format($post->views_count) }} vistas
                                </small>
                            </div>
                            <a href="{{ route('webacademia.blog.show', $post->slug) }}" class="blog-read-more">
                                <span>Leer Más</span>
                                <svg width="13px" height="10px" viewBox="0 0 13 10">
                                    <path d="M1,5 L11,5"></path>
                                    <polyline points="8 1 12 5 8 9"></polyline>
                                </svg>
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>

            <!-- Paginación -->
            @if($posts->hasPages())
                <div class="d-flex justify-content-center mt-5">
                    <nav aria-label="Paginación del blog">
                        {{ $posts->links() }}
                    </nav>
                </div>
            @endif
        @else
            <!-- Estado vacío -->
            <div class="text-center py-5">
                <i class="fas fa-newspaper fa-5x text-muted mb-4"></i>
                <h3 class="text-muted">No hay noticias disponibles</h3>
                <p class="text-muted">Pronto publicaremos contenido interesante sobre formación profesional y tecnología.</p>
            </div>
        @endif
    </div>
</section>

@endsection
