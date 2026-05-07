@extends('crm.layouts.clean_app')

@section('titulo', 'Mi Perfil')

@section('content')
<div class="container py-4">

    @if(session('success'))
        <div style="background: rgba(16,185,129,0.1); color: #10b981; border: 1px solid rgba(16,185,129,0.2); padding: 14px 20px; border-radius: 10px; margin-bottom: 24px; display: flex; align-items: center; gap: 10px;">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    <div style="background: white; border-radius: 20px; box-shadow: 0 8px 32px rgba(0,0,0,0.08); border: 1px solid #f0f0f0; overflow: hidden;">

        <!-- Hero unificado -->
        <div style="background: linear-gradient(135deg, #D93690 0%, #8B5CF6 100%); padding: 40px 32px; display: flex; align-items: center; gap: 28px; position: relative;">
            <div style="width: 96px; height: 96px; border-radius: 50%; background: rgba(255,255,255,0.2); border: 3px solid rgba(255,255,255,0.5); overflow: hidden; flex-shrink: 0; display: flex; align-items: center; justify-content: center; font-size: 2.5rem; color: white;">
                @if($user->avatar)
                    <img src="{{ Storage::url($user->avatar) }}" alt="Avatar" style="width:100%;height:100%;object-fit:cover;">
                @else
                    <i class="fas fa-user"></i>
                @endif
            </div>
            <div style="flex: 1;">
                <h2 style="color: white; font-size: 1.6rem; font-weight: 700; margin: 0 0 4px;">{{ $user->name }}</h2>
                <p style="color: rgba(255,255,255,0.8); margin: 0; font-size: 0.95rem;">{{ $user->email }}</p>
                <span style="display: inline-block; margin-top: 10px; background: rgba(255,255,255,0.2); color: white; padding: 3px 12px; border-radius: 20px; font-size: 0.8rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">Admin</span>
            </div>
            <a href="{{ route('user.profile.edit') }}" style="position: absolute; top: 20px; right: 24px; background: rgba(255,255,255,0.15); color: white; border: 1px solid rgba(255,255,255,0.4); padding: 8px 18px; border-radius: 8px; font-size: 0.85rem; font-weight: 600; text-decoration: none; display: flex; align-items: center; gap: 6px; backdrop-filter: blur(4px);">
                <i class="fas fa-edit"></i> Editar
            </a>
        </div>

        <!-- Info + Config -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 0; border-bottom: 1px solid #f0f0f0;">
            <!-- Información Personal -->
            <div style="padding: 28px 32px; border-right: 1px solid #f0f0f0;">
                <h3 style="font-size: 0.8rem; font-weight: 700; color: #9ca3af; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 20px;">
                    <i class="fas fa-user-circle" style="color: #D93690; margin-right: 6px;"></i> Información Personal
                </h3>
                @foreach([
                    ['Nombre', $user->name],
                    ['Email', $user->email],
                    ['Teléfono', $user->phone ?? 'No especificado'],
                    ['Miembro desde', $user->created_at ? $user->created_at->format('d/m/Y') : 'No disponible'],
                ] as [$label, $value])
                <div style="display: flex; justify-content: space-between; align-items: center; padding: 10px 0; border-bottom: 1px solid #f9fafb;">
                    <span style="color: #9ca3af; font-size: 0.85rem; font-weight: 500;">{{ $label }}</span>
                    <span style="color: #111827; font-size: 0.9rem; font-weight: 600;">{{ $value }}</span>
                </div>
                @endforeach
            </div>

            <!-- Configuración -->
            <div style="padding: 28px 32px;">
                <h3 style="font-size: 0.8rem; font-weight: 700; color: #9ca3af; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 20px;">
                    <i class="fas fa-cog" style="color: #8B5CF6; margin-right: 6px;"></i> Configuración
                </h3>
                @foreach([
                    ['Idioma', $user->language ?? 'Español'],
                    ['Zona Horaria', $user->timezone ?? 'Europe/Madrid'],
                    ['Tema', ucfirst($user->theme ?? 'Claro')],
                ] as [$label, $value])
                <div style="display: flex; justify-content: space-between; align-items: center; padding: 10px 0; border-bottom: 1px solid #f9fafb;">
                    <span style="color: #9ca3af; font-size: 0.85rem; font-weight: 500;">{{ $label }}</span>
                    <span style="color: #111827; font-size: 0.9rem; font-weight: 600;">{{ $value }}</span>
                </div>
                @endforeach
                <div style="display: flex; justify-content: space-between; align-items: center; padding: 10px 0;">
                    <span style="color: #9ca3af; font-size: 0.85rem; font-weight: 500;">Notificaciones</span>
                    @if($user->notifications_email ?? true)
                        <span style="background: rgba(16,185,129,0.1); color: #10b981; padding: 3px 10px; border-radius: 20px; font-size: 0.8rem; font-weight: 600;">Activadas</span>
                    @else
                        <span style="background: rgba(239,68,68,0.1); color: #ef4444; padding: 3px 10px; border-radius: 20px; font-size: 0.8rem; font-weight: 600;">Desactivadas</span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Stats -->
        <div style="display: grid; grid-template-columns: repeat(3, 1fr); border-bottom: 1px solid #f0f0f0;">
            @foreach([
                ['fas fa-calendar-alt', '#D93690', optional($user->created_at)->diffInDays(now()) ?? 0, 'Días activo'],
                ['fas fa-shield-alt', '#10b981', 'Admin', 'Rol de usuario'],
                ['fas fa-clock', '#3b82f6', '24/7', 'Acceso disponible'],
            ] as [$icon, $color, $val, $label])
            <div style="padding: 24px 20px; text-align: center; border-right: 1px solid #f0f0f0;">
                <div style="width: 44px; height: 44px; border-radius: 12px; background: {{ $color }}18; display: flex; align-items: center; justify-content: center; margin: 0 auto 10px; color: {{ $color }}; font-size: 1.1rem;">
                    <i class="{{ $icon }}"></i>
                </div>
                <div style="font-size: 1.4rem; font-weight: 700; color: #111827; line-height: 1;">{{ $val }}</div>
                <div style="color: #9ca3af; font-size: 0.8rem; margin-top: 4px;">{{ $label }}</div>
            </div>
            @endforeach
        </div>

        <!-- Acciones -->
        <div style="padding: 20px 32px; display: flex; gap: 10px; justify-content: flex-end;">
            <a href="{{ route('user.settings') }}" style="padding: 10px 20px; border-radius: 8px; font-weight: 600; font-size: 0.85rem; text-decoration: none; display: inline-flex; align-items: center; gap: 6px; border: 1px solid #e5e7eb; color: #6b7280; background: white;">
                <i class="fas fa-cog"></i> Configuración
            </a>
            <a href="{{ route('dashboard') }}" style="padding: 10px 20px; border-radius: 8px; font-weight: 600; font-size: 0.85rem; text-decoration: none; display: inline-flex; align-items: center; gap: 6px; border: 1px solid #e5e7eb; color: #6b7280; background: white;">
                <i class="fas fa-arrow-left"></i> Dashboard
            </a>
            <a href="{{ route('user.profile.edit') }}" style="padding: 10px 20px; border-radius: 8px; font-weight: 600; font-size: 0.85rem; text-decoration: none; display: inline-flex; align-items: center; gap: 6px; background: linear-gradient(135deg, #D93690, #8B5CF6); color: white;">
                <i class="fas fa-edit"></i> Editar Perfil
            </a>
        </div>

    </div>
</div>
@endsection
