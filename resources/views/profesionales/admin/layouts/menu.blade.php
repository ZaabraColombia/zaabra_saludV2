@php
$user = Auth::user();
@endphp
<div class="active" id="sidebar">
    <div class="sidebar-wrapper active ps ps--active-y">
        <div class="sidebar-menu">
            <div class="sidebar__header">
                <img src="{{ asset($user->profesional->fotoperfil ?? 'img/menu/avatar.png') }}" alt="user.png">
                <div class="user_data">
                    <h2>Dr.(a) {{ $user->nombre_completo }}</h2>
                    <h3>{{ $user->profecional->especialidad->nombreEspecialidad }}</h3>
                </div>
            </div>

            <ul class="menu">
                <!-- menú -->
                <li class="sidebar-item has-sub items_blue">
                    <a id="" href="{{ route('profesional.panel') }}" class="">
                        <button class="{{ request()->routeIs('profesional.panel') ? 'btn_active' : '' }}">Menú</button>
                    </a>
                </li>

                <!-- Agenda -->
                <li class="sidebar-item has-sub items_blue accordion" id="accordionExample2">
                    <button id="headingTwo" class="{{ request()->routeIs('profesional.agenda.*') ? 'btn_active' : '' }}" type="button" data-toggle="collapse"
                            data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Agenda<i class="icon_angle fas fa-angle-down pl-2"></i>
                    </button>

                    <ul id="collapseTwo" class="collapse sub_menu_blue {{ request()->routeIs('profesional.agenda.*') ? 'show' : '' }}"
                        aria-labelledby="headingTwo" data-parent="#accordionExample2">
                        <li class="submenu-item">
                            <a id="cita" class="{{ request()->routeIs('profesional.agenda.citas') ? 'txt_active_blue' : '' }}" href='{{ route('profesional.agenda.citas') }}'>Citas</a>
                        </li>
                        <li class="submenu-item ">
                            <a id="calendario" class="{{ request()->routeIs('profesional.agenda.calendario') ? 'txt_active_blue' : '' }}"
                            href='{{ route('profesional.agenda.calendario') }}'>Calendario</a>
                        </li>
                        <li class="submenu-item ">
                            <a id="configurar-calendario" class="{{ request()->routeIs('profesional.agenda.configurar-calendario') ? 'txt_active_blue' : '' }}"
                            href='{{ route('profesional.agenda.configurar-calendario') }}'>Configuración del Calendario</a>
                        </li>
                    </ul>
                </li>

                <!-- Pagos -->
                <li class="sidebar-item  has-sub items_blue">
                    <a id="" class="" href='{{ route('profesional.pagos') }}'>
                        <button class="{{ request()->routeIs('profesional.pagos') ? 'btn_active' : '' }}">Pagos</button>
                    </a>
                </li>

                <!-- Pacientes -->
                <li class="sidebar-item  has-sub items_blue">
                    <a id="" class="" href='{{ route('profesional.pacientes') }}'>
                        <button class="{{ request()->routeIs('profesional.pacientes') ? 'btn_active' : '' }}">Pacientes</button>
                    </a>
                </li>

                <!-- Contactos -->
                <li class="sidebar-item  has-sub items_blue">
                    <a id="" class="" href='{{ route('profesional.contactos.index') }}'>
                        <button class="{{ request()->routeIs('profesional.contactos.index') ? 'btn_active' : '' }}">Contactos</button>
                    </a>
                </li>

                <!-- Catálogos -->
                <li class="sidebar-item has-sub items_blue accordion" id="accordionExample">
                    <button id="headingOne" class="{{ request()->routeIs('profesional.catalogos.*') ? 'btn_active' : '' }}" type="button" data-toggle="collapse"
                            data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                        Catálogos<i class="icon_angle fas fa-angle-down pl-2"></i>
                    </button>

                    <ul id="collapseOne" class="collapse sub_menu_blue {{ request()->routeIs('profesional.catalogos.*') ? 'show' : '' }}"
                        aria-labelledby="headingOne" data-parent="#accordionExample">
                        <li class="submenu-item ">
                            <a id="cie10" class="{{ request()->routeIs('profesional.catalogos.cie10') ? 'txt_active_blue' : '' }}"
                                href='{{ route('profesional.catalogos.cie10') }}'>Diagnósticos (CIE - 10)</a>
                        </li>
                        <li class="submenu-item ">
                            <a id="cups" class="{{ request()->routeIs('profesional.catalogos.cups') ? 'txt_active_blue' : '' }}"
                                href='{{ route('profesional.catalogos.cups') }}'>Procedimientos (CUPS)</a>
                        </li>
                        <li class="submenu-item ">
                            <a id="cums" class="{{ request()->routeIs('profesional.catalogos.cums') ? 'txt_active_blue' : '' }}"
                                href='{{ route("profesional.catalogos.cums") }}'>Vademecum actualizado COLOMBIA INVIMA (CUMS)</a>
                        </li>
                    </ul>
                </li>

                <!-- Favoritos -->
                <li class="sidebar-item  has-sub items_blue">
                    <a class="" href='{{ route('profesional.favoritos') }}'>
                        <button class="{{ request()->routeIs('profesional.favoritos') ? 'btn_active' : '' }}">Favoritos</button>
                    </a>
                </li>

                <!-- Configuración -->
                <li class="sidebar-item has-sub items_blue accordion" id="accordionConfiguracion">
                    <button id="headingConfiguracion" class="" type="button" data-toggle="collapse"
                            data-target="#collapseConfiguracion" aria-expanded="false" aria-controls="collapseConfiguracion">
                        Configuración<i class="icon_angle fas fa-angle-down pl-2"></i>
                    </button>

                    <ul id="collapseConfiguracion" class="collapse sub_menu_blue {{ request()->routeIs('institucion.configuracion.*') ? 'show' : '' }}"
                        aria-labelledby="headingConfiguracion" data-parent="#accordionConfiguracion">
                        <li class="submenu-item ">
                            <a id="" class="" href=''>
                                Convenios
                            </a>
                        </li>
                        <li class="submenu-item ">
                            <a id="" class="" href=''>
                                Servicios
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Logo PLM -->
                <li class="sidebar-item  has-sub items_logos_blue" style="width: 180px">
                    <a id="fav" class="" target="_blank" href="https://www.prescripciontotal.com.co/consultorio-generico/login">
                        <button class="d-flex justify-content-start pl-3">
                            <img src="{{ asset('/img/agenda/panelPrincipal/profesionales/plm.png') }}" alt="" width="100px">
                        </button>
                    </a>
                </li>

                <!-- Logo Mipress -->
                <li class="sidebar-item  has-sub items_logos_blue" style="width: 180px">
                    <a id="fav" class="" target="_blank" href="https://mipres.sispro.gov.co/MIPRESNOPBS/Login.aspx?ReturnUrl=%2fMIPRESNOPBS">
                        <button class="d-flex justify-content-start pl-3">
                            <img src="{{ asset('/img/agenda/panelPrincipal/profesionales/mipres-zaabra.png') }}" alt="" width="100px">
                        </button>
                    </a>
                </li>

                <!-- Logo Medihistoria -->
                <li class="sidebar-item  has-sub items_logos_blue" style="width: 180px">
                    <a id="fav" class="" target="_blank" href="">
                        <button class="d-flex justify-content-start pl-3">
                            <img src="{{ asset('/img/agenda/panelPrincipal/profesionales/logo_medhistoria_banner.png') }}" alt="" width="160px" height="27px">
                        </button>
                    </a>
                </li>

                @if(!empty($objListaUsuario5->isNotEmpty()))
                    <li class="sidebar-item  has-sub items_blue">
                        <a href="#" class="sidebar-link">
                            <i class="bi bi-grid-1x2-fill"></i>
                            <span>Perfiles</span>
                        </a>
                        <ul class="submenu ">
                            @foreach($objListaUsuario5 as $objListaUsuario5)
                                <li class="submenu-item ">
                                <a href='{{url("$objListaUsuario5->urlPermiso")}}'>{{$objListaUsuario5->nombrePermiso}}</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endif

                @if(!empty($objListaUsuario6->isNotEmpty()))
                    <li class="sidebar-item  has-sub items_blue">
                        <a href="#" class="sidebar-link">
                            <i class="bi bi-grid-1x2-fill"></i>
                            <span>Pagos</span>
                        </a>
                        <ul class="submenu ">
                            @foreach($objListaUsuario6 as $objListaUsuario6)
                                <li class="submenu-item ">
                                <a href='{{url("$objListaUsuario6->urlPermiso")}}'>{{$objListaUsuario6->nombrePermiso}}</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endif

                @if(!empty($objListaUsuario7->isNotEmpty()))
                    <li class="sidebar-item  has-sub items_blue">
                        <a href="#" class="sidebar-link">
                            <i class="bi bi-grid-1x2-fill"></i>
                            <span>Reportes</span>
                        </a>
                        <ul class="submenu ">
                            @foreach($objListaUsuario7 as $objListaUsuario7)
                                <li class="submenu-item ">
                                <a href='{{url("$objListaUsuario7->urlPermiso")}}'>{{$objListaUsuario7->nombrePermiso}}</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</div>

@section('scripts')
<script>
</script>
@endsection



