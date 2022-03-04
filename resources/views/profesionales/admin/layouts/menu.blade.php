@php
$user = Auth::user();
@endphp
<div id="sidebar" class="active">
    <div class="sidebar-wrapper active ps ps--active-y">
        <div class="sidebar-menu">
            <div class="imgtxtagen">
                <img class="imagen_usuario_agen" src="{{ asset($user->profecional->fotoperfil ?? 'img/menu/avatar.png') }}" alt="user.png">
                <h1 class="title_agenda mb-0">{{ $user->nombre_completo }}</h1>
            </div>

            <ul class="menu pr-0">
                <li class="sidebar-item  has-sub ">
                    <a id="menu_panel" class="actived" href="{{ route('profesional.panel') }}"> Menu </a>
                </li>
                @if(!empty($objListaUsuario1->isNotEmpty()))
                    <li class="sidebar-item  has-sub">
                        <span id="cita_padre" class="titulo_menu">Mis citas</span>
                        <ul class="submenu active p-0">
{{--                            <li class="submenu-item">--}}
{{--                                <a id="cita" class="actived" href='{{ route('profesional.citas') }}'>Citas</a>--}}
{{--                            </li>--}}
                            <li class="submenu-item ">
                                <a id="calendario" class="actived" href='{{ route('profesional.calendario') }}'>Calendario</a>
                            </li>
                            <li class="submenu-item ">
                                <a id="configurar-calendario" class="actived" href='{{ route('profesional.configurar-calendario') }}'>Configuración del Calendario</a>
                            </li>
{{--                            <li class="submenu-item ">--}}
{{--                                <a id="pago" class="actived" href='{{ route('profesional.pagos') }}'>Mis pagos</a>--}}
{{--                            </li>--}}
{{--                            <li class="submenu-item ">--}}
{{--                                <a id="pacientes" class="actived" href='{{ route('profesional.pacientes') }}'>Mis paciente</a>--}}
{{--                            </li>--}}
{{--                            <li class="submenu-item ">--}}
{{--                                <a id="contactos" class="actived" href='{{ route('profesional.contactos.index') }}'>Mis contactos</a>--}}
{{--                            </li>--}}
                        </ul>
                    </li>
                @endif
                @if(!empty($objListaUsuario2->isNotEmpty()))
                    <li class="sidebar-item  has-sub">
                        <span id="historia_padre" class="titulo_menu">Procedimientos</span>
                        <ul class="submenu active p-0">
                            <li class="submenu-item ">
                                <a id="cie10" class="actived" href='{{ route('profesional.cie10') }}'>Diagnósticos (CIE - 10)</a>
                            </li>
                            <li class="submenu-item ">
                                <a id="cups" class="actived" href='{{ route('profesional.cups') }}'>Procedimientos (CUPS)</a>
                            </li>
                            <li class="submenu-item ">
                                <a id="cums" class="actived" href='{{ route("profesional.cums") }}'>Vademecum actualizado COLOMBIA INVIMA (CUMS)</a>
                            </li>
                        </ul>
                    </li>
                @endif


                @if(!empty($objListaUsuario3->isNotEmpty()))
                    <li class="sidebar-item  has-sub">
                        <span id="favorito_padre" class="titulo_menu">Mis favoritos</span>
                        <ul class="submenu active p-0">

                            <li class="submenu-item ">
                                <a id="fav" class="actived" href='{{ route('profesional.favoritos') }}'>Favoritos</a>
                            </li>
                        </ul>
                    </li>
                @endif

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
