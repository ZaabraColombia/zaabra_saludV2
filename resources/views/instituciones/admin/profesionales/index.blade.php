@section('styles')
    <link rel="stylesheet" href="{{ asset('plugins/DataTables/datatables.min.css') }}">
    <style>
        .dataTables_filter, .dataTables_info { display: none;!important; }
    </style>
@endsection

@extends('instituciones.admin.layouts.layout')

@section('contenido')
    <div class="container-fluid p-0 pr-lg-4">
        <div class="containt_agendaProf">
            <div class="my-4 my-xl-5">
                <h1 class="title__xl green_bold">Profesionales</h1>
            </div>

            <!-- Contenedor barra de búsqueda y botón agregar contacto -->
            <div class="containt_main_table mb-3">
                <div class="row m-0">
                    <div class="col-md-9 p-0 input__box mb-0">
                        <input class="mb-md-0" type="search" name="search" id="search" placeholder="Buscar profesional">
                    </div>

                    <div class="col-md-3 p-0 content_btn_right">
                        <a href="{{ route('institucion.profesionales.create') }}" class="button_green" id="btn-agregar-contacto">
                            Agregar
                        </a>
                    </div>
                </div>
            </div>

            <!-- Contenedor formato tabla de la lista de contactos -->
            <div class="containt_main_table mb-3">
                <div class="table-responsive">
                    <table class="table table_agenda" id="table-pacientes">
                        <thead class="thead_green">
                        <tr>
                            <th>Nombre</th>
                            <th>Especialidad</th>
                            <th>Correo</th>
                            <th>Teléfonos</th>
                            <th>Dirección</th>
                            <th class="text-center">Acción</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($profesionales->isNotEmpty())
                            @foreach($profesionales as $profesional)
                                <tr>
                                    <td class="pr-0">
                                        <div class="user__xl">
                                            <div class="pr-2">
                                                <img class="img__contacs" src='{{ asset($profesional->foto_perfil_institucion ?? 'img/menu/avatar.png') }}'>
                                            </div>

                                            <div>
                                                <span>{{ $profesional->nombre_completo }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $profesional->nombre_especialidad ?? '' }}</td>
                                    <td>{{ $profesional->correo }}</td>
                                    <td>{{ "{$profesional->celular} - {$profesional->telefono}" }}</td>
                                    <td>{{ $profesional->direccion }}</td>
                                    <td>
                                        <div class="d-flex justify-content-between">
                                            <a class="btn_action_green tool top" style="width: 33px"
                                            href="{{ route('institucion.profesionales.edit', ['profesional' => $profesional->id_profesional_inst]) }}">
                                                <i data-feather="edit"></i> <span class="tiptext">Editar profesional</span>
                                            </a>
                                        
                                            <a class="btn_action_green tool top" style="width: 33px"
                                            href="{{ route('institucion.profesionales.configurar_calendario', ['profesional' => $profesional->id_profesional_inst]) }}">
                                                <i data-feather="calendar"></i> <span class="tiptext">Configurar agenda</span>
                                            </a>
                            
                                            <a class="btn_action_green tool top" style="width: 33px" href="#" data-toggle="modal" data-target="#modal_bloqueo_cita">
                                                <i data-feather="slash"></i> <span class="tiptext">Bloquear agenda</span>
                                            </a>
                                        </div>
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

    <!-- Modal  bloquear cita -->
    <div class="modal fade" id="modal_bloqueo_cita" tabindex="-1" >
        <div class="modal-dialog" role="document">
            <div class="modal-content modal_container">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form method="post" id="form-reagendar-cita">
                    @csrf
                    <div class="modal-body">
                        <h1 style="color: #019f86">Bloquear Agenda</h1>

                        <div class="form_modal">
                            <div class="row m-0">
                                <div class="col-12 p-0" id="alerta-reasignar"></div>

                                <div class="col-12 col-md-6 pl-0 pr-1">
                                    <label for="hora_inicio">Hora inicio</label>
                                    <input type="datetime-local" id="hora_inicio" name="hora_inicio" value="">
                                </div>

                                <div class="col-12 col-md-6 pr-0 pl-1">
                                    <label for="hora_fin">Hora fin</label>
                                    <input type="datetime-local" id="hora_fin" name="hora_fin" value="">
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
                        <button type="submit" class="button_green">Bloquear</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('plugins/DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('js/alertas.js') }}"></script>

    <script>
        //Inicializar tabla
        var table = $('#table-pacientes').DataTable({
            bFilter: false,
            bInfo: false,
            response: true,
            language: {
                url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
            },
            searching: true,
            columnDefs: [
                {
                    targets: [-1,-2],
                    orderable: false,
                }
            ],
            paging: true,

        });

        $("#search").on('keyup change',function(){
            var texto = $(this).val();
            table.search(texto).draw();
        });
    </script>
@endsection
