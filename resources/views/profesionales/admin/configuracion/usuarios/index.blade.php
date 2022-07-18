@extends('profesionales.admin.layouts.panel')

@section('styles')
    <link rel="stylesheet" href="{{ asset('plugins/DataTables/datatables.min.css') }}">
    <style>
        .dataTables_filter, .dataTables_info { display: none;!important; }
    </style>
@endsection

@section('contenido')
    <div class="container-fluid panel_container">
        <!-- panel head -->
        <div class="panel_head">
            <!-- Title -->
            <h1 class="title blue_two">Usuarios</h1>
            <!-- Toolbar -->
            <div class="row m-0">
                <!-- Add button -->
                @can('accesos-profesional',['agregar-usuario'])
                    <div class="col-md-12 col-lg-auto btn__card_add">
                        <a href="{{ route('profesional.configuracion.usuarios.create') }}" id="btn-agregar-contacto" class="bg_blue_two">Agregar usuario</a>
                    </div>
                @endcan
                <!-- Search bar -->
                <div class="col-md-6 col-lg-5 col-xl-5 mr-lg-auto search">
                    <form method="get">
                        <button id="search" type="button" class="icon_search_blue {{ (request('search')) ? 'search_togggle':'' }}">
                            <input type="search" name="search" id="search" placeholder="Buscar" value="{{ request('search') }}">
                        </button>
                    </form>
                </div>
                <!-- Document action buttons  -->
                <div class="col-md-4 ml-md-auto col-lg-auto btns__export_doc">
                    <div class="toolTip bottom">
                        <button class="file_excel"></button>
                        <span class="toolText">Eportar Excel</span>
                    </div>
                    <div class="toolTip bottom">
                        <button class="file_pdf"></button>
                        <span class="toolText">Eportar PDF</span>
                    </div>
                    <div class="toolTip bottom">
                        <button class="file_printer"></button>
                        <span class="toolText">Imprimir</span>
                    </div>
                </div>
            </div>
        </div>
        <!-- panel body -->
        <div id="" class="panel_body">
            <div class="row m-0">
                <!-- alert notice -->
                <div class="col-12">
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
                @if($usuarios->isNotEmpty())
                    @foreach($usuarios as $usuario)
                        <div class="col-md-6 col-lg-4 mb_card card__space card__width_desk">
                            <!-- card -->
                            <div class="card__mod">
                                <!-- card header -->
                                <div class="card__header pt-0 px-0">
                                    <div class="row m-0">
                                        <!-- Image user -->
                                        <div class="img__perfil_float_inside">
                                            <img src="{{ asset($contacto->foto ?? 'img/menu/avatar.png') }}">
                                        </div>
                                        <!-- Estado activo o inactivo -->
                                        <div class="col-12 p-0 btn__estado">
                                            <button class="btn__activado">
                                                <span>Activo</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <!-- card boody -->
                                <div class="card__body">
                                    <div class="row mx-0 mt-1">
                                        <div class="col-12 p-0 mb-2 card_bord_bottom">
                                            <h5 class="text-center h5_fs14_med black_">{{ "$usuario->primernombre $usuario->apellidos" }}</h5>

                                            <h5 class="text-center mb-1 h5_fs14_reg black_">{{ $usuario->auxiliar->cargo }} Administrativo</h5>
                                        </div>

                                        <div class="col-9 p-0 m-auto">
                                            <div class="pl-md-3">
                                                <i data-feather="phone" class="icon_contac_blue_card"></i>
                                                <span class="span_fs12_reg black_">{{ $usuario->auxiliar->celular }}</span>
                                            </div>

                                            <div class="toolTip bottom">
                                                <div class="pl-md-3 tooltip_data">
                                                    <i data-feather="mail" class="icon_contac_blue_card"></i>
                                                    <span class="span_fs12_reg black_">{{ $usuario->email }}</span>
                                                </div>
                                                <span class="toolText">{{ $usuario->email }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- card footer -->
                                <div class="card__footer pt-0 pb-1">
                                    <div class="row m-0 justify-content-center">
                                        @can('accesos-institucion', 'editar-usuario')
                                            <div class="col-12 col-md-3 p-0 btn__card_down">
                                                <button class="bg_blue_two boton-convenio"
                                                    data-url="{{ route('profesional.configuracion.usuarios.show', ['usuario' => $usuario->id]) }}">Ver más
                                                </button>
                                            </div>
                                        @endcan

                                        @can('accesos-institucion', 'editar-usuario')
                                            <div class="col-12 col-md-3 p-0 btn__card_down">
                                                <a href="{{ route('profesional.configuracion.usuarios.edit', ['usuario' => $usuario->id]) }}" class="bord_blue_two">Editar</a>
                                            </div>
                                        @endcan
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
                <!-- Pagination buttons -->
                <div class="col-12 p-0 pr-md-2 pr-xl-3 mt-4 butons__pagination_card">
                    <div class="toolTip bottom">
                        <a disabled class="btn_right_pag_card disabled"></a>
                        <span class="toolText">Previus</span>
                    </div>

                    <div class="toolTip bottom">
                        <a disabled class="btn_left_pag_card disabled"></a>
                        <span class="toolText">Next</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Ver user -->
    <div class="modal fade" id="modal_ver_usuario" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content modal_container">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- Mantener las cases "label-*" -->
                <div class="modal-body">
                    <h1 class="mb-3">Ver Usuario</h1>

                    <div class="content__border_see_contacs"></div>

                    <div class="modal_info_cita pt-3 px-2">
                        <h4 class="fs_subtitle blue_light" style="border-bottom: 2px solid #7fadcb;">Información básica</h4>
                        <div class="row mb-2">
                            <div class="col-lg-6 info_contac">
                                <span>Nombres:&nbsp;</span>
                                <span id="nombres">Nombre 1 Nombre 2</span>
                            </div>

                            <div class="col-lg-6 info_contac">
                                <span>Apellidos:&nbsp;</span>
                                <span id="apellidos">Apellido 1 Apellido 2</span>
                            </div>

                            <div class="col-lg-6 info_contac">
                                <span id="numero_identificacion"></span>
                            </div>

                            <div class="col-lg-6 info_contac">
                                <span>Fecha de nacimiento:&nbsp;</span>
                                <span id="fecha_nacimineto"></span>
                            </div>

                            <div class="col-lg-6 info_contac">
                                <span>Teléfonos:&nbsp;</span>
                                <span id="telefonos"></span>
                            </div>

                            <div class="col-lg-6 info_contac">
                                <span>Correo:&nbsp;</span>
                                <span id="correo"></span>
                            </div>

                            <div class="col-lg-6 info_contac">
                                <span>Dirección:&nbsp;</span>
                                <span id="direccion"></span>
                            </div>

                            <div class="col-lg-6 info_contac">
                                <span>País:&nbsp;</span>
                                <span id="pais"></span>
                            </div>

                            <div class="col-lg-6 info_contac">
                                <span>Departamento:&nbsp;</span>
                                <span id="departamento"></span>
                            </div>

                            <div class="col-lg-6 info_contac">
                                <span>Provincia:&nbsp;</span>
                                <span id="provincia"></span>
                            </div>

                            <div class="col-lg-6 info_contac">
                                <span>Ciudad:&nbsp;</span>
                                <span id="ciudad"></span>
                            </div>


                        </div>

                        <h4 class="fs_subtitle blue_light" style="border-bottom: 2px solid #7fadcb;">Accesos del usuario</h4>
                        <div class="row m-0 mb-2" id="accesos-lista">
                        </div>
                    </div>
                </div>
                <div class="modal-footer content_btn_center">
                    <button type="button" class="button_transparent" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('js/alertas.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>

    <script>
        // Inicializar iconos data-feather
        feather.replace()
    </script>

    <script>
        //Inicializar tabla
        var table = $('#table-pacientes').DataTable({
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
            paging: true,
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

        $('.modal-usuario').click(function (event) {
            var btn = $(this);

            $.get(btn.data('url'), function (response) {
                console.log(response);

                $.each(response.item, function (key, item) {
                    if (key !== 'accesos') $('#' + key).html(item);
                });
                $('#accesos-lista').html('');
                $.each(response.item.accesos, function (key, item) {
                    $('#accesos-lista').append('<div class="col-md-6 col-lg-4 d-flex pl-0 info_contac">'
                        + '<i data-feather="check-circle" style="color: #0083D6;" width="17"></i>'
                        + '<span class="pl-2">' + item.nombre + '</span>'
                        + '</div>');
                });

                feather.replace();
                $('#modal_ver_usuario').modal();
            }, "json").fail(function (error) {
                console.log(error);
            });
        });
    </script>

    <!-- Función para el despliegue de la barra de busqueda -->
    <script>
        $('#search').on('click', function () {
            $('#search').addClass('search_togggle');
        });
    </script>
@endsection
