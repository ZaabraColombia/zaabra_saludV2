@php
$user = Auth::user();
@endphp
<div class="active" id="sidebar">
    <div class="sidebar-wrapper active ps ps--active-y">
        <div class="sidebar-menu">
            <div class="sidebar__header">
                <img src="{{ asset($user->profecional->fotoperfil ?? 'img/menu/avatar.png') }}" alt="user.png">
                <div class="user_data">
                    <h2>Dr.(a) Alejandra de Santa María</h2>
                    <h3>Otorrinonaringología</h3>
                </div>
            </div>

            <ul class="menu">
                <!-- menú -->
                <li class="sidebar-item has-sub">
                    <a id="" href="{{ route('profesional.panel') }}" class="">
                        <button class="{{ request()->routeIs('profesional.panel') ? 'btn_active' : '' }}">Menu</button>
                    </a>
                </li>

                <!-- Mi agenda -->
                <li class="sidebar-item has-sub accordion" id="accordionExample2">
                    <button id="headingTwo" class="{{ request()->routeIs('profesional.agenda.*') ? 'btn_active' : '' }}" type="button" data-toggle="collapse" 
                            data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Mi agenda<i class="icon_angle fas fa-angle-down pl-2"></i>
                    </button>

                    <ul id="collapseTwo" class="collapse sub_menu {{ request()->routeIs('profesional.agenda.*') ? 'show' : '' }}" 
                        aria-labelledby="headingTwo" data-parent="#accordionExample2">
                        <li class="submenu-item">
                            <a id="cita" class="{{ request()->routeIs('profesional.agenda.citas') ? 'txt_active' : '' }}" href='{{ route('profesional.agenda.citas') }}'>Citas</a>
                        </li>
                        <li class="submenu-item ">
                            <a id="calendario" class="{{ request()->routeIs('profesional.agenda.calendario') ? 'txt_active' : '' }}" 
                            href='{{ route('profesional.agenda.calendario') }}'>Calendario</a>
                        </li>
                        <li class="submenu-item ">
                            <a id="configurar-calendario" class="{{ request()->routeIs('profesional.agenda.configurar-calendario') ? 'txt_active' : '' }}" 
                            href='{{ route('profesional.agenda.configurar-calendario') }}'>Configuración del Calendario</a>
                        </li>
                    </ul>
                </li>

                <!-- pagos -->
                <li class="sidebar-item  has-sub">
                    <a id="" class="" href='{{ route('profesional.pagos') }}'>
                        <button class="{{ request()->routeIs('profesional.pagos') ? 'btn_active' : '' }}">Mis pagos</button>
                    </a>
                </li>

                <!-- mis pacientes -->
                <li class="sidebar-item  has-sub">
                    <a id="" class="" href='{{ route('profesional.pacientes') }}'>
                        <button class="{{ request()->routeIs('profesional.pacientes') ? 'btn_active' : '' }}">Mis pacientes</button>
                    </a>
                </li>

                <!-- mis pacientes -->
                <li class="sidebar-item  has-sub">
                    <a id="" class="" href='{{ route('profesional.contactos.index') }}'>
                        <button class="{{ request()->routeIs('profesional.contactos.index') ? 'btn_active' : '' }}">Mis contactos</button>
                    </a>
                </li>

                <!-- Catálogos -->
                <li class="sidebar-item has-sub accordion" id="accordionExample">
                    <button id="headingOne" class="{{ request()->routeIs('profesional.catalogos.*') ? 'btn_active' : '' }}" type="button" data-toggle="collapse" 
                            data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                        Catálogos<i class="icon_angle fas fa-angle-down pl-2"></i>
                    </button>

                    <ul id="collapseOne" class="collapse sub_menu {{ request()->routeIs('profesional.catalogos.*') ? 'show' : '' }}" 
                        aria-labelledby="headingOne" data-parent="#accordionExample">
                        <li class="submenu-item ">
                            <a id="cie10" class="{{ request()->routeIs('profesional.catalogos.cie10') ? 'txt_active' : '' }}" 
                                href='{{ route('profesional.catalogos.cie10') }}'>Diagnósticos (CIE - 10)</a>
                        </li>
                        <li class="submenu-item ">
                            <a id="cups" class="{{ request()->routeIs('profesional.catalogos.cups') ? 'txt_active' : '' }}" 
                                href='{{ route('profesional.catalogos.cups') }}'>Procedimientos (CUPS)</a>
                        </li>
                        <li class="submenu-item ">
                            <a id="cums" class="{{ request()->routeIs('profesional.catalogos.cums') ? 'txt_active' : '' }}" 
                                href='{{ route("profesional.catalogos.cums") }}'>Vademecum actualizado COLOMBIA INVIMA (CUMS)</a>
                        </li>
                    </ul>
                </li>

                <!-- Favoritos -->
                <li class="sidebar-item  has-sub">
                    <a class="" href='{{ route('profesional.favoritos') }}'>
                        <button class="{{ request()->routeIs('profesional.favoritos') ? 'btn_active' : '' }}">Mis favoritos</button>
                    </a>
                </li>

                <li class="sidebar-item  has-sub">
                    <a id="fav" class="" target="_blank" href="https://www.prescripciontotal.com.co/consultorio-generico/login">
                        <button class="py-0">
                            <img src="{{ asset('/img/agenda/panelPrincipal/plm.png') }}" alt="" width="100px">                          
                        </button>
                    </a>
                </li>

                <li class="sidebar-item  has-sub">
                    <a id="fav" class="" target="_blank" href="https://mipres.sispro.gov.co/MIPRESNOPBS/Login.aspx?ReturnUrl=%2fMIPRESNOPBS">
                        <button class="py-0">
                            <img src="{{ asset('/img/agenda/panelPrincipal/mipres-zaabra.png') }}" alt="" width="100px">
                        </button>
                    </a>
                </li>

                @if(!empty($objListaUsuario5->isNotEmpty()))
                    <li class="sidebar-item  has-sub">
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
                    <li class="sidebar-item  has-sub">
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
                    <li class="sidebar-item  has-sub">
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



