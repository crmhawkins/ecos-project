@extends('crm.layouts.clean_app')

@section('titulo', 'Editar Perfil')

@section('css')
<style>
.avatar-upload-label {
    display: inline-flex; align-items: center; gap: 8px;
    padding: 9px 18px; border-radius: 8px; font-size: 0.85rem; font-weight: 600;
    cursor: pointer; background: white; border: 1px solid #e5e7eb; color: #374151;
    transition: all 0.2s;
}
.avatar-upload-label:hover { border-color: #D93690; color: #D93690; }
.form-input {
    width: 100%; padding: 11px 14px; border: 1px solid #e5e7eb; border-radius: 8px;
    font-size: 0.9rem; color: #111827; background: white; transition: border-color 0.2s;
    box-sizing: border-box;
}
.form-input:focus { outline: none; border-color: #8B5CF6; box-shadow: 0 0 0 3px rgba(139,92,246,0.1); }
</style>
@endsection

@section('content')
<div class="container py-4">

    <!-- Breadcrumb / back -->
    <div style="margin-bottom: 20px; display: flex; align-items: center; gap: 8px; font-size: 0.85rem; color: #9ca3af;">
        <a href="{{ route('dashboard') }}" style="color: #9ca3af; text-decoration: none;">Dashboard</a>
        <i class="fas fa-chevron-right" style="font-size: 0.7rem;"></i>
        <a href="{{ route('user.profile') }}" style="color: #9ca3af; text-decoration: none;">Mi Perfil</a>
        <i class="fas fa-chevron-right" style="font-size: 0.7rem;"></i>
        <span style="color: #111827; font-weight: 600;">Editar</span>
    </div>

    @if(session('success'))
        <div style="background: rgba(16,185,129,0.1); color: #10b981; border: 1px solid rgba(16,185,129,0.2); padding: 14px 20px; border-radius: 10px; margin-bottom: 20px; display: flex; align-items: center; gap: 10px;">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div style="background: rgba(239,68,68,0.08); color: #ef4444; border: 1px solid rgba(239,68,68,0.2); padding: 14px 20px; border-radius: 10px; margin-bottom: 20px;">
            <div style="display: flex; align-items: center; gap: 8px; font-weight: 600; margin-bottom: 8px;">
                <i class="fas fa-exclamation-triangle"></i> Revisa estos campos:
            </div>
            <ul style="margin: 0; padding-left: 20px;">
                @foreach($errors->all() as $error)
                    <li style="font-size: 0.9rem;">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('user.profile.update') }}" enctype="multipart/form-data">
        @csrf @method('PUT')

        <div style="display: grid; grid-template-columns: 1fr 320px; gap: 20px; align-items: start;">

            <!-- Columna principal -->
            <div style="display: flex; flex-direction: column; gap: 20px;">

                <!-- Información Personal -->
                <div style="background: white; border-radius: 16px; box-shadow: 0 2px 12px rgba(0,0,0,0.06); border: 1px solid #f0f0f0; overflow: hidden;">
                    <div style="padding: 18px 24px; border-bottom: 1px solid #f0f0f0; display: flex; align-items: center; gap: 10px;">
                        <div style="width: 32px; height: 32px; border-radius: 8px; background: linear-gradient(135deg,#D93690,#8B5CF6); display: flex; align-items: center; justify-content: center; color: white; font-size: 0.85rem;">
                            <i class="fas fa-user"></i>
                        </div>
                        <h3 style="margin: 0; font-size: 1rem; font-weight: 700; color: #111827;">Información Personal</h3>
                    </div>
                    <div style="padding: 24px; display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                        <div>
                            <label for="name" style="display: block; font-size: 0.8rem; font-weight: 700; color: #6b7280; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 6px;">Nombre Completo *</label>
                            <input type="text" id="name" name="name" class="form-input" value="{{ old('name', $user->name) }}" required>
                            @error('name')<div style="color:#ef4444;font-size:0.8rem;margin-top:4px;">{{ $message }}</div>@enderror
                        </div>
                        <div>
                            <label for="email" style="display: block; font-size: 0.8rem; font-weight: 700; color: #6b7280; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 6px;">Email *</label>
                            <input type="email" id="email" name="email" class="form-input" value="{{ old('email', $user->email) }}" required>
                            @error('email')<div style="color:#ef4444;font-size:0.8rem;margin-top:4px;">{{ $message }}</div>@enderror
                        </div>
                        <div>
                            <label for="phone" style="display: block; font-size: 0.8rem; font-weight: 700; color: #6b7280; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 6px;">Teléfono</label>
                            <input type="text" id="phone" name="phone" class="form-input" value="{{ old('phone', $user->phone) }}">
                            @error('phone')<div style="color:#ef4444;font-size:0.8rem;margin-top:4px;">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>

                <!-- Cambiar Contraseña -->
                <div style="background: white; border-radius: 16px; box-shadow: 0 2px 12px rgba(0,0,0,0.06); border: 1px solid #f0f0f0; overflow: hidden;">
                    <div style="padding: 18px 24px; border-bottom: 1px solid #f0f0f0; display: flex; align-items: center; gap: 10px;">
                        <div style="width: 32px; height: 32px; border-radius: 8px; background: #f3f4f6; display: flex; align-items: center; justify-content: center; color: #6b7280; font-size: 0.85rem;">
                            <i class="fas fa-lock"></i>
                        </div>
                        <h3 style="margin: 0; font-size: 1rem; font-weight: 700; color: #111827;">Cambiar Contraseña</h3>
                        <span style="margin-left: auto; font-size: 0.78rem; color: #9ca3af;">Deja en blanco para no cambiar</span>
                    </div>
                    <div style="padding: 24px; display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 16px;">
                        <div>
                            <label for="current_password" style="display: block; font-size: 0.8rem; font-weight: 700; color: #6b7280; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 6px;">Contraseña Actual</label>
                            <input type="password" id="current_password" name="current_password" class="form-input">
                            @error('current_password')<div style="color:#ef4444;font-size:0.8rem;margin-top:4px;">{{ $message }}</div>@enderror
                        </div>
                        <div>
                            <label for="new_password" style="display: block; font-size: 0.8rem; font-weight: 700; color: #6b7280; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 6px;">Nueva Contraseña</label>
                            <input type="password" id="new_password" name="new_password" class="form-input">
                            @error('new_password')<div style="color:#ef4444;font-size:0.8rem;margin-top:4px;">{{ $message }}</div>@enderror
                        </div>
                        <div>
                            <label for="new_password_confirmation" style="display: block; font-size: 0.8rem; font-weight: 700; color: #6b7280; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 6px;">Confirmar Nueva</label>
                            <input type="password" id="new_password_confirmation" name="new_password_confirmation" class="form-input">
                        </div>
                    </div>
                </div>

            </div>

            <!-- Sidebar: Avatar + Acciones -->
            <div style="display: flex; flex-direction: column; gap: 20px;">

                <!-- Avatar -->
                <div style="background: white; border-radius: 16px; box-shadow: 0 2px 12px rgba(0,0,0,0.06); border: 1px solid #f0f0f0; overflow: hidden;">
                    <div style="padding: 18px 24px; border-bottom: 1px solid #f0f0f0;">
                        <h3 style="margin: 0; font-size: 1rem; font-weight: 700; color: #111827;">Foto de perfil</h3>
                    </div>
                    <div style="padding: 24px; text-align: center;">
                        <div id="avatar-preview" style="width: 100px; height: 100px; border-radius: 50%; overflow: hidden; margin: 0 auto 16px; border: 3px solid #f0f0f0; display: flex; align-items: center; justify-content: center; font-size: 2.5rem; color: #d1d5db; background: #f9fafb;">
                            @if($user->avatar)
                                <img id="preview-img" src="{{ Storage::url($user->avatar) }}" alt="Avatar" style="width:100%;height:100%;object-fit:cover;">
                            @else
                                <i class="fas fa-user" id="preview-icon"></i>
                            @endif
                        </div>
                        <input type="file" id="avatar" name="avatar" accept="image/*" style="display:none;" onchange="previewAvatar(this)">
                        <label for="avatar" class="avatar-upload-label">
                            <i class="fas fa-camera"></i> Cambiar foto
                        </label>
                        <div style="color: #9ca3af; font-size: 0.78rem; margin-top: 10px; line-height: 1.5;">JPEG, PNG, GIF<br>Máximo 2MB</div>
                        @error('avatar')<div style="color:#ef4444;font-size:0.8rem;margin-top:6px;">{{ $message }}</div>@enderror
                    </div>
                </div>

                <!-- Acciones -->
                <div style="background: white; border-radius: 16px; box-shadow: 0 2px 12px rgba(0,0,0,0.06); border: 1px solid #f0f0f0; padding: 20px; display: flex; flex-direction: column; gap: 10px;">
                    <button type="submit" style="width:100%; padding: 12px; border-radius: 10px; font-weight: 700; font-size: 0.9rem; display: flex; align-items: center; justify-content: center; gap: 8px; background: linear-gradient(135deg,#D93690,#8B5CF6); color: white; border: none; cursor: pointer;">
                        <i class="fas fa-save"></i> Guardar Cambios
                    </button>
                    <a href="{{ route('user.profile') }}" style="width:100%; padding: 12px; border-radius: 10px; font-weight: 600; font-size: 0.9rem; display: flex; align-items: center; justify-content: center; gap: 8px; border: 1px solid #e5e7eb; color: #6b7280; background: white; text-decoration: none; box-sizing: border-box;">
                        <i class="fas fa-times"></i> Cancelar
                    </a>
                </div>

            </div>
        </div>
    </form>
</div>

<script>
function previewAvatar(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            const preview = document.getElementById('avatar-preview');
            preview.innerHTML = `<img src="${e.target.result}" style="width:100%;height:100%;object-fit:cover;">`;
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection
