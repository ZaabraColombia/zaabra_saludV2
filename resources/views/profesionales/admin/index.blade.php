@extends('profesionales.admin.layouts.panel')

@section('contenido')
    <div class="container py-4 px-lg-5">
        <div class="row m-0 p-0">
            <div class="col-12 col-lg-8 col-xl-9 p-0 m-0">
                <div class="row m-0 justify-content-between">
                    <!-- Mis calendario -->
                    <div class="col-6 col-md-4 col-lg-6 col-xl-4 p-2">
                        <a  href='{{ route('profesional.agenda.calendario') }}'>
                            <div class="content__target calendario_blue">
                                <span class="subtitle__lg">Mi Calendario</span>
                            </div>
                        </a>
                    </div>
                    <!-- Mis citas -->
                    <div class="col-6 col-md-4 col-lg-6 col-xl-4 p-2">
                        <a  href='{{ route('profesional.agenda.citas') }}'>
                            <div class="content__target cita_blue">
                                <span class="subtitle__lg">Mis Citas</span>
                            </div>
                        </a>
                    </div>
                    <!-- Mis pagos -->
                    <div class="col-6 col-md-4 col-lg-6 col-xl-4 p-2">
                        <a  href='{{ route('profesional.pagos') }}'>
                            <div class="content__target pago_blue">
                                <span class="subtitle__lg">Mis Pagos</span>
                            </div>
                        </a>
                    </div>
                    <!-- Mis pacientes -->
                    <div class="col-6 col-md-4 col-lg-6 col-xl-4 p-2">
                        <a  href='{{ route('profesional.pacientes') }}'>
                            <div class="content__target paciente_blue">
                                <span class="subtitle__lg">Mis Pacientes</span>
                            </div>
                        </a>
                    </div>
                    <!-- Mis contactos -->
                    <div class="col-6 col-md-4 col-lg-6 col-xl-4 p-2">
                        <a  href='{{ route('profesional.contactos.index') }}'>
                            <div class="content__target contacto_blue">
                                <span class="subtitle__lg">Mis Contactos</span>
                            </div>
                        </a>
                    </div>
                    <!-- Mis favoritos -->
                    <div class="col-6 col-md-4 col-lg-6 col-xl-4 p-2">
                        <a  href='{{ route('profesional.favoritos') }}'>
                            <div class="content__target favorito_blue">
                                <span class="subtitle__lg">Mis Favoritos</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-4 col-xl-3 p-0 m-0">
                <div class="row m-0">
                    <!-- PLM -->
                    <div class="col-6 col-lg-12 py-3 px-2 py-lg-2">
                        <a  href="https://www.prescripciontotal.com.co/consultorio-generico/login" target="_blank">
                            <div class="content__logos">
                                <img src="{{ asset('/img/agenda/panelPrincipal/profesionales/plm.png') }}" alt="">
                            </div>
                        </a>
                    </div>
                    <!-- Mipres -->
                    <div class="col-6 col-lg-12 py-3 px-2 py-lg-2">
                        <a  href="https://mipres.sispro.gov.co/MIPRESNOPBS/Login.aspx?ReturnUrl=%2fMIPRESNOPBS" target="_blank">
                            <div class="content__logos ">
                                <img src="{{ asset('/img/agenda/panelPrincipal/profesionales/mipres-zaabra.png') }}" alt="">
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

