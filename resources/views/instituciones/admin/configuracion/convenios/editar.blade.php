@extends('instituciones.admin.layouts.layout')

@section('styles')
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/tagsinput/bootstrap-tagsinput.css') }}">

@endsection

@section('contenido')
    <div class="container-fluid panel_container">
        <!-- Main title -->
        <div class="mb-4">
            <h1 class="fs_title_module green_bold">Convenio</h1>
        </div>
        <!-- Formulario -->
        <div class="container__main_form">
            <form action="{{ route('institucion.configuracion.convenios.update', ['convenio' => $convenio->id]) }}" method="post"
                    id="form-convenio-crear" enctype="multipart/form-data">
                <!-- Información básica -->
                <div class="d-block d-md-flex justify-content-end py-3">
                    <!-- Check box interactivo y personalizado -->
                    <div class="checkbox">
                        <input type="checkbox" {{ old('estado', $convenio->estado) == 1 ? 'checked':'' }}
                                name="estado" id="estado" value="1">
                        <label class="label_check" for="estado">
                            <b class="txt1">Convenio inactivo</b>
                            <b class="txt2">Convenio activo</b>
                        </label>
                    </div>
                </div>

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

                <div class="row m-0 mb-4 justify-content-center">
                    <div class="col-12 col-lg-4 mb-3 mb-lg-0">
                        <div class="img__upload">
                            <img id="imagen-foto" src="{{ asset( $convenio->url_image ?? 'img/menu/avatar.png') }}">
                            <input type="file" name="foto"  id="foto" accept="image/png, image/jpeg" />
                            <!-- <p>Foto de convenio</p> -->
                        </div>
                    </div>
                </div>

                <!-- Información Principal -->
                <div class="my-4">
                    <h2 class="fs_subtitle green_bold">Información Principal</h2>
                </div>

                <div class="row">
                    <div class="col-md-6 input__box">
                        <label for="primer_nombre">Primer nombre / Razón social</label>
                        <input type="text" id="primer_nombre" name="primer_nombre" value="{{ old('primer_nombre', $convenio->primer_nombre) }}"
                                class="@error('primer_nombre') is-invalid @enderror" required/>
                    </div>

                    <div class="col-md-6 input__box">
                        <label for="segundo_nombre">Segundo nombre</label>
                        <input type="text" id="segundo_nombre" name="segundo_nombre" value="{{ old('segundo_nombre', $convenio->segundo_nombre) }}"
                                class="@error('segundo_nombre') is-invalid @enderror"/>
                    </div>

                    <div class="col-md-6 input__box">
                        <label for="primer_apellido">Primer apellido</label>
                        <input type="text" id="primer_apellido" name="primer_apellido" value="{{ old('primer_apellido', $convenio->primer_apellido) }}"
                                class="@error('primer_apellido') is-invalid @enderror"/>
                    </div>

                    <div class="col-md-6 input__box">
                        <label for="segundo_apellido">Segundo apellido</label>
                        <input type="text" id="segundo_apellido" name="segundo_apellido" value="{{ old('segundo_apellido', $convenio->segundo_apellido) }}"
                                class="@error('segundo_apellido') is-invalid @enderror" />
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 input__box">
                        <label for="tipo_documento_id">Tipo de identificación</label>
                        <select class="@error('tipo_documento_id') is-invalid @enderror" id="tipo_documento_id" required
                                name="tipo_documento_id">
                            @if(!empty($tipo_documentos) and $tipo_documentos->isNotEmpty())
                                @foreach($tipo_documentos as $tipo)
                                    <option value="{{ $tipo->id }}" {{ old('tipo_documento_id', $convenio->tipo_documento_id) == $tipo->id ? 'selected':null }}>{{ $tipo->nombre }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="col-md-6 mb-3 input__box">
                        <label for="numero_documento">Número de identificación</label>
                        <div class="row m-0">
                            <input class="col-10 m-0 no_brad_right @error('numero_documento') is-invalid @enderror" required
                                    type="text" id="numero_documento" name="numero_documento" value="{{ old('numero_documento', $convenio->numero_documento) }}" />

                            <input class="col-2 m-0 no_brad_left @error('dv_documento') is-invalid @enderror" type="text"
                                    id="dv_documento" name="dv_documento" value="{{ old('dv_documento', $convenio->dv_documento) }}" placeholder="# verificación"/>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4 mb-3 input__box">
                        @php $sgsss = (!empty( old('sgsss_id', $convenio->sgsss_id) )) ? \App\Models\Sgsss::find(old('sgsss_id', $convenio->sgsss_id)):null; @endphp
                        <label for="sgsss_id">Código prestador del servicio</label>
                        <select type="text" id="sgsss_id" name="sgsss_id" value="{{ old('sgsss_id') }}" required
                                class="select2 @error('sgsss_id') is-invalid @enderror">
                            @if(!empty($sgsss))
                                <option value="{{ $sgsss->id }}" selected>{{ $sgsss->nombre }}</option>
                            @endif
                        </select>
                    </div>

                    <div class="col-md-6 col-lg-4 input__box">
                        <label for="codigo_convenio">Código del convenio</label>
                        <input type="text" id="codigo_convenio" name="codigo_convenio" value="{{ old('codigo_convenio', $convenio->codigo_convenio) }}"
                                class="@error('codigo_convenio') is-invalid @enderror" required/>
                    </div>

                    <div class="col-md-6 col-lg-4 input__box">
                        <label for="tipo_contribuyente_id">Tipo de contribuyente</label>
                        <select class="@error('tipo_contribuyente_id') is-invalid @enderror" id="tipo_contribuyente_id"
                                name="tipo_contribuyente_id" value="{{ old('tipo_contribuyente_id') }}" required>
                            @if(!empty($tipo_contribuyentes) and $tipo_contribuyentes->isNotEmpty())
                                @foreach($tipo_contribuyentes as $contribuyente)
                                    <option value="{{ $contribuyente->id }}" {{ old('tipo_documento_id', $convenio->tipo_documento_id) == $contribuyente->id ? 'selected':null }}>{{ $contribuyente->nombre }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="col-md-6 col-lg-4 mb-3 input__box">
                        @php $actividad = (!empty( old('actividad_economica_id', $convenio->actividad_economica_id) )) ? \App\Models\ActividadEconomica::find(old('actividad_economica_id', $convenio->actividad_economica_id)):null; @endphp
                        <label for="actividad_economica_id">Actividad económica</label>
                        <select id="actividad_economica_id" name="actividad_economica_id" required
                                class="@error('actividad_economica_id') is-invalid @enderror">
                            @if(!empty($actividad))
                                <option value="{{ $actividad->id }}" selected>{{ $actividad->nombre }}</option>
                            @endif
                        </select>
                    </div>

                    <div class="col-md-6 col-lg-4 input__box">
                        <label for="forma_pago">Forma de pago</label>
                        <select type="text" id="forma_pago" name="forma_pago" required
                                class="@error('forma_pago') is-invalid @enderror">
                            <option></option>
                            <option value="efectivo" {{ old('forma_pago', $convenio->forma_pago) == 'efectivo' ? 'selected':'' }}>Efectivo</option>
                            <option value="transferencia" {{ old('forma_pago', $convenio->forma_pago) == 'transferencia' ? 'selected':'' }}>Transferencia</option>
                            <option value="tarjeta" {{ old('forma_pago', $convenio->forma_pago) == 'tarjeta' ? 'selected':'' }}>Tarjeta de crédito / debito</option>
                            <option value="consignación" {{ old('forma_pago', $convenio->forma_pago) == 'consignación' ? 'selected':'' }}>Consignación</option>
                        </select>
                    </div>

                    <div class="col-md-6 col-lg-4 input__box">
                        <label for="id_tipo_convenio">Tipo de convenio</label>
                        <select class="@error('id_tipo_convenio') is-invalid @enderror" id="id_tipo_convenio" name="id_tipo_convenio">
                            <option></option>
                            @if($tipo_convenios->isNotEmpty())
                                @foreach($tipo_convenios as $tipo_convenio)
                                    <option value="{{ $tipo_convenio->id }}" {{ old('id_tipo_convenio', $convenio->id_tipo_convenio) == $tipo_convenio->id ? 'selected':'' }}>{{ $tipo_convenio->nombretipo }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>

                <!-- Linea división de elementos -->
                <div class="dropdown-divider my-4"></div>

                <!-- Información de contacto -->
                <h2 class="subtitle__lg green_bold mb-4">Información de contacto</h2>

                <div class="row">
                    <div class="col-md-6 col-lg-4 input__box">
                        <label for="tipo_establecimiento">Tipo de establecimiento</label>
                        <select class="@error('tipo_establecimiento') is-invalid @enderror" id="tipo_establecimiento"
                                name="tipo_establecimiento" required>
                            <option></option>
                            <option value="oficina" {{ old('tipo_establecimiento', $convenio->tipo_establecimiento) == 'oficina' ? 'selected':'' }}>Oficina</option>
                            <option value="consultorio" {{ old('tipo_establecimiento', $convenio->tipo_establecimiento) == 'consultorio' ? 'selected':'' }}>Consultorio</option>
                            <option value="institución" {{ old('tipo_establecimiento', $convenio->tipo_establecimiento) == 'institución' ? 'selected':'' }}>Institución</option>
                            <option value="edificio" {{ old('tipo_establecimiento', $convenio->tipo_establecimiento) == 'edificio' ? 'selected':'' }}>Edificio</option>
                        </select>
                    </div>

                    <div class="col-md-6 col-lg-4 input__box">
                        <label for="direccion">Dirección</label>
                        <input type="text" id="direccion" name="direccion" value="{{ old('direccion', $convenio->direccion) }}"
                                class="@error('direccion') is-invalid @enderror" required/>
                    </div>

                    <div class="col-md-6 col-lg-4 input__box">
                        <label for="codigo_postal">Código postal</label>
                        <input type="text" id="codigo_postal" name="codigo_postal" value="{{ old('codigo_postal', $convenio->codigo_postal) }}"
                                class="@error('codigo_postal') is-invalid @enderror" required/>
                    </div>

                    <div class="col-md-6 col-lg-4 mb-3 input__box">     <!--menu dinamico ciudades -->
                        <label for="pais_id">País</label>
                        <select id="pais_id" name="pais_id" class="select2 pais @error('pais_id') is-invalid @enderror"
                                data-departamento="#departamento_id" data-provincia="#provincia_id" data-ciudad="#ciudad_id"
                                data-id="{{ old('pais_id', $convenio->pais_id) }}" required>
                            @if($paises->isNotEmpty())
                                @foreach($paises as $pais)
                                    <option value="{{ $pais->id_pais }}">{{ $pais->nombre }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="col-md-6 col-lg-4 mb-3 input__box">
                        {{--@php $departamento = (old('departamento_id', $convenio->departamento_id) === null)?null:\App\Models\departamento::find(old('departamento_id', $convenio->departamento_id))@endphp--}}
                        <label for="departamento_id">Departamento</label>
                        {{-- @dd(old('departamento_id'))--}}
                        <select name="departamento_id" id="departamento_id" class="select2 departamento @error('departamento_id') is-invalid @enderror"
                                data-provincia="#provincia_id" data-ciudad="#ciudad_id" data-id="{{ old('departamento_id', $convenio->departamento_id) }}" required>
                            {{--@if(!empty($departamento))
                            <option value="{{ $departamento->id_departamento }}"
                                    selected>{{ $departamento->nombre }}</option>
                            @endif--}}
                        </select>
                    </div>

                    <div class="col-md-6 col-lg-4 mb-3 input__box">
                        {{--@php $provincia = (old('provincia_id', $convenio->provincia_id) === null)?null:\App\Models\provincia::find(old('provincia_id', $convenio->provincia_id)) @endphp--}}
                        <label for="provincia_id">Provincia</label>
                        <select name="provincia_id" id="provincia_id" data-ciudad="#ciudad_id" data-id="{{ old('provincia_id', $convenio->provincia_id) }}"
                                class="select2 provincia @error('provincia_id') is-invalid @enderror">
                            {{--@if(!empty($provincia))
                            <option value="{{ $provincia->id_provincia }}"
                                    selected>{{ $provincia->nombre }}</option>
                            @endif--}}
                        </select>
                    </div>

                    <div class="col-md-6 col-lg-4 mb-3 input__box">
                        {{--@php $ciudad = (old('ciudad_id', $convenio->ciudad_id) === null)?null:\App\Models\municipio::find(old('ciudad_id', $convenio->ciudad_id))@endphp--}}
                        <label for="ciudad_id">Ciudad</label>
                        <select name="ciudad_id" id="ciudad_id" class="select2 @error('ciudad_id') is-invalid @enderror"
                                data-id="{{ old('ciudad_id', $convenio->ciudad_id) }}" required>
                            {{--@if(!empty($ciudad))
                            <option value="{{ $ciudad->id_municipio }}" selected>{{ $ciudad->nombre }}</option>
                            @endif--}}
                        </select>
                    </div>

                    <div class="col-md-6 col-lg-4 input__box">
                        <label for="telefono">Teléfono</label>
                        <input type="text" id="telefono" name="telefono" value="{{ old('telefono', $convenio->telefono) }}"
                                class="w-100 @error('telefono') is-invalid @enderror"/>
                    </div>

                    <div class="col-md-6 col-lg-4 input__box">
                        <label for="celular">Móvil</label>
                        <input type="text" id="celular" name="celular" value="{{ old('celular', $convenio->celular) }}"
                                class="w-100 @error('celular') is-invalid @enderror"/>
                    </div>

                    <div class="col-md-6 col-lg-8 input__box">
                        <label for="correo">Correo</label>
                        <input type="email" id="correo" name="correo" value="{{ old('correo', $convenio->correo) }}"
                                class="@error('correo') is-invalid @enderror" required/>
                    </div>
                </div>


                <!-- Buttons -->
                <div class="row m-0 my-4 content_btn_center">
                    <a href="{{ route('institucion.configuracion.convenios.index') }}" class="button__form_transparent mr-3">Cancelar</a>
                    <button type="submit" class="button__form_green">Guardar</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('js/filtro-ubicacion.js') }}"></script>
    <script src="{{ asset('plugins/tagsinput/bootstrap-tagsinput.min.js') }}"></script>

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
        $('#actividad_economica_id').select2({
            theme: 'bootstrap4',
            ajax:{
                url: "/api/actividades_economicas",
                method: 'get',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'json',
                data:function (params) {
                    return {
                        term: params.term
                    };
                },
                processResults: function (response) {
                    return {
                        results:response.items
                    };
                },
            },
            minimumInputLength: 4,
        });
        $('#sgsss_id').select2({
            theme: 'bootstrap4',
            ajax:{
                url: "/api/sgsss",
                method: 'get',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'json',
                data:function (params) {
                    return {
                        term: params.term
                    };
                },
                processResults: function (response) {
                    return {
                        results:response.items
                    };
                },
            },
            minimumInputLength: 2,
        });

        var pais = $('#pais_id');
        pais.val(pais.data('id')).trigger('change');

        var departamento = $('#departamento_id');
        if (departamento.data('id') !== '') setTimeout(function () {
            departamento.val(departamento.data('id')).trigger('change');
        },500);

        var provincia = $('#provincia_id');
        if (provincia.data('id') !== '') setTimeout(function () {
            provincia.val(provincia.data('id')).trigger('change');
        },1000);

        var ciudad = $('#ciudad_id');
        if (ciudad.data('id') !== '') setTimeout(function () {
            ciudad.val(ciudad.data('id')).trigger('change');
        },1500);

        // $('#telefono, #celular').tagsinput({
        //     tagClass: 'bg-primary p-1'
        // });
    </script>
@endsection
