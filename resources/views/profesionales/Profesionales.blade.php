@extends('layouts.app')

@section('content')
     <div style="background: red;">
        <!--carrusel profesionales premiun-->
        @foreach ($objcarruselprofesionalespremiun as $objcarruselprofesionalespremiun)
            <img class="swiper-slide logoHeaderSProfesionales" src="{{URL::asset($objcarruselprofesionalespremiun->fotoperfil)}}">
            <span>{{$objcarruselprofesionalespremiun->primernombre}} {{$objcarruselprofesionalespremiun->primerapellido}}</span>
            <span>{{$objcarruselprofesionalespremiun->nombreEspecialidad}}</span>
            <span>{{$objcarruselprofesionalespremiun->nombre}}</span>
            <span>{{$objcarruselprofesionalespremiun->descripcionPerfil}}</span>
            <span>{{$objcarruselprofesionalespremiun->nombreuniversidad}}</span>
        @endforeach
      </div>
      <div style="background: blue;">
        <!--galeria profesionales pago normal-->
        @foreach ($objmedicospagonormal as $objmedicospagonormal)
            <img class="swiper-slide logoHeaderSProfesionales" src="{{URL::asset($objmedicospagonormal->fotoperfil)}}">
            <span>{{$objmedicospagonormal->primernombre}} {{$objmedicospagonormal->primerapellido}}</span>
            <span>{{$objmedicospagonormal->nombreEspecialidad}}</span>
            <span>{{$objmedicospagonormal->nombre}}</span>
            <span>{{$objmedicospagonormal->descripcionPerfil}}</span>
            <span>{{$objmedicospagonormal->nombreuniversidad}}</span>
        @endforeach
      </div>
      <div style="background: yellow;">
        <!--galeria profesionales sin pago -->
        @foreach ($objmedicossinpago as $objmedicossinpago)
        <span>{{$objmedicossinpago->primernombre}} {{$objmedicossinpago->primerapellido}}</span>
        <span>{{$objmedicossinpago->nombreEspecialidad}}</span>
        @endforeach
      </div>
          <!--carrusel publicidad -->
    @foreach ($objcarruselPublicidadprofesionales as $objcarruselPublicidadprofesionales)
        <img class="swiper-slide logoHeaderSProfesionales" src="{{URL::asset($objcarruselPublicidadprofesionales->rutaImagenVenta)}}">
      @endforeach 

@endsection

