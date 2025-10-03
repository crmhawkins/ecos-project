@extends('crm.layouts.clean_app')

@section('titulo', 'Editar Información de la Empresa')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div style="background: linear-gradient(135deg, #D93690 0%, #8B5CF6 100%); color: white; padding: 40px 0;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="mb-0">
                        <i class="fas fa-edit"></i>
                        Editar Información de la Empresa
                    </h1>
                    <p class="mb-0 mt-2" style="opacity: 0.9;">Actualiza la información corporativa de tu empresa</p>
                </div>
                <div class="col-md-4 text-end">
                    <a href="{{ route('empresa.index') }}" class="btn btn-light">
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
                    <i class="fas fa-building"></i> Información Corporativa
                </h3>
            </div>
            
            <form method="POST" action="{{ route('empresa.update') }}" style="padding: 24px;">
                @csrf
                @method('PUT')
                
                <!-- Información básica -->
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px; margin-bottom: 32px;">
                    <div style="display: flex; flex-direction: column; gap: 8px;">
                        <label for="nombre" style="font-weight: 600; color: #111827; font-size: 0.9rem;">Nombre de la Empresa *</label>
                        <input type="text" id="nombre" name="nombre" 
                               style="padding: 12px 16px; border: 1px solid #e5e7eb; border-radius: 8px; font-size: 0.9rem; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); background: white;"
                               value="{{ old('nombre', $empresa['nombre']) }}" required>
                        @error('nombre')
                            <div style="color: #ef4444; font-size: 0.8rem; margin-top: 4px;">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div style="display: flex; flex-direction: column; gap: 8px;">
                        <label for="cif" style="font-weight: 600; color: #111827; font-size: 0.9rem;">CIF *</label>
                        <input type="text" id="cif" name="cif" 
                               style="padding: 12px 16px; border: 1px solid #e5e7eb; border-radius: 8px; font-size: 0.9rem; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); background: white;"
                               value="{{ old('cif', $empresa['cif']) }}" required>
                        @error('cif')
                            <div style="color: #ef4444; font-size: 0.8rem; margin-top: 4px;">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div style="display: flex; flex-direction: column; gap: 8px;">
                        <label for="sector" style="font-weight: 600; color: #111827; font-size: 0.9rem;">Sector *</label>
                        <input type="text" id="sector" name="sector" 
                               style="padding: 12px 16px; border: 1px solid #e5e7eb; border-radius: 8px; font-size: 0.9rem; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); background: white;"
                               value="{{ old('sector', $empresa['sector']) }}" required>
                        @error('sector')
                            <div style="color: #ef4444; font-size: 0.8rem; margin-top: 4px;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Descripción -->
                <div style="margin-bottom: 32px;">
                    <label for="descripcion" style="font-weight: 600; color: #111827; font-size: 0.9rem; margin-bottom: 8px; display: block;">Descripción de la Empresa *</label>
                    <textarea id="descripcion" name="descripcion" rows="4" 
                              style="width: 100%; padding: 12px 16px; border: 1px solid #e5e7eb; border-radius: 8px; font-size: 0.9rem; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); background: white; resize: vertical;"
                              required>{{ old('descripcion', $empresa['descripcion']) }}</textarea>
                    @error('descripcion')
                        <div style="color: #ef4444; font-size: 0.8rem; margin-top: 4px;">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Información de contacto -->
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px; margin-bottom: 32px;">
                    <div style="display: flex; flex-direction: column; gap: 8px;">
                        <label for="direccion" style="font-weight: 600; color: #111827; font-size: 0.9rem;">Dirección *</label>
                        <input type="text" id="direccion" name="direccion" 
                               style="padding: 12px 16px; border: 1px solid #e5e7eb; border-radius: 8px; font-size: 0.9rem; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); background: white;"
                               value="{{ old('direccion', $empresa['direccion']) }}" required>
                        @error('direccion')
                            <div style="color: #ef4444; font-size: 0.8rem; margin-top: 4px;">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div style="display: flex; flex-direction: column; gap: 8px;">
                        <label for="ciudad" style="font-weight: 600; color: #111827; font-size: 0.9rem;">Ciudad *</label>
                        <input type="text" id="ciudad" name="ciudad" 
                               style="padding: 12px 16px; border: 1px solid #e5e7eb; border-radius: 8px; font-size: 0.9rem; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); background: white;"
                               value="{{ old('ciudad', $empresa['ciudad']) }}" required>
                        @error('ciudad')
                            <div style="color: #ef4444; font-size: 0.8rem; margin-top: 4px;">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div style="display: flex; flex-direction: column; gap: 8px;">
                        <label for="telefono" style="font-weight: 600; color: #111827; font-size: 0.9rem;">Teléfono *</label>
                        <input type="text" id="telefono" name="telefono" 
                               style="padding: 12px 16px; border: 1px solid #e5e7eb; border-radius: 8px; font-size: 0.9rem; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); background: white;"
                               value="{{ old('telefono', $empresa['telefono']) }}" required>
                        @error('telefono')
                            <div style="color: #ef4444; font-size: 0.8rem; margin-top: 4px;">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div style="display: flex; flex-direction: column; gap: 8px;">
                        <label for="email" style="font-weight: 600; color: #111827; font-size: 0.9rem;">Email *</label>
                        <input type="email" id="email" name="email" 
                               style="padding: 12px 16px; border: 1px solid #e5e7eb; border-radius: 8px; font-size: 0.9rem; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); background: white;"
                               value="{{ old('email', $empresa['email']) }}" required>
                        @error('email')
                            <div style="color: #ef4444; font-size: 0.8rem; margin-top: 4px;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Estadísticas -->
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 32px;">
                    <div style="display: flex; flex-direction: column; gap: 8px;">
                        <label for="empleados" style="font-weight: 600; color: #111827; font-size: 0.9rem;">Empleados</label>
                        <input type="number" id="empleados" name="empleados" min="0" 
                               style="padding: 12px 16px; border: 1px solid #e5e7eb; border-radius: 8px; font-size: 0.9rem; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); background: white;"
                               value="{{ old('empleados', $empresa['empleados']) }}">
                        @error('empleados')
                            <div style="color: #ef4444; font-size: 0.8rem; margin-top: 4px;">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div style="display: flex; flex-direction: column; gap: 8px;">
                        <label for="estudiantes" style="font-weight: 600; color: #111827; font-size: 0.9rem;">Estudiantes</label>
                        <input type="number" id="estudiantes" name="estudiantes" min="0" 
                               style="padding: 12px 16px; border: 1px solid #e5e7eb; border-radius: 8px; font-size: 0.9rem; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); background: white;"
                               value="{{ old('estudiantes', $empresa['estudiantes']) }}">
                        @error('estudiantes')
                            <div style="color: #ef4444; font-size: 0.8rem; margin-top: 4px;">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div style="display: flex; flex-direction: column; gap: 8px;">
                        <label for="cursos_activos" style="font-weight: 600; color: #111827; font-size: 0.9rem;">Cursos Activos</label>
                        <input type="number" id="cursos_activos" name="cursos_activos" min="0" 
                               style="padding: 12px 16px; border: 1px solid #e5e7eb; border-radius: 8px; font-size: 0.9rem; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); background: white;"
                               value="{{ old('cursos_activos', $empresa['cursos_activos']) }}">
                        @error('cursos_activos')
                            <div style="color: #ef4444; font-size: 0.8rem; margin-top: 4px;">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div style="display: flex; flex-direction: column; gap: 8px;">
                        <label for="aulas_disponibles" style="font-weight: 600; color: #111827; font-size: 0.9rem;">Aulas Disponibles</label>
                        <input type="number" id="aulas_disponibles" name="aulas_disponibles" min="0" 
                               style="padding: 12px 16px; border: 1px solid #e5e7eb; border-radius: 8px; font-size: 0.9rem; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); background: white;"
                               value="{{ old('aulas_disponibles', $empresa['aulas_disponibles']) }}">
                        @error('aulas_disponibles')
                            <div style="color: #ef4444; font-size: 0.8rem; margin-top: 4px;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Botones de acción -->
                <div style="display: flex; gap: 12px; justify-content: flex-end; padding: 20px 0; border-top: 1px solid #e5e7eb;">
                    <a href="{{ route('empresa.index') }}" style="padding: 12px 24px; border-radius: 8px; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); border: none; cursor: pointer; font-size: 0.9rem; background: #6b7280; color: white;">
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