@extends('profesionales.admin.layouts.panel')

@section('contenido')


    <div class="row containt_agendaProf" id="basic-table">

            <div class="section_cabecera_citas">
                <div>
                    <h1 class="title_miCita">Mis favoritos Profesional</h1>
                    <p class="subtitle_miCita">Registre sus favoritos y reciba información relacionada con sus intereses.</p>
                </div>
            </div>

            <div class="container_principal_fav">
                <div class="card main_card_fav">
                    <div class="card-content">
                        <div class="card-body container_table_fav">
                            <h2 class="subtitle_fav icon_especialidad_favProf">Especialidades</h2>
                            @csrf
                            @if(!empty($objFavorito))
                                <div class="section_favoritos_fav alto_predet" id="tabFav">
                                    @foreach($objFavorito as $objFavorito)
                                        <div class="celda_favorito"> {{$objFavorito->nombre_favorito_especialidad}} </div>
                                    @endforeach
                                </div>

                                <form id="favorito_especialidad" class="d-none" method="post" action="{{ route('profesional.favoritos.guardar_especialidades') }}"
                                      enctype="multipar/form-data" accept-charset="UTF-8">

                                    <div class="form-group mt-3" id="listas">
                                        <input class="input_espFav"  placeholder="Especialidad favorita" type="text" name="nombre_favorito_especialidad" id="nombre_favorito_especialidad"  value="">
                                    </div>

                                    <div class="section_btn_fav">
                                        <button type="submit" class="btn_guardar_fav" id="guardar_data">Guardar</button>
                                    </div>
                                </form>

                                <div class="section_verAdd_fav">
                                    <input class="btn_agregar_fav icono_agragar_fav" type="button" id="btnagregar" value="Agregar más">
                                    <button class="text_vermas_fav" onclick="registerShow(this)" id="vermas" data-position="mas">Ver más</button>
                                    <button class="text_vermas_fav d-none" onclick="registerShow(this)" id="vermenos" data-posiotion="menos">Ver menos</button>
                                </div>
                            @else
                            <form id="favorito_especialidad" method="post" action="{{ route('profesional.favoritos.guardar_especialidades') }}"
                                  enctype="multipar/form-data" accept-charset="UTF-8">
                                <div class="table-responsive section_tableCitas">
                                    <label for="example-date-input" class="text_label-formInst"> Ingrese especialidad </label>

                                    <div class="">
                                        <input class="form-group input_espFav" placeholder="Especialidad favorita" type="text" name="nombre_favorito_especialidad" id="nombre_favorito_especialidad"  value="">
                                    </div>
                                </div>

                                <div class="section_btn_fav">
                                    <button type="submit" class="btn_guardar_fav" id="guardar_data">Guardar</button>
                                </div>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="card main_card_favServ">
                    <div class="card-content">
                        <div class="card-body container_table_fav">
                            <h2 class="subtitle_serv_fav icon_servicio_favProf">Servicios</h2>
                            @csrf
                            @if(!empty($objFavoritoServicio))
                                <div class="section_favoritos_fav alto_predet" id="tabFav_serv">
                                    @foreach($objFavoritoServicio as $objFavoritoServicio)
                                        <div class="celda_favorito"> {{$objFavoritoServicio->nombre_favorito_servicio}} </div>
                                    @endforeach
                                </div>

                                <form id="favorito_servicio" class="d-none" method="post" action="{{ route('profesional.favoritos.guardar_servicios') }}"
                                      enctype="multipar/form-data" accept-charset="UTF-8">

                                    <div class="form-group mt-3">
                                        <input class="input_espFav"  placeholder="Especialidad favorita" type="text" name="nombre_favorito_servicio" id="nombre_favorito_servicio"  value="">
                                    </div>

                                    <div class="section_btn_fav">
                                        <button type="submit" class="btn_guardar_fav" id="guardar_data2">Guardar</button>
                                    </div>
                                </form>

                                <div class="section_verAdd_fav">
                                    <input class="btn_agregar_fav icono_agragar_fav" type="button" id="btnagregar_serv" value="Agregar más">
                                    <button class="text_vermas_fav" onclick="registerShow(this)" id="vermas_serv" data-position="mas_serv">Ver más</button>
                                    <button class="text_vermas_fav d-none" onclick="registerShow(this)" id="vermenos_serv" data-position="menos_serv">Ver menos</button>
                                </div>
                            @else
                                <form id="favorito_servicio" method="post" action="{{ route('profesional.favoritos.guardar_servicios') }}"
                                      enctype="multipar/form-data" accept-charset="UTF-8">
                                    <div class="table-responsive section_tableCitas">
                                        <label for="example-date-input" class="text_label-formInst"> Ingrese servicio </label>

                                        <div class="" id="">
                                            <input class="form-group input_espFav" placeholder="Especialidad favorita" type="text" name="nombre_favorito_servicio" id="nombre_favorito_servicio"  value="">
                                        </div>
                                    </div>

                                    <div class="section_btn_fav">
                                        <button type="submit" class="btn_guardar_fav" id="guardar_data2">Guardar</button>
                                    </div>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="card main_card_favServ mt-3">
                    <div class="card-content">
                        <div class="card-body container_table_fav">
                            <h2 class="subtitle_espec_fav icon_especialista_favProf">Especialista</h2>
                            @csrf
                            @if(!empty($objFavoritoEspec))
                                <div class="section_favoritos_fav alto_predet" id="tabFav_espec">
                                    @foreach($objFavoritoEspec as $objFavoritoEspec)
                                        <div class="celda_favorito"> {{$objFavoritoEspec->nombre_favorito_especialista}} </div>
                                    @endforeach
                                </div>

                                <form id="favorito_especialista" class="d-none" method="post" action="{{ route('profesional.favoritos.guardar_profesional') }}"
                                      enctype="multipar/form-data" accept-charset="UTF-8">

                                    <div class="form-group mt-3">
                                        <input class="input_espFav"  placeholder="Especialidad favorita" type="text" name="nombre_favorito_especialista" id="nombre_favorito_especialista"  value="">
                                    </div>

                                    <div class="section_btn_fav">
                                        <button type="submit" class="btn_guardar_fav" id="guardar_data3">Guardar</button>
                                    </div>
                                </form>

                                <div class="section_verAdd_fav">
                                    <input class="btn_agregar_fav icono_agragar_fav" type="button" id="btnagregar_espec" value="Agregar más">
                                    <button class="text_vermas_fav" onclick="registerShow(this)" id="vermas_espec" data-position="mas_espec">Ver más</button>
                                    <button class="text_vermas_fav d-none" onclick="registerShow(this)" id="vermenos_espec" data-position="menos_espec">Ver menos</button>
                                </div>
                            @else
                                <form id="favorito_especialista" method="post" action="{{ route('profesional.favoritos.guardar_profesional') }}" enctype="multipar/form-data" accept-charset="UTF-8">
                                    <div class="table-responsive section_tableCitas">
                                        <label for="example-date-input" class="text_label-formInst"> Ingrese servicio </label>

                                        <div class="" id="">
                                            <input class="form-group input_espFav" placeholder="Especialidad favorita" type="text" name="nombre_favorito_especialista" id="nombre_favorito_especialista"  value="">
                                        </div>
                                    </div>

                                    <div class="section_btn_fav">
                                        <button type="submit" class="btn_guardar_fav" id="guardar_data3">Guardar</button>
                                    </div>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="card main_card_favServ mt-3">
                    <div class="card-content">
                        <div class="card-body container_table_fav">
                            <h2 class="subtitle_inst_fav icon_institucion_favProf">Instituciones</h2>
                            @csrf
                            @if(!empty($objFavoritoInst))
                                <div class="section_favoritos_fav alto_predet" id="tabFav_inst">
                                    @foreach($objFavoritoInst as $objFavoritoInst)
                                        <div class="celda_favorito"> {{$objFavoritoInst->nombre_favorito_institucion}} </div>
                                    @endforeach
                                </div>

                                <form id="favorito_institucion" class="d-none" method="post" action="{{ route('profesional.favoritos.guardar_instituciones') }}"
                                      enctype="multipar/form-data" accept-charset="UTF-8">

                                    <div class="form-group mt-3">
                                        <input class="input_espFav"  placeholder="Especialidad favorita" type="text" name="nombre_favorito_institucion" id="nombre_favorito_institucion"  value="">
                                    </div>

                                    <div class="section_btn_fav">
                                        <button type="submit" class="btn_guardar_fav" id="guardar_data4">Guardar</button>
                                    </div>
                                </form>

                                <div class="section_verAdd_fav">
                                    <input class="btn_agregar_fav icono_agragar_fav" type="button" id="btnagregar_inst" value="Agregar más">
                                    <button class="text_vermas_fav" onclick="registerShow(this)" id="vermas_inst" data-position="mas_inst">Ver más</button>
                                    <button class="text_vermas_fav d-none" onclick="registerShow(this)" id="vermenos_inst" data-position="menos_inst">Ver menos</button>
                                </div>
                            @else
                                <form id="favorito_institucion" method="post" action="{{ route('profesional.favoritos.guardar_instituciones') }}"
                                      enctype="multipar/form-data" accept-charset="UTF-8">
                                    <div class="table-responsive section_tableCitas">
                                        <label for="example-date-input" class="text_label-formInst"> Ingrese servicio </label>

                                        <div class="" id="">
                                            <input class="form-group input_espFav" placeholder="Especialidad favorita" type="text" name="nombre_favorito_institucion" id="nombre_favorito_institucion"  value="">
                                        </div>
                                    </div>

                                    <div class="section_btn_fav">
                                        <button type="submit" class="btn_guardar_fav" id="guardar_data4">Guardar</button>
                                    </div>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

    </div>


@endsection

@section('scripts')
    <script src="{{ asset('js/favorito.js') }}"></script>
@endsection
