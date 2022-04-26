@extends('instituciones.admin.layouts.layout')

@section('styles')
    <link rel="stylesheet" href="{{ asset('plugins/DataTables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/DataTables/Responsive-2.2.9/css/responsive.dataTables.min.css') }}">
    {{--<link rel="stylesheet" href="{{ asset(' plugins/DataTables/Responsive-2.2.9/css/responsive.bootstrap.min.css') }}">--}}

    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2-bootstrap4.min.css') }}">

    <link rel="stylesheet" href="{{ asset('plugins/datepicker/css/bootstrap-datepicker.min.css') }}">

    <style>
        .dataTables_filter, .dataTables_info { display: none;!important; }
        .bg-agendado { background: rgba(1, 159, 134, 0.3)}
        .bg-cancelado { background: rgba(157, 209, 249, 0.3)}
        .bg-completado { background: rgba(71, 178, 0, 0.3)}
        .bg-reservado { background: rgba(243, 119, 37, 0.3)}
    </style>
@endsection

@section('contenido')
    <div class="container-fluid p-0 pr-lg-4">
        <div class="containt_agendaProf" id="basic-table">
            <div class="my-4 my-xl-5">
                <h1 class="title__xl green_bold">Citas</h1>
                <span class="text__md black_light">Encuentre aquí las citas agendadas por sus pacientes.</span>

                {{--
                <div class="col-md-4 p-0 content_btn_right">
                    <a href="" class="button_transparent mr-2" id="" data-toggle="modal"
                       data-target="#modal_cancelar_cita">
                        eliminar
                    </a>
                    <a href="" class="button_green" id="" data-toggle="modal" data-target="#modal_reagendar_cita">
                        reagendar
                    </a>
                </div>
                --}}
            </div>

            <!-- Contenedor barra de búsqueda pacientes -->
            <div class="containt_main_table mb-3">
                <div class="row m-0">
                    <div class="col-md-8  p-0 input__box mb-0">
                        <input class="mb-md-0" type="search" name="search" id="search" placeholder="Buscar cita" />
                    </div>

                    <div class="col-md-4 p-0 content_btn_right">
                        <a href="{{ route('institucion.calendario.iniciar-control') }}" class="button_transparent mr-2" id="">
                            Atras
                        </a>
                        <a href="{{ route('institucion.calendario.crear-cita') }}" class="button_green" target="_blank">
                            Crear cita
                        </a>
                    </div>
                </div>
            </div>

            <!-- Contenedor formato tabla de la lista de pacientes -->
            <div class="containt_main_table mb-3">
                <table class="table display responsive nowrap" style="width: 100%" id="table-citas">
                    <thead class="thead_green">
                    <tr>
                        <th>Hora</th>
                        <th>Fecha</th>
                        <th>Profesional</th>
                        <th>Paciente</th>
                        <th>Identificación</th>
                        <th>Acción</th>
                        <th>Lugar</th>
                        <th>Celular</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal  reagendar cita -->
    <div class="modal fade" id="modal-reagendar-cita" tabindex="-1" >
        <div class="modal-dialog" role="document">
            <div class="modal-content modal_container">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form method="POST" action="" id="form-reagendar-cita">
                    @csrf
                    <div class="modal-body">
                        <div class="modal_info_cita mb-3">
                            <div class="py-3">
                                <h2 class="nombre_paciente">Marco Antonio Garzon Sepulveda</h2>
                                <p class="numero_id">C.C. 80645987</p>
                                <p class="correo">marco@hotmail.com</p>
                            </div>

                            <div class="row m-0">
                                <div class="col-12 p-0 mb-2">
                                    <h3 class="fecha">miércoles, 27 septiembre 2022</h3>
                                    <span class="hora">08:00 A.M - 08:45 A.M</span>
                                </div>
                                <div class="col-12 d-md-flex p-0 mb-2">
                                    <h3>Profesional: &nbsp;</h3>
                                    <span class="">Willmar Alejandro Gutierrez Sandoval</span>
                                </div>
                                <div class="col-12 d-md-flex p-0 mb-2">
                                    <h3>Especialidad: &nbsp;</h3>
                                    <span class="">Cirugia maxilofacial</span>
                                </div>
                            </div>

                            <div class="row m-0">
                                <div class="col-12 d-md-flex p-0 mb-2">
                                    <h3>Tipo de servicio: &nbsp;</h3>
                                    <span class="">Procedimiento no quirurgico</span>
                                </div>
                                <div class="col-12 d-md-flex p-0 mb-2">
                                    <h3>Servicio: &nbsp;</h3>
                                    <span class="">Procedimiento no quirurgico Procedimiento no</span>
                                </div>
                            </div>

                            <div class="row m-0">
                                <div class="col-12 d-flex p-0 mb-2">
                                    <h3>Tipo de atención: &nbsp;</h3>
                                    <span class="">Presencial</span>
                                </div>
                                <div class="col-md-9 p-0 mb-2">
                                    <h3>Lugar: &nbsp;</h3>
                                    <span class="">EPS Salud Total virrey Solis Olaya</span>
                                </div>
                                <div class="col-md-3 d-flex d-md-block p-0 mb-2">
                                    <h3 class="text-md-right mr-2 mr-md-0">Consultorio:</h3>
                                    <span class="d-md-flex justify-content-md-center">203</span>
                                </div>
                            </div>
                        </div>

                        <div class="form_modal">
                            <div class="row m-0">
                                <div class="col-12 p-0" id="alerta-reasignar"></div>
                                <input type="hidden" id="paciente" name="paciente" />
                                <input type="hidden" id="tipo_servicio" name="tipo_servicio" />

                                <div class="col-12 p-0">
                                    <label for="profesional">Profesional</label>
                                    <select type="text" id="profesional" name="profesional" required></select>
                                </div>

                                <label for="fecha-reasignar">Fecha</label>
                                <div class="col-12 input-group p-0 mb-3">
                                    {{--
                                    <div class="input-group-prepend">
                                        <button class="btn btn-outline-secondary" type="button" id="dia-anterior">
                                            <i class="fas fa-chevron-left"></i>
                                        </button>
                                    </div>
                                    --}}
                                    <input type="text" class="form-control" id="fecha-reasignar" name="date-calendar" disabled/>
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">
                                        <i class="fas fa-calendar"></i>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-12 p-0">
                                    <label for="hora">Horario disponible</label>
                                    <select id="hora" name="hora" required>
                                        <option></option>
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" id="id_cita-reasignar" name="id_cita"/>
                        </div>
                    </div>

                    <div class="modal-footer content_btn_center">
                        <button type="button" class="button_transparent" data-dismiss="modal">
                            Cancelar
                        </button>
                        <button type="submit" class="button_blue">Confirmar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal  Cancelar cita -->
    <div class="modal fade" id="modal_cancelar_cita" tabindex="-1" >
        <div class="modal-dialog" role="document">
            <div class="modal-content modal_container">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <h1>Cancelar cita</h1>

                    <div class="modal_info_cita">
                        <div class="py-3">
                            <h2 class="nombre_paciente">Marco Antonio Garzon Sepulveda</h2>
                            <p class="numero_id">C.C. 80645987</p>
                            <p class="correo">marco@hotmail.com</p>
                        </div>

                        <div class="row m-0">
                            <div class="col-12 p-0 mb-2">
                                <h3 class="fecha">miércoles, 27 septiembre 2022</h3>
                                <span class="hora">08:00 A.M - 08:45 A.M</span>
                            </div>
                            <div class="col-12 d-md-flex p-0 mb-2">
                                <h3>Profesional: &nbsp;</h3>
                                <span class="">Willmar Alejandro Gutierrez Sandoval</span>
                            </div>
                            <div class="col-12 d-md-flex p-0 mb-2">
                                <h3>Especialidad: &nbsp;</h3>
                                <span class="">Cirugia maxilofacial</span>
                            </div>
                        </div>

                        <div class="row m-0">
                            <div class="col-12 d-md-flex p-0 mb-2">
                                <h3>Tipo de servicio: &nbsp;</h3>
                                <span class="">Procedimiento no quirurgico</span>
                            </div>
                            <div class="col-12 d-md-flex p-0 mb-2">
                                <h3>Servicio: &nbsp;</h3>
                                <span class="">Procedimiento no quirurgico Procedimiento no</span>
                            </div>
                        </div>

                        <div class="row m-0">
                            <div class="col-12 d-flex p-0 mb-2">
                                <h3>Tipo de atención: &nbsp;</h3>
                                <span class="">Presencial</span>
                            </div>
                            <div class="col-md-9 p-0 mb-2">
                                <h3>Lugar: &nbsp;</h3>
                                <span class="">EPS Salud Total virrey Solis Olaya</span>
                            </div>
                            <div class="col-md-3 d-flex d-md-block p-0 mb-2">
                                <h3 class="text-md-right mr-2 mr-md-0">Consultorio:</h3>
                                <span class="d-md-flex justify-content-md-center">203</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer content_btn_center">
                    <form action="{{ route('profesional.agenda.calendario.cancelar-cita') }}" method="post" id="form-cita-cancelar">
                        <input type="hidden" class="form-control" id="id_cita-cancelar" name="id_cita"/>
                        <button type="button" class="button_transparent mr-2" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="button_blue" id="">Confirmar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('plugins/DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('plugins/DataTables/DateTime-1.1.2/js/dataTables.dateTime.min.js') }}"></script>
    <script src="{{ asset('plugins/moment/moment-with-locales.min.js') }}"></script>
    {{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.4/moment.min.js"></script>--}}
    <script src="https://cdn.datatables.net/plug-ins/1.11.5/sorting/datetime-moment.js"></script>
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>

    <script src="{{ asset('plugins/datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('plugins/datepicker/locales/bootstrap-datepicker.es.min.js') }}"></script>

    <script src="{{ asset('js/alertas.js') }}"></script>

    <script>
        $(document).ready( function () {

            $.fn.dataTable.moment( 'DD-MM / YYYY', 'es');
            //$.fn.dataTable.moment( 'HH:mm A \- HH:mm A', 'es');


            $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
                var dateS = $('#date').val();
                var startDate = moment(data[0], 'DD-MM / YYYY');

                if (dateS == null || dateS === '') return true;
                return startDate.format('YYYY-MM-DD') === dateS;
            });

            //Inicializar tabla
            var table = $('#table-citas').DataTable({
                responsive: true,
                language: {
                    url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                },
                columns:[
                    {data: "hora", name: "fecha_inicio"},
                    {data: "fecha", name: "fecha_inicio"},
                    {data: "profesional_ins.nombre_completo", name: 'profesional_ins.nombre_completo'},
                    {data: "paciente.user.nombre_completo", name: 'paciente.user.nombre_completo'},
                    {data: "paciente.user.numerodocumento", name: 'paciente.user.numerodocumento'},
                    {
                        name: 'edit',
                        data: function (data, type, full, meta) {
                            return '<button  class="btn_action_green tool top editar-cita" data-url="' + data.edit + '">' +
                                '<i class="fas fa-calendar-day fa-2x"></i>' +
                                '<span class="tiptext">Editar cita</span>' +
                                '</button>' +
                                '<button  class="btn_action_green tool top cancelar-cita" data-url="' + data.edit + '">' +
                                '<i class="fas fa-calendar-times fa-2x"></i>' +
                                '<span class="tiptext">Cancelar cita</span>' +
                                '</button>';
                        },
                        searchable: false,
                        //responsive: false,
                    },
                    {data: "lugar", name: "lugar"},
                    {data: "paciente.celular", name: "paciente.celular"},
                ],
                columnDefs: [
                    {
                        //name:    'edit',
                        //target:    5,
                        //search:     false,
                        //responsive: false,
                        className: '',
                        data: function (data, type, full, meta) {
                            console.log(data);
                            return data;
                        }

                    }
                ],
                serverSide: true,
                ajax:{
                    data:{ids: {!! json_encode($lista) !!}, fecha:'{{ $fecha }}'},
                    type: 'post',
                    url: '{{ route('institucion.calendario.lista-citas') }}',
                    // data: function ( d ) {
                    //     console.log(d);
                    //     // return $.extend({}, d, {
                    //     //     "extra_search": $('#extra').val()
                    //     // });
                    // }
                },
                // createdRow: function (row, data, dataIndex) {
                //     $(row).addClass('bg-' + data.estado);
                // }
            });

            setInterval( function () {
                table.ajax.reload(null, false);
            }, 30000 );

            $("#search").on('keyup change',function(){
                var texto = $(this).val();
                table.search(texto).draw();
            });
            $("#date").on('change',function(){
                table.draw();
            });

            //editar cita
            table.on('click', '.editar-cita', function (eve) {
                var btn = $(this);

                $('#form-reagendar-cita')[0].reset();

                $.get(btn.data('url'), function (response) {
                    var item = response.item;

                    $('#form-reagendar-cita').attr('action', item.edit);

                    $('#paciente').val(item.paciente);
                    $('#tipo_servicio').val(item.tipo_cita_id);

                    $('#modal-reagendar-cita').modal();

                }, 'json').fail(function (status) {
                    console.log(status);
                });

            });
        });

        //var date_picker = $('#fecha-reasignar').datepicker();

        //Buscar profesional
        $('#profesional').select2({
            language: 'es',
            theme: 'bootstrap4',
            ajax: {
                url: '{{ route('institucion.buscador-profesional') }}',
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
            minimumInputLength: 3,
            dropdownParent: $('#modal-reagendar-cita')
        }).on('select2:select', function (e) {
            var data = e.params.data;
            $.ajax({
                url: '{{ route('institucion.calendario-disponible') }}',
                data: {profesional: data.id},
                dataType: 'json',
                method: 'post',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: (response) => {
                    var agenda = response.agenda;
                    var date_picker = $('#fecha-reasignar');

                    date_picker.prop('disabled', false);
                    console.log(agenda);
                    date_picker.datepicker({
                        daysOfWeekDisabled: agenda.weekNotBusiness,
                        language: 'es',
                        //setDate: moment().format('YYYY-MM-DD'),
                        format: 'yyyy-mm-dd',
                        //startDate: '2022-04-01',
                        startDate: moment().format('YYYY-MM-DD'),
                        //endDate: '2022-04-30',
                        endDate: moment().add('days', agenda.disponibilidad).format('YYYY-MM-DD'),
                    });

                    //date_picker.datepicker('update', moment().format('YYYY-MM-DD'));
                }
            });
        }).on('select2:opening', function (e){
            var date_picker = $('#fecha-reasignar');
            $(this).val('').trigger('change');

            date_picker.prop('disabled', true);
        });

        $('#fecha-reasignar').change(function (e) {
            var form = $('#form-reagendar-cita');
            var hora = $('#hora');
            $.ajax({
                url: '{{ route('institucion.calendario.citas-libre') }}',
                data: form.serialize(),
                dataType: 'json',
                method: 'post',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: (response) => {

                    hora.html('<option></option>');
                    //get list
                    $.each(response.data, function (index, item) {
                        hora.append('<option value=\'{"start":"' + item.startTime + '","end": "' + item.endTime + '"}\'>' +
                            moment(item.startTime).format('hh:mm A') + '-' + moment(item.endTime).format('hh:mm A') +
                            '</option>');
                    });
                }
            });

        });
    </script>
@endsection
