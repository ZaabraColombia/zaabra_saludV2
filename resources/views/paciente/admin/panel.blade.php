@extends('paciente.admin.layouts.layout')

@section('contenido')
    <div class="container py-4 px-lg-5">
        <div class="row m-0 p-0">
            <div class="col-12 p-0 m-0">
                <div class="row m-0">
                    <!-- Mis profesionales -->
                    <div class="col-6 col-md-4 p-2">
                        <a  href="{{ route('paciente.profesionales') }}">
                            <div class="content__target profesional_blue">
                                <span class="subtitle__lg">Profesionales</span>
                            </div>
                        </a>
                    </div>
                    <!-- Actualizar datos -->
                    <div class="col-6 col-md-4 p-2">
                        <a  href="{{ route('paciente.perfil') }}">
                            <div class="content__target paciente_blue">
                                <span class="subtitle__lg">Actualizar Datos</span>
                            </div>
                        </a>
                    </div>
                    <!-- Mis citas -->
                    <div class="col-6 col-md-4 p-2">
                        <a  href="{{ route('paciente.citas') }}">
                            <div class="content__target cita_blue">
                                <span class="subtitle__lg">Citas</span>
                            </div>
                        </a>
                    </div>
                    <!-- Mis pagos -->
                    <div class="col-6 col-md-4 p-2">
                        <a  href="{{ route('paciente.pagos') }}">
                            <div class="content__target pago_blue">
                                <span class="subtitle__lg">Pagos</span>
                            </div>
                        </a>
                    </div>
                    <!-- Mis favoritos -->
                    <div class="col-6 col-md-4 p-2">
                        <a  href="{{ route('paciente.favoritos') }}">
                            <div class="content__target favorito_blue">
                                <span class="subtitle__lg">Favoritos</span>
                            </div>
                        </a>
                    </div>
                    <!-- Mis contactos -->
                    <div class="col-6 col-md-4 col-lg-6 col-xl-4 p-2">
                        <a  href="{{ route('paciente.contactos.index') }}">
                            <div class="content__target contacto_blue">
                                <span class="subtitle__lg">Contactos</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

