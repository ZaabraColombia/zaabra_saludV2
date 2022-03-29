@php
    $user = Auth::user();
@endphp
<div class="active" id="sidebar">
    <div class="sidebar-wrapper active ps ps--active-y">
        <div class="sidebar-menu">
            <div class="sidebar__header">
                <img src="{{ asset($user->institucion->logo ?? 'img/menu/avatar.png') }}" alt="user.png">
                <div class="user_data">
                    <h2 style="color: #019F86">{{ $user->nombreinstitucion }}</h2>
                    <h3>{{ $user->email }}</h3>
                </div>
            </div>

            <ul class="menu">
                <!-- menú -->
                <li class="sidebar-item has-sub items_green">
                    <a id="" href="{{ route('institucion.panel') }}">
                        <button class="{{ request()->routeIs('institucion.panel') ? 'btn_active_inst' : '' }}">Menu</button>
                    </a>
                </li>

                <!-- pagos -->
                <li class="sidebar-item  has-sub items_green">
                    <a id="" class="" href='{{ route('institucion.profesionales.index') }}'>
                        <button class="{{ request()->routeIs('institucion.profesionales.*') ? 'btn_active_inst' : '' }}">Mis profesionales</button>
                    </a>
                </li>

                <!-- pagos -->
                <li class="sidebar-item  has-sub items_green">
                    <a id="" class="" href='{{ route('institucion.pagos') }}'>
                        <button class="{{ request()->routeIs('institucion.pagos') ? 'btn_active_inst' : '' }}">Mis pagos</button>
                    </a>
                </li>

                <!-- mis pacientes -->
                <li class="sidebar-item  has-sub items_green">
                    <a id="" class="" href='{{ route('institucion.pacientes') }}'>
                        <button class="{{ request()->routeIs('institucion.pacientes') ? 'btn_active_inst' : '' }}">Mis pacientes</button>
                    </a>
                </li>

                <!-- mis contactos -->
                <li class="sidebar-item  has-sub items_green">
                    <a id="" class="" href='{{ route('institucion.contactos.index') }}'>
                        <button class="{{ request()->routeIs('institucion.contactos.index') ? 'btn_active_inst' : '' }}">Mis contactos</button>
                    </a>
                </li>

                <!-- Catálogos -->
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

                <!-- Favoritos -->
                <li class="sidebar-item  has-sub items_green">
                    <a class="" href='{{ route('institucion.favoritos') }}'>
                        <button class="{{ request()->routeIs('institucion.favoritos') ? 'btn_active_inst' : '' }}">Mis favoritos</button>
                    </a>
                </li>

                <!-- Logo PLM -->
                <li class="sidebar-item  has-sub items_logos_green">
                    <a id="fav" class="" target="_blank" href="https://www.prescripciontotal.com.co/consultorio-generico/login">
                        <button class="d-flex justify-content-start pl-3">
                            <img src="{{ asset('/img/agenda/panelPrincipal/profesionales/plm.png') }}" alt="" width="100px">
                        </button>
                    </a>
                </li>

                <!-- Logo Mipress -->
                <li class="sidebar-item  has-sub items_logos_green">
                    <a id="fav" class="" target="_blank" href="https://mipres.sispro.gov.co/MIPRESNOPBS/Login.aspx?ReturnUrl=%2fMIPRESNOPBS">
                        <button class="d-flex justify-content-start pl-3">
                            <img src="{{ asset('/img/agenda/panelPrincipal/profesionales/mipres-zaabra.png') }}" alt="" width="100px">
                        </button>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
