@php
    $user = Auth::user();
@endphp
<nav class="navbar navbar_zaabrasalud">
    <div class="container-fluid contains_header">
        <!-- Sección Logo Zaabra -->
        <a class="navbar-logo" href="{{ url('/') }}">
            <img class="logo_header" src="{{URL::asset('/img/header/logo-zaabra-salud.png')}}">
        </a>
        <!-- Sección barra de busqueda -->
        <div class="containt_buscador_desk">
            <div class="barra_busqueda" id="barra_busqueda">
                <input  class="input_buscador" id="filtro" data-url='{{ url('search') }}'>
                <button class="buscador_boton_desk buscador_icon_desk"></button>
            </div>
        </div>

        <!--******************************     Sección BARRA DE BUSQUEDA version MOBILE      *************************************-->
        <div class="busqueda_mobile">
            <!--///      Función para desplegar y ocultar barra de busqueda en la vista "header" versión Mobile ubicada en el archivo header.js      ///-->
            <button class="busqueda_boton_mobile" type="button" onclick="ocultaInput()">
                <img class="busqueda_icon_mobile" src="{{ asset('/img/header/icono-lupa-blanco.svg') }}" />
            </button>
        </div>
        <!--******************************     End sección BARRA DE BUSQUEDA version MOBILE      *********************************-->

    @guest
        <!-- Menú desplegable del LOGIN -->
            <div class="soy_paciente dropdown">
                <a class="dropdown-toggle {{--menu_flip--}}" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink" style="">
                    <a class="dropdown-item p-0" href="{{ route('login') }}">
                        <span class="menu__item icon__paciente">Soy paciente</span>
                    </a>
                    <div class="dropdown-divider m-0"></div>

                    <a class="dropdown-item p-0" href="{{ route('login') }}">
                        <span class="menu__item icon__doctor">Soy doctor</span>
                    </a>
                    <div class="dropdown-divider m-0"></div>

                    <a class="dropdown-item p-0" href="{{ route('login') }}">
                        <span class="menu__item icon__institucion">Soy institución</span>
                    </a>
                </div>
            </div>

            <!-- Sección Botón membresía Desktop -->
            <div class="button-membresia">
                <a class="" href="{{ route('profesional.membresiaProfesional') }}">
                    <img class="img-button-membresia" src="{{ asset('/img/header/boton-membresia.png') }}">
                </a>
            </div>

            <!--******************************     Sección Botón Membresía version MOBILE      *************************************-->
            <div class="membresia_mobile">
                <a class="membresia_icon_mobile" href="{{ route('profesional.membresiaProfesional') }}"></a>
            </div>

            <!--******************************     End sección Botón Membresía version MOBILE      *********************************-->

            <!-- Sección Menú hamburguesa no logueado-->
            <div class="menu-hamburger dropdown">
                <a class="dropdown-toggle {{--menu_flip--}}" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span></span>
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink" style="">
                    <a class="dropdown-item p-0" href="{{ route('ramas-de-la-salud') }}">
                        <span class="menu__item icon__especialidad">Especialidades medicas</span>
                    </a>
                    <div class="dropdown-divider m-0"></div>

                    <a class="dropdown-item p-0" href="{{ route('Instituciones-Medicas') }}">
                        <span class="menu__item icon__institucion">Instituciones medicas</span>
                    </a>
                    <div class="dropdown-divider m-0"></div>

                    <a class="dropdown-item p-0" href="{{ route('acerca') }}">
                        <span class="menu__item icon__quienes">Acerca de Zaabra</span>
                    </a>
                    <div class="dropdown-divider m-0"></div>

                    <a class="dropdown-item p-0" href="{{ route('contacto') }}">
                        <span class="menu__item icon__contactenos">Contáctenos</span>
                    </a>
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
            <div class="membresia_mobile">
                <a class="membresia_icon_mobile" href="{{ route('profesional.membresiaProfesional') }}"></a>
            </div>
            <!--******************************     End sección Botón Membresía version MOBILE      *********************************-->

            <!-- Sección Menú hamburguesa logueado -->
            <div class="menu-hamburger dropdown">
                <a class="dropdown-toggle {{--menu_flip--}}" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span></span>
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink" style="">

                    @if(!empty($objtipoUsuarioLogueado))
                        @if($objtipoUsuarioLogueado->idrol == 1)
                            {{--Usuario Paciente --}}
                            <div class="menu__item_head">
                                <img src="{{ asset($user->paciente->foto ?? 'img/menu/avatar.png') }}" alt="user.png">
                                <span>{{ $user->nombre_completo }}</span>
                            </div>
                            <div class="dropdown-divider m-0"></div>

                            <a class="dropdown-item p-0" href="{{ route('paciente.perfil') }}">
                                <div class="menu__item icon__perfil">Mi perfil</div>
                            </a>
                            <div class="dropdown-divider m-0"></div>

                            <a class="dropdown-item p-0" href="{{ route('paciente.panel') }}">
                                <div class="menu__item icon__agenda">Agenda</div>
                            </a>
                        @elseif($objtipoUsuarioLogueado->idrol==2)
                            {{--Usuario Doctor --}}
                            <div class="menu__item_head">
                                <img src="{{ asset($user->profesional->fotoperfil ?? 'img/menu/avatar.png') }}" alt="user.png">
                                <span>Dr.(a) {{ $user->nombre_completo }}</span>
                            </div>
                            <div class="dropdown-divider m-0"></div>

                            <a class="dropdown-item p-0" href="{{ route('profesional.perfil') }}">
                                <div class="menu__item icon__perfil">Mi perfil</div>
                            </a>
                            <div class="dropdown-divider m-0"></div>

                            <a class="dropdown-item p-0" href="{{ route('profesional.panel') }}">
                                <div class="menu__item icon__agenda">Agenda</div>
                            </a>
                        @elseif($objtipoUsuarioLogueado->idrol==3)
                            {{--Usuario Institución --}}
                            <div class="menu__item_head">
                                <img src="{{ asset($user->institucion->logo ?? 'img/menu/avatar.png') }}" alt="user.png">
                                <span>{{ $user->nombreinstitucion }}</span>
                            </div>

                            <div class="dropdown-divider m-0"></div>

                            <a class="dropdown-item p-0" href="{{ url('/FormularioInstitucion') }}">
                                <div class="menu__item icon__perfil">Mi perfil</div>
                            </a>
                            <div class="dropdown-divider m-0"></div>

                            <a class="dropdown-item p-0" href="{{ route('institucion.panel') }}">
                                <div class="menu__item icon__agenda">Agenda</div>
                            </a>
                        @elseif($objtipoUsuarioLogueado->idrol == 4)
                            {{--Usuario Auxiliar --}}
                            <div class="menu__item_head">
                                <img src="{{ asset($user->institucion->user->institucion->logo ?? 'img/menu/avatar.png') }}" alt="user.png">
                                <span>{{ $user->institucion->user->nombreinstitucion }}</span>
                            </div>
                            <div class="dropdown-divider m-0"></div>

                            <a class="dropdown-item p-0" href="{{ route('institucion.panel') }}">
                                <div class="menu__item icon__agenda">Agenda </div>
                            </a>
                        @endif
                    @endif

                    <div class="dropdown-divider m-0"></div>

                    <a class="dropdown-item p-0" href="{{route('ramas-de-la-salud')}}">
                        <div class="menu__item icon__especialidad">Especialidades medicas</div>
                    </a>
                    <div class="dropdown-divider m-0"></div>

                    <a class="dropdown-item p-0" href="{{route('Instituciones-Medicas')}}">
                        <div class="menu__item icon__institucion">Instituciones medicas</div>
                    </a>
                    <div class="dropdown-divider m-0"></div>

                    <a class="dropdown-item p-0" href="{{route('acerca')}}">
                        <div class="menu__item icon__quienes">Acerca de Zaabra</div>
                    </a>
                    <div class="dropdown-divider m-0"></div>

                    <a class="dropdown-item p-0" href="{{route('contacto')}}">
                        <div class="menu__item icon__contactenos">Contáctenos</div>
                    </a>
                    <div class="dropdown-divider m-0"></div>

                    <a class="dropdown-item p-0" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <div class="menu__item icon__closed">Salir</div>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        @endguest
    </div>

    <!--******************************     Sección BARRA DE BUSQUEDA OCULTA version MOBILE      *************************************-->
    <!-- Clase "contain_buscador_mobile"utilizada para mostrar y ocultar la barra de busqueda en el HEADER tamaño Mobile, función ubicada en el archivo header.js -->
    <div class="contain_buscador_mobile">
        <div class="section_buscador_mobile" id="buscador">
            <div class="barra_buscador_mobile" id="barra_busqueda2">
                <input type="hidden" name="_token" value="tzFtz8TstiTocmap8vuJp4Py7sMc0zcQiC63SuyF">
                <input  class="input_buscador" id="filtro2" data-url='{{ url('search') }}'>
                <!-- <input class="input_buscador" type="buttton" name="buscar" id="barra_buscar" autocomplete="off"> -->
                <input type="image" class="icon_buscador" src="{{asset('/img/header/icono-buscador-azul.svg')}}">
            </div>
        </div>
    </div>
    <!--******************************     End sección BARRA DE BUSQUEDA OCULTA version MOBILE      *********************************-->
</nav>
