@extends('webacademia.layouts.web_layout')

@section('title', 'Mi perfil')

@section('css')
<style>
/* Perfil moderno y profesional */
.perfil-hero {
    background: linear-gradient(135deg, #D93690 0%, #667eea 100%);
    padding: 80px 0 40px 0;
    color: white;
    position: relative;
    overflow: hidden;
}

.perfil-hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="50" cy="50" r="1" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
    opacity: 0.3;
}

.perfil-avatar {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    border: 5px solid rgba(255,255,255,0.3);
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    object-fit: cover;
    margin: 0 auto 20px auto;
    display: block;
}

.perfil-name {
    font-size: 32px;
    font-weight: 800;
    margin-bottom: 10px;
    text-shadow: 0 2px 10px rgba(0,0,0,0.2);
}

.perfil-email {
    font-size: 18px;
    opacity: 0.9;
    margin-bottom: 0;
}

.perfil-card {
    background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
    border-radius: 25px;
    padding: 40px;
    box-shadow: 0 15px 40px rgba(0,0,0,0.1);
    border: 1px solid #e2e8f0;
    margin-bottom: 30px;
    position: relative;
    overflow: hidden;
}

.perfil-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 6px;
    background: linear-gradient(135deg, #D93690 0%, #ff6b9d 50%, #667eea 100%);
}

.perfil-card h4 {
    color: #2d3748;
    font-weight: 800;
    font-size: 24px;
    margin-bottom: 30px;
    position: relative;
    padding-left: 20px;
}

