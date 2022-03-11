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
                        <button type="button" class="button_blue" id="btn-agregar-contacto">
                            Agregar
                        </button>
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
                        @if($contactos->isNotEmpty())
                            @foreach($contactos as $contacto)
                                <tr>
                                    <td>{{ $contacto->nombre }}</td>
                                    <td>{{ $contacto->direccion }}</td>
                                    <td>{{ "{$contacto->telefono} - {$contacto->telefono_adicional}" }}</td>
                                    <td>{{ $contacto->correo }}</td>
                                </tr>
                            @endforeach
                        @endif
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
    <div class="modal fade" id="modal_contactos">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="fs_title_module blue_bold" id="exampleModalLabel">Nuevo Contacto</h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" id="form-contacto" class="forms">
                        <input type="hidden">
                        @csrf
                        <div class="containt_main_form">
                            <div id="alert-horario-agregar"></div>
                            <div class="row">
                                <div class="col-12 input__box">
                                    <label for="nombre">Nombre / Razón social (*)</label>
                                    <input type="text" id="nombre" name="nombre" />
                                </div>

                                <div class="col-12 input__box">
                                    <label for="ciudad">Ciudad</label>
                                    <input type="text" id="ciudad" name="ciudad" />
                                </div>

                                <div class="col-12 input__box">
                                    <label for="direccion">Dirección</label>
                                    <input type="text" id="direccion" name="direccion" />
                                </div>

                                <div class="col-12 input__box">
                                    <label for="telefono">Teléfono (*)</label>
                                    <input type="text" id="telefono" name="telefono" />
                                </div>

                                <div class="col-12 input__box">
                                    <label for="telefono_adicional">Teléfono adicional</label>
                                    <input type="text" id="telefono_adicional" name="telefono_adicional" />
                                </div>

                                <div class="col-12 input__box">
                                    <label for="correo">Correo</label>
                                    <input type="email" id="correo" name="correo" />
                                </div>

                                <div class="col-12 input__box">
                                    <label for="tipo">Tipo Contacto</label>
                                    <select type="email" id="tipo" name="tipo" class="form-control">
                                        <option></option>
                                        <option value="proveedor">Proveedor</option>
                                        <option value="paciente">Paciente</option>
                                        <option value="otro">Otro</option>
                                    </select>
                                </div>

                                <div class="col-12 input__box">
                                    <label for="tipo_cuenta">Tipo de cuenta bancaria</label>
                                    <select type="email" id="tipo_cuenta" name="tipo_cuenta" class="form-control">
                                        <option></option>
                                        <option value="ahorro">Ahorro</option>
                                        <option value="corriente">Corriente</option>
                                    </select>
                                </div>

                                <div class="col-12 input__box">
                                    <label for="numero_cuenta">Número de cuenta bancaria</label>
                                    <input type="text" id="numero_cuenta" name="numero_cuenta" />
                                </div>

                                <div class="col-12 input__box">
                                    <label for="observacion">Observación</label>
                                    <textarea name="observacion" id="observacion" class="form-control"></textarea>
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
@section('scripts')
    <script>
        $('#btn-agregar-contacto').click(function (e) {

            $('#modal_contactos').modal();
        });
    </script>
@endsection
