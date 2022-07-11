@extends('instituciones.admin.layouts.layout')

@section('contenido')
    <div class="container-fluid panel_container">
        <div class="panel_head">
            <!-- Main title -->
            <div class="mb-4">
                <h1 class="txt_title_panel_head">Procedimientos (CUPS)</h1>
            </div>
            <!-- Toolbar -->
            <div class="row m-0 mb-4">
                <div class="col-md-9 col-lg-10 p-0">
                    <h2 class="txt_subtitle_panel_head px-4 px-md-0 mb-1">
                        Procedimientos CUPS deacuerdo con la Resolución N°.0002238 de 2020 emitida por el 
                        Ministerio de Salud y Protección Social, la cual define la actualización única de 
                        procedimientos en Salud - CUPS.
                    </h2>
                </div>
                <!-- Document action buttons  -->
                <div class="col-md-3 col-lg-2 p-0 justify-content-md-end button__doc_download">
                    <div class="toolt bottom">
                        <button class="file_excel"></button>
                        <span class="tiptext">Exportar excel</span>
                    </div>
                    <div class="toolt bottom">
                        <button class="file_pdf"></button>
                        <span class="tiptext">Exportar PDF</span>
                    </div>
                    <div class="toolt bottom">
                        <button class="file_printer"></button>
                        <span class="tiptext">Imprimir</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="panel_body">
            <div class="row m-0">
                <div class="col-lg-6 p-0">
                    <div class=" card mr-lg-3 mb-4 mb-lg-0">
                        <div class="card-body pt-4 pb-5">
                            <div class="input__box">
                                <label class="txt_inside_panel_body" for="search">Nombre</label>
                                <input type="text" name="search" id="search"
                                class="search" data-description="#description" data-type="cups"/>
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