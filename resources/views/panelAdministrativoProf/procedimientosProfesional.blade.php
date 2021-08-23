@extends('panelAdministrativoProf.panelAdministrativoProfesional')

@section('PanelProf')
        <section class="section">
            <div class="row containt_agendaProf" id="basic-table">
                <div class="col-12 p-0">
                    <div class="section_cabecera_citas padRight_agenProf">
                        <div>
                            <h1 class="title_miCita">Procedimientos (CUPS)</h1>
                            <span class="subtitle_miCita">Procedimientos (CUPS) de acuerdo con la Resolución No.0002238 de 2020 emitida por el Ministerio de Salud y Protección Social,
                                la cual define la Actualización única de procedimientos en Salud - CUPS.
                            </span>
                        </div>
                    </div>    

                    <div class="card container_proced">
                        <div class="card-content">
                            <div class="card-body py-0">
                                <!-- Table with outer spacing -->
                                <div class="table-responsive section_tableCitas">
                                    <table class="table table-lg table_citas">
                                        <tbody>
                                            <tr>
                                                <td><b>Nombre :</b></td>
                                                <td>2238 Por la cual Actualiza la Clasificación Única de Procedimientos en Salud - CUPS (002).pdf</td>
                                                <td>12.5Mb 10/12/2020</td>
                                            </tr>
                                            <tr>
                                                <td><b>Descripción :</b></td>
                                                <td>Actualización en la Clasificación Única de Procedimientos en Salud - CUPS (002)</td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <button type="submit" class="btn_descargar_agenProf"> Descargar
                                    <img src="{{URL::asset('/img/iconos/icono-descargar-pagos.svg')}}" class="icon_descargar" alt=""> 
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection