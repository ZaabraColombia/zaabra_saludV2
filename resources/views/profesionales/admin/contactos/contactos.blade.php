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
                <h1 class="title__xl blue_bold">Contactos</h1>
            </div>

            <!-- Contenedor barra de búsqueda y botón agregar contacto -->
            <div class="containt_main_table mb-3">
                <div class="row m-0">
                    <div class="col-md-9 p-0 input__box mb-0">
                        <input class="mb-md-0" type="search" name="search" id="search" placeholder="Buscar contacto" />
                    </div>

                    @can('accesos-profesional',['agregar-contacto'])
                        <div class="col-md-3 p-0 content_btn_right">
                            <button type="button" class="button_blue" id="btn-agregar-contacto">
                                Agregar
                            </button>
                        </div>
                    @endcan
                </div>
            </div>

            <!-- Contenedor formato tabla de la lista de contactos -->
            <div class="containt_main_table mb-3">
                <div class="row" id="alertas"></div>
                <div class="table-responsive">
                    <table class="table table_agenda" id="table-contactos">
                        <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Dirección</th>
                            <th>Teléfono</th>
                            <th>Correo</th>
                            <th>Acción</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($contactos->isNotEmpty())
                            @foreach($contactos as $contacto)
                                <tr>
                                    <td class="pr-0">
                                        <div class="user__xl">
                                            <div class="pr-2">
                                                <img class="img__contacs" src='{{ asset($contacto->foto ?? 'img/menu/avatar.png') }}'>
                                            </div>

                                            <div>
                                                <span>{{ $contacto->nombre }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $contacto->direccion }}</td>
                                    <td>{{ "{$contacto->telefono} - {$contacto->telefono_adicional}" }}</td>
                                    <td>{{ $contacto->correo }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            @can('accesos-profesional',['ver-contactos'])
                                                <button class="btn_action btn-ver-contacto tool top" type="button" data-id="{{ $contacto->id }}">
                                                    <i class="fas fa-eye"></i> <span class="tiptext">Ver contacto</span>
                                                </button>
                                            @endcan
                                            @can('accesos-profesional',['editar-contacto'])
                                                <button class="btn_action btn-editar-contacto tool top" type="button" data-id="{{ $contacto->id }}">
                                                    <i class="fas fa-edit"></i> <span class="tiptext">Editar contacto</span>
                                                </button>
                                            @endcan

                                            @can('accesos-profesional',['eliminar-contacto'])
                                                <button class="btn_action btn-eliminar-contacto tool top" type="button" data-id="{{ $contacto->id }}">
                                                    <i class="fas fa-trash"></i> <span class="tiptext">Eliminar contacto</span>
                                                </button>
                                            @endcan
                                        </div>
                                    </td>

                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @can('accesos-profesional',['agregar-contacto', 'editar-contacto'])
        <!-- Modal Editar y Crear -->
        <div class="modal fade modal_contactos" id="modal_contactos" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content modal_container">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form method="post" id="form-contacto" class="forms">
                        <div class="modal-body">
                            <h1><span id="titulo">Nuevo</span> Contacto</h1>
                            @method('post')
                            <div class="form_modal">
                                <div class="row m-0">
                                    <div class="col-12" id="alertas-modal"></div>

                                    <div class="col-12 p-lg-0">
                                        <div class="row align-items-lg-end mx-lg-0 mb-lg-3">
                                            <div class="col-12 col-lg-4 mb-3 mb-lg-0">
                                                <div class="img__upload">
                                                    <img id="imagen-foto" src="">
                                                    <input type="file" name="foto"  id="foto" accept="image/png, image/jpeg" value="">
                                                    <p>Subir foto de perfil</p>
                                                </div>
                                            </div>

                                            <div class="col-12 col-lg-8 p-0">
                                                <div class="col-12 p-0">
                                                    <label for="nombre">Nombre / Razón social (*)</label>
                                                    <input type="text" id="nombre" name="nombre" class="campo" required/>
                                                </div>

                                                <div class="col-12 p-0">
                                                    <label for="numero_identificacion">Cédula / NIT </label>
                                                    <input type="text" id="numero_identificacion" name="numero_identificacion" class="campo"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-12 col-lg-6 p-0 pr-lg-2">
                                        <label for="ciudad">Ciudad</label>
                                        <input type="text" id="ciudad" name="ciudad" class="campo"/>
                                    </div>

                                    <div class="col-12 col-lg-6 p-0 pl-lg-2">
                                        <label for="direccion">Dirección</label>
                                        <input type="text" id="direccion" name="direccion" class="campo"/>
                                    </div>

                                    <div class="col-12 col-lg-6 p-0 pr-lg-2">
                                        <label for="telefono">Teléfono (*)</label>
                                        <input type="text" id="telefono" name="telefono" class="campo" required/>
                                    </div>

                                    <div class="col-12 col-lg-6 p-0 pl-lg-2">
                                        <label for="telefono_adicional">Teléfono adicional</label>
                                        <input type="text" id="telefono_adicional" name="telefono_adicional" class="campo"/>
                                    </div>

                                    <div class="col-12 col-lg-6 p-0 pr-lg-2">
                                        <label for="correo">Correo</label>
                                        <input type="email" id="correo" name="correo" class="campo"/>
                                    </div>

                                    <div class="col-12 col-lg-6 p-0 pl-lg-2">
                                        <label for="tipo">Tipo Contacto</label>
                                        <select type="email" id="tipo" name="tipo" class="campo">
                                            <option></option>
                                            <option value="proveedor">Proveedor</option>
                                            <option value="paciente">Paciente</option>
                                            <option value="otro">Otro</option>
                                        </select>
                                    </div>

                                    <div class="col-12 col-lg-6 p-0 pr-lg-2">
                                        <label for="tipo_cuenta">Tipo de cuenta bancaria</label>
                                        <select type="email" id="tipo_cuenta" name="tipo_cuenta" class="campo">
                                            <option></option>
                                            <option value="ahorro">Ahorro</option>
                                            <option value="corriente">Corriente</option>
                                        </select>
                                    </div>

                                    <div class="col-12 col-lg-6 p-0 pl-lg-2">
                                        <label for="numero_cuenta">Número de cuenta bancaria</label>
                                        <input type="text" id="numero_cuenta" name="numero_cuenta" class="campo"/>
                                    </div>

                                    <div class="col-12 p-0">
                                        <label for="observacion">Observación</label>
                                        <textarea name="observacion" id="observacion" class="form-control campo"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer content_btn_center">
                            <button type="button" class="button_transparent" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="button_blue">Confirmar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endcan
    @can('accesos-profesional',['eliminar-contacto'])
        <!-- Modal Eliminar -->
        <div class="modal fade modal_contactos" id="modal_contactos_eliminar" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content modal_container">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!-- Mantener las cases "label-*" -->
                    <div class="modal-body">
                        <h1 class="pl-5">Eliminar Contacto</h1>

                        <div class="content__see_contacs">
                            <img id="foto-eliminar" class="img__see_contacs" src='{{ asset($contacto->foto ?? 'img/menu/avatar.png') }}'>
                        </div>

                        <div class="content__border_see_contacs"></div>

                        <div class="modal_info_cita pt-5">
                            <div class="info_contac">
                                <span>Nombre:</span>
                                <span class="label-nombre"></span>
                            </div>

                            <div class="info_contac">
                                <span>Número identificación:&nbsp;</span>
                                <span class="label-numero_identificacion"></span>
                            </div>

                            <div class="info_contac">
                                <span>Correo:&nbsp;</span>
                                <span class="label-correo"></span>
                            </div>

                            <div class="info_contac">
                                <span>Teléfonos:&nbsp;</span>
                                <span class="label-telefono"></span> -
                                <span class="label-telefono_adicional"></span>
                            </div>

                            <div class="info_contac">
                                <span>Ciudad:&nbsp;</span>
                                <span class="label-ciudad"></span>
                            </div>

                            <div class="info_contac">
                                <span>Dirección:&nbsp;</span>
                                <span class="label-direccion"></span>
                            </div>

                            <div class="info_contac">
                                <span>Tipo contacto:&nbsp;</span>
                                <span class="label-tipo"></span>
                            </div>

                            <div class="info_contac">
                                <span>Tipo cuenta bancaria:&nbsp;</span>
                                <span class="label-tipo_cuenta"></span>
                            </div>

                            <div class="info_contac">
                                <span>Número cuenta bancaria:&nbsp;</span>
                                <span class="label-numero_cuenta"></span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer content_btn_center">
                        <form method="post" id="form-contacto-eliminar" class="forms">
                            @csrf
                            @method('delete')
                            <button type="button" class="button_transparent ml-2" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="button_blue ml-2">Eliminar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endcan

    @can('accesos-profesional',['ver-contactos'])
        <!-- Modal Ver -->
        <div class="modal fade modal_contactos" id="modal_contactos_ver" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content modal_container">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!-- Mantener las cases "label-*" -->
                    <div class="modal-body">
                        <h1>Ver Contacto</h1>

                        <div class="content__see_contacs">
                            <img id="foto-ver" class="img__see_contacs" src='{{ asset($contacto->foto ?? 'img/menu/avatar.png') }}'>
                        </div>

                        <div class="content__border_see_contacs"></div>

                        <div class="modal_info_cita pt-5">
                            <div class="info_contac">
                                <span>Nombre:</span>
                                <span class="label-nombre"></span>
                            </div>

                            <div class="info_contac">
                                <span>Número identificación:&nbsp;</span>
                                <span class="label-numero_identificacion"></span>
                            </div>

                            <div class="info_contac">
                                <span>Correo:&nbsp;</span>
                                <span class="label-correo"></span>
                            </div>

                            <div class="info_contac">
                                <span>Teléfonos:&nbsp;</span>
                                <span class="label-telefono"></span> -
                                <span class="label-telefono_adicional"></span>
                            </div>

                            <div class="info_contac">
                                <span>Ciudad:&nbsp;</span>
                                <span class="label-ciudad"></span>
                            </div>

                            <div class="info_contac">
                                <span>Dirección:&nbsp;</span>
                                <span class="label-direccion"></span>
                            </div>

                            <div class="info_contac">
                                <span>Tipo contacto:&nbsp;</span>
                                <span class="label-tipo"></span>
                            </div>

                            <div class="info_contac">
                                <span>Tipo cuenta bancaria:&nbsp;</span>
                                <span class="label-tipo_cuenta"></span>
                            </div>

                            <div class="info_contac">
                                <span>Número cuenta bancaria:&nbsp;</span>
                                <span class="label-numero_cuenta"></span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer content_btn_center">
                        <button type="button" class="button_transparent" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    @endcan
@endsection
@section('scripts')
    <script src="{{ asset('plugins/DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('js/alertas.js') }}"></script>

    <script>
        // Obtener referencia al input y a la imagen
        const $seleccionArchivos = document.querySelector("#foto"),
            $imagenPrevisualizacion = document.querySelector("#imagen-foto");

        // Escuchar cuando cambie
        $seleccionArchivos.addEventListener("change", () => {
            // Los archivos seleccionados, pueden ser muchos o uno
            const archivos = $seleccionArchivos.files;
            // Si no hay archivos salimos de la función y quitamos la imagen
            if (!archivos || !archivos.length) {
                $imagenPrevisualizacion.src = "";
                return;
            }
            // Ahora tomamos el primer archivo, el cual vamos a previsualizar
            const primerArchivo = archivos[0];
            // Lo convertimos a un objeto de tipo objectURL Y a la fuente de la imagen le ponemos el objectURL
            $imagenPrevisualizacion.src = URL.createObjectURL(primerArchivo);
        });
    </script>

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
            columnDefs: [
                {
                    targets: [-1],
                    orderable: false,
                }
            ],
            dom: 'lfBrtip',
            buttons: [
                {
                    extend: 'pdfHtml5',
                    text: 'PDF',
                    className: 'red',
                    title:'Resultados',
                    exportOptions: {
                        columns: ":not(:last-child)",
                    },
                    //text: 'Red',
                },
                {
                    extend: 'excel',
                    text: 'Excel',
                    className: 'border_left',
                    title: 'Resultados',
                    exportOptions: {
                        columns: ":not(:last-child)",
                    },
                },
            ],
        });

        $("#search").on('keyup change',function(){
            var texto = $(this).val();
            table.search(texto).draw();
        });

        @can('accesos-profesional',['agregar-contacto'])
        //Abrir modal para crear contacto
        $('#btn-agregar-contacto').click(function (e) {
            var form = $('#form-contacto');
            form.attr('action', '{{ route('profesional.contactos.store') }}');
            //form.attr('method', 'post');
            $('input[name=_method]').val('post');
            form[0].reset();
            $('#modal_contactos').modal();
            $('#titulo').html('Nuevo');
        });
        @endcan
        //Id del row a tratar
        var row;
        //Abrir modal para editar, eliminar y ver
        $('#table-contactos tbody').on('click', '.btn-editar-contacto', function (e) {
            @can('accesos-profesional',['editar-contacto'])
            var form = $('#form-contacto');
            var ruta_guardar = '{{ route('profesional.contactos.update', ['contacto' => ':id']) }}';
            var ruta_ver     = '{{ route('profesional.contactos.show', ['contacto' => ':id']) }}';
            var btn = $(this);

            form[0].reset();
            form.attr('action', ruta_guardar.replace(':id', btn.data('id')));
            //form.attr('method', 'put');
            $('input[name=_method]').val('put');
            $('#titulo').html('Editar');

            //llamar someId de la tabla
            row = table.row( btn.parents('tr') );

            $.ajax({
                url: ruta_ver.replace(':id', btn.data('id')),
                data: form.serialize(),
                type: 'get',
                dataType: 'json',
                success: function (response) {

                    //Lleno la base de datos
                    var item = response.item;

                    $.each(item, function (key, item) {
                        if (key !== 'foto') $('#' + key).val(item);
                    });

                    $('#imagen-foto').attr('src', item.foto);

                },
                error: function (error) {
                    //mensaje
                    $('#alertas').html(alert(error.responseJSON.message, 'danger'));
                }
            });

            $('#modal_contactos').modal();
            @endcan
        }).on('click', '.btn-eliminar-contacto', function (e) {
            @can('accesos-profesional',['eliminar-contacto'])
            var form            = $('#form-contacto-eliminar');
            var ruta_eliminar   = '{{ route('profesional.contactos.update', ['contacto' => ':id']) }}';
            var ruta_ver        = '{{ route('profesional.contactos.show', ['contacto' => ':id']) }}';
            var btn = $(this);
            var modal = $('#modal_contactos_eliminar');

            form[0].reset();
            form.attr('action', ruta_eliminar.replace(':id', btn.data('id')));
            form.attr('method', 'delete');

            //llamar someId de la tabla
            row = table.row( btn.parents('tr') );

            $.ajax({
                url: ruta_ver.replace(':id', btn.data('id')),
                data: form.serialize(),
                type: 'get',
                dataType: 'json',
                success: function (response) {

                    //Lleno la base de datos
                    var item = response.item;

                    $.each(item, function (key, item) {
                        modal.find('.label-' + key).html(item);
                        console.log(key);
                    });

                    $('#foto-eliminar').attr('src', item.foto);

                    modal.modal();
                },
                error: function (error) {
                    //mensaje
                    $('#alertas').html(alert(error.responseJSON.message, 'danger'));
                }
            });
            @endcan
        }).on('click', '.btn-ver-contacto', function (e) {
            @can('accesos-profesional',['ver-contactos'])
            var form            = $('#form-contacto-eliminar');
            var ruta_eliminar   = '{{ route('profesional.contactos.update', ['contacto' => ':id']) }}';
            var ruta_ver        = '{{ route('profesional.contactos.show', ['contacto' => ':id']) }}';
            var btn = $(this);
            var modal = $('#modal_contactos_ver');
            @can('accesos-profesional',['eliminar-contacto'])
            //Eliminar contacto

            form[0].reset();
            form.attr('action', ruta_eliminar.replace(':id', btn.data('id')));
            form.attr('method', 'delete');
            @endcan

            //llamar someId de la tabla
            row = table.row( btn.parents('tr') );

            $.ajax({
                url: ruta_ver.replace(':id', btn.data('id')),
                data: form.serialize(),
                type: 'get',
                dataType: 'json',
                success: function (response) {

                    //Lleno la base de datos
                    var item = response.item;

                    $.each(item, function (key, item) {
                        modal.find('.label-' + key).html(item);
                    });
                    $('#foto-ver').attr('src', item.foto);

                    modal.modal();
                },
                error: function (error) {
                    //mensaje
                    $('#alertas').html(alert(error.responseJSON.message, 'danger'));
                }
            });
            @endcan
        });


        //Capturar el envío del formulario
        $('#form-contacto, #form-contacto-eliminar').submit(function (e) {
            e.preventDefault();
            var form = $(this);
            var modal = $('.modal_contactos');

            var data = new FormData(form[0]);

            $.ajax({
                url: form.attr('action'),
                //data: form.serialize(),
                enctype: 'multipart/form-data',
                contentType: false,
                processData: false,
                cache: false,
                //type: method,
                type: 'post',
                dataType: 'json',
                data: data,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    //mensaje
                    $('#alertas').html(alert(response.message, 'success'));

                    //Validar si se actualizo o se creo
                    switch (response.type) {
                        case 'created':
                            table.row.add([
                                img(response.item.foto, response.item.nombre),
                                response.item.direccion,
                                response.item.telefono,
                                response.item.correo,
                                    '<div class="d-flex justify-content-center">' +
                                    @can('accesos-profesional',['ver-contactos'])'<button class="btn_action btn-ver-contacto tool top" type="button" data-id="' + response.item.id + '" id=contacto-"' + response.item.id + '"> <i class="fas fa-eye"></i> <span class="tiptext">Ver contacto</span> </button>' + @endcan
                                    @can('accesos-profesional',['editar-contacto'])'<button class="btn_action btn-editar-contacto tool top" type="button" data-id="' + response.item.id + '" id=contacto-"' + response.item.id + '"> <i class="fas fa-edit"></i> <span class="tiptext">Editar contacto</span> </button>' + @endcan
                                    @can('accesos-profesional',['eliminar-contacto'])'<button class="btn_action btn-eliminar-contacto tool top" type="button" data-id="' + response.item.id + '" id=contacto-"' + response.item.id + '"> <i class="fas fa-trash"></i> <span class="tiptext">Eliminar contacto</span> </button>' + @endcan
                                    '</div>',
                            ]).draw().node();
                            modal.modal('hide');
                            break;
                        case 'updated':
                            row.data([
                                img(response.item.foto, response.item.nombre),
                                response.item.direccion,
                                response.item.telefono,
                                response.item.correo,
                                    '<div class="d-flex justify-content-center">' +
                                    @can('accesos-profesional',['ver-contactos'])'<button class="btn_action btn-ver-contacto tool top" type="button" data-id="' + response.item.id + '" id=contacto-"' + response.item.id + '"> <i class="fas fa-eye"></i> <span class="tiptext">Ver contacto</span> </button>' + @endcan
                                    @can('accesos-profesional',['editar-contacto'])'<button class="btn_action btn-editar-contacto tool top" type="button" data-id="' + response.item.id + '" id=contacto-"' + response.item.id + '"> <i class="fas fa-edit"></i> <span class="tiptext">Editar contacto</span> </button>' + @endcan
                                    @can('accesos-profesional',['eliminar-contacto'])'<button class="btn_action btn-eliminar-contacto tool top" type="button" data-id="' + response.item.id + '" id=contacto-"' + response.item.id + '"> <i class="fas fa-trash"></i> <span class="tiptext">Eliminar contacto</span> </button>' + @endcan
                                    '</div>',
                            ]).draw();
                            modal.modal('hide');
                            break;
                        case 'deleted':
                            row.remove().draw();
                            modal.modal('hide');
                            break;
                    }
                    row = undefined;
                },
                error: function (error) {
                    //mensaje
                    $('#alertas-modal').html(alert(error.responseJSON.message, 'danger'));
                }
            });
        });



        function img(img, nombre) {
            return '<div class="user__xl">'
                + '<div class="pr-2">'
                + '<img class="img__contacs" src="' + img + '">'
                + '</div>'
                + '<div>'
                + '<span>' + nombre + '</span>'
                + '</div>'
                +'</div>';
        }


    </script>
@endsection
