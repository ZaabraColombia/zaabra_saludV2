@extends('layouts.app-admin')

@section('content')
    <div class="row m-0 p-0">
        <div class="col-3 d-none d-xl-block bg_white p-0" style="min-height: 80vh;">
            @include('instituciones.admin.layouts.menu')
        </div>

        <div class="col-12 col-lg-11 col-xl-9 p-0">
            <div class="dropdown d-xl-none pt-3 pl-3">
                <a class="dropdown-toggle menu_mobile" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>

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
