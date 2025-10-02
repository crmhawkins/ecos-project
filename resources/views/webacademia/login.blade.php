@extends('webacademia.layouts.web_layout')

@section('title', 'Login')

@section('css')
<style>
/* Estilo moderno para el formulario de login */
.login-hero {
    background: linear-gradient(135deg, #D93690 0%, #667eea 100%);
    padding: 80px 0 40px 0;
    color: white;
    position: relative;
    overflow: hidden;
}

.login-hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="50" cy="50" r="1" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
    opacity: 0.3;
}

.login-hero h1 {
    font-size: 48px;
    font-weight: 800;
    margin-bottom: 15px;
    text-shadow: 0 2px 10px rgba(0,0,0,0.2);
    color: white !important;
}

.login-hero p {
    font-size: 18px;
    opacity: 0.9;
    margin-bottom: 0;
}

.login-card {
    background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
    border-radius: 25px;
    padding: 50px;
    box-shadow: 0 20px 60px rgba(0,0,0,0.1);
    border: 1px solid #e2e8f0;
    position: relative;
    overflow: hidden;
    margin-top: -50px;
    z-index: 10;
}

.login-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 6px;
    background: linear-gradient(135deg, #D93690 0%, #ff6b9d 50%, #667eea 100%);
}

.login-card h4 {
    color: #2d3748;
    font-weight: 800;
    font-size: 28px;
    margin-bottom: 30px;
    text-align: center;
    position: relative;
}

.login-card h4::after {
    content: '';
    position: absolute;
    bottom: -10px;
    left: 50%;
    transform: translateX(-50%);
    width: 60px;
    height: 3px;
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
    margin-bottom: 12px;
    display: block;
    font-size: 15px;
    text-transform: uppercase;
    letter-spacing: 1px;
    position: relative;
    padding-left: 15px;
}

.form-group label::before {
    content: '';
    position: absolute;
    left: 0;
    top: 50%;
    transform: translateY(-50%);
    width: 4px;
    height: 20px;
    background: linear-gradient(135deg, #D93690 0%, #ff6b9d 100%);
    border-radius: 2px;
}

.form-control {
    border: 2px solid #e1e8ed !important;
    border-radius: 15px !important;
    padding: 18px 24px !important;
    font-size: 16px !important;
    font-weight: 500 !important;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1) !important;
    background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%) !important;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08) !important;
    width: 100% !important;
    outline: none !important;
    color: #2d3748 !important;
}

.form-control:focus {
    border-color: #D93690 !important;
    box-shadow: 0 0 0 3px rgba(217, 54, 144, 0.1), 0 8px 25px rgba(217, 54, 144, 0.15) !important;
    background: white !important;
    transform: translateY(-2px) !important;
}

.form-control:hover {
    border-color: #ff6b9d !important;
    transform: translateY(-1px) !important;
}

.form-control.is-invalid {
    border-color: #e53e3e !important;
    box-shadow: 0 0 0 3px rgba(229, 62, 62, 0.1) !important;
}

