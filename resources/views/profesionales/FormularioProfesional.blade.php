@extends('layouts.app')

@section('content')

<!-- Contenedor principal de las tarjetas de datos -->
<div class="container-fluid content_principal-formProf">

<!--     Sección lista de opciones     -->
<ol  class="lista_opciones-usuario-formProf">
    <div>
        <li class="icon_opcion-datoPersonal active" onclick="colorTransition(this)" data-codigo="1">
            <label class="text_opcion-formProfesional" > Datos personales </label>
        </li>
    </div>

    <div>
        <li class="icon_opcion-perfProf" onclick="colorTransition(this)" data-codigo="2">
            <label class="text_opcion-formProfesional" > Perfil profesional </label>
        </li>
    </div>

    <div>
        <li class="icon_opcion-trataProced" onclick="colorTransition(this)" data-codigo="3">
            <label class="text_opcion-formProfesional" > Tratamientos y procedimientos </label>
        </li>
    </div>

    <div>
        <li class="icon_opcion-premioRecon" onclick="colorTransition(this)" data-codigo="4">
            <label class="text_opcion-formProfesional" > Premios y reconocimientos </label>
        </li>
    </div>

    <div>
        <li class="icon_opcion-public" onclick="colorTransition(this)" data-codigo="5">
            <label class="text_opcion-formProfesional" > Publicaciones </label>
        </li>
    </div>

    <div>
        <li class="icon_opcion-galeriaVideo" onclick="colorTransition(this)" data-codigo="6">
            <label class="text_opcion-formProfesional" > Galería </label>
        </li>
    </div>
</ol> 

<!--  -->
<div class="col-lg-10 content_textPrincipal-formProf">
    <h5 class="titulo_principal-formProf"> LE DAMOS LA BIENVENIDA A ZAABRA SALUD </h5>

    <p class="texto_superior-formProf"> Ingrese los datos según corresponda y finalice el proceso completamente en línea. </p>
</div>

