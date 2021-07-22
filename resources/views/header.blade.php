
            <nav class="navbar navbar_zaabrasalud">
                <div class="container contains_header">
                    <!-- Sección Logo Zaabra -->
                    <a class="navbar-logo" href="{{ url('/') }}">
                        <img class="logo_header" src="{{URL::asset('/img/header/logo-zaabra-salud.png')}}">
                    </a>
                    <!-- Sección barra de busqueda -->
                    <div class="contains_boxsearch">
                        <div class="barra_busqueda" id="barra_busqueda">
                            <input  class="inputBarraBusquedad " id="filtro">
                            <button class="button_SearchBarH icon_searchH"></button>
                        </div> 
                    </div>

                    <!--******************************     Sección BARRA DE BUSQUEDA version MOBILE      *************************************-->
                    <!-- SECCION BARRA DE BUSQUEDA HEADER -->
                    <div class="contain_lupa-mobile">
                        <!--///      Función para desplegar y ocultar barra de busqueda en la vista "header" versión Mobile ubicada en el archivo header.js      ///-->
                        <button type="button" onclick="ocultaInput()" class="boton_lupa_mobile">
                            <img class="icon_lupa-mobile" src="{{URL::asset('/img/header/icono-lupa-blanco.svg')}}">
                        </button>
                    </div>
                    <!--******************************     End sección BARRA DE BUSQUEDA version MOBILE      *********************************-->
                    
                    <!-- Sección Soy paciente -->
                    @guest
                        <div class="soy_paciente dropdown">
                            <a class="dropdown-toggle icon_paciente" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                            <div class="dropdown-menu dropdown-menu-right menu_paciente" aria-labelledby="dropdownMenuLink" style="">
                                <a class="dropdown-item menu_item-paciente icon-paciente" href="{{ route('login') }}"><span class="texto_item-menu-paciente">Soy paciente</span></a>
                                <div class="dropdown-divider m-0"></div>
                                <a class="dropdown-item menu_item-paciente icon-medico" href="{{ route('login') }}"><span class="texto_item-menu-paciente">Soy doctor</span></a>
                                <div class="dropdown-divider m-0"></div>
                                <a class="dropdown-item menu_item-paciente icon-instituciones" href="{{ route('login') }}"><span class="texto_item-menu-paciente">Soy institución</span></a>    
                            </div>
                        </div>
                        <!-- Sección Botón membresía Desktop -->
                        <div class="button-membresia">
                            <a class="" href="{{ route('membresiaProfesional') }}">
                                <img class="img-button-membresia" src="{{URL::asset('/img/header/boton-membresia.png')}}">
                            </a>  
                        </div>

                        <!--******************************     Sección Botón Membresía version MOBILE      *************************************-->
                        <!-- SECCION BOTÓN MEMBRESÍA HEADER -->
                        <div class="button-membresia-mobile">
                            <a class="" href="{{ route('membresiaProfesional') }}">
                                <img class="img-button-membresia-mobile" src="{{URL::asset('/img/header/boton-de-memebresia-mob.png')}}"> 
                            </a>  
                        </div>
                        <!--******************************     End sección Botón Membresía version MOBILE      *********************************-->

                        <!-- Sección Menú hamburguesa -->
                        <div class="menu-hamburger dropdown">
                            <a class="icon-menu dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right menu_hamburguesa" aria-labelledby="dropdownMenuLink" style="">
                                <a class="dropdown-item menu_item item-cel icon-especialidades" href="{{route('ramas-de-la-salud')}}"><span class="texto_item-menu">Especialidades medicas</span></a>
                                <div class="dropdown-divider m-0"></div>
                                <a class="dropdown-item menu_item item-cel icon-instituciones-burger" href="{{route('Entidades')}}"><span class="texto_item-menu">Instituciones medicas</span></a>
                                <div class="dropdown-divider m-0"></div>
                                <a class="dropdown-item menu_item item-cel icon-quienes" href="{{route('acerca')}}"><span class="texto_item-menu">Acerca de Zaabra</span></a>
                                <div class="dropdown-divider m-0"></div>
                                <a class="dropdown-item menu_item item-cel icon-contactenos" href="{{route('contacto')}}"><span class="texto_item-menu">Contáctenos</span></a>
                            </div>
                        </div>
                    @else
                        <!-- Sección Botón membresía Desktop -->
                        <div class="button-membresia">
                            <a class="" href="{{ route('membresiaProfesional') }}">
                                <img class="img-button-membresia" src="{{URL::asset('/img/header/boton-membresia.png')}}">
                            </a>  
                        </div>

                        <!--******************************     Sección Botón Membresía version MOBILE      *************************************-->
                        <!-- SECCION BOTÓN MEMBRESÍA HEADER -->
                        <div class="button-membresia-mobile">
                            <a class="" href="{{ route('membresiaProfesional') }}">
                                <img class="img-button-membresia-mobile" src="{{URL::asset('/img/header/boton-de-memebresia-mob.png')}}"> 
                            </a>  
                        </div>
                        <!--******************************     End sección Botón Membresía version MOBILE      *********************************-->

                        <!-- Sección Menú hamburguesa -->
                        <div class="menu-hamburger dropdown">
                            <a class="icon-menu dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right menu_hamburguesa" aria-labelledby="dropdownMenuLink" style="">
                                @if(!empty($objtipoUsuarioLogueado))
                                    @if($objtipoUsuarioLogueado->idrol==1) 
                                    <a class="dropdown-item menu_item-paciente icon-agenda" href="{{ url('/panelPrincipal') }}"><span class="texto_item-menu-paciente">Agenda</span></a>
                                    @elseif($objtipoUsuarioLogueado->idrol==2)
                                    <a class="dropdown-item menu_item-paciente icon-perfil" href="{{ url('/FormularioProfesional') }}"><span class="texto_item-menu-paciente">Mi perfil</span></a>
                                      <div class="dropdown-divider m-0"></div>
                                    <a class="dropdown-item menu_item-paciente icon-agenda" href="{{ url('/panelPrincipal') }}"><span class="texto_item-menu-paciente">Agenda</span></a>
                                    @elseif($objtipoUsuarioLogueado->idrol==3)
                                    <a class="dropdown-item menu_item-paciente icon-perfil" href="{{ url('/FormularioInstitucion') }}"><span class="texto_item-menu-paciente">Mi perfil</span></a>
                                      <div class="dropdown-divider m-0"></div>
                                    <a class="dropdown-item menu_item-paciente icon-agenda" href="{{ url('/panelPrincipal') }}"><span class="texto_item-menu-paciente">Agenda</span></a>
                                    @elseif($objtipoUsuarioLogueado->idrol==4)
                                    <a class="dropdown-item menu_item-paciente icon-agenda" href="{{ url('/panelPrincipal') }}"><span class="texto_item-menu-paciente">Admin</span></a>
                                    @endif
                                 @endif 
                                 <div class="dropdown-divider m-0"></div>
                                <a class="dropdown-item menu_item item-cel icon-especialidades" href="{{route('ramas-de-la-salud')}}"><span class="texto_item-menu">Especialidades medicas</span></a>
                                <div class="dropdown-divider m-0"></div>
                                <a class="dropdown-item menu_item item-cel icon-instituciones-burger" href="{{route('Entidades')}}"><span class="texto_item-menu">Instituciones medicas</span></a>
                                <div class="dropdown-divider m-0"></div>
                                <a class="dropdown-item menu_item item-cel icon-quienes" href="{{route('acerca')}}"><span class="texto_item-menu">Acerca de Zaabra</span></a>
                                <div class="dropdown-divider m-0"></div>
                                <a class="dropdown-item menu_item item-cel icon-contactenos" href="{{route('contacto')}}"><span class="texto_item-menu">Contáctenos</span></a>
                                <div class="dropdown-divider m-0"></div>
                                <a class="dropdown-item menu_item-paciente icon-cerrarSesion" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    <span class="texto_item-menu-paciente">Salir</span>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </div>

                    @endguest
                    
                    <!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button> -->

                    <!-- <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        
                        <ul class="navbar-nav mr-auto">

                        </ul>

                        <ul class="navbar-nav ml-auto">
                            
                            @guest
                                @if (Route::has('login'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                    </li>
                                @endif

                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        <span>Bienvenido </span>{{auth()->user()->primernombre}} {{auth()->user()->primerapellido}}
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div> -->
                </div>

                <!--******************************     Sección BARRA DE BUSQUEDA OCULTA version MOBILE      *************************************-->
                <!-- Clase "contains_barra"utilizada para mostrar y ocultar la barra de busqueda en el HEADER tamaño Mobile, función ubicada en el archivo header.js -->
                <div class="contains_barra"> 
                    <div class="barra_oculta" id="buscador">
                        <div class="barra_busqueda-mobile" id="barra_busqueda2">
                            <input type="hidden" name="_token" value="tzFtz8TstiTocmap8vuJp4Py7sMc0zcQiC63SuyF">
                            <input  class="inputBarraBusquedad" id="filtro2">
                            <!-- <input class="inputBarraBusquedad" type="buttton" name="buscar" id="barra_buscar" autocomplete="off"> -->
                            <input type="image" class="contenedorLupa" src="{{URL::asset('/img/header/icono-buscador-azul.svg')}}">
                        </div> 
                    </div>
                </div>
                <!--******************************     End sección BARRA DE BUSQUEDA OCULTA version MOBILE      *********************************-->
            </nav>