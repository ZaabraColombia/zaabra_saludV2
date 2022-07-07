@extends('profesionales.admin.layouts.panel')

@section('contenido')
    <div class="container-fluid panel_main_menu">
        <div class="row m-0">
            <!-- Sección tarjetas menú de opciones -->
            <div class="col-12 col-lg-9 p-0 m-0">
                <!-- Buscador -->
                <div class="row search__main_menu">
                    <div class="col-12 p-0">
                        <input type="search" name="search" id="search" placeholder="Buscar" data-url="">
                        <button class="icon_search_blue"></button>
                    </div>
                </div>
                <!-- Tarjetas de opciones -->
                <div class="row m-0 justify-content-start">
                    {{-- Calendario --}}
                    @can('accesos-profesional',['ver-calendario'])
                        <div class="col-6 col-md-4 card__menu">
                            <a  href='{{ route('profesional.agenda.calendario') }}'>
                                <div class="card__ calendario_blue">
                                    <span class="txt__card_menu">Calendario</span>
                                </div>
                            </a>
                        </div>
                    @endcan
                    {{-- Citas --}}
                    @can('accesos-profesional',['ver-citas'])
                        <div class="col-6 col-md-4 card__menu">
                            <a  href='{{ route('profesional.agenda.citas') }}'>
                                <div class="card__ cita_blue">
                                    <span class="txt__card_menu">Citas</span>
                                </div>
                            </a>
                        </div>
                    @endcan
                    {{-- Pagos --}}
                    @can('accesos-profesional',['ver-pagos'])
                        <div class="col-6 col-md-4 card__menu">
                            <a  href='{{ route('profesional.pagos') }}'>
                                <div class="card__ pago_blue">
                                    <span class="txt__card_menu">Pagos</span>
                                </div>
                            </a>
                        </div>
                    @endcan
                    {{-- Pacientes --}}
                    @can('accesos-profesional',['ver-pacientes'])
                        <div class="col-6 col-md-4 card__menu">
                            <a  href='{{ route('profesional.pacientes') }}'>
                                <div class="card__ paciente_blue">
                                    <span class="txt__card_menu">Pacientes</span>
                                </div>
                            </a>
                        </div>
                    @endcan
                    {{-- Contactos --}}
                    @can('accesos-profesional',['ver-contactos'])
                        <div class="col-6 col-md-4 card__menu">
                            <a  href='{{ route('profesional.contactos.index') }}'>
                                <div class="card__ contacto_blue">
                                    <span class="txt__card_menu">Contactos</span>
                                </div>
                            </a>
                        </div>
                    @endcan
                    {{-- Favoritos --}}
                    @can('accesos-profesional',['ver-favoritos'])
                        <div class="col-6 col-md-4 card__menu">
                            <a  href='{{ route('profesional.favoritos') }}'>
                                <div class="card__ favorito_blue">
                                    <span class="txt__card_menu">Favoritos</span>
                                </div>
                            </a>
                        </div>
                    @endcan
                    {{-- Convenios --}}
                    @can('accesos-profesional',['ver-convenios'])
                        <div class="col-6 col-md-4 card__menu">
                            <a  href='{{ route('profesional.configuracion.convenios.index') }}'>
                                <div class="card__ convenio_blue">
                                    <span class="txt__card_menu">Convenios</span>
                                </div>
                            </a>
                        </div>
                    @endcan
                    {{-- Servicios --}}
                    @can('accesos-profesional',['ver-servicios'])
                        <div class="col-6 col-md-4 card__menu">
                            <a  href='{{ route('profesional.configuracion.servicios.index') }}'>
                                <div class="card__ servicio_blue">
                                    <span class="txt__card_menu">Servicios</span>
                                </div>
                            </a>
                        </div>
                    @endcan

                    {{-- Usuarios --}}
                    @can('accesos-profesional',['ver-servicios'])
                        <div class="col-12 col-md-4 pl-4 pr-4 card__menu">
                            <a  href='{{ route('profesional.configuracion.usuarios.index') }}'>
                                <div class="card__ usuario_blue">
                                    <span class="txt__card_menu">Usuarios</span>
                                </div>
                            </a>
                        </div>
                    @endcan
                </div>
            </div>
            <!-- Tarjetas de logos -->
            <div class="col-12 col-lg-3 p-0">
                <div class="row m-0">
                    {{-- Mipres --}}
                    <div class="col-12 col-md-4 col-lg-12 mb-4 card__menu_logo">
                        <a  href="https://mipres.sispro.gov.co/MIPRESNOPBS/Login.aspx?ReturnUrl=%2fMIPRESNOPBS" target="_blank">
                            <div class="card__">
                                <img class="img_card_menu_panel"
                                src="{{ asset('/img/agenda/panelPrincipal/profesionales/mipres-zaabra.png') }}" alt="">
                            </div>
                        </a>
                    </div>
                    {{-- Medhistoria --}}
                    <div class="col-12 col-md-4 col-lg-12 mb-4 card__menu_logo">
                        <a  href="https://medhistoria.com/" target="_blank">
                            <div class="card__">
                                <img class="img_card_menu_panel"
                                src="{{ asset('/img/agenda/panelPrincipal/profesionales/logo_medhistoria_banner.png') }}" alt="">
                            </div>
                        </a>
                    </div>
                    {{-- PLM --}}
                    <div class="col-12 col-md-4 col-lg-12 mb-4 card__menu_logo">
                        <a  href="https://www.prescripciontotal.com.co/consultorio-generico/login" target="_blank">
                            <div class="card__">
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

