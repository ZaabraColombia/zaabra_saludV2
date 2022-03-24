@extends('profesionales.admin.layouts.panel')

@section('contenido')
        <section class="section mb-3 pr-lg-4">
            <div class="containt_agendaProf" id="basic-table">
                <div class="p-0">
                    <div class="my-4 my-xl-5">
                        <h1 class="title__xl blue_bold">Diagnósticos (CIE - 10)</h1>
                        <span class="text__md black_light">Consulte el documento de diagnóstico (CIE - 10).</span>
                    </div>

                    <div class="card container_proced">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="input__box">
                                    <label for="search"><b>Nombre:</b></label>
                                    <input type="text" name="search" id="search"
                                            class="search" placeholder="Buscar Diagnostico"
                                            data-description="#description" data-type="cie10"/>
                                </div>

                                <div class="mt-2">
                                    <label class="fs_text_small font_roboto black_bold"><b>Descripción :</b></label>
                                    <div id="description"></div>
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
