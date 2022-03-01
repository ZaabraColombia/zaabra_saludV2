@extends('panelAdministrativoProf.panelAdministrativoProfesional')

@section('PanelProf')
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
                                            <th>Especialidad</th>
                                            <th>Valor</th>
                                        </tr>
                                    </thead>
                                        <tbody>
                                            <tr>
                                                <td>25/05/2021</td>
                                                <td>Presencial</td>
                                                <td>Laura León</td>
                                                <td>Traumatología</td>
                                                <td>$50.000</td>
                                                <td class="content_btn_descargar">
                                                    <button type="submit" class="btn_descargar_pago"> Descargar
                                                        <img src="{{URL::asset('/img/iconos/icono-descargar-pagos.svg')}}" class="icon_descargar" alt=""> 
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>19/05/2021</td>
                                                <td>Virtual</td>
                                                <td>Jorge Romero</td>
                                                <td>Cardiología</td>
                                                <td>$45.000</td>
                                                <td class="content_btn_descargar">
                                                    <button type="submit" class="btn_descargar_pago"> Descargar
                                                        <img src="{{URL::asset('/img/iconos/icono-descargar-pagos.svg')}}" class="icon_descargar" alt=""> 
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>26/05/2021</td>
                                                <td>Control medico</td>
                                                <td>Martha Rodríguez</td>
                                                <td>Traumatología</td>
                                                <td>$30.000</td>
                                                <td class="content_btn_descargar">
                                                    <button type="submit" class="btn_descargar_pago"> Descargar
                                                        <img src="{{URL::asset('/img/iconos/icono-descargar-pagos.svg')}}" class="icon_descargar" alt=""> 
                                                    </button>
                                                </td>
                                            </tr>
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