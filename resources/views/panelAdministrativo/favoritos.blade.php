@extends('panelAdministrativo.panelAdministrativo')
@section('Panel')

    <h1 class="titulo_principal_fav">Mis favoritos</h1>
    <p class="subtitulo_principal_fav">Registre sus favoritos y reciba información relacionada con sus intereses.</p>
       
        
    <div class="container_principal_fav">
        <div class="card main_card_fav">
            <div class="card-content">
                <div class="card-body container_table_fav">
                    <h2 class="subtitle_fav icon_especialidad_fav">Especialidades</h2>
                    @csrf
                    @if(!empty($objFavorito))
                        <div class="table_favoritos1 alto_predet" id="tabFav">    
                            @foreach($objFavorito as $objFavorito)
                                <div class="celda_favorito"> {{$objFavorito->nombre_favorito_especialidad}} </div>
                            @endforeach
                        </div>

                        <form id="favorito_especialidad" class="d-none" method="post" action="javascript:void(0)" enctype="multipar/form-data" accept-charset="UTF-8">
                                
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
                    <form id="favorito_especialidad" method="post" action="javascript:void(0)" enctype="multipar/form-data" accept-charset="UTF-8">
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
                    <h2 class="subtitle2_fav icon2_especialidad_fav">Servicios</h2>
                    @csrf
                    @if(!empty($objFavoritoServicio))
                        <div class="table_favoritos1 alto_predetServ" id="tabFav_serv">    
                            @foreach($objFavoritoServicio as $objFavoritoServicio)
                                <div class="celda_favorito"> {{$objFavoritoServicio->nombre_favorito_servicio}} </div>
                            @endforeach
                        </div>

                        <form id="favorito_servicio" class="d-none" method="post" action="javascript:void(0)" enctype="multipar/form-data" accept-charset="UTF-8">
                                    
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
                        <form id="favorito_servicio" method="post" action="javascript:void(0)" enctype="multipar/form-data" accept-charset="UTF-8">
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

        <!-- <div class="card main_card_fav">
            <div class="card-content">
                <div class="card-body container_table_fav">
                    <h2 class="subtitle2_fav icon2_especialidad_fav">Servicios</h2>
                    <div class="table-responsive section_tableCitas">    
                        <table class="table table_favoritos">
                            <tbody>
                                <tr>
                                    <td>Rayos X</td>
                                    <td>Inyectología</td>
                                    <td>Muestra de orina</td>
                                </tr>
                                <tr>
                                    <td>Muestra de sangre</td>
                                    <td>Vacunación</td>
                                    <td>Oncología</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="section_verAdd_fav">
                        <button class="btn_agregar_fav icono_agragar_fav">Agregar más</button>
                        <button class="text_vermas_fav">Ver más</button>
                    </div>
                </div>
            </div>
        </div> -->
    </div>


    
@endsection