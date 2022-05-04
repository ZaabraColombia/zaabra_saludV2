@extends('layouts.app-admin')

@section('content')
    <div class="container pt-3 pt-lg-5">
        <div class="my-3">
            <h1 class="fs_title blue_light">Notificación de Pago</h1>
        </div>
        {{--        <div class="row mb-4">--}}
        {{--            <div class="col-12">--}}
        {{--                <h4 class="fs_subtitle black_bold font_roboto">Nombre de la Institución</h4>--}}
        {{--                <h4 class="fs_subtitle black_bold font_roboto">MedPlus Ltda</h4>--}}
        {{--                <h4 class="fs_subtitle black_bold font_roboto">Nit: 901297863-1</h4>--}}
        {{--                <h4 class="fs_subtitle black_bold font_roboto">Carrera 15 25 87</h4>--}}
        {{--            </div>--}}
        {{--        </div>--}}

        <div class="row mb-4">
            <div class="col-12 col-lg-7 mb-4 mb-lg-0">
                <h4 class="fs_subtitle black_bold font_roboto">Información del profesional</h4>
                <p class="fs_subtitle black_light font_roboto">Dr.(a) {{ $pagoCita->cita->profesional->user->nombre_completo }}</p>
                <span class="fs_subtitle black_light font_roboto">Especialidad:</span>
                <span class="fs_subtitle black_light font_roboto">{{ $pagoCita->cita->profesional->especialidad->nombreEspecialidad }}</span>
                <p class="fs_subtitle black_light font_roboto">Fecha:
                    <span>{{ "{$pagoCita->cita->fecha_inicio->format('d-M/Y')}" }}</span>
                </p>
                <p class="fs_subtitle black_light font_roboto">Hora:
                    <span>{{ "{$pagoCita->cita->fecha_inicio->format('H:i a')} - {$pagoCita->cita->fecha_fin->format('H:i a')}" }}</span>
                </p>
                <p class="fs_subtitle black_light font_roboto">Dirección:
                    <span">{{ $pagoCita->cita->lugar }}</span>
                </p>
                <p class="fs_subtitle black_light font_roboto">Tipo de cita: Presencial</p>
                <p class="fs_subtitle black_light font_roboto">Valor: ${{ number_format($pagoCita->valor, 0, ",", ".") }}</p>
            </div>

            <div class="col-12 col-lg-5">
                <h4 class="fs_subtitle black_bold font_roboto">Información del paciente</h4>
                <p class="fs_subtitle black_light font_roboto">{{ $pagoCita->cita->paciente->user->nombre_completo }}</p>
                <p class="fs_subtitle black_light font_roboto">{{ $pagoCita->cita->paciente->user->numerodocumento }}</p>
                <p class="fs_subtitle black_light font_roboto">Correo electrónico: {{ $pagoCita->cita->paciente->user->email }}</p>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-12">
                <h4 class="mb-3 fs_subtitle black_bold font_roboto">Pague aquí:</h4>
                <div class="row d-flex m-0 justify-content-center">

                    @if($pagoCita->aprobado == false and $pagoCita->tipo == 'virtual')
                        <div class="col-6 col-lg-4 pr-2 pl-0">
                            <a href="{{ route('profesional.pago-cita', ['pago_cita' => $pagoCita->id, 'metodo_pago' => 'pse']) }}">
                                <img class="d-flex m-auto" id="img_pagoPse" src="{{ asset('/img/banners/carruselhome/pse_pago-en-linea.png') }}" style="width: 112px">
                                <h4 class="fs_subtitle black_bold text-center">Pagos seguros en línea</h4>
                            </a>
                        </div>
                        <div class="col-6 col-lg-4 p-0 pl-md-0" style="border-left: 1px solid #c5c3c3;">
                            <a href="{{ route('profesional.pago-cita', ['pago_cita' => $pagoCita->id, 'metodo_pago' => 'card']) }}">
                                <img class="d-flex m-auto" id="img_tarjCred" src="{{ asset('/img/popup-pago/tarjetas-de-credito-azul.svg') }}">
                                <h4 class="fs_subtitle black_bold text-center">Tarjeta de crédito</h4>
                            </a>
                        </div>
                    @endif
                    @if($pagoCita->aprobado == true and $pagoCita->tipo == 'virtual')
                        <h3 class="fs_subtitle black_bold font_roboto">La cita esta pagada correctamente.</h3>
                    @endif
                    @if($pagoCita->tipo == 'presencial')
                        <h3 class="fs_subtitle black_bold font_roboto">La cita se debe pagar en el consultorio o entidad.</h3>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
