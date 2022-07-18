@extends('instituciones.admin.layouts.layout')

@section('contenido')
    <div class="container-fluid panel_main_menu">
        <div class="row m-0">
            <!-- Sección tarjetas menú de opciones -->
            <div class="col-12 col-lg-9 p-0 m-0">
                <!-- Buscador -->
                <div class="row search__main_menu">
                    <div class="col-12 p-0">
                        <input type="search" name="search" id="search" placeholder="Buscar" data-url="{{ route('institucion.filtro-vistas') }}">
                        <button class="icon_search_green"></button>
                    </div>
                </div>
                <!-- Tarjetas de opciones -->
                <div class="row m-0">
                    {{-- Convenios --}}
                    @can('accesos-institucion','ver-convenios')
                        <div class="col-6 col-md-4 card__menu">
                            <a href='{{ route('institucion.configuracion.convenios.index') }}'>
                                <div class="card__ icon__conv_green">
                                    <span class="txt__card_menu">Convenios</span>
                                </div>
                            </a>
                        </div>
                    @endcan

                    {{-- Servicios --}}
                    @can('accesos-institucion','ver-servicios')
                        <div class="col-6 col-md-4 card__menu">
                            <a href='{{ route('institucion.configuracion.servicios.index') }}'>
                                <div class="card__ icon__serv_green">
                                    <span class="txt__card_menu">Servicios</span>
                                </div>
                            </a>
                        </div>
                    @endcan

                    {{-- Usuarios --}}
                    @can('accesos-institucion','ver-usuarios')
                        <div class="col-6 col-md-4 card__menu">
                            <a href='{{ route('institucion.configuracion.usuarios.index') }}'>
                                <div class="card__ icon__usua_green">
                                    <span class="txt__card_menu">Usuarios</span>
                                </div>
                            </a>
                        </div>
                    @endcan

                    {{-- Pacientes --}}
                    @can('accesos-institucion','ver-pacientes')
                        <div class="col-6 col-md-4 card__menu">
                            <a href='{{ route('institucion.pacientes.index') }}'>
                                <div class="card__ icon__paci_green">
                                    <span class="txt__card_menu">Pacientes</span>
                                </div>
                            </a>
                        </div>
                    @endcan

                    {{-- Profesionales --}}
                    @can('accesos-institucion','ver-profesionales')
                        <div class="col-6 col-md-4 card__menu">
                            <a href='{{ route('institucion.profesionales.index') }}'>
                                <div class="card__ icon__prof_green">
                                    <span class="txt__card_menu">Profesionales</span>
                                </div>
                            </a>
                        </div>
                    @endcan

                    {{-- Pagos --}}
                    @can('accesos-institucion','ver-pagos')
                        <div class="col-6 col-md-4 card__menu">
                            <a href='{{ route('institucion.pagos') }}'>
                                <div class="card__ icon__pago_green">
                                    <span class="txt__card_menu">Pagos</span>
                                </div>
                            </a>
                        </div>
                    @endcan

                    {{-- Contactos --}}
                    @can('accesos-institucion','ver-contactos')
                        <div class="col-6 col-md-4 card__menu">
                            <a href='{{ route('institucion.contactos.index') }}'>
                                <div class="card__ icon__cont_green">
                                    <span class="txt__card_menu">Contactos</span>
                                </div>
                            </a>
                        </div>
                    @endcan

                    {{-- Gestión --}} 
                    <div class="col-6 col-md-4 card__menu">
                        <a href="{{ route('institucion.gestion.primer-reporte') }}">
                            <div class="card__ icon__gest_green">
                                <span class="txt__card_menu">Gestión</span>
                            </div>
                        </a>
                    </div>

                    {{-- Histórico de citas --}}
                    @can('accesos-institucion','ver-citas')
                        <div class="col-12 col-md-4 pl-4 pr-4 card__menu">
                            <a href='{{ route('institucion.citas') }}'>
                                <div class="card__ icon__cita_green">
                                    <span class="txt__card_menu">Histórico de citas</span>
                                </div>
                            </a>
                        </div>
                    @endcan
                </div>
            </div>
            <!-- Tarjetas de logos entidades -->
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
                    {{-- Medistoria --}}
                    <div class="col-12 col-md-4 col-lg-12 mb-4 card__menu_logo">
                        <a  href="https://medhistoria.com/" target="_blank">
                            <div class="card__ ">
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

@section('scripts')
    <script src="{{ asset('js/panel.js') }}"></script>
@endsection

