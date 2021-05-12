@extends('layouts.app')

@section('content')

@foreach ($objbannersprincipalEspecialidades as $objbannersprincipalEspecialidades)
      <div class="col-12">
        <img class="" src="{{URL::asset($objbannersprincipalEspecialidades->rutaImagenVenta)}}">
      </div>
  @endforeach

  @foreach ($objEspecialidades as $objEspecialidades)
      <div class="col-12">
        <img class="" src="{{URL::asset($objEspecialidades->urlimagen)}}">
        <span>{{$objEspecialidades->nombreEspecialidad}}</span>
        <span><a href="{{url('galeriaProfesionales/'.$objEspecialidades->idEspecialidad)}}">ruta</a></span>
      </div>
  @endforeach

  @foreach ($objbannerssecundarioEspecialidades as $objbannerssecundarioEspecialidades)
      <div class="col-12">
        <img class="" src="{{URL::asset($objbannerssecundarioEspecialidades->rutaImagenVenta)}}">
      </div>
  @endforeach

  @foreach ($objcarruselespecialidades as $objcarruselespecialidades)
      <div class="col-12">
        <img class="" src="{{URL::asset($objcarruselespecialidades->rutaImagenVenta)}}">
      </div>
  @endforeach

@endsection

