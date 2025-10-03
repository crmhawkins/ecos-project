@extends('crm.layouts.clean_app')

@section('titulo', 'Detalles de la Tarea')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div style="background: linear-gradient(135deg, #D93690 0%, #8B5CF6 100%); color: white; padding: 40px 0;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="mb-0">
                        <i class="fas fa-tasks"></i>
                        {{ $tarea->title ?? 'Tarea #' . $tarea->id }}
                    </h1>
                    <p class="mb-0 mt-2" style="opacity: 0.9;">Detalles de la tarea</p>
                </div>
                <div class="col-md-4 text-end">
                    <a href="{{ route('tarea.index') }}" class="btn btn-light me-2">
                        <i class="fas fa-arrow-left"></i>
                        Volver a Tareas
                    </a>
                    <a href="{{ route('tarea.edit', $tarea->id) }}" class="btn btn-light">
                        <i class="fas fa-edit"></i>
                        Editar Tarea
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-4">
        <!-- Mensajes de éxito/error -->
        @if(session('success'))
            <div class="alert alert-success" style="background: rgba(16, 185, 129, 0.1); color: #10b981; border: 1px solid rgba(16, 185, 129, 0.2); padding: 16px 20px; border-radius: 8px; margin-bottom: 24px; display: flex; align-items: center; gap: 12px;">
                <i class="fas fa-check-circle"></i>
                {{ session('success') }}
            </div>
        @endif

        <!-- Información de la tarea -->
        <div style="background: white; border-radius: 16px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); border: 1px solid #e5e7eb; overflow: hidden; margin-bottom: 24px;">
            <!-- Header de la tarea -->
            <div style="background: linear-gradient(135deg, #D93690 0%, #8B5CF6 100%); color: white; padding: 40px; text-align: center;">
                <div style="width: 120px; height: 120px; background: rgba(255, 255, 255, 0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; font-size: 3rem; overflow: hidden;">
                    <i class="fas fa-tasks"></i>
                </div>
                <h2 style="font-size: 2rem; font-weight: 700; margin-bottom: 8px;">{{ $tarea->title ?? 'Tarea #' . $tarea->id }}</h2>
                <p style="font-size: 1.1rem; opacity: 0.9; margin-bottom: 0;">
                    @if($tarea->status)
                        <span style="background: rgba(16, 185, 129, 0.2); padding: 4px 12px; border-radius: 20px; font-size: 0.9rem;">
                            <i class="fas fa-check-circle"></i> {{ $tarea->status->name ?? 'Completada' }}
                        </span>
                    @else
                        <span style="background: rgba(245, 158, 11, 0.2); padding: 4px 12px; border-radius: 20px; font-size: 0.9rem;">
                            <i class="fas fa-clock"></i> Pendiente
                        </span>
                    @endif
                </p>
            </div>
            
            <!-- Información detallada -->
            <div style="padding: 30px;">
                <div class="row">
                    <div class="col-md-8">
                        <h3 style="font-size: 1.3rem; font-weight: 600; color: #111827; margin-bottom: 20px; display: flex; align-items: center; gap: 8px;">
                            <i class="fas fa-info-circle"></i> Información de la Tarea
                        </h3>
                        
                        <div style="display: grid; gap: 16px;">
                            <div style="display: flex; justify-content: space-between; align-items: center; padding: 12px 0; border-bottom: 1px solid #f3f4f6;">
                                <span style="font-weight: 600; color: #6b7280; font-size: 0.9rem;">Título</span>
                                <span style="color: #111827; font-weight: 500;">{{ $tarea->title ?? 'Sin título' }}</span>
                            </div>
                            
                            <div style="display: flex; justify-content: space-between; align-items: center; padding: 12px 0; border-bottom: 1px solid #f3f4f6;">
                                <span style="font-weight: 600; color: #6b7280; font-size: 0.9rem;">Descripción</span>
                                <span style="color: #111827; font-weight: 500;">{{ $tarea->description ?? 'Sin descripción' }}</span>
                            </div>
                            
                            <div style="display: flex; justify-content: space-between; align-items: center; padding: 12px 0; border-bottom: 1px solid #f3f4f6;">
                                <span style="font-weight: 600; color: #6b7280; font-size: 0.9rem;">Estado</span>
                                <span style="color: #111827; font-weight: 500;">
                                    @if($tarea->status)
                                        <span style="color: #10b981;">
                                            <i class="fas fa-check-circle"></i> {{ $tarea->status->name }}
                                        </span>
                                    @else
                                        <span style="color: #f59e0b;">
                                            <i class="fas fa-clock"></i> Pendiente
                                        </span>
                                    @endif
                                </span>
                            </div>
                            
                            <div style="display: flex; justify-content: space-between; align-items: center; padding: 12px 0; border-bottom: 1px solid #f3f4f6;">
                                <span style="font-weight: 600; color: #6b7280; font-size: 0.9rem;">Prioridad</span>
                                <span style="color: #111827; font-weight: 500;">{{ $tarea->priority->name ?? 'Sin prioridad' }}</span>
                            </div>
                            
                            <div style="display: flex; justify-content: space-between; align-items: center; padding: 12px 0; border-bottom: 1px solid #f3f4f6;">
                                <span style="font-weight: 600; color: #6b7280; font-size: 0.9rem;">Asignado a</span>
                                <span style="color: #111827; font-weight: 500;">{{ $tarea->user->name ?? 'Sin asignar' }}</span>
                            </div>
                            
                            <div style="display: flex; justify-content: space-between; align-items: center; padding: 12px 0; border-bottom: 1px solid #f3f4f6;">
                                <span style="font-weight: 600; color: #6b7280; font-size: 0.9rem;">Fecha de Inicio</span>
                                <span style="color: #111827; font-weight: 500;">{{ $tarea->start_date ? \Carbon\Carbon::parse($tarea->start_date)->format('d/m/Y') : 'No especificada' }}</span>
                            </div>
                            
                            <div style="display: flex; justify-content: space-between; align-items: center; padding: 12px 0; border-bottom: 1px solid #f3f4f6;">
                                <span style="font-weight: 600; color: #6b7280; font-size: 0.9rem;">Fecha de Vencimiento</span>
                                <span style="color: #111827; font-weight: 500;">{{ $tarea->due_date ? \Carbon\Carbon::parse($tarea->due_date)->format('d/m/Y') : 'No especificada' }}</span>
                            </div>
                            
                            <div style="display: flex; justify-content: space-between; align-items: center; padding: 12px 0;">
                                <span style="font-weight: 600; color: #6b7280; font-size: 0.9rem;">Creada</span>
                                <span style="color: #111827; font-weight: 500;">{{ $tarea->created_at ? $tarea->created_at->format('d/m/Y H:i') : 'No disponible' }}</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div style="background: #f8fafc; border-radius: 12px; padding: 20px; border: 1px solid #e5e7eb;">
                            <h4 style="font-size: 1.1rem; font-weight: 600; color: #111827; margin-bottom: 16px; display: flex; align-items: center; gap: 8px;">
                                <i class="fas fa-chart-bar"></i> Estadísticas
                            </h4>
                            
                            <div style="display: grid; gap: 12px;">
                                <div style="text-align: center; padding: 16px; background: white; border-radius: 8px; border: 1px solid #e5e7eb;">
                                    <div style="font-size: 2rem; font-weight: 700; color: #D93690; margin-bottom: 4px;">
                                        {{ $tarea->estimated_hours ?? 0 }}h
                                    </div>
                                    <div style="font-size: 0.9rem; color: #6b7280; font-weight: 500;">Horas Estimadas</div>
                                </div>
                                
                                <div style="text-align: center; padding: 16px; background: white; border-radius: 8px; border: 1px solid #e5e7eb;">
                                    <div style="font-size: 2rem; font-weight: 700; color: #10b981; margin-bottom: 4px;">
                                        {{ $tarea->actual_hours ?? 0 }}h
                                    </div>
                                    <div style="font-size: 0.9rem; color: #6b7280; font-weight: 500;">Horas Reales</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
