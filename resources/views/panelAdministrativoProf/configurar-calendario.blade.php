@section('styles')

@endsection

@extends('panelAdministrativoProf.panelAdministrativoProfesional')

@section('PanelProf')
    <nav id="nav_breadcrumb" aria-label="breadcrumb">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb py-1">
                <li class="breadcrumb-item">
                    <a href="#">
                      Calendario
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="#">
                        Configuración del Calendario
                    </a>
                </li>
            </ol>
        </nav>
    </nav>
    <!-- Form update duration date -->
    <form action="#" method="post" id="form-config-date">
        @csrf
        <div class="form_config">
            <h2>Configuración de cita</h2>

            <div class="row">
                <div class="col-md-6">
                    <label for="date-duration">Durración de cita</label>
                    <input type="number" id="date-duration" name="date-duration" value="date-duration">
                </div>

                <div class="col-md-6">
                    <label for="date-after">Después de cita</label>
                    <input type="number"id="date-after" name="date-after" value="date-after">
                </div>
            </div>

            <!-- Buttons -->
            <div class="row btn_bottom"> 
                <button type="submit" class="btn_blue">Guardar
                    <i class="fas fa-save pl-2"></i>
                </button>
            </div>
        </div>
    </form>

    <div class="">
        <!-- Form add schedule-->
        <form action="" method="post" id="">
            @csrf
            <div class="form_config">
                <h2>Adicionar Horario</h2>
                <div class="">
                    <ul class="row justify-content-between mb-4">
                        <li class="col-1">
                            <input class="" type="checkbox" value="1" id="week-1" name="">
                            <span>lunes</span>
                        </li>
                        <li class="col-1">
                            <input class="" type="checkbox" value="1" id="week-1" name="">
                            <span>Martes</span>
                        </li>
                        <li class="col-1">
                            <input class="" type="checkbox" value="1" id="week-1" name="">
                            <span>Miércoles</span>
                        </li>
                        <li class="col-1">
                            <input class="" type="checkbox" value="1" id="week-1" name="">
                            <span>Jueves</span>
                        </li>
                        <li class="col-1">
                            <input class="" type="checkbox" value="1" id="week-1" name="">
                            <span>Viernes</span>
                        </li>
                        <li class="col-1">
                            <input class="" type="checkbox" value="1" id="week-1" name="">
                            <span>Sábado</span>
                        </li>
                        <li class="col-1">
                            <input class="" type="checkbox" value="1" id="week-1" name="">
                            <span>Domingo</span>
                        </li>
                    </ul>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label for="startTime">Inicio</label>
                        <input type="time" class="" id="startTime" name="startTime">
                    </div>

                    <div class="col-md-6 data_group_form">
                        <label for="endTime">Fin</label>
                        <input type="time" class="" id="endTime" name="endTime">
                    </div>
                </div>

                <!-- Buttons -->
                <div class="row btn_bottom"> 
                    <button type="submit" class="btn_blue">Agregar
                        <i class="fas fa-plus pl-2"></i>
                    </button>
                </div>
            </div>
        </form>

        <div class="form_config">
            <h2>Horario</h2>

            <div class="col-12">
                <table class="table table-striped table-bordered p-0" id="table-schedule">
                    <thead>
                        <tr>
                            <th>Días</th>
                            <th>Horas</th>
                            <th>Acción</th>
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
                            <td>
                                <div class="btn_bottom">
                                    <button class="btn_red" data-id="">Eliminar
                                        <i class="fa fa-trash pl-2"></i>
                                    </button>
                                </div>
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
                            <td>
                                <div class="btn_bottom">
                                    <button class="btn_red" data-id="">Eliminar
                                        <i class="fa fa-trash pl-2"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script defer>
        document.addEventListener('DOMContentLoaded', function() {
            $('#form-config-date').submit(function (e) {
                e.preventDefault();
                var form = $(this);

                $.ajax({
                    data: form.serialize(),
                    url: form.attr('action'),
                    dataType: 'json',
                    method: 'post',
                    success: function (res, status) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Hecho',
                            text: res.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                    },
                    error: function (res, status) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Alerta',
                            text: res.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                });
            });

   


        });

        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
@endsection
