@extends('instituciones.admin.layouts.layout')

@section('contenido')
    <div class="container-fluid py-4 pt-xl-5 px-1 px-lg-5">
        <div class="row m-0 p-0">
            <div class="col-12">
                @if(session()->has('success'))
                    <div class="alert alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="alert-heading">Hecho!</h4>
                        <p>{{ session('success') }}</p>
                    </div>
                @endif
            </div>
            <div class="col-12 col-lg-9 px-0 m-0">
                <div class="search_main_container mb-3">
                    <div class="row m-0">
                        <div class="col-12 p-0 input__box mb-0">
                            <input class="mb-0 extremo_redondeado" type="search" name="search" id="search" placeholder="Buscar">
                            <button class="btnIn_search"><i data-feather="search"></i></button>
                        </div>
                    </div>
                </div>

                <div class="row m-0 justify-content-between">
                    {{-- Profesionales --}}
                    @can('accesos-institucion','ver-profesionales')
                        <div class="col-6 col-md-4 col-xl-4 p-2">
                            <a  href='{{ route('institucion.profesionales.index') }}'>
                                <div class="content__target_inst profesional_green">
                                    <span class="fs_text">Profesionales</span>
                                </div>
                            </a>
                        </div>
                    @endcan

                    {{-- Pacientes --}}
                    @can('accesos-institucion','ver-pacientes')
                        <div class="col-6 col-md-4 col-xl-4 p-2">
                            <a  href='{{ route('institucion.pacientes') }}'>
                                <div class="content__target_inst paciente_green">
                                    <span class="fs_text">Pacientes</span>
                                </div>
                            </a>
                        </div>
                    @endcan

                    {{-- Histórico de citas --}}
                    @can('accesos-institucion','ver-citas')
                        <div class="col-6 col-md-4 col-xl-4 p-2">
                            <a  href='{{ route('institucion.citas') }}'>
                                <div class="content__target_inst cita_green">
                                    <span class="fs_text">Histórico de citas</span>
                                </div>
                            </a>
                        </div>
                    @endcan

                    {{-- Pagos --}}
                    @can('accesos-institucion','ver-pagos')
                        <div class="col-6 col-md-4 col-xl-4 p-2">
                            <a  href='{{ route('institucion.pagos') }}'>
                                <div class="content__target_inst pago_green">
                                    <span class="fs_text">Pagos</span>
                                </div>
                            </a>
                        </div>
                    @endcan
                    
                    {{-- Usuarios --}}
                    @can('accesos-institucion','ver-usuarios')
                        <div class="col-6 col-md-4 col-xl-4 p-2">
                            <a  href='{{ route('institucion.configuracion.usuarios.index') }}'>
                                <div class="content__target_inst usuario_green">
                                    <span class="fs_text">Usuarios</span>
                                </div>
                            </a>
                        </div>
                    @endcan

                    {{-- Contactos --}}
                    @can('accesos-institucion','ver-contactos')
                        <div class="col-6 col-md-4 col-xl-4 p-2">
                            <a  href='{{ route('institucion.contactos.index') }}'>
                                <div class="content__target_inst contacto_green">
                                    <span class="fs_text">Contactos</span>
                                </div>
                            </a>
                        </div>
                    @endcan

                    {{-- Convenios --}}
                    @can('accesos-institucion','ver-convenios')
                        <div class="col-6 col-md-4 col-xl-4 p-2">
                            <a  href='{{ route('institucion.configuracion.convenios.index') }}'>
                                <div class="content__target_inst convenio_green">
                                    <span class="fs_text">Convenios</span>
                                </div>
                            </a>
                        </div>
                    @endcan

                    {{-- Servicios --}}
                    @can('accesos-institucion','ver-servicios')
                        <div class="col-6 col-md-4 col-xl-4 p-2">
                            <a  href='{{ route('institucion.configuracion.servicios.index') }}'>
                                <div class="content__target_inst servicio_green">
                                    <span class="fs_text">Servicios</span>
                                </div>
                            </a>
                        </div>
                    @endcan

                    {{-- Gestión --}}
                    <div class="col-6 col-md-4 col-xl-4 p-2">
                        <a  href="#">
                            <div class="content__target_inst gestion_green">
                                <span class="fs_text">Gestión</span>
                            </div>
                        </a>
                    </div>
                    
                    {{-- Favoritos 
                    @can('accesos-institucion','favoritos')
                        <div class="col-6 col-md-4 col-xl-4 p-2">
                            <a  href='{{ route('institucion.favoritos') }}'>
                                <div class="content__target_inst favorito_green">
                                    <span class="fs_text">Favoritos</span>
                                </div>
                            </a>
                        </div>
                    @endcan --}}
                </div>
            </div>

            <div class="col-12 col-lg-3 p-0 m-0">
                <div class="row m-0">
                    {{-- Mipres --}}
                    <div class="col-12 col-md-4 col-lg-12 pb-3 px-4 px-md-2 pr-xl-4">
                        <a  href="https://mipres.sispro.gov.co/MIPRESNOPBS/Login.aspx?ReturnUrl=%2fMIPRESNOPBS" target="_blank">
                            <div class="content__logos_inst">
                                <img src="{{ asset('/img/agenda/panelPrincipal/profesionales/mipres-zaabra.png') }}" alt="">
                            </div>
                        </a>
                    </div>
                    {{-- Medistoria --}}
                    <div class="col-12 col-md-4 col-lg-12 pb-3 px-4 px-md-2 pr-xl-4">
                        <a  href="" target="_blank">
                            <div class="content__logos_inst ">
                                <img src="{{ asset('/img/agenda/panelPrincipal/profesionales/logo_medhistoria_banner.png') }}" alt="">
                            </div>
                        </a>
                    </div>
                    {{-- PLM --}}
                    <div class="col-12 col-md-4 col-lg-12 py-0 px-4 px-md-2 pr-xl-4">
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

