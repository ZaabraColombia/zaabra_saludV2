<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">


        <!-- Scripts -->
        <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.9.2/viewer.min.js" integrity="sha512-Cpto2uFAGrtCArBkIckJacfNjZ6yFJ1F61YIOH3Nj4dpccnCK1AGkudN9g+HM+OQMIHxeFvcRmkIUKbJ/7Qxyg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="{{ asset('js/selectareas.js') }}" defer></script>

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@600;700&family=Roboto:wght@400;500&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
        <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.9.2/viewer.min.css" integrity="sha512-zwoDXU7OjppdwrN9brNSW0E2G5+BxJsDXrwoUCEYJ3mE4ZmApOp0DJc36amSk3h8iWi8+qjcii7WFb+9m8Ro4g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js"></script>
    </head>
    <body>
        <label for="cursos">Cursos: </label>
        <input id="cursos">
        <div id="app">
            <!-------------------------------------------Headaer-------------------------------------------->
            <nav class="navbar navbar_zaabrasalud">
                <div class="container contains_header">
                    <!-- Sección Logo Zaabra -->
                    <a class="navbar-logo" href="{{ url('/') }}">
                        <img class="logo_header" src="{{URL::asset('/img/header/logo-zaabra-salud.png')}}">
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
                        <!--///      Función para desplegar y ocultar barra de busqueda en la vista "header" versión Mobile ubicada en el archivo header.js      ///-->
                        <button type="button" onclick="ocultaInput()" class="boton_lupa_mobile">
                            <img class="icon_lupa-mobile" src="{{URL::asset('/img/header/icono-lupa-blanco.svg')}}">
                        </button>
                    </div>
                    <!--******************************     End sección BARRA DE BUSQUEDA version MOBILE      *********************************-->

                    <!-- Sección Soy paciente -->
                    <div class="soy_paciente dropdown">
                        <a class="dropdown-toggle icon_paciente" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>

                        <div class="dropdown-menu dropdown-menu-right menu_paciente" aria-labelledby="dropdownMenuLink" style="">
                            <a class="dropdown-item menu_item-paciente icon-paciente" href="{{ route('login') }}"><span class="texto_item-menu-paciente">Soy Paciente</span></a>
                            <div class="dropdown-divider m-0"></div>
                            <a class="dropdown-item menu_item-paciente icon-medico" href="{{ route('login') }}"><span class="texto_item-menu-paciente">Soy Doctor</span></a>
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
                            <a class="dropdown-item menu_item item-cel icon-especialidades" href="#"><span class="texto_item-menu">Especialidades medicas</span></a>
                            <div class="dropdown-divider m-0"></div>
                            <a class="dropdown-item menu_item item-cel icon-instituciones-burger" href="#"><span class="texto_item-menu">Instituciones medicas</span></a>
                            <div class="dropdown-divider m-0"></div>
                            <a class="dropdown-item menu_item item-cel icon-quienes" href="{{route('acerca')}}"><span class="texto_item-menu">Acerca de Zaabra</span></a>
                            <div class="dropdown-divider m-0"></div>
                            <a class="dropdown-item menu_item item-cel icon-contactenos" href="{{route('contacto')}}"><span class="texto_item-menu">Contáctenos</span></a>
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
                <!-- Clase "contains_barra"utilizada para mostrar y ocultar la barra de busqueda en el HEADER tamaño Mobile, función ubicada en el archivo header.js -->
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
        <!--///      Ubicación de los SCRIPT de cada uno de los archivos .js utilizados en el proyecto zaabrasalud      ///-->
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/header.js') }}"></script>
        <script src="{{ asset('js/register.js') }}"></script>
        <script src="{{ asset('js/home.js') }}"></script>
        <script src="{{ asset('js/footer.js') }}"></script>
        <script src="{{ asset('js/formularios.js') }}"></script>
        <script src="{{ asset('js/profesionales.js') }}"></script>
        <script src="{{ asset('js/perfil-profesionales.js') }}"></script>
        <script src="{{ asset('js/galeriaProfesiones.js') }}"></script>
        <script src="{{ asset('js/instituciones.js') }}"></script>
        <script src="{{ asset('js/selectareas.js') }}"></script>
        <script src="{{ asset('js/selectpais.js') }}"></script>
        <script src="{{ asset('js/cargaFoto.js') }}"></script>
        <script src="{{ asset('js/contacto.js') }}"></script>
        <script src="{{ asset('js/adicionarcamposformulario.js') }}"></script>
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script>
            $(function(){
                $("#cursos").autocomplete({
                source: function(request, response) {
                    $.ajax({
                    url: "{{route('search.cursos')}}",
                    dataType: "json",
                    data: {
                        term: request.term
                    },
                    success: function( data ) {
                        response( data );
                    }
                    });
                },
                select: function (event, ui) {
                    $('#cursos').val(ui.item.label);
                    $('#cursos').val(ui.item.value); 
                    return false;
                    }

                });
            });
        </script>

    </body>

    <!--/////    MODAL POPUP DE PAGO de las tarjetas de membresia de las vistas "membresiaProfesional" y "membresiaInstitucion". Estilos ubicados en la vista "popup-pagos.scss"  /////-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal_dialog-popup" role="document">
            <div class="modal-content modal_content-popup">
                <!-- Sección boton derecho de cierre "X" -->
                <div class="modal-header modal_header-popup">
                    <button type="button" class="btn_close-popup" data-dismiss="modal" aria-label="Close">
                        <span class="Xcierre_modal-popup" aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body p-0">
                    <!-- Titulo y texto de encabezado -->
                    <h5 class="modal-title titulo_principal-popup" id="exampleModalLabel"> Seleccione el medio de pago</h5>

                    <p class="texto_superior-popup"> Seleccione el medio de pago que mejor se adapte a su necesidad. </p>
                    
                    <!-- Sección iconos medios de pago Tarjeta de credito y PSE -->
                    <!--//////      Funcionalidad de cambio de color de los botones e iconos de pago del poup se encuentran en el archivo instituciones.js     //////-->
                    <div class="section_icons-popup">
                        <!-- Tarjeta de credito -->
                        <div class="secction_tarjeta-popup">
                            <img id="img_tarjCred" src="{{URL::asset('/img/popup-pago/tarjetas-de-credito-azul.svg')}}" class="icon_popup">  

                            <h3 class="textoCheck_popup"> Tarjetas de crédito </h3> 

                            <input class="inputCheck_popup" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                        </div> 

                        <!-- PSE -->
                        <div class="secction_tarjeta-popup">
                            <img id="img_pagoPse" src="{{URL::asset('/img/popup-pago/medios-online-pse-azul.svg')}}" class="icon_popup"> 

                            <h3 class="textoCheck_popup"> Medio online (PSE) </h3>   

                            <input class="inputCheck_popup" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                        </div>  
                    </div>

                    <!-- Sección botón Pagar -->
                    <div class="section_btnPagar-popup">
                        <button type="submit" class="btnPagar-popup" id="btnPagarPremium2" data-toggle="modal" data-target="#modalPagoEspera"> {{ __('Pagar') }}
                            <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flecha_pagar-popup" alt=""> 
                        </button>
                    </div>

                    <!-- @if (auth()->check())
                        <button type="button" class="btn-modalPagos-PremiunHome" id="btnPagarPremium2" data-toggle="modal" data-target="#modalPagoEspera">Seleccionar</button>
                    @else
                        <a href="">
                            <button class=" btn-modalPagos-PremiunHome"> Seleccionar</button>
                        </a>
                    @endif -->
                </div>
            </div>
        </div>
    </div>
</html>


