@extends('panelAdministrativoProf.panelAdministrativoProfesional')

@section('PanelProf')
        <section class="section">
            <div class="row m-0 p-0" id="basic-table">
                <div class="col-12 p-0">
                    <div class="section_cabecera_citas">
                        <div>
                            <h1 class="title_miCita">Historia clínica</h1>
                            <span class="subtitle_miCita">Administre las historias clínicas de sus pacientes.</span>
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
                                                <th>Documento del paciente</th>
                                                <th>Paciente</th>
                                                <th>Correo electrónico</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1013568142</td>
                                                <td>Juan Hernández</td>
                                                <td>Juan@gmail.com</td>
                                            </tr>
                                            <tr>
                                                <td>80882521</td>
                                                <td>Blanca Bernal</td>
                                                <td>blanca@gmail.com</td>
                                            </tr>
                                            <tr>
                                                <td>1016842563</td>
                                                <td>Laura León</td>
                                                <td>laura@gmail.com</td>
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