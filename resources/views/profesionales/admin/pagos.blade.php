@extends('profesionales.admin.layouts.panel')

@section('contenido')
        <section class="section">
            <div class="row containt_agendaProf" id="basic-table">
                <div class="col-12 p-0">
                    <div class="section_cabecera_citas">
                        <div>
                            <h1 class="title_miCita">Mis pagos</h1>
                            <span class="subtitle_miCita">Encuentre aquí los pagos realizados por cada una de sus citas.</span>
                        </div>
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
{{--                                                        <button type="submit" class="btn_descargar_pago"> --}}
{{--                                                            Descargar <i class="fas fa-d"></i>--}}
{{--                                                        </button>--}}
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
