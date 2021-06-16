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

    <form method="POST" action="{{ url ('/FormularioInstitucionSave6') }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8">
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
<div class="col-lg-10 pb-3 infoBasica_formProf">
       <h5 class="col-lg-12 icon_infoBasica-formProf">Convenios</h5>
        <div class="col-12 row">

                @foreach($objEps as $objEps)
                    @if(!empty($objEps->urlimagen))
                    <img id="imagenPrevisualizacion" class="img_usuario-formProf" src="{{URL::asset($objEps->urlimagen)}}">
                    <a href="{{url('/FormularioInstituciondelete5/'.$objEps->id)}}">
                        <button type="submit" class="close" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </a>   
                    @endif
                @endforeach
                @foreach($objIps as $objIps)
                    @if(!empty($objIps->urlimagen))
                    <img id="imagenPrevisualizacion" class="img_usuario-formProf" src="{{URL::asset($objIps->urlimagen)}}">
                    <a href="{{url('/FormularioInstituciondelete6/'.$objIps->id)}}">
                        <button type="submit" class="close" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </a>   
                    @endif
                @endforeach
                @foreach($objPrepa as $objPrepa)
                    @if(!empty($objPrepa->urlimagen))
                    <img id="imagenPrevisualizacion" class="img_usuario-formProf" src="{{URL::asset($objPrepa->urlimagen)}}">
                    <a href="{{url('/FormularioInstituciondelete7/'.$objPrepa->id_prepagada)}}">
                        <button type="submit" class="close" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </a>   
                    @endif
                @endforeach
        </div>
    <form method="POST" action="{{ url ('/FormularioInstitucionSave7') }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8">
        <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
            <div class="col-12 row">
            <!--formulario eps-->
            @if($objContadorEps->cantidad == 0)
                    <div class="col-12">
                        <label for="title">  Suba imágenes con respecto a los convenios que tengan con las EPS </label>
                        <div class="col-6">
                        <input type='file' id="urlimagen" name="urlimagenEps[]"/>
                        </div>
                        <div class="col-6">
                        <input type='file' id="urlimagen" name="urlimagenEps[]"/>
                        </div>
                        <div class="col-6">
                        <input type='file' id="urlimagen" name="urlimagenEps[]"/>
                        </div>
                        <div class="col-6">
                        <input type='file' id="urlimagen" name="urlimagenEps[]"/>
                        </div>
                    </div>
            @elseif($objContadorEps->cantidad == 1)
                    <div class="col-12">
                        <label for="title">  Suba imágenes con respecto a los convenios que tengan con las EPS </label>
                        <div class="col-6">
                        <input type='file' id="urlimagen" name="urlimagenEps[]"/>
                        </div>
                        <div class="col-6">
                        <input type='file' id="urlimagen" name="urlimagenEps[]"/>
                        </div>
                        <div class="col-6">
                        <input type='file' id="urlimagen" name="urlimagenEps[]"/>
                        </div>
                    </div>
            @elseif($objContadorEps->cantidad == 2)
                    <div class="col-12">
                        <label for="title">  Suba imágenes con respecto a los convenios que tengan con las EPS </label>
                        <div class="col-6">
                          <input type='file' id="urlimagen" name="urlimagenEps[]"/>
                        </div>
                        <div class="col-6">
                          <input type='file' id="urlimagen" name="urlimagenEps[]"/>
                        </div>
                    </div>
            @elseif($objContadorEps->cantidad == 3)
                    <div class="col-12">
                        <label for="title">  Suba imágenes con respecto a los convenios que tengan con las EPS </label>
                        <div class="col-6">
                          <input type='file' id="urlimagen" name="urlimagenEps[]"/>
                        </div>
                    </div>
            @elseif($objContadorEps->cantidad == 4)
            <span>No se pueden agregar mas </span>
            @endif
            <!--formulario ips-->
            @if($objContadorIps->cantidad == 0)
                    <div class="col-12">
                        <label for="title">  Suba imágenes con respecto a los convenios que tengan con las IPS </label>
                        <div class="col-6">
                        <input type='file' id="imgasocia1" name="urlimagenIps[]"/>
                        </div>
                        <div class="col-6">
                        <input type='file' id="imgasocia1" name="urlimagenIps[]"/>
                        </div>
                        <div class="col-6">
                        <input type='file' id="imgasocia1" name="urlimagenIps[]"/>
                        </div>
                        <div class="col-6">
                        <input type='file' id="imgasocia1" name="urlimagenIps[]"/>
                        </div>
                    </div>
            @elseif($objContadorIps->cantidad == 1)
                    <div class="col-12">
                        <label for="title">  Suba imágenes con respecto a los convenios que tengan con las IPS </label>
                        <div class="col-6">
                          <input type='file' id="imgasocia1" name="urlimagenIps[]"/>
                        </div>
                        <div class="col-6">
                          <input type='file' id="imgasocia1" name="urlimagenIps[]"/>
                        </div>
                        <div class="col-6">
                          <input type='file' id="imgasocia1" name="urlimagenIps[]"/>
                        </div>
                    </div>
            @elseif($objContadorIps->cantidad == 2)
                    <div class="col-12">
                        <label for="title">  Suba imágenes con respecto a los convenios que tengan con las IPS </label>
                        <div class="col-6">
                          <input type='file' id="imgasocia1" name="urlimagenIps[]"/>
                        </div>
                        <div class="col-6">
                          <input type='file' id="imgasocia1" name="urlimagenIps[]"/>
                        </div>
                    </div>
            @elseif($objContadorIps->cantidad == 3)
                    <div class="col-12">
                        <label for="title">  Suba imágenes con respecto a los convenios que tengan con las IPS </label>
                        <div class="col-6">
                          <input type='file' id="imgasocia1" name="urlimagenIps[]"/>
                        </div>
                    </div>
            @elseif($objContadorIps->cantidad == 4)
                    <span>No se pueden agregar mas </span>
            @endif

            <!--formulario prepagada-->
            @if($objContadorIps->cantidad == 0)
                    <div class="col-12">
                        <label for="title">  Suba imágenes con respecto a los convenios que tengan con Medicina Prepagada</label>
                        <div class="col-6">
                          <input type='file' id="imgasocia1" name="urlimagenPre[]"/>
                        </div>
                        <div class="col-6">
                          <input type='file' id="imgasocia1" name="urlimagenPre[]"/>
                        </div>
                        <div class="col-6">
                          <input type='file' id="imgasocia1" name="urlimagenPre[]"/>
                        </div>
                        <div class="col-6">
                          <input type='file' id="imgasocia1" name="urlimagenPre[]"/>
                        </div>
                    </div>
            @elseif($objContadorIps->cantidad == 1)
                    <div class="col-12">
                        <label for="title">  Suba imágenes con respecto a los convenios que tengan con Medicina Prepagada</label>
                        <div class="col-6">
                          <input type='file' id="imgasocia1" name="urlimagenPre[]"/>
                        </div>
                        <div class="col-6">
                          <input type='file' id="imgasocia1" name="urlimagenPre[]"/>
                        </div>
                        <div class="col-6">
                          <input type='file' id="imgasocia1" name="urlimagenPre[]"/>
                        </div>
                    </div>
            @elseif($objContadorIps->cantidad == 2)
                    <div class="col-12">
                        <label for="title">  Suba imágenes con respecto a los convenios que tengan con Medicina Prepagada</label>
                        <div class="col-6">
                          <input type='file' id="imgasocia1" name="urlimagenPre[]"/>
                        </div>
                        <div class="col-6">
                          <input type='file' id="imgasocia1" name="urlimagenPre[]"/>
                        </div>
                    </div>
            @elseif($objContadorIps->cantidad == 3)
                    <div class="col-12">
                        <label for="title">  Suba imágenes con respecto a los convenios que tengan con Medicina Prepagada</label>
                        <div class="col-6">
                          <input type='file' id="imgasocia1" name="urlimagenPre[]"/>
                        </div>
                    </div>
            @elseif($objContadorIps->cantidad == 4)
                    <span>No se pueden agregar mas </span>
            @endif
            </div>
            <div class="col-lg-12 content_btnEnviar-formProf">
            <button type="submit" class="btn2_enviar-formProf"> Guardar
                <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flecha_ingreso-membresia" alt=""> 
            </button>
        </div>
    </form>
