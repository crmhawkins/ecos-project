@extends('crm.layouts.clean_app')

@section('titulo', 'Crear Alumno')

@section('css')
<style>
    .form-header-gradient {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        color: white;
        padding: 24px 32px;
        border-radius: 16px 16px 0 0;
        margin: 0;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
    }
    .form-header-gradient h1 {
        margin: 0;
        font-size: 1.8rem;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .form-header-gradient .btn-back {
        background: white;
        color: var(--primary-color);
        border: none;
        padding: 8px 16px;
        border-radius: 8px;
        font-weight: 600;
        transition: var(--transition);
        display: flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
    }
    .form-header-gradient .btn-back:hover {
        background: #f0f0f0;
        color: var(--primary-color);
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }

    .form-container {
        background: white;
        border-radius: 16px;
        box-shadow: var(--shadow);
        overflow: hidden;
        margin-bottom: 24px;
        border: 1px solid var(--border-color);
    }
    .form-body {
        padding: 32px;
    }
    .form-section-title {
        font-size: 1.4rem;
        font-weight: 600;
        color: var(--primary-color);
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid rgba(var(--primary-color-rgb, 217, 54, 144), 0.1);
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .form-group {
        margin-bottom: 24px;
    }
    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: var(--text-primary);
        font-size: 0.95rem;
    }
    .form-control {
        width: 100%;
        padding: 12px 16px;
        border: 2px solid var(--border-color);
        border-radius: 8px;
        font-size: 1rem;
        transition: var(--transition);
        background: white;
        color: var(--text-primary);
    }
    .form-control:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(var(--primary-color-rgb, 217, 54, 144), 0.1);
    }
    .form-control::placeholder {
        color: var(--text-secondary);
        opacity: 0.7;
    }
    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 24px;
    }
    .file-upload-wrapper {
        border: 2px dashed var(--border-color);
        border-radius: 8px;
        padding: 20px;
        text-align: center;
        cursor: pointer;
        transition: var(--transition);
        position: relative;
        overflow: hidden;
    }
    .file-upload-wrapper:hover {
        border-color: var(--primary-color);
        background-color: rgba(var(--primary-color-rgb, 217, 54, 144), 0.05);
    }
    .file-upload-wrapper input[type="file"] {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
    }
    .file-upload-wrapper i {
        font-size: 2.5rem;
        color: var(--text-secondary);
        margin-bottom: 10px;
    }
    .file-upload-wrapper p {
        margin: 0;
        color: var(--text-secondary);
        font-weight: 500;
    }
    .image-preview {
        margin-top: 20px;
        border: 1px solid var(--border-color);
        border-radius: 8px;
        padding: 10px;
        display: inline-block;
        max-width: 100%;
    }
    .image-preview img {
        max-width: 100%;
        height: auto;
        border-radius: 4px;
    }
    .btn-group-form {
        display: flex;
        gap: 12px;
        padding: 24px 32px;
        background: var(--bg-light);
        border-top: 1px solid var(--border-color);
        border-radius: 0 0 16px 16px;
        justify-content: flex-end;
    }
    .btn-submit {
        background: var(--primary-color);
        color: white;
        padding: 12px 24px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        transition: var(--transition);
        border: none;
        cursor: pointer;
        font-size: 1rem;
    }
    .btn-submit:hover {
        background: #c2185b;
        color: white;
    }
    .btn-cancel {
        background: var(--text-secondary);
        color: white;
        padding: 12px 24px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        transition: var(--transition);
        border: none;
        cursor: pointer;
        font-size: 1rem;
    }
    .btn-cancel:hover {
        background: #4b5563;
        color: white;
        text-decoration: none;
    }

    @media (max-width: 768px) {
        .form-row {
            grid-template-columns: 1fr;
            gap: 16px;
        }
        .form-body {
            padding: 24px;
        }
        .form-header-gradient {
            padding: 18px 24px;
        }
        .form-header-gradient h1 {
            font-size: 1.5rem;
        }
        .btn-group-form {
            flex-direction: column;
            padding: 18px 24px;
        }
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-triangle"></i>
            <strong>Error:</strong>
            <ul style="margin: 8px 0 0 0; padding-left: 20px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('crm.alumnos.store') }}" enctype="multipart/form-data">
        @csrf
        
        <div class="form-container">
            <div class="form-header-gradient">
                <h1><i class="fas fa-user-plus"></i> Crear Nuevo Alumno</h1>
                <a href="{{ route('crm.alumnos.index') }}" class="btn-back">
                    <i class="fas fa-arrow-left"></i> Volver al Listado
                </a>
            </div>
            
            <div class="form-body">
                <h3 class="form-section-title"><i class="fas fa-user"></i> Información Personal</h3>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="name">Nombre <span style="color: red;">*</span></label>
                        <input type="text" name="name" id="name" class="form-control" 
                               value="{{ old('name') }}" placeholder="Nombre del alumno" required>
                    </div>
                    <div class="form-group">
                        <label for="surname">Apellidos</label>
                        <input type="text" name="surname" id="surname" class="form-control" 
                               value="{{ old('surname') }}" placeholder="Apellidos del alumno">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="email">Email <span style="color: red;">*</span></label>
                        <input type="email" name="email" id="email" class="form-control" 
                               value="{{ old('email') }}" placeholder="correo@ejemplo.com" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Teléfono</label>
                        <input type="tel" name="phone" id="phone" class="form-control" 
                               value="{{ old('phone') }}" placeholder="+34 600 000 000">
                    </div>
                </div>

                <div class="form-group">
                    <label for="username">Nombre de Usuario</label>
                    <input type="text" name="username" id="username" class="form-control" 
                           value="{{ old('username') }}" placeholder="Nombre de usuario único">
                    <small style="color: var(--text-secondary); font-size: 0.85rem; margin-top: 5px; display: block;">
                        Si se deja vacío, se generará automáticamente basado en el email
                    </small>
                </div>

                <div class="form-group">
                    <label for="avatar">Foto de Perfil</label>
                    <div class="file-upload-wrapper" id="fileUploadWrapper">
                        <input type="file" name="avatar" id="avatar" accept="image/*">
                        <i class="fas fa-cloud-upload-alt"></i>
                        <p>Arrastra y suelta una imagen aquí o haz clic para seleccionar</p>
                    </div>
                    <div id="imagePreview" class="image-preview" style="display: none;">
                        <img src="#" alt="Previsualización de avatar" style="max-width: 150px; height: auto;">
                    </div>
                </div>

                <h3 class="form-section-title"><i class="fas fa-graduation-cap"></i> Configuración Académica</h3>
                
                <div class="form-group">
                    <label for="password">Contraseña Temporal</label>
                    <input type="password" name="password" id="password" class="form-control" 
                           placeholder="Contraseña para el acceso inicial">
                    <small style="color: var(--text-secondary); font-size: 0.85rem; margin-top: 5px; display: block;">
                        Si se deja vacío, se generará una contraseña automática que se enviará por email
                    </small>
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirmar Contraseña</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" 
                           placeholder="Repetir la contraseña">
                </div>
            </div>
        </div>

        <div class="btn-group-form" style="background: white; border-radius: 16px; box-shadow: var(--shadow); border: 1px solid var(--border-color);">
            <a href="{{ route('crm.alumnos.index') }}" class="btn-cancel">
                <i class="fas fa-times"></i> Cancelar
            </a>
            <button type="submit" class="btn-submit">
                <i class="fas fa-save"></i> Crear Alumno
            </button>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Preview de imagen
    const avatarInput = document.getElementById('avatar');
    const imagePreview = document.getElementById('imagePreview');
    const previewImg = imagePreview.querySelector('img');

    avatarInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                imagePreview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        } else {
            imagePreview.style.display = 'none';
        }
    });

    // Generar username automático basado en email
    const emailInput = document.getElementById('email');
    const usernameInput = document.getElementById('username');
    
    emailInput.addEventListener('blur', function() {
        if (!usernameInput.value && emailInput.value) {
            const emailPart = emailInput.value.split('@')[0];
            usernameInput.value = emailPart.toLowerCase().replace(/[^a-z0-9]/g, '');
        }
    });

    // Validación de contraseñas
    const passwordInput = document.getElementById('password');
    const confirmPasswordInput = document.getElementById('password_confirmation');
    
    function validatePasswords() {
        if (passwordInput.value && confirmPasswordInput.value) {
            if (passwordInput.value !== confirmPasswordInput.value) {
                confirmPasswordInput.setCustomValidity('Las contraseñas no coinciden');
            } else {
                confirmPasswordInput.setCustomValidity('');
            }
        }
    }
    
    passwordInput.addEventListener('input', validatePasswords);
    confirmPasswordInput.addEventListener('input', validatePasswords);
});
</script>
@endsection
