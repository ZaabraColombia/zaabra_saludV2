@extends('profesionales.admin.layouts.panel')

@section('contenido')
    <div class="container-fluid p-0 pr-lg-4">
        <div class="containt_agendaProf">
            <div class="my-4 my-xl-5">
                <h1 class="title__xl blue_bold">Mis Pacientes</h1>
            </div>

            <!-- Contenedor barra de búsqueda y botón agregar contacto -->
            <div class="containt_main_form mb-3">
                <div class="row m-0">
                    <div class="col-md-9 p-0 input__box mb-0">
                        <input class="mb-md-0" type="search" name="search" id="search" placeholder="Buscar Paciente">
                    </div>
                </div>
            </div>

            <!-- Contenedor formato tabla de la lista de contactos -->
            <div class="containt_main_form mb-3">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Numero identificación</th>
                                <th>Dirección</th>
                                <th>Teléfono</th>
                                <th>E-mail</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if($pacientes->isNotEmpty())
                            @foreach($pacientes as $paciente)
                                <tr>
                                    <td>{{ $paciente->user->nombre_completo }}</td>
                                    <td>{{ $paciente->user->numerodocumento }}</td>
                                    <td>{{ $paciente->direccion }}</td>
                                    <td>{{ "{$paciente->celular} - {$paciente->telefono}" }}</td>
                                    <td>{{ $paciente->user->email }}</td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
