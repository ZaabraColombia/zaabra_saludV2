@section('styles')
@endsection

@extends('instituciones.admin.layouts.layout')

@section('contenido')
    <div class="container-fluid p-0 pr-lg-4">
        <div class="containt_agendaProf">
            <div class="my-4 my-xl-5">
                <h1 class="title__xl green_bold">Servicios</h1>
            </div>


            <div class="containt_main_table mb-3">
                <form action="{{ route('institucion.configuracion.servicios.store') }}" method="post">
                    @csrf
                    {{--
                    <div class="d-block d-md-flex justify-content-between py-3">
                        <h2 class="subtitle__lg green_bold mb-4">Nuevo servicio</h2>
                        <!-- Check box interactivo y personalizado -->
                        <div class="checkbox">
                            <input type="checkbox" name="checkbox" id="conv_check">
                            <label class="label_check" for="conv_check">
                                <b class="txt1">Servicio inactivo</b>
                                <b class="txt2">Servicio activo</b>
                            </label>
                        </div>
                    </div>
                    --}}

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
                            <input type="number" id="duracion" name="duracion" value="{{ old('duracion') }}"
                                   class="@error('duracion') is-invalid @enderror"/>
                        </div>

                        <div class="col-md-4 input__box">
                            <label for="descanso">Descanso (minuto)</label>
                            <input type="number" id="descanso" name="descanso" value="{{ old('descanso') }}"
                                   class="@error('descanso') is-invalid @enderror"/>
                        </div>

                        <div class="col-md-4 input__box">
                            <label for="valor">Valor</label>
                            <input type="number" id="valor" name="valor" value="{{ old('valor') }}"
                                   class="@error('valor') is-invalid @enderror"/>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 input__box">
                            <label for="nombre">Nombre</label>
                            <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}"
                                   class="@error('nombre') is-invalid @enderror"/>
                        </div>

                        <div class="col-md-6 input__box">
                            <label for="especialidad_id">Especialidad</label>
                            <select class="@error('especialidad_id') is-invalid @enderror" id="especialidad_id"
                                    name="especialidad_id">
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
                            <label for="tp_servicio">Tipo de servicio</label>
                            <select class="@error('tp_servicio') is-invalid @enderror" id="tp_servicio"
                                    name="tp_servicio" value="{{ old('tp_servicio') }}">
                                <option value=""></option>
                                <option value="Consulta por primera vez">Consulta por primera vez</option>
                                <option value="Consulta de control">Consulta de control</option>
                                <option value="Procedimiento quirúrgico">Procedimiento quirúrgico</option>
                                <option value="Procedimiento no quirúrgico">Procedimiento no quirúrgico</option>
                            </select>
                        </div>

                        <div class="col-md-8 input__box">
                            <label for="cups">CUPS</label>
                            <select class="@error('cups') is-invalid @enderror" id="cups"
                                    name="cups" value="{{ old('cups') }}">
                                <option value=""></option>
                                <option value="cups 1">cups 1</option>
                                <option value="cups 2">cups 2</option>
                                <option value="cups 3">cups 3</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-7 col-xl-5 d-flex justify-content-between align-self-end input__box">
                            <label class="align-self-center" for="">Número de citas activas por paciente</label>
                            <input type="number" id="" name="" value="{{ old('') }}"
                                class="citas_activas @error('') is-invalid @enderror"/>
                        </div>

                        <div class="col-md-5 col-xl-7 input__box pl-md-0">
                            <label for="metodo">Método</label>
                            <select class="@error('metodo') is-invalid @enderror" id="metodo"
                                    name="metodo" value="{{ old('metodo') }}">
                                <option value=""></option>
                                <option value="Presencial">Presencial</option>
                                <option value="Virtual">Virtual</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 input__box">
                            <label for="descripcion">Descripción</label>
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
                        {{--<div class="row m-0">
                            <div class="col-md-9 input__box">
                                <label for="convenio">Convenio</label>
                                <select class="@error('convenio') is-invalid @enderror" id="convenio"
                                        name="convenio" value="{{ old('convenio') }}">
                                    @if($convenios->isNotEmpty())
                                    @foreach($convenios as $convenio)
                                    <option value="{{ $convenio->id }}">{{ $convenio->nombre_completo }}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-3 p-0 pt-3 content_btn_right">
                                <a href="" class="button_green" id="">
                                    Agregar
                                </a>
                            </div>
                        </div>--}}

                        <div class="table-responsive">
                            <table class="table table_agenda" id="">
                                <thead class="thead_green">
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
                                                <input id="name_convenio" type="checkbox" class="validar-convenio" {{ isset($old[$convenio->id]) ? 'checked':'' }} id="convenio-{{ $convenio->id }}">
                                                <label class="label_check_green" for="name_convenio">{{ $convenio->nombre_completo }}</label>
                                                <input type="hidden" name="convenios-lista[{{ $convenio->id }}][convenio_id]" value="{{ $convenio->id }}">
                                            </td>
                                            <td>
                                                <div class="input__box">
                                                    <div class="signo_peso"><span>$</span></div>
                                                    <input type="number" id="valor" name="convenios-lista[{{ $convenio->id }}][valor_convenio]"
                                                           value="{{ $old[$convenio->id]['valor_convenio'] ?? '' }}" class="@error("convenios-lista.{$convenio->id}.valor_convenio") is-invalid @enderror"/>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input__box">
                                                    <div class="signo_peso"><span>$</span></div>
                                                    <input type="number" id="valor" name="convenios-lista[{{ $convenio->id }}][valor_paciente]"
                                                           value="{{ $old[$convenio->id]['valor_paciente'] ?? '' }}" class="@error("convenios-lista.{$convenio->id}.valor_paciente") is-invalid @enderror"/>
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
                        <a href="" class="button_transparent mr-2" style="color: #434343">Cancelar</a>
                        <button type="submit" class="button_green">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
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
        });
    </script>
@endsection
