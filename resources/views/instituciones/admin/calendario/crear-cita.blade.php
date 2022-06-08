@extends('instituciones.admin.layouts.layout')

@section('styles')
    <link rel="stylesheet" href="{{ asset('plugins/pg-calendar-master/dist/css/pignose.calendar.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2-bootstrap4.min.css') }}">
@endsection

@section('contenido')
    <div class="container-fluid panel_container">
        <div class="panel_head_op2">
            <!-- Main title -->
            <div class="mb-4 mb-lg-0">
                <h1 class="txt_title_panel_head">Agendar cita</h1>
            </div>
            <!-- Toolbar -->
            <div class="row m-0">
                <!-- Add appoiment -->
                <div class="col-12 p-0 mb-4 button__add_card justify-content-md-end">
                    <a href="{{ route('institucion.calendario.crear-cita') }}" class="button__green_card py-1" id="btn-agregar-contacto">
                        <i data-feather="user-plus" style="width: 20px"></i>&nbsp; Agregar paciente
                    </a>
                </div>
            </div>
        </div>
        <!-- Mensaje de alerta -->
        <div class="row m-0">
            <div class="col-12 p-0" id="alertas">
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

        <div class="panel_body_op2">
            <form action="{{ route('institucion.calendario.guardar-cita') }}" method="post" id="form-crear-cita-institucion">
                @csrf
                <div class="row m-0">
                    <!-- Información del paciente -->
                    <div class="col-12 col-lg-3 card__section_head">
                        <div class="row m-0">
                            <input type="hidden" name="date-calendar" id="date-calendar">
                            <!-- Paciente -->
                            <div class="col-md-6 col-lg-12 px-2 px-lg-0 mb-2">
                                <label for="paciente" class="txt_calendar_cita">Paciente</label>
                                <select id="paciente" class="form-control" name="paciente" required></select>
                            </div>
                                        <!-- Imagen e info del paciente -->
                            <div class="col-md-6 col-lg-12 px-1 px-lg-0 mt-3 mb-2" style="display: none" id="div-paciente">
                                <div class="row m-0">
                                    <div class="col-3 col-lg-2 p-0">
                                        <img id="foto" alt="foto" class="img__user_cita"/>
                                    </div>
                                    <div class="col-9 col-lg-10 pad_l_dat">
                                        <h4 class="txt_h4_data_cita" id="paciente-nombre-comppleto"></h4>
                                        <h5 class="txt_h5_data_cita" id="paciente-identificacion"></h5>
                                        <div class="d-flex">
                                            <i data-feather="phone" class="icon_txt_data"></i>
                                            <h5 class="txt_h5_data_cita pl-2" id="">313 000 00 00</h5>
                                        </div>
                                        <div class="d-flex">
                                            <i data-feather="mail" class="icon_txt_data"></i>
                                            <h5 class="txt_h5_data_cita pl-2" id="paciente-correo"></h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Servicio -->
                            <div class="col-md-6 col-lg-12 px-2 px-lg-0 mb-2">
                                <label for="tipo_servicio" class="txt_calendar_cita">Servicio</label>
                                <select id="tipo_servicio" class="form-control" name="tipo_servicio" required>
                                    <option></option>
                                    @if(!empty($servicios))
                                        @foreach ($servicios as $servicio)
                                            <option value="{{ $servicio->id }}" data-valor="{{ $servicio->valor }}">{{ $servicio->nombre }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <!-- Especialidad -->
                            <div class="col-md-6 col-lg-12 px-2 px-lg-0 mb-2">
                                <label for="especialidad" class="txt_calendar_cita">Eespecialidad</label>
                                <select id="especialidad" class="form-control" name="especialidad" required>
                                    <option></option>
                                    <option value="Especialidad 1" data-lugar="">Especialidad 1</option>
                                    <option value="Especialidad 2" data-lugar="">Especialidad 2</option>
                                </select>
                            </div>
                            <!-- Profesional -->
                            <div class="col-md-6 col-lg-12 px-2 px-lg-0 mb-2">
                                <label for="profesional" class="txt_calendar_cita">Profesional</label>
                                <select id="profesional" class="form-control" name="profesional" required>
                                    <option></option>
                                    @if($profesionales->isNotEmpty())
                                        @foreach($profesionales as $profesional)
                                            <option value="{{ $profesional->id_profesional_inst }}" data-lugar="{{ $profesional->consultorio_completo }}">{{ $profesional->nombre_completo }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <!-- Imagen e info del profesional -->
                            <div class="col-md-6 col-lg-12 px-1 px-lg-0 mt-3 mb-2" id="">
                                <div class="row m-0">
                                    <div class="col-3 col-lg-2 p-0">
                                        <img id="" alt="" src="{{ asset('img/menu/avatar.png') }}" class="img__user_cita"/>
                                    </div>
                                    <div class="col-9 col-lg-10 pad_l_dat">
                                        <h4 class="txt_h4_data_cita" id="">Alexander Montenegro Caballero</h4>
                                        <h5 class="txt_h5_data_cita" id="">C.C. 1.000.000.000</h5>
                                        <div class="d-flex">
                                            <i data-feather="phone" class="icon_txt_data"></i>
                                            <h5 class="txt_h5_data_cita pl-2" id="">313 000 00 00</h5>
                                        </div>
                                        <div class="d-flex">
                                            <i data-feather="mail" class="icon_txt_data"></i>
                                            <h5 class="txt_h5_data_cita pl-2" id="">alexmaonte@hotmail.com</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-6 pad_entre_tarjetas">
                        <div class="card__section_body">
                            <!-- Pildoras informativas mobile -->
                            <div class="row m-0 mb-4 pl-3 pill_mobile">
                                <div class="col-12 p-0 mb-2 d-flex align-items-center">    
                                    <span class="pill_informative_blue"></span>
                                    <span class="ml-3 txt_calendar_cita">Días disponibles</span>
                                </div>
                                <div class="col-12 p-0 mb-2 d-flex align-items-center">
                                    <span class="pill_informative_gray"></span>
                                    <span class="ml-3 txt_calendar_cita">Días no disponibles</span>
                                </div>
                                <div class="col-12 p-0 mb-2 d-flex align-items-center">
                                    <span class="pill_informative_gree"></span>
                                    <span class="ml-3 txt_calendar_cita">Días seleccionados</span>
                                </div>
                            </div>
                        
                            <!-- Calendario -->
                            <div id="calendar" class="calendar pad_externo_calendar"></div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-3 card__section_foot">
                        <!-- Pildoras informativas desktop -->
                        <div class="row m-0 pill_desktop">
                            <div class="col-12 p-0 mb-2 d-flex align-items-center">    
                                <span class="pill_informative_blue"></span>
                                <span class="ml-3 txt_calendar_cita">Días disponibles</span>
                            </div>
                            <div class="col-12 p-0 mb-2 d-flex align-items-center">
                                <span class="pill_informative_gray"></span>
                                <span class="ml-3 txt_calendar_cita">Días no disponibles</span>
                            </div>
                            <div class="col-12 p-0 mb-2 d-flex align-items-center">
                                <span class="pill_informative_gree"></span>
                                <span class="ml-3 txt_calendar_cita">Días seleccionados</span>
                            </div>
                        </div>

                        <div class="row m-0">
                            <!-- Hora de cita -->
                            <div class="col-md-6 col-lg-12 px-2 px-lg-0 mb-2">
                                <label for="hora" class="txt_calendar_cita_green">Hora de la cita</label>
                                <select id="hora" name="hora" class="form-control input_height_min" required></select>
                            </div>
                            <!-- Convenio -->
                            <div class="col-md-6 col-lg-12 px-2 px-lg-0 mb-2">
                                <label for="convenio" class="txt_calendar_cita_green">Convenio</label>
                                <div class="input-group">
                                    <div class="input-group-prepend input_height_min_ckec">
                                        <div class="input-group-text">
                                            <input type="checkbox" id="check-convenio" name="check-convenio" value="1">
                                        </div>
                                    </div>
                                    <select class="custom-select input_height_min" id="convenio" name="convenio" disabled></select>
                                </div>
                            </div>
                            <!-- Modalidad de pago -->
                            <div class="col-md-6 col-lg-12 px-2 px-lg-0 mb-2">
                                <label for="modalidad" class="txt_calendar_cita_green">Modalidad de pago</label>
                                <select id="modalidad" class="form-control input_height_min" name="modalidad" required>
                                    <option value="virtual">Virtual</option>
                                    <option value="presencial"> Presencial </option>
                                </select>
                            </div>
                            <!-- Botón inferior -->
                            <div class="col-12 px-2 px-lg-0 mt-3 content__btn_inferior">
                                <button type="button" class="button_green py-1" id="btn-finalizar-cita-profesional">Agendar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal confirmar cita -->
    <div class="modal fade" id="confirmar-cita" tabindex="-1" data-backdrop="static" data-keyboard="false">
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
                        <h5 id="modal-paciente"></h5>
                        <h5 id="modal-paciente-identificacion"></h5>
                    </div>
                    <div>
                        <h5> Paciente<span id="modal-profesional"></span></h5>
                        <h5> Identificación<span id="modal-profesional-identificacion"></span></h5>
                        <h5> Servicio:<span id="modal-tipo-cita"></span></h5>
                        <h5> Profesional: <span id="modal-profesional"></span></h5>
                        <h5> Horario: <span id="modal-horario"></span></h5>
                        <h5> Lugar: <span id="modal-lugar"></span></h5>
                        <h5> Pago: <span id="modal-modalidad"></span></h5>
                        <h5>Valor cita: <span id="modal-valor"></span></h5>
                        <h5> Convenio: <span id="modal-convenio"></span></h5>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="btn_confirmar_cita">Guardar</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/pg-calendar-master/dist/js/pignose.calendar.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>

    <script src="{{ asset('js/alertas.js') }}"></script>

    <script>

        //moment.locale('es'); // change the global locale to Spanish

        var calendar = $('#calendar').pignoseCalendar({
            lang: 'es',
            initialize: false,
            minDate: '',
            maxDate: '',
            /*maxDate: '2022-06-24',*/
            disabledWeekdays:[0, 1, 2, 3, 4, 5, 6], // WEDNESDAY (0)
            disabledDates: [],
            disabledRanges: [
                //['2022-04-07', '2022-04-22'], // 2022-04-07 ~ 22
            ],
            select: (date, context) => {

                var servicio = $('#tipo_servicio').val();

                var date_calendar = $('#date-calendar');
                date_calendar.val('');

                if(date[0] !== null && date[0]._i) date_calendar.val(date[0]._i);
                if (date[0] !== null && date[0]._i !== undefined && servicio !== '') dias_libres(date[0]._i, servicio);

            }
        });


        //Buscar paciente
        $('#paciente').select2({
            language: 'es',
            theme: 'bootstrap4',
            ajax: {
                url: '{{ route('buscador-paciente') }}',
                dataType: 'json',
                method: 'post',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: function (params) {
                    return {
                        searchTerm: params.term // search term
                    };
                },
                processResults: function (response) {
                    return {
                        results:response
                    };
                },
                cache: true,
            },
            minimumInputLength: 3
        }).on('select2:select', function (e) {
            var data = e.params.data;

            $('#foto').attr('src', data.foto);
            $('#paciente-nombre-comppleto').html(data.nombre_completo);
            $('#paciente-identificacion').html(data.identificacion);
            $('#paciente-correo').html(data.email);
            $('#div-paciente').show();

        }).on('select2:opening', function (e){

            $(this).val(null).trigger('change');
            $('#div-paciente').hide();
            $('#foto').attr('src', '#');
            $('#paciente-nombre-comppleto').html('');
            $('#paciente-identificacion').html('');
            $('#paciente-correo').html('');
        }).on('select2:open', function () {
            $('input.select2-search__field')[0].focus();
        });

        //Agregar servicios
        $('#profesional').change(function (event) {
            var select = $(this);

            $.ajax({
                type: "POST",
                url: '{{ route('institucion.calendario-disponible') }}',
                data: {profesional: select.val()},
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    $('#convenio').empty().prop('disabled', true);

                    $('#check-convenio').prop('checked', false);

                    $('#tipo_servicio').html('<option></option>');
                    $.each(response.servicios, function (key, item) {
                        $('#tipo_servicio').append('<option value="' + item.id + '" data-valor="' + item.valor + '">' +
                            item.nombre +
                            '</option>'
                        );
                    });

                    //date
                    $('#date-calendar').val(moment().format('YYYY-MM-DD'));

                    //calendario
                    $('#calendar').pignoseCalendar({
                        lang: 'es',
                        date: moment().format('YYYY-MM-DD'),
                        minDate: moment().format('YYYY-MM-DD'),
                        maxDate: moment().add('days', response.agenda.disponibilidad).format('YYYY-MM-DD'),
                        disabledWeekdays: response.agenda.weekNotBusiness,
                        select: (date, context) => {

                            var servicio = $('#tipo_servicio').val();

                            var date_calendar = $('#date-calendar');
                            date_calendar.val('');

                            if(date[0] !== null && date[0]._i) date_calendar.val(date[0]._i);
                            if (date[0] !== null && date[0]._i !== undefined && servicio !== '') dias_libres(date[0]._i, servicio);

                        }
                    });

                    // $('#calendar').pignoseCalendar('setting', {
                    //     minDate: moment(),
                    //     maxDate: moment().add('days', 2),
                    //     disabledWeekdays: [1, 2, 3]
                    // });
                }
            })
        });

        //Agregar convenios
        $('#tipo_servicio').change(function (event) {
            var select = $(this);

            var servicio = $(this);
            var date =  $('#date-calendar');

            //console.log('fecha 1 ' + date.val());
            //console.log('servicio 1 ' + servicio.val());

            if (servicio.val() !== '' && date.val() !== '' ) dias_libres(date.val(), servicio.val());

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
                },
                error: function (response) {
                    var response = res.responseJSON;
                    $('#alertas').html(alert(response.message, 'danger'));
                }
            })
        });

        $('#check-convenio').change(function (event) {
            $('#convenio').prop('disabled', !$(this).prop('checked'));
        });

        //Dias libres
        function dias_libres(fecha, servicio) {
            var hora = $('#hora');
            hora.html('<option></option>');

            $.ajax({
                data: $('#form-crear-cita-institucion').serialize(),
                dataType: 'json',
                url: '{{ route('institucion.calendario.citas-libre') }}',
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


        //Confirmación de cita
        $('#btn-finalizar-cita-profesional').click(function (event) {
            //llenar modal
            $('#modal-paciente').html($('#paciente-nombre-comppleto').text());
            $('#modal-paciente-identificacion').html($('#paciente-identificacion').text());

            $('#modal-tipo-cita').html($('#tipo_servicio option:selected').text());
            $('#modal-horario').html(
                moment($('#date-calendar').val(), 'YYYY-MM-DD').locale('es').format('DD-MMM [del] YYYY') +
                ' / ' + $('#hora option:selected').html()
            );
            $('#modal-profesional').html($('#profesional option:selected').text());
            $('#modal-lugar').html($('#profesional option:selected').data('lugar'));

            $('#modal-modalidad').html($('#modalidad option:selected').text());
            $('#modal-valor').html(
                ($('#check-convenio').prop('checked')) ? $('#convenio option:selected').data('valor') : $('#tipo_servicio option:selected').data('valor')
            );

            $('#modal-convenio').html(
                ($('#check-convenio').prop('checked')) ? $('#convenio option:selected').html() : ''
            );

            $('#confirmar-cita').modal();
        });
        $('#btn_confirmar_cita').click(function (event) {
            $('#form-crear-cita-institucion').submit();
        });

    </script>
@endsection

