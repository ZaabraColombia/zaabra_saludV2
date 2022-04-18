@php
    $user = Auth::user();
@endphp
<div class="active" id="sidebar">
    <div class="sidebar-wrapper active ps ps--active-y">
        <div class="sidebar-menu">
            <div class="sidebar__header">
                <img src="{{ asset($user->institucion->logo ?? 'img/menu/avatar.png') }}" alt="user.png">
                <div class="user_data">
                    <h2 style="color: #019F86">{{ $user->nombre_completo }}</h2>
                    <h3>{{ $user->email }}</h3>
                </div>
            </div>

            <ul class="menu">
                {{-- menú --}}
                <li class="sidebar-item has-sub items_green">
                    <a id="" href="{{ route('institucion.panel') }}">
                        <button class="{{ request()->routeIs('institucion.panel') ? 'btn_active_inst' : '' }}">Menu</button>
                    </a>
                </li>

               {{-- profesionales --}}
                @can('accesos-institucion','ver-profesionales')
                <li class="sidebar-item  has-sub items_green">
                    <a id="" class="" href='{{ route('institucion.profesionales.index') }}'>
                        <button class="{{ request()->routeIs('institucion.profesionales.*') ? 'btn_active_inst' : '' }}">Mis profesionales</button>
                    </a>
                </li>
@endcan

                {{-- Configuraciones --}}
                @can('accesos-institucion','configuraciones')
                <li class="sidebar-item has-sub items_green accordion" id="accordionConfiguracion">
                    <button id="headingConfiguracion" class="{{ request()->routeIs('institucion.configuracion.*') ? 'btn_active_inst' : '' }}" type="button" data-toggle="collapse"
                            data-target="#collapseConfiguracion" aria-expanded="false" aria-controls="collapseConfiguracion">
                        Configuración<i class="icon_angle fas fa-angle-down pl-2"></i>
                    </button>

                    <ul id="collapseConfiguracion" class="collapse sub_menu_green {{ request()->routeIs('institucion.configuracion.*') ? 'show' : '' }}"
                        aria-labelledby="headingConfiguracion" data-parent="#accordionConfiguracion">
                        @can('accesos-institucion','ver-convenios')
                            <li class="submenu-item ">
                                <a id="cie10" class="{{ request()->routeIs('institucion.configuracion.convenios.*') ? 'txt_active_green' : '' }}"
                                   href='{{ route('institucion.configuracion.convenios.index') }}'>
                                    Convenios
                                </a>
                            </li>
                        @endcan
                        @can('accesos-institucion','ver-servicios')
                            <li class="submenu-item ">
                                <a id="cups" class="{{ request()->routeIs('institucion.configuracion.servicios.*') ? 'txt_active_green' : '' }}"
                                   href='{{ route('institucion.configuracion.servicios.index') }}'>
                                    Servicios
                                </a>
                            </li>
                        @endcan

                        @can('accesos-institucion','ver-usuarios')
                            <li class="submenu-item ">
                                <a id="cups" class="{{ request()->routeIs('institucion.configuracion.usuarios.*') ? 'txt_active_green' : '' }}"
                                   href='{{ route('institucion.configuracion.usuarios.index') }}'>
                                    Usuarios
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
                @endcan

                {{-- pagos --}}
                @can('accesos-institucion','ver-pagos')
                <li class="sidebar-item  has-sub items_green">
                    <a id="" class="" href='{{ route('institucion.pagos') }}'>
                        <button class="{{ request()->routeIs('institucion.pagos') ? 'btn_active_inst' : '' }}">Mis pagos</button>
                    </a>
                </li>
@endcan

                {{-- mis pacientes --}}
                @can('accesos-institucion','ver-pacientes')
                <li class="sidebar-item  has-sub items_green">
                    <a id="" class="" href='{{ route('institucion.pacientes') }}'>
                        <button class="{{ request()->routeIs('institucion.pacientes') ? 'btn_active_inst' : '' }}">Mis pacientes</button>
                    </a>
                </li>
