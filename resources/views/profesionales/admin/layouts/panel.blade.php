@extends('layouts.app-admin')

@section('content')
    <div class="row m-0 p-0">
        <div class="col-2 col-lg-3 d-none d-lg-block p-0 bg-light sidebar" style="height: fit-content;">
            @include('profesionales.admin.layouts.menu')
        </div>

        <div class="col-12 col-lg-9  panel-Administrativo_prof">
            <div class="dropdown d-lg-none">
                <a class="icon_menu_agenda dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>

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
