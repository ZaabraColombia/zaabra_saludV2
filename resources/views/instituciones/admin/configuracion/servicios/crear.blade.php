@section('styles')
@endsection

@extends('instituciones.admin.layouts.layout')

@section('contenido')
    <div class="container-fluid p-0 pr-lg-4">
        <div class="containt_agendaProf">
            <div class="my-4 my-xl-5">
                <h1 class="title__xl green_bold">Nuevo Servicio</h1>
            </div>
        

            <div class="containt_main_table mb-3">
                <form action="" method="post" id="" enctype="">
                    <div class="d-block d-md-flex justify-content-end py-3">
                        <!-- Check box interactivo y personalizado -->
                        <div class="checkbox">
                            <input type="checkbox" name="checkbox" id="conv_check">
                            <label class="label_check" for="conv_check"> 
                                <b class="txt1">Servicio inactivo</b>
                                <b class="txt2">Servicio activo</b>
                            </label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 input__box">
                            <label for="duracion">Duración (minuto)</label>
                            <input type="number" id="duracion" name="duracion" value="{{ old('duracion') }}"
                                class="@error('duracion') is-invalid @enderror"/>
                        </div>

                        <div class="col-md-4 input__box">
                            <label for="descanso">Descanso (minuto)</label>
                            <input type="number" id="descanso" name="descanso" value="{{ old('descanso') }}"
                                class="@error('descanso') is-invalid @enderror"/>
                        </div>

                        <div class="col-md-4 input__box">
                            <label for="valor">Valor</label>
                            <input type="number" id="valor" name="valor" value="{{ old('valor') }}"
                                class="@error('valor') is-invalid @enderror"/>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 input__box">
                            <label for="nombre">Nombre</label>
                            <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}"
                                class="@error('nombre') is-invalid @enderror"/>
                        </div>

                        <div class="col-md-6 input__box">
                            <label for="especialidad">Especialidad</label>
                            <select class="@error('especialidad') is-invalid @enderror" id="especialidad"
                                    name="especialidad" value="{{ old('especialidad') }}">
                                <option value=""></option>
                                <option value="especialidad 1">especialidad 1</option>
                                <option value="especialidad 2">especialidad 2</option>
                                <option value="especialidad 3">especialidad 3</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 input__box">
                            <label for="descripcion">Descripción</label>
                            <textarea name="descripcion" id="descripcion" rows="5"></textarea>
                        </div>

                        <div class="col-12">
                            <div class="d-flex align-items-center mt-3">
                                <p class="fs_text_small black_light">Vincular convenios</p>
                                <input class="ml-4 mr-2" type="radio" name="radio" id="checkon">
                                <label class="fs_text_small black_light mb-0" for="si">Si</label>

                                <input class="ml-4 mr-2" type="radio" name="radio" id="checkoff">
                                <label class="fs_text_small black_light mb-0" for="no">No</label>
                            </div>
                        </div>
                    </div>

                    <!-- Contenedor formato tabla de la lista de contactos -->
                    <div id="table_servicio" class="containt_main_table my-3 d-none">
                        <div class="row m-0">
                            <div class="col-md-9 input__box">
                                <label for="convenio">Convenio</label>
                                <select class="@error('convenio') is-invalid @enderror" id="convenio"
                                        name="convenio" value="{{ old('convenio') }}">
                                    <option value=""></option>
                                    <option value="Convenio 1">Convenio 1</option>
                                    <option value="Convenio 2">Convenio 2</option>
                                    <option value="Convenio 3">Convenio 3</option>
                                </select>
                            </div>

                            <div class="col-md-3 p-0 pt-3 content_btn_right">
                                <a href="" class="button_green" id="">
                                    Agregar
                                </a>
                            </div>
                        </div>

                         <!-- Linea división de elementos -->
                        <div class="dropdown-divider mt-3 mb-5"></div>

                        <div class="table-responsive">
                            <table class="table table_agenda" id="">
                                <thead class="thead_green">
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Valor a pagar convenio</th>
                                        <th>Valor a pagar paciente</th>
                                        <th></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <td>Convenio 1</td>
                                        <td>
                                            <div class="input__box">
                                                <div class="signo_peso">
                                                    <span class="" id="">$</span>
                                                </div>
                                                <input type="number" id="valor" name="valor" value="{{ old('valor') }}"
                                                    class="@error('valor') @enderror"/>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input__box">
                                                <div class="signo_peso">
                                                    <span class="" id="">$</span>
                                                </div>
                                                <input type="number" id="valor" name="valor" value="{{ old('valor') }}"
                                                    class="@error('valor') @enderror"/>
                                            </div>
                                        </td>
                                        <td>
                                            <a class="btn_action_green tool top" style="width: 33px" href="">
                                                <i data-feather="trash-2"></i> 
                                                <span class="tiptext">eliminar convenio</span>
                                            </a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Convenio 2</td>
                                        <td>
                                            <div class="input__box">
                                                <div class="signo_peso">
                                                    <span class="" id="">$</span>
                                                </div>
                                                <input type="number" id="valor" name="valor" value="{{ old('valor') }}"
                                                    class="@error('valor') @enderror"/>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input__box">
                                                <div class="signo_peso">
                                                    <span class="" id="">$</span>
                                                </div>
                                                <input type="number" id="valor" name="valor" value="{{ old('valor') }}"
                                                    class="@error('valor') @enderror"/>
                                            </div>
                                        </td>
                                        <td>
                                            <a class="btn_action_green tool top" style="width: 33px"href="">
                                                <i data-feather="trash-2"></i> 
                                                <span class="tiptext">eliminar convenio</span>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // función para mostrar y ocultar la tabla de vincular convenios
        $(document).ready(function(){
            $("#checkon").click(function(){
                $("#table_servicio").removeClass('d-none');
                $("#table_servicio").addClass('d-block');
            });

            $("#checkoff").click(function(){
                $("#table_servicio").addClass('d-none');
                $("#table_servicio").removeClass('d-block');
            });
        });
    </script>
@endsection
