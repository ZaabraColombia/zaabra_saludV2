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
                        @if(!empty($objFormulario->logo))
                            <img id="imagenPrevisualizacion" class="img_usuario-formProf" src="{{URL::asset($objFormulario->logo)}}">
                        @endif  
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
                                @if(!empty($objFormulario->imagen))
                                 <img id="imagenPrevisualizacion" class="img_usuario-formProf" src="{{URL::asset($objFormulario->imagen)}}">
                                @endif  
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
                                            <input class="col-lg-12 form-control" id="url" placeholder="nombre" type="text" name="url">
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

@endsection