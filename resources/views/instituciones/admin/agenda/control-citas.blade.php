@extends('paciente.admin.layouts.layout')

@section('styles')
    <!-- Librería de calendar_date min.css -->
    <link rel="stylesheet" href="{{ asset('plugins/pg-calendar-master/dist/css/pignose.calendar.min.css') }}">
@endsection

@section('contenido')
    @php
        $user = Auth::user();
    @endphp
    <div class="container-fluid content_asig_cita">

        <div class="content_row">
            <div class="col-12 w_lg_35" id="alertas">
                @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="alert-heading">Error</h4>
                        <p>{{ collect($errors->all())->implode('<br>') }}</p>
                    </div>
                @endif
            </div>
        </div>

        <div class="content_row mt_md_lg">
            <!-- Información del Profesional -->
            <div class="col_flex w_lg_35 align_between_1300">
                <div class="w-100 w_md_65 w_lg_100 px_xl pl-md-3">
                    <div class="col_block mb-3 mt-md-1 mb-md-0 mt-lg-0">
                        <form action="" method="post" id="">
                            @csrf
                            <input type="hidden" name="date-calendar" id="date-calendar">
                            <div class="input__box mb-3">
                                <label for="paciente">Paciente</label>
                                <select id="paciente" class="form-control" name="paciente" required>
                                    <option value=""></option>
                                    <option value="paciente 1">paciente 1</option>
                                    <option value="paciente 2"> paciente 2</option>
                                </select>
                            </div>

                            <div class="input__box mb-3">
                                <label for="profesional">Profesional</label>
                                <select id="profesional" class="form-control" name="profesional" required>
                                    <option value=""></option>
                                    <option value="profesional 1">profesional 1</option>
                                    <option value="profesional 2"> profesional 2</option>
                                </select>
                            </div>

                            <div class="input__box mb-3">
                                <label for="tipo_servicio">Tipo de servicio</label>
                                <select id="tipo_servicio" class="form-control" name="tipo_servicio" required>
                                    <option></option>
                                    @if(!empty($servicios))
                                        @foreach ($servicios as $servicio)
                                            <option value="{{ $servicio->id }}" data-valor="{{ $servicio->valor }}">{{ $servicio->nombre }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="content_row w_lg_65 my__md">
                <!-- Calendario -->
                <div class="col_flex col_flex_md">
                    <div class="calendar w-100"></div>
                </div>

                <div class="content_row col_flex_md ml-md-auto mt-lg-2 align_between_1300">
                    <div class="col_flex">
                        <div class="mt-4 mb-3 mt-md-0">
                            <span class="badge rounded-pill bg-primary mb-3 w-100">Días disponibles</span>
                            <span class="badge rounded-pill bg-secondary mb-3 w-100" style="opacity: .5;">Días no disponibles</span>
                            <span class="badge rounded-pill bg-success mb-3 w-100">Días seleccionados</span>
                        </div>
                    </div>

                    <div class="col_block mb-3 mt-md-1 mb-md-0 mt-lg-0">
                        <form action="" method="post" id="">
                            @csrf
                            <input type="hidden" name="date-calendar" id="date-calendar">
                            <div class="input__box mb-3">
                                <label for="modalidad">Modalidad de pago</label>
                                <select id="modalidad" class="form-control" name="modalidad" required>
                                    <option value="virtual">Virtual</option>
                                    <option value="presencial"> Presencial </option>
                                </select>
                            </div>

                            <div class="">
                                <label for="convenio">Convenio</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <input type="checkbox" id="check-convenio" name="check-convenio" value="1">
                                        </div>
                                    </div>
                                    <select class="custom-select" id="convenio" name="convenio" disabled></select>
                                </div>
                            </div>

                            <div class="input__box mb-3">
                                <label for="hora">Hora de la cita</label>
                                <select id="hora" name="hora"  class="form-control" required></select>
                            </div>

                            <div class="row m-0 content_btn_right">
                                <button type="button" class="button_blue" id="btn-finalizar-cita-profesional">
                                    Finalizar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/pg-calendar-master/dist/js/pignose.calendar.min.js') }}"></script>

    <script src="{{ asset('js/alertas.js') }}"></script>

    <script>
 
        moment.locale('es'); // change the global locale to Spanish

        $('.calendar').pignoseCalendar({
            lang: 'es',
            initialize: false,
            minDate: '',
            maxDate: '',
            /*maxDate: '2022-06-24',*/
            disabledWeekdays:'', // WEDNESDAY (0)
            disabledDates: [],
            disabledRanges: [
                //['2022-04-07', '2022-04-22'], // 2022-04-07 ~ 22
            ],

        });

    </script>
@endsection

