@extends('layouts.app')

@section('content')

        <form action="" method="POST">
                <div class="form-group">
                    <label for="exampleFormControlInput1">Email address</label>
                    <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">area</label>
                    <select class="form-control form-control-sm" name="area" id="area">
                        @foreach ($objarea as $objarea)  
                            <option value="{{$objarea->idArea}}">
                                <?php if(!empty($objarea->objarea)){
                                    if ($objarea->idArea ==  $objarea->objarea) {echo('selected = "selected"');} 
                                    } 
                                ?>    
                            {{$objarea->nombreArea}}</option>
                        @endforeach  
                    </select> 
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">profesion</label>
                    <select class="form-control form-control-sm" name="profesion" id="profesion">
                        @foreach ($objprofesion as $objprofesion)  
                            <option value="{{$objprofesion->idProfesion}}">
                               <?php if(!empty($objprofesion->objprofesion)){
                                    if ($objprofesion->idProfesion ==  $objprofesion->objprofesion) {echo('selected = "selected"');} 
                                    } 
                                ?>     
                            {{$objprofesion->nombreProfesion}}</option>
                        @endforeach  
                    </select> 
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">especialidad</label>
                    <select class="form-control form-control-sm" name="especialidad" id="especialidad">
                        @foreach ($objespecialidad as $objespecialidad)  
                            <option value="{{$objespecialidad->idEspecialidad}}">
                                <?php if(!empty($objespecialidad->objespecialidad)){
                                    if ($objespecialidad->idEspecialidad ==  $objespecialidad->objespecialidad) {echo('selected = "selected"');} 
                                    } 
                                ?>     
                            {{$objespecialidad->nombreEspecialidad}}</option>
                        @endforeach  
                    </select> 
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Example textarea</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="customFileLang" lang="es">
                    <label class="custom-file-label" for="customFileLang">Seleccionar Archivo</label>
                </div>
                <div class="form-group row">
                    <label for="example-date-input" class="col-2 col-form-label">Date</label>
                    <div class="col-10">
                        <input class="form-control" type="date" value="2011-08-19" id="example-date-input">
                    </div>
                </div>
                
         <!--menu dinamico ciudades -->
            <div class="form-group">
                <select id="pais" name="id_pais" class="form-control" style="width:350px" >
                    <option value="" selected disabled>Seleccione pais</option>
                         @foreach($pais as $pais)
                    <option value="{{$pais->id_pais}}"> {{$pais->nombre}}</option>
                         @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="title">Selecione Departamento:</label>
                <select name="departamento" id="departamento" class="form-control" style="width:350px">
                </select>
            </div>
         
            <div class="form-group">
                <label for="title">Seleccione provincia:</label>
                <select name="provincia" id="provincia" class="form-control" style="width:350px">
                </select>
            </div>
            <div class="form-group">
                <label for="title">Seleccione ciudad:</label>
                <select name="ciudad" id="ciudad" class="form-control" style="width:350px">
                </select>
            </div>

        </form>



@endsection