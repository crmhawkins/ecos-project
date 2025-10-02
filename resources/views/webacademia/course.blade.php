@extends('webacademia.layouts.web_layout')

@section('title', 'Course')

@section('css')

<style>
    .loading {
        text-align: center;
        padding: 20px;
    }

    .search-bar {
        margin-bottom: 20px;
    }

    .search-bar .form-control {
        border-radius: 25px 0 0 25px;
        border-right: none;
        padding: 12px 20px;
        font-size: 16px;
    }

    .search-bar .btn {
        border-radius: 0 25px 25px 0;
        padding: 12px 20px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
    }

    /* Asegurar que el grid funcione correctamente */
    #course-container {
        display: flex;
        flex-wrap: wrap;
        margin-left: -15px;
        margin-right: -15px;
    }

    #course-container .course-item {
        padding-left: 15px;
        padding-right: 15px;
        margin-bottom: 30px;
    }

    /* Responsive grid fixes */
    @media (max-width: 991.98px) {
        #course-container .course-item.col-lg-4 {
            flex: 0 0 50%;
            max-width: 50%;
        }
    }

    @media (max-width: 767.98px) {
        #course-container .course-item.col-lg-4 {
            flex: 0 0 100%;
            max-width: 100%;
        }
    }

    /* Asegurar altura uniforme de las tarjetas */
    .course-item {
        display: flex;
        align-items: stretch;
    }

    .course-card {
        width: 100%;
        display: flex;
        flex-direction: column;
    }

    .search-bar .btn:hover {
        background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
    }

    #category-select {
        border-radius: 25px;
        padding: 12px 20px;
        font-size: 16px;
    }

    .sidebar-widget {
        background: #fff;
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        margin-bottom: 20px;
    }

    .widget-title {
        color: #333;
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid #f0f0f0;
    }

    .category-list {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .category-link {
        text-decoration: none;
        color: #666;
        font-weight: 500;
        padding: 12px 15px;
        border-radius: 8px;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .category-link:hover {
        color: #fff;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        transform: translateX(5px);
        text-decoration: none;
    }

    .category-link.active {
        color: #fff;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        text-decoration: none;
    }

    .stats-info {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .stat-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 10px;
        background: #f8f9fa;
        border-radius: 8px;
    }

    .stat-item i {
        font-size: 20px;
        width: 24px;
        text-align: center;
    }

    .stat-item span {
        font-weight: 500;
        color: #333;
    }

    #results-count {
        font-size: 14px;
        font-weight: 500;
    }

    #no-results {
        background: #f8f9fa;
        border-radius: 15px;
        margin: 20px 0;
    }
</style>
@endsection

@section('content')
<section class="section-top">
    <div class="container">
        <div class="col-lg-10 offset-lg-1 text-center">
            <div class="section-top-title wow fadeInRight">
                <h1>Todos los cursos</h1>
                <ul>
                    <li><a href="{{ url('/') }}">Inicio</a></li>
                    <li> / Cursos</li>
                </ul>
                @if($isLoggedIn)
                    <p class="mt-3 text-success">
                        <i class="fa fa-user"></i> Bienvenido, {{ $user->name }}
                    </p>
                @else
                    <p class="mt-3 text-info">
                        <i class="fa fa-info-circle"></i> 
                        <a href="{{ url('/weblogin') }}" class="text-primary">Inicia sesión</a> 
                        para agregar cursos al carrito
                    </p>
                @endif
            </div>
        </div>
    </div>
</section>

