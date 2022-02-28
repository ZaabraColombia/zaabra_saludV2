<div id="sidebar" class="active">
    <div class="sidebar-wrapper active ps ps--active-y">
        <div class="sidebar-menu">
            <div class="imgtxtagen">
                <img class="imagen_usuario_agen" src="{{URL::asset('img/user/7/7-1631140530.jpg')}}" alt="">
                <h1 class="title_agenda mb-0">Dr. Santiago Arturo Polo Chahin</h1>
            </div>

            <ul class="menu pr-0">
                <li class="sidebar-item  has-sub ">
                    <a id="menu_panel" class="actived" href="{{ url('/panelPrincipalProfesional') }}"> Menu </a>
                </li>
                @if(!empty($objListaUsuario1->isNotEmpty()))
                    <li class="sidebar-item  has-sub">
                        <!-- <a href="#" class="sidebar-link">
                            <i class="bi bi-stack"></i>-->
                        <span id="cita_padre" class="titulo_menu">Mis citas</span>
                        <!-- </a> -->
                        <ul class="submenu active p-0">
                            <!-- @foreach($objListaUsuario1 as $objListaUsuario1)
                                <li class="submenu-item ">
                                    <a href='{{url("$objListaUsuario1->urlPermiso")}}'>{{$objListaUsuario1->nombrePermiso}}</a>
                                </li>
                            @endforeach -->
                            <li class="submenu-item">
                                <a id="cita" class="actived" href='{{url("citasProfesional")}}'>Citas</a>
                            </li>
                            <li class="submenu-item ">
                                <a id="calendario" class="actived" href='{{url("calendarioProfesional")}}'>Calendario</a>
                            </li>
                            <li class="submenu-item ">
                                <a id="pago" class="actived" href='{{url("pagosProfesional")}}'>Mis pagos</a>
                            </li>
                        </ul>
                    </li>
                @endif
                @if(!empty($objListaUsuario2->isNotEmpty()))
                    <li class="sidebar-item  has-sub">
                        <!-- <a href="#" class="sidebar-link">
                            <i class="bi bi-collection-fill"></i>-->
                        <span id="historia_padre" class="titulo_menu">Procedimientos</span>
                        <!-- </a> -->
                        <ul class="submenu active p-0">
                            <!-- @foreach($objListaUsuario2 as $objListaUsuario2)
                                <li class="submenu-item ">
                                    <a href='{{url("$objListaUsuario2->urlPermiso")}}'>{{$objListaUsuario2->nombrePermiso}}</a>
                                </li>
                            @endforeach -->
                            <!-- <li class="submenu-item ">
                                <a id="hist" class="actived" href='{{url("historiaClinicaProfesional")}}'>Historia clínica</a>
                            </li>
                            <li class="submenu-item ">
                                <a id="formula" class="actived" href='{{url("prescripcionesProfesional")}}'>Prescripciones/ fórmulas médicas</a>
                            </li> -->
                            <li class="submenu-item ">
                                <a id="diag" class="actived" href='{{ route('profesional.cie10') }}'>Diagnósticos (CIE - 10)</a>
                            </li>
                            <li class="submenu-item ">
                                <a id="proced" class="actived" href='{{ route('profesional.cups') }}'>Procedimientos (CUPS)</a>
                            </li>
                            <li class="submenu-item ">
                                <a id="vademe" class="actived" href='{{ route("profesional.cums") }}'>Vademecum actualizado COLOMBIA INVIMA (CUMS)</a>
                            </li>
                        </ul>
                    </li>
                @endif


                @if(!empty($objListaUsuario3->isNotEmpty()))
                    <li class="sidebar-item  has-sub">
                        <!-- <a href="#" class="sidebar-link">
                            <i class="bi bi-grid-1x2-fill"></i>-->
                        <span id="favorito_padre" class="titulo_menu">Mis favoritos</span>
                        <!-- </a> -->
                        <ul class="submenu active p-0">
                            <!-- @foreach($objListaUsuario3 as $objListaUsuario3)
                                <li class="submenu-item ">
                                    <a href='{{url("$objListaUsuario3->urlPermiso")}}'>{{$objListaUsuario3->nombrePermiso}}</a>
                                </li>
                            @endforeach -->
                            <li class="submenu-item ">
                                <a id="fav" class="actived" href='{{url("favoritosProfesional")}}'>Favoritos</a>
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
