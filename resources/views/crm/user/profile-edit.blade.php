@extends('crm.layouts.clean_app')

@section('titulo', 'Editar Perfil')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div style="background: linear-gradient(135deg, #D93690 0%, #8B5CF6 100%); color: white; padding: 40px 0;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="mb-0">
                        <i class="fas fa-edit"></i>
                        Editar Perfil
                    </h1>
                    <p class="mb-0 mt-2" style="opacity: 0.9;">Actualiza tu información personal</p>
                </div>
                <div class="col-md-4 text-end">
                    <a href="{{ route('user.profile') }}" class="btn btn-light">
                        <i class="fas fa-arrow-left"></i>
                        Volver
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

        <!-- Formulario -->
        <div style="background: white; border-radius: 16px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); border: 1px solid #e5e7eb; overflow: hidden;">
            <div style="background: #f8fafc; padding: 20px 24px; border-bottom: 1px solid #e5e7eb;">
                <h3 style="margin: 0; font-size: 1.2rem; font-weight: 700; color: #111827; display: flex; align-items: center; gap: 8px;">
                    <i class="fas fa-user"></i> Información Personal
                </h3>
            </div>
            
            <form method="POST" action="{{ route('user.profile.update') }}" enctype="multipart/form-data" style="padding: 24px;">
                @csrf
                @method('PUT')
                
                <!-- Información básica -->
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px; margin-bottom: 32px;">
                    <div style="display: flex; flex-direction: column; gap: 8px;">
                        <label for="name" style="font-weight: 600; color: #111827; font-size: 0.9rem;">Nombre Completo *</label>
                        <input type="text" id="name" name="name" 
                               style="padding: 12px 16px; border: 1px solid #e5e7eb; border-radius: 8px; font-size: 0.9rem; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); background: white;"
                               value="{{ old('name', $user->name) }}" required>
                        @error('name')
                            <div style="color: #ef4444; font-size: 0.8rem; margin-top: 4px;">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div style="display: flex; flex-direction: column; gap: 8px;">
                        <label for="email" style="font-weight: 600; color: #111827; font-size: 0.9rem;">Email *</label>
                        <input type="email" id="email" name="email" 
                               style="padding: 12px 16px; border: 1px solid #e5e7eb; border-radius: 8px; font-size: 0.9rem; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); background: white;"
                               value="{{ old('email', $user->email) }}" required>
                        @error('email')
                            <div style="color: #ef4444; font-size: 0.8rem; margin-top: 4px;">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div style="display: flex; flex-direction: column; gap: 8px;">
                        <label for="phone" style="font-weight: 600; color: #111827; font-size: 0.9rem;">Teléfono</label>
                        <input type="text" id="phone" name="phone" 
                               style="padding: 12px 16px; border: 1px solid #e5e7eb; border-radius: 8px; font-size: 0.9rem; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); background: white;"
                               value="{{ old('phone', $user->phone) }}">
                        @error('phone')
                            <div style="color: #ef4444; font-size: 0.8rem; margin-top: 4px;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Avatar -->
                <div style="margin-bottom: 32px;">
                    <label style="font-weight: 600; color: #111827; font-size: 0.9rem; margin-bottom: 8px; display: block;">Avatar</label>
                    <div style="display: flex; align-items: center; gap: 20px;">
                        <div style="width: 80px; height: 80px; border-radius: 50%; overflow: hidden; border: 2px solid #e5e7eb;">
                            @if($user->avatar)
                                <img src="{{ Storage::url($user->avatar) }}" alt="Avatar actual" style="width: 100%; height: 100%; object-fit: cover;">
                            @else
                                <div style="width: 100%; height: 100%; background: #f3f4f6; display: flex; align-items: center; justify-content: center; font-size: 2rem; color: #6b7280;">
                                    <i class="fas fa-user"></i>
                                </div>
                            @endif
                        </div>
                        <div style="flex: 1;">
                            <input type="file" id="avatar" name="avatar" accept="image/*" 
                                   style="padding: 8px; border: 1px solid #e5e7eb; border-radius: 8px; font-size: 0.9rem; background: white;">
                            <div style="color: #6b7280; font-size: 0.8rem; margin-top: 4px;">Formatos: JPEG, PNG, JPG, GIF. Máximo 2MB</div>
                            @error('avatar')
                                <div style="color: #ef4444; font-size: 0.8rem; margin-top: 4px;">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Cambio de contraseña -->
                <div style="background: #f8fafc; border-radius: 12px; padding: 20px; margin-bottom: 32px; border: 1px solid #e5e7eb;">
                    <h4 style="font-size: 1.1rem; font-weight: 600; color: #111827; margin-bottom: 16px; display: flex; align-items: center; gap: 8px;">
                        <i class="fas fa-lock"></i>
                        Cambiar Contraseña
                    </h4>
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 16px;">
                        <div style="display: flex; flex-direction: column; gap: 8px;">
                            <label for="current_password" style="font-weight: 600; color: #111827; font-size: 0.9rem;">Contraseña Actual</label>
                            <input type="password" id="current_password" name="current_password" 
                                   style="padding: 12px 16px; border: 1px solid #e5e7eb; border-radius: 8px; font-size: 0.9rem; background: white;">
                            @error('current_password')
                                <div style="color: #ef4444; font-size: 0.8rem; margin-top: 4px;">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div style="display: flex; flex-direction: column; gap: 8px;">
                            <label for="new_password" style="font-weight: 600; color: #111827; font-size: 0.9rem;">Nueva Contraseña</label>
                            <input type="password" id="new_password" name="new_password" 
                                   style="padding: 12px 16px; border: 1px solid #e5e7eb; border-radius: 8px; font-size: 0.9rem; background: white;">
                            @error('new_password')
                                <div style="color: #ef4444; font-size: 0.8rem; margin-top: 4px;">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div style="display: flex; flex-direction: column; gap: 8px;">
                            <label for="new_password_confirmation" style="font-weight: 600; color: #111827; font-size: 0.9rem;">Confirmar Nueva Contraseña</label>
                            <input type="password" id="new_password_confirmation" name="new_password_confirmation" 
                                   style="padding: 12px 16px; border: 1px solid #e5e7eb; border-radius: 8px; font-size: 0.9rem; background: white;">
                        </div>
                    </div>
                    <div style="color: #6b7280; font-size: 0.8rem; margin-top: 8px;">
                        <i class="fas fa-info-circle"></i>
                        Deja estos campos vacíos si no quieres cambiar la contraseña
                    </div>
                </div>

                <!-- Botones de acción -->
                <div style="display: flex; gap: 12px; justify-content: flex-end; padding: 20px 0; border-top: 1px solid #e5e7eb;">
                    <a href="{{ route('user.profile') }}" style="padding: 12px 24px; border-radius: 8px; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); border: none; cursor: pointer; font-size: 0.9rem; background: #6b7280; color: white;">
                        <i class="fas fa-times"></i>
                        Cancelar
                    </a>
                    <button type="submit" style="padding: 12px 24px; border-radius: 8px; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); border: none; cursor: pointer; font-size: 0.9rem; background: #D93690; color: white;">
                        <i class="fas fa-save"></i>
                        Guardar Cambios
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
