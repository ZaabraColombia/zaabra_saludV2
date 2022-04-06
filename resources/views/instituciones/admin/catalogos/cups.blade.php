@extends('instituciones.admin.layouts.layout')

@section('contenido')
    <section class="section mb-3 pr-lg-4">
        <div class="containt_agendaProf">
            <div class="p-0">
                <div class="my-4 my-xl-5">
                    <h1 class="title__xl green_bold">Procedimientos (CUPS)</h1>
                    <p class="text__md black_light">
                        Procedimientos (CUPS) de acuerdo con la Resolución No.0002238 de 2020 emitida por el Ministerio de Salud y Protección Social,
                        la cual define la Actualización única de procedimientos en Salud - CUPS.
                    </p>
                </div>

                <div class="card container_proced">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="input__box">
                                <label for="search"><b>Nombre:</b></label>
                                <input type="text" name="search" id="search"
                                        class="search" placeholder="Buscar cups"
                                        data-description="#description" data-type="cups"/>
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
