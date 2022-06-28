@extends('instituciones.admin.layouts.layout')

@section('contenido')
    <div class="container-fluid panel_container_main_menu">
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
                <!-- Contenedor barra de búsqueda -->
                <div class="row search_main_container">
                    <div class="col-12 p-0">
                        <input type="search" name="search" id="search" placeholder="Buscar" data-url="{{ route('institucion.filtro-vistas') }}">
                        <button class="btnIn_search"></button>
                    </div>
                </div>
                <!-- Contenedor cards menú panel -->
                <div class="row m-0">
                    {{-- Profesionales --}}
                    @can('accesos-institucion','ver-profesionales')
                        <div class="col-6 col-md-4 col-xl-4 card__option">
                            <a href='{{ route('institucion.profesionales.index') }}'>
                                <div class="card__menu_panel icon__prof_green">
                                    <span class="txt_name_card">Profesionales</span>
                                </div>
                            </a>
                        </div>
                    @endcan

                    {{-- Pacientes --}}
                    @can('accesos-institucion','ver-pacientes')
                        <div class="col-6 col-md-4 col-xl-4 card__option">
                            <a href='{{ route('institucion.pacientes.index') }}'>
                                <div class="card__menu_panel icon__paci_green">
                                    <span class="txt_name_card">Pacientes</span>
                                </div>
                            </a>
                        </div>
                    @endcan

                    {{-- Histórico de citas --}}
                    @can('accesos-institucion','ver-citas')
                        <div class="col-6 col-md-4 col-xl-4 card__option">
                            <a href='{{ route('institucion.citas') }}'>
                                <div class="card__menu_panel icon__cita_green">
                                    <span class="txt_name_card">Histórico de citas</span>
                                </div>
                            </a>
                        </div>
                    @endcan

                    {{-- Pagos --}}
                    @can('accesos-institucion','ver-pagos')
                        <div class="col-6 col-md-4 col-xl-4 card__option">
                            <a href='{{ route('institucion.pagos') }}'>
                                <div class="card__menu_panel icon__pago_green">
                                    <span class="txt_name_card">Pagos</span>
                                </div>
                            </a>
                        </div>
                    @endcan

                    {{-- Usuarios --}}
                    @can('accesos-institucion','ver-usuarios')
                        <div class="col-6 col-md-4 col-xl-4 card__option">
                            <a href='{{ route('institucion.configuracion.usuarios.index') }}'>
                                <div class="card__menu_panel icon__usua_green">
                                    <span class="txt_name_card">Usuarios</span>
                                </div>
                            </a>
                        </div>
                    @endcan

                    {{-- Contactos --}}
                    @can('accesos-institucion','ver-contactos')
                        <div class="col-6 col-md-4 col-xl-4 card__option">
                            <a href='{{ route('institucion.contactos.index') }}'>
                                <div class="card__menu_panel icon__cont_green">
                                    <span class="txt_name_card">Contactos</span>
                                </div>
                            </a>
                        </div>
                    @endcan

                    {{-- Convenios --}}
                    @can('accesos-institucion','ver-convenios')
                        <div class="col-6 col-md-4 col-xl-4 card__option">
                            <a href='{{ route('institucion.configuracion.convenios.index') }}'>
                                <div class="card__menu_panel icon__conv_green">
                                    <span class="txt_name_card">Convenios</span>
                                </div>
                            </a>
                        </div>
                    @endcan

                    {{-- Servicios --}}
                    @can('accesos-institucion','ver-servicios')
                        <div class="col-6 col-md-4 col-xl-4 card__option">
                            <a href='{{ route('institucion.configuracion.servicios.index') }}'>
                                <div class="card__menu_panel icon__serv_green">
                                    <span class="txt_name_card">Servicios</span>
                                </div>
                            </a>
                        </div>
                    @endcan
                    
                    <!-- (SOLO PARA DISPOSITIVOS CELULARES) Si se anexan nuevas tarjetas de opciones, esta última tarjeta 
                        queda con las clases (pl-4 pr-4) del primer div, ya sea cualquier tipo de opción que se le asigne
                        y el anexo de la nueva tarjeta se hace en la parte superior de este mensaje sin las clases (pl-4 pr-4)  -->
                    {{-- Gestión --}} 
                    <div class="col-12 col-md-4 col-xl-4 pl-4 pr-4 card__option">
                        <a href="#">
                            <div class="card__menu_panel icon__gest_green">
                                <span class="txt_name_card">Gestión</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- Contenedor tarjetas de los logos -->
            <div class="col-12 col-lg-3 p-0">
                <div class="row m-0">
                    {{-- Mipres --}}
                    <div class="col-12 col-md-4 col-lg-12 mb-4 card__option_logo">
                        <a  href="https://mipres.sispro.gov.co/MIPRESNOPBS/Login.aspx?ReturnUrl=%2fMIPRESNOPBS" target="_blank">
                            <div class="card__logo_menu_panel">
                                <img class="img_card_menu_panel" 
                                src="{{ asset('/img/agenda/panelPrincipal/profesionales/mipres-zaabra.png') }}" alt="">
                            </div>
                        </a>
                    </div>
                    {{-- Medistoria --}}
                    <div class="col-12 col-md-4 col-lg-12 mb-4 card__option_logo">
                        <a  href="https://medhistoria.com/" target="_blank">
                            <div class="card__logo_menu_panel ">
                                <img class="img_card_menu_panel"
                                src="{{ asset('/img/agenda/panelPrincipal/profesionales/logo_medhistoria_banner.png') }}" alt="">
                            </div>
                        </a>
                    </div>
                    {{-- PLM --}}
                    <div class="col-12 col-md-4 col-lg-12 mb-4 card__option_logo">
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

@section('scripts')
    <script src="{{ asset('js/panel.js') }}"></script>
@endsection

