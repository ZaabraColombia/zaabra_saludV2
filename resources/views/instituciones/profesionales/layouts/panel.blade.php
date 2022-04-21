@extends('layouts.app-admin')

@section('content')
    <div class="row m-0 p-0">
        <div class="col-lg-3 d-none d-lg-block bg_white p-0" style="min-height: 80vh;">
            @include('instituciones.profesionales.layouts.menu')
        </div>

        <div class="col-12 col-lg-9 p-0">
            <div class="dropdown d-lg-none pt-3 pl-3">
                <a class="dropdown-toggle menu_mobile" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>

                <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                    @include('instituciones.profesionales.layouts.menu')
                </div>
            </div>
            
            <main>
                @yield('contenido')
            </main>
        </div>
    </div>
@endsection
