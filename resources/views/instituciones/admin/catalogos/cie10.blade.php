@extends('instituciones.admin.layouts.layout')

@section('contenido')
    <div class="row containt_agendaProf mb-3" id="basic-table">
        <div class="my-4 my-xl-5">
            <h1 class="title__xl green_bold">Diagnósticos (CIE - 10)</h1>
            <p class="text__md black_light">Descargue el documentos de Diagnósticos (CIE - 10.</p>
        </div>

        <div class="col-12 p-0">
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
                                                        class="search form-control" placeholder="Buscar Diagnostico"
                                                        data-description="#description" data-type="cie10"/>
                                                {{-- <div class="input-group-append">         --}}
                                                {{--     <span class="fas fa-search"></span>  --}}
                                                {{-- </div>                                   --}}
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
@endsection

@section('scripts')
    <script src="{{ asset('js/search.js') }}"></script>
@endsection
