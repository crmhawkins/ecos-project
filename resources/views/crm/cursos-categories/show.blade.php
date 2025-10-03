@extends('crm.layouts.clean_app')

@section('titulo', 'Detalle de Categoría')

@section('content')
<div class="container-fluid">
    <!-- Header principal con gradiente - EXACTAMENTE igual que cursos -->
    <div class="hero-section" style="background: linear-gradient(135deg, #D93690 0%, #8B5CF6 100%); color: white; padding: 40px 0; margin-bottom: 32px; border-radius: 16px; margin: 0 16px 32px 16px;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="hero-content" style="display: flex; align-items: center; gap: 24px;">
                        <div class="hero-icon" style="width: 80px; height: 80px; background: rgba(255, 255, 255, 0.2); border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 2.5rem; flex-shrink: 0;">
                            <i class="fas fa-tag"></i>
                        </div>
                        <div class="hero-text">
                            <h1 style="font-size: 2.5rem; font-weight: 800; margin-bottom: 8px; line-height: 1.2;">
                                {{ $categoria->name }}
                            </h1>
                            <p style="font-size: 1.1rem; opacity: 0.9; margin-bottom: 0;">
                                @if($categoria->inactive)
                                    <span style="background: rgba(239, 68, 68, 0.2); padding: 6px 12px; border-radius: 20px; font-size: 0.9rem; display: inline-flex; align-items: center; gap: 6px;">
                                        <i class="fas fa-times-circle"></i> Inactiva
                                    </span>
                                @else
                                    <span style="background: rgba(16, 185, 129, 0.2); padding: 6px 12px; border-radius: 20px; font-size: 0.9rem; display: inline-flex; align-items: center; gap: 6px;">
                                        <i class="fas fa-check-circle"></i> Activa
                                    </span>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 text-end">
                    <div class="hero-actions" style="display: flex; gap: 12px; align-items: center; justify-content: flex-end;">
                        <a href="{{ route('cursosCategoria.edit', $categoria->id) }}" class="btn btn-light" style="padding: 12px 24px; border-radius: 8px; font-weight: 600; display: flex; align-items: center; gap: 8px; text-decoration: none; transition: all 0.3s ease; border: none;">
                            <i class="fas fa-edit"></i>
                            Editar Categoría
                        </a>
                        <a href="{{ route('cursosCategoria.index') }}" class="btn btn-outline-light" style="padding: 12px 24px; border-radius: 8px; font-weight: 600; display: flex; align-items: center; gap: 8px; text-decoration: none; transition: all 0.3s ease; border: 2px solid rgba(255, 255, 255, 0.3);">
                            <i class="fas fa-arrow-left"></i>
                            Volver al Listado
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <!-- Columna izquierda - Información principal -->
            <div class="col-lg-8">
                <!-- Información de la Categoría -->
                <div class="info-card" style="background: white; border-radius: 20px; box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1); border: 1px solid #e5e7eb; overflow: hidden; margin-bottom: 32px;">
                    <div class="info-card-header" style="background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%); padding: 24px 32px; border-bottom: 1px solid #e5e7eb;">
                        <h3 style="margin: 0; font-size: 1.4rem; font-weight: 700; color: #111827; display: flex; align-items: center; gap: 12px;">
                            <i class="fas fa-info-circle" style="color: #D93690; font-size: 1.2rem;"></i>
                            Información de la Categoría
                        </h3>
                    </div>
                    <div class="info-card-body" style="padding: 32px;">
                        <div class="info-grid" style="display: grid; grid-template-columns: 1fr; gap: 24px;">
                            <div class="info-item">
                                <div class="info-label" style="font-size: 0.9rem; font-weight: 600; color: #6b7280; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.5px;">Título</div>
                                <div class="info-value" style="font-size: 1.1rem; color: #111827; font-weight: 500;">{{ $categoria->name }}</div>
                            </div>
                            
                            <div class="info-item">
                                <div class="info-label" style="font-size: 0.9rem; font-weight: 600; color: #6b7280; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.5px;">Slug</div>
                                <div class="info-value" style="font-size: 1.1rem; color: #111827; font-weight: 500;">
                                    <code style="background: #f1f5f9; padding: 8px 12px; border-radius: 8px; font-size: 0.9rem; color: #475569;">{{ $categoria->slug ?? 'N/A' }}</code>
                                </div>
                            </div>
                            
                            <div class="info-item">
                                <div class="info-label" style="font-size: 0.9rem; font-weight: 600; color: #6b7280; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.5px;">Estado</div>
                                <div class="info-value">
                                    @if($categoria->inactive)
                                        <span class="status-badge status-inactive" style="display: inline-flex; align-items: center; gap: 8px; padding: 8px 16px; border-radius: 25px; font-size: 0.9rem; font-weight: 600; background: rgba(239, 68, 68, 0.1); color: #ef4444;">
                                            <i class="fas fa-times-circle"></i> Inactiva
                                        </span>
                                    @else
                                        <span class="status-badge status-active" style="display: inline-flex; align-items: center; gap: 8px; padding: 8px 16px; border-radius: 25px; font-size: 0.9rem; font-weight: 600; background: rgba(16, 185, 129, 0.1); color: #10b981;">
                                            <i class="fas fa-check-circle"></i> Activa
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            @if($categoria->description)
                            <div class="info-item">
                                <div class="info-label" style="font-size: 0.9rem; font-weight: 600; color: #6b7280; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.5px;">Descripción</div>
                                <div class="info-value" style="font-size: 1.1rem; color: #111827; font-weight: 500; line-height: 1.6;">{{ $categoria->description }}</div>
                            </div>
                            @endif
                            
                            <div class="info-item">
                                <div class="info-label" style="font-size: 0.9rem; font-weight: 600; color: #6b7280; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.5px;">Fecha de Creación</div>
                                <div class="info-value" style="font-size: 1.1rem; color: #111827; font-weight: 500;">
                                    {{ $categoria->created_at ? $categoria->created_at->format('d/m/Y H:i') : 'N/A' }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Cursos Asociados -->
                @if($categoria->cursos && $categoria->cursos->count() > 0)
                <div class="info-card" style="background: white; border-radius: 20px; box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1); border: 1px solid #e5e7eb; overflow: hidden; margin-bottom: 32px;">
                    <div class="info-card-header" style="background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%); padding: 24px 32px; border-bottom: 1px solid #e5e7eb;">
                        <h3 style="margin: 0; font-size: 1.4rem; font-weight: 700; color: #111827; display: flex; align-items: center; gap: 12px;">
                            <i class="fas fa-graduation-cap" style="color: #D93690; font-size: 1.2rem;"></i>
                            Cursos Asociados ({{ $categoria->cursos->count() }})
                        </h3>
                    </div>
                    <div class="info-card-body" style="padding: 32px;">
                        <div class="courses-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px;">
                            @foreach($categoria->cursos as $curso)
                            <div class="course-card" style="background: #f8fafc; border: 1px solid #e5e7eb; border-radius: 12px; padding: 20px; transition: all 0.3s ease;">
                                <div class="course-header" style="display: flex; align-items: center; gap: 12px; margin-bottom: 12px;">
                                    <div class="course-icon" style="width: 40px; height: 40px; background: linear-gradient(135deg, #D93690 0%, #8B5CF6 100%); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: white; font-size: 1.1rem;">
                                        <i class="fas fa-book"></i>
                                    </div>
                                    <div class="course-title" style="font-weight: 600; color: #111827; font-size: 1rem;">{{ $curso->name }}</div>
                                </div>
                                <div class="course-meta" style="display: flex; justify-content: space-between; align-items: center; font-size: 0.85rem; color: #6b7280;">
                                    <span>Precio: {{ $curso->price ? '€' . number_format($curso->price, 2) : 'Gratis' }}</span>
                                    <span>{{ $curso->created_at->format('d/m/Y') }}</span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <!-- Columna derecha - Estadísticas y acciones -->
            <div class="col-lg-4">
                <!-- Estado Web -->
                <div class="info-card" style="background: white; border-radius: 20px; box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1); border: 1px solid #e5e7eb; overflow: hidden; margin-bottom: 32px;">
                    <div class="info-card-header" style="background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%); padding: 24px 32px; border-bottom: 1px solid #e5e7eb;">
                        <h3 style="margin: 0; font-size: 1.4rem; font-weight: 700; color: #111827; display: flex; align-items: center; gap: 12px;">
                            <i class="fas fa-globe" style="color: #D93690; font-size: 1.2rem;"></i>
                            Estado Web
                        </h3>
                    </div>
                    <div class="info-card-body" style="padding: 32px;">
                        <div class="status-display" style="text-align: center;">
                            @if($categoria->inactive)
                                <span class="status-badge status-inactive" style="display: inline-flex; align-items: center; gap: 8px; padding: 12px 20px; border-radius: 25px; font-size: 1rem; font-weight: 600; background: rgba(239, 68, 68, 0.1); color: #ef4444; margin-bottom: 16px;">
                                    <i class="fas fa-times-circle"></i> Inactiva
                                </span>
                                <p style="color: #6b7280; font-size: 0.9rem; margin: 0;">Esta categoría no es visible en la web pública.</p>
                            @else
                                <span class="status-badge status-active" style="display: inline-flex; align-items: center; gap: 8px; padding: 12px 20px; border-radius: 25px; font-size: 1rem; font-weight: 600; background: rgba(16, 185, 129, 0.1); color: #10b981; margin-bottom: 16px;">
                                    <i class="fas fa-check-circle"></i> Activa
                                </span>
                                <p style="color: #6b7280; font-size: 0.9rem; margin: 0;">Esta categoría es visible en la web pública.</p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Estadísticas -->
                <div class="info-card" style="background: white; border-radius: 20px; box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1); border: 1px solid #e5e7eb; overflow: hidden; margin-bottom: 32px;">
                    <div class="info-card-header" style="background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%); padding: 24px 32px; border-bottom: 1px solid #e5e7eb;">
                        <h3 style="margin: 0; font-size: 1.4rem; font-weight: 700; color: #111827; display: flex; align-items: center; gap: 12px;">
                            <i class="fas fa-chart-bar" style="color: #D93690; font-size: 1.2rem;"></i>
                            Estadísticas
                        </h3>
                    </div>
                    <div class="info-card-body" style="padding: 32px;">
                        <div class="stats-grid" style="display: grid; grid-template-columns: 1fr; gap: 20px;">
                            <div class="stat-item" style="text-align: center; padding: 20px; background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%); border-radius: 12px;">
                                <div class="stat-number" style="font-size: 2.5rem; font-weight: 800; color: #D93690; margin-bottom: 8px;">{{ $categoria->cursos ? $categoria->cursos->count() : 0 }}</div>
                                <div class="stat-label" style="font-size: 0.9rem; color: #6b7280; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">Cursos</div>
                            </div>
                            <div class="stat-item" style="text-align: center; padding: 20px; background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%); border-radius: 12px;">
                                <div class="stat-number" style="font-size: 2.5rem; font-weight: 800; color: #8B5CF6; margin-bottom: 8px;">{{ $categoria->created_at ? $categoria->created_at->diffInDays(now()) : 0 }}</div>
                                <div class="stat-label" style="font-size: 0.9rem; color: #6b7280; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">Días Creada</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Vista Previa del Diseño -->
                <div class="info-card" style="background: white; border-radius: 20px; box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1); border: 1px solid #e5e7eb; overflow: hidden;">
                    <div class="info-card-header" style="background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%); padding: 24px 32px; border-bottom: 1px solid #e5e7eb;">
                        <h3 style="margin: 0; font-size: 1.4rem; font-weight: 700; color: #111827; display: flex; align-items: center; gap: 12px;">
                            <i class="fas fa-palette" style="color: #D93690; font-size: 1.2rem;"></i>
                            Vista Previa
                        </h3>
                    </div>
                    <div class="info-card-body" style="padding: 32px;">
                        <div class="preview-card" style="background: linear-gradient(135deg, #D93690 0%, #8B5CF6 100%); border-radius: 16px; padding: 24px; text-align: center; color: white;">
                            <div class="preview-icon" style="width: 60px; height: 60px; background: rgba(255, 255, 255, 0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px; font-size: 1.8rem;">
                                <i class="fas fa-tag"></i>
                            </div>
                            <div class="preview-title" style="font-size: 1.2rem; font-weight: 700; margin-bottom: 8px;">{{ $categoria->name }}</div>
                            <div class="preview-status" style="font-size: 0.9rem; opacity: 0.9;">
                                @if($categoria->inactive)
                                    <i class="fas fa-times-circle"></i> Inactiva
                                @else
                                    <i class="fas fa-check-circle"></i> Activa
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }
    
    .info-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
    }
    
    .course-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        border-color: #D93690;
    }
    
    .stat-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }
    
    @media (max-width: 768px) {
        .hero-section {
            padding: 40px 0 !important;
        }
        
        .hero-content h1 {
            font-size: 2rem !important;
        }
        
        .hero-actions {
            flex-direction: column !important;
            align-items: stretch !important;
        }
        
        .info-grid {
            grid-template-columns: 1fr !important;
        }
        
        .courses-grid {
            grid-template-columns: 1fr !important;
        }
    }
</style>
@endsection