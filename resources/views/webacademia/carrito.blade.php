@extends('webacademia.layouts.web_layout')

@section('title', 'Mi Carrito')

@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/niceselect.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/shop.css') }}">
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
                                    <img src="{{ $item->curso->image ? asset('storage/' . $item->curso->image) : asset('assets/images/default-course.jpg') }}" alt="{{ $item->curso->title }}" style="width: 80px; height: 60px; object-fit: cover;">
                                </td>
                                <td class="product-des" data-title="Description">
                                    <p class="product-name">
                                        <a href="{{ route('webacademia.single_course', $item->curso->id) }}">
                                            {{ $item->curso->title }}
                                        </a>
                                    </p>
                                    <p class="product-des">
                                        {{ Str::limit($item->curso->description, 100) }}
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
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este curso del carrito?')">
                                            <i class="ti-trash remove-icon"></i>
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
                                        <a href="{{ route('webacademia.courses') }}" class="btn_one mt-3">Ver Cursos</a>
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
                                            <button type="submit" class="btn btn-outline-danger" onclick="return confirm('¿Estás seguro de vaciar todo el carrito?')">
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
                                            <button type="submit" class="btn_one">Proceder al Pago</button>
                                        </form>
                                        <a href="{{ route('webacademia.courses') }}" class="btn_two">Seguir Comprando</a>
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
