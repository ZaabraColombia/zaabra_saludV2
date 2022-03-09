@extends('profesionales.admin.layouts.panel')

@section('contenido')
        <section class="section mb-3 pr-lg-4">
            <div class="row containt_agendaProf" id="basic-table">
                <div class="col-12 p-0">
                    <div class="my-4 my-xl-5">
                        <h1 class="title__xl blue_bold">Procedimientos (CUPS)</h1>
                        <span class="text__md black_light">Procedimientos (CUPS) de acuerdo con la Resolución No.0002238 de 2020 emitida por el Ministerio de Salud y Protección Social,
                            la cual define la Actualización única de procedimientos en Salud - CUPS.
                        </span>
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
                                                    <div class="input-group">
                                                        <input type="text" name="search" id="search"
                                                               class="search form-control" placeholder="Buscar cups"
                                                               data-description="#description" data-type="cups"/>
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
