@extends('instituciones.admin.layouts.layout')

@section('styles')
    <link rel="stylesheet" href="{{ asset('plugins/DataTables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/DataTables/Responsive-2.2.9/css/responsive.dataTables.min.css') }}">
{{--    <link rel="stylesheet" href="{{ asset(' plugins/DataTables/Responsive-2.2.9/css/responsive.bootstrap.min.css') }}">--}}
    <style>
        .dataTables_filter, .dataTables_info { display: none;!important; }
        .bg-agendado { background: #00abb2}
        .bg-cancelado { background: #b2004a}
        .bg-completado { background: #47b200}
        .bg-reservado { background: #b28800}
    </style>
@endsection

@section('contenido')
    <div class="container-fluid p-0 pr-lg-4">
        <div class="containt_agendaProf" id="basic-table">
            <div class="my-4 my-xl-5">
                <h1 class="title__xl green_bold">Citas</h1>
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
                <table class="table display responsive nowrap" style="width: 100%" id="table-citas">
                    <thead class="thead_green">
                        <tr>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Profesional</th>
                            <th>Paciente</th>
                            <th>Identificación</th>
                            <th>Lugar</th>
                        </tr>
                    </thead>
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
            //$.fn.dataTable.moment( 'HH:mm A \- HH:mm A', 'es');


            $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
                var dateS = $('#date').val();
                var startDate = moment(data[0], 'DD-MM / YYYY');

                if (dateS == null || dateS === '') return true;
                return startDate.format('YYYY-MM-DD') === dateS;
            });

            //Inicializar tabla
            var table = $('#table-citas').DataTable({
                pageLength: 2,
                lengthMenu: [2,50,100,-1],
                responsive: true,
                language: {
                    url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                },
                columns:[
                    {data: "fecha"},
                    {data: "hora"},
                    {data: "profesional"},
                    {data: "paciente"},
                    {data: "identificacion"},
                    {data: "lugar"}
                ],
                // columnDefs: [
                //     {
                //         targets: [-1],
                //         orderable: false,
                //     }
                // ],
                ajax:{
                    data:{ids: {!! json_encode($lista) !!}},
                    type: 'post',
                    url: '{{ route('institucion.calendario.lista-citas') }}',
                    // data: function ( d ) {
                    //     console.log(d);
                    //     // return $.extend({}, d, {
                    //     //     "extra_search": $('#extra').val()
                    //     // });
                    // }
                },
                createdRow: function (row, data, dataIndex) {
                    $(row).addClass('bg-' + data.estado);
                }
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
