@extends('webacademia.layouts.web_layout')

@section('title', 'Registro')

@section('css')
@endsection

@section('content')

<!-- START SECTION TOP -->
<section class="section-top">
    <div class="container">
        <div class="col-lg-10 offset-lg-1 text-center">
            <div class="section-top-title wow fadeInRight">
                <h1>Registro</h1>
            </div>
        </div>
    </div>
</section>
<!-- END SECTION TOP -->

<!-- START LOGIN AND REGISTER -->
<section class="login_register section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 col-xs-12">
                <div class="register">
                    <h4 class="login_register_title">Crear nueva cuenta</h4>

                    <form method="POST" action="{{ route('webacademia.register') }}">
                        @csrf
                        <div class="form-group">
                            <label for="username">Usuario</label>
                            <input type="text" class="form-control input-label mb-1" name="username" value="{{ old('username') }}" required>
                            @error('username')
                                <div class="alert alert-danger">
                                    <ul class="mt-0">
                                        <li>{{ $message }}</li>
                                    </ul>
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input type="text" class="form-control input-label mb-1" name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="alert alert-danger">
                                    <ul class="mt-0">
                                        <li>{{ $message }}</li>
                                    </ul>
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="surname">Apellidos</label>
                            <input type="text" class="form-control input-label mb-1" name="surname" value="{{ old('surname') }}" required>
                            @error('surname')
                                <div class="alert alert-danger">
                                    <ul class="mt-0">
                                        <li>{{ $message }}</li>
                                    </ul>
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control input-label mb-1" name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="alert alert-danger">
                                    <ul class="mt-0">
                                        <li>{{ $message }}</li>
                                    </ul>
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">Contraseña</label>
                            <input type="password" class="form-control input-label mb-1" name="password" required>
                            @error('password')
                                <div class="alert alert-danger">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>

                        <div class="form-group col-lg-12">
                            <button class="btn_one" type="submit">Registrar</button>
                        </div>

                        <p>¿Ya tienes cuenta? <a href="/weblogin">Iniciar Sesión</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END LOGIN AND REGISTER -->

@endsection