</div>
<!--------------------------------------------Fin septima parte del formulario------------------------------------------------> 


<!--------------------------------------------Inicio octava parte del formulario------------------------------------------------>
<div class="col-lg-10 pb-3 infoBasica_formProf">
       <h5 class="col-lg-12 icon_infoBasica-formProf">Profesionales </h5>
        <div class="col-12 row">
                @foreach($objProfeInsti as $objProfeInsti)
                    @if(!empty($objProfeInsti->foto_perfil_institucion))
                    <img id="imagenPrevisualizacion" class="img_usuario-formProf" src="{{URL::asset($objProfeInsti->foto_perfil_institucion)}}">
                    <span>{{$objProfeInsti->primer_nombre}} {{$objProfeInsti->segundo_nombre}} {{$objProfeInsti->primer_apellido}} {{$objProfeInsti->segundo_apellido}}</span>
                    <span>{{$objProfeInsti->especialidad_uno}} {{$objProfeInsti->especialidad_dos}}</span>
                    <a href="{{url('/FormularioInstituciondelete8/'.$objProfeInsti->id_profesional_inst)}}">
                        <button type="submit" class="close" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </a>   
                    @endif
                @endforeach
        </div>
        <form method="POST" action="{{ url ('/FormularioInstitucionSave8') }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8">
            <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
            @if($objContadorProfeInsti->cantidad == 0)
                <div class="col-12 row">
                    <div class="col-2">
                        <input type='file' id="imgasocia1" name="foto_perfil_institucion[]"/>
                    </div>
                    <div class="col-10 row">
                            <label for="title"> Primer nombre </label>
                            <input class="col-2 form-control" type="text" name="primer_nombre[]" value="">
                            <label for="title"> Segundo Nombre </label>
                            <input class="col-2 form-control"   type="text" name="segundo_nombre[]" value="">
                            <label for="title"> Primer apellido </label>
                            <input class="col-2 form-control"   type="text" name="primer_apellido[]" value="">
                            <label for="title"> Segundo apellido </label>
                            <input class="col-2 form-control"   type="text" name="segundo_apellido[]" value="">
                            <label for="title"> Especialidades </label>
                            <input class="col-12 form-control"   type="text" name="especialidad_uno[]" value="">
                            <label for="title"> Especialidades </label>
                            <input class="col-12 form-control"   type="text" name="especialidad_dos[]" value="">
                    </div>
                </div> 
                <div class="col-12 row">
                    <div class="col-2">
                        <input type='file' id="imgasocia1" name="foto_perfil_institucion[]"/>
                    </div>
                    <div class="col-10 row">
                            <label for="title"> Primer nombre </label>
                            <input class="col-2 form-control" type="text" name="primer_nombre[]" value="">
                            <label for="title"> Segundo Nombre </label>
                            <input class="col-2 form-control"   type="text" name="segundo_nombre[]" value="">
                            <label for="title"> Primer apellido </label>
                            <input class="col-2 form-control"   type="text" name="primer_apellido[]" value="">
                            <label for="title"> Segundo apellido </label>
                            <input class="col-2 form-control"   type="text" name="segundo_apellido[]" value="">
                            <label for="title"> Especialidades </label>
                            <input class="col-12 form-control"   type="text" name="especialidad_uno[]" value="">
                            <label for="title"> Especialidades </label>
                            <input class="col-12 form-control"   type="text" name="especialidad_dos[]" value="">
                    </div>
                </div> 
                <div class="col-12 row">
                    <div class="col-2">
                        <input type='file' id="imgasocia1" name="foto_perfil_institucion[]"/>
                    </div>
                    <div class="col-10 row">
                            <label for="title"> Primer nombre </label>
                            <input class="col-2 form-control" type="text" name="primer_nombre[]" value="">
                            <label for="title"> Segundo Nombre </label>
                            <input class="col-2 form-control"   type="text" name="segundo_nombre[]" value="">
                            <label for="title"> Primer apellido </label>
                            <input class="col-2 form-control"   type="text" name="primer_apellido[]" value="">
                            <label for="title"> Segundo apellido </label>
                            <input class="col-2 form-control"   type="text" name="segundo_apellido[]" value="">
                            <label for="title"> Especialidades </label>
                            <input class="col-12 form-control"   type="text" name="especialidad_uno[]" value="">
                            <label for="title"> Especialidades </label>
                            <input class="col-12 form-control"   type="text" name="especialidad_dos[]" value="">
                    </div>
                </div> 
            @elseif($objContadorProfeInsti->cantidad == 1)
                <div class="col-12 row">
                    <div class="col-2">
                        <input type='file' id="imgasocia1" name="foto_perfil_institucion[]"/>
                    </div>
                    <div class="col-10 row">
                            <label for="title"> Primer nombre </label>
                            <input class="col-2 form-control" type="text" name="primer_nombre[]" value="">
                            <label for="title"> Segundo Nombre </label>
                            <input class="col-2 form-control"   type="text" name="segundo_nombre[]" value="">
                            <label for="title"> Primer apellido </label>
                            <input class="col-2 form-control"   type="text" name="primer_apellido[]" value="">
                            <label for="title"> Segundo apellido </label>
                            <input class="col-2 form-control"   type="text" name="segundo_apellido[]" value="">
                            <label for="title"> Especialidades </label>
                            <input class="col-12 form-control"   type="text" name="especialidad_uno[]" value="">
                            <label for="title"> Especialidades </label>
                            <input class="col-12 form-control"   type="text" name="especialidad_dos[]" value="">
                    </div>
                </div> 
                <div class="col-12 row">
                    <div class="col-2">
                        <input type='file' id="imgasocia1" name="foto_perfil_institucion[]"/>
                    </div>
                    <div class="col-10 row">
                            <label for="title"> Primer nombre </label>
                            <input class="col-2 form-control" type="text" name="primer_nombre[]" value="">
                            <label for="title"> Segundo Nombre </label>
                            <input class="col-2 form-control"   type="text" name="segundo_nombre[]" value="">
                            <label for="title"> Primer apellido </label>
                            <input class="col-2 form-control"   type="text" name="primer_apellido[]" value="">
                            <label for="title"> Segundo apellido </label>
                            <input class="col-2 form-control"   type="text" name="segundo_apellido[]" value="">
                            <label for="title"> Especialidades </label>
                            <input class="col-12 form-control"   type="text" name="especialidad_uno[]" value="">
                            <label for="title"> Especialidades </label>
                            <input class="col-12 form-control"   type="text" name="especialidad_dos[]" value="">
                    </div>
                </div>  
            @elseif($objContadorProfeInsti->cantidad == 2)
                <div class="col-12 row">
                    <div class="col-2">
                        <input type='file' id="imgasocia1" name="foto_perfil_institucion[]"/>
                    </div>
                    <div class="col-10 row">
                            <label for="title"> Primer nombre </label>
                            <input class="col-2 form-control" type="text" name="primer_nombre[]" value="">
                            <label for="title"> Segundo Nombre </label>
                            <input class="col-2 form-control"   type="text" name="segundo_nombre[]" value="">
                            <label for="title"> Primer apellido </label>
                            <input class="col-2 form-control"   type="text" name="primer_apellido[]" value="">
                            <label for="title"> Segundo apellido </label>
                            <input class="col-2 form-control"   type="text" name="segundo_apellido[]" value="">
                            <label for="title"> Especialidades </label>
                            <input class="col-12 form-control"   type="text" name="especialidad_uno[]" value="">
                            <label for="title"> Especialidades </label>
                            <input class="col-12 form-control"   type="text" name="especialidad_dos[]" value="">
                    </div>
                </div>  
            @elseif($objContadorProfeInsti->cantidad == 3)
            <span>No se peden agregar mas</span>
            @endif
 
 

           <div class="col-lg-12 content_btnEnviar-formProf">
            <button type="submit" class="btn2_enviar-formProf"> Guardar
                <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flecha_ingreso-membresia" alt=""> 
            </button>
        </div>
        </form>
