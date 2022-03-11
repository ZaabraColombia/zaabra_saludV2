@extends('layouts.app')

@section('content')
    <div class="container pt-4">
        <div class="mt-3 mb-5">
            <h1 class="fs_title blue_light">Comprobante de pago en línea</h1>
        </div>

        <div class="row mb-4">
            <div class="col-12">
                <span class="fs_subtitle black_bold font_roboto">Pago realizado por: &nbsp;&nbsp;&nbsp;</span>
                <span class="fs_subtitle black_light font_roboto">Marco Antonio Garzón Sepúlveda</span>
            </div>

            <div class="col-12">
                <span class="fs_subtitle black_bold font_roboto">Descripción de pago: &nbsp;&nbsp;&nbsp;</span>
                <span class="fs_subtitle black_light font_roboto">Cita presencial</span>
            </div>

            <div class="col-12">
                <span class="fs_subtitle black_bold font_roboto">N° de referencia: &nbsp;&nbsp;&nbsp;</span>
                <span class="fs_subtitle black_light font_roboto">000000000000</span>
            </div>

            <div class="col-12">
                <span class="fs_subtitle black_bold font_roboto">Fecha y hora de la transacción: &nbsp;&nbsp;&nbsp;</span>
                <span class="fs_subtitle black_light font_roboto">Jueves 10 de Marzo de 2022 05:59:35 a.m.</span>
            </div>

            <div class="col-12">
                <span class="fs_subtitle black_bold font_roboto">Número de comprobante: &nbsp;&nbsp;&nbsp;</span>
                <span class="fs_subtitle black_light font_roboto">123561555</span>
            </div>

            <div class="col-12">
                <span class="fs_subtitle black_bold font_roboto">Código del Banco: &nbsp;&nbsp;&nbsp;</span>
                <span class="fs_subtitle black_light font_roboto">0002</span>
            </div>

            <div class="col-12">
                <span class="fs_subtitle black_bold font_roboto">Nombre del Banco: &nbsp;&nbsp;&nbsp;</span>
                <span class="fs_subtitle black_light font_roboto">0017</span>
            </div>

            <div class="col-12">
                <span class="fs_subtitle black_bold font_roboto">Valor: &nbsp;&nbsp;&nbsp;</span>
                <span class="fs_subtitle black_light font_roboto">$ 100.000</span>
            </div>

            <div class="col-12">
                <span class="fs_subtitle black_bold font_roboto">Cuenta: &nbsp;&nbsp;&nbsp;</span>
                <span class="fs_subtitle black_light font_roboto">********5461</span>
            </div>

            <div class="col-12">
                <span class="fs_subtitle black_bold font_roboto">Estado de la transacción: &nbsp;&nbsp;&nbsp;</span>
                <span class="fs_subtitle black_light font_roboto">TRANSACCIÓN APROBADA – TRANSACCIÓN RECHAZADA</span>
            </div>
        </div>

        <div class="content_btn_center py-5">
            <button class="fs_subtitle button_green ml-3" type="button">Descargar</button>
            <button class="fs_subtitle button_blue ml-3" type="button">Finalizar</button>
        </div>
    </div>
@endsection

@section('scripts')
@endsection