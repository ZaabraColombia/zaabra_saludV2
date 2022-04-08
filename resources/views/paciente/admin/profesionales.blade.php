@extends('paciente.admin.layouts.layout')

@section('styles')
    <link rel="stylesheet" href="{{ asset('plugins/DataTables/datatables.min.css') }}">
    <style>
        .dataTables_filter, .dataTables_info { display: none;!important; }
    </style>
@endsection

@section('contenido')
    <div class="container-fluid p-0 pr-lg-4">
        <div class="containt_agendaProf">
            <div class="my-4 my-xl-5">
                <h1 class="title__xl blue_bold">Mis Especialistas</h1>
            </div>

            <!-- Contenedor barra de búsqueda -->
            <div class="containt_main_table mb-3">
                <div class="row m-0">
                    <div class="col-md-9 p-0 input__box mb-0">
                        <input class="mb-md-0" type="search" name="search" id="search" placeholder="Buscar especialista">
                    </div>
                </div>
            </div>

            <!-- Contenedor formato tabla de la lista de especialistas -->
            <div class="containt_main_table mb-3">
                <div class="table-responsive">
                    <table class="table table_agenda" id="table-pacientes">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Especialidad</th>
                                <th>Teléfonos</th>
                                <th>Dirección</th>
                                <th>Institución</th>
                                <th class="text-right">Acción</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            @if($profesionales->isNotEmpty())
                                @foreach($profesionales as $profesional)
                                    <tr>
                                        <td class="pr-0">
                                            <div class="user__xl">
                                                <div class="pr-2">
                                                    <img class="img__contacs" src='{{ asset($profesional->fotoperfil ?? 'img/menu/avatar.png') }}'>
                                                </div>

                                                <div>
                                                    <span>{{ $profesional->user->nombre_completo }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $profesional->especialidad->nombreEspecialidad }}</td>
                                        <td>{{ "{$profesional->celular} - {$profesional->telefono}" }}</td>
                                        <td>{{ $profesional->direccion }}</td>
                                        <td>{{ $profesional->EmpresaActual }}</td>
                                        <td>
                                            <a class="btn_action tool top" style="width: 33px" href="{{ route('PerfilProfesional', ['slug' => $profesional->slug]) }}" target="_blank">
                                                <i data-feather="external-link"></i>  <span class="tiptext">Perfil doctor</span>
                                            </a>
                                        </td>
                                        <td>
                                            <a class="btn_action tool top" style="width: 33px" href="{{ route('paciente.asignar-cita-profesional', ['profesional' => $profesional->slug]) }}">
                                                <i data-feather="calendar"></i> <span class="tiptext">Agendar cita</span>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif

                            @if($profesionales_ins->isNotEmpty())
                                @foreach($profesionales_ins as $profesional)
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
                                        <td>{{ $profesional->especialidad[0]->nombreEspecialidad ?? '' }}</td>
                                        <td>{{ "{$profesional->institucion->telefonouno} - {$profesional->institucion->telefono2}" }}</td>
                                        <td>{{ $profesional->institucion->direccion }}</td>
                                        <td>{{ $profesional->institucion->user->nombreinstitucion }}</td>
                                        <td>
                                            <a class="btn_action toll top" style="width: 33px" href="{{ route('PerfilInstitucion', ['slug' => $profesional->institucion->slug]) }}" target="_blank">
                                                <i class="external-link"></i> <span class="tiptext">Perfil doctor</span>
                                            </a>
                                        </td>
                                        <td>
                                            <a class="btn_action toll top" style="width: 33px" href="#">
                                                <i class="calendar"></i> <span class="tiptext">Agendar cita</span>
                                            </a>
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
            ]
        });

        $("#search").on('keyup change',function(){
            var texto = $(this).val();
            table.search(texto).draw();
        });
    </script>
@endsection
