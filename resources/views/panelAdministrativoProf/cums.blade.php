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
                                                <td>
                                                    <div class="input-group mb-3">
                                                        <input type="text" name="search" id="search"
                                                               class="search form-control" placeholder="Buscar cums"
                                                               data-description="#description" data-type="cums"/>
                                                        {{--                                                        <div class="input-group-append">--}}
                                                        {{--                                                            <span class="fas fa-search"></span>--}}
                                                        {{--                                                        </div>--}}
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><b>Descripción :</b></td>
                                                <td id="description"></td>
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

@section('scripts')
    <script src="{{ asset('js/search.js') }}"></script>
@endsection
