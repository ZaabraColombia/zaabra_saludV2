@extends('panelAdministrativo.panelAdministrativo')

@section('Panel')
    <div class="container">
        <div class="row">
            @if(!empty($objListaUsuario4->isNotEmpty()))
                @foreach($objListaUsuario4 as $objListaUsuario4)
                    <div class="col-6 col-lg-4 col-md-6 mb-5 mt-5">
                        <div class="card" style="width: 18rem;">
                            <a  href='{{url("$objListaUsuario4->urlPermiso")}}'>
                                <div class="card-body px-3 py-4-5 cardtipo{{$objListaUsuario4->idrol}}">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="stats-icon purple">
                                                <i class="iconly-boldShow"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <span class="text-muted font-semibold">{{$objListaUsuario4->nombrePermiso}}</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach  
            @endif
        </div>
    </div>
@endsection
