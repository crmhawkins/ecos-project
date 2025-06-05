@extends('webacademia.layouts.web_layout')

@section('title', 'Login')

@section('css')
@endsection

@section('content')

<!-- START SECTION TOP -->
<section class="section-top">
    <div class="container">
        <div class="col-lg-10 offset-lg-1 text-center">
            <div class="section-top-title wow fadeInRight">
                <h1>Inicio de Sesión</h1>
            </div>
        </div>
    </div>
</section>
<!-- END SECTION TOP -->

<!-- START LOGIN -->
<section class="login_register section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 col-xs-12">
                <div class="login">
                    <h4 class="login_register_title">Iniciar Sesión</h4>

                    <form method="POST" action="{{ route('webacademia.login') }}">
                        @csrf
                        <div class="form-group">
                            <label for="email">Correo electrónico</label>
                            <input type="email" class="form-control input-label" name="email" value="{{ old('email') }}" required>
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
                            <input type="password" class="form-control input-label" name="password" required>
                            @error('password')
                                <div class="alert alert-danger">
                                    <ul class="mt-0">
                                        <li>{{ $message }}</li>
                                    </ul>
                                </div>
                            @enderror
                        </div>

                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" name="remember" id="remember">
                            <label class="form-check-label" for="remember">Recordarme</label>
                        </div>

                        <div class="form-group col-lg-12">
                            <button class="btn_one" type="submit">Iniciar Sesión</button>
                        </div>

                        <p>¿No tienes cuenta? <a href="/webregister">Regístrate</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END LOGIN -->

@endsection

@section('scripts')
@endsection
