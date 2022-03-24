@extends('instituciones.admin.layouts.layout')

@section('styles')
    <link rel="stylesheet" href="{{ asset('plugins/DataTables/datatables.min.css') }}">
    <style>
        /*.dataTables_filter, .dataTables_info { display: none;!important; }*/
    </style>
@endsection

@section('contenido')
        <section class="section pr-lg-4">
            <div class="row containt_agendaProf mb-3" id="basic-table">
                <div class="col-12 p-0">
                    <div class="my-4 my-xl-5">
                        <h1 class="title__xl blue_bold">Mis pagos</h1>
                        <span class="subtitle__lg black_light">Encuentre aquí los pagos realizados por cada una de sus citas.</span>
                    </div>

                    <div class="containt_main_form mb-3">
                        <div class="table-responsive">
                            <table class="table" id="table-pagos">
                                <thead>
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Tipo de cita</th>
                                        <th>Paciente</th>
                                        <th>Estado</th>
                                        <th>Valor</th>
                                        <!-- <th></th> -->
                                    </tr>
                                </thead>

                                <tbody>
                                    @if($pagos->isNotEmpty())
                                        @foreach($pagos as $pago)
                                            <tr>
                                                <td>{{ $pago->fecha->format('d-m /Y') }}</td>
                                                <td>{{ $pago->cita->tipo_consulta->nombreconsulta ?? ''}}</td>
                                                <td>{{ $pago->cita->paciente->user->nombre_completo ?? ''}}</td>
                                                <td>{{ ($pago->aprobado) ? 'Aprobado':'Por pagar' }}</td>
                                                <td>${{ number_format($pago->valor, 0, ",", ".") }}</td>
                                                <!-- <td class="content_btn_descargar">

                                                </td> -->
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
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
        });

        $("#search").on('keyup change',function(){
            var texto = $(this).val();
            table.search(texto).draw();
        });
    </script>
@endsection
