@extends('instituciones.admin.layouts.layout')

@section('contenido')
    <div class="container py-4 px-lg-5">
        <div class="row m-0 p-0">
            <div class="col-12 col-lg-8 col-xl-9 p-0 m-0">
                <div class="row m-0 justify-content-between">
                    {{-- Profesionales --}}
                    @can('accesos-institucion','ver-profesionales')
                        <div class="col-6 col-md-4 col-lg-6 col-xl-4 p-2">
                            <a  href='{{ route('institucion.profesionales.index') }}'>
                                <div class="content__target_inst profesional_green">
                                    <span class="subtitle__lg">Profesionales</span>
                                </div>
                            </a>
                        </div>
                    @endcan
                    {{-- Citas --}}
                    @can('accesos-institucion','ver-citas')
                        <div class="col-6 col-md-4 col-lg-6 col-xl-4 p-2">
                            <a  href='{{ route('institucion.citas') }}'>
                                <div class="content__target_inst cita_green">
                                    <span class="subtitle__lg">Citas</span>
                                </div>
                            </a>
                        </div>
                    @endcan
                    {{-- Pagos --}}
                    @can('accesos-institucion','ver-pagos')
                        <div class="col-6 col-md-4 col-lg-6 col-xl-4 p-2">
                            <a  href='{{ route('institucion.pagos') }}'>
                                <div class="content__target_inst pago_green">
                                    <span class="subtitle__lg">Pagos</span>
                                </div>
                            </a>
                        </div>
                    @endcan
                    {{-- Pacientes --}}
                    @can('accesos-institucion','ver-pacientes')
                        <div class="col-6 col-md-4 col-lg-6 col-xl-4 p-2">
                            <a  href='{{ route('institucion.pacientes') }}'>
                                <div class="content__target_inst paciente_green">
                                    <span class="subtitle__lg">Pacientes</span>
                                </div>
                            </a>
                        </div>
                    @endcan
                    {{-- Contactos --}}
                    @can('accesos-institucion','ver-contactos')
                        <div class="col-6 col-md-4 col-lg-6 col-xl-4 p-2">
                            <a  href='{{ route('institucion.contactos.index') }}'>
                                <div class="content__target_inst contacto_green">
                                    <span class="subtitle__lg">Contactos</span>
                                </div>
                            </a>
                        </div>
                    @endcan
                    {{-- Favoritos --}}
                    @can('accesos-institucion','favoritos')
                        <div class="col-6 col-md-4 col-lg-6 col-xl-4 p-2">
                            <a  href='{{ route('institucion.favoritos') }}'>
                                <div class="content__target_inst favorito_green">
                                    <span class="subtitle__lg">Favoritos</span>
                                </div>
                            </a>
                        </div>
                    @endcan

                    {{-- Usuarios --}}
                    @can('accesos-institucion','ver-usuarios')
                        <div class="col-6 col-md-4 col-lg-6 col-xl-4 p-2">
                            <a  href='{{ route('institucion.configuracion.usuarios.index') }}'>
                                <div class="content__target_inst usuario_green">
                                    <span class="subtitle__lg">Usuarios</span>
                                </div>
                            </a>
                        </div>
                    @endcan

                    {{-- Convenios --}}
                    @can('accesos-institucion','ver-convenios')
                        <div class="col-6 col-md-4 col-lg-6 col-xl-4 p-2">
                            <a  href='{{ route('institucion.configuracion.convenios.index') }}'>
                                <div class="content__target_inst convenio_green">
                                    <span class="subtitle__lg">Convenios</span>
                                </div>
                            </a>
                        </div>
                    @endcan

                    {{-- Servicios --}}
                    @can('accesos-institucion','ver-servicios')
                        <div class="col-6 col-md-4 col-lg-6 col-xl-4 p-2">
                            <a  href='{{ route('institucion.configuracion.servicios.index') }}'>
                                <div class="content__target_inst servicio_green">
                                    <span class="subtitle__lg">Servicios</span>
                                </div>
                            </a>
                        </div>
                    @endcan
                </div>
            </div>

            <div class="col-12 col-lg-4 col-xl-3 p-0 m-0">
                <div class="row m-0">
                    {{-- Mipres --}}
                    <div class="col-6 col-lg-12 py-3 px-2 py-lg-2">
                        <a  href="https://mipres.sispro.gov.co/MIPRESNOPBS/Login.aspx?ReturnUrl=%2fMIPRESNOPBS" target="_blank">
                            <div class="content__logos_inst">
                                <img src="{{ asset('/img/agenda/panelPrincipal/profesionales/mipres-zaabra.png') }}" alt="">
                            </div>
                        </a>
                    </div>
                    {{-- Medistoria --}}
                    <div class="col-6 col-md-4 col-lg-12 py-3 px-2 py-lg-2">
                        <a  href="" target="_blank">
                            <div class="content__logos_inst ">
                                <img src="{{ asset('/img/agenda/panelPrincipal/profesionales/logo_medhistoria_banner.png') }}" alt="">
                            </div>
                        </a>
                    </div>
                    {{-- PLM --}}
                    <div class="col-6 col-lg-12 py-3 px-2 py-lg-2">
                        <a  href="https://www.prescripciontotal.com.co/consultorio-generico/login" target="_blank">
                            <div class="content__logos_inst">
                                <img src="{{ asset('/img/agenda/panelPrincipal/profesionales/plm.png') }}" alt="">
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

