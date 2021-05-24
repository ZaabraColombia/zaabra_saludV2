@extends('layouts.app')

@section('content')
        <div class="col-12" style="background: aqua;">
            @foreach ($objprofesionallanding as $objprofesionallanding)
            <img src="{{URL::asset($objprofesionallanding->fotoperfil)}}">
                <p>{{$objprofesionallanding->primernombre}} {{$objprofesionallanding->primerapellido}}</p>
                <p>{{$objprofesionallanding->nombreEspecialidad}}</p>
                <p>{{$objprofesionallanding->nombreuniversidad}}</p>
                <p>{{$objprofesionallanding->numeroTarjeta}}</p>
                <p>{{$objprofesionallanding->direccion}}</p>
            @endforeach
        </div>
        <div class="col-12" style="background: blue;">
            @foreach ($objprofesionallandingconsultas as $objprofesionallandingconsultas)
                <p>{{$objprofesionallandingconsultas->nombreconsulta}}</p>
                <p>{{$objprofesionallandingconsultas->valorconsulta}}</p>
            @endforeach
        </div>
        <div class="col-12" style="background: blueviolet;">
            @foreach ($objprofesionallandingexperto as $objprofesionallandingexperto)
                <p>{{$objprofesionallandingexperto->nombreExpertoEn}}</p>
                <p>{{$objprofesionallandingexperto->descripcionExpertoEn}}</p>
            @endforeach
        </div>

        <div class="col-12" style="background: brown;">
            <p>{{$objprofesionallanding->descripcionPerfil}}</p>
        </div>

        <div class="col-12" style="background: cadetblue;">
            @foreach ($objprofesionallandingestudios as $objprofesionallandingestudios)
                <p>{{$objprofesionallandingestudios->nombreestudio}}</p>
                <p>{{$objprofesionallandingestudios->nombreuniversidad}}</p>
                <p>{{$objprofesionallandingestudios->fechaestudio}}</p>
            @endforeach
        </div>

        <div class="col-12" style="background: chartreuse;">
            @foreach ($objprofesionallandingexperi as $objprofesionallandingexperi)
                <p>{{$objprofesionallandingexperi->nombreEmpresaExperiencia}}</p>
                <p>{{$objprofesionallandingexperi->descripcionExperiencia}}</p>
                <p>{{$objprofesionallandingexperi->fechaInicioExperiencia}}</p>
                <p>{{$objprofesionallandingexperi->fechaFinExperiencia}}</p>
                <img src="{{URL::asset($objprofesionallandingexperi->imgexperiencia)}}">
            @endforeach
        </div>

        <div class="col-12" style="background: chocolate;">
            @foreach ($objprofesionallandingasocia as $objprofesionallandingasocia)
                <img src="{{URL::asset($objprofesionallandingasocia->imgasociacion)}}">
            @endforeach
        </div>

        <div class="col-12" style="background: cornflowerblue;">
            @foreach ($objprofesionallandingidioma as $objprofesionallandingidioma)
                <p>{{$objprofesionallandingidioma->nombreidioma}}</p>
                <img src="{{URL::asset($objprofesionallandingidioma->imgidioma)}}">
            @endforeach
        </div>



        <div class="col-12" style="background: crimson;">
            @foreach ($objprofesionallandingtratam as $objprofesionallandingtratam)
                <div class="col-12">
                    <img src="{{URL::asset($objprofesionallandingtratam->imgTratamientoAntes)}}">
                    <p>{{$objprofesionallandingtratam->tituloTrataminetoAntes}}</p>
                    <p>{{$objprofesionallandingtratam->descripcionTratamientoAntes}}</p>
                </div>
                <div class="col-12">
                    <img src="{{URL::asset($objprofesionallandingtratam->imgTratamientodespues)}}">
                    <p>{{$objprofesionallandingtratam->tituloTrataminetoDespues}}</p>
                    <p>{{$objprofesionallandingtratam->descripcionTratamientoDespues}}</p>
                </div>
            @endforeach
        </div>


        
        <div class="col-12" style="background: cornflowerblue;">
            @foreach ($objprofesionallandingpremio as $objprofesionallandingpremio)
            <img src="{{URL::asset($objprofesionallandingpremio->imgpremio)}}">
            <p>{{$objprofesionallandingpremio->fechapremio}}</p>
            <p>{{$objprofesionallandingpremio->nombrepremio}}</p>
            <p>{{$objprofesionallandingpremio->descripcionpremio}}</p>
            @endforeach
        </div>

        <div class="col-12" style="background: chocolate;">
            @foreach ($objprofesionallandingpublic as $objprofesionallandingpublic)
            <img src="{{URL::asset($objprofesionallandingpublic->imgpublicacion)}}">
            <p>{{$objprofesionallandingpublic->nombrepublicacion}}</p>
            <p>{{$objprofesionallandingpublic->descripcion}}</p>
            @endforeach
        </div>

        <div class="col-12" style="background: crimson;">
            @foreach ($objprofesionallandinggaler as $objprofesionallandinggaler)
            <img src="{{URL::asset($objprofesionallandinggaler->imggaleria)}}">
            <p>{{$objprofesionallandinggaler->nombrefoto}}</p>
            <p>{{$objprofesionallandinggaler->descripcion}}</p>
            @endforeach
        </div>

        <div class="col-12" style="background: blueviolet;">
            @foreach ($objprofesionallandingvideo as $objprofesionallandingvideo)
            <iframe src="{{$objprofesionallandingvideo->urlvideo}}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
            <p>{{$objprofesionallandingvideo->nombrevideo}}</p>
            <p>{{$objprofesionallandingvideo->descripcionvideo}}</p>
            @endforeach
        </div>
        
@endsection