</div>
<!--------------------------------------------Fin octava parte del formulario------------------------------------------------>

<!--------------------------------------------   Inicio novena parte del formulario ------------------------------------------------>
<div class="col-lg-10 pb-3 infoBasica_formProf">
    <h5 class="col-lg-12 icon_infoBasica-formProf"> Certificaciones </h5>

    <p class="text_superior-proced-formProf"> A continuación suba imágenes relacionadas con sus certificaciones, con fecha, nombre y descripción. </p>

    <!-- Modulo de los Certificaciones con información -->
    <div class="row col-12 p-0 m-0">
        @foreach($objCertificaciones as $objCertificaciones)
            @if(!empty($objCertificaciones->imgcertificado))
                <!-- Contenido Certificaciones -->    
                <div class="col-6 mt-3 content_antes-formProf">
                    <div class="col-12">
                        <a href="{{url('/FormularioInstituciondelete9/'.$objCertificaciones->id_certificacion)}}">
                            <button type="submit" class="close" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </a>
                    </div>
                    
                    <div class="col-12 content_agregarImg-formProf form-group">

                        <div class="col-10 img_selccionada-formProf">
                            <img  src="{{URL::asset($objCertificaciones->imgcertificado)}}">
                        </div>

                        <div class="col-12 pl-0">
                            <div class="form-group">
                                <span>{{$objCertificaciones->titulocertificado}}</span>
                            </div>
                        </div>

                        <div class="col-12 pl-0">
                            <div class="form-group">
                                <span>{{$objCertificaciones->descrpcioncertificado}}</span>
                            </div>
                        </div>

                        <div class="col-12 pl-0">
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
            <div class="row content_antDesp-formProf">
                <!-- Contenido Certificaciones izquierdo -->
                <div class="col-6 content_antes-formProf">
                    <div class="col-12 pl-0 content_agregarImg-formProf form-group">
                        <div class="col-10 img_selccionada-formProf">
                            <div class="img_anexada-formProf" id="previewates"></div>
                        </div>

                        <div class="agregar_archivo-formProf">
                            <input type='file' id="imgantes" name="imgcertificado[]"/>
                        </div>
                    </div>

                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="example-date-input" class="col-form-label">Fecha de inicio</label>
                        
                            <input class="form-control" type="date"  id="fechacertificado" name="fechacertificado[]" value="">
                        </div>
                    </div>

                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">titulo premio</label>

                            <input class="form-control" id="titulocertificado"  type="text" name="titulocertificado[]" value="">
                        </div>
                    </div>

                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Descrpcion premio</label>
                            
                            <input class="form-control" id="descrpcioncertificado"  type="text" name="descrpcioncertificado[]" value="">
                        </div>
                    </div>
                </div>

                <!-- Contenido Certificaciones derecho -->
                <div class="col-6 pr-0">
                    <div class="col-12 content_agregarImg-formProf form-group">
                        <div class="form-group col-12 ">
                            <div class="col-10 img_selccionada-formProf">
                                <div class="img_anexada-formProf" id="previewates"></div>
                            </div>

                            <div class="agregar_archivo-formProf">
                                <input type='file' id="imgantes" name="imgcertificado[]"/>
                            </div>
                        </div>

                        <div class="col-12 pr-0">
                            <label for="example-date-input" class="col-form-label">Fecha de inicio</label>
                            
                            <input class="form-control" type="date"  id="fechacertificado" name="fechacertificado[]" value="">
                        </div>

                        <div class="col-12 pr-0">
                            <div class="form-group">
                                <label for="title">titulo premio</label>

                                <input class="form-control" id="titulocertificado"  type="text" name="titulocertificado[]" value="">
                            </div>
                        </div>

                        <div class="col-12 pr-0">
                            <div class="form-group">
                                <label for="title">Descrpcion premio</label>

                                <input class="form-control" id="descrpcioncertificado"  type="text" name="descrpcioncertificado[]" value="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modulo de los Certificaciones sin información-->
            <div class="row content_antDesp-formProf">
                <!-- Contenido Certificaciones izquierdo -->
                <div class="col-6 content_antes-formProf">
                    <div class="col-12 pl-0 content_agregarImg-formProf form-group">
                        <div class="col-10 img_selccionada-formProf">
                            <div class="img_anexada-formProf" id="previewates"></div>
                        </div>

                        <div class="agregar_archivo-formProf">
                            <input type='file' id="imgantes" name="imgcertificado[]"/>
                        </div>
                    </div>

                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="example-date-input" class="col-form-label">Fecha de inicio</label>
                        
                            <input class="form-control" type="date"  id="fechacertificado" name="fechacertificado[]" value="">
                        </div>
                    </div>

                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">titulo premio</label>

                            <input class="form-control" id="titulocertificado"  type="text" name="titulocertificado[]" value="">
                        </div>
                    </div>

                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Descrpcion premio</label>
                            
                            <input class="form-control" id="descrpcioncertificado"  type="text" name="descrpcioncertificado[]" value="">
                        </div>
                    </div>
                </div>

                <!-- Contenido Certificaciones derecho -->
                <div class="col-6 pr-0">
                    <div class="col-12 content_agregarImg-formProf form-group">
                        <div class="form-group col-12 ">
                            <div class="col-10 img_selccionada-formProf">
                                <div class="img_anexada-formProf" id="previewates"></div>
                            </div>

                            <div class="agregar_archivo-formProf">
                                <input type='file' id="imgantes" name="imgcertificado[]"/>
                            </div>
                        </div>

                        <div class="col-12 pr-0">
                            <label for="example-date-input" class="col-form-label">Fecha de inicio</label>
                            
                            <input class="form-control" type="date"  id="fechacertificado" name="fechacertificado[]" value="">
                        </div>

                        <div class="col-12 pr-0">
                            <div class="form-group">
                                <label for="title">titulo premio</label>

                                <input class="form-control" id="titulocertificado"  type="text" name="titulocertificado[]" value="">
                            </div>
                        </div>

                        <div class="col-12 pr-0">
                            <div class="form-group">
                                <label for="title">Descrpcion premio</label>

                                <input class="form-control" id="descrpcioncertificado"  type="text" name="descrpcioncertificado[]" value="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @elseif($objContadorCertificaciones->cantidad == 1)
            <!-- Modulo de los Certificaciones sin información-->
            <div class="row content_antDesp-formProf">
                <!-- Contenido Certificaciones izquierdo -->
                <div class="col-6 content_antes-formProf">
                    <div class="col-12 pl-0 content_agregarImg-formProf form-group">
                        <div class="col-10 img_selccionada-formProf">
                            <div class="img_anexada-formProf" id="previewates"></div>
                        </div>

                        <div class="agregar_archivo-formProf">
                            <input type='file' id="imgantes" name="imgcertificado[]"/>
                        </div>
                    </div>

                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="example-date-input" class="col-form-label">Fecha de inicio</label>
                        
                            <input class="form-control" type="date"  id="fechacertificado" name="fechacertificado[]" value="">
                        </div>
                    </div>

                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">titulo premio</label>

                            <input class="form-control" id="titulocertificado"  type="text" name="titulocertificado[]" value="">
                        </div>
                    </div>

                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Descrpcion premio</label>
                            
                            <input class="form-control" id="descrpcioncertificado"  type="text" name="descrpcioncertificado[]" value="">
                        </div>
                    </div>
                </div>

                <!-- Contenido Certificaciones derecho -->
                <div class="col-6 pr-0">
                    <div class="col-12 content_agregarImg-formProf form-group">
                        <div class="form-group col-12 ">
                            <div class="col-10 img_selccionada-formProf">
                                <div class="img_anexada-formProf" id="previewates"></div>
                            </div>

                            <div class="agregar_archivo-formProf">
                                <input type='file' id="imgantes" name="imgcertificado[]"/>
                            </div>
                        </div>

                        <div class="col-12 pr-0">
                            <label for="example-date-input" class="col-form-label">Fecha de inicio</label>
                            
                            <input class="form-control" type="date"  id="fechacertificado" name="fechacertificado[]" value="">
                        </div>

                        <div class="col-12 pr-0">
                            <div class="form-group">
                                <label for="title">titulo premio</label>

                                <input class="form-control" id="titulocertificado"  type="text" name="titulocertificado[]" value="">
                            </div>
                        </div>

                        <div class="col-12 pr-0">
                            <div class="form-group">
                                <label for="title">Descrpcion premio</label>

                                <input class="form-control" id="descrpcioncertificado"  type="text" name="descrpcioncertificado[]" value="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modulo de los Certificaciones sin información-->
            <div class="row content_antDesp-formProf">
                <!-- Contenido Certificaciones izquierdo -->
                <div class="col-6 content_antes-formProf">
                    <div class="col-12 pl-0 content_agregarImg-formProf form-group">
                        <div class="col-10 img_selccionada-formProf">
                            <div class="img_anexada-formProf" id="previewates"></div>
                        </div>

                        <div class="agregar_archivo-formProf">
                            <input type='file' id="imgantes" name="imgcertificado[]"/>
                        </div>
                    </div>

                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="example-date-input" class="col-form-label">Fecha de inicio</label>
                        
                            <input class="form-control" type="date"  id="fechacertificado" name="fechacertificado[]" value="">
                        </div>
                    </div>

                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">titulo premio</label>

                            <input class="form-control" id="titulocertificado"  type="text" name="titulocertificado[]" value="">
                        </div>
                    </div>

                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Descrpcion premio</label>
                            
                            <input class="form-control" id="descrpcioncertificado"  type="text" name="descrpcioncertificado[]" value="">
                        </div>
                    </div>
                </div>
            </div>
        @elseif($objContadorCertificaciones->cantidad == 2)
            <!-- Modulo de los Certificaciones sin información-->
            <div class="row content_antDesp-formProf">
                <!-- Contenido Certificaciones izquierdo -->
                <div class="col-6 content_antes-formProf">
                    <div class="col-12 pl-0 content_agregarImg-formProf form-group">
                        <div class="col-10 img_selccionada-formProf">
                            <div class="img_anexada-formProf" id="previewates"></div>
                        </div>

                        <div class="agregar_archivo-formProf">
                            <input type='file' id="imgantes" name="imgcertificado[]"/>
                        </div>
                    </div>

                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="example-date-input" class="col-form-label">Fecha de inicio</label>
                        
                            <input class="form-control" type="date"  id="fechacertificado" name="fechacertificado[]" value="">
                        </div>
                    </div>

                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">titulo premio</label>

                            <input class="form-control" id="titulocertificado"  type="text" name="titulocertificado[]" value="">
                        </div>
                    </div>

                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Descrpcion premio</label>
                            
                            <input class="form-control" id="descrpcioncertificado"  type="text" name="descrpcioncertificado[]" value="">
                        </div>
                    </div>
                </div>

                <!-- Contenido Certificaciones derecho -->
                <div class="col-6 pr-0">
                    <div class="col-12 content_agregarImg-formProf form-group">
                        <div class="form-group col-12 ">
                            <div class="col-10 img_selccionada-formProf">
                                <div class="img_anexada-formProf" id="previewates"></div>
                            </div>

                            <div class="agregar_archivo-formProf">
                                <input type='file' id="imgantes" name="imgcertificado[]"/>
                            </div>
                        </div>

                        <div class="col-12 pr-0">
                            <label for="example-date-input" class="col-form-label">Fecha de inicio</label>
                            
                            <input class="form-control" type="date"  id="fechacertificado" name="fechacertificado[]" value="">
                        </div>

                        <div class="col-12 pr-0">
                            <div class="form-group">
                                <label for="title">titulo premio</label>

                                <input class="form-control" id="titulocertificado"  type="text" name="titulocertificado[]" value="">
                            </div>
                        </div>

                        <div class="col-12 pr-0">
                            <div class="form-group">
                                <label for="title">Descrpcion premio</label>

                                <input class="form-control" id="descrpcioncertificado"  type="text" name="descrpcioncertificado[]" value="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @elseif($objContadorCertificaciones->cantidad == 3)
            <!-- Modulo de los Certificaciones sin información-->
            <div class="row content_antDesp-formProf">
                <!-- Contenido Certificaciones izquierdo -->
                <div class="col-6 content_antes-formProf">
                    <div class="col-12 pl-0 content_agregarImg-formProf form-group">
                        <div class="col-10 img_selccionada-formProf">
                            <div class="img_anexada-formProf" id="previewates"></div>
                        </div>

                        <div class="agregar_archivo-formProf">
                            <input type='file' id="imgantes" name="imgcertificado[]"/>
                        </div>
                    </div>

                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="example-date-input" class="col-form-label">Fecha de inicio</label>
                        
                            <input class="form-control" type="date"  id="fechacertificado" name="fechacertificado[]" value="">
                        </div>
                    </div>

                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">titulo premio</label>

                            <input class="form-control" id="titulocertificado"  type="text" name="titulocertificado[]" value="">
                        </div>
                    </div>

                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Descrpcion premio</label>
                            
                            <input class="form-control" id="descrpcioncertificado"  type="text" name="descrpcioncertificado[]" value="">
                        </div>
                    </div>
                </div>
            </div>
        @elseif($objContadorCertificaciones->cantidad == 4)
            <span> No se puede agregar más </span>
        @endif 

        <div class="col-lg-12 content_btnEnviar-formProf">
            <button type="submit" class="btn2_enviar-formProf"> Guardar
                <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flecha_ingreso-membresia" alt=""> 
            </button>
        </div>
    </form>
