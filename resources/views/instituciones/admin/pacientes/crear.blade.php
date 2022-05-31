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
    <div class="container-fluid px-3 px-md-5 pt-5 left_alignment">
        <div class="mb-4 mb-xl-5">
            <h1 class="fs_title_module green_bold">Agregar Paciente</h1>
        </div>

        <div class="container__main_form">
            <form action="" method="post" id="" enctype="multipart/form-data">
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

                <div class="row m-0 my-4 justify-content-center">
                    <div class="col-12 col-lg-4 mb-3 mb-lg-0">
                        <div class="img__upload">
                            <img id="imagen-foto" src="{{ asset('img/menu/avatar.png') }}">
                            <input type="file" name="foto"  id="foto" accept="image/png, image/jpeg" />
                        </div>
                    </div>
                </div>

                <!-- Información Básica -->
                <div class="my-4">
                    <h2 class="fs_subtitle green_bold">Información Básica</h2>
                </div>

                <div class="row">
                    <div class="col-md-6 input__box">
                        <label for="primer_nombre">Primer Nombre</label>
                        <input type="text" id="primer_nombre" name="primer_nombre" value="{{ old('primer_nombre') }}"
                                class="@error('primer_nombre') is-invalid @enderror"/>
                    </div>

                    <div class="col-md-6 input__box">
                        <label for="segundo_nombre">Segundo Nombre</label>
                        <input type="text" id="segundo_nombre" name="segundo_nombre" value="{{ old('segundo_nombre') }}"
                                class="@error('segundo_nombre') is-invalid @enderror"/>
                    </div>

                    <div class="col-md-6 input__box">
                        <label for="primer_apellido">Primer Apellido</label>
                        <input type="text" id="primer_apellido" name="primer_apellido" value="{{ old('primer_apellido') }}"
                                class="@error('primer_apellido') is-invalid @enderror"/>
                    </div>

                    <div class="col-md-6 input__box">
                        <label for="segundo_apellido">Segundo Apellido</label>
                        <input type="text" id="segundo_apellido" name="segundo_apellido" value="{{ old('segundo_apellido') }}"
                                class="@error('segundo_apellido') is-invalid @enderror"/>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 input__box">
                        <label for="tipo_documento">Tipo de Documento</label>
                        <select id="tipo_documento" name="tipo_documento" class="select2 @error('tipo_documento') is-invalid @enderror">
                            <option value=""></option>
                            <option value="">opción 1</option>
                            <option value="">opción 2</option>
                            <option value="">opción 3</option>
                        </select>
                    </div>

                    <div class="col-md-4 input__box">
                        <label for="numero_documento">Número de Documento</label>
                        <input type="text" id="numero_documento" name="numero_documento" value="{{ old('numero_documento') }}"
                                class="@error('numero_documento') is-invalid @enderror"/>
                    </div>

                    <div class="col-md-4 input__box">
                        <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                        <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}"
                                class="@error('fecha_nacimiento') is-invalid @enderror"/>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 input__box">
                        <label for="sexo_biologico">Sexo Biológico</label>
                        <select id="sexo_biologico" name="sexo_biologico" class="select2 @error('sexo_biologico') is-invalid @enderror">
                            <option value=""></option>
                            <option value="">opción 1</option>
                            <option value="">opción 2</option>
                            <option value="">opción 3</option>
                        </select>
                    </div>

                    <div class="col-md-4 input__box">
                        <label for="estado_civil">Estado Civil</label>
                        <select id="estado_civil" name="estado_civil" class="select2 @error('estado_civil') is-invalid @enderror">
                            <option value=""></option>
                            <option value="">opción 1</option>
                            <option value="">opción 2</option>
                            <option value="">opción 3</option>
                        </select>
                    </div>

                    <div class="col-md-4 input__box">
                        <label for="cargo">Ocupación</label>
                        <input type="text" id="cargo" name="cargo" value="{{ old('cargo') }}"
                                class="@error('cargo') is-invalid @enderror" required/>
                    </div>
                </div>

                <div class="col-12 dropdown-divider my-5"></div>

                <div class="row">
                    <div class="col-md-6 mb-3 input__box">
                        <label for="grupo_sanguineo">Grupo Sanguineo</label>
                        <select id="grupo_sanguineo" name="grupo_sanguineo" class="select2 @error('grupo_sanguineo') is-invalid @enderror">
                            <option value=""></option>
                            <option value="">opción 1</option>
                            <option value="">opción 2</option>
                            <option value="">opción 3</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3 input__box">
                        <label for="entidad_medica">Entidad Médica</label>
                        <select id="entidad_medica" name="entidad_medica" class="select2 @error('entidad_medica') is-invalid @enderror">
                            <option value=""></option>
                            <option value="">opción 1</option>
                            <option value="">opción 2</option>
                            <option value="">opción 3</option>
                        </select>
                    </div>

                    <div class="col-md-6 input__box">
                        <label for="categoria_discapacidad">Categoria de Discapacidad</label>
                        <select id="categoria_discapacidad" name="categoria_discapacidad" class="select2 @error('categoria_discapacidad') is-invalid @enderror">
                            <option value=""></option>
                            <option value="">opción 1</option>
                            <option value="">opción 2</option>
                            <option value="">opción 3</option>
                        </select>
                    </div>

                    <div class="col-md-6 input__box">
                        <label for="alergia">Alergías</label>
                        <input type="text" id="alergia" name="alergia" value="{{ old('alergia') }}"
                                class="@error('alergia') is-invalid @enderror" required/>
                    </div>
                </div>

                <!-- Información del contacto -->
                <div class="my-4">
                    <h2 class="fs_subtitle green_bold">Información de Contacto</h2>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3 input__box">
                        <label for="pais_id">País</label>
                        <select id="pais_id" name="pais_id" class="@error('pais_id') is-invalid @enderror">
            
                        </select>
                    </div>

                    <div class="col-md-4 mb-3 input__box">
                        <label for="departamento_id">Departamento</label>
                        <select name="departamento_id" id="departamento_id" class="select2 departamento @error('departamento_id') is-invalid @enderror"
                                data-provincia="#provincia_id" data-ciudad="#ciudad_id" data-id="{{ old('departamento_id') }}" required>
                        </select>
                    </div>

                    <div class="col-md-4 mb-3 input__box">
                        <label for="ciudad_id">Ciudad</label>
                        <select name="ciudad_id" id="ciudad_id" class="select2 @error('ciudad_id') is-invalid @enderror"
                                data-id="{{ old('ciudad_id') }}" required>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 input__box">
                        <label for="direccion">Dirección</label>
                        <input type="text" id="direccion" name="direccion" value="{{ old('direccion') }}"
                                class="@error('direccion') is-invalid @enderror"/>
                    </div>
                    <div class="col-md-4 input__box">
                        <label for="telefono">Teléfono</label>
                        <input type="text" id="telefono" name="telefono" value="{{ old('telefono') }}"
                                class="tags-input @error('telefono') is-invalid @enderror"/>
                    </div>

                    <div class="col-md-4 input__box">
                        <label for="correo">Correo Electrónico</label>
                        <input type="email" id="correo" name="correo" value="{{ old('correo') }}"
                                class="@error('primer_nombre') is-invalid @enderror"/>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="row m-0 my-4 content_btn_center">
                    <a href="{{ route('institucion.profesionales.index') }}" class="button__form_transparent mr-3" style="color: #434343">Cancelar</a>
                    <button type="submit" class="button__form_green">Guardar</button>
                </div>
            </form>
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

    <script>
        $('.tags-input').tagsinput({
            tagClass: 'bg-primary p-1',
            confirmKeys: [13, 44, 32]
        });

        $('form').keypress(function (event) {
            if (event.which === 13) {
                event.preventDefault();
                return false;
            }
        });

        $('.select2').select2({
            theme: 'bootstrap4'
        });
        $('.select2-multiple').select2({
            theme: 'classic'
        });

        //Están invertidos por la inicialización
        var ciudad = $('#ciudad_id').select2({
            theme: 'bootstrap4'
        });

        var provincia = $('#provincia_id').select2({
            theme: 'bootstrap4'
        }).on('change', function () {
            var id_provincia = $(this).val();
            ciudad.empty();
            if(id_provincia){
                $.ajax({
                    type:"GET",
                    url:"/api/ciudades/" + id_provincia,
                    dataType: 'json',
                    success:function(res){
                        console.log(res.items);
                        if(res.items){
                            $.each(res.items,function(key, item){
                                var newOption = new Option(item.text, item.id, false, false);
                                ciudad.append(newOption);
                            });
                        }
                        ciudad.trigger('change');
                    }
                });
            }
        });

        var departamento = $('#departamento_id').select2({
            theme: 'bootstrap4'
        }).on('change', function () {
            var id_departamento = $(this).val();
            provincia.empty();
            ciudad.empty();
            if(id_departamento){
                $.ajax({
                    type:"GET",
                    url:"/api/provincias/" + id_departamento,
                    dataType: 'json',
                    success:function(res){
                        if(res.items){
                            $.each(res.items,function(key, item){
                                var newOption = new Option(item.text, item.id, false, false);
                                provincia.append(newOption);
                            });
                        }
                        provincia.trigger('change');
                    }
                });
            }
        });

        var pais = $('#pais_id').select2({
            theme: 'bootstrap4'
        }).on('change', function () {
            var id_pais = $(this).val();
            departamento.empty();
            provincia.empty();
            ciudad.empty();
            if(id_pais){
                $.ajax({
                    type:"GET",
                    url:"/api/departamentos/" + id_pais,
                    dataType: 'json',
                    success:function(res){
                        if(res.items){
                            $.each(res.items,function(key, item){
                                var newOption = new Option(item.text, item.id, false, false);
                                departamento.append(newOption);
                            });
                        }
                        departamento.trigger('change');
                    }
                });
            }
        });


    </script>
@endsection
