@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('plugins/cubeportfolio-full/css/cubeportfolio.min.css') }}">
@endsection

@section('content')

    <!-- Swiper Banner principal, funcionalidad del swiper alojada en el archivo instituciones.js -->
    <div class="imagen_inst_instProf">
        <div class="img_institucion_instProf" style="background: url('{{URL::asset($institucion[0]->imagen)}}') center center no-repeat;"></div>
        <h1 class="nombre_inst_instProf">{{$institucion[0]->nombreinstitucion}}</h1>
    </div>

    {{--<!-- Tarjetas profesionales de la institución -->
    <div class="container_principal_instProf">
        <section class="container_tarjetas_instProf">
            @foreach ($objProfesionalesIns as $profesional)
                <div class="card tarjeta_instProf">
                    <img class="img_perfil_instProf" src="{{ asset($profesional->foto_perfil_institucion) }}">
                    <div class="card-body content_tarjeta_instProf">
                        @if(!empty($profesional->nombre_especialidad))
                            <h2>{{$profesional->nombre_especialidad}}</h2>
                        @endif    
                        <h5 class="niega_uppercase">{{$profesional->primer_nombre}} {{$profesional->primer_apellido}}</h5>
                        @if(!empty($profesional->nombre_especialidad))
                            <p>Especialista en {{$profesional->nombre_especialidad}}</p>
                        @endif    
                        <p>{{$profesional->nombre_universidad}}</p>
                       
                            <p>{{$profesional->cargo}}</p>
                   
                        @if(!empty($profesional->nombre_especialidad))
                            <div class="content_btn_instprof">
                                <a class="btn_agendar_instProf" href=""> Agendar cita
                                    <i class="fas fa-arrow-right arrow_mas"></i>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </section>
    </div>--}}

    <section class="container-fluid" style="background: #F9F9F9;">
        <div class="container_principal_instProf">
           <!-- Filter -->
           <ul id="filterControls" class="list-inline cbp-l-filters-alignRight text-center">
               <li class="list-inline-item cbp-filter-item cbp-filter-item-active u-cubeportfolio__item asociado" data-filter="*">Asociados</li>
               @foreach($especialidades as $item)
                   <li class="list-inline-item cbp-filter-item u-cubeportfolio__item asociado" data-filter=".{{ Str::slug($item) }}">{{ $item }}</li>
               @endforeach
           </ul>
           <!-- End Filter -->

            <!-- Content -->
            <div id="grid-container" class="container_grid cards_instProf">
                @foreach ($objProfesionalesIns as $profesional)
                    <div class="card tarjeta_instProf cbp-item {{ Str::slug($profesional->nombre_especialidad) }}">
                        <img class="img_perfil_instProf" src="{{ asset($profesional->foto_perfil_institucion) }}">
                        <div class="card-body content_tarjeta_instProf">
                            <h2>{{$profesional->nombre_especialidad}}</h2>
                            <h2>{{$profesional->nombre_especialidad}}</h2>
                            <h5 class="niega_uppercase">{{$profesional->primer_nombre}} {{$profesional->primer_apellido}}</h5>
                            <p>Especialista en {{$profesional->nombre_especialidad}}</p>
                            <p>Especialista en {{$profesional->nombre_especialidad}}</p>
                            <p>{{$profesional->nombre_universidad}}</p>
                            <h4>{{$profesional->cargo}}</h4>
                            <div class="content_btn_instprof">
                                <a class="btn_agendar_instProf" href=""> Agendar cita
                                    <i class="fas fa-arrow-right arrow_mas"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- End Content -->
        </div>
    </section>
@endsection

@section('scripts')
    <script src="{{ asset('plugins/cubeportfolio-full/js/jquery.cubeportfolio.min.js') }}"></script>

    <script type="text/javascript">
        jQuery(document).ready( function() {
            jQuery('#grid-container').cubeportfolio({
                filters: '#filterControls',
                mediaQueries: [
                    {"width" : 1500, "cols" : 4},
                    {"width" : 1100, "cols" : 4},
                    {"width" : 700, "cols" : 3},
                    {"width" : 480, "cols" : 1},
                    {"width" : 300, "cols" : 1},
                ]
                
            });
        });
    </script>
@endsection


