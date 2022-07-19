@extends('profesionales.admin.layouts.panel')

@section('styles')

@endsection

@section('contenido')
    <div class="container-fluid panel_container">
        <!-- panel head -->
        <div class="panel_head">
            <!-- Title -->
            <h1 class="mb-3 title blue_two">Configuración del calendario</h1>
            <!-- Subtitulo y tarjeta del usuario -->
            <div class="row m-0">
                <div class="col-md-6 p-0 mb-3 mb-md-0">
                    <h2 class="text-center text-md-left h2_fs20_bold black_">Administre el horario de las citas.</h2>
                </div>

                <div class="col-md-6 p-0">
                    <a class="d-flex justify-content-end align-items-center" href="">
                        <div class="img__perfil_estatic">
                            <img src='/img/menu/avatar.png'>
                        </div>
                        <div class="pl-3">
                            <h5 class="h5_fs15_med black_">Alejandro Sandoval</h5>
                            <h5 class="h5_fs15_med black_">Cardiologo</h5>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <!-- panel body -->
        <div class="panel_body">
            <div class="container__form mb-3">
                <form action="{{ route('profesional.agenda.configurar-calendario.cita') }}" method="post" id="form-dias" data-alert="#alert-cita">
                    @csrf
                    <!-- Mensaje de alerta -->
                    <div id="alert-cita">
                        @if($errors->first('configurar'))
                            <div class="col-12">
                                <div class="alert alert-danger" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <h4 class="alert-heading">Error!</h4>
                                    <p>{{ $errors->first('configurar') }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                    <!-- Inputs -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="label_fs16_med black_" for="dias_agenda">Disponibilidad de la agenda (Días)</label>
                            <input class="input__text" type="number" id="dias_agenda" name="dias_agenda" value="{{ old('dias_agenda', $config->dias_agenda) }}">
                        </div>
                    </div>
                    <!-- Button -->
                    <div class="btn__down_form">
                        <button type="submit" class="bg_blue_two">Guardar</button>
                    </div>
                </form>
            </div>

            <div class="container__form mb-3">
                <form action="{{ route('profesional.agenda.configurar-calendario.horario-agregar') }}" method="post" id="form-horario-agregar" data-alert="#alert-horario-agregar">
                    @csrf
                    <div id="alert-horario-agregar"></div>
                    <!-- Subtitulo -->
                    <div class="mb-3">
                        <h2 class="h2_fs20_bold blue_two">Nuevo Horario</h2>
                    </div>
                    <!-- Lista checks toggle -->
                    <div id="input_check_list" class="list_check_toggle">
                        <ul class="check_blue">
                            <li class="col-6 col-md-3 input_checkBox_toggle">
                                <input type="checkbox" value="1" id="semana-1" name="semana[]">
                                <label class="input_checkBox_text_toggle" for="semana-1">lunes</label>
                            </li>
                            <li class="col-6 col-md-3 input_checkBox_toggle">
                                <input type="checkbox" value="2" id="semana-2" name="semana[]">
                                <label class="input_checkBox_text_toggle" for="semana-2">Martes</label>
                            </li>
                            <li class="col-6 col-md-3 input_checkBox_toggle">
                                <input type="checkbox" value="3" id="semana-3" name="semana[]">
                                <label class="input_checkBox_text_toggle" for="semana-3">Miércoles</label>
                            </li>
                            <li class="col-6 col-md-3 input_checkBox_toggle">
                                <input type="checkbox" value="4" id="semana-4" name="semana[]">
                                <label class="input_checkBox_text_toggle" for="semana-4">Jueves</label>
                            </li>
                            <li class="col-6 col-md-3 input_checkBox_toggle">
                                <input type="checkbox" value="5" id="semana-5" name="semana[]">
                                <label class="input_checkBox_text_toggle" for="semana-5">Viernes</label>
                            </li>
                            <li class="col-6 col-md-3 input_checkBox_toggle">
                                <input type="checkbox" value="6" id="semana-6" name="semana[]">
                                <label class="input_checkBox_text_toggle" for="semana-6">Sábado</label>
                            </li>
                            <li class="col-6 col-md-3 input_checkBox_toggle">
                                <input type="checkbox" value="0" id="semana-0" name="semana[]">
                                <label class="input_checkBox_text_toggle" for="semana-0">Domingo</label>
                            </li>
                        </ul>
                    </div>
                    <!-- inputs -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="label_fs16_med black_" for="hora_inicio">Inicio</label>
                            <input class="input__text" type="time" id="hora_inicio" name="hora_inicio">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="label_fs16_med black_" for="hora_final">Fin</label>
                            <input class="input__text" type="time" id="hora_final" name="hora_final">
                        </div>
                    </div>
                    <!-- Button -->
                    <div class="btn__down_form">
                        <button type="submit" class="bg_blue_two">Agregar</button>
                    </div>
                </form>
            </div>

            <div class="container__form mb-3">
                <!-- Subtitulo -->
                <div class="mb-3">
                    <h2 class="h2_fs20_bold blue_two">Horario</h2>
                </div>
                <!-- Tabla -->
                <div class="table-responsive table__form">
                    <table class="table tableBlue" id="table-horario">
                        <thead>
                            <tr>
                                <th>Días</th>
                                <th>Horas</th>
                                <th>Acción</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if(!empty($config->horario) and is_array($config->horario))
                                @foreach($config->horario as $item)
                                    <tr>
                                        <td>
                                            @if(!empty($item['daysOfWeek']))
                                                @php foreach ($item['daysOfWeek'] as $k => $i) $item['daysOfWeek'][$k] = daysWeekText($i); @endphp
                                                {{ implode('-', $item['daysOfWeek']) }}
                                            @endif
                                        </td>
                                        <td>{{ date('h:i A', strtotime($item['startTime'])) }} - {{ date('h:i A', strtotime($item['endTime'])) }}</td>
                                        <td>
                                            <button class="btn_cierre_citasProf eliminar-horario tool top"
                                                    type="button" data-id="{{ $item['id'] }}">
                                                <span class="tiptext">Eliminar horario</span>
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
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal_preventivo">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <h1 class="text-center h1_fs25_bold blue_two">Eliminar horario</h1>

                    <div class="modal_icon_preventivo">
                        <i data-feather="trash-2" class="trash_2"></i>
                    </div>

                    <h5 class="text-center h5_fs14_reg black_">¿Está seguro de eliminar el horario?</h5>
                </div>

                <div class="modal-footer">
                    <button type="button" class="bord_gray_70 h2_fs20_bold btn-eliminar-horario" data-status="0">Cancelar</button>
                    <button type="submit" class="bg_blueTwo h2_fs20_bold btn-eliminar-horario" data-status="1">Confirmar</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('js/alertas.js') }}"></script>
    <script>
        moment.locale('es');
        $('#form-dias').submit(function (e) {
            e.preventDefault();
            var form = $(this);
            $.ajax({
                data: form.serialize(),
                url: form.attr('action'),
                dataType: 'json',
                method: 'post',
                success: function (res, status) {
                    $('#alert-cita').html(alert(res.message, 'success'));
                },
                error: function (res, status) {
                    $('#alert-cita').html(alert(res.responseJSON.message, 'danger'));
                }
            });
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
                    $('#alert-horario-agregar').html(alert(res.message, 'success'));
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
                    url: '{{ route('profesional.agenda.configurar-calendario.horario-eliminar') }}',
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


        $(function () {
            $('[data-toggle="tooltip"]').tooltip();
        })
    </script>
@endsection
