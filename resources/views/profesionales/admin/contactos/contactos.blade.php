@extends('profesionales.admin.layouts.panel')

@section('contenido')
    <div class="container-fluid p-0 pr-lg-4">   
        <div class="containt_agendaProf"> 
            <div class="my-4 my-xl-5">       
                <h1 class="title__xl blue_bold">Mis Contactos</h1>
            </div>

            <!-- Contenedor barra de búsqueda y botón agregar contacto -->
            <div class="containt_main_form mb-3">
                <div class="row m-0">
                    <div class="col-md-9 p-0 input__box mb-0">
                        <input class="mb-md-0" type="search" name="search" id="search" placeholder="Buscar Contacto">
                    </div>
                    <div class="col-md-3 p-0 content_btn_right">
                        <button type="submit" class="button_blue" data-toggle="modal" data-target="#modal_agregar_contactos">Agregar</button>
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

    <!-- Modal -->
    <div class="modal fade" id="modal_agregar_contactos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="fs_title_module blue_bold" id="exampleModalLabel">Nuevo Contacto</h1>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form action="" method="post" id="f" class="forms">
                    @csrf
                    <div class="containt_main_form">
                        <div id="alert-horario-agregar"></div>
                        <div class="row">
                            <div class="col-12 input__box">
                                <label for="name">Nombre / Razón social</label>
                                <input type="texto" id="name" name="name">
                            </div>

                            <div class="col-12 input__box">
                                <label for="address">Dirección</label>
                                <input type="text" id="address" name="address">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 input__box">
                                <label for="phone">Teléfono</label>
                                <input type="texto" id="phone" name="phone">
                            </div>

                            <div class="col-12 input__box">
                                <label for="other_phone">Teléfono adicional</label>
                                <input type="text" id="other_phone" name="other_phone">
                            </div>

                            <div class="col-12 input__box">
                                <label for="mail">E-mail</label>
                                <input type="mail" id="mail" name="mail">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer content_btn_right">
                <button type="button" class="button_transparent">Cancelar</button>
                <button type="button" class="button_blue">Confirmar</button>
            </div>
            </div>
        </div>
    </div>
@endsection 