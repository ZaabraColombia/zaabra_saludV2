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
@endsection