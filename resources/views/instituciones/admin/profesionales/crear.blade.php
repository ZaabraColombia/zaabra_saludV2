@extends('instituciones.admin.layouts.layout')

@section('styles')
    <link rel="stylesheet" href="{{ asset('public/plugins/select2/css/select2.min.css') }}">
@endsection

@section('contenido')
<div class="container-fluid p-0 pr-lg-4">
    <div class="containt_agendaProf">
        <div class="my-4 my-xl-5">
            <h1 class="title__xl blue_bold">Profesionales</h1>
        </div>

        <div class="containt_main_table mb-3">
            <div class="row m-0 my-4 justify-content-center">
                <div class="col-12 col-lg-4 mb-3 mb-lg-0">
                    <div class="img__upload">
                        <img id="imagen-foto" src="{{ asset('img/menu/avatar.png') }}">
                        <input type="file" name="foto"  id="foto" accept="image/png, image/jpeg" value="" />
                        <p>Subir foto de perfil</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 input__box">
                    <label for="primer_nombre">Primer nombre</label>
                    <input type="text" id="primer_nombre" name="primer_nombre" value="{{ old('primer_nombre') }}" />
                </div>

                <div class="col-md-3 input__box">
                    <label for="segundo_nombre">Segundo nombre</label>
                    <input type="text" id="segundo_nombre" name="segundo_nombre" value="{{ old('segundo_nombre') }}" />
                </div>

                <div class="col-md-3 input__box">
                    <label for="primer_apellido">Primer apellido</label>
                    <input type="text" id="primer_apellido" name="primer_apellido" value="{{ old('primer_apellido') }}" />
                </div>

                <div class="col-md-3 input__box">
                    <label for="segundo_apellido">Segundo apellido</label>
                    <input type="text" id="segundo_apellido" name="segundo_apellido" value="{{ old('segundo_apellido') }}" />
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 input__box">
                    <label for="tipo_documento_id">Tipo de documento</label>
                    <select type="text" id="tipo_documento_id" name="tipo_documento_id" >
                        @foreach($tipo_documentos as $tipo)
                            <option value="{{ $tipo->id }}" {{ old('tipo_documento_id') == $tipo->id? 'selected':'' }}>{{ $tipo->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4 input__box">
                    <label for="numero_documento">Número de documento</label>
                    <input type="text" id="numero_documento" name="numero_documento" value="{{ old('numero_documento') }}" />
                </div>

                <div class="col-md-4 input__box">
                    <label for="fecha_nacimiento">Fecha de nacimiento</label>
                    <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}" />
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 input__box">
                    <label for="direccion">Dirección</label>
                    <input type="text" id="direccion" name="direccion" value="{{ old('direccion') }}" />
                </div>

                <div class="col-md-4 input__box">
                    <label for="telefono">Teléfono</label>
                    <input type="text" id="telefono" name="telefono" value="{{ old('telefono') }}" />
                </div>

                <div class="col-md-4 input__box">
                    <label for="celular">Móvil</label>
                    <input type="text" id="celular" name="celular" value="{{ old('celular') }}" />
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 input__box">
                    <label for="ciudad_id">Ciudad</label>
                    <input type="text" id="ciudad_id" name="ciudad_id" value="{{ old('ciudad_id') }}" />
                </div>

                <div class="col-md-6 p-0 pl-md-1">     <!--menu dinamico ciudades -->
                    <label for="pais_id">País</label>
                    <select id="pais_id" name="pais_id" class="input_box_form">
                    </select>
                </div>

                <div class="col-md-6 p-0 pr-md-1">
                    <label for="departamento_id">Departamento</label>
                    <select name="departamento_id" id="departamento_id" >
                    </select>
                </div>

                <div class="col-md-6 p-0 pl-md-1">
                    <label for="provincia_id">Seleccione provincia</label>
                    <select name="provincia_id" id="provincia_id">
                    </select>
                </div>

                <div class="col-md-6 p-0 pr-md-1">
                    <label for="ciudad_id">Ciudad</label>
                    <select name="ciudad_id" id="ciudad_id">
                    </select>
                </div>

                <div class="col-md-4 input__box">
                    <label for="correo">Correo electrónico</label>
                    <input type="email" id="correo" name="correo" value="{{ old('correo') }}" />
                </div>

                <div class="col-md-4 input__box">
                    <label for="sitio_web">Sitio web</label>
                    <input type="text" id="sitio_web" name="sitio_web" value="{{ old('sitio_web') }}" />
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 input__box">
                    <label for="linkedin">LinkedIn</label>
                    <input type="text" id="linkedin" name="linkedin" value="{{ old('linkedin') }}" />
                </div>

                <div class="col-md-4 input__box">
                    <label for="red_social">Otra red social</label>
                    <input type="text" id="red_social" name="red_social" value="{{ old('red_social') }}" />
                </div>

                <div class="col-md-4 input__box">
                    <label for="rethus">RETHUS</label>
                    <input type="text" id="rethus" name="rethus" value="{{ old('rethus') }}" />
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 input__box">
                    <label for="id_universidad">Universidad</label>
                    <select id="id_universidad" name="id_universidad" class="universidad"></select>
                </div>

                <div class="col-md-4 input__box">
                    <label for="cargo">Cargo</label>
                    <input type="text" id="cargo" name="cargo" value="{{ old('cargo') }}">
                </div>

                <div class="col-md-4 input__box">
                    <label for="numero_profesional">Tarjeta profesional</label>
                    <input type="text" id="numero_profesional" name="numero_profesional" value="{{ old('numero_profesional') }}">
                </div>

                <div class="col-md-4 input__box">
                    <label for="id_especialidad">Especialidad principal</label>
                    <select type="text" id="id_especialidad" name="id_especialidad">
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-12 input__box">
                    <label for="especialidades">Otras especialidades</label>
                    <select type="text" id="especialidades" name="especialidades">
                    </select>
                </div>
            </div>

            <!-- Buttons -->
            <div class="row m-0 mt-2 content_btn_right">
                <button type="submit" class="button_transparent mr-2">Cancelar</button>
                <button type="submit" class="button_blue">Guardar</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="{{ asset('select2\js\select2.min.js') }}"></script>

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

    <script>
        $('.select').select2();
    </script>
@endsection
