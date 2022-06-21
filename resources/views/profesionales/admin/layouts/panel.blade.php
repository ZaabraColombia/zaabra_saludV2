@extends('layouts.app-admin')

@section('content')
    <!-- Botón despliegue y repliegue menú lateral o sidebar dispositivos (320px - 1024px) -->
    <button class="btn_opening" type="button" data-open="sideBar"></button>

    <!-- Menú lateral o sidebar -->
    <div class="sideBar" id="sideBar">
        @include('profesionales.admin.layouts.menu')
    </div>

    <!-- Panel central dashboard -->
    <div class="main__contenido">
        <!-- Contenedor principal de los modulos  -->
        <main>
            @yield('contenido')
        </main>
        <!-- Contenedor principal del footer -->
        <main class="mt-auto">
            @include('layouts.footer-admin')
        </main>
    </div>
@endsection