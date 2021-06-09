@extends('layouts.app')

@section('content')

<!-- Contenedor principal de las tarjetas de datos -->
<div class="container-fluid content_principal-formProf">
<!-------------------------------------------primera parte del formulario-------------------------------------------------------> 
<!-- Fila principal información básica -->
<div class="col-lg-10 content_textPrincipal-formProf">
    <h5 class="titulo_principal-formProf"> LE DAMOS LA BIENVENIDA A ZAABRA SALUD </h5>
    <p class="texto_superior-formProf"> Ingrese los datos según corresponda y finalice el proceso completamente en línea. </p>
</div>

<div class="col-lg-10 infoBasica_formProf">
    <h5 class="col-lg-12 icon_infoBasica-formProf"> Información básica </h5> 
    <form method="POST" action="{{ url ('/FormularioProfesionalSave') }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8">
        <input type="hidden" name="_token" value="{{ csrf_token() }}"> 

        <!---------------valida que ya exista informacion y la muestra en caso contrario muestra un formulario vacio---------------------> 
        @if(!empty($objFormulario))
            <div class="row fila_infoBasica-formProf">
                <!-- Sección imagen de usuario --> 
                <div class="col-lg-3 contain_imgUsuario-formProf">
                    @if(!empty($objFormulario->imglogoempresa))
                        <img id="imagenPrevisualizacion" class="img_usuario-formProf" src="{{URL::asset($objFormulario->imglogoempresa)}}">
                    @endif  

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
            
                    @foreach ($objFormulario as $objFormulario)
                        <div class="col-lg-6 pr-0">
                            <label for="title">  Fecha de nacimiento </label>

                            <input class="col-lg-12 form-control" type="date" value="{{$objFormulario->fechanacimiento}}" id="example-date-input" name="fechanacimiento">
                        </div>
                    @endforeach

                    <div class="col-lg-6 pr-0">
                        <label for="title"> Selecione Área </label> 

                        <select id="idarea" name="idarea" class="col-lg-12 form-control" style="width:350px" >
                            <option value="" selected disabled>Seleccione area</option>

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
                        <label for="title"> Selecione Universidad </label>

                        <select  class="col-lg-12 form-control" style="width:350px" name="id_universidad">
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
<!--------------------------------------------Fin primera parte del formulario------------------------------------------------> 


<!--------------------------------------------Inicio segunda parte del formulario------------------------------------------------> 
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
<!--------------------------------------------Fin segunda parte del formulario------------------------------------------------> 


<!--------------------------------------------Inicio tercera parte del formulario------------------------------------------------> 
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
<!--------------------------------------------Fin tercera parte del formulario------------------------------------------------> 


<!--------------------------------------------Inicio cuarta parte del formulario------------------------------------------------> 
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
<!--------------------------------------------Fin cuarta parte del formulario------------------------------------------------>



<!--------------------------------------------Inicio quinta parte del formulario------------------------------------------------> 
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
<!--------------------------------------------Fin quinta parte del formulario------------------------------------------------>


<!--------------------------------------------Inicio sexta parte del formulario------------------------------------------------> 
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
<!--------------------------------------------Fin sexta parte del formulario------------------------------------------------>



