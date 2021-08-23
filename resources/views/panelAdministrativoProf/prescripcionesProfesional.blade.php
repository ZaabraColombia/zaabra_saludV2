@extends('panelAdministrativoProf.panelAdministrativoProfesional')

@section('PanelProf')
    <section class="section">
        <div class="row containt_agendaProf" id="basic-table">
            <div class="col-12 p-0">
                <div class="section_cabecera_histClinica pad_rigth_formula">
                    <div>
                        <h1 class="title_miCita">Prescripciones/fórmulas médicas</h1>
                        <span class="subtitle_miCita">Administre las fórmulas médicas de sus pacientes.</span>
                    </div>

                    <a type="submit" href='{{url("crearFormulaProfesional")}}' class="btn_crear_formula"> Crear fórmula
                        <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flecha_btn_agendar" alt=""> 
                    </a>
                </div>    

                <div class="card container_formula">
                    <div class="card-content">
                        <div class="card-body py-0">
                            <!-- Table with outer spacing -->
                            <div class="table-responsive section_tableCitas">
                                <table class="table table-lg table_citas">
                                    <thead>
                                        <tr>
                                            <th>Código</th>
                                            <th>Paciente</th>
                                            <th>Especialidad</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>00123</td>
                                            <td>Juan Hernández</td>
                                            <td>Traumatología</td>
                                            <td>
                                                <button class="btn_descargar_formula" type="submit" data-toggle="modal" data-target="#exampleModal1"></button>
                                            </td>
                                        <td>
                                            <button class="btn_cierre_citasProf" type="submit" data-toggle="modal" data-target="#exampleModal2"></button>
                                        </td>
                                        </tr>
                                        <tr>
                                            <td>00124</td>
                                            <td>Blanca Bernal</td>
                                            <td>Traumatología</td>
                                            <td>
                                                <button class="btn_descargar_formula" type="submit" data-toggle="modal" data-target="#exampleModal1"></button>
                                            </td>
                                        <td>
                                            <button class="btn_cierre_citasProf" type="submit" data-toggle="modal" data-target="#exampleModal2"></button>
                                        </td>
                                        </tr>
                                        <tr>
                                            <td>00125</td>
                                            <td>Laura León</td>
                                            <td>Traumatología</td>
                                            <td>
                                                <button class="btn_descargar_formula" type="submit" data-toggle="modal" data-target="#exampleModal1"></button>
                                            </td>
                                        <td>
                                            <button class="btn_cierre_citasProf" type="submit" data-toggle="modal" data-target="#exampleModal2"></button>
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

    <!-- Pop-up eliminar prescripción -->
    <div class="modal fade modalA" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
        <div class="modal-dialog modal-lg modal_citas_popUp" role="document">
            <div class="modal-content content_citaCancela">
                <!-- Sección boton derecho de cierre "X" -->
                <div class="modal-header modal_cancelarCitas">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body modal_cancelarCitas">
                    <h1 class="title_cancelar_miCita" id="exampleModalLabel2">¿Está seguro de eliminar la prescripción/fórmula?</h1>
                </div>

                <!-- Sección botón Pagar -->
                <div class="modal-footer section_cancelar_citas">
                    <!-- Función onclick para mostrar el pop-up de cancelación y ocultar pop-up de opciones la cual esta implementada en admin.js -->
                    <button type="submit" class="btn_cancela-cita" id="" data-toggle="modal" data-target="#exampleModal3" onclick="elementClose(this)" data-position="cancelo">Sí, eliminar</button>

                    <button type="submit" class="btn_noCancela-cita" id="">No eliminar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Pop-up se elimino prescripción -->
    <div class="modal fade modalB" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel3" aria-hidden="true">
        <div class="modal-dialog modal-lg container_modal_cancelo" role="document">
            <div class="modal-content content_canceloCita">
                <!-- Sección boton derecho de cierre "X" -->
                <div class="modal-header modal_cancelarCitasProf">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body modal_contentCitasProf">
                    <h1 class="title_cancelar_miCita" id="exampleModalLabel3">Prescripción/fórmula eliminada.</h1>
                </div>
            </div>
        </div>
    </div>
@endsection