</div>
<!--------------------------------------------      Fin novena parte del formulario  ------------------------------------------------>

<!--------------------------------------------      Inicio decima parte del formulario ------------------------------------------------>
<div class="col-lg-10 pb-3 infoBasica_formProf">
    <h5 class="col-lg-12 icon_infoBasica-formProf"> Sedes </h5>

    <p class="text_superior-proced-formProf"> A continuación suba imágenes e información de las sedes que tengan de la institución </p>

    <!-- Modulo de los Certificaciones con información -->
    <div class="row col-12 p-0 m-0">
        @foreach($objSedes as $objSedes)
            @if(!empty($objSedes->imgsede))
                <!-- Contenido Certificaciones -->    
                <div class="col-6 mt-3 content_antes-formProf">
                    <div class="col-12">
                        <a href="{{url('/FormularioInstituciondelete10/'.$objSedes->id)}}">
                            <button type="submit" class="close" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </a>
                    </div>
                    
                    <div class="col-12 content_agregarImg-formProf form-group">

                        <div class="col-10 img_selccionada-formProf">
                            <img  src="{{URL::asset($objSedes->imgsede)}}">
                        </div>

                        <div class="col-12 pl-0">
                            <div class="form-group">
                                <span>{{$objSedes->nombre}}</span>
                            </div>
                        </div>

                        <div class="col-12 pl-0">
                            <div class="form-group">
                                <span>{{$objSedes->direccion}}</span>
                            </div>
                        </div>

                        <div class="col-12 pl-0">
                            <div class="form-group">
                                <span>{{$objSedes->horario_sede}}</span>
                            </div>
                        </div>
                        <div class="col-12 pl-0">
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
            <!-- Modulo de los Certificaciones sin información-->
            <div class="row content_antDesp-formProf">
                <!-- Contenido Certificaciones izquierdo -->
                <div class="col-6 content_antes-formProf">
                    <div class="col-12 pl-0 content_agregarImg-formProf form-group">
                        <div class="col-10 img_selccionada-formProf">
                            <div class="img_anexada-formProf" id="previewates"></div>
                        </div>

                        <div class="agregar_archivo-formProf">
                            <input type='file' id="imgsede" name="imgsede[]"/>
                        </div>
                    </div>

                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Nombre de la sede</label>

                            <input class="form-control" id="nombre"  type="text" name="nombre[]" value="">
                        </div>
                    </div>
                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Dirrección</label>
                            
                            <input class="form-control" id="direccion"  type="text" name="direccion[]" value="">
                        </div>
                    </div>
                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Horario</label>
                            
                            <input class="form-control" id="horario_sede"  type="text" name="horario_sede[]" value="">
                        </div>
                    </div>
                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Teléfono</label>
                            
                            <input class="form-control" id="telefono"  type="text" name="telefono[]" value="">
                        </div>
                    </div>
                </div>

                <!-- Contenido Certificaciones derecho -->
                <div class="col-6 pr-0">
                    <div class="col-12 pl-0 content_agregarImg-formProf form-group">
                        <div class="col-10 img_selccionada-formProf">
                            <div class="img_anexada-formProf" id="previewates"></div>
                        </div>

                        <div class="agregar_archivo-formProf">
                            <input type='file' id="imgsede" name="imgsede[]"/>
                        </div>
                    </div>

                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Nombre de la sede</label>

                            <input class="form-control" id="nombre"  type="text" name="nombre[]" value="">
                        </div>
                    </div>
                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Dirrección</label>
                            
                            <input class="form-control" id="direccion"  type="text" name="direccion[]" value="">
                        </div>
                    </div>
                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Horario</label>
                            
                            <input class="form-control" id="horario_sede"  type="text" name="horario_sede[]" value="">
                        </div>
                    </div>
                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Teléfono</label>
                            
                            <input class="form-control" id="telefono"  type="text" name="telefono[]" value="">
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modulo de los Certificaciones sin información-->
            <div class="row content_antDesp-formProf">
                <!-- Contenido Certificaciones izquierdo -->
                <div class="col-6 content_antes-formProf">
                    <div class="col-12 pl-0 content_agregarImg-formProf form-group">
                        <div class="col-10 img_selccionada-formProf">
                            <div class="img_anexada-formProf" id="previewates"></div>
                        </div>

                        <div class="agregar_archivo-formProf">
                            <input type='file' id="imgsede" name="imgsede[]"/>
                        </div>
                    </div>

                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Nombre de la sede</label>

                            <input class="form-control" id="nombre"  type="text" name="nombre[]" value="">
                        </div>
                    </div>
                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Dirrección</label>
                            
                            <input class="form-control" id="direccion"  type="text" name="direccion[]" value="">
                        </div>
                    </div>
                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Horario</label>
                            
                            <input class="form-control" id="horario_sede"  type="text" name="horario_sede[]" value="">
                        </div>
                    </div>
                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Teléfono</label>
                            
                            <input class="form-control" id="telefono"  type="text" name="telefono[]" value="">
                        </div>
                    </div>
                </div>

                <!-- Contenido Certificaciones derecho -->
                <div class="col-6 pr-0">
                    <div class="col-12 pl-0 content_agregarImg-formProf form-group">
                        <div class="col-10 img_selccionada-formProf">
                            <div class="img_anexada-formProf" id="previewates"></div>
                        </div>

                        <div class="agregar_archivo-formProf">
                            <input type='file' id="imgsede" name="imgsede[]"/>
                        </div>
                    </div>

                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Nombre de la sede</label>

                            <input class="form-control" id="nombre"  type="text" name="nombre[]" value="">
                        </div>
                    </div>
                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Dirrección</label>
                            
                            <input class="form-control" id="direccion"  type="text" name="direccion[]" value="">
                        </div>
                    </div>
                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Horario</label>
                            
                            <input class="form-control" id="horario_sede"  type="text" name="horario_sede[]" value="">
                        </div>
                    </div>
                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Teléfono</label>
                            
                            <input class="form-control" id="telefono"  type="text" name="telefono[]" value="">
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modulo de los Certificaciones sin información-->
            <div class="row content_antDesp-formProf">
                <!-- Contenido Certificaciones izquierdo -->
                <div class="col-6 content_antes-formProf">
                    <div class="col-12 pl-0 content_agregarImg-formProf form-group">
                        <div class="col-10 img_selccionada-formProf">
                            <div class="img_anexada-formProf" id="previewates"></div>
                        </div>

                        <div class="agregar_archivo-formProf">
                            <input type='file' id="imgsede" name="imgsede[]"/>
                        </div>
                    </div>

                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Nombre de la sede</label>

                            <input class="form-control" id="nombre"  type="text" name="nombre[]" value="">
                        </div>
                    </div>
                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Dirrección</label>
                            
                            <input class="form-control" id="direccion"  type="text" name="direccion[]" value="">
                        </div>
                    </div>
                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Horario</label>
                            
                            <input class="form-control" id="horario_sede"  type="text" name="horario_sede[]" value="">
                        </div>
                    </div>
                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Teléfono</label>
                            
                            <input class="form-control" id="telefono"  type="text" name="telefono[]" value="">
                        </div>
                    </div>
                </div>

                <!-- Contenido Certificaciones derecho -->
                <div class="col-6 pr-0">
                    <div class="col-12 pl-0 content_agregarImg-formProf form-group">
                        <div class="col-10 img_selccionada-formProf">
                            <div class="img_anexada-formProf" id="previewates"></div>
                        </div>

                        <div class="agregar_archivo-formProf">
                            <input type='file' id="imgsede" name="imgsede[]"/>
                        </div>
                    </div>

                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Nombre de la sede</label>

                            <input class="form-control" id="nombre"  type="text" name="nombre[]" value="">
                        </div>
                    </div>
                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Dirrección</label>
                            
                            <input class="form-control" id="direccion"  type="text" name="direccion[]" value="">
                        </div>
                    </div>
                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Horario</label>
                            
                            <input class="form-control" id="horario_sede"  type="text" name="horario_sede[]" value="">
                        </div>
                    </div>
                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Teléfono</label>
                            
                            <input class="form-control" id="telefono"  type="text" name="telefono[]" value="">
                        </div>
                    </div>
                </div>
            </div>
            
        @elseif($objContadorSedes->cantidad == 1)
            <!-- Modulo de los Certificaciones sin información-->
            <div class="row content_antDesp-formProf">
                <!-- Contenido Certificaciones izquierdo -->
                <div class="col-6 content_antes-formProf">
                    <div class="col-12 pl-0 content_agregarImg-formProf form-group">
                        <div class="col-10 img_selccionada-formProf">
                            <div class="img_anexada-formProf" id="previewates"></div>
                        </div>

                        <div class="agregar_archivo-formProf">
                            <input type='file' id="imgsede" name="imgsede[]"/>
                        </div>
                    </div>

                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Nombre de la sede</label>

                            <input class="form-control" id="nombre"  type="text" name="nombre[]" value="">
                        </div>
                    </div>
                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Dirrección</label>
                            
                            <input class="form-control" id="direccion"  type="text" name="direccion[]" value="">
                        </div>
                    </div>
                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Horario</label>
                            
                            <input class="form-control" id="horario_sede"  type="text" name="horario_sede[]" value="">
                        </div>
                    </div>
                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Teléfono</label>
                            
                            <input class="form-control" id="telefono"  type="text" name="telefono[]" value="">
                        </div>
                    </div>
                </div>

                <!-- Contenido Certificaciones derecho -->
                <div class="col-6 pr-0">
                    <div class="col-12 pl-0 content_agregarImg-formProf form-group">
                        <div class="col-10 img_selccionada-formProf">
                            <div class="img_anexada-formProf" id="previewates"></div>
                        </div>

                        <div class="agregar_archivo-formProf">
                            <input type='file' id="imgsede" name="imgsede[]"/>
                        </div>
                    </div>

                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Nombre de la sede</label>

                            <input class="form-control" id="nombre"  type="text" name="nombre[]" value="">
                        </div>
                    </div>
                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Dirrección</label>
                            
                            <input class="form-control" id="direccion"  type="text" name="direccion[]" value="">
                        </div>
                    </div>
                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Horario</label>
                            
                            <input class="form-control" id="horario_sede"  type="text" name="horario_sede[]" value="">
                        </div>
                    </div>
                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Teléfono</label>
                            
                            <input class="form-control" id="telefono"  type="text" name="telefono[]" value="">
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modulo de los Certificaciones sin información-->
            <div class="row content_antDesp-formProf">
                <!-- Contenido Certificaciones izquierdo -->
                <div class="col-6 content_antes-formProf">
                    <div class="col-12 pl-0 content_agregarImg-formProf form-group">
                        <div class="col-10 img_selccionada-formProf">
                            <div class="img_anexada-formProf" id="previewates"></div>
                        </div>

                        <div class="agregar_archivo-formProf">
                            <input type='file' id="imgsede" name="imgsede[]"/>
                        </div>
                    </div>

                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Nombre de la sede</label>

                            <input class="form-control" id="nombre"  type="text" name="nombre[]" value="">
                        </div>
                    </div>
                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Dirrección</label>
                            
                            <input class="form-control" id="direccion"  type="text" name="direccion[]" value="">
                        </div>
                    </div>
                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Horario</label>
                            
                            <input class="form-control" id="horario_sede"  type="text" name="horario_sede[]" value="">
                        </div>
                    </div>
                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Teléfono</label>
                            
                            <input class="form-control" id="telefono"  type="text" name="telefono[]" value="">
                        </div>
                    </div>
                </div>

                <!-- Contenido Certificaciones derecho -->
                <div class="col-6 pr-0">
                    <div class="col-12 pl-0 content_agregarImg-formProf form-group">
                        <div class="col-10 img_selccionada-formProf">
                            <div class="img_anexada-formProf" id="previewates"></div>
                        </div>

                        <div class="agregar_archivo-formProf">
                            <input type='file' id="imgsede" name="imgsede[]"/>
                        </div>
                    </div>

                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Nombre de la sede</label>

                            <input class="form-control" id="nombre"  type="text" name="nombre[]" value="">
                        </div>
                    </div>
                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Dirrección</label>
                            
                            <input class="form-control" id="direccion"  type="text" name="direccion[]" value="">
                        </div>
                    </div>
                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Horario</label>
                            
                            <input class="form-control" id="horario_sede"  type="text" name="horario_sede[]" value="">
                        </div>
                    </div>
                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Teléfono</label>
                            
                            <input class="form-control" id="telefono"  type="text" name="telefono[]" value="">
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modulo de los Certificaciones sin información-->
            <div class="row content_antDesp-formProf">
                <!-- Contenido Certificaciones izquierdo -->
                <div class="col-6 content_antes-formProf">
                    <div class="col-12 pl-0 content_agregarImg-formProf form-group">
                        <div class="col-10 img_selccionada-formProf">
                            <div class="img_anexada-formProf" id="previewates"></div>
                        </div>

                        <div class="agregar_archivo-formProf">
                            <input type='file' id="imgsede" name="imgsede[]"/>
                        </div>
                    </div>

                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Nombre de la sede</label>

                            <input class="form-control" id="nombre"  type="text" name="nombre[]" value="">
                        </div>
                    </div>
                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Dirrección</label>
                            
                            <input class="form-control" id="direccion"  type="text" name="direccion[]" value="">
                        </div>
                    </div>
                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Horario</label>
                            
                            <input class="form-control" id="horario_sede"  type="text" name="horario_sede[]" value="">
                        </div>
                    </div>
                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Teléfono</label>
                            
                            <input class="form-control" id="telefono"  type="text" name="telefono[]" value="">
                        </div>
                    </div>
                </div>
            </div>
        @elseif($objContadorSedes->cantidad == 2)
            <!-- Modulo de los Certificaciones sin información-->
            <div class="row content_antDesp-formProf">
                <!-- Contenido Certificaciones izquierdo -->
                <div class="col-6 content_antes-formProf">
                    <div class="col-12 pl-0 content_agregarImg-formProf form-group">
                        <div class="col-10 img_selccionada-formProf">
                            <div class="img_anexada-formProf" id="previewates"></div>
                        </div>

                        <div class="agregar_archivo-formProf">
                            <input type='file' id="imgsede" name="imgsede[]"/>
                        </div>
                    </div>

                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Nombre de la sede</label>

                            <input class="form-control" id="nombre"  type="text" name="nombre[]" value="">
                        </div>
                    </div>
                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Dirrección</label>
                            
                            <input class="form-control" id="direccion"  type="text" name="direccion[]" value="">
                        </div>
                    </div>
                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Horario</label>
                            
                            <input class="form-control" id="horario_sede"  type="text" name="horario_sede[]" value="">
                        </div>
                    </div>
                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Teléfono</label>
                            
                            <input class="form-control" id="telefono"  type="text" name="telefono[]" value="">
                        </div>
                    </div>
                </div>

                <!-- Contenido Certificaciones derecho -->
                <div class="col-6 pr-0">
                    <div class="col-12 pl-0 content_agregarImg-formProf form-group">
                        <div class="col-10 img_selccionada-formProf">
                            <div class="img_anexada-formProf" id="previewates"></div>
                        </div>

                        <div class="agregar_archivo-formProf">
                            <input type='file' id="imgsede" name="imgsede[]"/>
                        </div>
                    </div>

                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Nombre de la sede</label>

                            <input class="form-control" id="nombre"  type="text" name="nombre[]" value="">
                        </div>
                    </div>
                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Dirrección</label>
                            
                            <input class="form-control" id="direccion"  type="text" name="direccion[]" value="">
                        </div>
                    </div>
                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Horario</label>
                            
                            <input class="form-control" id="horario_sede"  type="text" name="horario_sede[]" value="">
                        </div>
                    </div>
                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Teléfono</label>
                            
                            <input class="form-control" id="telefono"  type="text" name="telefono[]" value="">
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modulo de los Certificaciones sin información-->
            <div class="row content_antDesp-formProf">
                <!-- Contenido Certificaciones izquierdo -->
                <div class="col-6 content_antes-formProf">
                    <div class="col-12 pl-0 content_agregarImg-formProf form-group">
                        <div class="col-10 img_selccionada-formProf">
                            <div class="img_anexada-formProf" id="previewates"></div>
                        </div>

                        <div class="agregar_archivo-formProf">
                            <input type='file' id="imgsede" name="imgsede[]"/>
                        </div>
                    </div>

                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Nombre de la sede</label>

                            <input class="form-control" id="nombre"  type="text" name="nombre[]" value="">
                        </div>
                    </div>
                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Dirrección</label>
                            
                            <input class="form-control" id="direccion"  type="text" name="direccion[]" value="">
                        </div>
                    </div>
                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Horario</label>
                            
                            <input class="form-control" id="horario_sede"  type="text" name="horario_sede[]" value="">
                        </div>
                    </div>
                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Teléfono</label>
                            
                            <input class="form-control" id="telefono"  type="text" name="telefono[]" value="">
                        </div>
                    </div>
                </div>

                <!-- Contenido Certificaciones derecho -->
                <div class="col-6 pr-0">
                    <div class="col-12 pl-0 content_agregarImg-formProf form-group">
                        <div class="col-10 img_selccionada-formProf">
                            <div class="img_anexada-formProf" id="previewates"></div>
                        </div>

                        <div class="agregar_archivo-formProf">
                            <input type='file' id="imgsede" name="imgsede[]"/>
                        </div>
                    </div>

                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Nombre de la sede</label>

                            <input class="form-control" id="nombre"  type="text" name="nombre[]" value="">
                        </div>
                    </div>
                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Dirrección</label>
                            
                            <input class="form-control" id="direccion"  type="text" name="direccion[]" value="">
                        </div>
                    </div>
                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Horario</label>
                            
                            <input class="form-control" id="horario_sede"  type="text" name="horario_sede[]" value="">
                        </div>
                    </div>
                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Teléfono</label>
                            
                            <input class="form-control" id="telefono"  type="text" name="telefono[]" value="">
                        </div>
                    </div>
                </div>
            </div>
        @elseif($objContadorSedes->cantidad == 3)
            <!-- Modulo de los Certificaciones sin información-->
            <div class="row content_antDesp-formProf">
                <!-- Contenido Certificaciones izquierdo -->
                <div class="col-6 content_antes-formProf">
                    <div class="col-12 pl-0 content_agregarImg-formProf form-group">
                        <div class="col-10 img_selccionada-formProf">
                            <div class="img_anexada-formProf" id="previewates"></div>
                        </div>

                        <div class="agregar_archivo-formProf">
                            <input type='file' id="imgsede" name="imgsede[]"/>
                        </div>
                    </div>

                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Nombre de la sede</label>

                            <input class="form-control" id="nombre"  type="text" name="nombre[]" value="">
                        </div>
                    </div>
                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Dirrección</label>
                            
                            <input class="form-control" id="direccion"  type="text" name="direccion[]" value="">
                        </div>
                    </div>
                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Horario</label>
                            
                            <input class="form-control" id="horario_sede"  type="text" name="horario_sede[]" value="">
                        </div>
                    </div>
                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Teléfono</label>
                            
                            <input class="form-control" id="telefono"  type="text" name="telefono[]" value="">
                        </div>
                    </div>
                </div>

                <!-- Contenido Certificaciones derecho -->
                <div class="col-6 pr-0">
                    <div class="col-12 pl-0 content_agregarImg-formProf form-group">
                        <div class="col-10 img_selccionada-formProf">
                            <div class="img_anexada-formProf" id="previewates"></div>
                        </div>

                        <div class="agregar_archivo-formProf">
                            <input type='file' id="imgsede" name="imgsede[]"/>
                        </div>
                    </div>

                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Nombre de la sede</label>

                            <input class="form-control" id="nombre"  type="text" name="nombre[]" value="">
                        </div>
                    </div>
                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Dirrección</label>
                            
                            <input class="form-control" id="direccion"  type="text" name="direccion[]" value="">
                        </div>
                    </div>
                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Horario</label>
                            
                            <input class="form-control" id="horario_sede"  type="text" name="horario_sede[]" value="">
                        </div>
                    </div>
                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Teléfono</label>
                            
                            <input class="form-control" id="telefono"  type="text" name="telefono[]" value="">
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modulo de los Certificaciones sin información-->
            <div class="row content_antDesp-formProf">
                <!-- Contenido Certificaciones izquierdo -->
                <div class="col-6 content_antes-formProf">
                    <div class="col-12 pl-0 content_agregarImg-formProf form-group">
                        <div class="col-10 img_selccionada-formProf">
                            <div class="img_anexada-formProf" id="previewates"></div>
                        </div>

                        <div class="agregar_archivo-formProf">
                            <input type='file' id="imgsede" name="imgsede[]"/>
                        </div>
                    </div>

                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Nombre de la sede</label>

                            <input class="form-control" id="nombre"  type="text" name="nombre[]" value="">
                        </div>
                    </div>
                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Dirrección</label>
                            
                            <input class="form-control" id="direccion"  type="text" name="direccion[]" value="">
                        </div>
                    </div>
                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Horario</label>
                            
                            <input class="form-control" id="horario_sede"  type="text" name="horario_sede[]" value="">
                        </div>
                    </div>
                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Teléfono</label>
                            
                            <input class="form-control" id="telefono"  type="text" name="telefono[]" value="">
                        </div>
                    </div>
                </div>
            </div>
        @elseif($objContadorSedes->cantidad == 4)
            <!-- Modulo de los Certificaciones sin información-->
            <div class="row content_antDesp-formProf">
                <!-- Contenido Certificaciones izquierdo -->
                <div class="col-6 content_antes-formProf">
                    <div class="col-12 pl-0 content_agregarImg-formProf form-group">
                        <div class="col-10 img_selccionada-formProf">
                            <div class="img_anexada-formProf" id="previewates"></div>
                        </div>

                        <div class="agregar_archivo-formProf">
                            <input type='file' id="imgsede" name="imgsede[]"/>
                        </div>
                    </div>

                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Nombre de la sede</label>

                            <input class="form-control" id="nombre"  type="text" name="nombre[]" value="">
                        </div>
                    </div>
                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Dirrección</label>
                            
                            <input class="form-control" id="direccion"  type="text" name="direccion[]" value="">
                        </div>
                    </div>
                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Horario</label>
                            
                            <input class="form-control" id="horario_sede"  type="text" name="horario_sede[]" value="">
                        </div>
                    </div>
                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Teléfono</label>
                            
                            <input class="form-control" id="telefono"  type="text" name="telefono[]" value="">
                        </div>
                    </div>
                </div>

                <!-- Contenido Certificaciones derecho -->
                <div class="col-6 pr-0">
                    <div class="col-12 pl-0 content_agregarImg-formProf form-group">
                        <div class="col-10 img_selccionada-formProf">
                            <div class="img_anexada-formProf" id="previewates"></div>
                        </div>

                        <div class="agregar_archivo-formProf">
                            <input type='file' id="imgsede" name="imgsede[]"/>
                        </div>
                    </div>

                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Nombre de la sede</label>

                            <input class="form-control" id="nombre"  type="text" name="nombre[]" value="">
                        </div>
                    </div>
                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Dirrección</label>
                            
                            <input class="form-control" id="direccion"  type="text" name="direccion[]" value="">
                        </div>
                    </div>
                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Horario</label>
                            
                            <input class="form-control" id="horario_sede"  type="text" name="horario_sede[]" value="">
                        </div>
                    </div>
                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Teléfono</label>
                            
                            <input class="form-control" id="telefono"  type="text" name="telefono[]" value="">
                        </div>
                    </div>
                </div>
            </div>
        @elseif($objContadorSedes->cantidad == 5)
                    <!-- Modulo de los Certificaciones sin información-->
                    <div class="row content_antDesp-formProf">
                <!-- Contenido Certificaciones izquierdo -->
                <div class="col-6 content_antes-formProf">
                    <div class="col-12 pl-0 content_agregarImg-formProf form-group">
                        <div class="col-10 img_selccionada-formProf">
                            <div class="img_anexada-formProf" id="previewates"></div>
                        </div>

                        <div class="agregar_archivo-formProf">
                            <input type='file' id="imgsede" name="imgsede[]"/>
                        </div>
                    </div>

                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Nombre de la sede</label>

                            <input class="form-control" id="nombre"  type="text" name="nombre[]" value="">
                        </div>
                    </div>
                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Dirrección</label>
                            
                            <input class="form-control" id="direccion"  type="text" name="direccion[]" value="">
                        </div>
                    </div>
                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Horario</label>
                            
                            <input class="form-control" id="horario_sede"  type="text" name="horario_sede[]" value="">
                        </div>
                    </div>
                    <div class="col-12 pr-0">
                        <div class="form-group">
                            <label for="title">Teléfono</label>
                            
                            <input class="form-control" id="telefono"  type="text" name="telefono[]" value="">
                        </div>
                    </div>
                </div>
            </div>
        @elseif($objContadorSedes->cantidad == 6)
        <span>No se puede agregar mas</span>
        @endif 

        <div class="col-lg-12 content_btnEnviar-formProf">
            <button type="submit" class="btn2_enviar-formProf"> Guardar
                <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flecha_ingreso-membresia" alt=""> 
            </button>
        </div>
    </form>
