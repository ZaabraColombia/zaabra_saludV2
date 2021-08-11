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
                                
                            <div class="form-group" id="listas">
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
                            
                            <div class="form-group" id="listas">
                                <input class="input_espFav" placeholder="Especialidad favorita" type="text" name="nombre_favorito_especialidad" id="nombre_favorito_especialidad"  value="">
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








    <!-- Pop-up  editar cita -->
    <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal_citas_popUp" role="document">
            <div class="modal-content content_modalCitas">
                <!-- Sección boton derecho de cierre "X" -->
                <div class="modal-header modal_headerCitas">
                    <h1 class="title_popup_miCita" id="exampleModalLabel">Favoritos especialidades</h1>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body modal_headerCitas">
                    <form id="favorito_especialidad" method="post" action="javascript:void(0)" enctype="multipar/form-data" accept-charset="UTF-8">
                        <div class="alert alert-success d-none" id="msg_info">
                            <span id="message_info">Su información se guardó correctamente</span>
                        </div>
                            <div class="col-md-6 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Seleccione especialidad </label>

                                <input type="text" data-role="tagsinput" name="nombre_favorito_especialidad" id="nombre_favorito_especialidad" class="col-lg-12 form-control">
                            </div>

                            <div class="modal-footer section_btn_citas">
                                <button type="submit" class="btnAgendar-popup" id="guardar_data">Guardar</button>

                                <!-- <button type="submit" class="btnCancelar-popup" id="">Cancelar</button> -->
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection