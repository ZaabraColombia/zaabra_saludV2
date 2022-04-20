@extends('paciente.admin.layouts.layout')

@section('styles')
    <link rel="stylesheet" href="{{ asset('plugins/pg-calendar-master/dist/css/pignose.calendar.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2-bootstrap4.min.css') }}">
@endsection

@section('contenido')
    <div class="container-fluid content_asig_cita">

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
                <div class="w-100 w_md_65 w_lg_100 px_xl pl-md-3">
                    <div class="col_block mb-3 mt-md-1 mb-md-0 mt-lg-0">
                        <form action="" method="post" id="">
                            @csrf
                            <input type="hidden" name="date-calendar" id="date-calendar">
                            <div class="input__box mb-3">
                                <label for="paciente">Paciente</label>
                                <select id="paciente" class="form-control" name="paciente" required></select>
                            </div>

                            <div class="input__box mb-3">
                                <label for="profesional">Profesional</label>
                                <select id="profesional" class="form-control" name="profesional" required>
                                    <option></option>
                                    @if($profesionales->isNotEmpty())
                                        @foreach($profesionales as $profesional)
                                            <option value="{{ $profesional->id_profesional_inst }}">{{ $profesional->nombre_completo }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                            <div class="input__box mb-3">
                                <label for="tipo_servicio">Tipo de servicio</label>
                                <select id="tipo_servicio" class="form-control" name="tipo_servicio" required>
                                    <option></option>
                                    @if(!empty($servicios))
                                        @foreach ($servicios as $servicio)
                                            <option value="{{ $servicio->id }}" data-valor="{{ $servicio->valor }}">{{ $servicio->nombre }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="content_row w_lg_65 my__md">
                <!-- Calendario -->
                <div class="col_flex col_flex_md">
                    <div class="calendar w-100"></div>
                </div>

                <div class="content_row col_flex_md ml-md-auto mt-lg-2 align_between_1300">
                    <div class="col_flex">
                        <div class="mt-4 mb-3 mt-md-0">
                            <span class="badge rounded-pill bg-primary mb-3 w-100">Días disponibles</span>
                            <span class="badge rounded-pill bg-secondary mb-3 w-100" style="opacity: .5;">Días no disponibles</span>
                            <span class="badge rounded-pill bg-success mb-3 w-100">Días seleccionados</span>
                        </div>
                    </div>

                    <div class="col_block mb-3 mt-md-1 mb-md-0 mt-lg-0">
                        <form action="" method="post" id="">
                            @csrf
                            <input type="hidden" name="date-calendar" id="date-calendar">
                            <div class="input__box mb-3">
                                <label for="modalidad">Modalidad de pago</label>
                                <select id="modalidad" class="form-control" name="modalidad" required>
                                    <option value="virtual">Virtual</option>
                                    <option value="presencial"> Presencial </option>
                                </select>
                            </div>

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
                                <select id="hora" name="hora"  class="form-control" required></select>
                            </div>

                            <div class="row m-0 content_btn_right">
                                <button type="button" class="button_blue" id="btn-finalizar-cita-profesional">
                                    Finalizar
                                </button>
                            </div>
                        </form>
                    </div>
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

        var calendar = $('.calendar').pignoseCalendar({
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

            //$('#nombre').val(data.nombre);
            //$('#apellido').val(data.apellido);
            //$('#correo').val(data.email);

        }).on('select2:opening', function (e){

            $(this).val(null).trigger('change');
            //$('#nombre').val('');
            //$('#apellido').val('');
            //$('#correo').val('');

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

                    //calendario
                    $('.calendar').pignoseCalendar('configure', {
                        minDate: moment().format('YYYY-MM-DD'),
                        maxDate: moment().add('days', response.agenda.disponibilidad).format('YYYY-MM-DD'),
                        disabledWeekdays: response.agenda.weekNotBusiness
                    });
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
                        $('#convenio').append('<option value="' + item.id + '" data-valor="' + item.pivot.valor_paciente + '">' + item.nombre_completo + '</option>');
                    });
                }
            })
        });

        $('#check-convenio').change(function (event) {
            $('#convenio').prop('disabled', !$(this).prop('checked'));
        });
    </script>
@endsection

