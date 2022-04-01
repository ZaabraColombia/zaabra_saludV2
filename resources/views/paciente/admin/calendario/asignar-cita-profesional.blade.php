@extends('paciente.admin.layouts.layout')
    <style>
        select option {
            letter-spacing: 15px;
        }
    </style>
@section('styles')
    <!-- Librería de calendar_date min.css -->
    <link rel="stylesheet" href="{{ asset('plugins/pg-calendar-master/dist/css/pignose.calendar.min.css') }}">
@endsection

@section('contenido')
    @php
        $user = Auth::user();
    @endphp
    <div class="container-fluid content_asig_cita">
        @if(isset($profesional))
            <div class="content_row">
                <div class="col_flex w_lg_35" id="alertas">
                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="alert-heading">Error</h4>
                            <p>{{ collect($errors->all())->implode('<br>') }}</p>
                        </div>
                    @endif
                </div>
            </div>
            <div class="content_row">
                <!-- Información del Profesional -->
                <div class="col_flex w_lg_35 mb-md-4">
                    <div class="content_img_center w_md_35">
                        <img src="{{ asset($profesional->fotoperfil) }}">
                    </div>

                    <div class="w_md_65 w_lg_100">
                        <h2 class="fs_title_module blue_bold" id="nombre_profesional-paciente">
                            {{$profesional->user->nombre_completo }}
                        </h2>
                        <h4 class="fs_subtitle_module black_bold mb-0" id="especialidad_profesional-paciente">{{ $profesional->especialidad->nombreEspecialidad ?? null }}</h4>
                        <h5 class="fs_text gray_light">{{$profesional->universidad->nombreuniversidad}}</h5>
                        <h5 class="fs_text gray_bold">N° Tarjeta profesional: {{$profesional->numeroTarjeta}}</h5>

                        <h5 class="fs_text gray_light"><i></i>{{ $profesional->direccion }}</h5>
                        <h5 class="fs_text gray_light">{{ $profesional->nombre }}</h5>

                        <!-- sección datos consulta perfil profesional-->
                        <div class="mt-2 mb-3 w_md_85 w_lg_100 w_xl_90">
                            <h3 class="fs_subtitle_module black_bold">Tipo de consulta</h3>
                            <div class="list__form_column">
                                <ul>
                                    @if(!empty($profesional->tipo_consultas))
                                        @foreach ($profesional->tipo_consultas as $consulta)
                                            <li>
                                                <p class="fs_text_small gray_light menu_{{$loop->iteration}}"><i></i>{{$consulta->nombreconsulta}}</p>
                                                <span class="fs_text_small gray_light"><i></i>${{ number_format($consulta->valorconsulta, 0, ",", ".") }}</span>
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
                                <span class="badge rounded-pill bg-primary mb-3 w-100">Días disponibles</span>
                                <span class="badge rounded-pill bg-secondary mb-3 w-100">Días no disponibles</span>
                                <span class="badge rounded-pill bg-success mb-3 w-100">Días seleccionados</span>
                            </div>
                        </div>

                        <div class="col_block mb-3 mt-md-1 mb-md-0 mt-lg-0">
                            <form action="{{ route('paciente.finalizar-cita-profesional', ['profesional' => $profesional->slug]) }}"
                                  method="post" id="form-finalizar-cita-profesional">
                                @csrf
                                <div class="input__box mb-3">
                                    <label for="modalidad">Modalidad de pago</label>
                                    <select id="modalidad" class="form-control" name="modalidad" required>
                                        <option value="virtual">Virtual</option>
                                        @if(!empty($antiguedad) and $antiguedad->confirmacion == true)
                                            <option value="presencial" id="option-presencial"> Presencial </option>
                                        @endif
                                    </select>
                                </div>
                                <div class="input__box mb-3">
                                    <label for="tipo_cita">Tipo de cita</label>
                                    <select id="tipo_cita" class="form-control" name="tipo_cita" required>
                                        <option></option>
                                        @if(!empty($profesional->tipo_consultas))
                                            @foreach ($profesional->tipo_consultas as $consulta)
{{--                                                @if(!empty($antiguedad) and $antiguedad->confirmacion == true)--}}
                                                @if($consulta->nombreconsulta == 'Control' and !empty($antiguedad) and $antiguedad->confirmacion == true)
                                                    <option value="{{ $consulta->id }}" data-valor="${{ number_format($consulta->valorconsulta, 0, ",", ".") }}" id="option-control">
                                                        {{ $consulta->nombreconsulta }}
                                                    </option>
                                                @elseif($consulta->nombreconsulta != 'Control')
                                                    <option value="{{ $consulta->id }}" data-valor="${{ number_format($consulta->valorconsulta, 0, ",", ".") }}">{{ $consulta->nombreconsulta }}</option>
                                                @endif
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="input__box mb-3">
                                    <label for="hora">Hora de la cita</label>
                                    <select id="hora" name="hora"  class="form-control" required></select>
                                </div>

                                <div class="row m-0 content_btn_right">
                                    <button type="button" class="button_blue" id="btn-finalizar-cita-profesional">
                                        Confirmar
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- Modal Detalle de la cita-->
    <div class="modal fade" id="confirmar-cita" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content modal_container">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <h1 class="fs_subtitle_module">Detalle de la cita</h1>

                    <div class="modal_info_cita">
                        <div class="d-flex blue_lighter mb-2">
                            <i data-feather="user"></i>
                            <h5 class="pt-1 pl-2 font_roboto blue_lighter fs_text mb-0">Paciente</h5>
                        </div>
                        <h5 class="fs_text_small profesional">{{ $user->nombre_completo }}</h5>
                        <h5 class="fs_text_small">{{ $user->numerodocumento }}</h5>
                    </div>

                    <div class="modal_info_cita mt-2">
                        <div class="d-flex blue_lighter mb-2">
                            <i data-feather="trello"></i>
                            <h5 class="pt-1 pl-2 font_roboto blue_lighter fs_text mb-0">Consulta</h5>
                        </div>
                        <h5 class="fs_text_small black_strong profesional">Dr(a). {{$profesional->user->nombre_completo }}</h5>
                        <h5 class="fs_text_small">{{$profesional->numerodocumento }}</h5>
                        <h5 class="fs_text_small black_strong">Tipo de cita:&nbsp;&nbsp;<span id="modal-tipo-de-cita" class="text-uppercase"></span></h5>
                        <h5 class="fs_text_small">Fecha:&nbsp;&nbsp;<span id="modal-fecha"></span> </h5>
                        <h5 class="fs_text_small">Hora:&nbsp;&nbsp;<span id="modal-horario"></span> </h5>
                        <h5 class="fs_text_small">Dirección:&nbsp;&nbsp;{{ $profesional->direccion }}</h5>
                        <h5 class="fs_text_small black_strong">Valor cita:&nbsp;&nbsp;<span id="modal-valor"></span></h5>
                    </div>
                </div>
                <div class="modal-footer content_btn_center">
                    <button type="button" class="button_transparent" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="button_blue" id="btn_confirmar_cita">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal static de pregunta-->
    @empty($antiguedad)
        <div class="modal fade" id="modal_antiguedad" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title fs_title_module black_bold" id="staticBackdropLabel">Asignación de citas</h2>
                    </div>
                    <div class="modal-body">
                        <div>
                            <h3 class="text-center fs_subtitle_module blue_light">¡Bienvenido!</h3>
                            <h3 class="text-center fs_subtitle black_bold">Sr(a). {{ Auth::user()->nombre_completo }}</h3>
                        </div>

                        <p class="text-center fs_text black_light">
                            Este es su primer agendamiento de cita para la consulta de {{ $profesional->especialidad->nombreEspecialidad }}.
                        </p>

                        <div class="d-flex justify-content-center mt-3">
                            <span class="d-flex align-items-center fs_text black_bold"> <i class="fas fa-stethoscope mr-2"></i> Especialista: &nbsp;</span>
                            <span class="d-flex fs_text black_light">{{ $profesional->user->nombre_completo }}</span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="button_blue" data-confirmacion="1">Si</button>
                        <button class="button_transparent ml-2" data-confirmacion="0">No</button>
                    </div>
                </div>
            </div>
        </div>
    @endempty
