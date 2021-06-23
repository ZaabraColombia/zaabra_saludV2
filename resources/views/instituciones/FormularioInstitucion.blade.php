@extends('layouts.app')

@section('content')
    <!--     Sección lista de opciones     -->
    <ol  class="lista_opciones-usuario-formInst">
        <div class="content_icons-formInst"> <!-- clase "content_icons-formInst" para evento ocultar y mostrar contenido de la opción. Ubicado en el archivo formularios.js -->
            <li class="iconVerde_datoInst dato_institution" onclick="hideContaintOption(this)" data-position="dateInstitution"> <!-- clase "dato_institution" para activar el evento on click de la opción. Ubicado en el archivo formulario.js  -->
                <p class="text_opcion-formInst" > Datos institucionales </p>
            </li>
        </div>

        <div class="content_icons-formInst">
            <li class="iconGris_servProfesional serv_profesional" onclick="hideContaintOption(this)" data-position="professionalServices">
                <p class="text_opcion-formInst" > Servicios profesionales </p>
            </li>
        </div>

        <div class="content_icons-formInst">
            <li class="iconGris_acercaInst acerca_institution" onclick="hideContaintOption(this)" data-position="aboutInstitution">
                <p class="text_opcion-formInst" > Acerca de la institución </p>
            </li>
        </div>

        <div class="content_icons-formInst">
            <li class="iconGris_profesionalInst profesional_institution" onclick="hideContaintOption(this)" data-position="professionalInst">
                <p class="text_opcion-formInst" > Profesionales </p>
            </li>
        </div>

        <div class="content_icons-formInst">
            <li class="iconGris_certifInst certificado_institution" onclick="hideContaintOption(this)" data-position="certificationsInst">
                <p class="text_opcion-formInst" > Certificaciones </p>
            </li>
        </div>

        <div class="content_icons-formInst">
            <li class="iconGris_sedeInst sede_institution" onclick="hideContaintOption(this)" data-position="venuesInst">
                <p class="text_opcion-formInst" > Sedes </p>
            </li>
        </div>

        <div class="content_icons-formInst">
            <li class="iconGris_galeInst galeria_institution" onclick="hideContaintOption(this)" data-position="galleryInst">
                <p class="text_opcion-formInst" > Galería </p>
            </li>
        </div>
    </ol> 

    <!-- 1* Contenedor principal de la opción DATOS INSTITUCIONALES -->
    <div class="container-fluid date_institution content_principal-formInst"> <!-- Clase "date_institution" creada para ocultar y mostrar elementos desde la función on click en el archivo formularios.js  -->
        <!-- Titulo y texto superior -->
        <div class="col-lg-10 col-xl-8 content_textPrincipal-formInst">
            <h5 class="titulo_principal-formInst"> LE DAMOS LA BIENVENIDA A ZAABRA SALUD </h5>

            <p class="texto_superior-formInst"> Ingrese los datos según corresponda y finalice el proceso completamente en línea. </p>
        </div>

        <!--------------------------------------------      Inicio 1 primera parte del formulario *** INFORMACIÓN BÁSICA ***      --------------------------------------------->
        <div class="col-lg-10 col-xl-8 content_tarjetasInfo-formInst">
            <h5 class="col-12 icon_infoBasica-formInst"> Información básica </h5> 

            <form method="POST" action="{{ url ('/FormularioInstitucionSave') }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"> 

                @if(!empty($objFormulario))
                    <!---------------valida que ya exista informacion y la muestra en caso contrario muestra un formulario vacio---------------------> 
                    <div class="row fila_infoBasica-formInst">
                        <!-- Sección logo datos institución --> 
                        <div class="col-md-3 contain_imgUsuario-formImg">
                            @foreach($objFormulario as $objFormulario)
                                <img id="imagenPrevisualizacion" class="img_usuario-formInst" src="{{URL::asset($objFormulario->logo)}}">
                            @endforeach 

                            <input type="file" class="input_imgUsuario-formInst" name="logoInstitucion"  id="seleccionArchivos" accept="image/png, image/jpeg">

                            <label class="col-12 icon_subirFoto-formInst text_usuario-formInst"> Subir foto de logo </label>
                        </div>

                        <!-- Sección datos institución -->
                        <div class="col-md-4 datos_principales-formInst"> 
                            @foreach ($objuser as $objuser)
                                <div class="col-12 section_inputRight-text-formInst">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Nombres Institucion</label>

                                    <input class="col-12 input_nomApl-formInst" value="{{$objuser->nombreinstitucion}}" readonly></input>
                                </div>
                            @endforeach  
        
                            <div class="col-12 section_inputRight-text-formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst">  Fecha  </label>

                                <input class="col-12 form-control" type="date" value="{{$objFormulario->fechainicio}}" id="example-date-input" name="fechainicio">
                            </div>

                            <div class="col-12 section_inputRight-text-formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Pagina web </label>

                                <input class="col-12 form-control" id="url" placeholder="nombre" type="text" name="url" value="{{$objFormulario->url}}">
                            </div>

                            <div class="col-12 section_inputRight-text-formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Selecione entidad </label> 

                                <select class="col-lg-12 form-control" name="idprofesion" id="idprofesion"></select>
                            </div>
                        </div>

                        <!-- Sección imagen datos institución -->
                        <div class="col-md-5 datos_principales2-formInst">  
                            <div class="col-12 contain_imgInst-formInst">       
                                <img class="img_institucion-formInst" id="imagenPrevisualizacion" src="{{URL::asset($objFormulario->imagen)}}">
                    
                                <input type="file" class="input_imgUsuario-formInst" name="imagenInstitucion"  id="seleccionArchivos" accept="image/png, image/jpeg">

                                <label class="col-12 icon_subirFoto-formInst text_usuario-formInst"> Subir foto de la sede </label>
                            </div>
                        </div>
                    </div>
                    <!------------------ Fin campos llenos ---------------------> 

                @else
                    <!--------------- Inicio campos vacios--------------------->  
                    <div class="row fila_infoBasica-formInst">
                        <!-- Sección logo datos institución --> 
                        <div class="col-md-3 contain_imgUsuario-formImg"> 
                            <img id="imagenPrevisualizacion" class="img_usuario-formInst">

                            <input type="file" class="input_imgUsuario-formInst" name="logoInstitucion"  id="seleccionArchivos" accept="image/png, image/jpeg">

                            <label class="col-12 icon_subirFoto-formInst text_usuario-formInst"> Subir foto de logo </label>
                        </div>
                
                        <!-- Sección datos institución -->
                        <div class="col-md-4 datos_principales-formInst">
                            @foreach ($objuser as $objuser)
                            <div class="col-12 section_inputRight-text-formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Nombres Institucion</label>

                                <input class="col-12 input_nomApl-formInst" value="{{$objuser->nombreinstitucion}}" readonly></input>
                            </div>
                            @endforeach
            
                            <div class="col-12 section_inputRight-text-formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>
                                
                                <input class="col-lg-12 form-control" type="date" value="2011-08-19" id="example-date-input" name="fechainicio">
                            </div>

                            <div class="col-12 section_inputRight-text-formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Pagina web </label>

                                <input class="col-lg-12 form-control" id="url" placeholder="nombre" type="text" name="url">
                            </div>
                            
                            <div class="col-12 section_inputRight-text-formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Selecione entidad </label> 

                                <select class="col-lg-12 form-control" name="idprofesion" id="idprofesion"></select>
                            </div>
                        </div>

                        <!-- Sección imagen datos institución -->
                        <div class="col-md-5 datos_principales2-formInst">  
                            <div class="col-12 contain_imgInst-formInst">   
                                <img class="img_institucion-formInst" id="imagenPrevisualizacion">

                                <input class="input_imgUsuario-formInst" type="file" name="imagenInstitucion"  id="seleccionArchivos" accept="image/png, image/jpeg">

                                <label class="col-12 icon_subirFoto-formInst text_usuario-formInst"> Subir foto de la sede </label>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="col-lg-3 content_btnEnviar-formInst">
                    <button type="submit" class="btn_guardar-formInst"> Guardar
                        <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flechaBtn_guardar-formInst" alt=""> 
                    </button>
                </div>
                <!--------------- Fin campos vacios--------------------->  
            </form>
        </div>
        <!--------------------------------------------      Fin 1 primera parte del formulario *** INFORMACIÓN BÁSICA ***      ------------------------------------------------>

        <!--------------------------------------------      Inicio 2 segunda parte del formulario *** INFORMACIÓN CONTACTO ***      ------------------------------------------->
        <div class="col-lg-10 col-xl-8 content_tarjetasInfo-formInst">
            <form method="POST" action="{{ url ('/FormularioInstitucionSave2') }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"> 

                <h5 class="col-12 icon_infoContac-formInst"> Información de contacto </h5>

                <div class="row fila_infoBasica-formInst">
                    @if(!empty($objFormulario->telefonouno))
                        <div class="col-md-6 section_inputLeft-text-formInst">
                            <div class="form-group">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Celular </label>

                                <input class="col-12 form-control" id="tarjeta" placeholder="N. Celular" type="number" name="telefonouno" value="{{$objFormulario->telefonouno}}">
                            </div>
                        </div>

                        <div class="col-md-6 section_inputRight-text-formInst">
                            <div class="form-group">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Teléfono fijo </label>

                                <input class="col-12 form-control" id="telefono" placeholder="N. Telefono" type="number" name="telefono2" value="{{$objFormulario->telefono2}}">
                            </div>
                        </div>
                        
                        <div class="col-md-6 section_inputLeft-text-formInst">
                            <div class="form-group">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Dirección </label>
                                
                                <input class="col-12 form-control" id="direccion" placeholder="N. direccion" type="text" name="direccion" value="{{$objFormulario->direccion}}">
                            </div>
                        </div>

                        <!--menu dinamico ciudades -->
                        <div class="col-md-6 section_inputRight-text-formInst">
                            <label for="example-date-input" class="col-12 text_label-formInst"> Selecione país </label>

                            <select id="idpais" name="idpais" class="col-12 form-control">
                                <option value="" selected disabled>Seleccione pais</option>

                                @foreach($pais as $pais)
                                    <option value="{{$pais->id_pais}}"> {{$pais->nombre}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 section_inputLeft-text-formInst">
                            <label for="example-date-input" class="col-12 text_label-formInst"> Selecione departamento </label>

                            <select name="id_departamento" id="id_departamento" class="col-12 form-control"></select>
                        </div>
                    
                        <div class="col-md-6 section_inputRight-text-formInst">
                            <label for="example-date-input" class="col-12 text_label-formInst"> Seleccione provincia </label>

                            <select name="id_provincia" id="id_provincia" class="col-12 form-control"></select>
                        </div>

                        <div class="col-md-6 section_inputLeft-text-formInst">
                            <label for="example-date-input" class="col-12 text_label-formInst"> Seleccione ciudad </label>

                            <select name="id_municipio" id="id_municipio" class="col-12 form-control"></select>
                        </div>

                        <!-- Botón guardar información -->
                        <div class="col-12 mt-3 content_btnEnviar-formInst">
                            <button type="submit" class="btn2_enviar-formInst"> Guardar
                                <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flechaBtn_guardar-formInst" alt=""> 
                            </button>
                        </div>
                        
                    @else
                        <div class="col-md-6 section_inputLeft-text-formInst">
                            <div class="form-group">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Celular </label>
                                
                                <input class="col-12 form-control" id="tarjeta" placeholder="N. Celular" type="number" name="telefonouno" >
                            </div>
                        </div>

                        <div class="col-md-6 section_inputRight-text-formInst">
                            <div class="form-group">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Teléfono fijo </label>

                                <input class="col-12 form-control" id="telefono" placeholder="N. Telefono" type="number" name="telefono2" >
                            </div>
                        </div>

                        <div class="col-md-6 section_inputLeft-text-formInst">
                            <div class="form-group">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Dirección </label>

                                <input class="col-12 form-control" id="direccion" placeholder="N. direccion" type="text" name="direccion" >
                            </div>
                        </div>

                        <!--menu dinamico ciudades -->
                        <div class="col-md-6 section_inputRight-text-formInst">
                            <label for="example-date-input" class="col-12 text_label-formInst"> Seleccione país </label>

                            <select id="idpais" name="idpais" class="form-control">
                                <option value="" selected disabled>Seleccione pais</option>

                                @foreach($pais as $pais)
                                    <option value="{{$pais->id_pais}}"> {{$pais->nombre}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 section_inputLeft-text-formInst">
                            <label for="example-date-input" class="col-12 text_label-formInst"> Selecione departamento </label>

                            <select name="id_departamento" id="id_departamento" class="form-control"></select>
                        </div>
                
                        <div class="col-md-6 section_inputRight-text-formInst">
                            <label for="example-date-input" class="col-12 text_label-formInst"> Seleccione provincia </label>

                            <select name="id_provincia" id="id_provincia" class="form-control"></select>
                        </div>

                        <div class="col-md-6 section_inputLeft-text-formInst">
                            <label for="example-date-input" class="col-12 text_label-formInst"> Seleccione ciudad </label>

                            <select name="id_municipio" id="id_municipio" class="form-control"> </select>
                        </div>

                        <!-- Botón guardar información -->
                        <div class="col-12 mt-3 content_btnEnviar-formInst">
                            <button type="submit" class="btn2_enviar-formInst"> Guardar
                                <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flechaBtn_guardar-formInst" alt=""> 
                            </button>
                        </div>
                    @endif
                </div>
            </form>
        </div>
        <!--------------------------------------------      Fin 2 segunda parte del formulario *** INFORMACIÓN CONTACTO ***      ---------------------------------------------->

        <!-- Secciones de los botones anterior y siguiente -->
        <div class="col-lg-10 col-xl-8 content_botonInferior-next-formInst">
            <div class="col-md-3 content_btn-siguient-formInst">
                <button type="submit" class="boton_inferior-siguiente-formInst btn-next-320-formInst" onclick="hideBtnNext(this)" code-position="dateInstitution"> Siguiente
                    <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flechaBtn_guardar-formInst" alt=""> 
                </button>
            </div>
        </div>
    </div>

    <!-- 2* Contenedor principal de la opción SERVICIOS PROFESIONALES -->
    <div class="container-fluid professional_services content_principal-formInst"> <!-- Clase "professional_services" creada para ocultar y mostrar elementos desde la función on click en el archivo formularios.js  -->
        <!--------------------------------------------      Inicio 3 tercera parte del formulario *** SERVICIO PROFESIONAL ***      ------------------------------------------->
        <div class="col-lg-10 col-xl-8 pb-3 content_tarjetasInfo-formInst">
            <h5 class="col-12 icon_servProf-formInst"> Servicios profesionales </h5>

            <form method="POST" action="{{ url ('/FormularioInstitucionSave3') }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"> 

                @if(!empty($objFormulario))
                    <div class="col-12 px-0">
                        <div class="form-group">
                            <label for="example-date-input" class="col-12 text_label-formInst"> Escriba una breve descripción de su servicio </label>

                            <textarea class="form-control" id="descripcionPerfil"  type="text" name="DescripcionGeneralServicios" >{{$objFormulario->DescripcionGeneralServicios}}</textarea>
                        </div>
                    </div>
                @else
                    <div class="col-12 px-0">
                        <div class="form-group">
                            <label for="example-date-input" class="col-12 text_label-formInst" maxlength="270"> Escriba una breve descripción de su servicio </label>

                            <textarea class="form-control" id="descripcionPerfil"  type="text" name="DescripcionGeneralServicios" ></textarea>

                            <labe class="col-12 text_infoImg-formInst"> 270 Caracteres </label>
                        </div>
                    </div>
                @endif

                <!-- Botón guardar información -->
                <div class="col-12 content_btnEnviar-formInst">
                    <button type="submit" class="btn2_enviar-formInst"> Guardar
                        <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flechaBtn_guardar-formInst" alt=""> 
                    </button>
                </div>
            </form>
        </div>
        <!--------------------------------------------      Fin 3 tercera parte del formulario *** SERVICIO PROFESIONAL ***      ---------------------------------------------->

        <!--------------------------------------------      Inicio 4 cuarta parte del formulario *** SERVICIO ***      -------------------------------------------------------->
        <div class="col-lg-10 col-xl-8 pb-3 content_tarjetasInfo-formInst">
            <h5 class="col-lg-12 icon_servicios-formInst"> Servicios </h5>
            <!-- Modulo contenido SERVICIOS -->
            <div class="col-12 row section_servicio-formInst">
                @foreach($objServicio as $objServicio)
                    @if(!empty($objServicio->tituloServicios))
                        <div class="col-6">
                            <div class="col-12 content_cierreX-formInst">
                                <a href="{{url('/FormularioInstituciondelete4/'.$objServicio->id_servicio)}}">
                                    <button type="submit" class="close" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </a>
                            </div>

                            <div class="col-12 px-0">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Título del servicio </label>

                                <span>{{$objServicio->tituloServicios}} </span>
                            </div>

                            <div class="col-12 px-0">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Descrpcion del servicio </label>
                            
                                <span>{{$objServicio->DescripcioServicios}} </span>
                            </div>

                            <div class="col-12 px-0">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Sucursales </label>
                            
                                <span>{{$objServicio->sucursalservicio}} </span>
                            </div>
                        </div>   
                    @endif
                @endforeach
            </div>

            <form method="POST" action="{{ url ('/FormularioInstitucionSave4') }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"> 

                @if($objContadorServicio->cantidad == 0)
                    <!-- Modulo contenido SERVICIOS -->
                    <div class="row fila_infoBasica-formInst">
                        <!-- Contenido IZQUIERDO -->
                        <div class="col-md-6 section_inputLeft-text-formInst">
                            <div class="col-12 section_inputLeft-text-formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Título del servicio </label>

                                <input class="form-control" id="tituloServicios" placeholder="tituloServicios" type="text" name="tituloServicios[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Descripción y sede en la que está el servicio </label>

                                <textarea class="form-control" id="DescripcioServicios" placeholder="DescripcioServicios" maxlength="270" name="DescripcioServicios[]" value=""></textarea>

                                <labe class="col-12 text_infoImg-formInst"> 270 Caracteres </label>
                            </div>
                            
                            <label for="example-date-input" class="col-12 text_label-formInst"> Sucursales </label>
                            <div class="col-12 section_inputLeft-text-formInst">
                                <input class="col-12 form-control" data-role="tagsinput" placeholder="tituloServicios" type="text" name="sucursalservicio[]" value="">
                            </div>
                        </div>

                        <!-- Contenido DERECHO -->
                        <div class="col-md-6 section_inputRight-text-formInst">
                            <div class="col-12 section_inputRight-text-formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Título del servicio </label>

                                <input class="form-control" id="tituloServicios" placeholder="tituloServicios" type="text" name="tituloServicios[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formInst">        
                                <label for="example-date-input" class="col-12 text_label-formInst"> Descripción y sede en la que está el servicio </label>

                                <textarea class="form-control" id="DescripcioServicios" placeholder="DescripcioServicios" maxlength="270" name="DescripcioServicios[]" value=""></textarea>

                                <labe class="col-12 text_infoImg-formInst"> 270 Caracteres </label>
                            </div>

                            <div class="col-12 section_inputRight-text-formInst">    
                                <label for="example-date-input" class="col-12 text_label-formInst"> Sucursales </label>
                                
                                <input class="col-12 form-control"  data-role="tagsinput" placeholder="tituloServicios" type="text" name="sucursalservicio[]" value="">
                            </div>
                        </div>
                    </div>

                    <!-- Modulo contenido SERVICIOS -->
                    <div class="row fila_infoBasica-formInst">
                        <!-- Contenido IZQUIERDO -->
                        <div class="col-md-6 section_inputLeft-text-formInst">
                            <div class="col-12 section_inputLeft-text-formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Título del servicio </label>

                                <input class="form-control" id="tituloServicios" placeholder="tituloServicios" type="text" name="tituloServicios[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Descripción y sede en la que está el servicio </label>

                                <textarea class="form-control" id="DescripcioServicios" placeholder="DescripcioServicios" maxlength="270" name="DescripcioServicios[]" value=""></textarea>

                                <labe class="col-12 text_infoImg-formInst"> 270 Caracteres </label>
                            </div>
                            
                            <div class="col-12 section_inputLeft-text-formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Sucursales </label>
    
                                <input class="col-12 form-control" data-role="tagsinput" placeholder="tituloServicios" type="text" name="sucursalservicio[]" value="">
                            </div>
                        </div>

                        <!-- Contenido DERECHO -->
                        <div class="col-md-6 section_inputRight-text-formInst">
                            <div class="col-12 section_inputRight-text-formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Título del servicio </label>

                                <input class="form-control" id="tituloServicios" placeholder="tituloServicios" type="text" name="tituloServicios[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formInst">        
                                <label for="example-date-input" class="col-12 text_label-formInst"> Descripción y sede en la que está el servicio </label>

                                <textarea class="form-control" id="DescripcioServicios" placeholder="DescripcioServicios" maxlength="270" name="DescripcioServicios[]" value=""></textarea>

                                <labe class="col-12 text_infoImg-formInst"> 270 Caracteres </label>
                            </div>

                            <div class="col-12 section_inputRight-text-formInst">    
                                <label for="example-date-input" class="col-12 text_label-formInst"> Sucursales </label>
                                
                                <input class="col-12 form-control"  data-role="tagsinput" placeholder="tituloServicios" type="text" name="sucursalservicio[]" value="">
                            </div>
                        </div>
                    </div>

                    <!-- Modulo contenido SERVICIOS -->
                    <div class="row fila_infoBasica-formInst">
                        <!-- Contenido IZQUIERDO -->
                        <div class="col-md-6 section_inputLeft-text-formInst">
                            <div class="col-12 section_inputLeft-text-formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Título del servicio </label>

                                <input class="form-control" id="tituloServicios" placeholder="tituloServicios" type="text" name="tituloServicios[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Descripción y sede en la que está el servicio </label>

                                <textarea class="form-control" id="DescripcioServicios" placeholder="DescripcioServicios" maxlength="270" name="DescripcioServicios[]" value=""></textarea>

                                <labe class="col-12 text_infoImg-formInst"> 270 Caracteres </label>
                            </div>
                            
                            <div class="col-12 section_inputLeft-text-formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Sucursales </label>
    
                                <input class="col-12 form-control" data-role="tagsinput" placeholder="tituloServicios" type="text" name="sucursalservicio[]" value="">
                            </div>
                        </div>

                        <!-- Contenido DERECHO -->
                        <div class="col-md-6 section_inputRight-text-formInst">
                            <div class="col-12 section_inputRight-text-formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Título del servicio </label>

                                <input class="form-control" id="tituloServicios" placeholder="tituloServicios" type="text" name="tituloServicios[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formInst">        
                                <label for="example-date-input" class="col-12 text_label-formInst"> Descripción y sede en la que está el servicio </label>

                                <textarea class="form-control" id="DescripcioServicios" placeholder="DescripcioServicios" maxlength="270" name="DescripcioServicios[]" value=""></textarea>

                                <labe class="col-12 text_infoImg-formInst"> 270 Caracteres </label>
                            </div>

                            <div class="col-12 section_inputRight-text-formInst">    
                                <label for="example-date-input" class="col-12 text_label-formInst"> Sucursales </label>
                                
                                <input class="col-12 form-control"  data-role="tagsinput" placeholder="tituloServicios" type="text" name="sucursalservicio[]" value="">
                            </div>
                        </div>
                    </div>
                @elseif($objContadorServicio->cantidad == 1)
                    <!-- Modulo contenido SERVICIOS -->
                    <div class="row fila_infoBasica-formInst">
                        <!-- Contenido IZQUIERDO -->
                        <div class="col-md-6 section_inputLeft-text-formInst">
                            <div class="col-12 section_inputLeft-text-formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Título del servicio </label>

                                <input class="form-control" id="tituloServicios" placeholder="tituloServicios" type="text" name="tituloServicios[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Descripción y sede en la que está el servicio </label>

                                <textarea class="form-control" id="DescripcioServicios" placeholder="DescripcioServicios" maxlength="270" name="DescripcioServicios[]" value=""></textarea>

                                <labe class="col-12 text_infoImg-formInst"> 270 Caracteres </label>
                            </div>
                            
                            <div class="col-12 section_inputLeft-text-formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Sucursales </label>
    
                                <input class="col-12 form-control" data-role="tagsinput" placeholder="tituloServicios" type="text" name="sucursalservicio[]" value="">
                            </div>
                        </div>

                        <!-- Contenido DERECHO -->
                        <div class="col-md-6 section_inputRight-text-formInst">
                            <div class="col-12 section_inputRight-text-formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Título del servicio </label>

                                <input class="form-control" id="tituloServicios" placeholder="tituloServicios" type="text" name="tituloServicios[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formInst">        
                                <label for="example-date-input" class="col-12 text_label-formInst"> Descripción y sede en la que está el servicio </label>

                                <textarea class="form-control" id="DescripcioServicios" placeholder="DescripcioServicios" maxlength="270" name="DescripcioServicios[]" value=""></textarea>

                                <labe class="col-12 text_infoImg-formInst"> 270 Caracteres </label>
                            </div>

                            <div class="col-12 section_inputRight-text-formInst">    
                                <label for="example-date-input" class="col-12 text_label-formInst"> Sucursales </label>
                                
                                <input class="col-12 form-control"  data-role="tagsinput" placeholder="tituloServicios" type="text" name="sucursalservicio[]" value="">
                            </div>
                        </div>
                    </div>

                    <!-- Modulo contenido SERVICIOS -->
                    <div class="row fila_infoBasica-formInst">
                        <!-- Contenido IZQUIERDO -->
                        <div class="col-md-6 section_inputLeft-text-formInst">
                            <div class="col-12 section_inputLeft-text-formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Título del servicio </label>

                                <input class="form-control" id="tituloServicios" placeholder="tituloServicios" type="text" name="tituloServicios[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Descripción y sede en la que está el servicio </label>

                                <textarea class="form-control" id="DescripcioServicios" placeholder="DescripcioServicios" maxlength="270" name="DescripcioServicios[]" value=""></textarea>

                                <labe class="col-12 text_infoImg-formInst"> 270 Caracteres </label>
                            </div>
                            
                            <div class="col-12 section_inputLeft-text-formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Sucursales </label>
    
                                <input class="col-12 form-control" data-role="tagsinput" placeholder="tituloServicios" type="text" name="sucursalservicio[]" value="">
                            </div>
                        </div>

                        <!-- Contenido DERECHO -->
                        <div class="col-md-6 section_inputRight-text-formInst">
                            <div class="col-12 section_inputRight-text-formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Título del servicio </label>

                                <input class="form-control" id="tituloServicios" placeholder="tituloServicios" type="text" name="tituloServicios[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formInst">        
                                <label for="example-date-input" class="col-12 text_label-formInst"> Descripción y sede en la que está el servicio </label>

                                <textarea class="form-control" id="DescripcioServicios" placeholder="DescripcioServicios" maxlength="270" name="DescripcioServicios[]" value=""></textarea>

                                <labe class="col-12 text_infoImg-formInst"> 270 Caracteres </label>
                            </div>

                            <div class="col-12 section_inputRight-text-formInst">    
                                <label for="example-date-input" class="col-12 text_label-formInst"> Sucursales </label>
                                
                                <input class="col-12 form-control"  data-role="tagsinput" placeholder="tituloServicios" type="text" name="sucursalservicio[]" value="">
                            </div>
                        </div>
                    </div>

                    <!-- Modulo contenido SERVICIOS -->
                    <div class="row fila_infoBasica-formInst">
                        <!-- Contenido IZQUIERDO -->
                        <div class="col-md-6 section_inputLeft-text-formInst">
                            <div class="col-12 section_inputLeft-text-formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Título del servicio </label>

                                <input class="form-control" id="tituloServicios" placeholder="tituloServicios" type="text" name="tituloServicios[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Descripción y sede en la que está el servicio </label>

                                <textarea class="form-control" id="DescripcioServicios" placeholder="DescripcioServicios" maxlength="270" name="DescripcioServicios[]" value=""></textarea>

                                <labe class="col-12 text_infoImg-formInst"> 270 Caracteres </label>
                            </div>
                            
                            <div class="col-12 section_inputLeft-text-formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Sucursales </label>
    
                                <input class="col-12 form-control" data-role="tagsinput" placeholder="tituloServicios" type="text" name="sucursalservicio[]" value="">
                            </div>
                        </div>
                    </div>
                @elseif($objContadorServicio->cantidad == 2)
                    <!-- Modulo contenido SERVICIOS -->
                    <div class="row fila_infoBasica-formInst">
                        <!-- Contenido IZQUIERDO -->
                        <div class="col-md-6 section_inputLeft-text-formInst">
                            <div class="col-12 section_inputLeft-text-formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Título del servicio </label>

                                <input class="form-control" id="tituloServicios" placeholder="tituloServicios" type="text" name="tituloServicios[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Descripción y sede en la que está el servicio </label>

                                <textarea class="form-control" id="DescripcioServicios" placeholder="DescripcioServicios" maxlength="270" name="DescripcioServicios[]" value=""></textarea>

                                <labe class="col-12 text_infoImg-formInst"> 270 Caracteres </label>
                            </div>
                            
                            <div class="col-12 section_inputLeft-text-formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Sucursales </label>
    
                                <input class="col-12 form-control" data-role="tagsinput" placeholder="tituloServicios" type="text" name="sucursalservicio[]" value="">
                            </div>
                        </div>

                        <!-- Contenido DERECHO -->
                        <div class="col-md-6 section_inputRight-text-formInst">
                            <div class="col-12 section_inputRight-text-formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Título del servicio </label>

                                <input class="form-control" id="tituloServicios" placeholder="tituloServicios" type="text" name="tituloServicios[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formInst">        
                                <label for="example-date-input" class="col-12 text_label-formInst"> Descripción y sede en la que está el servicio </label>

                                <textarea class="form-control" id="DescripcioServicios" placeholder="DescripcioServicios" maxlength="270" name="DescripcioServicios[]" value=""></textarea>

                                <labe class="col-12 text_infoImg-formInst"> 270 Caracteres </label>
                            </div>

                            <div class="col-12 section_inputRight-text-formInst">    
                                <label for="example-date-input" class="col-12 text_label-formInst"> Sucursales </label>
                                
                                <input class="col-12 form-control"  data-role="tagsinput" placeholder="tituloServicios" type="text" name="sucursalservicio[]" value="">
                            </div>
                        </div>
                    </div>

                    <!-- Modulo contenido SERVICIOS -->
                    <div class="row fila_infoBasica-formInst">
                        <!-- Contenido IZQUIERDO -->
                        <div class="col-md-6 section_inputLeft-text-formInst">
                            <div class="col-12 section_inputLeft-text-formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Título del servicio </label>

                                <input class="form-control" id="tituloServicios" placeholder="tituloServicios" type="text" name="tituloServicios[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Descripción y sede en la que está el servicio </label>

                                <textarea class="form-control" id="DescripcioServicios" placeholder="DescripcioServicios" maxlength="270" name="DescripcioServicios[]" value=""></textarea>

                                <labe class="col-12 text_infoImg-formInst"> 270 Caracteres </label>
                            </div>
                            
                            <div class="col-12 section_inputLeft-text-formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Sucursales </label>
    
                                <input class="col-12 form-control" data-role="tagsinput" placeholder="tituloServicios" type="text" name="sucursalservicio[]" value="">
                            </div>
                        </div>

                        <!-- Contenido DERECHO -->
                        <div class="col-md-6 section_inputRight-text-formInst">
                            <div class="col-12 section_inputRight-text-formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Título del servicio </label>

                                <input class="form-control" id="tituloServicios" placeholder="tituloServicios" type="text" name="tituloServicios[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formInst">        
                                <label for="example-date-input" class="col-12 text_label-formInst"> Descripción y sede en la que está el servicio </label>

                                <textarea class="form-control" id="DescripcioServicios" placeholder="DescripcioServicios" maxlength="270" name="DescripcioServicios[]" value=""></textarea>

                                <labe class="col-12 text_infoImg-formInst"> 270 Caracteres </label>
                            </div>

                            <div class="col-12 section_inputRight-text-formInst">    
                                <label for="example-date-input" class="col-12 text_label-formInst"> Sucursales </label>
                                
                                <input class="col-12 form-control"  data-role="tagsinput" placeholder="tituloServicios" type="text" name="sucursalservicio[]" value="">
                            </div>
                        </div>
                    </div>
                @elseif($objContadorServicio->cantidad == 3)
                    <!-- Modulo contenido SERVICIOS -->
                    <div class="row fila_infoBasica-formInst">
                        <!-- Contenido IZQUIERDO -->
                        <div class="col-md-6 section_inputLeft-text-formInst">
                            <div class="col-12 section_inputLeft-text-formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Título del servicio </label>

                                <input class="form-control" id="tituloServicios" placeholder="tituloServicios" type="text" name="tituloServicios[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Descripción y sede en la que está el servicio </label>

                                <textarea class="form-control" id="DescripcioServicios" placeholder="DescripcioServicios" maxlength="270" name="DescripcioServicios[]" value=""></textarea>

                                <labe class="col-12 text_infoImg-formInst"> 270 Caracteres </label>
                            </div>
                            
                            <div class="col-12 section_inputLeft-text-formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Sucursales </label>
    
                                <input class="col-12 form-control" data-role="tagsinput" placeholder="tituloServicios" type="text" name="sucursalservicio[]" value="">
                            </div>
                        </div>

                        <!-- Contenido DERECHO -->
                        <div class="col-md-6 section_inputRight-text-formInst">
                            <div class="col-12 section_inputRight-text-formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Título del servicio </label>

                                <input class="form-control" id="tituloServicios" placeholder="tituloServicios" type="text" name="tituloServicios[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formInst">        
                                <label for="example-date-input" class="col-12 text_label-formInst"> Descripción y sede en la que está el servicio </label>

                                <textarea class="form-control" id="DescripcioServicios" placeholder="DescripcioServicios" maxlength="270" name="DescripcioServicios[]" value=""></textarea>

                                <labe class="col-12 text_infoImg-formInst"> 270 Caracteres </label>
                            </div>

                            <div class="col-12 section_inputRight-text-formInst">    
                                <label for="example-date-input" class="col-12 text_label-formInst"> Sucursales </label>
                                
                                <input class="col-12 form-control"  data-role="tagsinput" placeholder="tituloServicios" type="text" name="sucursalservicio[]" value="">
                            </div>
                        </div>
                    </div>

                    <!-- Modulo contenido SERVICIOS -->
                    <div class="row fila_infoBasica-formInst">
                        <!-- Contenido IZQUIERDO -->
                        <div class="col-md-6 section_inputLeft-text-formInst">
                            <div class="col-12 section_inputLeft-text-formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Título del servicio </label>

                                <input class="form-control" id="tituloServicios" placeholder="tituloServicios" type="text" name="tituloServicios[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Descripción y sede en la que está el servicio </label>

                                <textarea class="form-control" id="DescripcioServicios" placeholder="DescripcioServicios" maxlength="270" name="DescripcioServicios[]" value=""></textarea>

                                <labe class="col-12 text_infoImg-formInst"> 270 Caracteres </label>
                            </div>
                            
                            <div class="col-12 section_inputLeft-text-formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Sucursales </label>
    
                                <input class="col-12 form-control" data-role="tagsinput" placeholder="tituloServicios" type="text" name="sucursalservicio[]" value="">
                            </div>
                        </div>
                    </div>
                @elseif($objContadorServicio->cantidad == 4)
                    <!-- Modulo contenido SERVICIOS -->
                    <div class="row fila_infoBasica-formInst">
                        <!-- Contenido IZQUIERDO -->
                        <div class="col-md-6 section_inputLeft-text-formInst">
                            <div class="col-12 section_inputLeft-text-formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Título del servicio </label>

                                <input class="form-control" id="tituloServicios" placeholder="tituloServicios" type="text" name="tituloServicios[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Descripción y sede en la que está el servicio </label>

                                <textarea class="form-control" id="DescripcioServicios" placeholder="DescripcioServicios" maxlength="270" name="DescripcioServicios[]" value=""></textarea>

                                <labe class="col-12 text_infoImg-formInst"> 270 Caracteres </label>
                            </div>
                            
                            <div class="col-12 section_inputLeft-text-formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Sucursales </label>
    
                                <input class="col-12 form-control" data-role="tagsinput" placeholder="tituloServicios" type="text" name="sucursalservicio[]" value="">
                            </div>
                        </div>

                        <!-- Contenido DERECHO -->
                        <div class="col-md-6 section_inputRight-text-formInst">
                            <div class="col-12 section_inputRight-text-formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Título del servicio </label>

                                <input class="form-control" id="tituloServicios" placeholder="tituloServicios" type="text" name="tituloServicios[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formInst">        
                                <label for="example-date-input" class="col-12 text_label-formInst"> Descripción y sede en la que está el servicio </label>

                                <textarea class="form-control" id="DescripcioServicios" placeholder="DescripcioServicios" maxlength="270" name="DescripcioServicios[]" value=""></textarea>

                                <labe class="col-12 text_infoImg-formInst"> 270 Caracteres </label>
                            </div>

                            <div class="col-12 section_inputRight-text-formInst">    
                                <label for="example-date-input" class="col-12 text_label-formInst"> Sucursales </label>
                                
                                <input class="col-12 form-control"  data-role="tagsinput" placeholder="tituloServicios" type="text" name="sucursalservicio[]" value="">
                            </div>
                        </div>
                    </div>
                @elseif($objContadorServicio->cantidad == 5)
                    <!-- Modulo contenido SERVICIOS -->
                    <div class="row fila_infoBasica-formInst">
                        <!-- Contenido IZQUIERDO -->
                        <div class="col-md-6 section_inputLeft-text-formInst">
                            <div class="col-12 section_inputLeft-text-formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Título del servicio </label>

                                <input class="form-control" id="tituloServicios" placeholder="tituloServicios" type="text" name="tituloServicios[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Descripción y sede en la que está el servicio </label>

                                <textarea class="form-control" id="DescripcioServicios" placeholder="DescripcioServicios" maxlength="270" name="DescripcioServicios[]" value=""></textarea>

                                <labe class="col-12 text_infoImg-formInst"> 270 Caracteres </label>
                            </div>
                            
                            <div class="col-12 section_inputLeft-text-formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Sucursales </label>
    
                                <input class="col-12 form-control" data-role="tagsinput" placeholder="tituloServicios" type="text" name="sucursalservicio[]" value="">
                            </div>
                        </div>
                    </div>
                @elseif($objContadorServicio->cantidad == 6)
                    <label for="example-date-input" class="col-12 text_label-formInst pb-0"> No se pueden agregar más servicios </label>
                @endif

                <!-- Botón guardar información -->
                <div class="col-12 content_btnEnviar-formInst">
                    <button type="submit" class="btn2_enviar-formInst"> Guardar
                        <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flechaBtn_guardar-formInst" alt=""> 
                    </button>
                </div>
            </form>
        </div>
        <!--------------------------------------------      Fin 4 cuarta parte del formulario *** SERVICIO ***      ----------------------------------------------------------->

        <!-- Secciones de los botones anterior y siguiente -->
        <div class="col-lg-10 col-xl-8 content_botonesInferiores-formInst">
            <div class="col-md-3 content_btn-anter-formInst">
                <button type="submit" class="boton_inferior-anterior-formInst" onclick="hideBtnPrevious(this)" code-position="professionalServices">
                    <img src="{{URL::asset('/img/formulario-profesional/icono-flecha-gris.svg')}}" class="flechaBtn_guardar-formInst" alt=""> 
                    Anterior
                </button>
            </div>

            <div class="col-md-3 content_btn-siguient-formInst">
                <button type="submit" class="boton_inferior-siguiente-formInst" onclick="hideBtnNext(this)" code-position="professionalServices"> Siguiente
                    <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flechaBtn_guardar-formInst" alt=""> 
                </button>
            </div>
        </div>
    </div>

    <!-- 3* Contenedor principal de la opción ACERCA DE LA INSTITUCIÓN -->
    <div class="container-fluid about_institution content_principal-formInst"> <!-- Clase "about_institution" creada para ocultar y mostrar elementos desde la función on click en el archivo formularios.js  -->
        <div class="col-lg-10 col-xl-8 pb-3 content_tarjetasInfo-formInst">
            <h5 class="col-lg-12 icon_quienes-formInst"> ¿Quiénes somos? </h5>

            <form method="POST" action="{{ url ('/FormularioInstitucionSave5') }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"> 

                @if(!empty($objFormulario))
                    <div class="col-12 px-0">
                        <div class="form-group">
                            <label for="example-date-input" class="col-12 text_label-formInst"> Escriba una breve descripción de ¿Quiénes son? </label>

                            <textarea class="form-control" id="descripcionPerfil"  type="text" name="quienessomos" >{{$objFormulario->quienessomos}}</textarea>
                        </div>
                    </div>
                @else
                    <div class="col-12 px-0">
                        <div class="form-group">
                            <label for="example-date-input" class="col-12 text_label-formInst" maxlength="500"> Escriba una breve descripción de ¿Quiénes son? </label>

                            <textarea class="form-control" id="descripcionPerfil"  type="text" name="quienessomos" ></textarea>

                            <labe class="col-12 text_infoImg-formInst"> 500 Caracteres </label>
                        </div>
                    </div>
                @endif

                <!-- Botón guardar información -->
                <div class="col-12 content_btnEnviar-formInst">
                    <button type="submit" class="btn2_enviar-formInst"> Guardar
                        <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flechaBtn_guardar-formInst" alt=""> 
                    </button>
                </div>
            </form>
        </div>
        <!--------------------------------------------      Fin 5 quinta parte del formulario *** QUIENES SOMOS ***      ------------------------------------------------------>

        <!--------------------------------------------      Inicio 6 sexta parte del formulario *** PROPUESTA DE VALOR ***      ----------------------------------------------->
        <div class="col-lg-10 col-xl-8 pb-3 content_tarjetasInfo-formInst">
            <h5 class="col-lg-12 icon_propuestaValor-formInst">Propuesta de valor </h5>

            <form method="POST" action="{{ url ('/FormularioInstitucionSave6') }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"> 

                @if(!empty($objFormulario))
                    <div class="col-12 px-0">
                        <div class="form-group">
                            <label for="example-date-input" class="col-12 text_label-formInst"> Escriba una breve descripción de la propuesta de valor </label>

                            <textarea class="form-control" id="descripcionPerfil"  type="text" name="propuestavalor" >{{$objFormulario->propuestavalor}}</textarea>
                        </div>
                    </div>
                @else
                    <div class="col-12 px-0">
                        <div class="form-group">
                            <label for="example-date-input" class="col-12 text_label-formInst" maxlength="300">  Escriba una breve descripción de la propuesta de valor </label>

                            <textarea class="form-control" id="descripcionPerfil"  type="text" name="propuestavalor" ></textarea>

                            <labe class="col-12 text_infoImg-formInst"> 300 Caracteres </label>
                        </div>
                    </div>
                @endif

                <!-- Botón guardar información -->
                <div class="col-12 content_btnEnviar-formInst">
                    <button type="submit" class="btn2_enviar-formInst"> Guardar
                        <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flechaBtn_guardar-formInst" alt=""> 
                    </button>
                </div>
            </form>
        </div>
        <!--------------------------------------------      Fin 6 sexta parte del formulario *** PROPUESTA DE VALOR ***      -------------------------------------------------->

        <!--------------------------------------------      Inicio 7 septima parte del formulario *** CONVENIOS ***      ------------------------------------------------------>
        <div class="col-lg-10 col-xl-8 pb-3 content_tarjetasInfo-formInst">
            <h5 class="col-lg-12 icon_convenios-formInst"> Convenios </h5>

            <div class="row col-12 p-0 m-0">
                <label for="example-date-input" class="col-12 text_label-formInst pb-0"> Convenio EPS </label>
                @foreach($objEps as $objEps)
                    @if(!empty($objEps->urlimagen))
                        <div class="col-10 col-md-6 content_imgGuardada-formInst">
                            <div class="col-12 pr-3 content_btnX-cierre-formInst">
                                <a href="{{url('/FormularioInstituciondelete5/'.$objEps->id)}}">
                                    <button type="submit" class="close" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </a> 
                            </div> 

                            <div class="col-12 img_selccionada-formInst">
                                <img class="imgConvenio_guardada-formInst" src="{{URL::asset($objEps->urlimagen)}}"> 
                            </div>
                        </div> 
                    @endif
                @endforeach
            </div> 

            <div class="row col-12 p-0 m-0">
                <label for="example-date-input" class="col-12 text_label-formInst pb-0"> Convenio IPS </label>
                @foreach($objIps as $objIps)
                    @if(!empty($objIps->urlimagen))
                        <div class="col-10 col-md-6 content_imgGuardada-formInst">
                            <div class="col-12 pr-3 content_btnX-cierre-formInst">
                                <a href="{{url('/FormularioInstituciondelete6/'.$objIps->id)}}">
                                    <button type="submit" class="close" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </a> 
                            </div>  
                            
                            <div class="col-12 img_selccionada-formInst">
                                <img class="imgConvenio_guardada-formInst" src="{{URL::asset($objIps->urlimagen)}}"> 
                            </div>  
                        </div>
                    @endif
                @endforeach
            </div>

            <div class="row col-12 p-0 m-0">
                <label for="example-date-input" class="col-12 text_label-formInst pb-0"> Convenio medicina prepagada </label>
                @foreach($objPrepa as $objPrepa)
                    @if(!empty($objPrepa->urlimagen))
                        <div class="col-10 col-md-6 content_imgGuardada-formInst">
                            <div class="col-12 pr-3 content_btnX-cierre-formInst">
                                <a href="{{url('/FormularioInstituciondelete7/'.$objPrepa->id_prepagada)}}">
                                    <button type="submit" class="close" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </a> 
                            </div>  
                            
                            <div class="col-12 img_selccionada-formInst">
                                <img class="imgConvenio_guardada-formInst" src="{{URL::asset($objPrepa->urlimagen)}}">
                            </div>  
                        </div> 
                    @endif
                @endforeach
            </div>

            <form method="POST" action="{{ url ('/FormularioInstitucionSave7') }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"> 

                <div class="row col-12 px-0 m-0">
                    <!-- **************************************************************** FORMULARIO EPS ************************************************************** -->
                    @if($objContadorEps->cantidad == 0)
                        <div class="col-12 content_agregarImg-formInst form-group">
                            <label for="example-date-input" class="col-12 text_label-formInst"> Suba imágenes con respecto a los convenios que tengan con las EPS </label>
                        </div>

                        <div class="col-10 col-md-6 content_agregarImg-formInst form-group">
                            <div class="col-10 img_selccionada-formProf">
                                <div class="img_anexada-formProf">
                                    <img id="uploadPreview1"/>
                                </div>
                            </div>

                            <div class="agregar_archivo-formInst">
                                <input type='file' id="uploadImage1" name="urlimagenEps[]" onchange="previewImage(1);"/>
                            </div>

                            <labe class="col-12 text_infoImg-formInst"> Tamaño 120px x 60px. Peso máximo 300kb </label>
                        </div>

                        <div class="col-10 col-md-6 content_agregarImg-formInst form-group">
                            <div class="col-10 img_selccionada-formProf">
                                <div class="img_anexada-formProf">
                                    <img id="uploadPreview2"/>
                                </div>
                            </div>

                            <div class="agregar_archivo-formInst2">
                                <input type='file' id="uploadImage2" name="urlimagenEps[]" onchange="previewImage(2);"/>
                            </div>

                            <labe class="col-12 text_infoImg-formInst"> Tamaño 120px x 60px. Peso máximo 300kb </label>
                        </div>

                        <div class="col-10 col-md-6 content_agregarImg-formInst form-group hidden-section-formInst">
                            <div class="col-10 img_selccionada-formProf">
                                <div class="img_anexada-formProf">
                                    <img id="uploadPreview3"/>
                                </div>
                            </div>

                            <div class="agregar_archivo-formInst">
                                <input type='file' id="uploadImage3" name="urlimagenEps[]" onchange="previewImage(3);"/>
                            </div>

                            <labe class="col-12 text_infoImg-formInst"> Tamaño 120px x 60px. Peso máximo 300kb </label>
                        </div>

                        <div class="col-10 col-md-6 content_agregarImg-formInst form-group hidden-section-formInst">
                            <div class="col-10 img_selccionada-formProf">
                                <div class="img_anexada-formProf">
                                    <img id="uploadPreview4"/>
                                </div>
                            </div>

                            <div class="agregar_archivo-formInst2">
                                <input type='file' id="uploadImage4" name="urlimagenEps[]" onchange="previewImage(4);"/>
                            </div>

                            <labe class="col-12 text_infoImg-formInst"> Tamaño 120px x 60px. Peso máximo 300kb </label>
                        </div>   

                    @elseif($objContadorEps->cantidad == 1)
                        <div class="col-12 content_agregarImg-formInst form-group">
                            <label for="example-date-input" class="col-12 text_label-formInst"> Suba imágenes con respecto a los convenios que tengan con las EPS </label>
                        </div>

                        <div class="col-10 col-md-6 content_agregarImg-formInst form-group hidden-section-formInst">
                            <div class="col-10 img_selccionada-formProf">
                                <div class="img_anexada-formProf">
                                    <img id="uploadPreview2"/>
                                </div>
                            </div>

                            <div class="agregar_archivo-formInst2">
                                <input type='file' id="uploadImage2" name="urlimagenEps[]" onchange="previewImage(2);"/>
                            </div>

                            <labe class="col-12 text_infoImg-formInst"> Tamaño 120px x 60px. Peso máximo 300kb </label>
                        </div>

                        <div class="col-10 col-md-6 content_agregarImg-formInst form-group">
                            <div class="col-10 img_selccionada-formProf">
                                <div class="img_anexada-formProf">
                                    <img id="uploadPreview3"/>
                                </div>
                            </div>

                            <div class="agregar_archivo-formInst">
                                <input type='file' id="uploadImage3" name="urlimagenEps[]" onchange="previewImage(3);"/>
                            </div>

                            <labe class="col-12 text_infoImg-formInst"> Tamaño 120px x 60px. Peso máximo 300kb </label>
                        </div>

                        <div class="col-10 col-md-6 content_agregarImg-formInst form-group">
                            <div class="col-10 img_selccionada-formProf">
                                <div class="img_anexada-formProf">
                                    <img id="uploadPreview4"/>
                                </div>
                            </div>

                            <div class="agregar_archivo-formInst2">
                                <input type='file' id="uploadImage4" name="urlimagenEps[]" onchange="previewImage(4);"/>
                            </div>

                            <labe class="col-12 text_infoImg-formInst"> Tamaño 120px x 60px. Peso máximo 300kb </label>
                        </div>  

                    @elseif($objContadorEps->cantidad == 2)
                        <div class="col-12 content_agregarImg-formInst form-group">
                            <label for="example-date-input" class="col-12 text_label-formInst"> Suba imágenes con respecto a los convenios que tengan con las EPS </label>
                        </div>

                        <div class="col-10 col-md-6 content_agregarImg-formInst form-group">
                            <div class="col-10 img_selccionada-formProf">
                                <div class="img_anexada-formProf">
                                    <img id="uploadPreview3"/>
                                </div>
                            </div>

                            <div class="agregar_archivo-formInst">
                                <input type='file' id="uploadImage3" name="urlimagenEps[]" onchange="previewImage(3);"/>
                            </div>

                            <labe class="col-12 text_infoImg-formInst"> Tamaño 120px x 60px. Peso máximo 300kb </label>
                        </div>

                        <div class="col-10 col-md-6 content_agregarImg-formInst form-group">
                            <div class="col-10 img_selccionada-formProf">
                                <div class="img_anexada-formProf">
                                    <img id="uploadPreview4"/>
                                </div>
                            </div>

                            <div class="agregar_archivo-formInst2">
                                <input type='file' id="uploadImage4" name="urlimagenEps[]" onchange="previewImage(4);"/>
                            </div>

                            <labe class="col-12 text_infoImg-formInst"> Tamaño 120px x 60px. Peso máximo 300kb </label>
                        </div>  

                    @elseif($objContadorEps->cantidad == 3)
                        <div class="col-12 content_agregarImg-formInst form-group">
                            <label for="example-date-input" class="col-12 text_label-formInst"> Suba imágenes con respecto a los convenios que tengan con las EPS </label>
                        </div>

                        <div class="col-10 col-md-6 content_agregarImg-formInst form-group">
                            <div class="col-10 img_selccionada-formProf">
                                <div class="img_anexada-formProf">
                                    <img id="uploadPreview4"/>
                                </div>
                            </div>

                            <div class="agregar_archivo-formInst2">
                                <input type='file' id="uploadImage4" name="urlimagenEps[]" onchange="previewImage(4);"/>
                            </div>

                            <labe class="col-12 text_infoImg-formInst"> Tamaño 120px x 60px. Peso máximo 300kb </label>
                        </div>  

                    @elseif($objContadorEps->cantidad == 4)
                        <label for="example-date-input" class="col-12 text_label-formInst pb-0"> No se pueden agregar más convenios de EPS </label>
                    @endif

                    <!-- **************************************************************** FORMULARIO IPS ************************************************************** -->
                    @if($objContadorIps->cantidad == 0)
                        <div class="col-12 content_agregarImg-formInst form-group">
                            <label for="example-date-input" class="col-12 text_label-formInst"> Suba imágenes con respecto a los convenios que tengan con las IPS </label>
                        </div>

                        <div class="col-10 col-md-6 content_agregarImg-formInst form-group">
                            <div class="col-10 img_selccionada-formProf">
                                <div class="img_anexada-formProf">
                                    <img id="uploadPreview5"/>
                                </div>
                            </div>

                            <div class="agregar_archivo-formInst">
                                <input type='file' id="uploadImage5" name="urlimagenIps[]" onchange="previewImage(5);"/>
                            </div>

                            <labe class="col-12 text_infoImg-formInst"> Tamaño 120px x 60px. Peso máximo 300kb </label>
                        </div>

                        <div class="col-10 col-md-6 content_agregarImg-formInst form-group">
                            <div class="col-10 img_selccionada-formProf">
                                <div class="img_anexada-formProf">
                                    <img id="uploadPreview6"/>
                                </div>
                            </div>

                            <div class="agregar_archivo-formInst2">
                                <input type='file' id="uploadImage6" name="urlimagenIps[]" onchange="previewImage(6);"/>
                            </div>

                            <labe class="col-12 text_infoImg-formInst"> Tamaño 120px x 60px. Peso máximo 300kb </label>
                        </div>

                        <div class="col-10 col-md-6 content_agregarImg-formInst form-group hidden-section-formInst">
                            <div class="col-10 img_selccionada-formProf">
                                <div class="img_anexada-formProf">
                                    <img id="uploadPreview7"/>
                                </div>
                            </div>

                            <div class="agregar_archivo-formInst">
                                <input type='file' id="uploadImage7" name="urlimagenIps[]" onchange="previewImage(7);"/>
                            </div>

                            <labe class="col-12 text_infoImg-formInst"> Tamaño 120px x 60px. Peso máximo 300kb </label>
                        </div>

                        <div class="col-10 col-md-6 content_agregarImg-formInst form-group hidden-section-formInst">
                            <div class="col-10 img_selccionada-formProf">
                                <div class="img_anexada-formProf">
                                    <img id="uploadPreview8"/>
                                </div>
                            </div>

                            <div class="agregar_archivo-formInst2">
                                <input type='file' id="uploadImage8" name="urlimagenIps[]" onchange="previewImage(8);"/>
                            </div>

                            <labe class="col-12 text_infoImg-formInst"> Tamaño 120px x 60px. Peso máximo 300kb </label>
                        </div>

                    @elseif($objContadorIps->cantidad == 1)
                        <div class="col-12 content_agregarImg-formInst form-group">
                            <label for="example-date-input" class="col-12 text_label-formInst"> Suba imágenes con respecto a los convenios que tengan con las IPS </label>
                        </div>

                        <div class="col-10 col-md-6 content_agregarImg-formInst form-group hidden-section-formInst">
                            <div class="col-10 img_selccionada-formProf">
                                <div class="img_anexada-formProf">
                                    <img id="uploadPreview6"/>
                                </div>
                            </div>

                            <div class="agregar_archivo-formInst2">
                                <input type='file' id="uploadImage6" name="urlimagenIps[]" onchange="previewImage(6);"/>
                            </div>

                            <labe class="col-12 text_infoImg-formInst"> Tamaño 120px x 60px. Peso máximo 300kb </label>
                        </div>

                        <div class="col-10 col-md-6 content_agregarImg-formInst form-group">
                            <div class="col-10 img_selccionada-formProf">
                                <div class="img_anexada-formProf">
                                    <img id="uploadPreview7"/>
                                </div>
                            </div>

                            <div class="agregar_archivo-formInst">
                                <input type='file' id="uploadImage7" name="urlimagenIps[]" onchange="previewImage(7);"/>
                            </div>

                            <labe class="col-12 text_infoImg-formInst"> Tamaño 120px x 60px. Peso máximo 300kb </label>
                        </div>

                        <div class="col-10 col-md-6 content_agregarImg-formInst form-group">
                            <div class="col-10 img_selccionada-formProf">
                                <div class="img_anexada-formProf">
                                    <img id="uploadPreview8"/>
                                </div>
                            </div>

                            <div class="agregar_archivo-formInst2">
                                <input type='file' id="uploadImage8" name="urlimagenIps[]" onchange="previewImage(8);"/>
                            </div>

                            <labe class="col-12 text_infoImg-formInst"> Tamaño 120px x 60px. Peso máximo 300kb </label>
                        </div>

                    @elseif($objContadorIps->cantidad == 2)
                        <div class="col-12 content_agregarImg-formInst form-group">
                            <label for="example-date-input" class="col-12 text_label-formInst"> Suba imágenes con respecto a los convenios que tengan con las IPS </label>
                        </div>

                        <div class="col-10 col-md-6 content_agregarImg-formInst form-group">
                            <div class="col-10 img_selccionada-formProf">
                                <div class="img_anexada-formProf">
                                    <img id="uploadPreview7"/>
                                </div>
                            </div>

                            <div class="agregar_archivo-formInst">
                                <input type='file' id="uploadImage7" name="urlimagenIps[]" onchange="previewImage(7);"/>
                            </div>

                            <labe class="col-12 text_infoImg-formInst"> Tamaño 120px x 60px. Peso máximo 300kb </label>
                        </div>

                        <div class="col-10 col-md-6 content_agregarImg-formInst form-group">
                            <div class="col-10 img_selccionada-formProf">
                                <div class="img_anexada-formProf">
                                    <img id="uploadPreview8"/>
                                </div>
                            </div>

                            <div class="agregar_archivo-formInst2">
                                <input type='file' id="uploadImage8" name="urlimagenIps[]" onchange="previewImage(8);"/>
                            </div>

                            <labe class="col-12 text_infoImg-formInst"> Tamaño 120px x 60px. Peso máximo 300kb </label>
                        </div>

                    @elseif($objContadorIps->cantidad == 3)
                        <div class="col-12 content_agregarImg-formInst form-group">
                            <label for="example-date-input" class="col-12 text_label-formInst"> Suba imágenes con respecto a los convenios que tengan con las IPS </label>
                        </div>

                        <div class="col-10 col-md-6 content_agregarImg-formInst form-group">
                            <div class="col-10 img_selccionada-formProf">
                                <div class="img_anexada-formProf">
                                    <img id="uploadPreview8"/>
                                </div>
                            </div>

                            <div class="agregar_archivo-formInst2">
                                <input type='file' id="uploadImage8" name="urlimagenIps[]" onchange="previewImage(8);"/>
                            </div>

                            <labe class="col-12 text_infoImg-formInst"> Tamaño 120px x 60px. Peso máximo 300kb </label>
                        </div>

                    @elseif($objContadorIps->cantidad == 4)
                        <label for="example-date-input" class="col-12 text_label-formInst pb-0"> No se pueden agregar más convenios de IPS </label>
                    @endif
 
                    <!-- **************************************************************** FORMULARIO PREPAGADA ************************************************************** -->
                    @if($objContadorPrepa->cantidad == 0)
                        <div class="col-12 content_agregarImg-formInst form-group">
                            <label for="example-date-input" class="col-12 text_label-formInst"> Suba imágenes con respecto a los convenios que tengan con medicina prepagada </label>
                        </div>

                        <div class="col-10 col-md-6 content_agregarImg-formInst form-group">
                            <div class="col-10 img_selccionada-formProf">
                                <div class="img_anexada-formProf">
                                    <img id="uploadPreview9"/>
                                </div>
                            </div>

                            <div class="agregar_archivo-formInst">
                                <input type='file' id="uploadImage9" name="urlimagenPre[]" onchange="previewImage(9);"/>
                            </div>

                            <labe class="col-12 text_infoImg-formInst"> Tamaño 120px x 60px. Peso máximo 300kb </label>
                        </div>

                        <div class="col-10 col-md-6 content_agregarImg-formInst form-group">
                            <div class="col-10 img_selccionada-formProf">
                                <div class="img_anexada-formProf">
                                    <img id="uploadPreview10"/>
                                </div>
                            </div>

                            <div class="agregar_archivo-formInst2">
                                <input type='file' id="uploadImage10" name="urlimagenPre[]" onchange="previewImage(10);"/>
                            </div>

                            <labe class="col-12 text_infoImg-formInst"> Tamaño 120px x 60px. Peso máximo 300kb </label>
                        </div>

                        <div class="col-10 col-md-6 content_agregarImg-formInst form-group hidden-section-formInst">
                            <div class="col-10 img_selccionada-formProf">
                                <div class="img_anexada-formProf">
                                    <img id="uploadPreview11"/>
                                </div>
                            </div>

                            <div class="agregar_archivo-formInst">
                                <input type='file' id="uploadImage11" name="urlimagenPre[]" onchange="previewImage(11);"/>
                            </div>

                            <labe class="col-12 text_infoImg-formInst"> Tamaño 120px x 60px. Peso máximo 300kb </label>
                        </div>

                        <div class="col-10 col-md-6 content_agregarImg-formInst form-group hidden-section-formInst">
                            <div class="col-10 img_selccionada-formProf">
                                <div class="img_anexada-formProf">
                                    <img id="uploadPreview12"/>
                                </div>
                            </div>

                            <div class="agregar_archivo-formInst2">
                                <input type='file' id="uploadImage12" name="urlimagenPre[]" onchange="previewImage(12);"/>
                            </div>

                            <labe class="col-12 text_infoImg-formInst"> Tamaño 120px x 60px. Peso máximo 300kb </label>
                        </div>

                    @elseif($objContadorPrepa->cantidad == 1)
                        <div class="col-12 content_agregarImg-formInst form-group">
                            <label for="example-date-input" class="col-12 text_label-formInst"> Suba imágenes con respecto a los convenios que tengan con medicina prepagada </label>
                        </div>

                        <div class="col-10 col-md-6 content_agregarImg-formInst form-group hidden-section-formInst">
                            <div class="col-10 img_selccionada-formProf">
                                <div class="img_anexada-formProf">
                                    <img id="uploadPreview10"/>
                                </div>
                            </div>

                            <div class="agregar_archivo-formInst2">
                                <input type='file' id="uploadImage10" name="urlimagenPre[]" onchange="previewImage(10);"/>
                            </div>

                            <labe class="col-12 text_infoImg-formInst"> Tamaño 120px x 60px. Peso máximo 300kb </label>
                        </div>

                        <div class="col-10 col-md-6 content_agregarImg-formInst form-group">
                            <div class="col-10 img_selccionada-formProf">
                                <div class="img_anexada-formProf">
                                    <img id="uploadPreview11"/>
                                </div>
                            </div>

                            <div class="agregar_archivo-formInst">
                                <input type='file' id="uploadImage11" name="urlimagenPre[]" onchange="previewImage(11);"/>
                            </div>

                            <labe class="col-12 text_infoImg-formInst"> Tamaño 120px x 60px. Peso máximo 300kb </label>
                        </div>

                        <div class="col-10 col-md-6 content_agregarImg-formInst form-group">
                            <div class="col-10 img_selccionada-formProf">
                                <div class="img_anexada-formProf">
                                    <img id="uploadPreview12"/>
                                </div>
                            </div>

                            <div class="agregar_archivo-formInst2">
                                <input type='file' id="uploadImage12" name="urlimagenPre[]" onchange="previewImage(12);"/>
                            </div>

                            <labe class="col-12 text_infoImg-formInst"> Tamaño 120px x 60px. Peso máximo 300kb </label>
                        </div>

                    @elseif($objContadorPrepa->cantidad == 2)
                        <div class="col-12 content_agregarImg-formInst form-group">
                            <label for="example-date-input" class="col-12 text_label-formInst"> Suba imágenes con respecto a los convenios que tengan con medicina prepagada </label>
                        </div>

                        <div class="col-10 col-md-6 content_agregarImg-formInst form-group">
                            <div class="col-10 img_selccionada-formProf">
                                <div class="img_anexada-formProf">
                                    <img id="uploadPreview11"/>
                                </div>
                            </div>

                            <div class="agregar_archivo-formInst">
                                <input type='file' id="uploadImage11" name="urlimagenPre[]" onchange="previewImage(11);"/>
                            </div>

                            <labe class="col-12 text_infoImg-formInst"> Tamaño 120px x 60px. Peso máximo 300kb </label>
                        </div>

                        <div class="col-10 col-md-6 content_agregarImg-formInst form-group">
                            <div class="col-10 img_selccionada-formProf">
                                <div class="img_anexada-formProf">
                                    <img id="uploadPreview12"/>
                                </div>
                            </div>

                            <div class="agregar_archivo-formInst2">
                                <input type='file' id="uploadImage12" name="urlimagenPre[]" onchange="previewImage(12);"/>
                            </div>

                            <labe class="col-12 text_infoImg-formInst"> Tamaño 120px x 60px. Peso máximo 300kb </label>
                        </div>

                    @elseif($objContadorPrepa->cantidad == 3)
                        <div class="col-12 content_agregarImg-formInst form-group">
                            <label for="example-date-input" class="col-12 text_label-formInst"> Suba imágenes con respecto a los convenios que tengan con medicina prepagada </label>
                        </div>

                        <div class="col-10 col-md-6 content_agregarImg-formInst form-group">
                            <div class="col-10 img_selccionada-formProf">
                                <div class="img_anexada-formProf">
                                    <img id="uploadPreview12"/>
                                </div>
                            </div>

                            <div class="agregar_archivo-formInst2">
                                <input type='file' id="uploadImage12" name="urlimagenPre[]" onchange="previewImage(12);"/>
                            </div>

                            <labe class="col-12 text_infoImg-formInst"> Tamaño 120px x 60px. Peso máximo 300kb </label>
                        </div>

                    @elseif($objContadorPrepa->cantidad == 4)
                        <label for="example-date-input" class="col-12 text_label-formInst pb-0"> No se pueden agregar más convenios de medicina prepagada </label>
                    @endif
                  
                </div>

                <!-- Botón guardar información -->
                <div class="col-12 content_btnEnviar-formInst">
                    <button type="submit" class="btn2_enviar-formInst"> Guardar
                        <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flechaBtn_guardar-formInst" alt=""> 
                    </button>
                </div>
            </form>
        </div>
        <!--------------------------------------------      Fin 7 septima parte del formulario *** CONVENIOS ***      --------------------------------------------------------->

        <!-- Secciones de los botones anterior y siguiente -->
        <div class="col-lg-10 col-xl-8 content_botonesInferiores-formInst">
            <div class="col-md-3 content_btn-anter-formInst">
                <button type="submit" class="boton_inferior-anterior-formInst" onclick="hideBtnPrevious(this)" code-position="aboutInstitution">
                    <img src="{{URL::asset('/img/formulario-profesional/icono-flecha-gris.svg')}}" class="flechaBtn_guardar-formInst" alt=""> 
                    Anterior
                </button>
            </div>

            <div class="col-md-3 content_btn-siguient-formInst">
                <button type="submit" class="boton_inferior-siguiente-formInst" onclick="hideBtnNext(this)" code-position="aboutInstitution"> Siguiente
                    <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flechaBtn_guardar-formInst" alt=""> 
                </button>
            </div>
        </div>
    </div>

    <!-- 4* Contenedor principal de la opción PROFESIONALES -->
    <div class="container-fluid professional_inst content_principal-formInst"> <!-- Clase "professional_inst" creada para ocultar y mostrar elementos desde la función on click en el archivo formularios.js  -->
        <!--------------------------------------------      Inicio 8 octava parte del formulario *** PROFESIONALES ***      --------------------------------------------------->
        <div class="col-lg-10 col-xl-8 pb-3 content_tarjetasInfo-formInst">
            <h5 class="col-lg-12 icon_profesionales-formInst"> Profesionales </h5>

            <div class="col-12 col-md-9 row containt_profGuardado-formInst">
                @foreach($objProfeInsti as $objProfeInsti)
                    @if(!empty($objProfeInsti->foto_perfil_institucion))
                        <div class="col-md-4 mt-3 contain_imgUsuario-formImg">
                            <img id="imagenPrevisualizacion" class="img_usuario-formInst" src="{{URL::asset($objProfeInsti->foto_perfil_institucion)}}">
                        </div>
                        
                        <div class="col-md-8 mt-3 datos_principales-formInst">
                            <a href="{{url('/FormularioInstituciondelete8/'.$objProfeInsti->id_profesional_inst)}}">
                                <button type="submit" class="close" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </a> 

                            <div class="col-md-6 section_inputRight-text-formInst">
                                <div class="form-group">
                                    <span>{{$objProfeInsti->primer_nombre}} {{$objProfeInsti->segundo_nombre}}</span>
                                </div>
                            </div>

                            <div class="col-md-6 section_inputRight-text-formInst">
                                <div class="form-group">
                                    <span>{{$objProfeInsti->primer_apellido}} {{$objProfeInsti->segundo_apellido}}</span>
                                </div>
                            </div>

                            <div class="col-md-12 section_inputRight-text-formInst">
                                <div class="form-group">
                                    <span>{{$objProfeInsti->especialidad_uno}}</span>
                                </div> 

                                <div class="form-group">
                                    <span> {{$objProfeInsti->especialidad_dos}}</span>
                                </div> 
                            </div>  
                        </div>
                    @endif
                @endforeach
            </div>

            <form method="POST" action="{{ url ('/FormularioInstitucionSave8') }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"> 

                @if($objContadorProfeInsti->cantidad == 0)
                    <!-- Profesional numero 1 -->
                    <div class="row fila_infoBasica-formInst">
                        <div class="col-md-3 contain_imgUsuario-formImg">
                            <img class="img_usuario-formInst" id="imagenPrevi1">

                            <input class="input_imgUsuario-formInst" type="file" id="selecArchivos1" name="foto_perfil_institucion[]" onchange="previewImageProf(1);" accept="image/png, image/jpeg">

                            <label class="col-12 icon_subirFoto-formInst text_usuario-formInst"> Subir foto de perfil </label>
                        </div>

                        <div class="row col-md-9 datos_principales-formInst">
                            <div class="col-md-6 section_inputRight-text-formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Nombres </label>

                                <div class="col-12 nombres_usuario-formInst">
                                    <input class="input_nomApl-prefes-formProf" type="text" name="primer_nombre[]" value="">

                                    <input class="input_nomApl-prefes-formProf"   type="text" name="segundo_nombre[]" value="">
                                </div>        
                            </div>

                            <div class="col-md-6 section_inputRight-text-formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Apellidos </label>

                                <div class="col-12 nombres_usuario-formInst">
                                    <input class="input_nomApl-prefes-formProf"   type="text" name="primer_apellido[]" value="">
                    
                                    <input class="input_nomApl-prefes-formProf"   type="text" name="segundo_apellido[]" value="">
                                </div>  
                            </div>

                            <div class="col-md-12 section_inputRight-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Especialidades </label>

                                    <input class="col-12 form-control"   type="text" name="especialidad_uno[]" value="">
                                </div>

                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Especialidades </label>

                                    <input class="col-12 form-control"   type="text" name="especialidad_dos[]" value="">
                                </div>
                            </div>
                        </div>
                    </div> 

                    <!-- Profesional numero 2 -->
                    <div class="row fila_infoBasica-formInst hidden-section-formInst">
                        <div class="col-md-3 contain_imgUsuario-formImg">
                            <img class="img_usuario-formInst" id="imagenPrevi2">

                            <input class="input_imgUsuario-formInst" type="file" id="selecArchivos2" name="foto_perfil_institucion[]" onchange="previewImageProf(2);" accept="image/png, image/jpeg">

                            <label class="col-12 icon_subirFoto-formInst text_usuario-formInst"> Subir foto de perfil </label>
                        </div>

                        <div class="row col-md-9 datos_principales-formInst">
                            <div class="col-md-6 section_inputRight-text-formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Nombres </label>

                                <div class="col-12 nombres_usuario-formInst">
                                    <input class="input_nomApl-prefes-formProf" type="text" name="primer_nombre[]" value="">

                                    <input class="input_nomApl-prefes-formProf"   type="text" name="segundo_nombre[]" value="">
                                </div>        
                            </div>

                            <div class="col-md-6 section_inputRight-text-formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Apellidos </label>

                                <div class="col-12 nombres_usuario-formInst">
                                    <input class="input_nomApl-prefes-formProf"   type="text" name="primer_apellido[]" value="">
                    
                                    <input class="input_nomApl-prefes-formProf"   type="text" name="segundo_apellido[]" value="">
                                </div>  
                            </div>

                            <div class="col-md-12 section_inputRight-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Especialidades </label>

                                    <input class="col-12 form-control"   type="text" name="especialidad_uno[]" value="">
                                </div>

                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Especialidades </label>

                                    <input class="col-12 form-control"   type="text" name="especialidad_dos[]" value="">
                                </div>
                            </div>
                        </div>
                    </div> 

                    <!-- Profesional numero 3 -->
                    <div class="row fila_infoBasica-formInst hidden-section-formInst">
                        <div class="col-md-3 contain_imgUsuario-formImg">
                            <img class="img_usuario-formInst" id="imagenPrevi3">

                            <input class="input_imgUsuario-formInst" type="file" id="selecArchivos3" name="foto_perfil_institucion[]" onchange="previewImageProf(3);" accept="image/png, image/jpeg">

                            <label class="col-12 icon_subirFoto-formInst text_usuario-formInst"> Subir foto de perfil </label>
                        </div>

                        <div class="row col-md-9 datos_principales-formInst">
                            <div class="col-md-6 section_inputRight-text-formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Nombres </label>

                                <div class="col-12 nombres_usuario-formInst">
                                    <input class="input_nomApl-prefes-formProf" type="text" name="primer_nombre[]" value="">

                                    <input class="input_nomApl-prefes-formProf"   type="text" name="segundo_nombre[]" value="">
                                </div>        
                            </div>

                            <div class="col-md-6 section_inputRight-text-formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Apellidos </label>

                                <div class="col-12 nombres_usuario-formInst">
                                    <input class="input_nomApl-prefes-formProf"   type="text" name="primer_apellido[]" value="">
                    
                                    <input class="input_nomApl-prefes-formProf"   type="text" name="segundo_apellido[]" value="">
                                </div>  
                            </div>

                            <div class="col-md-12 section_inputRight-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Especialidades </label>

                                    <input class="col-12 form-control"   type="text" name="especialidad_uno[]" value="">
                                </div>

                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Especialidades </label>

                                    <input class="col-12 form-control"   type="text" name="especialidad_dos[]" value="">
                                </div>
                            </div>
                        </div>
                    </div>

                @elseif($objContadorProfeInsti->cantidad == 1)
                    <!-- Profesional numero 2 -->
                    <div class="row fila_infoBasica-formInst">
                        <div class="col-md-3 contain_imgUsuario-formImg">
                            <img class="img_usuario-formInst" id="imagenPrevi2">

                            <input class="input_imgUsuario-formInst" type="file" id="selecArchivos2" name="foto_perfil_institucion[]" onchange="previewImageProf(2);" accept="image/png, image/jpeg">

                            <label class="col-12 icon_subirFoto-formInst text_usuario-formInst"> Subir foto de perfil </label>
                        </div>

                        <div class="row col-md-9 datos_principales-formInst">
                            <div class="col-md-6 section_inputRight-text-formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Nombres </label>

                                <div class="col-12 nombres_usuario-formInst">
                                    <input class="input_nomApl-prefes-formProf" type="text" name="primer_nombre[]" value="">

                                    <input class="input_nomApl-prefes-formProf"   type="text" name="segundo_nombre[]" value="">
                                </div>        
                            </div>

                            <div class="col-md-6 section_inputRight-text-formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Apellidos </label>

                                <div class="col-12 nombres_usuario-formInst">
                                    <input class="input_nomApl-prefes-formProf"   type="text" name="primer_apellido[]" value="">
                    
                                    <input class="input_nomApl-prefes-formProf"   type="text" name="segundo_apellido[]" value="">
                                </div>  
                            </div>

                            <div class="col-md-12 section_inputRight-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Especialidades </label>

                                    <input class="col-12 form-control"   type="text" name="especialidad_uno[]" value="">
                                </div>

                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Especialidades </label>

                                    <input class="col-12 form-control"   type="text" name="especialidad_dos[]" value="">
                                </div>
                            </div>
                        </div>
                    </div> 

                    <!-- Profesional numero 3 -->
                    <div class="row fila_infoBasica-formInst hidden-section-formInst">
                        <div class="col-md-3 contain_imgUsuario-formImg">
                            <img class="img_usuario-formInst" id="imagenPrevi3">

                            <input class="input_imgUsuario-formInst" type="file" id="selecArchivos3" name="foto_perfil_institucion[]" onchange="previewImageProf(3);" accept="image/png, image/jpeg">

                            <label class="col-12 icon_subirFoto-formInst text_usuario-formInst"> Subir foto de perfil </label>
                        </div>

                        <div class="row col-md-9 datos_principales-formInst">
                            <div class="col-md-6 section_inputRight-text-formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Nombres </label>

                                <div class="col-12 nombres_usuario-formInst">
                                    <input class="input_nomApl-prefes-formProf" type="text" name="primer_nombre[]" value="">

                                    <input class="input_nomApl-prefes-formProf"   type="text" name="segundo_nombre[]" value="">
                                </div>        
                            </div>

                            <div class="col-md-6 section_inputRight-text-formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Apellidos </label>

                                <div class="col-12 nombres_usuario-formInst">
                                    <input class="input_nomApl-prefes-formProf"   type="text" name="primer_apellido[]" value="">
                    
                                    <input class="input_nomApl-prefes-formProf"   type="text" name="segundo_apellido[]" value="">
                                </div>  
                            </div>

                            <div class="col-md-12 section_inputRight-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Especialidades </label>

                                    <input class="col-12 form-control"   type="text" name="especialidad_uno[]" value="">
                                </div>

                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Especialidades </label>

                                    <input class="col-12 form-control"   type="text" name="especialidad_dos[]" value="">
                                </div>
                            </div>
                        </div>
                    </div> 
                @elseif($objContadorProfeInsti->cantidad == 2)
                    <!-- Profesional numero 3 -->
                    <div class="row fila_infoBasica-formInst">
                        <div class="col-md-3 contain_imgUsuario-formImg">
                            <img class="img_usuario-formInst" id="imagenPrevi3">

                            <input class="input_imgUsuario-formInst" type="file" id="selecArchivos3" name="foto_perfil_institucion[]" onchange="previewImageProf(3);" accept="image/png, image/jpeg">

                            <label class="col-12 icon_subirFoto-formInst text_usuario-formInst"> Subir foto de perfil </label>
                        </div>

                        <div class="row col-md-9 datos_principales-formInst">
                            <div class="col-md-6 section_inputRight-text-formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Nombres </label>

                                <div class="col-12 nombres_usuario-formInst">
                                    <input class="input_nomApl-prefes-formProf" type="text" name="primer_nombre[]" value="">

                                    <input class="input_nomApl-prefes-formProf"   type="text" name="segundo_nombre[]" value="">
                                </div>        
                            </div>

                            <div class="col-md-6 section_inputRight-text-formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Apellidos </label>

                                <div class="col-12 nombres_usuario-formInst">
                                    <input class="input_nomApl-prefes-formProf"   type="text" name="primer_apellido[]" value="">
                    
                                    <input class="input_nomApl-prefes-formProf"   type="text" name="segundo_apellido[]" value="">
                                </div>  
                            </div>

                            <div class="col-md-12 section_inputRight-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Especialidades </label>

                                    <input class="col-12 form-control"   type="text" name="especialidad_uno[]" value="">
                                </div>

                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Especialidades </label>

                                    <input class="col-12 form-control"   type="text" name="especialidad_dos[]" value="">
                                </div>
                            </div>
                        </div>
                    </div> 
                @elseif($objContadorProfeInsti->cantidad == 3)
                    <label for="example-date-input" class="col-12 text_label-formInst pb-0"> No se peden agregar más profesionales </label>
                @endif

                <!-- Botón guardar información -->
                <div class="col-12 content_btnEnviar-formInst">
                    <button type="submit" class="btn2_enviar-formInst"> Guardar
                        <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flechaBtn_guardar-formInst" alt=""> 
                    </button>
                </div>
            </form>
        </div>
        <!--------------------------------------------      Fin 8 octava parte del formulario *** PROFESIONALES ***      ------------------------------------------------------>

        <!-- Secciones de los botones anterior y siguiente -->
        <div class="col-lg-10 col-xl-8 content_botonesInferiores-formInst">
            <div class="col-md-3 content_btn-anter-formInst">
                <button type="submit" class="boton_inferior-anterior-formInst" onclick="hideBtnPrevious(this)" code-position="professionalInst">
                    <img src="{{URL::asset('/img/formulario-profesional/icono-flecha-gris.svg')}}" class="flechaBtn_guardar-formInst" alt=""> 
                    Anterior
                </button>
            </div>

            <div class="col-md-3 content_btn-siguient-formInst">
                <button type="submit" class="boton_inferior-siguiente-formInst" onclick="hideBtnNext(this)" code-position="professionalInst"> Siguiente
                    <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flechaBtn_guardar-formInst" alt=""> 
                </button>
            </div>
        </div>   
    </div>

    <!-- 5* Contenedor principal de la opción CERTIFICACIONES -->
    <div class="container-fluid certifications_inst content_principal-formInst"> <!-- Clase "certifications_inst" creada para ocultar y mostrar elementos desde la función on click en el archivo formularios.js  -->
        <!--------------------------------------------      Inicio 9 novena parte del formulario *** CERTIFICACIONES ***      ------------------------------------------------->
        <div class="col-lg-10 col-xl-8 pb-3 content_tarjetasInfo-formInst">
            <h5 class="col-lg-12 icon_certificaciones-formInst"> Certificaciones </h5>

            <p class="text_superior-proced-formInst"> A continuación suba imágenes relacionadas con sus certificaciones, con fecha, nombre y descripción. </p>

            <!-- Modulo de los Certificaciones con información -->
            <div class="row col-12 p-0 m-0">
                @foreach($objCertificaciones as $objCertificaciones)
                    @if(!empty($objCertificaciones->imgcertificado))
                        <!-- Contenido Certificaciones -->    
                        <div class="col-6 mt-3 content_antes-formInst">
                            <div class="col-12 content_cierreX-formInst">
                                <a href="{{url('/FormularioInstituciondelete9/'.$objCertificaciones->id_certificacion)}}">
                                    <button type="submit" class="close" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </a>
                            </div>
                            
                            <div class="col-12 content_agregarImg-formInst form-group">

                                <div class="col-10 img_selccionada-formInst">
                                    <img class="img_anexada-formInst"  src="{{URL::asset($objCertificaciones->imgcertificado)}}">
                                </div>

                                <div class="col-12 px-0">
                                    <div class="form-group">
                                        <span>{{$objCertificaciones->titulocertificado}}</span>
                                    </div>
                                </div>

                                <div class="col-12 px-0">
                                    <div class="form-group">
                                        <span>{{$objCertificaciones->descrpcioncertificado}}</span>
                                    </div>
                                </div>

                                <div class="col-12 px-0">
                                    <div class="form-group">
                                        <span>{{$objCertificaciones->fechacertificado}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach 
            </div>

            <form method="POST" action="{{ url ('/FormularioInstitucionSave9') }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"> 

                @if($objContadorCertificaciones->cantidad == 0)
                    <!-- Modulo de los Certificaciones sin información-->
                    <div class="row content_antDesp-formInst">
                        <!-- Contenido PREMIO izquierdo -->
                        <div class="col-md-6 photo1 section_inputLeft-text-formInst">
                            <div class="col-12 section_inputLeft-text-formInst content_agregarImg-formInst form-group">
                                <div class="col-10 img_selccionada-formInst">
                                    <div class="img_anexada-formInst" id="previewPremioLeft1"></div>
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="imgPremio1" name="imgcertificado[]"/>
                                </div>

                                <labe class="col-12 text_infoImg-formInst"> Tamaño 356 x 326px. Peso máximo 300kb </label> 
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>
                                
                                    <input class="form-control" type="date"  id="fechacertificado" name="fechacertificado[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Título de la imagen 1 </label>

                                    <input class="form-control" id="titulocertificado"  type="text" name="titulocertificado[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Descripción de la certificación </label>
                                    
                                    <input class="form-control" id="descrpcioncertificado"  type="text" name="descrpcioncertificado[]" value="">

                                    <labe class="col-12 text_infoImg-formInst"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>

                        <!-- Contenido Certificaciones derecho -->
                        <div class="col-md-6 photo2 section_inputRight-text-formInst">
                            <div class="col-12 section_inputRight-text-formInst content_agregarImg-formInst form-group">
                                <div class="col-10 img_selccionada-formInst">
                                    <div class="img_anexada-formInst" id="previewPremioRight1"></div>
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="imgantes" name="imgcertificado[]"/>
                                </div>

                                <labe class="col-12 text_infoImg-formInst"> Tamaño 356 x 326px. Peso máximo 300kb </label> 
                            </div>

                            <div class="col-12 section_inputRight-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>
                                    
                                    <input class="form-control" type="date"  id="fechacertificado" name="fechacertificado[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputRight-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Título de la imagen 2 </label>

                                    <input class="form-control" id="titulocertificado"  type="text" name="titulocertificado[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputRight-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Descripción de la certificación </label>

                                    <input class="form-control" id="descrpcioncertificado"  type="text" name="descrpcioncertificado[]" value="">

                                    <labe class="col-12 text_infoImg-formInst"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modulo de los Certificaciones sin información-->
                    <div class="row content_antDesp-formInst">
                        <!-- Contenido PREMIO izquierdo -->
                        <div class="col-md-6 photo3 section_inputLeft-text-formInst">
                            <div class="col-12 section_inputLeft-text-formInst content_agregarImg-formInst form-group">
                                <div class="col-10 img_selccionada-formInst">
                                    <div class="img_anexada-formInst" id="previewPremioLeft1"></div>
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="imgPremio1" name="imgcertificado[]"/>
                                </div>

                                <labe class="col-12 text_infoImg-formInst"> Tamaño 356 x 326px. Peso máximo 300kb </label> 
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>
                                
                                    <input class="form-control" type="date"  id="fechacertificado" name="fechacertificado[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Título de la imagen 3 </label>

                                    <input class="form-control" id="titulocertificado"  type="text" name="titulocertificado[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Descripción de la certificación </label>
                                    
                                    <input class="form-control" id="descrpcioncertificado"  type="text" name="descrpcioncertificado[]" value="">

                                    <labe class="col-12 text_infoImg-formInst"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>

                        <!-- Contenido Certificaciones derecho -->
                        <div class="col-md-6 photo4 section_inputRight-text-formInst">
                            <div class="col-12 section_inputRight-text-formInst content_agregarImg-formInst form-group">
                                <div class="col-10 img_selccionada-formInst">
                                    <div class="img_anexada-formInst" id="previewPremioRight1"></div>
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="imgantes" name="imgcertificado[]"/>
                                </div>

                                <labe class="col-12 text_infoImg-formInst"> Tamaño 356 x 326px. Peso máximo 300kb </label> 
                            </div>

                            <div class="col-12 section_inputRight-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>
                                    
                                    <input class="form-control" type="date"  id="fechacertificado" name="fechacertificado[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputRight-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Título de la imagen 4 </label>

                                    <input class="form-control" id="titulocertificado"  type="text" name="titulocertificado[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputRight-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Descripción de la certificación </label>

                                    <input class="form-control" id="descrpcioncertificado"  type="text" name="descrpcioncertificado[]" value="">

                                    <labe class="col-12 text_infoImg-formInst"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>
                    </div>

                @elseif($objContadorCertificaciones->cantidad == 1)
                    <!-- Modulo de los Certificaciones sin información-->
                    <div class="row content_antDesp-formInst">
                        <!-- Contenido PREMIO izquierdo -->
                        <div class="col-md-6 photo1 section_inputLeft-text-formInst">
                            <div class="col-12 section_inputLeft-text-formInst content_agregarImg-formInst form-group">
                                <div class="col-10 img_selccionada-formInst">
                                    <div class="img_anexada-formInst" id="previewPremioLeft1"></div>
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="imgPremio1" name="imgcertificado[]"/>
                                </div>

                                <labe class="col-12 text_infoImg-formInst"> Tamaño 356 x 326px. Peso máximo 300kb </label> 
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>
                                
                                    <input class="form-control" type="date"  id="fechacertificado" name="fechacertificado[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Título de la imagen 1 </label>

                                    <input class="form-control" id="titulocertificado"  type="text" name="titulocertificado[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Descripción de la certificación </label>
                                    
                                    <input class="form-control" id="descrpcioncertificado"  type="text" name="descrpcioncertificado[]" value="">

                                    <labe class="col-12 text_infoImg-formInst"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>

                        <!-- Contenido Certificaciones derecho -->
                        <div class="col-md-6 photo2 section_inputRight-text-formInst">
                            <div class="col-12 section_inputRight-text-formInst content_agregarImg-formInst form-group">
                                <div class="col-10 img_selccionada-formInst">
                                    <div class="img_anexada-formInst" id="previewPremioRight1"></div>
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="imgantes" name="imgcertificado[]"/>
                                </div>

                                <labe class="col-12 text_infoImg-formInst"> Tamaño 356 x 326px. Peso máximo 300kb </label> 
                            </div>

                            <div class="col-12 section_inputRight-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>
                                    
                                    <input class="form-control" type="date"  id="fechacertificado" name="fechacertificado[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputRight-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Título de la imagen 2 </label>

                                    <input class="form-control" id="titulocertificado"  type="text" name="titulocertificado[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputRight-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Descripción de la certificación </label>

                                    <input class="form-control" id="descrpcioncertificado"  type="text" name="descrpcioncertificado[]" value="">

                                    <labe class="col-12 text_infoImg-formInst"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modulo de los Certificaciones sin información-->
                    <div class="row content_antDesp-formInst">
                        <!-- Contenido PREMIO izquierdo -->
                        <div class="col-md-6 photo3 section_inputLeft-text-formInst">
                            <div class="col-12 section_inputLeft-text-formInst content_agregarImg-formInst form-group">
                                <div class="col-10 img_selccionada-formInst">
                                    <div class="img_anexada-formInst" id="previewPremioLeft1"></div>
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="imgPremio1" name="imgcertificado[]"/>
                                </div>

                                <labe class="col-12 text_infoImg-formInst"> Tamaño 356 x 326px. Peso máximo 300kb </label> 
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>
                                
                                    <input class="form-control" type="date"  id="fechacertificado" name="fechacertificado[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Título de la imagen 3 </label>

                                    <input class="form-control" id="titulocertificado"  type="text" name="titulocertificado[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Descripción de la certificación </label>
                                    
                                    <input class="form-control" id="descrpcioncertificado"  type="text" name="descrpcioncertificado[]" value="">

                                    <labe class="col-12 text_infoImg-formInst"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>
                    </div>

                @elseif($objContadorCertificaciones->cantidad == 2)
                    <!-- Modulo de los Certificaciones sin información-->
                    <div class="row content_antDesp-formInst">
                        <!-- Contenido Certificaciones izquierdo -->
                        <div class="col-md-6 photo1 section_inputLeft-text-formInst">
                            <div class="col-12 section_inputLeft-text-formInst content_agregarImg-formInst form-group">
                                <div class="col-10 img_selccionada-formInst">
                                    <div class="img_anexada-formInst" id="previewPremioLeft1"></div>
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="imgPremio1" name="imgcertificado[]"/>
                                </div>

                                <labe class="col-12 text_infoImg-formInst"> Tamaño 356 x 326px. Peso máximo 300kb </label> 
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>
                                
                                    <input class="form-control" type="date"  id="fechacertificado" name="fechacertificado[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Título de la imagen 1 </label>

                                    <input class="form-control" id="titulocertificado"  type="text" name="titulocertificado[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Descripción de la certificación </label>
                                    
                                    <input class="form-control" id="descrpcioncertificado"  type="text" name="descrpcioncertificado[]" value="">

                                    <labe class="col-12 text_infoImg-formInst"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>

                        <!-- Contenido Certificaciones derecho -->
                        <div class="col-md-6 photo2 section_inputRight-text-formInst">
                            <div class="col-12 section_inputRight-text-formInst content_agregarImg-formInst form-group">
                                <div class="col-10 img_selccionada-formInst">
                                    <div class="img_anexada-formInst" id="previewPremioRight1"></div>
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="imgantes" name="imgcertificado[]"/>
                                </div>

                                <labe class="col-12 text_infoImg-formInst"> Tamaño 356 x 326px. Peso máximo 300kb </label> 
                            </div>

                            <div class="col-12 section_inputRight-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>
                                    
                                    <input class="form-control" type="date"  id="fechacertificado" name="fechacertificado[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputRight-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Título de la imagen 2 </label>

                                    <input class="form-control" id="titulocertificado"  type="text" name="titulocertificado[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputRight-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Descripción de la certificación </label>

                                    <input class="form-control" id="descrpcioncertificado"  type="text" name="descrpcioncertificado[]" value="">

                                    <labe class="col-12 text_infoImg-formInst"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif($objContadorCertificaciones->cantidad == 3)
                    <!-- Modulo de los Certificaciones sin información-->
                    <div class="row content_antDesp-formInst">
                        <!-- Contenido PREMIO izquierdo -->
                        <div class="col-md-6 photo1 section_inputLeft-text-formInst">
                            <div class="col-12 section_inputLeft-text-formInst content_agregarImg-formInst form-group">
                                <div class="col-10 img_selccionada-formInst">
                                    <div class="img_anexada-formInst" id="previewPremioLeft1"></div>
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="imgPremio1" name="imgcertificado[]"/>
                                </div>

                                <labe class="col-12 text_infoImg-formInst"> Tamaño 356 x 326px. Peso máximo 300kb </label> 
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>
                                
                                    <input class="form-control" type="date"  id="fechacertificado" name="fechacertificado[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Título de la imagen 1 </label>

                                    <input class="form-control" id="titulocertificado"  type="text" name="titulocertificado[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Descripción de la certificación </label>
                                    
                                    <input class="form-control" id="descrpcioncertificado"  type="text" name="descrpcioncertificado[]" value="">

                                    <labe class="col-12 text_infoImg-formInst"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>
                    </div>

                @elseif($objContadorCertificaciones->cantidad == 4)
                    <span> No se puede agregar más </span>
                @endif 

                <!-- Botón guardar información -->
                <div class="col-12 content_btnEnviar-formInst">
                    <button type="submit" class="btn2_enviar-formInst"> Guardar
                        <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flechaBtn_guardar-formInst" alt=""> 
                    </button>
                </div>
            </form>
        </div>
        <!--------------------------------------------      Fin 9 novena parte del formulario *** CERTIFICACIONES ***      ---------------------------------------------------->

        <!-- Secciones de los botones anterior y siguiente -->
        <div class="col-lg-10 col-xl-8 content_botonesInferiores-formInst">
            <div class="col-md-3 content_btn-anter-formInst">
                <button type="submit" class="boton_inferior-anterior-formInst" onclick="hideBtnPrevious(this)" code-position="certificationsInst">
                    <img src="{{URL::asset('/img/formulario-profesional/icono-flecha-gris.svg')}}" class="flechaBtn_guardar-formInst" alt=""> 
                    Anterior
                </button>
            </div>

            <div class="col-md-3 content_btn-siguient-formInst">
                <button type="submit" class="boton_inferior-siguiente-formInst" onclick="hideBtnNext(this)" code-position="certificationsInst"> Siguiente
                    <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flechaBtn_guardar-formInst" alt=""> 
                </button>
            </div>
        </div>
    </div>

    <!-- 6* Contenedor principal de la opción SEDES -->
    <div class="container-fluid venues_inst content_principal-formInst"> <!-- Clase "venues_inst" creada para ocultar y mostrar elementos desde la función on click en el archivo formularios.js  -->
        <!--------------------------------------------      Inicio 10 decima parte del formulario *** SEDES ***      ---------------------------------------------------------->
        <div class="col-lg-10 col-xl-8 pb-3 content_tarjetasInfo-formInst">
            <h5 class="col-lg-12 icon_sedes-formInst"> Sedes </h5>

            <p class="text_superior-proced-formInst"> A continuación suba imágenes e información de las sedes que tengan de la institución </p>

            <!-- Modulo de los Sedes con información -->
            <div class="row col-12 p-0 m-0">
                @foreach($objSedes as $objSedes)
                    @if(!empty($objSedes->imgsede))
                        <!-- Contenido Certificaciones -->    
                        <div class="col-6 mt-3 content_antes-formInst">
                            <div class="col-12 content_cierreX-formInst">
                                <a href="{{url('/FormularioInstituciondelete10/'.$objSedes->id)}}">
                                    <button type="submit" class="close" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </a>
                            </div>
                            
                            <div class="col-12 content_agregarImg-formInst form-group">
                                <div class="col-10 img_selccionada-formInst">
                                    <img class="img_anexada-formInst" src="{{URL::asset($objSedes->imgsede)}}">
                                </div>

                                <div class="col-12 px-0">
                                    <div class="form-group">
                                        <span>{{$objSedes->nombre}}</span>
                                    </div>
                                </div>

                                <div class="col-12 px-0">
                                    <div class="form-group">
                                        <span>{{$objSedes->direccion}}</span>
                                    </div>
                                </div>

                                <div class="col-12 px-0">
                                    <div class="form-group">
                                        <span>{{$objSedes->horario_sede}}</span>
                                    </div>
                                </div>
                                <div class="col-12 px-0">
                                    <div class="form-group">
                                        <span>{{$objSedes->telefono}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach 
            </div>

            <form method="POST" action="{{ url ('/FormularioInstitucionSave10') }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"> 

                @if($objContadorSedes->cantidad == 0)
                    <!-- Modulo de los Sedes sin información-->
                    <div class="row content_antDesp-formInst">
                        <!-- Contenido Sedes izquierdo -->
                        <div class="col-md-6 photo1 section_inputLeft-text-formInst">
                            <div class="col-12 section_inputLeft-text-formInst content_agregarImg-formInst form-group">
                                <div class="col-10 img_selccionada-formInst">
                                    <div class="img_anexada-formInst" id="previewPremioLeft1"></div>
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="imgsede" name="imgsede[]"/>
                                </div>

                                <labe class="col-12 text_infoImg-formInst"> Tamaño 356 x 326px. Peso máximo 300kb </label> 
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Nombre de la sede </label>

                                    <input class="form-control" id="nombre"  type="text" name="nombre[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Dirrección </label>
                                    
                                    <input class="form-control" id="direccion"  type="text" name="direccion[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Horario </label>
                                    
                                    <input class="form-control" id="horario_sede"  type="text" name="horario_sede[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Teléfono </label>
                                    
                                    <input class="form-control" id="telefono"  type="text" name="telefono[]" value="">
                                </div>
                            </div>
                        </div>

                        <!-- Contenido Sedes derecho -->
                        <div class="col-md-6 photo2 section_inputRight-text-formInst">
                            <div class="col-12 section_inputRight-text-formInst content_agregarImg-formInst form-group">
                                <div class="col-10 img_selccionada-formInst">
                                    <div class="img_anexada-formInst" id="previewPremioRight1"></div>
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="imgsede" name="imgsede[]"/>
                                </div>

                                <labe class="col-12 text_infoImg-formInst"> Tamaño 356 x 326px. Peso máximo 300kb </label> 
                            </div>

                            <div class="col-12 section_inputRight-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Nombre de la sede </label>

                                    <input class="form-control" id="nombre"  type="text" name="nombre[]" value="">
                                </div>
                            </div>
                            <div class="col-12 section_inputRight-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Dirrección </label>
                                    
                                    <input class="form-control" id="direccion"  type="text" name="direccion[]" value="">
                                </div>
                            </div>
                            <div class="col-12 section_inputRight-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Horario </label>
                                    
                                    <input class="form-control" id="horario_sede"  type="text" name="horario_sede[]" value="">
                                </div>
                            </div>
                            <div class="col-12 section_inputRight-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Teléfono </label>
                                    
                                    <input class="form-control" id="telefono"  type="text" name="telefono[]" value="">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modulo de los Sedes sin información-->
                    <div class="row content_antDesp-formInst">
                        <!-- Contenido Sedes izquierdo -->
                        <div class="col-md-6 photo1 section_inputLeft-text-formInst">
                            <div class="col-12 section_inputLeft-text-formInst content_agregarImg-formInst form-group">
                                <div class="col-10 img_selccionada-formInst">
                                    <div class="img_anexada-formInst" id="previewPremioLeft1"></div>
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="imgsede" name="imgsede[]"/>
                                </div>

                                <labe class="col-12 text_infoImg-formInst"> Tamaño 356 x 326px. Peso máximo 300kb </label> 
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Nombre de la sede </label>

                                    <input class="form-control" id="nombre"  type="text" name="nombre[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Dirrección </label>
                                    
                                    <input class="form-control" id="direccion"  type="text" name="direccion[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Horario </label>
                                    
                                    <input class="form-control" id="horario_sede"  type="text" name="horario_sede[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Teléfono </label>
                                    
                                    <input class="form-control" id="telefono"  type="text" name="telefono[]" value="">
                                </div>
                            </div>
                        </div>

                        <!-- Contenido Sedes derecho -->
                        <div class="col-md-6 photo2 section_inputRight-text-formInst">
                            <div class="col-12 section_inputRight-text-formInst content_agregarImg-formInst form-group">
                                <div class="col-10 img_selccionada-formInst">
                                    <div class="img_anexada-formInst" id="previewPremioRight1"></div>
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="imgsede" name="imgsede[]"/>
                                </div>

                                <labe class="col-12 text_infoImg-formInst"> Tamaño 356 x 326px. Peso máximo 300kb </label> 
                            </div>

                            <div class="col-12 section_inputRight-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Nombre de la sede </label>

                                    <input class="form-control" id="nombre"  type="text" name="nombre[]" value="">
                                </div>
                            </div>
                            <div class="col-12 section_inputRight-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Dirrección </label>
                                    
                                    <input class="form-control" id="direccion"  type="text" name="direccion[]" value="">
                                </div>
                            </div>
                            <div class="col-12 section_inputRight-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Horario </label>
                                    
                                    <input class="form-control" id="horario_sede"  type="text" name="horario_sede[]" value="">
                                </div>
                            </div>
                            <div class="col-12 section_inputRight-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Teléfono </label>
                                    
                                    <input class="form-control" id="telefono"  type="text" name="telefono[]" value="">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modulo de los Sedes sin información-->
                    <div class="row content_antDesp-formInst">
                        <!-- Contenido Sedes izquierdo -->
                        <div class="col-md-6 photo1 section_inputLeft-text-formInst">
                            <div class="col-12 section_inputLeft-text-formInst content_agregarImg-formInst form-group">
                                <div class="col-10 img_selccionada-formInst">
                                    <div class="img_anexada-formInst" id="previewPremioLeft1"></div>
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="imgsede" name="imgsede[]"/>
                                </div>

                                <labe class="col-12 text_infoImg-formInst"> Tamaño 356 x 326px. Peso máximo 300kb </label> 
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Nombre de la sede </label>

                                    <input class="form-control" id="nombre"  type="text" name="nombre[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Dirrección </label>
                                    
                                    <input class="form-control" id="direccion"  type="text" name="direccion[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Horario </label>
                                    
                                    <input class="form-control" id="horario_sede"  type="text" name="horario_sede[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Teléfono </label>
                                    
                                    <input class="form-control" id="telefono"  type="text" name="telefono[]" value="">
                                </div>
                            </div>
                        </div>

                        <!-- Contenido Sedes derecho -->
                        <div class="col-md-6 photo2 section_inputRight-text-formInst">
                            <div class="col-12 section_inputRight-text-formInst content_agregarImg-formInst form-group">
                                <div class="col-10 img_selccionada-formInst">
                                    <div class="img_anexada-formInst" id="previewPremioRight1"></div>
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="imgsede" name="imgsede[]"/>
                                </div>

                                <labe class="col-12 text_infoImg-formInst"> Tamaño 356 x 326px. Peso máximo 300kb </label> 
                            </div>

                            <div class="col-12 section_inputRight-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Nombre de la sede </label>

                                    <input class="form-control" id="nombre"  type="text" name="nombre[]" value="">
                                </div>
                            </div>
                            <div class="col-12 section_inputRight-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Dirrección </label>
                                    
                                    <input class="form-control" id="direccion"  type="text" name="direccion[]" value="">
                                </div>
                            </div>
                            <div class="col-12 section_inputRight-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Horario </label>
                                    
                                    <input class="form-control" id="horario_sede"  type="text" name="horario_sede[]" value="">
                                </div>
                            </div>
                            <div class="col-12 section_inputRight-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Teléfono </label>
                                    
                                    <input class="form-control" id="telefono"  type="text" name="telefono[]" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                @elseif($objContadorSedes->cantidad == 1)
                    <!-- Modulo de los Sedes sin información-->
                    <div class="row content_antDesp-formInst">
                        <!-- Contenido Sedes izquierdo -->
                        <div class="col-md-6 photo1 section_inputLeft-text-formInst">
                            <div class="col-12 section_inputLeft-text-formInst content_agregarImg-formInst form-group">
                                <div class="col-10 img_selccionada-formInst">
                                    <div class="img_anexada-formInst" id="previewPremioLeft1"></div>
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="imgsede" name="imgsede[]"/>
                                </div>

                                <labe class="col-12 text_infoImg-formInst"> Tamaño 356 x 326px. Peso máximo 300kb </label> 
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Nombre de la sede </label>

                                    <input class="form-control" id="nombre"  type="text" name="nombre[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Dirrección </label>
                                    
                                    <input class="form-control" id="direccion"  type="text" name="direccion[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Horario </label>
                                    
                                    <input class="form-control" id="horario_sede"  type="text" name="horario_sede[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Teléfono </label>
                                    
                                    <input class="form-control" id="telefono"  type="text" name="telefono[]" value="">
                                </div>
                            </div>
                        </div>

                        <!-- Contenido Sedes derecho -->
                        <div class="col-md-6 photo2 section_inputRight-text-formInst">
                            <div class="col-12 section_inputRight-text-formInst content_agregarImg-formInst form-group">
                                <div class="col-10 img_selccionada-formInst">
                                    <div class="img_anexada-formInst" id="previewPremioRight1"></div>
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="imgsede" name="imgsede[]"/>
                                </div>

                                <labe class="col-12 text_infoImg-formInst"> Tamaño 356 x 326px. Peso máximo 300kb </label> 
                            </div>

                            <div class="col-12 section_inputRight-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Nombre de la sede </label>

                                    <input class="form-control" id="nombre"  type="text" name="nombre[]" value="">
                                </div>
                            </div>
                            <div class="col-12 section_inputRight-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Dirrección </label>
                                    
                                    <input class="form-control" id="direccion"  type="text" name="direccion[]" value="">
                                </div>
                            </div>
                            <div class="col-12 section_inputRight-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Horario </label>
                                    
                                    <input class="form-control" id="horario_sede"  type="text" name="horario_sede[]" value="">
                                </div>
                            </div>
                            <div class="col-12 section_inputRight-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Teléfono </label>
                                    
                                    <input class="form-control" id="telefono"  type="text" name="telefono[]" value="">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modulo de los Sedes sin información-->
                    <div class="row content_antDesp-formInst">
                        <!-- Contenido Sedes izquierdo -->
                        <div class="col-md-6 photo1 section_inputLeft-text-formInst">
                            <div class="col-12 section_inputLeft-text-formInst content_agregarImg-formInst form-group">
                                <div class="col-10 img_selccionada-formInst">
                                    <div class="img_anexada-formInst" id="previewPremioLeft1"></div>
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="imgsede" name="imgsede[]"/>
                                </div>

                                <labe class="col-12 text_infoImg-formInst"> Tamaño 356 x 326px. Peso máximo 300kb </label> 
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Nombre de la sede </label>

                                    <input class="form-control" id="nombre"  type="text" name="nombre[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Dirrección </label>
                                    
                                    <input class="form-control" id="direccion"  type="text" name="direccion[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Horario </label>
                                    
                                    <input class="form-control" id="horario_sede"  type="text" name="horario_sede[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Teléfono </label>
                                    
                                    <input class="form-control" id="telefono"  type="text" name="telefono[]" value="">
                                </div>
                            </div>
                        </div>

                        <!-- Contenido Sedes derecho -->
                        <div class="col-md-6 photo2 section_inputRight-text-formInst">
                            <div class="col-12 section_inputRight-text-formInst content_agregarImg-formInst form-group">
                                <div class="col-10 img_selccionada-formInst">
                                    <div class="img_anexada-formInst" id="previewPremioRight1"></div>
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="imgsede" name="imgsede[]"/>
                                </div>

                                <labe class="col-12 text_infoImg-formInst"> Tamaño 356 x 326px. Peso máximo 300kb </label> 
                            </div>

                            <div class="col-12 section_inputRight-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Nombre de la sede </label>

                                    <input class="form-control" id="nombre"  type="text" name="nombre[]" value="">
                                </div>
                            </div>
                            <div class="col-12 section_inputRight-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Dirrección </label>
                                    
                                    <input class="form-control" id="direccion"  type="text" name="direccion[]" value="">
                                </div>
                            </div>
                            <div class="col-12 section_inputRight-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Horario </label>
                                    
                                    <input class="form-control" id="horario_sede"  type="text" name="horario_sede[]" value="">
                                </div>
                            </div>
                            <div class="col-12 section_inputRight-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Teléfono </label>
                                    
                                    <input class="form-control" id="telefono"  type="text" name="telefono[]" value="">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modulo de los Sedes sin información-->
                    <div class="row content_antDesp-formInst">
                        <!-- Contenido Sedes izquierdo -->
                        <div class="col-md-6 photo1 section_inputLeft-text-formInst">
                            <div class="col-12 section_inputLeft-text-formInst content_agregarImg-formInst form-group">
                                <div class="col-10 img_selccionada-formInst">
                                    <div class="img_anexada-formInst" id="previewPremioLeft1"></div>
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="imgsede" name="imgsede[]"/>
                                </div>

                                <labe class="col-12 text_infoImg-formInst"> Tamaño 356 x 326px. Peso máximo 300kb </label> 
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Nombre de la sede </label>

                                    <input class="form-control" id="nombre"  type="text" name="nombre[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Dirrección </label>
                                    
                                    <input class="form-control" id="direccion"  type="text" name="direccion[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Horario </label>
                                    
                                    <input class="form-control" id="horario_sede"  type="text" name="horario_sede[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Teléfono </label>
                                    
                                    <input class="form-control" id="telefono"  type="text" name="telefono[]" value="">
                                </div>
                            </div>
                        </div>
                    </div>

                @elseif($objContadorSedes->cantidad == 2)
                    <!-- Modulo de los Sedes sin información-->
                    <div class="row content_antDesp-formInst">
                        <!-- Contenido Sedes izquierdo -->
                        <div class="col-md-6 photo1 section_inputLeft-text-formInst">
                            <div class="col-12 section_inputLeft-text-formInst content_agregarImg-formInst form-group">
                                <div class="col-10 img_selccionada-formInst">
                                    <div class="img_anexada-formInst" id="previewPremioLeft1"></div>
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="imgsede" name="imgsede[]"/>
                                </div>

                                <labe class="col-12 text_infoImg-formInst"> Tamaño 356 x 326px. Peso máximo 300kb </label> 
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Nombre de la sede </label>

                                    <input class="form-control" id="nombre"  type="text" name="nombre[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Dirrección </label>
                                    
                                    <input class="form-control" id="direccion"  type="text" name="direccion[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Horario </label>
                                    
                                    <input class="form-control" id="horario_sede"  type="text" name="horario_sede[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Teléfono </label>
                                    
                                    <input class="form-control" id="telefono"  type="text" name="telefono[]" value="">
                                </div>
                            </div>
                        </div>

                        <!-- Contenido Sedes derecho -->
                        <div class="col-md-6 photo2 section_inputRight-text-formInst">
                            <div class="col-12 section_inputRight-text-formInst content_agregarImg-formInst form-group">
                                <div class="col-10 img_selccionada-formInst">
                                    <div class="img_anexada-formInst" id="previewPremioRight1"></div>
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="imgsede" name="imgsede[]"/>
                                </div>

                                <labe class="col-12 text_infoImg-formInst"> Tamaño 356 x 326px. Peso máximo 300kb </label> 
                            </div>

                            <div class="col-12 section_inputRight-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Nombre de la sede </label>

                                    <input class="form-control" id="nombre"  type="text" name="nombre[]" value="">
                                </div>
                            </div>
                            <div class="col-12 section_inputRight-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Dirrección </label>
                                    
                                    <input class="form-control" id="direccion"  type="text" name="direccion[]" value="">
                                </div>
                            </div>
                            <div class="col-12 section_inputRight-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Horario </label>
                                    
                                    <input class="form-control" id="horario_sede"  type="text" name="horario_sede[]" value="">
                                </div>
                            </div>
                            <div class="col-12 section_inputRight-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Teléfono </label>
                                    
                                    <input class="form-control" id="telefono"  type="text" name="telefono[]" value="">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modulo de los Sedes sin información-->
                    <div class="row content_antDesp-formInst">
                        <!-- Contenido Sedes izquierdo -->
                        <div class="col-md-6 photo1 section_inputLeft-text-formInst">
                            <div class="col-12 section_inputLeft-text-formInst content_agregarImg-formInst form-group">
                                <div class="col-10 img_selccionada-formInst">
                                    <div class="img_anexada-formInst" id="previewPremioLeft1"></div>
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="imgsede" name="imgsede[]"/>
                                </div>

                                <labe class="col-12 text_infoImg-formInst"> Tamaño 356 x 326px. Peso máximo 300kb </label> 
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Nombre de la sede </label>

                                    <input class="form-control" id="nombre"  type="text" name="nombre[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Dirrección </label>
                                    
                                    <input class="form-control" id="direccion"  type="text" name="direccion[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Horario </label>
                                    
                                    <input class="form-control" id="horario_sede"  type="text" name="horario_sede[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Teléfono </label>
                                    
                                    <input class="form-control" id="telefono"  type="text" name="telefono[]" value="">
                                </div>
                            </div>
                        </div>

                        <!-- Contenido Sedes derecho -->
                        <div class="col-md-6 photo2 section_inputRight-text-formInst">
                            <div class="col-12 section_inputRight-text-formInst content_agregarImg-formInst form-group">
                                <div class="col-10 img_selccionada-formInst">
                                    <div class="img_anexada-formInst" id="previewPremioRight1"></div>
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="imgsede" name="imgsede[]"/>
                                </div>

                                <labe class="col-12 text_infoImg-formInst"> Tamaño 356 x 326px. Peso máximo 300kb </label> 
                            </div>

                            <div class="col-12 section_inputRight-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Nombre de la sede </label>

                                    <input class="form-control" id="nombre"  type="text" name="nombre[]" value="">
                                </div>
                            </div>
                            <div class="col-12 section_inputRight-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Dirrección </label>
                                    
                                    <input class="form-control" id="direccion"  type="text" name="direccion[]" value="">
                                </div>
                            </div>
                            <div class="col-12 section_inputRight-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Horario </label>
                                    
                                    <input class="form-control" id="horario_sede"  type="text" name="horario_sede[]" value="">
                                </div>
                            </div>
                            <div class="col-12 section_inputRight-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Teléfono </label>
                                    
                                    <input class="form-control" id="telefono"  type="text" name="telefono[]" value="">
                                </div>
                            </div>
                        </div>
                    </div>

                @elseif($objContadorSedes->cantidad == 3)
                    <!-- Modulo de los Sedes sin información-->
                    <div class="row content_antDesp-formInst">
                        <!-- Contenido Sedes izquierdo -->
                        <div class="col-md-6 photo1 section_inputLeft-text-formInst">
                            <div class="col-12 section_inputLeft-text-formInst content_agregarImg-formInst form-group">
                                <div class="col-10 img_selccionada-formInst">
                                    <div class="img_anexada-formInst" id="previewPremioLeft1"></div>
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="imgsede" name="imgsede[]"/>
                                </div>

                                <labe class="col-12 text_infoImg-formInst"> Tamaño 356 x 326px. Peso máximo 300kb </label> 
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Nombre de la sede </label>

                                    <input class="form-control" id="nombre"  type="text" name="nombre[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Dirrección </label>
                                    
                                    <input class="form-control" id="direccion"  type="text" name="direccion[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Horario </label>
                                    
                                    <input class="form-control" id="horario_sede"  type="text" name="horario_sede[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Teléfono </label>
                                    
                                    <input class="form-control" id="telefono"  type="text" name="telefono[]" value="">
                                </div>
                            </div>
                        </div>

                        <!-- Contenido Sedes derecho -->
                        <div class="col-md-6 photo2 section_inputRight-text-formInst">
                            <div class="col-12 section_inputRight-text-formInst content_agregarImg-formInst form-group">
                                <div class="col-10 img_selccionada-formInst">
                                    <div class="img_anexada-formInst" id="previewPremioRight1"></div>
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="imgsede" name="imgsede[]"/>
                                </div>

                                <labe class="col-12 text_infoImg-formInst"> Tamaño 356 x 326px. Peso máximo 300kb </label> 
                            </div>

                            <div class="col-12 section_inputRight-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Nombre de la sede </label>

                                    <input class="form-control" id="nombre"  type="text" name="nombre[]" value="">
                                </div>
                            </div>
                            <div class="col-12 section_inputRight-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Dirrección </label>
                                    
                                    <input class="form-control" id="direccion"  type="text" name="direccion[]" value="">
                                </div>
                            </div>
                            <div class="col-12 section_inputRight-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Horario </label>
                                    
                                    <input class="form-control" id="horario_sede"  type="text" name="horario_sede[]" value="">
                                </div>
                            </div>
                            <div class="col-12 section_inputRight-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Teléfono </label>
                                    
                                    <input class="form-control" id="telefono"  type="text" name="telefono[]" value="">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modulo de los Sedes sin información-->
                    <div class="row content_antDesp-formInst">
                        <!-- Contenido Sedes izquierdo -->
                        <div class="col-md-6 photo1 section_inputLeft-text-formInst">
                            <div class="col-12 section_inputLeft-text-formInst content_agregarImg-formInst form-group">
                                <div class="col-10 img_selccionada-formInst">
                                    <div class="img_anexada-formInst" id="previewPremioLeft1"></div>
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="imgsede" name="imgsede[]"/>
                                </div>

                                <labe class="col-12 text_infoImg-formInst"> Tamaño 356 x 326px. Peso máximo 300kb </label> 
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Nombre de la sede </label>

                                    <input class="form-control" id="nombre"  type="text" name="nombre[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Dirrección </label>
                                    
                                    <input class="form-control" id="direccion"  type="text" name="direccion[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Horario </label>
                                    
                                    <input class="form-control" id="horario_sede"  type="text" name="horario_sede[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Teléfono </label>
                                    
                                    <input class="form-control" id="telefono"  type="text" name="telefono[]" value="">
                                </div>
                            </div>
                        </div>
                    </div>

                @elseif($objContadorSedes->cantidad == 4)
                    <!-- Modulo de los Sedes sin información-->
                    <div class="row content_antDesp-formInst">
                        <!-- Contenido Sedes izquierdo -->
                        <div class="col-md-6 photo1 section_inputLeft-text-formInst">
                            <div class="col-12 section_inputLeft-text-formInst content_agregarImg-formInst form-group">
                                <div class="col-10 img_selccionada-formInst">
                                    <div class="img_anexada-formInst" id="previewPremioLeft1"></div>
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="imgsede" name="imgsede[]"/>
                                </div>

                                <labe class="col-12 text_infoImg-formInst"> Tamaño 356 x 326px. Peso máximo 300kb </label> 
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Nombre de la sede </label>

                                    <input class="form-control" id="nombre"  type="text" name="nombre[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Dirrección </label>
                                    
                                    <input class="form-control" id="direccion"  type="text" name="direccion[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Horario </label>
                                    
                                    <input class="form-control" id="horario_sede"  type="text" name="horario_sede[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Teléfono </label>
                                    
                                    <input class="form-control" id="telefono"  type="text" name="telefono[]" value="">
                                </div>
                            </div>
                        </div>

                        <!-- Contenido Sedes derecho -->
                        <div class="col-md-6 photo2 section_inputRight-text-formInst">
                            <div class="col-12 section_inputRight-text-formInst content_agregarImg-formInst form-group">
                                <div class="col-10 img_selccionada-formInst">
                                    <div class="img_anexada-formInst" id="previewPremioRight1"></div>
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="imgsede" name="imgsede[]"/>
                                </div>

                                <labe class="col-12 text_infoImg-formInst"> Tamaño 356 x 326px. Peso máximo 300kb </label> 
                            </div>

                            <div class="col-12 section_inputRight-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Nombre de la sede </label>

                                    <input class="form-control" id="nombre"  type="text" name="nombre[]" value="">
                                </div>
                            </div>
                            <div class="col-12 section_inputRight-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Dirrección </label>
                                    
                                    <input class="form-control" id="direccion"  type="text" name="direccion[]" value="">
                                </div>
                            </div>
                            <div class="col-12 section_inputRight-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Horario </label>
                                    
                                    <input class="form-control" id="horario_sede"  type="text" name="horario_sede[]" value="">
                                </div>
                            </div>
                            <div class="col-12 section_inputRight-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Teléfono </label>
                                    
                                    <input class="form-control" id="telefono"  type="text" name="telefono[]" value="">
                                </div>
                            </div>
                        </div>
                    </div>

                @elseif($objContadorSedes->cantidad == 5)
                    <!-- Modulo de los Sedes sin información-->
                    <div class="row content_antDesp-formInst">
                        <!-- Contenido Sedes izquierdo -->
                        <div class="col-md-6 photo1 section_inputLeft-text-formInst">
                            <div class="col-12 section_inputLeft-text-formInst content_agregarImg-formInst form-group">
                                <div class="col-10 img_selccionada-formInst">
                                    <div class="img_anexada-formInst" id="previewPremioLeft1"></div>
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="imgsede" name="imgsede[]"/>
                                </div>

                                <labe class="col-12 text_infoImg-formInst"> Tamaño 356 x 326px. Peso máximo 300kb </label> 
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Nombre de la sede </label>

                                    <input class="form-control" id="nombre"  type="text" name="nombre[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Dirrección </label>
                                    
                                    <input class="form-control" id="direccion"  type="text" name="direccion[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Horario </label>
                                    
                                    <input class="form-control" id="horario_sede"  type="text" name="horario_sede[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Teléfono </label>
                                    
                                    <input class="form-control" id="telefono"  type="text" name="telefono[]" value="">
                                </div>
                            </div>
                        </div>
                    </div>

                @elseif($objContadorSedes->cantidad == 6)
                    <span> No se puede agregar más </span>
                @endif 

                <!-- Botón guardar información -->
                <div class="col-12 content_btnEnviar-formInst">
                    <button type="submit" class="btn2_enviar-formInst"> Guardar
                        <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flechaBtn_guardar-formInst" alt=""> 
                    </button>
                </div>
            </form>
        </div>
        <!--------------------------------------------      Fin 10 decima parte del formulario *** SEDES ***      ------------------------------------------------------------->

        <!--------------------------------------------      Inicio 11 onceava parte del formulario *** UBIQUE LA SEDE ***      -------------------------------------------->
        <div class="col-lg-10 col-xl-8 pb-3 content_tarjetasInfo-formInst">
            <h5 class="col-lg-12 icon_ubiqueSede-formInst"> Ubique la sede </h5>

            <form method="POST" action="{{ url ('/FormularioInstitucionSave11') }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"> 

                @if(!empty($objFormulario))
                    <div class="col-12 px-0">
                        <div class="form-group">
                            <label for="example-date-input" class="col-12 text_label-formInst"> A continuación enlace las sedes en Google Maps </label>

                            <iframe src="{{$objFormulario->url_maps}}" width="800" height="600" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                        </div>
                    </div>
                @else
                    <div class="col-12 px-0">
                        <div class="form-group">
                            <label for="example-date-input" class="col-12 text_label-formInst"> A continuación enlace las sedes en Google Maps </label>

                            <input class="form-control" id="descripcionPerfil" placeholder="https://www.youtube.com/watch?v=53lHGbvu8o&ab" type="text" name="url_maps" >
                        </div>
                    </div>
                @endif
                <!-- Botón guardar información -->
                <div class="col-12 content_btnEnviar-formInst">
                    <button type="submit" class="btn2_enviar-formInst"> Guardar
                        <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flechaBtn_guardar-formInst" alt=""> 
                    </button>
                </div>
            </form>
        </div>
        <!--------------------------------------------      Fin 11 onceava parte del formulario *** UBIQUE LA SEDE ***      --------------------------------------------------->
        
        <!-- Secciones de los botones anterior y siguiente -->
        <div class="col-lg-10 col-xl-8 content_botonesInferiores-formInst">
            <div class="col-md-3 content_btn-anter-formInst">
                <button type="submit" class="boton_inferior-anterior-formInst" onclick="hideBtnPrevious(this)" code-position="venuesInst">
                    <img src="{{URL::asset('/img/formulario-profesional/icono-flecha-gris.svg')}}" class="flechaBtn_guardar-formInst" alt=""> 
                    Anterior
                </button>
            </div>

            <div class="col-md-3 content_btn-siguient-formInst">
                <button type="submit" class="boton_inferior-siguiente-formInst" onclick="hideBtnNext(this)" code-position="venuesInst"> Siguiente
                    <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flechaBtn_guardar-formInst" alt=""> 
                </button>
            </div>
        </div>
    </div>

    <!-- 7* Contenedor principal de la opción GALERIAS -->
    <div class="container-fluid gallery_inst content_principal-formInst">
        <!--------------------------------------------      Inicio 12 doceava parte del formulario *** GALERIA ***      ------------------------------------------------------->
        <div class="col-lg-10 col-xl-8 pb-3 content_tarjetasInfo-formInst">
            <h5 class="col-lg-12 icon_galeriaInst-formInst"> Galeria </h5>

            <p class="text_superior-proced-formInst"> A continuación suba 10 imágenes como mínimo, con su respectivo nombre y descripción. </p>

            <!-- Modulo de la GALERIA con información -->
            <div class="row col-12 p-0 m-0">
                @foreach($objGaleria as $objGaleria)
                    @if(!empty($objGaleria->nombrefoto))
                        <!-- Contenido GALERIA -->    
                        <div class="col-md-6 mt-3 content_antes-formInst">
                            <div class="col-12 content_btnX-cierre-forminst">
                                <a href="{{url('/FormularioInstituciondelete12/'.$objGaleria->id_galeria)}}">
                                    <button type="submit" class="close" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </a>
                            </div>

                            <div class="col-12 content_agregarImg-formInst form-group">
                                <div class="img_selccionada-formInst">
                                    <img  class="img_publi-formInst" src="{{URL::asset($objGaleria->imggaleria)}}">
                                </div>

                                <div class="col-12 p-0">
                                    <div class="form-group">
                                        <span>{{$objGaleria->nombrefoto}}</span>
                                    </div>
                                </div>

                                <div class="col-12 p-0">
                                    <div class="form-group">
                                        <span>{{$objGaleria->descripcion}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach 
            </div>

            <form method="POST" action="{{ url ('/FormularioInstitucionSave12') }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"> 

                @if($objContadorGaleria->cantidad == 0)
                    <!-- Modulos del contenido GALERIA -->
                    <div class="row content_antDesp-formInst">
                        <!-- Contenido IZQUIERDO -->
                        <div class="col-md-6 photo1 section_inputLeft-text-formInst">
                            <div class="col-12 section_inputLeft-text-formInst content_agregarImg-formInst form-group">
                                <div class="col-10 img_selccionada-formInst">
                                    <div class="img_anexada-formInst" id="previewGaleL1"></div>
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="imgGalL1" name="imggaleria[]"/>
                                </div>

                                <labe class="col-12 text_infoImg-formInst"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>
                                
                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Título de la imagen 1 </label>

                                    <input class="form-control" id="nombrefoto"  type="text" name="nombrefoto[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Descripción </label>
                                    
                                    <input class="form-control" id="descripcion"  type="text" name="descripcion[]" value="">

                                    <labe class="col-12 text_infoImg-formInst"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>

                        <!-- Contenido DERECHO -->
                        <div class="col-md-6 photo2 section_inputRight-text-formInst">
                            <div class="col-12 content_agregarImg-formInst form-group">
                                <div class="col-10 img_selccionada-formInst">
                                    <div class="img_anexada-formInst" id="previewGaleR1"></div>
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="imgGalR1" name="imggaleria[]"/>
                                </div>

                                <labe class="col-12 text_infoImg-formInst"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                            </div>

                            <div class="col-12 section_inputRight-text-formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>
                                
                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Título de la imagen </label>

                                    <input class="form-control" id="nombrepremio"  type="text" name="nombrefoto[]" value="">
                                </div>
                            </div>
                            
                            <div class="col-12 section_inputRight-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Descripción </label>

                                    <input class="form-control" id="nombrepremio"  type="text" name="descripcion[]" value="">
                                </div>
                            </div>
                        </div>

                        <!-- Contenido IZQUIERDO -->
                        <div class="col-md-6 photo1 section_inputLeft-text-formInst">
                            <div class="col-12 section_inputLeft-text-formInst content_agregarImg-formInst form-group">
                                <div class="col-10 img_selccionada-formInst">
                                    <div class="img_anexada-formInst" id="previewGaleL1"></div>
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="imgGalL1" name="imggaleria[]"/>
                                </div>

                                <labe class="col-12 text_infoImg-formInst"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>
                                
                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Título de la imagen 1 </label>

                                    <input class="form-control" id="nombrefoto"  type="text" name="nombrefoto[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Descripción </label>
                                    
                                    <input class="form-control" id="descripcion"  type="text" name="descripcion[]" value="">

                                    <labe class="col-12 text_infoImg-formInst"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>

                        <!-- Contenido DERECHO -->
                        <div class="col-md-6 photo2 section_inputRight-text-formInst">
                            <div class="col-12 content_agregarImg-formInst form-group">
                                <div class="col-10 img_selccionada-formInst">
                                    <div class="img_anexada-formInst" id="previewGaleR1"></div>
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="imgGalR1" name="imggaleria[]"/>
                                </div>

                                <labe class="col-12 text_infoImg-formInst"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                            </div>

                            <div class="col-12 section_inputRight-text-formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>
                                
                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Título de la imagen </label>

                                    <input class="form-control" id="nombrepremio"  type="text" name="nombrefoto[]" value="">
                                </div>
                            </div>
                            
                            <div class="col-12 section_inputRight-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Descripción </label>

                                    <input class="form-control" id="nombrepremio"  type="text" name="descripcion[]" value="">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modulos del contenido GALERIA -->
                    <div class="row content_antDesp-formInst">
                        <!-- Contenido IZQUIERDO -->
                        <div class="col-md-6 photo1 section_inputLeft-text-formInst">
                            <div class="col-12 section_inputLeft-text-formInst content_agregarImg-formInst form-group">
                                <div class="col-10 img_selccionada-formInst">
                                    <div class="img_anexada-formInst" id="previewGaleL1"></div>
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="imgGalL1" name="imggaleria[]"/>
                                </div>

                                <labe class="col-12 text_infoImg-formInst"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>
                                
                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Título de la imagen 1 </label>

                                    <input class="form-control" id="nombrefoto"  type="text" name="nombrefoto[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Descripción </label>
                                    
                                    <input class="form-control" id="descripcion"  type="text" name="descripcion[]" value="">

                                    <labe class="col-12 text_infoImg-formInst"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>

                        <!-- Contenido DERECHO -->
                        <div class="col-md-6 photo2 section_inputRight-text-formInst">
                            <div class="col-12 content_agregarImg-formInst form-group">
                                <div class="col-10 img_selccionada-formInst">
                                    <div class="img_anexada-formInst" id="previewGaleR1"></div>
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="imgGalR1" name="imggaleria[]"/>
                                </div>

                                <labe class="col-12 text_infoImg-formInst"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                            </div>

                            <div class="col-12 section_inputRight-text-formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>
                                
                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Título de la imagen </label>

                                    <input class="form-control" id="nombrepremio"  type="text" name="nombrefoto[]" value="">
                                </div>
                            </div>
                            
                            <div class="col-12 section_inputRight-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Descripción </label>

                                    <input class="form-control" id="nombrepremio"  type="text" name="descripcion[]" value="">
                                </div>
                            </div>
                        </div>

                        <!-- Contenido IZQUIERDO -->
                        <div class="col-md-6 photo1 section_inputLeft-text-formInst">
                            <div class="col-12 section_inputLeft-text-formInst content_agregarImg-formInst form-group">
                                <div class="col-10 img_selccionada-formInst">
                                    <div class="img_anexada-formInst" id="previewGaleL1"></div>
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="imgGalL1" name="imggaleria[]"/>
                                </div>

                                <labe class="col-12 text_infoImg-formInst"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>
                                
                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Título de la imagen 1 </label>

                                    <input class="form-control" id="nombrefoto"  type="text" name="nombrefoto[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Descripción </label>
                                    
                                    <input class="form-control" id="descripcion"  type="text" name="descripcion[]" value="">

                                    <labe class="col-12 text_infoImg-formInst"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>

                        <!-- Contenido DERECHO -->
                        <div class="col-md-6 photo2 section_inputRight-text-formInst">
                            <div class="col-12 content_agregarImg-formInst form-group">
                                <div class="col-10 img_selccionada-formInst">
                                    <div class="img_anexada-formInst" id="previewGaleR1"></div>
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="imgGalR1" name="imggaleria[]"/>
                                </div>

                                <labe class="col-12 text_infoImg-formInst"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                            </div>

                            <div class="col-12 section_inputRight-text-formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>
                                
                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Título de la imagen </label>

                                    <input class="form-control" id="nombrepremio"  type="text" name="nombrefoto[]" value="">
                                </div>
                            </div>
                            
                            <div class="col-12 section_inputRight-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Descripción </label>

                                    <input class="form-control" id="nombrepremio"  type="text" name="descripcion[]" value="">
                                </div>
                            </div>
                        </div>
                    </div>

                @elseif($objContadorGaleria->cantidad == 1)
                    <!-- Modulos del contenido GALERIA -->
                    <div class="row content_antDesp-formInst">
                        <!-- Contenido IZQUIERDO -->
                        <div class="col-md-6 photo1 section_inputLeft-text-formInst">
                            <div class="col-12 section_inputLeft-text-formInst content_agregarImg-formInst form-group">
                                <div class="col-10 img_selccionada-formInst">
                                    <div class="img_anexada-formInst" id="previewGaleL1"></div>
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="imgGalL1" name="imggaleria[]"/>
                                </div>

                                <labe class="col-12 text_infoImg-formInst"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>
                                
                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Título de la imagen 1 </label>

                                    <input class="form-control" id="nombrefoto"  type="text" name="nombrefoto[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Descripción </label>
                                    
                                    <input class="form-control" id="descripcion"  type="text" name="descripcion[]" value="">

                                    <labe class="col-12 text_infoImg-formInst"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>

                        <!-- Contenido DERECHO -->
                        <div class="col-md-6 photo2 section_inputRight-text-formInst">
                            <div class="col-12 content_agregarImg-formInst form-group">
                                <div class="col-10 img_selccionada-formInst">
                                    <div class="img_anexada-formInst" id="previewGaleR1"></div>
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="imgGalR1" name="imggaleria[]"/>
                                </div>

                                <labe class="col-12 text_infoImg-formInst"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                            </div>

                            <div class="col-12 section_inputRight-text-formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>
                                
                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Título de la imagen </label>

                                    <input class="form-control" id="nombrepremio"  type="text" name="nombrefoto[]" value="">
                                </div>
                            </div>
                            
                            <div class="col-12 section_inputRight-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Descripción </label>

                                    <input class="form-control" id="nombrepremio"  type="text" name="descripcion[]" value="">
                                </div>
                            </div>
                        </div>

                        <!-- Contenido IZQUIERDO -->
                        <div class="col-md-6 photo1 section_inputLeft-text-formInst">
                            <div class="col-12 section_inputLeft-text-formInst content_agregarImg-formInst form-group">
                                <div class="col-10 img_selccionada-formInst">
                                    <div class="img_anexada-formInst" id="previewGaleL1"></div>
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="imgGalL1" name="imggaleria[]"/>
                                </div>

                                <labe class="col-12 text_infoImg-formInst"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>
                                
                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Título de la imagen 1 </label>

                                    <input class="form-control" id="nombrefoto"  type="text" name="nombrefoto[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Descripción </label>
                                    
                                    <input class="form-control" id="descripcion"  type="text" name="descripcion[]" value="">

                                    <labe class="col-12 text_infoImg-formInst"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>

                        <!-- Contenido DERECHO -->
                        <div class="col-md-6 photo2 section_inputRight-text-formInst">
                            <div class="col-12 content_agregarImg-formInst form-group">
                                <div class="col-10 img_selccionada-formInst">
                                    <div class="img_anexada-formInst" id="previewGaleR1"></div>
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="imgGalR1" name="imggaleria[]"/>
                                </div>

                                <labe class="col-12 text_infoImg-formInst"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                            </div>

                            <div class="col-12 section_inputRight-text-formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>
                                
                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Título de la imagen </label>

                                    <input class="form-control" id="nombrepremio"  type="text" name="nombrefoto[]" value="">
                                </div>
                            </div>
                            
                            <div class="col-12 section_inputRight-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Descripción </label>

                                    <input class="form-control" id="nombrepremio"  type="text" name="descripcion[]" value="">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modulos del contenido GALERIA -->
                    <div class="row content_antDesp-formInst">
                        <!-- Contenido IZQUIERDO -->
                        <div class="col-md-6 photo1 section_inputLeft-text-formInst">
                            <div class="col-12 section_inputLeft-text-formInst content_agregarImg-formInst form-group">
                                <div class="col-10 img_selccionada-formInst">
                                    <div class="img_anexada-formInst" id="previewGaleL1"></div>
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="imgGalL1" name="imggaleria[]"/>
                                </div>

                                <labe class="col-12 text_infoImg-formInst"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>
                                
                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Título de la imagen 1 </label>

                                    <input class="form-control" id="nombrefoto"  type="text" name="nombrefoto[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Descripción </label>
                                    
                                    <input class="form-control" id="descripcion"  type="text" name="descripcion[]" value="">

                                    <labe class="col-12 text_infoImg-formInst"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>

                        <!-- Contenido DERECHO -->
                        <div class="col-md-6 photo2 section_inputRight-text-formInst">
                            <div class="col-12 content_agregarImg-formInst form-group">
                                <div class="col-10 img_selccionada-formInst">
                                    <div class="img_anexada-formInst" id="previewGaleR1"></div>
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="imgGalR1" name="imggaleria[]"/>
                                </div>

                                <labe class="col-12 text_infoImg-formInst"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                            </div>

                            <div class="col-12 section_inputRight-text-formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>
                                
                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Título de la imagen </label>

                                    <input class="form-control" id="nombrepremio"  type="text" name="nombrefoto[]" value="">
                                </div>
                            </div>
                            
                            <div class="col-12 section_inputRight-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Descripción </label>

                                    <input class="form-control" id="nombrepremio"  type="text" name="descripcion[]" value="">
                                </div>
                            </div>
                        </div>

                        <!-- Contenido IZQUIERDO -->
                        <div class="col-md-6 photo1 section_inputLeft-text-formInst">
                            <div class="col-12 section_inputLeft-text-formInst content_agregarImg-formInst form-group">
                                <div class="col-10 img_selccionada-formInst">
                                    <div class="img_anexada-formInst" id="previewGaleL1"></div>
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="imgGalL1" name="imggaleria[]"/>
                                </div>

                                <labe class="col-12 text_infoImg-formInst"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>
                                
                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Título de la imagen 1 </label>

                                    <input class="form-control" id="nombrefoto"  type="text" name="nombrefoto[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Descripción </label>
                                    
                                    <input class="form-control" id="descripcion"  type="text" name="descripcion[]" value="">

                                    <labe class="col-12 text_infoImg-formInst"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>
                    </div>

                @elseif($objContadorGaleria->cantidad == 2)
                    <!-- Modulos del contenido GALERIA -->
                    <div class="row content_antDesp-formInst">
                        <!-- Contenido IZQUIERDO -->
                        <div class="col-md-6 photo1 section_inputLeft-text-formInst">
                            <div class="col-12 section_inputLeft-text-formInst content_agregarImg-formInst form-group">
                                <div class="col-10 img_selccionada-formInst">
                                    <div class="img_anexada-formInst" id="previewGaleL1"></div>
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="imgGalL1" name="imggaleria[]"/>
                                </div>

                                <labe class="col-12 text_infoImg-formInst"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>
                                
                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Título de la imagen 1 </label>

                                    <input class="form-control" id="nombrefoto"  type="text" name="nombrefoto[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Descripción </label>
                                    
                                    <input class="form-control" id="descripcion"  type="text" name="descripcion[]" value="">

                                    <labe class="col-12 text_infoImg-formInst"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>

                        <!-- Contenido DERECHO -->
                        <div class="col-md-6 photo2 section_inputRight-text-formInst">
                            <div class="col-12 content_agregarImg-formInst form-group">
                                <div class="col-10 img_selccionada-formInst">
                                    <div class="img_anexada-formInst" id="previewGaleR1"></div>
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="imgGalR1" name="imggaleria[]"/>
                                </div>

                                <labe class="col-12 text_infoImg-formInst"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                            </div>

                            <div class="col-12 section_inputRight-text-formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>
                                
                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Título de la imagen </label>

                                    <input class="form-control" id="nombrepremio"  type="text" name="nombrefoto[]" value="">
                                </div>
                            </div>
                            
                            <div class="col-12 section_inputRight-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Descripción </label>

                                    <input class="form-control" id="nombrepremio"  type="text" name="descripcion[]" value="">
                                </div>
                            </div>
                        </div>

                        <!-- Contenido IZQUIERDO -->
                        <div class="col-md-6 photo1 section_inputLeft-text-formInst">
                            <div class="col-12 section_inputLeft-text-formInst content_agregarImg-formInst form-group">
                                <div class="col-10 img_selccionada-formInst">
                                    <div class="img_anexada-formInst" id="previewGaleL1"></div>
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="imgGalL1" name="imggaleria[]"/>
                                </div>

                                <labe class="col-12 text_infoImg-formInst"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>
                                
                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Título de la imagen 1 </label>

                                    <input class="form-control" id="nombrefoto"  type="text" name="nombrefoto[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Descripción </label>
                                    
                                    <input class="form-control" id="descripcion"  type="text" name="descripcion[]" value="">

                                    <labe class="col-12 text_infoImg-formInst"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>

                        <!-- Contenido DERECHO -->
                        <div class="col-md-6 photo2 section_inputRight-text-formInst">
                            <div class="col-12 content_agregarImg-formInst form-group">
                                <div class="col-10 img_selccionada-formInst">
                                    <div class="img_anexada-formInst" id="previewGaleR1"></div>
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="imgGalR1" name="imggaleria[]"/>
                                </div>

                                <labe class="col-12 text_infoImg-formInst"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                            </div>

                            <div class="col-12 section_inputRight-text-formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>
                                
                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Título de la imagen </label>

                                    <input class="form-control" id="nombrepremio"  type="text" name="nombrefoto[]" value="">
                                </div>
                            </div>
                            
                            <div class="col-12 section_inputRight-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Descripción </label>

                                    <input class="form-control" id="nombrepremio"  type="text" name="descripcion[]" value="">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modulos del contenido GALERIA -->
                    <div class="row content_antDesp-formInst">
                        <!-- Contenido IZQUIERDO -->
                        <div class="col-md-6 photo1 section_inputLeft-text-formInst">
                            <div class="col-12 section_inputLeft-text-formInst content_agregarImg-formInst form-group">
                                <div class="col-10 img_selccionada-formInst">
                                    <div class="img_anexada-formInst" id="previewGaleL1"></div>
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="imgGalL1" name="imggaleria[]"/>
                                </div>

                                <labe class="col-12 text_infoImg-formInst"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>
                                
                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Título de la imagen 1 </label>

                                    <input class="form-control" id="nombrefoto"  type="text" name="nombrefoto[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Descripción </label>
                                    
                                    <input class="form-control" id="descripcion"  type="text" name="descripcion[]" value="">

                                    <labe class="col-12 text_infoImg-formInst"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>

                        <!-- Contenido DERECHO -->
                        <div class="col-md-6 photo2 section_inputRight-text-formInst">
                            <div class="col-12 content_agregarImg-formInst form-group">
                                <div class="col-10 img_selccionada-formInst">
                                    <div class="img_anexada-formInst" id="previewGaleR1"></div>
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="imgGalR1" name="imggaleria[]"/>
                                </div>

                                <labe class="col-12 text_infoImg-formInst"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                            </div>

                            <div class="col-12 section_inputRight-text-formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>
                                
                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Título de la imagen </label>

                                    <input class="form-control" id="nombrepremio"  type="text" name="nombrefoto[]" value="">
                                </div>
                            </div>
                            
                            <div class="col-12 section_inputRight-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Descripción </label>

                                    <input class="form-control" id="nombrepremio"  type="text" name="descripcion[]" value="">
                                </div>
                            </div>
                        </div>
                    </div>

                @elseif($objContadorGaleria->cantidad == 3)
                    <!-- Modulos del contenido GALERIA -->
                    <div class="row content_antDesp-formInst">
                        <!-- Contenido IZQUIERDO -->
                        <div class="col-md-6 photo1 section_inputLeft-text-formInst">
                            <div class="col-12 section_inputLeft-text-formInst content_agregarImg-formInst form-group">
                                <div class="col-10 img_selccionada-formInst">
                                    <div class="img_anexada-formInst" id="previewGaleL1"></div>
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="imgGalL1" name="imggaleria[]"/>
                                </div>

                                <labe class="col-12 text_infoImg-formInst"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>
                                
                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Título de la imagen 1 </label>

                                    <input class="form-control" id="nombrefoto"  type="text" name="nombrefoto[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Descripción </label>
                                    
                                    <input class="form-control" id="descripcion"  type="text" name="descripcion[]" value="">

                                    <labe class="col-12 text_infoImg-formInst"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>

                        <!-- Contenido DERECHO -->
                        <div class="col-md-6 photo2 section_inputRight-text-formInst">
                            <div class="col-12 content_agregarImg-formInst form-group">
                                <div class="col-10 img_selccionada-formInst">
                                    <div class="img_anexada-formInst" id="previewGaleR1"></div>
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="imgGalR1" name="imggaleria[]"/>
                                </div>

                                <labe class="col-12 text_infoImg-formInst"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                            </div>

                            <div class="col-12 section_inputRight-text-formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>
                                
                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Título de la imagen </label>

                                    <input class="form-control" id="nombrepremio"  type="text" name="nombrefoto[]" value="">
                                </div>
                            </div>
                            
                            <div class="col-12 section_inputRight-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Descripción </label>

                                    <input class="form-control" id="nombrepremio"  type="text" name="descripcion[]" value="">
                                </div>
                            </div>
                        </div>

                        <!-- Contenido IZQUIERDO -->
                        <div class="col-md-6 photo1 section_inputLeft-text-formInst">
                            <div class="col-12 section_inputLeft-text-formInst content_agregarImg-formInst form-group">
                                <div class="col-10 img_selccionada-formInst">
                                    <div class="img_anexada-formInst" id="previewGaleL1"></div>
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="imgGalL1" name="imggaleria[]"/>
                                </div>

                                <labe class="col-12 text_infoImg-formInst"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>
                                
                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Título de la imagen 1 </label>

                                    <input class="form-control" id="nombrefoto"  type="text" name="nombrefoto[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Descripción </label>
                                    
                                    <input class="form-control" id="descripcion"  type="text" name="descripcion[]" value="">

                                    <labe class="col-12 text_infoImg-formInst"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>

                        <!-- Contenido DERECHO -->
                        <div class="col-md-6 photo2 section_inputRight-text-formInst">
                            <div class="col-12 content_agregarImg-formInst form-group">
                                <div class="col-10 img_selccionada-formInst">
                                    <div class="img_anexada-formInst" id="previewGaleR1"></div>
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="imgGalR1" name="imggaleria[]"/>
                                </div>

                                <labe class="col-12 text_infoImg-formInst"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                            </div>

                            <div class="col-12 section_inputRight-text-formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>
                                
                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Título de la imagen </label>

                                    <input class="form-control" id="nombrepremio"  type="text" name="nombrefoto[]" value="">
                                </div>
                            </div>
                            
                            <div class="col-12 section_inputRight-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Descripción </label>

                                    <input class="form-control" id="nombrepremio"  type="text" name="descripcion[]" value="">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modulos del contenido GALERIA -->
                    <div class="row content_antDesp-formInst">
                        <!-- Contenido IZQUIERDO -->
                        <div class="col-md-6 photo1 section_inputLeft-text-formInst">
                            <div class="col-12 section_inputLeft-text-formInst content_agregarImg-formInst form-group">
                                <div class="col-10 img_selccionada-formInst">
                                    <div class="img_anexada-formInst" id="previewGaleL1"></div>
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="imgGalL1" name="imggaleria[]"/>
                                </div>

                                <labe class="col-12 text_infoImg-formInst"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>
                                
                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Título de la imagen 1 </label>

                                    <input class="form-control" id="nombrefoto"  type="text" name="nombrefoto[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Descripción </label>
                                    
                                    <input class="form-control" id="descripcion"  type="text" name="descripcion[]" value="">

                                    <labe class="col-12 text_infoImg-formInst"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>
                    </div>

                @elseif($objContadorGaleria->cantidad == 4)
                    <!-- Modulos del contenido GALERIA -->
                    <div class="row content_antDesp-formInst">
                        <!-- Contenido IZQUIERDO -->
                        <div class="col-md-6 photo1 section_inputLeft-text-formInst">
                            <div class="col-12 section_inputLeft-text-formInst content_agregarImg-formInst form-group">
                                <div class="col-10 img_selccionada-formInst">
                                    <div class="img_anexada-formInst" id="previewGaleL1"></div>
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="imgGalL1" name="imggaleria[]"/>
                                </div>

                                <labe class="col-12 text_infoImg-formInst"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>
                                
                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Título de la imagen 1 </label>

                                    <input class="form-control" id="nombrefoto"  type="text" name="nombrefoto[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Descripción </label>
                                    
                                    <input class="form-control" id="descripcion"  type="text" name="descripcion[]" value="">

                                    <labe class="col-12 text_infoImg-formInst"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>

                        <!-- Contenido DERECHO -->
                        <div class="col-md-6 photo2 section_inputRight-text-formInst">
                            <div class="col-12 content_agregarImg-formInst form-group">
                                <div class="col-10 img_selccionada-formInst">
                                    <div class="img_anexada-formInst" id="previewGaleR1"></div>
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="imgGalR1" name="imggaleria[]"/>
                                </div>

                                <labe class="col-12 text_infoImg-formInst"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                            </div>

                            <div class="col-12 section_inputRight-text-formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>
                                
                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Título de la imagen </label>

                                    <input class="form-control" id="nombrepremio"  type="text" name="nombrefoto[]" value="">
                                </div>
                            </div>
                            
                            <div class="col-12 section_inputRight-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Descripción </label>

                                    <input class="form-control" id="nombrepremio"  type="text" name="descripcion[]" value="">
                                </div>
                            </div>
                        </div>

                        <!-- Contenido IZQUIERDO -->
                        <div class="col-md-6 photo1 section_inputLeft-text-formInst">
                            <div class="col-12 section_inputLeft-text-formInst content_agregarImg-formInst form-group">
                                <div class="col-10 img_selccionada-formInst">
                                    <div class="img_anexada-formInst" id="previewGaleL1"></div>
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="imgGalL1" name="imggaleria[]"/>
                                </div>

                                <labe class="col-12 text_infoImg-formInst"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>
                                
                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Título de la imagen 1 </label>

                                    <input class="form-control" id="nombrefoto"  type="text" name="nombrefoto[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Descripción </label>
                                    
                                    <input class="form-control" id="descripcion"  type="text" name="descripcion[]" value="">

                                    <labe class="col-12 text_infoImg-formInst"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>

                        <!-- Contenido DERECHO -->
                        <div class="col-md-6 photo2 section_inputRight-text-formInst">
                            <div class="col-12 content_agregarImg-formInst form-group">
                                <div class="col-10 img_selccionada-formInst">
                                    <div class="img_anexada-formInst" id="previewGaleR1"></div>
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="imgGalR1" name="imggaleria[]"/>
                                </div>

                                <labe class="col-12 text_infoImg-formInst"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                            </div>

                            <div class="col-12 section_inputRight-text-formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>
                                
                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Título de la imagen </label>

                                    <input class="form-control" id="nombrepremio"  type="text" name="nombrefoto[]" value="">
                                </div>
                            </div>
                            
                            <div class="col-12 section_inputRight-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Descripción </label>

                                    <input class="form-control" id="nombrepremio"  type="text" name="descripcion[]" value="">
                                </div>
                            </div>
                        </div>
                    </div>

                @elseif($objContadorGaleria->cantidad == 5)
                    <!-- Modulos del contenido GALERIA -->
                    <div class="row content_antDesp-formInst">
                        <!-- Contenido IZQUIERDO -->
                        <div class="col-md-6 photo1 section_inputLeft-text-formInst">
                            <div class="col-12 section_inputLeft-text-formInst content_agregarImg-formInst form-group">
                                <div class="col-10 img_selccionada-formInst">
                                    <div class="img_anexada-formInst" id="previewGaleL1"></div>
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="imgGalL1" name="imggaleria[]"/>
                                </div>

                                <labe class="col-12 text_infoImg-formInst"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>
                                
                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Título de la imagen 1 </label>

                                    <input class="form-control" id="nombrefoto"  type="text" name="nombrefoto[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Descripción </label>
                                    
                                    <input class="form-control" id="descripcion"  type="text" name="descripcion[]" value="">

                                    <labe class="col-12 text_infoImg-formInst"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>

                        <!-- Contenido DERECHO -->
                        <div class="col-md-6 photo2 section_inputRight-text-formInst">
                            <div class="col-12 content_agregarImg-formInst form-group">
                                <div class="col-10 img_selccionada-formInst">
                                    <div class="img_anexada-formInst" id="previewGaleR1"></div>
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="imgGalR1" name="imggaleria[]"/>
                                </div>

                                <labe class="col-12 text_infoImg-formInst"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                            </div>

                            <div class="col-12 section_inputRight-text-formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>
                                
                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Título de la imagen </label>

                                    <input class="form-control" id="nombrepremio"  type="text" name="nombrefoto[]" value="">
                                </div>
                            </div>
                            
                            <div class="col-12 section_inputRight-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Descripción </label>

                                    <input class="form-control" id="nombrepremio"  type="text" name="descripcion[]" value="">
                                </div>
                            </div>
                        </div>

                        <!-- Contenido IZQUIERDO -->
                        <div class="col-md-6 photo1 section_inputLeft-text-formInst">
                            <div class="col-12 section_inputLeft-text-formInst content_agregarImg-formInst form-group">
                                <div class="col-10 img_selccionada-formInst">
                                    <div class="img_anexada-formInst" id="previewGaleL1"></div>
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="imgGalL1" name="imggaleria[]"/>
                                </div>

                                <labe class="col-12 text_infoImg-formInst"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>
                                
                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Título de la imagen 1 </label>

                                    <input class="form-control" id="nombrefoto"  type="text" name="nombrefoto[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Descripción </label>
                                    
                                    <input class="form-control" id="descripcion"  type="text" name="descripcion[]" value="">

                                    <labe class="col-12 text_infoImg-formInst"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>
                    </div>

                @elseif($objContadorGaleria->cantidad == 6)
                    <!-- Modulos del contenido GALERIA -->
                    <div class="row content_antDesp-formInst">
                        <!-- Contenido IZQUIERDO -->
                        <div class="col-md-6 photo1 section_inputLeft-text-formInst">
                            <div class="col-12 section_inputLeft-text-formInst content_agregarImg-formInst form-group">
                                <div class="col-10 img_selccionada-formInst">
                                    <div class="img_anexada-formInst" id="previewGaleL1"></div>
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="imgGalL1" name="imggaleria[]"/>
                                </div>

                                <labe class="col-12 text_infoImg-formInst"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>
                                
                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Título de la imagen 1 </label>

                                    <input class="form-control" id="nombrefoto"  type="text" name="nombrefoto[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Descripción </label>
                                    
                                    <input class="form-control" id="descripcion"  type="text" name="descripcion[]" value="">

                                    <labe class="col-12 text_infoImg-formInst"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>

                        <!-- Contenido DERECHO -->
                        <div class="col-md-6 photo2 section_inputRight-text-formInst">
                            <div class="col-12 content_agregarImg-formInst form-group">
                                <div class="col-10 img_selccionada-formInst">
                                    <div class="img_anexada-formInst" id="previewGaleR1"></div>
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="imgGalR1" name="imggaleria[]"/>
                                </div>

                                <labe class="col-12 text_infoImg-formInst"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                            </div>

                            <div class="col-12 section_inputRight-text-formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>
                                
                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Título de la imagen </label>

                                    <input class="form-control" id="nombrepremio"  type="text" name="nombrefoto[]" value="">
                                </div>
                            </div>
                            
                            <div class="col-12 section_inputRight-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Descripción </label>

                                    <input class="form-control" id="nombrepremio"  type="text" name="descripcion[]" value="">
                                </div>
                            </div>
                        </div>
                    </div>

                @elseif($objContadorGaleria->cantidad == 7)
                    <!-- Modulos del contenido GALERIA -->
                    <div class="row content_antDesp-formInst">
                        <!-- Contenido IZQUIERDO -->
                        <div class="col-md-6 photo1 section_inputLeft-text-formInst">
                            <div class="col-12 section_inputLeft-text-formInst content_agregarImg-formInst form-group">
                                <div class="col-10 img_selccionada-formInst">
                                    <div class="img_anexada-formInst" id="previewGaleL1"></div>
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="imgGalL1" name="imggaleria[]"/>
                                </div>

                                <labe class="col-12 text_infoImg-formInst"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>
                                
                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Título de la imagen 1 </label>

                                    <input class="form-control" id="nombrefoto"  type="text" name="nombrefoto[]" value="">
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Descripción </label>
                                    
                                    <input class="form-control" id="descripcion"  type="text" name="descripcion[]" value="">

                                    <labe class="col-12 text_infoImg-formInst"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>
                    </div>

                @elseif($objContadorGaleria->cantidad == 8)
                    <span> No se puede agregar más</span>
                @endif 

                <!-- Botón guardar información -->
                <div class="col-12 content_btnEnviar-formInst">
                    <button type="submit" class="btn2_enviar-formInst"> Guardar
                        <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flechaBtn_guardar-formInst" alt=""> 
                    </button>
                </div>  
            </form>
        </div>  
        <!--------------------------------------------      Fin 12 doceava parte del formulario *** GALERIA ***      ---------------------------------------------------------->

        <!-- Secciones de los botones anterior y siguiente -->
        <div class="col-lg-10 col-xl-8 content_botonesInferiores-formInst">
            <div class="col-md-3 content_btn-anter-formInst">
                <button type="submit" class="boton_inferior-anterior-formInst" onclick="hideBtnPrevious(this)" code-position="galleryInst">
                    <img src="{{URL::asset('/img/formulario-profesional/icono-flecha-gris.svg')}}" class="flechaBtn_guardar-formInst" alt=""> 
                    Anterior
                </button>
            </div>

            <div class="col-md-3 content_btn-siguient-formInst">
                <a type="submit" class="boton_inferior-finalizar-formInst" href="{{ route('contacto') }}"> Finalizar
                    <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flechaBtn_finalizar-formInst" alt=""> 
                </a>
            </div>
        </div>
    </div>
@endsection