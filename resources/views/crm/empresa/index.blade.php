@extends('crm.layouts.clean_app')

@section('titulo', 'Empresa')

@section('content')
<div class="container py-4">

    @if(session('success'))
        <div style="background: rgba(16,185,129,0.1); color: #10b981; border: 1px solid rgba(16,185,129,0.2); padding: 14px 20px; border-radius: 10px; margin-bottom: 24px; display: flex; align-items: center; gap: 10px;">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    <!-- Hero -->
    <div style="background: white; border-radius: 20px; box-shadow: 0 8px 32px rgba(0,0,0,0.08); border: 1px solid #f0f0f0; overflow: hidden; margin-bottom: 20px;">
        <div style="background: linear-gradient(135deg, #D93690 0%, #8B5CF6 100%); padding: 40px 32px; display: flex; align-items: center; gap: 28px; position: relative;">
            <div style="width: 88px; height: 88px; border-radius: 50%; background: rgba(255,255,255,0.2); border: 3px solid rgba(255,255,255,0.5); display: flex; align-items: center; justify-content: center; font-size: 2.2rem; color: white; flex-shrink: 0;">
                <i class="fas fa-building"></i>
            </div>
            <div style="flex: 1;">
                <h2 style="color: white; font-size: 1.6rem; font-weight: 700; margin: 0 0 4px;">{{ $empresa['nombre'] }}</h2>
                <p style="color: rgba(255,255,255,0.85); margin: 0; font-size: 0.95rem;">{{ $empresa['descripcion'] }}</p>
            </div>
            <a href="{{ route('empresa.edit') }}" style="position: absolute; top: 20px; right: 24px; background: rgba(255,255,255,0.15); color: white; border: 1px solid rgba(255,255,255,0.4); padding: 8px 18px; border-radius: 8px; font-size: 0.85rem; font-weight: 600; text-decoration: none; display: flex; align-items: center; gap: 6px;">
                <i class="fas fa-edit"></i> Editar
            </a>
        </div>

        <!-- Info -->
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0; border-bottom: 1px solid #f0f0f0;">
            <div style="padding: 28px 32px; border-right: 1px solid #f0f0f0;">
                <h3 style="font-size: 0.8rem; font-weight: 700; color: #9ca3af; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 20px;">
                    <i class="fas fa-info-circle" style="color: #D93690; margin-right: 6px;"></i> Información Corporativa
                </h3>
                @foreach([
                    ['Nombre',  $empresa['nombre']],
                    ['CIF',     $empresa['cif']],
                    ['Sector',  $empresa['sector']],
                ] as [$label, $value])
                <div style="display: flex; justify-content: space-between; align-items: center; padding: 10px 0; border-bottom: 1px solid #f9fafb;">
                    <span style="color: #9ca3af; font-size: 0.85rem; font-weight: 500;">{{ $label }}</span>
                    <span style="color: #111827; font-size: 0.9rem; font-weight: 600;">{{ $value ?: '—' }}</span>
                </div>
                @endforeach
            </div>
            <div style="padding: 28px 32px;">
                <h3 style="font-size: 0.8rem; font-weight: 700; color: #9ca3af; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 20px;">
                    <i class="fas fa-map-marker-alt" style="color: #8B5CF6; margin-right: 6px;"></i> Contacto
                </h3>
                @foreach([
                    ['Dirección', $empresa['direccion']],
                    ['Ciudad',    $empresa['ciudad']],
                    ['Teléfono',  $empresa['telefono']],
                    ['Email',     $empresa['email']],
                ] as [$label, $value])
                <div style="display: flex; justify-content: space-between; align-items: center; padding: 10px 0; border-bottom: 1px solid #f9fafb;">
                    <span style="color: #9ca3af; font-size: 0.85rem; font-weight: 500;">{{ $label }}</span>
                    <span style="color: #111827; font-size: 0.9rem; font-weight: 600;">{{ $value ?: '—' }}</span>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Stats automáticas -->
        <div style="display: grid; grid-template-columns: repeat(4, 1fr);">
            @foreach([
                ['fas fa-users',          '#D93690', $stats['empleados'],         'Usuarios CRM'],
                ['fas fa-user-graduate',  '#10b981', $stats['estudiantes'],        'Alumnos'],
                ['fas fa-graduation-cap', '#3b82f6', $stats['cursos_activos'],     'Cursos Activos'],
                ['fas fa-chalkboard',     '#f59e0b', $stats['aulas_disponibles'],  'Aulas'],
            ] as [$icon, $color, $val, $label])
            <div style="padding: 24px 20px; text-align: center; border-right: 1px solid #f0f0f0;">
                <div style="width: 44px; height: 44px; border-radius: 12px; background: {{ $color }}18; display: flex; align-items: center; justify-content: center; margin: 0 auto 10px; color: {{ $color }}; font-size: 1.1rem;">
                    <i class="{{ $icon }}"></i>
                </div>
                <div style="font-size: 1.6rem; font-weight: 700; color: #111827; line-height: 1;">{{ number_format($val) }}</div>
                <div style="color: #9ca3af; font-size: 0.8rem; margin-top: 4px;">{{ $label }}</div>
            </div>
            @endforeach
        </div>

        <!-- Acciones -->
        <div style="padding: 20px 32px; display: flex; gap: 10px; justify-content: flex-end;">
            <a href="{{ route('dashboard') }}" style="padding: 10px 20px; border-radius: 8px; font-weight: 600; font-size: 0.85rem; text-decoration: none; display: inline-flex; align-items: center; gap: 6px; border: 1px solid #e5e7eb; color: #6b7280; background: white;">
                <i class="fas fa-arrow-left"></i> Dashboard
            </a>
            <a href="{{ route('empresa.edit') }}" style="padding: 10px 20px; border-radius: 8px; font-weight: 600; font-size: 0.85rem; text-decoration: none; display: inline-flex; align-items: center; gap: 6px; background: linear-gradient(135deg, #D93690, #8B5CF6); color: white;">
                <i class="fas fa-edit"></i> Editar Información
            </a>
        </div>
    </div>

</div>
@endsection
