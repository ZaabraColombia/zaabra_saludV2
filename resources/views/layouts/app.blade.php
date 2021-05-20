<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@600;700&family=Roboto:wght@400;500&display=swap" rel="stylesheet">


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    
</head>
<body>
    <div id="app">
        <!-------------------------------------------Headaer-------------------------------------------->
        <nav class="navbar navbar_zaabrasalud">
            <div class="container contains_header">
                <!-- Sección Logo Zaabra -->
                <a class="navbar-logo" href="{{ url('/') }}">
                    <img class="logo_header" src="{{URL::asset('/img/header/logo-zaabra.png')}}">
                </a>

                <!-- Sección barra de busqueda -->
                <div class="contains_boxsearch">
                    <div class="barra_busqueda">
                        <form action="http://portal-test.zaabra.local/busqueda" method="POST" class="form-inline heigFormHeader" id="buscar">
                            <input type="hidden" name="_token" value="tzFtz8TstiTocmap8vuJp4Py7sMc0zcQiC63SuyF">
                            <input class="inputBarraBusquedad" type="buttton" name="buscar" id="barra_buscar" autocomplete="off">
                            <input type="image" class="contenedorLupa" src="{{URL::asset('/img/header/icono-buscador-azul.svg')}}">
                        </form>
                    </div> 
                </div>

                <!--******************************     Sección BARRA DE BUSQUEDA version MOBILE      *************************************-->
                <!-- SECCION BARRA DE BUSQUEDA HEADER -->
                <div class="contain_lupa-mobile">
                    <button type="button" onclick="ocultaInput()" class="boton_lupa_mobile">
                        <img class="icon_lupa-mobile" src="{{URL::asset('/img/header/icono-lupa-blanco.svg')}}">
                    </button>
                </div>
                <!--******************************     End sección BARRA DE BUSQUEDA version MOBILE      *********************************-->

                <!-- Sección Soy paciente -->
                <div class="soy_paciente dropdown">
                    <a class="dropdown-toggle icon_paciente" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>

                    <div class="dropdown-menu dropdown-menu-right menu_paciente" aria-labelledby="dropdownMenuLink" style="">
                        <a class="dropdown-item menu_item-paciente icon-paciente" href="#"><span class="texto_item-menu-paciente">Soy Paciente</span></a>
                        <div class="dropdown-divider m-0"></div>
                        <a class="dropdown-item menu_item-paciente icon-medico" href="#"><span class="texto_item-menu-paciente">Soy Doctor</span></a>
                        <div class="dropdown-divider m-0"></div>
                        <a class="dropdown-item menu_item-paciente icon-instituciones" href="#"><span class="texto_item-menu-paciente">Soy institución</span></a>
                    </div>
                </div>

                <!-- Sección Botón membresía -->
                <div class="button-membresia">
                    <a class="" href="">
                        <img class="img-button-membresia" src="http://portal-test.zaabra.local/img/boton-membresia.png">
                    </a>  
                </div>

                <!--******************************     Sección Botón Membresía version MOBILE      *************************************-->
                <!-- SECCION BOTÓN MEMBRESÍA HEADER -->
                <div class="button-membresia-mobile">
                    <a class="" href="">
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
                        <a class="dropdown-item menu_item item-cel icon-especialidades" href="#"><span class="texto_item-menu">Especialidades medicas</span></a>
                        <div class="dropdown-divider m-0"></div>
                        <a class="dropdown-item menu_item item-cel icon-instituciones-burger" href="#"><span class="texto_item-menu">Instituciones medicas</span></a>
                        <div class="dropdown-divider m-0"></div>
                        <a class="dropdown-item menu_item item-cel icon-quienes" href="#"><span class="texto_item-menu">Acerca de Zaabra</span></a>
                        <div class="dropdown-divider m-0"></div>
                        <a class="dropdown-item menu_item item-cel icon-contactenos" href="#"><span class="texto_item-menu">Contáctenos</span></a>
                    </div>
                </div>

                
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
            <div class="contains_barra">
                <div class="barra_oculta" id="buscador">
                    <div class="barra_busqueda-mobile">
                        <form action="http://portal-test.zaabra.local/busqueda" method="POST" class="form-inline heigFormHeader" id="buscar">
                            <input type="hidden" name="_token" value="tzFtz8TstiTocmap8vuJp4Py7sMc0zcQiC63SuyF">
                            <input class="inputBarraBusquedad" type="buttton" name="buscar" id="barra_buscar" autocomplete="off">
                            <input type="image" class="contenedorLupa" src="{{URL::asset('/img/header/icono-buscador-azul.svg')}}">
                        </form>
                    </div> 
                </div>
            </div>
            <!--******************************     End sección BARRA DE BUSQUEDA OCULTA version MOBILE      *********************************-->
        </nav>

        <!-------------------------------------------Contenido-------------------------------------------->
        <main>
            @yield('content')
        </main>
        @include('footer')
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/header.js') }}"></script>
    <script src="{{ asset('js/home.js') }}"></script>
    <script src="{{ asset('js/footer.js') }}"></script>
    <script src="{{ asset('js/profesionales.js') }}"></script>
    <script src="{{ asset('js/galeriaProfesiones.js') }}"></script>
</body>
</html>
