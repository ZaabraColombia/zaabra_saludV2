@extends('profesionales.admin.layouts.panel')

@section('contenido')
        <section class="section pr-lg-4">
            <div class="row containt_agendaProf mb-3" id="basic-table">
                <div class="col-12 p-0">
                    <div class="my-4 my-xl-5">
                        <h1 class="title__xl blue_bold">Mis pagos</h1>
                        <span class="subtitle__lg black_light">Encuentre aquí los pagos realizados por cada una de sus citas.</span>
                    </div>

                    <div class="card container_pagos">
                        <div class="card-content">
                            <div class="card-body py-0">
                                <!-- Table with outer spacing -->
                                <div class="table-responsive section_tableCitas">
                                    <table class="table table-lg table_citas">
                                        <thead>
                                            <tr>
                                                <th>Fecha</th>
                                                <th>Tipo de cita</th>
                                                <th>Paciente</th>
                                                <th>Estado</th>
                                                <th>Valor</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                            @if($pagos->isNotEmpty())
                                                @foreach($pagos as $pago)
                                                    <tr>
                                                        <td>{{ $pago->fecha->format('d,m /Y') }}</td>
                                                        <td>{{ $pago->cita->tipo_consulta->nombreconsulta }}</td>
                                                        <td>{{ $pago->cita->paciente->user->nombre_completo }}</td>
                                                        <td>{{ ($pago->aprobado) ? 'Aprobado':'Por pagar' }}</td>
                                                        <td>{{ $pago->valor }}</td>
                                                        <td class="content_btn_descargar">

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
                </div>
            </div>
        </section>
@endsection
