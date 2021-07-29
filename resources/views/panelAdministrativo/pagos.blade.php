@extends('panelAdministrativo.panelAdministrativo')
@section('Panel')
        <section class="section">
            <div class="row m-0 p-0" id="basic-table">
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
                                <div class="table-responsive">
                                    <table class="table table-lg table_citas">
                                        <thead>
                                            <tr>
                                                <th>Fecha</th>
                                                <th>Hora</th>
                                                <th>Tipo de cita</th>
                                                <th>Especialidad</th>
                                                <th>Valor</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>25/05/2021</td>
                                                <td>10:00 am</td>
                                                <td>Presencial</td>
                                                <td>Traumatología</td>
                                                <td>$50.000</td>
                                                <td class="content_btn_descargar">
                                                    <button type="submit" class="btn_descargar_pago"> Descargar
                                                        <img src="{{URL::asset('/img/iconos/icono-descargar-pagos.svg')}}" class="icon_descargar" alt=""> 
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>25/05/2021</td>
                                                <td>10:00 am</td>
                                                <td>Presencial</td>
                                                <td>Traumatología</td>
                                                <td>$50.000</td>
                                                <td class="content_btn_descargar">
                                                    <button type="submit" class="btn_descargar_pago"> Descargar
                                                        <img src="{{URL::asset('/img/iconos/icono-descargar-pagos.svg')}}" class="icon_descargar" alt=""> 
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>25/05/2021</td>
                                                <td>10:00 am</td>
                                                <td>Presencial</td>
                                                <td>Traumatología</td>
                                                <td>$50.000</td>
                                                <td class="content_btn_descargar">
                                                    <button type="submit" class="btn_descargar_pago"> Descargar
                                                        <img src="{{URL::asset('/img/iconos/icono-descargar-pagos.svg')}}" class="icon_descargar" alt=""> 
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>25/05/2021</td>
                                                <td>10:00 am</td>
                                                <td>Presencial</td>
                                                <td>Traumatología</td>
                                                <td>$50.000</td>
                                                <td class="content_btn_descargar">
                                                    <button type="submit" class="btn_descargar_pago"> Descargar
                                                        <img src="{{URL::asset('/img/iconos/icono-descargar-pagos.svg')}}" class="icon_descargar" alt=""> 
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>25/05/2021</td>
                                                <td>10:00 am</td>
                                                <td>Presencial</td>
                                                <td>Traumatología</td>
                                                <td>$50.000</td>
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