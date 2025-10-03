@extends('crm.layouts.clean_app')

@section('titulo', 'Información de la Empresa')

@section('content')
<div class="container-fluid">

    <div class="container mt-4">
        <!-- Mensajes de éxito/error -->
        @if(session('success'))
            <div class="alert alert-success" style="background: rgba(16, 185, 129, 0.1); color: #10b981; border: 1px solid rgba(16, 185, 129, 0.2); padding: 16px 20px; border-radius: 8px; margin-bottom: 24px; display: flex; align-items: center; gap: 12px;">
                <i class="fas fa-check-circle"></i>
                {{ session('success') }}
            </div>
        @endif

        <!-- Información de la empresa -->
        <div style="background: white; border-radius: 16px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); border: 1px solid #e5e7eb; overflow: hidden; margin-bottom: 24px;">
            <!-- Header de la empresa -->
            <div style="background: linear-gradient(135deg, #D93690 0%, #8B5CF6 100%); color: white; padding: 40px; text-align: center;">
                <div style="width: 120px; height: 120px; background: rgba(255, 255, 255, 0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; font-size: 3rem; overflow: hidden;">
                    <i class="fas fa-building"></i>
                </div>
                <h2 style="font-size: 2rem; font-weight: 700; margin-bottom: 8px;">{{ $empresa['nombre'] }}</h2>
                <p style="font-size: 1.1rem; opacity: 0.9; margin-bottom: 0;">{{ $empresa['descripcion'] }}</p>
            </div>
            
            <!-- Botones de acción -->
            <div style="display: flex; gap: 12px; justify-content: center; padding: 20px 24px; background: #f8fafc; border-top: 1px solid #e5e7eb;">
                <a href="{{ route('empresa.edit') }}" style="padding: 12px 24px; border-radius: 8px; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); border: none; cursor: pointer; font-size: 0.9rem; background: #D93690; color: white;">
                    <i class="fas fa-edit"></i>
                    Editar Información
                </a>
                <a href="{{ route('dashboard') }}" style="padding: 12px 24px; border-radius: 8px; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); border: none; cursor: pointer; font-size: 0.9rem; background: #6b7280; color: white;">
                    <i class="fas fa-arrow-left"></i>
                    Volver al Dashboard
                </a>
            </div>
        </div>

        <!-- Información detallada de la empresa -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 24px; margin-bottom: 24px;">
            <!-- Información básica -->
            <div style="background: white; border-radius: 16px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); border: 1px solid #e5e7eb; padding: 24px;">
                <h3 style="font-size: 1.2rem; font-weight: 700; color: #111827; margin-bottom: 20px; display: flex; align-items: center; gap: 8px;">
                    <i class="fas fa-info-circle" style="color: #D93690;"></i>
                    Información Básica
                </h3>
                <div style="display: flex; justify-content: space-between; align-items: center; padding: 12px 0; border-bottom: 1px solid #e5e7eb;">
                    <span style="font-weight: 600; color: #6b7280; font-size: 0.9rem;">Nombre</span>
                    <span style="color: #111827; font-weight: 500;">{{ $empresa['nombre'] }}</span>
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center; padding: 12px 0; border-bottom: 1px solid #e5e7eb;">
                    <span style="font-weight: 600; color: #6b7280; font-size: 0.9rem;">CIF</span>
                    <span style="color: #111827; font-weight: 500;">{{ $empresa['cif'] }}</span>
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center; padding: 12px 0; border-bottom: 1px solid #e5e7eb;">
                    <span style="font-weight: 600; color: #6b7280; font-size: 0.9rem;">Sector</span>
                    <span style="color: #111827; font-weight: 500;">{{ $empresa['sector'] }}</span>
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center; padding: 12px 0;">
                    <span style="font-weight: 600; color: #6b7280; font-size: 0.9rem;">Fecha Creación</span>
                    <span style="color: #111827; font-weight: 500;">{{ $empresa['fecha_creacion'] }}</span>
                </div>
            </div>

            <!-- Información de contacto -->
            <div style="background: white; border-radius: 16px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); border: 1px solid #e5e7eb; padding: 24px;">
                <h3 style="font-size: 1.2rem; font-weight: 700; color: #111827; margin-bottom: 20px; display: flex; align-items: center; gap: 8px;">
                    <i class="fas fa-phone" style="color: #D93690;"></i>
                    Contacto
                </h3>
                <div style="display: flex; justify-content: space-between; align-items: center; padding: 12px 0; border-bottom: 1px solid #e5e7eb;">
                    <span style="font-weight: 600; color: #6b7280; font-size: 0.9rem;">Dirección</span>
                    <span style="color: #111827; font-weight: 500;">{{ $empresa['direccion'] }}</span>
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center; padding: 12px 0; border-bottom: 1px solid #e5e7eb;">
                    <span style="font-weight: 600; color: #6b7280; font-size: 0.9rem;">Ciudad</span>
                    <span style="color: #111827; font-weight: 500;">{{ $empresa['ciudad'] }}</span>
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center; padding: 12px 0; border-bottom: 1px solid #e5e7eb;">
                    <span style="font-weight: 600; color: #6b7280; font-size: 0.9rem;">Teléfono</span>
                    <span style="color: #111827; font-weight: 500;">{{ $empresa['telefono'] }}</span>
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center; padding: 12px 0;">
                    <span style="font-weight: 600; color: #6b7280; font-size: 0.9rem;">Email</span>
                    <span style="color: #111827; font-weight: 500;">{{ $empresa['email'] }}</span>
                </div>
            </div>
        </div>

            <!-- Estadísticas de la empresa -->
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px; margin-top: 24px; padding: 0 24px 24px;">
                <div style="background: white; border-radius: 12px; padding: 20px; text-align: center; border: 1px solid #e5e7eb; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
                    <div style="width: 48px; height: 48px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 12px; font-size: 1.2rem; color: white; background: #D93690;">
                        <i class="fas fa-users"></i>
                    </div>
                    <div style="font-size: 2rem; font-weight: 700; color: #111827; margin-bottom: 4px;">{{ $empresa['empleados'] }}</div>
                    <div style="color: #6b7280; font-size: 0.9rem; font-weight: 500;">Empleados</div>
                </div>
                
                <div style="background: white; border-radius: 12px; padding: 20px; text-align: center; border: 1px solid #e5e7eb; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
                    <div style="width: 48px; height: 48px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 12px; font-size: 1.2rem; color: white; background: #10b981;">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <div style="font-size: 2rem; font-weight: 700; color: #111827; margin-bottom: 4px;">{{ $empresa['estudiantes'] }}</div>
                    <div style="color: #6b7280; font-size: 0.9rem; font-weight: 500;">Estudiantes</div>
                </div>
                
                <div style="background: white; border-radius: 12px; padding: 20px; text-align: center; border: 1px solid #e5e7eb; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
                    <div style="width: 48px; height: 48px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 12px; font-size: 1.2rem; color: white; background: #3b82f6;">
                        <i class="fas fa-book"></i>
                    </div>
                    <div style="font-size: 2rem; font-weight: 700; color: #111827; margin-bottom: 4px;">{{ $empresa['cursos_activos'] }}</div>
                    <div style="color: #6b7280; font-size: 0.9rem; font-weight: 500;">Cursos Activos</div>
                </div>
                
                <div style="background: white; border-radius: 12px; padding: 20px; text-align: center; border: 1px solid #e5e7eb; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
                    <div style="width: 48px; height: 48px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 12px; font-size: 1.2rem; color: white; background: #f59e0b;">
                        <i class="fas fa-door-open"></i>
                    </div>
                    <div style="font-size: 2rem; font-weight: 700; color: #111827; margin-bottom: 4px;">{{ $empresa['aulas_disponibles'] }}</div>
                    <div style="color: #6b7280; font-size: 0.9rem; font-weight: 500;">Aulas Disponibles</div>
                </div>
            </div>

            <!-- Botones de acción -->
            <div style="display: flex; gap: 12px; justify-content: center; margin-top: 24px; padding: 0 24px 24px;">
                <a href="{{ route('empresa.edit') }}" style="padding: 12px 24px; border-radius: 8px; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); border: none; cursor: pointer; font-size: 0.9rem; background: #D93690; color: white;">
                    <i class="fas fa-edit"></i>
                    Editar Información
                </a>
                <a href="{{ route('dashboard') }}" style="padding: 12px 24px; border-radius: 8px; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); border: none; cursor: pointer; font-size: 0.9rem; background: #6b7280; color: white;">
                    <i class="fas fa-arrow-left"></i>
                    Volver al Dashboard
                </a>
            </div>
        </div>
    </div>
</div>
@endsection