.btn_one {
    background: linear-gradient(135deg, #D93690 0%, #ff6b9d 100%) !important;
    color: white !important;
    border: none !important;
    padding: 18px 40px !important;
    border-radius: 25px !important;
    font-weight: 700 !important;
    font-size: 16px !important;
    transition: all 0.3s ease !important;
    box-shadow: 0 8px 25px rgba(217, 54, 144, 0.3) !important;
    text-transform: uppercase !important;
    letter-spacing: 1px !important;
    width: 100% !important;
    margin-top: 10px !important;
}

.btn_one:hover {
    transform: translateY(-3px) !important;
    box-shadow: 0 12px 30px rgba(217, 54, 144, 0.4) !important;
    color: white !important;
    background: linear-gradient(135deg, #ff6b9d 0%, #D93690 100%) !important;
}

/* Checkbox personalizado */
.form-check {
    display: flex;
    align-items: center;
    margin-bottom: 25px;
    padding-left: 0;
}

.form-check-input {
    width: 20px;
    height: 20px;
    margin-right: 12px;
    border: 2px solid #D93690;
    border-radius: 4px;
    background: white;
    cursor: pointer;
}

.form-check-input:checked {
    background: linear-gradient(135deg, #D93690 0%, #ff6b9d 100%);
    border-color: #D93690;
}

.form-check-label {
    color: #2d3748;
    font-weight: 500;
    cursor: pointer;
    margin-bottom: 0;
    font-size: 14px;
}

/* Alertas personalizadas */
.alert {
    border-radius: 15px;
    border: none;
    padding: 15px 20px;
    margin-bottom: 20px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    font-weight: 500;
}

.alert-danger {
    background: linear-gradient(135deg, #e53e3e 0%, #c53030 100%);
    color: white;
}

.alert-success {
    background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
    color: white;
}

.alert i {
    margin-right: 10px;
    font-size: 16px;
}

.alert ul {
    margin: 0;
    padding-left: 20px;
}

.alert li {
    margin-bottom: 5px;
}

.alert li:last-child {
    margin-bottom: 0;
}

/* Enlaces */
.login-link {
    text-align: center;
    margin-top: 30px;
    padding-top: 20px;
    border-top: 1px solid #e2e8f0;
}

.login-link p {
    color: #718096;
    font-size: 16px;
    margin-bottom: 0;
}

.login-link a {
    color: #D93690;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
}

.login-link a:hover {
    color: #ff6b9d;
    text-decoration: underline;
}

/* Responsive */
@media (max-width: 768px) {
    .login-hero {
        padding: 60px 0 30px 0;
    }
    
    .login-hero h1 {
        font-size: 32px;
    }
    
    .login-card {
        padding: 30px 20px;
        margin-top: -30px;
    }
    
    .login-card h4 {
        font-size: 24px;
    }
    
    .form-control {
        padding: 15px 20px !important;
        font-size: 15px !important;
    }
    
    .btn_one {
        padding: 15px 30px !important;
        font-size: 15px !important;
    }
}

/* Animaciones */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.login-card {
    animation: fadeInUp 0.6s ease-out;
}

.form-group {
    animation: fadeInUp 0.6s ease-out;
    animation-fill-mode: both;
}

.form-group:nth-child(1) { animation-delay: 0.1s; }
.form-group:nth-child(2) { animation-delay: 0.2s; }
.form-group:nth-child(3) { animation-delay: 0.3s; }
.form-group:nth-child(4) { animation-delay: 0.4s; }
</style>
@endsection

@section('content')

<!-- HERO SECTION DEL LOGIN -->
<section class="login-hero">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h1>¡Bienvenido de Nuevo!</h1>
                <p>Accede a tu cuenta y continúa tu formación profesional</p>
            </div>
        </div>
    </div>
</section>

<!-- FORMULARIO DE LOGIN -->
<section style="padding: 80px 0; background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <div class="login-card">
                    <h4>Iniciar Sesión</h4>
                    
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

                    <form method="POST" action="{{ route('webacademia.login') }}" id="loginForm">
                        @csrf
                        
                        <div class="form-group">
                            <label for="email">
                                <i class="fas fa-envelope"></i> Correo Electrónico
                            </label>
                            <input type="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   name="email" 
                                   id="email"
                                   value="{{ old('email') }}" 
                                   required
                                   placeholder="tu@email.com"
                                   autocomplete="email">
                            @error('email')
                                <div class="alert alert-danger mt-2">
                                    <i class="fas fa-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">
                                <i class="fas fa-lock"></i> Contraseña
                            </label>
                            <input type="password" 
                                   class="form-control @error('password') is-invalid @enderror" 
                                   name="password" 
                                   id="password"
                                   required
                                   placeholder="Tu contraseña"
                                   autocomplete="current-password">
                            @error('password')
                                <div class="alert alert-danger mt-2">
                                    <i class="fas fa-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="remember" id="remember">
                            <label class="form-check-label" for="remember">
                                <i class="fas fa-heart"></i> Recordarme
                            </label>
                        </div>

                        <div class="form-group">
                            <button class="btn_one" type="submit" id="submitBtn">
                                <i class="fas fa-sign-in-alt"></i> Iniciar Sesión
                            </button>
                        </div>
                    </form>

                    <div class="login-link">
                        <p>¿No tienes cuenta? <a href="/webregister">Regístrate aquí</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('loginForm');
    const submitBtn = document.getElementById('submitBtn');
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');
    
    // Validación del formulario antes del envío
    form.addEventListener('submit', function(e) {
        let isValid = true;
        
        // Validar email
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailInput.value.trim()) {
            emailInput.classList.add('is-invalid');
            isValid = false;
        } else if (!emailRegex.test(emailInput.value)) {
            emailInput.classList.add('is-invalid');
            isValid = false;
        } else {
            emailInput.classList.remove('is-invalid');
        }
        
        // Validar contraseña
        if (!passwordInput.value.trim()) {
            passwordInput.classList.add('is-invalid');
            isValid = false;
        } else {
            passwordInput.classList.remove('is-invalid');
        }
        
        if (!isValid) {
            e.preventDefault();
            showAlert('Por favor, completa todos los campos correctamente.', 'danger');
            return false;
        }
        
        // Mostrar loading en el botón
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Iniciando sesión...';
        submitBtn.disabled = true;
    });
    
    // Limpiar errores al escribir
    const inputs = form.querySelectorAll('input');
    inputs.forEach(input => {
        input.addEventListener('input', function() {
            if (this.classList.contains('is-invalid') && this.value.trim()) {
                this.classList.remove('is-invalid');
            }
        });
    });
    
    // Función para mostrar alertas temporales
    function showAlert(message, type) {
        // Crear alerta temporal
        const alertDiv = document.createElement('div');
        alertDiv.className = `alert alert-${type} alert-dismissible fade show`;
        alertDiv.innerHTML = `
            <i class="fas fa-exclamation-triangle"></i> ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;
        
        // Insertar antes del formulario
        const form = document.getElementById('loginForm');
        form.parentNode.insertBefore(alertDiv, form);
        
        // Auto-remover después de 5 segundos
        setTimeout(() => {
            if (alertDiv.parentNode) {
                alertDiv.remove();
            }
        }, 5000);
    }
    
    // Animación de entrada para los campos
    const formGroups = document.querySelectorAll('.form-group');
    formGroups.forEach((group, index) => {
        group.style.animationDelay = `${0.1 + (index * 0.1)}s`;
    });
});
</script>
@endsection
