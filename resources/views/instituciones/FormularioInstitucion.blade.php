@extends('layouts.app')

@section('content')

<div class="col-lg-10 infoBasica_formProf">
    <h5 class="col-lg-12 icon_infoBasica-formProf"> Información básica </h5> 
    <form method="POST" action="{{ url ('/FormularioInstitucionSave') }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8">
        <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
        <!---------------valida que ya exista informacion y la muestra en caso contrario muestra un formulario vacio---------------------> 

        @if(!empty($objFormulario))
                <div class="row col-12 datos_principales-formProf">
                   <div class="col-2">
                       @foreach($objFormulario as $logo)
                            <img id="imagenPrevisualizacion" class="img_usuario-formProf" src="{{URL::asset($logo->logo)}}">
                        @endforeach 
                            <input type="file" class="input_imgUsuario-formProf" name="logoInstitucion"  id="seleccionArchivos" accept="image/png, image/jpeg">
                            <label class="text_usuario-formProf"> Subir foto de perfil </label>
                   </div>
                   <div class="col-10">
                        <div class="col-6">
                                @foreach ($objuser as $objuser)
                                    <div class="col-lg-6 pr-0">
                                        <label for="example-date-input" class="col-12 col-form-label px-0"> Nombres Institucion</label>
                                        <div class="col-12 nombres_usuario-formProf">
                                            <input class="input_nomApl-formProf" value="{{$objuser->nombreinstitucion}}" readonly></input>
                                        </div>
                                    </div>
                                @endforeach
                        </div>
                        <div class="col-6">
                                @foreach($objFormulario as $imagen)
                                    <img id="imagenPrevisualizacion" class="img_usuario-formProf" src="{{URL::asset($imagen->imagen)}}">
                                 @endforeach   
                                <input type="file" class="input_imgUsuario-formProf" name="imagenInstitucion"  id="seleccionArchivos" accept="image/png, image/jpeg">
                                <label class="text_usuario-formProf"> Subir foto de perfil </label>
                        </div>
                   </div>
                   <div class="col-10">
                               @foreach ($objFormulario as $objFormulario)
                                    <div class="col-lg-6 pr-0">
                                        <label for="title">  Fecha  </label>
                                        <input class="col-lg-12 form-control" type="date" value="{{$objFormulario->fechainicio}}" id="example-date-input" name="fechainicio">
                                    </div>
                                    <div class="col-6 pr-0">
                                        <div class="form-group">
                                            <label for="title"> Pagina web </label>
                                            <input class="col-lg-12 form-control" id="url" placeholder="nombre" type="text" name="url" value="{{$objFormulario->url}}">
                                        </div>
                                </div>
                                @endforeach
                   </div>
                </div>

            <!------------------ Fin campos llenos ---------------------> 

            <!--------------- Inicio campos vacios--------------------->    
        @else
            <div class="row fila_infoBasica-formProf">
                <!-- Sección imagen de usuario --> 
                <div class="col-lg-3 contain_imgUsuario-formProf">   
                    <img class="img_usuario-formProf" id="imagenPrevisualizacion">

                    <input class="input_imgUsuario-formProf" type="file" name="logoInstitucion"  id="seleccionArchivos" accept="image/png, image/jpeg">

                    <label class="text_usuario-formProf"> Subir logo </label>
                </div>
          
                <!-- Sección datos personales -->
                <div class="row col-lg-9 datos_principales-formProf">
                    @foreach ($objuser as $objuser)
                    <div class="col-lg-6 pr-0">
                        <label for="example-date-input" class="col-12 col-form-label px-0"> Nombres Institucion</label>
                        <div class="col-12 nombres_usuario-formProf">
                            <input class="input_nomApl-formProf" value="{{$objuser->nombreinstitucion}}" readonly></input>
                        </div>
                    </div>
                    @endforeach
                    <div class="col-lg-3 contain_imgUsuario-formProf">   
                        <img class="img_usuario-formProf" id="imagenPrevisualizacion">
                        <input class="input_imgUsuario-formProf" type="file" name="imagenInstitucion"  id="seleccionArchivos" accept="image/png, image/jpeg">
                        <label class="text_usuario-formProf"> Subir logo </label>
                   </div>
       
                    <div class="col-lg-6 pr-0">
                        <label for="title">  Fecha </label>
                        
                        <input class="col-lg-12 form-control" type="date" value="2011-08-19" id="example-date-input" name="fechainicio">
                    </div>

                    <div class="col-6 pr-0">
                        <div class="form-group">
                            <label for="title"> Pagina web </label>
                            <input class="col-lg-12 form-control" id="url" placeholder="nombre" type="text" name="url">
                        </div>
                    </div>                    
                </div>
            </div>
        @endif
         <div class="col-lg-3 content_btnEnviar-formProf">
            <button type="submit" class="btn_enviar-formProf"> Enviar
                <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flecha_ingreso-membresia" alt=""> 
            </button>
         </div>
        <!--------------- Fin campos vacios--------------------->  
    </form>