</div>
<!--------------------------------------------      Fin decima parte del formulario  ------------------------------------------------>


<!--------------------------------------------Inicio once parte del formulario------------------------------------------------> 
<div class="col-lg-10 pb-3 infoBasica_formProf">
    <h5 class="col-lg-12 icon_infoBasica-formProf">Ubique la sede </h5>

    <form method="POST" action="{{ url ('/FormularioInstitucionSave11') }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8">
        <input type="hidden" name="_token" value="{{ csrf_token() }}"> 

        @if(!empty($objFormulario))
            <div class="col-12 pr-0">
                <div class="form-group">
                    <label for="title"> A continuación enlace las sedes en Google Maps </label>
                    <iframe src="{{$objFormulario->url_maps}}" width="800" height="600" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        @else
            <div class="col-12 pr-0">
                <div class="form-group">
                    <label for="title">  A continuación enlace las sedes en Google Maps </label>
                    <input class="form-control" id="descripcionPerfil"  type="text" name="url_maps" >
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
<!--------------------------------------------Fin once parte del formulario------------------------------------------------>


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
                        <a href="{{url('/FormularioInstituciondelete12/'.$objGaleria->id_galeria)}}">
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

    <form method="POST" action="{{ url ('/FormularioInstitucionSave12') }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8">
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

@endsection