@extends('profesionales.admin.layouts.panelAdministrativoProfesional')

@section('PanelProf')
        <section class="section">
            <div class="row containt_agendaProf" id="basic-table">
                <div class="col-12 p-0">
                    <div class="section_cabecera_citas">
                        <div>
                            <h1 class="title_miCita">Diagnósticos (CIE - 10)</h1>
                            <span class="subtitle_miCita">Descargue el documentos de Diagnósticos (CIE - 10).</span>
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
                                                <td>Diagnósticos (CIE - 10)</td>
                                                <td>609KB 31/05/202</td>
                                            </tr>
                                            <tr>
                                                <td><b>Descripción :</b></td>
                                                <td>Tabla de la clasificación estadística internacional de enfermedades y problemas relacionados <br>
                                                    con la salud, decima revisión (cie-10) para el registro individual de prestaciones de servicios <br>
                                                    (rips) con restricciones de sexo, edad y códigos que no son afección principal. <br>
                                                </td>
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
