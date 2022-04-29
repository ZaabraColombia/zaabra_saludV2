@extends('instituciones.profesionales.layouts.panel')

@section('styles')
    <link rel="stylesheet" href="{{ asset('plugins/DataTables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/DataTables/Responsive-2.2.9/css/responsive.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset(' plugins/DataTables/Responsive-2.2.9/css/responsive.bootstrap.min.css') }}">
    <style>
        .dataTables_filter, .dataTables_info { display: none;!important; }
    </style>
@endsection

@section('contenido')
    <div class="container-fluid p-0 pr-lg-4">
        <div class="containt_agendaProf" id="basic-table">
            <div class="my-4 my-xl-5">
                <h1 class="title__xl blue_bold">Citas</h1>
                <span class="text__md black_light">Encuentre aquí las citas agendadas por sus pacientes.</span>
            </div>

            <!-- Contenedor barra de búsqueda pacientes -->
            <div class="containt_main_table mb-3">
                <div class="row m-0">
                    <div class="col-md-9  p-0 input__box mb-0">
                        <input class="mb-md-0" type="search" name="search" id="search" placeholder="Buscar cita" />
                    </div>
                </div>
            </div>

            <!-- Contenedor formato tabla de la lista de pacientes -->
            <div class="containt_main_table mb-3">
                {{--
                <div class="col-md-4 col-xl-3 p-0 input__box">
                    <label for="date"><b>Filtrar por fecha</b></label>
                    <input type="date" id="date" class="form-control"/>
                </div>
                --}}

                <table class="table display responsive nowrap" style="width: 100%" id="table-citas">
                    <thead>
                        <tr>
                            <th>Hora Inicio</th>
                            <th>Hora Fin</th>
                            <th>Fecha</th>
                            <th>Especialidad</th>
                            <th>Paciente</th>
                            <th>Identificación</th>
                            <th>Lugar</th>
                            <th>Celular</th>
                            <th>Estado</th>
                        </tr>
                    </thead>

                    <tbody>
                    @if($citas->isNotEmpty())
                        @foreach($citas as $cita)
                            <tr>
                                <td>{{ $cita->fecha_inicio->format('h:i a') }}</td>
                                <td>{{ $cita->fecha_fin->format('h:i a') }}</td>
                                <td>{{ $cita->fecha_inicio->format('d-m / Y') }}</td>
                                <td>{{ $cita->especialidad->nombreEspecialidad ?? '' }}</td>
                                <td>{{ $cita->paciente->user->nombre_completo ?? '' }}</td>
                                <td>{{ $cita->paciente->user->identificacion ?? '' }}</td>
                                <td>{{ $cita->lugar }}</td>
                                <td>{{ str_replace(',', ' - ', $cita->paciente->celular ?? '') }}</td>
                                <td>{{ $cita->estado }}</td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
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
            $.fn.dataTable.moment( 'HH:mm A', 'es');


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
                searching: true,
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
                ]
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
