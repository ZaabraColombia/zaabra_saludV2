@extends('instituciones.admin.layouts.layout')
@section('styles')
@endsection
@section('contenido')
    <div id="container_gestion" class="container-fluid panel_container">
        <!-- panel head -->
        <div class="panel_head">
            <!-- Main title -->
            <h1 class="title green_two">Gestión</h1>
            <!-- Toolbar -->
            <div class="row m-0">
                <!-- Document action buttons  -->
                <div class="col-md-4 ml-md-auto col-lg-auto btns__export_doc_green">
                    <div class="toolTip bottom">
                        <button class="file_excel"></button>
                        <span class="toolText">Exportar excel</span>
                    </div>
                    <div class="toolTip bottom">
                        <button class="file_pdf"></button>
                        <span class="toolText">Exportar PDF</span>
                    </div>
                    <div class="toolTip bottom">
                        <button class="file_printer"></button>
                        <span class="toolText">Imprimir</span>
                    </div>
                </div>
            </div>
        </div>

        @include('instituciones.admin.gestion.botones-opciones')
        
        <!-- panel body -->
        <div class="panel_body">
            <div class="pt-4 mb-3">
                <h2 class="text-center text-lg-left mt-2 h2_fs23_bold green_two">Búsqueda</h2>
            </div>
            <!-- Check radio -->
            <div class="row m-0 pb-lg-1">
                <div class="col-lg-6 p-0">
                    <div class="row m-0">
                        <div id="document" class="col-lg-3 pl-lg-0 input_check_radio">
                            <input class="" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                            <label class="input_text_check" for="exampleRadios1">Documento</label>
                        </div>

                        <div id="rango" class="col-lg-3 pl-lg-0 input_check_radio">
                            <input class="" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
                            <label class="input_text_check" for="exampleRadios2">Rango de fecha</label>
                        </div>

                        <div id="servicio" class="col-lg-3 pl-lg-0 input_check_radio">
                            <input class="" type="radio" name="exampleRadios" id="exampleRadios3" value="option3">
                            <label class="input_text_check" for="exampleRadios3">Servicios</label>
                        </div>

                        <div id="especialidad" class="col-lg-3 pl-lg-0 input_check_radio">
                            <input class="" type="radio" name="exampleRadios" id="exampleRadios4" value="option4">
                            <label class="input_text_check" for="exampleRadios4">Especialidades</label>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Reporte check DOCUMENTO -->     
            <div id="filtroDoc" class="mb-4 pt-lg-2">
                <!-- form -->
                <form action="" method="" id="">
                    @csrf
                    <div class="row m-0 mt-4">
                        <!-- Inputs -->
                        <div class="col-lg-4 mb-3 px-4 pl-lg-0">
                            <label class="label_fs20_bold black_bold" for="tip_doc">Seleccione tipo de documento</label>
                            <select class="input__text" id="tip_doc" name="">
                                <option value="Cédula de ciudadanía">Cédula de ciudadanía</option>
                                <option value="NIT">NIT</option>
                                <option value="Otro documento">Otro documento</option>
                            </select>
                        </div>
                        <div class="col-lg-4 mb-3 px-4 pl-lg-0">
                            <label class="label_fs20_bold black_bold" for="num_doc">Número de documento</label>
                            <input class="input__text" id="num_doc" type="text">
                        </div>
                        <!-- Button search -->
                        <div class="col-lg-4 mb-3 btn__down_search_sm">
                            <button type="submit" class="bg_greenOne">Buscar</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- Reporte check RANGO DE FECHA -->     
            <div id="filtroRang" class="mb-4 pt-lg-2 d-none">
                <!-- form -->
                <form action="" method="" id="">
                    @csrf
                    <div class="row m-0 mt-4">
                        <!-- Inputs -->
                        <div class="col-lg-4 mb-3 px-4 pl-lg-0">
                            <label class="label_fs20_bold black_bold" for="fecha-iicio">Fecha de inicio</label>
                            <input class="input__text" id="fecha-iicio" type="date">
                        </div>
                        <div class="col-lg-4 mb-3 px-4 pl-lg-0">
                            <label class="label_fs20_bold black_bold" for="fecha-fin">Fecha final</label>
                            <input class="input__text" id="fecha-fin" type="date">
                        </div>
                        <!-- Button search -->
                        <div class="col-lg-4 mb-3 btn__down_search_sm">
                            <button type="submit" class="bg_greenOne">Buscar</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- Reporte check SERVICIOS -->     
            <div id="filtroServ" class="mb-4 pt-lg-2 d-none">
                <!-- form -->
                <form action="" method="" id="">
                    @csrf
                    <div class="row m-0 mt-4">
                        <!-- Inputs -->
                        <div class="col-lg-8 mb-3 px-4 pl-lg-0">
                            <label class="label_fs20_bold black_bold" for="tip_doc">Servicios</label>
                            <select class="input__text" id="tip_doc" name="">
                                <option value="Servicio">Servicio</option>
                                <option value="Otro servicio">Otro servicio</option>
                            </select>
                        </div>
                        <!-- Button search -->
                        <div class="col-lg-4 mb-3 btn__down_search_sm">
                            <button type="submit" class="bg_greenOne">Buscar</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- Reporte check ESPECIALIDAD -->     
            <div id="filtroEspe" class="mb-4 pt-lg-2 d-none">
                <!-- form -->
                <form action="" method="" id="">
                    @csrf
                    <div class="row m-0 mt-4">
                        <!-- Inputs -->
                        <div class="col-lg-8 mb-3 px-4 pl-lg-0">
                            <label class="label_fs20_bold black_bold" for="tip_doc">Especialidad</label>
                            <select class="input__text" id="tip_doc" name="">
                                <option value="Especialidad">Especialidad</option>
                                <option value="Otro especialidad">Otro especialidad</option>
                            </select>
                        </div>
                        <!-- Button search -->
                        <div class="col-lg-4 mb-3 btn__down_search_sm">
                            <button type="submit" class="bg_greenOne">Buscar</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- Graphics and Table -->
            <div class="row m-0 cuadro_resultado">
                <!-- Graphics -->
                <div class="col-lg-6 pr-lg-0 mb-5 mb-lg-0">
                    <div class="table_resultado">
                        <canvas id="myChart" height="190"></canvas>
                    </div>
                </div>
                <!-- User and table -->
                <div class="col-lg-6 pl-lg-0">
                    <div class="table_resultado">
                        <!-- User -->
                        <div class="row pb-lg-1">
                            <div class="col-md-6">
                                <div class="row align-items-center">
                                    <div class="col-3 pr-lg-0">
                                        <img class="" src='/img/menu/avatar.png' style="width: 53px">
                                    </div>
                                    <div class="col-9 pl-lg-2 pr-lg-0">
                                        <h4 class="h4_fs18_bold black_bolder">Nombre de convenio</h4>
                                        <h4 class="h4_fs16_reg black_bolder">Bogotá</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 pr-lg-0 d-flex flex-column justify-content-center">
                                <div>
                                    <span class="h4_fs16_reg black_bolder">Dirección:</span>
                                    <span class="h4_fs16_reg black_bolder">Carrera 30 # 0 - 00</span>
                                </div>
                                <div>
                                    <span class="h4_fs16_reg black_bolder">Teléfono:</span>
                                    <span class="h4_fs16_reg black_bolder">+57 313 000 00 00</span>
                                </div>
                            </div>
                        </div>
                        <!-- Table -->
                        <div class="table-responsive mt-lg-4 tab_gestion_green">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th scope="col">Fecha</th>
                                        <th scope="col">Concepto</th>
                                        <th scope="col">Saldo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>16/05/2022</td>
                                        <td>Consulta primera vez</td>
                                        <td>90.000</td>
                                    </tr>
                                    <tr>
                                        <td>10/04/2022</td>
                                        <td>Consulta general</td>
                                        <td>120.000</td>
                                    </tr>
                                    <tr>
                                        <td>06/03/2022</td>
                                        <td>Control</td>
                                        <td>60.000</td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td scope="col">Total</td>
                                        <td></td>
                                        <td>270.000</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Button search -->
                <div class="col-12 mt-4 justify-content-center btn__down_search_sm">
                    <button type="submit" class="bg_greenOne" style="width: 84px">Exportar</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('plugins/chartJs/chart.min.js') }}"></script>
    <!-- Ruta archivo js de funcionalidades en las opciones modulo GESTIÓN -->
    <script src="{{ asset('js/slider-gestion.js') }}"></script>
    
    <!-- Plugin para los gráficos -->
    <script>
        var ctx = document.getElementById("myChart");
        var myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
                datasets: [{
                    label: 'Ejemplo de gráfico',
                    data: [12, 19, 3, 5, 2, 3],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 2
                }]
            }
            // options: {
            //     scales: {
            //         yAxes: [{
            //             ticks: {
            //                 beginAtZero:true
            //             }
            //         }]
            //     }
            // }
        });
    </script>
@endsection