@extends('profesionales.admin.layouts.panel')

@section('styles')
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2-bootstrap4.min.css') }}">
@endsection

@section('contenido')
    <div class="container-fluid p-0 pr-lg-4">
        <div class="containt_agendaProf">
            <div class="my-4 my-xl-5">
                <h1 class="title__xl blue_bold">Servicios</h1>
            </div>


            <div class="containt_main_table mb-3">
                <form action="{{ route('profesional.configuracion.servicios.update', ['servicio' => $servicio->id]) }}" method="post">
                    @csrf
                    @method('put')
                    <div class="d-block d-md-flex justify-content-between py-3">
                        <h2 class="subtitle__lg blue_bold mb-4">Editar servicio</h2>
                        <!-- Check box interactivo y personalizado -->
                        <div class="checkbox__blue">
                            <input type="checkbox" name="estado" id="estado" value="1" {{ old('estado', $servicio->estado) == 1 ? 'checked':'' }}>
                            <label class="label_check__blue" for="estado">
                                <b class="txt1">Servicio inactivo</b>
                                <b class="txt2">Servicio activo</b>
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            @if($errors->any())
                                <div class="alert alert-danger" role="alert">
                                    <h4 class="alert-heading">Error!</h4>
                                    <ul>
                                        <li>{!! collect($errors->all())->implode('</li><li>') !!}</li>
                                    </ul>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-4 input__box">
                            <label for="duracion">Duración (minuto)</label>
                            <input type="number" id="duracion" name="duracion" value="{{ old('duracion', $servicio->duracion) }}"
                                   class="@error('duracion') is-invalid @enderror"/>
                        </div>

                        <div class="col-md-4 input__box">
                            <label for="descanso">Descanso (minuto)</label>
                            <input type="number" id="descanso" name="descanso" value="{{ old('descanso', $servicio->descanso) }}"
                                   class="@error('descanso') is-invalid @enderror"/>
                        </div>

                        <div class="col-md-4 input__box">
                            <label for="valor">Valor</label>
                            <input type="number" id="valor" name="valor" value="{{ old('valor', $servicio->valor) }}"
                                   class="@error('valor') is-invalid @enderror"/>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 input__box">
                            <label for="nombre">Nombre</label>
                            <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $servicio->nombre) }}"
                                   class="@error('nombre') is-invalid @enderror"/>
                        </div>

                        <div class="col-md-6 input__box">
                            <label for="especialidad_id">Especialidad</label>
                            <select class="@error('especialidad_id') is-invalid @enderror" id="especialidad_id"
                                    name="especialidad_id">
                                @if($especialidades->isNotEmpty())
                                    @foreach($especialidades as $especialidad)
                                        <option value="{{ $especialidad->idEspecialidad }}" {{ old('especialidad_id', $servicio->especialidad_id) == $especialidad->idEspecialidad ? 'checked':null }}>{{ $especialidad->nombreEspecialidad }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 input__box">
                            <label for="tipo_servicio_id">Tipo de servicio</label>
                            <select class="@error('tipo_servicio_id') is-invalid @enderror" id="tipo_servicio_id" name="tipo_servicio_id">
                                @if($tipo_servicios->isNotEmpty())
                                    @foreach($tipo_servicios as $tipo_servicio)
                                        <option value="{{ $tipo_servicio->id }}" {{ old('tipo_servicio_id', $servicio->tipo_servicio_id) == $tipo_servicio->id ? 'checked':null }}>{{ $tipo_servicio->nombre }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="col-md-8 input__box">
                            @php $codigo_cups = old('codigo_cups', $servicio->codigo_cups); $cup = !empty($codigo_cups) ? \App\Models\Cups::query()->where('code', 'like', "%$codigo_cups")->first():null @endphp
                            <label for="codigo_cups">CUPS</label>
                            <select class="@error('codigo_cups') is-invalid @enderror" id="codigo_cups" name="codigo_cups">
                                <option></option>
                                @if(!empty($cup))
                                    <option value="{{ $cup->code }}" selected>{{ $cup->nombre }}</option>
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-7 col-xl-5 d-flex justify-content-between align-self-end input__box">
                            <label class="align-self-center" for="citas_activas">Número de citas activas por paciente</label>
                            <input type="number" id="citas_activas" name="citas_activas" value="{{ old('citas_activas', $servicio->citas_activas) }}"
                                   class="citas_activas @error('citas_activas') is-invalid @enderror"/>
                        </div>

                        <div class="col-md-5 col-xl-7 input__box pl-md-0">
                            <label for="tipo_atencion">Tipo de atención</label>
                            <select class="@error('tipo_atencion') is-invalid @enderror" id="tipo_atencion" name="tipo_atencion">
                                <option></option>
                                <option value="presencial" {{old('tipo_atencion', $servicio->tipo_atencion) == 'presencial' ? 'selected':''}}>Presencial</option>
                                <option value="virtual" {{old('tipo_atencion', $servicio->tipo_atencion) == 'virtual' ? 'selected':''}}>Virtual</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 d-flex">
                            <label class="mt-2">Agendamiento virtual</label>&nbsp;
                            <!-- Check box interactivo y personalizado -->
                            <div class="checkbox__blue">
                                <input type="checkbox" name="agendamiento_virtual" id="agendamiento_virtual" value="1" {{ old('agendamiento_virtual', $servicio->agendamiento_virtual) == 1 ? 'checked':'' }}>
                                <label class="label_check__blue" for="agendamiento_virtual">
                                    <b class="txt1">Desactivado</b>
                                    <b class="txt2">Activado</b>
                                </label>
                            </div>
                        </div>

                        <div class="col-12 input__box">
                            <label for="descripcion">Descripción</label>
                            <textarea name="descripcion" id="descripcion" class="@error('especialidad') is-invalid @enderror"
                                      rows="5">{{ old('descripcion', $servicio->descripcion) }}</textarea>
                        </div>
                        <div class="col-12">
                            <div class="d-flex align-items-center mt-4 py-2 pl-2" style="background: #eff3f3;">
                                <p class="fs_text_small black_light">Vincular convenios</p>
                                <input class="ml-4 mr-2 check__radio" type="radio" name="convenios" id="convenios-1"
                                       value="1" {{ (old('convenios', $servicio->convenios) == 1) ? 'checked':'' }}/>
                                <label class="fs_text_small black_light mb-0" for="convenios-1">Si</label>

                                <input class="ml-4 mr-2 check__radio" type="radio" name="convenios" id="convenios-0"
                                       value="0" {{ (old('convenios', $servicio->convenios) == 0) ? 'checked':'' }}/>
                                <label class="fs_text_small black_light mb-0" for="convenios-0">No</label>
                            </div>
                        </div>
                    </div>

                    <!-- Contenedor formato tabla de la lista de contactos -->
                    @php $old = old('convenios-lista', $lista) @endphp
                    <div id="table_servicio" class="containt_main_table mt-4 {{ (empty($old)) ? 'd-none':'' }}">
                        <div class="table-responsive">
                            <table class="table table_agenda" id="">
                                <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Valor a pagar convenio</th>
                                    <th>Valor a pagar paciente</th>
                                </tr>
                                </thead>

                                <tbody>
                                @if($convenios->isNotEmpty())
                                    @foreach($convenios as $convenio)
                                        <tr>
                                            <td class="check__box_green">
                                                <input type="checkbox" class="validar-convenio" {{ isset($old[$convenio->id]) ? 'checked':'' }} id="convenio-{{ $convenio->id }}">
                                                <label class="label_check_green" for="convenio-{{ $convenio->id }}">{{ $convenio->nombre_completo }}</label>
                                                <input type="hidden" name="convenios-lista[{{ $convenio->id }}][convenio_id]" value="{{ $convenio->id }}">
                                            </td>
                                            <td>
                                                <div class="input__box">
                                                    <div class="signo_peso"><span>$</span></div>
                                                    <input type="number" id="valor" name="convenios-lista[{{ $convenio->id }}][valor_paciente]"
                                                           value="{{ $old[$convenio->id]['valor_paciente'] ?? '' }}" class="valor-paciente @error("convenios-lista.{$convenio->id}.valor_paciente") is-invalid @enderror"/>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input__box">
                                                    <div class="signo_peso"><span>$</span></div>
                                                    <input type="number" id="valor" name="convenios-lista[{{ $convenio->id }}][valor_convenio]"
                                                           value="{{ $old[$convenio->id]['valor_convenio'] ?? '' }}" class="valor-convenio @error("convenios-lista.{$convenio->id}.valor_convenio") is-invalid @enderror"/>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="row m-0 mt-3 content_btn_right">
                        <a href="{{ route('profesional.configuracion.servicios.index') }}" class="button_transparent mr-2" style="color: #434343">Cancelar</a>
                        <button type="submit" class="button_blue">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>

    <script>
        // función para mostrar y ocultar la tabla de vincular convenios
        $(document).ready(function(){
            $("#convenios-1").click(function(){
                $("#table_servicio").removeClass('d-none').addClass('d-block');
            });

            $("#convenios-0").click(function(){
                $("#table_servicio").addClass('d-none').removeClass('d-block');
            });

            $('.validar-convenio').on('click', function () {
                var check = $(this);
                check.parents('tr').find('input[type=number],input[type=hidden]').prop('disabled', !check.prop('checked'));
            }).each(function (key, item) {
                var check = $(item);
                check.parents('tr').find('input[type=number],input[type=hidden]').prop('disabled', !check.prop('checked'));
            });

            $('#codigo_cups').select2({
                theme: 'bootstrap4',
                ajax: {
                    url: '{{ route('search-cups') }}',
                    data: function (params) {
                        // Query parameters will be ?search=[term]&type=public
                        return {
                            term: params.term
                        };
                    },
                    processResults: function (result) {
                        // Transforms the top-level key of the response object from 'items' to 'results'
                        return {
                            results: result.data
                        };
                    }
                }
            });

            $('.valor-paciente').change(function () {
                var input = $(this);
                var valor = $('#valor');

                if (!input.prop('disabled') && input.val() !== '' && valor.val() !== '')
                    input.parents('tr').find('.valor-convenio').val(valor.val() - input.val());
            });
        });
    </script>
@endsection
