@extends('layouts.app')

@section('content')

<!-- contenedor principal -->
<div class="container-fluid contenedorPrin_login">
    <!-- fila principal -->
    <div class="row justify-content-center">
        <!-- titulo principal -->
        <h1 class="titulo_principal-login"> Acceda a nuestro portal de Zaabra Salud o regístrese. </h1>
        <!-- contenedor de elementos login -->
        <div class="card col-11 col-md-10 col-lg-8 section_principal-login">
            <!-- seccion body login -->
            <div class="card-body section_body-login">
                <form method="POST" action="{{ route('login') }}">
                    <!-- seccion iniciar sesion y creaar cuenta -->
                    <div class="row card-header content_iniciar-crear">
                        <div class="col-6 section_texto-iniciar">
                            <a> Iniciar Sesión </a>
                        </div>

                        <div class="col-6 section_texto-crear">
                            <a href="{{ route('register') }}" class="texto_crear-login"> Crear Cuenta </a>
                        </div>
                    </div>
                    @csrf
                    <!-- seccion correo electronico -->
                    <div class="form-group row mt-4 mb-0">
                        <label for="email" class="col-md-12 col-form-label texto_label-login"> Correo Electrónico </label>

                        <div class="col-12">
                            <input id="email" type="email" class="form-control input_height-fullhd @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="servicioalcliente@zaabrasalud.co">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <!-- seccion contraseña -->
                    <div class="form-group row mb-3">
                        <label for="password" class="col-md-12 col-form-label texto_label-login"> Contraseña </label>

                        <div class="col-12">
                            <input id="password" type="password" class="form-control input_height-fullhd @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Contraseña">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <!-- seccion boton ingresar -->
                    <div class="form-group row mb-0">
                        <div class="col-12 content_btn-ingresar-login">
                            <button type="submit" class="btn_Ingreso-login"> Ingresar
                                <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flecha_ingreso-login" alt="">
                            </button>

                            @if (Route::has('password.request'))
                                <a class="texto_olvide-login" href="{{ route('password.request') }}">
                                    Olvidé mi contraseña
                                </a>
                            @endif
                        </div>
                    </div>
                    <!-- <div class="form-group row">
                        <div class="col-md-6 offset-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                    </div> -->
                </form>
            </div>

            <!-- seccion pie de pagina login -->
            <div class="card-footer content_pie-login">
                <!-- texto pie de pagina -->
                <p class="col-4 col-md-2 texto_inferior-login">  o ingrese con  </p>
                <!-- seccion iconos redes sociales -->
                <div class="col-4 col-md-3 content_imgRedes-login">
                    <a class="" href="{{ route('facebook-redirect') }}">
                        <img class="img_redes-login" src="{{ asset('/img/iconos/icono-facebook.svg') }}">
                    </a>
                    <a class="" href="{{ route('google-redirect') }}">
                        <img class="img_redes-login" src="{{ asset('/img/iconos/icono-gmail.svg') }}">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