.perfil-card h4::before {
    content: '';
    position: absolute;
    left: 0;
    top: 50%;
    transform: translateY(-50%);
    width: 4px;
    height: 24px;
    background: linear-gradient(135deg, #D93690 0%, #ff6b9d 100%);
    border-radius: 2px;
}

/* Formulario moderno */
.form-group {
    margin-bottom: 25px;
    position: relative;
}

.form-group label {
    font-weight: 700;
    color: #2d3748;
    margin-bottom: 8px;
    display: block;
    font-size: 14px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.form-control {
    border: 2px solid #e1e8ed;
    border-radius: 12px;
    padding: 16px 20px;
    font-size: 16px;
    font-weight: 500;
    transition: all 0.3s ease;
    background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
    box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    width: 100%;
}

.form-control:focus {
    border-color: #D93690;
    box-shadow: 0 0 0 3px rgba(217, 54, 144, 0.1), 0 8px 25px rgba(217, 54, 144, 0.15);
    background: white;
    transform: translateY(-2px);
}

.btn_one {
    background: linear-gradient(135deg, #D93690 0%, #ff6b9d 100%);
    color: white;
    border: none;
    padding: 16px 32px;
    border-radius: 25px;
    font-weight: 700;
    font-size: 16px;
    transition: all 0.3s ease;
    box-shadow: 0 8px 25px rgba(217, 54, 144, 0.3);
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.btn_one:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 30px rgba(217, 54, 144, 0.4);
    color: white;
}

/* Cursos comprados */
.curso-item {
    background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
    border-radius: 15px;
    padding: 25px;
    margin-bottom: 20px;
    border: 1px solid #e2e8f0;
    box-shadow: 0 8px 25px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.curso-item::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 4px;
    height: 100%;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.curso-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.15);
}

.curso-title {
    font-size: 20px;
    font-weight: 700;
    color: #2d3748;
    margin-bottom: 10px;
    line-height: 1.3;
}

.curso-description {
    color: #718096;
    font-size: 15px;
    line-height: 1.6;
    margin-bottom: 20px;
}

.curso-meta {
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 15px;
}

.curso-price {
    background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
    color: white;
    padding: 8px 16px;
    border-radius: 20px;
    font-weight: 600;
    font-size: 14px;
}

.curso-status {
    background: linear-gradient(135deg, #4299e1 0%, #3182ce 100%);
    color: white;
    padding: 8px 16px;
    border-radius: 20px;
    font-weight: 600;
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.btn-curso {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border: none;
    padding: 12px 24px;
    border-radius: 20px;
    font-weight: 600;
    font-size: 14px;
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

.btn-curso:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
    color: white;
    text-decoration: none;
}

.empty-state {
    text-align: center;
    padding: 60px 20px;
    color: #718096;
}

.empty-state-icon {
    font-size: 64px;
    margin-bottom: 20px;
    opacity: 0.5;
}

.empty-state h5 {
    font-size: 24px;
    font-weight: 700;
    margin-bottom: 15px;
    color: #2d3748;
}

.empty-state p {
    font-size: 16px;
    line-height: 1.6;
    max-width: 400px;
    margin: 0 auto;
}

/* Avatar upload */
.avatar-upload {
    position: relative;
    display: inline-block;
}

.avatar-preview {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid #e2e8f0;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

/* Alertas personalizadas */
.alert {
    border-radius: 15px;
    border: none;
    padding: 20px 25px;
    margin-bottom: 25px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    font-weight: 500;
}

.alert-success {
    background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
    color: white;
}

.alert-danger {
    background: linear-gradient(135deg, #e53e3e 0%, #c53030 100%);
    color: white;
}

.alert i {
    margin-right: 10px;
    font-size: 18px;
}

.alert ul {
    margin-left: 20px;
}

.btn-close {
    filter: brightness(0) invert(1);
    opacity: 0.8;
}

.btn-close:hover {
    opacity: 1;
}

/* Responsive */
@media (max-width: 768px) {
    .perfil-hero {
        padding: 60px 0 30px 0;
    }
    
    .perfil-name {
        font-size: 24px;
    }
    
    .perfil-card {
        padding: 25px 20px;
    }
    
    .curso-meta {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .alert {
        padding: 15px 20px;
        font-size: 14px;
    }
}
</style>
@endsection

@section('content')

<!-- HERO SECTION DEL PERFIL -->
<section class="perfil-hero">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                @if(auth('alumno')->user()->avatar)
                    <img src="{{ asset('storage/' . auth('alumno')->user()->avatar) }}" alt="Avatar" class="perfil-avatar">
                @else
                    <div class="perfil-avatar" style="background: rgba(255,255,255,0.2); display: flex; align-items: center; justify-content: center; font-size: 48px; color: white;">
                        👤
                    </div>
                @endif
                
                <h1 class="perfil-name">{{ auth('alumno')->user()->name }} {{ auth('alumno')->user()->surname }}</h1>
                <p class="perfil-email">{{ auth('alumno')->user()->email }}</p>
            </div>
        </div>
    </div>
</section>

<!-- CONTENIDO PRINCIPAL -->
<section class="section-padding" style="padding: 80px 0;">
    <div class="container">
        <div class="row">
            <!-- FORMULARIO DE PERFIL -->
            <div class="col-lg-6 mb-5">
                <div class="perfil-card">
                    <h4>✏️ Editar mis datos</h4>
                    
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-triangle"></i> {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-triangle"></i> <strong>Por favor, corrige los siguientes errores:</strong>
                            <ul class="mb-0 mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    
                    <form action="{{ route('webacademia.perfil.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>👤 Nombre</label>
                                    <input type="text" name="name" class="form-control" value="{{ old('name', auth('alumno')->user()->name) }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>👥 Apellidos</label>
                                    <input type="text" name="surname" class="form-control" value="{{ old('surname', auth('alumno')->user()->surname) }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>📧 Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email', auth('alumno')->user()->email) }}" required>
                        </div>

                        <div class="form-group">
                            <label>📱 Teléfono</label>
                            <input type="text" name="phone" class="form-control" value="{{ old('phone', auth('alumno')->user()->phone) }}" placeholder="Introduce tu número de teléfono">
                        </div>

                        <div class="form-group">
                            <label>🖼️ Avatar</label>
                            <input type="file" name="avatar" class="form-control" accept="image/*">
                            @if(auth('alumno')->user()->avatar)
                                <div class="mt-3">
                                    <img src="{{ asset('storage/' . auth('alumno')->user()->avatar) }}" alt="avatar" class="avatar-preview">
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn_one">
                                💾 Guardar cambios
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- CURSOS COMPRADOS -->
            <div class="col-lg-6">
                <div class="perfil-card">
                    <h4>🎓 Mis cursos comprados</h4>
                    
                    @php
                        $cursosComprados = auth('alumno')->user()->cursos()->with('category')->get();
                    @endphp
                    
                    @forelse($cursosComprados as $curso)
                        <div class="curso-item">
                            <div class="curso-title">{{ $curso->name ?? $curso->title }}</div>
                            
                            @if($curso->description)
                                <div class="curso-description">
                                    {{ Str::limit($curso->description, 120) }}
                                </div>
                            @endif
                            
                            <div class="curso-meta">
                                <div class="d-flex align-items-center gap-2">
                                    @if($curso->price)
                                        <span class="curso-price">💰 {{ number_format($curso->price, 2) }}€</span>
                                    @endif
                                    <span class="curso-status">✅ Activo</span>
                                </div>
                                
                                <a href="{{ route('webacademia.single_course', $curso->id) }}" class="btn-curso">
                                    📚 Ver curso
                                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="empty-state">
                            <div class="empty-state-icon">📚</div>
                            <h5>¡Aún no tienes cursos!</h5>
                            <p>Explora nuestro catálogo de cursos y comienza tu viaje de aprendizaje. Tenemos una gran variedad de cursos diseñados para impulsar tu carrera profesional.</p>
                            <a href="{{ route('webacademia.courses') }}" class="btn_one mt-3">
                                🔍 Explorar cursos
                            </a>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- ESTADÍSTICAS DEL USUARIO -->
        <div class="row mt-5">
            <div class="col-12">
                <div class="perfil-card">
                    <h4>📊 Mis estadísticas</h4>
                    <div class="row text-center">
                        <div class="col-md-3 mb-4">
                            <div style="background: linear-gradient(135deg, #4299e1 0%, #3182ce 100%); color: white; padding: 30px 20px; border-radius: 15px; box-shadow: 0 8px 25px rgba(66, 153, 225, 0.3);">
                                <div style="font-size: 36px; font-weight: 800; margin-bottom: 10px;">{{ $cursosComprados->count() }}</div>
                                <div style="font-size: 14px; opacity: 0.9; text-transform: uppercase; letter-spacing: 0.5px;">Cursos Comprados</div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-4">
                            <div style="background: linear-gradient(135deg, #48bb78 0%, #38a169 100%); color: white; padding: 30px 20px; border-radius: 15px; box-shadow: 0 8px 25px rgba(72, 187, 120, 0.3);">
                                <div style="font-size: 36px; font-weight: 800; margin-bottom: 10px;">{{ $cursosComprados->where('pivot.estado', 'activo')->count() }}</div>
                                <div style="font-size: 14px; opacity: 0.9; text-transform: uppercase; letter-spacing: 0.5;">Cursos Activos</div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-4">
                            <div style="background: linear-gradient(135deg, #D93690 0%, #ff6b9d 100%); color: white; padding: 30px 20px; border-radius: 15px; box-shadow: 0 8px 25px rgba(217, 54, 144, 0.3);">
                                <div style="font-size: 36px; font-weight: 800; margin-bottom: 10px;">{{ $cursosComprados->sum('lecciones') ?: '0' }}</div>
                                <div style="font-size: 14px; opacity: 0.9; text-transform: uppercase; letter-spacing: 0.5;">Lecciones Totales</div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-4">
                            <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 30px 20px; border-radius: 15px; box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);">
                                <div style="font-size: 36px; font-weight: 800; margin-bottom: 10px;">{{ auth('alumno')->user()->created_at->format('Y') }}</div>
                                <div style="font-size: 14px; opacity: 0.9; text-transform: uppercase; letter-spacing: 0.5;">Miembro desde</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
