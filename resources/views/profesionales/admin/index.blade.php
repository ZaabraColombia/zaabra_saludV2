@extends('profesionales.admin.layouts.panel')

@section('contenido')
    <div class="container-fluid panel_container">
        <div class="row m-0 p-0">
            <div class="col-12 col-lg-9 px-0 m-0">
                <!-- Contenedor barra de búsqueda -->
                <div class="search_main_container mb-4">
                    <div class="row m-0">
                        <div class="col-12 p-0">
                            <input type="search" name="search" id="search" placeholder="Buscar" data-url="">
                            <button class="btnIn_search_blue"></button>
                        </div>
                    </div>
                </div>
                <!-- Contenedor cards menú panel -->
                <div class="row m-0 justify-content-start">
                    {{-- Calendario --}}
                    @can('accesos-profesional',['ver-calendario'])
                        <div class="col-6 col-md-4 col-xl-4 px-2 pb-4">
                            <a  href='{{ route('profesional.agenda.calendario') }}'>
                                <div class="card__menu_panel calendario_blue">
                                    <span class="txt_name_card">Calendario</span>
                                </div>
                            </a>
                        </div>
                    @endcan
                    {{-- Citas --}}
                    @can('accesos-profesional',['ver-citas'])
                        <div class="col-6 col-md-4 col-xl-4 px-2 pb-4">
                            <a  href='{{ route('profesional.agenda.citas') }}'>
                                <div class="card__menu_panel cita_blue">
                                    <span class="txt_name_card">Citas</span>
                                </div>
                            </a>
                        </div>
                    @endcan
                    {{-- Pagos --}}
                    @can('accesos-profesional',['ver-pagos'])
                        <div class="col-6 col-md-4 col-xl-4 px-2 pb-4">
                            <a  href='{{ route('profesional.pagos') }}'>
                                <div class="card__menu_panel pago_blue">
                                    <span class="txt_name_card">Pagos</span>
                                </div>
                            </a>
                        </div>
                    @endcan
                    {{-- Pacientes --}}
                    @can('accesos-profesional',['ver-pacientes'])
                        <div class="col-6 col-md-4 col-xl-4 px-2 pb-4">
                            <a  href='{{ route('profesional.pacientes') }}'>
                                <div class="card__menu_panel paciente_blue">
                                    <span class="txt_name_card">Pacientes</span>
                                </div>
                            </a>
                        </div>
                    @endcan
                    {{-- Contactos --}}
                    @can('accesos-profesional',['ver-contactos'])
                        <div class="col-6 col-md-4 col-xl-4 px-2 pb-4">
                            <a  href='{{ route('profesional.contactos.index') }}'>
                                <div class="card__menu_panel contacto_blue">
                                    <span class="txt_name_card">Contactos</span>
                                </div>
                            </a>
                        </div>
                    @endcan
                    {{-- Favoritos --}}
                    @can('accesos-profesional',['ver-favoritos'])
                        <div class="col-6 col-md-4 col-xl-4 px-2 pb-4">
                            <a  href='{{ route('profesional.favoritos') }}'>
                                <div class="card__menu_panel favorito_blue">
                                    <span class="txt_name_card">Favoritos</span>
                                </div>
                            </a>
                        </div>
                    @endcan
                    {{-- Convenios --}}
                    @can('accesos-profesional',['ver-convenios'])
                        <div class="col-6 col-md-4 col-xl-4 px-2 pb-4">
                            <a  href='{{ route('profesional.configuracion.convenios.index') }}'>
                                <div class="card__menu_panel convenio_blue">
                                    <span class="txt_name_card">Convenios</span>
                                </div>
                            </a>
                        </div>
                    @endcan
                    {{-- Servicios --}}
                    @can('accesos-profesional',['ver-servicios'])
                        <div class="col-6 col-md-4 col-xl-4 px-2 pb-4">
                            <a  href='{{ route('profesional.configuracion.servicios.index') }}'>
                                <div class="card__menu_panel servicio_blue">
                                    <span class="txt_name_card">Servicios</span>
                                </div>
                            </a>
                        </div>
                    @endcan

                    {{-- Usuarios --}}
                    @can('accesos-profesional',['ver-servicios'])
                        <div class="col-6 col-md-4 col-xl-4 px-2 pb-4">
                            <a  href='{{ route('profesional.configuracion.usuarios.index') }}'>
                                <div class="card__menu_panel usuario_blue">
                                    <span class="txt_name_card">Usuarios</span>
                                </div>
                            </a>
                        </div>
                    @endcan
                </div>
            </div>

            <div class="col-12 col-lg-3 p-0">
                <div class="row m-0">
                    {{-- Mipres --}}
                    <div class="col-12 col-md-4 col-lg-12 pb-4 px-4 px-md-2 pr-xl-4">
                        <a  href="https://mipres.sispro.gov.co/MIPRESNOPBS/Login.aspx?ReturnUrl=%2fMIPRESNOPBS" target="_blank">
                            <div class="card__logo_menu_panel">
                                <img class="img_card_menu_panel"
                                src="{{ asset('/img/agenda/panelPrincipal/profesionales/mipres-zaabra.png') }}" alt="">
                            </div>
                        </a>
                    </div>
                    {{-- Medhistoria --}}
                    <div class="col-12 col-md-4 col-lg-12 pb-4 px-4 px-md-2 pr-xl-4">
                        <a  href="" target="_blank">
                            <div class="card__logo_menu_panel">
                                <img class="img_card_menu_panel"
                                src="{{ asset('/img/agenda/panelPrincipal/profesionales/logo_medhistoria_banner.png') }}" alt="">
                            </div>
                        </a>
                    </div>
                    {{-- PLM --}}
                    <div class="col-12 col-md-4 col-lg-12 pb-4 px-4 px-md-2 pr-xl-4">
                        <a  href="https://www.prescripciontotal.com.co/consultorio-generico/login" target="_blank">
                            <div class="card__logo_menu_panel">
                                <img class="img_card_menu_panel"
                                src="{{ asset('/img/agenda/panelPrincipal/profesionales/plm.png') }}" alt="">
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

