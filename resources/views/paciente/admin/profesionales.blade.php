@extends('profesionales.admin.layouts.panel')

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
                <h1 class="title__xl blue_bold">Mis Pacientes</h1>
            </div>

            <!-- Contenedor barra de búsqueda y botón agregar contacto -->
            <div class="containt_main_form mb-3">
                <div class="row m-0">
                    <div class="col-md-9 p-0 input__box mb-0">
                        <input class="mb-md-0" type="search" name="search" id="search" placeholder="Buscar Paciente">
                    </div>
                </div>
            </div>

            <!-- Contenedor formato tabla de la lista de contactos -->
            <div class="containt_main_form mb-3">
                <div class="table-responsive">
                    <table class="table" id="table-pacientes">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Especialidad</th>
                                <th>Universidad</th>
                                <th>Teléfonos</th>
                                <th>Dirección</th>
                                <th>Institución</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        @if($profesionales->isNotEmpty())
                            @foreach($profesionales as $profesional)
                                <tr>
                                    <td>{{ $profesional->user->nombre_completo }}</td>
                                    <td>{{ $profesional->especialidad->nombreEspecialidad }}</td>
                                    <td>{{ $profesional->universidad->nombreuniversidad }}</td>
                                    <td>{{ "{$profesional->celular} - {$profesional->telefono}" }}</td>
                                    <td>{{ $profesional->direccion }}</td>
                                    <td>{{ $profesional->EmpresaActual }}</td>
                                    <td>
                                        <a href="{{ route('PerfilProfesional', ['slug' => $profesional->slug]) }}" target="_blank">
                                            <i class="fas fa-external-link-alt" style="color: #0c0c0c"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('paciente.asignar-cita-profesional', ['profesional' => $profesional->slug]) }}">
                                            <i class="fas fa-calendar-check" style="color: #0c0c0c"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        @if($profesionales_ins->isNotEmpty())
                            @foreach($profesionales_ins as $profesional)
                                <tr>
                                    <td>{{ $profesional->nombre_completo }}</td>
                                    <td>{{ $profesional->especialidad[0]->nombreEspecialidad ?? '' }}</td>
                                    <td>{{ $profesional->universidad->nombreuniversidad }}</td>
                                    <td>{{ "{$profesional->institucion->telefonouno} - {$profesional->institucion->telefono2}" }}</td>
                                    <td>{{ $profesional->institucion->direccion }}</td>
                                    <td>{{ $profesional->institucion->user->nombreinstitucion }}</td>
                                    <td>
                                        <a href="{{ route('PerfilInstitucion', ['slug' => $profesional->institucion->slug]) }}" target="_blank">
                                            <i class="fas fa-external-link-alt" style="color: #0c0c0c"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="#">
                                            <i class="fas fa-calendar-check" style="color: #0c0c0c"></i>
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
        });

        $("#search").on('keyup change',function(){
            var texto = $(this).val();
            table.search(texto).draw();
        });
    </script>
@endsection