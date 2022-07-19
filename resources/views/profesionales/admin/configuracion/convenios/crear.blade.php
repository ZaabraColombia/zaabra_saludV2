@extends('profesionales.admin.layouts.panel')

@section('styles')
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/tagsinput/bootstrap-tagsinput.css') }}">

@endsection

@section('contenido')
    <div class="container-fluid panel_container">
        <!-- panel head -->
        <div class="panel_head">
            <!-- Title -->
            <h1 class="mb-3 title blue_two">Nuevo convenio</h1>
        </div>
        <!-- panel body -->
        <div class="panel_body">
            <div class="container__form mb-3">
                <form action="{{ route('profesional.configuracion.convenios.store') }}" method="post" id="form-convenio-crear" enctype="multipart/form-data">
                    <!-- Check estado ACTIVO / INACTIVO -->
                    <div id="input_check_estado" class="d-block d-md-flex justify-content-end py-3">
                        <div class="check_blue">
                            <div class="input_checkBox_toogle">
                                <input type="checkbox" name="estado" id="estado" value="1" {{ old('estado') == 1 ? 'checked':'' }}>
                                <label class="input_checkBox_text_toggle" for="estado">
                                    <b class="inactiv">Convenio inactivo</b>
                                    <b class="actived">Convenio activo</b>
                                </label>
                            </div>
                        </div>
                    </div>
                    @csrf
                    <!-- Imagen usuario -->
                    <div class="row m-0 mb-4">
                        <div class="col-12 img__perfil_formulario">
                            <img id="imagen-foto" src="{{ asset('img/menu/avatar.png') }}">
                            <input type="file" name="foto"  id="foto" accept="image/png, image/jpeg" />
                        </div>
                    </div>
                    <!-- Mensaje de alerta -->
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
                    <!-- Subtitulo -->
                    <div class="mb-4">
                        <h2 class="h2_fs20_bold blue_two">Información principal</h2>
                    </div>
                    <!-- Inputs -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="label_fs16_med black_" for="primer_nombre">Primer nombre / Razón social</label>
                            <input type="text" id="primer_nombre" name="primer_nombre" value="{{ old('primer_nombre') }}"
                                   class="input__text @error('primer_nombre') is-invalid @enderror" required/>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="label_fs16_med black_" for="segundo_nombre">Segundo nombre</label>
                            <input type="text" id="segundo_nombre" name="segundo_nombre" value="{{ old('segundo_nombre') }}"
                                   class="input__text @error('segundo_nombre') is-invalid @enderror"/>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="label_fs16_med black_" for="primer_apellido">Primer apellido</label>
                            <input type="text" id="primer_apellido" name="primer_apellido" value="{{ old('primer_apellido') }}"
                                   class="input__text @error('primer_apellido') is-invalid @enderror"/>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="label_fs16_med black_" for="segundo_apellido">Segundo apellido</label>
                            <input type="text" id="segundo_apellido" name="segundo_apellido" value="{{ old('segundo_apellido') }}"
                                   class="input__text @error('segundo_apellido') is-invalid @enderror" />
                        </div>
                    </div>
                    <!-- Inputs -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="label_fs16_med black_" for="tipo_documento_id">Tipo de identificación</label>
                            <select class="input__select @error('tipo_documento_id') is-invalid @enderror" id="tipo_documento_id" required
                                    name="tipo_documento_id">
                                <option value=""></option>
                                @if(!empty($tipo_documentos) and $tipo_documentos->isNotEmpty())
                                    @foreach($tipo_documentos as $tipo)
                                        <option value="{{ $tipo->id }}" {{ old('tipo_documento_id') == $tipo->id ? 'selected':null }}>{{ $tipo->nombre }}</option>
                                    @endforeach
                                @endif
                                <option value=""></option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="label_fs16_med black_" for="numero_documento">Número de identificación</label>
                            <div class="row m-0 input_double">
                                <input class="col-9 m-0 input__text @error('numero_documento') is-invalid @enderror" required
                                       type="text" id="numero_documento" name="numero_documento" value="{{ old('numero_documento') }}" />

                                <input class="col-3 m-0 input__text @error('dv_documento') is-invalid @enderror" type="text"
                                       id="dv_documento" name="dv_documento" value="{{ old('dv_documento') }}" placeholder="Cod."/>
                            </div>
                        </div>

                        <div class="col-md-6 col-xl-4 mb-3">
                            @php $sgsss = (!empty( old('sgsss_id') )) ? \App\Models\Sgsss::find(old('sgsss_id')):null; @endphp
                            <label class="label_fs16_med black_" for="sgsss_id">Código del prestador del servicio</label>
                            <select type="text" id="sgsss_id" name="sgsss_id" value="{{ old('sgsss_id') }}" required
                                    class="select2 input__select @error('sgsss_id') is-invalid @enderror">
                                @if(!empty($sgsss))
                                    <option value="{{ $sgsss->id }}" selected>{{ $sgsss->nombre }}</option>
                                @endif
                            </select>
                        </div>

                        <div class="col-md-6 col-xl-4 mb-3">
                            <label class="label_fs16_med black_" for="codigo_convenio">Código del convenio</label>
                            <input type="text" id="codigo_convenio" name="codigo_convenio" value="{{ old('codigo_convenio') }}"
                                   class="input__text @error('codigo_convenio') is-invalid @enderror" required/>
                        </div>

                        <div class="col-md-6 col-xl-4 mb-3">
                            <label class="label_fs16_med black_" for="tipo_contribuyente_id">Tipo de contribuyente</label>
                            <select class="input__select @error('tipo_contribuyente_id') is-invalid @enderror" id="tipo_contribuyente_id"
                                    name="tipo_contribuyente_id" value="{{ old('tipo_contribuyente_id') }}" required>
                                <option value=""></option>
                                @if(!empty($tipo_contribuyentes) and $tipo_contribuyentes->isNotEmpty())
                                    @foreach($tipo_contribuyentes as $contribuyente)
                                        <option value="{{ $contribuyente->id }}" {{ old('tipo_documento_id') == $contribuyente->id ? 'selected':null }}>{{ $contribuyente->nombre }}</option>
                                    @endforeach
                                @endif
                                <option value=""></option>
                            </select>
                        </div>

                        <div class="col-md-6 col-xl-4 mb-3">
                            @php $actividad_economica = (!empty( old('actividad_economica_id') )) ? \App\Models\ActividadEconomica::find(old('actividad_economica_id')):null; @endphp                            
                            <label class="label_fs16_med black_" for="actividad_economica_id">Actividad económica</label>
                            <select id="actividad_economica_id" name="actividad_economica_id" required
                                    class="input__select @error('actividad_economica_id') is-invalid @enderror">
                                @if(!empty($actividad_economica))
                                    <option value="{{ $actividad_economica->id }}" selected>{{ $actividad_economica->nombre }}</option>
                                @endif
                            </select>
                        </div>

                        <div class="col-md-6 col-xl-4 mb-3">
                            <label class="label_fs16_med black_" for="forma_pago">Forma de pago</label>
                            <select type="text" id="forma_pago" name="forma_pago" required
                                    class="input__select @error('forma_pago') is-invalid @enderror">
                                <option></option>
                                <option value="efectivo" {{ old('forma_pago') == 'efectivo' ? 'selected':'' }}>Efectivo</option>
                                <option value="transferencia" {{ old('forma_pago') == 'transferencia' ? 'selected':'' }}>Transferencia</option>
                                <option value="tarjeta" {{ old('forma_pago') == 'tarjeta' ? 'selected':'' }}>Tarjeta de crédito / debito</option>
                                <option value="consignación" {{ old('forma_pago') == 'consignación' ? 'selected':'' }}>Consignación</option>
                                <option value=""></option>
                            </select>
                        </div>

                        <div class="col-md-6 col-xl-4 mb-3">
                            <label class="label_fs16_med black_" for="id_tipo_convenio">Tipo de convenio</label>
                            <select class="input__select @error('id_tipo_convenio') is-invalid @enderror" id="id_tipo_convenio" name="id_tipo_convenio">
                                <option></option>
                                @if($tipo_convenios->isNotEmpty())
                                    @foreach($tipo_convenios as $tipo_convenio)
                                        <option value="{{ $tipo_convenio->id }}" {{ old('id_tipo_convenio') == $tipo_convenio->id ? 'selected':'' }}>{{ $tipo_convenio->nombretipo }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <!-- Linea división de elementos -->
                    <div class="dropdown-divider my-4"></div>
                    <!-- Subtitulo -->
                    <div class="mb-4">
                        <h2 class="h2_fs20_bold blue_two">Información de contacto</h2>
                    </div>
                    <!-- Inputs -->
                    <div class="row">
                        <div class="col-md-6 col-xl-4 mb-3">
                            <label class="label_fs16_med black_" for="tipo_establecimiento">Tipo de establecimiento</label>
                            <select class="input__select @error('tipo_establecimiento') is-invalid @enderror" id="tipo_establecimiento"
                                    name="tipo_establecimiento" required>
                                <option></option>
                                <option value="oficina" {{ old('tipo_establecimiento') == 'oficina' ? 'selected':'' }}>Oficina</option>
                                <option value="consultorio" {{ old('tipo_establecimiento') == 'consultorio' ? 'selected':'' }}>Consultorio</option>
                                <option value="institución" {{ old('tipo_establecimiento') == 'institución' ? 'selected':'' }}>Institución</option>
                                <option value="edificio" {{ old('tipo_establecimiento') == 'edificio' ? 'selected':'' }}>Edificio</option>
                            </select>
                        </div>

                        <div class="col-md-6 col-xl-4 mb-3">
                            <label class="label_fs16_med black_" for="direccion">Dirección</label>
                            <input type="text" id="direccion" name="direccion" value="{{ old('direccion') }}"
                                   class="input__text @error('direccion') is-invalid @enderror" required/>
                        </div>

                        <div class="col-md-6 col-xl-4 mb-3">
                            <label class="label_fs16_med black_" for="codigo_postal">Código postal</label>
                            <input type="text" id="codigo_postal" name="codigo_postal" value="{{ old('codigo_postal') }}"
                                   class="input__text @error('codigo_postal') is-invalid @enderror" required/>
                        </div>

                        <div class="col-md-6 col-xl-4 mb-3">     <!--menu dinamico ciudades -->
                            <label class="label_fs16_med black_" for="pais_id">País</label>
                            <select id="pais_id" name="pais_id" class="select2 pais input__select @error('pais_id') is-invalid @enderror"
                                    data-departamento="#departamento_id" data-provincia="#provincia_id" data-ciudad="#ciudad_id"
                                    data-id="{{ old('pais_id', 18/* colombia */) }}" required>
                                @if($paises->isNotEmpty())
                                    @foreach($paises as $pais)
                                        <option value="{{ $pais->id_pais }}">{{ $pais->nombre }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="col-md-6 col-xl-4 mb-3">
                            @php $departamento = (old('departamento_id') === null)?null:\App\Models\departamento::query()->where('id_departamento', old('departamento_id'))->first()@endphp
                            <label class="label_fs16_med black_" for="departamento_id">Departamento</label>
                            {{-- @dd(old('departamento_id'))--}}
                            <select name="departamento_id" id="departamento_id" class="select2 departamento input__select @error('departamento_id') is-invalid @enderror"
                                    data-provincia="#provincia_id" data-ciudad="#ciudad_id" data-id="{{ old('departamento_id') }}" required>
                                @if(!empty($departamento))
                                    <option value="{{ $departamento->id_departamento }}" selected>{{ $departamento->nombre }}</option>
                                @endif
                            </select>
                        </div>

                        <div class="col-md-6 col-xl-4 mb-3">
                            @php $provincia = (old('provincia_id') === null)?null:\App\Models\provincia::query()->where('id_provincia', old('provincia_id'))->first()@endphp
                            <label class="label_fs16_med black_" for="provincia_id">Provincia</label>
                            <select name="provincia_id" id="provincia_id" data-ciudad="#ciudad_id" data-id="{{ old('provincia_id') }}"
                                    class="select2 provincia input__select @error('provincia_id') is-invalid @enderror">
                                @if(!empty($provincia))
                                    <option value="{{ $provincia->id_provincia }}" selected>{{ $provincia->nombre }}</option>
                                @endif
                            </select>
                        </div>

                        <div class="col-md-6 col-xl-4 mb-3">
                            @php $ciudad = (old('ciudad_id') === null)?null:\App\Models\municipio::query()->where('id_municipio', old('ciudad_id'))->first()@endphp
                            <label class="label_fs16_med black_" for="ciudad_id">Ciudad</label>
                            <select name="ciudad_id" id="ciudad_id" class="select2 input__select @error('ciudad_id') is-invalid @enderror"
                                    data-id="{{ old('ciudad_id') }}" required>
                                @if(!empty($ciudad))
                                    <option value="{{ $ciudad->id_municipio }}" selected>{{ $ciudad->nombre }}</option>
                                @endif
                            </select>
                        </div>

                        <div class="col-md-6 col-xl-4 mb-3">
                            <label class="label_fs16_med black_" for="telefono">Teléfono</label>
                            <input type="text" id="telefono" name="telefono" value="{{ old('telefono') }}"
                                   class="input__text @error('telefono') is-invalid @enderror"/>
                        </div>

                        <div class="col-md-6 col-xl-4 mb-3">
                            <label class="label_fs16_med black_" for="celular">Móvil</label>
                            <input type="text" id="celular" name="celular" value="{{ old('celular') }}"
                                   class="input__text @error('celular') is-invalid @enderror"/>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="label_fs16_med black_" for="correo">Correo</label>
                            <input type="email" id="correo" name="correo" value="{{ old('correo') }}"
                                   class="input__text @error('correo') is-invalid @enderror" required/>
                        </div>
                    </div>
                    <!-- Buttons down -->
                    <div class="btn__down_form">
                        <a href="" class="bord_gray_70">Cancelar</a>
                        <button class="bg_blue_two" type="submit">Guardar</button>
                    </div>
                </form>
            </div>
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