<!--------------------------------------------Inicio septima parte del formulario------------------------------------------------> 
<div class="col-lg-10 pb-3 infoBasica_formProf">
    <h5 class="col-lg-12 icon_infoBasica-formProf"> Asociaciones </h5>

    @foreach($objAsociaciones as $objAsociaciones)
        @if(!empty($objAsociaciones->imgasociacion))
            <div class="col-12">
                <img id="imagenPrevisualizacion" src="{{URL::asset($objAsociaciones->imgasociacion)}}">

                <a href="{{url('/FormularioProfesionaldelete7/'.$objAsociaciones->idAsociaciones)}}">
                    <button type="submit" class="close" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </a>
            </div>
        @endif
    @endforeach

    <form method="POST" action="{{ url ('/FormularioProfesionalSave7') }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8">
        <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
            
        @if($objContadorAsociaciones->cantidad == 0)
            <div class="col-12 row px-0 pt-3 m-0">
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
            <div class="col-12 row p-0 m-0">
                <div class="col-6 pr-0 form-group">
                    <div class="col-6 btn-input">
                        <input type='file' id="imgasocia1" name="src-file1" aria-label="Archivo"/>
                    </div>

                    <div class="col-6">
                        <div id="preview1"></div>
                    </div>
                </div> 

                <div class="col-6 pr-0 form-group">
                    <div class="col-6 btn-input">
                        <input type='file' id="imgasocia2" name="src-file2" aria-label="Archivo"/>
                    </div>

                    <div class="col-6">
                        <div id="preview2"></div>
                    </div>
                </div> 

                <div class="col-6 pr-0 form-group">
                    <div class="col-6 btn-input">
                        <input type='file' id="imgasocia3" name="src-file13" aria-label="Archivo"/>
                    </div>

                    <div class="col-6">
                        <div id="preview3"></div>
                    </div>
                </div>  
            </div>

        @elseif($objContadorAsociaciones->cantidad == 2)
            <div class="col-12 row p-0 m-0">
                <div class="col-6 pr-0 form-group">
                    <div class="col-6">
                        <input type='file' id="imgasocia1" name="imgasociacion[]"/>
                    </div>
                    
                    <div class="col-6">
                        <div id="preview1"></div>
                    </div>
                </div> 

                <div class="col-6 pr-0 form-group">
                    <div class="col-6">
                        <input type='file' id="imgasocia2" name="imgasociacion[]"/>
                    </div>

                    <div class="col-6">
                        <div id="preview2"></div>
                    </div>
                </div> 
            </div> 

        @elseif($objContadorAsociaciones->cantidad == 3)
            <div class="col-12 row p-0 m-0">
                <div class="col-6 pr-0 form-group">
                    <div class="col-6">
                        <input type='file' id="imgasocia1" name="imgasociacion[]"/>
                    </div>

                    <div class="col-6">
                        <div id="preview1"></div>
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
<!--------------------------------------------Fin septima parte del formulario------------------------------------------------>



<!--------------------------------------------Inicio octavo parte del formulario------------------------------------------------> 

