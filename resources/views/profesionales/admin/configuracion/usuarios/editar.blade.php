@extends('profesionales.admin.layouts.panel')

@section('styles')
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2-bootstrap4.min.css') }}">

@endsection

@section('contenido')
    <div class="container-fluid p-0 pr-lg-4">
        <div class="containt_agendaProf">
            <div class="my-4 my-xl-5">
                <h1 class="title__xl blue_bold">Usuarios</h1>
            </div>


            <div class="containt_main_table mb-3">
                <form action="{{ route('profesional.configuracion.usuarios.update', ['usuario' => $user->id]) }}" method="post"
                      id="form-usuario-crear" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="d-block d-md-flex justify-content-between py-3">
                        <h2 class="subtitle__lg blue_bold mb-4">Editar usuario</h2>
                        <!-- Check box interactivo y personalizado -->
                        <div class="checkbox__blue">
                            <input type="checkbox" name="estado" id="estado" value="1"
                                {{ old('estado', $user->estado) == 1 ? 'checked':'' }}>
                            <label class="label_check__blue" for="estado">
                                <b class="txt1">Usuario inactivo</b>
                                <b class="txt2">Usuario activo</b>
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        @if($errors->any())
                            <div class="col-12">
                                <div class="alert alert-danger" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <h4 class="alert-heading">Error!</h4>
                                    <ul>
                                        <li>{!! collect($errors->all())->implode('</li><li>') !!}</li>
                                    </ul>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="row">
                        <div class="col-md-3 input__box">
                            <label for="primer_nombre">Primer nombre</label>
                            <input type="text" id="primer_nombre" name="primer_nombre" value="{{ old('primer_nombre', $user->primernombre) }}"
                                   class="@error('primer_nombre') is-invalid @enderror" required/>
                        </div>

                        <div class="col-md-3 input__box">
                            <label for="segundo_nombre">Segundo nombre</label>
                            <input type="text" id="segundo_nombre" name="segundo_nombre" value="{{ old('segundo_nombre', $user->segundonombre) }}"
                                   class="@error('segundo_nombre') is-invalid @enderror"/>
                        </div>

                        <div class="col-md-3 input__box">
                            <label for="primer_apellido">Primer apellido</label>
                            <input type="text" id="primer_apellido" name="primer_apellido" value="{{ old('primer_apellido', $user->primerapellido) }}"
                                   class="@error('primer_apellido') is-invalid @enderror" required/>
                        </div>

                        <div class="col-md-3 input__box">
                            <label for="segundo_apellido">Segundo apellido</label>
                            <input type="text" id="segundo_apellido" name="segundo_apellido" value="{{ old('segundo_apellido', $user->segundoapellido) }}"
                                   class="@error('segundo_apellido') is-invalid @enderror" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 input__box">
                            <label for="tipo_documento">Tipo de identificaci??n</label>
                            <select class="@error('tipo_documento') is-invalid @enderror" id="tipo_documento"
                                    name="tipo_documento" value="{{ old('tipo_documento') }}" required>
                                @if($tipo_documentos->isNotEmpty())
                                    @foreach($tipo_documentos as $tipo_documento)
                                        <option value="{{ $tipo_documento->id }}" {{ old('tipo_documento', $user->tipodocumento) == $tipo_documento->id ? 'selected':'' }}>{{ $tipo_documento->nombre }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="col-md-6 input__box">
                            <label for="numero_documento">N??mero de identificaci??n</label>
                            <input type="text" id="numero_documento" name="numero_documento" value="{{ old('numero_documento', $user->numerodocumento) }}"
                                class="@error('numero_documento') is-invalid @enderror" required/>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 input__box">
                            <label for="fecha_nacimiento">Fecha de nacimiento</label>
                            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" value="{{ old('fecha_nacimiento', $user->auxiliar->fecha_nacimiento) }}"
                                class="@error('fecha_nacimiento') is-invalid @enderror" required/>
                        </div>

                        <div class="col-md-4 input__box">
                            <label for="direccion">Direcci??n</label>
                            <input type="text" id="direccion" name="direccion" value="{{ old('direccion', $user->auxiliar->direccion) }}"
                                class="@error('direccion') is-invalid @enderror" required/>
                        </div>

                        <div class="col-md-4 input__box">
                            <label for="telefono">Tel??fono</label>
                            <input type="text" id="telefono" name="telefono" value="{{ old('telefono', $user->auxiliar->telefono) }}"
                                class="@error('telefono') is-invalid @enderror" required/>
                        </div>

                        <div class="col-md-4 input__box">
                            <label for="celular">Celular</label>
                            <input type="text" id="celular" name="celular" value="{{ old('celular', $user->auxiliar->celular) }}"
                                   class="@error('celular') is-invalid @enderror" required/>
                        </div>

                        <div class="col-md-4 input__box">
                            <label for="cargo">Cargo</label>
                            <input type="text" id="cargo" name="cargo" value="{{ old('cargo', $user->auxiliar->cargo) }}"
                                   class="@error('cargo') is-invalid @enderror" required/>
                        </div>

                        <div class="col-md-4 input__box">
                            <label for="email">E-mail</label>
                            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                                   class="@error('email') is-invalid @enderror" required/>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-4 input__box">
                            <label for="pais_id">Pa??s</label>
                            <select id="pais_id" name="pais_id" class="select2 pais @error('pais_id') is-invalid @enderror"
                                    data-departamento="#departamento_id" data-provincia="#provincia_id" data-ciudad="#ciudad_id"
                                    data-id="{{ old('pais_id', $user->auxiliar->pais_id) }}" required>
                                @if($paises->isNotEmpty())
                                    @foreach($paises as $pais)
                                        <option value="{{ $pais->id_pais }}" {{ (old('pais_id', $user->auxiliar->pais_id) == $pais->id_pais) ? 'selected':'' }}>{{ $pais->nombre }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="col-md-4 input__box">
                            <label for="departamento_id">Departamento</label>
                            {{-- @dd(old('departamento_id'))--}}
                            <select name="departamento_id" id="departamento_id" class="select2 departamento @error('departamento_id') is-invalid @enderror"
                                    data-provincia="#provincia_id" data-ciudad="#ciudad_id" data-id="{{ old('departamento_id', $user->auxiliar->departamento_id) }}" required>
                            </select>
                        </div>

                        <div class="col-md-4 input__box">
                            <label for="provincia_id">Provincia</label>
                            <select name="provincia_id" id="provincia_id" data-ciudad="#ciudad_id" data-id="{{ old('provincia_id', $user->auxiliar->provincia_id) }}"
                                    class="select2 provincia @error('provincia_id') is-invalid @enderror" required>
                            </select>
                        </div>

                        <div class="col-md-4 input__box">
                            <label for="ciudad_id">Ciudad</label>
                            <select name="ciudad_id" id="ciudad_id" class="select2 @error('ciudad_id') is-invalid @enderror"
                                    data-id="{{ old('ciudad_id', $user->auxiliar->ciudad_id) }}" required>
                            </select>
                        </div>

                    </div>

                    <!-- Linea divisi??n de elementos -->
                    <div class="dropdown-divider my-4"></div>

                    <!-- Accesos del usuario -->
                    <h2 class="subtitle__lg blue_bold mb-4">Permiso a usuario</h2>

                    <div class="row list__form">
                        @if($accesos->isNotEmpty())
                            @foreach($accesos as $acceso)
                                <div class="col-6 col-md-4 check__box_blue">
                                    <input type="checkbox" {{ (collect(old('accesos', $accesosUsuario))->contains($acceso->id)) ? 'checked':'' }}
                                           value="{{ $acceso->id }}" id="acceso-{{ $acceso->id }}" name="accesos[]">
                                    <label class="label_check_blue" for="acceso-{{ $acceso->id }}">{{ $acceso->nombre }}</label>
                                </div>
                            @endforeach
                        @endif
                    </div>

                    <!-- Linea divisi??n de elementos -->
                    <div class="dropdown-divider my-4"></div>

                    <!-- Contrase??a del usuario -->
                    <div class="mb-4">
                        <h2 class="subtitle__lg blue_bold">Contrase??a</h2>
                        <p class="text__md black_light">Crea una contrase??a para el usuario que esta creando.</p>
                    </div>

                    <div class="row">

                        <div class="col-md-6 input__box">
                            <label for="password">Contrase??a</label>
                            <div class="input-group mb-3">
                                <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-primary password" type="button" data-class="primary"
                                            data-password="#password">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 input__box">
                            <label for="password_confirmation">Confirmar contrase??a</label>
                            <div class="input-group mb-3">
                                <input type="password" id="password_confirmation" name="password_confirmation"
                                       class="form-control @error('password_confirmation') is-invalid @enderror">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-primary password" type="button" data-class="primary"
                                            data-password="#password_confirmation">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Buttons -->
                    <div class="row m-0 mt-3 content_btn_right">
                        <a href="{{ route('profesional.configuracion.usuarios.index') }}" class="button_transparent mr-2" style="color: #434343">Cancelar</a>
                        <button type="submit" class="button_blue">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('plugins/tagsinput/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ asset('js/ubicacion.js') }}"></script>
    <script src="{{ asset('js/password.js') }}"></script>

    <script>
        $('#pais_id').trigger('change');
    </script>
@endsection
