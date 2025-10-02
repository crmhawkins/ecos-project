@extends('webacademia.layouts.web_layout')

@section('title', 'Finalizar Compra')

@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/niceselect.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/shop.css') }}">
<style>
/* Estilos mejorados para el checkout */
.checkout-container {
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    min-height: 100vh;
    padding: 40px 0;
}

.checkout-card {
    background: white;
    border-radius: 20px;
    box-shadow: 0 15px 40px rgba(0,0,0,0.1);
    overflow: hidden;
    margin-bottom: 30px;
}

.checkout-header {
    background: linear-gradient(135deg, #D93690 0%, #ff6b9d 100%);
    color: white;
    padding: 40px;
    text-align: center;
    position: relative;
}

.checkout-header::before {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 20px;
    background: white;
    border-radius: 20px 20px 0 0;
}

.checkout-header h1 {
    margin: 0;
    font-size: 2.8rem;
    font-weight: 300;
    text-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.checkout-header .breadcrumb {
    background: transparent;
    margin: 15px 0 0 0;
    justify-content: center;
    padding: 0;
}

.checkout-header .breadcrumb a {
    color: rgba(255,255,255,0.9);
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s ease;
}

.checkout-header .breadcrumb a:hover {
    color: white;
    text-shadow: 0 2px 5px rgba(0,0,0,0.2);
}

.form-section {
    padding: 50px;
    background: white;
}

.form-section h2 {
    color: #2c3e50;
    margin-bottom: 15px;
    font-weight: 700;
    font-size: 1.8rem;
}

.form-section p {
    color: #7f8c8d;
    margin-bottom: 40px;
    font-size: 16px;
    line-height: 1.6;
}

.form-group {
    margin-bottom: 30px;
    position: relative;
}

.form-group label {
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 10px;
    display: block;
    font-size: 15px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.form-group label span {
    color: #e74c3c;
    font-size: 18px;
}

.form-control {
    border: 2px solid #e9ecef;
    border-radius: 12px;
    padding: 16px 20px;
    font-size: 16px;
    transition: all 0.3s ease;
    background: #fafbfc;
    width: 100%;
    font-weight: 500;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

.form-control:focus {
    border-color: #D93690;
    box-shadow: 0 0 0 0.3rem rgba(217, 54, 144, 0.15);
    background: white;
    transform: translateY(-2px);
}

.form-control::placeholder {
    color: #adb5bd;
    font-weight: 400;
}

/* Estilos especiales para inputs específicos */
input[type="text"], input[type="email"], input[type="tel"] {
    background: linear-gradient(145deg, #fafbfc 0%, #f8f9fa 100%);
}

input[type="text"]:focus, input[type="email"]:focus, input[type="tel"]:focus {
    background: linear-gradient(145deg, #ffffff 0%, #fafbfc 100%);
}

/* Select mejorado */
select.form-control {
    background: linear-gradient(145deg, #fafbfc 0%, #f8f9fa 100%);
    cursor: pointer;
    appearance: none;
    background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23D93690' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6,9 12,15 18,9'%3e%3c/polyline%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right 15px center;
    background-size: 20px;
    padding-right: 50px;
}

select.form-control:focus {
    background: linear-gradient(145deg, #ffffff 0%, #fafbfc 100%);
    background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23D93690' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6,9 12,15 18,9'%3e%3c/polyline%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right 15px center;
    background-size: 20px;
}

.payment-methods {
    margin-top: 40px;
}

.payment-methods h3 {
    color: #2c3e50;
    margin-bottom: 25px;
    font-weight: 600;
}

.payment-method {
    border: 2px solid #ecf0f1;
    border-radius: 12px;
    padding: 20px;
    margin-bottom: 15px;
    cursor: pointer;
    transition: all 0.3s ease;
    background: white;
}

.payment-method:hover {
    border-color: #D93690;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(217, 54, 144, 0.1);
}

.payment-method.selected {
    border-color: #D93690;
    background: linear-gradient(135deg, rgba(217, 54, 144, 0.05) 0%, rgba(255, 107, 157, 0.05) 100%);
}

.payment-method input[type="radio"] {
    margin-right: 15px;
    transform: scale(1.2);
}

.payment-method .method-info {
    display: flex;
    align-items: center;
}

.payment-method .method-icon {
    width: 50px;
    height: 50px;
    margin-right: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #f8f9fa;
    border-radius: 50%;
    font-size: 20px;
}

.payment-method strong {
    color: #2c3e50;
    font-size: 18px;
}

.payment-method p {
    margin: 5px 0 0 0;
    color: #7f8c8d;
}

.order-summary {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    padding: 35px;
    border-radius: 20px;
    margin-bottom: 25px;
    border: 1px solid #dee2e6;
    box-shadow: 0 8px 25px rgba(0,0,0,0.08);
    position: sticky;
    top: 20px;
}

.order-summary h3 {
    color: #2c3e50;
    margin-bottom: 30px;
    font-weight: 700;
    text-align: center;
    font-size: 1.4rem;
    padding-bottom: 15px;
    border-bottom: 2px solid #D93690;
}

.course-item {
    display: flex;
    align-items: center;
    padding: 20px 0;
    border-bottom: 1px solid #dee2e6;
}

.course-item:last-child {
    border-bottom: none;
}

.course-item img {
    width: 80px;
    height: 60px;
    object-fit: cover;
    border-radius: 8px;
    margin-right: 20px;
}

.course-details {
    flex: 1;
}

.course-details h6 {
    color: #2c3e50;
    margin-bottom: 5px;
    font-weight: 600;
}

.course-price {
    font-weight: bold;
    color: #D93690;
    font-size: 18px;
}

.total-section {
    background: white;
    padding: 30px;
    border-radius: 15px;
    border: 2px solid #D93690;
    box-shadow: 0 5px 15px rgba(217, 54, 144, 0.1);
}

.total-section .d-flex {
    font-size: 16px;
    margin-bottom: 15px;
}

.total-section hr {
    border-color: #D93690;
    opacity: 0.3;
}

.btn_one {
    background: linear-gradient(135deg, #D93690 0%, #ff6b9d 100%);
    border: none;
    color: white;
    padding: 15px 30px;
    border-radius: 8px;
    font-size: 18px;
    font-weight: 600;
    transition: all 0.3s ease;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.btn_one:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(217, 54, 144, 0.3);
    color: white;
}

.btn_one:disabled {
    opacity: 0.7;
    transform: none;
    box-shadow: none;
}

.terms-section {
    background: #f8f9fa;
    padding: 25px;
    border-radius: 12px;
    margin-top: 30px;
    border-left: 4px solid #D93690;
}

.form-check-input:checked {
    background-color: #D93690;
    border-color: #D93690;
}

.form-check-label {
    color: #2c3e50;
    font-size: 14px;
}

.form-check-label a {
    color: #D93690;
    text-decoration: none;
    font-weight: 600;
}

.form-check-label a:hover {
    text-decoration: underline;
}

.security-badge {
    text-align: center;
    margin-top: 20px;
    padding: 15px;
    background: rgba(40, 167, 69, 0.1);
    border-radius: 8px;
    color: #28a745;
}

/* Responsive */
@media (max-width: 991.98px) {
    .order-details {
        padding-left: 0 !important;
        margin-top: 30px;
    }
}

@media (max-width: 768px) {
    .checkout-container {
        padding: 20px 0;
    }
    
    .checkout-header {
        padding: 30px 20px;
    }
    
    .checkout-header h1 {
        font-size: 2.2rem;
    }
    
    .form-section {
        padding: 30px 25px;
    }
    
    .form-section h2 {
        font-size: 1.5rem;
    }
    
    .form-control {
        padding: 14px 16px;
        font-size: 15px;
    }
    
    .order-summary {
        padding: 25px 20px;
        position: static;
    }
    
    .total-section {
        padding: 25px 20px;
    }
    
    .btn_one {
        padding: 14px 25px;
        font-size: 15px;
    }
}

/* Modales */
.modal-header {
    background: linear-gradient(135deg, #D93690 0%, #ff6b9d 100%);
    color: white;
    border-bottom: none;
}

.modal-header .btn-close {
    filter: invert(1);
}

.modal-body {
    padding: 30px;
    line-height: 1.6;
}

.modal-content {
    border-radius: 15px;
    border: none;
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
}
</style>
@endsection

@section('content')

<!-- Checkout Header -->
<div class="checkout-container">
    <div class="container">
        <div class="checkout-card">
            <div class="checkout-header">
                <h1>✨ Finalizar Compra</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">🏠 Inicio</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('carrito.ver') }}">🛒 Carrito</a></li>
                        <li class="breadcrumb-item active" aria-current="page">💳 Checkout</li>
                    </ol>
                </nav>
            </div>

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin: 20px 40px 0;">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <form method="POST" action="{{ route('carrito.procesar_pago') }}" id="checkout-form">
                @csrf
                <div class="row g-4">
                    <div class="col-lg-8 col-12">
                        <div class="form-section">
                            <h2>📋 Datos de Facturación</h2>
                            <p>Por favor, completa los datos para procesar tu compra de forma segura</p>
                        
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label>Nombre <span>*</span></label>
                                    <input type="text" name="nombre" value="{{ Auth::guard('alumno')->user()->name }}" required>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label>Apellidos <span>*</span></label>
                                    <input type="text" name="apellidos" value="{{ Auth::guard('alumno')->user()->surname }}" required>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label>Email <span>*</span></label>
                                    <input type="email" name="email" value="{{ Auth::guard('alumno')->user()->email }}" required>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label>Teléfono <span>*</span></label>
                                    <input type="tel" name="telefono" value="{{ Auth::guard('alumno')->user()->phone }}" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Dirección</label>
                                    <input type="text" name="direccion" placeholder="Calle, número, piso...">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-12">
                                <div class="form-group">
                                    <label>Ciudad</label>
                                    <input type="text" name="ciudad" placeholder="Ciudad">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-12">
                                <div class="form-group">
                                    <label>Código Postal</label>
                                    <input type="text" name="codigo_postal" placeholder="28001">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-12">
                                <div class="form-group">
                                    <label>País</label>
                                    <select name="pais" class="form-control">
                                        <option value="ES" selected>España</option>
                                        <option value="FR">Francia</option>
                                        <option value="PT">Portugal</option>
                                        <option value="IT">Italia</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Métodos de Pago -->
                        <div class="payment-methods mt-5">
                            <h3>Método de Pago</h3>
                            
                            <div class="payment-method" onclick="selectPayment('stripe')">
                                <div class="method-info">
                                    <input type="radio" name="metodo_pago" value="stripe" id="stripe" required>
                                    <div class="method-icon">
                                        <i class="fa fa-credit-card" style="color: #D93690;"></i>
                                    </div>
                                    <div>
                                        <strong>Tarjeta de Crédito/Débito</strong>
                                        <p class="mb-0 text-muted">Visa, Mastercard, American Express</p>
                                    </div>
                                </div>
                            </div>

                            <div class="payment-method" onclick="selectPayment('paypal')">
                                <div class="method-info">
                                    <input type="radio" name="metodo_pago" value="paypal" id="paypal">
                                    <div class="method-icon">
                                        <i class="fab fa-paypal" style="color: #0070ba;"></i>
                                    </div>
                                    <div>
                                        <strong>PayPal</strong>
                                        <p class="mb-0 text-muted">Paga con tu cuenta de PayPal</p>
                                    </div>
                                </div>
                            </div>

                            <div class="payment-method" onclick="selectPayment('transferencia')">
                                <div class="method-info">
                                    <input type="radio" name="metodo_pago" value="transferencia" id="transferencia">
                                    <div class="method-icon">
                                        <i class="fa fa-university" style="color: #28a745;"></i>
                                    </div>
                                    <div>
                                        <strong>Transferencia Bancaria</strong>
                                        <p class="mb-0 text-muted">Pago mediante transferencia</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                            <!-- Términos y Condiciones -->
                            <div class="terms-section">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="acepto_terminos" id="acepto_terminos" required>
                                    <label class="form-check-label" for="acepto_terminos">
                                        ✅ Acepto los <a href="#" data-bs-toggle="modal" data-bs-target="#terminosModal">términos y condiciones</a> y la <a href="#" data-bs-toggle="modal" data-bs-target="#privacidadModal">política de privacidad</a>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-12">
                        <div class="order-details" style="padding-left: 20px;">
                            <!-- Resumen del Pedido -->
                            <div class="order-summary">
                                <h3>📦 Resumen del Pedido</h3>
                            
                            @foreach($carrito as $item)
                                <div class="course-item">
                                    @if($item->curso->image && file_exists(storage_path('app/public/' . $item->curso->image)))
                                        <img src="{{ asset('storage/' . $item->curso->image) }}" alt="{{ $item->curso->name ?? $item->curso->title }}">
                                    @else
                                        <img src="{{ asset('assets/images/default-course.svg') }}" alt="Curso por defecto">
                                    @endif
                                    <div class="course-details">
                                        <h6>{{ $item->curso->name ?? $item->curso->title }}</h6>
                                        <small class="text-muted">📚 Cantidad: {{ $item->cantidad }}</small>
                                    </div>
                                    <div class="course-price">
                                        {{ number_format($item->curso->price * $item->cantidad, 2) }}€
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Total -->
                        <div class="total-section">
                            @php
                                $subtotal = $carrito->sum(function($item) {
                                    return $item->curso->price * $item->cantidad;
                                });
                                $iva = $subtotal * 0.21;
                                $total = $subtotal + $iva;
                            @endphp
                            
                            <div class="d-flex justify-content-between mb-2">
                                <span>Subtotal:</span>
                                <span>{{ number_format($subtotal, 2) }}€</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>IVA (21%):</span>
                                <span>{{ number_format($iva, 2) }}€</span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between mb-3">
                                <strong>Total:</strong>
                                <strong style="color: #D93690; font-size: 1.2em;">{{ number_format($total, 2) }}€</strong>
                            </div>

                                <button type="submit" class="btn_one w-100" id="btn-pagar">
                                    🔒 Procesar Pago Seguro
                                </button>
                                
                                <div class="security-badge">
                                    <i class="fa fa-shield-alt"></i> Pago 100% seguro y encriptado
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Términos y Condiciones -->
<div class="modal fade" id="terminosModal" tabindex="-1" aria-labelledby="terminosModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="terminosModalLabel">📋 Términos y Condiciones</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if($configuracion && $configuracion->terminos_condiciones)
                    {!! nl2br(e($configuracion->terminos_condiciones)) !!}
                @else
                    <p>Los términos y condiciones no han sido configurados aún. Por favor, contacta con el administrador.</p>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Política de Privacidad -->
<div class="modal fade" id="privacidadModal" tabindex="-1" aria-labelledby="privacidadModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="privacidadModalLabel">🔒 Política de Privacidad</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if($configuracion && $configuracion->politica_privacidad)
                    {!! nl2br(e($configuracion->politica_privacidad)) !!}
                @else
                    <p>La política de privacidad no ha sido configurada aún. Por favor, contacta con el administrador.</p>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script>
// Función mejorada para seleccionar método de pago
function selectPayment(method) {
    // Remover selección anterior
    document.querySelectorAll('.payment-method').forEach(el => {
        el.classList.remove('selected');
    });
    
    // Seleccionar método actual
    document.getElementById(method).checked = true;
    document.getElementById(method).closest('.payment-method').classList.add('selected');
    
    // Añadir animación
    const selectedMethod = document.getElementById(method).closest('.payment-method');
    selectedMethod.style.transform = 'scale(1.02)';
    setTimeout(() => {
        selectedMethod.style.transform = 'scale(1)';
    }, 200);
}

// Validación mejorada del formulario
document.getElementById('checkout-form').addEventListener('submit', function(e) {
    const metodoPago = document.querySelector('input[name="metodo_pago"]:checked');
    const terminos = document.getElementById('acepto_terminos');
    const btnPagar = document.getElementById('btn-pagar');
    
    if (!metodoPago) {
        e.preventDefault();
        Swal.fire({
            icon: 'warning',
            title: '⚠️ Método de pago requerido',
            text: 'Por favor, selecciona un método de pago para continuar',
            confirmButtonColor: '#D93690'
        });
        return;
    }
    
    if (!terminos.checked) {
        e.preventDefault();
        Swal.fire({
            icon: 'warning',
            title: '📋 Términos y condiciones',
            text: 'Debes aceptar los términos y condiciones para proceder con la compra',
            confirmButtonColor: '#D93690'
        });
        return;
    }
    
    // Deshabilitar botón y mostrar loading
    btnPagar.disabled = true;
    btnPagar.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Procesando pago...';
    
    // Mostrar mensaje de procesamiento
    Swal.fire({
        title: '💳 Procesando pago...',
        text: 'Por favor espera mientras procesamos tu pago de forma segura',
        allowOutsideClick: false,
        allowEscapeKey: false,
        showConfirmButton: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });
});

// Animaciones al cargar la página
document.addEventListener('DOMContentLoaded', function() {
    // Animar elementos del formulario
    const formGroups = document.querySelectorAll('.form-group');
    formGroups.forEach((group, index) => {
        group.style.opacity = '0';
        group.style.transform = 'translateY(20px)';
        setTimeout(() => {
            group.style.transition = 'all 0.5s ease';
            group.style.opacity = '1';
            group.style.transform = 'translateY(0)';
        }, index * 100);
    });
    
    // Animar métodos de pago
    const paymentMethods = document.querySelectorAll('.payment-method');
    paymentMethods.forEach((method, index) => {
        method.style.opacity = '0';
        method.style.transform = 'translateX(-20px)';
        setTimeout(() => {
            method.style.transition = 'all 0.5s ease';
            method.style.opacity = '1';
            method.style.transform = 'translateX(0)';
        }, (index + formGroups.length) * 100);
    });
    
    // Animar resumen del pedido
    const orderSummary = document.querySelector('.order-summary');
    if (orderSummary) {
        orderSummary.style.opacity = '0';
        orderSummary.style.transform = 'translateY(20px)';
        setTimeout(() => {
            orderSummary.style.transition = 'all 0.5s ease';
            orderSummary.style.opacity = '1';
            orderSummary.style.transform = 'translateY(0)';
        }, 500);
    }
});

// Validación en tiempo real
document.querySelectorAll('input[required]').forEach(input => {
    input.addEventListener('blur', function() {
        if (this.value.trim() === '') {
            this.style.borderColor = '#e74c3c';
            this.style.boxShadow = '0 0 0 0.2rem rgba(231, 76, 60, 0.25)';
        } else {
            this.style.borderColor = '#27ae60';
            this.style.boxShadow = '0 0 0 0.2rem rgba(39, 174, 96, 0.25)';
        }
    });
});

// Mejorar experiencia de los modales
document.querySelectorAll('[data-bs-toggle="modal"]').forEach(trigger => {
    trigger.addEventListener('click', function(e) {
        e.preventDefault();
        const targetModal = this.getAttribute('data-bs-target');
        const modal = new bootstrap.Modal(document.querySelector(targetModal));
        modal.show();
    });
});
</script>

<!-- SweetAlert2 para mejores alertas -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@endsection