</div>


<!--------------------------------------------Inicio segunda parte del formulario------------------------------------------------> 
<div class="col-lg-10 infoBasica_formProf">
    <form method="POST" action="{{ url ('/FormularioInstitucionSave2') }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8">
        <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
        <h5 class="col-lg-12 icon_infoBasica-formProf"> Información de contacto </h5>
        <div class="row fila_infoBasica-formProf">
            @if(!empty($objFormulario->telefonouno))
                <div class="col-6 pr-0">
                    <div class="form-group">
                        <label for="title"> Celular </label>
                        <input class="col-lg-12 form-control" id="tarjeta" placeholder="N. Celular" type="number" name="telefonouno" value="{{$objFormulario->telefonouno}}">
                    </div>
                </div>

                <div class="col-6 pr-0">
                    <div class="form-group">
                        <label for="title"> Teléfono </label>

                        <input class="col-lg-12 form-control" id="telefono" placeholder="N. Telefono" type="number" name="telefono2" value="{{$objFormulario->telefono2}}">
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
                        
                        <input class="col-lg-12 form-control" id="tarjeta" placeholder="N. Celular" type="number" name="telefonouno" >
                    </div>
                </div>

                <div class="col-6 pr-0">
                    <div class="form-group">
                        <label for="title"> Teléfono </label>

                        <input class="col-lg-12 form-control" id="telefono" placeholder="N. Telefono" type="number" name="telefono2" >
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
    <h5 class="col-lg-12 icon_infoBasica-formProf"> Servicios </h5>

    <form method="POST" action="{{ url ('/FormularioInstitucionSave3') }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8">
        <input type="hidden" name="_token" value="{{ csrf_token() }}"> 

        @if(!empty($objFormulario))
            <div class="col-12 pr-0">
                <div class="form-group">
                    <label for="title"> Escriba una breve descripción de su servicio </label>

                    <textarea class="form-control" id="descripcionPerfil"  type="text" name="DescripcionGeneralServicios" >{{$objFormulario->DescripcionGeneralServicios}}</textarea>
                </div>
            </div>
        @else
            <div class="col-12 pr-0">
                <div class="form-group">
                    <label for="title">  Escriba una breve descripción de su servicio </label>

                    <textarea class="form-control" id="descripcionPerfil"  type="text" name="DescripcionGeneralServicios" ></textarea>
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
<!--------------------------------------------Fin tercera parte del formulario------------------------------------------------>

