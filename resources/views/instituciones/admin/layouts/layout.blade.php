@extends('layouts.app-admin')

@section('content')
    <div class="row m-0 p-0">
        <div class="col-2 d-none d-lg-block p-0 bg-light sidebar" style="height: fit-content;">
            @include('instituciones.admin.layouts.menu')
        </div>

        <div class="col-12 col-lg-10 panel-Administrativo">
            <div class="dropdown d-lg-none">
                <a class="icon_menu_agenda dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>

                <div class="dropdown-menu" aria-labelledby="dropdownMenu2" style="z-index: 450;">
                    @include('instituciones.admin.layouts.menu')
                </div>
            </div>
            <main>
                @yield('contenido')
            </main>
        </div>
    </div>
@endsection
