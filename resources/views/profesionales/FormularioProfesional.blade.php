@extends('layouts.app')

@section('content')

    <!--     Sección lista de opciones     -->
    <ol  class="lista_opciones-usuario-formProf">
        <div class="content_icons-formProf"> <!-- clase "content_icons-formProf" para evento ocultar y mostrar contenido de la opción. Ubicado en el archivo formularios.js -->
            <li class="iconAzul_datoPersonal dato-personal" onclick="containtHideOption(this)" data-position="personalData">
                <p class="text_opcion-formProfesional" > Datos personales </p>
            </li>
        </div>

        <div class="content_icons-formProf">
            <li class="iconGris_perfProf perfil-profesional" onclick="containtHideOption(this)" data-position="professionalProfile">
                <p class="text_opcion-formProfesional" > Perfil profesional </p>
            </li>
        </div>

        <div class="content_icons-formProf">
            <li class="iconGris_trataProced tratamiento-procedimiento" onclick="containtHideOption(this)" data-position="treatmentsProcedures">
                <p class="text_opcion-formProfesional" > Tratamientos y procedimientos </p>
            </li>
        </div>

        <div class="content_icons-formProf">
            <li class="iconGris_premioRecon premio-reconocimiento" onclick="containtHideOption(this)" data-position="AwardsHonours">
                <p class="text_opcion-formProfesional" > Premios y reconocimientos </p>
            </li>
        </div>

        <div class="content_icons-formProf">
            <li class="iconGris_public publicacion" onclick="containtHideOption(this)" data-position="publicationsFormProf">
                <p class="text_opcion-formProfesional" > Publicaciones </p>
            </li>
        </div>

        <div class="content_icons-formProf">
            <li class="iconGris_galeriaVideo galeria-video" onclick="containtHideOption(this)" data-position="galleryFormProf">
                <p class="text_opcion-formProfesional" > Galería </p>
            </li>
        </div>
    </ol> 

    <!-- 1* Contenedor principal de la tarjeta DATOS PERSONALES -->
    <div class="container-fluid personal_data content_principal-formProf">
        <!-- Titulo y texto superior -->
        <div class="col-lg-10 col-xl-8 content_textPrincipal-formProf">
            <h5 class="titulo_principal-formProf"> LE DAMOS LA BIENVENIDA A ZAABRA SALUD </h5>

            <p class="texto_superior-formProf"> Ingrese los datos según corresponda y finalice el proceso completamente en línea. </p>
        </div>

        <!--------------------------------------------      Inicio 1 primera parte del formulario *** INFORMACIÓN BÁSICA ***      --------------------------------------------->
        <div class="col-lg-10 col-xl-8 content_dato-person infoBasica_formProf">
            <h5 class="col-12 icon_infoBasica-formProf"> Información básica </h5> 

            <form method="POST" action="{{ url ('/FormularioProfesionalSave') }}" enctype="multipart/form-data" accept-charset="UTF-8">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"> 

                <!---------------valida que ya exista informacion y la muestra en caso contrario muestra un formulario vacio---------------------> 
                @if(!empty($objFormulario))
                    <div class="row fila_infoBasica-formProf">
                        <!-- Sección imagen de usuario --> 
                        <div class="col-md-3 contain_imgUsuario-formProf">
                            @foreach($objFormulario as $objFormulario)
                                <img id="imagenPrevisualizacion" class="img_usuario-formProf" src="{{URL::asset($objFormulario->imglogoempresa)}}">
                            @endforeach
            
                            <input type="file" class="input_imgUsuario-formProf" name="logo"  id="seleccionArchivos" accept="image/png, image/jpeg">

                            <label class="col-12 icon_subirFoto-formProf text_usuario-formProf"> Subir foto de perfil </label>
                        </div>
                        
                        <!-- Sección datos personales -->
                        <div class="row col-md-9 datos_principales-formProf">
                            @foreach ($objuser as $objuser)
                            <div class="col-lg-6 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Nombres </label>

                                
                                <div class="col-12 nombres_usuario-formProf">
                                    <input class="input_nomApl-formProf" value="{{$objuser->primernombre}}" readonly></input>

                                    <input class="input_nomApl-formProf" value="{{$objuser->segundonombre}}" readonly></input>
                                </div>
                            </div>

                            <div class="col-lg-6 section_inputRight-text-formProf">
                                <label for="example-date-input"class="col-12 text_label-formProf"> Apellidos </label>

                                <div class="col-12 nombres_usuario-formProf">
                                    <input class="input_nomApl-formProf" value="{{$objuser->primerapellido}}" readonly></input>

                                    <input class="input_nomApl-formProf" value="{{$objuser->segundoapellido}}" readonly></input>
                                </div>
                            </div>
                            @endforeach

                            <div class="col-md-6 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha de nacimiento </label>

                                <input class="col-lg-12 form-control" type="date" value="{{$objFormulario->fechanacimiento}}" id="example-date-input" name="fechanacimiento">
                            </div>
                

                            <div class="col-md-6 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Selecione área </label> 

                                <select id="idarea" name="idarea" class="col-lg-12 form-control">
                                    <option value="" selected disabled>Seleccione área</option>

                                    @foreach($area as $area)
                                        <option value="{{$area->idArea}}"> {{$area->nombreArea}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Selecione profesión </label>

                                <select name="idprofesion" id="idprofesion" class="col-lg-12 form-control"></select>
                            </div>

                            <div class="col-md-6 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Seleccione especialidad </label>

                                <select name="idespecialidad" id="idespecialidad" class="col-lg-12 form-control"></select>
                            </div>
                    
                            <div class="col-md-6 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Selecione universidad </label>

                                <select  class="col-lg-12 form-control" name="id_universidad">
                                    @foreach($objFormulario1 as $objFormulario1)
                                        <option value="{{$objFormulario1->id_universidad}}">{{$objFormulario1->nombreuniversidad}}</option>
                                    @endforeach

                                    @foreach($universidades as $universidades1)
                                        <option value="{{$universidades1->id_universidad}}"> {{$universidades1->nombreuniversidad}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Tarjeta profesional </label>

                                    <input class="col-lg-12 form-control" id="tarjeta" placeholder="N. Tarjeta" type="number" name="numeroTarjeta" value="{{$objFormulario->numeroTarjeta}}">
                                </div>
                            </div>

                            <div class="col-md-3 content_btnEnviar-formProf">
                                <button type="submit" class="btn_enviar-formProf"> Guardar
                                    <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flecha_guardar-formProf" alt=""> 
                                </button>
                            </div>
                        </div>
                    </div>
                    <!------------------ Fin campos llenos ---------------------> 

                    <!--------------- Inicio campos vacios--------------------->    
                @else
                    <div class="row fila_infoBasica-formProf">
                        <!-- Sección imagen de usuario --> 
                        <div class="col-md-3 contain_imgUsuario-formProf">   
                            <img class="img_usuario-formProf" id="imagenPrevisualizacion">

                            <input class="input_imgUsuario-formProf" type="file" name="logo"  id="seleccionArchivos" accept="image/png, image/jpeg">

                            <label class="col-12 icon_subirFoto-formProf text_usuario-formProf"> Subir foto de perfil </label>
                        </div>
                
                        <!-- Sección datos personales -->
                        <div class="row col-md-9 datos_principales-formProf">
                            @foreach ($objuser as $objuser)
                                <div class="col-lg-6 section_inputRight-text-formProf">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Nombres </label>

                                    <div class="col-12 nombres_usuario-formProf">
                                        <input class="input_nomApl-formProf" value="{{$objuser->primernombre}}" readonly></input>

                                        <input class="input_nomApl-formProf" value="{{$objuser->segundonombre}}" readonly></input>
                                    </div>
                                </div>

                                <div class="col-lg-6 section_inputRight-text-formProf">
                                    <label for="example-date-input" class="col-lg-12 text_label-formProf"> Apellidos </label>

                                    <div class="col-12 nombres_usuario-formProf">
                                        <input class="input_nomApl-formProf" value="{{$objuser->primerapellido}}" readonly></input>

                                        <input class="input_nomApl-formProf" value="{{$objuser->segundoapellido}}" readonly></input>
                                    </div>
                                </div>
                            @endforeach
            
                            <div class="col-md-6 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf">  Fecha de nacimiento </label>
                                
                                <input class="col-lg-12 form-control" type="date" value="2011-08-19" id="example-date-input" name="fechanacimiento">
                            </div>

                            <div class="col-md-6 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Selecione área </label> 

                                <select id="idarea" name="idarea" class="col-lg-12 form-control">
                                    <option value="" selected disabled> Seleccione area</option>

                                    @foreach($area as $area)
                                        <option value="{{$area->idArea}}"> {{$area->nombreArea}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Selecione profesión </label> 

                                <select name="idprofesion" id="idprofesion" class="col-lg-12 form-control"></select>
                            </div>

                            <div class="col-md-6 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Seleccione especialidad </label>

                                <select name="idespecialidad" id="idespecialidad" class="col-lg-12 form-control"></select>
                            </div>
                        
                            <div class="col-md-6 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Selecione universidad </label>

                                    <select  class="col-lg-12 form-control" name="id_universidad">
                                        <option value="">Seleccione Universidad</option>

                                        @foreach($universidades as $universidades2)
                                            <option value="{{$universidades2->id_universidad}}"> {{$universidades2->nombreuniversidad}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-6 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Tarjeta profesional </label>

                                    <input class="col-lg-12 form-control" id="tarjeta" placeholder="nombre" type="number" name="numeroTarjeta">
                                </div>
                            </div>

                            <div class="col-md-3 content_btnEnviar-formProf">
                                <button type="submit" class="btn_enviar-formProf"> Guaradar
                                    <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flecha_guardar-formProf" alt=""> 
                                </button>
                            </div>
                        </div>
                    </div>
                @endif
                <!--------------- Fin campos vacios--------------------->  
            </form>
        </div>
        <!--------------------------------------------      Fin 1 primera parte del formulario *** INFORMACIÓN BÁSICA ***      ------------------------------------------------>

        <!--------------------------------------------      Inicio 2 segunda parte del formulario *** INFORMACIÓN CONTACTO ***      ------------------------------------------->
        <div class="col-lg-10 col-xl-8 content_dato-person infoBasica_formProf">
            <form method="POST" action="{{ url ('/FormularioProfesionalSave2') }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"> 

                <h5 class="col-12 icon_infoContac-formProf"> Información de contacto </h5>

                <div class="row fila_infoBasica-formProf">
                    @if(!empty($objFormulario))
                        <div class="col-md-6 section_inputLeft-text-formProf">
                            <div class="form-group">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Celular </label>

                                <input class="col-12 form-control" id="tarjeta" placeholder="N. Celular" type="number" name="celular" value="{{$objFormulario->celular}}">
                            </div>
                        </div>

                        <div class="col-md-6 section_inputRight-text-formProf">
                            <div class="form-group">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Teléfono </label>

                                <input class="col-12 form-control" id="telefono" placeholder="N. Telefono" type="number" name="telefono" value="{{$objFormulario->telefono}}">
                            </div>
                        </div>
                        
                        <div class="col-md-6 section_inputLeft-text-formProf">
                            <div class="form-group">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Dirección </label>
                                
                                <input class="col-12 form-control" id="direccion" placeholder="N. direccion" type="text" name="direccion" value="{{$objFormulario->direccion}}">
                            </div>
                        </div>

                        <!--menu dinamico ciudades -->
                        <div class="col-md-6 section_inputRight-text-formProf">
                            <label for="example-date-input" class="col-12 text_label-formProf"> Selecione país </label>

                            <select id="idpais" name="idpais" class="col-12 form-control">
                                <option value="" selected disabled>Seleccione país</option>

                                @foreach($pais as $pais)
                                    <option value="{{$pais->id_pais}}"> {{$pais->nombre}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 section_inputLeft-text-formProf">
                            <label for="example-date-input" class="col-12 text_label-formProf"> Selecione departamento </label>

                            <select name="id_departamento" id="id_departamento" class="col-12 form-control"></select>
                        </div>
                    
                        <div class="col-md-6 section_inputRight-text-formProf">
                            <label for="example-date-input" class="col-12 text_label-formProf"> Seleccione provincia </label>

                            <select name="id_provincia" id="id_provincia" class="col-12 form-control"></select>
                        </div>

                        <div class="col-md-6 section_inputLeft-text-formProf">
                            <label for="example-date-input" class="col-12 text_label-formProf"> Seleccione ciudad </label>

                            <select name="id_municipio" id="id_municipio" class="col-12 form-control"></select>
                        </div>

                        <!-- Botón guardar información -->
                        <div class="col-12 mt-3 content_btnEnviar-formProf">
                            <button type="submit" class="btn2_enviar-formProf"> Guardar
                                <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flecha_guardar-formProf" alt=""> 
                            </button>
                        </div>
                        
                    @else
                        <div class="col-md-6 section_inputLeft-text-formProf">
                            <div class="form-group">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Celular </label>
                                
                                <input class="col-12 form-control" id="tarjeta" placeholder="N. Celular" type="number" name="celular" >
                            </div>
                        </div>

                        <div class="col-md-6 section_inputRight-text-formProf">
                            <div class="form-group">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Teléfono </label>

                                <input class="col-12 form-control" id="telefono" placeholder="N. Telefono" type="number" name="telefono" >
                            </div>
                        </div>

                        <div class="col-md-6 section_inputLeft-text-formProf">
                            <div class="form-group">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Dirección </label>

                                <input class="col-12 form-control" id="direccion" placeholder="N. direccion" type="text" name="direccion" >
                            </div>
                        </div>

                        <!--menu dinamico ciudades -->
                        <div class="col-md-6 section_inputRight-text-formProf">
                            <label for="example-date-input" class="col-12 text_label-formProf"> Seleccione país </label>

                            <select id="idpais" name="idpais" class="form-control">
                                <option value="" selected disabled> Seleccione país </option>

                                @foreach($pais as $pais)
                                    <option value="{{$pais->id_pais}}"> {{$pais->nombre}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 section_inputLeft-text-formProf">
                            <label for="example-date-input" class="col-12 text_label-formProf"> Selecione departamento </label>

                            <select name="id_departamento" id="id_departamento" class="form-control"></select>
                        </div>
                
                        <div class="col-md-6 section_inputRight-text-formProf">
                            <label for="example-date-input" class="col-12 text_label-formProf"> Seleccione provincia </label>
                            <select name="id_provincia" id="id_provincia" class="form-control"></select>
                        </div>

                        <div class="col-md-6 section_inputLeft-text-formProf">
                            <label for="example-date-input" class="col-12 text_label-formProf"> Seleccione ciudad </label>

                            <select name="id_municipio" id="id_municipio" class="form-control"></select>
                        </div>

                        <!-- Botón guardar información -->
                        <div class="col-12 mt-3 content_btnEnviar-formProf">
                            <button type="submit" class="btn2_enviar-formProf"> Guardar
                                <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flecha_guardar-formProf" alt=""> 
                            </button>
                        </div>
                    @endif
                </div>
            </form>
        </div>
        <!--------------------------------------------      Fin 2 segunda parte del formulario *** INFORMACIÓN CONTACTO ***      ---------------------------------------------->

        <!--------------------------------------------      Inicio 3 tercera parte del formulario *** INFORMACIÓN CONSULTA ***      ------------------------------------------->
        <div class="col-lg-10 col-xl-8 pb-3 content_dato-person infoBasica_formProf">
            <h5 class="col-12 icon_infoConsult-formProf"> Información consulta </h5>

            @foreach($objConsultas as $objConsultas)
                @if(!empty($objConsultas->nombreconsulta))
                    <div class="col-md-6">
                        <span> {{$objConsultas->nombreconsulta}} </span>

                        <span> {{$objConsultas->valorconsulta}} </span>
                        
                        <a href="{{url('/FormularioProfesionaldelete3/'.$objConsultas->id)}}">
                            <button type="submit" class="close" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </a>
                    </div>
                @endif
            @endforeach

            <form method="POST" action="{{ url ('/FormularioProfesionalSave3') }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
                    
                @if($objContadorConsultas->cantidad == 0)
                    <div class="col-12 seccion_consulta-formProf">
                        <div class="col-md-6 section_inputLeft-text-formProf">
                            <label for="example-date-input" class="col-12 text_label-formProf"> Tipo consulta </label>

                            <select id="inputState" class="form-control" name="nombreconsulta[]">
                                <option value=" " selected> Seleccionar </option>
                                <option value="Presencial"> Presencial </option>
                                <option value="Virtual"> Virtual </option>
                                <option value="Control médico"> Control Médico </option>
                            </select>
                        </div>

                        <div class="col-md-6 section_inputRight-text-formProf">
                            <label for="example-date-input" class="col-12 text_label-formProf"> Valor </label>
                                
                            <input type="number" min="0.00" max="10000.00" step="0.01" class="form-control" name="valorconsulta[]">
                        </div>
                    </div>

                    <div class="col-12 seccion_consulta-formProf hidden-section-formProf">
                        <div class="col-md-6 section_inputLeft-text-formProf">
                            <label for="example-date-input" class="col-12 text_label-formProf"> Tipo consulta </label>

                            <select id="inputState" class="form-control" name="nombreconsulta[]">
                                <option value=" " selected> Seleccionar </option>
                                <option value="Presencial"> Presencial </option>
                                <option value="Virtual"> Virtual </option>
                                <option value="Control médico"> Control Médico </option>
                            </select>
                        </div>

                        <div class="col-md-6 section_inputRight-text-formProf">
                            <label for="example-date-input" class="col-12 text_label-formProf"> Valor </label> 

                            <input type="number" min="0.00" max="10000.00" step="0.01" class="form-control" name="valorconsulta[]">
                        </div>
                    </div>

                    <div class="col-12 seccion_consulta-formProf hidden-section-formProf">
                        <div class="col-md-6 section_inputLeft-text-formProf">
                            <label for="example-date-input" class="col-12 text_label-formProf"> Tipo consulta </label>

                            <select id="inputState" class="form-control" name="nombreconsulta[]">
                                <option value=" " selected> Seleccionar </option>
                                <option value="Presencial"> Presencial </option>
                                <option value="Virtual"> Virtual</option>
                                <option value="Control médico"> Control Médico </option>
                            </select>
                        </div>

                        <div class="col-md-6 section_inputRight-text-formProf">
                            <label for="example-date-input" class="col-12 text_label-formProf"> Valor </label>

                            <input type="number" min="0.00" max="10000.00" step="0.01" class="form-control" name="valorconsulta[]">
                        </div>
                    </div>
                @elseif($objContadorConsultas->cantidad == 1)
                    <div class="col-12 seccion_consulta-formProf">
                        <div class="col-md-6 section_inputLeft-text-formProf">
                            <label for="example-date-input" class="col-12 text_label-formProf"> Tipo consulta </label> 

                            <select id="inputState" class="form-control" name="nombreconsulta[]">
                                <option value=" " selected> Seleccionar </option>
                                <option value="Presencial"> Presencial </option>
                                <option value="Virtual"> Virtual </option> 
                                <option value="Control médico"> Control Médico </option>
                            </select>
                        </div>

                        <div class="col-md-6 section_inputRight-text-formProf">
                            <label for="example-date-input" class="col-12 text_label-formProf"> Valor </label>

                            <input type="number" min="0.00" max="10000.00" step="0.01" class="form-control" name="valorconsulta[]">
                        </div>
                    </div>

                    <div class="col-12 seccion_consulta-formProf hidden-section-formProf">
                        <div class="col-md-6 section_inputLeft-text-formProf">
                            <label for="example-date-input" class="col-12 text_label-formProf"> Tipo consulta </label> 

                            <select id="inputState" class="form-control" name="nombreconsulta[]">
                                <option value=" " selected> Seleccionar </option>
                                <option value="Presencial"> Presencial </option>
                                <option value="Virtual"> Virtual </option>
                                <option value="Control médico"> Control Médico </option>
                            </select>
                        </div>

                        <div class="col-md-6 section_inputRight-text-formProf">
                            <label for="example-date-input" class="col-12 text_label-formProf"> Valor </label>

                            <input type="number" min="0.00" max="10000.00" step="0.01" class="form-control" name="valorconsulta[]">
                        </div>
                    </div>

                @elseif($objContadorConsultas->cantidad == 2)
                    <div class="col-12 seccion_consulta-formProf">
                        <div class="col-md-6 section_inputLeft-text-formProf">
                            <label for="example-date-input" class="col-12 text_label-formProf"> Tipo consulta </label>

                            <select id="inputState" class="form-control" name="nombreconsulta[]">
                                <option value=" " selected> Seleccionar </option>
                                <option value="Presencial"> Presencial </option>
                                <option value="Virtual"> Virtual </option>
                                <option value="Control médico"> Control Médico </option>
                            </select>
                        </div>

                        <div class="col-md-6 section_inputRight-text-formProf">
                            <label for="example-date-input" class="col-12 text_label-formProf"> Valor </label>

                            <input type="number" min="0.00" max="10000.00" step="0.01" class="form-control" name="valorconsulta[]">
                        </div>
                    </div>
                @elseif($objContadorConsultas->cantidad == 3)
                    <span> No se puede agragar más </span>
                @endif

                <div class="col-12 content_btnEnviar-formProf">
                    <button type="submit" class="btn2_enviar-formProf"> Guardar
                        <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flecha_guardar-formProf" alt=""> 
                    </button>
                </div>
            </form>
        </div>
        <!--------------------------------------------      Fin 3 tercera parte del formulario *** INFORMACIÓN CONSULTA ***      ----------------------------------------------> 

        <!-- Secciones de los botones anterior y siguiente -->
        <div class="col-lg-10 col-xl-8 content_botonInferior-next-formProf">
            <div class="col-md-3 content_btn-siguient">
                <button type="submit" class="boton_inferior-siguiente-formProf btn-next-320-formProf" onclick="btnHideNext(this)" code-position="personalData"> Siguiente
                    <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flechaBtn_guardar-formInst" alt=""> 
                </button>
            </div>
        </div>
    </div>

    <!-- 2* Contenedor principal de la tarjeta PERFIL PROFESIONAL -->
    <div class="container-fluid professional_profile content_principal-formProf">
        <!--------------------------------------------      Inicio 4 cuarta parte del formulario *** PERFIL PROFESIONAL ***      ---------------------------------------------->
        <div class="col-lg-10 col-xl-8 pb-3 content_perfil-prof  infoBasica_formProf">
            <h5 class="col-12 icon_infoSubPerfil-formProf"> Perfil profesional </h5>

            <form method="POST" action="{{ url ('/FormularioProfesionalSave4') }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"> 

                @if(!empty($objFormulario))
                    <div class="col-12 px-0">
                        <div class="form-group">
                            <label for="example-date-input" class="col-12 text_label-formProf"> Escriba una breve descripción de su biografía </label>

                            <textarea class="form-control" id="descripcionPerfil"  type="text" name="descripcionPerfil" >{{$objFormulario->descripcionPerfil}}</textarea>
                        </div>
                    </div>
                @else
                    <div class="col-12 px-0">
                        <div class="form-group">
                            <label for="example-date-input" class="col-12 text_label-formProf" maxlength="270" > Escriba una breve descripción de su biografía </label>

                            <textarea class="form-control" id="descripcionPerfil"  type="text" name="descripcionPerfil" ></textarea>

                            <labe class="col-12 text_infoImg-formProf"> 270 Caracteres </label> 
                        </div>
                    </div>
                @endif
                <div class="col-12 content_btnEnviar-formProf">
                    <button type="submit" class="btn2_enviar-formProf"> Guardar
                        <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flecha_guardar-formProf" alt=""> 
                    </button>
                </div>
            </form>
        </div>
        <!--------------------------------------------      Fin 4 cuarta parte del formulario *** PERFIL PROFESIONAL ***      ------------------------------------------------->

        <!--------------------------------------------      Inicio 5 quinta parte del formulario *** EDUCACIÓN ***      ------------------------------------------------------->
        <div class="col-lg-10 col-xl-8 pb-3 content_perfil-prof infoBasica_formProf">
            <h5 class="col-12 icon_infoEduc-formProf"> Educación </h5>

            @foreach($objEducacion as $objEducacion)
                @if(!empty($objEducacion->nombreuniversidad))
                    <div class="col-12">
                        <span>{{$objEducacion->nombreuniversidad}}  {{$objEducacion->nombreestudio}} {{$objEducacion->fechaestudio}}</span>
                        
                        <a href="{{url('/FormularioProfesionaldelete5/'.$objEducacion->id_universidadperfil)}}">
                            <button type="submit" class="close" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </a>
                    </div>
                @endif
            @endforeach

            <form method="POST" action="{{ url ('/FormularioProfesionalSave5') }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"> 

                <div class="row p-0 m-0">
                    <div class="col-md-6 section_inputLeft-text-formProf">
                        <label for="example-date-input" class="col-12 text_label-formProf"> Selecione universidad </label>

                        <select  class="form-control" name="id_universidad[]">
                            <option value=""> Seleccione universidad </option>

                            @foreach($universidades as $universidad)
                                <option value="{{$universidad->id_universidad}}"> {{$universidad->nombreuniversidad}}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="col-md-6 section_inputRight-text-formProf">
                        <label for="example-date-input" class="col-12 text_label-formProf"> Fecha de finalización </label>
                    
                        <input class="form-control" type="date" value="2011-08-19" id="example-date-input" name="fechaestudio[]">
                    </div>

                    <div class="col-md-6 section_inputLeft-text-formProf">
                        <div class="form-group">
                            <label for="example-date-input" class="col-12 text_label-formProf"> Disciplina académica </label>

                            <input class="form-control" id="direccion" type="text" name="nombreestudio[]" value="">
                        </div>
                    </div>
                </div>

                <div class="row p-0 m-0 hidden-section-formProf">
                    <div class="col-md-6 section_inputLeft-text-formProf">
                        <label for="example-date-input" class="col-12 text_label-formProf"> Selecione universidad </label>

                        <select  class="form-control" name="id_universidad[]">
                            <option value="">Seleccione universidad</option>

                            @foreach($universidades as $universidad)
                                <option value="{{$universidad->id_universidad}}"> {{$universidad->nombreuniversidad}}</option>
                            @endforeach
                        </select>
                    </div>
            
                    <div class="col-md-6 section_inputRight-text-formProf">
                        <label for="example-date-input" class="col-12 text_label-formProf"> Fecha de finalización </label>

                        <input class="form-control" type="date" value="2011-08-19" id="example-date-input" name="fechaestudio[]">
                    </div>

                    <div class="col-md-6 section_inputLeft-text-formProf">
                        <div class="form-group">
                            <label for="example-date-input" class="col-12 text_label-formProf"> Disciplina académica </label>

                            <input class="form-control" id="direccion" type="text" name="nombreestudio[]" value="">
                        </div>
                    </div>
                </div>

                            
                <div class="row p-0 m-0 hidden-section-formProf">
                    <div class="col-md-6 section_inputLeft-text-formProf">
                        <label for="example-date-input" class="col-12 text_label-formProf"> Selecione universidad </label>
                            <select  class="form-control" name="id_universidad[]">
                                <option value="">Seleccione universidad</option>

                                @foreach($universidades as $universidad)
                                    <option value="{{$universidad->id_universidad}}"> {{$universidad->nombreuniversidad}}</option>
                                @endforeach
                            </select>
                    </div>

                    <div class="col-md-6 section_inputRight-text-formProf">
                        <label for="example-date-input" class="col-12 text_label-formProf"> Fecha de finalización </label>

                        <input class="form-control" type="date" value="2011-08-19" id="example-date-input" name="fechaestudio[]">
                    </div>

                    <div class="col-md-6 section_inputLeft-text-formProf">
                        <div class="form-group">
                            <label for="example-date-input" class="col-12 text_label-formProf"> Disciplina académica </label>

                            <input class="form-control" id="direccion" type="text" name="nombreestudio[]" value="">
                        </div>
                </div>
                </div>

                <div class="row p-0 m-0 hidden-section-formProf">
                    <div class="col-md-6 section_inputLeft-text-formProf">
                        <label for="example-date-input" class="col-12 text_label-formProf"> Selecione universidad </label>

                        <select  class="form-control" name="id_universidad[]">
                            <option value="">Seleccione universidad</option>

                            @foreach($universidades as $universidad)
                                <option value="{{$universidad->id_universidad}}"> {{$universidad->nombreuniversidad}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 section_inputRight-text-formProf">
                        <label for="example-date-input" class="col-12 text_label-formProf"> Fecha de finalización </label>

                        <input class="form-control" type="date" value="2011-08-19" id="example-date-input" name="fechaestudio[]">
                    </div>

                    <div class="col-md-6 section_inputLeft-text-formProf">
                        <div class="form-group">
                            <label for="example-date-input" class="col-12 text_label-formProf"> Disciplina académica </label>

                            <input class="form-control" id="direccion" type="text" name="nombreestudio[]" value="">
                        </div>
                    </div>
                </div>

                <div class="col-12 content_btnEnviar-formProf">
                    <button type="submit" class="btn2_enviar-formProf"> Guardar
                        <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flecha_guardar-formProf" alt=""> 
                    </button>
                </div>
            </form> 
        </div>
        <!--------------------------------------------      Fin 5 quinta parte del formulario *** EDUCACIÓN ***      ---------------------------------------------------------->

        <!--------------------------------------------      Inicio 6 sexta parte del formulario *** EXPERIENCIA ***      ------------------------------------------------------>
        <div class="col-lg-10 col-xl-8 pb-3 content_perfil-prof infoBasica_formProf">
            <h5 class="col-12 icon_infoExper-formProf"> Experiencia </h5>

            <!--------------muestra una lista de la experinecia ingresada---------------> 
            @foreach($objExperiencia as $objExperiencia)
                @if(!empty($objExperiencia->nombreEmpresaExperiencia))
                    <div class="col-12">
                        <span>{{$objExperiencia->nombreEmpresaExperiencia}}  {{$objExperiencia->descripcionExperiencia}} {{$objExperiencia->fechaInicioExperiencia}} {{$objExperiencia->fechaFinExperiencia}}</span>

                        <a href="{{url('/FormularioProfesionaldelete6/'.$objExperiencia->idexperiencias)}}">
                            <button type="submit" class="close" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </a>
                    </div>
                @endif
            @endforeach

            <form method="POST" action="{{ url ('/FormularioProfesionalSave6') }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"> 

                <div class="row fila_infoBasica-formProf" id="listas"> 
                    <div class="col-md-6 section_inputLeft-text-formProf">
                        <label for="example-date-input" class="col-12 text_label-formProf"> Empresa </label>

                        <input class="col-lg-12 form-control" id="nombreEmpresaExperiencia"  type="text" name="nombreEmpresaExperiencia[]" value="">
                    </div>

                    <div class="col-md-6 section_inputRight-text-formProf">
                        <label for="example-date-input" class="col-12 text_label-formProf"> Cargo </label>

                        <input class="col-lg-12 form-control" id="descripcionExperiencia"  type="text" name="descripcionExperiencia[]" value="">
                    </div>

                    <div class="col-md-6 section_inputLeft-text-formProf">
                        <label for="example-date-input" class="col-12 text_label-formProf"> Fecha de inicio </label>

                        <input class="form-control" type="date"  id="fechaInicioExperiencia" name="fechaInicioExperiencia[]" value="">
                    </div>

                    <div class="col-md-6 section_inputRight-text-formProf">
                        <label for="example-date-input" class="col-12 text_label-formProf"> Fecha de terminación </label>

                        <input class="form-control" type="date"  id="fechaFinExperienci" name="fechaFinExperiencia[]" value="">
                    </div>
                </div>

                <div class="col-12 content_btnEnviar-formProf">
                    <button type="submit" class="btn2_enviar-formProf"> Guardar
                        <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flecha_guardar-formProf" alt=""> 
                    </button>
                </div>
            </form>
        </div>
        <!--------------------------------------------      Fin 6 sexta parte del formulario *** EXPERIENCIA ***      --------------------------------------------------------->

        <!--------------------------------------------      Inicio 7 septima parte del formulario *** ASOCIACIONES ***      --------------------------------------------------->
        <div class="col-lg-10 col-xl-8 pb-3 content_perfil-prof infoBasica_formProf">
            <h5 class="col-12 icon_infoAsocia-formProf"> Asociaciones </h5>

            <div class="row col-12 px-0 mt-3 m-0">
                @foreach($objAsociaciones as $objAsociaciones)
                    @if(!empty($objAsociaciones->imgasociacion))
                        <div class="col-10 col-md-6 content_imgGuardada-formProf">
                            <a href="{{url('/FormularioProfesionaldelete7/'.$objAsociaciones->idAsociaciones)}}">
                                <button type="submit" class="close" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </a>
                            
                            <img class="img_guardada-formProf" id="imagenPrevisualizacion" src="{{URL::asset($objAsociaciones->imgasociacion)}}">
                        </div>
                    @endif
                @endforeach
            </div>

            <form method="POST" action="{{ url ('/FormularioProfesionalSave7') }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
                    
                @if($objContadorAsociaciones->cantidad == 0)
                    <!-- Modulo ASOCIACIONES -->
                    <div class="row col-12 px-0 m-0">
                        <!-- campo 1 -->
                        <div class="col-10 col-md-6 content_agregarImg-formProf form-group">
                            <div class="col-10 img_selccionada-formProf">
                                <div class="img_anexada-formProf">
                                    <img id="uploadPreview1"/>
                                </div>
                            </div>

                            <div class="agregar_archivo-formProf">
                                <input type='file' id="uploadImage1" name="imgasociacion[]" onchange="previewImage(1);"/>
                            </div>

                            <labe class="col-12 text_infoImg-formProf"> Tamaño 120px x 60px. Peso máximo 300kb </label> 
                        </div> 

                        <!-- campo 2 -->
                        <div class="col-10 col-md-6 content_agregarImg-formProf form-group">
                            <div class="col-10 img_selccionada-formProf">
                                <div class="img_anexada-formProf">
                                    <img id="uploadPreview2"/>
                                </div>
                            </div>

                            <div class="agregar_archivo-formProf">
                                <input type='file' id="uploadImage2" name="imgasociacion[]" onchange="previewImage(2);"/>
                            </div>

                            <labe class="col-12 text_infoImg-formProf"> Tamaño 120px x 60px. Peso máximo 300kb </label> 
                        </div> 

                    </div> 
                    
                    <!-- Modulo ASOCIACIONES -->
                    <div class="row col-12 px-0 m-0 hidden-section-formProf">
                        <!-- campo 3 -->
                        <div class="col-10 col-md-6 content_agregarImg-formProf form-group">
                            <div class="col-10 img_selccionada-formProf">
                                <div class="img_anexada-formProf">
                                    <img id="uploadPreview3"/>
                                </div>
                            </div>

                            <div class="agregar_archivo-formProf">
                                <input type='file' id="uploadImage3" name="imgasociacion[]" onchange="previewImage(3);"/>
                            </div>

                            <labe class="col-12 text_infoImg-formProf"> Tamaño 120px x 60px. Peso máximo 300kb </label> 
                        </div> 
                        
                        <!-- campo 4 -->
                        <div class="col-10 col-md-6 content_agregarImg-formProf form-group">
                            <div class="col-10 img_selccionada-formProf">
                                <div class="img_anexada-formProf">
                                    <img id="uploadPreview4"/>
                                </div>
                            </div>

                            <div class="agregar_archivo-formProf">
                                <input type='file' id="uploadImage4" name="imgasociacion[]" onchange="previewImage(4);"/>
                            </div>

                            <labe class="col-12 text_infoImg-formProf"> Tamaño 120px x 60px. Peso máximo 300kb </label> 
                        </div>  
                    </div>

                @elseif($objContadorAsociaciones->cantidad == 1)
                    <!-- Modulo ASOCIACIONES -->
                    <div class="row col-12 px-0 m-0">
                        <!-- campo 1 -->
                        <div class="col-10 col-md-6 content_agregarImg-formProf form-group">
                            <div class="col-10 img_selccionada-formProf">
                                <div class="img_anexada-formProf">
                                    <img id="uploadPreview1"/>
                                </div>   
                            </div>

                            <div class="agregar_archivo-formProf">
                                <input type='file' id="uploadImage1" name="imgasociacion[]" onchange="previewImage(1);"/> 
                            </div>

                            <labe class="col-12 text_infoImg-formProf"> Tamaño 120px x 60px. Peso máximo 300kb </label> 
                        </div> 

                        <!-- campo 2 -->
                        <div class="col-10 col-md-6 content_agregarImg-formProf form-group">
                            <div class="col-10 img_selccionada-formProf">
                                <div class="img_anexada-formProf">
                                    <img id="uploadPreview2"/>
                                </div> 
                            </div>

                            <div class="agregar_archivo-formProf">
                                <input type='file' id="uploadImage2" name="imgasociacion[]" onchange="previewImage(2);"/>
                            </div>

                            <labe class="col-12 text_infoImg-formProf"> Tamaño 120px x 60px. Peso máximo 300kb </label> 
                        </div>
                    </div> 

                    <!-- Modulo ASOCIACIONES -->
                    <div class="row col-12 px-0 m-0 hidden-section-formProf">
                        <!-- campo 3 -->
                        <div class="col-10 col-md-6 content_agregarImg-formProf form-group">
                            <div class="col-10 img_selccionada-formProf">
                                <div class="img_anexada-formProf">
                                    <img id="uploadPreview3"/>
                                </div>  
                            </div>

                            <div class="agregar_archivo-formProf">
                                <input type='file' id="uploadImage3" name="imgasociacion[]" onchange="previewImage(3);"/>
                            </div>

                            <labe class="col-12 text_infoImg-formProf"> Tamaño 120px x 60px. Peso máximo 300kb </label> 
                        </div>  
                    </div>

                @elseif($objContadorAsociaciones->cantidad == 2)
                    <!-- Modulo ASOCIACIONES -->
                    <div class="row col-12 px-0 m-0">
                        <!-- campo 1 -->
                        <div class="col-10 col-md-6 content_agregarImg-formProf form-group">
                            <div class="col-10 img_selccionada-formProf">
                                <div class="img_anexada-formProf">
                                    <img id="uploadPreview1"/>
                                </div>   
                            </div>

                            <div class="agregar_archivo-formProf">
                                <input type='file' id="uploadImage1" name="imgasociacion[]" onchange="previewImage(1);"/> 
                            </div>

                            <labe class="col-12 text_infoImg-formProf"> Tamaño 120px x 60px. Peso máximo 300kb </label> 
                        </div> 

                        <!-- campo 2 -->
                        <div class="col-10 col-md-6 content_agregarImg-formProf form-group">
                            <div class="col-10 img_selccionada-formProf">
                                <div class="img_anexada-formProf">
                                    <img id="uploadPreview2"/>
                                </div> 
                            </div>

                            <div class="agregar_archivo-formProf">
                                <input type='file' id="uploadImage2" name="imgasociacion[]" onchange="previewImage(2);"/>
                            </div>

                            <labe class="col-12 text_infoImg-formProf"> Tamaño 120px x 60px. Peso máximo 300kb </label> 
                        </div> 
                    </div>

                @elseif($objContadorAsociaciones->cantidad == 3)
                    <!-- Modulo ASOCIACIONES -->
                    <div class="row col-12 px-0 m-0">
                        <!-- campo 1 -->
                        <div class="col-10 col-md-6 content_agregarImg-formProf form-group">
                            <div class="col-10 img_selccionada-formProf">
                                <div class="img_anexada-formProf">
                                    <img id="uploadPreview1"/>
                                </div>   
                            </div>

                            <div class="agregar_archivo-formProf">
                                <input type='file' id="uploadImage1" name="imgasociacion[]" onchange="previewImage(1);"/> 
                            </div>

                            <labe class="col-12 text_infoImg-formProf"> Tamaño 120px x 60px. Peso máximo 300kb </label> 
                        </div> 
                    </div>

                @elseif($objContadorAsociaciones->cantidad >= 4)
                    <span> No se puede agregar más fotos </span>
                @endif
            
                <div class="col-12 mt-2 content_btnEnviar-formProf">
                    <button type="submit" class="btn2_enviar-formProf"> Guardar
                        <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flecha_guardar-formProf" alt=""> 
                    </button>
                </div>
            </form>
        </div>
        <!--------------------------------------------      Fin 7 septima parte del formulario *** ASOCIACIONES ***      ------------------------------------------------------>

        <!--------------------------------------------      Inicio 8 octava parte del formulario *** IDIOMAS ***      --------------------------------------------------------->
        <div class="col-lg-10 col-xl-8 pb-3 content_perfil-prof infoBasica_formProf">
            <h5 class="col-12 icon_infoIdioma-formProf"> Idiomas </h5>

            <div class="row p-0 mt-3 m-0">
                @foreach($objIdiomas as $objIdiomas)
                    @if(!empty($objIdiomas->imgidioma))
                        <div class="col-4 content_idmBandera-formProf">
                            <a href="{{url('/FormularioProfesionaldelete8/'.$objIdiomas->id_idioma)}}">
                                <button type="submit" class="close" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </a>

                            <label for="example-date-input" class="mr-2 text_label-formProf"> {{$objIdiomas->nombreidioma}}</label>

                            <img id="imagenPrevisualizacion" class="img_bandera-forProf" src="{{URL::asset($objIdiomas->imgidioma)}}">
                        </div>
                    @endif
                @endforeach
            </div>

            <form method="POST" action="{{ url ('/FormularioProfesionalSave8') }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">  
                    
                @if($objContadorIdiomas->cantidad == 0)
                    <div class="row p-0 mt-3 m-0">
                        <div class="col-md-6 section_inputLeft-text-formProf">
                            <label for="example-date-input" class="mr-2 text_label-formProf"> Seleccione idioma </label>

                            <select  class="form-control" name="id_idioma[]">
                                <option value=" "> Seleccione </option>
                                @foreach($idiomas as $idiomas1)
                                    <option value="{{$idiomas1->id_idioma}}"> {{$idiomas1->nombreidioma}}</option>
                                @endforeach
                            </select>
                        </div>                    

                        <div class="col-md-6 section_inputRight-text-formProf hidden-section-formProf">
                            <label for="example-date-input" class="mr-2 text_label-formProf"> Seleccione idioma </label>

                            <select  class="form-control" name="id_idioma[]">
                                <option value=" "> Seleccione </option>
                                @foreach($idiomas as $idiomas2)
                                    <option value="{{$idiomas2->id_idioma}}"> {{$idiomas2->nombreidioma}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 section_inputLeft-text-formProf hidden-section-formProf">
                            <label for="example-date-input" class="mr-2 text_label-formProf"> Seleccione idioma </label>

                            <select  class="form-control" name="id_idioma[]">
                                <option value=" "> Seleccione </option>
                                @foreach($idiomas as $idiomas3)
                                    <option value="{{$idiomas3->id_idioma}}"> {{$idiomas3->nombreidioma}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                @elseif($objContadorIdiomas->cantidad == 1)
                    <div class="row p-0 mt-3 m-0">
                        <div class="col-md-6 section_inputLeft-text-formProf">
                            <label for="example-date-input" class="mr-2 text_label-formProf"> Seleccione idioma </label>

                            <select  class="form-control" name="id_idioma[]">
                                <option value=" "> Seleccione </option>
                                @foreach($idiomas as $idiomas1)
                                    <option value="{{$idiomas1->id_idioma}}"> {{$idiomas1->nombreidioma}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 section_inputRight-text-formProf hidden-section-formProf">
                            <label for="example-date-input" class="mr-2 text_label-formProf"> Seleccione idioma </label>

                            <select  class="form-control" name="id_idioma[]">
                                <option value=" "> Seleccione </option>
                                @foreach($idiomas as $idiomas2)
                                    <option value="{{$idiomas2->id_idioma}}"> {{$idiomas2->nombreidioma}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>  
                @elseif($objContadorIdiomas->cantidad == 2)
                    <div class="row p-0 mt-3 m-0">
                        <div class="col-md-6 section_inputLeft-text-formProf">
                            <label for="example-date-input" class="mr-2 text_label-formProf"> Seleccione idioma </label>

                            <select  class="form-control" name="id_idioma[]">
                                <option value=" "> Seleccione </option>
                                @foreach($idiomas as $idiomas1)
                                    <option value="{{$idiomas1->id_idioma}}"> {{$idiomas1->nombreidioma}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>  
                @elseif($objContadorIdiomas->cantidad == 3)
                    <span> No se puede agregar más idiomas </span>
                @endif 

                <div class="col-12 mt-3 content_btnEnviar-formProf">
                    <button type="submit" class="btn2_enviar-formProf"> Guardar
                        <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flecha_guardar-formProf" alt=""> 
                    </button>
                </div>
            </form>
        </div>
        <!--------------------------------------------      Fin 8 octava parte del formulario *** IDIOMAS ***      ------------------------------------------------------------>

        <!-- Secciones de los botones anterior y siguiente -->
        <div class="col-lg-10 col-xl-8 content_botonesInferiores-formProf">
            <div class="col-md-3 content_btn-anter">
                <button type="submit" class="boton_inferior-anterior-formProf" onclick="btnHidePrevious(this)" code-position="professionalProfile">
                    <img src="{{URL::asset('/img/formulario-profesional/icono-flecha-gris.svg')}}" class="flechaBtn_guardar-formInst" alt=""> 
                    Anterior
                </button>
            </div>

            <div class="col-md-3 content_btn-siguient">
                <button type="submit" class="boton_inferior-siguiente-formProf" onclick="btnHideNext(this)" code-position="professionalProfile"> Siguiente
                    <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flechaBtn_guardar-formInst" alt=""> 
                </button>
            </div>
        </div>
    </div>

    <!-- 3* Contenedor principal de la tarjeta TRATAMIENTOS Y PROCEDIMIENTOS -->
    <div class="container-fluid treatments_procedures content_principal-formProf">
        <!--------------------------------------------      Inicio 9 novena parte del formulario *** TRATAMIENTOS y PROCEDIMIENTOS ***      ----------------------------------->
        <div class="col-lg-10 col-xl-8 pb-3 content_tratam-proced infoBasica_formProf">
            <h5 class="col-12 icon_infoTratam-formProf"> Tratamientos y procedimientos </h5>

            <p class="text_superior-proced-formProf"> A continuación suba imágenes con respecto a los procedimientos y tratamientos, con su título y descripción. </p>

            @foreach($objTratamiento as $objTratamiento)
                @if(!empty($objTratamiento->imgTratamientoAntes))
                    <div class="row col-12 p-0 m-0">
                        <div class="col-12 pr-3 content_btnX-cierre-formProf">
                            <a href="{{url('/FormularioProfesionaldelete9/'.$objTratamiento->id_tratamiento)}}">
                                <button type="submit" class="close" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </a>
                        </div>

                        <!-- Contenido ANTES -->  
                        <div class="col-12 col-md-6 content_agregarImg-formProf form-group">
                            <label for="example-date-input" class="col-12 text_label-formProf"> Antes </label> 

                            <div class="col-12 img_selccionada-formProf">
                                <img src="{{URL::asset($objTratamiento->imgTratamientoAntes)}}" width="150" height="150">
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> {{$objTratamiento->tituloTrataminetoAntes}} </label>
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> {{$objTratamiento->descripcionTratamientoAntes}} </label>
                                </div>
                            </div>
                        </div>
                
                        <!-- Contenido DESPUÉS -->
                        <div class="col-12 col-md-6 content_agregarImg-formProf form-group">
                            <label for="example-date-input" class="col-12 text_label-formProf"> Después </label> 

                            <div class="col-12 img_selccionada-formProf">
                                <img src="{{URL::asset($objTratamiento->imgTratamientodespues)}}" width="150" height="150">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> {{$objTratamiento->tituloTrataminetoDespues}} </label>
                                </div>
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> {{$objTratamiento->descripcionTratamientoDespues}} </label>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach 

            <form method="POST" action="{{ url ('/FormularioProfesionalSave9') }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            
                @if($objContadorTratamiento->cantidad == 0)
                    <!-- Modulos de los contenidos ANTES y DESPUÉS -->
                    <div class="row content_antDesp-formProf">
                        <!-- Contenido ANTES -->
                        <div class="col-md-6 content_antes-formProf section_inputLeft-text-formProf">
                            <div class="col-12 content_agregarImg-formProf form-group">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Antes </label> 

                                <div class="col-12 img_selccionada-formProf">
                                    <div class="img_anexada-formProf" id="previewates1">
                                        <img id="uploadPreview5" width="150" height="150"/>
                                    </div>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage5" name="imgTratamientoAntes[]" onchange="previewImage(5);"/>
                                </div>

                                <labe class="col-12 text_infoImg-formProf"> Tamaño 225px x 225px. Peso máximo 400kb </label> 
                            </div> 

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Título de la imagen antes </label> 

                                    <input class="form-control" id="descripcionExperiencia"  type="text" name="tituloTrataminetoAntes[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción antes </label>

                                    <input class="form-control" id="descripcionExperiencia"  type="text" name="descripcionTratamientoAntes[]" value="">
                                </div>
                            </div>
                        </div>

                        <!-- Contenido DESPUÉS -->
                        <div class="col-md-6 content_despues-formProf section_inputRight-text-formProf">
                            <div class="col-12 content_agregarImg-formProf form-group">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Después </label> 

                                <div class="col-12 img_selccionada-formProf">
                                    <div class="img_anexada-formProf" id="previewdespues1">
                                        <img id="uploadPreview6" width="150" height="150"/>
                                    </div>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage6" name="imgTratamientodespues[]" onchange="previewImage(6);"/>
                                </div>

                                <labe class="col-12 text_infoImg-formProf"> Tamaño 225px x 225px. Peso máximo 400kb </label> 
                            </div> 

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Título de la imagen después </label>

                                    <input class="form-control" id="descripcionExperiencia"  type="text" name="tituloTrataminetoDespues[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción después </label>

                                    <input class="form-control" id="descripcionExperiencia"  type="text" name="descripcionTratamientoDespues[]" value="">
                                </div>
                            </div> 
                        </div>
                    </div>

                    <!-- Modulo de los contenidos ANTES y DESPUÉS -->
                    <div class="row content_antDesp-formProf hidden-section-formProf">
                        <!-- Contenido ANTES -->
                        <div class="col-md-6 content_antes-formProf section_inputLeft-text-formProf">
                            <div class="col-12 content_agregarImg-formProf form-group">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Antes </label>


                                <div class="col-12 img_selccionada-formProf">
                                    <div class="img_anexada-formProf" id="previewates2">
                                        <img id="uploadPreview7" width="150" height="150"/>
                                    </div>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage7" name="imgTratamientoAntes[]" onchange="previewImage(7);"/>
                                </div> 

                                <labe class="col-12 text_infoImg-formProf"> Tamaño 225px x 225px. Peso máximo 400kb </label> 
                            </div> 

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Título de la imagen antes </label> 

                                    <input class="form-control" id="descripcionExperiencia"  type="text" name="tituloTrataminetoAntes[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción antes </label>

                                    <input class="form-control" id="descripcionExperiencia"  type="text" name="descripcionTratamientoAntes[]" value="">
                                </div>
                            </div>
                        </div>

                        <!-- Contenido DESPUÉS -->
                        <div class="col-md-6 content_despues-formProf section_inputRight-text-formProf">
                            <div class="col-12 content_agregarImg-formProf form-group">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Después </label> 

                                <div class="col-12 img_selccionada-formProf">
                                    <div class="img_anexada-formProf" id="previewdespues2">
                                        <img id="uploadPreview8" width="150" height="150"/>
                                    </div>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage8" name="imgTratamientodespues[]" onchange="previewImage(8);"/>
                                </div>

                                <labe class="col-12 text_infoImg-formProf"> Tamaño 225px x 225px. Peso máximo 400kb </label> 
                            </div> 

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Título de la imagen después </label>

                                    <input class="form-control" id="descripcionExperiencia"  type="text" name="tituloTrataminetoDespues[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción después </label>

                                    <input class="form-control" id="descripcionExperiencia"  type="text" name="descripcionTratamientoDespues[]" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif($objContadorTratamiento->cantidad == 1)
                    <!-- Modulo de los contenidos ANTES y DESPUÉS -->
                    <div class="row content_antDesp-formProf">
                        <!-- Contenido ANTES -->
                        <div class="col-md-6 content_antes-formProf section_inputLeft-text-formProf">
                            <div class="col-12 content_agregarImg-formProf form-group">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Antes </label>


                                <div class="col-12 img_selccionada-formProf">
                                    <div class="img_anexada-formProf">
                                        <img id="uploadPreview5" width="150" height="150"/> 
                                    </div>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage5" name="imgTratamientoAntes[]" onchange="previewImage(5);"/>
                                </div> 

                                <labe class="col-12 text_infoImg-formProf"> Tamaño 225px x 225px. Peso máximo 400kb </label> 
                            </div> 

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Título de la imagen antes </label> 

                                    <input class="form-control" id="descripcionExperiencia"  type="text" name="tituloTrataminetoAntes[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción antes </label>

                                    <input class="form-control" id="descripcionExperiencia"  type="text" name="descripcionTratamientoAntes[]" value="">
                                </div>
                            </div>
                        </div>

                        <!-- Contenido DESPUÉS -->
                        <div class="col-md-6 content_despues-formProf section_inputRight-text-formProf">
                            <div class="col-12 content_agregarImg-formProf form-group">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Después </label> 

                                <div class="col-12 img_selccionada-formProf">
                                    <div class="img_anexada-formProf" id>
                                        <img id="uploadPreview6" width="150" height="150"/>
                                    </div>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage6" name="imgTratamientodespues[]" onchange="previewImage(6);"/>
                                </div>

                                <labe class="col-12 text_infoImg-formProf"> Tamaño 225px x 225px. Peso máximo 400kb </label> 
                            </div> 

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Título de la imagen después </label>

                                    <input class="form-control" id="descripcionExperiencia"  type="text" name="tituloTrataminetoDespues[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción después </label>

                                    <input class="form-control" id="descripcionExperiencia"  type="text" name="descripcionTratamientoDespues[]" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif($objContadorTratamiento->cantidad == 2)
                    <span> No se pueden agregar más </span>
                @endif 

                <div class="col-12 content_btnEnviar-formProf">
                    <button type="submit" class="btn2_enviar-formProf"> Guardar
                        <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flecha_guardar-formProf" alt=""> 
                    </button>
                </div>
            </form>
        </div>
        <!--------------------------------------------      Fin 9 novena parte del formulario *** TRATAMIENTOS y PROCEDIMIENTOS ***      -------------------------------------->

        <!-- Secciones de los botones anterior y siguiente -->
        <div class="col-lg-10 col-xl-8 content_botonesInferiores-formProf">
            <div class="col-md-3 content_btn-anter">
                <button type="submit" class="boton_inferior-anterior-formProf" onclick="btnHidePrevious(this)" code-position="treatmentsProcedures">
                    <img src="{{URL::asset('/img/formulario-profesional/icono-flecha-gris.svg')}}" class="flechaBtn_guardar-formInst" alt=""> 
                    Anterior
                </button>
            </div>

            <div class="col-md-3 content_btn-siguient">
                <button type="submit" class="boton_inferior-siguiente-formProf" onclick="btnHideNext(this)" code-position="treatmentsProcedures"> Siguiente
                    <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flechaBtn_guardar-formInst" alt=""> 
                </button>
            </div>
        </div>
    </div>

    <!-- 4* Contenedor principal de la tarjeta PREMIOS Y RECONOCIMIENTOS -->
    <div class="container-fluid Awards_honours content_principal-formProf">
        <!--------------------------------------------      Inicio 10 decima parte del formulario *** PREMIOS y RECONOCIMIENTOS ***      -------------------------------------->
        <div class="col-lg-10 col-xl-8 pb-3 content_premio-recono infoBasica_formProf">
            <h5 class="col-12 icon_infoPremReco-formProf"> Premios y reconocimientos </h5>

            <p class="text_superior-proced-formProf"> A continuación suba imágenes relacionadas con sus premios y reconocimientos, con nombre y descripción. </p>

            <!-- Modulo de los PREMIOS con información -->
            <div class="row col-12 p-0 m-0">
                @foreach($objPremios as $objPremios)
                    @if(!empty($objPremios->nombrepremio))
                        <!-- Contenido PREMIO -->    
                        <div class="col-md-6 mt-3 content_antes-formProf">
                            <div class="col-12 content_btnX-cierre-formProf">
                                <a href="{{url('/FormularioProfesionaldelete10/'.$objPremios->id)}}">
                                    <button type="submit" class="close" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </a>
                            </div>
                            
                            <div class="col-12 content_agregarImg-formProf form-group">
                                <div class="img_selccionada-formProf">
                                    <img class="img_anexada-formProf" src="{{URL::asset($objPremios->imgpremio)}}">
                                </div>

                                <div class="col-12 p-0">
                                    <div class="form-group">
                                        <label for="example-date-input" class="col-12 text_label-formProf"> {{$objPremios->nombrepremio}}  </label>
                                    </div>
                                </div>

                                <div class="col-12 p-0">
                                    <div class="form-group">
                                        <label for="example-date-input" class="col-12 text_label-formProf"> {{$objPremios->descripcionpremio}} </label>
                                    </div>
                                </div>

                                <div class="col-12 p-0">
                                    <div class="form-group">
                                        <label for="example-date-input" class="col-12 text_label-formProf"> {{$objPremios->fechapremio}} </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach 
            </div>

            <form method="POST" action="{{ url ('/FormularioProfesionalSave10') }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"> 

                @if($objContadorPremios->cantidad == 0)
                    <!-- Modulo de los PREMIOS sin información-->
                    <div class="row content_antDesp-formProf">
                        <!-- Contenido PREMIO izquierdo -->
                        <div class="col-md-6 photo1 section_inputLeft-text-formProf">
                            <div class="col-12 section_inputLeft-text-formProf content_agregarImg-formProf form-group">
                                <div class="col-10 img_selccionada-formProf">
                                    <div class="img_anexada-formProf">
                                        <img id="uploadPreview9" width="150" height="150"/>
                                    </div>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage9" name="imgpremio[]" onchange="previewImage(9);"/>
                                </div>

                                <labe class="col-12 text_infoImg-formProf"> Tamaño 356 x 326px. Peso máximo 300kb </label> 
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Fecha de inicio </label>
                                
                                    <input class="form-control" type="date"  id="fechapremio" name="fechapremio[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Título premio </label>

                                    <input class="form-control" id="nombrepremio"  type="text" name="nombrepremio[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción premio </label>
                                    
                                    <input class="form-control" id="descripcionpremio"  type="text" name="descripcionpremio[]" value="">
                                </div>
                            </div>
                        </div>

                        <!-- Contenido PREMIO derecho -->
                        <div class="col-md-6 photo2 section_inputRight-text-formProf">
                            <div class="col-12 section_inputRight-text-formProf content_agregarImg-formProf form-group">
                                <div class="col-10 img_selccionada-formProf">
                                    <div class="img_anexada-formProf">
                                        <img id="uploadPreview10" width="150" height="150"/>
                                    </div>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage10" name="imgpremio[]" onchange="previewImage(10);"/>
                                </div>

                                <labe class="col-12 text_infoImg-formProf"> Tamaño 356 x 326px. Peso máximo 300kb </label> 
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Fecha de inicio </label>
                                    
                                    <input class="form-control" type="date"  id="fechapremio" name="fechapremio[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Título premio </label>

                                    <input class="form-control" id="nombrepremio"  type="text" name="nombrepremio[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción premio </label>

                                    <input class="form-control" id="descripcionpremio"  type="text" name="descripcionpremio[]" value="">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modulo de los PREMIOS sin información-->
                    <div class="row content_antDesp-formProf">
                        <!-- Contenido PREMIO izquierdo -->
                        <div class="col-md-6 photo3  section_inputLeft-text-formProf">
                            <div class="col-12 section_inputLeft-text-formProf content_agregarImg-formProf form-group">
                                <div class="col-10 img_selccionada-formProf">
                                    <div class="img_anexada-formProf">
                                        <img id="uploadPreview11" width="150" height="150"/>
                                    </div>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage11" name="imgpremio[]" onchange="previewImage(11);"/>
                                </div>

                                <labe class="col-12 text_infoImg-formProf"> Tamaño 356 x 326px. Peso máximo 300kb </label> 
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Fecha de inicio </label>
                                
                                    <input class="form-control" type="date"  id="fechapremio" name="fechapremio[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Título premio </label>

                                    <input class="form-control" id="nombrepremio"  type="text" name="nombrepremio[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción premio </label>
                                    
                                    <input class="form-control" id="descripcionpremio"  type="text" name="descripcionpremio[]" value="">
                                </div>
                            </div>
                        </div>

                        <!-- Contenido PREMIO derecho -->
                        <div class="col-md-6 photo4 section_inputRight-text-formProf">
                            <div class="col-12 section_inputRight-text-formProf content_agregarImg-formProf form-group">
                                <div class="col-10 img_selccionada-formProf">
                                    <div class="img_anexada-formProf">
                                        <img id="uploadPreview12" width="150" height="150"/>
                                    </div>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage12" name="imgpremio[]" onchange="previewImage(12);"/>
                                </div>

                                <labe class="col-12 text_infoImg-formProf"> Tamaño 356 x 326px. Peso máximo 300kb </label> 
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Fecha de inicio </label>
                                    
                                    <input class="form-control" type="date"  id="fechapremio" name="fechapremio[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Título premio </label>

                                    <input class="form-control" id="nombrepremio"  type="text" name="nombrepremio[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción premio </label>

                                    <input class="form-control" id="descripcionpremio"  type="text" name="descripcionpremio[]" value="">
                                </div>
                            </div>
                        </div>
                    </div>

                @elseif($objContadorPremios->cantidad == 1)
                    <!-- Modulo de los PREMIOS sin información-->
                    <div class="row content_antDesp-formProf">
                        <!-- Contenido PREMIO derecho -->
                        <div class="col-md-6 photo2 section_inputRight-text-formProf">
                            <div class="col-12 section_inputRight-text-formProf content_agregarImg-formProf form-group">
                                <div class="col-10 img_selccionada-formProf">
                                    <div class="img_anexada-formProf">
                                        <img id="uploadPreview10" width="150" height="150"/>
                                    </div>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage10" name="imgpremio[]" onchange="previewImage(10);"/>
                                </div>

                                <labe class="col-12 text_infoImg-formProf"> Tamaño 356 x 326px. Peso máximo 300kb </label> 
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Fecha de inicio </label>
                                    
                                    <input class="form-control" type="date"  id="fechapremio" name="fechapremio[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Título premio </label>

                                    <input class="form-control" id="nombrepremio"  type="text" name="nombrepremio[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción premio </label>

                                    <input class="form-control" id="descripcionpremio"  type="text" name="descripcionpremio[]" value="">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modulo de los PREMIOS sin información-->
                    <div class="row content_antDesp-formProf">
                        <!-- Contenido PREMIO izquierdo -->
                        <div class="col-md-6 photo3  section_inputLeft-text-formProf">
                            <div class="col-12 section_inputLeft-text-formProf content_agregarImg-formProf form-group">
                                <div class="col-10 img_selccionada-formProf">
                                    <div class="img_anexada-formProf">
                                        <img id="uploadPreview11" width="150" height="150"/>
                                    </div>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage11" name="imgpremio[]" onchange="previewImage(11);"/>
                                </div>

                                <labe class="col-12 text_infoImg-formProf"> Tamaño 356 x 326px. Peso máximo 300kb </label> 
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Fecha de inicio </label>
                                
                                    <input class="form-control" type="date"  id="fechapremio" name="fechapremio[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Título premio </label>

                                    <input class="form-control" id="nombrepremio"  type="text" name="nombrepremio[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción premio </label>
                                    
                                    <input class="form-control" id="descripcionpremio"  type="text" name="descripcionpremio[]" value="">
                                </div>
                            </div>
                        </div>

                        <!-- Contenido PREMIO derecho -->
                        <div class="col-md-6 photo4 section_inputRight-text-formProf">
                            <div class="col-12 section_inputRight-text-formProf content_agregarImg-formProf form-group">
                                <div class="col-10 img_selccionada-formProf">
                                    <div class="img_anexada-formProf">
                                        <img id="uploadPreview12" width="150" height="150"/>
                                    </div>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage12" name="imgpremio[]" onchange="previewImage(12);"/>
                                </div>

                                <labe class="col-12 text_infoImg-formProf"> Tamaño 356 x 326px. Peso máximo 300kb </label> 
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Fecha de inicio </label>
                                    
                                    <input class="form-control" type="date"  id="fechapremio" name="fechapremio[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Título premio </label>

                                    <input class="form-control" id="nombrepremio"  type="text" name="nombrepremio[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción premio </label>

                                    <input class="form-control" id="descripcionpremio"  type="text" name="descripcionpremio[]" value="">
                                </div>
                            </div>
                        </div>
                    </div>

                @elseif($objContadorPremios->cantidad == 2)
                    <!-- Modulo de los PREMIOS sin información-->
                    <div class="row content_antDesp-formProf">
                        <!-- Contenido PREMIO izquierdo -->
                        <div class="col-md-6 photo3  section_inputLeft-text-formProf">
                            <div class="col-12 section_inputLeft-text-formProf content_agregarImg-formProf form-group">
                                <div class="col-10 img_selccionada-formProf">
                                    <div class="img_anexada-formProf">
                                        <img id="uploadPreview11" width="150" height="150"/>
                                    </div>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage11" name="imgpremio[]" onchange="previewImage(11);"/>
                                </div>

                                <labe class="col-12 text_infoImg-formProf"> Tamaño 356 x 326px. Peso máximo 300kb </label> 
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Fecha de inicio </label>
                                
                                    <input class="form-control" type="date"  id="fechapremio" name="fechapremio[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Título premio </label>

                                    <input class="form-control" id="nombrepremio"  type="text" name="nombrepremio[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción premio </label>
                                    
                                    <input class="form-control" id="descripcionpremio"  type="text" name="descripcionpremio[]" value="">
                                </div>
                            </div>
                        </div>

                        <!-- Contenido PREMIO derecho -->
                        <div class="col-md-6 photo4 section_inputRight-text-formProf">
                            <div class="col-12 section_inputRight-text-formProf content_agregarImg-formProf form-group">
                                <div class="col-10 img_selccionada-formProf">
                                    <div class="img_anexada-formProf">
                                        <img id="uploadPreview12" width="150" height="150"/>
                                    </div>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage12" name="imgpremio[]" onchange="previewImage(12);"/>
                                </div>

                                <labe class="col-12 text_infoImg-formProf"> Tamaño 356 x 326px. Peso máximo 300kb </label> 
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Fecha de inicio </label>
                                    
                                    <input class="form-control" type="date"  id="fechapremio" name="fechapremio[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Título premio </label>

                                    <input class="form-control" id="nombrepremio"  type="text" name="nombrepremio[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción premio </label>

                                    <input class="form-control" id="descripcionpremio"  type="text" name="descripcionpremio[]" value="">
                                </div>
                            </div>
                        </div>
                    </div>

                @elseif($objContadorPremios->cantidad == 3)
                    <!-- Modulo de los PREMIOS sin información-->
                    <div class="row content_antDesp-formProf">
                        <!-- Contenido PREMIO derecho -->
                        <div class="col-md-6 photo4 section_inputRight-text-formProf">
                            <div class="col-12 section_inputRight-text-formProf content_agregarImg-formProf form-group">
                                <div class="col-10 img_selccionada-formProf">
                                    <div class="img_anexada-formProf">
                                        <img id="uploadPreview12" width="150" height="150"/>
                                    </div>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage12" name="imgpremio[]" onchange="previewImage(12);"/>
                                </div>

                                <labe class="col-12 text_infoImg-formProf"> Tamaño 356 x 326px. Peso máximo 300kb </label> 
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Fecha de inicio </label>
                                    
                                    <input class="form-control" type="date"  id="fechapremio" name="fechapremio[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Título premio </label>

                                    <input class="form-control" id="nombrepremio"  type="text" name="nombrepremio[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción premio </label>

                                    <input class="form-control" id="descripcionpremio"  type="text" name="descripcionpremio[]" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif($objContadorPremios->cantidad == 4)
                    <span> No se puede agregar más </span>
                @endif 

                <div class="col-12 content_btnEnviar-formProf">
                    <button type="submit" class="btn2_enviar-formProf"> Guardar
                        <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flecha_guardar-formProf" alt=""> 
                    </button>
                </div>
            </form>
        </div>
        <!--------------------------------------------      Fin 10 decima parte del formulario *** PREMIOS y RECONOCIMIENTOS ***      ----------------------------------------->

        <!-- Secciones de los botones anterior y siguiente -->
        <div class="col-lg-10 col-xl-8 content_botonesInferiores-formProf">
            <div class="col-md-3 content_btn-anter">
                <button type="submit" class="boton_inferior-anterior-formProf" onclick="btnHidePrevious(this)" code-position="AwardsHonours">
                    <img src="{{URL::asset('/img/formulario-profesional/icono-flecha-gris.svg')}}" class="flechaBtn_guardar-formInst" alt=""> 
                    Anterior
                </button>
            </div>

            <div class="col-md-3 content_btn-siguient">
                <button type="submit" class="boton_inferior-siguiente-formProf" onclick="btnHideNext(this)" code-position="AwardsHonours"> Siguiente
                    <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flechaBtn_guardar-formInst" alt=""> 
                </button>
            </div>
        </div>
    </div>

    <!-- 5* Contenedor principal de la tarjeta PUBLICACIONES -->
    <div class="container-fluid publications_formInst content_principal-formProf">
        <!--------------------------------------------      Inicio 11 onceava parte del formulario *** PUBLICACIONES ***      ------------------------------------------------->
        <div class="col-lg-10 col-xl-8 pb-3 content_publicacion infoBasica_formProf">
            <h5 class="col-12 icon_infoPublic-formProf"> Publicaciones </h5>

            <p class="text_superior-proced-formProf"> A continuación suba imágenes de las publicaciones que ha realizado a lo largo de su experiencia. </p>

            <!-- Modulo de las PUBLICAIONES con información -->
            <div class="row col-12 p-0 m-0">
                @foreach($Publicaciones as $Publicaciones)
                    @if(!empty($Publicaciones->nombrepublicacion))
                        <!-- Contenido PUBLICACIÓN -->    
                        <div class="col-md-6 mt-3 content_antes-formProf">
                            <div class="col-12 content_btnX-cierre-formProf">
                                <a href="{{url('/FormularioProfesionaldelete11/'.$Publicaciones->id)}}">
                                    <button type="submit" class="close" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </a>
                            </div>

                            <div class="col-12 content_agregarImg-formProf form-group">
                                <div class="col-12 img_selccionada-formProf">
                                    <img class="img_publi-formProf" src="{{URL::asset($Publicaciones->imgpublicacion)}}">
                                </div>

                                <div class="col-12 p-0">
                                    <div class="form-group">
                                        <label for="example-date-input" class="col-12 text_label-formProf"> {{$Publicaciones->nombrepublicacion}} </label>
                                    </div>
                                </div>

                                <div class="col-12 p-0">
                                    <div class="form-group">
                                        <label for="example-date-input" class="col-12 text_label-formProf"> {{$Publicaciones->descripcion}} </label>
                                    </div>
                                </div>
                            </div>               
                        </div>
                    @endif
                @endforeach 
            </div>

            <form method="POST" action="{{ url ('/FormularioProfesionalSave11') }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"> 

                @if($objContadorPublicaciones->cantidad == 0)
                    <!-- Modulos del contenido PUBLICACIONES -->
                    <div class="row content_antDesp-formProf">
                        <!-- Contenido publicación left -->
                        <div class="col-md-6 photoPub1 section_inputLeft-text-formProf">
                            <div class="col-12 section_inputLeft-text-formProf content_agregarImg-formProf form-group">
                                <div class="col-12 img_selccionada-formProf">
                                    <div class="img_anexada-formProf">
                                        <img id="uploadPreview13" width="150" height="150"/>
                                    </div>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage13" name="imgpublicacion[]" onchange="previewImage(13);"/>
                                </div>

                                <labe class="col-12 text_infoImg-formProf"> Tamaño 800 x 800px. Peso máximo 500kb </label>
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Título publicación </label>

                                    <input class="form-control" id="nombrepremio"  type="text" name="nombrepublicacion[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción publicación </label>
                                    
                                    <input class="form-control" id="nombrepremio"  type="text" name="descripcion[]" value="">
                                </div>
                            </div>
                        </div>

                        <!-- Contenido publicación right -->
                        <div class="col-md-6 photoPub2 section_inputRight-text-formProf">
                            <div class="col-12 content_agregarImg-formProf form-group">
                                <div class="col-12 img_selccionada-formProf">
                                    <div class="img_anexada-formProf">
                                        <img id="uploadPreview14" width="150" height="150"/>
                                    </div>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage14" name="imgpublicacion[]" onchange="previewImage(14);"/>
                                </div>

                                <labe class="col-12 text_infoImg-formProf"> Tamaño 800 x 800px. Peso máximo 500kb </label>
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Título publicación </label>
                                    
                                    <input class="form-control" id="nombrepremio"  type="text" name="nombrepublicacion[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción publicación </label>
                                    
                                    <input class="form-control" id="nombrepremio"  type="text" name="descripcion[]" value="">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modulos del contenido PUBLICACIONES -->
                    <div class="row content_antDesp-formProf hidden-section-formProf">
                        <!-- Contenido publicación left -->
                        <div class="col-md-6 photoPub1 section_inputLeft-text-formProf">
                            <div class="col-12 section_inputLeft-text-formProf content_agregarImg-formProf form-group">
                                <div class="col-12 img_selccionada-formProf">
                                    <div class="img_anexada-formProf">
                                        <img id="uploadPreview15" width="150" height="150"/>
                                    </div>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage15" name="imgpublicacion[]" onchange="previewImage(15);"/>
                                </div>

                                <labe class="col-12 text_infoImg-formProf"> Tamaño 800 x 800px. Peso máximo 500kb </label>
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Título publicación </label>

                                    <input class="form-control" id="nombrepremio"  type="text" name="nombrepublicacion[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción publicación </label>
                                    
                                    <input class="form-control" id="nombrepremio"  type="text" name="descripcion[]" value="">
                                </div>
                            </div>
                        </div>

                        <!-- Contenido publicación right -->
                        <div class="col-md-6 photoPub2 section_inputRight-text-formProf">
                            <div class="col-12 content_agregarImg-formProf form-group">
                                <div class="col-12 img_selccionada-formProf">
                                    <div class="img_anexada-formProf">
                                        <img id="uploadPreview16" width="150" height="150"/>
                                    </div>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage16" name="imgpublicacion[]" onchange="previewImage(16);"/>
                                </div>

                                <labe class="col-12 text_infoImg-formProf"> Tamaño 800 x 800px. Peso máximo 500kb </label>
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Título publicación </label>
                                    
                                    <input class="form-control" id="nombrepremio"  type="text" name="nombrepublicacion[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción publicación </label>
                                    
                                    <input class="form-control" id="nombrepremio"  type="text" name="descripcion[]" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif($objContadorPublicaciones->cantidad == 1)
                    <!-- Modulos del contenido PUBLICACIONES -->
                    <div class="row content_antDesp-formProf hidden-section-formProf">
                        <!-- Contenido publicación right -->
                        <div class="col-md-6 photoPub2 section_inputRight-text-formProf">
                            <div class="col-12 content_agregarImg-formProf form-group">
                                <div class="col-12 img_selccionada-formProf">
                                    <div class="img_anexada-formProf">
                                        <img id="uploadPreview14" width="150" height="150"/>
                                    </div>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage14" name="imgpublicacion[]" onchange="previewImage(14);"/>
                                </div>

                                <labe class="col-12 text_infoImg-formProf"> Tamaño 800 x 800px. Peso máximo 500kb </label>
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Título publicación </label>
                                    
                                    <input class="form-control" id="nombrepremio"  type="text" name="nombrepublicacion[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción publicación </label>
                                    
                                    <input class="form-control" id="nombrepremio"  type="text" name="descripcion[]" value="">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modulos del contenido PUBLICACIONES -->
                    <div class="row content_antDesp-formProf">
                        <!-- Contenido publicación left -->
                        <div class="col-md-6 photoPub1 section_inputLeft-text-formProf">
                            <div class="col-12 section_inputLeft-text-formProf content_agregarImg-formProf form-group">
                                <div class="col-12 img_selccionada-formProf">
                                    <div class="img_anexada-formProf">
                                        <img id="uploadPreview15" width="150" height="150"/>
                                    </div>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage15" name="imgpublicacion[]" onchange="previewImage(15);"/>
                                </div>

                                <labe class="col-12 text_infoImg-formProf"> Tamaño 800 x 800px. Peso máximo 500kb </label>
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Título publicación </label>

                                    <input class="form-control" id="nombrepremio"  type="text" name="nombrepublicacion[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción publicación </label>
                                    
                                    <input class="form-control" id="nombrepremio"  type="text" name="descripcion[]" value="">
                                </div>
                            </div>
                        </div>

                        <!-- Contenido publicación right -->
                        <div class="col-md-6 photoPub2 section_inputRight-text-formProf">
                            <div class="col-12 content_agregarImg-formProf form-group">
                                <div class="col-12 img_selccionada-formProf">
                                    <div class="img_anexada-formProf">
                                        <img id="uploadPreview16" width="150" height="150"/>
                                    </div>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage16" name="imgpublicacion[]" onchange="previewImage(16);"/>
                                </div>

                                <labe class="col-12 text_infoImg-formProf"> Tamaño 800 x 800px. Peso máximo 500kb </label>
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Título publicación </label>
                                    
                                    <input class="form-control" id="nombrepremio"  type="text" name="nombrepublicacion[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción publicación </label>
                                    
                                    <input class="form-control" id="nombrepremio"  type="text" name="descripcion[]" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif($objContadorPublicaciones->cantidad == 2)
                    <!-- Modulos del contenido PUBLICACIONES -->
                    <div class="row content_antDesp-formProf">
                        <!-- Contenido publicación left -->
                        <div class="col-md-6 photoPub1 section_inputLeft-text-formProf">
                            <div class="col-12 section_inputLeft-text-formProf content_agregarImg-formProf form-group">
                                <div class="col-12 img_selccionada-formProf">
                                    <div class="img_anexada-formProf">
                                        <img id="uploadPreview15" width="150" height="150"/>
                                    </div>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage15" name="imgpublicacion[]" onchange="previewImage(15);"/>
                                </div>

                                <labe class="col-12 text_infoImg-formProf"> Tamaño 800 x 800px. Peso máximo 500kb </label>
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Título publicación </label>

                                    <input class="form-control" id="nombrepremio"  type="text" name="nombrepublicacion[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción publicación </label>
                                    
                                    <input class="form-control" id="nombrepremio"  type="text" name="descripcion[]" value="">
                                </div>
                            </div>
                        </div>

                        <!-- Contenido publicación right -->
                        <div class="col-md-6 photoPub2 section_inputRight-text-formProf">
                            <div class="col-12 content_agregarImg-formProf form-group">
                                <div class="col-12 img_selccionada-formProf">
                                    <div class="img_anexada-formProf">
                                        <img id="uploadPreview16" width="150" height="150"/>
                                    </div>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage16" name="imgpublicacion[]" onchange="previewImage(16);"/>
                                </div>

                                <labe class="col-12 text_infoImg-formProf"> Tamaño 800 x 800px. Peso máximo 500kb </label>
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Título publicación </label>
                                    
                                    <input class="form-control" id="nombrepremio"  type="text" name="nombrepublicacion[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción publicación </label>
                                    
                                    <input class="form-control" id="nombrepremio"  type="text" name="descripcion[]" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif($objContadorPublicaciones->cantidad == 3)
                    <!-- Modulos del contenido PUBLICACIONES -->
                    <div class="row content_antDesp-formProf">
                        <!-- Contenido publicación right -->
                        <div class="col-md-6 photoPub2 section_inputRight-text-formProf">
                            <div class="col-12 content_agregarImg-formProf form-group">
                                <div class="col-12 img_selccionada-formProf">
                                    <div class="img_anexada-formProf">
                                        <img id="uploadPreview16" width="150" height="150"/>
                                    </div>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage16" name="imgpublicacion[]" onchange="previewImage(16);"/>
                                </div>

                                <labe class="col-12 text_infoImg-formProf"> Tamaño 800 x 800px. Peso máximo 500kb </label>
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Título publicación </label>
                                    
                                    <input class="form-control" id="nombrepremio"  type="text" name="nombrepublicacion[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción publicación </label>
                                    
                                    <input class="form-control" id="nombrepremio"  type="text" name="descripcion[]" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif($objContadorPublicaciones->cantidad == 4)
                    <span> No se puede agregar más publicaciones </span>
                @endif 
                        
                <div class="col-12 content_btnEnviar-formProf">
                    <button type="submit" class="btn2_enviar-formProf"> Guardar
                        <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flecha_guardar-formProf" alt=""> 
                    </button>
                </div>
            </form>
        </div>         
        <!--------------------------------------------      Fin 11 onceava parte del formulario *** PUBLICACIONES ***      ---------------------------------------------------->

        <!-- Secciones de los botones anterior y siguiente -->
        <div class="col-lg-10 col-xl-8 content_botonesInferiores-formProf">
            <div class="col-md-3 content_btn-anter">
                <button type="submit" class="boton_inferior-anterior-formProf" onclick="btnHidePrevious(this)" code-position="publicationsFormProf">
                    <img src="{{URL::asset('/img/formulario-profesional/icono-flecha-gris.svg')}}" class="flechaBtn_guardar-formInst" alt=""> 
                    Anterior
                </button>
            </div>

            <div class="col-md-3 content_btn-siguient">
                <button type="submit" class="boton_inferior-siguiente-formProf" onclick="btnHideNext(this)" code-position="publicationsFormInst"> Siguiente
                    <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flechaBtn_guardar-formInst" alt=""> 
                </button>
            </div>
        </div>
    </div>

    <!-- 6* Contenedor principal de la tarjeta GALERIA -->
    <div class="container-fluid gallery_formInst content_principal-formProf">
        <!--------------------------------------------      Inicio 12 doceava parte del formulario *** GALERIA ***      ------------------------------------------------------->
        <div class="col-lg-10 col-xl-8 pb-3 content_galeria-video infoBasica_formProf">
            <h5 class="col-12 icon_infoGale-formProf"> Galeria </h5>

            <p class="text_superior-proced-formProf"> A continuación suba 10 imágenes como mínimo, con su respectivo nombre y descripción. </p>

            <!-- Modulo de la GALERIA con información -->
            <div class="row col-12 p-0 m-0">
                @foreach($objGaleria as $objGaleria)
                    @if(!empty($objGaleria->nombrefoto))
                        <!-- Contenido GALERIA -->    
                        <div class="col-md-6 mt-3 content_antes-formProf">
                            <div class="col-12 content_btnX-cierre-formProf">
                                <a href="{{url('/FormularioProfesionaldelete12/'.$objGaleria->id_galeria)}}">
                                    <button type="submit" class="close" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </a>
                            </div>

                            <div class="col-12 content_agregarImg-formProf form-group">
                                <div class="img_selccionada-formProf">
                                    <img  class="img_publi-formProf" src="{{URL::asset($objGaleria->imggaleria)}}">
                                </div>

                                <div class="col-12 p-0">
                                    <div class="form-group">
                                        <labe class="col-12 text_label-formProf"> {{$objGaleria->nombrefoto}} </label>
                                    </div>
                                </div>

                                <div class="col-12 p-0">
                                    <div class="form-group">
                                        <labe class="col-12 text_label-formProf"> {{$objGaleria->descripcion}} </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach 
            </div>

            <form method="POST" action="{{ url ('/FormularioProfesionalSave12') }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"> 

                @if($objContadorGaleria->cantidad == 0)
                    <!-- Modulos del contenido GALERIA -->
                    <div class="row content_antDesp-formProf">
                        <!-- Contenido IZQUIERDO -->
                        <div class="col-md-6 photo1 section_inputLeft-text-formProf">
                            <div class="col-12 section_inputLeft-text-formProf content_agregarImg-formProf form-group">
                                <div class="col-10 img_selccionada-formProf">
                                    <div class="img_anexada-formProf">
                                        <img id="uploadPreview17" width="150" height="150"/>
                                    </div>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage17" name="imggaleria[]" onchange="previewImage(17);"/>
                                </div>

                                <labe class="col-12 text_infoImg-formProf"> Tamaño 400 x 400px. Peso máximo 500kb </label> 
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha </label>
                                
                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Título de la imagen </label>

                                    <input class="form-control" id="nombrefoto"  type="text" name="nombrefoto[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción </label>
                                    
                                    <input class="form-control" id="descripcion"  type="text" name="descripcion[]" value="">
                                </div>
                            </div>
                        </div>

                        <!-- Contenido DERECHO -->
                        <div class="col-md-6 photo2 section_inputRight-text-formProf">
                            <div class="col-12 content_agregarImg-formProf form-group">
                                <div class="col-10 img_selccionada-formProf">
                                    <div class="img_anexada-formProf">
                                        <img id="uploadPreview18" width="150" height="150"/>
                                    </div>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage18" name="imggaleria[]" onchange="previewImage(18);"/>
                                </div>

                                <labe class="col-12 text_infoImg-formProf"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha </label>
                                
                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Título de la imagen </label>

                                    <input class="form-control" id="nombrepremio"  type="text" name="nombrefoto[]" value="">
                                </div>
                            </div>
                            
                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción </label>

                                    <input class="form-control" id="nombrepremio"  type="text" name="descripcion[]" value="">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modulos del contenido GALERIA -->
                    <div class="row content_antDesp-formProf hidden-section-formProf">
                        <!-- Contenido IZQUIERDO -->
                        <div class="col-md-6 photo1 section_inputLeft-text-formProf">
                            <div class="col-12 section_inputLeft-text-formProf content_agregarImg-formProf form-group">
                                <div class="col-10 img_selccionada-formProf">
                                    <div class="img_anexada-formProf">
                                        <img id="uploadPreview19" width="150" height="150"/>
                                    </div>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage19" name="imggaleria[]" onchange="previewImage(19);"/>
                                </div>

                                <labe class="col-12 text_infoImg-formProf"> Tamaño 400 x 400px. Peso máximo 500kb </label> 
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha </label>
                                
                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Título de la imagen </label>

                                    <input class="form-control" id="nombrefoto"  type="text" name="nombrefoto[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción </label>
                                    
                                    <input class="form-control" id="descripcion"  type="text" name="descripcion[]" value="">
                                </div>
                            </div>
                        </div>

                        <!-- Contenido DERECHO -->
                        <div class="col-md-6 photo2 section_inputRight-text-formProf">
                            <div class="col-12 content_agregarImg-formProf form-group">
                                <div class="col-10 img_selccionada-formProf">
                                    <div class="img_anexada-formProf">
                                        <img id="uploadPreview20" width="150" height="150"/>
                                    </div>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage20" name="imggaleria[]" onchange="previewImage(20);"/>
                                </div>

                                <labe class="col-12 text_infoImg-formProf"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha </label>
                                
                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Título de la imagen </label>

                                    <input class="form-control" id="nombrepremio"  type="text" name="nombrefoto[]" value="">
                                </div>
                            </div>
                            
                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción </label>

                                    <input class="form-control" id="nombrepremio"  type="text" name="descripcion[]" value="">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modulos del contenido GALERIA -->
                    <div class="row content_antDesp-formProf hidden-section-formProf">
                        <!-- Contenido IZQUIERDO -->
                        <div class="col-md-6 photo1 section_inputLeft-text-formProf">
                            <div class="col-12 section_inputLeft-text-formProf content_agregarImg-formProf form-group">
                                <div class="col-10 img_selccionada-formProf">
                                    <div class="img_anexada-formProf">
                                        <img id="uploadPreview21" width="150" height="150"/>
                                    </div>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage21" name="imggaleria[]" onchange="previewImage(21);"/>
                                </div>

                                <labe class="col-12 text_infoImg-formProf"> Tamaño 400 x 400px. Peso máximo 500kb </label> 
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha </label>
                                
                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Título de la imagen </label>

                                    <input class="form-control" id="nombrefoto"  type="text" name="nombrefoto[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción </label>
                                    
                                    <input class="form-control" id="descripcion"  type="text" name="descripcion[]" value="">
                                </div>
                            </div>
                        </div>

                        <!-- Contenido DERECHO -->
                        <div class="col-md-6 photo2 section_inputRight-text-formProf">
                            <div class="col-12 content_agregarImg-formProf form-group">
                                <div class="col-10 img_selccionada-formProf">
                                    <div class="img_anexada-formProf">
                                        <img id="uploadPreview22" width="150" height="150"/>
                                    </div>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage22" name="imggaleria[]" onchange="previewImage(22);"/>
                                </div>

                                <labe class="col-12 text_infoImg-formProf"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha </label>
                                
                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Título de la imagen </label>

                                    <input class="form-control" id="nombrepremio"  type="text" name="nombrefoto[]" value="">
                                </div>
                            </div>
                            
                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción </label>

                                    <input class="form-control" id="nombrepremio"  type="text" name="descripcion[]" value="">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modulos del contenido GALERIA -->
                    <div class="row content_antDesp-formProf hidden-section-formProf">
                        <!-- Contenido IZQUIERDO -->
                        <div class="col-md-6 photo1 section_inputLeft-text-formProf">
                            <div class="col-12 section_inputLeft-text-formProf content_agregarImg-formProf form-group">
                                <div class="col-10 img_selccionada-formProf">
                                    <div class="img_anexada-formProf">
                                        <img id="uploadPreview23" width="150" height="150"/>
                                    </div>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage23" name="imggaleria[]" onchange="previewImage(23);"/>
                                </div>

                                <labe class="col-12 text_infoImg-formProf"> Tamaño 400 x 400px. Peso máximo 500kb </label> 
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha </label>
                                
                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Título de la imagen </label>

                                    <input class="form-control" id="nombrefoto"  type="text" name="nombrefoto[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción </label>
                                    
                                    <input class="form-control" id="descripcion"  type="text" name="descripcion[]" value="">
                                </div>
                            </div>
                        </div>

                        <!-- Contenido DERECHO -->
                        <div class="col-md-6 photo2 section_inputRight-text-formProf">
                            <div class="col-12 content_agregarImg-formProf form-group">
                                <div class="col-10 img_selccionada-formProf">
                                    <div class="img_anexada-formProf">
                                        <img id="uploadPreview24" width="150" height="150"/>
                                    </div>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage24" name="imggaleria[]" onchange="previewImage(24);"/>
                                </div>

                                <labe class="col-12 text_infoImg-formProf"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha </label>
                                
                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Título de la imagen </label>

                                    <input class="form-control" id="nombrepremio"  type="text" name="nombrefoto[]" value="">
                                </div>
                            </div>
                            
                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción </label>

                                    <input class="form-control" id="nombrepremio"  type="text" name="descripcion[]" value="">
                                </div>
                            </div>
                        </div>
                    </div>

                @elseif($objContadorGaleria->cantidad == 1)
                    <!-- Modulos del contenido GALERIA -->
                    <div class="row content_antDesp-formProf hidden-section-formProf">
                        <!-- Contenido DERECHO -->
                        <div class="col-md-6 photo2 section_inputRight-text-formProf">
                            <div class="col-12 content_agregarImg-formProf form-group">
                                <div class="col-10 img_selccionada-formProf">
                                    <div class="img_anexada-formProf">
                                        <img id="uploadPreview18" width="150" height="150"/>
                                    </div>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage18" name="imggaleria[]" onchange="previewImage(18);"/>
                                </div>

                                <labe class="col-12 text_infoImg-formProf"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha </label>
                                
                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Título de la imagen </label>

                                    <input class="form-control" id="nombrepremio"  type="text" name="nombrefoto[]" value="">
                                </div>
                            </div>
                            
                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción </label>

                                    <input class="form-control" id="nombrepremio"  type="text" name="descripcion[]" value="">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modulos del contenido GALERIA -->
                    <div class="row content_antDesp-formProf">
                        <!-- Contenido IZQUIERDO -->
                        <div class="col-md-6 photo1 section_inputLeft-text-formProf">
                            <div class="col-12 section_inputLeft-text-formProf content_agregarImg-formProf form-group">
                                <div class="col-10 img_selccionada-formProf">
                                    <div class="img_anexada-formProf">
                                        <img id="uploadPreview19" width="150" height="150"/>
                                    </div>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage19" name="imggaleria[]" onchange="previewImage(19);"/>
                                </div>

                                <labe class="col-12 text_infoImg-formProf"> Tamaño 400 x 400px. Peso máximo 500kb </label> 
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha </label>
                                
                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Título de la imagen </label>

                                    <input class="form-control" id="nombrefoto"  type="text" name="nombrefoto[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción </label>
                                    
                                    <input class="form-control" id="descripcion"  type="text" name="descripcion[]" value="">
                                </div>
                            </div>
                        </div>

                        <!-- Contenido DERECHO -->
                        <div class="col-md-6 photo2 section_inputRight-text-formProf">
                            <div class="col-12 content_agregarImg-formProf form-group">
                                <div class="col-10 img_selccionada-formProf">
                                    <div class="img_anexada-formProf">
                                        <img id="uploadPreview20" width="150" height="150"/>
                                    </div>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage20" name="imggaleria[]" onchange="previewImage(20);"/>
                                </div>

                                <labe class="col-12 text_infoImg-formProf"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha </label>
                                
                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Título de la imagen </label>

                                    <input class="form-control" id="nombrepremio"  type="text" name="nombrefoto[]" value="">
                                </div>
                            </div>
                            
                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción </label>

                                    <input class="form-control" id="nombrepremio"  type="text" name="descripcion[]" value="">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modulos del contenido GALERIA -->
                    <div class="row content_antDesp-formProf hidden-section-formProf">
                        <!-- Contenido IZQUIERDO -->
                        <div class="col-md-6 photo1 section_inputLeft-text-formProf">
                            <div class="col-12 section_inputLeft-text-formProf content_agregarImg-formProf form-group">
                                <div class="col-10 img_selccionada-formProf">
                                    <div class="img_anexada-formProf">
                                        <img id="uploadPreview21" width="150" height="150"/>
                                    </div>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage21" name="imggaleria[]" onchange="previewImage(21);"/>
                                </div>

                                <labe class="col-12 text_infoImg-formProf"> Tamaño 400 x 400px. Peso máximo 500kb </label> 
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha </label>
                                
                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Título de la imagen </label>

                                    <input class="form-control" id="nombrefoto"  type="text" name="nombrefoto[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción </label>
                                    
                                    <input class="form-control" id="descripcion"  type="text" name="descripcion[]" value="">
                                </div>
                            </div>
                        </div>

                        <!-- Contenido DERECHO -->
                        <div class="col-md-6 photo2 section_inputRight-text-formProf">
                            <div class="col-12 content_agregarImg-formProf form-group">
                                <div class="col-10 img_selccionada-formProf">
                                    <div class="img_anexada-formProf">
                                        <img id="uploadPreview22" width="150" height="150"/>
                                    </div>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage22" name="imggaleria[]" onchange="previewImage(22);"/>
                                </div>

                                <labe class="col-12 text_infoImg-formProf"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha </label>
                                
                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Título de la imagen </label>

                                    <input class="form-control" id="nombrepremio"  type="text" name="nombrefoto[]" value="">
                                </div>
                            </div>
                            
                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción </label>

                                    <input class="form-control" id="nombrepremio"  type="text" name="descripcion[]" value="">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modulos del contenido GALERIA -->
                    <div class="row content_antDesp-formProf hidden-section-formProf">
                        <!-- Contenido IZQUIERDO -->
                        <div class="col-md-6 photo1 section_inputLeft-text-formProf">
                            <div class="col-12 section_inputLeft-text-formProf content_agregarImg-formProf form-group">
                                <div class="col-10 img_selccionada-formProf">
                                    <div class="img_anexada-formProf">
                                        <img id="uploadPreview23" width="150" height="150"/>
                                    </div>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage23" name="imggaleria[]" onchange="previewImage(23);"/>
                                </div>

                                <labe class="col-12 text_infoImg-formProf"> Tamaño 400 x 400px. Peso máximo 500kb </label> 
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha </label>
                                
                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Título de la imagen </label>

                                    <input class="form-control" id="nombrefoto"  type="text" name="nombrefoto[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción </label>
                                    
                                    <input class="form-control" id="descripcion"  type="text" name="descripcion[]" value="">
                                </div>
                            </div>
                        </div>

                        <!-- Contenido DERECHO -->
                        <div class="col-md-6 photo2 section_inputRight-text-formProf">
                            <div class="col-12 content_agregarImg-formProf form-group">
                                <div class="col-10 img_selccionada-formProf">
                                    <div class="img_anexada-formProf">
                                        <img id="uploadPreview24" width="150" height="150"/>
                                    </div>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage24" name="imggaleria[]" onchange="previewImage(24);"/>
                                </div>

                                <labe class="col-12 text_infoImg-formProf"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha </label>
                                
                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Título de la imagen </label>

                                    <input class="form-control" id="nombrepremio"  type="text" name="nombrefoto[]" value="">
                                </div>
                            </div>
                            
                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción </label>

                                    <input class="form-control" id="nombrepremio"  type="text" name="descripcion[]" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif($objContadorGaleria->cantidad == 2)
                    <!-- Modulos del contenido GALERIA -->
                    <div class="row content_antDesp-formProf">
                        <!-- Contenido IZQUIERDO -->
                        <div class="col-md-6 photo1 section_inputLeft-text-formProf">
                            <div class="col-12 section_inputLeft-text-formProf content_agregarImg-formProf form-group">
                                <div class="col-10 img_selccionada-formProf">
                                    <div class="img_anexada-formProf">
                                        <img id="uploadPreview19" width="150" height="150"/>
                                    </div>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage19" name="imggaleria[]" onchange="previewImage(19);"/>
                                </div>

                                <labe class="col-12 text_infoImg-formProf"> Tamaño 400 x 400px. Peso máximo 500kb </label> 
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha </label>
                                
                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Título de la imagen </label>

                                    <input class="form-control" id="nombrefoto"  type="text" name="nombrefoto[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción </label>
                                    
                                    <input class="form-control" id="descripcion"  type="text" name="descripcion[]" value="">
                                </div>
                            </div>
                        </div>

                        <!-- Contenido DERECHO -->
                        <div class="col-md-6 photo2 section_inputRight-text-formProf">
                            <div class="col-12 content_agregarImg-formProf form-group">
                                <div class="col-10 img_selccionada-formProf">
                                    <div class="img_anexada-formProf">
                                        <img id="uploadPreview20" width="150" height="150"/>
                                    </div>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage20" name="imggaleria[]" onchange="previewImage(20);"/>
                                </div>

                                <labe class="col-12 text_infoImg-formProf"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha </label>
                                
                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Título de la imagen </label>

                                    <input class="form-control" id="nombrepremio"  type="text" name="nombrefoto[]" value="">
                                </div>
                            </div>
                            
                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción </label>

                                    <input class="form-control" id="nombrepremio"  type="text" name="descripcion[]" value="">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modulos del contenido GALERIA -->
                    <div class="row content_antDesp-formProf hidden-section-formProf">
                        <!-- Contenido IZQUIERDO -->
                        <div class="col-md-6 photo1 section_inputLeft-text-formProf">
                            <div class="col-12 section_inputLeft-text-formProf content_agregarImg-formProf form-group">
                                <div class="col-10 img_selccionada-formProf">
                                    <div class="img_anexada-formProf">
                                        <img id="uploadPreview21" width="150" height="150"/>
                                    </div>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage21" name="imggaleria[]" onchange="previewImage(21);"/>
                                </div>

                                <labe class="col-12 text_infoImg-formProf"> Tamaño 400 x 400px. Peso máximo 500kb </label> 
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha </label>
                                
                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Título de la imagen </label>

                                    <input class="form-control" id="nombrefoto"  type="text" name="nombrefoto[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción </label>
                                    
                                    <input class="form-control" id="descripcion"  type="text" name="descripcion[]" value="">
                                </div>
                            </div>
                        </div>

                        <!-- Contenido DERECHO -->
                        <div class="col-md-6 photo2 section_inputRight-text-formProf">
                            <div class="col-12 content_agregarImg-formProf form-group">
                                <div class="col-10 img_selccionada-formProf">
                                    <div class="img_anexada-formProf">
                                        <img id="uploadPreview22" width="150" height="150"/>
                                    </div>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage22" name="imggaleria[]" onchange="previewImage(22);"/>
                                </div>

                                <labe class="col-12 text_infoImg-formProf"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha </label>
                                
                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Título de la imagen </label>

                                    <input class="form-control" id="nombrepremio"  type="text" name="nombrefoto[]" value="">
                                </div>
                            </div>
                            
                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción </label>

                                    <input class="form-control" id="nombrepremio"  type="text" name="descripcion[]" value="">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modulos del contenido GALERIA -->
                    <div class="row content_antDesp-formProf hidden-section-formProf">
                        <!-- Contenido IZQUIERDO -->
                        <div class="col-md-6 photo1 section_inputLeft-text-formProf">
                            <div class="col-12 section_inputLeft-text-formProf content_agregarImg-formProf form-group">
                                <div class="col-10 img_selccionada-formProf">
                                    <div class="img_anexada-formProf">
                                        <img id="uploadPreview23" width="150" height="150"/>
                                    </div>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage23" name="imggaleria[]" onchange="previewImage(23);"/>
                                </div>

                                <labe class="col-12 text_infoImg-formProf"> Tamaño 400 x 400px. Peso máximo 500kb </label> 
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha </label>
                                
                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Título de la imagen </label>

                                    <input class="form-control" id="nombrefoto"  type="text" name="nombrefoto[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción </label>
                                    
                                    <input class="form-control" id="descripcion"  type="text" name="descripcion[]" value="">
                                </div>
                            </div>
                        </div>

                        <!-- Contenido DERECHO -->
                        <div class="col-md-6 photo2 section_inputRight-text-formProf">
                            <div class="col-12 content_agregarImg-formProf form-group">
                                <div class="col-10 img_selccionada-formProf">
                                    <div class="img_anexada-formProf">
                                        <img id="uploadPreview24" width="150" height="150"/>
                                    </div>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage24" name="imggaleria[]" onchange="previewImage(24);"/>
                                </div>

                                <labe class="col-12 text_infoImg-formProf"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha </label>
                                
                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Título de la imagen </label>

                                    <input class="form-control" id="nombrepremio"  type="text" name="nombrefoto[]" value="">
                                </div>
                            </div>
                            
                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción </label>

                                    <input class="form-control" id="nombrepremio"  type="text" name="descripcion[]" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif($objContadorGaleria->cantidad == 3)
                    <!-- Modulos del contenido GALERIA -->
                    <div class="row content_antDesp-formProf hidden-section-formProf">
                        <!-- Contenido DERECHO -->
                        <div class="col-md-6 photo2 section_inputRight-text-formProf">
                            <div class="col-12 content_agregarImg-formProf form-group">
                                <div class="col-10 img_selccionada-formProf">
                                    <div class="img_anexada-formProf">
                                        <img id="uploadPreview20" width="150" height="150"/>
                                    </div>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage20" name="imggaleria[]" onchange="previewImage(20);"/>
                                </div>

                                <labe class="col-12 text_infoImg-formProf"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha </label>
                                
                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Título de la imagen </label>

                                    <input class="form-control" id="nombrepremio"  type="text" name="nombrefoto[]" value="">
                                </div>
                            </div>
                            
                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción </label>

                                    <input class="form-control" id="nombrepremio"  type="text" name="descripcion[]" value="">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modulos del contenido GALERIA -->
                    <div class="row content_antDesp-formProf">
                        <!-- Contenido IZQUIERDO -->
                        <div class="col-md-6 photo1 section_inputLeft-text-formProf">
                            <div class="col-12 section_inputLeft-text-formProf content_agregarImg-formProf form-group">
                                <div class="col-10 img_selccionada-formProf">
                                    <div class="img_anexada-formProf">
                                        <img id="uploadPreview21" width="150" height="150"/>
                                    </div>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage21" name="imggaleria[]" onchange="previewImage(21);"/>
                                </div>

                                <labe class="col-12 text_infoImg-formProf"> Tamaño 400 x 400px. Peso máximo 500kb </label> 
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha </label>
                                
                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Título de la imagen </label>

                                    <input class="form-control" id="nombrefoto"  type="text" name="nombrefoto[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción </label>
                                    
                                    <input class="form-control" id="descripcion"  type="text" name="descripcion[]" value="">
                                </div>
                            </div>
                        </div>

                        <!-- Contenido DERECHO -->
                        <div class="col-md-6 photo2 section_inputRight-text-formProf">
                            <div class="col-12 content_agregarImg-formProf form-group">
                                <div class="col-10 img_selccionada-formProf">
                                    <div class="img_anexada-formProf">
                                        <img id="uploadPreview22" width="150" height="150"/>
                                    </div>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage22" name="imggaleria[]" onchange="previewImage(22);"/>
                                </div>

                                <labe class="col-12 text_infoImg-formProf"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha </label>
                                
                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Título de la imagen </label>

                                    <input class="form-control" id="nombrepremio"  type="text" name="nombrefoto[]" value="">
                                </div>
                            </div>
                            
                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción </label>

                                    <input class="form-control" id="nombrepremio"  type="text" name="descripcion[]" value="">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modulos del contenido GALERIA -->
                    <div class="row content_antDesp-formProf hidden-section-formProf">
                        <!-- Contenido IZQUIERDO -->
                        <div class="col-md-6 photo1 section_inputLeft-text-formProf">
                            <div class="col-12 section_inputLeft-text-formProf content_agregarImg-formProf form-group">
                                <div class="col-10 img_selccionada-formProf">
                                    <div class="img_anexada-formProf">
                                        <img id="uploadPreview23" width="150" height="150"/>
                                    </div>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage23" name="imggaleria[]" onchange="previewImage(23);"/>
                                </div>

                                <labe class="col-12 text_infoImg-formProf"> Tamaño 400 x 400px. Peso máximo 500kb </label> 
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha </label>
                                
                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Título de la imagen </label>

                                    <input class="form-control" id="nombrefoto"  type="text" name="nombrefoto[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción </label>
                                    
                                    <input class="form-control" id="descripcion"  type="text" name="descripcion[]" value="">
                                </div>
                            </div>
                        </div>

                        <!-- Contenido DERECHO -->
                        <div class="col-md-6 photo2 section_inputRight-text-formProf">
                            <div class="col-12 content_agregarImg-formProf form-group">
                                <div class="col-10 img_selccionada-formProf">
                                    <div class="img_anexada-formProf">
                                        <img id="uploadPreview24" width="150" height="150"/>
                                    </div>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage24" name="imggaleria[]" onchange="previewImage(24);"/>
                                </div>

                                <labe class="col-12 text_infoImg-formProf"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha </label>
                                
                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Título de la imagen </label>

                                    <input class="form-control" id="nombrepremio"  type="text" name="nombrefoto[]" value="">
                                </div>
                            </div>
                            
                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción </label>

                                    <input class="form-control" id="nombrepremio"  type="text" name="descripcion[]" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif($objContadorGaleria->cantidad == 4)
                    <!-- Modulos del contenido GALERIA -->
                    <div class="row content_antDesp-formProf">
                        <!-- Contenido IZQUIERDO -->
                        <div class="col-md-6 photo1 section_inputLeft-text-formProf">
                            <div class="col-12 section_inputLeft-text-formProf content_agregarImg-formProf form-group">
                                <div class="col-10 img_selccionada-formProf">
                                    <div class="img_anexada-formProf">
                                        <img id="uploadPreview21" width="150" height="150"/>
                                    </div>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage21" name="imggaleria[]" onchange="previewImage(21);"/>
                                </div>

                                <labe class="col-12 text_infoImg-formProf"> Tamaño 400 x 400px. Peso máximo 500kb </label> 
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha </label>
                                
                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Título de la imagen </label>

                                    <input class="form-control" id="nombrefoto"  type="text" name="nombrefoto[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción </label>
                                    
                                    <input class="form-control" id="descripcion"  type="text" name="descripcion[]" value="">
                                </div>
                            </div>
                        </div>

                        <!-- Contenido DERECHO -->
                        <div class="col-md-6 photo2 section_inputRight-text-formProf">
                            <div class="col-12 content_agregarImg-formProf form-group">
                                <div class="col-10 img_selccionada-formProf">
                                    <div class="img_anexada-formProf">
                                        <img id="uploadPreview22" width="150" height="150"/>
                                    </div>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage22" name="imggaleria[]" onchange="previewImage(22);"/>
                                </div>

                                <labe class="col-12 text_infoImg-formProf"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha </label>
                                
                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Título de la imagen </label>

                                    <input class="form-control" id="nombrepremio"  type="text" name="nombrefoto[]" value="">
                                </div>
                            </div>
                            
                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción </label>

                                    <input class="form-control" id="nombrepremio"  type="text" name="descripcion[]" value="">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modulos del contenido GALERIA -->
                    <div class="row content_antDesp-formProf hidden-section-formProf">
                        <!-- Contenido IZQUIERDO -->
                        <div class="col-md-6 photo1 section_inputLeft-text-formProf">
                            <div class="col-12 section_inputLeft-text-formProf content_agregarImg-formProf form-group">
                                <div class="col-10 img_selccionada-formProf">
                                    <div class="img_anexada-formProf">
                                        <img id="uploadPreview23" width="150" height="150"/>
                                    </div>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage23" name="imggaleria[]" onchange="previewImage(23);"/>
                                </div>

                                <labe class="col-12 text_infoImg-formProf"> Tamaño 400 x 400px. Peso máximo 500kb </label> 
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha </label>
                                
                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Título de la imagen </label>

                                    <input class="form-control" id="nombrefoto"  type="text" name="nombrefoto[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción </label>
                                    
                                    <input class="form-control" id="descripcion"  type="text" name="descripcion[]" value="">
                                </div>
                            </div>
                        </div>

                        <!-- Contenido DERECHO -->
                        <div class="col-md-6 photo2 section_inputRight-text-formProf">
                            <div class="col-12 content_agregarImg-formProf form-group">
                                <div class="col-10 img_selccionada-formProf">
                                    <div class="img_anexada-formProf">
                                        <img id="uploadPreview24" width="150" height="150"/>
                                    </div>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage24" name="imggaleria[]" onchange="previewImage(24);"/>
                                </div>

                                <labe class="col-12 text_infoImg-formProf"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha </label>
                                
                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Título de la imagen </label>

                                    <input class="form-control" id="nombrepremio"  type="text" name="nombrefoto[]" value="">
                                </div>
                            </div>
                            
                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción </label>

                                    <input class="form-control" id="nombrepremio"  type="text" name="descripcion[]" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif($objContadorGaleria->cantidad == 5)
                    <!-- Modulos del contenido GALERIA -->
                    <div class="row content_antDesp-formProf hidden-section-formProf">
                        <!-- Contenido DERECHO -->
                        <div class="col-md-6 photo2 section_inputRight-text-formProf">
                            <div class="col-12 content_agregarImg-formProf form-group">
                                <div class="col-10 img_selccionada-formProf">
                                    <div class="img_anexada-formProf">
                                        <img id="uploadPreview22" width="150" height="150"/>
                                    </div>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage22" name="imggaleria[]" onchange="previewImage(22);"/>
                                </div>

                                <labe class="col-12 text_infoImg-formProf"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha </label>
                                
                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Título de la imagen </label>

                                    <input class="form-control" id="nombrepremio"  type="text" name="nombrefoto[]" value="">
                                </div>
                            </div>
                            
                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción </label>

                                    <input class="form-control" id="nombrepremio"  type="text" name="descripcion[]" value="">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modulos del contenido GALERIA -->
                    <div class="row content_antDesp-formProf">
                        <!-- Contenido IZQUIERDO -->
                        <div class="col-md-6 photo1 section_inputLeft-text-formProf">
                            <div class="col-12 section_inputLeft-text-formProf content_agregarImg-formProf form-group">
                                <div class="col-10 img_selccionada-formProf">
                                    <div class="img_anexada-formProf">
                                        <img id="uploadPreview23" width="150" height="150"/>
                                    </div>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage23" name="imggaleria[]" onchange="previewImage(23);"/>
                                </div>

                                <labe class="col-12 text_infoImg-formProf"> Tamaño 400 x 400px. Peso máximo 500kb </label> 
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha </label>
                                
                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Título de la imagen </label>

                                    <input class="form-control" id="nombrefoto"  type="text" name="nombrefoto[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción </label>
                                    
                                    <input class="form-control" id="descripcion"  type="text" name="descripcion[]" value="">
                                </div>
                            </div>
                        </div>

                        <!-- Contenido DERECHO -->
                        <div class="col-md-6 photo2 section_inputRight-text-formProf">
                            <div class="col-12 content_agregarImg-formProf form-group">
                                <div class="col-10 img_selccionada-formProf">
                                    <div class="img_anexada-formProf">
                                        <img id="uploadPreview24" width="150" height="150"/>
                                    </div>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage24" name="imggaleria[]" onchange="previewImage(24);"/>
                                </div>

                                <labe class="col-12 text_infoImg-formProf"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha </label>
                                
                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Título de la imagen </label>

                                    <input class="form-control" id="nombrepremio"  type="text" name="nombrefoto[]" value="">
                                </div>
                            </div>
                            
                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción </label>

                                    <input class="form-control" id="nombrepremio"  type="text" name="descripcion[]" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif($objContadorGaleria->cantidad == 6)
                    <!-- Modulos del contenido GALERIA -->
                    <div class="row content_antDesp-formProf">
                        <!-- Contenido IZQUIERDO -->
                        <div class="col-md-6 photo1 section_inputLeft-text-formProf">
                            <div class="col-12 section_inputLeft-text-formProf content_agregarImg-formProf form-group">
                                <div class="col-10 img_selccionada-formProf">
                                    <div class="img_anexada-formProf">
                                        <img id="uploadPreview23" width="150" height="150"/>
                                    </div>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage23" name="imggaleria[]" onchange="previewImage(23);"/>
                                </div>

                                <labe class="col-12 text_infoImg-formProf"> Tamaño 400 x 400px. Peso máximo 500kb </label> 
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha </label>
                                
                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Título de la imagen </label>

                                    <input class="form-control" id="nombrefoto"  type="text" name="nombrefoto[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción </label>
                                    
                                    <input class="form-control" id="descripcion"  type="text" name="descripcion[]" value="">
                                </div>
                            </div>
                        </div>

                        <!-- Contenido DERECHO -->
                        <div class="col-md-6 photo2 section_inputRight-text-formProf">
                            <div class="col-12 content_agregarImg-formProf form-group">
                                <div class="col-10 img_selccionada-formProf">
                                    <div class="img_anexada-formProf">
                                        <img id="uploadPreview24" width="150" height="150"/>
                                    </div>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage24" name="imggaleria[]" onchange="previewImage(24);"/>
                                </div>

                                <labe class="col-12 text_infoImg-formProf"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha </label>
                                
                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Título de la imagen </label>

                                    <input class="form-control" id="nombrepremio"  type="text" name="nombrefoto[]" value="">
                                </div>
                            </div>
                            
                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción </label>

                                    <input class="form-control" id="nombrepremio"  type="text" name="descripcion[]" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif($objContadorGaleria->cantidad == 7)
                    <!-- Modulos del contenido GALERIA -->
                    <div class="row content_antDesp-formProf">
                        <!-- Contenido DERECHO -->
                        <div class="col-md-6 photo2 section_inputRight-text-formProf">
                            <div class="col-12 content_agregarImg-formProf form-group">
                                <div class="col-10 img_selccionada-formProf">
                                    <div class="img_anexada-formProf">
                                        <img id="uploadPreview24" width="150" height="150"/>
                                    </div>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage24" name="imggaleria[]" onchange="previewImage(24);"/>
                                </div>

                                <labe class="col-12 text_infoImg-formProf"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha </label>
                                
                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Título de la imagen </label>

                                    <input class="form-control" id="nombrepremio"  type="text" name="nombrefoto[]" value="">
                                </div>
                            </div>
                            
                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción </label>

                                    <input class="form-control" id="nombrepremio"  type="text" name="descripcion[]" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif($objContadorGaleria->cantidad == 8)
                    <span> No se puede agregar más </span>
                @endif 

                <div class="col-12 content_btnEnviar-formProf">
                    <button type="submit" class="btn2_enviar-formProf"> Guardar
                        <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flecha_guardar-formProf" alt=""> 
                    </button>
                </div>  
            </form>
        </div>  
        <!--------------------------------------------      Fin 12 doceava parte del formulario *** GALERIA ***      ---------------------------------------------------------->

        <!--------------------------------------------      Inicio 13 treceava parte del formulario *** VIDEOS ***      ------------------------------------------------------->
        <div class="col-lg-10 col-xl-8 pb-3 content_galeria-video infoBasica_formProf">
            <h5 class="col-12 icon_infoVideo-formProf"> Videos </h5>

            <p class="text_superior-proced-formProf"> A continuación suba el link del video, con su respectivo nombre y descripción. </p>

            <!-- Modulos de los VIDEOS -->
            <div class="row col-12 p-0 m-0">
                @foreach($objVideo as $objVideo)
                    @if(!empty($objVideo->nombrevideo))
                        <!-- Contenido VIDEOS -->    
                        <div class="col-md-6 mt-3 content_antes-formProf">
                            <div class="col-12">
                                <a href="{{url('/FormularioProfesionaldelete13/'.$objVideo->id)}}">
                                    <button type="submit" class="close" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </a>
                            </div>
                        

                            <div class="col-12 content_agregarImg-formProf form-group">
                                <div class="col-10 img_selccionada-formProf">
                                    <iframe src="{{$objVideo->urlvideo}}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                </div>

                                <div class="col-12 p-0">
                                    <div class="form-group">
                                        <label for="example-date-input" class="col-12 text_label-formProf"> {{$objVideo->nombrevideo}} </label>
                                    </div>
                                </div>

                                <div class="col-12 p-0">
                                    <div class="form-group">
                                        <label for="example-date-input" class="col-12 text_label-formProf"> {{$objVideo->descripcionvideo}} </label>
                                    </div>
                                </div>

                                <div class="col-12 p-0">
                                    <div class="form-group">
                                        <label for="example-date-input" class="col-12 text_label-formProf"> {{$objVideo->fechavideo}} </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach 
            </div>

            <form method="POST" action="{{ url ('/FormularioProfesionalSave13') }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                @if($objContadorVideo->cantidad == 0)
                    <!-- Modulos de los VIDEOS -->
                    <div class="row content_antDesp-formProf">
                        <!-- Contenido IZQUIERDO -->
                        <div class="col-md-6 video1 section_inputLeft-text-formProf">
                            <div class="col-12 section_inputLeft-text-formProf content_agregarImg-formProf form-group">
                                <div class="agregar_archivo-formProf">
                                    <input id="nombrefoto"  type="file" name="urlvideo[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha </label>
                                
                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Título Video </label>

                                    <input class="form-control" id="nombrefoto"  type="text" name="nombrefoto[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción Video </label>
                                    
                                    <input class="form-control" id="descripcion"  type="text" name="descripcion[]" value="">
                                </div>
                            </div>
                        </div>

                        <!-- Contenido DERECHO -->
                        <div class="col-md-6 video2 section_inputRight-text-formProf">
                            <div class="col-12 content_agregarImg-formProf form-group">
                                <div class="agregar_archivo-formProf">
                                    <input id="nombrefoto"  type="file" name="urlvideo[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha </label>
                                
                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Título Video </label>

                                    <input class="form-control" id="nombrepremio"  type="text" name="nombrefoto[]" value="">
                                </div>
                            </div>
                            
                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción Video </label>

                                    <input class="form-control" id="nombrepremio"  type="text" name="descripcion[]" value="">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modulos de los VIDEOS -->
                    <div class="row content_antDesp-formProf hidden-section-formProf">
                        <!-- Contenido IZQUIERDO -->
                        <div class="col-md-6 video1 section_inputLeft-text-formProf">
                            <div class="col-12 section_inputLeft-text-formProf content_agregarImg-formProf form-group">
                                <div class="agregar_archivo-formProf">
                                    <input id="nombrefoto"  type="file" name="urlvideo[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha </label>
                                
                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Título Video </label>

                                    <input class="form-control" id="nombrefoto"  type="text" name="nombrefoto[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción Video </label>
                                    
                                    <input class="form-control" id="descripcion"  type="text" name="descripcion[]" value="">
                                </div>
                            </div>
                        </div>

                        <!-- Contenido DERECHO -->
                        <div class="col-md-6 video2 section_inputRight-text-formProf">
                            <div class="col-12 content_agregarImg-formProf form-group">
                                <div class="agregar_archivo-formProf">
                                    <input id="nombrefoto"  type="file" name="urlvideo[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha </label>
                                
                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Título Video </label>

                                    <input class="form-control" id="nombrepremio"  type="text" name="nombrefoto[]" value="">
                                </div>
                            </div>
                            
                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción Video </label>

                                    <input class="form-control" id="nombrepremio"  type="text" name="descripcion[]" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif($objContadorVideo->cantidad == 1)
                    <!-- Modulos de los VIDEOS -->
                    <div class="row content_antDesp-formProf">
                        <!-- Contenido IZQUIERDO -->
                        <div class="col-md-6 video1 section_inputLeft-text-formProf">
                            <div class="col-12 section_inputLeft-text-formProf content_agregarImg-formProf form-group">
                                <div class="agregar_archivo-formProf">
                                    <input id="nombrefoto"  type="file" name="urlvideo[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha </label>
                                
                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Título Video </label>

                                    <input class="form-control" id="nombrefoto"  type="text" name="nombrefoto[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción Video </label>
                                    
                                    <input class="form-control" id="descripcion"  type="text" name="descripcion[]" value="">
                                </div>
                            </div>
                        </div>

                        <!-- Contenido DERECHO -->
                        <div class="col-md-6 video2 section_inputRight-text-formProf">
                            <div class="col-12 content_agregarImg-formProf form-group">
                                <div class="agregar_archivo-formProf">
                                    <input id="nombrefoto"  type="file" name="urlvideo[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha </label>
                                
                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Título Video </label>

                                    <input class="form-control" id="nombrepremio"  type="text" name="nombrefoto[]" value="">
                                </div>
                            </div>
                            
                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción Video </label>

                                    <input class="form-control" id="nombrepremio"  type="text" name="descripcion[]" value="">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modulos de los contenidos ANTES y DESPUÉS -->
                    <div class="row content_antDesp-formProf">
                        <!-- Contenido IZQUIERDO -->
                        <div class="col-md-6 video1 section_inputLeft-text-formProf">
                            <div class="col-12 section_inputLeft-text-formProf content_agregarImg-formProf form-group">
                                <div class="agregar_archivo-formProf">
                                    <input id="nombrefoto"  type="file" name="urlvideo[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha </label>
                                
                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Título Video </label>

                                    <input class="form-control" id="nombrefoto"  type="text" name="nombrefoto[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción Video </label>
                                    
                                    <input class="form-control" id="descripcion"  type="text" name="descripcion[]" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif($objContadorVideo->cantidad == 2)
                    <!-- Modulos de los VIDEOS -->
                    <div class="row content_antDesp-formProf">
                        <!-- Contenido IZQUIERDO -->
                        <div class="col-md-6 video1 section_inputLeft-text-formProf">
                            <div class="col-12 section_inputLeft-text-formProf content_agregarImg-formProf form-group">
                                <div class="agregar_archivo-formProf">
                                    <input id="nombrefoto"  type="file" name="urlvideo[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha </label>
                                
                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Título Video </label>

                                    <input class="form-control" id="nombrefoto"  type="text" name="nombrefoto[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción Video </label>
                                    
                                    <input class="form-control" id="descripcion"  type="text" name="descripcion[]" value="">
                                </div>
                            </div>
                        </div>

                        <!-- Contenido DERECHO -->
                        <div class="col-md-6 video2 section_inputRight-text-formProf">
                            <div class="col-12 content_agregarImg-formProf form-group">
                                <div class="agregar_archivo-formProf">
                                    <input id="nombrefoto"  type="file" name="urlvideo[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha </label>
                                
                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Título Video </label>

                                    <input class="form-control" id="nombrepremio"  type="text" name="nombrefoto[]" value="">
                                </div>
                            </div>
                            
                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción Video </label>

                                    <input class="form-control" id="nombrepremio"  type="text" name="descripcion[]" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif($objContadorVideo->cantidad == 3)
                    <!-- Modulos de los VIDEOS -->
                    <div class="row content_antDesp-formProf">
                        <!-- Contenido IZQUIERDO -->
                        <div class="col-md-6 video1 section_inputLeft-text-formProf">
                            <div class="col-12 section_inputLeft-text-formProf content_agregarImg-formProf form-group">
                                <div class="agregar_archivo-formProf">
                                    <input id="nombrefoto"  type="file" name="urlvideo[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha </label>
                                
                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Título Video </label>

                                    <input class="form-control" id="nombrefoto"  type="text" name="nombrefoto[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción Video </label>
                                    
                                    <input class="form-control" id="descripcion"  type="text" name="descripcion[]" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif($objContadorVideo->cantidad == 4)
                    <span> No se pueden agregar más </span>
                @endif 

                <div class="col-12 content_btnEnviar-formProf">
                    <button type="submit" class="btn2_enviar-formProf"> Guardar
                        <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flecha_guardar-formProf" alt=""> 
                    </button>
                </div>
            </form>
        </div>
        <!--------------------------------------------      Fin 13 treceava parte del formulario *** VIDEOS ***      ---------------------------------------------------------->

        <!-- Secciones de los botones anterior y siguiente -->
        <div class="col-lg-10 col-xl-8 content_botonesInferiores-formProf">
            <div class="col-md-3 content_btn-anter">
                <button type="submit" class="boton_inferior-anterior-formProf" onclick="btnHidePrevious(this)" code-position="galleryFormProf">
                    <img src="{{URL::asset('/img/formulario-profesional/icono-flecha-gris.svg')}}" class="flechaBtn_guardar-formInst" alt=""> 
                    Anterior
                </button>
            </div>

            <div class="col-md-3 content_btn-siguient">
                <a type="submit" class="boton_inferior-finalizar-formProf" href="{{ route('contacto') }}"> Finalizar
                    <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flechaBtn_finalizar-formProf" alt=""> 
                </a>
            </div>
        </div>
    </div>

@endsection