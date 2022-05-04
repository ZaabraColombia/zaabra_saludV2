@extends('paciente.admin.layouts.layout')

@section('contenido')
    <section class="section">
        <div class="row m-0 p-0" id="basic-table">
            <div class="col-12 col-md-10 col-lg-12 m-auto p-0">
                <div class="section_cabecera_ordMed">
                    <div>
                        <h1 class="title_ordMed">Mis prescripciones/fórmulas</h1>
                        <span class="subtitle_ordMed">Encuentre aquí sus prescripciones y/o fórmulas médicas.</span>
                    </div>
                </div>

                <div class="card container_pres">
                    <div class="card-content">
                        <div class="card-body">
                            <h2 class="titulo_tarjeta_pres">Consulte su fórmula</h2>
                            <span class="subtitulo_tarjeta_pres">Revise la lista de medicamentos, ordenados por el especialista. La fórmula estará visible durante los 5 primeros días.</span>
                            <!-- Table with outer spacing -->
                            <div class="table-responsive">
                                <table class="table table-lg table_ordMed">
                                    <thead>
                                        <tr>
                                            <th>Medicamentos y posología</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Acetaminofen x 500MG (TAB), tomar una tableta cada 6 horas durante 3 días.</td>
                                        </tr>
                                        <tr>
                                            <td>Ibuprofeno x 800MG (TAB), tomar una tableta cada 6 horas durante 3 días.</d>
                                        </tr>
                                        <tr>
                                            <td>Acetaminofen x 500MG (TAB), tomar una tableta cada 6 horas durante 3 días.</d>
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
