@extends('layouts.app')

@section('content')

<div class="container">
    <div class="contain_principal101" id="">
        <img class="banner_error101" src="{{URL::asset('/img/errores/banner-error-404.jpeg')}}" alt="">

        <h5 class="titulo_principal101"> ERROR 404 </h5>
        
        <p class="texto_descripcion101"> OOPS! algo salió mal, no pudimos encontrar la página que buscaba. Estamos trabajando para solucionar el problema. </p>

        <a href="" class="text_regresar101 d-flex"> Regresar a la página anterior <span class="icon_dobleFlecha101"></span></a> 
    </div> 
</div>

@endsection