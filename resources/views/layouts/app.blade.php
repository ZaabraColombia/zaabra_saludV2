<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">


        {!! SEO::generate() !!}
        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="shortcat icon" href="{{URL::asset('/img/logos/zaabrasalud-favicon.png')}}">
        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@600;700&family=Roboto:wght@400;500&display=swap" rel="stylesheet">



        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
        <link rel="stylesheet" href="https://unpkg.com/swiper@6.8.4/swiper-bundle.min.css" />
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.9.2/viewer.min.css" integrity="sha512-zwoDXU7OjppdwrN9brNSW0E2G5+BxJsDXrwoUCEYJ3mE4ZmApOp0DJc36amSk3h8iWi8+qjcii7WFb+9m8Ro4g==" crossorigin="anonymous" referrerpolicy="no-referrer" />-->



        @yield('styles')
    </head>
    <body>
    <div id="page_overlay"></div>
         @include('header')
        <div id="app">
                <!-------------------------------------------Contenido-------------------------------------------->
                <main>
                    @yield('content')
                </main>
                @include('footer')
        </div>
        <script src="{{ asset('js/app.js') }}"></script>
        <!--///      Ubicación de los SCRIPT de cada uno de los archivos .js utilizados en el proyecto zaabrasalud      ///-->
        <script src="https://unpkg.com/swiper@6.8.4/swiper-bundle.min.js"></script>
        <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.9.2/viewer.min.js" integrity="sha512-Cpto2uFAGrtCArBkIckJacfNjZ6yFJ1F61YIOH3Nj4dpccnCK1AGkudN9g+HM+OQMIHxeFvcRmkIUKbJ/7Qxyg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>-->
        <!--<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>-->
        <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js"></script>-->


        @yield('scripts')

        <!-- Scripts  areas-->
        <script src="{{ asset('js/header.js') }}"></script>
        <script src="{{ asset('js/home.js') }}"></script>
        <script src="{{ asset('js/footer.js') }}"></script>
        <script src="{{ asset('js/formularios.js') }}"></script>
        <script src="{{ asset('js/comentarios.js') }}"></script>
        <script src="{{ asset('js/filtroBusquedad.js') }}"></script>



        <!--<script src="{{ asset('js/adicionarcamposformulario.js') }}"></script>-->



        <!--js admin template-->
        <script src="{{ asset('js/admin.js') }}"></script>



    <!--/////    MODAL POPUP DE PAGO de las tarjetas de membresia de las vistas "membresiaProfesional" y "membresiaInstitucion". Estilos ubicados en la vista "popup-pagos.scss"  /////-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal_dialog-popup" role="document">
            <div class="modal-content modal_content-popup">
                <!-- Sección boton derecho de cierre "X" -->
                <div class="modal-header modal_header-popup">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body p-0">
                    <!-- Titulo y texto de encabezado -->
                    <h1 class="modal-title titulo_principal-popup" id="exampleModalLabel"> Seleccione el medio de pago</h1>

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

                            <h3 class="textoCheck_popup"> Pago en línea (PSE) </h3>

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

    </body>
</html>



