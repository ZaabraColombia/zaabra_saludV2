@extends('paciente.admin.layouts.layout')

@section('contenido')
    <div class="container py-4 px-lg-5">
        <div class="row m-0 p-0">
            <div class="col-12 p-0 m-0">
                <div class="row m-0">
                    <!-- Mis citas -->
                    <div class="col-6 col-md-4 p-2">
                        <a  href="{{ route('paciente.citas') }}">
                            <div class="content__target">
                                <img src="{{ asset('/img/agenda/panelPrincipal/mi-calendario.png') }}" alt="">

                                <h3 class="subtitle__lg">Mis Citas</h3>
                            </div>
                        </a>
                    </div>
                    <!-- Mis pagos -->
                    <div class="col-6 col-md-4 p-2">
                        <a  href="">
                            <div class="content__target">
                                <img src="{{ asset('/img/agenda/panelPrincipal/mis-pagos.png') }}" alt="">

                                <h3 class="subtitle__lg">Mis Pagos</h3>
                            </div>
                        </a>
                    </div>
                    <!-- Actualizar datos -->
                    <div class="col-6 col-md-4 p-2">
                        <a  href="{{ route('paciente.perfil') }}">
                            <div class="content__target">
                                <img src="{{ asset('/img/agenda/panelPrincipal/mi-historia-clinica.png') }}" alt="">

                                <h3 class="subtitle__lg">Actualizar Datos</h3>
                            </div>
                        </a>
                    </div>
                    <!-- Mis profesionales -->
                    <div class="col-6 col-md-4 p-2">
                        <a  href="#">
                            <div class="content__target">
                                <img src="{{ asset('/img/agenda/panelPrincipal/mis-examenes.jpg') }}" alt="">

                                <h3 class="subtitle__lg">Mis Profesionales</h3>
                            </div>
                        </a>
                    </div>
                    <!-- Mis favoritos -->
                    <div class="col-6 col-md-4 p-2">
                        <a  href="{{ route('paciente.favoritos') }}">
                            <div class="content__target">
                                <img src="{{ asset('/img/agenda/panelPrincipal/mis-favoritos.png') }}" alt="">

                                <h3 class="subtitle__lg">Mis Favoritos</h3>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