@endsection

@section('scripts')
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/pg-calendar-master/dist/js/pignose.calendar.min.js') }}"></script>

    <script src="{{ asset('js/alertas.js') }}"></script>

    <script>
        var weekNotBusiness = {!! json_encode($weekDisabled) !!};

        $('.calendar').pignoseCalendar({
            lang: 'es',
            initialize: false,
            minDate: '{{ date('Y-m-d') }}',
            /*maxDate: '2022-06-24',*/
            disabledWeekdays: weekNotBusiness, // WEDNESDAY (0)
            disabledDates: [],
            disabledRanges: [
                //['2022-04-07', '2022-04-22'], // 2022-04-07 ~ 22
            ],
            select: function (date, context) {
                console.log(date[0]);
                var hora = $('#hora');
                hora.html('<option></option>');

                if (date[0]._i !== null && date[0]._i !== undefined )
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
                                    moment(item.startTime).format('hh:mm  A') + '&nbsp;&nbsp;-&nbsp;&nbsp;' + moment(item.endTime).format('hh:mm  A') +
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

        $('#btn-finalizar-cita-profesional').click(function (e) {
            e.preventDefault();

            var modal = $('#confirmar-cita');

            var horario = $.parseJSON($('#hora').val());
            var tipo_cita = $('#tipo_cita');
            var modalidad = $('#modalidad');
            var btn_confirmar_cita = $('#btn_confirmar_cita');

            if (
                horario !== undefined && horario !== null &&
                modalidad.val() !== undefined && modalidad.val() !== null &&
                tipo_cita.val() !== undefined && tipo_cita.val() !== null
            )
            {
                $('#modal-fecha').html(moment(horario.start, 'YYYY-MM-DD HH:mm').format('DD-MMM /YYYY'));
                $('#modal-horario').html(moment(horario.start, 'YYYY-MM-DD HH:mm').format('hh:mm A')
                    + ' - ' + moment(horario.end, 'YYYY-MM-DD HH:mm').format('hh:mm A'));
                $('#modal-tipo-de-cita').html(tipo_cita.find('option:selected').html());
                $('#modal-valor').html(tipo_cita.find('option:selected').data('valor'));

                btn_confirmar_cita.html((modalidad.val() === 'presencial') ? 'Finalizar':'Pagar')

                modal.modal('show');
            } else {
                $('#alertas').html(alert({title: "Error", text:"No se pudo completar el agendamiento, revisa la información"}, 'danger'));
            }

        });

        $('#btn_confirmar_cita').click(function (e) {
            $('#form-finalizar-cita-profesional').submit();
        });

        @empty($antiguedad)
        $('#modal_antiguedad').modal()
            .on('click', 'button', function (e) {
                var btn = $(this);

                $.ajax({
                    url: '{{ route('paciente.confirmar-antiguedad-profesional', ['profesional' => $profesional->idPerfilProfesional]) }}',
                    //Verdadero primera vez
                    data: {antiguedad:btn.data('confirmacion')},
                    type: 'post',
                    dataType: 'json',
                    success: function (response) {
                        if (btn.data('confirmacion')) {
                            $('#option-presencial, #option-control').remove();
                        }else{
                            $('#modalidad').append('<option value="presencial"> Presencial </option>');
                        }
                        $('#modal_antiguedad').modal('hide');
                    },
                    error: function (error) {
                    }
                });
            });
        @endempty

    </script>
@endsection
