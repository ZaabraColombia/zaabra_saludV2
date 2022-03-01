@extends('profesionales.admin.layouts.panelAdministrativoProfesional')

@section('PanelProf')
        <section class="section">
            <div class="row containt_agendaProf" id="basic-table">
                <div class="col-12 p-0">
                    <div class="section_cabecera_citas">
                        <div>
                            <h1 class="title_miCita">Vademecum actualizado COLOMBIA INVIMA (CUMS)</h1>
                            <span class="subtitle_miCita">Descargue el vademécum actualizado COLOMBIA INVIMA (CUMS).</span>
                        </div>
                    </div>

                    <div class="card container_vademecum">
                        <div class="card-content">
                            <div class="card-body py-0">
                                <!-- Table with outer spacing -->
                                <div class="table-responsive section_tableCitas">
                                    <table class="table table-lg table_citas">
                                        <tbody>
                                            <tr>
                                                <td class="pr-md-0"><b>Nombre :</b></td>
                                                <td class="pr-md-0">Vademécum COLOMBIA INVIMA (CUMS)</td>
                                                <td class="pr-md-0">609KB 31/05/2021</td>
                                            </tr>
                                            <tr>
                                                <td class="pr-md-0"><b>Descripción :</b></td>
                                                <td class="pr-md-0">Documento de referencia que contiene las nociones <br>
                                                    o informaciones fundamentales en materia de salud.
                                                </td>
                                                <td class="pr-md-0"></td>
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