<!--------------------------------------------Inicio cuarta parte del formulario------------------------------------------------> 
<div class="col-lg-10 pb-3 infoBasica_formProf">
    <div class="col-12 row">
        @foreach($objServicio as $objServicio)
                @if(!empty($objServicio->tituloServicios))
                        <div class="col-6">
                        <label for="title"> Título del servicio </label>
                            <div class="col-12">
                                <span>{{$objServicio->tituloServicios}} </span>
                            </div>
                            <label for="title"> Descrpcion del servicio </label>
                            <div class="col-12">
                                <span>{{$objServicio->DescripcioServicios}} </span>
                            </div>
                            <label for="title"> Sucursales </label>
                            <div class="col-12">
                               <span>{{$objServicio->sucursalservicio}} </span>
                            </div>
                            <a href="{{url('/FormularioInstituciondelete4/'.$objServicio->id_servicio)}}">
                                <button type="submit" class="close" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </a>
                        </div>   
                @endif
            @endforeach
        </div>
    <form method="POST" action="{{ url ('/FormularioInstitucionSave4') }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8">
        <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
        <h5 class="col-lg-12 icon_infoBasica-formProf"> Servicios </h5>
           @if($objContadorServicio->cantidad == 0)
                <div class="row fila_infoBasica-formProf">
                    <div class="col-6">
                        <div class="col-12 pr-0">
                                <div class="form-group">
                                    <label for="title"> Título del servicio </label>
                                    <input class="col-lg-12 form-control" id="tituloServicios" placeholder="tituloServicios" type="text" name="tituloServicios[]" value="">
                                </div>
                            </div>

                            <div class="col-12 pr-0">
                                <div class="form-group">
                                    <label for="title"> Descripción y sede en la que está el servicio </label>
                                    <textarea class="col-lg-12 form-control" id="DescripcioServicios" placeholder="DescripcioServicios" name="DescripcioServicios[]" value=""></textarea>
                                </div>
                            </div>
                            <div class="col-12 pr-0">
                                <div class="form-group">
                                    <label for="title"> Sucursales </label>
                                    <div class="">
                                        <input class="col-lg-12 form-control" data-role="tagsinput" placeholder="tituloServicios" type="text" name="sucursalservicio[]" value="">
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="col-6">
                        <div class="col-12 pr-0">
                                <div class="form-group">
                                    <label for="title"> Título del servicio </label>
                                    <input class="col-lg-12 form-control" id="tituloServicios" placeholder="tituloServicios" type="text" name="tituloServicios[]" value="">
                                </div>
                            </div>

                            <div class="col-12 pr-0">
                                <div class="form-group">
                                    <label for="title"> Descripción y sede en la que está el servicio </label>
                                    <textarea class="col-lg-12 form-control" id="DescripcioServicios" placeholder="DescripcioServicios" name="DescripcioServicios[]" value=""></textarea>
                                </div>
                            </div>
                            <div class="col-12 pr-0">
                                <div class="form-group">
                                    <label for="title"> Sucursales </label>
                                    <div class="">
                                        <input class="col-lg-12 form-control"  data-role="tagsinput" placeholder="tituloServicios" type="text" name="sucursalservicio[]" value="">
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
                <div class="row fila_infoBasica-formProf">
                    <div class="col-6">
                        <div class="col-12 pr-0">
                                <div class="form-group">
                                    <label for="title"> Título del servicio </label>
                                    <input class="col-lg-12 form-control" id="tituloServicios" placeholder="tituloServicios" type="text" name="tituloServicios[]" value="">
                                </div>
                            </div>

                            <div class="col-12 pr-0">
                                <div class="form-group">
                                    <label for="title"> Descripción y sede en la que está el servicio </label>
                                    <textarea class="col-lg-12 form-control" id="DescripcioServicios" placeholder="DescripcioServicios" name="DescripcioServicios[]" value=""></textarea>
                                </div>
                            </div>
                            <div class="col-12 pr-0">
                                <div class="form-group">
                                    <label for="title"> Sucursales </label>
                                    <div class="">
                                    <input class="col-lg-12 form-control"  data-role="tagsinput" placeholder="tituloServicios" type="text" name="sucursalservicio[]" value="">
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="col-6">
                        <div class="col-12 pr-0">
                                <div class="form-group">
                                    <label for="title"> Título del servicio </label>
                                    <input class="col-lg-12 form-control" id="tituloServicios" placeholder="tituloServicios" type="text" name="tituloServicios[]" value="">
                                </div>
                            </div>

                            <div class="col-12 pr-0">
                                <div class="form-group">
                                    <label for="title"> Descripción y sede en la que está el servicio </label>
                                    <textarea class="col-lg-12 form-control" id="DescripcioServicios" placeholder="DescripcioServicios" name="DescripcioServicios[]" value=""></textarea>
                                </div>
                            </div>
                            <div class="col-12 pr-0">
                                <div class="form-group">
                                    <label for="title"> Sucursales </label>
                                    <div class="">
                                    <input class="col-lg-12 form-control"   data-role="tagsinput" placeholder="tituloServicios" type="text" name="sucursalservicio[]" value="">
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
                <div class="row fila_infoBasica-formProf">
                    <div class="col-6">
                        <div class="col-12 pr-0">
                                <div class="form-group">
                                    <label for="title"> Título del servicio </label>
                                    <input class="col-lg-12 form-control" id="tituloServicios" placeholder="tituloServicios" type="text" name="tituloServicios[]" value="">
                                </div>
                            </div>

                            <div class="col-12 pr-0">
                                <div class="form-group">
                                    <label for="title"> Descripción y sede en la que está el servicio </label>
                                    <textarea class="col-lg-12 form-control" id="DescripcioServicios" placeholder="DescripcioServicios" name="DescripcioServicios[]" value=""></textarea>
                                </div>
                            </div>
                            <div class="col-12 pr-0">
                                <div class="form-group">
                                    <label for="title"> Sucursales </label>
                                    <div class="">
                                    <input class="col-lg-12 form-control"  data-role="tagsinput" placeholder="tituloServicios" type="text" name="sucursalservicio[]" value="">
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="col-6">
                        <div class="col-12 pr-0">
                                <div class="form-group">
                                    <label for="title"> Título del servicio </label>
                                    <input class="col-lg-12 form-control" id="tituloServicios" placeholder="tituloServicios" type="text" name="tituloServicios[]" value="">
                                </div>
                            </div>

                            <div class="col-12 pr-0">
                                <div class="form-group">
                                    <label for="title"> Descripción y sede en la que está el servicio </label>
                                    <textarea class="col-lg-12 form-control" id="DescripcioServicios" placeholder="DescripcioServicios" name="DescripcioServicios[]" value=""></textarea>
                                </div>
                            </div>
                            <div class="col-12 pr-0">
                                <div class="form-group">
                                    <label for="title"> Sucursales </label>
                                    <div class="">
                                    <input class="col-lg-12 form-control"   data-role="tagsinput" placeholder="tituloServicios" type="text" name="sucursalservicio[]" value="">
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            @elseif($objContadorServicio->cantidad == 1)
                <div class="row fila_infoBasica-formProf">
                    <div class="col-6">
                        <div class="col-12 pr-0">
                                <div class="form-group">
                                    <label for="title"> Título del servicio </label>
                                    <input class="col-lg-12 form-control" id="tituloServicios" placeholder="tituloServicios" type="text" name="tituloServicios[]" value="">
                                </div>
                            </div>

                            <div class="col-12 pr-0">
                                <div class="form-group">
                                    <label for="title"> Descripción y sede en la que está el servicio </label>
                                    <textarea class="col-lg-12 form-control" id="DescripcioServicios" placeholder="DescripcioServicios" name="DescripcioServicios[]" value=""></textarea>
                                </div>
                            </div>
                            <div class="col-12 pr-0">
                                <div class="form-group">
                                    <label for="title"> Sucursales </label>
                                    <div class="">
                                        <input class="col-lg-12 form-control" data-role="tagsinput" placeholder="tituloServicios" type="text" name="sucursalservicio[]" value="">
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="col-6">
                        <div class="col-12 pr-0">
                                <div class="form-group">
                                    <label for="title"> Título del servicio </label>
                                    <input class="col-lg-12 form-control" id="tituloServicios" placeholder="tituloServicios" type="text" name="tituloServicios[]" value="">
                                </div>
                            </div>

                            <div class="col-12 pr-0">
                                <div class="form-group">
                                    <label for="title"> Descripción y sede en la que está el servicio </label>
                                    <textarea class="col-lg-12 form-control" id="DescripcioServicios" placeholder="DescripcioServicios" name="DescripcioServicios[]" value=""></textarea>
                                </div>
                            </div>
                            <div class="col-12 pr-0">
                                <div class="form-group">
                                    <label for="title"> Sucursales </label>
                                    <div class="">
                                        <input class="col-lg-12 form-control"  data-role="tagsinput" placeholder="tituloServicios" type="text" name="sucursalservicio[]" value="">
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
                <div class="row fila_infoBasica-formProf">
                    <div class="col-6">
                        <div class="col-12 pr-0">
                                <div class="form-group">
                                    <label for="title"> Título del servicio </label>
                                    <input class="col-lg-12 form-control" id="tituloServicios" placeholder="tituloServicios" type="text" name="tituloServicios[]" value="">
                                </div>
                            </div>

                            <div class="col-12 pr-0">
                                <div class="form-group">
                                    <label for="title"> Descripción y sede en la que está el servicio </label>
                                    <textarea class="col-lg-12 form-control" id="DescripcioServicios" placeholder="DescripcioServicios" name="DescripcioServicios[]" value=""></textarea>
                                </div>
                            </div>
                            <div class="col-12 pr-0">
                                <div class="form-group">
                                    <label for="title"> Sucursales </label>
                                    <div class="">
                                    <input class="col-lg-12 form-control"  data-role="tagsinput" placeholder="tituloServicios" type="text" name="sucursalservicio[]" value="">
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="col-6">
                        <div class="col-12 pr-0">
                                <div class="form-group">
                                    <label for="title"> Título del servicio </label>
                                    <input class="col-lg-12 form-control" id="tituloServicios" placeholder="tituloServicios" type="text" name="tituloServicios[]" value="">
                                </div>
                            </div>

                            <div class="col-12 pr-0">
                                <div class="form-group">
                                    <label for="title"> Descripción y sede en la que está el servicio </label>
                                    <textarea class="col-lg-12 form-control" id="DescripcioServicios" placeholder="DescripcioServicios" name="DescripcioServicios[]" value=""></textarea>
                                </div>
                            </div>
                            <div class="col-12 pr-0">
                                <div class="form-group">
                                    <label for="title"> Sucursales </label>
                                    <div class="">
                                    <input class="col-lg-12 form-control"   data-role="tagsinput" placeholder="tituloServicios" type="text" name="sucursalservicio[]" value="">
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
                <div class="row fila_infoBasica-formProf">
                    <div class="col-6">
                        <div class="col-12 pr-0">
                                <div class="form-group">
                                    <label for="title"> Título del servicio </label>
                                    <input class="col-lg-12 form-control" id="tituloServicios" placeholder="tituloServicios" type="text" name="tituloServicios[]" value="">
                                </div>
                            </div>

                            <div class="col-12 pr-0">
                                <div class="form-group">
                                    <label for="title"> Descripción y sede en la que está el servicio </label>
                                    <textarea class="col-lg-12 form-control" id="DescripcioServicios" placeholder="DescripcioServicios" name="DescripcioServicios[]" value=""></textarea>
                                </div>
                            </div>
                            <div class="col-12 pr-0">
                                <div class="form-group">
                                    <label for="title"> Sucursales </label>
                                    <div class="">
                                    <input class="col-lg-12 form-control"  data-role="tagsinput" placeholder="tituloServicios" type="text" name="sucursalservicio[]" value="">
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            @elseif($objContadorServicio->cantidad == 2)
                 <div class="row fila_infoBasica-formProf">
                    <div class="col-6">
                        <div class="col-12 pr-0">
                                <div class="form-group">
                                    <label for="title"> Título del servicio </label>
                                    <input class="col-lg-12 form-control" id="tituloServicios" placeholder="tituloServicios" type="text" name="tituloServicios[]" value="">
                                </div>
                            </div>

                            <div class="col-12 pr-0">
                                <div class="form-group">
                                    <label for="title"> Descripción y sede en la que está el servicio </label>
                                    <textarea class="col-lg-12 form-control" id="DescripcioServicios" placeholder="DescripcioServicios" name="DescripcioServicios[]" value=""></textarea>
                                </div>
                            </div>
                            <div class="col-12 pr-0">
                                <div class="form-group">
                                    <label for="title"> Sucursales </label>
                                    <div class="">
                                        <input class="col-lg-12 form-control" data-role="tagsinput" placeholder="tituloServicios" type="text" name="sucursalservicio[]" value="">
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="col-6">
                        <div class="col-12 pr-0">
                                <div class="form-group">
                                    <label for="title"> Título del servicio </label>
                                    <input class="col-lg-12 form-control" id="tituloServicios" placeholder="tituloServicios" type="text" name="tituloServicios[]" value="">
                                </div>
                            </div>

                            <div class="col-12 pr-0">
                                <div class="form-group">
                                    <label for="title"> Descripción y sede en la que está el servicio </label>
                                    <textarea class="col-lg-12 form-control" id="DescripcioServicios" placeholder="DescripcioServicios" name="DescripcioServicios[]" value=""></textarea>
                                </div>
                            </div>
                            <div class="col-12 pr-0">
                                <div class="form-group">
                                    <label for="title"> Sucursales </label>
                                    <div class="">
                                        <input class="col-lg-12 form-control"  data-role="tagsinput" placeholder="tituloServicios" type="text" name="sucursalservicio[]" value="">
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
                <div class="row fila_infoBasica-formProf">
                    <div class="col-6">
                        <div class="col-12 pr-0">
                                <div class="form-group">
                                    <label for="title"> Título del servicio </label>
                                    <input class="col-lg-12 form-control" id="tituloServicios" placeholder="tituloServicios" type="text" name="tituloServicios[]" value="">
                                </div>
                            </div>

                            <div class="col-12 pr-0">
                                <div class="form-group">
                                    <label for="title"> Descripción y sede en la que está el servicio </label>
                                    <textarea class="col-lg-12 form-control" id="DescripcioServicios" placeholder="DescripcioServicios" name="DescripcioServicios[]" value=""></textarea>
                                </div>
                            </div>
                            <div class="col-12 pr-0">
                                <div class="form-group">
                                    <label for="title"> Sucursales </label>
                                    <div class="">
                                    <input class="col-lg-12 form-control"  data-role="tagsinput" placeholder="tituloServicios" type="text" name="sucursalservicio[]" value="">
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="col-6">
                        <div class="col-12 pr-0">
                                <div class="form-group">
                                    <label for="title"> Título del servicio </label>
                                    <input class="col-lg-12 form-control" id="tituloServicios" placeholder="tituloServicios" type="text" name="tituloServicios[]" value="">
                                </div>
                            </div>

                            <div class="col-12 pr-0">
                                <div class="form-group">
                                    <label for="title"> Descripción y sede en la que está el servicio </label>
                                    <textarea class="col-lg-12 form-control" id="DescripcioServicios" placeholder="DescripcioServicios" name="DescripcioServicios[]" value=""></textarea>
                                </div>
                            </div>
                            <div class="col-12 pr-0">
                                <div class="form-group">
                                    <label for="title"> Sucursales </label>
                                    <div class="">
                                    <input class="col-lg-12 form-control"   data-role="tagsinput" placeholder="tituloServicios" type="text" name="sucursalservicio[]" value="">
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            @elseif($objContadorServicio->cantidad == 3)
                <div class="row fila_infoBasica-formProf">
                    <div class="col-6">
                        <div class="col-12 pr-0">
                                <div class="form-group">
                                    <label for="title"> Título del servicio </label>
                                    <input class="col-lg-12 form-control" id="tituloServicios" placeholder="tituloServicios" type="text" name="tituloServicios[]" value="">
                                </div>
                            </div>

                            <div class="col-12 pr-0">
                                <div class="form-group">
                                    <label for="title"> Descripción y sede en la que está el servicio </label>
                                    <textarea class="col-lg-12 form-control" id="DescripcioServicios" placeholder="DescripcioServicios" name="DescripcioServicios[]" value=""></textarea>
                                </div>
                            </div>
                            <div class="col-12 pr-0">
                                <div class="form-group">
                                    <label for="title"> Sucursales </label>
                                    <div class="">
                                        <input class="col-lg-12 form-control" data-role="tagsinput" placeholder="tituloServicios" type="text" name="sucursalservicio[]" value="">
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="col-6">
                        <div class="col-12 pr-0">
                                <div class="form-group">
                                    <label for="title"> Título del servicio </label>
                                    <input class="col-lg-12 form-control" id="tituloServicios" placeholder="tituloServicios" type="text" name="tituloServicios[]" value="">
                                </div>
                            </div>

                            <div class="col-12 pr-0">
                                <div class="form-group">
                                    <label for="title"> Descripción y sede en la que está el servicio </label>
                                    <textarea class="col-lg-12 form-control" id="DescripcioServicios" placeholder="DescripcioServicios" name="DescripcioServicios[]" value=""></textarea>
                                </div>
                            </div>
                            <div class="col-12 pr-0">
                                <div class="form-group">
                                    <label for="title"> Sucursales </label>
                                    <div class="">
                                        <input class="col-lg-12 form-control"  data-role="tagsinput" placeholder="tituloServicios" type="text" name="sucursalservicio[]" value="">
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
                <div class="row fila_infoBasica-formProf">
                    <div class="col-6">
                        <div class="col-12 pr-0">
                                <div class="form-group">
                                    <label for="title"> Título del servicio </label>
                                    <input class="col-lg-12 form-control" id="tituloServicios" placeholder="tituloServicios" type="text" name="tituloServicios[]" value="">
                                </div>
                            </div>

                            <div class="col-12 pr-0">
                                <div class="form-group">
                                    <label for="title"> Descripción y sede en la que está el servicio </label>
                                    <textarea class="col-lg-12 form-control" id="DescripcioServicios" placeholder="DescripcioServicios" name="DescripcioServicios[]" value=""></textarea>
                                </div>
                            </div>
                            <div class="col-12 pr-0">
                                <div class="form-group">
                                    <label for="title"> Sucursales </label>
                                    <div class="">
                                    <input class="col-lg-12 form-control"  data-role="tagsinput" placeholder="tituloServicios" type="text" name="sucursalservicio[]" value="">
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            @elseif($objContadorServicio->cantidad == 4)
                <div class="row fila_infoBasica-formProf">
                    <div class="col-6">
                        <div class="col-12 pr-0">
                                <div class="form-group">
                                    <label for="title"> Título del servicio </label>
                                    <input class="col-lg-12 form-control" id="tituloServicios" placeholder="tituloServicios" type="text" name="tituloServicios[]" value="">
                                </div>
                            </div>

                            <div class="col-12 pr-0">
                                <div class="form-group">
                                    <label for="title"> Descripción y sede en la que está el servicio </label>
                                    <textarea class="col-lg-12 form-control" id="DescripcioServicios" placeholder="DescripcioServicios" name="DescripcioServicios[]" value=""></textarea>
                                </div>
                            </div>
                            <div class="col-12 pr-0">
                                <div class="form-group">
                                    <label for="title"> Sucursales </label>
                                    <div class="">
                                        <input class="col-lg-12 form-control" data-role="tagsinput" placeholder="tituloServicios" type="text" name="sucursalservicio[]" value="">
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="col-6">
                        <div class="col-12 pr-0">
                                <div class="form-group">
                                    <label for="title"> Título del servicio </label>
                                    <input class="col-lg-12 form-control" id="tituloServicios" placeholder="tituloServicios" type="text" name="tituloServicios[]" value="">
                                </div>
                            </div>

                            <div class="col-12 pr-0">
                                <div class="form-group">
                                    <label for="title"> Descripción y sede en la que está el servicio </label>
                                    <textarea class="col-lg-12 form-control" id="DescripcioServicios" placeholder="DescripcioServicios" name="DescripcioServicios[]" value=""></textarea>
                                </div>
                            </div>
                            <div class="col-12 pr-0">
                                <div class="form-group">
                                    <label for="title"> Sucursales </label>
                                    <div class="">
                                        <input class="col-lg-12 form-control"  data-role="tagsinput" placeholder="tituloServicios" type="text" name="sucursalservicio[]" value="">
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            @elseif($objContadorServicio->cantidad == 5)
                <div class="row fila_infoBasica-formProf">
                    <div class="col-6">
                        <div class="col-12 pr-0">
                                <div class="form-group">
                                    <label for="title"> Título del servicio </label>
                                    <input class="col-lg-12 form-control" id="tituloServicios" placeholder="tituloServicios" type="text" name="tituloServicios[]" value="">
                                </div>
                            </div>

                            <div class="col-12 pr-0">
                                <div class="form-group">
                                    <label for="title"> Descripción y sede en la que está el servicio </label>
                                    <textarea class="col-lg-12 form-control" id="DescripcioServicios" placeholder="DescripcioServicios" name="DescripcioServicios[]" value=""></textarea>
                                </div>
                            </div>
                            <div class="col-12 pr-0">
                                <div class="form-group">
                                    <label for="title"> Sucursales </label>
                                    <div class="">
                                        <input class="col-lg-12 form-control" data-role="tagsinput" placeholder="tituloServicios" type="text" name="sucursalservicio[]" value="">
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            @elseif($objContadorServicio->cantidad == 6)
            <span>No se pueden agtregar mas </span>
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
    <h5 class="col-lg-12 icon_infoBasica-formProf"> ¿Quiénes somos? </h5>

    <form method="POST" action="{{ url ('/FormularioInstitucionSave5') }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8">
        <input type="hidden" name="_token" value="{{ csrf_token() }}"> 

        @if(!empty($objFormulario))
            <div class="col-12 pr-0">
                <div class="form-group">
                    <label for="title"> Escriba una breve descripción de ¿Quiénes son? </label>

                    <textarea class="form-control" id="descripcionPerfil"  type="text" name="quienessomos" >{{$objFormulario->quienessomos}}</textarea>
                </div>
            </div>
        @else
            <div class="col-12 pr-0">
                <div class="form-group">
                    <label for="title">  Escriba una breve descripción de ¿Quiénes son? </label>

                    <textarea class="form-control" id="descripcionPerfil"  type="text" name="quienessomos" ></textarea>
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
<!--------------------------------------------Fin quinta parte del formulario------------------------------------------------>

