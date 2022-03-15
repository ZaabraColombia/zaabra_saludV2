<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        {!! SEO::generate() !!}
        <!-- <title>{{ config('app.name', 'Laravel') }}</title> -->

        <link rel="shortcat icon" href="{{asset('/img/logos/zaabrasalud-favicon.png')}}">
        <link rel="icon" href="{{asset('/img/logos/zaabrasalud-favicon.png')}}">
        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@600;700&family=Roboto:wght@400;500&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
        <link rel="stylesheet" href="https://unpkg.com/swiper@6.8.4/swiper-bundle.min.css" />
        <link href="{{ mix('css/app.css') }}" rel="stylesheet">

        <!-- <link rel="stylesheet" href="{{ asset('/plugins/map-leaflet/leaflet.css') }}"/> -->
        <!-- <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
        integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
        crossorigin=""/>
        <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" /> -->

        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css" integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ==" crossorigin="" />
        <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder@1.5.8/dist/Control.Geocoder.css" />



        <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.9.2/viewer.min.css" integrity="sha512-zwoDXU7OjppdwrN9brNSW0E2G5+BxJsDXrwoUCEYJ3mE4ZmApOp0DJc36amSk3h8iWi8+qjcii7WFb+9m8Ro4g==" crossorigin="anonymous" referrerpolicy="no-referrer" />-->

        @yield('styles')

        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-XYV89KDD52"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'G-XYV89KDD52');
        </script>
    </head>

    <body>
        <div id="page_overlay"></div>

        @include('header')

        <div id="app">
            <!--    Contenido   -->
            <main style="width: 100%">
                @yield('content')
            </main>

            @include('layouts.footer-admin')
        </div>

        <script src="{{ mix('js/app.js') }}"></script>
        <!--///      Ubicación de los SCRIPT de cada uno de los archivos .js utilizados en el proyecto zaabrasalud      ///-->
        <script src="https://unpkg.com/swiper@6.8.4/swiper-bundle.min.js"></script>
        <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.9.2/viewer.min.js" integrity="sha512-Cpto2uFAGrtCArBkIckJacfNjZ6yFJ1F61YIOH3Nj4dpccnCK1AGkudN9g+HM+OQMIHxeFvcRmkIUKbJ/7Qxyg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>-->
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js"></script>-->

        <!-- Scripts  areas-->
        <script src="{{ asset('js/header.js') }}"></script>
        <script src="{{ asset('js/home.js') }}"></script>
{{--        <script src="{{ asset('js/footer.js') }}"></script>--}}
        <script src="{{ asset('js/formularios.js') }}"></script>
        <script src="{{ asset('js/comentarios.js') }}"></script>
        <script src="{{ asset('js/filtroBusquedad.js') }}"></script>


        <script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet-src.js" integrity="sha512-IkGU/uDhB9u9F8k+2OsA6XXoowIhOuQL1NTgNZHY1nkURnqEGlDZq3GsfmdJdKFe1k1zOc6YU2K7qY+hF9AodA==" crossorigin=""></script>
        <script src="https://unpkg.com/leaflet-control-geocoder@1.5.8/dist/Control.Geocoder.js"></script>
        <!-- <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script> -->

        <!--<script src="{{ asset('js/adicionarcamposformulario.js') }}"></script>-->

        <!--js admin template-->
{{--        <script src="{{ asset('js/admin.js') }}"></script>--}}

        <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
        <script>
            feather.replace()
        </script>

        <!-- <script src="{{ asset('/plugins/map-leaflet/leatlef.js') }}"></script> -->
        <!-- <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
            integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
            crossorigin="">
        </script> -->

        @yield('scripts')
    </body>
</html>



