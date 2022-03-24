@extends('layouts.app-admin')

@section('content')
    <div class="container pt-4">
        <div id="imprimir">
            <div class="mt-3 mb-5">
                <h1 class="fs_title blue_light">Comprobante de pago en línea</h1>
            </div>
            <div class="row mb-4">
                {{-- Datos --}}
                @php
                    $paciente = $historial->pago_cita->cita->paciente;
                @endphp

                @if($historial->metodo == 'bank_account')
                    <div class="col-12">
                        <span class="fs_subtitle black_bold font_roboto">Tipo de pago: &nbsp;&nbsp;&nbsp;</span>
                        <span class="fs_subtitle black_light font_roboto">PSE</span>
                    </div>
                @endif

                <div class="col-12">
                    <span class="fs_subtitle black_bold font_roboto">Pago realizado por: &nbsp;&nbsp;&nbsp;</span>
                    <span class="fs_subtitle black_light font_roboto">{{ $paciente->user->nombre_completo }}</span>
                </div>

                @php
                    $cita = $historial->pago_cita->cita;
                    $profesional = $historial->pago_cita->cita->profesional;
                @endphp
                <div class="col-12">
                    <span class="fs_subtitle black_bold font_roboto">Descripción de pago: &nbsp;&nbsp;&nbsp;</span>
                    <span class="fs_subtitle black_light font_roboto">{{ "Cita medica {$profesional->user->nombre_completo} "
                    . "{$cita->fecha_inicio->format('Y-m-d')} / "
                    . "{$cita->fecha_inicio->format('H:i A')} - {$cita->fecha_fin->format('H:i A')} / "
                    . "{$cita->lugar}" }}</span>
                </div>

                <div class="col-12">
                    <span class="fs_subtitle black_bold font_roboto">N° de referencia: &nbsp;&nbsp;&nbsp;</span>
                    <span class="fs_subtitle black_light font_roboto">{{ $historial->referencia_autorizacion }}</span>
                </div>
                <div class="col-12">
                    <span class="fs_subtitle black_bold font_roboto">Fecha y hora de la transacción: &nbsp;&nbsp;&nbsp;</span>
                    <span class="fs_subtitle black_light font_roboto">{{ $historial->fecha->format('d-M \d\e\l Y h:i a') }}</span>
                </div>

                <div class="col-12">
                    <span class="fs_subtitle black_bold font_roboto">Número de comprobante: &nbsp;&nbsp;&nbsp;</span>
                    <span class="fs_subtitle black_light font_roboto">{{ $historial->respuesta['id'] }}</span>
                </div>

                @if($historial->metodo == 'card')
                    <div class="col-12">
                        <span class="fs_subtitle black_bold font_roboto">Código del Banco: &nbsp;&nbsp;&nbsp;</span>
                        <span class="fs_subtitle black_light font_roboto">{{ $historial->respuesta['authorization'] }}</span>
                    </div>

                    <div class="col-12">
                        <span class="fs_subtitle black_bold font_roboto">Nombre del Banco: &nbsp;&nbsp;&nbsp;</span>
                        <span class="fs_subtitle black_light font_roboto">{{ $historial->respuesta['card']['bank_name'] }}</span>
                    </div>
                @endif
                <div class="col-12">
                    <span class="fs_subtitle black_bold font_roboto">Valor: &nbsp;&nbsp;&nbsp;</span>
                    <span class="fs_subtitle black_light font_roboto">${{ number_format($historial->pago_cita->valor, 0, ",", ".") }}</span>
                </div>
                @if($historial->metodo == 'card')
                    <div class="col-12">
                        <span class="fs_subtitle black_bold font_roboto">Cuenta: &nbsp;&nbsp;&nbsp;</span>
                        <span class="fs_subtitle black_light font_roboto">{{ $historial->respuesta['card']['serializableData']['card_number'] }}</span>
                    </div>
                @endif
                <div class="col-12">
                    <span class="fs_subtitle black_bold font_roboto">Estado de la transacción: &nbsp;&nbsp;&nbsp;</span>
                    <span class="fs_subtitle black_light font_roboto">TRANSACCIÓN {{ $historial->estado ? 'APROBADA':'RECHAZADA' }}</span>
                </div>
            </div>
        </div>

        <div class="content_btn_center py-5">
            <button class="fs_subtitle button_green ml-3" type="button" onclick="imprimir()">Descargar</button>
            <button class="fs_subtitle button_blue ml-3" type="button" onclick="finalizar()">Finalizar</button>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        function finalizar() {
            window.close();
        }

        function imprimir(){
            var ventana = window.open('', 'PRINT', 'height=400,width=600');
            ventana.document.write('<html><head><title>Comprobante de pago</title>');
            ventana.document.write('<link rel="stylesheet" href="{{ mix('css/app.css') }}">'); //Aquí agregué la hoja de estilos
            ventana.document.write('</head><body >');
            ventana.document.write(document.querySelector('#imprimir').innerHTML);
            ventana.document.write('</body></html>');
            ventana.document.close();
            ventana.focus();
            ventana.onload = function() {
                ventana.print();
                ventana.close();
            };
        }
    </script>

@endsection
