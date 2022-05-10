@php
    $user = Auth::user();
@endphp
<div class="active" id="sidebar">
    <div class="sidebar-wrapper active ps ps--active-y">
        <div class="sidebar-menu">
            <div class="sidebar__header">
                <img src="{{ asset($user->profesional->fotoperfil ?? 'img/menu/avatar.png') }}" alt="user.png">
                <div class="user_data">
                    <h2>Dr.(a) {{ $user->profesional->user->nombre_completo }}</h2>
                    <h3>{{ $user->profesional->especialidad->nombreEspecialidad }}</h3>
                </div>
            </div>

            <ul class="menu">
                <!-- menú -->
                <li class="sidebar-item has-sub items_blue">
                    <a id="" href="{{ route('profesional.panel') }}" class="">
                        <button class="{{ request()->routeIs('profesional.panel') ? 'btn_active' : '' }}">Menú</button>
                    </a>
                </li>

                {{-- Agenda --}}
                @can('accesos-profesional',['configurar-calendario', 'ver-calendario', 'ver-citas'])
                    <li class="sidebar-item has-sub items_blue accordion" id="accordionExample2">
                        <button id="headingTwo" class="{{ request()->routeIs('profesional.agenda.*') ? 'btn_active' : '' }}" type="button" data-toggle="collapse"
                                data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Agenda<i class="icon_angle fas fa-angle-down pl-2"></i>
                        </button>

                        <ul id="collapseTwo" class="collapse sub_menu_blue {{ request()->routeIs('profesional.agenda.*') ? 'show' : '' }}"
                            aria-labelledby="headingTwo" data-parent="#accordionExample2">
                            @can('accesos-profesional',['ver-citas'])
                                <li class="submenu-item">
                                    <a id="cita" class="{{ request()->routeIs('profesional.agenda.citas') ? 'txt_active_blue' : '' }}" href='{{ route('profesional.agenda.citas') }}'>Citas</a>
                                </li>
                            @endcan
                            @can('accesos-profesional',['ver-calendario'])
                                <li class="submenu-item ">
                                    <a id="calendario" class="{{ request()->routeIs('profesional.agenda.calendario') ? 'txt_active_blue' : '' }}"
                                       href='{{ route('profesional.agenda.calendario') }}'>Calendario</a>
                                </li>
                            @endcan
                            @can('accesos-profesional',['configurar-calendario'])
                                <li class="submenu-item ">
                                    <a id="configurar-calendario" class="{{ request()->routeIs('profesional.agenda.configurar-calendario') ? 'txt_active_blue' : '' }}"
                                       href='{{ route('profesional.agenda.configurar-calendario') }}'>Configuración del Calendario</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                {{-- configuración --}}
                @can('accesos-profesional',['configuraciones', 'ver-convenios', 'ver-servicios', 'ver-usuarios'])
                    <li class="sidebar-item has-sub items_blue accordion" id="accordion-configuracion">
                        <button id="headingTwo" class="{{ request()->routeIs('profesional.configuracion.*') ? 'btn_active' : '' }}" type="button" data-toggle="collapse"
                                data-target="#collapse-configuraciones" aria-expanded="false" aria-controls="collapseTwo">
                            Configuración<i class="icon_angle fas fa-angle-down pl-2"></i>
                        </button>

                        <ul id="collapse-configuraciones" class="collapse sub_menu_blue {{ request()->routeIs('profesional.configuracion.*') ? 'show' : '' }}"
                            aria-labelledby="headingTwo" data-parent="#accordion-configuracion">
                            @can('accesos-profesional',['ver-convenios'])
                                <li class="submenu-item ">
                                    <a id="calendario" class="{{ request()->routeIs('profesional.configuracion.convenios.*') ? 'txt_active_blue' : '' }}"
                                       href='{{ route('profesional.configuracion.convenios.index') }}'>Convenios</a>
                                </li>
                            @endcan
                            @can('accesos-profesional',['ver-servicios'])
                                <li class="submenu-item ">
                                    <a id="configurar-calendario" class="{{ request()->routeIs('profesional.configuracion.servicios.*') ? 'txt_active_blue' : '' }}"
                                       href='{{ route('profesional.configuracion.servicios.index') }}'>Servicios</a>
                                </li>
                            @endcan
                            @can('accesos-profesional',['ver-usuarios'])
                                <li class="submenu-item ">
                                    <a id="configurar-calendario" class="{{ request()->routeIs('profesional.configuracion.usuarios.*') ? 'txt_active_blue' : '' }}"
                                       href='{{ route('profesional.configuracion.usuarios.index') }}'>Usuarios</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                {{-- Pagos --}}
                @can('accesos-profesional',['ver-pagos'])
                    <li class="sidebar-item  has-sub items_blue">
                        <a id="" class="" href='{{ route('profesional.pagos') }}'>
                            <button class="{{ request()->routeIs('profesional.pagos') ? 'btn_active' : '' }}">Pagos</button>
                        </a>
                    </li>
                @endcan

                {{-- Pacientes --}}
                @can('accesos-profesional',['ver-pacientes'])
                    <li class="sidebar-item  has-sub items_blue">
                        <a id="" class="" href='{{ route('profesional.pacientes') }}'>
                            <button class="{{ request()->routeIs('profesional.pacientes') ? 'btn_active' : '' }}">Pacientes</button>
                        </a>
                    </li>
                @endcan

                {{-- Contactos --}}
                @can('accesos-profesional',['ver-contactos'])
                    <li class="sidebar-item  has-sub items_blue">
                        <a id="" class="" href='{{ route('profesional.contactos.index') }}'>
                            <button class="{{ request()->routeIs('profesional.contactos.index') ? 'btn_active' : '' }}">Contactos</button>
                        </a>
                    </li>
                @endcan

                {{-- Catálogos --}}
                @can('accesos-profesional',['ver-catalogos'])
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
                @endcan

                {{-- Favoritos --}}
                @can('accesos-profesional',['ver-favoritos'])
                    <li class="sidebar-item  has-sub items_blue">
                        <a class="" href='{{ route('profesional.favoritos') }}'>
                            <button class="{{ request()->routeIs('profesional.favoritos') ? 'btn_active' : '' }}">Favoritos</button>
                        </a>
                    </li>
                @endcan

                {{-- Logo Mipress --}}
                <li class="sidebar-item  has-sub items_logos_blue" style="width: 180px">
                    <a id="fav" class="" target="_blank" href="https://mipres.sispro.gov.co/MIPRESNOPBS/Login.aspx?ReturnUrl=%2fMIPRESNOPBS">
                        <button class="d-flex justify-content-start pl-3">
                            <img src="{{ asset('/img/agenda/panelPrincipal/profesionales/mipres-zaabra.png') }}" alt="" width="100px">
                        </button>
                    </a>
                </li>

                {{-- Logo Medihistoria --}}
                <li class="sidebar-item  has-sub items_logos_blue" style="width: 180px">
                    <a id="fav" class="" target="_blank" href="">
                        <button class="d-flex justify-content-start p-3">
                            <img src="{{ asset('/img/agenda/panelPrincipal/profesionales/logo_medhistoria_banner.png') }}" alt="" width="160px" height="27px">
                        </button>
                    </a>
                </li>

                {{-- Logo PLM --}}
                <li class="sidebar-item  has-sub items_logos_blue" style="width: 180px">
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

@section('scripts')
    <script>
    </script>
@endsection



