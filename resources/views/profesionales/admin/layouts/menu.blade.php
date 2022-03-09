@php
$user = Auth::user();
@endphp
<div class="active" id="sidebar">
    <div class="sidebar-wrapper active ps ps--active-y">
        <div class="sidebar-menu">
            <div class="sidebar__header">
                <img src="{{ asset($user->profecional->fotoperfil ?? 'img/menu/avatar.png') }}" alt="user.png">
                <div class="user_data">
                    <h2>Dr(a) Alejandra de Santa María</h2>
                    <h3>Otorrinonaringología</h3>
                </div>
            </div>

            <ul class="menu">
                <li class="sidebar-item  has-sub">
                    <a id="menu_panel" href="{{ route('profesional.panel') }}">
                        <button>Menu</button>
                    </a>
                </li>

                <li class="sidebar-item  has-sub">
                    <button id="cita_padre">Mi Agenda
                        <i class="fas fa-angle-down pl-2 open"></i>
                    </button>

                    <ul class="submenu active">
                        <li class="submenu-item">
                            <a id="cita" class="" href='{{ route('profesional.agenda.citas') }}'>Citas</a>
                        </li>
                        <li class="submenu-item ">
                            <a id="calendario" class="" href='{{ route('profesional.agenda.calendario') }}'>Calendario</a>
                        </li>
                        <li class="submenu-item ">
                            <a id="configurar-calendario" class="" href='{{ route('profesional.agenda.configurar-calendario') }}'>Configuración del Calendario</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item  has-sub">
                    <a id="pago" class="" href='{{ route('profesional.pagos') }}'>
                        <button>Mis pagos</button>
                    </a>
                </li>

                <li class="sidebar-item  has-sub">
                    <a id="pacientes" class="" href='{{ route('profesional.pacientes') }}'>
                        <button>Mis pacientes</button>
                    </a>
                </li>

                <li class="sidebar-item  has-sub">
                    <a id="contactos" class="" href='{{ route('profesional.contactos.index') }}'>
                        <button>Mis contactos</button>
                    </a>
                </li>

                <li class="sidebar-item  has-sub">
                    <button id="historia_padre">Catálogos
                        <i class="fas fa-angle-down pl-2 open"></i>
                    </button>

                    <ul class="submenu active">
                        <li class="submenu-item ">
                            <a id="cie10" class="" href='{{ route('profesional.catalogos.cie10') }}'>Diagnósticos (CIE - 10)</a>
                        </li>
                        <li class="submenu-item ">
                            <a id="cups" class="" href='{{ route('profesional.catalogos.cups') }}'>Procedimientos (CUPS)</a>
                        </li>
                        <li class="submenu-item ">
                            <a id="cums" class="" href='{{ route("profesional.catalogos.cums") }}'>Vademecum actualizado COLOMBIA INVIMA (CUMS)</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item  has-sub">
                    <a id="fav" class="" href='{{ route('profesional.favoritos') }}'>
                        <button>Mis favoritos</button>
                    </a>
                </li>

                <li class="sidebar-item  has-sub">
                    <a id="fav" class="" target="_blank" href="https://www.prescripciontotal.com.co/consultorio-generico/login">
                        <button>PLM</button>
                    </a>
                </li>

                <li class="sidebar-item  has-sub">
                    <a id="fav" class="" target="_blank" href="https://mipres.sispro.gov.co/MIPRESNOPBS/Login.aspx?ReturnUrl=%2fMIPRESNOPBS">
                        <button>Mipres
                        <i class="fas fa-arrow-right-from-bracket"></i>
                        <!-- <i class="fas fa-arrow-up-line"></i> -->
                            <!-- <i class="fas fa-arrow-up pl-2 open"></i>  -->
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
