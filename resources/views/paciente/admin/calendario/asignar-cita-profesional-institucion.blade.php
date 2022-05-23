@extends('paciente.admin.layouts.layout')

@section('styles')
    <!-- Librería de calendar_date min.css -->
    <link rel="stylesheet" href="{{ asset('plugins/pg-calendar-master/dist/css/pignose.calendar.min.css') }}">
@endsection

@section('contenido')
    @php
        $user = Auth::user();
    @endphp
    <div class="container-fluid content_asig_cita">

        <div class="content_row">
            <h2 class="fs_title_module green_bold mt-3 title__img_inst" id="nombre_profesional-paciente">
                {{ $profesional->institucion->user->nombreinstitucion }}
            </h2>
            <!-- Información Institución -->
            <div class="container__inst">
                <div class="content__img_inst">
                    <img src='{{ asset($profesional->institucion->imagen) }}' alt="" class="img__inst">
                </div>

                <div class="content__info_inst">
                    <h5 class="fs_text_small black_strong">{{ $profesional->institucion->url }}</h5>
                    <h5 class="fs_text_small black_strong">{{ $profesional->sede->telefono ?? ''}}</h5>
                    <h5 class="fs_text_small black_strong">{{ $profesional->sede->direccion ?? ''}}</h5>
                    <h5 class="fs_text_small black_strong">{{ $profesional->sede->ciudad->nombre ?? ''}}</h5>
                </div>

                <div class="content__img_prof">
                    <div class="img__prof">
                        <img src='{{ asset($profesional->foto_perfil_institucion) }}'>
                    </div>
                </div>
            </div>
        </div>

        <div class="content_row">
            <div class="col-12 w_lg_35" id="alertas">
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

        <div class="content_row mt_md_lg">
            <!-- Información del Profesional -->
            <div class="col_flex w_lg_35 align_between_1300">
                <div class="content_img_center">
                    <img src='{{ asset($profesional->foto_perfil_institucion) }}'>
                </div>

                <div class="w-100 w_md_65 w_lg_100 pl-md-3">
                    <h2 class="fs_title_module green_bold mt-3" id="nombre_profesional-paciente">
                        Dr.(a) {{ $profesional->nombre_completo }}
                    </h2>
                    <h4 class="fs_subtitle_module black_bold mb-0"
                        id="">{{ $profesional->especialidad_principal->nombreEspecialidad ?? '' }}</h4>
                    <h5 class="fs_text gray_light">{{ $profesional->universidad->nombreuniversidad }}</h5>
                    <h5 class="fs_text gray_light">{{ "{$profesional->sede->direccion} ({$profesional->sede->ciudad->nombre})" }}</h5>
                    <!-- sección datos consulta perfil profesional-->
                    <div class="mt-2 mb-3 mb-md-0 w_md_50 w_lg_100">
                        <h3 class="fs_subtitle_module black_bold">Servicio</h3>

                        <div class="d-flex justify-content-between pr-xl-3">
                            {{--<input type="hidden" id="id_profesional" name="id_profesional">--}}
                            <div>
                                <p id="imp_serv" class="fs_text gray_light">Seleccione un servicio</p>
                                <span id="valor_servicio" class="fs_text gray_light"></span>
                            </div>
                            <div class="row m-0 content_btn_left">
                                <button type="button" class="button_green" id="" data-toggle="modal"
                                        data-target="#options_servicio">
                                    Cambiar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content_row w_lg_65 my__md align-items-center">
                <div class="col_flex col_flex_md">
                    <div class="calendar w-100"></div>
                </div>

                <div class="content_row col_flex_md ml-md-auto mt-lg-2 align_between_1300">
                    <div class="col_flex">
                        <div class="mt-4 mt-md-0 width_pill">
                            <span class="badge rounded-pill bg-primary mb-3 w-100">Días disponibles</span>
                            <span class="badge rounded-pill bg-secondary mb-3 w-100" style="opacity: .5;">Días no disponibles</span>
                            <span class="badge rounded-pill bg-success mb-3 w-100">Días seleccionados</span>
                        </div>
                    </div>

                    <div class="col_block mb-3 mt-md-1 mb-md-0 mt-lg-0">
                        <form
                            action="{{ route('paciente.finalizar-cita-institucion-profesional', ['profesional' => $profesional->slug]) }}"
                            method="post" id="form-finalizar-cita-profesional">
                            @csrf
                            @php
                                $date_calendar = old('date-calendar');
                                $tipo_servicio = old('tipo_servicio', request('servicio'));
                            @endphp
                            <input type="hidden" name="date-calendar" id="date-calendar"
                                   value="{{ $date_calendar }}">
                            <input type="hidden" name="tipo_servicio" id="servicio_prof_inst">
                            <div class="input__box mb-3">
                                <label for="modalidad">Modalidad de pago</label>
                                <select id="modalidad" class="form-control" name="modalidad" required>
                                    <option value="virtual" {{ old('modalidad') == 'virtual' ? 'selected':'' }}>
                                        Virtual
                                    </option>
                                    @if(isset($activar_presencial) and $activar_presencial)
                                        <option value="presencial"
                                                id="option-presencial" {{ old('modalidad') == 'presencial' ? 'selected':'' }}>
                                            Presencial
                                        </option>
                                    @endif
                                </select>
                            </div>
                            {{--
                            <div class="input__box mb-3">
                                <label for="tipo_servicio">Tipo de servicio</label>
                                <select id="tipo_servicio" class="form-control" name="tipo_servicio" required>
                                    <option></option>
                                    @if(!empty($servicios))
                                    @foreach ($servicios as $servicio)
                                    <option value="{{ $servicio->id }}"
                                            data-valor="{{ number_format($servicio->valor, 0, ',', '.') }}">{{ $servicio->nombre }}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                            --}}

                            <div class="">
                                <label for="convenio">Convenio</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <input type="checkbox" id="check-convenio" name="check-convenio" value="1">
                                        </div>
                                    </div>
                                    <select class="custom-select" id="convenio" name="convenio" disabled></select>
                                </div>
                            </div>

                            <div class="input__box mb-3">
                                <label for="hora">Hora de la cita</label>
                                <select id="hora" name="hora" class="form-control" required></select>
                            </div>

                            <div class="row m-0 content_btn_right">
                                <button type="button" class="button_green" id="btn-finalizar-cita-profesional">
                                    Finalizar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="confirmar-cita" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content modal_container">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <h1 class="" id="exampleModalLabel">Detalles de la cita</h1>

                    <h5 class="profesional">{{ $user->nombre_completo }}</h5>
                    <h5>{{ "{$user->tipo_documento->nombre_corto}" }}
                        : {{ number_format($user->numerodocumento, 0, ",", ".") }}</h5>
                    <div>
                        <h5 class="profesional">Dr(a). {{ $profesional->nombre_completo }}</h5>
                    <!-- <h5>{{ "{$user->tipo_documento->nombre_corto}" }}:</h5> -->
                        <h5 id="modal-tipo-de-cita"></h5>
                        <h5>Fecha: &nbsp;<span id="modal-fecha"></span></h5>
                        <h5>Hora cita: &nbsp;<span id="modal-hora"></span></h5>
                        <h5>Dirección de atención: &nbsp;
                            <span>{{ ($profesional->sede->direccion ?? $profesional->institucion->direccion) }}

                                (Consultorio {{ $profesional->consultorio }})
                                ({{ $profesional->sede->ciudad->nombre ?? $profesional->institucion->ciudad->nombre }})
                            </span>
                        </h5>
                        <h5>Valor cita: &nbsp;<span id="modal-valor"></span></h5>
                    </div>
                </div>

                <div class="modal-footer content_btn_center">
                    <button type="button" class="button_transparent" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="button_green" id="btn_confirmar_cita">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal static de pregunta-->
    @empty($antiguedad)
        <div class="modal fade" id="modal_antiguedad" data-backdrop="static" data-keyboard="false" tabindex="-1"
             aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title fs_title" id="staticBackdropLabel">Asignación de citas</h2>
                    </div>
                    <div class="modal-body">
                        <div>
                            <h3 class="text-center fs_subtitle blue_bold">¡Bienvenido!</h3>
                            <h3 class="text-center fs_subtitle black_light">Sr(a). {{ $user->nombre_completo }}</h3>
                        </div>
                        <br>
                        <p class="text-center fs_text black_light">
                            ¿Este es su primer agendamiento con la institución <span
                                class="black_bold">{{ $profesional->institucion->user->nombreinstitucion }}</span>?.
                        </p>
                        <br>
                        <div>
                            <span class="fs_text black_bold"> Especialista: &nbsp;</span>
                            <span class="fs_text black_light">{{ $profesional->nombre_completo }}</span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="button_transparent" data-confirmacion="1">No</button>
                        <button class="button_blue ml-3" data-confirmacion="0">Si</button>
                    </div>
                </div>
            </div>
        </div>
    @endempty

    <!-- Modal Tipos de Servicios -->
    <div class="modal fade" id="options_servicio" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content modal_container">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <h1 class="mb-3" style="color: #019F86; font-weight: bold;" id="exampleModalLabel">Tipo de servicio</h1>
                    @if(!empty ($servicios))
                        @foreach($servicios as $servicio)
                            <div class="d-flex justify-content-between mb-3">
                                <div>
                                    <p id="servicio">{{ $servicio->nombre }}</p>
                                    <span>$ {{ number_format($servicio->valor, 0, ",", ".") }}</span>
                                </div>
                                <div class="row m-0 content_btn_left">
                                    <button type="button" class="button_green select_service"
                                            data-servicio="{{ $servicio->nombre }}"
                                            data-precio="$ {{ number_format($servicio->valor, 0, ',', '.') }}"
                                            data-id="{{ $servicio->id }}">
                                        Seleccionar
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/pg-calendar-master/dist/js/pignose.calendar.min.js') }}"></script>

    <script src="{{ asset('js/alertas.js') }}"></script>

    <script>
        var weekNotBusiness = {!! json_encode($weekDisabled) !!};
        //moment.locale('es'); // change the global locale to Spanish

        $('.calendar').pignoseCalendar({
            lang: 'es',
            initialize: false,
            minDate: '{{ date('Y-m-d') }}',
            maxDate: '{{ date('Y-m-d', strtotime(date('Y-m-d') . "+$disponibilidad days")) }}',
            /*maxDate: '2022-06-24',*/
            disabledWeekdays: weekNotBusiness, // WEDNESDAY (0)
            disabledDates: [],
            disabledRanges: [
                //['2022-04-07', '2022-04-22'], // 2022-04-07 ~ 22
            ],
            select: function (date, context) {

                var servicio = $('#servicio_prof_inst').val();

                var date_calendar = $('#date-calendar');
                date_calendar.val('');

                if (date[0] !== null && date[0]._i) date_calendar.val(date[0]._i);
                if (date[0] !== null && date[0]._i !== undefined && servicio !== '') dias_libres(date[0]._i, servicio);
            }
        });

        function dias_libres(fecha, servicio) {
            var hora = $('#hora');
            hora.html('<option></option>');

            //console.log('fecha ' + fecha);
            //console.log('servicio ' + servicio);
            $.ajax({
                data: {date: fecha, servicio: servicio},
                dataType: 'json',
                url: '{{ route('paciente.dias-libre-institucion-profesional', ['profesional' => $profesional->slug]) }}',
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
                    $('#alertas').html(alert(response.message, 'danger'));
                }
            });
        }

        $('#btn-finalizar-cita-profesional').click(function (e) {
            e.preventDefault();

            var modal = $('#confirmar-cita');

            var horario = $.parseJSON($('#hora').val());
            var tipo_cita = $('#servicio_prof_inst');
            var convenio = $('#convenio');
            var check_convenio = $('#check-convenio');
            var modalidad = $('#modalidad');
            var btn_confirmar_cita = $('#btn_confirmar_cita');

            if (
                horario !== undefined && horario !== null &&
                modalidad.val() !== undefined && modalidad.val() !== null &&
                tipo_cita.val() !== undefined && tipo_cita.val() !== null
            ) {
                // Fecha de la cita
                $('#modal-fecha').html(moment(horario.start, 'YYYY-MM-DD HH:mm').locale('es').format('DD-MMM-YYYY')
                );

                // Hora de la cita
                $('#modal-hora').html($('#hora option:selected').html());

                $('#modal-tipo-de-cita').html(tipo_cita.find('option:selected').html());

                if (check_convenio.prop('checked')) {
                    $('#modal-valor').html(convenio.find('option:selected').data('valor'));
                } else {
                    $('#modal-valor').html($('#valor_servicio').html());
                }

                btn_confirmar_cita.html((modalidad.val() === 'presencial') ? 'Finalizar' : 'Pagar')

                modal.modal('show');
            } else {
                $('#alertas').html(alert({
                    title: "Error",
                    text: "No se pudo completar el agendamiento, revisa la información"
                }, 'danger'));
            }

        });

        $('#btn_confirmar_cita').click(function (e) {
            $('#form-finalizar-cita-profesional').submit();
        });

        @empty($antiguedad )
        $('#modal_antiguedad').modal()
            .on('click', 'button', function (e) {
                var btn = $(this);
                $('#modal_antiguedad').modal('hide');
                $.ajax({
                    url: '{{ route('paciente.confirmar-antiguedad-institucion', ['institucion' => $profesional->id_institucion]) }}',
                    //Verdadero primera vez
                    data: {antiguedad: btn.data('confirmacion')},
                    type: 'post',
                    dataType: 'json',
                    success: function (response) {

                        if (btn.data('confirmacion')) {
                            $('#option-presencial').remove();
                        }

                        $('#modal_antiguedad').modal('hide');
                    },
                    error: function (error) {
                    }
                });
            });
        @endempty

        $('#servicio_prof_inst').change(function (event) {
            var select = $(this);

            var servicio = $(this);
            var date = $('#date-calendar');

            //console.log('fecha 1 ' + date.val());
            //console.log('servicio 1 ' + servicio.val());

            if (servicio.val() !== '' && date.val() !== '') dias_libres(date.val(), servicio.val());

            $.ajax({
                type: "POST",
                url: '{{ route('institucion.convenios-servicio') }}',
                data: {servicio: select.val(), institucion: '{{ $profesional->institucion->id }}'},
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    $('#convenio').empty().prop('disabled', true);

                    $('#check-convenio').prop('checked', false);

                    $.each(response.items, function (key, item) {
                        $('#convenio').append('<option value="' + item.id + '" data-valor="' + item.valor + '">' + item.nombre_completo + '</option>');
                    });
                }
            })
        });

        $('#check-convenio').change(function (event) {
            $('#convenio').prop('disabled', !$(this).prop('checked'));
        });

        $('.select_service').click(function servicioProfesional() {
            var btn_service = $(this);

            $('#imp_serv').html(btn_service.data('servicio'));
            $('#valor_servicio').html(btn_service.data('precio'));
            $('#servicio_prof_inst').val(btn_service.data('id')).trigger('change');
            $('#options_servicio').modal('hide');
            $('.select_service').addClass('button_green').removeClass('button_seleccionado').html('Seleccionar');
            btn_service.removeClass('button_green').addClass('button_seleccionado').html('Seleccionado');
        });

        @if(!empty($date_calendar) and !empty($tipo_servicio))
        $('#tipo_servicio').trigger('change');
        @endif

        @if(!empty($tipo_servicio))
        $('.select_service[data-id={{ $tipo_servicio }}]').trigger('click');
        @endif
    </script>
@endsection

