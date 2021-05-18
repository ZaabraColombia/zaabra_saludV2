<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/home.js') }}" defer></script>
    <script src="{{ asset('js/galeriaProfesiones.js') }}" defer></script>
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
                <div class="contains_boxsearch d-none d-lg-flex">
                    <div class="barra_busqueda">
                        <form action="http://portal-test.zaabra.local/busqueda" method="POST" class="form-inline heigFormHeader" id="buscar">
                            <input type="hidden" name="_token" value="tzFtz8TstiTocmap8vuJp4Py7sMc0zcQiC63SuyF">
                            <input class="inputBarraBusquedad" type="buttton" name="buscar" id="barra_buscar" autocomplete="off">
                            <input type="image" class="contenedorLupa" src="{{URL::asset('/img/header/Lupa_Iconos.png')}}">
                        </form>
                    </div> 
                </div>

                <!--******************************     Sección BARRA DE BUSQUEDA version MOBILE      *************************************-->
                <!-- SECCION BARRA DE BUSQUEDA HEADER -->
                <div class="positionIConoLupaHeader d-flex d-lg-none">
                    <button type="button" class="btnLupaHeaderMovil">
                        <img class="lupaHeaderMovil" id="" src="{{URL::asset('/img/header/icono-lupa-blanco.svg')}}">
                    </button>
                </div>
                <!--******************************     End sección BARRA DE BUSQUEDA version MOBILE      *********************************-->

                <!-- Sección Soy paciente -->
                <div class="soy_paciente dropdown">
                    <a class="icon_menu dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="icon_paciente" src="{{URL::asset('/img/header/icono-soy-paciente-blanco.svg')}}">
                    </a>

                    <div class="dropdown-menu menu_paciente px-2" aria-labelledby="dropdownMenuLink" style="">
                        <a class="dropdown-item" href="#"><div class="icon_dropdown icon-especialidades"></div>Soy Paciente</a>
                        <a class="dropdown-item" href="#"><div class="icon_dropdown icon-instituciones"></div>Soy Doctor</a>
                        <a class="dropdown-item" href="#"><div class="icon_dropdown icon-quienes"></div>Soy institución</a>
                    </div>
                </div>

                <!-- Sección Botón membresía -->
                <div class="button-membresia d-none d-lg-flex">
                    <a class="" href="">
                        <img class="img-button-membresia" src="http://portal-test.zaabra.local/img/boton-membresia.png">
                    </a>  
                </div>

                <!--******************************     Sección BARRA DE BUSQUEDA version MOBILE      *************************************-->
                <!-- SECCION BARRA DE BUSQUEDA HEADER -->
                <div class="button-membresia d-flex d-lg-none">
                    <a class="" href="">
                        <img class="img-button-membresia" src="{{URL::asset('/img/header/boton-de-memebresia-mob.png')}}"> 
                    </a>  
                </div>
                <!--******************************     End sección BARRA DE BUSQUEDA version MOBILE      *********************************-->

                <!-- Sección Menú hamburguesa -->
                <div class="menu-hamburger dropdown">
                    <a class="icon-menu dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span></span>
                    </a>

                    <div class="dropdown-menu menu-hamburguesa px-2" aria-labelledby="dropdownMenuLink" style="">
                        <a class="dropdown-item" href="#"><div class="icon-dropdown icon-especialidades"></div>Especialidades medicas</a>
                        <a class="dropdown-item" href="#"><div class="icon-dropdown icon-instituciones"></div>Instituciones medicas</a>
                        <a class="dropdown-item" href="#"><div class="icon-dropdown icon-quienes"></div>¿Quiénes Somos?</a>
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
        </nav>

        <!-------------------------------------------Contenido-------------------------------------------->
        <main>
            @yield('content')
        </main>
        @include('footer')
    </div>
    <script src="{{ asset('js/footer.js') }}"></script>
</body>
</html>
