@extends('layouts.app-admin')

@section('content')
<div class="row m-0 p-0">
        <div class="col-xl-2 d-none d-xl-block bg_white p-0" style="min-height: 80vh;">
            @include('instituciones.admin.layouts.menu')
        </div>

        <div class="col-12 col-xl-10 p-0">
            <div class="dropdown d-xl-none pt-3 pl-3">
                <!-- Icono menú hamburguesa -->
                <a class="dropdown-toggle menu_mobile" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                <!-- Sidebar o menú lateral oculto de 320px a 1024px -->
                <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                    @include('instituciones.admin.layouts.menu')
                </div>
            </div>
            <main>
                @yield('contenido')
            </main>
        </div>
    </div>
@endsection
