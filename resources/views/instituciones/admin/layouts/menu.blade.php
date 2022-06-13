@php
    $user = Auth::user();
@endphp

<div class="sidebar-wrapper">
    <div class="sidebar-menu pb-3">
        <div class="sidebar__header">
            <a class="d-flex" href="{{ route('PerfilInstitucion', ['slug' => $user->institucion->slug]) }}" target="_blank">
                <img src="{{ asset($user->institucion->logo ?? 'img/menu/avatar.png') }}" alt="user.png">
                <div class="user_data">
                    <h2 style="color: #019F86">{{ $user->nombre_completo ?? $user->nombreinstitucion }}</h2>
                    <div class="cont_text">
                    <span>{{ $user->email }}</span>
                    </div>
                </div>
            </a>
        </div>
            
        <div class="sidebar_body">
            <ul class="menu">
                {{-- Menú --}}
                <li class="sidebar-item item__green">
                    <a id="" href="{{ route('institucion.panel') }}">
                        <button class="{{ request()->routeIs('institucion.panel') ? 'item_green_activ' : '' }}">Menú</button>
                    </a>
                </li>

                {{-- Profesionales --}}
                @can('accesos-institucion','ver-profesionales')
                    <li class="sidebar-item item__green">
                        <a id="" class="" href='{{ route('institucion.profesionales.index') }}'>
                            <button class="{{ request()->routeIs('institucion.profesionales.*') ? 'item_green_activ' : '' }}">Profesionales</button>
                        </a>
                    </li>
                @endcan


                {{-- Mis pacientes --}}
                @can('accesos-institucion','ver-pacientes')
                    <li class="sidebar-item item__green">
                        <a id="" class="" href='{{ route('institucion.pacientes.index') }}'>
                            <button class="{{ request()->routeIs('institucion.pacientes.*') ? 'item_green_activ' : '' }}">Pacientes</button>
                        </a>
                    </li>
                @endcan

                {{-- Configuraciones --}}
                @can('accesos-institucion','configuraciones')
                    <li class="sidebar-item item__green accordion" id="accordionConfiguracion">
                        <button id="headingConfiguracion" class="{{ request()->routeIs('institucion.configuracion.*') ? 'item_green_activ' : '' }}" type="button" data-toggle="collapse"
                                data-target="#collapseConfiguracion" aria-expanded="false" aria-controls="collapseConfiguracion">
                            Configuración<i class="icon_angle fas fa-angle-down pl-2"></i>
                        </button>

                        <ul id="collapseConfiguracion" class="collapse submenu_green {{ request()->routeIs('institucion.configuracion.*') ? 'show' : '' }}"
                            aria-labelledby="headingConfiguracion" data-parent="#accordionConfiguracion">
                            @can('accesos-institucion','ver-convenios')
                                <li class="submenu-item">
                                    <a id="cie10" class="{{ request()->routeIs('institucion.configuracion.convenios.*') ? 'subitem_green_activ' : '' }}"
                                    href='{{ route('institucion.configuracion.convenios.index') }}'>
                                        Convenios
                                    </a>
                                </li>
                            @endcan
                            @can('accesos-institucion','ver-servicios')
                                <li class="submenu-item">
                                    <a id="cups" class="{{ request()->routeIs('institucion.configuracion.servicios.*') ? 'subitem_green_activ' : '' }}"
                                    href='{{ route('institucion.configuracion.servicios.index') }}'>
                                        Servicios
                                    </a>
                                </li>
                            @endcan


                            @can('accesos-institucion','ver-usuarios')
                                <li class="submenu-item">
                                    <a id="cups" class="{{ request()->routeIs('institucion.configuracion.usuarios.*') ? 'subitem_green_activ' : '' }}"
                                    href='{{ route('institucion.configuracion.usuarios.index') }}'>
                                        Usuarios
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                {{-- Agenda --}}
                <li class="sidebar-item item__green accordion" id="accordion_agenda">
                    <button id="headingAgenda" class="{{ request()->routeIs('institucion.calendario.*') ? 'item_green_activ' : '' }}" type="button" data-toggle="collapse"
                            data-target="#collapseAgenda" aria-expanded="false" aria-controls="collapseAgenda">
                        Agenda <i class="icon_angle fas fa-angle-down pl-2"></i>
                    </button>

                    <ul id="collapseAgenda" class="collapse submenu_green" aria-labelledby="headingAgenda" data-parent="#accordion_agenda">
                        <li class="submenu-item">
                            <a class="{{ (request()->routeIs('institucion.calendario.citas') or request()->routeIs('institucion.calendario.citas')) ? 'subitem_green_activ' : '' }}"
                            href="{{ route('institucion.calendario.citas') }}">
                                Administración citas
                            </a>
                        </li>
                        <li class="submenu-item">
                            <a class="{{ request()->routeIs('institucion.calendario.crear-cita') ? 'subitem_green_activ' : '' }}"
                            href="{{ route('institucion.calendario.crear-cita') }}">
                                Agendar cita
                            </a>
                        </li>
                        {{--
                        <li class="submenu-item">
                            <a id="" class="" href="#">
                                Historial de bloqueos
                            </a>
                        </li>
                        --}}
                    </ul>
                </li>


                {{-- Histórico de citas --}}
                @can('accesos-institucion','ver-citas')
                    <li class="sidebar-item item__green">
                        <a id="" class="" href='{{ route('institucion.citas') }}'>
                            <button class="{{ request()->routeIs('institucion.citas') ? 'item_green_activ' : '' }}">Histórico de citas</button>
                        </a>
                    </li>
                @endcan

                {{-- pagos --}}
                @can('accesos-institucion','ver-pagos')
                    <li class="sidebar-item item__green">
                        <a id="" class="" href='{{ route('institucion.pagos') }}'>
                            <button class="{{ request()->routeIs('institucion.pagos') ? 'item_green_activ' : '' }}">Pagos</button>
                        </a>
                    </li>
                @endcan

                {{-- mis contactos --}}
                @can('accesos-institucion','ver-contactos')
                    <li class="sidebar-item item__green">
                        <a id="" class="" href='{{ route('institucion.contactos.index') }}'>
                            <button class="{{ request()->routeIs('institucion.contactos.index') ? 'item_green_activ' : '' }}">Contactos</button>
                        </a>
                    </li>
                @endcan

                {{-- Catálogos --}}
                @can('accesos-institucion','ver-catalogos')
                    <li class="sidebar-item item__green accordion" id="accordionExample">
                        <button id="headingOne" class="{{ request()->routeIs('institucion.catalogos.*') ? 'item_green_activ' : '' }}" type="button" data-toggle="collapse"
                                data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                            Catálogos<i class="icon_angle fas fa-angle-down pl-2"></i>
                        </button>

                        <ul id="collapseOne" class="collapse submenu_green {{ request()->routeIs('institucion.catalogos.*') ? 'show' : '' }}"
                            aria-labelledby="headingOne" data-parent="#accordionExample">
                            <li class="submenu-item">
                                <a id="cie10" class="{{ request()->routeIs('institucion.catalogos.cie10') ? 'subitem_green_activ' : '' }}"
                                href='{{ route('institucion.catalogos.cie10') }}'>
                                    Diagnósticos (CIE - 10)
                                </a>
                            </li>
                            <li class="submenu-item">
                                <a id="cups" class="{{ request()->routeIs('institucion.catalogos.cups') ? 'subitem_green_activ' : '' }}"
                                href='{{ route('institucion.catalogos.cups') }}'>
                                    Procedimientos (CUPS)
                                </a>
                            </li>
                            <li class="submenu-item">
                                <a id="cums" class="{{ request()->routeIs('institucion.catalogos.cums') ? 'subitem_green_activ' : '' }}"
                                href='{{ route("institucion.catalogos.cums") }}'>
                                    Vademecum actualizado COLOMBIA INVIMA (CUMS)
                                </a>
                            </li>
                        </ul>
                    </li>
                @endcan

                {{-- Gestión --}}
                <li class="sidebar-item item__green">
                    <a class="" href="#">
                        <button class="">Gestión</button>
                    </a>
                </li>

                {{-- Favoritos
                @can('accesos-institucion','favoritos')
                    <li class="sidebar-item item__green">
                        <a class="" href='{{ route('institucion.favoritos') }}'>
                            <button class="{{ request()->routeIs('institucion.favoritos') ? 'item_green_activ' : '' }}">Favoritos</button>
                        </a>
                    </li>
                @endcan --}}


                {{-- Logo Mipress --}}
                <li class="sidebar-item  has-sub item__logo_green">
                    <a id="fav" class="" target="_blank" href="https://mipres.sispro.gov.co/MIPRESNOPBS/Login.aspx?ReturnUrl=%2fMIPRESNOPBS">
                        <button class="d-flex justify-content-start pl-3">
                            <img src="{{ asset('/img/agenda/panelPrincipal/profesionales/mipres-zaabra.png') }}" alt="" width="85px">
                        </button>
                    </a>
                </li>

                {{-- Logo Medihistoria --}}
                <li class="sidebar-item  has-sub item__logo_green">
                    <a id="fav" class="" target="_blank" href="">
                        <button class="d-flex justify-content-start p-3">
                            <img src="{{ asset('/img/agenda/panelPrincipal/profesionales/logo_medhistoria_banner.png') }}" alt="" width="141px" height="22px">
                        </button>
                    </a>
                </li>

                {{-- Logo PLM --}}
                <li class="sidebar-item  has-sub item__logo_green">
                    <a id="fav" class="" target="_blank" href="https://www.prescripciontotal.com.co/consultorio-generico/login">
                        <button class="d-flex justify-content-start pl-2">
                            <img src="{{ asset('/img/agenda/panelPrincipal/profesionales/plm.png') }}" alt="" width="85px">
                        </button>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>