@extends('webacademia.layouts.web_layout')

@section('title', 'Finalizar Compra')

@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/niceselect.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/shop.css') }}">
<style>
.payment-method {
    border: 2px solid #e9ecef;
    border-radius: 8px;
    padding: 20px;
    margin-bottom: 15px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.payment-method:hover,
.payment-method.selected {
    border-color: #D93690;
    background-color: #f8f9fa;
}

.payment-method input[type="radio"] {
    margin-right: 10px;
}

.payment-method .method-info {
    display: flex;
    align-items: center;
}

.payment-method .method-icon {
    width: 40px;
    height: 40px;
    margin-right: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #f8f9fa;
    border-radius: 50%;
}

.order-summary {
    background: #f8f9fa;
    padding: 25px;
    border-radius: 8px;
    margin-bottom: 20px;
}

.course-item {
    display: flex;
    align-items: center;
    padding: 15px 0;
    border-bottom: 1px solid #dee2e6;
}

.course-item:last-child {
    border-bottom: none;
}

.course-item img {
    width: 60px;
    height: 45px;
    object-fit: cover;
    border-radius: 4px;
    margin-right: 15px;
}

.course-details {
    flex: 1;
}

.course-price {
    font-weight: bold;
    color: #D93690;
}

.total-section {
    background: white;
    padding: 20px;
    border-radius: 8px;
    border: 2px solid #D93690;
}
</style>
@endsection

@section('content')

<!-- START SECTION TOP -->
<section class="section-top">
    <div class="container">
        <div class="col-lg-10 offset-lg-1 text-center">
            <div class="section-top-title wow fadeInRight">
                <h1>Finalizar Compra</h1>
                <ul>
                    <li><a href="/">Inicio</a></li>
                    <li><a href="{{ route('carrito.ver') }}">Carrito</a></li>
                    <li> / Checkout</li>
                </ul>
            </div>
        </div>
    </div>
</section>
<!-- END SECTION TOP -->

<!-- Start Checkout -->
<section class="shop checkout section">
    <div class="container">
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <form method="POST" action="{{ route('carrito.procesar_pago') }}" id="checkout-form">
            @csrf
            <div class="row">
                <div class="col-lg-8 col-12">
                    <div class="checkout-form">
                        <h2>Datos de Facturación</h2>
                        <p>Por favor, completa los datos para procesar tu compra</p>
                        
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
                        <div class="form-check mt-4">
                            <input class="form-check-input" type="checkbox" name="acepto_terminos" id="acepto_terminos" required>
                            <label class="form-check-label" for="acepto_terminos">
                                Acepto los <a href="#" target="_blank">términos y condiciones</a> y la <a href="#" target="_blank">política de privacidad</a>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-12">
                    <div class="order-details">
                        <!-- Resumen del Pedido -->
                        <div class="order-summary">
                            <h3>Resumen del Pedido</h3>
                            
                            @foreach($carrito as $item)
                                <div class="course-item">
                                    <img src="{{ $item->curso->image ? asset('storage/' . $item->curso->image) : asset('assets/images/default-course.jpg') }}" alt="{{ $item->curso->title }}">
                                    <div class="course-details">
                                        <h6>{{ $item->curso->title }}</h6>
                                        <small class="text-muted">Cantidad: {{ $item->cantidad }}</small>
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
                                <i class="fa fa-lock"></i> Procesar Pago Seguro
                            </button>
                            
                            <div class="text-center mt-3">
                                <small class="text-muted">
                                    <i class="fa fa-shield-alt"></i> Pago 100% seguro y encriptado
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<!--/ End Checkout -->

<script>
function selectPayment(method) {
    // Remover selección anterior
    document.querySelectorAll('.payment-method').forEach(el => {
        el.classList.remove('selected');
    });
    
    // Seleccionar método actual
    document.getElementById(method).checked = true;
    document.getElementById(method).closest('.payment-method').classList.add('selected');
}

// Validación del formulario
document.getElementById('checkout-form').addEventListener('submit', function(e) {
    const metodoPago = document.querySelector('input[name="metodo_pago"]:checked');
    const terminos = document.getElementById('acepto_terminos');
    
    if (!metodoPago) {
        e.preventDefault();
        alert('Por favor, selecciona un método de pago');
        return;
    }
    
    if (!terminos.checked) {
        e.preventDefault();
        alert('Debes aceptar los términos y condiciones');
        return;
    }
    
    // Deshabilitar botón para evitar doble envío
    document.getElementById('btn-pagar').disabled = true;
    document.getElementById('btn-pagar').innerHTML = '<i class="fa fa-spinner fa-spin"></i> Procesando...';
});
</script>

@endsection
