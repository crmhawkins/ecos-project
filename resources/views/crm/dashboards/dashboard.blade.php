@extends('crm.layouts.clean_app')

@section('titulo', 'Dashboard Academia')

@section('css')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
    .dashboard-header {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        color: white;
        padding: 40px;
        border-radius: 12px;
        margin-bottom: 32px;
        text-align: center;
        box-shadow: var(--shadow-lg);
        position: relative;
        overflow: hidden;
    }
    
    .dashboard-header::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
        animation: pulse 4s ease-in-out infinite;
    }
    
    @keyframes pulse {
        0%, 100% { transform: scale(1); opacity: 0.5; }
        50% { transform: scale(1.1); opacity: 0.8; }
    }
    
    .dashboard-header h1 {
        font-size: 2.8rem;
        font-weight: 900;
        margin-bottom: 12px;
        position: relative;
        z-index: 1;
    }
    
    .dashboard-header p {
        font-size: 1.2rem;
        opacity: 0.9;
        margin: 0;
        position: relative;
        z-index: 1;
    }
    
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 24px;
        margin-bottom: 40px;
    }
    
    .stat-card {
        background: white;
        padding: 32px;
        border-radius: 16px;
        box-shadow: var(--shadow);
        text-align: center;
        border-left: 5px solid;
        transition: var(--transition);
        position: relative;
        overflow: hidden;
    }
    
    .stat-card::after {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        opacity: 0.1;
        font-family: 'Font Awesome 6 Free';
        font-weight: 900;
        font-size: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        transform: translate(20px, -20px);
    }
    
    .stat-card.alumnos {
        border-left-color: var(--primary-color);
    }
    
    .stat-card.alumnos::after {
        content: '\f501';
        background: var(--primary-color);
        color: white;
    }
    
    .stat-card.cursos {
        border-left-color: var(--info-color);
    }
    
    .stat-card.cursos::after {
        content: '\f19d';
        background: var(--info-color);
        color: white;
    }
    
    .stat-card.blog {
        border-left-color: var(--success-color);
    }
    
    .stat-card.blog::after {
        content: '\f1ea';
        background: var(--success-color);
        color: white;
    }
    
    .stat-card.categorias {
        border-left-color: var(--warning-color);
    }
    
    .stat-card.categorias::after {
        content: '\f02c';
        background: var(--warning-color);
        color: white;
    }
    
    .stat-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.15);
    }
    
    .stat-number {
        font-size: 4rem;
        font-weight: 900;
        margin-bottom: 8px;
        line-height: 1;
        background: linear-gradient(45deg, currentColor, rgba(0,0,0,0.7));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    .stat-card.alumnos .stat-number {
        color: var(--primary-color);
    }
    
    .stat-card.cursos .stat-number {
        color: var(--info-color);
    }
    
    .stat-card.blog .stat-number {
        color: var(--success-color);
    }
    
    .stat-card.categorias .stat-number {
        color: var(--warning-color);
    }
    
    .stat-label {
        color: var(--text-primary);
        font-size: 1.2rem;
        font-weight: 700;
        margin: 0;
    }
    
    .stat-sublabel {
        color: var(--text-secondary);
        font-size: 0.9rem;
        margin-top: 8px;
        font-weight: 500;
    }
    
    .charts-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 24px;
        margin-bottom: 40px;
    }
    
    .chart-card {
        background: white;
        border-radius: 16px;
        box-shadow: var(--shadow);
        overflow: hidden;
    }
    
    .chart-header {
        padding: 24px 32px;
        border-bottom: 1px solid var(--border-color);
        background: linear-gradient(135deg, #fafafa, #f0f0f0);
    }
    
    .chart-header h3 {
        margin: 0;
        font-size: 1.4rem;
        font-weight: 700;
        color: var(--text-primary);
        display: flex;
        align-items: center;
        gap: 12px;
    }
    
    .chart-body {
        padding: 32px;
        height: 400px;
        position: relative;
    }
    
    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 24px;
        margin-bottom: 40px;
    }
    
    .info-card {
        background: white;
        border-radius: 16px;
        box-shadow: var(--shadow);
        overflow: hidden;
        transition: var(--transition);
    }
    
    .info-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-lg);
    }
    
    .info-card-header {
        padding: 24px 32px;
        border-bottom: 1px solid var(--border-color);
        background: linear-gradient(135deg, #fafafa, #f0f0f0);
        display: flex;
        align-items: center;
        gap: 12px;
    }
    
    .info-card-header h3 {
        margin: 0;
        font-size: 1.3rem;
        font-weight: 700;
        color: var(--text-primary);
    }
    
    .info-card-body {
        padding: 32px;
    }
    
    .mini-stats {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }
    
    .mini-stat {
        text-align: center;
        padding: 24px;
        background: linear-gradient(135deg, #f8fafc, #e2e8f0);
        border-radius: 12px;
        border-left: 4px solid;
        transition: var(--transition);
    }
    
    .mini-stat:hover {
        transform: scale(1.05);
    }
    
    .mini-stat.success {
        border-left-color: var(--success-color);
    }
    
    .mini-stat.info {
        border-left-color: var(--info-color);
    }
    
    .mini-stat.warning {
        border-left-color: var(--warning-color);
    }
    
    .mini-stat.primary {
        border-left-color: var(--primary-color);
    }
    
    .mini-stat-number {
        font-size: 2.5rem;
        font-weight: 900;
        margin-bottom: 8px;
        line-height: 1;
    }
    
    .mini-stat.success .mini-stat-number {
        color: var(--success-color);
    }
    
    .mini-stat.info .mini-stat-number {
        color: var(--info-color);
    }
    
    .mini-stat.warning .mini-stat-number {
        color: var(--warning-color);
    }
    
    .mini-stat.primary .mini-stat-number {
        color: var(--primary-color);
    }
    
    .mini-stat-label {
        color: var(--text-secondary);
        font-size: 0.95rem;
        font-weight: 600;
        margin: 0;
    }
    
    .recent-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .recent-item {
        display: flex;
        align-items: center;
        padding: 16px 0;
        border-bottom: 1px solid #f1f5f9;
        transition: var(--transition);
    }
    
    .recent-item:hover {
        background: #f8fafc;
        margin: 0 -32px;
        padding: 16px 32px;
    }
    
    .recent-item:last-child {
        border-bottom: none;
    }
    
    .recent-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 16px;
        font-size: 18px;
        color: white;
        font-weight: 600;
    }
    
    .recent-icon.alumno {
        background: linear-gradient(135deg, var(--primary-color), #c2185b);
    }
    
    .recent-icon.curso {
        background: linear-gradient(135deg, var(--info-color), #1565c0);
    }
    
    .recent-icon.blog {
        background: linear-gradient(135deg, var(--success-color), #2e7d32);
    }
    
    .recent-content h4 {
        margin: 0 0 4px 0;
        font-size: 1rem;
        font-weight: 600;
        color: var(--text-primary);
    }
    
    .recent-content p {
        margin: 0;
        font-size: 0.875rem;
        color: var(--text-secondary);
    }
    
    .progress-bar {
        width: 100%;
        height: 8px;
        background: #e5e7eb;
        border-radius: 4px;
        overflow: hidden;
        margin-top: 12px;
    }
    
    .progress-fill {
        height: 100%;
        background: linear-gradient(90deg, var(--success-color), var(--info-color));
        border-radius: 4px;
        transition: width 1s ease-in-out;
    }
    
    .quick-actions {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 16px;
        margin-top: 32px;
    }
    
    .quick-action {
        display: flex;
        align-items: center;
        padding: 16px 20px;
        background: white;
        border: 2px solid var(--border-color);
        border-radius: 12px;
        text-decoration: none;
        color: var(--text-primary);
        font-weight: 600;
        transition: var(--transition);
        box-shadow: var(--shadow);
    }
    
    .quick-action:hover {
        border-color: var(--primary-color);
        color: var(--primary-color);
        transform: translateY(-2px);
        box-shadow: var(--shadow-lg);
        text-decoration: none;
    }
    
    .quick-action i {
        margin-right: 12px;
        font-size: 18px;
    }
    
    @media (max-width: 1024px) {
        .charts-grid {
            grid-template-columns: 1fr;
        }
    }
    
    @media (max-width: 768px) {
        .dashboard-header {
            padding: 24px;
        }
        
        .dashboard-header h1 {
            font-size: 2.2rem;
        }
        
        .stats-grid {
            grid-template-columns: 1fr;
            gap: 16px;
        }
        
        .stat-card {
            padding: 24px;
        }
        
        .stat-number {
            font-size: 3rem;
        }
        
        .info-grid {
            grid-template-columns: 1fr;
            gap: 16px;
        }
        
        .mini-stats {
            grid-template-columns: 1fr;
            gap: 16px;
        }
        
        .chart-body {
            height: 300px;
            padding: 16px;
        }
        
        .quick-actions {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
<div>
    <!-- Header Principal -->
    <div class="dashboard-header">
        <h1>📚 Dashboard Academia Completo</h1>
        <p>Panel de control integral del sistema educativo - {{ date('d/m/Y H:i:s') }}</p>
    </div>

    <!-- Estadísticas Principales -->
    <div class="stats-grid">
        <div class="stat-card alumnos">
            <div class="stat-number">{{ $totalAlumnos ?? 0 }}</div>
            <div class="stat-label">Total Alumnos</div>
            <div class="stat-sublabel">+{{ $alumnosEsteAno ?? 0 }} registrados este año</div>
        </div>
        
        <div class="stat-card cursos">
            <div class="stat-number">{{ $totalCursos ?? 0 }}</div>
            <div class="stat-label">Total Cursos</div>
            <div class="stat-sublabel">{{ $cursosPublicados ?? 0 }} publicados • {{ $cursosActivos ?? 0 }} activos</div>
        </div>
        
        <div class="stat-card blog">
            <div class="stat-number">{{ $totalBlogPosts ?? 0 }}</div>
            <div class="stat-label">Artículos Blog</div>
            <div class="stat-sublabel">{{ $blogPostsPublicados ?? 0 }} publicados • {{ $blogPostsEsteMes ?? 0 }} este mes</div>
        </div>
        
        <div class="stat-card categorias">
            <div class="stat-number">{{ $totalCategorias ?? 0 }}</div>
            <div class="stat-label">Categorías</div>
            <div class="stat-sublabel">{{ $categoriasConCursos ?? 0 }} con cursos activos</div>
        </div>
    </div>

    <!-- Gráficos -->
    <div class="charts-grid">
        <div class="chart-card">
            <div class="chart-header">
                <h3>
                    <i class="fas fa-chart-line" style="color: var(--primary-color);"></i>
                    Crecimiento de Alumnos (Últimos 12 meses)
                </h3>
            </div>
            <div class="chart-body">
                <canvas id="alumnosChart"></canvas>
            </div>
        </div>
        
        <div class="chart-card">
            <div class="chart-header">
                <h3>
                    <i class="fas fa-chart-pie" style="color: var(--info-color);"></i>
                    Cursos por Categoría
                </h3>
            </div>
            <div class="chart-body">
                <canvas id="categoriasChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Información Detallada -->
    <div class="info-grid">
        <div class="info-card">
            <div class="info-card-header">
                <i class="fas fa-chart-bar" style="color: var(--success-color);"></i>
                <h3>Actividad Reciente</h3>
            </div>
            <div class="info-card-body">
                <div class="mini-stats">
                    <div class="mini-stat success">
                        <div class="mini-stat-number">{{ $alumnosEstaSeamana ?? 0 }}</div>
                        <div class="mini-stat-label">Alumnos esta semana</div>
                    </div>
                    <div class="mini-stat info">
                        <div class="mini-stat-number">{{ $blogPostsEsteMes ?? 0 }}</div>
                        <div class="mini-stat-label">Posts este mes</div>
                    </div>
                </div>
                
                <div class="progress-bar">
                    <div class="progress-fill" style="width: {{ $totalAlumnos > 0 ? min(($alumnosEstaSeamana / $totalAlumnos) * 100, 100) : 0 }}%"></div>
                </div>
                <p style="text-align: center; margin-top: 8px; font-size: 0.875rem; color: var(--text-secondary);">
                    Progreso semanal: {{ $totalAlumnos > 0 ? round(($alumnosEstaSeamana / $totalAlumnos) * 100, 1) : 0 }}%
                </p>
            </div>
        </div>
        
        <div class="info-card">
            <div class="info-card-header">
                <i class="fas fa-cogs" style="color: var(--info-color);"></i>
                <h3>Estado del Sistema</h3>
            </div>
            <div class="info-card-body">
                <div class="mini-stats">
                    <div class="mini-stat success">
                        <div class="mini-stat-number">{{ $cursosActivos ?? 0 }}</div>
                        <div class="mini-stat-label">Cursos activos</div>
                    </div>
                    <div class="mini-stat warning">
                        <div class="mini-stat-number">{{ $cursosEsteAno ?? 0 }}</div>
                        <div class="mini-stat-label">Creados este año</div>
                    </div>
                </div>
                
                <div class="progress-bar">
                    <div class="progress-fill" style="width: {{ $totalCursos > 0 ? min(($cursosPublicados / $totalCursos) * 100, 100) : 0 }}%"></div>
                </div>
                <p style="text-align: center; margin-top: 8px; font-size: 0.875rem; color: var(--text-secondary);">
                    Cursos publicados: {{ $totalCursos > 0 ? round(($cursosPublicados / $totalCursos) * 100, 1) : 0 }}%
                </p>
            </div>
        </div>
        
        <div class="info-card">
            <div class="info-card-header">
                <i class="fas fa-clock" style="color: var(--warning-color);"></i>
                <h3>Últimas Actividades</h3>
            </div>
            <div class="info-card-body">
                <ul class="recent-list">
                    @if(isset($ultimosAlumnos) && $ultimosAlumnos->count() > 0)
                        @foreach($ultimosAlumnos->take(3) as $alumno)
                        <li class="recent-item">
                            <div class="recent-icon alumno">
                                <i class="fas fa-user-graduate"></i>
                            </div>
                            <div class="recent-content">
                                <h4>{{ $alumno->name ?? 'Alumno' }} {{ $alumno->surname ?? '' }}</h4>
                                <p>Registrado {{ $alumno->created_at ? $alumno->created_at->diffForHumans() : 'recientemente' }}</p>
                            </div>
                        </li>
                        @endforeach
                    @else
                        <li class="recent-item">
                            <div class="recent-icon alumno">
                                <i class="fas fa-info-circle"></i>
                            </div>
                            <div class="recent-content">
                                <h4>Sin actividad reciente</h4>
                                <p>No hay alumnos registrados recientemente</p>
                            </div>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
        
        <div class="info-card">
            <div class="info-card-header">
                <i class="fas fa-graduation-cap" style="color: var(--primary-color);"></i>
                <h3>Cursos Destacados</h3>
            </div>
            <div class="info-card-body">
                <ul class="recent-list">
                    @if(isset($ultimosCursos) && $ultimosCursos->count() > 0)
                        @foreach($ultimosCursos->take(3) as $curso)
                        <li class="recent-item">
                            <div class="recent-icon curso">
                                <i class="fas fa-book"></i>
                            </div>
                            <div class="recent-content">
                                <h4>{{ Str::limit($curso->name ?? 'Curso sin nombre', 30) }}</h4>
                                <p>{{ $curso->published ? 'Publicado' : 'Borrador' }} • {{ $curso->created_at ? $curso->created_at->diffForHumans() : 'Fecha no disponible' }}</p>
                            </div>
                        </li>
                        @endforeach
                    @else
                        <li class="recent-item">
                            <div class="recent-icon curso">
                                <i class="fas fa-info-circle"></i>
                            </div>
                            <div class="recent-content">
                                <h4>Sin cursos recientes</h4>
                                <p>No hay cursos creados recientemente</p>
                            </div>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>

    <!-- Acciones Rápidas -->
    <div class="quick-actions">
        <a href="{{ route('crm.alumnos.create') }}" class="quick-action">
            <i class="fas fa-user-plus"></i>
            Nuevo Alumno
        </a>
        <a href="{{ route('cursos.create') }}" class="quick-action">
            <i class="fas fa-plus"></i>
            Nuevo Curso
        </a>
        <a href="{{ route('crm.blog.create') }}" class="quick-action">
            <i class="fas fa-edit"></i>
            Nueva Noticia
        </a>
        <a href="{{ route('cursosCategoria.index') }}" class="quick-action">
            <i class="fas fa-tags"></i>
            Gestionar Categorías
        </a>
        <a href="{{ route('crm.alumnos.index') }}" class="quick-action">
            <i class="fas fa-users"></i>
            Ver Todos los Alumnos
        </a>
        <a href="{{ route('cursos.index') }}" class="quick-action">
            <i class="fas fa-graduation-cap"></i>
            Ver Todos los Cursos
        </a>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Datos para el gráfico de alumnos
    const alumnosData = @json($alumnosPorMes ?? []);
    const alumnosLabels = alumnosData.map(item => item.mes || 'N/A');
    const alumnosValues = alumnosData.map(item => item.cantidad || 0);
    
    // Gráfico de crecimiento de alumnos
    const alumnosCtx = document.getElementById('alumnosChart');
    if (alumnosCtx) {
        new Chart(alumnosCtx, {
            type: 'line',
            data: {
                labels: alumnosLabels.length > 0 ? alumnosLabels : ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                datasets: [{
                    label: 'Nuevos Alumnos',
                    data: alumnosValues.length > 0 ? alumnosValues : [0, 1, 2, 1, 3, 0, 0, 0, 0, 0, 0, 0],
                    borderColor: '#D93690',
                    backgroundColor: 'rgba(217, 54, 144, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#D93690',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 6,
                    pointHoverRadius: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#f1f5f9'
                        },
                        ticks: {
                            color: '#6b7280'
                        }
                    },
                    x: {
                        grid: {
                            color: '#f1f5f9'
                        },
                        ticks: {
                            color: '#6b7280'
                        }
                    }
                },
                elements: {
                    point: {
                        hoverBackgroundColor: '#D93690'
                    }
                }
            }
        });
    }
    
    // Datos para el gráfico de categorías
    const categoriasData = @json($cursosPorCategoria ?? []);
    const categoriasLabels = categoriasData.map(item => item.name || 'Sin categoría');
    const categoriasValues = categoriasData.map(item => item.cursos_count || 0);
    
    // Gráfico de cursos por categoría
    const categoriasCtx = document.getElementById('categoriasChart');
    if (categoriasCtx) {
        new Chart(categoriasCtx, {
            type: 'doughnut',
            data: {
                labels: categoriasLabels.length > 0 ? categoriasLabels : ['Sin datos'],
                datasets: [{
                    data: categoriasValues.length > 0 ? categoriasValues : [1],
                    backgroundColor: [
                        '#D93690',
                        '#3b82f6',
                        '#10b981',
                        '#f59e0b',
                        '#8b5cf6',
                        '#ef4444'
                    ],
                    borderWidth: 0,
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 20,
                            usePointStyle: true,
                            color: '#6b7280'
                        }
                    }
                },
                cutout: '60%'
            }
        });
    }
    
    console.log('🎯 Dashboard Academia completo cargado exitosamente');
    console.log('Estadísticas completas:', {
        alumnos: {{ $totalAlumnos ?? 0 }},
        cursos: {{ $totalCursos ?? 0 }},
        blog: {{ $totalBlogPosts ?? 0 }},
        categorias: {{ $totalCategorias ?? 0 }},
        cursosActivos: {{ $cursosActivos ?? 0 }},
        cursosPublicados: {{ $cursosPublicados ?? 0 }}
    });
});
</script>
@endsection