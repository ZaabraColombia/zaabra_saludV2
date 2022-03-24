@extends('panelAdministrativoPac.panelAdministrativo')

@section('styles')
    <!-- Libreria de calendar_date min.css -->
    <link rel="stylesheet" href="{{ asset('plugins/pg-calendar-master/dist/css/pignose.calendar.min.css') }}">
@endsection

@section('Panel')
    <div class="container-fluid px-lg-0">
        @if(isset($profesional))  
            <div class="content_row"> 
                <div id="data-eventos-profesional" data-events='[{"id":0,"title":"Medicina","profesional":"Jorge Machado","start":"2021-08-21","tipo_cita":"Virtual","allDay":true},{"id":1,"title":"Medicina","profesional":"Jorge Machado","start":"2021-08-22","tipo_cita":"Virtual","allDay":true},{"id":2,"title":"Odontologia","profesional":"Jhoana Gutierres","start":"2021-08-23","tipo_cita":"Prensencial","allDay":true},{"id":3,"title":"Odontologia","profesional":"Jhoana Gutierres","start":"2021-08-24","tipo_cita":"Prensencial","allDay":true}]'></div>                    
                <!-- Información del Profesional -->
                <div class="col_flex w_lg_35">
                    <div class="content_img_center w_md_35">
                        <img src="{{ asset($profesional->fotoperfil) }}">
                    </div>
                    
                    <div class="w_md_65 w_lg_100">
                        <h2 class="fs_title_module blue_bold" id="nombre_profesional-paciente">
                            {{$profesional->primernombre}} {{$profesional->segundonombre}} {{$profesional->primerapellido}} {{$profesional->segundoapellido}}
                        </h2>
                        <h4 class="fs_subtitle_module black_bold mb-0" id="especialidad_profesional-paciente">{{$profesional->nombreEspecialidad}}</h4>
                        <h5 class="fs_text gray_light">{{$profesional->nombreuniversidad}}</h5>
                        <h5 class="fs_text gray_bold">N° Tarjeta profesional: {{$profesional->numeroTarjeta}}</h5>
                        <!-- Rating Stars Box -->
                        <!-- <div class='rating-stars star_box'>
                            @if(!empty($comentarios))
                                @foreach($comentarios as $promedioEstrellas)
                                @endforeach
                                @for ($i=1; $i <= $promedioEstrellas->calificacionRedondeada; $i++)
                                    <li class='star' title='Poor'>
                                        <i class='fa fa-star fa-fw' style="color: #E6C804;"></i>
                                    </li>
                                @endfor
                                @for ($i=$promedioEstrellas->calificacionRedondeada; $i <= 4; $i++)
                                    <li class='star' title='Poor'>
                                        <i class="far fa-star" style="color: #E6C804;"></i>
                                    </li>
                                @endfor
                            @endif
                        </div> -->

                        <!-- <div class="contains_direccion"></div> -->
                        <h5 class="fs_text gray_light"><i></i>{{ $profesional->direccion }}</h5>
                        <h5 class="fs_text gray_light">{{ $profesional->nombre }}</h5>

                        <!-- seccion datos consulta perfil profesional-->
                        <div class="mt-2 mb-3 w_md_85 w_lg_100 w_xl_90">
                            <h3 class="fs_subtitle_module black_bold text-center">Tipo de consulta</h3>
                            <div class="list__form_column">
                                <ul class="">
                                    @foreach ($consultas as $consulta)
                                        <li>
                                            <p class="fs_text_small gray_light menu_{{$loop->iteration}}"><i></i>{{$consulta->nombreconsulta}}</p>
                                            <span class="fs_text_small gray_light"><i></i>${{number_format($consulta->valorconsulta, 0, ",", ".") }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="content_row w_lg_65">
                    <div class="col_flex col_flex_md">
                        <div class="calendar w-100"></div>
                    </div>   
                    
                    <div class="content_row col_flex_md ml-md-auto mt-lg-2">
                        <div class="col_flex">
                            <div class="mt-4 mb-3 mt-md-0">
                                <span class="badge rounded-pill bg-primary mb-3">Días disponibles</span>
                                <span class="badge rounded-pill bg-secondary mb-3">Días no disponibles</span>
                                <span class="badge rounded-pill bg-success mb-3">Días seleccionados</span>
                            </div>
                        </div>

                        <div class="col_block mb-3 mt-md-1 mb-md-0 mt-lg-0">
                            <div class="input__box mb-3">
                                <label for="tipo_cita-select-paciente" class="">Modalidad de pago</label>
                                <select id="tipo_cita-select-paciente" class="form-control" name="tipo_cita-select-paciente">
                                    <option value="Presencial"> Presencial </option>
                                    <option value="Virtual"> Virtual </option>
                                </select>
                            </div>
                            <div class="input__box mb-3">
                                <label for="tipo_cita-select-paciente" class="">Tipo de cita</label>
                                <select id="tipo_cita-select-paciente" class="form-control" name="tipo_cita-select-paciente">
                                    <option value="Presencial"> Presencial </option>
                                    <option value="Virtual"> Virtual </option>
                                    <option value="Control médico"> Control</option>
                                </select>
                            </div>
                            <div class="input__box mb-3">
                                <label for="hora_input-paciente">Hora de la cita</label>
                                <input type="time" id="hora_input-paciente" name="hora_input-paciente">
                            </div>

                            <div class="row m-0 content_btn_right">
                                <button type="submit" class="button_blue" data-toggle="modal" data-target="#exampleModal">Finalizar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        @endif
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="fs_title_module black_bold" id="exampleModalLabel">Detalles de la cita</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <h5>Fernando Alexander Sandoval Gutierrez</h5>
                        <h5>Cc 1033456847</h5>
                    </div>
                    <div>
                        <h5>Dra. Claudia Marcela Perez Jimenez</h5>
                        <h5>Tipo cita: ita presencial</h5>
                        <h5>Hora cita: 04:00 P.M.</h5>
                        <h5>Dirección: Carrera 8 # 127 - 85</h5>
                        <h5>Valor cita: 120.000</h5>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://momentjs.com/downloads/moment-with-locales.min.js"></script>
    <!-- Full calendar JS -->

    <!-- Libreria de calendar_date min.js -->
    <script src="{{ asset('plugins/pg-calendar-master/dist/js/pignose.calendar.min.js') }}"></script>
    <script>
        $(function() {
            $('.calendar').pignoseCalendar({
		        lang: 'es',
                minDate: '2022-01-15',
		        maxDate: '2022-06-24',
                disabledWeekdays: [3], // WEDNESDAY (0)
                disabledDates: [
                    '2022-03-08',
                    '2022-03-19',
                    '2022-03-30'
                ],
                disabledRanges: [
                    ['2022-04-07', '2022-04-22'], // 2022-04-07 ~ 22
                ],
	        });
        });
    </script>
@endsection