<div class="best-cpurse section-padding">
    <div class="container">
        <div class="section-title">
            <h2>Cursos Disponibles</h2>
            <p>Explora nuestros <span><u>mejores cursos</u></span></p>
        </div>
        
        @if(session('error'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <i class="fa fa-exclamation-triangle"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        <!-- Barra de búsqueda y filtros -->
        <div class="row mb-4">
            <div class="col-lg-8">
                <div class="search-bar">
                    <div class="input-group">
                        <input type="text" id="search-input" class="form-control" placeholder="Buscar cursos por nombre o descripción...">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button" id="search-btn">
                                <i class="fa fa-search"></i> Buscar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <select id="category-select" class="form-control">
                    <option value="">Todas las categorías</option>
                    @foreach($categorias as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-9">
                <!-- Contador de resultados -->
                <div class="mb-3">
                    <span id="results-count" class="text-muted">Mostrando cursos...</span>
                </div>
                
                <div class="row" id="course-container">
                    @include('webacademia.partials.course_card', ['cursos' => $initialCursos])
                </div>
                <div id="loading" class="loading" style="display: none;">
                    <p>Cargando más cursos...</p>
                </div>
                
                <!-- Mensaje cuando no hay resultados -->
                <div id="no-results" style="display: none;" class="text-center py-5">
                    <i class="fa fa-search fa-3x text-muted mb-3"></i>
                    <h4>No se encontraron cursos</h4>
                    <p class="text-muted">Intenta con otros términos de búsqueda o selecciona una categoría diferente.</p>
                </div>
            </div>
            <div class="col-lg-3 mb-4">
                <div class="sidebar-widget">
                    <h4 class="widget-title">Categorías</h4>
                    <div class="category-list">
                        <a href="#" class="category-link active" data-id="">
                            <i class="fa fa-th-large"></i> Todas las categorías
                        </a>
                        @foreach($categorias as $cat)
                            <a href="#" class="category-link" data-id="{{ $cat->id }}">
                                <i class="fa fa-folder"></i> {{ $cat->name }}
                            </a>
                        @endforeach
                    </div>
                </div>
                
                <div class="sidebar-widget mt-4">
                    <h4 class="widget-title">Estadísticas</h4>
                    <div class="stats-info">
                        <div class="stat-item">
                            <i class="fa fa-graduation-cap text-primary"></i>
                            <span>{{ $initialCursos->count() }}+ Cursos disponibles</span>
                        </div>
                        <div class="stat-item">
                            <i class="fa fa-users text-success"></i>
                            <span>Miles de estudiantes</span>
                        </div>
                        <div class="stat-item">
                            <i class="fa fa-certificate text-warning"></i>
                            <span>Certificados oficiales</span>
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
    let offset = 0;
    let loading = false;
    let endReached = false;
    let selectedCategory = '';
    let searchTerm = '';

    function updateResultsCount(count, isReset = false) {
        const resultsCount = document.getElementById('results-count');
        if (isReset) {
            resultsCount.textContent = count > 0 ? `Mostrando ${count} cursos` : 'No se encontraron cursos';
        } else {
            resultsCount.textContent = `Mostrando ${count} cursos`;
        }
    }

    function showNoResults() {
        document.getElementById('no-results').style.display = 'block';
        document.getElementById('course-container').style.display = 'none';
    }

    function hideNoResults() {
        document.getElementById('no-results').style.display = 'none';
        document.getElementById('course-container').style.display = 'block';
    }

    function loadCourses({ reset = false } = {}) {
        if (reset) {
            offset = 0;
            endReached = false;
            loading = false;
            const container = document.getElementById('course-container');
            container.innerHTML = '';
            // Asegurar que el contenedor mantenga la clase 'row'
            container.className = 'row';
            document.getElementById('loading').innerHTML = '<p>Cargando más cursos...</p>';
            hideNoResults();
        }
        
        if (loading || endReached) return;

        loading = true;
        document.getElementById('loading').style.display = 'block';

        const params = new URLSearchParams({
            offset: offset,
            category_id: selectedCategory,
            search: searchTerm
        });

        fetch("{{ route('webacademia.courses') }}?" + params.toString(), {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(res => res.json())
        .then(data => {
            loading = false;
            document.getElementById('loading').style.display = 'none';
            
            console.log('Received data:', data);
            
            if (data.count > 0) {
                const container = document.getElementById('course-container');
                console.log('Container before:', container.children.length, 'courses');
                
                // Crear un elemento temporal para parsear el HTML
                const tempDiv = document.createElement('div');
                tempDiv.innerHTML = data.html;
                
                console.log('Parsed HTML children:', tempDiv.children.length);
                
                // Insertar cada elemento hijo directamente
                while (tempDiv.firstChild) {
                    container.appendChild(tempDiv.firstChild);
                }
                
                console.log('Container after:', container.children.length, 'courses');
                
                // Forzar recalculo del layout y verificar grid
                container.style.display = 'none';
                container.offsetHeight; // Trigger reflow
                container.style.display = 'flex';
                
                // Verificar que todas las tarjetas tengan las clases correctas
                const courseItems = container.querySelectorAll('.course-item');
                courseItems.forEach((item, index) => {
                    if (!item.classList.contains('col-lg-4')) {
                        console.warn('Course item missing col-lg-4 class:', item);
                        item.classList.add('col-lg-4', 'col-md-6', 'col-sm-12');
                    }
                });
                
                offset += data.count;
                
                if (reset) {
                    updateResultsCount(data.count, true);
                }
            } else {
                if (reset && offset === 0) {
                    showNoResults();
                    updateResultsCount(0, true);
                } else {
                    endReached = true;
                    document.getElementById('loading').innerHTML = "<p>No hay más cursos disponibles.</p>";
                }
            }
        })
        .catch(error => {
            loading = false;
            document.getElementById('loading').style.display = 'none';
            console.error('Error loading courses:', error);
        });
    }

    // Búsqueda por texto
    function performSearch() {
        searchTerm = document.getElementById('search-input').value.trim();
        console.log('Performing search for:', searchTerm);
        loadCourses({ reset: true });
    }

    // Event listeners para búsqueda
    document.getElementById('search-btn').addEventListener('click', performSearch);
    
    document.getElementById('search-input').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            performSearch();
        }
    });

    // Búsqueda en tiempo real (opcional, con debounce)
    let searchTimeout;
    document.getElementById('search-input').addEventListener('input', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            performSearch();
        }, 500); // Esperar 500ms después de que el usuario deje de escribir
    });

    // Filtro por categoría (select)
    document.getElementById('category-select').addEventListener('change', function() {
        selectedCategory = this.value;
        
        // Actualizar enlaces de categoría en sidebar
        document.querySelectorAll('.category-link').forEach(l => l.classList.remove('active'));
        const activeLink = document.querySelector(`.category-link[data-id="${selectedCategory}"]`);
        if (activeLink) {
            activeLink.classList.add('active');
        } else {
            document.querySelector('.category-link[data-id=""]').classList.add('active');
        }
        
        loadCourses({ reset: true });
    });

    // Filtro por categoría (sidebar links)
    document.querySelectorAll('.category-link').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();

            document.querySelectorAll('.category-link').forEach(l => l.classList.remove('active'));
            this.classList.add('active');

            selectedCategory = this.dataset.id;
            document.getElementById('category-select').value = selectedCategory;
            
            loadCourses({ reset: true });
        });
    });

    // Scroll infinito
    window.addEventListener('scroll', () => {
        if (!endReached && (window.innerHeight + window.scrollY) >= document.body.offsetHeight - 300) {
            loadCourses();
        }
    });

    // Función para inicializar el grid correctamente
    function initializeGrid() {
        const container = document.getElementById('course-container');
        if (container) {
            // Asegurar que el contenedor tenga las clases correctas
            container.className = 'row';
            
            // Aplicar estilos de flexbox
            container.style.display = 'flex';
            container.style.flexWrap = 'wrap';
            container.style.marginLeft = '-15px';
            container.style.marginRight = '-15px';
            
            console.log('Grid initialized with', container.children.length, 'courses');
        }
    }

    // Inicializar contador de resultados y grid
    document.addEventListener('DOMContentLoaded', function() {
        initializeGrid();
        
        const initialCount = document.querySelectorAll('.course-item').length;
        updateResultsCount(initialCount, true);
        
        console.log('Page loaded with', initialCount, 'initial courses');
        
        // Solo cargar más cursos si hay menos de 9 cursos iniciales
        if (initialCount < 9) {
            setTimeout(() => {
                loadCourses();
            }, 500);
        }
    });
</script>
@endsection
