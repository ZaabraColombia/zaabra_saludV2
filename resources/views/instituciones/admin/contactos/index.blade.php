@extends('instituciones.admin.layouts.layout')

@section('styles')
    <link rel="stylesheet" href="{{ asset('plugins/DataTables/datatables.min.css') }}">
    <style>
        .dataTables_filter, .dataTables_info { display: none;!important; }
    </style>
@endsection

@section('contenido')
    <div class="container-fluid panel_container">
        <div class="panel_head">
            <!-- Main title -->
            <div class="card_main_title">
                <h1 class="txt_title_panel_head color_green">Contactos</h1>
            </div>
            <!-- Toolbar -->
            <div class="row m-0">
                <!-- Add contact -->
                <div class="col-md-12 col-lg-auto mr-lg-3 button__add_card">
                    <a href="" class="button__green_card" id="">Agregar contacto</a>
                </div>
                <!-- Search bar -->
                <div class="col-md-6 col-lg-5 col-xl-5 mr-lg-auto button__search_card">
                    <form method="get">
                        <button id="search" type="button" class="icon__search_green {{ (request('search')) ? 'search_togggle':'' }}">
                            <input class="mb-0" type="search" name="search" id="search" placeholder="Buscar" value="{{ request('search') }}">
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="panel_body">
            <div class="row m-0 mt-3 mt-md-4 mt-lg-3">
                <!-- alert notice -->
                <div class="col-12" id="alertas">
                    @if(session()->has('success'))
                        <div class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="alert-heading">Hecho!</h4>
                            <p>{{ session('success') }}</p>
                        </div>
                    @endif
                </div>
                <!-- Professional card -->
                @if($contactos->isNotEmpty())
                    @foreach($contactos as $contacto)
                        <div class="col-md-6 col-lg-4 spaceCard_between card__col">
                            <div class="card card__">
                                <div class="row card__row_column">
                                    <!-- Informative buttons desktop-->
                                    <div class="col-12 mb-md-1 mb-xl-2 d-none d-lg-flex button__info_card">
                                        @can('accesos-institucion','ver-contactos')
                                            <button class="btn_icon_card btn-ver-contacto tool top" data-id="{{ $contacto->id }}">
                                                <i data-feather="eye" class="icon_btn_card_desk"></i> 
                                                <span class="tiptext">Ver contacto</span>
                                            </button>
                                        @endcan
                                        @can('accesos-institucion','editar-contacto')
                                            <button class="btn_icon_card btn-editar-contacto tool top" data-id="{{ $contacto->id }}">
                                                <i data-feather="edit" class="icon_btn_card_desk"></i>
                                                <span class="tiptext">Editar contacto</span>
                                        </button>
                                        @endcan
                                        @can('accesos-institucion','eliminar-contacto')
                                        <button class="btn_icon_card btn-eliminar-contacto tool top" data-id="{{ $contacto->id }}">
                                            <i data-feather="trash-2" class="icon_btn_card_mobile" style="color: #FF3E3E"></i> 
                                            <span class="tiptext">Eliminar contacto</span>
                                        </button>
                                        @endcan
                                    </div>
                                    <!-- Image contact -->
                                    <div class="col-lg-3 p-0 mb-3 d-flex justify-content-center align-self-md-start">
                                        <img class="img_card_module" src='{{ asset($contacto->foto ?? 'img/menu/avatar.png') }}'>
                                    </div>
                                    <!-- Information professional -->
                                    <div class="col-lg-9 card__data pl-2">
                                        <!-- card data top -->
                                        <div class="card__data_top">
                                            <div class="mb_card">
                                                <h4 class="txt_h4_card">{{ $contacto->nombre }}</h4>
                                            </div>
                                        </div>
                                        <!-- Informative buttons mobile-->
                                        <div class="d-lg-none button__info_card mb_card">
                                            @can('accesos-institucion','ver-contactos')
                                                <button class="btn_icon_card btn-ver-contacto tool top" data-id="{{ $contacto->id }}">
                                                    <i data-feather="eye" class="icon_btn_card_mobile"></i> 
                                                    <span class="tiptext">Ver contacto</span>
                                                </button>
                                            @endcan
                                            @can('accesos-institucion','editar-contacto')
                                                <button class="btn_icon_card btn-editar-contacto tool top" data-id="{{ $contacto->id }}">
                                                    <i data-feather="edit" class="icon_btn_card_mobile"></i> 
                                                    <span class="tiptext">Editar contacto</span>
                                                </button>
                                            @endcan
                                            @can('accesos-institucion','eliminar-contacto')
                                            <button class="btn_icon_card btn-eliminar-contacto tool top" data-id="{{ $contacto->id }}">
                                                <i data-feather="trash-2" class="icon_btn_card_mobile" style="color: #FF3E3E"></i> 
                                                <span class="tiptext">Eliminar contacto</span>
                                            </button>
                                            @endcan
                                        </div>
                                        <!-- card data down -->
                                        <div class="card__data_down">
                                            <div class="toolt bottom mb_card">
                                                <div class="width__tool_tip">
                                                    <i data-feather="mail" class="icon_span_card"></i>
                                                    <span class="txt_span_card">{{ $contacto->correo }}</span>
                                                </div>
                                                <span class="tiptext">{{ $contacto->correo }}</span>
                                            </div>

                                            <div class="mb_card">
                                                <i data-feather="phone" class="icon_span_card"></i>
                                                <span class="txt_span_card">{{ "{$contacto->telefono} - {$contacto->telefono_adicional}" }}</span>
                                            </div>

                                            <div class="toolt bottom">
                                                <div class="width__tool_tip">
                                                    <i data-feather="map-pin" class="icon_span_card"></i>
                                                    <span class="txt_span_card">{{ $contacto->direccion }}</span>
                                                </div>
                                                <span class="tiptext">{{ $contacto->direccion }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
                <!-- Pagination buttons -->
                <div class="col-12 p-0 pr-md-2 pr-xl-3 mt-4 butons__pagination_card">
                    <div class="toolt bottom">
                        <a disabled class="btn_right_pag_card"></a>
                        <span class="tiptext">Previus</span>
                    </div>

                    <div class="toolt bottom">
                        <a disabled class="btn_left_pag_card"></a>
                        <span class="tiptext">Next</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal see contac -->
    <div class="modal fade" id="modal_contactos_ver" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content modal__">
                <!-- Modal header -->
                <div class="modal-header row m-0 px-3 pl-lg-4">
                    <div class="col-12 p-0">
                        <button type="button" class="close modal_btn_close_top" data-dismiss="modal" aria-label="Close">
                            <span class="modal_x_close" aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!-- Título principal -->
                    <div class="col-12 modal_main_title">
                        <h1 class="modal_title_green">Ver Contacto</h1>
                    </div>
                </div>
                <!-- Modal body -->
                <div class="modal-body px-3 px-lg-4 m-0 mb-lg-3">
                    <!-- Imagen imprersa -->
                    <div class="row m-0">
                        <div class="col-12 p-0 mb-4 mb-lg-3 d-flex justify-content-center">
                            <img class="img_printed_modal" id="ver-foto" src="{{ asset($contacto->foto ?? 'img/menu/avatar.png') }}">
                        </div>
                    </div>
                    <!-- Sección data -->
                    <div class="modal_info_data_open">
                        <div class="row m-0">
                            <div class="col-lg-6 modal_info_user">
                                <h4 class="modal_data_form">Nombre:</h4>
                                <div class="modal_data_user">
                                    <span class="label-nombre"></span>
                                </div>
                            </div>

                            <div class="col-lg-6 modal_info_user">
                                <h4 class="modal_data_form">Identificación:</h4>
                                <div class="modal_data_user">
                                    <span class="label-numero_identificacion"></span>
                                </div>
                            </div>

                            <div class="col-12 mb-3 px-md-4 dropdown-divider" style="border: 1px solid #DBDADA"></div>

                            <div class="col-lg-6 modal_info_user">
                                <h4 class="modal_data_form">Correo:</h4>
                                <div class="modal_data_user">
                                    <span class="label-correo"></span>
                                </div>
                            </div>

                            <div class="col-lg-6 modal_info_user">
                                <h4 class="modal_data_form">Teléfono:</h4>
                                <div class="modal_data_user">
                                    <span class="label-telefono"></span>
                                </div>
                                <div class="modal_data_user">
                                    <span class="label-telefono_adicional"></span>
                                </div>
                            </div>

                            <div class="col-lg-6 modal_info_user">
                                <h4 class="modal_data_form">Ciudad:</h4>
                                <div class="modal_data_user">
                                    <span class="label-ciudad"></span>
                                </div>
                            </div>

                            <div class="col-lg-6 modal_info_user">
                                <h4 class="modal_data_form">Dirección:</h4>
                                <div class="modal_data_user">
                                    <span class="label-direccion"></span>
                                </div>
                            </div>

                            <div class="col-lg-6 modal_info_user">
                                <h4 class="modal_data_form">Tipo de contrato:</h4>
                                <div class="modal_data_user">
                                    <span class="label-tipo"></span>
                                </div>
                            </div>

                            <div class="col-lg-6 modal_info_user">
                                <h4 class="modal_data_form">Dependencia:</h4>
                                <div class="modal_data_user">
                                    <span class="label-dependencia"></span>
                                </div>
                            </div>

                            <div class="col-lg-6 modal_info_user">
                                <h4 class="modal_data_form">Banco:</h4>
                                <div class="modal_data_user">
                                    <span class="">Bancolombia</span>
                                </div>
                            </div>

                            <div class="col-lg-6 modal_info_user">
                                <h4 class="modal_data_form">Tipo de cuenta bancaria:</h4>
                                <div class="modal_data_user">
                                    <span class="label-tipo_cuenta"></span>
                                </div>
                            </div>

                            <div class="col-12 modal_info_user">
                                <h4 class="modal_data_form">N° de Cuenta bancaria:</h4>
                                <div class="modal_data_user">
                                    <span class="label-numero_cuenta"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modalfooter -->
                <div class="modal_btn_down_center mb-4">
                    <button type="button" class="button__form_green" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal delete contac -->
    <div class="modal fade" id="modal_contactos_eliminar" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal__">
                <!-- Modal header -->
                <div class="modal-header row m-0 px-3 pl-lg-4">
                    <div class="col-12 p-0">
                        <button type="button" class="close modal_btn_close_top" data-dismiss="modal" aria-label="Close">
                            <span class="modal_x_close" aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!-- Título principal -->
                    <div class="col-12 modal_main_title">
                        <h1 class="modal_title_green text-center">Eliminar Contacto</h1>
                    </div>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="modal__content_icon mb-3">
                        <i data-feather="trash-2" class="icon_delete_modal"></i>
                    </div>
                    <h5 class="txt_h5_regular_modal">¿Está seguro de eliminar a</h5>
                    <h5 class="label-nombre txt_h5_bold_modal my-1"></h5>
                    <h5 class="txt_h5_regular_modal">de su lista de contactos?</h5>
                </div>

                <!-- Delete and cancel buttons -->
                <form method="post" id="form-contacto-eliminar" class="forms">
                    @csrf
                    @method('delete')
                    <div class="row m-0 mt-md-3 mb-5 d-block d-md-flex justify-content-center">
                        <div class="col-12 col-md-4 p-0 mb-3 mb-md-0 button__down_card">
                            <button type="submit" class="btn_big_green_modal">Eliminar</button>
                        </div>

                        <div class="col-12 col-md-4 p-0 button__down_card">
                            <button type="button" class="btn_big_bord_green_modal" data-dismiss="modal">Cancelar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Editar y Crear -->
    <div class="modal fade modal_contactos" id="modal_contactos" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content modal_container">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form method="post" id="form-contacto" class="forms" enctype="multipart/form-data">
                    <div class="modal-body">
                        <h1 style="color: #019F86"><span id="titulo" style="color: #019F86">Nuevo</span> Contacto</h1>
                        @csrf
                        @method('put')
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
                        <button type="submit" class="button_green">Confirmar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Eliminar -->
    <div class="modal fade modal_contactos" id="" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal_container">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- Mantener las cases "label-*" -->
                <div class="modal-body">
                    <h1 style="color: #019F86">Eliminar Contacto</h1>

                    <div class="content__see_contacs" style="background-color: #6eb1a6">
                        <img id="ver-foto-eliminar" class="img__see_contacs" src='{{ asset($contacto->foto ?? 'img/menu/avatar.png') }}'>
                    </div>

                    <div class="content__border_see_contacs" style="background-color: #6eb1a6"></div>

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
                            <span>Dependencia:&nbsp;</span>
                            <span class="label-dependencia"></span>
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
                        <button type="submit" class="button_green ml-2">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('plugins/DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('js/alertas.js') }}"></script>

    <!-- Script para cargar, subir y visualizar la imagen principal -->
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
            // Lo convertimos a un objeto de tipo objectURL
            const objectURL = URL.createObjectURL(primerArchivo);
            // Y a la fuente de la imagen le ponemos el objectURL
            $imagenPrevisualizacion.src = objectURL;
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
                    targets: [-1, -2, -3],
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
                        modifier: {
                            page: 'current'
                        }
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

        //Abrir modal para crear contacto
        $('#btn-agregar-contacto').click(function (e) {
            var form = $('#form-contacto');
            form.attr('action', '{{ route('institucion.contactos.store') }}');
            form.attr('method', 'post');

            form.find('[name="_method"]').val('post');

            $('#imagen-foto').attr('src', '{{ asset('img/menu/avatar.png') }}');

            form[0].reset();
            $('#modal_contactos').modal();
            $('#titulo').html('Nuevo');
        });

        //Id del row a tratar
        var row;
        //Abrir modal para editar, eliminar y ver
        $('#table-contactos tbody').on('click', '.btn-editar-contacto', function (e) {
            var form = $('#form-contacto');
            var ruta_guardar = '{{ route('institucion.contactos.update', ['contacto' => ':id']) }}';
            var ruta_ver     = '{{ route('institucion.contactos.show', ['contacto' => ':id']) }}';
            var btn = $(this);

            form[0].reset();
            form.attr('action', ruta_guardar.replace(':id', btn.data('id')));
            form.attr('method', 'put');

            form.find('[name="_method"]').val('put');

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

                    console.log(item);
                    $.each(item, function (key, item) {
                        var i = $('#' + key);
                        if(i[0] && key !== 'foto') i.val(item);
                    });

                    $('#imagen-foto').attr('src', item.foto);
                },
                error: function (error) {
                    //mensaje
                    $('#alertas').html(alert(error.responseJSON.message, 'danger'));
                }
            });

            $('#modal_contactos').modal();
        });

        $('.btn-eliminar-contacto').click(function (e) {
            var form            = $('#form-contacto-eliminar');
            var ruta_eliminar   = '{{ route('institucion.contactos.update', ['contacto' => ':id']) }}';
            var ruta_ver        = '{{ route('institucion.contactos.show', ['contacto' => ':id']) }}';
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

                    $('#ver-foto-eliminar').attr('src', item.foto);

                    modal.modal();
                },
                error: function (error) {
                    //mensaje
                    $('#alertas').html(alert(error.responseJSON.message, 'danger'));
                }
            });
        });

        $('.btn-ver-contacto').click(function (e) {
            var form            = $('#form-contacto-eliminar');
            var ruta_eliminar   = '{{ route('institucion.contactos.update', ['contacto' => ':id']) }}';
            var ruta_ver        = '{{ route('institucion.contactos.show', ['contacto' => ':id']) }}';
            var btn = $(this);
            var modal = $('#modal_contactos_ver');

            form[0].reset();
            form.attr('action', ruta_eliminar.replace(':id', btn.data('id')));
            form.attr('method', 'delete');
            //form.find('[name="_method"]').val('post');

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

                    $('#ver-foto').attr('src', item.foto);

                    modal.modal();
                },
                error: function (error) {
                    //mensaje
                    $('#alertas').html(alert(error.responseJSON.message, 'danger'));
                }
            });

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
                                '<div class="d-flex justify-content-between">' +
                                    '<button class="btn_action_green btn-ver-contacto" type="button" data-id="' + response.item.id + '" id=contacto-"' + response.item.id + '">' +
                                        '<i class="fas fa-eye"></i>' + 
                                    '</button>' +
                                    @can('accesos-institucion','editar-contacto') 
                                        '<button class="btn_action_green btn-editar-contacto" type="button" data-id="' + response.item.id + '" id=contacto-"' + response.item.id + '">' +
                                            '<i class="fas fa-edit"></i>' +
                                        '</button>' + 
                                    @endcan
                                    @can('accesos-institucion','eliminar-contacto')
                                        '<button class="btn_action_green btn-eliminar-contacto" type="button" data-id="' + response.item.id + '" id=contacto-"' + response.item.id + '">' +
                                            '<i class="fas fa-trash-2"></i>' +
                                        '</button>' + 
                                    @endcan
                                '</div>'
                            ]).draw().node();
                            modal.modal('hide');
                            break;
                        case 'updated':
                            row.data([
                                img(response.item.foto, response.item.nombre),
                                response.item.direccion,
                                response.item.telefono,
                                response.item.correo,
                                '<div class="d-flex justify-content-between">' +
                                '<button class="btn_action_green btn-ver-contacto" type="button" data-id="' + response.item.id + '" id=contacto-"' + response.item.id + '"> <i class="fas fa-eye"></i> </button>' +
                                @can('accesos-institucion','editar-contacto')'<button class="btn_action_green btn-editar-contacto" type="button" data-id="' + response.item.id + '" id=contacto-"' + response.item.id + '"> <i class="fas fa-edit"></i> </button>' +@endcan
                                    @can('accesos-institucion','eliminar-contacto')'<button class="btn_action_green btn-eliminar-contacto" type="button" data-id="' + response.item.id + '" id=contacto-"' + response.item.id + '"> <i class="fas fa-trash-2"></i> </button>' + @endcan
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

    <!-- Script barra de búsqueda desplegable -->
    <script>
        $('#search').on('click', function () {
            $('#search').addClass('search_togggle');
        });
    </script>
@endsection
