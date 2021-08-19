@extends('panelAdministrativoProf.panelAdministrativoProfesional')

@section('PanelProf')
        <section class="section">
            <div class="row m-0 p-0" id="basic-table">
                <div class="col-12 p-0">
                    <div class="section_cabecera_citas">
                        <div>
                            <h1 class="title_miCita">Prescripciones/fórmulas médicas</h1>
                            <span class="subtitle_miCita">Administre las fórmulas médicas de sus pacientes.</span>
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
                                            </tr>
                                            <tr>
                                                <td>00124</td>
                                                <td>Blanca Bernal</td>
                                                <td>Traumatología</td>
                                            </tr>
                                            <tr>
                                                <td>00125</td>
                                                <td>Laura León</td>
                                                <td>Traumatología</td>
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