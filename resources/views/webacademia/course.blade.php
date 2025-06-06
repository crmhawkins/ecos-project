@extends('webacademia.layouts.web_layout')

@section('title', 'Course')

@section('css')

<style>
    .loading {
        text-align: center;
        padding: 20px;
    }

    .category-list {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 10px;
    }

    .category-link {
        text-decoration: none;
        color: #333;
        font-weight: 500;
        padding: 5px 10px;
        transition: color 0.2s;
    }

    .category-link:hover {
        color: #D93690;
    }

    .category-link.active {
        color: #D93690;
        text-decoration: none;
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
            </div>
        </div>
    </div>
</section>

<div class="best-cpurse section-padding">
    <div class="container">
        <div class="section-title">
            <h2>Cursos Populares</h2>
            <p>Explora nuestros <span><u>mejores cursos</u></span></p>
        </div>
        <div class="row">
            <div class="col-lg-9">
                <div class="row" id="course-container">
                    @include('webacademia.partials.course_card', ['cursos' => $initialCursos])
                </div>
                <div id="loading" class="loading" style="display: none;">
                    <p>Cargando más cursos...</p>
                </div>
            </div>
            <div class="col-lg-3 mb-4">
                <h3 class="text-center h3">Categorias</h3>
               <div class="category-list">
                    <a href="#" class="category-link active" data-id="">Todos</a>
                    @foreach($categorias as $cat)
                        <a href="#" class="category-link" data-id="{{ $cat->id }}">{{ $cat->name }}</a>
                    @endforeach
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

    function loadCourses({ reset = false } = {}) {

        if (reset) {
            offset = 0;
            endReached = false;
            loading = false;
            document.getElementById('course-container').innerHTML = '';
            document.getElementById('loading').innerHTML = '<p>Cargando más cursos...</p>';
        }
        if (loading || endReached) return;

        loading = true;
        document.getElementById('loading').style.display = 'block';

        fetch("{{ route('webacademia.courses') }}?offset=" + offset + "&category_id=" + selectedCategory, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(res => res.json())
        .then(data => {
            if (data.count > 0) {
                document.getElementById('course-container').insertAdjacentHTML('beforeend', data.html);
                offset += data.count;
                loading = false;
                document.getElementById('loading').style.display = 'none';
            } else {
                endReached = true;
                document.getElementById('loading').innerHTML = "<p>No hay más cursos disponibles.</p>";
            }
        });
    }

    document.querySelectorAll('.category-link').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();

            document.querySelectorAll('.category-link').forEach(l => l.classList.remove('active'));
            this.classList.add('active');

            selectedCategory = this.dataset.id;
            loadCourses({ reset: true });
        });
    });

    window.addEventListener('scroll', () => {
        if (!endReached && (window.innerHeight + window.scrollY) >= document.body.offsetHeight - 300) {
            loadCourses();
        }
    });
</script>
@endsection
