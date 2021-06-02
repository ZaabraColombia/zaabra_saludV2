@extends('layouts.app')

@section('content')

<div class="container">
    <div class="contain_principal101" id="">
        <img class="banner_error101" src="{{URL::asset('/img/errores/banner-error-101.jpeg')}}" alt="">

        <h5 class="titulo_principal101"> ERROR 101 </h5>
        
        <p class="texto_descripcion101"> Error en la conexión. El navegador se logro localizar, pero la conexión no puede establecerse. Actualiza de nuevo la página. </p>

        <a href="" class="text_regresar101 d-flex"> Regresar a la página anterior <span class="icon_dobleFlecha101"></span></a> 
    </div> 
</div>

@endsection