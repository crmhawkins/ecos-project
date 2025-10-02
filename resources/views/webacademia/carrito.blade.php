@extends('webacademia.layouts.web_layout')

@section('title', 'Mi Carrito')

@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/niceselect.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/shop.css') }}">
<style>
/* Estilos mejorados para el carrito */
.shopping-cart {
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    min-height: 100vh;
    padding: 40px 0;
}

.shopping-summery {
    background: white;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    margin-bottom: 30px;
}

.shopping-summery thead tr {
    background: linear-gradient(135deg, #D93690 0%, #ff6b9d 100%);
    color: white;
}

.shopping-summery thead th {
    padding: 20px 15px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    border: none;
}

.shopping-summery tbody td {
    padding: 25px 15px;
    vertical-align: middle;
    border-bottom: 1px solid #f0f0f0;
}

.shopping-summery tbody tr:last-child td {
    border-bottom: none;
}

.shopping-summery tbody tr:hover {
    background-color: #f8f9fa;
}

/* Imagen del curso mejorada */
.course-image {
    width: 100px;
    height: 75px;
    border-radius: 10px;
    object-fit: cover;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
}

.course-image:hover {
    transform: scale(1.05);
}

.default-course-image {
    width: 100px;
    height: 75px;
    border-radius: 10px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 2rem;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

/* Información del producto */
.product-name a {
    color: #2c3e50;
    font-weight: 600;
    font-size: 16px;
    text-decoration: none;
    transition: color 0.3s ease;
}

.product-name a:hover {
    color: #D93690;
}

.product-des {
    color: #7f8c8d;
    font-size: 14px;
    margin-top: 8px;
}

/* Precio */
.price span {
    font-size: 18px;
    font-weight: 600;
    color: #D93690;
}

/* Controles de cantidad mejorados */
.input-group {
    width: 120px;
    margin: 0 auto;
}

.input-group .btn {
    background: linear-gradient(135deg, #D93690 0%, #ff6b9d 100%);
    border: none;
    color: white;
    width: 35px;
    height: 35px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.input-group .btn:hover {
    background: linear-gradient(135deg, #ff6b9d 0%, #D93690 100%);
    transform: translateY(-2px);
}

.input-number {
    width: 50px;
    text-align: center;
    border: 2px solid #e9ecef;
    border-left: none;
    border-right: none;
    height: 35px;
    font-weight: 600;
}

/* Total */
.total-amount span {
    font-size: 18px;
    font-weight: 600;
    color: #2c3e50;
}

/* Botón eliminar mejorado */
.btn-remove {
    background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
    border: none;
    color: white;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.btn-remove:hover {
    background: linear-gradient(135deg, #c0392b 0%, #e74c3c 100%);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(231, 76, 60, 0.3);
}

/* Carrito vacío */
.empty-cart {
    padding: 60px 20px;
    text-align: center;
}

.empty-cart i {
    font-size: 5rem;
    color: #bdc3c7;
    margin-bottom: 20px;
}

.empty-cart h4 {
    color: #2c3e50;
    margin-bottom: 15px;
}

/* Sección de totales mejorada */
.total-amount {
    background: white;
    border-radius: 15px;
    padding: 30px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

.total-amount .right ul {
    background: #f8f9fa;
    padding: 25px;
    border-radius: 10px;
    margin-bottom: 25px;
}

.total-amount .right ul li {
    display: flex;
    justify-content: space-between;
    padding: 10px 0;
    border-bottom: 1px solid #dee2e6;
    font-size: 16px;
}

.total-amount .right ul li:last-child {
    border-bottom: none;
    font-weight: 600;
    font-size: 18px;
    color: #D93690;
    padding-top: 15px;
    border-top: 2px solid #D93690;
}

/* Botones principales mejorados */
.btn_one {
    background: linear-gradient(135deg, #D93690 0%, #ff6b9d 100%);
    color: white;
    padding: 15px 30px;
    border: none;
    border-radius: 25px;
    font-size: 16px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-block;
    width: 100%;
    text-align: center;
    margin-bottom: 15px;
}

.btn_one:hover {
    background: linear-gradient(135deg, #ff6b9d 0%, #D93690 100%);
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(217, 54, 144, 0.3);
    color: white;
    text-decoration: none;
}

.btn_two {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 15px 30px;
    border: none;
    border-radius: 25px;
    font-size: 16px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-block;
    width: 100%;
    text-align: center;
}

.btn_two:hover {
    background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
    color: white;
    text-decoration: none;
}

/* Botón vaciar carrito mejorado */
.btn-vaciar-carrito {
    background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
    color: white;
    padding: 12px 25px;
    border: none;
    border-radius: 20px;
    font-size: 14px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

.btn-vaciar-carrito:hover {
    background: linear-gradient(135deg, #c0392b 0%, #e74c3c 100%);
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(231, 76, 60, 0.3);
    color: white;
}

.btn-vaciar-carrito i {
    font-size: 16px;
}

/* Botón explorar cursos más pequeño */
.btn-explorar-cursos {
    padding: 12px 24px !important;
    border-radius: 8px !important;
    font-size: 14px !important;
    font-weight: 600 !important;
    text-decoration: none !important;
    display: inline-flex !important;
    align-items: center !important;
    gap: 8px !important;
    background: linear-gradient(135deg, #D93690 0%, #ff6b9d 100%) !important;
    border: none !important;
    color: white !important;
    transition: all 0.3s ease !important;
}

.btn-explorar-cursos:hover {
    background: linear-gradient(135deg, #ff6b9d 0%, #D93690 100%) !important;
    transform: translateY(-2px) !important;
    box-shadow: 0 8px 20px rgba(217, 54, 144, 0.3) !important;
    color: white !important;
    text-decoration: none !important;
}

/* Responsive */
@media (max-width: 768px) {
    .shopping-summery {
        font-size: 14px;
    }
    
    .shopping-summery thead th {
        padding: 15px 10px;
        font-size: 12px;
    }
    
    .shopping-summery tbody td {
        padding: 20px 10px;
    }
    
    .course-image, .default-course-image {
        width: 80px;
        height: 60px;
    }
    
    .btn_one, .btn_two {
        padding: 12px 20px;
        font-size: 14px;
    }
    
    .btn-explorar-cursos {
        padding: 10px 20px !important;
        font-size: 13px !important;
    }
}
</style>
@endsection

@section('content')

<!-- START SECTION TOP -->
<section class="section-top">
    <div class="container">
        <div class="col-lg-10 offset-lg-1 text-center">
            <div class="section-top-title wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.3s" data-wow-offset="0">
                <h1>Mi Carrito</h1>
                <ul>
                    <li><a href="/">Inicio</a></li>
                    <li> / Mi Carrito</li>
                </ul>
            </div>
        </div>
    </div>
</section>
<!-- END SECTION TOP -->

<!-- Shopping Cart -->
<div class="shopping-cart section">
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row">
            <div class="col-12">
                <!-- Shopping Summery -->
                <table class="table shopping-summery">
                    <thead>
                        <tr class="main-hading">
                            <th>CURSO</th>
                            <th>NOMBRE</th>
                            <th class="text-center">PRECIO UNITARIO</th>
                            <th class="text-center">CANTIDAD</th>
                            <th class="text-center">TOTAL</th> 
                            <th class="text-center"><i class="ti-trash remove-icon"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($carrito as $item)
                            <tr>
                                <td class="image" data-title="No">
                                    @if($item->curso->image && file_exists(storage_path('app/public/' . $item->curso->image)))
                                        <img src="{{ asset('storage/' . $item->curso->image) }}" alt="{{ $item->curso->name ?? $item->curso->title }}" class="course-image">
                                    @else
                                        <img src="{{ asset('assets/images/default-course.svg') }}" alt="Curso por defecto" class="course-image">
                                    @endif
                                </td>
                                <td class="product-des" data-title="Description">
                                    <p class="product-name">
                                        <a href="{{ route('webacademia.single_course', $item->curso->id) }}">
                                            {{ $item->curso->name ?? $item->curso->title }}
                                        </a>
                                    </p>
                                    <p class="product-des">
                                        {{ Str::limit($item->curso->description ?? 'Curso completo con certificación oficial', 80) }}
                                    </p>
                                </td>
                                <td class="price" data-title="Price">
                                    <span>{{ number_format($item->curso->price, 2) }}€</span>
                                </td>
                                <td class="qty" data-title="Qty">
                                    <div class="input-group">
                                        <div class="button minus">
                                            <button type="button" class="btn btn-primary btn-number" onclick="updateQuantity({{ $item->id }}, {{ $item->cantidad - 1 }})">
                                                <i class="ti-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text" name="quantity" class="input-number" data-min="1" data-max="10" value="{{ $item->cantidad }}" readonly>
                                        <div class="button plus">
                                            <button type="button" class="btn btn-primary btn-number" onclick="updateQuantity({{ $item->id }}, {{ $item->cantidad + 1 }})">
                                                <i class="ti-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td class="total-amount" data-title="Total">
                                    <span>{{ number_format($item->curso->price * $item->cantidad, 2) }}€</span>
                                </td>
                                <td class="action" data-title="Remove">
                                    <form method="POST" action="{{ route('carrito.eliminar', $item->curso->id) }}" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn-remove" onclick="return confirm('¿Estás seguro de eliminar este curso del carrito?')" title="Eliminar curso">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <div class="empty-cart">
                                        <i class="ti-shopping-cart" style="font-size: 4rem; color: #ccc;"></i>
                                        <h4 class="mt-3">Tu carrito está vacío</h4>
                                        <p class="text-muted">¡Explora nuestros cursos y añade algunos a tu carrito!</p>
                                        <a href="{{ route('webacademia.courses') }}" class="btn-explorar-cursos">
                                            <i class="fas fa-graduation-cap"></i> Explorar Cursos
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <!--/ End Shopping Summery -->
            </div>
        </div>

        @if($carrito->count() > 0)
            <div class="row">
                <div class="col-12">
                    <!-- Total Amount -->
                    <div class="total-amount">
                        <div class="row">
                            <div class="col-lg-8 col-md-5 col-12">
                                <div class="left">
                                    <div class="coupon">
                                        <form method="POST" action="{{ route('carrito.vaciar') }}">
                                            @csrf
                                            <button type="submit" class="btn-vaciar-carrito" onclick="return confirm('¿Estás seguro de vaciar todo el carrito?')">
                                                <i class="fas fa-trash-alt"></i>
                                                Vaciar Carrito
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-7 col-12">
                                <div class="right">
                                    <ul>
                                        @php
                                            $subtotal = $carrito->sum(function($item) {
                                                return $item->curso->price * $item->cantidad;
                                            });
                                            $iva = $subtotal * 0.21; // 21% IVA
                                            $total = $subtotal + $iva;
                                        @endphp
                                        <li>Subtotal<span>{{ number_format($subtotal, 2) }}€</span></li>
                                        <li>IVA (21%)<span>{{ number_format($iva, 2) }}€</span></li>
                                        <li class="last">Total<span>{{ number_format($total, 2) }}€</span></li>
                                    </ul>
                                    <div class="button5">
                                        <form method="POST" action="{{ route('carrito.checkout') }}">
                                            @csrf
                                            <button type="submit" class="btn_one">
                                                <i class="fas fa-credit-card"></i> Proceder al Pago
                                            </button>
                                        </form>
                                        <a href="{{ route('webacademia.courses') }}" class="btn_two">
                                            <i class="fas fa-shopping-bag"></i> Seguir Comprando
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ End Total Amount -->
                </div>
            </div>
        @endif
    </div>
</div>
<!--/ End Shopping Cart -->

<script>
function updateQuantity(itemId, newQuantity) {
    if (newQuantity < 1) {
        if (confirm('¿Deseas eliminar este curso del carrito?')) {
            // Eliminar item
            window.location.href = `/carrito/eliminar/${itemId}`;
        }
        return;
    }
    
    if (newQuantity > 10) {
        alert('Máximo 10 unidades por curso');
        return;
    }
    
    // Aquí podrías implementar AJAX para actualizar la cantidad
    // Por ahora, recargamos la página
    window.location.reload();
}
</script>

@endsection