@endcan

                {{-- mis contactos --}}
                @can('accesos-institucion','ver-contactos')
                <li class="sidebar-item  has-sub items_green">
                    <a id="" class="" href='{{ route('institucion.contactos.index') }}'>
                        <button class="{{ request()->routeIs('institucion.contactos.index') ? 'btn_active_inst' : '' }}">Mis contactos</button>
                    </a>
                </li>
                @endcan

                {{-- Catálogos --}}
                @can('accesos-institucion','ver-catalogos')
                <li class="sidebar-item has-sub items_green accordion" id="accordionExample">
                    <button id="headingOne" class="{{ request()->routeIs('institucion.catalogos.*') ? 'btn_active_inst' : '' }}" type="button" data-toggle="collapse"
                            data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                        Catálogos<i class="icon_angle fas fa-angle-down pl-2"></i>
                    </button>

                    <ul id="collapseOne" class="collapse sub_menu_green {{ request()->routeIs('institucion.catalogos.*') ? 'show' : '' }}"
                        aria-labelledby="headingOne" data-parent="#accordionExample">
                        <li class="submenu-item ">
                            <a id="cie10" class="{{ request()->routeIs('institucion.catalogos.cie10') ? 'txt_active_green' : '' }}"
                               href='{{ route('institucion.catalogos.cie10') }}'>
                                Diagnósticos (CIE - 10)
                            </a>
                        </li>
                        <li class="submenu-item ">
                            <a id="cups" class="{{ request()->routeIs('institucion.catalogos.cups') ? 'txt_active_green' : '' }}"
                               href='{{ route('institucion.catalogos.cups') }}'>
                                Procedimientos (CUPS)
                            </a>
                        </li>
                        <li class="submenu-item ">
                            <a id="cums" class="{{ request()->routeIs('institucion.catalogos.cums') ? 'txt_active_green' : '' }}"
                               href='{{ route("institucion.catalogos.cums") }}'>
                                Vademecum actualizado COLOMBIA INVIMA (CUMS)
                            </a>
                        </li>
                    </ul>
                </li>
@endcan

                {{-- Favoritos --}}
                @can('accesos-institucion','favoritos')
                <li class="sidebar-item  has-sub items_green">
                    <a class="" href='{{ route('institucion.favoritos') }}'>
                        <button class="{{ request()->routeIs('institucion.favoritos') ? 'btn_active_inst' : '' }}">Mis favoritos</button>
                    </a>
                </li>
@endcan

                <!-- Logo Mipress -->
                <li class="sidebar-item  has-sub items_logos_green" style="width: 180px">
                    <a id="fav" class="" target="_blank" href="https://mipres.sispro.gov.co/MIPRESNOPBS/Login.aspx?ReturnUrl=%2fMIPRESNOPBS">
                        <button class="d-flex justify-content-start pl-3">
                            <img src="{{ asset('/img/agenda/panelPrincipal/profesionales/mipres-zaabra.png') }}" alt="" width="100px">
                        </button>
                    </a>
                </li>

                <!-- Logo Medihistoria -->
                <li class="sidebar-item  has-sub items_logos_green" style="width: 180px">
                    <a id="fav" class="" target="_blank" href="">
                        <button class="d-flex justify-content-start p-3">
                            <img src="{{ asset('/img/agenda/panelPrincipal/profesionales/logo_medhistoria_banner.png') }}" alt="" width="160px" height="27px">
                        </button>
                    </a>
                </li>

                <!-- Logo PLM -->
                <li class="sidebar-item  has-sub items_logos_green" style="width: 180px">
                    <a id="fav" class="" target="_blank" href="https://www.prescripciontotal.com.co/consultorio-generico/login">
                        <button class="d-flex justify-content-start pl-3">
                            <img src="{{ asset('/img/agenda/panelPrincipal/profesionales/plm.png') }}" alt="" width="100px">
                        </button>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
