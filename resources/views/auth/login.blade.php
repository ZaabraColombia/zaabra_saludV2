@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <p class="titulo_principal-login"> Ingrese con su correo o regístrese y haga parte de Zaabra salud. </p>
        <div class="col-md-8">
            <div class="card section_principal-login">

                <div class="row card-header section_btns-login">
                    <button class="col-6 btn_iniciar-login"> Iniciar Sesión </button>
                    <button class="col-6 btn_registro-login"> Registrarse </button>
                </div>

                <div class="card-body section_body-login">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group row mb-0">
                            <label for="email" class="col-md-4 col-form-label texto_label-login"> Correo Electrónico </label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label texto_label-login"> Contraseña </label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn_Ingreso-login"> Ingresar
                                    <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flecha_ingreso-login" alt=""> 
                                </button>
                                    
                                @if (Route::has('password.request'))
                                    <a class="btn texto_olvide-login" href="{{ route('password.request') }}">
                                        Olvidé mi contraseña
                                    </a>
                                @endif
                            </div>
                        </div>

                        <p class="texto_inferior-login"> Ingresa con tus redes sociales </p>
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
            </div>
        </div>
    </div>
</div>
@endsection
