@extends('layouts.app')

@section('content')

    <div class="container-fluid" style="background: #F9F9F9">
        <div class="row justify-content-center py-4 py-md-5">
            <div class="w-100">
                <h1 class="titulo_h1"> Acceda a nuestro portal de Zaabra Salud @if(!request()->routeIs('institucion.profesional.login'))<br>o regístrese @endif</h1>
            </div>

            <div class="card tarjeta_principal">
                @if(!request()->routeIs('institucion.profesional.login'))
                    <div class="card-header tarjeta_header">
                        <div class="seccion_activa">
                            <h2 class="titulo_h2">Iniciar Sesión</h2>
                        </div>

                        <div class="seccion_inactiva">
                            <a href="{{ route('register') }}">
                                <h2 class="titulo_h2" style="color: #D1D1D1">Crear Cuenta</h2>
                            </a>
                        </div>
                    </div>
                @endif

                <div class="card-body pt-md-5 pb-md-4">
                    <form method="POST" action="{{ (request()->routeIs('institucion.profesional.login')) ? route('institucion.profesional.login'):route('login') }}">
                        @csrf
                        @if(request()->routeIs('institucion.profesional.login'))
                            <div class="mb-3">
                                <label for="correo" class="texto_label"> Correo Electrónico </label>

                                <input id="correo" type="email" class="input_form @error('correo') is-invalid @enderror"
                                       name="correo" value="{{ old('correo') }}" required
                                       autocomplete="correo" autofocus placeholder="servicioalcliente@zaabrasalud.co">
                                @error('correo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        @else
                            <div class="mb-3">
                                <label for="email" class="texto_label"> Correo Electrónico </label>

                                <input id="email" type="email" class="input_form @error('email') is-invalid @enderror"
                                       name="email" value="{{ old('email') }}" required autocomplete="email"
                                       autofocus placeholder="servicioalcliente@zaabrasalud.co">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        @endif

                        <div class="mb-3">
                            <label for="password" class="texto_label"> Contraseña </label>

                            <input id="password" type="password" class="input_form @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Contraseña">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="seccion_btn_central m-0">
                            <button type="submit" class="btn_grande_central_azul px-4"> Ingresar
                                <i class="fas fa-arrow-right pl-1"></i>
                            </button>
                        </div>

                        @if(!request()->routeIs('institucion.profesional.login'))
                            @if (Route::has('password.request'))
                                <a class="texto_href" href="{{ route('password.request') }}">
                                    Olvidé mi contraseña
                                </a>
                            @endif
                            {{-- <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember"
                                               id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div> --}}
                        @endif
                    </form>
                </div>

                @if(!request()->routeIs('institucion.profesional.login'))
                    <div class="card-footer seccion_redes_sociales">
                        <p class="texto_flotante">  o ingrese con  </p>

                        <div class="contenedor_icono_red">
                            <a class="contenido_icono" href="{{ route('facebook-redirect') }}">
                                <img style="width: 100%" src="{{ asset('/img/iconos/icono-facebook.svg') }}">
                            </a>
                            <a class="contenido_icono" href="{{ route('google-redirect') }}">
                                <img style="width: 100%" src="{{ asset('/img/iconos/icono-gmail.svg') }}">
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
