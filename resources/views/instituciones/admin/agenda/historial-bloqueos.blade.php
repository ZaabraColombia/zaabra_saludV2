@extends('instituciones.admin.layouts.layout')

@section('styles')
    <link rel="stylesheet" href="{{ asset('plugins/DataTables/datatables.min.css') }}">
    <style>
        .dataTables_filter, .dataTables_info { display: none;!important; }
    </style>
@endsection

@section('contenido')
    <section class="section pr-lg-4">
        <div class="row containt_agendaProf mb-3" id="basic-table">
            <div class="col-12 p-0">
                <div class="my-4 my-xl-5">
                    <h1 class="title__xl green_bold">Historial de bloqueos</h1>
                </div>

                <!-- Contenedor barra de búsqueda -->
                <div class="containt_main_table mb-3">
                    <div class="row m-0">
                        <div class="col-md-9 p-0 input__box mb-0">
                            <input class="mb-md-0" type="search" name="search" id="search" placeholder="Buscar pagos">
                        </div>
                    </div>
                </div>

                <div class="containt_main_table mb-3">
                    <div class="table-responsive">
                        <table class="table table_agenda" id="table-pagos">
                            <thead class="thead_green">
                                <tr>
                                    <th>Nombre profesional</th>
                                    <th>Especialidad</th>
                                    <th>Fecha inicio</th>
                                    <th>Fecha fin</th>
                                    <th class="text-center">Acción</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td>Nombre Completo</td>
                                    <td>Especialidad Médica</td>
                                    <td>00-00-0000</td>
                                    <td>00-00-0000</td>
                                    <td>
                                        <div class="d-flex justify-content-between">
                                            <a class="btn_action_green tool top" style="width: 33px"
                                            href="#" data-toggle="modal" data-target="#modal_ver_bloqueo">
                                                <i data-feather="eye"></i> <span class="tiptext">Ver bloqueo</span>
                                            </a>

                                            <a class="btn_action_green tool top" style="width: 33px"
                                            href="#" data-toggle="modal" data-target="#modal_editar_bloqueo">
                                                <i data-feather="edit"></i> <span class="tiptext">Editar bloqueo</span>
                                            </a>

                                            <a class="btn_action_green tool top" style="width: 33px"
                                            href="#" data-toggle="modal" data-target="#modal_desbloquear">
                                                <i data-feather="unlock"></i> <span class="tiptext">Desbloquear</span>
                                            </a>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Nombre Completo</td>
                                    <td>Especialidad Médica</td>
                                    <td>00-00-0000</td>
                                    <td>00-00-0000</td>
                                    <td>
                                        <div class="d-flex justify-content-between">
                                            <a class="btn_action_green tool top" style="width: 33px"
                                            href="#" data-toggle="modal" data-target="#modal_ver_bloqueo">
                                                <i data-feather="eye"></i> <span class="tiptext">Ver bloqueo</span>
                                            </a>

                                            <a class="btn_action_green tool top" style="width: 33px"
                                            href="#" data-toggle="modal" data-target="#modal_editar_bloqueo">
                                                <i data-feather="edit"></i> <span class="tiptext">Editar bloqueo</span>
                                            </a>

                                            <a class="btn_action_green tool top" style="width: 33px"
                                            href="#" data-toggle="modal" data-target="#modal_desbloquear">
                                                <i data-feather="unlock"></i> <span class="tiptext">Desbloquear</span>
                                            </a>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Nombre Completo</td>
                                    <td>Especialidad Médica</td>
                                    <td>00-00-0000</td>
                                    <td>00-00-0000</td>
                                    <td>
                                        <div class="d-flex justify-content-between">
                                            <a class="btn_action_green tool top" style="width: 33px"
                                            href="#" data-toggle="modal" data-target="#modal_ver_bloqueo">
                                                <i data-feather="eye"></i> <span class="tiptext">Ver bloqueo</span>
                                            </a>

                                            <a class="btn_action_green tool top" style="width: 33px"
                                            href="#" data-toggle="modal" data-target="#modal_editar_bloqueo">
                                                <i data-feather="edit"></i> <span class="tiptext">Editar bloqueo</span>
                                            </a>

                                            <a class="btn_action_green tool top" style="width: 33px"
                                            href="#" data-toggle="modal" data-target="#modal_desbloquear">
                                                <i data-feather="unlock"></i> <span class="tiptext">Desbloquear</span>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal Ver Historial de bloqueo -->
    <div class="modal fade modal_contactos" id="modal_ver_bloqueo">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal_container">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- Mantener las cases "label-*" -->
                <div class="modal-body">
                    <h1 style="color: #019F86">Historial Bloqueos</h1>

                    <div class="content__see_contacs" style="background-color: #6eb1a6">
                        <img class="img__see_contacs" id="foto" src=''>
                    </div>

                    <div class="content__border_see_contacs" style="background-color: #6eb1a6"></div>

                    <div class="modal_info_cita pt-5">
                        <div class="info_contac">
                            <span>Nombre profesional:</span>
                            <span>Nombre Completo</span>
                        </div>

                        <div class="info_contac">
                            <span>Especialidad:&nbsp;</span>
                            <span>Especialidad Médica</span>
                        </div>

                        <div class="info_contac">
                            <span>Fecha inicio:&nbsp;</span>
                            <span>00-00-0000</span>
                        </div>

                        <div class="info_contac">
                            <span>Fecha fin:&nbsp;</span>
                            <span>00-00-0000</span>
                        </div>

                        <div class="col-12 p-0 mt-3 form_modal">
                            <label for="comentarios">Comentarios</label>
                            <textarea name="comentarios" id="comentarios" rows="7" readonly></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer content_btn_center">
                    <button type="button" class="button_transparent" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Editar Historial de bloqueo -->
    <div class="modal fade modal_contactos" id="modal_editar_bloqueo">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal_container">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- Mantener las cases "label-*" -->
                <div class="modal-body">
                    <h1 style="color: #019F86">Editar Bloqueo</h1>

                    <div class="content__see_contacs" style="background-color: #6eb1a6">
                        <img class="img__see_contacs" id="foto" src=''>
                    </div>

                    <div class="content__border_see_contacs" style="background-color: #6eb1a6"></div>

                    <div class="modal_info_cita pt-5">
                        <div class="info_contac">
                            <span>Nombre profesional:</span>
                            <span>Nombre Completo</span>
                        </div>

                        <div class="info_contac">
                            <span>Especialidad:&nbsp;</span>
                            <span>Especialidad Médica</span>
                        </div>

                        <div class="info_contac">
                            <span>Fecha inicio:&nbsp;</span>
                            <span>00-00-0000</span>
                        </div>

                        <div class="info_contac">
                            <span>Fecha fin:&nbsp;</span>
                            <span>00-00-0000</span>
                        </div>
                    </div>

                    <form method="post" id="form-bloquear-agenda">
                        @csrf
                        <div class="modal-body p-0">
                            <div class="form_modal">
                                <div class="row m-0 mt-3">
                                    <div class="col-12 p-0" id="alerta-reasignar"></div>

                                    <div class="col-12 col-md-6 pl-0 pr-1">
                                        <label for="fecha_inicio">Fecha inicio</label>
                                        <input type="datetime-local" id="fecha_inicio" name="fecha_inicio">
                                    </div>

                                    <div class="col-12 col-md-6 pr-0 pl-1">
                                        <label for="fecha_fin">Fecha fin</label>
                                        <input type="datetime-local" id="fecha_fin" name="fecha_fin">
                                    </div>

                                    <div class="col-12 p-0">
                                        <label for="observacion">Comentarios</label>
                                        <textarea name="observacion" id="observacion" cols="35" rows="5"></textarea>
                                    </div>
                                </div>
                                <input type="hidden" id="id_cita-reasignar" name="id_cita"/>
                            </div>
                        </div>

                        <div class="modal-footer content_btn_center">
                            <button type="button" class="button_transparent" data-dismiss="modal">
                                Cancelar
                            </button>
                            <button type="submit" class="button_green">Confirmar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Ver Desbloquear -->
    <div class="modal fade modal_contactos" id="modal_desbloquear">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal_container">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- Mantener las cases "label-*" -->
                <div class="modal-body">
                    <h1 style="color: #019F86">Desbloquear</h1>

                    <div class="content__see_contacs" style="background-color: #6eb1a6">
                        <img class="img__see_contacs" id="foto" src=''>
                    </div>

                    <div class="content__border_see_contacs" style="background-color: #6eb1a6"></div>

                    <div class="modal_info_cita pt-5">
                        <div class="info_contac">
                            <span>Nombre profesional:</span>
                            <span>Nombre Completo</span>
                        </div>

                        <div class="info_contac">
                            <span>Especialidad:&nbsp;</span>
                            <span>Especialidad Médica</span>
                        </div>

                        <div class="info_contac">
                            <span>Fecha inicio:&nbsp;</span>
                            <span>00-00-0000</span>
                        </div>

                        <div class="info_contac">
                            <span>Fecha fin:&nbsp;</span>
                            <span>00-00-0000</span>
                        </div>

                        <div class="col-12 p-0 mt-3 form_modal">
                            <label for="comentarios">Comentarios</label>
                            <textarea name="comentarios" id="comentarios" rows="7" readonly></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer content_btn_center">
                    <button type="button" class="button_transparent" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="button_green" data-dismiss="modal">Confirmar</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('plugins/DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('js/alertas.js') }}"></script>

    <script>
        //Inicializar tabla
        var table = $('#table-pagos').DataTable({
            bFilter: false,
            bInfo: false,
            response: true,
            language: {
                url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
            },
            searching: true,
            dom: 'lfBrtip',
            buttons: [
                {
                    extend: 'pdfHtml5',
                    text: 'PDF',
                    className: 'red',
                    title:'Resultados',
                    exportOptions: {
                        columns: ":not(:last-child)",
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
                    title: 'Resultados',
                    exportOptions: {
                        columns: ":not(:last-child)",
                    },
                },
            ],
        });

        $("#search").on('keyup change',function(){
            var texto = $(this).val();
            table.search(texto).draw();
        });
    </script>
@endsection
