@extends('instituciones.admin.layouts.layout')

@section('contenido')
    <div class="container-fluid panel_container">
        <div class="panel_head_op2">
            <!-- Main title -->
            <div class="mb-4">
                <h1 class="txt_title_panel_head">Diagnósticos (CIE - 10)</h1>
                <h2 class="txt_subtitle_panel_head">Consulte el documento de diagnóstico (CIE - 10).</h2>
            </div>
            <!-- Toolbar -->
            <div class="row m-0">
                <!-- Document action buttons  -->
                <div class="col-12 p-0 mb-4 justify-content-md-end button__doc_download">
                    <button class="file_excel"></button>
                    <button class="file_pdf"></button>
                    <button class="file_printer"></button>
                </div>
            </div>
        </div>

        <div class="panel_body_op2">
            <div class="row m-0">
                <div class="col-lg-6 p-0">
                    <div class=" card mr-lg-3 mb-4 mb-lg-0">
                        <div class="card-body pt-4 pb-5">
                            <div class="input__box">
                                <label for="search">Nombre</label>
                                <input type="text" name="search" id="search"
                                class="search" data-description="#description" data-type="cie10"/>
                            </div>
                            <!-- Botón inferior -->
                            <div class="col-12 px-2 px-lg-0 mt-3 d-flex justify-content-center justify-content-lg-start">
                                <button type="button" class="button_green py-1" id="btn-finalizar-cita-profesional">Buscar</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 p-0">
                    <div class="card ml-lg-3">
                        <div class="card-body pt-4 pb-5">
                            <div class="input__box">
                                <label for="description">Descripción</label>
                                <div id="description"></div>
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
