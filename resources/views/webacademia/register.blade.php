@extends('webacademia.layouts.web_layout')

@section('title', 'Registro')

@section('css')
<style>
/* Estilo moderno para el formulario de registro */
.register-hero {
    background: linear-gradient(135deg, #D93690 0%, #667eea 100%);
    padding: 80px 0 40px 0;
    color: white;
    position: relative;
    overflow: hidden;
}

.register-hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="50" cy="50" r="1" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
    opacity: 0.3;
}

.register-hero h1 {
    font-size: 48px;
    font-weight: 800;
    margin-bottom: 15px;
    text-shadow: 0 2px 10px rgba(0,0,0,0.2);
    color: white !important;
}

.register-hero p {
    font-size: 18px;
    opacity: 0.9;
    margin-bottom: 0;
}

.register-card {
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

.register-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 6px;
    background: linear-gradient(135deg, #D93690 0%, #ff6b9d 50%, #667eea 100%);
}

.register-card h4 {
    color: #2d3748;
    font-weight: 800;
    font-size: 28px;
    margin-bottom: 30px;
    text-align: center;
    position: relative;
}

.register-card h4::after {
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
.register-link {
    text-align: center;
    margin-top: 30px;
    padding-top: 20px;
    border-top: 1px solid #e2e8f0;
}

.register-link p {
    color: #718096;
    font-size: 16px;
    margin-bottom: 0;
}

.register-link a {
    color: #D93690;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
}

.register-link a:hover {
    color: #ff6b9d;
    text-decoration: underline;
}

/* Indicadores de fortaleza de contraseña */
.password-strength {
    margin-top: 10px;
}

.password-strength-bar {
    height: 4px;
    background: #e2e8f0;
    border-radius: 2px;
    overflow: hidden;
    margin-bottom: 8px;
}

.password-strength-fill {
    height: 100%;
    transition: all 0.3s ease;
    border-radius: 2px;
}

.password-strength-text {
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.strength-weak .password-strength-fill {
    width: 33%;
    background: linear-gradient(135deg, #e53e3e 0%, #c53030 100%);
}

.strength-weak .password-strength-text {
    color: #e53e3e;
}

.strength-medium .password-strength-fill {
    width: 66%;
    background: linear-gradient(135deg, #ed8936 0%, #dd6b20 100%);
}

.strength-medium .password-strength-text {
    color: #ed8936;
}

.strength-strong .password-strength-fill {
    width: 100%;
    background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
}

.strength-strong .password-strength-text {
    color: #48bb78;
}

/* Responsive */
@media (max-width: 768px) {
    .register-hero {
        padding: 60px 0 30px 0;
    }
    
    .register-hero h1 {
        font-size: 32px;
    }
    
    .register-card {
        padding: 30px 20px;
        margin-top: -30px;
    }
    
    .register-card h4 {
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

/* Estilos para checkboxes */
.checkbox-container {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    margin-bottom: 20px;
    width: 100%;
}

.form-check-input {
    width: 20px !important;
    height: 20px !important;
    margin: 0 !important;
    margin-top: 2px !important;
    border: 2px solid #D93690 !important;
    border-radius: 4px !important;
    background: white !important;
    cursor: pointer !important;
    transition: all 0.3s ease !important;
    flex-shrink: 0 !important;
}

.form-check-input:checked {
    background: #D93690 !important;
    border-color: #D93690 !important;
}

.form-check-input:focus {
    box-shadow: 0 0 0 3px rgba(217, 54, 144, 0.2) !important;
    outline: none !important;
}

.form-check-label {
    font-size: 14px !important;
    line-height: 1.5 !important;
    color: #4a5568 !important;
    cursor: pointer !important;
    display: flex !important;
    align-items: flex-start !important;
    gap: 8px !important;
    flex: 1 !important;
    margin: 0 !important;
}

.privacy-link {
    color: #D93690;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
}

.privacy-link:hover {
    color: #8B5CF6;
    text-decoration: underline;
}

.required {
    color: #e53e3e;
    font-weight: bold;
}

/* Modal de política de privacidad */
.modal-content {
    border-radius: 15px;
    border: none;
    box-shadow: 0 20px 60px rgba(0,0,0,0.2);
}

.modal-header {
    background: linear-gradient(135deg, #D93690 0%, #8B5CF6 100%);
    color: white;
    border-radius: 15px 15px 0 0;
    border: none;
    padding: 20px 30px;
}

.modal-title {
    font-weight: 700;
    font-size: 1.3rem;
}

.modal-body {
    padding: 30px;
    max-height: 400px;
    overflow-y: auto;
}

.modal-footer {
    border: none;
    padding: 20px 30px;
    background: #f8fafc;
    border-radius: 0 0 15px 15px;
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

.register-card {
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
.form-group:nth-child(5) { animation-delay: 0.5s; }
.form-group:nth-child(6) { animation-delay: 0.6s; }
</style>
@endsection

@section('content')

<!-- HERO SECTION DEL REGISTRO -->
<section class="register-hero">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h1>¡Únete a Nosotros!</h1>
                <p>Crea tu cuenta y accede a nuestros cursos de formación profesional</p>
            </div>
        </div>
    </div>
</section>

<!-- FORMULARIO DE REGISTRO -->
<section style="padding: 80px 0; background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="register-card">
                    <h4>Crear Nueva Cuenta</h4>
                    
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

                    <form method="POST" action="{{ route('webacademia.register') }}" id="registerForm">
                        @csrf
                        
                        <div class="form-group">
                            <label for="username">
                                <i class="fas fa-user"></i> Usuario
                            </label>
                            <input type="text" 
                                   class="form-control @error('username') is-invalid @enderror" 
                                   name="username" 
                                   id="username"
                                   value="{{ old('username') }}" 
                                   required
                                   placeholder="Introduce tu nombre de usuario"
                                   autocomplete="username">
                            @error('username')
                                <div class="alert alert-danger mt-2">
                                    <i class="fas fa-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">
                                        <i class="fas fa-id-card"></i> Nombre
                                    </label>
                                    <input type="text" 
                                           class="form-control @error('name') is-invalid @enderror" 
                                           name="name" 
                                           id="name"
                                           value="{{ old('name') }}" 
                                           required
                                           placeholder="Tu nombre"
                                           autocomplete="given-name">
                                    @error('name')
                                        <div class="alert alert-danger mt-2">
                                            <i class="fas fa-exclamation-circle"></i>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="surname">
                                        <i class="fas fa-id-card"></i> Apellidos
                                    </label>
                                    <input type="text" 
                                           class="form-control @error('surname') is-invalid @enderror" 
                                           name="surname" 
                                           id="surname"
                                           value="{{ old('surname') }}" 
                                           required
                                           placeholder="Tus apellidos"
                                           autocomplete="family-name">
                                    @error('surname')
                                        <div class="alert alert-danger mt-2">
                                            <i class="fas fa-exclamation-circle"></i>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email">
                                <i class="fas fa-envelope"></i> Email
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
                                   placeholder="Mínimo 8 caracteres"
                                   autocomplete="new-password">
                            
                            <!-- Indicador de fortaleza de contraseña -->
                            <div class="password-strength" id="passwordStrength" style="display: none;">
                                <div class="password-strength-bar">
                                    <div class="password-strength-fill"></div>
                                </div>
                                <div class="password-strength-text"></div>
                            </div>
                            
                            @error('password')
                                <div class="alert alert-danger mt-2">
                                    <i class="fas fa-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">
                                <i class="fas fa-lock"></i> Confirmar Contraseña
                            </label>
                            <input type="password" 
                                   class="form-control @error('password_confirmation') is-invalid @enderror" 
                                   name="password_confirmation" 
                                   id="password_confirmation"
                                   required
                                   placeholder="Repite tu contraseña"
                                   autocomplete="new-password">
                            @error('password_confirmation')
                                <div class="alert alert-danger mt-2">
                                    <i class="fas fa-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Política de Privacidad (Obligatorio) -->
                        <div class="form-group">
                            <div class="checkbox-container">
                                <input type="checkbox" 
                                       class="form-check-input @error('privacy_policy') is-invalid @enderror" 
                                       name="privacy_policy" 
                                       id="privacy_policy"
                                       value="1"
                                       required>
                                <label for="privacy_policy" class="form-check-label">
                                    <i class="fas fa-shield-alt"></i>
                                    Acepto la <a href="#" data-bs-toggle="modal" data-bs-target="#privacyModal" class="privacy-link">Política de Privacidad</a> <span class="required">*</span>
                                </label>
                            </div>
                            @error('privacy_policy')
                                <div class="alert alert-danger mt-2">
                                    <i class="fas fa-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Marketing (Opcional) -->
                        <div class="form-group">
                            <div class="checkbox-container">
                                <input type="checkbox" 
                                       class="form-check-input" 
                                       name="marketing_consent" 
                                       id="marketing_consent"
                                       value="1">
                                <label for="marketing_consent" class="form-check-label">
                                    <i class="fas fa-bullhorn"></i>
                                    Deseo recibir información sobre cursos, promociones y novedades por email
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <button class="btn_one" type="submit" id="submitBtn">
                                <i class="fas fa-user-plus"></i> Crear Cuenta
                            </button>
                        </div>
                    </form>

                    <div class="register-link">
                        <p>¿Ya tienes cuenta? <a href="/weblogin">Iniciar Sesión</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('registerForm');
    const passwordInput = document.getElementById('password');
    const passwordConfirmInput = document.getElementById('password_confirmation');
    const passwordStrength = document.getElementById('passwordStrength');
    const submitBtn = document.getElementById('submitBtn');
    
    // Validación de fortaleza de contraseña
    passwordInput.addEventListener('input', function() {
        const password = this.value;
        const strength = calculatePasswordStrength(password);
        
        if (password.length > 0) {
            passwordStrength.style.display = 'block';
            updatePasswordStrengthUI(strength);
        } else {
            passwordStrength.style.display = 'none';
        }
    });
    
    // Validación de confirmación de contraseña
    passwordConfirmInput.addEventListener('input', function() {
        const password = passwordInput.value;
        const confirmPassword = this.value;
        
        if (confirmPassword.length > 0) {
            if (password !== confirmPassword) {
                this.classList.add('is-invalid');
                this.style.borderColor = '#e53e3e';
            } else {
                this.classList.remove('is-invalid');
                this.style.borderColor = '#48bb78';
            }
        }
    });
    
    // Validación del formulario antes del envío
    form.addEventListener('submit', function(e) {
        let isValid = true;
        const formData = new FormData(form);
        
        // Validar campos requeridos
        const requiredFields = ['username', 'name', 'surname', 'email', 'password', 'password_confirmation'];
        requiredFields.forEach(field => {
            const input = document.getElementById(field);
            if (!input.value.trim()) {
                input.classList.add('is-invalid');
                isValid = false;
            } else {
                input.classList.remove('is-invalid');
            }
        });
        
        // Validar email
        const emailInput = document.getElementById('email');
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (emailInput.value && !emailRegex.test(emailInput.value)) {
            emailInput.classList.add('is-invalid');
            isValid = false;
        }
        
        // Validar contraseñas coincidan
        if (passwordInput.value !== passwordConfirmInput.value) {
            passwordConfirmInput.classList.add('is-invalid');
            isValid = false;
        }
        
        // Validar fortaleza mínima de contraseña
        const strength = calculatePasswordStrength(passwordInput.value);
        if (strength.score < 2) {
            passwordInput.classList.add('is-invalid');
            isValid = false;
        }
        
        if (!isValid) {
            e.preventDefault();
            showAlert('Por favor, corrige los errores en el formulario antes de continuar.', 'danger');
            return false;
        }
        
        // Mostrar loading en el botón
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Creando cuenta...';
        submitBtn.disabled = true;
    });
    
    function calculatePasswordStrength(password) {
        let score = 0;
        let feedback = [];
        
        if (password.length >= 8) score++;
        else feedback.push('Mínimo 8 caracteres');
        
        if (/[a-z]/.test(password)) score++;
        else feedback.push('Una letra minúscula');
        
        if (/[A-Z]/.test(password)) score++;
        else feedback.push('Una letra mayúscula');
        
        if (/[0-9]/.test(password)) score++;
        else feedback.push('Un número');
        
        if (/[^A-Za-z0-9]/.test(password)) score++;
        else feedback.push('Un carácter especial');
        
        return { score, feedback };
    }
    
    function updatePasswordStrengthUI(strength) {
        const strengthElement = passwordStrength;
        const fillElement = strengthElement.querySelector('.password-strength-fill');
        const textElement = strengthElement.querySelector('.password-strength-text');
        
        // Remover clases anteriores
        strengthElement.classList.remove('strength-weak', 'strength-medium', 'strength-strong');
        
        if (strength.score <= 2) {
            strengthElement.classList.add('strength-weak');
            textElement.textContent = 'Débil';
        } else if (strength.score <= 3) {
            strengthElement.classList.add('strength-medium');
            textElement.textContent = 'Media';
        } else {
            strengthElement.classList.add('strength-strong');
            textElement.textContent = 'Fuerte';
        }
    }
    
    function showAlert(message, type) {
        // Crear alerta temporal
        const alertDiv = document.createElement('div');
        alertDiv.className = `alert alert-${type} alert-dismissible fade show`;
        alertDiv.innerHTML = `
            <i class="fas fa-exclamation-triangle"></i> ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;
        
        // Insertar antes del formulario
        const form = document.getElementById('registerForm');
        form.parentNode.insertBefore(alertDiv, form);
        
        // Auto-remover después de 5 segundos
        setTimeout(() => {
            if (alertDiv.parentNode) {
                alertDiv.remove();
            }
        }, 5000);
    }
    
    // Limpiar errores al escribir
    const inputs = form.querySelectorAll('input');
    inputs.forEach(input => {
        input.addEventListener('input', function() {
            if (this.classList.contains('is-invalid') && this.value.trim()) {
                this.classList.remove('is-invalid');
                this.style.borderColor = '';
            }
        });
    });
});
</script>

<!-- Modal de Política de Privacidad -->
<div class="modal fade" id="privacyModal" tabindex="-1" aria-labelledby="privacyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="privacyModalLabel">
                    <i class="fas fa-shield-alt"></i>
                    Política de Privacidad
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <h6><i class="fas fa-info-circle"></i> Información que recopilamos</h6>
                <p>Recopilamos información que nos proporcionas directamente, como cuando te registras, te inscribes en un curso, o te comunicas con nosotros.</p>
                
                <h6><i class="fas fa-user"></i> Datos personales</h6>
                <p>Nombre, dirección de correo electrónico, número de teléfono, información de facturación y cualquier otra información que elijas proporcionar.</p>
                
                <h6><i class="fas fa-graduation-cap"></i> Información académica</h6>
                <p>Registros de cursos, calificaciones, certificados y otra información relacionada con tu experiencia educativa.</p>
                
                <h6><i class="fas fa-cog"></i> Cómo utilizamos tu información</h6>
                <p>Utilizamos tu información para proporcionar, mantener y mejorar nuestros servicios educativos, procesar pagos, comunicarnos contigo y cumplir con nuestras obligaciones legales.</p>
                
                <h6><i class="fas fa-share-alt"></i> Compartir información</h6>
                <p>No vendemos, alquilamos ni compartimos tu información personal con terceros, excepto en las circunstancias descritas en esta política.</p>
                
                <h6><i class="fas fa-lock"></i> Seguridad</h6>
                <p>Implementamos medidas de seguridad técnicas y organizativas para proteger tu información personal contra acceso no autorizado, alteración, divulgación o destrucción.</p>
                
                <h6><i class="fas fa-envelope"></i> Comunicaciones</h6>
                <p>Podemos enviarte comunicaciones relacionadas con tu cuenta, cursos y servicios. Puedes optar por no recibir ciertos tipos de comunicaciones.</p>
                
                <h6><i class="fas fa-edit"></i> Tus derechos</h6>
                <p>Tienes derecho a acceder, actualizar, corregir o eliminar tu información personal. También puedes retirar tu consentimiento en cualquier momento.</p>
                
                <h6><i class="fas fa-phone"></i> Contacto</h6>
                <p>Si tienes preguntas sobre esta política de privacidad, puedes contactarnos en <strong>info@ecosformacion.com</strong></p>
                
                <p><small class="text-muted">Última actualización: {{ date('d/m/Y') }}</small></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i> Cerrar
                </button>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">
                    <i class="fas fa-check"></i> Entendido
                </button>
            </div>
        </div>
    </div>
</div>

@endsection
