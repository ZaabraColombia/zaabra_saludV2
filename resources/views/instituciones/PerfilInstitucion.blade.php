@extends('layouts.app')

@section('content')

@php
   $new_array = array();
@endphp

<div class="col-12">
    @foreach ($objinstitucionlandin as $objinstitucionlandin)
          <img class="swiper-slide logoHeaderSProfesionales" src="{{URL::asset($objinstitucionlandin->logo)}}">
          <span>{{$objinstitucionlandin->nombreinstitucion}}</span>
          <span>{{$objinstitucionlandin->nombretipo}}</span>
          <span>{{$objinstitucionlandin->url}}</span>
          <span>{{$objinstitucionlandin->telefonouno}}</span>
          <span>{{$objinstitucionlandin->direccion}}</span>
          <span>{{$objinstitucionlandin->ciudad}} {{$objinstitucionlandin->pais}}</span>
          <img class="swiper-slide logoHeaderSProfesionales" src="{{URL::asset($objinstitucionlandin->imagen)}}">
    @endforeach
</div>


<div class="col-12">
    <span>{{$objinstitucionlandin->DescripcionGeneralServicios}}</span>
</div>



<div class="col-12">
    @foreach ($objinstitucionlandinservicios as $objinstitucionlandinservicios)
        <div class="col-12">
          <span>{{$objinstitucionlandinservicios->tituloServicios}}</span>
        </div>
        <div class="col-12">
          <span>{{$objinstitucionlandinservicios->DescripcioServicios}}</span>
        </div>
        <div class="col-12">
            @if($objinstitucionlandinservicios->sucursalservicio) 
                @php  $new_array = explode(',',$objinstitucionlandinservicios->sucursalservicio); @endphp
        
            @endif
            @foreach($new_array as $info)
            <option>{{$info}}</option>
            @endforeach
        </div>
    @endforeach

</div>

<div class="col-12">
    <span>{{$objinstitucionlandin->quienessomos}}</span>
</div>
<div class="col-12">
    <span>{{$objinstitucionlandin->propuestavalor}}</span>
</div>
<div class="col-12">
    @foreach ($objinstitucionlandineps as $objinstitucionlandineps)
         <img class="swiper-slide logoHeaderSProfesionales" src="{{URL::asset($objinstitucionlandineps->urlimagen)}}">
      @endforeach
</div>
<div class="col-12">
    @foreach ($objinstitucionlandinips as $objinstitucionlandinips)
         <img class="swiper-slide logoHeaderSProfesionales" src="{{URL::asset($objinstitucionlandinips->urlimagen)}}">
      @endforeach
</div>
<div class="col-12">
    @foreach ($objinstitucionlandinprepagada as $objinstitucionlandinprepagada)
         <img class="swiper-slide logoHeaderSProfesionales" src="{{URL::asset($objinstitucionlandinprepagada->urlimagen)}}">
      @endforeach
</div>
<div class="col-12">
    @foreach ($objinstitucionlandinpremios as $objinstitucionlandinpremios)
         <img class="swiper-slide logoHeaderSProfesionales" src="{{URL::asset($objinstitucionlandinpremios->imgpremio)}}">
         <span>{{$objinstitucionlandinpremios->fechapremio}}</span>
          <span>{{$objinstitucionlandinpremios->nombrepremio}}</span>
          <span>{{$objinstitucionlandinpremios->descripcionpremio}}</span>
      @endforeach
</div>
<div class="col-12">
    @foreach ($objinstitucionlandinpublicaci as $objinstitucionlandinpublicaci)
         <img class="swiper-slide logoHeaderSProfesionales" src="{{URL::asset($objinstitucionlandinpublicaci->imgpublicacion)}}">
         <span>{{$objinstitucionlandinpublicaci->nombrepublicacion}}</span>
          <span>{{$objinstitucionlandinpublicaci->descripcion}}</span>
      @endforeach
</div>
<div class="col-12">
    @foreach ($objinstitucionlandingaleria as $objinstitucionlandingaleria)
         <img class="swiper-slide logoHeaderSProfesionales" src="{{URL::asset($objinstitucionlandingaleria->imggaleria)}}">
         <span>{{$objinstitucionlandingaleria->nombrefoto}}</span>
          <span>{{$objinstitucionlandingaleria->descripcion}}</span>
      @endforeach
</div>
<div class="col-12">
            @foreach ($objinstitucionlandinvideo as $objinstitucionlandinvideo)
            <iframe src="{{$objinstitucionlandinvideo->urlvideo}}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
            <p>{{$objinstitucionlandinvideo->nombrevideo}}</p>
            <p>{{$objinstitucionlandinvideo->descripcionvideo}}</p>
            @endforeach
        </div>

@endsection

