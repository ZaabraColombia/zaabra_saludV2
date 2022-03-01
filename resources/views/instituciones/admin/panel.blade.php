@extends('profesionales.admin.layouts.panelAdministrativoProfesional')

@section('PanelProf')
    <div class="container container_principal p-md-0">
        <div class="row">
            <div class="container_target p-md-0 col-6 col-lg-4 col-md-6 mb-5 mt-5">
                <div class="card cards_panelPrincipal_prof">
                    <a href="{{ route('entidad.panel') }}">
                        <div class="card-body card_optionPrincipal cardtipo2">
                            <div class="target-panel">
                                <div>
                                    <img src="{{ asset('img/agenda/panelPrincipal/mi-calendario.png') }}" alt="calendario.png">
                                </div>
                                <div>
                                    <span class="text-muted font-semibold">Mi calendario</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="container_target p-md-0 col-6 col-lg-4 col-md-6 mb-5 mt-5">
                <div class="card cards_panelPrincipal_prof">
                    <a href="{{ route('entidad.citas') }}">
                        <div class="card-body card_optionPrincipal cardtipo2">
                            <div class="target-panel">
                                <div>
                                    <img src="{{ asset('img/agenda/panelPrincipal/mis-citas.jpg') }}" alt="citas.jpg">
                                </div>
                                <div>
                                    <span class="text-muted font-semibold">Mis citas</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="container_target p-md-0 col-6 col-lg-4 col-md-6 mb-5 mt-5">
                <div class="card cards_panelPrincipal_prof">
                    <a href="{{ route('entidad.pagos') }}">
                        <div class="card-body card_optionPrincipal cardtipo2">
                            <div class="target-panel">
                                <div>
                                    <img src="{{ asset('img/agenda/panelPrincipal/mis-pagos.png') }}" alt="pagos.png">
                                </div>
                                <div>
                                    <span class="text-muted font-semibold">Mis pagos</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="container_target p-md-0 col-6 col-lg-4 col-md-6 mb-5 mt-5">
                <div class="card cards_panelPrincipal_prof">
                    <a href="#">
                        <div class="card-body card_optionPrincipal cardtipo2">
                            <div class="target-panel">
                                <div>
                                    <img src="{{ asset('img/agenda/panelPrincipal/mi-historia-clinica.png') }}" alt="clinica.png">
                                </div>
                                <div>
                                    <span class="text-muted font-semibold">Historia clínica</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="container_target p-md-0 col-6 col-lg-4 col-md-6 mb-5 mt-5">
                <div class="card cards_panelPrincipal_prof">
                    <a href="#">
                        <div class="card-body card_optionPrincipal cardtipo2">
                            <div class="target-panel">
                                <div>
                                    <img src="{{ asset('img/agenda/panelPrincipal/mis-prescripciones.png') }}" alt="prescripciones.png">
                                </div>
                                <div>
                                    <span class="text-muted font-semibold">Mis Formulas</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="container_target p-md-0 col-6 col-lg-4 col-md-6 mb-5 mt-5">
                <div class="card cards_panelPrincipal_prof">
                    <a href="{{ asset('entidad.favoritos') }}">
                        <div class="card-body card_optionPrincipal cardtipo2">
                            <div class="target-panel">
                                <div>
                                    <img src="{{ asset('img/agenda/panelPrincipal/mis-favoritos.png') }}" alt="favoritos.png">
                                </div>
                                <div>
                                    <span class="text-muted font-semibold">Mis favoritos</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

