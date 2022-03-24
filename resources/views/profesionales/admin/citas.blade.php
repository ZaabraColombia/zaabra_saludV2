@extends('profesionales.admin.layouts.panel')

@section('styles')
    <link rel="stylesheet" href="{{ asset('plugins/DataTables/datatables.min.css') }}">
    <style>
        .dataTables_filter, .dataTables_info { display: none;!important; }
    </style>
@endsection

@section('contenido')
    <div class="container-fluid p-0 pr-lg-4">
        <div class="containt_agendaProf" id="basic-table">
            <div class="my-4 my-xl-5">
                <h1 class="title__xl blue_bold">Mis citas</h1>
                <span class="text__md black_light">Encuentre aquí las citas agendadas por sus pacientes.</span>
            </div>

            <!-- Contenedor barra de búsqueda mis pacientes -->
            <div class="containt_main_table mb-3">
                <div class="row m-0">
                    <div class="col-md-9  p-0 input__box mb-0">
                        <input class="mb-md-0" type="search" name="search" id="search" placeholder="Buscar Citas" />
                    </div>
                </div>
            </div>

            <!-- Contenedor formato tabla de la lista de mis pacientes -->
            <div class="containt_main_table mb-3">
                <div class="col-md-4 col-xl-3 p-0 input__box">
                    <label for="date"><b>Filtrar por fecha</b></label>
                    <input type="date" id="date" class="form-control"/>
                    <!-- <label for="date"><b>Descargar en</b></label> -->
                </div>

                <div class="table-responsive">
                    <table class="table table_agenda" id="table-citas">
                        <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Tipo de cita</th>
                            <th>Paciente</th>
                            <th>Teléfonos</th>
                            <th>Dirección</th>
                            <th>Estado</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($citas->isNotEmpty())
                            @foreach($citas as $cita)
                                <tr>
                                    <td>{{ $cita->fecha_inicio->format('d-m /Y') }}</td>
                                    <td>{{ "{$cita->fecha_inicio->format('H:i A')} - {$cita->fecha_fin->format('H:i A') }" }}</td>
                                    <td>{{ $cita->tipo_consulta->nombreconsulta }}</td>
                                    <td>{{ $cita->paciente->user->nombre_completo }} <br>
                                        <span>name@gmail.com</span>
                                    </td>
                                    <td>
                                        <span>310 235 6548</span> <br>
                                        <span>7025 235</span>
                                    </td>
                                    <td>
                                        <span>call 34 sur # 56 - 44</span> <br>
                                        <span>Conjunto los ceresos</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $cita->bg_estado }}">{{ $cita->estado }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Pop-up  editar cita -->
    <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal_citas_popUp" role="document">
            <div class="modal-content content_modalCitas">
                <!-- Sección boton derecho de cierre "X" -->
                <div class="modal-header modal_headerCitas">
                    <h1 class="title_popup_miCita" id="exampleModalLabel">Editar cita</h1>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body modal_headerCitas">
                    <form method="POST" action="">
                        <!-- <div class="col-md-6 section_inputRight-text-formProf">
                            <label for="example-date-input" class="col-12 text_label-formProf">Especialidad</label>
                            <select name="idespecialidad" id="idespecialidad" class="col-lg-12 form-control" required></select>
                        </div> -->

                        <div class="col-md-6 p-0">
                            <label for="example-date-input" class="col-12 text_label-formProf">Especialidad</label>

                            <input class="col-12 form-control" id="" placeholder="Traumatología" type="text" name="" required>
                        </div>

                        <div class="col-md-6 p-0">
                            <label for="example-date-input" class="col-12 text_label-formProf">Estado</label>

                            <select id="nombreconsulta[]" class="form-control" name="nombreconsulta[]">
                                <option value="" selected> Seleccionar </option>
                                <option value="Presencial"> Confirmada </option>
                                <option value="Virtual"> Cancelada </option>
                            </select>
                        </div>

                        <div class="col-md-6 p-0">
                            <label for="example-date-input" class="col-12 text_label-formProf">Fecha</label>

                            <input class="form-control" type="date" value="2011-08-19" id="example-date-input" name="fechaestudio[]">
                        </div>

                        <div class="col-md-6 p-0">
                            <label for="example-date-input" class="col-12 text_label-formProf">Hora</label>

                            <input class="form-control" type="time" value="" id="example-date-input" name="fechaestudio[]">
                        </div>
                    </form>
                </div>

                <!-- Sección botón Pagar -->
                <div class="modal-footer section_btn_citas">
                    <button type="submit" class="btnAgendar-popup" id="">Guardar</button>

                    <button type="submit" class="btnCancelar-popup" id="">Cancelar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Pop-up cancelar cita -->
    <div class="modal fade modalA" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
        <div class="modal-dialog modal-lg modal_citas_popUp" role="document">
            <div class="modal-content content_citaCancela">
                <!-- Sección boton derecho de cierre "X" -->
                <div class="modal-header modal_cancelarCitas">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body modal_cancelarCitas">
                    <h1 class="title_cancelar_miCita" id="exampleModalLabel2">¿Está seguro de cancelar cita?</h1>
                </div>

                <!-- Sección botón Pagar -->
                <div class="modal-footer section_cancelar_citas">
                    <!-- Función onclick para mostrar el pop-up de cancelación y ocultar pop-up de opciones la cual esta implementada en admin.js -->
                    <button type="submit" class="btn_cancela-cita" id="" data-toggle="modal" data-target="#exampleModal3" onclick="elementClose(this)" data-position="cancelo">Sí, cancelar cita</button>

                    <button type="submit" class="btn_noCancela-cita" id="">No cancelar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Pop-up cancelar cita -->
    <div class="modal fade modalB" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel3" aria-hidden="true">
        <div class="modal-dialog modal-lg container_modal_cancelo" role="document">
            <div class="modal-content content_canceloCita">
                <!-- Sección boton derecho de cierre "X" -->
                <div class="modal-header modal_cancelarCitasProf">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body modal_contentCitasProf">
                    <h1 class="title_cancelar_miCita" id="exampleModalLabel3">Cita cancelada.</h1>
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
    <script src="{{ asset('js/alertas.js') }}"></script>

    <script>
        $(document).ready( function () {

            $.fn.dataTable.moment( 'DD-MM / YYYY', 'es');
            $.fn.dataTable.moment( 'HH:mm A \- HH:mm A', 'es');


            $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
                var dateS = $('#date').val();
                var startDate = moment(data[0], 'DD-MM / YYYY');

                if (dateS == null || dateS === '') return true;
                return startDate.format('YYYY-MM-DD') === dateS;
            });

            //Inicializar tabla
            var table = $('#table-citas').DataTable({
                bFilter: false,
                bInfo: false,
                responsive: true,
                language: {
                    url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                },
                dom: 'lfBrtip',
                buttons: [
                    {
                        extend: 'pdfHtml5',
                        text: 'PDF',
                        className: 'red',
                        title:'Resultados',
                        exportOptions: {
                            modifier: {
                                page: 'current'
                            }
                        },
                        //text: 'Red',
                    },
                    {
                        extend: 'excel',
                        text: 'Excel',
                        className: 'border_left',
                        title:function () {
                            return 'Resultados';
                        }
                    },
                ],
                searching: true,
                columnDefs: [
                    {
                        targets: [-1],
                        orderable: false,
                    }
                ],
            });

            $("#search").on('keyup change',function(){
                var texto = $(this).val();
                table.search(texto).draw();
            });
            $("#date").on('change',function(){
                table.draw();
            });
        });
    </script>
@endsection
