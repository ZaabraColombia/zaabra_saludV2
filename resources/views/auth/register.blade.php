@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card ">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div id="persona">
                            <div class="form-check">
                                    <input class="form-check-input" type="radio" name="idrol" id="idrol" value="1" checked>
                                    <label class="form-check-label" for="idrol">
                                    Soy paciente
                                    </label>
                                    </div>
                                    <div class="form-check">
                                    <input class="form-check-input" type="radio" name="idrol" id="idrol" value="3">
                                    <label class="form-check-label" for="idrol">
                                        Soy medico
                                    </label>
                                    </div>
                                    <div class="form-check">
                                    <input class="form-check-input" type="radio" name="idrol" id="idrol" value="3">
                                    <label class="form-check-label" for="idrol">
                                        Soy Instituciones
                                    </label>
                            </div>
                        <div class="form-group row">
                            <label for="primernombre" class="col-md-4 col-form-label text-md-right">{{ __('primer nombre') }}</label>

                            <div class="col-md-6">
                                <input id="primernombre" type="text" class="form-control @error('primernombre') is-invalid @enderror" name="primernombre" value="{{ old('primernombre') }}" required autocomplete="primernombre" autofocus>

                                @error('primernombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="segundonombre" class="col-md-4 col-form-label text-md-right">{{ __('Segundo nombre') }}</label>

                            <div class="col-md-6">
                                <input id="segundonombre" type="text" class="form-control @error('segundonombre') is-invalid @enderror" name="segundonombre" value="{{ old('segundonombre') }}"  autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="primerapellido" class="col-md-4 col-form-label text-md-right">{{ __('Primer Apellido') }}</label>

                            <div class="col-md-6">
                                <input id="primerapellido" type="text" class="form-control @error('primerapellido') is-invalid @enderror" name="primerapellido" value="{{ old('primerapellido') }}" required autocomplete="primerapellido" autofocus>

                                @error('primerapellido')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="segundoapellido" class="col-md-4 col-form-label text-md-right">{{ __('Segundo Apellido') }}</label>

                            <div class="col-md-6">
                                <input id="segundoapellido" type="text" class="form-control @error('segundoapellido') is-invalid @enderror" name="segundoapellido" value="{{ old('segundoapellido') }}" autofocus>
                            </div>
                        </div>
                    </div>
                    <div id="institucion">
                        <div class="form-group row">
                            <label for="nombreinstitucion" class="col-md-4 col-form-label text-md-right">{{ __('Nombre Institucion') }}</label>

                            <div class="col-md-6">
                                <input id="nombreinstitucion" type="text" class="form-control @error('nombreinstitucion') is-invalid @enderror" name="nombreinstitucion" value="{{ old('nombreinstitucion') }}" autofocus>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tipodocumento" class="col-md-4 col-form-label text-md-right">{{ __('Tipo Documento') }}</label>
                            <select class="form-select" name="tipodocumento" required>
                                <option selected>Seleccione</option>
                                <option value="1">Cedula Ciudadania</option>
                                <option value="2">Cedula Extranjeria </option>
                                <option value="3">Cedula Extranjeria </option>
                                <option value="4">Nit </option>
                            </select>
                            
                    </div>
                    <div class="form-group row">
                            <label for="numerodocumento" class="col-md-4 col-form-label text-md-right">{{ __('Numero Documento') }}</label>

                            <div class="col-md-6">
                                <input id="numerodocumento" type="number" class="form-control @error('numerodocumento') is-invalid @enderror" name="numerodocumento" value="{{ old('numerodocumento') }}" required autocomplete="numerodocumento" autofocus>

                                @error('numerodocumento')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
