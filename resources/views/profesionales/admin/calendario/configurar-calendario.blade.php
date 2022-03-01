@section('styles')

@endsection

@extends('profesionales.admin.layouts.panel')

@section('contenido')
    <!-- Form update duration date -->
    <div class="main_title">
        <h1>Configuración de cita</h1>
        <span>Administre su horario de la cita</span>
    </div>

    <form action="{{ route('profesional.configurar-calendario.cita') }}"
          method="post" id="form-dias" class="forms" data-alert="#alert-cita">
        @csrf
        <div class="form_config">
            <div id="alert-cita"></div>
            <div class="row">
                <div class="col-md-6">
                    <label for="duracion">Duración de cita (min)</label>
                    <input type="number" id="duracion" name="duracion">
                </div>

                <div class="col-md-6">
                    <label for="descanso">Tiempo entre citas (min)</label>
                    <input type="number" id="descanso" name="descanso">
                </div>
            </div>

            <!-- Buttons -->
            <div class="row btn_bottom">
                <button type="submit" class="btn_blue px-4">Guardar</button>
            </div>
        </div>
    </form>

    <div class="">
        <!-- Form add schedule-->
        <form action="{{ asset('profesional.configurar-calendario.horario-agregar') }}"
              method="post" id="form-horario-agregar" class="forms" data-alert="#alert-horario-agregar">
            @csrf
            <div class="form_config">
                <div id="alert-horario-agregar"></div>
                <h2>Nuevo Horario</h2>
                <div class="">
                    <ul class="row m-0">
                        <li class="col-3">
                            <input type="checkbox" value="0" id="week-0" name="week[]">
                            <label for="week-0">lunes</label>
                        </li>
                        <li class="col-3">
                            <input type="checkbox" value="1" id="week-1" name="week[]">
                            <label for="week-1">Martes</label>
                        </li>
                        <li class="col-3">
                            <input type="checkbox" value="2" id="week-2" name="week[]">
                            <label for="week-2">Miércoles</label>
                        </li>
                        <li class="col-3">
                            <input type="checkbox" value="3" id="week-3" name="week[]">
                            <label for="week-3">Jueves</label>
                        </li>
                        <li class="col-3">
                            <input type="checkbox" value="4" id="week-4" name="week[]">
                            <label for="week-4">Viernes</label>
                        </li>
                        <li class="col-3">
                            <input type="checkbox" value="5" id="week-5" name="week[]">
                            <label for="week-5">Sábado</label>
                        </li>
                        <li class="col-3">
                            <input type="checkbox" value="6" id="week-6" name="week[]">
                            <label for="week-6">Domingo</label>
                        </li>
                    </ul>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label for="hora_inicio">Inicio</label>
                        <input type="time" id="hora_inicio" name="hora_inicio">
                    </div>

                    <div class="col-md-6 data_group_form">
                        <label for="hora_final">Fin</label>
                        <input type="time" id="hora_final" name="hora_final">
                    </div>
                </div>

                <!-- Buttons -->
                <div class="row btn_bottom">
                    <button type="submit" class="btn_blue">Agregar
                        <i class="fas fa-plus pl-1"></i>
                    </button>
                </div>
            </div>
        </form>

        <div class="form_config">
            <h2>Horario</h2>

            <div>
                <table class="table p-0" id="">
                    <thead>
                        <tr>
                            <th>
                                <span>Días</span>
                            </th>
                            <th>
                                <span>Horas</span>
                            </th>
                            <th>
                                <span>Acción</span>
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>
                                <span>Lunes -</span>
                                <span>Martes -</span>
                                <span>Viernes</span>
                            </td>
                            <td>
                                <span>07:00 a.m. - 04:00 p.m.</span>
                            </td>
                            <td class="d-flex justify-content-center">
                                <button class="btn_cierre_citasProf" type="submit" data-toggle="modal" data-target="#exampleModal2"></button>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <span>Martes -</span>
                                <span>Jueves -</span>
                                <span>Viernes</span>
                            </td>
                            <td>
                                <span>09:00 a.m. - 04:00 p.m.</span>
                            </td>
                            <td class="d-flex justify-content-center">
                                <button class="btn_cierre_citasProf" type="submit" data-toggle="modal" data-target="#exampleModal2"></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/alertas.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
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
        });

        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
@endsection
