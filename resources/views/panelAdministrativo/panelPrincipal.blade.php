@extends('panelAdministrativo.panelAdministrativo')

@section('Panel')
    <div class="container">
        <div class="row">
            @if(!empty($objListaUsuario4->isNotEmpty()))
                @foreach($objListaUsuario4 as $objListaUsuario4)
                    <div class="col-6 col-lg-4 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
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
                        </div>
                    </div>
                @endforeach  
            @endif
        </div>
    </div>
@endsection

