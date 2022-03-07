@extends('profesionales.admin.layouts.panel')

@section('contenido')
    <div class="container-fluid">   
        <div class="containt_right"> 
            <div class="my-4">       
                <h1 class="fs_title blue_bold">Mis Pacientes</h1>
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
            <div class="containt_main_form">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Dirección</th>
                                <th>Teléfono</th>
                                <th>E-mail</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Henrry Alexander Contreras Valbuena</td>
                                <td>Carrera 34 # 45 - 09</td>
                                <td>310 324 5687</td>
                                <td>henrrycon@gmail.com</td>
                            </tr>
                            <tr>
                                <td>Henrry Alexander Contreras Valbuena</td>
                                <td>Carrera 34 # 45 - 09</td>
                                <td>310 324 5687</td>
                                <td>henrrycon@gmail.com</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection