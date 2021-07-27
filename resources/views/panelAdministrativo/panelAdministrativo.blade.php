@extends('layouts.app')
@section('content')
    <div class="row m-0 p-0">
        <div class="col-2 d-none d-md-block bg-light sidebar">
            @include('menuAdmin')
        </div>

        <div class="col-12 col-md-10 panel-Administrativo">
            <main>
                @yield('Panel')
            </main>
        </div>
    </div>
@endsection