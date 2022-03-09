@extends('profesionales.admin.layouts.panel')

@section('contenido')
    <div class="container py-4">
        <div class="row m-0 justify-content-between">
            <div class="col-6 p-2 border">
                <a  href="">
                    <div class="content__target">
                        <img src="{{ asset('/img/agenda/panelPrincipal/mi-calendario.png') }}" alt="">

                        <h3 class="subtitle__lg">Mi Agenda</h3>
                    </div>
                </a>
            </div>

            <div class="col-6 p-2">
                <a  href="">
                    <div class="content__target">
                        <img src="{{ asset('/img/agenda/panelPrincipal/mis-citas.jpg') }}" alt="">

                        <h3 class="subtitle__lg">Mis Catálogos</h3>
                    </div>
                </a>
            </div>

            <div class="col-6 p-2">
                <a  href="">
                    <div class="content__target">
                        <img src="{{ asset('/img/agenda/panelPrincipal/mis-pagos.png') }}" alt="">

                        <h3 class="subtitle__lg">Mis Pagos</h3>
                    </div>
                </a>
            </div>

            <div class="col-6 p-2">
                <a  href="">
                    <div class="content__target">
                        <img src="{{ asset('/img/agenda/panelPrincipal/mi-historia-clinica.png') }}" alt="">

                        <h3 class="subtitle__lg">Mis Pacientes</h3>
                    </div>
                </a>
            </div>

            <div class="col-6 p-2">
                <a  href="">
                    <div class="content__target">
                        <img src="{{ asset('/img/agenda/panelPrincipal/mis-examenes.jpg') }}" alt="">

                        <h3 class="subtitle__lg">Mis Contactos</h3>
                    </div>
                </a>
            </div>

            <div class="col-6 p-2">
                <a  href="">
                    <div class="content__target">
                        <img src="{{ asset('/img/agenda/panelPrincipal/mis-favoritos.png') }}" alt="">

                        <h3 class="subtitle__lg">Mis Favoritos</h3>
                    </div>
                </a>
            </div>
        </div>

        <div class="row m-0">
            <div class="col-6 py-3 px-2">
                <a  href="">
                    <div class="d-flex justify-content-center">
                        <img src="{{ asset('/img/agenda/panelPrincipal/plm.png') }}" alt="" width="105px">
                    </div>
                </a>
            </div>

            <div class="col-6 py-3 px-2">
                <a  href="">
                    <div class="d-flex justify-content-center">
                        <img src="{{ asset('/img/agenda/panelPrincipal/mipres-zaabra.png') }}" alt="" width="105px">
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection

