@extends('instituciones.admin.layouts.layout')

@section('styles')
    <link rel="stylesheet" href="{{ asset('plugins/DataTables/datatables.min.css') }}">
    {{--<link rel="stylesheet" href="{{ asset('plugins/DataTables/Responsive-2.2.9/css/responsive.dataTables.min.css') }}">--}}
    {{--<link rel="stylesheet" href="{{ asset(' plugins/DataTables/Responsive-2.2.9/css/responsive.bootstrap.min.css') }}">--}}

    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2-bootstrap4.min.css') }}">

    <link rel="stylesheet" href="{{ asset('plugins/datepicker/css/bootstrap-datepicker.min.css') }}">

    <style>
        .dataTables_filter, .dataTables_info {
            /*    display: none;*/
            /*!important;*/
        }

        .bg-agendado {
            background: rgba(1, 159, 134, 0.3)
        }

        .bg-cancelado {
            background: rgba(157, 209, 249, 0.3)
        }

        .bg-completado {
            background: rgba(71, 178, 0, 0.3)
        }

        .bg-reservado {
            background: rgba(243, 119, 37, 0.3)
        }
    </style>
@endsection

@section('contenido')
    <div id="admin_cita">
        <div class="container-fluid panel_container">
            <!-- panel head -->
            <div class="panel_head px-lg-0 mb-lg-3">
                <!-- Main title -->
                <div class="mb-0">
                    <h1 class="txt_title_panel_head color_green mb-3 mb-lg-2">Administración de citas</h1>
                </div>
                <a  class="" type="button" data-toggle="modal" data-target="#modal_appoiment_detail">Launch modal</a>
                <!-- Toolbar --> 
                <div class="row m-0">
                    <div class="col-12 p-0 mb-lg-4 mb-xl-5">
                        <h2 class="txt_subtitle_panel_head">Encuentre aquí las citas agendadas por sus pacientes.</h2>
                    </div>
                    <!-- Add appoiment -->
                    <div class="col-md-12 col-lg-auto mt-4 mt-md-3 mt-lg-0 mr-lg-3 button__add_card">
                        <a href="{{ route('institucion.calendario.crear-cita') }}" class="button__green_card" id="btn-agregar-contacto">Agregar cita</a>
                    </div>
                    <!-- Search bar -->
                    <div class="col-md-6 col-lg-5 col-xl-5 mb-md-0 mr-lg-auto button__search_card">
                        <form method="get">
                            <button id="search" type="button" class="icon__search_green {{ (request('search')) ? 'search_togggle':'' }}">
                                <input class="mb-0" type="search" name="search" id="search" placeholder="Buscar" value="{{ request('search') }}">
                            </button>
                        </form>
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
                        <table class="table table-borderless" style="width: 100%" id="table-citas">
                            <thead>
                                <tr>
                                    <th>Fecha&nbsp;</th>
                                    <th>Hora&nbsp;Inicio</th>
                                    <th>Hora&nbsp;Fin</th>
                                    {{--Es nesesario que esten duplicados--}}
                                    <th>Profesional</th>
                                    <th>Profesional</th>
                                    <th>Especialidad</th>
                                    {{--Es nesesario que esten duplicados--}}
                                    <th>Servicio</th>
                                    <th>Servicio</th>
                                    <th>Paciente</th>
                                    <th>Identificación</th>
                                    <th>Celular</th>
                                    <th>Estado</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <!-- Botones de paginación -->
                    <nav id="pagination" class="w-100 pr-1">
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
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal appoiment detail -->
    <div class="modal fade" id="modal_appoiment_detail" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content modal__">
                <!-- Modal header -->
                <div class="modal-header row m-0 px-3 pl-lg-4">
                    <div class="col-12 p-0">
                        <button type="button" class="close modal_btn_close_top" data-dismiss="modal" aria-label="Close">
                            <span class="modal_x_close" aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!-- Título principal -->
                    <div class="col-12 modal_main_title">
                        <h1 class="modal_title_green">Detalles de la cita</h1>
                    </div>
                </div>
                <!-- Modal body -->
                <div class="modal-body px-3 px-lg-4 m-0 mb-lg-3">
                    <!-- Imagen imprersa del profesional -->
                    <div class="row m-0">
                        <div class="col-12 p-0 mb-5 mb-lg-3 d-flex justify-content-center">
                            <img class="img_printed_modal" src="{{ asset($profesional->foto_perfil_institucion ?? 'img/menu/avatar.png') }}">
                        </div>
                    </div>
                    <!-- Sección data sin borde -->
                    <div class="modal_info_data_open">
                        <div class="row m-0">
                            <div class="col-12 modal_info_user">
                                <h4 class="modal_data_form">Profesional:</h4>
                                <div class="modal_data_user">
                                    <span id="">Dr.(a) Santiago Jonathan Buenaventura Santamaria</span>
                                </div>
                            </div>

                            <div class="col-12 modal_info_user">
                                <h4 class="modal_data_form">Especialidad:</h4>
                                <div class="modal_data_user">
                                    <span id="">Otorrinolaringología</span>
                                </div>
                            </div>

                            <div class="col-12 mb-3 px-md-4 dropdown-divider" style="border: 1px solid #DBDADA"></div>

                            <div class="col-12 modal_info_user">
                                <h4 class="modal_data_form">Paciente:</h4>
                                <div class="modal_data_user">
                                    <span id="nombre">Carlos Arturo Quiroga Galvis</span>
                                </div>
                            </div>

                            <div class="col-lg-6 modal_info_user">
                                <h4 class="modal_data_form">Identificación:</h4>
                                <div class="modal_data_user">
                                    <span id="">C.C. 1.070.000.000</span>
                                </div>
                            </div>

                            <div class="col-lg-6 modal_info_user">
                                <h4 class="modal_data_form">Teléfono:</h4>
                                <div class="modal_data_user">
                                    <span id="">0000000</span>
                                </div>
                            </div>

                            <div class="col-lg-6 modal_info_user">
                                <h4 class="modal_data_form">Tipo de servicio:</h4>
                                <div class="modal_data_user">
                                    <span id="">Cirugía plástica facial</span>
                                </div>
                            </div>

                            <div class="col-lg-6 modal_info_user">
                                <h4 class="modal_data_form">Fecha:</h4>
                                <div class="modal_data_user">
                                    <span id="">28/11/1985</span>
                                </div>
                            </div>

                            <div class="col-lg-6 modal_info_user">
                                <h4 class="modal_data_form">Hora:</h4>
                                <div class="modal_data_user">
                                    <span id="">7:00 a.m. - 7:30 a.m.</span>
                                </div>
                            </div>

                            <div class="col-lg-6 modal_info_user">
                                <h4 class="modal_data_form">Lugar:</h4>
                                <div class="modal_data_user">
                                    <span id="">Calle 127A # 7-53 Cs 7003</span>
                                </div>
                            </div>

                            <div class="col-lg-6 modal_info_user">
                                <h4 class="modal_data_form">Pago:</h4>
                                <div class="modal_data_user">
                                    <span id="">Virtual</span>
                                </div>
                            </div>

                            <div class="col-lg-6 modal_info_user">
                                <h4 class="modal_data_form">Consultorio:</h4>
                                <div class="modal_data_user">
                                    <span id="">Consultorio 105</span>
                                </div>
                            </div>

                            <div class="col-lg-6 modal_info_user">
                                <h4 class="modal_data_form">Valor de la cita:</h4>
                                <div class="modal_data_user">
                                    <span id="">$ 1.440.000</span>
                                </div>
                            </div>

                            <div class="col-lg-6 modal_info_user">
                                <h4 class="modal_data_form">Convenio:</h4>
                                <div class="modal_data_user">
                                    <span id="">Sura E.P.S.</span>
                                </div>
                            </div>

                            <div class="col-lg-6 d-lg-block modal_info_user">
                                <h4 class="modal_data_form">¿Desea cancelar la cita?</h4>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="cita-cancelada" id="cita-cancelada" value="" checked>
                                    <label class="form-check-label" for="cita-cancelada">Si</label>
                                </div>
                                <div id="btn-cancel-cita" class="modal_btn_cancel_cita">
                                    <button type="button" class="modal_btn_bord_green" data-dismiss="modal">Cancelar cita</button>
                                </div>
                            </div>

                            <div class="col-lg-6 d-lg-block modal_info_user">
                                <h4 class="modal_data_form">Inasistencia:</h4>
                                <div class="d-flex">
                                    <div class="form-check mr-4">
                                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option2" checked>
                                        <label class="form-check-label" for="exampleRadios1">Si</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option3" checked>
                                        <label class="form-check-label" for="exampleRadios1">No</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 d-lg-block modal_info_user input__box">
                                <h4 class="modal_data_form mb-3">Observaciones:</h4>
                                <textarea name="descripcion" id="descripcion" class="@error('especialidad') is-invalid @enderror"
                                        rows="4">{{ old('descripcion') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modalfooter -->
                <div class="modal_buttons_down mb-4 mb-lg-5 mt-lg-2">
                    <button type="button" class="modal_border_green mb-4 mb-lg-0 mr-lg-4" data-dismiss="modal">Reagendar cita</button>
                    <button type="button" class="modal_border_green mb-4 mb-lg-0 mr-lg-4" data-dismiss="modal">Confirmar pagos</button>
                    <button type="button" class="modal_button_green" data-dismiss="modal">Confirmar cita</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal  reagendar cita -->
    <div class="modal fade" id="modal-reagendar-cita" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal_container">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form method="post" id="form-reagendar-cita">
                    <div class="modal-body">
                        <div class="modal_info_cita mb-3">
                            <div class="pt-3 pb-2">
                                <h2 class="nombre_paciente"></h2>
                            </div>

                            <div class="row m-0">
                                <div class="col-12 d-md-flex p-0 mb-2">
                                    <h3>Documento de identidad: &nbsp;</h3>
                                    <span class="numero_id"></span>
                                </div>
                                <div class="col-12 p-0 mb-2">
                                    <h3>Correo electrónico: &nbsp;</h3>
                                    <p class="correo"></p>
                                </div>
                            </div>

                            <div class="row m-0">
                                <div class="col-12 d-md-flex p-0 mb-2">
                                    <h3>Fecha de la cita: &nbsp;</h3>
                                    <span class="fecha"></span>
                                </div>
                                <div class="col-12 d-md-flex p-0 mb-2">
                                    <h3>Hora de la cita: &nbsp;</h3>
                                    <span class="hora"></span>
                                </div>
                                <div class="col-12 d-md-flex p-0 mb-2">
                                    <h3>Profesional: &nbsp;</h3>
                                    <span class="nombre_profesional"></span>
                                </div>
                                <div class="col-12 d-md-flex p-0 mb-2">
                                    <h3>Especialidad: &nbsp;</h3>
                                    <span class="especialidad"></span>
                                </div>
                            </div>

                            <div class="row m-0">
                                <div class="col-12 d-md-flex p-0 mb-2">
                                    <h3>Tipo de servicio: &nbsp;</h3>
                                    <span class="tipo_servicio"></span>
                                </div>
                                <div class="col-12 d-md-flex p-0 mb-2">
                                    <h3>Servicio: &nbsp;</h3>
                                    <span class="servicio"></span>
                                </div>
                            </div>

                            <div class="row m-0">
                                <div class="col-12 d-flex p-0 mb-2">
                                    <h3>Tipo de atención: &nbsp;</h3>
                                    <span class="atencion">Presencial</span>
                                </div>
                                <div class="col-md-9 p-0 mb-2">
                                    <h3>Lugar: &nbsp;</h3>
                                    <span class="lugar"></span>
                                </div>
                                {{--
                                <div class="col-md-3 d-flex d-md-block p-0 mb-2">
                                    <h3 class="text-md-right mr-2 mr-md-0">Consultorio:</h3>
                                    <span class="d-md-flex justify-content-md-center"></span>
                                </div>
                                --}}
                            </div>
                        </div>

                        <div class="form_modal">
                            <div class="row m-0">
                                <div class="col-12 p-0" id="alerta-reasignar"></div>
                                <input type="hidden" id="paciente" name="paciente"/>
                                <input type="hidden" id="tipo_servicio" name="tipo_servicio"/>

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
                                    <input type="text" class="form-control" id="fecha-reasignar" name="date-calendar"
                                           disabled/>
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
    <div class="modal fade" id="modal-cancelar-cita" tabindex="-1">
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
                            <h2 class="nombre_paciente"></h2>
                        </div>

                        <div class="row m-0">
                            <div class="col-12 d-md-flex p-0 mb-2">
                                <h3>Documento de identidad: &nbsp;</h3>
                                <span class="numero_id"></span>
                            </div>
                            <div class="col-12 p-0 mb-2">
                                <h3>Correo electrónico: &nbsp;</h3>
                                <p class="correo"></p>
                            </div>
                        </div>

                        <div class="row m-0">
                            <div class="col-12 d-md-flex p-0 mb-2">
                                <h3>Fecha de la cita: &nbsp;</h3>
                                <span class="fecha"></span>
                            </div>
                            <div class="col-12 d-md-flex p-0 mb-2">
                                <h3>Hora de la cita: &nbsp;</h3>
                                <span class="hora"></span>
                            </div>
                            <div class="col-12 d-md-flex p-0 mb-2">
                                <h3>Profesional: &nbsp;</h3>
                                <span class="nombre_profesional"></span>
                            </div>
                            <div class="col-12 d-md-flex p-0 mb-2">
                                <h3>Especialidad: &nbsp;</h3>
                                <span class="especialidad"></span>
                            </div>
                        </div>

                        <div class="row m-0">
                            <div class="col-12 d-md-flex p-0 mb-2">
                                <h3>Tipo de servicio: &nbsp;</h3>
                                <span class="tipo_servicio"></span>
                            </div>
                            <div class="col-12 d-md-flex p-0 mb-2">
                                <h3>Servicio: &nbsp;</h3>
                                <span class="servicio"></span>
                            </div>
                        </div>

                        <div class="row m-0">
                            <div class="col-12 d-flex p-0 mb-2">
                                <h3>Tipo de atención: &nbsp;</h3>
                                <span class="atencion"></span>
                            </div>
                            <div class="col-md-9 p-0 mb-2">
                                <h3>Lugar: &nbsp;</h3>
                                <span class="lugar"></span>
                            </div>
                            {{--
                            <div class="col-md-3 d-flex d-md-block p-0 mb-2">
                                <h3 class="text-md-right mr-2 mr-md-0">Consultorio:</h3>
                                <span class="d-md-flex justify-content-md-center"></span>
                            </div>
                            --}}
                        </div>
                    </div>
                </div>

                <div class="modal-footer content_btn_center">
                    <form method="post" id="form-cancelar-cita">
                        <input type="hidden" class="form-control" id="profesional-cancelar" name="profesional"/>
                        <button type="button" class="button_transparent mr-2" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="button_blue" id="">Confirmar</button>
                    </form>
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


            $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
                var dateS = $('#date').val();
                var startDate = moment(data[0], 'DD-MM / YYYY');

                if (dateS == null || dateS === '') return true;
                return startDate.format('YYYY-MM-DD') === dateS;
            });

            //Inicializar tabla
            var table = $('#table-citas').DataTable({
                //dom: 'Plfrtip',
                dom:
                    // "<'#filter-input.row'><'row'<'col-12'P>>"+
                    "Pt",
                serverSide: true,
                processing: true,
                ajax: {
                    type: 'post',
                    url: '{{ route('institucion.calendario.lista-citas') }}',
                    data: (d) =>{
                        d.fecha = $('#fecha').val();
                        d.estado = $('#estado').val();
                    }
                },
                responsive: true,
                language: {
                    url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
                    emptyTable: ' '
                },
                columns: [
                    {data: "fecha", name: "fecha_inicio"},
                    {data: "hora_inicio", name: "fecha_inicio"},
                    {data: "hora_fin", name: 'fecha_fin'},
                    {
                        data: 'prof.nombre_completo',
                        name: 'prof.nombre_completo',
                        visible: false
                    },
                    {
                        data: 'profesional_nombre',
                        name: 'profesional_nombre',
                        searchable: false
                    },
                    {data: "nombreEspecialidad", name: 'nombreEspecialidad'},
                    {
                        data: 'serv.nombre',
                        name: 'serv.nombre',
                        visible: false
                    },
                    {
                        data: 'servicio',
                        name: 'servicio',
                        searchable: false
                    },
                    {data: "paciente_nombre", name: 'paciente_nombre'},
                    {data: "paciente_identificacion", name: 'paciente_identificacion'},
                    {data: "paciente_celular", name: "paciente_celular"},
                    {data: "estado", name: "estado"},
                    {
                        name: 'edit',
                        className: '',
                        data: function (data, type, full, meta) {

                            return '<div class="col-12 p-0 my-2 d-flex justify-content-center">' +
                                        '<button  class="btn__activado">' +
                                        '</button>' +
                                    '</div>';
                            
                                // '<div class="d-flex justify-content-center">' +
                                // '<button  class="btn_action_green tool top editar-cita" data-url="' + data.ver + '">' +
                                // '<i class="fas fa-calendar-day fa-2x"></i>' +
                                // '<span class="tiptext">Editar cita</span>' +
                                // '</button>' +
                                // '<button  class="btn_action_green tool top cancelar-cita" data-url="' + data.ver + '">' +
                                // '<i class="fas fa-calendar-times fa-2x"></i>' +
                                // '<span class="tiptext">Cancelar cita</span>' +
                                // '</button>' +
                                // '</div>';
                        },
                        searchable: false,
                        orderable: false,
                    },
                ],
                searchPanes: {
                    viewTotal: false               
                },

                columnDefs: [
                    {
                        searchPanes: {
                            show: true,
                            clear: false
                        },
                        targets: [3, 5, 7]
                    },
                    {
                        responsivePriority: 1,
                        targets: [-1]
                    }
                ],
                initComplete: function () {

                    var api = this.api();

                    $('.filter-data').on('change', function () {
                        table.ajax.reload(null, false)
                    });

                    $('#fecha').datepicker({
                        language: 'es',
                        format: 'yyyy-mm-dd',
                        //startDate: moment().format('YYYY-MM-DD'),
                    });

                    table.ajax.reload(null, false);

                    table.searchPanes.container().insertAfter('#data');

                    //table.search().draw();
                }
                // createdRow: function (row, data, dataIndex) {
                //     $(row).addClass('bg-' + data.estado);
                // }
            });

            setInterval(function () {
                table.ajax.reload(null, false);
            }, 30000);

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
