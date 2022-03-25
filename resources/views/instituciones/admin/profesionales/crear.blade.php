@extends('instituciones.admin.layouts.layout')

@section('styles')
    <link rel="stylesheet" href="{{ asset('plugins/DataTables/datatables.min.css') }}">
    <style>
        /* .dataTables_filter, .dataTables_info { display: none;!important; } */
    </style>
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
                        <img id="imagen-foto" src="">
                        <input type="file" name="foto"  id="foto" accept="image/png, image/jpeg" value="">
                        <p>Subir foto de perfil</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 input__box">
                    <label for="pr_nombre">Primer nombre</label>
                    <input type="text" id="pr_nombre" name="pr_nombre" value="">
                </div>

                <div class="col-md-3 input__box">
                    <label for="sg_nombre">Segundo nombre</label>
                    <input type="text" id="sg_nombre" name="sg_nombre" value="">
                </div>

                <div class="col-md-3 input__box">
                    <label for="pr_apellido">Primer apellido</label>
                    <input type="text" id="pr_apellido" name="pr_apellido" value="">
                </div>

                <div class="col-md-3 input__box">
                    <label for="sg_apellido">Segundo apellido</label>
                    <input type="text" id="sg_apellido" name="sg_apellido" value="">
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 input__box">
                    <label for="tp_documento">Tipo de documento</label>
                    <select type="text" id="tp_documento" name="tp_documento">
                        <option></option>
                        <option value="Cédula de ciudadanía">Cédula de ciudadanía</option>
                        <option value="Cedula extranjera">Cedula extranjera</option>
                        <option value="otro">Otro</option>
                    </select>
                </div>

                <div class="col-md-4 input__box">
                    <label for="num_documento">Número de documento</label>
                    <input type="text" id="num_documento" name="num_documento" value="">
                </div>

                <div class="col-md-4 input__box">
                    <label for="fec_nacimiento">Fecha de nacimiento</label>
                    <input type="date" id="fec_nacimiento" name="fec_nacimiento" value="">
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 input__box">
                    <label for="direccion">Dirección</label>
                    <input type="text" id="direccion" name="direccion" value="">
                </div>

                <div class="col-md-4 input__box">
                    <label for="Telefono">Teléfono</label>
                    <input type="text" id="Telefono" name="Telefono" value="">
                </div>

                <div class="col-md-4 input__box">
                    <label for="movil">Móvil</label>
                    <input type="text" id="movil" name="movil" value="">
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 input__box">
                    <label for="ciudad">Ciudad</label>
                    <input type="text" id="ciudad" name="ciudad" value="">
                </div>

                <div class="col-md-4 input__box">
                    <label for="correo">Correo electrónico</label>
                    <input type="mail" id="correo" name="correo" value="">
                </div>

                <div class="col-md-4 input__box">
                    <label for="web">Sitio web</label>
                    <input type="text" id="web" name="web" value="">
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 input__box">
                    <label for="linkedin">LinkedIn</label>
                    <input type="text" id="linkedin" name="linkedin" value="">
                </div>

                <div class="col-md-4 input__box">
                    <label for="otra_red">Otra red social</label>
                    <input type="text" id="otra_red" name="otra_red" value="">
                </div>

                <div class="col-md-4 input__box">
                    <label for="rethus">RETHUS</label>
                    <input type="text" id="rethus" name="rethus" value="">
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 input__box">
                    <label for="universidad">Universidad</label>
                    <input type="text" id="universidad" name="universidad" value="">
                </div>

                <div class="col-md-4 input__box">
                    <label for="tarj_profesional">Tarjeta profesional</label>
                    <input type="text" id="tarj_profesional" name="tarj_profesional" value="">
                </div>

                <div class="col-md-4 input__box">
                    <label for="prin_especialidad">Especialidad principal</label>
                    <input type="text" id="prin_especialidad" name="prin_especialidad" value="">
                </div>
            </div>

            <div class="row">
                <div class="col-12 input__box">
                    <label for="otra_especialida">Otras especialidades</label>
                    <select type="text" id="otra_especialida" name="otra_especialida">
                        <option></option>
                        <option value="especialidad">especialidad</option>
                        <option value="especialidad">especialidad</option>
                        <option value="especialidad">especialidad</option>
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
    <script src="{{ asset('plugins/DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('js/alertas.js') }}"></script>

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