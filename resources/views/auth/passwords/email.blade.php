@extends('layouts.app')

@section('content')
<!-- Contenedor principal -->
<div class="container-fluid contenedorPrin_email">
    <!-- Fila principal -->
    <div class="row justify-content-center">

        <!-- contenedor de elementos login -->
        <div class="card col-11 col-md-10 col-lg-8 section_principal-email">
            <!-- seccion body login -->
            <div class="card-body section_body-email">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="form-group row">
                        <!-- Titulo interno de la tarjeta email -->
                        <h3 class="titulo_superior-tarjeta-email"> Restaurar Contraseña </h3>
                        <!-- titulo principal -->
                        <p class="titulo_principal-email"> Ingrese su correo electrónico. Le enviaremos las instrucciones para recuperar su contraseña. </p>
                        <!-- Campo de Correo Electrónico -->
                        <div class="col-md-12">
                            <label for="email" class="col-md-12 pl-0 col-form-label texto_label-email">{{ __('Correo Electrónico') }}</label>
                            <input id="email" type="email" class="form-control input_height-fullhd-email input_text-email @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="servicioalcliente@zaabrasalud.co">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <!-- Botón Ingresar -->
                    <div class="form-group row mb-2 mb-md-0">
                        <div class="col-12 content_btn-enviar-email">
                            <button type="submit" class="btn_Ingreso-email"> {{ __('Enviar') }}
                                <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flecha_ingreso-email" alt="">
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
