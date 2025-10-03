@extends('crm.layouts.clean_app')

@section('titulo', 'Mi Perfil')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div style="background: linear-gradient(135deg, #D93690 0%, #8B5CF6 100%); color: white; padding: 40px 0;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="mb-0">
                        <i class="fas fa-user"></i>
                        Mi Perfil
                    </h1>
                    <p class="mb-0 mt-2" style="opacity: 0.9;">Gestiona tu información personal y configuración</p>
                </div>
                <div class="col-md-4 text-end">
                    <a href="{{ route('user.profile.edit') }}" class="btn btn-light">
                        <i class="fas fa-edit"></i>
                        Editar Perfil
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

        <!-- Tarjeta principal del perfil -->
        <div style="background: white; border-radius: 16px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); border: 1px solid #e5e7eb; overflow: hidden;">
            <!-- Header del perfil -->
            <div style="background: linear-gradient(135deg, #D93690 0%, #8B5CF6 100%); color: white; padding: 40px; text-align: center;">
                <div style="width: 120px; height: 120px; background: rgba(255, 255, 255, 0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; font-size: 3rem; overflow: hidden;">
                    @if($user->avatar)
                        <img src="{{ Storage::url($user->avatar) }}" alt="Avatar" style="width: 100%; height: 100%; object-fit: cover;">
                    @else
                        <i class="fas fa-user"></i>
                    @endif
                </div>
                <h2 style="font-size: 2rem; font-weight: 700; margin-bottom: 8px;">{{ $user->name }}</h2>
                <p style="font-size: 1.1rem; opacity: 0.9; margin-bottom: 0;">{{ $user->email }}</p>
            </div>
            
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 24px; padding: 24px;">
                <!-- Información personal -->
                <div style="background: #f8fafc; border-radius: 12px; padding: 20px; border: 1px solid #e5e7eb;">
                    <h3 style="font-size: 1.1rem; font-weight: 600; color: #111827; margin-bottom: 16px; display: flex; align-items: center; gap: 8px;">
                        <i class="fas fa-user-circle"></i>
                        Información Personal
                    </h3>
                    <div style="display: flex; justify-content: space-between; align-items: center; padding: 12px 0; border-bottom: 1px solid #e5e7eb;">
                        <span style="font-weight: 600; color: #6b7280; font-size: 0.9rem;">Nombre</span>
                        <span style="color: #111827; font-weight: 500;">{{ $user->name }}</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; align-items: center; padding: 12px 0; border-bottom: 1px solid #e5e7eb;">
                        <span style="font-weight: 600; color: #6b7280; font-size: 0.9rem;">Email</span>
                        <span style="color: #111827; font-weight: 500;">{{ $user->email }}</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; align-items: center; padding: 12px 0; border-bottom: 1px solid #e5e7eb;">
                        <span style="font-weight: 600; color: #6b7280; font-size: 0.9rem;">Teléfono</span>
                        <span style="color: #111827; font-weight: 500;">{{ $user->phone ?? 'No especificado' }}</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; align-items: center; padding: 12px 0;">
                        <span style="font-weight: 600; color: #6b7280; font-size: 0.9rem;">Miembro desde</span>
                        <span style="color: #111827; font-weight: 500;">{{ $user->created_at ? $user->created_at->format('d/m/Y') : 'No disponible' }}</span>
                    </div>
                </div>

                <!-- Configuración de cuenta -->
                <div style="background: #f8fafc; border-radius: 12px; padding: 20px; border: 1px solid #e5e7eb;">
                    <h3 style="font-size: 1.1rem; font-weight: 600; color: #111827; margin-bottom: 16px; display: flex; align-items: center; gap: 8px;">
                        <i class="fas fa-cog"></i>
                        Configuración
                    </h3>
                    <div style="display: flex; justify-content: space-between; align-items: center; padding: 12px 0; border-bottom: 1px solid #e5e7eb;">
                        <span style="font-weight: 600; color: #6b7280; font-size: 0.9rem;">Idioma</span>
                        <span style="color: #111827; font-weight: 500;">{{ $user->language ?? 'Español' }}</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; align-items: center; padding: 12px 0; border-bottom: 1px solid #e5e7eb;">
                        <span style="font-weight: 600; color: #6b7280; font-size: 0.9rem;">Zona Horaria</span>
                        <span style="color: #111827; font-weight: 500;">{{ $user->timezone ?? 'Europe/Madrid' }}</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; align-items: center; padding: 12px 0; border-bottom: 1px solid #e5e7eb;">
                        <span style="font-weight: 600; color: #6b7280; font-size: 0.9rem;">Tema</span>
                        <span style="color: #111827; font-weight: 500;">{{ ucfirst($user->theme ?? 'Claro') }}</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; align-items: center; padding: 12px 0;">
                        <span style="font-weight: 600; color: #6b7280; font-size: 0.9rem;">Notificaciones</span>
                        <span style="color: #111827; font-weight: 500;">
                            @if($user->notifications_email ?? true)
                                <span style="color: #10b981;">Activadas</span>
                            @else
                                <span style="color: #ef4444;">Desactivadas</span>
                            @endif
                        </span>
                    </div>
                </div>
            </div>

            <!-- Estadísticas del usuario -->
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px; margin-top: 24px; padding: 0 24px 24px;">
                <div style="background: white; border-radius: 12px; padding: 20px; text-align: center; border: 1px solid #e5e7eb; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
                    <div style="width: 48px; height: 48px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 12px; font-size: 1.2rem; color: white; background: #D93690;">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <div style="font-size: 2rem; font-weight: 700; color: #111827; margin-bottom: 4px;">{{ $user->created_at->diffInDays(now()) }}</div>
                    <div style="color: #6b7280; font-size: 0.9rem; font-weight: 500;">Días activo</div>
                </div>
                
                <div style="background: white; border-radius: 12px; padding: 20px; text-align: center; border: 1px solid #e5e7eb; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
                    <div style="width: 48px; height: 48px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 12px; font-size: 1.2rem; color: white; background: #10b981;">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <div style="font-size: 2rem; font-weight: 700; color: #111827; margin-bottom: 4px;">Admin</div>
                    <div style="color: #6b7280; font-size: 0.9rem; font-weight: 500;">Rol de usuario</div>
                </div>
                
                <div style="background: white; border-radius: 12px; padding: 20px; text-align: center; border: 1px solid #e5e7eb; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
                    <div style="width: 48px; height: 48px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 12px; font-size: 1.2rem; color: white; background: #3b82f6;">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div style="font-size: 2rem; font-weight: 700; color: #111827; margin-bottom: 4px;">24/7</div>
                    <div style="color: #6b7280; font-size: 0.9rem; font-weight: 500;">Acceso disponible</div>
                </div>
            </div>

            <!-- Botones de acción -->
            <div style="display: flex; gap: 12px; justify-content: center; margin-top: 24px; padding: 0 24px 24px;">
                <a href="{{ route('user.profile.edit') }}" style="padding: 12px 24px; border-radius: 8px; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); border: none; cursor: pointer; font-size: 0.9rem; background: #D93690; color: white;">
                    <i class="fas fa-edit"></i>
                    Editar Perfil
                </a>
                <a href="{{ route('user.settings') }}" style="padding: 12px 24px; border-radius: 8px; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); border: none; cursor: pointer; font-size: 0.9rem; background: #3b82f6; color: white;">
                    <i class="fas fa-cog"></i>
                    Configuración
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
