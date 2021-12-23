@extends('layouts.app')

@section('content')
<div class="container-fluid" style="background: #F9F9F9">
    <div class="contenedor_tarjeta">
        <div class="w-100 mb-3">
            <h1 class="titulo_principal"> Restaurar Contraseña </h1>
        </div>

        <div class="card tarjeta_principal">
            <div class="card-body pt-4 pb-5 pt-md-5">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf        
                    <p class="texto_label text-left font-weight-light mb-4"> Ingrese su correo electrónico. Le enviaremos las instrucciones para recuperar su contraseña. </p>
                    
                    <div class="mb-3">
                        <label for="email" class="texto_label">{{ __('Correo Electrónico') }}</label>
                        <input id="email" type="email" class="input_form @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="servicioalcliente@zaabrasalud.co">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Botón Ingresar -->
                    <div class="seccion_btn_central m-0">
                        <button type="submit" class="btn_grande_central_azul px-4"> {{ __('Enviar') }}
                            <i class="fas fa-arrow-right pl-1"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
