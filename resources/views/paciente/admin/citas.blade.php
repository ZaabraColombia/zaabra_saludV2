@extends('paciente.admin.layouts.layout')

@section('styles')
    <link rel="stylesheet" href="{{ asset('plugins/DataTables/datatables.min.css') }}">
    <style>
        /*.dataTables_filter, .dataTables_info { display: none;!important; }*/
    </style>
@endsection

@section('contenido')
    <div class="container-fluid p-0 pr-lg-4">
        <div class="containt_agendaProf" id="basic-table">
            <div class="col-12">
                @if(session('success'))
                    <div class="alert alert-success w-100" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="alert-heading">Hecho</h4>
                        <p>{{ session('success') }}</p>
                    </div>
                @endif
            </div>

            <div class="my-4 my-xl-5">
                <h1 class="title_miCita">Mis citas</h1>
                <span class="subtitle_miCita">encuentre aquí todas sus citas</span>
            </div>

            <div class="containt_main_table mb-3">
                <div class="table-responsive">
                    <table class="table table_agenda" id="table-citas">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Hora</th>
                                <th>Dirección</th>
                                {{-- <th>Ciudad</th>        --}}
                                <th>Tipo de cita</th>
                                {{-- <th>Especialidad</th>  --}}
                                {{-- <th>Institución</th>   --}}
                                <th>Especialista</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if($citas->isNotEmpty())
                            @foreach($citas as $cita)
                                <tr>
                                    <td>{{ $cita->fecha_inicio->format('d-m-Y') }}</td>
                                    <td>{{ "{$cita->fecha_inicio->format('H:i a')} - {$cita->fecha_fin->format('H:i a')}" }}</td>
                                    <td>{{ $cita->lugar }}</td>
                                    {{-- <td>Bogotá</td>                                    --}}
                                    <td>{{ $cita->tipo_consulta->nombreconsulta ?? ''}}</td>
                                    {{-- <td>Traumatología</td>                             --}}
                                    {{-- <td>Clinica Reina Sofia</td>                       --}}
                                    <td class="d-flex align-items-center">
                                        @if(!empty($cita->profesional))
                                            {{ $cita->profesional->user->nombre_completo }} &nbsp;
                                            <a class="btn_action" style="width: 33px" href="{{route('PerfilProfesional', ['slug' => $cita->profesional->slug])}}" target="_blank"> 
                                                <i data-feather="external-link"></i>
                                            </a>
                                        @endif
                                        @if(!empty($cita->profesional_ins))
                                            {{ "{$cita->profesional_ins->institucion->user->nombreinstitucion} - {$cita->profesional_ins->nombre_completo}" }} &nbsp;
                                                <a class="btn_action" style="width: 33px" href="{{route('PerfilInstitucion', ['slug' => $cita->profesional_ins->institucion->slug])}}" target="_blank"> 
                                                    <i data-feather="external-link"></i>
                                                </a>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $cita->bg_estado }}">{{ $cita->estado }}</span>
                                    </td>
                                    {{-- <td>                                                                                                           --}}
                                    {{--     <button class="btn_editar_citas" type="submit" data-toggle="modal" data-target="#exampleModal1"></button>  --}}
                                    {{--     <button class="btn_cierre_citas" type="submit" data-toggle="modal" data-target="#exampleModal2"></button>  --}}
                                    {{-- </td>                                                                                                          --}}
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
            
        </div>
    </div>

    <!-- Pop-up  editar cita -->
    <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal_citas_popUp" role="document">
            <div class="modal-content content_modalCitas">
                <!-- Sección boton derecho de cierre "X" -->
                <div class="modal-header modal_headerCitas">
                    <h1 class="title_popup_miCita" id="exampleModalLabel">Editar cita</h1>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body modal_headerCitas">
                    <form method="POST" action="">
                        <!-- <div class="col-md-6 section_inputRight-text-formProf">
                            <label for="example-date-input" class="col-12 text_label-formProf">Especialidad</label>
                            <select name="idespecialidad" id="idespecialidad" class="col-lg-12 form-control" required></select>
                        </div> -->

                        <div class="col-md-6 p-0">
                            <label for="example-date-input" class="col-12 text_label-formProf">Estado</label>

                            <select id="nombreconsulta[]" class="form-control" name="nombreconsulta[]">
                                <option value="" selected> Seleccionar </option>
                                <option value="Presencial"> Confirmada </option>
                                <option value="Virtual"> Cancelada </option>
                            </select>
                        </div>

                        <div class="col-md-6 p-0">
                            <label for="example-date-input" class="col-12 text_label-formProf">Tipo consulta</label>

                            <select id="nombreconsulta[]" class="form-control" name="nombreconsulta[]">
                                <option value="" selected> Seleccionar </option>
                                <option value="Presencial"> Presencial </option>
                                <option value="Virtual"> Virtual </option>
                                <option value="Control médico"> Control Médico </option>
                            </select>
                        </div>

                        <div class="col-md-6 p-0">
                            <label for="example-date-input" class="col-12 text_label-formProf">Fecha</label>

                            <input class="form-control" type="date" value="2011-08-19" id="example-date-input" name="fechaestudio[]">
                        </div>

                        <div class="col-md-6 p-0">
                            <label for="example-date-input" class="col-12 text_label-formProf">Hora</label>

                            <input class="form-control" type="time" value="" id="example-date-input" name="fechaestudio[]">
                        </div>

                        <div class="col-md-6 p-0">
                            <label for="example-date-input" class="col-12 text_label-formProf">Ciudad</label>

                            <input class="col-12 form-control" id="" placeholder="" type="text" name="" required>
                        </div>

                        <div class="col-md-6 p-0">
                            <label for="example-date-input" class="col-12 text_label-formProf">Sede</label>

                            <input class="col-12 form-control" id="" placeholder="" type="text" name="" required>
                        </div>
                    </form>
                </div>

                <!-- Sección botón Pagar -->
                <div class="modal-footer section_btn_citas">
                    <button type="submit" class="btnAgendar-popup" id="">Guardar</button>

                    <button type="submit" class="btnCancelar-popup" id="">Cancelar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Pop-up cancelar cita -->
    <div class="modal fade modalA" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
        <div class="modal-dialog modal-lg modal_citas_popUp" role="document">
            <div class="modal-content content_citaCancela">
                <!-- Sección boton derecho de cierre "X" -->
                <div class="modal-header modal_cancelarCitas">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body modal_cancelarCitas">
                    <h1 class="title_cancelar_miCita" id="exampleModalLabel2">¿Está seguro de cancelar cita?</h1>
                </div>

                <!-- Sección botón Pagar -->
                <div class="modal-footer section_cancelar_citas">
                    <!-- Función onclick para mostrar el pop-up de cancelación y ocultar pop-up de opciones la cual esta implementada en admin.js -->
                    <button type="submit" class="btn_cancela-cita" id="" data-toggle="modal" data-target="#exampleModal3" onclick="elementClose(this)" data-position="cancelo">Sí, cancelar cita</button>

                    <button type="submit" class="btn_noCancela-cita" id="">No cancelar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Pop-up cancelar cita -->
    <div class="modal fade modalB" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel3" aria-hidden="true">
        <div class="modal-dialog modal-lg container_modal_cancelo" role="document">
            <div class="modal-content content_canceloCita">
                <!-- Sección boton derecho de cierre "X" -->
                <div class="modal-header modal_cancelarCitas">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body modal_cancelarCitas">
                    <h1 class="title_cancelar_miCita" id="exampleModalLabel3">Cita cancelada.</h1>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('plugins/DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('js/alertas.js') }}"></script>

    <script>
        //Inicializar tabla
        var table = $('#table-citas').DataTable({
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
            ]
        });

        $("#search").on('keyup change',function(){
            var texto = $(this).val();
            table.search(texto).draw();
        });
    </script>
@endsection
