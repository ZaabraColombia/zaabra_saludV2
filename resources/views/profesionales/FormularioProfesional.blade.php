@extends('layouts.app')

@section('content')

<div class="container">
<!-------------------------------------------primera parte del formulario-------------------------------------------------------> 
<div class="row" style="background: red;">
  <div class="col-md-10 col-md-offset-1">
    <div class="panel panel-default">
      <div class="panel-heading">Agregar archivos</div>
        <div class="panel-body">
          <form method="POST" action="{{ url ('/FormularioProfesionalSave') }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8">
          <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
           <!---------------valida que ya exista informacion y la muestra
            en caso contrario muestra un formulario vacio---------------------> 
          @if(!empty($objFormulario))
                    <div class="col-12">
                        @foreach ($objuser as $objuser)
                            <input value="{{$objuser->primernombre}}" readonly></input>
                            <input value="{{$objuser->segundonombre}}" readonly></input>
                            <input value="{{$objuser->primerapellido}}" readonly></input>
                            <input value="{{$objuser->segundoapellido}}" readonly></input>
                        @endforeach
                    </div>
                    @foreach ($objFormulario as $objFormulario)
                        <div class="form-group col-12">
                            <label for="example-date-input" class="col-2 col-form-label">Date</label>
                            <div class="col-10">
                                <input class="form-control" type="date" value="{{$objFormulario->fechanacimiento}}" id="example-date-input" name="fechanacimiento">
                            </div>
                        </div>
                    @endforeach
                    <div class="col-12">
                        <div class="form-group">
                            <select id="idarea" name="idarea" class="form-control" style="width:350px" >
                                <option value="" selected disabled>Seleccione area</option>
                                    @foreach($area as $area)
                                <option value="{{$area->idArea}}"> {{$area->nombreArea}}</option>
                                    @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="title">Selecione Profesion:</label>
                            <select name="idprofesion" id="idprofesion" class="form-control" style="width:350px">
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="title">Seleccione especialidad:</label>
                            <select name="idespecialidad" id="idespecialidad" class="form-control" style="width:350px">
                            </select>
                        </div>
                    </div>
            
                    <div class="col-12">
                        <div class="form-group">
                            <label for="title">Selecione Universidad:</label>
                            <select  class="form-control" style="width:350px" name="id_universidad">
                                @foreach($objFormulario1 as $objFormulario1)
                                    <option value="{{$objFormulario1->id_universidad}}">{{$objFormulario1->nombreuniversidad}}</option>
                                @endforeach
                                @foreach($universidades as $universidades)
                                        <option value="{{$universidades->id_universidad}}"> {{$universidades->nombreuniversidad}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="title">Tarjeta Profesional</label>
                            <input id="tarjeta" placeholder="N. Tarjeta" type="number" name="numeroTarjeta" value="{{$objFormulario->numeroTarjeta}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Nuevo Archivo</label>
                        <div class="col-md-6">
                            <input type="file" class="form-control" name="logo"  id="seleccionArchivos" accept="image/png, image/jpeg">
                            @if(!empty($objFormulario->imglogoempresa))
                            <img id="imagenPrevisualizacion" src="{{URL::asset($objFormulario->imglogoempresa)}}">
                            @endif  
                        </div>
                    </div>

                    <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </div>
                    </div>
                <!------------------ Fin campos llenos ---------------------> 



                <!--------------- Inicio campos vacios--------------------->    
            @else
                    <div class="col-12">
                        @foreach ($objuser as $objuser)
                            <input value="{{$objuser->primernombre}}" readonly></input>
                            <input value="{{$objuser->segundonombre}}" readonly></input>
                            <input value="{{$objuser->primerapellido}}" readonly></input>
                            <input value="{{$objuser->segundoapellido}}" readonly></input>
                        @endforeach
                    </div>
                    <div class="form-group col-12">
                        <label for="example-date-input" class="col-2 col-form-label">Date</label>
                        <div class="col-10">
                            <input class="form-control" type="date" value="2011-08-19" id="example-date-input" name="fechanacimiento">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <select id="idarea" name="idarea" class="form-control" style="width:350px" >
                                <option value="" selected disabled>Seleccione area</option>
                                    @foreach($area as $area)
                                <option value="{{$area->idArea}}"> {{$area->nombreArea}}</option>
                                    @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="title">Selecione Profesion:</label>
                            <select name="idprofesion" id="idprofesion" class="form-control" style="width:350px">
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="title">Seleccione especialidad:</label>
                            <select name="idespecialidad" id="idespecialidad" class="form-control" style="width:350px">
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="title">Selecione Universidad:</label>
                            <select  class="form-control" style="width:350px" name="id_universidad">
                                <option value="">Seleccione Universidad</option>
                                    @foreach($universidades as $universidades)
                                <option value="{{$universidades->id_universidad}}"> {{$universidades->nombreuniversidad}}</option>
                                    @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="title">Tarjeta Profesional</label>
                            <input id="tarjeta" placeholder="nombre" type="number" name="numeroTarjeta">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Nuevo Archivo</label>
                        <div class="col-md-6">
                            <input type="file" class="form-control" name="logo"  id="seleccionArchivos" accept="image/png, image/jpeg">
                            <img id="imagenPrevisualizacion">
                        </div>
                    </div>

                    <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </div>
                </div>
            @endif
            <!--------------- Fin campos vacios--------------------->  
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!--------------------------------------------Fin primera parte del formulario------------------------------------------------> 


<!--------------------------------------------Inicio segunda parte del formulario------------------------------------------------> 
<div class="container" style="background: aqua;">
        <form method="POST" action="{{ url ('/FormularioProfesionalSave2') }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
            @if(!empty($objFormulario))
                <div class="col-12">
                    <div class="form-group">
                        <label for="title">Celular</label>
                        <input id="tarjeta" placeholder="N. Celular" type="number" name="celular" value="{{$objFormulario->celular}}">
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label for="title">telefono</label>
                        <input id="telefono" placeholder="N. Telefono" type="number" name="telefono" value="{{$objFormulario->telefono}}">
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label for="title">direccion</label>
                        <input id="direccion" placeholder="N. direccion" type="text" name="direccion" value="{{$objFormulario->direccion}}">
                    </div>
                </div>
                <!--menu dinamico ciudades -->
                <div class="form-group">
                    <select id="idpais" name="idpais" class="form-control" style="width:350px" >
                        <option value="" selected disabled>Seleccione pais</option>
                            @foreach($pais as $pais)
                        <option value="{{$pais->id_pais}}"> {{$pais->nombre}}</option>
                            @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="title">Selecione Departamento:</label>
                    <select name="id_departamento" id="id_departamento" class="form-control" style="width:350px">
                    </select>
                </div>
            
                <div class="form-group">
                    <label for="title">Seleccione provincia:</label>
                    <select name="id_provincia" id="id_provincia" class="form-control" style="width:350px">
                    </select>
                </div>
                <div class="form-group">
                    <label for="title">Seleccione ciudad:</label>
                    <select name="id_municipio" id="id_municipio" class="form-control" style="width:350px">
                    </select>
                </div>
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </div>
            @endif
        </form>
</div>
<!--------------------------------------------Fin segunda parte del formulario------------------------------------------------> 


<!--------------------------------------------Inicio tercera parte del formulario------------------------------------------------> 
<div class="container" style="background: bisque;">
        <form method="POST" action="{{ url ('/FormularioProfesionalSave3') }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"> 

                @if(!empty($objFormulario))
                <div class="col-12">
                    <div class="form-group">
                        <label for="title">descripcion </label>
                        <textarea class="form-control" id="descripcionPerfil"  type="text" name="descripcionPerfil" >{{$objFormulario->descripcionPerfil}}</textarea>
                    </div>
                </div>
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </div>
                @endif
        </form>
</div>
<!--------------------------------------------Fin tercera parte del formulario------------------------------------------------>


<!--------------------------------------------Inicio cuarta parte del formulario------------------------------------------------> 
<div class="container" style="background: aquamarine;">

           <!--------------muestra una lista de la experinecia ingresada---------------> 
            @foreach($objExperiencia as $objExperiencia)
                @if(!empty($objExperiencia->nombreEmpresaExperiencia))
                    <div class="col-12">
                            <span>{{$objExperiencia->nombreEmpresaExperiencia}}  {{$objExperiencia->descripcionExperiencia}} {{$objExperiencia->fechaInicioExperiencia}} {{$objExperiencia->fechaFinExperiencia}} </span>
                            <a href="{{url('/FormularioProfesionaldelete4/'.$objExperiencia->idexperiencias)}}">
                                <button type="submit" class="close" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </a>
                    </div>
                @endif
                @endforeach

        <form method="POST" action="{{ url ('/FormularioProfesionalSave4') }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">    
                @if($objContadorExperiencia->cantidad >= 4)
                   <span>No puede agregar mas campos</span>
                @else
                    <input type="button" id="add_field" value="adicionar">
                    <div id="listas"> 
                            <div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="title">Empresa</label>
                                        <input id="nombreEmpresaExperiencia"  type="text" name="nombreEmpresaExperiencia[]" value="">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="title">Cargo</label>
                                        <input id="descripcionExperiencia"  type="text" name="descripcionExperiencia[]" value="">
                                    </div>
                                </div>
                                <div class="form-group col-12">
                                    <label for="example-date-input" class="col-2 col-form-label">Fecha de inicio</label>
                                    <div class="col-10">
                                        <input class="form-control" type="date"  id="fechaInicioExperiencia" name="fechaInicioExperiencia[]" value="">
                                    </div>
                                </div>
                                <div class="form-group col-12">
                                    <label for="example-date-input" class="col-2 col-form-label">Fecha de terminación</label>
                                    <div class="col-10">
                                        <input class="form-control" type="date"  id="fechaFinExperienci" name="fechaFinExperiencia[]" value="">
                                    </div>
                                </div>
                            </div>
                        </div>
                       <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">Enviar</button>
                       </div>
                @endif


                      <!-- <input class="contadorexperinecia" name="contadorexperinecia" type="text" value="1">-->
        </form>
</div>
<!--------------------------------------------Fin cuarta parte del formulario------------------------------------------------>



<!--------------------------------------------Inicio quinta parte del formulario------------------------------------------------> 
<div class="container" style="background: blueviolet;">
               @foreach($objAsociaciones as $objAsociaciones)
                        @if(!empty($objAsociaciones->imgasociacion))
                            <div class="col-12">
                             <img id="imagenPrevisualizacion" src="{{URL::asset($objAsociaciones->imgasociacion)}}">

                            <a href="{{url('/FormularioProfesionaldelete5/'.$objAsociaciones->idAsociaciones)}}">
                                <button type="submit" class="close" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </a>
                            </div>
                        @endif
                @endforeach
        <form method="POST" action="{{ url ('/FormularioProfesionalSave5') }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
             
                @if($objContadorAsociaciones->cantidad == 0)
                        <div class="col-12">
                                <div class="form-group col-12 row">
                                    <div class="col-6">
                                    <input type='file' id="imgasocia1" name="imgasociacion[]"/>
                                    </div>
                                    <div class="col-6">
                                    <div id="preview1"></div>
                                    </div>
                                </div> 
                                <div class="form-group col-12 row">
                                    <div class="col-6">
                                    <input type='file' id="imgasocia2" name="imgasociacion[]"/>
                                    </div>
                                    <div class="col-6">
                                    <div id="preview2"></div>
                                    </div>
                                </div> 
                                <div class="form-group col-12 row">
                                    <div class="col-6">
                                    <input type='file' id="imgasocia3" name="imgasociacion[]"/>
                                    </div>
                                    <div class="col-6">
                                    <div id="preview3"></div>
                                    </div>
                                </div> 
                                <div class="form-group col-12 row">
                                    <div class="col-6">
                                    <input type='file' id="imgasocia4" name="imgasociacion[]"/>
                                    </div>
                                    <div class="col-6">
                                    <div id="preview4"></div>
                                    </div>
                                </div>  
                        </div>
                @elseif($objContadorAsociaciones->cantidad == 1)
                <div class="col-12">
                                <div class="form-group col-12 row">
                                    <div class="col-6">
                                    <input type='file' id="imgasocia1" name="imgasociacion[]"/>
                                    </div>
                                    <div class="col-6">
                                    <div id="preview1"></div>
                                    </div>
                                </div> 
                                <div class="form-group col-12 row">
                                    <div class="col-6">
                                    <input type='file' id="imgasocia2" name="imgasociacion[]"/>
                                    </div>
                                    <div class="col-6">
                                    <div id="preview2"></div>
                                    </div>
                                </div> 
                                <div class="form-group col-12 row">
                                    <div class="col-6">
                                    <input type='file' id="imgasocia3" name="imgasociacion[]"/>
                                    </div>
                                    <div class="col-6">
                                    <div id="preview3"></div>
                                    </div>
                                </div>  
                        </div>

                @elseif($objContadorAsociaciones->cantidad == 2)
                        <div class="col-12">
                                <div class="form-group col-12 row">
                                    <div class="col-6">
                                    <input type='file' id="imgasocia1" name="imgasociacion[]"/>
                                    </div>
                                    <div class="col-6">
                                    <div id="preview1"></div>
                                    </div>
                                </div> 
                                <div class="form-group col-12 row">
                                    <div class="col-6">
                                    <input type='file' id="imgasocia2" name="imgasociacion[]"/>
                                    </div>
                                    <div class="col-6">
                                    <div id="preview2"></div>
                                    </div>
                                </div> 
                        </div> 
                @elseif($objContadorAsociaciones->cantidad == 3)
                        <div class="col-12">
                                <div class="form-group col-12 row">
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
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </div>

        </form>
</div>
<!--------------------------------------------Fin quinta parte del formulario------------------------------------------------>



<!--------------------------------------------Inicio sexta parte del formulario------------------------------------------------> 

<div class="container" style="background: blue;">
            <div class="col-12">
                <div class="form-group">
                    <label for="title">Selecione Universidad:</label>
                    <select  class="form-control" style="width:350px" name="id_universidad[]">
                        <option value=" ">Seleccione</option>
                          @foreach($idiomas as $idiomas1)
                           <option value="{{$idiomas1->id_idioma}}"> {{$idiomas1->nombreidioma}}</option>
                          @endforeach
                    </select>
                    <select  class="form-control" style="width:350px" name="id_universidad[]">
                        <option value=" ">Seleccione</option>
                          @foreach($idiomas as $idiomas2)
                           <option value="{{$idiomas2->id_idioma}}"> {{$idiomas2->nombreidioma}}</option>
                          @endforeach
                    </select>
                    <select  class="form-control" style="width:350px" name="id_universidad[]">
                        <option value=" ">Seleccione</option>
                          @foreach($idiomas as $idiomas3)
                           <option value="{{$idiomas3->id_idioma}}"> {{$idiomas3->nombreidioma}}</option>
                          @endforeach
                    </select>
                </div>
                
 
            </div>
            
</div>

<!--------------------------------------------Fin sexta parte del formulario------------------------------------------------>
@endsection