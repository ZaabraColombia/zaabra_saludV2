@extends('instituciones.admin.layouts.layout')

@section('styles')
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/tagsinput/bootstrap-tagsinput.css') }}">
    <style>
        .bootstrap-tagsinput{
            width: 100% !important;
        }
    </style>
@endsection

@section('contenido')
    <div class="container-fluid panel_container">
        <div class="panel_container_form">
            <!-- Main title -->
            <div class="mb-4">
                <h1 class="fs_title_module green_bold">Agregar contacto</h1>
            </div>
            <!-- Formulario -->
            <div class="container__main_form">
                <form method="post" id="form-contacto" class="forms" enctype="multipart/form-data">
                    @csrf
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
                    <!-- Imagen de encabezado -->
                    <div class="row m-0 my-4 justify-content-center">
                        <div class="col-12 col-lg-4 mb-3 mb-lg-0">
                            <div class="img__upload">
                                <img id="imagen-foto" src="{{ ('img/menu/avatar.png') }}">
                                <input type="file" name="foto"  id="foto" accept="image/png, image/jpeg" value="">
                                <!-- <p>Subir foto de perfil</p> -->
                            </div>
                        </div>
                    </div>
                    <!-- Subtítulo información Básica -->
                    <div class="my-4">
                        <h2 class="fs_subtitle green_bold">Información Básica</h2>
                    </div>
                    <!-- Data del formulario -->
                    <div class="row">
                        <div class="col-12 input__box">
                            <label for="nombre">Nombre (*)</label>
                            <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}" class="@error('nombre') is-invalid @enderror" required/>
                        </div>

                        <div class="col-md-6 input__box">
                            <label for="tipo_documento_id">Tipo de Documento</label>
                            <select id="tipo_documento_id" name="tipo_documento_id" class="select2 @error('tipo_documento_id') is-invalid @enderror">
                                <option value=""></option>
                                <option value="">option 1</option>
                                <option value="">option 2</option>
                                <option value="">option 3</option>
                            </select>
                        </div>

                        <div class="col-md-6 input__box">
                            <label for="numero_documento">Número de Documento</label>
                            <input type="text" id="numero_documento" name="numero_documento" value="{{ old('numero_documento') }}"
                                    class="@error('numero_documento') is-invalid @enderror"/>
                        </div>
                    </div>
                    <!-- Subtítulo información de Contacto -->
                    <div class="my-4">
                        <h2 class="fs_subtitle green_bold">Información de Contacto</h2>
                    </div>
                    <!-- Data del formulario -->
                    <div class="row">
                        <div class="col-md-4 input__box">
                            <label for="correo">Correo electrónico</label>
                            <input type="email" id="correo" name="correo" value="{{ old('correo') }}"
                                class="@error('primer_nombre') is-invalid @enderror"/>
                        </div>

                        <div class="col-md-4 input__box">
                            <label for="telefono">Teléfono 1</label>
                            <input type="text" id="telefono" name="telefono" value="{{ old('telefono') }}"
                                class="tags-input @error('telefono') is-invalid @enderror"/>
                        </div>

                        <div class="col-md-4 input__box">
                            <label for="celular">Teléfono 2</label>
                            <input type="text" id="celular" name="celular" value="{{ old('celular') }}"
                                class="tags-input @error('celular') is-invalid @enderror"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 input__box">
                            <label for="ciudad">Ciudad / Municipio de Residencia</label>
                            <input type="text" id="ciudad" name="ciudad" value="{{ old('ciudad') }}"
                                class="@error('ciudad') is-invalid @enderror"/>
                        </div>

                        <div class="col-md-6 input__box">
                            <label for="direccion">Dirección</label>
                            <input type="text" id="direccion" name="direccion" value="{{ old('direccion') }}"
                            class="@error('direccion') is-invalid @enderror"/>
                        </div>

                        <div class="col-md-6 input__box">
                            <label for="dependencia">Dependencia</label>
                            <input type="text" id="dependencia" name="dependencia" value="{{ old('dependencia') }}"
                            class="@error('dependencia') is-invalid @enderror"/>
                        </div>

                        <div class="col-md-6 input__box">
                            <label for="tipo">Tipo Contacto</label>
                            <select type="email" id="tipo" name="tipo" value="{{ old('tipo') }}"
                                class="@error('dependencia') is-invalid @enderror">
                                <option></option>
                                <option value="proveedor">Proveedor</option>
                                <option value="paciente">Paciente</option>
                                <option value="otro">Otro</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 input__box">
                            <label for="banco">Banco</label>
                            <input type="text" id="banco" name="banco" value="{{ old('banco') }}"
                            class="@error('banco') is-invalid @enderror"/>
                        </div>
                        
                        <div class="col-md-6 input__box">
                            <label for="tipo_cuenta">Tipo de cuenta bancaria</label>
                            <select type="email" id="tipo_cuenta" name="tipo_cuenta" value="{{ old('tipo_cuenta') }}"
                            class="@error('tipo_cuenta') is-invalid @enderror">
                                <option></option>
                                <option value="ahorro">Ahorro</option>
                                <option value="corriente">Corriente</option>
                            </select>
                        </div>

                        <div class="col-md-6 input__box">
                            <label for="numero_cuenta">N° de Cuenta bancaria</label>
                            <input type="text" id="numero_cuenta" name="numero_cuenta" value="{{ old('numero_cuenta') }}"
                            class="@error('numero_cuenta') is-invalid @enderror">
                        </div>

                        <div class="col-12 input__box">
                            <label for="observacion">Observación</label>
                            <textarea name="observacion" id="observacion" rows="5"></textarea>
                        </div>
                    </div>
                    <!-- Botones inferiores -->
                    <div class="row m-0 my-4 content_btn_center">
                        <a href="{{ route('institucion.profesionales.index') }}" class="button__form_transparent mr-3">Cancelar</a>
                        <button type="submit" class="button__form_green">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('plugins/tagsinput/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ asset('js/password.js') }}"></script>

    <!-- Script para cargar, subir y visualizar la imagen principal -->
    <script>
        // Obtener referencia al input y a la imagen
        const $seleccionArchivos = document.querySelector("#foto"),
            $imagenPrevisualizacion = document.querySelector("#imagen-foto");

        // Escuchar cuando cambie
        $seleccionArchivos.addEventListener("change", () => {
            // Los archivos seleccionados, pueden ser muchos o uno
            const archivos = $seleccionArchivos.files;
            // Si no hay archivos salimos de la función y quitamos la imagen
            if (!archivos || !archivos.length) {
                $imagenPrevisualizacion.src = "";
                return;
            }
            // Ahora tomamos el primer archivo, el cual vamos a previsualizar
            const primerArchivo = archivos[0];
            // Lo convertimos a un objeto de tipo objectURL
            const objectURL = URL.createObjectURL(primerArchivo);
            // Y a la fuente de la imagen le ponemos el objectURL
            $imagenPrevisualizacion.src = objectURL;
        });
    </script>
@endsection
