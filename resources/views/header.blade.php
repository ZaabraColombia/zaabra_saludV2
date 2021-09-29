<nav class="navbar navbar_zaabrasalud">
    <div class="container-fluid contains_header">
        <!-- Sección Logo Zaabra -->
        <a class="navbar-logo" href="{{ url('/') }}">
            <img class="logo_header" src="{{URL::asset('/img/header/logo-zaabra-salud.png')}}">
        </a>
        <!-- Sección barra de busqueda -->
        <div class="contains_boxsearch">
            <div class="barra_busqueda" id="barra_busqueda">
                <input  class="inputBarraBusquedad " id="filtro" data-url='{{ url('search') }}'>
                <button class="button_SearchBarH icon_searchH"></button>
            </div>
        </div>

        <!--******************************     Sección BARRA DE BUSQUEDA version MOBILE      *************************************-->
        <div class="contain_lupa-mobile">
            <!--///      Función para desplegar y ocultar barra de busqueda en la vista "header" versión Mobile ubicada en el archivo header.js      ///-->
            <button type="button" onclick="ocultaInput()" class="boton_lupa_mobile">
                <img class="icon_lupa-mobile" src="{{ asset('/img/header/icono-lupa-blanco.svg') }}" />
            </button>
        </div>
        <!--******************************     End sección BARRA DE BUSQUEDA version MOBILE      *********************************-->

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
                <a class="" href="{{ route('profesional.membresiaProfesional') }}">
                    <img class="img-button-membresia" src="{{ asset('/img/header/boton-membresia.png') }}">
                </a>
            </div>

            <!--******************************     Sección Botón Membresía version MOBILE      *************************************-->
            <a class="btnMembresia_header_mobile " href="{{ route('profesional.membresiaProfesional') }}"></a>
            <!--******************************     End sección Botón Membresía version MOBILE      *********************************-->

            <!-- Sección Menú hamburguesa -->
            <div class="menu-hamburger dropdown">
                <a class="icon-menu dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right menu_hamburguesa" aria-labelledby="dropdownMenuLink" style="">
                    <a class="dropdown-item menu_item item-cel icon-especialidades" href="{{ route('ramas-de-la-salud') }}"><span class="texto_item-menu">Especialidades medicas</span></a>
                        <div class="dropdown-divider m-0"></div>
                    <a class="dropdown-item menu_item item-cel icon-instituciones-burger" href="{{ route('Instituciones-Medicas') }}"><span class="texto_item-menu">Instituciones medicas</span></a>
                        <div class="dropdown-divider m-0"></div>
                    <a class="dropdown-item menu_item item-cel icon-quienes" href="{{ route('acerca') }}"><span class="texto_item-menu">Acerca de Zaabra</span></a>
                        <div class="dropdown-divider m-0"></div>
                    <a class="dropdown-item menu_item item-cel icon-contactenos" href="{{ route('contacto') }}"><span class="texto_item-menu">Contáctenos</span></a>
                </div>
            </div>
        @else
            <!-- Sección Botón membresía Desktop -->
            <div class="button-membresia">
                <a class="" href="{{ route('profesional.membresiaProfesional') }}">
                    <img class="img-button-membresia" src="{{ asset('/img/header/boton-membresia.png') }}">
                </a>
            </div>

            <!--******************************     Sección Botón Membresía version MOBILE      *************************************-->
            <a class="btnMembresia_header_mobile" href="{{ route('profesional.membresiaProfesional') }}"></a>
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
                            <div class="dropdown-divider m-0"></div>
                            <a class="dropdown-item menu_item-paciente icon-perfil" href="{{ url('/perfil') }}"><span class="texto_item-menu-paciente">Mi perfil</span></a>
                        @elseif($objtipoUsuarioLogueado->idrol==2)
                            <a class="dropdown-item menu_item-paciente icon-perfil" href="{{ url('/FormularioProfesional') }}"><span class="texto_item-menu-paciente">Mi perfil</span></a>
                            <div class="dropdown-divider m-0"></div>
                            <a class="dropdown-item menu_item-paciente icon-agenda" href="{{ url('/panelPrincipalProfesional') }}"><span class="texto_item-menu-paciente">Agenda</span></a>
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
                    <a class="dropdown-item menu_item item-cel icon-instituciones-burger" href="{{route('Instituciones-Medicas')}}"><span class="texto_item-menu">Instituciones medicas</span></a>
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
    </div>

    <!--******************************     Sección BARRA DE BUSQUEDA OCULTA version MOBILE      *************************************-->
    <!-- Clase "contains_barra"utilizada para mostrar y ocultar la barra de busqueda en el HEADER tamaño Mobile, función ubicada en el archivo header.js -->
    <div class="contains_barra">
        <div class="barra_oculta" id="buscador">
            <div class="barra_busqueda-mobile" id="barra_busqueda2">
                <input type="hidden" name="_token" value="tzFtz8TstiTocmap8vuJp4Py7sMc0zcQiC63SuyF">
                <input  class="inputBarraBusquedad" id="filtro2" data-url='{{ url('search') }}'>
                <!-- <input class="inputBarraBusquedad" type="buttton" name="buscar" id="barra_buscar" autocomplete="off"> -->
                <input type="image" class="contenedorLupa" src="{{asset('/img/header/icono-buscador-azul.svg')}}">
            </div>
        </div>
    </div>
    <!--******************************     End sección BARRA DE BUSQUEDA OCULTA version MOBILE      *********************************-->
</nav>
