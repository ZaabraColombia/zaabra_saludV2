@extends('layouts.app-admin')

@section('content')
    <div class="container pt-4">
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
            <div class="col-12 col-lg-6 mb-4 mb-lg-0">
                <h4 class="fs_subtitle black_bold font_roboto">Información del profesional</h4>
                <p class="fs_subtitle black_light font_roboto">Dr.(a) {{ $pagoCita->cita->profesional->user->nombre_completo }}</p>
                <p class="fs_subtitle black_light font_roboto">{{ $pagoCita->cita->profesional->especialidad->nombreEspecialidad }}</p>
                <p class="fs_subtitle black_light font_roboto">
                    Fecha y hora de la atención:
                    {{ "{$pagoCita->cita->fecha_inicio->format('d-M/Y H:i a')} - {$pagoCita->cita->fecha_fin->format('H:i a')}" }}
                </p>
                <p class="fs_subtitle black_light font_roboto">{{ $pagoCita->cita->lugar }}</p>
                <p class="fs_subtitle black_light font_roboto">Tipo de cita: Presencial</p>
                <p class="fs_subtitle black_light font_roboto">Valor: ${{ $pagoCita->valor }}</p>
            </div>

            <div class="col-12 col-lg-6">
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
                    <div class="col-6 col-lg-4 pr-2 pl-0">
                        <a href="{{ route('profesional.pago-cita', ['pago_cita' => $pagoCita->id, 'metodo_pago' => 'pse']) }}">
                            <img class="d-flex m-auto" id="img_pagoPse" src="{{ asset('/img/popup-pago/medios-online-pse-azul.svg') }}">
                            <h4 class="fs_subtitle black_bold text-center">Pagos seguros en línea</h4>
                        </a>
                    </div>
                    <div class="col-6 col-lg-4 p-0 pl-md-0" style="border-left: 1px solid #c5c3c3;">
                        <a href="{{ route('profesional.pago-cita', ['pago_cita' => $pagoCita->id, 'metodo_pago' => 'card']) }}">
                            <img class="d-flex m-auto" id="img_tarjCred" src="{{ asset('/img/popup-pago/tarjetas-de-credito-azul.svg') }}">
                            <h4 class="fs_subtitle black_bold text-center">Tarjeta de crédito</h4>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection