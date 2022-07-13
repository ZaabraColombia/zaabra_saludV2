@extends('instituciones.admin.layouts.layout')

@section('styles')
    <link rel="stylesheet" href="{{ asset('plugins/DataTables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/DataTables/Responsive-2.2.9/css/responsive.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset(' plugins/DataTables/Responsive-2.2.9/css/responsive.bootstrap.min.css') }}">
    <style>
        .dataTables_filter, .dataTables_info { display: none;!important; }
    </style>
@endsection

@section('contenido')
    <div id="admin_cita">
        <div class="container-fluid panel_container">
            <!-- panel head -->
            <div class="panel_head px-lg-0 mb-lg-3">
                <!-- Main title -->
                <div class="mb-0">
                    <h1 class="txt_title_panel_head color_green mb-3 mb-lg-2">Histórico de citas</h1>
                </div>
                <!-- Toolbar -->
                <div class="row m-0">
                    <div class="col-md-8 p-0">
                        <h2 class="txt_subtitle_panel_head mb-3 mb-md-0">Encuentre aquí las citas agendadas por sus pacientes.</h2>
                    </div>
                    <!-- Document action buttons  -->
                    <div class="col-md-4 ml-md-auto col-lg-auto button__doc_download">
                        <div class="toolt bottom">
                            <button class="file_calendar"></button>
                            <span class="tiptext">Calendario</span>
                        </div>
                        <div class="toolt bottom">
                            <button class="file_excel"></button>
                            <span class="tiptext">Exportar excel</span>
                        </div>
                        <div class="toolt bottom">
                            <button class="file_pdf"></button>
                            <span class="tiptext">Exportar PDF</span>
                        </div>
                        <div class="toolt bottom">
                            <button class="file_printer"></button>
                            <span class="tiptext">Imprimir</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- panel body -->
            <div class="panel_body">
                <div class="row m-0">
                    <div class="col-12 p-0">
                        <div class="row_btns_panel">
                            <div class="mb_btn_panel btn_top_panel">
                                <button type="submit" class="btn_green_panel">Mostrar todo</button>
                            </div>
                            <div class="btn_top_panel">
                                <button type="submit" class="btn_white_panel">Ocultar todo</button>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 p-0">
                        <div id="filter-input" class="row m-0">
                            <div class="col-md-6 p-0 pr-md-3 col-lg-3 mb-3">
                                <label for="fecha">Fecha de inicio</label>
                                <input id="fecha" name="fecha" class="form-control filter-data" readonly value="{{ date('Y-m-d') }}"/>
                            </div>
                            <div class="col-md-6 p-0 pl-md-3 pl-lg-0 pr-lg-3 col-lg-3 mb-3">
                                <label for="fecha_fin">Fecha final</label>
                                <input id="fecha_fin" name="fecha_fin" class="form-control filter-data" readonly value="{{ date('Y-m-d') }}"/>
                            </div>
                            <div class="col-md-6 p-0 pr-md-3 col-lg-3 mb-3">
                                <label for="estado">Estado de cita</label>
                                <select name="estado" id="estado" class="form-control filter-data">
                                    <option value="">Todos</option>
                                    <option selected value="agendado">Agendado</option>
                                    <option value="completado">Completado</option>
                                    <option value="cancelado">Cancelado</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Tabla -->
                <div class="row m-0">
                    <div class="col-12 p-0" id="alertas"></div>
                    <div id="table_green" class="col-12 p-0">
                        <table class="table table-borderless py-4" style="width: 100%" id="table-citas">
                            <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Profesional</th>
                                    <th>Especialidad</th>
                                    <th>Convenio</th>
                                    <th>Paciente</th>
                                    <th>Servicio</th>
                                    <th>Estado de cita</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>16/05/2022</td>
                                    <td>Diego José Escobar</td>
                                    <td>Otorrinolaringología</td>
                                    <td>Salud Total</td>
                                    <td>Marco Antonio Garzon Sepulveda</td>
                                    <td>Limpieza de oido</td>
                                    <td>Completada</td>
                                </tr>
                                <tr>
                                    <td>16/05/2022</td>
                                    <td>Diego José Escobar</td>
                                    <td>Cirugía ortopédica y traumatología</td>
                                    <td>Sanitas</td>
                                    <td>Marco Antonio Garzon Sepulveda</td>
                                    <td>Cirugía de ligamento cruzado</td>
                                    <td>Cancelada</td>
                                </tr>
                                <tr>
                                    <td>16/05/2022</td>
                                    <td>Diego José Escobar</td>
                                    <td>Cirugía Plástica</td>
                                    <td>MedPlus</td>
                                    <td>Marco Antonio Garzon Sepulveda</td>
                                    <td>Rinoplastia</td>
                                    <td>Inasistida</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- Botones de paginación -->
                    <div id="pagination" class="w-100 pr-1">
                        <ul class="pagination mt-3 mb-0 pr-md-2 pr-xl-3 justify-content-end">
                            <li class="page-item toolt bottom">
                                <a class="page-link" href="#" rel="prev">
                                    <i data-feather="chevron-left" class="icon_direction"></i>
                                </a>
                                <span class="tiptext">Anterior</span>
                            </li>

                            <li class="page-item toolt bottom">
                                <a class="page-link ml-1" href="#" rel="next">
                                    <i data-feather="chevron-right" class="icon_direction"></i>
                                </a>
                                <span class="tiptext">Siguiente</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('plugins/moment/moment-with-locales.min.js') }}"></script>
    <script src="{{ asset('plugins/DataTables/datatables.min.js') }}"></script>
    {{--<script src="{{ asset('plugins/DataTables/DateTime-1.1.2/js/dataTables.dateTime.min.js') }}"></script>--}}
    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.4/moment.min.js"></script>--}}
    {{--<script src="https://cdn.datatables.net/plug-ins/1.11.5/sorting/datetime-moment.js"></script>--}}

    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>

    <script src="{{ asset('plugins/datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('plugins/datepicker/locales/bootstrap-datepicker.es.min.js') }}"></script>

    <script src="{{ asset('js/alertas.js') }}"></script>

    <script>
        $(document).ready(function () {

            //$.fn.dataTable.moment( 'DD-MM / YYYY', 'es');
            //$.fn.dataTable.moment( 'HH:mm A \- HH:mm A', 'es');


            // $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
            //     var dateS = $('#date').val();
            //     var startDate = moment(data[0], 'DD-MM / YYYY');

            //     if (dateS == null || dateS === '') return true;
            //     return startDate.format('YYYY-MM-DD') === dateS;
            // });

            //Inicializar tabla
            var table = $('#table-citas').DataTable({
                //dom: 'Plfrtip',
                dom:
                    // "<'#filter-input.row'><'row'<'col-12'P>>"+
                    "Pt",
                // serverSide: true,
                // processing: true,
                // ajax: {
                //     type: 'post',
                //     url: '{{ route('institucion.calendario.lista-citas') }}',
                //     data: (d) =>{
                //         d.fecha = $('#fecha').val();
                //         d.estado = $('#estado').val();
                //     }
                // },
                responsive: true,
                language: {
                    url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
                    emptyTable: ' '
                },
                // columns: [
                //     {data: "fecha", name: "fecha_inicio"},
                //     {data: "hora_inicio", name: "fecha_inicio"},
                //     {data: "hora_fin", name: 'fecha_fin'},
                //     {
                //         data: 'profesional_nombre',
                //         name: 'profesional_nombre',
                //     },
                //     {data: "nombreEspecialidad", name: 'nombreEspecialidad'},
                //     {
                //         data: 'servicio',
                //         name: 'servicio',
                //     },
                //     {data: "paciente_nombre", name: 'paciente_nombre'},
                //     {data: "paciente_identificacion", name: 'paciente_identificacion'},
                //     {data: "paciente_celular", name: "paciente_celular"},
                //     {data: "estado", name: "estado"},
                //     {
                //         name: 'edit',
                //         className: '',
                //         data: function (data, type, full, meta) {

                //             return '<div class="d-flex justify-content-center">' +
                //                 '<button  class="btn_action_green tool top editar-cita" data-url="' + data.ver + '">' +
                //                 '<i class="fas fa-calendar-day fa-2x"></i>' +
                //                 '<span class="tiptext">Editar cita</span>' +
                //                 '</button>' +
                //                 '<button  class="btn_action_green tool top cancelar-cita" data-url="' + data.ver + '">' +
                //                 '<i class="fas fa-calendar-times fa-2x"></i>' +
                //                 '<span class="tiptext">Cancelar cita</span>' +
                //                 '</button>' +
                //                 '</div>';
                //         },
                //         searchable: false,
                //         orderable: false,
                //     },
                // ],
                searchPanes: {
                    viewTotal: false               
                },

                columnDefs: [
                    {
                        searchPanes: {
                            show: true,
                            clear: false
                        },
                        targets: [1, 2, 3, 4, 5, 6]
                    },
                    {
                        responsivePriority: 1,
                        targets: [-1]
                    }
                ],
                initComplete: function () {

                    var api = this.api();

                    // $('.filter-data').on('change', function () {
                    //     table.ajax.reload(null, false)
                    // });

                    // $('#fecha').datepicker({
                    //     language: 'es',
                    //     format: 'yyyy-mm-dd',
                    //     //startDate: moment().format('YYYY-MM-DD'),
                    // });

                    //table.ajax.reload(null, false);

                    table.searchPanes.container().insertAfter('#data');

                    //table.search().draw();
                }
                // createdRow: function (row, data, dataIndex) {
                //     $(row).addClass('bg-' + data.estado);
                // }
            });

            // setInterval(function () {
            //     table.ajax.reload(null, false);
            // }, 30000);

            $("#search").on('keyup change', function () {
                var texto = $(this).val();
                table.search(texto).draw();
            });
            $("#date").on('change', function () {
                table.draw();
            });

            //editar cita
            table.on('click', '.editar-cita', function (eve) {
                var btn = $(this);

                $('#form-reagendar-cita')[0].reset();
                $('#profesional').val('').trigger('changue');

                $.get(btn.data('url'), function (response) {
                    var item = response.item;
                    var modal = $('#modal-reagendar-cita');

                    $('#form-reagendar-cita').attr('action', item.edit);

                    $('#paciente').val(item.paciente_id);
                    $('#tipo_servicio').val(item.tipo_cita_id);

                    info(modal, item);

                    modal.modal();

                }, 'json').fail(function (status) {
                    console.log(status);
                });

            });

            //cancelar cita
            table.on('click', '.cancelar-cita', function (eve) {
                var btn = $(this);

                $('#form-cancelar-cita')[0].reset();

                $.get(btn.data('url'), function (response) {
                    var item = response.item;
                    var modal = $('#modal-cancelar-cita');

                    $('#form-cancelar-cita').attr('action', item.cancel);

                    $('#profesional-cancelar').val(item.profesional_ins_id);

                    info(modal, item);

                    modal.modal();

                }, 'json').fail(function (status) {
                    console.log(status);
                });

            });

            var info = (modal, info) => {
                modal.find('.nombre_paciente').html(info.nombre_paciente);
                modal.find('.numero_id').html(info.identificacion);
                modal.find('.correo').html(info.correo_paciente);
                modal.find('.fecha').html(info.fecha);
                modal.find('.hora').html(info.hora);
                modal.find('.nombre_profesional').html(info.nombre_profesional);
                modal.find('.especialidad').html(info.especialidad);
                modal.find('.tipo_servicio').html(info.tipo_servicio);
                modal.find('.servicio').html(info.servicio);
                modal.find('.atencion').html(info.atencion);
                modal.find('.lugar').html(info.lugar);
            };

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
                            searchTerm: params.term, // search term
                            service: $('#tipo_servicio').val()
                        };
                    },
                    processResults: function (response) {
                        return {
                            results: response
                        };
                    },
                    cache: true,
                },
                //minimumInputLength: 3,
                dropdownParent: $('#modal-reagendar-cita')
            }).on('select2:select', function (e) {
                var data = e.params.data;
                $.ajax({
                    url: '{{ route('institucion.calendario-disponible') }}',
                    data: {profesional: data.id},
                    dataType: 'json',
                    method: 'post',
                    headers: {
                        accept: 'application/json',
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
            }).on('select2:opening', function (e) {
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

            $('#form-reagendar-cita, #form-cancelar-cita').submit(function (e) {
                e.preventDefault();

                var form = $(this);

                $.ajax({
                    url: form.attr('action'),
                    data: form.serialize(),
                    dataType: 'json',
                    method: 'post',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: (response) => {
                        $('#alertas').html(alert(response.message, 'success'));
                        $('#modal-reagendar-cita').modal('hide');
                        $('#modal-cancelar-cita').modal('hide');
                        table.ajax.reload(null, false);
                    },
                    error: (response) => {
                        $('#alertas').html(alert(response.responseJSON.message, 'danger'));
                        $('#modal-reagendar-cita').modal('hide');
                        $('#modal-cancelar-cita').modal('hide');
                        table.ajax.reload(null, false);
                    }
                });

            });

        });
    </script>

    <!-- Script barra de búsqueda desplegable -->
    <script>
        $('#search').on('click', function () {
            $('#search').addClass('search_togggle');
        });
    </script>
@endsection