<!--------------------------------------------Inicio sexta parte del formulario------------------------------------------------> 
<div class="col-lg-10 pb-3 infoBasica_formProf">
    <h5 class="col-lg-12 icon_infoBasica-formProf">Propuesta de valor </h5>

    <form method="POST" action="{{ url ('/FormularioInstitucionSave5') }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8">
        <input type="hidden" name="_token" value="{{ csrf_token() }}"> 

        @if(!empty($objFormulario))
            <div class="col-12 pr-0">
                <div class="form-group">
                    <label for="title"> Escriba una breve descripción de la propuesta de valor </label>

                    <textarea class="form-control" id="descripcionPerfil"  type="text" name="propuestavalor" >{{$objFormulario->propuestavalor}}</textarea>
                </div>
            </div>
        @else
            <div class="col-12 pr-0">
                <div class="form-group">
                    <label for="title">  Escriba una breve descripción de la propuesta de valor </label>

                    <textarea class="form-control" id="descripcionPerfil"  type="text" name="propuestavalor" ></textarea>
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
<!--------------------------------------------Fin sexta parte del formulario------------------------------------------------>

<!--------------------------------------------Inicio septima parte del formulario------------------------------------------------>
<div class="col-12 row">

    <div class="col-12">
        <div class="col-6">
           <input type='file' id="imgasocia1" name="imgasociacion[]"/>
        </div>
        <div class="col-6">
          <input type='file' id="imgasocia1" name="imgasociacion[]"/>
        </div>
        <div class="col-6">
           <input type='file' id="imgasocia1" name="imgasociacion[]"/>
        </div>
        <div class="col-6">
          <input type='file' id="imgasocia1" name="imgasociacion[]"/>
        </div>
    </div>

</div>
<!--------------------------------------------Fin septima parte del formulario------------------------------------------------> 

@endsection