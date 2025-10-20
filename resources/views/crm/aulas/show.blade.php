@extends('crm.layouts.clean_app')

@section('titulo', 'Detalles del Aula')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div style="background: linear-gradient(135deg, #D93690 0%, #8B5CF6 100%); color: white; padding: 40px 0;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="mb-0">
                        <i class="fas fa-chalkboard"></i>
                        {{ $aula->name }}
                    </h1>
                    <p class="mb-0 mt-2" style="opacity: 0.9;">Detalles del aula</p>
                </div>
                <div class="col-md-4 text-end">
                    <a href="{{ route('aulas.index') }}" class="btn btn-light me-2">
                        <i class="fas fa-arrow-left"></i>
                        Volver a Aulas
                    </a>
                    <a href="{{ route('aulas.edit', $aula->id) }}" class="btn btn-light">
                        <i class="fas fa-edit"></i>
                        Editar Aula
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

        <!-- Información del aula -->
        <div style="background: white; border-radius: 16px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); border: 1px solid #e5e7eb; overflow: hidden; margin-bottom: 24px;">
            <!-- Header del aula -->
            <div style="background: linear-gradient(135deg, #D93690 0%, #8B5CF6 100%); color: white; padding: 40px; text-align: center;">
                <div style="width: 120px; height: 120px; background: rgba(255, 255, 255, 0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; font-size: 3rem; overflow: hidden;">
                    <i class="fas fa-chalkboard"></i>
                </div>
                <h2 style="font-size: 2rem; font-weight: 700; margin-bottom: 8px;">{{ $aula->name }}</h2>
                <p style="font-size: 1.1rem; opacity: 0.9; margin-bottom: 0;">
                    @if($aula->inactive)
                        <span style="background: rgba(239, 68, 68, 0.2); padding: 4px 12px; border-radius: 20px; font-size: 0.9rem;">
                            <i class="fas fa-times-circle"></i> Inactiva
                        </span>
                    @else
                        <span style="background: rgba(16, 185, 129, 0.2); padding: 4px 12px; border-radius: 20px; font-size: 0.9rem;">
                            <i class="fas fa-check-circle"></i> Activa
                        </span>
                    @endif
                </p>
            </div>
            
            <!-- Información detallada -->
            <div style="padding: 30px;">
                <div class="row">
                    <div class="col-md-8">
                        <h3 style="font-size: 1.3rem; font-weight: 600; color: #111827; margin-bottom: 20px; display: flex; align-items: center; gap: 8px;">
                            <i class="fas fa-info-circle"></i> Información del Aula
                        </h3>
                        
                        <div style="display: grid; gap: 16px;">
                            <div style="display: flex; justify-content: space-between; align-items: center; padding: 12px 0; border-bottom: 1px solid #f3f4f6;">
                                <span style="font-weight: 600; color: #6b7280; font-size: 0.9rem;">Nombre</span>
                                <span style="color: #111827; font-weight: 500;">{{ $aula->name }}</span>
                            </div>
                            
                            @if($aula->description)
                            <div style="display: flex; justify-content: space-between; align-items: flex-start; padding: 12px 0; border-bottom: 1px solid #f3f4f6;">
                                <span style="font-weight: 600; color: #6b7280; font-size: 0.9rem;">Descripción</span>
                                <span style="color: #111827; font-weight: 500; text-align: right; max-width: 60%;">{{ $aula->description }}</span>
                            </div>
                            @endif
                            
                            @if($aula->capacity)
                            <div style="display: flex; justify-content: space-between; align-items: center; padding: 12px 0; border-bottom: 1px solid #f3f4f6;">
                                <span style="font-weight: 600; color: #6b7280; font-size: 0.9rem;">Capacidad</span>
                                <span style="color: #111827; font-weight: 500;">{{ $aula->capacity }} personas</span>
                            </div>
                            @endif
                            
                            @if($aula->floor)
                            <div style="display: flex; justify-content: space-between; align-items: center; padding: 12px 0; border-bottom: 1px solid #f3f4f6;">
                                <span style="font-weight: 600; color: #6b7280; font-size: 0.9rem;">Planta/Piso</span>
                                <span style="color: #111827; font-weight: 500;">{{ $aula->floor }}</span>
                            </div>
                            @endif
                            
                            @if($aula->building)
                            <div style="display: flex; justify-content: space-between; align-items: center; padding: 12px 0; border-bottom: 1px solid #f3f4f6;">
                                <span style="font-weight: 600; color: #6b7280; font-size: 0.9rem;">Edificio</span>
                                <span style="color: #111827; font-weight: 500;">{{ $aula->building }}</span>
                            </div>
                            @endif
                            
                            @if($aula->status)
                            <div style="display: flex; justify-content: space-between; align-items: center; padding: 12px 0; border-bottom: 1px solid #f3f4f6;">
                                <span style="font-weight: 600; color: #6b7280; font-size: 0.9rem;">Estado</span>
                                <span style="color: #111827; font-weight: 500;">
                                    @if($aula->status == 'disponible')
                                        <span style="color: #10b981;">
                                            <i class="fas fa-check-circle"></i> Disponible
                                        </span>
                                    @elseif($aula->status == 'ocupada')
                                        <span style="color: #f59e0b;">
                                            <i class="fas fa-clock"></i> Ocupada
                                        </span>
                                    @else
                                        <span style="color: #ef4444;">
                                            <i class="fas fa-tools"></i> En Mantenimiento
                                        </span>
                                    @endif
                                </span>
                            </div>
                            @endif
                            
                            @if($aula->type)
                            <div style="display: flex; justify-content: space-between; align-items: center; padding: 12px 0; border-bottom: 1px solid #f3f4f6;">
                                <span style="font-weight: 600; color: #6b7280; font-size: 0.9rem;">Tipo</span>
                                <span style="color: #111827; font-weight: 500;">{{ ucfirst(str_replace('_', ' ', $aula->type)) }}</span>
                            </div>
                            @endif
                            
                            @if($aula->responsible)
                            <div style="display: flex; justify-content: space-between; align-items: center; padding: 12px 0; border-bottom: 1px solid #f3f4f6;">
                                <span style="font-weight: 600; color: #6b7280; font-size: 0.9rem;">Responsable</span>
                                <span style="color: #111827; font-weight: 500;">{{ $aula->responsible }}</span>
                            </div>
                            @endif
                            
                            @if($aula->contact_phone)
                            <div style="display: flex; justify-content: space-between; align-items: center; padding: 12px 0; border-bottom: 1px solid #f3f4f6;">
                                <span style="font-weight: 600; color: #6b7280; font-size: 0.9rem;">Teléfono</span>
                                <span style="color: #111827; font-weight: 500;">{{ $aula->contact_phone }}</span>
                            </div>
                            @endif
                            
                            <div style="display: flex; justify-content: space-between; align-items: center; padding: 12px 0; border-bottom: 1px solid #f3f4f6;">
                                <span style="font-weight: 600; color: #6b7280; font-size: 0.9rem;">Estado del Sistema</span>
                                <span style="color: #111827; font-weight: 500;">
                                    @if($aula->inactive)
                                        <span style="color: #ef4444;">
                                            <i class="fas fa-times-circle"></i> Inactiva
                                        </span>
                                    @else
                                        <span style="color: #10b981;">
                                            <i class="fas fa-check-circle"></i> Activa
                                        </span>
                                    @endif
                                </span>
                            </div>
                            
                            <div style="display: flex; justify-content: space-between; align-items: center; padding: 12px 0; border-bottom: 1px solid #f3f4f6;">
                                <span style="font-weight: 600; color: #6b7280; font-size: 0.9rem;">Creada</span>
                                <span style="color: #111827; font-weight: 500;">{{ $aula->created_at ? $aula->created_at->format('d/m/Y H:i') : 'No disponible' }}</span>
                            </div>
                            
                            <div style="display: flex; justify-content: space-between; align-items: center; padding: 12px 0;">
                                <span style="font-weight: 600; color: #6b7280; font-size: 0.9rem;">Última Actualización</span>
                                <span style="color: #111827; font-weight: 500;">{{ $aula->updated_at ? $aula->updated_at->format('d/m/Y H:i') : 'No disponible' }}</span>
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
                                        {{ $aula->reservas()->count() ?? 0 }}
                                    </div>
                                    <div style="font-size: 0.9rem; color: #6b7280; font-weight: 500;">Reservas Totales</div>
                                </div>
                                
                                <div style="text-align: center; padding: 16px; background: white; border-radius: 8px; border: 1px solid #e5e7eb;">
                                    <div style="font-size: 2rem; font-weight: 700; color: #10b981; margin-bottom: 4px;">
                                        {{ $aula->reservas()->where('estado', 'confirmada')->count() ?? 0 }}
                                    </div>
                                    <div style="font-size: 0.9rem; color: #6b7280; font-weight: 500;">Reservas Confirmadas</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Equipamiento y Horarios -->
        <div style="background: white; border-radius: 16px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); border: 1px solid #e5e7eb; overflow: hidden; margin-bottom: 24px;">
            <div style="background: #f8fafc; padding: 20px 24px; border-bottom: 1px solid #e5e7eb;">
                <h3 style="margin: 0; font-size: 1.2rem; font-weight: 700; color: #111827; display: flex; align-items: center; gap: 8px;">
                    <i class="fas fa-tools"></i> Equipamiento y Horarios
                </h3>
            </div>
            
            <div style="padding: 24px;">
                <div class="row">
                    @if($aula->equipment && is_array($aula->equipment) && count($aula->equipment) > 0)
                    <div class="col-md-6">
                        <h4 style="font-size: 1.1rem; font-weight: 600; color: #111827; margin-bottom: 16px; display: flex; align-items: center; gap: 8px;">
                            <i class="fas fa-cogs"></i> Equipamiento Disponible
                        </h4>
                        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 12px;">
                            @foreach($aula->equipment as $equipment)
                            <div style="display: flex; align-items: center; gap: 8px; padding: 8px 12px; background: #f8fafc; border-radius: 6px; border: 1px solid #e5e7eb;">
                                <i class="fas fa-check-circle" style="color: #10b981; font-size: 0.9rem;"></i>
                                <span style="font-size: 0.9rem; color: #111827; font-weight: 500;">{{ ucfirst(str_replace('_', ' ', $equipment)) }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    
                    <div class="col-md-6">
                        @if($aula->available_schedule)
                        <h4 style="font-size: 1.1rem; font-weight: 600; color: #111827; margin-bottom: 16px; display: flex; align-items: center; gap: 8px;">
                            <i class="fas fa-clock"></i> Horario de Disponibilidad
                        </h4>
                        <div style="background: #f8fafc; border-radius: 8px; padding: 16px; border: 1px solid #e5e7eb;">
                            <p style="margin: 0; color: #111827; line-height: 1.6;">{{ $aula->available_schedule }}</p>
                        </div>
                        @endif
                        
                        @if($aula->observations)
                        <h4 style="font-size: 1.1rem; font-weight: 600; color: #111827; margin-bottom: 16px; margin-top: 24px; display: flex; align-items: center; gap: 8px;">
                            <i class="fas fa-sticky-note"></i> Observaciones
                        </h4>
                        <div style="background: #f8fafc; border-radius: 8px; padding: 16px; border: 1px solid #e5e7eb;">
                            <p style="margin: 0; color: #111827; line-height: 1.6;">{{ $aula->observations }}</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Reservas del aula -->
        <div style="background: white; border-radius: 16px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); border: 1px solid #e5e7eb; overflow: hidden;">
            <div style="background: #f8fafc; padding: 20px 24px; border-bottom: 1px solid #e5e7eb;">
                <h3 style="margin: 0; font-size: 1.2rem; font-weight: 700; color: #111827; display: flex; align-items: center; gap: 8px;">
                    <i class="fas fa-calendar-check"></i> Reservas del Aula
                </h3>
            </div>
            
            <div style="padding: 24px;">
                @if($aula->reservas && $aula->reservas->count() > 0)
                    <div style="display: grid; gap: 16px;">
                        @foreach($aula->reservas as $reserva)
                            <div style="display: flex; justify-content: space-between; align-items: center; padding: 16px; background: #f8fafc; border-radius: 8px; border: 1px solid #e5e7eb;">
                                <div>
                                    <div style="font-weight: 600; color: #111827; margin-bottom: 4px;">{{ $reserva->titulo ?? 'Sin título' }}</div>
                                    <div style="font-size: 0.9rem; color: #6b7280;">
                                        {{ $reserva->fecha_inicio ? \Carbon\Carbon::parse($reserva->fecha_inicio)->format('d/m/Y H:i') : 'Sin fecha' }}
                                    </div>
                                </div>
                                <div style="display: flex; align-items: center; gap: 12px;">
                                    <span style="padding: 4px 12px; border-radius: 20px; font-size: 0.8rem; font-weight: 600;
                                        @if($reserva->estado == 'confirmada')
                                            background: rgba(16, 185, 129, 0.1); color: #10b981;
                                        @elseif($reserva->estado == 'pendiente')
                                            background: rgba(245, 158, 11, 0.1); color: #f59e0b;
                                        @else
                                            background: rgba(239, 68, 68, 0.1); color: #ef4444;
                                        @endif">
                                        {{ ucfirst($reserva->estado ?? 'pendiente') }}
                                    </span>
                                    <a href="{{ route('reservas.show', $reserva->id) }}" style="padding: 8px 12px; background: #D93690; color: white; border-radius: 6px; text-decoration: none; font-size: 0.8rem; font-weight: 600;">
                                        <i class="fas fa-eye"></i> Ver
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div style="text-align: center; padding: 40px; color: #6b7280;">
                        <i class="fas fa-calendar-times" style="font-size: 3rem; margin-bottom: 16px; opacity: 0.5;"></i>
                        <h4 style="margin-bottom: 8px; color: #111827;">No hay reservas</h4>
                        <p style="margin: 0;">Este aula no tiene reservas asignadas.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection