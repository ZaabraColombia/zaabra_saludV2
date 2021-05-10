@extends('layouts.app')

@section('content')

    <!--carrusel banner principal home--> 
<div>
      @foreach ($objbannersprincipalHome as $objbannersprincipalHome)
            <img class="logoHeaderSProfesionales" src="{{URL::asset($objbannersprincipalHome->rutaImagenVenta)}}">
      @endforeach
</div>
   <!--parallax home--> 
<div>
      @foreach ($objbannersparallaxHome as $objbannersparallaxHome)
            <img class="logoHeaderSProfesionales" src="{{URL::asset($objbannersparallaxHome->rutaImagenVenta)}}">
      @endforeach
</div>
 <!--profesionales home--> 
<div>
      @foreach ($objprofesionaleshome as $objprofesionaleshome)
        <div class="col-6">
            <div class="col-12">
               <img class="" src="{{URL::asset($objprofesionaleshome->fotoperfil)}}">
            </div>
            <div class="col-12">
             <span>{{$objprofesionaleshome->primernombre}} {{$objprofesionaleshome->primerapellido}}</span>
            </div>
            <div class="col-12">
             <span>{{$objprofesionaleshome->nombreEspecialidad}}</span>
            </div>
            <div class="col-12">
             <span>{{$objprofesionaleshome->nombreuniversidad}}</span>
            </div>
        </div>
      @endforeach
</div>
<!--carrusel home--> 
<div>
  @foreach ($objcarruselhome as $objcarruselhome)
      <img class="" src="{{URL::asset($objcarruselhome->rutaImagenVenta)}}">
  @endforeach
</div>



@endsection


