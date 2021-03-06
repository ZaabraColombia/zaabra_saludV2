<div id="sidebar" class="active">
    <div class="sidebar-wrapper active ps ps--active-y">
        <div class="sidebar-menu">
            <h1 class="title_agenda mb-0 px-3">AGENDA PACIENTE</h1>

            <ul class="menu">
                <a id="menu_panel" class="actived" href="{{ url('/panelPrincipal') }}" ><i class="fas fa-home"></i> Menu</a>


                @if(!empty($objListaUsuario1->isNotEmpty()))
                    <li class="sidebar-item  has-sub">
                        <span id="cita_padre" class="titulo_menu"><i class="fas fa-calendar" style="padding: 5px 5px 0 0;"></i> Mis citas</span>
                        <ul class="submenu active">

                            @foreach($objListaUsuario1 as $key => $objListaUsuario1)
                                <li class="submenu-item ">
                                    <a id="cita{{$key}}" class="actived" href='{{url("$objListaUsuario1->urlPermiso")}}'><i class="fas fa-dot-circle"></i> {{$objListaUsuario1->nombrePermiso}}</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endif

                @if(!empty($objListaUsuario2->isNotEmpty()))
                    <li class="sidebar-item  has-sub">
                        <!-- <a href="#" class="sidebar-link"> -->
                        <!-- <i class="bi bi-collection-fill"></i> -->
                        <span id="historia_padre" class="titulo_menu">Mi Historia Clínica</span>
                        <!-- </a> -->
                        <ul class="submenu ">
                            @foreach($objListaUsuario2 as $objListaUsuario2)
                                <li class="submenu-item ">
                                    <a id="cita" class="actived" href='{{url("$objListaUsuario2->urlPermiso")}}'>{{$objListaUsuario2->nombrePermiso}}</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endif


                @if(!empty($objListaUsuario3->isNotEmpty()))
                    <li class="sidebar-item  has-sub">
                        <!-- <a href="#" class="sidebar-link"> -->
                        <!-- <i class="bi bi-grid-1x2-fill"></i> -->
                        <span id="favorito_padre" class="titulo_menu">
                            <i class="fas fa-bookmark" style="padding: 5px 5px 0 0;"></i>
                            Mis favoritos
                        </span>
                        <!-- </a> -->
                        <ul class="submenu active">
                            @foreach($objListaUsuario3 as $objListaUsuario3)
                                <li class="submenu-item ">
                                    <a id="fav" class="actived" href='{{url("$objListaUsuario3->urlPermiso")}}'>
                                        <i class="fas fa-dot-circle"></i>
                                        {{$objListaUsuario3->nombrePermiso}}
                                    </a>
                                </li>
                            @endforeach
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
                                    <a id="cita" class="actived" href='{{url("$objListaUsuario5->urlPermiso")}}'>{{$objListaUsuario5->nombrePermiso}}</a>
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
                                    <a id="cita" class="actived" href='{{url("$objListaUsuario6->urlPermiso")}}'>{{$objListaUsuario6->nombrePermiso}}</a>
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
                                    <a id="cita" class="actived" href='{{url("$objListaUsuario7->urlPermiso")}}'>{{$objListaUsuario7->nombrePermiso}}</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</div>
