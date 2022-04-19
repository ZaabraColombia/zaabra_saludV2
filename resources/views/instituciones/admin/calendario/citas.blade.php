@extends('instituciones.admin.layouts.layout')

@section('styles')
    <link rel="stylesheet" href="{{ asset('plugins/DataTables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/DataTables/Responsive-2.2.9/css/responsive.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset(' plugins/DataTables/Responsive-2.2.9/css/responsive.bootstrap.min.css') }}">
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
            </div>

            <!-- Contenedor barra de búsqueda pacientes -->
            <div class="containt_main_table mb-3">
                <div class="row m-0">
                    <div class="col-md-8  p-0 input__box mb-0">
                        <input class="mb-md-0" type="search" name="search" id="search" placeholder="Buscar cita" />
                    </div>

                    <div class="col-md-4 p-0 content_btn_right">
                        <a href="" class="button_transparent mr-2" id="">
                            Atras
                        </a>
                        <a href="" class="button_green" id="">
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
                            <th>Lugar</th>
                            <th>Celular</th>
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
                    {data: "lugar", name: "lugar"},
                    {data: "paciente.celular", name: "paciente.celular"},
                ],
                // columnDefs: [
                //     {
                //         targets: [-1],
                //         orderable: false,
                //         responsive: false
                //     }
                // ],
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
                createdRow: function (row, data, dataIndex) {
                    $(row).addClass('bg-' + data.estado);
                }
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
        });
    </script>
@endsection
