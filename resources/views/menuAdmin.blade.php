
<div id="sidebar" class="active">
        <div class="sidebar-wrapper active ps ps--active-y">
            <div class="sidebar-menu">
                <ul class="menu">
                    <a href="{{ url('/panelPrincipal') }}" class="">
                    <li class="sidebar-title">Menu</li>
                    </a>
                    @if(!empty($objListaUsuario1->isNotEmpty()))
                        <li class="sidebar-item  has-sub">
                            <!-- <a href="#" class="sidebar-link"> -->
                                <i class="bi bi-stack"></i>
                                <span>Mis citas</span>
                            <!-- </a> -->
                            <ul class="submenu active">
                                @foreach($objListaUsuario1 as $objListaUsuario1)
                                    <li class="submenu-item ">
                                        <a href='{{url("$objListaUsuario1->urlPermiso")}}'>{{$objListaUsuario1->nombrePermiso}}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @endif
                    @if(!empty($objListaUsuario2->isNotEmpty()))
                        <li class="sidebar-item  has-sub">
                            <a href="#" class="sidebar-link">
                                <i class="bi bi-collection-fill"></i>
                                <span>Mi Historia Clínica</span>
                            </a>
                            <ul class="submenu ">
                                @foreach($objListaUsuario2 as $objListaUsuario2)
                                    <li class="submenu-item ">
                                        <a href='{{url("$objListaUsuario2->urlPermiso")}}'>{{$objListaUsuario2->nombrePermiso}}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @endif

                                  
                    @if(!empty($objListaUsuario3->isNotEmpty()))
                        <li class="sidebar-item  has-sub">
                            <!-- <a href="#" class="sidebar-link"> -->
                                <i class="bi bi-grid-1x2-fill"></i>
                                <span>Mis favoritos</span>
                            <!-- </a> -->
                            <ul class="submenu active">
                                @foreach($objListaUsuario3 as $objListaUsuario3)
                                    <li class="submenu-item ">
                                        <a href='{{url("$objListaUsuario3->urlPermiso")}}'>{{$objListaUsuario3->nombrePermiso}}</a>
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
            <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
            </div>
            <div class="ps__rail-y" style="top: 0px; height: 50vh; right: 0px;">
                <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 50vh;"></div>
            </div>
        </div>
</div>