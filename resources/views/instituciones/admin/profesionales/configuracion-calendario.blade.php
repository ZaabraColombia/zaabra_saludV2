@section('styles')

@endsection

@extends('instituciones.admin.layouts.layout')

@section('contenido')
    <div class="container-fluid p-0 pr-lg-4">
        <div class="containt_agendaProf">
            <!-- Form update duration date -->
            <div class="my-4 my-xl-5">
                <h1 class="title__xl green_bold">Configuración de cita</h1>
                <h2 class="text__md black_light">Administre el horario de las citas</h2>
            </div>

            <form action="#"
                  method="post" id="form-dias" class="forms" data-alert="#alert-cita">
                @csrf
                <div class="containt_main_table mb-3">
                    <div id="alert-cita"></div>
                    <div class="row">
                        <div class="col-md-4 input__box">
                            <label for="disponibilidad">Tiempo disponibilidad agenda</label>
                            <input type="number" id="disponibilidad" name="disponibilidad">
                        </div>

                        <div class="col-12 input__box">
                            <label for="duracion">Servicios</label>
                            <select type="text" id="tp_documento" name="tp_documento">
                                <option></option>
                                <option value="Servicio 1">Servicio 1</option>
                                <option value="Servicio 2">Servicio 2</option>
                                <option value="Servicio 3">Servicio 3</option>
                                <option value="otro">Otro</option>
                            </select>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="row m-0 content_btn_right">
                        <button type="button" class="button_green">Guardar</button>
                    </div>
                </div>
            </form>

            <!-- Form add schedule-->
            <form action="{{ route('institucion.profesionales.guardar_horario', ['profesional' => $profesional->id_profesional_inst]) }}"
                  method="post" id="form-horario-agregar" class="forms" data-alert="#alert-horario-agregar">
                @csrf
                <div class="containt_main_table mb-3">
                    <div id="alert-horario-agregar"></div>
                    <div class="mb-3">
                        <h2 class="subtitle__lg green_bold">Nuevo Horario</h2>
                    </div>

                    <div class="list__form">
                        <ul class="row m-0 mt-3">
                            <li class="col-6 col-md-3 input__check">
                                <input type="checkbox" value="1" id="semana-1" name="semana[]">
                                <label for="semana-1">lunes</label>
                            </li>
                            <li class="col-6 col-md-3 input__check">
                                <input type="checkbox" value="2" id="semana-2" name="semana[]">
                                <label for="semana-2">Martes</label>
                            </li>
                            <li class="col-6 col-md-3 input__check">
                                <input type="checkbox" value="3" id="semana-3" name="semana[]">
                                <label for="semana-3">Miércoles</label>
                            </li>
                            <li class="col-6 col-md-3 input__check">
                                <input type="checkbox" value="4" id="semana-4" name="semana[]">
                                <label for="semana-4">Jueves</label>
                            </li>
                            <li class="col-6 col-md-3 input__check">
                                <input type="checkbox" value="5" id="semana-5" name="semana[]">
                                <label for="semana-5">Viernes</label>
                            </li>
                            <li class="col-6 col-md-3 input__check">
                                <input type="checkbox" value="6" id="semana-6" name="semana[]">
                                <label for="semana-6">Sábado</label>
                            </li>
                            <li class="col-6 col-md-3 input__check">
                                <input type="checkbox" value="0" id="semana-0" name="semana[]">
                                <label for="semana-0">Domingo</label>
                            </li>
                        </ul>
                    </div>

                    <div class="row">
                        <div class="col-md-6 input__box">
                            <label for="hora_inicio">Inicio</label>
                            <input type="time" id="hora_inicio" name="hora_inicio">
                        </div>

                        <div class="col-md-6 input__box">
                            <label for="hora_final">Fin</label>
                            <input type="time" id="hora_final" name="hora_final">
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="row m-0 content_btn_right">
                        <button type="submit" class="button_green">Agregar</button>
                    </div>
                </div>
            </form>

            <div class="containt_main_table mb-3">
                <div class="mb-3">
                    <h2 class="subtitle__lg green_bold">Horario</h2>
                </div>

                <div class="table-responsive">
                    <table class="table" id="table-horario">
                        <thead>
                            <tr>
                                <th>Días</th>
                                <th>Horas</th>
                                <th>Acción</th>
                            </tr>
                        </thead>

                        <tbody>
                        @if(!empty($profesional->horario) and is_array($profesional->horario))
                            @foreach($profesional->horario as $item)
                                <tr>
                                    <td>
                                        @if(!empty($item['daysOfWeek']))
                                            @php foreach ($item['daysOfWeek'] as $k => $i) $item['daysOfWeek'][$k] = daysWeekText($i); @endphp
                                            {{ implode('-', $item['daysOfWeek']) }}
                                        @endif
                                    </td>
                                    <td>{{ date('h:i A', strtotime($item['startTime'])) }} - {{ date('h:i A', strtotime($item['endTime'])) }}</td>
                                    <td>
                                        <button class="btn_type_icon_green eliminar-horario tool top"
                                                type="button" data-id="{{ $item['id'] }}">
                                            <i data-feather="x-circle"></i>
                                            <span class="tiptext">eliminar horario</span>
                                        </button>
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

    <!-- Modal  Eliminar horario -->
    <div class="modal fade" id="modal_eliminar_horario" tabindex="-1" >
        <div class="modal-dialog" role="document">
            <div class="modal-content modal_container">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <h1>Eliminar horario</h1>

                    <div class="eliminar_horario">
                        <i data-feather="trash-2" class="trash_2"></i>
                        <h3>Desea eliminar el horario</h3>
                    </div>
                </div>

                <div class="modal-footer content_btn_center">
                    <button type="button" class="button_transparent btn-eliminar-horario" data-status="0">Cancelar</button>
                    <button type="submit" class="button_blue btn-eliminar-horario" data-status="1">Confirmar</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('js/alertas.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>

    <script>
        feather.replace()
    </script>

    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });

        $('#form-horario-agregar').submit(function (e) {
            e.preventDefault();
            var form = $(this);

            $.ajax({
                data: form.serialize(),
                url: form.attr('action'),
                dataType: 'json',
                method: 'post',
                success: function (res, status) {
                    $('#alert-horario-agregar').html(res.message);
                    //clean form
                    form[0].reset();

                    //add item form
                    $('#table-horario tbody').append('<tr>' +
                        '<td>' +
                        res.item.daysOfWeek.join('-') +
                        '</td>' +
                        '<td>' + moment(res.item.startTime, 'HH:mm').format('hh:mm A') + ' - ' + moment(res.item.endTime, 'HH:mm').format('hh:mm A') + '</td>' +
                        '<td class="d-flex justify-content-center">' +
                        '<button class="btn_cierre_citasProf eliminar-horario" type="button" data-id="' + res.item.id + '"></button>' +
                        '</td>' +
                        '</tr>');
                },
                error: function (res, status) {
                    $('#alert-horario-agregar').html(alert(res.responseJSON.message, 'danger'));
                }
            });
        });

        var tr_eliminar_horario;
        $('#table-horario tbody').on('click', '.eliminar-horario', function (e) {
            e.preventDefault();
            var btn = $(this);
            $('.btn-eliminar-horario').data('id', btn.data('id'));
            tr_eliminar_horario = btn.parents('tr');
            $('#modal_eliminar_horario').modal();
        });

        $('.btn-eliminar-horario').click(function (element) {
            $('#modal_eliminar_horario').modal('hide');

            var btn = $(this);

            if (btn.data('status'))
            {
                $.ajax({
                    data: {id: btn.data('id')},
                    url: '{{ route('institucion.profesionales.eliminar_horario', ['profesional' => $profesional->id_profesional_inst]) }}',
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: 'delete',
                    success: function (res) {
                        $('#alert-horario-agregar').html(alert(res.message, 'success'));

                        tr_eliminar_horario.remove();
                        tr_eliminar_horario = undefined;
                    },
                    error: function (res) {
                        $('#alert-horario-agregar').html(alert(res.responseJSON.message, 'danger'));
                    }
                });
            }
        });

    </script>
@endsection
