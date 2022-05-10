@extends('profesionales.admin.layouts.panel')

@section('contenido')
    <div class="container py-4 px-lg-5">
        <div class="row m-0 p-0">
            <div class="col-12 col-lg-8 col-xl-9 p-0 m-0">
                <div class="row m-0 justify-content-start">
                    {{-- Calendario --}}
                    @can('accesos-profesional',['ver-calendario'])
                        <div class="col-6 col-md-4 col-lg-6 col-xl-4 p-2">
                            <a  href='{{ route('profesional.agenda.calendario') }}'>
                                <div class="content__target calendario_blue">
                                    <span class="subtitle__lg">Calendario</span>
                                </div>
                            </a>
                        </div>
                    @endcan
                    {{-- Citas --}}
                    @can('accesos-profesional',['ver-citas'])
                        <div class="col-6 col-md-4 col-lg-6 col-xl-4 p-2">
                            <a  href='{{ route('profesional.agenda.citas') }}'>
                                <div class="content__target cita_blue">
                                    <span class="subtitle__lg">Citas</span>
                                </div>
                            </a>
                        </div>
                    @endcan
                    {{-- Pagos --}}
                    @can('accesos-profesional',['ver-pagos'])
                        <div class="col-6 col-md-4 col-lg-6 col-xl-4 p-2">
                            <a  href='{{ route('profesional.pagos') }}'>
                                <div class="content__target pago_blue">
                                    <span class="subtitle__lg">Pagos</span>
                                </div>
                            </a>
                        </div>
                    @endcan
                    {{-- Pacientes --}}
                    @can('accesos-profesional',['ver-pacientes'])
                        <div class="col-6 col-md-4 col-lg-6 col-xl-4 p-2">
                            <a  href='{{ route('profesional.pacientes') }}'>
                                <div class="content__target paciente_blue">
                                    <span class="subtitle__lg">Pacientes</span>
                                </div>
                            </a>
                        </div>
                    @endcan
                    {{-- Contactos --}}
                    @can('accesos-profesional',['ver-contactos'])
                        <div class="col-6 col-md-4 col-lg-6 col-xl-4 p-2">
                            <a  href='{{ route('profesional.contactos.index') }}'>
                                <div class="content__target contacto_blue">
                                    <span class="subtitle__lg">Contactos</span>
                                </div>
                            </a>
                        </div>
                    @endcan
                    {{-- Favoritos --}}
                    @can('accesos-profesional',['ver-favoritos'])
                        <div class="col-6 col-md-4 col-lg-6 col-xl-4 p-2">
                            <a  href='{{ route('profesional.favoritos') }}'>
                                <div class="content__target favorito_blue">
                                    <span class="subtitle__lg">Favoritos</span>
                                </div>
                            </a>
                        </div>
                    @endcan
                    {{-- Convenios --}}
                    @can('accesos-profesional',['ver-convenios'])
                        <div class="col-6 col-md-4 col-lg-6 col-xl-4 p-2">
                            <a  href='{{ route('profesional.configuracion.convenios.index') }}'>
                                <div class="content__target convenio_blue">
                                    <span class="subtitle__lg">Convenios</span>
                                </div>
                            </a>
                        </div>
                    @endcan
                    {{-- Servicios --}}
                    @can('accesos-profesional',['ver-servicios'])
                        <div class="col-6 col-md-4 col-lg-6 col-xl-4 p-2">
                            <a  href='{{ route('profesional.configuracion.servicios.index') }}'>
                                <div class="content__target servicio_blue">
                                    <span class="subtitle__lg">Servicios</span>
                                </div>
                            </a>
                        </div>
                    @endcan

                    {{-- Usuarios --}}
                    @can('accesos-profesional',['ver-servicios'])
                        <div class="col-6 col-md-4 col-lg-6 col-xl-4 p-2">
                            <a  href='{{ route('profesional.configuracion.usuarios.index') }}'>
                                <div class="content__target usuario_blue">
                                    <span class="subtitle__lg">Usuarios</span>
                                </div>
                            </a>
                        </div>
                    @endcan
                </div>
            </div>

            <div class="col-12 col-lg-4 col-xl-3 p-0 m-0">
                <div class="row m-0">
                    {{-- Mipres --}}
                    <div class="col-6 col-md-4 col-lg-12 py-3 px-2 py-lg-2">
                        <a  href="https://mipres.sispro.gov.co/MIPRESNOPBS/Login.aspx?ReturnUrl=%2fMIPRESNOPBS" target="_blank">
                            <div class="content__logos ">
                                <img src="{{ asset('/img/agenda/panelPrincipal/profesionales/mipres-zaabra.png') }}" alt="">
                            </div>
                        </a>
                    </div>
                    {{-- Medhistoria --}}
                    <div class="col-6 col-md-4 col-lg-12 py-3 px-2 py-lg-2">
                        <a  href="" target="_blank">
                            <div class="content__logos ">
                                <img src="{{ asset('/img/agenda/panelPrincipal/profesionales/logo_medhistoria_banner.png') }}" alt="">
                            </div>
                        </a>
                    </div>
                    {{-- PLM --}}
                    <div class="col-6 col-md-4 col-lg-12 py-3 px-2 py-lg-2">
                        <a  href="https://www.prescripciontotal.com.co/consultorio-generico/login" target="_blank">
                            <div class="content__logos">
                                <img src="{{ asset('/img/agenda/panelPrincipal/profesionales/plm.png') }}" alt="">
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

