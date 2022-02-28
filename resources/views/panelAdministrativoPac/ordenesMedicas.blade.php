@extends('panelAdministrativoPac.panelAdministrativo')
@section('Panel')
    <section class="section">
        <div class="row m-0 p-0" id="basic-table">
            <div class="col-12 col-md-10 col-lg-12 m-auto p-0">
                <div class="section_cabecera_ordMed">
                    <div>
                        <h1 class="title_ordMed">Mis exámenes</h1>
                        <span class="subtitle_ordMed">Encuentre aquí todos sus exámenes y resultados. Puede cargarlos y asignarlos a un Especialistas.</span>
                    </div>
                </div>

                <div class="card container_ordMed">
                    <div class="card-content">
                        <div class="card-body py-0">
                            <!-- Table with outer spacing -->
                            <div class="table-responsive">
                                <table class="table table-lg table_ordMed">
                                    <thead>
                                        <tr>
                                            <th>Documento</th>
                                            <th>Subido por</th>
                                            <th>Asignado a</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>examen_medico_traumatologia.pdf</td>
                                            <td>Juan Hernández</td>
                                            <td></td>
                                            <td>
                                                <button class="btn_cierre_ordMed" type="submit" data-toggle="modal" data-target="#exampleModal2"></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>examen_medico_cardiología.pdf</td>
                                            <td>Blanca Bernal</td>
                                            <td></td>
                                            <td>
                                                <button class="btn_cierre_ordMed" type="submit" data-toggle="modal" data-target="#exampleModal2"></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>examen_medico_traumatologia.pdf</td>
                                            <td>Laura León</td>
                                            <td>Daniel Gomez</td>
                                            <td>
                                                <button class="btn_cierre_ordMed" type="submit" data-toggle="modal" data-target="#exampleModal2"></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <span class="text_inferior_ordMed">Seleccione y cargue el archivo. Máximo 5 documentos y que el peso de cada uno sea inferior a 1MB.</span>

                    <h2 class="txt_doc_ordMed">Documento</h2>

                    <div class="section_addFile_ordMed">
                        <input type="" class="cajaTxt_ordMed" name=""  id="">
                        <input class="addFile_ordMed" type="file" class="selecFile_ordMed" id="">
                        <label class="text_addInput">Seleccionar archivo</label>
                        <input class="btnSend_ordMed" type="submit" value="subir">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pop-up cancelar cita -->
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
                    <h1 class="title_cancelar_miCita" id="exampleModalLabel2">¿Está seguro de cancelar cita?</h1>
                </div>

                <!-- Sección botón Pagar -->
                <div class="modal-footer section_cancelar_citas">
                    <!-- Función onclick para mostrar el pop-up de cancelación y ocultar pop-up de opciones la cual esta implementada en admin.js -->
                    <button type="submit" class="btn_cancela-cita" id="" data-toggle="modal" data-target="#exampleModal3" onclick="elementClose(this)" data-position="cancelo">Sí, cancelar cita</button>

                    <button type="submit" class="btn_noCancela-cita" id="">No cancelar</button>
                </div>
            </div>
        </div>
    </div>
@endsection