<div class="container" style="background: blue;">
                @foreach($objIdiomas as $objIdiomas)
                        @if(!empty($objIdiomas->imgidioma))
                            <div class="col-12">
                            <label for="title">{{$objIdiomas->nombreidioma}}</label>
                             <img id="imagenPrevisualizacion" src="{{URL::asset($objIdiomas->imgidioma)}}">

                            <a href="{{url('/FormularioProfesionaldelete8/'.$objIdiomas->id_idioma)}}">
                                <button type="submit" class="close" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </a>
                            </div>
                        @endif
                @endforeach
         <form method="POST" action="{{ url ('/FormularioProfesionalSave8') }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">  
                
                @if($objContadorIdiomas->cantidad == 0)
                        <div class="col-12">
                            <div class="form-group">
                                <label for="title">Selecione</label>
                                <select  class="form-control" style="width:350px" name="id_idioma[]">
                                    <option value=" ">Seleccione</option>
                                    @foreach($idiomas as $idiomas1)
                                    <option value="{{$idiomas1->id_idioma}}"> {{$idiomas1->nombreidioma}}</option>
                                    @endforeach
                                </select>
                                <select  class="form-control" style="width:350px" name="id_idioma[]">
                                    <option value=" ">Seleccione</option>
                                    @foreach($idiomas as $idiomas2)
                                    <option value="{{$idiomas2->id_idioma}}"> {{$idiomas2->nombreidioma}}</option>
                                    @endforeach
                                </select>
                                <select  class="form-control" style="width:350px" name="id_idioma[]">
                                    <option value=" ">Seleccione</option>
                                    @foreach($idiomas as $idiomas3)
                                    <option value="{{$idiomas3->id_idioma}}"> {{$idiomas3->nombreidioma}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                @elseif($objContadorIdiomas->cantidad == 1)
                        <div class="col-12">
                            <div class="form-group">
                                <label for="title">Selecione</label>
                                <select  class="form-control" style="width:350px" name="id_idioma[]">
                                    <option value=" ">Seleccione</option>
                                    @foreach($idiomas as $idiomas1)
                                    <option value="{{$idiomas1->id_idioma}}"> {{$idiomas1->nombreidioma}}</option>
                                    @endforeach
                                </select>
                                <select  class="form-control" style="width:350px" name="id_idioma[]">
                                    <option value=" ">Seleccione</option>
                                    @foreach($idiomas as $idiomas2)
                                    <option value="{{$idiomas2->id_idioma}}"> {{$idiomas2->nombreidioma}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>  
                @elseif($objContadorIdiomas->cantidad == 2)
                        <div class="col-12">
                            <div class="form-group">
                                <label for="title">Selecione</label>
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
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </div>
         </form>
</div>

<!--------------------------------------------Fin octavo parte del formulario------------------------------------------------>

<!--------------------------------------------Inicio noveno parte del formulario------------------------------------------------>

<div class="container" style="background: blueviolet;">

                @foreach($objTratamiento as $objTratamiento)
                        @if(!empty($objTratamiento->imgTratamientoAntes))
                            <div class="col-12">
                             <img  src="{{URL::asset($objTratamiento->imgTratamientoAntes)}}">
                            <span>{{$objTratamiento->tituloTrataminetoAntes}}</span>
                            <span>{{$objTratamiento->descripcionTratamientoAntes}}</span>

                            <img  src="{{URL::asset($objTratamiento->imgTratamientodespues)}}">
                            <span>{{$objTratamiento->tituloTrataminetoDespues}}</span>
                            <span>{{$objTratamiento->descripcionTratamientoDespues}}</span>

                            <a href="{{url('/FormularioProfesionaldelete9/'.$objTratamiento->id_tratamiento)}}">
                                <button type="submit" class="close" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </a>
                            </div>
                        @endif
                @endforeach 
    <form method="POST" action="{{ url ('/FormularioProfesionalSave9') }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8">
       <input type="hidden" name="_token" value="{{ csrf_token() }}">  
        <div class="col-12 row">
            <div class="col-6">
                <label for="title">Antes</label>
                <div class="col-12">
                    <div class="form-group col-12 ">
                        <div class="col-6">
                            <input type='file' id="imgantes1" name="imgTratamientoAntes[]"/>
                        </div>
                        <div class="col-6">
                            <div id="previewates1"></div>
                        </div>
                    </div> 
                </div> 
                <div class="col-12">
                    <div class="form-group">
                        <label for="title">Título de la imagen Antes</label>
                        <input id="descripcionExperiencia"  type="text" name="tituloTrataminetoAntes[]" value="">
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label for="title">Descripción Antes</label>
                        <input id="descripcionExperiencia"  type="text" name="descripcionTratamientoAntes[]" value="">
                    </div>
                </div>
            </div>
            <div class="col-6">
                 <label for="title">Despues</label>
                <div class="col-12">
                    <div class="form-group col-12 ">
                        <div class="col-6">
                            <input type='file' id="imgasocia1" name="imgTratamientodespues[]"/>
                        </div>
                        <div class="col-6">
                            <div id="preview1"></div>
                        </div>
                    </div> 
                </div> 
                <div class="col-12">
                    <div class="form-group">
                        <label for="title">Título de la imagen Antes</label>
                        <input id="descripcionExperiencia"  type="text" name="tituloTrataminetoDespues[]" value="">
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label for="title">Descripción Antes</label>
                        <input id="descripcionExperiencia"  type="text" name="descripcionTratamientoDespues[]" value="">
                    </div>
                </div>
                
            </div>
        </div>
        <div class="col-12 row">
            <div class="col-6">
                <label for="title">Antes</label>
                <div class="col-12">
                    <div class="form-group col-12 ">
                        <div class="col-6">
                            <input type='file' id="imgantes1" name="imgTratamientoAntes[]"/>
                        </div>
                        <div class="col-6">
                            <div id="previewates1"></div>
                        </div>
                    </div> 
                </div> 
                <div class="col-12">
                    <div class="form-group">
                        <label for="title">Título de la imagen Antes</label>
                        <input id="descripcionExperiencia"  type="text" name="tituloTrataminetoAntes[]" value="">
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label for="title">Descripción Antes</label>
                        <input id="descripcionExperiencia"  type="text" name="descripcionTratamientoAntes[]" value="">
                    </div>
                </div>
            </div>
            <div class="col-6">
                 <label for="title">Despues</label>
                <div class="col-12">
                    <div class="form-group col-12 ">
                        <div class="col-6">
                            <input type='file' id="imgasocia1" name="imgTratamientodespues[]"/>
                        </div>
                        <div class="col-6">
                            <div id="preview1"></div>
                        </div>
                    </div> 
                </div> 
                <div class="col-12">
                    <div class="form-group">
                        <label for="title">Título de la imagen Antes</label>
                        <input id="descripcionExperiencia"  type="text" name="tituloTrataminetoDespues[]" value="">
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label for="title">Descripción Antes</label>
                        <input id="descripcionExperiencia"  type="text" name="descripcionTratamientoDespues[]" value="">
                    </div>
                </div>
                
            </div>
        </div>
        <div class="col-md-6 col-md-offset-4">
             <button type="submit" class="btn btn-primary">Enviar</button>
        </div>
    </form>
</div>

<!--------------------------------------------Fin noveno parte del formulario----------------------------------------------->

<!--------------------------------------------Inicio decimo parte del formulario------------------------------------------------>
<div class="container" style="background: antiquewhite;">
        <form method="POST" action="{{ url ('/FormularioProfesionalSave10') }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8">
                 <input type="hidden" name="_token" value="{{ csrf_token() }}">  
                <div class="col-12 row">
                    <div class="col-6">
                        <div class="form-group col-12 ">
                                <div class="col-6">
                                    <input type='file' id="imgantes" name="imgpremio[]"/>
                                </div>
                                <div class="col-6">
                                    <div id="previewates"></div>
                                </div>
                            </div>
                            <div class="form-group col-12">
                                    <label for="example-date-input" class="col-2 col-form-label">Fecha de inicio</label>
                                    <div class="col-10">
                                        <input class="form-control" type="date"  id="fechapremio" name="fechapremio[]" value="">
                                    </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="title">titulo premio</label>
                                    <input id="nombrepremio"  type="text" name="nombrepremio[]" value="">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="title">Descrpcion premio</label>
                                    <input id="descripcionpremio"  type="text" name="descripcionpremio[]" value="">
                                </div>
                            </div>
                    </div>

                    <div class="col-6">
                        <div class="col-6">
                            <div class="form-group col-12 ">
                                    <div class="col-6">
                                        <input type='file' id="imgantes" name="imgpremio[]"/>
                                    </div>
                                    <div class="col-6">
                                        <div id="previewates"></div>
                                    </div>
                            </div>
                            <div class="form-group col-12">
                                    <label for="example-date-input" class="col-2 col-form-label">Fecha de inicio</label>
                                    <div class="col-10">
                                        <input class="form-control" type="date"  id="fechapremio" name="fechapremio[]" value="">
                                    </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="title">titulo premio</label>
                                    <input id="nombrepremio"  type="text" name="nombrepremio[]" value="">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="title">Descrpcion premio</label>
                                    <input id="descripcionpremio"  type="text" name="descripcionpremio[]" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 row">
                    <div class="col-6">
                        <div class="form-group col-12 ">
                                <div class="col-6">
                                    <input type='file' id="imgantes" name="imgpremio[]"/>
                                </div>
                                <div class="col-6">
                                    <div id="previewates"></div>
                                </div>
                            </div>
                            <div class="form-group col-12">
                                    <label for="example-date-input" class="col-2 col-form-label">Fecha de inicio</label>
                                    <div class="col-10">
                                        <input class="form-control" type="date"  id="fechapremio" name="fechapremio[]" value="">
                                    </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="title">titulo premio</label>
                                    <input id="nombrepremio"  type="text" name="nombrepremio[]" value="">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="title">Descrpcion premio</label>
                                    <input id="descripcionpremio"  type="text" name="descripcionpremio[]" value="">
                                </div>
                            </div>
                    </div>

                    <div class="col-6">
                        <div class="col-6">
                            <div class="form-group col-12 ">
                                    <div class="col-6">
                                        <input type='file' id="imgantes" name="imgpremio[]"/>
                                    </div>
                                    <div class="col-6">
                                        <div id="previewates"></div>
                                    </div>
                            </div>
                            <div class="form-group col-12">
                                    <label for="example-date-input" class="col-2 col-form-label">Fecha de inicio</label>
                                    <div class="col-10">
                                        <input class="form-control" type="date"  id="fechapremio" name="fechapremio[]" value="">
                                    </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="title">titulo premio</label>
                                    <input id="nombrepremio"  type="text" name="nombrepremio[]" value="">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="title">Descrpcion premio</label>
                                    <input id="descripcionpremio"  type="text" name="descripcionpremio[]" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-md-offset-4">
                     <button type="submit" class="btn btn-primary">Enviar</button>
                </div>
        </form>
</div>
<!--------------------------------------------Inicio decimo parte del formulario------------------------------------------------>
@endsection