@extends('profesionales.admin.layouts.panel')

@section('styles')
    <link rel="stylesheet" href="{{ asset('plugins/DataTables/datatables.min.css') }}">
    <style>
        .dataTables_filter, .dataTables_info { display: none;!important; }
    </style>
@endsection

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
                        <input class="mb-md-0" type="search" name="search" id="search" placeholder="Buscar Contacto" />
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
                <div class="row" id="alertas"></div>
                <div class="table-responsive">
                    <table class="table" id="table-contactos">
                        <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Dirección</th>
                            <th>Teléfono</th>
                            <th>Correo</th>
                            <th></th>
                            <th></th>
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
                                    <td>
                                        <button class="btn_action btn-editar-contacto" type="button" data-id="{{ $contacto->id }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </td>
                                    <td>
                                        <button class="btn_action btn-eliminar-contacto" type="button" data-id="{{ $contacto->id }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @endif

                        {{--                        <tr>--}}
                        {{--                            <td>Henrry Alexander Contreras Valbuena</td>--}}
                        {{--                            <td>Carrera 34 # 45 - 09</td>--}}
                        {{--                            <td>310 324 5687</td>--}}
                        {{--                            <td>henrrycon@gmail.com</td>--}}
                        {{--                            <td>--}}
                        {{--                                <button class="btn_action" type="button" data-id=""> <i class="fas fa-edit"></i> </button>--}}
                        {{--                            </td>--}}
                        {{--                            <td>--}}
                        {{--                                <button class="btn_action" type="button" data-id=""> <i class="fas fa-trash"></i> </button>--}}
                        {{--                            </td>--}}
                        {{--                        </tr>--}}
                        {{--                        <tr>--}}
                        {{--                            <td>Henrry Alexander Contreras Valbuena</td>--}}
                        {{--                            <td>Carrera 34 # 45 - 09</td>--}}
                        {{--                            <td>310 324 5687</td>--}}
                        {{--                            <td>henrrycon@gmail.com</td>--}}
                        {{--                            <td>--}}
                        {{--                                <button class="btn_action" type="button" data-id=""> <i class="fas fa-edit"></i> </button>--}}
                        {{--                            </td>--}}
                        {{--                            <td>--}}
                        {{--                                <button class="btn_action" type="button" data-id=""> <i class="fas fa-trash"></i> </button>--}}
                        {{--                            </td>--}}
                        {{--                        </tr>--}}
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
                <form method="post" id="form-contacto" class="forms">
                    <div class="modal-body">
                        @csrf
                        <div class="containt_main_form">
                            <div class="row">
                                <div class="col-12" id="alertas-modal"></div>
                                <div class="col-12 input__box">
                                    <label for="nombre">Nombre / Razón social (*)</label>
                                    <input type="text" id="nombre" name="nombre" class="campo" required/>
                                </div>

                                <div class="col-12 input__box">
                                    <label for="numero_identificacion">Cédula / NIT </label>
                                    <input type="text" id="numero_identificacion" name="numero_identificacion" class="campo"/>
                                </div>

                                <div class="col-12 input__box">
                                    <label for="ciudad">Ciudad</label>
                                    <input type="text" id="ciudad" name="ciudad" class="campo"/>
                                </div>

                                <div class="col-12 input__box">
                                    <label for="direccion">Dirección</label>
                                    <input type="text" id="direccion" name="direccion" class="campo"/>
                                </div>

                                <div class="col-12 input__box">
                                    <label for="telefono">Teléfono (*)</label>
                                    <input type="text" id="telefono" name="telefono" class="campo" required/>
                                </div>

                                <div class="col-12 input__box">
                                    <label for="telefono_adicional">Teléfono adicional</label>
                                    <input type="text" id="telefono_adicional" name="telefono_adicional" class="campo"/>
                                </div>

                                <div class="col-12 input__box">
                                    <label for="correo">Correo</label>
                                    <input type="email" id="correo" name="correo" class="campo"/>
                                </div>

                                <div class="col-12 input__box">
                                    <label for="tipo">Tipo Contacto</label>
                                    <select type="email" id="tipo" name="tipo" class="form-control campo">
                                        <option></option>
                                        <option value="proveedor">Proveedor</option>
                                        <option value="paciente">Paciente</option>
                                        <option value="otro">Otro</option>
                                    </select>
                                </div>

                                <div class="col-12 input__box">
                                    <label for="tipo_cuenta">Tipo de cuenta bancaria</label>
                                    <select type="email" id="tipo_cuenta" name="tipo_cuenta" class="form-control campo">
                                        <option></option>
                                        <option value="ahorro">Ahorro</option>
                                        <option value="corriente">Corriente</option>
                                    </select>
                                </div>

                                <div class="col-12 input__box">
                                    <label for="numero_cuenta">Número de cuenta bancaria</label>
                                    <input type="text" id="numero_cuenta" name="numero_cuenta" class="campo"/>
                                </div>

                                <div class="col-12 input__box">
                                    <label for="observacion">Observación</label>
                                    <textarea name="observacion" id="observacion" class="form-control campo"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer content_btn_right">
                        <button type="button" class="button_transparent" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="button_blue">Confirmar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('plugins/DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('js/alertas.js') }}"></script>

    <script>
        //Inicializar tabla
        var table = $('#table-contactos').DataTable({
            bFilter: false,
            bInfo: false,
            response: true,
            language: {
                url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
            },
            searching: true,
        });

        $("#search").on('keyup change',function(){
            var texto = $(this).val();
            table.search(texto).draw();
        });

        //Abrir modal para crear contacto
        $('#btn-agregar-contacto').click(function (e) {
            var form = $('#form-contacto');
            form.attr('action', '{{ route('profesional.contactos.store') }}');
            form[0].reset();
            $('#modal_contactos').modal();
        });

        //Abrir modal para editar
        $('#table-contactos tbody').on('.btn-editar-contacto', 'click', function (e) {
            var form = $('#form-contacto');
            var ruta_guardar = '{{ route('profesional.contactos.update', ['contacto' => ':id']) }}';
            var ruta_ver     = '{{ route('profesional.contactos.show', ['contacto' => ':id']) }}';
            var btn = $(this);

            form[0].reset();
            form.attr('action', ruta_guardar.replace(':id', btn.data('id')));

            $.ajax({
                url: ruta_ver.replace(':id', btn.data('id')),
                data: form.serialize(),
                type: 'get',
                dataType: 'json',
                success: function (response) {

                    //Lleno la base de datos
                    var item = response.item;

                    $.each(item, function (key, item) {
                        $('#' + key).val(item);
                    });
                },
                error: function (error) {
                    //mensaje
                    $('#alertas').html(alert(error.responseJSON.message, 'danger'));
                }
            });

            $('#modal_contactos').modal();
        });

        //Capturar el envío del formulario
        $('#form-contacto').submit(function (e) {
            e.preventDefault();
            var form = $(this);
            var modal = $('#modal_contactos');

            $.ajax({
                url: form.attr('action'),
                data: form.serialize(),
                type: 'post',
                dataType: 'json',
                success: function (response) {
                    //mensaje
                    $('#alertas').html(alert(response.message, 'success'));

                    //Validar si se actualizo o se creo
                    switch (response.type) {
                        case 'created':
                            table.row.add([
                                response.item.nombre,
                                response.item.direccion,
                                response.item.telefono,
                                response.item.correo,
                                '<button class="btn_action" type="button" data-id="' + response.item.id + '"> <i class="fas fa-edit"></i> </button>',
                                '<button class="btn_action" type="button" data-id="' + response.item.id + '"> <i class="fas fa-trash"></i> </button>',
                            ]).draw().node();
                            modal.modal('hide');
                            break;
                    }
                },
                error: function (error) {
                    //mensaje
                    $('#alertas-modal').html(alert(error.responseJSON.message, 'danger'));
                }
            });
        });
    </script>
@endsection
