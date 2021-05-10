@extends('layouts.app')

@section('content')

    <!--carrusel banner principal home--> 
    <div>
      @foreach ($objbannersprincipalProfesiones as $objbannersprincipalProfesiones)
            <img class="logoHeaderSProfesionales" src="{{URL::asset($objbannersprincipalProfesiones->rutaImagenVenta)}}">
      @endforeach
    </div>
    <div>
      @foreach ($objprofesiones as $objprofesiones)
      <div class="col-12">
      <span>{{$objprofesiones->nombreProfesion}}</span>
      </div>
      @endforeach
    </div>
    <div>
      @foreach ($objcarruselprofesiones as $objcarruselprofesiones)
            <img class="logoHeaderSProfesionales" src="{{URL::asset($objcarruselprofesiones->rutaImagenVenta)}}">
      @endforeach
    </div>

@endsection