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
                <h1 class="fs_title_module green_bold">Profesional</h1>
            </div>
            <!-- Formulario -->
            <div class="container__main_form">
                <form action="{{ route('institucion.profesionales.update', ['profesional' => $profesional->id_profesional_inst]) }}" method="post" id="form-crear-profesional" enctype="multipart/form-data">
                    @csrf
                    @method('put')
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

                    <div class="d-block d-md-flex justify-content-end py-3">
                        <!-- Check box interactivo y personalizado -->
                        <div class="checkbox">
                            <input type="checkbox" name="estado" id="estado" value="1"
                                {{ (old('estado', $profesional->estado) == 1) ? 'checked':'' }}/>
                            <label class="label_check" for="estado">
                                <b class="txt1">Profesional inactivo</b>
                                <b class="txt2">Profesional activo</b>
                            </label>
                        </div>
                    </div>

                    <div class="row m-0 my-4 justify-content-center">
                        <div class="col-12 col-lg-4 mb-3 mb-lg-0">
                            <div class="img__upload">
                                <img id="imagen-foto" src="{{ asset($profesional->foto_perfil_institucion ?? 'img/menu/avatar.png') }}">
                                <input type="file" name="foto"  id="foto" accept="image/png, image/jpeg" />
                                <!-- <p>Subir foto de perfil</p> -->
                            </div>
                        </div>
                    </div>

                    <!-- Información Principal -->
                    <div class="my-4">
                        <h2 class="fs_subtitle green_bold">Información Principal</h2>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-lg-3 input__box">
                            <label for="primer_nombre">Primer nombre</label>
                            <input type="text" id="primer_nombre" name="primer_nombre" value="{{ old('primer_nombre', $profesional->primer_nombre) }}"
                                    class="@error('primer_nombre') is-invalid @enderror"/>
                        </div>

                        <div class="col-md-6 col-lg-3 input__box">
                            <label for="segundo_nombre">Segundo nombre</label>
                            <input type="text" id="segundo_nombre" name="segundo_nombre" value="{{ old('segundo_nombre', $profesional->segundo_nombre) }}"
                                    class="@error('segundo_nombre') is-invalid @enderror"/>
                        </div>

                        <div class="col-md-6 col-lg-3 input__box">
                            <label for="primer_apellido">Primer apellido</label>
                            <input type="text" id="primer_apellido" name="primer_apellido" value="{{ old('primer_apellido', $profesional->primer_apellido) }}"
                                    class="@error('primer_apellido') is-invalid @enderror"/>
                        </div>

                        <div class="col-md-6 col-lg-3 input__box">
                            <label for="segundo_apellido">Segundo apellido</label>
                            <input type="text" id="segundo_apellido" name="segundo_apellido" value="{{ old('segundo_apellido', $profesional->segundo_apellido) }}"
                                    class="@error('segundo_apellido') is-invalid @enderror"/>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-lg-4 input__box">
                            <label for="tipo_documento_id">Tipo de documento</label>
                            <select id="tipo_documento_id" name="tipo_documento_id" class="select2 @error('tipo_documento_id') is-invalid @enderror">
                                @if($tipo_documentos->isNotEmpty())
                                    @foreach($tipo_documentos as $tipo)
                                        <option value="{{ $tipo->id }}" {{ old('tipo_documento_id', $profesional->tipo_documento_id) == $tipo->id? 'selected':'' }}>{{ $tipo->nombre }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="col-md-6 col-lg-4 input__box">
                            <label for="numero_documento">Número de documento</label>
                            <input type="text" id="numero_documento" name="numero_documento" value="{{ old('numero_documento', $profesional->numero_documento) }}"
                                    class="@error('numero_documento') is-invalid @enderror"/>
                        </div>

                        <div class="col-md-6 col-lg-4 input__box">
                            <label for="fecha_nacimiento">Fecha de nacimiento</label>
                            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" value="{{ old('fecha_nacimiento', $profesional->fecha_nacimiento->format('Y-m-d')) }}"
                                    class="@error('fecha_nacimiento') is-invalid @enderror"/>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-lg-4 input__box">
                            <label for="telefono">Teléfono</label>
                            <input type="text" id="telefono" name="telefono" value="{{ old('telefono', $profesional->telefono) }}"
                                    class="input_box_formtags-input @error('telefono') is-invalid @enderror"/>
                        </div>

                        <div class="col-md-6 col-lg-4 input__box">
                            <label for="celular">Móvil</label>
                            <input type="text" id="celular" name="celular" value="{{ old('celular', $profesional->celular) }}"
                                    class="input_box_formtags-input @error('celular') is-invalid @enderror"/>
                        </div>

                        <div class="col-md-6 col-lg-4 input__box">
                            <label for="correo">Correo electrónico</label>
                            <input type="email" id="correo" name="correo" value="{{ old('correo', $profesional->correo) }}"
                                    class="@error('primer_nombre') is-invalid @enderror"/>
                        </div>

                        <div class="col-md-6 col-lg-4 input__box">
                            <label for="sitio_web">Sitio web</label>
                            <input type="text" id="sitio_web" name="sitio_web" value="{{ old('sitio_web', $profesional->sitio_web) }}"
                                    class="@error('sitio_web') is-invalid @enderror"/>
                        </div>
                        <div class="col-md-6 col-lg-4 input__box">
                            <label for="linkedin">LinkedIn</label>
                            <input type="text" id="linkedin" name="linkedin" value="{{ old('linkedin', $profesional->linkedin) }}"
                                    class="@error('linkedin') is-invalid @enderror"/>
                        </div>

                        <div class="col-md-6 col-lg-4 input__box">
                            <label for="red_social">Otra red social</label>
                            <input type="text" id="red_social" name="red_social" value="{{ old('red_social', $profesional->red_social) }}"
                                    class="@error('red_social') is-invalid @enderror"/>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-lg-4 input__box"><!--menu dinamico ciudades -->
                            <label for="pais_id">País</label>
                            <select id="pais_id" name="pais_id" class="@error('pais_id') is-invalid @enderror">
                                @if($paises->isNotEmpty())
                                    @foreach($paises as $pais)
                                        <option value="{{ $pais->id_pais }}" {{ old('pais_id', $profesional->pais_id) == $pais->id_pais ? 'selected':'' }}>{{ $pais->nombre }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="col-md-6 col-lg-4 input__box">
                            @php $departamento = (old('departamento_id', $profesional->departamento_id) === null)?null:\App\Models\departamento::query()->where('id_departamento', old('departamento_id', $profesional->departamento_id))->first()@endphp
                            <label for="departamento_id">Departamento</label>
                            {{--                            @dd(old('departamento_id'))--}}
                            <select name="departamento_id" id="departamento_id" class="@error('departamento_id') is-invalid @enderror">
                                @if(!empty($departamento))
                                    <option value="{{ $departamento->id_departamento }}" selected>{{ $departamento->nombre }}</option>
                                @endif
                            </select>
                        </div>

                        <div class="col-md-6 col-lg-4 input__box">
                            @php $provincia = (old('provincia_id', $profesional->provincia_id) === null)?null:\App\Models\provincia::query()->where('id_provincia', old('provincia_id', $profesional->provincia_id))->first()@endphp
                            <label for="provincia_id">Provincia</label>
                            <select name="provincia_id" id="provincia_id" class="@error('provincia_id') is-invalid @enderror">
                                @if(!empty($provincia))
                                    <option value="{{ $provincia->id_provincia }}" selected>{{ $provincia->nombre }}</option>
                                @endif
                            </select>
                        </div>

                        <div class="col-md-6 col-lg-4 input__box">
                            @php $ciudad = (old('ciudad_id', $profesional->ciudad_id) === null)?null:\App\Models\municipio::query()->where('id_municipio', old('ciudad_id', $profesional->ciudad_id))->first()@endphp
                            <label for="ciudad_id">Ciudad</label>
                            <select name="ciudad_id" id="ciudad_id" class="@error('ciudad_id') is-invalid @enderror">
                                @if(!empty($ciudad))
                                    <option value="{{ $ciudad->id_municipio }}" selected>{{ $ciudad->nombre }}</option>
                                @endif
                            </select>
                        </div>

                        <div class="col-md-6 col-lg-4 input__box">
                            <label for="direccion">Dirección</label>
                            <input type="text" id="direccion" name="direccion" value="{{ old('direccion', $profesional->direccion) }}"
                                    class="@error('direccion') is-invalid @enderror"/>
                        </div>

                        <div class="col-md-6 col-lg-4 input__box">
                            <label for="numero_profesional">Tarjeta profesional</label>
                            <input type="text" id="numero_profesional" name="numero_profesional" value="{{ old('numero_profesional', $profesional->numero_profesional) }}"
                                    class="@error('numero_profesional') is-invalid @enderror"/>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 input__box">
                            <label for="rethus">RETHUS</label>
                            <input type="text" id="rethus" name="rethus" value="{{ old('rethus', $profesional->rethus) }}"
                                    class="@error('rethus') is-invalid @enderror"/>
                        </div>

                        <div class="col-md-6 input__box">
                            <label for="cargo">Cargo</label>
                            <input type="text" id="cargo" name="cargo" value="{{ old('cargo', $profesional->cargo) }}"
                                    class="@error('cargo') is-invalid @enderror"/>
                        </div>

                        <div class="col-md-6 input__box">
                            <label for="id_especialidad">Especialidad principal</label>
                            <select id="id_especialidad" name="id_especialidad" class="select2 @error('id_especialidad') is-invalid @enderror">
                                @if($especialidades->isNotEmpty())
                                    @foreach($especialidades as $especialidad)
                                        <option value="{{ $especialidad->idEspecialidad }}" {{ old('id_especialidad', $profesional->id_especialidad) == $especialidad->idEspecialidad ? 'selected':'' }}>{{ $especialidad->nombreEspecialidad }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="col-md-6 input__box">
                            <label for="id_universidad">Universidad</label>
                            <select id="id_universidad" name="id_universidad" class="select2 @error('id_universidad') is-invalid @enderror">
                                @if($universidades->isNotEmpty())
                                    @foreach($universidades as $universidad)
                                        <option value="{{ $universidad->id_universidad }}" {{ old('id_universidad', $profesional->id_universidad) == $universidad->id_universidad ? 'selected':'' }}>{{ $universidad->nombreuniversidad }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 input__box">
                            <label for="especialidades">Otras especialidades</label>
                            @php
                                $ids = $profesional->especialidades->map(function ($item) {return $item['idEspecialidad']; });
                            @endphp
                            <select id="especialidades" name="especialidades[]" class="select2-multiple @error('especialidades.*') is-invalid @enderror" multiple>
                                @if($especialidades->isNotEmpty())
                                    @foreach($especialidades as $especialidad)
                                        <option value="{{ $especialidad->idEspecialidad }}" {{ collect(old('especialidades', $ids))->contains($especialidad->idEspecialidad) ? 'selected':'' }}>{{ $especialidad->nombreEspecialidad }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <!-- Contraseña del usuario -->
                    <div class="my-4">
                        <h2 class="fs_subtitle green_bold">Contraseña</h2>
                        <p class="text__md black_light">Crea una contraseña para el profesional que esta creando.</p>
                    </div>

                    <div class="row">
                        <div class="col-md-6 input__box">
                            <label for="password">Contraseña</label>
                            <div class="input-group">
                                <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-success password py-0" type="button" data-class="success" data-password="#password">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 input__box">
                            <label for="password_confirmation">Confirmar contraseña</label>
                            <div class="input-group">
                                <input type="password" id="password_confirmation" name="password_confirmation"
                                        class="form-control @error('password_confirmation') is-invalid @enderror">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-success password py-0" type="button" data-class="success" data-password="#password_confirmation">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Buttons -->
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
