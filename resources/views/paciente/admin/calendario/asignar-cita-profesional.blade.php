@extends('paciente.admin.layouts.layout')

@section('styles')
    <!-- Libreria de calendar_date min.css -->
    <link rel="stylesheet" href="{{ asset('plugins/pg-calendar-master/dist/css/pignose.calendar.min.css') }}">
@endsection

@section('contenido')
    @php
    $user = Auth::user();
    @endphp
    <div class="container-fluid px-lg-0">
        @if(isset($profesional))
            <div class="content_row">
                <div id="data-eventos-profesional" data-events='[{"id":0,"title":"Medicina","profesional":"Jorge Machado","start":"2021-08-21","tipo_cita":"Virtual","allDay":true},{"id":1,"title":"Medicina","profesional":"Jorge Machado","start":"2021-08-22","tipo_cita":"Virtual","allDay":true},{"id":2,"title":"Odontologia","profesional":"Jhoana Gutierres","start":"2021-08-23","tipo_cita":"Prensencial","allDay":true},{"id":3,"title":"Odontologia","profesional":"Jhoana Gutierres","start":"2021-08-24","tipo_cita":"Prensencial","allDay":true}]'></div>
                <!-- Información del Profesional -->
                <div class="col_flex w_lg_35">
                    <div class="content_img_center w_md_35">
                        <img src="{{ asset($profesional->fotoperfil) }}">
                    </div>

                    <div class="w_md_65 w_lg_100">
                        <h2 class="fs_title_module blue_bold" id="nombre_profesional-paciente">
                            {{$profesional->user->nombre_completo }}
                        </h2>
                        <h4 class="fs_subtitle_module black_bold mb-0" id="especialidad_profesional-paciente">{{$profesional->nombreEspecialidad}}</h4>
                        <h5 class="fs_text gray_light">{{$profesional->nombreuniversidad}}</h5>
                        <h5 class="fs_text gray_bold">N° Tarjeta profesional: {{$profesional->numeroTarjeta}}</h5>

                        <h5 class="fs_text gray_light"><i></i>{{ $profesional->direccion }}</h5>
                        <h5 class="fs_text gray_light">{{ $profesional->nombre }}</h5>

                        <!-- sección datos consulta perfil profesional-->
                        <div class="mt-2 mb-3 w_md_85 w_lg_100 w_xl_90">
                            <h3 class="fs_subtitle_module black_bold text-center">Tipo de consulta</h3>
                            <div class="list__form_column">
                                <ul>
                                    @if(!empty($profesional->tipo_consultas))
                                        @foreach ($profesional->tipo_consultas as $consulta)
                                            <li>
                                                <p class="fs_text_small gray_light menu_{{$loop->iteration}}"><i></i>{{$consulta->nombreconsulta}}</p>
                                                <span class="fs_text_small gray_light"><i></i>${{number_format($consulta->valorconsulta, 0, ",", ".") }}</span>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="content_row w_lg_65">
                    <div class="col_flex col_flex_md">
                        <div class="calendar w-100"></div>
                    </div>

                    <div class="content_row col_flex_md ml-md-auto mt-lg-2">
                        <div class="col_flex">
                            <div class="mt-4 mb-3 mt-md-0">
                                <span class="badge rounded-pill bg-primary mb-3">Días disponibles</span>
                                <span class="badge rounded-pill bg-secondary mb-3">Días no disponibles</span>
                                <span class="badge rounded-pill bg-success mb-3">Días seleccionados</span>
                            </div>
                        </div>

                        <div class="col_block mb-3 mt-md-1 mb-md-0 mt-lg-0">
                            <form action="{{ route('paciente.finalizar-cita-profesional', ['profesional' => $profesional->slug]) }}"
                                  method="post" id="form-finalizar-cita-profesional">
                                <div class="input__box mb-3">
                                    <label for="modalidad">Modalidad de pago</label>
                                    <select id="modalidad" class="form-control" name="modalidad" required>
                                        <option value="Presencial"> Presencial </option>
                                        <option value="Virtual"> Virtual </option>
                                    </select>
                                </div>
                                <div class="input__box mb-3">
                                    <label for="tipo_cita">Tipo de cita</label>
                                    <select id="tipo_cita" class="form-control" name="tipo_cita" required>
                                        <option></option>
                                        @if(!empty($profesional->tipo_consultas))
                                            @foreach ($profesional->tipo_consultas as $consulta)
                                                <option value="{{ $consulta->id }}" data-valor="{{ $consulta->valorconsulta }}">{{ $consulta->nombreconsulta }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="input__box mb-3">
                                    <label for="hora">Hora de la cita</label>
                                    <select id="hora" name="hora"  class="form-control" required></select>
                                </div>

                                <div class="row m-0 content_btn_right">
                                    <button type="submit" class="button_blue" data-toggle="modal" data-target="#exampleModal">Finalizar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="fs_title_module black_bold" id="exampleModalLabel">Detalles de la cita</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <h5 class="profesional">Fernando Alexander Sandoval Gutierrez</h5>
                        <h5>Cc 1033456847</h5>
                    </div>
                    <div>
                        <h5 class="profesional">Dr(a). {{$profesional->user->nombre_completo }}</h5>
                        <h5>{{$profesional->numerodocumento }}</h5>
                        <h5 id="modal-tipo-de-cita"></h5>
                        <h5 id="modal-horario"></h5>
                        <h5>{{ $profesional->direccion }}</h5>
                        <h5>Valor cita: <span id="modal-valor"></span></h5>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="modal-boton">Guardar</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/pg-calendar-master/dist/js/pignose.calendar.min.js') }}"></script>

    <script>
        $(function() {

            var weekNotBusiness = {!! json_encode($weekDisabled) !!};

            $('.calendar').pignoseCalendar({
                lang: 'es',
                minDate: '{{ date('Y-m-d') }}',
                /*maxDate: '2022-06-24',*/
                disabledWeekdays: weekNotBusiness, // WEDNESDAY (0)
                disabledDates: [],
                disabledRanges: [
                    //['2022-04-07', '2022-04-22'], // 2022-04-07 ~ 22
                ],
                select: function (date, context) {
                    //onsole.log(date[0]._i);
                    var hora = $('#hora');
                    hora.html('<option></option>');

                    if (date[0] !== null && date[0] !== undefined )
                    {
                        $.ajax({
                            data: { date: date[0]._i},
                            dataType: 'json',
                            url: '{{ route('paciente.dias-libre-profesional', ['profesional' => $profesional->slug]) }}',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            method: 'POST',
                            success: function (res) {

                                //get list
                                $.each(res.data, function (index, item) {
                                    hora.append('<option value=\'{"start":"' + item.startTime + '","end": "' + item.endTime + '"}\'>' +
                                        moment(item.startTime).format('hh:mm A') + '-' + moment(item.endTime).format('hh:mm A') +
                                        '</option>');
                                });
                            },
                            error: function (res, status) {
                                var response = res.responseJSON;
                                $('#alerta-general').html(alert(response.message, 'danger'));
                            }
                        });
                    }
                }
            });

        });
    </script>
@endsection
