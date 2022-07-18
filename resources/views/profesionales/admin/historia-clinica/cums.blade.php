@extends('profesionales.admin.layouts.panel')

@section('contenido')
    <div class="container-fluid panel_container">
        <!-- panel head -->
        <div class="panel_head m-md-0 mb-lg-3">
            <!-- Title -->
            <h1 class="title blue_two mb-3 mb-md-0 mb-lg-3">Procedimientos (CUMS)</h1>
            <!-- Toolbar -->
            <div class="row m-0">
                <!-- Subtitle -->
                <div class="col-md-9 col-lg-10 p-0 mb-4 mb-md-0 d-md-flex align-items-md-center align-items-lg-baseline">
                    <h2 class="text-center text-lg-left h2_fs20_bold black_">
                        Identifica el Código Único Nacional de Medicamentos alfanumérica asignada a los medicamentos por el 
                        Instituto Nacional de Vigilancia de Medicamentos y Alimentos Invima.
                    </h2>
                </div>
                <!-- Document action buttons  -->
                <div class="col-md-3 ml-md-auto col-lg-2 col-lg-auto p-0 justify-content-md-end btns__export_doc">
                    <div class="toolTip bottom">
                        <button class="file_excel"></button>
                        <span class="toolText">Exportar Excel</span>
                    </div>
                    <div class="toolTip bottom">
                        <button class="file_pdf"></button>
                        <span class="toolText">Exportar PDF</span>
                    </div>
                    <div class="toolTip bottom">
                        <button class="file_printer"></button>
                        <span class="toolText">Imprimir</span>
                    </div>
                </div>
            </div>
        </div>
        <!-- panel body -->
        <div class="panel_body pt-3">
            <div class="row m-0">
                <div class="col-lg-6 p-0 mb-5 mb-md-4 mb-lg-0">
                    <div class="card__mod px-0 px-md-2 mr-lg-4">
                        <div class="card-body pt-4 p-3 px-md-5 pb-md-4 px-lg-4 pb-lg-5">
                            <div class="mb-3">
                                <label class="label_fs20_bold black_bold" for="search">Nombre</label>
                                <input class="search input__text" type="text" name="search" id="search"
                                data-description="#description" data-type="cums"/>
                            </div>
                            <!-- Botón inferior -->
                            <div class="col-12 btn__down_search justify-content-lg-start px-lg-0">
                                <button class="bg_blue_two" type="button" id="">Buscar</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 p-0 mt-md-3 mt-lg-0">
                    <div class="card px-md-2 py-lg-2">
                        <div class="card-body py-5 px-md-5 pt-lg-4 px-lg-4">
                            <div class="">
                                <label class="label_fs20_bold black_bold" for="description">Descripción</label>
                                <div class="mt-3 mb-0 label_fs20_bold black_bold" id="description"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/search.js') }}"></script>
@endsection
