@extends('layouts.app')

@section('content')

<div class="container">
    <div class="contain_principal101" id="">
        <img class="banner_error101" src="{{URL::asset('/img/errores/banner-error-403.jpeg')}}" alt="">

        <h5 class="titulo_principal101"> ERROR 403 </h5>
        
        <p class="texto_descripcion101"> Acceso denegado o prohibido. La página a la que intentaba acceder está absolutamente prohibida por algún motivo. </p>

        <a href="" class="text_regresar101 d-flex"> Regresar a la página anterior <span class="icon_dobleFlecha101"></span></a> 
    </div> 
</div>

@endsection