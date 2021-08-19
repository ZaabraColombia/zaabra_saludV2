@extends('layouts.app')
@section('content')
    <div class="row m-0 p-0">
        <div class="col-2 d-none d-lg-block bg-light sidebar">
            @include('menuAdminProfesional')
        </div>

        <div class="col-12 col-lg-10 panel-Administrativo_prof">
            <div class="dropdown d-lg-none menu_dropdown_agenda">
                <a class="icon_menu_agenda dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>

                <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                    <div id="sidebar" class="active">
                        <div class="sidebar-wrapper active ps ps--active-y">
                            <div class="sidebar-menu">
                                <ul class="menu">
                                    <a href="{{ url('/panelPrincipalProfesional') }}" class="">
                                        <li class="sidebar-title">Menu OSCAR</li>
                                    </a>
                                    @if(!empty($objListaUsuario1->isNotEmpty()))
                                        <li class="sidebar-item  has-sub">
                                            <!-- <a href="#" class="sidebar-link"> -->
                                                <i class="bi bi-stack"></i>
                                                <span>Mis citas</span>
                                            <!-- </a> -->
                                            <ul class="submenu active p-0">
                                                <!-- @foreach($objListaUsuario1 as $objListaUsuario1)
                                                    <li class="submenu-item ">
                                                        <a href='{{url("$objListaUsuario1->urlPermiso")}}'>{{$objListaUsuario1->nombrePermiso}}</a>
                                                    </li>
                                                @endforeach -->
                                                <li class="submenu-item ">
                                                    <a href='{{url("citasProfesional")}}'>Citas</a>
                                                </li>
                                                <li class="submenu-item ">
                                                    <a href='{{url("calendarioProfesional")}}'>Calendario</a>
                                                </li>
                                                <li class="submenu-item ">
                                                    <a href='{{url("pagosProfesional")}}'>Mis pagos</a>
                                                </li>
                                            </ul>
                                        </li>
                                    @endif
                                    @if(!empty($objListaUsuario2->isNotEmpty()))
                                        <li class="sidebar-item  has-sub">
                                            <!-- <a href="#" class="sidebar-link"> -->
                                                <i class="bi bi-collection-fill"></i>
                                                <span>Mi Historia Clínica</span>
                                            <!-- </a> -->
                                            <ul class="submenu active p-0">
                                                <!-- @foreach($objListaUsuario2 as $objListaUsuario2)
                                                    <li class="submenu-item ">
                                                        <a href='{{url("$objListaUsuario2->urlPermiso")}}'>{{$objListaUsuario2->nombrePermiso}}</a>
                                                    </li>
                                                @endforeach -->
                                                <li class="submenu-item ">
                                                    <a href='{{url("historiaClinicaProfesional")}}'>Historia clínica</a>
                                                </li>
                                                <li class="submenu-item ">
                                                    <a href='{{url("prescripcionesProfesional")}}'>Prescripciones/ fórmulas médicas</a>
                                                </li>
                                                <li class="submenu-item ">
                                                    <a href='{{url("diagnosticosProfesional")}}'>Diagnósticos (CIE - 10)</a>
                                                </li>
                                                <li class="submenu-item ">
                                                    <a href='{{url("procedimientosProfesional")}}'>Procedimientos (CUPS)</a>
                                                </li>
                                                <li class="submenu-item ">
                                                    <a href='{{url("vademecumProfesional")}}'>Vademecum actualizado COLOMBIA INVIMA (CUMS)</a>
                                                </li>
                                            </ul>
                                        </li>
                                    @endif

                                                    
                                    @if(!empty($objListaUsuario3->isNotEmpty()))
                                        <li class="sidebar-item  has-sub">
                                            <!-- <a href="#" class="sidebar-link"> -->
                                                <i class="bi bi-grid-1x2-fill"></i>
                                                <span>Mis favoritos</span>
                                            <!-- </a> -->
                                            <ul class="submenu active p-0">
                                                <!-- @foreach($objListaUsuario3 as $objListaUsuario3)
                                                    <li class="submenu-item ">
                                                        <a href='{{url("$objListaUsuario3->urlPermiso")}}'>{{$objListaUsuario3->nombrePermiso}}</a>
                                                    </li>
                                                @endforeach -->
                                                <li class="submenu-item ">
                                                    <a href='{{url("favoritosProfesional")}}'>Favoritos</a>
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
                            <!-- <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
                            <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                                <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                            </div>
                            <div class="ps__rail-y" style="top: 0px; height: 50vh; right: 0px;">
                                <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 50vh;"></div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>

            <main>
                @yield('PanelProf')
            </main>
        </div>
    </div>
@endsection