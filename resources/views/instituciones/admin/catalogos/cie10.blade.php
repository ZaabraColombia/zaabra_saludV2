@extends('instituciones.admin.layouts.layout')

@section('contenido')
    <div class="container-fluid panel_container">
        <div class="panel_head_op2">
            <!-- Main title -->
            <div class="mb-4">
                <h1 class="txt_title_panel_head">Diagnósticos (CIE - 10)</h1>
            </div>
            <!-- Toolbar -->
            <div class="row m-0">
                <div class="col-md-9 col-lg-10 p-0 mb-4">
                    <h2 class="txt_subtitle_panel_head px-4 px-md-0">
                        Consulte el documento de diagnóstico (CIE - 10).
                    </h2>
                </div>
                <!-- Document action buttons  -->
                <div class="col-md-3 col-lg-2 p-0 mb-4 mb-md-0 justify-content-md-end button__doc_download">
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
                                <label class="txt_inside_panel_body" for="search">Nombre</label>
                                <input type="text" name="search" id="search"
                                class="search" data-description="#description" data-type="cie10"/>
                            </div>
                            <!-- Botón inferior -->
                            <div class="col-12 px-2 px-lg-0 mt-3 d-flex justify-content-center justify-content-lg-start">
                                <button type="button" class="button_green py-1" id="">Buscar</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 p-0">
                    <div class="card ml-lg-3">
                        <div class="card-body pt-4 pb-5">
                            <div class="input__box">
                                <label class="txt_inside_panel_body" for="description">Descripción</label>
                                <div class="txt_inside_panel_body" id="description"></div>
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
