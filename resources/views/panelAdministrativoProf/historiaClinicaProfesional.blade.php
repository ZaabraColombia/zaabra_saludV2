@extends('panelAdministrativoProf.panelAdministrativoProfesional')

@section('PanelProf')
        <section class="section">
            <div class="row containt_agendaProf" id="basic-table">
                <div class="content_histClinica">
                    <div class="section_cabecera_histClinica">
                        <div>
                            <h1 class="title_miCita">Historia clínica</h1>
                            <span class="subtitle_miCita">Administre las historias clínicas de sus pacientes.</span>
                        </div>

                        <a type="submit" href="{{route('registroPaciente')}}" class="btn_crear_histClinica"> Crear historia clínica
                            <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flecha_btn_agendar" alt=""> 
                        </a>
                    </div>    

                    <div class="section_input_formula">
                        <label for="example-date-input" class="text_label-formInst mt-0">Búsqueda</label>

                        <div class="section_barraBusqueda" id="barra_busqueda">
                            <input  class="barraBusquedad_histClinica" placeholder="Documento del paciente" id="filtro">
                            
                            <button class="btnBusqueda_histClinica icon_lupa_busqueda"></button>
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
                                                <td>
                                                    <a class="btn_descargar_formula" type="submit" href="{{route('pacienteRegistrado')}}"></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>80882521</td>
                                                <td>Blanca Bernal</td>
                                                <td>blanca@gmail.com</td>
                                                <td>
                                                    <a class="btn_descargar_formula" type="submit" href="{{route('pacienteRegistrado')}}"></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>1016842563</td>
                                                <td>Laura León</td>
                                                <td>laura@gmail.com</td>
                                                <td>
                                                    <a class="btn_descargar_formula" type="submit" href="{{route('pacienteRegistrado')}}"></a>
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