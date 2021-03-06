@extends('instituciones.admin.layouts.layout')

@section('styles')
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2-bootstrap4.min.css') }}">
@endsection

@section('contenido')
    <div class="container-fluid p-0 pr-lg-4">
        <div class="containt_agendaProf">
            <div class="my-4 my-xl-5">
                <h1 class="title__xl green_bold">Servicios</h1>
            </div>


            <div class="containt_main_table mb-3">
                <form action="{{ route('institucion.configuracion.servicios.store') }}" method="post">
                    @csrf

                    <div class="d-block d-md-flex justify-content-between py-3">
                        <h2 class="subtitle__lg green_bold mb-4">Nuevo servicio</h2>
                        <!-- Check box interactivo y personalizado -->
                        <div class="checkbox">
                            <input type="checkbox" name="estado" id="estado" value="1"
                                {{ (old('estado') == 1) ? 'checked':'' }}/>
                            <label class="label_check" for="estado">
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
                    </div>
                    <div class="row">
                        <div class="col-md-6 input__box">
                            <label for="nombre">Nombre</label>
                            <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}"
                                   class="@error('nombre') is-invalid @enderror" required/>
                        </div>

                        <div class="col-md-6 input__box">
                            <label for="especialidad_id">Especialidad</label>
                            <select class="@error('especialidad_id') is-invalid @enderror" id="especialidad_id"
                                    name="especialidad_id" required>
                                @if($especialidades->isNotEmpty())
                                    @foreach($especialidades as $especialidad)
                                        <option value="{{ $especialidad->idEspecialidad }}" {{ old('especialidad_id') == $especialidad->idEspecialidad ? 'checked':null }}>{{ $especialidad->nombreEspecialidad }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 input__box">
                            <label for="duracion">Duraci??n (minuto)</label>
                            <input type="number" id="duracion" name="duracion" value="{{ old('duracion') }}"
                                   class="@error('duracion') is-invalid @enderror" required/>
                        </div>

                        <div class="col-md-4 input__box">
                            <label for="descanso">Descanso (minuto)</label>
                            <input type="number" id="descanso" name="descanso" value="{{ old('descanso') }}"
                                   class="@error('descanso') is-invalid @enderror" required/>
                        </div>

                        <div class="col-md-4 input__box">
                            <label for="valor">Valor</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend signo_peso">
                                    <span class="input-group-text">$</span>
                                </div>
                                <input type="text" id="valor" name="valor" value="{{ old('valor') }}"
                                       class="form-control mask-money @error('valor') is-invalid @enderror"/>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 input__box">
                            <label for="tipo_servicio_id">Tipo de servicio</label>
                            <select class="@error('tipo_servicio_id') is-invalid @enderror" id="tipo_servicio_id" name="tipo_servicio_id" required>
                                <option></option>
                                @if($tipo_servicios->isNotEmpty())
                                    @foreach($tipo_servicios as $tipo_servicio)
                                        <option value="{{ $tipo_servicio->id }}" {{ old('tipo_servicio_id') == $tipo_servicio->id ? 'selected':'' }}>{{ $tipo_servicio->nombre }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="col-md-8 input__box">
                            @php $codigo_cups = old('codigo_cups'); $cup = !empty($codigo_cups) ? \App\Models\Cups::query()->where('code', 'like', "%$codigo_cups")->first():null @endphp
                            <label for="codigo_cups">CUPS</label>
                            <select class="@error('codigo_cups') is-invalid @enderror" id="codigo_cups" name="codigo_cups" required>
                                @if(!empty($cup))
                                    <option value="{{ $cup->code }}" selected>{{ $cup->nombre }}</option>
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-7 col-xl-5 d-flex justify-content-between align-self-end input__box">
                            <label class="align-self-center" for="citas_activas">N??mero de citas activas por paciente</label>
                            <input type="number" id="citas_activas" name="citas_activas" value="{{ old('citas_activas') }}"
                                class="citas_activas @error('citas_activas') is-invalid @enderror" required/>
                        </div>

                        <div class="col-md-5 col-xl-7 input__box pl-md-0">
                            <label for="tipo_atencion">Tipo de atenci??n</label>
                            <select class="@error('tipo_atencion') is-invalid @enderror" id="tipo_atencion" name="tipo_atencion" required>
                                <option></option>
                                <option value="presencial" {{old('tipo_atencion') == 'presencial' ? 'selected':''}}>Presencial</option>
                                <option value="virtual" {{old('tipo_atencion') == 'virtual' ? 'selected':''}}>Virtual</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 d-flex">
                            <label class="mt-2">Agendamiento virtual</label>&nbsp;
                            <!-- Check box interactivo y personalizado -->
                            <div class="checkbox">
                                <input type="checkbox" name="agendamiento_virtual" id="agendamiento_virtual" value="1" {{ old('agendamiento_virtual') == 1 ? 'checked':'' }}>
                                <label class="label_check" for="agendamiento_virtual">
                                    <b class="txt1">Desactivado</b>
                                    <b class="txt2">Activado</b>
                                </label>
                            </div>
                        </div>
                        <div class="col-12 input__box">
                            <label for="descripcion">Descripci??n</label>
                            <textarea name="descripcion" id="descripcion" class="@error('especialidad') is-invalid @enderror"
                                      rows="5">{{ old('descripcion') }}</textarea>
                        </div>
                        <div class="col-12">
                            <div class="d-flex align-items-center mt-4 py-2 pl-2" style="background: #eff3f3;">
                                <p class="fs_text_small black_light">Vincular convenios</p>
                                <input class="ml-4 mr-2 check__radio" type="radio" name="convenios" id="convenios-1"
                                       value="1" {{ (old('convenios') == 1) ? 'checked':'' }}/>
                                <label class="fs_text_small black_light mb-0" for="convenios-1">Si</label>

                                <input class="ml-4 mr-2 check__radio" type="radio" name="convenios" id="convenios-0"
                                       value="0" {{ (old('convenios') == 0) ? 'checked':'' }}/>
                                <label class="fs_text_small black_light mb-0" for="convenios-0">No</label>
                            </div>
                        </div>
                    </div>

                    <!-- Contenedor formato tabla de la lista de contactos -->
                    @php $old = old('convenios-lista') @endphp
                    <div id="table_servicio" class="containt_main_table mt-4 {{ (empty($old)) ? 'd-none':'' }}">
                        <div class="table-responsive">
                            <table class="table table_agenda" id="">
                                <thead class="thead_green">
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Valor a pagar paciente</th>
                                        <th>Valor restante a pagar convenio</th>
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
                                                    <input type="text" id="valor" name="convenios-lista[{{ $convenio->id }}][valor_paciente]"
                                                           value="{{ $old[$convenio->id]['valor_paciente'] ?? '' }}" class="valor-paciente mask-money @error("convenios-lista.{$convenio->id}.valor_paciente") is-invalid @enderror"/>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input__box">
                                                    <div class="signo_peso"><span>$</span></div>
                                                    <input type="text" id="valor" name="convenios-lista[{{ $convenio->id }}][valor_convenio]"
                                                           value="{{ $old[$convenio->id]['valor_convenio'] ?? '' }}" class="valor-convenio mask-money @error("convenios-lista.{$convenio->id}.valor_convenio") is-invalid @enderror"/>
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
                        <a href="{{ route('institucion.configuracion.servicios.index') }}" class="button_transparent mr-2" style="color: #434343">Cancelar</a>
                        <button type="submit" class="button_green">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-mask/jquery.mask.min.js') }}"></script>

    <script>
        // funci??n para mostrar y ocultar la tabla de vincular convenios
        $(document).ready(function(){
            $("#convenios-1").click(function(){
                $("#table_servicio").removeClass('d-none').addClass('d-block');
            });

            $("#convenios-0").click(function(){
                $("#table_servicio").addClass('d-none').removeClass('d-block');
            });

            $('.validar-convenio').on('click', function () {
                var check = $(this);
                check.parents('tr').find('input[type=number], input[type=text], input[type=hidden]').prop('disabled', !check.prop('checked'));
            }).each(function (key, item) {
                var check = $(item);
                check.parents('tr').find('input[type=number], input[type=text], input[type=hidden]').prop('disabled', !check.prop('checked'));
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

            //Mascara
            $('.mask-money').mask('000.000.000.000.000', {reverse: true});

            $('.valor-paciente').change(function () {
                var input = $(this);
                var valor = $('#valor');
                var cantidad = valor.val().replace('.', '');
                var cantidad_paciente = input.val().replace('.', '');

                if (!input.prop('disabled') && cantidad_paciente !== '' && cantidad !== '')
                    input.parents('tr').find('.valor-convenio').val(cantidad - cantidad_paciente).trigger('input');
            });
        });
    </script>
@endsection
