@extends('crm.layouts.clean_app')

@section('titulo', 'Editar Empresa')

@section('content')
<div class="container py-4">

    <!-- Breadcrumb -->
    <div style="margin-bottom: 20px; display: flex; align-items: center; gap: 8px; font-size: 0.85rem; color: #9ca3af;">
        <a href="{{ route('dashboard') }}" style="color: #9ca3af; text-decoration: none;">Dashboard</a>
        <i class="fas fa-chevron-right" style="font-size: 0.7rem;"></i>
        <a href="{{ route('empresa.index') }}" style="color: #9ca3af; text-decoration: none;">Empresa</a>
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

    <form method="POST" action="{{ route('empresa.update') }}">
        @csrf @method('PUT')

        <div style="display: grid; grid-template-columns: 1fr 280px; gap: 20px; align-items: start;">

            <!-- Columna principal -->
            <div style="display: flex; flex-direction: column; gap: 20px;">

                <!-- Información corporativa -->
                <div style="background: white; border-radius: 16px; box-shadow: 0 2px 12px rgba(0,0,0,0.06); border: 1px solid #f0f0f0; overflow: hidden;">
                    <div style="padding: 18px 24px; border-bottom: 1px solid #f0f0f0; display: flex; align-items: center; gap: 10px;">
                        <div style="width: 32px; height: 32px; border-radius: 8px; background: linear-gradient(135deg,#D93690,#8B5CF6); display: flex; align-items: center; justify-content: center; color: white; font-size: 0.85rem;">
                            <i class="fas fa-building"></i>
                        </div>
                        <h3 style="margin: 0; font-size: 1rem; font-weight: 700; color: #111827;">Información Corporativa</h3>
                    </div>
                    <div style="padding: 24px; display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                        <div>
                            <label style="display: block; font-size: 0.8rem; font-weight: 700; color: #6b7280; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 6px;">Nombre *</label>
                            <input type="text" name="nombre" class="form-input" value="{{ old('nombre', $empresa['nombre']) }}" required>
                            @error('nombre')<div style="color:#ef4444;font-size:0.8rem;margin-top:4px;">{{ $message }}</div>@enderror
                        </div>
                        <div>
                            <label style="display: block; font-size: 0.8rem; font-weight: 700; color: #6b7280; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 6px;">CIF *</label>
                            <input type="text" name="cif" class="form-input" value="{{ old('cif', $empresa['cif']) }}" required>
                            @error('cif')<div style="color:#ef4444;font-size:0.8rem;margin-top:4px;">{{ $message }}</div>@enderror
                        </div>
                        <div style="grid-column: span 2;">
                            <label style="display: block; font-size: 0.8rem; font-weight: 700; color: #6b7280; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 6px;">Sector *</label>
                            <input type="text" name="sector" class="form-input" value="{{ old('sector', $empresa['sector']) }}" required>
                            @error('sector')<div style="color:#ef4444;font-size:0.8rem;margin-top:4px;">{{ $message }}</div>@enderror
                        </div>
                        <div style="grid-column: span 2;">
                            <label style="display: block; font-size: 0.8rem; font-weight: 700; color: #6b7280; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 6px;">Descripción *</label>
                            <textarea name="descripcion" rows="4" class="form-input" style="resize: vertical;" required>{{ old('descripcion', $empresa['descripcion']) }}</textarea>
                            @error('descripcion')<div style="color:#ef4444;font-size:0.8rem;margin-top:4px;">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>

                <!-- Contacto -->
                <div style="background: white; border-radius: 16px; box-shadow: 0 2px 12px rgba(0,0,0,0.06); border: 1px solid #f0f0f0; overflow: hidden;">
                    <div style="padding: 18px 24px; border-bottom: 1px solid #f0f0f0; display: flex; align-items: center; gap: 10px;">
                        <div style="width: 32px; height: 32px; border-radius: 8px; background: #f3f4f6; display: flex; align-items: center; justify-content: center; color: #6b7280; font-size: 0.85rem;">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <h3 style="margin: 0; font-size: 1rem; font-weight: 700; color: #111827;">Contacto y Ubicación</h3>
                    </div>
                    <div style="padding: 24px; display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                        <div style="grid-column: span 2;">
                            <label style="display: block; font-size: 0.8rem; font-weight: 700; color: #6b7280; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 6px;">Dirección *</label>
                            <input type="text" name="direccion" class="form-input" value="{{ old('direccion', $empresa['direccion']) }}" required>
                            @error('direccion')<div style="color:#ef4444;font-size:0.8rem;margin-top:4px;">{{ $message }}</div>@enderror
                        </div>
                        <div>
                            <label style="display: block; font-size: 0.8rem; font-weight: 700; color: #6b7280; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 6px;">Ciudad *</label>
                            <input type="text" name="ciudad" class="form-input" value="{{ old('ciudad', $empresa['ciudad']) }}" required>
                            @error('ciudad')<div style="color:#ef4444;font-size:0.8rem;margin-top:4px;">{{ $message }}</div>@enderror
                        </div>
                        <div>
                            <label style="display: block; font-size: 0.8rem; font-weight: 700; color: #6b7280; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 6px;">Teléfono *</label>
                            <input type="text" name="telefono" class="form-input" value="{{ old('telefono', $empresa['telefono']) }}" required>
                            @error('telefono')<div style="color:#ef4444;font-size:0.8rem;margin-top:4px;">{{ $message }}</div>@enderror
                        </div>
                        <div style="grid-column: span 2;">
                            <label style="display: block; font-size: 0.8rem; font-weight: 700; color: #6b7280; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 6px;">Email *</label>
                            <input type="email" name="email" class="form-input" value="{{ old('email', $empresa['email']) }}" required>
                            @error('email')<div style="color:#ef4444;font-size:0.8rem;margin-top:4px;">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>

            </div>

            <!-- Sidebar: estadísticas + acciones -->
            <div style="display: flex; flex-direction: column; gap: 20px;">

                <!-- Nota stats automáticas -->
                <div style="background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 12px; padding: 16px;">
                    <div style="display: flex; align-items: center; gap: 8px; color: #16a34a; font-weight: 700; font-size: 0.85rem; margin-bottom: 8px;">
                        <i class="fas fa-chart-bar"></i> Estadísticas automáticas
                    </div>
                    <p style="margin: 0; color: #15803d; font-size: 0.8rem; line-height: 1.5;">Usuarios, alumnos, cursos y aulas se calculan en tiempo real desde la base de datos. No requieren edición manual.</p>
                </div>

                <!-- Acciones -->
                <div style="background: white; border-radius: 16px; box-shadow: 0 2px 12px rgba(0,0,0,0.06); border: 1px solid #f0f0f0; padding: 20px; display: flex; flex-direction: column; gap: 10px;">
                    <button type="submit" style="width:100%; padding: 12px; border-radius: 10px; font-weight: 700; font-size: 0.9rem; display: flex; align-items: center; justify-content: center; gap: 8px; background: linear-gradient(135deg,#D93690,#8B5CF6); color: white; border: none; cursor: pointer;">
                        <i class="fas fa-save"></i> Guardar Cambios
                    </button>
                    <a href="{{ route('empresa.index') }}" style="width:100%; padding: 12px; border-radius: 10px; font-weight: 600; font-size: 0.9rem; display: flex; align-items: center; justify-content: center; gap: 8px; border: 1px solid #e5e7eb; color: #6b7280; background: white; text-decoration: none; box-sizing: border-box;">
                        <i class="fas fa-times"></i> Cancelar
                    </a>
                </div>

            </div>
        </div>
    </form>
</div>

<style>
.form-input {
    width: 100%; padding: 11px 14px; border: 1px solid #e5e7eb; border-radius: 8px;
    font-size: 0.9rem; color: #111827; background: white; transition: border-color 0.2s;
    box-sizing: border-box;
}
.form-input:focus { outline: none; border-color: #8B5CF6; box-shadow: 0 0 0 3px rgba(139,92,246,0.1); }
</style>
@endsection
