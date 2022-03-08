@extends('layouts.app')

@section('content')
    <div class="row m-0 p-0">
        <div class="col-2 col-lg-3 d-none d-lg-block bg_white p-0">
            @include('profesionales.admin.layouts.menu')
        </div>

        <div class="col-12 col-lg-9 bg_gray p-0">
            <div class="dropdown d-lg-none pt-3 pl-3">
                <a class="dropdown-toggle menu_mobile" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>

                <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                    @include('profesionales.admin.layouts.menu')
                </div>
            </div>

            <main>
                @yield('contenido')
            </main>
        </div>
    </div>
@endsection