<!--------------------------------------------      Inicio 1 primera parte del formulario *** INFORMACIÓN BÁSICA ***      ------------------------------------------------>
<div class="col-lg-10 infoBasica_formProf">
    <h5 class="col-lg-12 icon_infoBasica-formProf"> Información básica </h5> 

    <form method="POST" action="{{ url ('/FormularioProfesionalSave') }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8">
        <input type="hidden" name="_token" value="{{ csrf_token() }}"> 

        <!---------------valida que ya exista informacion y la muestra en caso contrario muestra un formulario vacio---------------------> 
        @if(!empty($objFormulario))
            <div class="row fila_infoBasica-formProf">
                <!-- Sección imagen de usuario --> 
                <div class="col-lg-3 contain_imgUsuario-formProf">

                    @foreach($objFormulario as $objFormulario)
                        <img id="imagenPrevisualizacion" class="img_usuario-formProf" src="{{URL::asset($objFormulario->imglogoempresa)}}">
                    @endforeach
     
                    <input type="file" class="input_imgUsuario-formProf" name="logo"  id="seleccionArchivos" accept="image/png, image/jpeg">

                    <label class="text_usuario-formProf"> Subir foto de perfil </label>
                </div>
                
                <!-- Sección datos personales -->
                <div class="row col-lg-9 datos_principales-formProf">
            
                    @foreach ($objuser as $objuser)
                    <div class="col-lg-6 pr-0">
                        <label for="example-date-input" class="col-12 col-form-label px-0"> Nombres </label>

                        
                        <div class="col-12 nombres_usuario-formProf">
                            <input class="input_nomApl-formProf" value="{{$objuser->primernombre}}" readonly></input>
                            <input class="input_nomApl-formProf" value="{{$objuser->segundonombre}}" readonly></input>
                        </div>
                    </div>

                    <div class="col-lg-6 pr-0">
                        <label for="example-date-input"class="col-12 col-form-label px-0"> Apellidos </label>

                        <div class="col-12 nombres_usuario-formProf">
                            <input class="input_nomApl-formProf" value="{{$objuser->primerapellido}}" readonly></input>
                            <input class="input_nomApl-formProf" value="{{$objuser->segundoapellido}}" readonly></input>
                        </div>
                    </div>
                    @endforeach

                        <div class="col-lg-6 pr-0">
                            <label for="title">  Fecha de nacimiento </label>

                            <input class="col-lg-12 form-control" type="date" value="{{$objFormulario->fechanacimiento}}" id="example-date-input" name="fechanacimiento">
                        </div>
         

                    <div class="col-lg-6 pr-0">
                        <label for="title"> Selecione Área </label> 

                        <select id="idarea" name="idarea" class="col-lg-12 form-control">
                            <option value="" selected disabled>Seleccione area</option>

                            @foreach($area as $area)
                                <option value="{{$area->idArea}}"> {{$area->nombreArea}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-lg-6 pr-0">
                        <label for="title"> Selecione Profesión </label>

                        <select name="idprofesion" id="idprofesion" class="col-lg-12 form-control"></select>
                    </div>

                    <div class="col-lg-6 pr-0">
                        <label for="title"> Seleccione especialidad </label>

                        <select name="idespecialidad" id="idespecialidad" class="col-lg-12 form-control"></select>
                    </div>
            
                    <div class="col-lg-6 pr-0">
                        <label for="title"> Selecione Universidad </label>

                        <select  class="col-lg-12 form-control" name="id_universidad">
                            @foreach($objFormulario1 as $objFormulario1)
                                <option value="{{$objFormulario1->id_universidad}}">{{$objFormulario1->nombreuniversidad}}</option>
                            @endforeach

                            @foreach($universidades as $universidades1)
                                <option value="{{$universidades1->id_universidad}}"> {{$universidades1->nombreuniversidad}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-lg-6 pr-0">
                        <div class="form-group">
                            <label for="title"> Tarjeta Profesional </label>

                            <input class="col-lg-12 form-control" id="tarjeta" placeholder="N. Tarjeta" type="number" name="numeroTarjeta" value="{{$objFormulario->numeroTarjeta}}">
                        </div>
                    </div>

                    <div class="col-lg-3 content_btnEnviar-formProf">
                        <button type="submit" class="btn_enviar-formProf">Enviar
                            <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flecha_ingreso-membresia" alt=""> 
                        </button>
                    </div>
                </div>
            </div>
            <!------------------ Fin campos llenos ---------------------> 

            <!--------------- Inicio campos vacios--------------------->    
        @else
            <div class="row fila_infoBasica-formProf">
                <!-- Sección imagen de usuario --> 
                <div class="col-lg-3 contain_imgUsuario-formProf">   
                    <img class="img_usuario-formProf" id="imagenPrevisualizacion">

                    <input class="input_imgUsuario-formProf" type="file" name="logo"  id="seleccionArchivos" accept="image/png, image/jpeg">

                    <label class="text_usuario-formProf"> Subir foto de perfil </label>
                </div>
          
                <!-- Sección datos personales -->
                <div class="row col-lg-9 datos_principales-formProf">
                    @foreach ($objuser as $objuser)
                        <div class="col-lg-6 pr-0">
                            <label for="example-date-input" class="col-12 col-form-label px-0"> Nombres </label>

                            <div class="col-12 nombres_usuario-formProf">
                                <input class="input_nomApl-formProf" value="{{$objuser->primernombre}}" readonly></input>
                                <input class="input_nomApl-formProf" value="{{$objuser->segundonombre}}" readonly></input>
                            </div>
                        </div>

                        <div class="col-lg-6 pr-0">
                            <label for="example-date-input" class="col-lg-12 col-form-label px-0"> Apellidos </label>

                            <div class="col-12 nombres_usuario-formProf">
                                <input class="input_nomApl-formProf" value="{{$objuser->primerapellido}}" readonly></input>
                                <input class="input_nomApl-formProf" value="{{$objuser->segundoapellido}}" readonly></input>
                            </div>
                        </div>
                    @endforeach
       
                    <div class="col-lg-6 pr-0">
                        <label for="title">  Fecha de nacimiento </label>
                        
                        <input class="col-lg-12 form-control" type="date" value="2011-08-19" id="example-date-input" name="fechanacimiento">
                    </div>

                    <div class="col-lg-6 pr-0">
                        <label for="title"> Selecione Área </label> 

                        <select id="idarea" name="idarea" class="col-lg-12 form-control" style="width:350px" >
                            <option value="" selected disabled> Seleccione area</option>

                            @foreach($area as $area)
                                <option value="{{$area->idArea}}"> {{$area->nombreArea}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-lg-6 pr-0">
                        <label for="title"> Selecione Profesión </label> 

                        <select name="idprofesion" id="idprofesion" class="col-lg-12 form-control" style="width:350px"></select>
                    </div>

                    <div class="col-lg-6 pr-0">
                        <label for="title"> Seleccione especialidad </label>

                        <select name="idespecialidad" id="idespecialidad" class="col-lg-12 form-control" style="width:350px"></select>
                    </div>
                  
                    <div class="col-lg-6 pr-0">
                        <div class="form-group">
                            <label for="title"> Selecione Universidad </label>

                            <select  class="col-lg-12 form-control" style="width:350px" name="id_universidad">
                                <option value="">Seleccione Universidad</option>

                                @foreach($universidades as $universidades2)
                                    <option value="{{$universidades2->id_universidad}}"> {{$universidades2->nombreuniversidad}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-6 pr-0">
                        <div class="form-group">
                            <label for="title"> Tarjeta Profesional </label>

                            <input class="col-lg-12 form-control" id="tarjeta" placeholder="nombre" type="number" name="numeroTarjeta">
                        </div>
                    </div>

                    <div class="col-lg-3 content_btnEnviar-formProf">
                        <button type="submit" class="btn_enviar-formProf"> Enviar
                            <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flecha_ingreso-membresia" alt=""> 
                        </button>
                    </div>
                </div>
            </div>
        @endif
        <!--------------- Fin campos vacios--------------------->  
    </form>
</div>
<!--------------------------------------------      Fin 1 primera parte del formulario *** INFORMACIÓN BÁSICA ***      ------------------------------------------------>

<!--------------------------------------------      Inicio 2 segunda parte del formulario *** INFORMACIÓN CONTACTO ***      ------------------------------------------------>
<div class="col-lg-10 infoBasica_formProf">
    <form method="POST" action="{{ url ('/FormularioProfesionalSave2') }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8">
        <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
        <h5 class="col-lg-12 icon_infoBasica-formProf"> Información de contacto </h5>
        <div class="row fila_infoBasica-formProf">
            @if(!empty($objFormulario))
                <div class="col-6 pr-0">
                    <div class="form-group">
                        <label for="title"> Celular </label>

                        <input class="col-lg-12 form-control" id="tarjeta" placeholder="N. Celular" type="number" name="celular" value="{{$objFormulario->celular}}">
                    </div>
                </div>

                <div class="col-6 pr-0">
                    <div class="form-group">
                        <label for="title"> Teléfono </label>

                        <input class="col-lg-12 form-control" id="telefono" placeholder="N. Telefono" type="number" name="telefono" value="{{$objFormulario->telefono}}">
                    </div>
                </div>
                
                <div class="col-6 pr-0">
                    <div class="form-group">
                        <label for="title"> Dirección </label>
                        
                        <input class="col-lg-12 form-control" id="direccion" placeholder="N. direccion" type="text" name="direccion" value="{{$objFormulario->direccion}}">
                    </div>
                </div>

                <!--menu dinamico ciudades -->
                <div class="col-6 pr-0">
                    <label for="title"> Selecione País </label>

                    <select id="idpais" name="idpais" class="col-12 form-control">
                        <option value="" selected disabled>Seleccione pais</option>
                        @foreach($pais as $pais)
                            <option value="{{$pais->id_pais}}"> {{$pais->nombre}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-6 pr-0">
                    <label for="title"> Selecione Departamento </label>

                    <select name="id_departamento" id="id_departamento" class="col-12 form-control"></select>
                </div>
            
                <div class="col-6 pr-0">
                    <label for="title"> Seleccione Provincia </label>

                    <select name="id_provincia" id="id_provincia" class="col-12 form-control"></select>
                </div>

                <div class="col-6 pr-0">
                    <label for="title"> Seleccione Ciudad </label>

                    <select name="id_municipio" id="id_municipio" class="col-12 form-control"></select>
                </div>

                <div class="col-lg-12 content_btnEnviar-formProf">
                    <button type="submit" class="btn2_enviar-formProf">Enviar
                        <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flecha_ingreso-membresia" alt=""> 
                    </button>
                </div>
                
            @else
                <div class="col-6 pr-0">
                    <div class="form-group">
                        <label for="title"> Celular </label>
                        
                        <input class="col-lg-12 form-control" id="tarjeta" placeholder="N. Celular" type="number" name="celular" >
                    </div>
                </div>

                <div class="col-6 pr-0">
                    <div class="form-group">
                        <label for="title"> Teléfono </label>

                        <input class="col-lg-12 form-control" id="telefono" placeholder="N. Telefono" type="number" name="telefono" >
                    </div>
                </div>

                <div class="col-6 pr-0">
                    <div class="form-group">
                        <label for="title"> Dirección </label>

                        <input class="col-lg-12 form-control" id="direccion" placeholder="N. direccion" type="text" name="direccion" >
                    </div>
                </div>

                <!--menu dinamico ciudades -->
                <div class="col-6 pr-0">
                    <label for="title"> Seleccione País </label>

                    <select id="idpais" name="idpais" class="form-control">
                        <option value="" selected disabled>Seleccione pais</option>
                            @foreach($pais as $pais)
                        <option value="{{$pais->id_pais}}"> {{$pais->nombre}}</option>
                            @endforeach
                    </select>
                </div>

                <div class="col-6 pr-0">
                    <label for="title"> Selecione Departamento </label>

                    <select name="id_departamento" id="id_departamento" class="form-control">
                    </select>
                </div>
        
                <div class="col-6 pr-0">
                    <label for="title"> Seleccione provincia </label>
                    <select name="id_provincia" id="id_provincia" class="form-control">
                    </select>
                </div>

                <div class="col-6 pr-0">
                    <label for="title"> Seleccione Ciudad </label>

                    <select name="id_municipio" id="id_municipio" class="form-control">
                    </select>
                </div>

                <div class="col-lg-12 content_btnEnviar-formProf">
                    <button type="submit" class="btn2_enviar-formProf">Enviar
                        <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flecha_ingreso-membresia" alt=""> 
                    </button>
                </div>
            @endif
        </div>
    </form>
</div>
<!--------------------------------------------      Fin 2 segunda parte del formulario *** INFORMACIÓN CONTACTO ***      ------------------------------------------------>

<!--------------------------------------------      Inicio 3 tercera parte del formulario *** INFORMACIÓN CONSULTA ***      ------------------------------------------------>
<div class="col-lg-10 pb-3 infoBasica_formProf">
    <h5 class="col-lg-12 icon_infoBasica-formProf"> Información consulta </h5>
    @foreach($objConsultas as $objConsultas)
        @if(!empty($objConsultas->nombreconsulta))
            <div class="col-12">
                <span>{{$objConsultas->nombreconsulta}} $ {{$objConsultas->valorconsulta}}</span>
                
                <a href="{{url('/FormularioProfesionaldelete5/'.$objConsultas->id)}}">
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
                <div class="col-6 pr-0">
                    <label for="inputState"> Tipo Consulta </label>

                    <select id="inputState" class="form-control" name="nombreconsulta[]">
                        <option value=" " selected> Seleccionar </option>
                        <option value="Presencial"> Presencial </option>
                        <option value="Virtual"> Virtual </option>
                        <option value="Control médico"> Control Médico </option>
                    </select>
                </div>

                <div class="col-6 pr-0">
                    <label for="inputZip"> Valor </label>
                        
                    <input type="number" min="0.00" max="10000.00" step="0.01" class="form-control" name="valorconsulta[]">
                </div>
            </div>

            <div class="col-12 seccion_consulta-formProf">
                <div class="col-6 pr-0">
                    <label for="inputState"> Tipo Consulta </label>

                    <select id="inputState" class="form-control" name="nombreconsulta[]">
                        <option value=" " selected> Seleccionar </option>
                        <option value="Presencial"> Presencial </option>
                        <option value="Virtual"> Virtual </option>
                        <option value="Control médico"> Control Médico </option>
                    </select>
                </div>

                <div class="col-6 pr-0">
                    <label for="inputZip"> Valor </label> 

                    <input type="number" min="0.00" max="10000.00" step="0.01" class="form-control" name="valorconsulta[]">
                </div>
            </div>

            <div class="col-12 seccion_consulta-formProf">
                <div class="col-6 pr-0">
                    <label for="inputState"> Tipo Consulta </label>

                    <select id="inputState" class="form-control" name="nombreconsulta[]">
                        <option value=" " selected> Seleccionar </option>
                        <option value="Presencial"> Presencial </option>
                        <option value="Virtual"> Virtual</option>
                        <option value="Control médico"> Control Médico </option>
                    </select>
                </div>

                <div class="col-6 pr-0">
                    <label for="inputZip"> Valor </label>

                    <input type="number" min="0.00" max="10000.00" step="0.01" class="form-control" name="valorconsulta[]">
                </div>
            </div>
        @elseif($objContadorConsultas->cantidad == 1)
            <div class="col-12 seccion_consulta-formProf">
                <div class="col-6 pr-0">
                    <label for="inputState"> Tipo Consulta </label> 

                    <select id="inputState" class="form-control" name="nombreconsulta[]">
                        <option value=" " selected> Seleccionar </option>
                        <option value="Presencial"> Presencial </option>
                        <option value="Virtual"> Virtual </option> 
                        <option value="Control médico"> Control Médico </option>
                    </select>
                </div>

                <div class="col-6 pr-0">
                    <label for="inputZip"> Valor </label>

                    <input type="number" min="0.00" max="10000.00" step="0.01" class="form-control" name="valorconsulta[]">
                </div>
            </div>

            <div class="col-12 seccion_consulta-formProf">
                <div class="col-6 pr-0">
                    <label for="inputState"> Tipo Consulta </label> 

                    <select id="inputState" class="form-control" name="nombreconsulta[]">
                        <option value=" " selected> Seleccionar </option>
                        <option value="Presencial"> Presencial </option>
                        <option value="Virtual"> Virtual </option>
                        <option value="Control médico"> Control Médico </option>
                    </select>
                </div>

                <div class="col-6 pr-0">
                    <label for="inputZip"> Valor </label>

                    <input type="number" min="0.00" max="10000.00" step="0.01" class="form-control" name="valorconsulta[]">
                </div>
            </div>

        @elseif($objContadorConsultas->cantidad == 2)
            <div class="col-12 seccion_consulta-formProf">
                <div class="col-6 pr-0">
                    <label for="inputState"> Tipo Consulta </label>

                    <select id="inputState" class="form-control" name="nombreconsulta[]">
                        <option value=" " selected> Seleccionar </option>
                        <option value="Presencial"> Presencial </option>
                        <option value="Virtual"> Virtual </option>
                        <option value="Control médico"> Control Médico </option>
                    </select>
                </div>

                <div class="col-6 pr-0">
                    <label for="inputZip"> Valor </label>

                    <input type="number" min="0.00" max="10000.00" step="0.01" class="form-control" name="valorconsulta[]">
                </div>
            </div>
        @elseif($objContadorConsultas->cantidad == 3)
            <span>No se puede agragar mas </span>
        @endif

        <div class="col-lg-12 content_btnEnviar-formProf">
            <button type="submit" class="btn2_enviar-formProf">Enviar
                <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flecha_ingreso-membresia" alt=""> 
            </button>
        </div>
    </form>
</div>
<!--------------------------------------------      Fin 3 tercera parte del formulario *** INFORMACIÓN CONSULTA ***      ------------------------------------------------> 

<!--------------------------------------------      Inicio 4 cuarta parte del formulario *** PERFIL PROFESIONAL ***      ------------------------------------------------>
<div class="col-lg-10 pb-3 infoBasica_formProf">
    <h5 class="col-lg-12 icon_infoBasica-formProf"> Perfil Profesional </h5>

    <form method="POST" action="{{ url ('/FormularioProfesionalSave4') }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8">
        <input type="hidden" name="_token" value="{{ csrf_token() }}"> 

        @if(!empty($objFormulario))
            <div class="col-12 pr-0">
                <div class="form-group">
                    <label for="title"> Escriba una breve descripción de su Biografía </label>

                    <textarea class="form-control" id="descripcionPerfil"  type="text" name="descripcionPerfil" >{{$objFormulario->descripcionPerfil}}</textarea>
                </div>
            </div>
        @else
            <div class="col-12 pr-0">
                <div class="form-group">
                    <label for="title"> Escriba una breve descripción de su Biografía </label>

                    <textarea class="form-control" id="descripcionPerfil"  type="text" name="descripcionPerfil" ></textarea>
                </div>
            </div>
        @endif
        <div class="col-lg-12 content_btnEnviar-formProf">
            <button type="submit" class="btn2_enviar-formProf"> Guardar
                <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flecha_ingreso-membresia" alt=""> 
            </button>
        </div>
    </form>
</div>
<!--------------------------------------------      Fin 4 cuarta parte del formulario *** PERFIL PROFESIONAL ***      ------------------------------------------------>

<!--------------------------------------------      Inicio 5 quinta parte del formulario *** EDUCACIÓN ***      ------------------------------------------------>
<div class="col-lg-10 pb-3 infoBasica_formProf">
    <h5 class="col-lg-12 icon_infoBasica-formProf"> Educación </h5>

    <form method="POST" action="{{ url ('/FormularioProfesionalSave5') }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8">
        <input type="hidden" name="_token" value="{{ csrf_token() }}"> 

        <div class="row p-0 m-0">
            <div class="col-6 pr-0">
                <label for="title"> Selecione Universidad </label>

                <select  class="form-control" name="id_universidad[]">
                    <option value="">Seleccione Universidad</option>

                    @foreach($universidades as $universidad)
                        <option value="{{$universidad->id_universidad}}"> {{$universidad->nombreuniversidad}}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="col-6 pr-0">
                <label for="title"> Fecha de finalización </label>
            
                <input class="form-control" type="date" value="2011-08-19" id="example-date-input" name="fechaestudio[]">
            </div>

            <div class="col-6 pr-0">
                <div class="form-group">
                    <label for="title"> Disciplina académica </label>

                    <input class="form-control" id="direccion" type="text" name="nombreestudio[]" value="">
                </div>
            </div>
        </div>

        <div class="row p-0 m-0">
            <div class="col-6 pr-0">
                <label for="title"> Selecione Universidad </label>

                <select  class="form-control" name="id_universidad[]">
                    <option value="">Seleccione Universidad</option>

                    @foreach($universidades as $universidad)
                        <option value="{{$universidad->id_universidad}}"> {{$universidad->nombreuniversidad}}</option>
                    @endforeach
                </select>
            </div>
      
            <div class="col-6 pr-0">
                <label for="title"> Fecha de finalización </label>

                <input class="form-control" type="date" value="2011-08-19" id="example-date-input" name="fechaestudio[]">
            </div>

            <div class="col-6 pr-0">
                <div class="form-group">
                    <label for="title"> Disciplina académica </label>

                    <input class="form-control" id="direccion" type="text" name="nombreestudio[]" value="">
                </div>
            </div>
        </div>

                    
        <div class="row p-0 m-0">
            <div class="col-6 pr-0">
                <label for="title"> Selecione Universidad </label>
                    <select  class="form-control" name="id_universidad[]">
                        <option value="">Seleccione Universidad</option>

                        @foreach($universidades as $universidad)
                            <option value="{{$universidad->id_universidad}}"> {{$universidad->nombreuniversidad}}</option>
                        @endforeach
                    </select>
            </div>

            <div class="col-6 pr-0">
                <label for="title"> Fecha de finalización </label>

                <input class="form-control" type="date" value="2011-08-19" id="example-date-input" name="fechaestudio[]">
            </div>

            <div class="col-6 pr-0">
                <div class="form-group">
                    <label for="title"> Disciplina académica </label>

                    <input class="form-control" id="direccion" type="text" name="nombreestudio[]" value="">
                </div>
           </div>
        </div>

        <div class="row p-0 m-0">
            <div class="col-6 pr-0">
                <label for="title"> Selecione Universidad </label>

                <select  class="form-control" name="id_universidad[]">
                    <option value="">Seleccione Universidad</option>

                    @foreach($universidades as $universidad)
                        <option value="{{$universidad->id_universidad}}"> {{$universidad->nombreuniversidad}}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-6 pr-0">
                <label for="title"> Fecha de finalización </label>

                <input class="form-control" type="date" value="2011-08-19" id="example-date-input" name="fechaestudio[]">
            </div>

            <div class="col-6 pr-0">
                <div class="form-group">
                    <label for="title"> Disciplina académica </label>

                    <input class="form-control" id="direccion" type="text" name="nombreestudio[]" value="">
                </div>
            </div>
        </div>

        <div class="col-lg-12 content_btnEnviar-formProf">
            <button type="submit" class="btn2_enviar-formProf"> Guardar
                <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flecha_ingreso-membresia" alt=""> 
            </button>
        </div>
    </form> 
</div>
<!--------------------------------------------      Fin 5 quinta parte del formulario *** EDUCACIÓN ***      ------------------------------------------------>

<!--------------------------------------------      Inicio 6 sexta parte del formulario *** EXPERIENCIA ***      ------------------------------------------------>
<div class="col-lg-10 pb-3 infoBasica_formProf">
    <h5 class="col-lg-12 icon_infoBasica-formProf"> Experiencia </h5>

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

        @if($objContadorExperiencia->cantidad >= 4)
            <span>No puede agregar mas campos</span>
        @else
            
            <div class="row fila_infoBasica-formProf" id="listas"> 
                <div class="col-6 pr-0">
                    <label for="title"> Empresa </label>

                    <input class="col-lg-12 form-control" id="nombreEmpresaExperiencia"  type="text" name="nombreEmpresaExperiencia[]" value="">
                </div>

                <div class="col-6 pr-0">
                    <label for="title"> Cargo </label>

                    <input class="col-lg-12 form-control" id="descripcionExperiencia"  type="text" name="descripcionExperiencia[]" value="">
                </div>

                <div class="col-6 pr-0">
                    <label for="example-date-input" class="col-form-label"> Fecha de inicio </label>

                    <input class="form-control" type="date"  id="fechaInicioExperiencia" name="fechaInicioExperiencia[]" value="">
                </div>

                <div class="col-6 pr-0">
                    <label for="example-date-input" class="col-form-label"> Fecha de terminación </label>

                    <input class="form-control" type="date"  id="fechaFinExperienci" name="fechaFinExperiencia[]" value="">
                </div>
            </div>

            <div class="col-lg-12 content_btnEnviar-formProf">
                <button type="submit" class="btn2_enviar-formProf"> Guardar
                    <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flecha_ingreso-membresia" alt=""> 
                </button>
            </div>
        @endif
        <!-- <input class="contadorexperinecia" name="contadorexperinecia" type="text" value="1">-->
    </form>
</div>
<!--------------------------------------------      Fin 6 sexta parte del formulario *** EXPERIENCIA ***      ------------------------------------------------>

<!--------------------------------------------      Inicio 7 septima parte del formulario *** ASOCIACIONES ***      ------------------------------------------------>
<div class="col-lg-10 pb-3 infoBasica_formProf">
    <h5 class="col-lg-12 icon_infoBasica-formProf"> Asociaciones </h5>

    <div class="row col-12 px-0 pt-3 m-0">
        @foreach($objAsociaciones as $objAsociaciones)
            @if(!empty($objAsociaciones->imgasociacion))
                <div class="col-6 content_imgGuardada-formProf">
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
            <div class="row col-12 px-0 pt-3 m-0">
                <div class="col-6 content_agregarImg-formProf form-group">
                    <div class="col-10 img_selccionada-formProf">
                        <div class="img_anexada-formProf" id="preview1"></div>
                    </div>

                    <div class="agregar_archivo-formProf">
                        <input type='file' id="imgasocia1" name="imgasociacion[]"/>
                    </div>
                </div> 

                <div class="col-6 content_agregarImg-formProf form-group">
                    <div class="col-10 img_selccionada-formProf">
                        <div class="img_anexada-formProf" id="preview2"></div>
                    </div>

                    <div class="agregar_archivo-formProf">
                        <input type='file' id="imgasocia2" name="imgasociacion[]"/>
                    </div>
                </div> 

                <div class="col-6 content_agregarImg-formProf form-group">
                    <div class="col-10 img_selccionada-formProf">
                        <div class="img_anexada-formProf" id="preview3"></div>
                    </div>

                    <div class="agregar_archivo-formProf">
                        <input type='file' id="imgasocia3" name="imgasociacion[]"/>
                    </div>
                </div> 
                
                <div class="col-6 content_agregarImg-formProf form-group">
                    <div class="col-10 img_selccionada-formProf">
                        <div class="img_anexada-formProf" id="preview4"></div>
                    </div>

                    <div class="agregar_archivo-formProf">
                        <input type='file' id="imgasocia4" name="imgasociacion[]"/>
                    </div>
                </div>  
            </div>

        @elseif($objContadorAsociaciones->cantidad == 1)
            <div class="row col-12 px-0 pt-3 m-0">
                <div class="col-6 content_agregarImg-formProf form-group">
                    <div class="col-10 img_selccionada-formProf">
                        <div class="img_anexada-formProf" id="preview1"></div>   
                    </div>

                    <div class="agregar_archivo-formProf">
                        <input type='file' id="imgasocia1" name="imgasociacion[]"/> 
                    </div>
                </div> 

                <div class="col-6 content_agregarImg-formProf form-group">
                    <div class="col-10 img_selccionada-formProf">
                        <div class="img_anexada-formProf" id="preview2"></div> 
                    </div>

                    <div class="agregar_archivo-formProf">
                        <input type='file' id="imgasocia2" name="imgasociacion[]"/>
                    </div>
                </div> 

                <div class="col-6 content_agregarImg-formProf form-group">
                    <div class="col-10 img_selccionada-formProf">
                        <div class="img_anexada-formProf" id="preview3"></div>  
                    </div>

                    <div class="agregar_archivo-formProf">
                        <input type='file' id="imgasocia3" name="imgasociacion[]"/>
                    </div>
                </div>  
            </div>

        @elseif($objContadorAsociaciones->cantidad == 2)
            <div class="row col-12 px-0 pt-3 m-0">
                <div class="col-6 content_agregarImg-formProf form-group">
                    <div class="col-10 img_selccionada-formProf">
                        <div class="img_anexada-formProf" id="preview1"></div>
                    </div>

                    <div class="agregar_archivo-formProf">
                        <input type='file' id="imgasocia1" name="imgasociacion[]"/>
                    </div>
                </div> 

                <div class="col-6 content_agregarImg-formProf form-group">
                    <div class="col-10 img_selccionada-formProf">
                        <div class="img_anexada-formProf" id="preview2"></div>
                    </div>

                    <div class="agregar_archivo-formProf">
                        <input type='file' id="imgasocia2" name="imgasociacion[]"/>
                    </div>
                </div> 
            </div> 

        @elseif($objContadorAsociaciones->cantidad == 3)
            <div class="row col-12 px-0 pt-3 m-0">
                <div class="col-6 content_agregarImg-formProf form-group">
                    <div class="col-10 img_selccionada-formProf">
                        <div class="img_anexada-formProf" id="preview1"></div>
                    </div>

                    <div class="agregar_archivo-formProf">
                        <input type='file' id="imgasocia1" name="imgasociacion[]"/>
                    </div>
                </div> 
            </div> 

        @elseif($objContadorAsociaciones->cantidad >= 4)
            <span>no se puede agregar mas fotos</span>
        @endif
            
        <div class="col-lg-12 content_btnEnviar-formProf">
            <button type="submit" class="btn2_enviar-formProf"> Guardar
                <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flecha_ingreso-membresia" alt=""> 
            </button>
        </div>
    </form>
</div>
<!--------------------------------------------      Fin 7 septima parte del formulario *** ASOCIACIONES ***      ------------------------------------------------>

<!--------------------------------------------      Inicio 8 octava parte del formulario *** IDIOMAS ***      ------------------------------------------------>
<div class="col-lg-10 pb-3 infoBasica_formProf">
    <h5 class="col-lg-12 icon_infoBasica-formProf"> Idiomas </h5>

    <div class="row p-0 m-0">
        @foreach($objIdiomas as $objIdiomas)
            @if(!empty($objIdiomas->imgidioma))
                <div class="col-4 mt-3">
                    <a href="{{url('/FormularioProfesionaldelete8/'.$objIdiomas->id_idioma)}}">
                        <button type="submit" class="close" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </a>

                    <label for="title">{{$objIdiomas->nombreidioma}}</label>

                    <img id="imagenPrevisualizacion" src="{{URL::asset($objIdiomas->imgidioma)}}">
                </div>
            @endif
        @endforeach
    </div>

    <form method="POST" action="{{ url ('/FormularioProfesionalSave8') }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">  
            
        @if($objContadorIdiomas->cantidad == 0)
            <div class="row p-0 m-0">
                <div class="col-6 pr-0">
                    <label for="title"> Seleccione idioma </label>

                    <select  class="form-control" name="id_idioma[]">
                        <option value=" ">Seleccione</option>
                        @foreach($idiomas as $idiomas1)
                            <option value="{{$idiomas1->id_idioma}}"> {{$idiomas1->nombreidioma}}</option>
                        @endforeach
                    </select>
                </div>                    

                <div class="col-6 pr-0">
                    <label for="title"> Seleccione idioma </label>

                    <select  class="form-control" name="id_idioma[]">
                        <option value=" ">Seleccione</option>
                        @foreach($idiomas as $idiomas2)
                            <option value="{{$idiomas2->id_idioma}}"> {{$idiomas2->nombreidioma}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-6 pr-0">
                    <label for="title"> Seleccione idioma </label>

                    <select  class="form-control" name="id_idioma[]">
                        <option value=" ">Seleccione</option>
                        @foreach($idiomas as $idiomas3)
                            <option value="{{$idiomas3->id_idioma}}"> {{$idiomas3->nombreidioma}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

        @elseif($objContadorIdiomas->cantidad == 1)
            <div class="row p-0 m-0">
                <div class="col-6 pr-0">
                    <label for="title"> Seleccione idioma </label>

                    <select  class="form-control" name="id_idioma[]">
                        <option value=" ">Seleccione</option>
                        @foreach($idiomas as $idiomas1)
                            <option value="{{$idiomas1->id_idioma}}"> {{$idiomas1->nombreidioma}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-6 pr-0">
                    <label for="title"> Seleccione idioma </label>

                    <select  class="form-control" name="id_idioma[]">
                        <option value=" ">Seleccione</option>
                        @foreach($idiomas as $idiomas2)
                            <option value="{{$idiomas2->id_idioma}}"> {{$idiomas2->nombreidioma}}</option>
                        @endforeach
                    </select>
                </div>
            </div>  
        @elseif($objContadorIdiomas->cantidad == 2)
            <div class="row p-0 m-0">
                <div class="col-6 pr-0">
                    <label for="title"> Seleccione idioma </label>

                    <select  class="form-control" style="width:350px" name="id_idioma[]">
                        <option value=" ">Seleccione</option>
                        @foreach($idiomas as $idiomas1)
                            <option value="{{$idiomas1->id_idioma}}"> {{$idiomas1->nombreidioma}}</option>
                        @endforeach
                    </select>
                </div>
            </div>  
        @elseif($objContadorIdiomas->cantidad == 3)
            <span>No se puede agragrar</span>
        @endif 

        <div class="col-lg-12 content_btnEnviar-formProf">
            <button type="submit" class="btn2_enviar-formProf"> Guardar
                <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flecha_ingreso-membresia" alt=""> 
            </button>
        </div>
    </form>
</div>
<!--------------------------------------------      Fin 8 octava parte del formulario *** IDIOMAS ***      ------------------------------------------------>

<!--------------------------------------------      Inicio 9 novena parte del formulario *** TRATAMIENTOS y PROCEDIMIENTOS ***      ------------------------------------------------>
<div class="col-lg-10 pb-3 infoBasica_formProf">
    <h5 class="col-lg-12 icon_infoBasica-formProf"> Tratamientos y procedimientos </h5>

    <p class="text_superior-proced-formProf"> A continuación suba imágenes con respecto a los procedimientos y tratamientos, con su título y descripción. </p>

    @foreach($objTratamiento as $objTratamiento)
        @if(!empty($objTratamiento->imgTratamientoAntes))
            <div class="row col-12 p-0 m-0">
                <div class="col-12">
                    <a href="{{url('/FormularioProfesionaldelete9/'.$objTratamiento->id_tratamiento)}}">
                        <button type="submit" class="close" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </a>
                </div>

                <!-- Contenido ANTES -->
                <div class="col-6 content_antes-formProf">
                    <div class="col-12 pl-0 content_agregarImg-formProf form-group">
                        <label for="title"> Antes </label> 

                        <div class="col-10 img_selccionada-formProf">
                            <img src="{{URL::asset($objTratamiento->imgTratamientoAntes)}}">
                        </div>

                        <div class="col-12 pl-0">
                            <div class="form-group">
                                <span>{{$objTratamiento->tituloTrataminetoAntes}}</span>
                            </div>
                        </div>

                        <div class="col-12 pl-0">
                            <div class="form-group">
                                <span>{{$objTratamiento->descripcionTratamientoAntes}}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contenido DESPUÉS -->
                <div class="col-6 content_agregarImg-formProf form-group">
                    <label for="title"> Después </label> 

                    <div class="col-10 img_selccionada-formProf">
                        <img  src="{{URL::asset($objTratamiento->imgTratamientodespues)}}">
                    </div>

                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <span>{{$objTratamiento->tituloTrataminetoDespues}}</span>
                        </div>
                    </div>

                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <span>{{$objTratamiento->descripcionTratamientoDespues}}</span>
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
                <div class="col-6 content_antes-formProf">
                    <div class="col-12 pl-0 content_agregarImg-formProf form-group">
                        <label for="title"> Antes </label> 

                        <div class="col-10 img_selccionada-formProf">
                            <div class="img_anexada-formProf" id="previewates1"></div>
                        </div>

                        <div class="agregar_archivo-formProf">
                            <input type='file' id="imgantes1" name="imgTratamientoAntes[]"/>
                        </div>
                    </div> 

                    <div class="col-12 pl-0">
                        <div class="form-group">
                            <label for="title"> Título de la imagen Antes </label> 

                            <input class="form-control" id="descripcionExperiencia"  type="text" name="tituloTrataminetoAntes[]" value="">
                        </div>
                    </div>

                    <div class="col-12 pl-0">
                        <div class="form-group">
                            <label for="title"> Descripción Antes </label>

                            <input class="form-control" id="descripcionExperiencia"  type="text" name="descripcionTratamientoAntes[]" value="">
                        </div>
                    </div>
                </div>

                <!-- Contenido DESPUÉS -->
                <div class="col-6 pr-0">
                    <div class="col-12 content_agregarImg-formProf form-group">
                        <label for="title"> Después </label> 

                        <div class="col-10 img_selccionada-formProf">
                            <div class="img_anexada-formProf" id="preview1"></div>
                        </div>

                        <div class="agregar_archivo-formProf">
                            <input type='file' id="imgasocia1" name="imgTratamientodespues[]"/>
                        </div>
                    </div> 

                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title"> Título de la imagen Después </label>

                            <input class="form-control" id="descripcionExperiencia"  type="text" name="tituloTrataminetoDespues[]" value="">
                        </div>
                    </div>

                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title"> Descripción Después </label>

                            <input class="form-control" id="descripcionExperiencia"  type="text" name="descripcionTratamientoDespues[]" value="">
                        </div>
                    </div> 
                </div>
            </div>

            <!-- Modulo de los contenidos ANTES y DESPUÉS -->
            <div class="row content_antDesp-formProf">
                <!-- Contenido ANTES -->
                <div class="col-6 content_antes-formProf">
                    <div class="col-12 pl-0 content_agregarImg-formProf form-group">
                        <label for="title"> Antes </label>


                        <div class="col-10 img_selccionada-formProf">
                            <div class="img_anexada-formProf" id="previewates1"></div>
                        </div>

                        <div class="agregar_archivo-formProf">
                            <input type='file' id="imgantes1" name="imgTratamientoAntes[]"/>
                        </div> 
                    </div> 

                    <div class="col-12 pl-0">
                        <div class="form-group">
                            <label for="title"> Título de la imagen Antes </label> 

                            <input class="form-control" id="descripcionExperiencia"  type="text" name="tituloTrataminetoAntes[]" value="">
                        </div>
                    </div>

                    <div class="col-12 pl-0">
                        <div class="form-group">
                            <label for="title"> Descripción Antes </label>

                            <input class="form-control" id="descripcionExperiencia"  type="text" name="descripcionTratamientoAntes[]" value="">
                        </div>
                    </div>
                </div>

                <!-- Contenido DESPUÉS -->
                <div class="col-6">
                    <div class="col-12 content_agregarImg-formProf form-group">
                        <label for="title"> Después </label> 

                        <div class="col-10 img_selccionada-formProf">
                            <div class="img_anexada-formProf" id="preview1"></div>
                        </div>

                        <div class="agregar_archivo-formProf">
                            <input type='file' id="imgasocia1" name="imgTratamientodespues[]"/>
                        </div>
                    </div> 

                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title"> Título de la imagen Después </label>

                            <input class="form-control" id="descripcionExperiencia"  type="text" name="tituloTrataminetoDespues[]" value="">
                        </div>
                    </div>

                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title"> Descripción Después </label>

                            <input class="form-control" id="descripcionExperiencia"  type="text" name="descripcionTratamientoDespues[]" value="">
                        </div>
                    </div>
                </div>
            </div>
        @elseif($objContadorIdiomas->cantidad == 1)
            <!-- Modulo de los contenidos ANTES y DESPUÉS -->
            <div class="row content_antDesp-formProf">
                <!-- Contenido ANTES -->
                <div class="col-6 content_antes-formProf">
                    <div class="col-12 pl-0 content_agregarImg-formProf form-group">
                        <label for="title"> Antes </label>


                        <div class="col-10 img_selccionada-formProf">
                            <div class="img_anexada-formProf" id="previewates1"></div>
                        </div>

                        <div class="agregar_archivo-formProf">
                            <input type='file' id="imgantes1" name="imgTratamientoAntes[]"/>
                        </div> 
                    </div> 

                    <div class="col-12 pl-0">
                        <div class="form-group">
                            <label for="title"> Título de la imagen Antes </label> 

                            <input class="form-control" id="descripcionExperiencia"  type="text" name="tituloTrataminetoAntes[]" value="">
                        </div>
                    </div>

                    <div class="col-12 pl-0">
                        <div class="form-group">
                            <label for="title"> Descripción Antes </label>

                            <input class="form-control" id="descripcionExperiencia"  type="text" name="descripcionTratamientoAntes[]" value="">
                        </div>
                    </div>
                </div>

                <!-- Contenido DESPUÉS -->
                <div class="col-6">
                    <div class="col-12 content_agregarImg-formProf form-group">
                        <label for="title"> Después </label> 

                        <div class="col-10 img_selccionada-formProf">
                            <div class="img_anexada-formProf" id="preview1"></div>
                        </div>

                        <div class="agregar_archivo-formProf">
                            <input type='file' id="imgasocia1" name="imgTratamientodespues[]"/>
                        </div>
                    </div> 

                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title"> Título de la imagen Después </label>

                            <input class="form-control" id="descripcionExperiencia"  type="text" name="tituloTrataminetoDespues[]" value="">
                        </div>
                    </div>

                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title"> Descripción Después </label>

                            <input class="form-control" id="descripcionExperiencia"  type="text" name="descripcionTratamientoDespues[]" value="">
                        </div>
                    </div>
                </div>
            </div>
        @elseif($objContadorIdiomas->cantidad == 2)
            <span>No se pueden agregar mas</span>
        @endif 

        <div class="col-lg-12 content_btnEnviar-formProf">
            <button type="submit" class="btn2_enviar-formProf"> Guardar
                <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flecha_ingreso-membresia" alt=""> 
            </button>
        </div>
    </form>
</div>
<!--------------------------------------------      Fin 9 novena parte del formulario *** TRATAMIENTOS y PROCEDIMIENTOS ***      ------------------------------------------------>

<!--------------------------------------------      Inicio 10 decima parte del formulario *** PREMIOS y RECONOCIMIENTOS ***      ------------------------------------------------>
<div class="col-lg-10 pb-3 infoBasica_formProf">
    <h5 class="col-lg-12 icon_infoBasica-formProf"> Premios y reconocimientos </h5>

    <p class="text_superior-proced-formProf"> A continuación suba imágenes relacionadas con sus premios y reconocimientos, con nombre y descripción. </p>

    <!-- Modulo de los PREMIOS con información -->
    <div class="row col-12 p-0 m-0">
        @foreach($objPremios as $objPremios)
            @if(!empty($objPremios->nombrepremio))
                <!-- Contenido PREMIO -->    
                <div class="col-6 mt-3 content_antes-formProf">
                    <div class="col-12">
                        <a href="{{url('/FormularioProfesionaldelete10/'.$objPremios->id)}}">
                            <button type="submit" class="close" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </a>
                    </div>
                    
                    <div class="col-12 content_agregarImg-formProf form-group">

                        <div class="col-10 img_selccionada-formProf">
                            <img  src="{{URL::asset($objPremios->imgpremio)}}">
                        </div>

                        <div class="col-12 pl-0">
                            <div class="form-group">
                                <span>{{$objPremios->nombrepremio}}</span>
                            </div>
                        </div>

                        <div class="col-12 pl-0">
                            <div class="form-group">
                                <span>{{$objPremios->descripcionpremio}}</span>
                            </div>
                        </div>

                        <div class="col-12 pl-0">
                            <div class="form-group">
                                <span>{{$objPremios->fechapremio}}</span>
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
                <div class="col-6 content_antes-formProf">
                    <div class="col-12 pl-0 content_agregarImg-formProf form-group">
                        <div class="col-10 img_selccionada-formProf">
                            <div class="img_anexada-formProf" id="previewates"></div>
                        </div>

                        <div class="agregar_archivo-formProf">
                            <input type='file' id="imgantes" name="imgpremio[]"/>
                        </div>
                    </div>

                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="example-date-input" class="col-form-label">Fecha de inicio</label>
                        
                            <input class="form-control" type="date"  id="fechapremio" name="fechapremio[]" value="">
                        </div>
                    </div>

                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">titulo premio</label>

                            <input class="form-control" id="nombrepremio"  type="text" name="nombrepremio[]" value="">
                        </div>
                    </div>

                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Descrpcion premio</label>
                            
                            <input class="form-control" id="descripcionpremio"  type="text" name="descripcionpremio[]" value="">
                        </div>
                    </div>
                </div>

                <!-- Contenido PREMIO derecho -->
                <div class="col-6 pr-0">
                    <div class="col-12 content_agregarImg-formProf form-group">
                        <div class="form-group col-12 ">
                            <div class="col-10 img_selccionada-formProf">
                                <div class="img_anexada-formProf" id="previewates"></div>
                            </div>

                            <div class="agregar_archivo-formProf">
                                <input type='file' id="imgantes" name="imgpremio[]"/>
                            </div>
                        </div>

                        <div class="col-12 pr-0">
                            <label for="example-date-input" class="col-form-label">Fecha de inicio</label>
                            
                            <input class="form-control" type="date"  id="fechapremio" name="fechapremio[]" value="">
                        </div>

                        <div class="col-12 pr-0">
                            <div class="form-group">
                                <label for="title">titulo premio</label>

                                <input class="form-control" id="nombrepremio"  type="text" name="nombrepremio[]" value="">
                            </div>
                        </div>

                        <div class="col-12 pr-0">
                            <div class="form-group">
                                <label for="title">Descrpcion premio</label>

                                <input class="form-control" id="descripcionpremio"  type="text" name="descripcionpremio[]" value="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modulo de los PREMIOS sin información-->
            <div class="row content_antDesp-formProf">
                <!-- Contenido PREMIO izquierdo -->
                <div class="col-6 content_antes-formProf">
                    <div class="col-12 pl-0 content_agregarImg-formProf form-group">
                        <div class="col-10 img_selccionada-formProf">
                            <div class="img_anexada-formProf" id="previewates"></div>
                        </div>

                        <div class="agregar_archivo-formProf">
                            <input type='file' id="imgantes" name="imgpremio[]"/>
                        </div>
                    </div>

                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="example-date-input" class="col-form-label">Fecha de inicio</label>
                        
                            <input class="form-control" type="date"  id="fechapremio" name="fechapremio[]" value="">
                        </div>
                    </div>

                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">titulo premio</label>

                            <input class="form-control" id="nombrepremio"  type="text" name="nombrepremio[]" value="">
                        </div>
                    </div>

                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Descrpcion premio</label>
                            
                            <input class="form-control" id="descripcionpremio"  type="text" name="descripcionpremio[]" value="">
                        </div>
                    </div>
                </div>

                <!-- Contenido PREMIO derecho -->
                <div class="col-6 pr-0">
                    <div class="col-12 content_agregarImg-formProf form-group">
                        <div class="form-group col-12 ">
                            <div class="col-10 img_selccionada-formProf">
                                <div class="img_anexada-formProf" id="previewates"></div>
                            </div>

                            <div class="agregar_archivo-formProf">
                                <input type='file' id="imgantes" name="imgpremio[]"/>
                            </div>
                        </div>

                        <div class="col-12 pr-0">
                            <label for="example-date-input" class="col-form-label">Fecha de inicio</label>
                            
                            <input class="form-control" type="date"  id="fechapremio" name="fechapremio[]" value="">
                        </div>

                        <div class="col-12 pr-0">
                            <div class="form-group">
                                <label for="title">titulo premio</label>

                                <input class="form-control" id="nombrepremio"  type="text" name="nombrepremio[]" value="">
                            </div>
                        </div>

                        <div class="col-12 pr-0">
                            <div class="form-group">
                                <label for="title">Descrpcion premio</label>

                                <input class="form-control" id="descripcionpremio"  type="text" name="descripcionpremio[]" value="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @elseif($objContadorPremios->cantidad == 1)
            <!-- Modulo de los PREMIOS sin información-->
            <div class="row content_antDesp-formProf">
                <!-- Contenido PREMIO izquierdo -->
                <div class="col-6 content_antes-formProf">
                    <div class="col-12 pl-0 content_agregarImg-formProf form-group">
                        <div class="col-10 img_selccionada-formProf">
                            <div class="img_anexada-formProf" id="previewates"></div>
                        </div>

                        <div class="agregar_archivo-formProf">
                            <input type='file' id="imgantes" name="imgpremio[]"/>
                        </div>
                    </div>

                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="example-date-input" class="col-form-label">Fecha de inicio</label>
                        
                            <input class="form-control" type="date"  id="fechapremio" name="fechapremio[]" value="">
                        </div>
                    </div>

                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">titulo premio</label>

                            <input class="form-control" id="nombrepremio"  type="text" name="nombrepremio[]" value="">
                        </div>
                    </div>

                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Descrpcion premio</label>
                            
                            <input class="form-control" id="descripcionpremio"  type="text" name="descripcionpremio[]" value="">
                        </div>
                    </div>
                </div>

                <!-- Contenido PREMIO derecho -->
                <div class="col-6 pr-0">
                    <div class="col-12 content_agregarImg-formProf form-group">
                        <div class="form-group col-12 ">
                            <div class="col-10 img_selccionada-formProf">
                                <div class="img_anexada-formProf" id="previewates"></div>
                            </div>

                            <div class="agregar_archivo-formProf">
                                <input type='file' id="imgantes" name="imgpremio[]"/>
                            </div>
                        </div>

                        <div class="col-12 pr-0">
                            <label for="example-date-input" class="col-form-label">Fecha de inicio</label>
                            
                            <input class="form-control" type="date"  id="fechapremio" name="fechapremio[]" value="">
                        </div>

                        <div class="col-12 pr-0">
                            <div class="form-group">
                                <label for="title">titulo premio</label>

                                <input class="form-control" id="nombrepremio"  type="text" name="nombrepremio[]" value="">
                            </div>
                        </div>

                        <div class="col-12 pr-0">
                            <div class="form-group">
                                <label for="title">Descrpcion premio</label>

                                <input class="form-control" id="descripcionpremio"  type="text" name="descripcionpremio[]" value="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modulo de los PREMIOS sin información-->
            <div class="row content_antDesp-formProf">
                <!-- Contenido PREMIO izquierdo -->
                <div class="col-6 content_antes-formProf">
                    <div class="col-12 pl-0 content_agregarImg-formProf form-group">
                        <div class="col-10 img_selccionada-formProf">
                            <div class="img_anexada-formProf" id="previewates"></div>
                        </div>

                        <div class="agregar_archivo-formProf">
                            <input type='file' id="imgantes" name="imgpremio[]"/>
                        </div>
                    </div>

                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="example-date-input" class="col-form-label">Fecha de inicio</label>
                        
                            <input class="form-control" type="date"  id="fechapremio" name="fechapremio[]" value="">
                        </div>
                    </div>

                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">titulo premio</label>

                            <input class="form-control" id="nombrepremio"  type="text" name="nombrepremio[]" value="">
                        </div>
                    </div>

                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Descrpcion premio</label>
                            
                            <input class="form-control" id="descripcionpremio"  type="text" name="descripcionpremio[]" value="">
                        </div>
                    </div>
                </div>
            </div>
        @elseif($objContadorPremios->cantidad == 2)
            <!-- Modulo de los PREMIOS sin información-->
            <div class="row content_antDesp-formProf">
                <!-- Contenido PREMIO izquierdo -->
                <div class="col-6 content_antes-formProf">
                    <div class="col-12 pl-0 content_agregarImg-formProf form-group">
                        <div class="col-10 img_selccionada-formProf">
                            <div class="img_anexada-formProf" id="previewates"></div>
                        </div>

                        <div class="agregar_archivo-formProf">
                            <input type='file' id="imgantes" name="imgpremio[]"/>
                        </div>
                    </div>

                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="example-date-input" class="col-form-label">Fecha de inicio</label>
                        
                            <input class="form-control" type="date"  id="fechapremio" name="fechapremio[]" value="">
                        </div>
                    </div>

                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">titulo premio</label>

                            <input class="form-control" id="nombrepremio"  type="text" name="nombrepremio[]" value="">
                        </div>
                    </div>

                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Descrpcion premio</label>
                            
                            <input class="form-control" id="descripcionpremio"  type="text" name="descripcionpremio[]" value="">
                        </div>
                    </div>
                </div>

                <!-- Contenido PREMIO derecho -->
                <div class="col-6 pr-0">
                    <div class="col-12 content_agregarImg-formProf form-group">
                        <div class="form-group col-12 ">
                            <div class="col-10 img_selccionada-formProf">
                                <div class="img_anexada-formProf" id="previewates"></div>
                            </div>

                            <div class="agregar_archivo-formProf">
                                <input type='file' id="imgantes" name="imgpremio[]"/>
                            </div>
                        </div>

                        <div class="col-12 pr-0">
                            <label for="example-date-input" class="col-form-label">Fecha de inicio</label>
                            
                            <input class="form-control" type="date"  id="fechapremio" name="fechapremio[]" value="">
                        </div>

                        <div class="col-12 pr-0">
                            <div class="form-group">
                                <label for="title">titulo premio</label>

                                <input class="form-control" id="nombrepremio"  type="text" name="nombrepremio[]" value="">
                            </div>
                        </div>

                        <div class="col-12 pr-0">
                            <div class="form-group">
                                <label for="title">Descrpcion premio</label>

                                <input class="form-control" id="descripcionpremio"  type="text" name="descripcionpremio[]" value="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @elseif($objContadorPremios->cantidad == 3)
            <!-- Modulo de los PREMIOS sin información-->
            <div class="row content_antDesp-formProf">
                <!-- Contenido PREMIO izquierdo -->
                <div class="col-6 content_antes-formProf">
                    <div class="col-12 pl-0 content_agregarImg-formProf form-group">
                        <div class="col-10 img_selccionada-formProf">
                            <div class="img_anexada-formProf" id="previewates"></div>
                        </div>

                        <div class="agregar_archivo-formProf">
                            <input type='file' id="imgantes" name="imgpremio[]"/>
                        </div>
                    </div>

                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="example-date-input" class="col-form-label">Fecha de inicio</label>
                        
                            <input class="form-control" type="date"  id="fechapremio" name="fechapremio[]" value="">
                        </div>
                    </div>

                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">titulo premio</label>

                            <input class="form-control" id="nombrepremio"  type="text" name="nombrepremio[]" value="">
                        </div>
                    </div>

                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Descrpcion premio</label>
                            
                            <input class="form-control" id="descripcionpremio"  type="text" name="descripcionpremio[]" value="">
                        </div>
                    </div>
                </div>
            </div>
        @elseif($objContadorPremios->cantidad == 4)
            <span> No se puede agregar más </span>
        @endif 

        <div class="col-lg-12 content_btnEnviar-formProf">
            <button type="submit" class="btn2_enviar-formProf"> Guardar
                <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flecha_ingreso-membresia" alt=""> 
            </button>
        </div>
    </form>
</div>
<!--------------------------------------------      Fin 10 decima parte del formulario *** PREMIOS y RECONOCIMIENTOS ***      ------------------------------------------------>

<!--------------------------------------------      Inicio 11 onceava parte del formulario *** PUBLICACIONES ***      ------------------------------------------------>
<div class="col-lg-10 pb-3 infoBasica_formProf">
    <h5 class="col-lg-12 icon_infoBasica-formProf"> Publicaciones </h5>

    <p class="text_superior-proced-formProf"> A continuación suba imágenes de las publicaciones que ha realizado a lo largo de su experiencia. </p>

    <!-- Modulo de las PUBLICAIONES con información -->
    <div class="row col-12 p-0 m-0">
        @foreach($Publicaciones as $Publicaciones)
            @if(!empty($Publicaciones->nombrepublicacion))
                <!-- Contenido PUBLICACIÓN -->    
                <div class="col-6 mt-3 content_antes-formProf">
                    <div class="col-12">
                        <a href="{{url('/FormularioProfesionaldelete11/'.$Publicaciones->id)}}">
                            <button type="submit" class="close" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </a>
                    </div>

                    <div class="col-12 content_agregarImg-formProf form-group">
                        <div class="col-10 img_selccionada-formProf">
                            <img class="col-10 img_publi-formProf" src="{{URL::asset($Publicaciones->imgpublicacion)}}">
                        </div>

                        <div class="col-12 pl-0">
                            <div class="form-group">
                                <span>{{$Publicaciones->nombrepublicacion}}</span>
                            </div>
                        </div>

                        <div class="col-12 pl-0">
                            <div class="form-group">
                                <span>{{$Publicaciones->descripcion}}</span>
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
            <!-- Modulos de los contenidos ANTES y DESPUÉS -->
            <div class="row content_antDesp-formProf">
                <!-- Contenido ANTES -->
                <div class="col-6 content_antes-formProf">
                    <div class="col-12 pl-0 content_agregarImg-formProf form-group">
                        <div class="col-10 img_selccionada-formProf">
                            <div class="img_anexada-formProf" id="previewates"></div>
                        </div>

                        <div class="agregar_archivo-formProf">
                            <input type='file' id="imgantes" name="imgpublicacion[]"/>
                        </div>
                    </div>

                    <div class="col-12 pl-0">
                        <div class="form-group">
                            <label for="title">titulo publicacion</label>

                            <input class="form-control" id="nombrepremio"  type="text" name="nombrepublicacion[]" value="">
                        </div>
                    </div>

                    <div class="col-12 pl-0">
                        <div class="form-group">
                            <label for="title">Descripcion publicacion</label>
                            
                            <input class="form-control" id="nombrepremio"  type="text" name="descripcion[]" value="">
                        </div>
                    </div>
                </div>

                <!-- Contenido DESPUÉS -->
                <div class="col-6 pr-0">
                    <div class="col-12 content_agregarImg-formProf form-group">
                        <div class="col-10 img_selccionada-formProf">
                            <div class="img_anexada-formProf" id="previewates"></div>
                        </div>

                        <div class="agregar_archivo-formProf">
                            <input type='file' id="imgantes" name="imgpublicacion[]"/>
                        </div>
                    </div>

                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">titulo publicacion</label>
                            
                            <input class="form-control" id="nombrepremio"  type="text" name="nombrepublicacion[]" value="">
                        </div>
                    </div>

                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Descripcion publicacion</label>
                            
                            <input class="form-control" id="nombrepremio"  type="text" name="descripcion[]" value="">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modulos de los contenidos ANTES y DESPUÉS -->
            <div class="row content_antDesp-formProf">
                <!-- Contenido ANTES -->
                <div class="col-6 content_antes-formProf">
                    <div class="col-12 pl-0 content_agregarImg-formProf form-group">
                        <div class="col-10 img_selccionada-formProf">
                            <div class="img_anexada-formProf" id="previewates"></div>
                        </div>

                        <div class="agregar_archivo-formProf">
                            <input type='file' id="imgantes" name="imgpublicacion[]"/>
                        </div>
                    </div>

                    <div class="col-12 pl-0">
                        <div class="form-group">
                            <label for="title">titulo publicacion</label>

                            <input class="form-control" id="nombrepremio"  type="text" name="nombrepublicacion[]" value="">
                        </div>
                    </div>

                    <div class="col-12 pl-0">
                        <div class="form-group">
                            <label for="title">Descripcion publicacion</label>
                            
                            <input class="form-control" id="nombrepremio"  type="text" name="descripcion[]" value="">
                        </div>
                    </div>
                </div>

                <!-- Contenido DESPUÉS -->
                <div class="col-6 pr-0">
                    <div class="col-12 content_agregarImg-formProf form-group">
                        <div class="col-10 img_selccionada-formProf">
                            <div class="img_anexada-formProf" id="previewates"></div>
                        </div>

                        <div class="agregar_archivo-formProf">
                            <input type='file' id="imgantes" name="imgpublicacion[]"/>
                        </div>
                    </div>

                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">titulo publicacion</label>
                            
                            <input class="form-control" id="nombrepremio"  type="text" name="nombrepublicacion[]" value="">
                        </div>
                    </div>

                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Descripcion publicacion</label>
                            
                            <input class="form-control" id="nombrepremio"  type="text" name="descripcion[]" value="">
                        </div>
                    </div>
                </div>
            </div>
        @elseif($objContadorPublicaciones->cantidad == 1)
            <!-- Modulos de los contenidos ANTES y DESPUÉS -->
            <div class="row content_antDesp-formProf">
                <!-- Contenido ANTES -->
                <div class="col-6 content_antes-formProf">
                    <div class="col-12 pl-0 content_agregarImg-formProf form-group">
                        <div class="col-10 img_selccionada-formProf">
                            <div class="img_anexada-formProf" id="previewates"></div>
                        </div>

                        <div class="agregar_archivo-formProf">
                            <input type='file' id="imgantes" name="imgpublicacion[]"/>
                        </div>
                    </div>

                    <div class="col-12 pl-0">
                        <div class="form-group">
                            <label for="title">titulo publicacion</label>

                            <input class="form-control" id="nombrepremio"  type="text" name="nombrepublicacion[]" value="">
                        </div>
                    </div>

                    <div class="col-12 pl-0">
                        <div class="form-group">
                            <label for="title">Descripcion publicacion</label>
                            
                            <input class="form-control" id="nombrepremio"  type="text" name="descripcion[]" value="">
                        </div>
                    </div>
                </div>

                <!-- Contenido DESPUÉS -->
                <div class="col-6 pr-0">
                    <div class="col-12 content_agregarImg-formProf form-group">
                        <div class="col-10 img_selccionada-formProf">
                            <div class="img_anexada-formProf" id="previewates"></div>
                        </div>

                        <div class="agregar_archivo-formProf">
                            <input type='file' id="imgantes" name="imgpublicacion[]"/>
                        </div>
                    </div>

                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">titulo publicacion</label>
                            
                            <input class="form-control" id="nombrepremio"  type="text" name="nombrepublicacion[]" value="">
                        </div>
                    </div>

                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Descripcion publicacion</label>
                            
                            <input class="form-control" id="nombrepremio"  type="text" name="descripcion[]" value="">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modulos de los contenidos ANTES y DESPUÉS -->
            <div class="row content_antDesp-formProf">
                <!-- Contenido ANTES -->
                <div class="col-6 content_antes-formProf">
                    <div class="col-12 pl-0 content_agregarImg-formProf form-group">
                        <div class="col-10 img_selccionada-formProf">
                            <div class="img_anexada-formProf" id="previewates"></div>
                        </div>

                        <div class="agregar_archivo-formProf">
                            <input type='file' id="imgantes" name="imgpublicacion[]"/>
                        </div>
                    </div>

                    <div class="col-12 pl-0">
                        <div class="form-group">
                            <label for="title">titulo publicacion</label>

                            <input class="form-control" id="nombrepremio"  type="text" name="nombrepublicacion[]" value="">
                        </div>
                    </div>

                    <div class="col-12 pl-0">
                        <div class="form-group">
                            <label for="title">Descripcion publicacion</label>
                            
                            <input class="form-control" id="nombrepremio"  type="text" name="descripcion[]" value="">
                        </div>
                    </div>
                </div>
            </div>
        @elseif($objContadorPublicaciones->cantidad == 2)
            <!-- Modulos de los contenidos ANTES y DESPUÉS -->
            <div class="row content_antDesp-formProf">
                <!-- Contenido ANTES -->
                <div class="col-6 content_antes-formProf">
                    <div class="col-12 pl-0 content_agregarImg-formProf form-group">
                        <div class="col-10 img_selccionada-formProf">
                            <div class="img_anexada-formProf" id="previewates"></div>
                        </div>

                        <div class="agregar_archivo-formProf">
                            <input type='file' id="imgantes" name="imgpublicacion[]"/>
                        </div>
                    </div>

                    <div class="col-12 pl-0">
                        <div class="form-group">
                            <label for="title">titulo publicacion</label>

                            <input class="form-control" id="nombrepremio"  type="text" name="nombrepublicacion[]" value="">
                        </div>
                    </div>

                    <div class="col-12 pl-0">
                        <div class="form-group">
                            <label for="title">Descripcion publicacion</label>
                            
                            <input class="form-control" id="nombrepremio"  type="text" name="descripcion[]" value="">
                        </div>
                    </div>
                </div>

                <!-- Contenido DESPUÉS -->
                <div class="col-6 pr-0">
                    <div class="col-12 content_agregarImg-formProf form-group">
                        <div class="col-10 img_selccionada-formProf">
                            <div class="img_anexada-formProf" id="previewates"></div>
                        </div>

                        <div class="agregar_archivo-formProf">
                            <input type='file' id="imgantes" name="imgpublicacion[]"/>
                        </div>
                    </div>

                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">titulo publicacion</label>
                            
                            <input class="form-control" id="nombrepremio"  type="text" name="nombrepublicacion[]" value="">
                        </div>
                    </div>

                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Descripcion publicacion</label>
                            
                            <input class="form-control" id="nombrepremio"  type="text" name="descripcion[]" value="">
                        </div>
                    </div>
                </div>
            </div>
        @elseif($objContadorPublicaciones->cantidad == 3)
            <!-- Modulos de los contenidos ANTES y DESPUÉS -->
            <div class="row content_antDesp-formProf">
                <!-- Contenido ANTES -->
                <div class="col-6 content_antes-formProf">
                    <div class="col-12 pl-0 content_agregarImg-formProf form-group">
                        <div class="col-10 img_selccionada-formProf">
                            <div class="img_anexada-formProf" id="previewates"></div>
                        </div>

                        <div class="agregar_archivo-formProf">
                            <input type='file' id="imgantes" name="imgpublicacion[]"/>
                        </div>
                    </div>

                    <div class="col-12 pl-0">
                        <div class="form-group">
                            <label for="title">titulo publicacion</label>

                            <input class="form-control" id="nombrepremio"  type="text" name="nombrepublicacion[]" value="">
                        </div>
                    </div>

                    <div class="col-12 pl-0">
                        <div class="form-group">
                            <label for="title">Descripcion publicacion</label>
                            
                            <input class="form-control" id="nombrepremio"  type="text" name="descripcion[]" value="">
                        </div>
                    </div>
                </div>
            </div>
        @elseif($objContadorPublicaciones->cantidad == 4)
            <span>No se puede agrrgar mas</span>
        @endif 
                
        <div class="col-lg-12 content_btnEnviar-formProf">
            <button type="submit" class="btn2_enviar-formProf"> Guardar
                <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flecha_ingreso-membresia" alt=""> 
            </button>
        </div>
    </form>
</div>         
<!--------------------------------------------      Fin 11 onceava parte del formulario *** PUBLICACIONES ***      ------------------------------------------------>

<!--------------------------------------------      Inicio 12 doceava parte del formulario *** GALERIA ***      ------------------------------------------------>
<div class="col-lg-10 pb-3 infoBasica_formProf">
    <h5 class="col-lg-12 icon_infoBasica-formProf"> Galeria </h5>

    <p class="text_superior-proced-formProf"> A continuación suba 10 imágenes como mínimo, con su respectivo nombre y descripción. </p>

    <!-- Modulo de la GALERIA con información -->
    <div class="row col-12 p-0 m-0">
        @foreach($objGaleria as $objGaleria)
            @if(!empty($objGaleria->nombrefoto))
                <!-- Contenido GALERIA -->    
                <div class="col-6 mt-3 content_antes-formProf">
                    <div class="col-12">
                        <a href="{{url('/FormularioProfesionaldelete12/'.$objGaleria->id_galeria)}}">
                            <button type="submit" class="close" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </a>
                    </div>

                    <div class="col-12 content_agregarImg-formProf form-group">
                        <div class="col-10 img_selccionada-formProf">
                            <img  class="col-10 img_publi-formProf" src="{{URL::asset($objGaleria->imggaleria)}}">
                        </div>

                        <div class="col-12 pl-0">
                            <div class="form-group">
                                <span>{{$objGaleria->nombrefoto}}</span>
                            </div>
                        </div>

                        <div class="col-12 pl-0">
                            <div class="form-group">
                                <span>{{$objGaleria->descripcion}}</span>
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
            <!-- Modulos de los contenidos ANTES y DESPUÉS -->
            <div class="row content_antDesp-formProf">
                <!-- Contenido ANTES -->
                <div class="col-6 content_antes-formProf">
                    <div class="col-12 pl-0 content_agregarImg-formProf form-group">
                        <div class="col-10 img_selccionada-formProf">
                            <div class="img_anexada-formProf" id="previewates"></div>
                        </div>

                        <div class="agregar_archivo-formProf">
                            <input type='file' id="imgantes" name="imggaleria[]"/>
                        </div>
                    </div>

                    <div class="col-12 pl-0">
                        <label for="example-date-input" class="col-2 col-form-label">Fecha </label>
                        
                        <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                    </div>

                    <div class="col-12 pl-0">
                        <div class="form-group">
                            <label for="title">nombre foto</label>

                            <input class="form-control" id="nombrefoto"  type="text" name="nombrefoto[]" value="">
                        </div>
                    </div>

                    <div class="col-12 pl-0">
                        <div class="form-group">
                            <label for="title">Descripcion foto</label>
                            
                            <input class="form-control" id="descripcion"  type="text" name="descripcion[]" value="">
                        </div>
                    </div>
                </div>

                <!-- Contenido DESPUÉS -->
                <div class="col-6 pr-0">
                    <div class="col-12 content_agregarImg-formProf form-group">
                        <div class="col-10 img_selccionada-formProf">
                            <div class="img_anexada-formProf" id="previewates"></div>
                        </div>

                        <div class="agregar_archivo-formProf">
                            <input type='file' id="imgantes" name="imggaleria[]"/>
                        </div>
                    </div>

                    <div class="col-12 pr-0">
                        <label for="example-date-input" class="col-2 col-form-label">Fecha </label>
                        
                        <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                    </div>

                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">titulo foto</label>

                            <input class="form-control" id="nombrepremio"  type="text" name="nombrefoto[]" value="">
                        </div>
                    </div>
                    
                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Descripcion foto</label>

                            <input class="form-control" id="nombrepremio"  type="text" name="descripcion[]" value="">
                        </div>
                    </div>
                </div>

                <!-- Contenido ANTES -->
                <div class="col-6 content_antes-formProf">
                    <div class="col-12 pl-0 content_agregarImg-formProf form-group">
                        <div class="col-10 img_selccionada-formProf">
                            <div class="img_anexada-formProf" id="previewates"></div>
                        </div>

                        <div class="agregar_archivo-formProf">
                            <input type='file' id="imgantes" name="imggaleria[]"/>
                        </div>
                    </div>

                    <div class="col-12 pl-0">
                        <label for="example-date-input" class="col-2 col-form-label">Fecha </label>

                        <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                    </div>

                    <div class="col-12 pl-0">
                        <div class="form-group">
                            <label for="title">nombre foto</label>

                            <input class="form-control" id="nombrefoto"  type="text" name="nombrefoto[]" value="">
                        </div>
                    </div>

                    <div class="col-12 pl-0">
                        <div class="form-group">
                            <label for="title">Descripcion foto</label>
                            
                            <input class="form-control" id="descripcion"  type="text" name="descripcion[]" value="">
                        </div>
                    </div>
                </div>

                <!-- Contenido DESPUÉS -->
                <div class="col-6 pr-0">
                    <div class="col-12 content_agregarImg-formProf form-group">
                        <div class="col-10 img_selccionada-formProf">
                            <div class="img_anexada-formProf" id="previewates"></div>
                        </div>

                        <div class="agregar_archivo-formProf">
                            <input type='file' id="imgantes" name="imggaleria[]"/>
                        </div>
                    </div>

                    <div class="col-12 pr-0">
                        <label for="example-date-input" class="col-2 col-form-label">Fecha </label>
                        
                        <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                    </div>

                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">titulo foto</label>

                            <input class="form-control" id="nombrepremio"  type="text" name="nombrefoto[]" value="">
                        </div>
                    </div>
                    
                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Descripcion foto</label>

                            <input class="form-control" id="nombrepremio"  type="text" name="descripcion[]" value="">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modulos de los contenidos ANTES y DESPUÉS -->
            <div class="row content_antDesp-formProf">
                <!-- Contenido ANTES -->
                <div class="col-6 content_antes-formProf">
                    <div class="col-12 pl-0 content_agregarImg-formProf form-group">
                        <div class="col-10 img_selccionada-formProf">
                            <div class="img_anexada-formProf" id="previewates"></div>
                        </div>

                        <div class="agregar_archivo-formProf">
                            <input type='file' id="imgantes" name="imggaleria[]"/>
                        </div>
                    </div>

                    <div class="col-12 pl-0">
                        <label for="example-date-input" class="col-2 col-form-label">Fecha </label>
                        
                        <div class="col-10">
                            <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                        </div>
                    </div>

                    <div class="col-12 pl-0">
                        <div class="form-group">
                            <label for="title">nombre foto</label>

                            <input class="form-control" id="nombrefoto"  type="text" name="nombrefoto[]" value="">
                        </div>
                    </div>

                    <div class="col-12 pl-0">
                        <div class="form-group">
                            <label for="title">Descripcion foto</label>
                            
                            <input class="form-control" id="descripcion"  type="text" name="descripcion[]" value="">
                        </div>
                    </div>
                </div>

                <!-- Contenido DESPUÉS -->
                <div class="col-6 pr-0">
                    <div class="col-12 content_agregarImg-formProf form-group">
                        <div class="col-10 img_selccionada-formProf">
                            <div class="img_anexada-formProf" id="previewates"></div>
                        </div>

                        <div class="agregar_archivo-formProf">
                            <input type='file' id="imgantes" name="imggaleria[]"/>
                        </div>
                    </div>

                    <div class="col-12 pr-0">
                        <label for="example-date-input" class="col-2 col-form-label">Fecha </label>
                        
                        <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                    </div>

                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">titulo foto</label>

                            <input class="form-control" id="nombrepremio"  type="text" name="nombrefoto[]" value="">
                        </div>
                    </div>
                    
                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Descripcion foto</label>

                            <input class="form-control" id="nombrepremio"  type="text" name="descripcion[]" value="">
                        </div>
                    </div>
                </div>

                <!-- Contenido ANTES -->
                <div class="col-6 content_antes-formProf">
                    <div class="col-12 pl-0 content_agregarImg-formProf form-group">
                        <div class="col-10 img_selccionada-formProf">
                            <div class="img_anexada-formProf" id="previewates"></div>
                        </div>

                        <div class="agregar_archivo-formProf">
                            <input type='file' id="imgantes" name="imggaleria[]"/>
                        </div>
                    </div>

                    <div class="col-12 pl-0">
                        <label for="example-date-input" class="col-2 col-form-label">Fecha </label>
                        
                        <div class="col-10">
                            <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                        </div>
                    </div>

                    <div class="col-12 pl-0">
                        <div class="form-group">
                            <label for="title">nombre foto</label>

                            <input class="form-control" id="nombrefoto"  type="text" name="nombrefoto[]" value="">
                        </div>
                    </div>

                    <div class="col-12 pl-0">
                        <div class="form-group">
                            <label for="title">Descripcion foto</label>
                            
                            <input class="form-control" id="descripcion"  type="text" name="descripcion[]" value="">
                        </div>
                    </div>
                </div>

                <!-- Contenido DESPUÉS -->
                <div class="col-6 pr-0">
                    <div class="col-12 content_agregarImg-formProf form-group">
                        <div class="col-10 img_selccionada-formProf">
                            <div class="img_anexada-formProf" id="previewates"></div>
                        </div>

                        <div class="agregar_archivo-formProf">
                            <input type='file' id="imgantes" name="imggaleria[]"/>
                        </div>
                    </div>

                    <div class="col-12 pr-0">
                        <label for="example-date-input" class="col-2 col-form-label">Fecha </label>
                        
                        <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                    </div>

                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">titulo foto</label>

                            <input class="form-control" id="nombrepremio"  type="text" name="nombrefoto[]" value="">
                        </div>
                    </div>
                    
                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Descripcion foto</label>

                            <input class="form-control" id="nombrepremio"  type="text" name="descripcion[]" value="">
                        </div>
                    </div>
                </div>
            </div>
        @elseif($objContadorGaleria->cantidad == 1)
            <!-- Modulos de los contenidos ANTES y DESPUÉS -->
            <div class="row content_antDesp-formProf">
                <!-- Contenido ANTES -->
                <div class="col-6 content_antes-formProf">
                    <div class="col-12 pl-0 content_agregarImg-formProf form-group">
                        <div class="col-10 img_selccionada-formProf">
                            <div class="img_anexada-formProf" id="previewates"></div>
                        </div>

                        <div class="agregar_archivo-formProf">
                            <input type='file' id="imgantes" name="imggaleria[]"/>
                        </div>
                    </div>

                    <div class="col-12 pl-0">
                        <label for="example-date-input" class="col-2 col-form-label">Fecha </label>
                        
                        <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                    </div>

                    <div class="col-12 pl-0">
                        <div class="form-group">
                            <label for="title">nombre foto</label>

                            <input class="form-control" id="nombrefoto"  type="text" name="nombrefoto[]" value="">
                        </div>
                    </div>

                    <div class="col-12 pl-0">
                        <div class="form-group">
                            <label for="title">Descripcion foto</label>
                            
                            <input class="form-control" id="descripcion"  type="text" name="descripcion[]" value="">
                        </div>
                    </div>
                </div>

                <!-- Contenido DESPUÉS -->
                <div class="col-6 pr-0">
                    <div class="col-12 content_agregarImg-formProf form-group">
                        <div class="col-10 img_selccionada-formProf">
                            <div class="img_anexada-formProf" id="previewates"></div>
                        </div>

                        <div class="agregar_archivo-formProf">
                            <input type='file' id="imgantes" name="imggaleria[]"/>
                        </div>
                    </div>

                    <div class="col-12 pr-0">
                        <label for="example-date-input" class="col-2 col-form-label">Fecha </label>
                        
                        <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                    </div>

                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">titulo foto</label>

                            <input class="form-control" id="nombrepremio"  type="text" name="nombrefoto[]" value="">
                        </div>
                    </div>
                    
                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Descripcion foto</label>

                            <input class="form-control" id="nombrepremio"  type="text" name="descripcion[]" value="">
                        </div>
                    </div>
                </div>

                <!-- Contenido ANTES -->
                <div class="col-6 content_antes-formProf">
                    <div class="col-12 pl-0 content_agregarImg-formProf form-group">
                        <div class="col-10 img_selccionada-formProf">
                            <div class="img_anexada-formProf" id="previewates"></div>
                        </div>

                        <div class="agregar_archivo-formProf">
                            <input type='file' id="imgantes" name="imggaleria[]"/>
                        </div>
                    </div>

                    <div class="col-12 pl-0">
                        <label for="example-date-input" class="col-2 col-form-label">Fecha </label>

                        <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                    </div>

                    <div class="col-12 pl-0">
                        <div class="form-group">
                            <label for="title">nombre foto</label>

                            <input class="form-control" id="nombrefoto"  type="text" name="nombrefoto[]" value="">
                        </div>
                    </div>

                    <div class="col-12 pl-0">
                        <div class="form-group">
                            <label for="title">Descripcion foto</label>
                            
                            <input class="form-control" id="descripcion"  type="text" name="descripcion[]" value="">
                        </div>
                    </div>
                </div>

                <!-- Contenido DESPUÉS -->
                <div class="col-6 pr-0">
                    <div class="col-12 content_agregarImg-formProf form-group">
                        <div class="col-10 img_selccionada-formProf">
                            <div class="img_anexada-formProf" id="previewates"></div>
                        </div>

                        <div class="agregar_archivo-formProf">
                            <input type='file' id="imgantes" name="imggaleria[]"/>
                        </div>
                    </div>

                    <div class="col-12 pr-0">
                        <label for="example-date-input" class="col-2 col-form-label">Fecha </label>
                        
                        <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                    </div>

                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">titulo foto</label>

                            <input class="form-control" id="nombrepremio"  type="text" name="nombrefoto[]" value="">
                        </div>
                    </div>
                    
                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Descripcion foto</label>

                            <input class="form-control" id="nombrepremio"  type="text" name="descripcion[]" value="">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modulos de los contenidos ANTES y DESPUÉS -->
            <div class="row content_antDesp-formProf">
                <!-- Contenido ANTES -->
                <div class="col-6 content_antes-formProf">
                    <div class="col-12 pl-0 content_agregarImg-formProf form-group">
                        <div class="col-10 img_selccionada-formProf">
                            <div class="img_anexada-formProf" id="previewates"></div>
                        </div>

                        <div class="agregar_archivo-formProf">
                            <input type='file' id="imgantes" name="imggaleria[]"/>
                        </div>
                    </div>

                    <div class="col-12 pl-0">
                        <label for="example-date-input" class="col-2 col-form-label">Fecha </label>
                        
                        <div class="col-10">
                            <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                        </div>
                    </div>

                    <div class="col-12 pl-0">
                        <div class="form-group">
                            <label for="title">nombre foto</label>

                            <input class="form-control" id="nombrefoto"  type="text" name="nombrefoto[]" value="">
                        </div>
                    </div>

                    <div class="col-12 pl-0">
                        <div class="form-group">
                            <label for="title">Descripcion foto</label>
                            
                            <input class="form-control" id="descripcion"  type="text" name="descripcion[]" value="">
                        </div>
                    </div>
                </div>

                <!-- Contenido DESPUÉS -->
                <div class="col-6 pr-0">
                    <div class="col-12 content_agregarImg-formProf form-group">
                        <div class="col-10 img_selccionada-formProf">
                            <div class="img_anexada-formProf" id="previewates"></div>
                        </div>

                        <div class="agregar_archivo-formProf">
                            <input type='file' id="imgantes" name="imggaleria[]"/>
                        </div>
                    </div>

                    <div class="col-12 pr-0">
                        <label for="example-date-input" class="col-2 col-form-label">Fecha </label>
                        
                        <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                    </div>

                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">titulo foto</label>

                            <input class="form-control" id="nombrepremio"  type="text" name="nombrefoto[]" value="">
                        </div>
                    </div>
                    
                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Descripcion foto</label>

                            <input class="form-control" id="nombrepremio"  type="text" name="descripcion[]" value="">
                        </div>
                    </div>
                </div>

                <!-- Contenido ANTES -->
                <div class="col-6 content_antes-formProf">
                    <div class="col-12 pl-0 content_agregarImg-formProf form-group">
                        <div class="col-10 img_selccionada-formProf">
                            <div class="img_anexada-formProf" id="previewates"></div>
                        </div>

                        <div class="agregar_archivo-formProf">
                            <input type='file' id="imgantes" name="imggaleria[]"/>
                        </div>
                    </div>

                    <div class="col-12 pl-0">
                        <label for="example-date-input" class="col-2 col-form-label">Fecha </label>
                        
                        <div class="col-10">
                            <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                        </div>
                    </div>

                    <div class="col-12 pl-0">
                        <div class="form-group">
                            <label for="title">nombre foto</label>

                            <input class="form-control" id="nombrefoto"  type="text" name="nombrefoto[]" value="">
                        </div>
                    </div>

                    <div class="col-12 pl-0">
                        <div class="form-group">
                            <label for="title">Descripcion foto</label>
                            
                            <input class="form-control" id="descripcion"  type="text" name="descripcion[]" value="">
                        </div>
                    </div>
                </div>
            </div>
        @elseif($objContadorGaleria->cantidad == 2)
            <!-- Modulos de los contenidos ANTES y DESPUÉS -->
            <div class="row content_antDesp-formProf">
                <!-- Contenido ANTES -->
                <div class="col-6 content_antes-formProf">
                    <div class="col-12 pl-0 content_agregarImg-formProf form-group">
                        <div class="col-10 img_selccionada-formProf">
                            <div class="img_anexada-formProf" id="previewates"></div>
                        </div>

                        <div class="agregar_archivo-formProf">
                            <input type='file' id="imgantes" name="imggaleria[]"/>
                        </div>
                    </div>

                    <div class="col-12 pl-0">
                        <label for="example-date-input" class="col-2 col-form-label">Fecha </label>
                        
                        <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                    </div>

                    <div class="col-12 pl-0">
                        <div class="form-group">
                            <label for="title">nombre foto</label>

                            <input class="form-control" id="nombrefoto"  type="text" name="nombrefoto[]" value="">
                        </div>
                    </div>

                    <div class="col-12 pl-0">
                        <div class="form-group">
                            <label for="title">Descripcion foto</label>
                            
                            <input class="form-control" id="descripcion"  type="text" name="descripcion[]" value="">
                        </div>
                    </div>
                </div>

                <!-- Contenido DESPUÉS -->
                <div class="col-6 pr-0">
                    <div class="col-12 content_agregarImg-formProf form-group">
                        <div class="col-10 img_selccionada-formProf">
                            <div class="img_anexada-formProf" id="previewates"></div>
                        </div>

                        <div class="agregar_archivo-formProf">
                            <input type='file' id="imgantes" name="imggaleria[]"/>
                        </div>
                    </div>

                    <div class="col-12 pr-0">
                        <label for="example-date-input" class="col-2 col-form-label">Fecha </label>
                        
                        <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                    </div>

                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">titulo foto</label>

                            <input class="form-control" id="nombrepremio"  type="text" name="nombrefoto[]" value="">
                        </div>
                    </div>
                    
                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Descripcion foto</label>

                            <input class="form-control" id="nombrepremio"  type="text" name="descripcion[]" value="">
                        </div>
                    </div>
                </div>

                <!-- Contenido ANTES -->
                <div class="col-6 content_antes-formProf">
                    <div class="col-12 pl-0 content_agregarImg-formProf form-group">
                        <div class="col-10 img_selccionada-formProf">
                            <div class="img_anexada-formProf" id="previewates"></div>
                        </div>

                        <div class="agregar_archivo-formProf">
                            <input type='file' id="imgantes" name="imggaleria[]"/>
                        </div>
                    </div>

                    <div class="col-12 pl-0">
                        <label for="example-date-input" class="col-2 col-form-label">Fecha </label>

                        <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                    </div>

                    <div class="col-12 pl-0">
                        <div class="form-group">
                            <label for="title">nombre foto</label>

                            <input class="form-control" id="nombrefoto"  type="text" name="nombrefoto[]" value="">
                        </div>
                    </div>

                    <div class="col-12 pl-0">
                        <div class="form-group">
                            <label for="title">Descripcion foto</label>
                            
                            <input class="form-control" id="descripcion"  type="text" name="descripcion[]" value="">
                        </div>
                    </div>
                </div>

                <!-- Contenido DESPUÉS -->
                <div class="col-6 pr-0">
                    <div class="col-12 content_agregarImg-formProf form-group">
                        <div class="col-10 img_selccionada-formProf">
                            <div class="img_anexada-formProf" id="previewates"></div>
                        </div>

                        <div class="agregar_archivo-formProf">
                            <input type='file' id="imgantes" name="imggaleria[]"/>
                        </div>
                    </div>

                    <div class="col-12 pr-0">
                        <label for="example-date-input" class="col-2 col-form-label">Fecha </label>
                        
                        <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                    </div>

                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">titulo foto</label>

                            <input class="form-control" id="nombrepremio"  type="text" name="nombrefoto[]" value="">
                        </div>
                    </div>
                    
                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Descripcion foto</label>

                            <input class="form-control" id="nombrepremio"  type="text" name="descripcion[]" value="">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modulos de los contenidos ANTES y DESPUÉS -->
            <div class="row content_antDesp-formProf">
                <!-- Contenido ANTES -->
                <div class="col-6 content_antes-formProf">
                    <div class="col-12 pl-0 content_agregarImg-formProf form-group">
                        <div class="col-10 img_selccionada-formProf">
                            <div class="img_anexada-formProf" id="previewates"></div>
                        </div>

                        <div class="agregar_archivo-formProf">
                            <input type='file' id="imgantes" name="imggaleria[]"/>
                        </div>
                    </div>

                    <div class="col-12 pl-0">
                        <label for="example-date-input" class="col-2 col-form-label">Fecha </label>
                        
                        <div class="col-10">
                            <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                        </div>
                    </div>

                    <div class="col-12 pl-0">
                        <div class="form-group">
                            <label for="title">nombre foto</label>

                            <input class="form-control" id="nombrefoto"  type="text" name="nombrefoto[]" value="">
                        </div>
                    </div>

                    <div class="col-12 pl-0">
                        <div class="form-group">
                            <label for="title">Descripcion foto</label>
                            
                            <input class="form-control" id="descripcion"  type="text" name="descripcion[]" value="">
                        </div>
                    </div>
                </div>

                <!-- Contenido DESPUÉS -->
                <div class="col-6 pr-0">
                    <div class="col-12 content_agregarImg-formProf form-group">
                        <div class="col-10 img_selccionada-formProf">
                            <div class="img_anexada-formProf" id="previewates"></div>
                        </div>

                        <div class="agregar_archivo-formProf">
                            <input type='file' id="imgantes" name="imggaleria[]"/>
                        </div>
                    </div>

                    <div class="col-12 pr-0">
                        <label for="example-date-input" class="col-2 col-form-label">Fecha </label>
                        
                        <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                    </div>

                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">titulo foto</label>

                            <input class="form-control" id="nombrepremio"  type="text" name="nombrefoto[]" value="">
                        </div>
                    </div>
                    
                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Descripcion foto</label>

                            <input class="form-control" id="nombrepremio"  type="text" name="descripcion[]" value="">
                        </div>
                    </div>
                </div>
            </div>
        @elseif($objContadorGaleria->cantidad == 3)
            <!-- Modulos de los contenidos ANTES y DESPUÉS -->
            <div class="row content_antDesp-formProf">
                <!-- Contenido ANTES -->
                <div class="col-6 content_antes-formProf">
                    <div class="col-12 pl-0 content_agregarImg-formProf form-group">
                        <div class="col-10 img_selccionada-formProf">
                            <div class="img_anexada-formProf" id="previewates"></div>
                        </div>

                        <div class="agregar_archivo-formProf">
                            <input type='file' id="imgantes" name="imggaleria[]"/>
                        </div>
                    </div>

                    <div class="col-12 pl-0">
                        <label for="example-date-input" class="col-2 col-form-label">Fecha </label>
                        
                        <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                    </div>

                    <div class="col-12 pl-0">
                        <div class="form-group">
                            <label for="title">nombre foto</label>

                            <input class="form-control" id="nombrefoto"  type="text" name="nombrefoto[]" value="">
                        </div>
                    </div>

                    <div class="col-12 pl-0">
                        <div class="form-group">
                            <label for="title">Descripcion foto</label>
                            
                            <input class="form-control" id="descripcion"  type="text" name="descripcion[]" value="">
                        </div>
                    </div>
                </div>

                <!-- Contenido DESPUÉS -->
                <div class="col-6 pr-0">
                    <div class="col-12 content_agregarImg-formProf form-group">
                        <div class="col-10 img_selccionada-formProf">
                            <div class="img_anexada-formProf" id="previewates"></div>
                        </div>

                        <div class="agregar_archivo-formProf">
                            <input type='file' id="imgantes" name="imggaleria[]"/>
                        </div>
                    </div>

                    <div class="col-12 pr-0">
                        <label for="example-date-input" class="col-2 col-form-label">Fecha </label>
                        
                        <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                    </div>

                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">titulo foto</label>

                            <input class="form-control" id="nombrepremio"  type="text" name="nombrefoto[]" value="">
                        </div>
                    </div>
                    
                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Descripcion foto</label>

                            <input class="form-control" id="nombrepremio"  type="text" name="descripcion[]" value="">
                        </div>
                    </div>
                </div>

                <!-- Contenido ANTES -->
                <div class="col-6 content_antes-formProf">
                    <div class="col-12 pl-0 content_agregarImg-formProf form-group">
                        <div class="col-10 img_selccionada-formProf">
                            <div class="img_anexada-formProf" id="previewates"></div>
                        </div>

                        <div class="agregar_archivo-formProf">
                            <input type='file' id="imgantes" name="imggaleria[]"/>
                        </div>
                    </div>

                    <div class="col-12 pl-0">
                        <label for="example-date-input" class="col-2 col-form-label">Fecha </label>

                        <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                    </div>

                    <div class="col-12 pl-0">
                        <div class="form-group">
                            <label for="title">nombre foto</label>

                            <input class="form-control" id="nombrefoto"  type="text" name="nombrefoto[]" value="">
                        </div>
                    </div>

                    <div class="col-12 pl-0">
                        <div class="form-group">
                            <label for="title">Descripcion foto</label>
                            
                            <input class="form-control" id="descripcion"  type="text" name="descripcion[]" value="">
                        </div>
                    </div>
                </div>

                <!-- Contenido DESPUÉS -->
                <div class="col-6 pr-0">
                    <div class="col-12 content_agregarImg-formProf form-group">
                        <div class="col-10 img_selccionada-formProf">
                            <div class="img_anexada-formProf" id="previewates"></div>
                        </div>

                        <div class="agregar_archivo-formProf">
                            <input type='file' id="imgantes" name="imggaleria[]"/>
                        </div>
                    </div>

                    <div class="col-12 pr-0">
                        <label for="example-date-input" class="col-2 col-form-label">Fecha </label>
                        
                        <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                    </div>

                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">titulo foto</label>

                            <input class="form-control" id="nombrepremio"  type="text" name="nombrefoto[]" value="">
                        </div>
                    </div>
                    
                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Descripcion foto</label>

                            <input class="form-control" id="nombrepremio"  type="text" name="descripcion[]" value="">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modulos de los contenidos ANTES y DESPUÉS -->
            <div class="row content_antDesp-formProf">
                <!-- Contenido ANTES -->
                <div class="col-6 content_antes-formProf">
                    <div class="col-12 pl-0 content_agregarImg-formProf form-group">
                        <div class="col-10 img_selccionada-formProf">
                            <div class="img_anexada-formProf" id="previewates"></div>
                        </div>

                        <div class="agregar_archivo-formProf">
                            <input type='file' id="imgantes" name="imggaleria[]"/>
                        </div>
                    </div>

                    <div class="col-12 pl-0">
                        <label for="example-date-input" class="col-2 col-form-label">Fecha </label>
                        
                        <div class="col-10">
                            <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                        </div>
                    </div>

                    <div class="col-12 pl-0">
                        <div class="form-group">
                            <label for="title">nombre foto</label>

                            <input class="form-control" id="nombrefoto"  type="text" name="nombrefoto[]" value="">
                        </div>
                    </div>

                    <div class="col-12 pl-0">
                        <div class="form-group">
                            <label for="title">Descripcion foto</label>
                            
                            <input class="form-control" id="descripcion"  type="text" name="descripcion[]" value="">
                        </div>
                    </div>
                </div>
            </div>
        @elseif($objContadorGaleria->cantidad == 4)
            <!-- Modulos de los contenidos ANTES y DESPUÉS -->
            <div class="row content_antDesp-formProf">
                <!-- Contenido ANTES -->
                <div class="col-6 content_antes-formProf">
                    <div class="col-12 pl-0 content_agregarImg-formProf form-group">
                        <div class="col-10 img_selccionada-formProf">
                            <div class="img_anexada-formProf" id="previewates"></div>
                        </div>

                        <div class="agregar_archivo-formProf">
                            <input type='file' id="imgantes" name="imggaleria[]"/>
                        </div>
                    </div>

                    <div class="col-12 pl-0">
                        <label for="example-date-input" class="col-2 col-form-label">Fecha </label>
                        
                        <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                    </div>

                    <div class="col-12 pl-0">
                        <div class="form-group">
                            <label for="title">nombre foto</label>

                            <input class="form-control" id="nombrefoto"  type="text" name="nombrefoto[]" value="">
                        </div>
                    </div>

                    <div class="col-12 pl-0">
                        <div class="form-group">
                            <label for="title">Descripcion foto</label>
                            
                            <input class="form-control" id="descripcion"  type="text" name="descripcion[]" value="">
                        </div>
                    </div>
                </div>

                <!-- Contenido DESPUÉS -->
                <div class="col-6 pr-0">
                    <div class="col-12 content_agregarImg-formProf form-group">
                        <div class="col-10 img_selccionada-formProf">
                            <div class="img_anexada-formProf" id="previewates"></div>
                        </div>

                        <div class="agregar_archivo-formProf">
                            <input type='file' id="imgantes" name="imggaleria[]"/>
                        </div>
                    </div>

                    <div class="col-12 pr-0">
                        <label for="example-date-input" class="col-2 col-form-label">Fecha </label>
                        
                        <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                    </div>

                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">titulo foto</label>

                            <input class="form-control" id="nombrepremio"  type="text" name="nombrefoto[]" value="">
                        </div>
                    </div>
                    
                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Descripcion foto</label>

                            <input class="form-control" id="nombrepremio"  type="text" name="descripcion[]" value="">
                        </div>
                    </div>
                </div>

                <!-- Contenido ANTES -->
                <div class="col-6 content_antes-formProf">
                    <div class="col-12 pl-0 content_agregarImg-formProf form-group">
                        <div class="col-10 img_selccionada-formProf">
                            <div class="img_anexada-formProf" id="previewates"></div>
                        </div>

                        <div class="agregar_archivo-formProf">
                            <input type='file' id="imgantes" name="imggaleria[]"/>
                        </div>
                    </div>

                    <div class="col-12 pl-0">
                        <label for="example-date-input" class="col-2 col-form-label">Fecha </label>

                        <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                    </div>

                    <div class="col-12 pl-0">
                        <div class="form-group">
                            <label for="title">nombre foto</label>

                            <input class="form-control" id="nombrefoto"  type="text" name="nombrefoto[]" value="">
                        </div>
                    </div>

                    <div class="col-12 pl-0">
                        <div class="form-group">
                            <label for="title">Descripcion foto</label>
                            
                            <input class="form-control" id="descripcion"  type="text" name="descripcion[]" value="">
                        </div>
                    </div>
                </div>

                <!-- Contenido DESPUÉS -->
                <div class="col-6 pr-0">
                    <div class="col-12 content_agregarImg-formProf form-group">
                        <div class="col-10 img_selccionada-formProf">
                            <div class="img_anexada-formProf" id="previewates"></div>
                        </div>

                        <div class="agregar_archivo-formProf">
                            <input type='file' id="imgantes" name="imggaleria[]"/>
                        </div>
                    </div>

                    <div class="col-12 pr-0">
                        <label for="example-date-input" class="col-2 col-form-label">Fecha </label>
                        
                        <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                    </div>

                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">titulo foto</label>

                            <input class="form-control" id="nombrepremio"  type="text" name="nombrefoto[]" value="">
                        </div>
                    </div>
                    
                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Descripcion foto</label>

                            <input class="form-control" id="nombrepremio"  type="text" name="descripcion[]" value="">
                        </div>
                    </div>
                </div>
            </div>
        @elseif($objContadorGaleria->cantidad == 5)
            <!-- Modulos de los contenidos ANTES y DESPUÉS -->
            <div class="row content_antDesp-formProf">
                <!-- Contenido ANTES -->
                <div class="col-6 content_antes-formProf">
                    <div class="col-12 pl-0 content_agregarImg-formProf form-group">
                        <div class="col-10 img_selccionada-formProf">
                            <div class="img_anexada-formProf" id="previewates"></div>
                        </div>

                        <div class="agregar_archivo-formProf">
                            <input type='file' id="imgantes" name="imggaleria[]"/>
                        </div>
                    </div>

                    <div class="col-12 pl-0">
                        <label for="example-date-input" class="col-2 col-form-label">Fecha </label>
                        
                        <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                    </div>

                    <div class="col-12 pl-0">
                        <div class="form-group">
                            <label for="title">nombre foto</label>

                            <input class="form-control" id="nombrefoto"  type="text" name="nombrefoto[]" value="">
                        </div>
                    </div>

                    <div class="col-12 pl-0">
                        <div class="form-group">
                            <label for="title">Descripcion foto</label>
                            
                            <input class="form-control" id="descripcion"  type="text" name="descripcion[]" value="">
                        </div>
                    </div>
                </div>

                <!-- Contenido DESPUÉS -->
                <div class="col-6 pr-0">
                    <div class="col-12 content_agregarImg-formProf form-group">
                        <div class="col-10 img_selccionada-formProf">
                            <div class="img_anexada-formProf" id="previewates"></div>
                        </div>

                        <div class="agregar_archivo-formProf">
                            <input type='file' id="imgantes" name="imggaleria[]"/>
                        </div>
                    </div>

                    <div class="col-12 pr-0">
                        <label for="example-date-input" class="col-2 col-form-label">Fecha </label>
                        
                        <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                    </div>

                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">titulo foto</label>

                            <input class="form-control" id="nombrepremio"  type="text" name="nombrefoto[]" value="">
                        </div>
                    </div>
                    
                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Descripcion foto</label>

                            <input class="form-control" id="nombrepremio"  type="text" name="descripcion[]" value="">
                        </div>
                    </div>
                </div>

                <!-- Contenido ANTES -->
                <div class="col-6 content_antes-formProf">
                    <div class="col-12 pl-0 content_agregarImg-formProf form-group">
                        <div class="col-10 img_selccionada-formProf">
                            <div class="img_anexada-formProf" id="previewates"></div>
                        </div>

                        <div class="agregar_archivo-formProf">
                            <input type='file' id="imgantes" name="imggaleria[]"/>
                        </div>
                    </div>

                    <div class="col-12 pl-0">
                        <label for="example-date-input" class="col-2 col-form-label">Fecha </label>

                        <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                    </div>

                    <div class="col-12 pl-0">
                        <div class="form-group">
                            <label for="title">nombre foto</label>

                            <input class="form-control" id="nombrefoto"  type="text" name="nombrefoto[]" value="">
                        </div>
                    </div>

                    <div class="col-12 pl-0">
                        <div class="form-group">
                            <label for="title">Descripcion foto</label>
                            
                            <input class="form-control" id="descripcion"  type="text" name="descripcion[]" value="">
                        </div>
                    </div>
                </div>
            </div>
        @elseif($objContadorGaleria->cantidad == 6)
            <!-- Modulos de los contenidos ANTES y DESPUÉS -->
            <div class="row content_antDesp-formProf">
                <!-- Contenido ANTES -->
                <div class="col-6 content_antes-formProf">
                    <div class="col-12 pl-0 content_agregarImg-formProf form-group">
                        <div class="col-10 img_selccionada-formProf">
                            <div class="img_anexada-formProf" id="previewates"></div>
                        </div>

                        <div class="agregar_archivo-formProf">
                            <input type='file' id="imgantes" name="imggaleria[]"/>
                        </div>
                    </div>

                    <div class="col-12 pl-0">
                        <label for="example-date-input" class="col-2 col-form-label">Fecha </label>
                        
                        <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                    </div>

                    <div class="col-12 pl-0">
                        <div class="form-group">
                            <label for="title">nombre foto</label>

                            <input class="form-control" id="nombrefoto"  type="text" name="nombrefoto[]" value="">
                        </div>
                    </div>

                    <div class="col-12 pl-0">
                        <div class="form-group">
                            <label for="title">Descripcion foto</label>
                            
                            <input class="form-control" id="descripcion"  type="text" name="descripcion[]" value="">
                        </div>
                    </div>
                </div>

                <!-- Contenido DESPUÉS -->
                <div class="col-6 pr-0">
                    <div class="col-12 content_agregarImg-formProf form-group">
                        <div class="col-10 img_selccionada-formProf">
                            <div class="img_anexada-formProf" id="previewates"></div>
                        </div>

                        <div class="agregar_archivo-formProf">
                            <input type='file' id="imgantes" name="imggaleria[]"/>
                        </div>
                    </div>

                    <div class="col-12 pr-0">
                        <label for="example-date-input" class="col-2 col-form-label">Fecha </label>
                        
                        <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                    </div>

                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">titulo foto</label>

                            <input class="form-control" id="nombrepremio"  type="text" name="nombrefoto[]" value="">
                        </div>
                    </div>
                    
                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Descripcion foto</label>

                            <input class="form-control" id="nombrepremio"  type="text" name="descripcion[]" value="">
                        </div>
                    </div>
                </div>
            </div>
        @elseif($objContadorGaleria->cantidad == 7)
             <!-- Modulos de los contenidos ANTES y DESPUÉS -->
             <div class="row content_antDesp-formProf">
                <!-- Contenido ANTES -->
                <div class="col-6 content_antes-formProf">
                    <div class="col-12 pl-0 content_agregarImg-formProf form-group">
                        <div class="col-10 img_selccionada-formProf">
                            <div class="img_anexada-formProf" id="previewates"></div>
                        </div>

                        <div class="agregar_archivo-formProf">
                            <input type='file' id="imgantes" name="imggaleria[]"/>
                        </div>
                    </div>

                    <div class="col-12 pl-0">
                        <label for="example-date-input" class="col-2 col-form-label">Fecha </label>
                        
                        <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                    </div>

                    <div class="col-12 pl-0">
                        <div class="form-group">
                            <label for="title">nombre foto</label>

                            <input class="form-control" id="nombrefoto"  type="text" name="nombrefoto[]" value="">
                        </div>
                    </div>

                    <div class="col-12 pl-0">
                        <div class="form-group">
                            <label for="title">Descripcion foto</label>
                            
                            <input class="form-control" id="descripcion"  type="text" name="descripcion[]" value="">
                        </div>
                    </div>
                </div>
            </div>
        @elseif($objContadorGaleria->cantidad == 8)
            <span>no se puede agregar mas</span>
        @endif 

        <div class="col-lg-12 content_btnEnviar-formProf">
            <button type="submit" class="btn2_enviar-formProf"> Guardar
                <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flecha_ingreso-membresia" alt=""> 
            </button>
        </div>  
    </form>
</div>  
<!--------------------------------------------      Fin 12 doceava parte del formulario *** GALERIA ***      ------------------------------------------------>

<!--------------------------------------------      Inicio 13 treceava parte del formulario *** VIDEOS ***      ------------------------------------------------>
<div class="col-lg-10 pb-3 infoBasica_formProf">
    <h5 class="col-lg-12 icon_infoBasica-formProf"> Videos </h5>

    <p class="text_superior-proced-formProf"> A continuación suba imágenes al carrusel con respecto a los premios y reconocimientos, con su respectivo nombre y descripción. </p>

    <!-- Modulo de la GALERIA con información -->
    <div class="row col-12 p-0 m-0">
        @foreach($objVideo as $objVideo)
            @if(!empty($objVideo->nombrevideo))
                <!-- Contenido GALERIA -->    
                <div class="col-6 mt-3 content_antes-formProf">
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

                        <div class="col-12 pl-0">
                            <div class="form-group">
                                <span>{{$objVideo->nombrevideo}}</span>
                            </div>
                        </div>

                        <div class="col-12 pl-0">
                            <div class="form-group">
                                <span>{{$objVideo->descripcionvideo}}</span>
                            </div>
                        </div>

                        <div class="col-12 pl-0">
                            <div class="form-group">
                                <span>{{$objVideo->fechavideo}}</span>
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
            <!-- Modulos de los contenidos ANTES y DESPUÉS -->
            <div class="row content_antDesp-formProf">
                <!-- Contenido ANTES -->
                <div class="col-6 content_antes-formProf">
                    <div class="col-12 pl-0 content_agregarImg-formProf form-group">
                        <div class="agregar_archivo-formProf">
                            <input id="nombrefoto"  type="text" name="urlvideo[]" value="">
                        </div>
                    </div>

                    <div class="col-12 pl-0">
                        <label for="example-date-input" class="col-form-label">Fecha </label>
                        
                        <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                    </div>

                    <div class="col-12 pl-0">
                        <div class="form-group">
                            <label for="title">Titulo Video</label>

                            <input class="form-control" id="nombrefoto"  type="text" name="nombrefoto[]" value="">
                        </div>
                    </div>

                    <div class="col-12 pl-0">
                        <div class="form-group">
                            <label for="title">Descripcion Video</label>
                            
                            <input class="form-control" id="descripcion"  type="text" name="descripcion[]" value="">
                        </div>
                    </div>
                </div>

                <!-- Contenido DESPUÉS -->
                <div class="col-6 pr-0">
                    <div class="col-12 content_agregarImg-formProf form-group">
                        <div class="agregar_archivo-formProf">
                            <input id="nombrefoto"  type="text" name="urlvideo[]" value="">
                        </div>
                    </div>

                    <div class="col-12 pr-0">
                        <label for="example-date-input" class="col-2 col-form-label">Fecha </label>
                        
                        <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                    </div>

                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Titulo Video</label>

                            <input class="form-control" id="nombrepremio"  type="text" name="nombrefoto[]" value="">
                        </div>
                    </div>
                    
                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Descripcion Video</label>

                            <input class="form-control" id="nombrepremio"  type="text" name="descripcion[]" value="">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modulos de los contenidos ANTES y DESPUÉS -->
            <div class="row content_antDesp-formProf">
                <!-- Contenido ANTES -->
                <div class="col-6 content_antes-formProf">
                    <div class="col-12 pl-0 content_agregarImg-formProf form-group">
                        <div class="agregar_archivo-formProf">
                            <input id="nombrefoto"  type="text" name="urlvideo[]" value="">
                        </div>
                    </div>

                    <div class="col-12 pl-0">
                        <label for="example-date-input" class="col-form-label">Fecha </label>
                        
                        <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                    </div>

                    <div class="col-12 pl-0">
                        <div class="form-group">
                            <label for="title">Titulo Video</label>

                            <input class="form-control" id="nombrefoto"  type="text" name="nombrefoto[]" value="">
                        </div>
                    </div>

                    <div class="col-12 pl-0">
                        <div class="form-group">
                            <label for="title">Descripcion Video</label>
                            
                            <input class="form-control" id="descripcion"  type="text" name="descripcion[]" value="">
                        </div>
                    </div>
                </div>

                <!-- Contenido DESPUÉS -->
                <div class="col-6 pr-0">
                    <div class="col-12 content_agregarImg-formProf form-group">
                        <div class="agregar_archivo-formProf">
                            <input id="nombrefoto"  type="text" name="urlvideo[]" value="">
                        </div>
                    </div>

                    <div class="col-12 pr-0">
                        <label for="example-date-input" class="col-2 col-form-label">Fecha </label>
                        
                        <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                    </div>

                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Titulo Video</label>

                            <input class="form-control" id="nombrepremio"  type="text" name="nombrefoto[]" value="">
                        </div>
                    </div>
                    
                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Descripcion Video</label>

                            <input class="form-control" id="nombrepremio"  type="text" name="descripcion[]" value="">
                        </div>
                    </div>
                </div>
            </div>
        @elseif($objContadorVideo->cantidad == 1)
            <!-- Modulos de los contenidos ANTES y DESPUÉS -->
            <div class="row content_antDesp-formProf">
                <!-- Contenido ANTES -->
                <div class="col-6 content_antes-formProf">
                    <div class="col-12 pl-0 content_agregarImg-formProf form-group">
                        <div class="agregar_archivo-formProf">
                            <input id="nombrefoto"  type="text" name="urlvideo[]" value="">
                        </div>
                    </div>

                    <div class="col-12 pl-0">
                        <label for="example-date-input" class="col-form-label">Fecha </label>
                        
                        <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                    </div>

                    <div class="col-12 pl-0">
                        <div class="form-group">
                            <label for="title">Titulo Video</label>

                            <input class="form-control" id="nombrefoto"  type="text" name="nombrefoto[]" value="">
                        </div>
                    </div>

                    <div class="col-12 pl-0">
                        <div class="form-group">
                            <label for="title">Descripcion Video</label>
                            
                            <input class="form-control" id="descripcion"  type="text" name="descripcion[]" value="">
                        </div>
                    </div>
                </div>

                <!-- Contenido DESPUÉS -->
                <div class="col-6 pr-0">
                    <div class="col-12 content_agregarImg-formProf form-group">
                        <div class="agregar_archivo-formProf">
                            <input id="nombrefoto"  type="text" name="urlvideo[]" value="">
                        </div>
                    </div>

                    <div class="col-12 pr-0">
                        <label for="example-date-input" class="col-2 col-form-label">Fecha </label>
                        
                        <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                    </div>

                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Titulo Video</label>

                            <input class="form-control" id="nombrepremio"  type="text" name="nombrefoto[]" value="">
                        </div>
                    </div>
                    
                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Descripcion Video</label>

                            <input class="form-control" id="nombrepremio"  type="text" name="descripcion[]" value="">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modulos de los contenidos ANTES y DESPUÉS -->
            <div class="row content_antDesp-formProf">
                <!-- Contenido ANTES -->
                <div class="col-6 content_antes-formProf">
                    <div class="col-12 pl-0 content_agregarImg-formProf form-group">
                        <div class="agregar_archivo-formProf">
                            <input id="nombrefoto"  type="text" name="urlvideo[]" value="">
                        </div>
                    </div>

                    <div class="col-12 pl-0">
                        <label for="example-date-input" class="col-form-label">Fecha </label>
                        
                        <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                    </div>

                    <div class="col-12 pl-0">
                        <div class="form-group">
                            <label for="title">Titulo Video</label>

                            <input class="form-control" id="nombrefoto"  type="text" name="nombrefoto[]" value="">
                        </div>
                    </div>

                    <div class="col-12 pl-0">
                        <div class="form-group">
                            <label for="title">Descripcion Video</label>
                            
                            <input class="form-control" id="descripcion"  type="text" name="descripcion[]" value="">
                        </div>
                    </div>
                </div>
            </div>
        @elseif($objContadorVideo->cantidad == 2)
            <!-- Modulos de los contenidos ANTES y DESPUÉS -->
            <div class="row content_antDesp-formProf">
                <!-- Contenido ANTES -->
                <div class="col-6 content_antes-formProf">
                    <div class="col-12 pl-0 content_agregarImg-formProf form-group">
                        <div class="agregar_archivo-formProf">
                            <input id="nombrefoto"  type="text" name="urlvideo[]" value="">
                        </div>
                    </div>

                    <div class="col-12 pl-0">
                        <label for="example-date-input" class="col-form-label">Fecha </label>
                        
                        <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                    </div>

                    <div class="col-12 pl-0">
                        <div class="form-group">
                            <label for="title">Titulo Video</label>

                            <input class="form-control" id="nombrefoto"  type="text" name="nombrefoto[]" value="">
                        </div>
                    </div>

                    <div class="col-12 pl-0">
                        <div class="form-group">
                            <label for="title">Descripcion Video</label>
                            
                            <input class="form-control" id="descripcion"  type="text" name="descripcion[]" value="">
                        </div>
                    </div>
                </div>

                <!-- Contenido DESPUÉS -->
                <div class="col-6 pr-0">
                    <div class="col-12 content_agregarImg-formProf form-group">
                        <div class="agregar_archivo-formProf">
                            <input id="nombrefoto"  type="text" name="urlvideo[]" value="">
                        </div>
                    </div>

                    <div class="col-12 pr-0">
                        <label for="example-date-input" class="col-2 col-form-label">Fecha </label>
                        
                        <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                    </div>

                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Titulo Video</label>

                            <input class="form-control" id="nombrepremio"  type="text" name="nombrefoto[]" value="">
                        </div>
                    </div>
                    
                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Descripcion Video</label>

                            <input class="form-control" id="nombrepremio"  type="text" name="descripcion[]" value="">
                        </div>
                    </div>
                </div>
            </div>
        @elseif($objContadorVideo->cantidad == 3)
            <!-- Modulos de los contenidos ANTES y DESPUÉS -->
            <div class="row content_antDesp-formProf">
                <!-- Contenido ANTES -->
                <div class="col-6 content_antes-formProf">
                    <div class="col-12 pl-0 content_agregarImg-formProf form-group">
                        <div class="agregar_archivo-formProf">
                            <input id="nombrefoto"  type="text" name="urlvideo[]" value="">
                        </div>
                    </div>

                    <div class="col-12 pl-0">
                        <label for="example-date-input" class="col-form-label">Fecha </label>
                        
                        <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                    </div>

                    <div class="col-12 pl-0">
                        <div class="form-group">
                            <label for="title">Titulo Video</label>

                            <input class="form-control" id="nombrefoto"  type="text" name="nombrefoto[]" value="">
                        </div>
                    </div>

                    <div class="col-12 pl-0">
                        <div class="form-group">
                            <label for="title">Descripcion Video</label>
                            
                            <input class="form-control" id="descripcion"  type="text" name="descripcion[]" value="">
                        </div>
                    </div>
                </div>
            </div>
        @elseif($objContadorVideo->cantidad == 4)
            <span>no se pueden agregar mas </span>
        @endif 

        <div class="col-lg-12 content_btnEnviar-formProf">
            <button type="submit" class="btn2_enviar-formProf"> Guardar
                <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flecha_ingreso-membresia" alt=""> 
            </button>
        </div>
    </form>
</div>
<!--------------------------------------------      Fin 13 treceava parte del formulario *** VIDEOS ***      ------------------------------------------------>
@endsection