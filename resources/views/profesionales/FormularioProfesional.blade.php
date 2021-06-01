@extends('layouts.app')

@section('content')

<div class="container">
<!------------------------------primera parte del formulario---------------------------------------> 
<div class="row" style="background: red;">
  <div class="col-md-10 col-md-offset-1">
    <div class="panel panel-default">
      <div class="panel-heading">Agregar archivos</div>
        <div class="panel-body">
          <form method="POST" action="{{ url ('/FormularioProfesionalSave') }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8">
          <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
           <!---------------valida que ya exista informacion y la muestra
            en caso contrario muestra un formulario vacio---------------------> 

          @if(!empty($objFormulario1))
                       @foreach ($objFormulario1 as $objFormulario1)
                            <input value="{{$objFormulario1->imglogoempresa}}" readonly></input>
                        @endforeach
          
                    <div class="col-12">
                        @foreach ($objuser as $objuser)
                            <input value="{{$objuser->primernombre}}" readonly></input>
                            <input value="{{$objuser->segundonombre}}" readonly></input>
                            <input value="{{$objuser->primerapellido}}" readonly></input>
                            <input value="{{$objuser->segundoapellido}}" readonly></input>
                        @endforeach
                    </div>
                    @foreach ($objFormulario1 as $objFormulario1)
                        <div class="form-group col-12">
                            <label for="example-date-input" class="col-2 col-form-label">Date</label>
                            <div class="col-10">
                                <input class="form-control" type="date" value="{{$objFormulario1->fechanacimiento}}" id="example-date-input" name="fechanacimiento">
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
                <!--------------- Fin campos llenos --------------------->     
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
                        <input type="file" class="form-control" name="fotoperfil"  id="seleccionArchivos" accept="image/png, image/jpeg">
                        <img id="imagenPrevisualizacion">
                    </div>
                    </div>

                    <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </div>
                </div>
            @endif
          </form>
        </div>
      </div>
    </div>
  </div>
  <!------------------------------Fin primera parte del formulario---------------------------------------> 
</div>


@endsection