@extends('crm.layouts.clean_app')

@section('titulo', 'Configuración')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div style="background: linear-gradient(135deg, #D93690 0%, #8B5CF6 100%); color: white; padding: 40px 0;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="mb-0">
                        <i class="fas fa-cog"></i>
                        Configuración
                    </h1>
                    <p class="mb-0 mt-2" style="opacity: 0.9;">Personaliza tu experiencia en el sistema</p>
                </div>
                <div class="col-md-4 text-end">
                    <a href="{{ route('user.profile') }}" class="btn btn-light">
                        <i class="fas fa-arrow-left"></i>
                        Volver al Perfil
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

        @if($errors->any())
            <div class="alert alert-danger" style="background: rgba(239, 68, 68, 0.1); color: #ef4444; border: 1px solid rgba(239, 68, 68, 0.2); padding: 16px 20px; border-radius: 8px; margin-bottom: 24px; display: flex; align-items: center; gap: 12px;">
                <i class="fas fa-exclamation-triangle"></i>
                <strong>Error:</strong>
                <ul style="margin: 8px 0 0 0; padding-left: 20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Formulario de configuración -->
        <div style="background: white; border-radius: 16px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); border: 1px solid #e5e7eb; overflow: hidden;">
            <div style="background: #f8fafc; padding: 20px 24px; border-bottom: 1px solid #e5e7eb;">
                <h3 style="margin: 0; font-size: 1.2rem; font-weight: 700; color: #111827; display: flex; align-items: center; gap: 8px;">
                    <i class="fas fa-cog"></i> Configuración del Sistema
                </h3>
            </div>
            
            <form method="POST" action="{{ route('user.settings.update') }}" style="padding: 24px;">
                @csrf
                @method('PUT')
                
                <!-- Configuración de idioma y zona horaria -->
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px; margin-bottom: 32px;">
                    <div style="display: flex; flex-direction: column; gap: 8px;">
                        <label for="language" style="font-weight: 600; color: #111827; font-size: 0.9rem;">Idioma *</label>
                        <select id="language" name="language" 
                                style="padding: 12px 16px; border: 1px solid #e5e7eb; border-radius: 8px; font-size: 0.9rem; background: white;">
                            <option value="es" {{ old('language', $settings->language ?? 'es') == 'es' ? 'selected' : '' }}>Español</option>
                            <option value="en" {{ old('language', $settings->language ?? 'es') == 'en' ? 'selected' : '' }}>English</option>
                        </select>
                        @error('language')
                            <div style="color: #ef4444; font-size: 0.8rem; margin-top: 4px;">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div style="display: flex; flex-direction: column; gap: 8px;">
                        <label for="timezone" style="font-weight: 600; color: #111827; font-size: 0.9rem;">Zona Horaria *</label>
                        <select id="timezone" name="timezone" 
                                style="padding: 12px 16px; border: 1px solid #e5e7eb; border-radius: 8px; font-size: 0.9rem; background: white;">
                            <option value="Europe/Madrid" {{ old('timezone', $settings->timezone ?? 'Europe/Madrid') == 'Europe/Madrid' ? 'selected' : '' }}>Madrid (GMT+1)</option>
                            <option value="Europe/London" {{ old('timezone', $settings->timezone ?? 'Europe/Madrid') == 'Europe/London' ? 'selected' : '' }}>Londres (GMT+0)</option>
                            <option value="America/New_York" {{ old('timezone', $settings->timezone ?? 'Europe/Madrid') == 'America/New_York' ? 'selected' : '' }}>Nueva York (GMT-5)</option>
                            <option value="America/Los_Angeles" {{ old('timezone', $settings->timezone ?? 'Europe/Madrid') == 'America/Los_Angeles' ? 'selected' : '' }}>Los Ángeles (GMT-8)</option>
                        </select>
                        @error('timezone')
                            <div style="color: #ef4444; font-size: 0.8rem; margin-top: 4px;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Configuración de tema -->
                <div style="margin-bottom: 32px;">
                    <label style="font-weight: 600; color: #111827; font-size: 0.9rem; margin-bottom: 12px; display: block;">Tema de la Interfaz *</label>
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px;">
                        <label style="display: flex; align-items: center; gap: 12px; padding: 16px; border: 2px solid {{ old('theme', $settings->theme ?? 'light') == 'light' ? '#D93690' : '#e5e7eb' }}; border-radius: 12px; cursor: pointer; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);">
                            <input type="radio" name="theme" value="light" {{ old('theme', $settings->theme ?? 'light') == 'light' ? 'checked' : '' }} style="margin: 0;">
                            <div style="display: flex; align-items: center; gap: 8px;">
                                <i class="fas fa-sun" style="color: #f59e0b;"></i>
                                <span style="font-weight: 500;">Claro</span>
                            </div>
                        </label>
                        
                        <label style="display: flex; align-items: center; gap: 12px; padding: 16px; border: 2px solid {{ old('theme', $settings->theme ?? 'light') == 'dark' ? '#D93690' : '#e5e7eb' }}; border-radius: 12px; cursor: pointer; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);">
                            <input type="radio" name="theme" value="dark" {{ old('theme', $settings->theme ?? 'light') == 'dark' ? 'checked' : '' }} style="margin: 0;">
                            <div style="display: flex; align-items: center; gap: 8px;">
                                <i class="fas fa-moon" style="color: #6366f1;"></i>
                                <span style="font-weight: 500;">Oscuro</span>
                            </div>
                        </label>
                    </div>
                    @error('theme')
                        <div style="color: #ef4444; font-size: 0.8rem; margin-top: 4px;">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Configuración de notificaciones -->
                <div style="background: #f8fafc; border-radius: 12px; padding: 20px; margin-bottom: 32px; border: 1px solid #e5e7eb;">
                    <h4 style="font-size: 1.1rem; font-weight: 600; color: #111827; margin-bottom: 16px; display: flex; align-items: center; gap: 8px;">
                        <i class="fas fa-bell"></i>
                        Notificaciones
                    </h4>
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px;">
                        <div style="display: flex; align-items: center; justify-content: space-between; padding: 16px; background: white; border-radius: 8px; border: 1px solid #e5e7eb;">
                            <div style="display: flex; align-items: center; gap: 12px;">
                                <i class="fas fa-envelope" style="color: #3b82f6;"></i>
                                <div>
                                    <div style="font-weight: 600; color: #111827;">Notificaciones por Email</div>
                                    <div style="color: #6b7280; font-size: 0.8rem;">Recibir notificaciones importantes por correo</div>
                                </div>
                            </div>
                            <label style="position: relative; display: inline-block; width: 50px; height: 24px;">
                                <input type="checkbox" name="email_notifications" value="1" {{ old('email_notifications', $settings->email_notifications ?? true) ? 'checked' : '' }} style="opacity: 0; width: 0; height: 0;">
                                <span style="position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background-color: {{ old('email_notifications', $settings->email_notifications ?? true) ? '#D93690' : '#ccc' }}; transition: .4s; border-radius: 24px;">
                                    <span style="position: absolute; content: ''; height: 18px; width: 18px; left: 3px; bottom: 3px; background-color: white; transition: .4s; border-radius: 50%; transform: {{ old('email_notifications', $settings->email_notifications ?? true) ? 'translateX(26px)' : 'translateX(0)' }};"></span>
                                </span>
                            </label>
                        </div>
                        
                        <div style="display: flex; align-items: center; justify-content: space-between; padding: 16px; background: white; border-radius: 8px; border: 1px solid #e5e7eb;">
                            <div style="display: flex; align-items: center; gap: 12px;">
                                <i class="fas fa-desktop" style="color: #10b981;"></i>
                                <div>
                                    <div style="font-weight: 600; color: #111827;">Notificaciones del Sistema</div>
                                    <div style="color: #6b7280; font-size: 0.8rem;">Mostrar notificaciones en la interfaz</div>
                                </div>
                            </div>
                            <label style="position: relative; display: inline-block; width: 50px; height: 24px;">
                                <input type="checkbox" name="system_notifications" value="1" {{ old('system_notifications', $settings->system_notifications ?? true) ? 'checked' : '' }} style="opacity: 0; width: 0; height: 0;">
                                <span style="position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background-color: {{ old('system_notifications', $settings->system_notifications ?? true) ? '#D93690' : '#ccc' }}; transition: .4s; border-radius: 24px;">
                                    <span style="position: absolute; content: ''; height: 18px; width: 18px; left: 3px; bottom: 3px; background-color: white; transition: .4s; border-radius: 50%; transform: {{ old('system_notifications', $settings->system_notifications ?? true) ? 'translateX(26px)' : 'translateX(0)' }};"></span>
                                </span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Información adicional -->
                <div style="background: #f0f9ff; border-radius: 12px; padding: 20px; margin-bottom: 32px; border: 1px solid #bae6fd;">
                    <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 12px;">
                        <i class="fas fa-info-circle" style="color: #0ea5e9;"></i>
                        <h4 style="margin: 0; font-size: 1rem; font-weight: 600; color: #0c4a6e;">Información Importante</h4>
                    </div>
                    <ul style="color: #0c4a6e; font-size: 0.9rem; margin: 0; padding-left: 20px;">
                        <li>Los cambios de idioma y zona horaria se aplicarán inmediatamente</li>
                        <li>El tema se aplicará en la próxima sesión</li>
                        <li>Las notificaciones por email incluyen alertas importantes del sistema</li>
                        <li>Puedes cambiar estas configuraciones en cualquier momento</li>
                    </ul>
                </div>

                <!-- Botones de acción -->
                <div style="display: flex; gap: 12px; justify-content: flex-end; padding: 20px 0; border-top: 1px solid #e5e7eb;">
                    <a href="{{ route('user.profile') }}" style="padding: 12px 24px; border-radius: 8px; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); border: none; cursor: pointer; font-size: 0.9rem; background: #6b7280; color: white;">
                        <i class="fas fa-times"></i>
                        Cancelar
                    </a>
                    <button type="submit" style="padding: 12px 24px; border-radius: 8px; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); border: none; cursor: pointer; font-size: 0.9rem; background: #D93690; color: white;">
                        <i class="fas fa-save"></i>
                        Guardar Configuración
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
