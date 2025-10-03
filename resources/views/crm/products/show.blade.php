@extends('crm.layouts.clean_app')

@section('titulo', 'Detalles del Producto')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div style="background: linear-gradient(135deg, #D93690 0%, #8B5CF6 100%); color: white; padding: 40px 0;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="mb-0">
                        <i class="fas fa-box"></i>
                        {{ $producto->name }}
                    </h1>
                    <p class="mb-0 mt-2" style="opacity: 0.9;">Detalles del producto</p>
                </div>
                <div class="col-md-4 text-end">
                    <a href="{{ route('productos.index') }}" class="btn btn-light me-2">
                        <i class="fas fa-arrow-left"></i>
                        Volver a Productos
                    </a>
                    <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-light">
                        <i class="fas fa-edit"></i>
                        Editar Producto
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

        <!-- Información del producto -->
        <div style="background: white; border-radius: 16px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); border: 1px solid #e5e7eb; overflow: hidden; margin-bottom: 24px;">
            <!-- Header del producto -->
            <div style="background: linear-gradient(135deg, #D93690 0%, #8B5CF6 100%); color: white; padding: 40px; text-align: center;">
                <div style="width: 120px; height: 120px; background: rgba(255, 255, 255, 0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; font-size: 3rem; overflow: hidden;">
                    @if($producto->image)
                        <img src="{{ $producto->image }}" alt="{{ $producto->name }}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">
                    @else
                        <i class="fas fa-box"></i>
                    @endif
                </div>
                <h2 style="font-size: 2rem; font-weight: 700; margin-bottom: 8px;">{{ $producto->name }}</h2>
                <p style="font-size: 1.1rem; opacity: 0.9; margin-bottom: 0;">
                    @if($producto->inactive)
                        <span style="background: rgba(239, 68, 68, 0.2); padding: 4px 12px; border-radius: 20px; font-size: 0.9rem;">
                            <i class="fas fa-times-circle"></i> Inactivo
                        </span>
                    @else
                        <span style="background: rgba(16, 185, 129, 0.2); padding: 4px 12px; border-radius: 20px; font-size: 0.9rem;">
                            <i class="fas fa-check-circle"></i> Activo
                        </span>
                    @endif
                </p>
            </div>
            
            <!-- Información detallada -->
            <div style="padding: 30px;">
                <div class="row">
                    <div class="col-md-8">
                        <h3 style="font-size: 1.3rem; font-weight: 600; color: #111827; margin-bottom: 20px; display: flex; align-items: center; gap: 8px;">
                            <i class="fas fa-info-circle"></i> Información del Producto
                        </h3>
                        
                        <div style="display: grid; gap: 16px;">
                            <div style="display: flex; justify-content: space-between; align-items: center; padding: 12px 0; border-bottom: 1px solid #f3f4f6;">
                                <span style="font-weight: 600; color: #6b7280; font-size: 0.9rem;">Nombre</span>
                                <span style="color: #111827; font-weight: 500;">{{ $producto->name }}</span>
                            </div>
                            
                            <div style="display: flex; justify-content: space-between; align-items: center; padding: 12px 0; border-bottom: 1px solid #f3f4f6;">
                                <span style="font-weight: 600; color: #6b7280; font-size: 0.9rem;">Precio</span>
                                <span style="color: #111827; font-weight: 500;">€{{ number_format($producto->price, 2) }}</span>
                            </div>
                            
                            <div style="display: flex; justify-content: space-between; align-items: center; padding: 12px 0; border-bottom: 1px solid #f3f4f6;">
                                <span style="font-weight: 600; color: #6b7280; font-size: 0.9rem;">Estado</span>
                                <span style="color: #111827; font-weight: 500;">
                                    @if($producto->inactive)
                                        <span style="color: #ef4444;">
                                            <i class="fas fa-times-circle"></i> Inactivo
                                        </span>
                                    @else
                                        <span style="color: #10b981;">
                                            <i class="fas fa-check-circle"></i> Activo
                                        </span>
                                    @endif
                                </span>
                            </div>
                            
                            <div style="display: flex; justify-content: space-between; align-items: center; padding: 12px 0; border-bottom: 1px solid #f3f4f6;">
                                <span style="font-weight: 600; color: #6b7280; font-size: 0.9rem;">Categoría</span>
                                <span style="color: #111827; font-weight: 500;">{{ $producto->category->name ?? 'Sin categoría' }}</span>
                            </div>
                            
                            <div style="display: flex; justify-content: space-between; align-items: center; padding: 12px 0; border-bottom: 1px solid #f3f4f6;">
                                <span style="font-weight: 600; color: #6b7280; font-size: 0.9rem;">Creado</span>
                                <span style="color: #111827; font-weight: 500;">{{ $producto->created_at ? $producto->created_at->format('d/m/Y H:i') : 'No disponible' }}</span>
                            </div>
                            
                            <div style="display: flex; justify-content: space-between; align-items: center; padding: 12px 0;">
                                <span style="font-weight: 600; color: #6b7280; font-size: 0.9rem;">Última Actualización</span>
                                <span style="color: #111827; font-weight: 500;">{{ $producto->updated_at ? $producto->updated_at->format('d/m/Y H:i') : 'No disponible' }}</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div style="background: #f8fafc; border-radius: 12px; padding: 20px; border: 1px solid #e5e7eb;">
                            <h4 style="font-size: 1.1rem; font-weight: 600; color: #111827; margin-bottom: 16px; display: flex; align-items: center; gap: 8px;">
                                <i class="fas fa-chart-bar"></i> Estadísticas
                            </h4>
                            
                            <div style="display: grid; gap: 12px;">
                                <div style="text-align: center; padding: 16px; background: white; border-radius: 8px; border: 1px solid #e5e7eb;">
                                    <div style="font-size: 2rem; font-weight: 700; color: #D93690; margin-bottom: 4px;">
                                        €{{ number_format($producto->price, 2) }}
                                    </div>
                                    <div style="font-size: 0.9rem; color: #6b7280; font-weight: 500;">Precio del Producto</div>
                                </div>
                                
                                <div style="text-align: center; padding: 16px; background: white; border-radius: 8px; border: 1px solid #e5e7eb;">
                                    <div style="font-size: 2rem; font-weight: 700; color: #10b981; margin-bottom: 4px;">
                                        {{ $producto->inactive ? 'No' : 'Sí' }}
                                    </div>
                                    <div style="font-size: 0.9rem; color: #6b7280; font-weight: 500;">Disponible</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
