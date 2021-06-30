<div id="sidebar" class="active">
            <div class="sidebar-wrapper active ps ps--active-y">
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>
                        @if(!empty($objListaUsuario1->isNotEmpty()))
                            <li class="sidebar-item  has-sub">
                                <a href="#" class="sidebar-link">
                                    <i class="bi bi-stack"></i>
                                    <span>Mis citas</span>
                                </a>
                                <ul class="submenu ">
                                    @foreach($objListaUsuario1 as $objListaUsuario1)
                                        <li class="submenu-item ">
                                            <a href="component-alert.html">{{$objListaUsuario1->nombrePermiso}}</a>
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
                                           <a href="component-alert.html">{{$objListaUsuario2->nombrePermiso}}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @endif
                        @if(!empty($objListaUsuario3->isNotEmpty()))
                            <li class="sidebar-item  has-sub">
                                <a href="#" class="sidebar-link">
                                    <i class="bi bi-grid-1x2-fill"></i>
                                    <span>Mis favoritos</span>
                                </a>
                                <ul class="submenu ">
                                    @foreach($objListaUsuario3 as $objListaUsuario3)
                                        <li class="submenu-item ">
                                        <a href="layout-default.html">{{$objListaUsuario3->nombrePermiso}}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; height: 50vh; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 100vh;"></div></div></div>
        </div>