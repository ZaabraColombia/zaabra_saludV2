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
        <!-- Carrusel de opciones -->
        <div class="swiper-container swiper_gestion">
            <div class="swiper-wrapper">
                <li class="swiper-slide">
                    <a id="serv" class="btn_inact_slider" data-index="0">
                        Ver convenio con saldo por pagar
                    </a>
                </li>
                <li class="swiper-slide">
                    <a id="serv" class="btn_inact_slider" data-index="1">
                        Ver convenio con todo el movimiento
                    </a>
                </li>
                <li class="swiper-slide">
                    <a id="serv" class="btn_inact_slider" data-index="2">
                        Ver los convenios con todos los movimientos
                    </a>
                </li>
                <li class="swiper-slide">
                    <a id="serv" class="btn_inact_slider" data-index="3">
                        Gestión de recaudado
                    </a>
                </li>
                <li class="swiper-slide">
                    <a id="serv" class="btn_inact_slider" data-index="4">
                        Cartera convenios por cobrar
                    </a>
                </li>
                <li class="swiper-slide">
                    <a id="serv" class="btn_inact_slider btn__activ" data-index="5">
                        Ventas por convenios y pacientes
                    </a>
                </li>
                <li class="swiper-slide">
                    <a id="serv" class="btn_inact_slider" data-index="6">
                        Informes de ventas por servicio
                    </a>
                </li>
                <li class="swiper-slide">
                    <a id="serv" class="btn_inact_slider" data-index="7">
                        Informe de ventas por especialidades
                    </a>
                </li>
                <li class="swiper-slide">
                    <a id="serv" class="btn_inact_slider" data-index="8">
                        Informe de ventas comparativos agrupados
                    </a>
                </li>
                <li class="swiper-slide">
                    <a id="serv" class="btn_inact_slider" data-index="9">
                        Informe de ventas por tipo de pago
                    </a>
                </li>
                <li class="swiper-slide">
                    <a id="serv" class="btn_inact_slider" data-index="10">
                        Número de citas por servicio
                    </a>
                </li>
                <li class="swiper-slide">
                    <a id="serv" class="btn_inact_slider" data-index="11">
                        Número de citas por especialidades
                    </a>
                </li>
                <li class="swiper-slide">
                    <a id="serv" class="btn_inact_slider" data-index="12">
                        Número de citas por profesional
                    </a>
                </li>
            </div>
            <!-- If we need navigation buttons -->
            <div class="swiper-button-prev btnPrev_pag_slider"></div>
            <div class="swiper-button-next btnNext_pag_slider"></div> 
        </div>
        <!-- panel body -->
        <div class="panel_body">
            <div class="pt-4 mb-3">
                <h2 class="text-center text-lg-left mt-2 h2_fs23_bold green_two">Búsqueda</h2>
            </div>
            <!-- form -->
            <div class="mb-4 pt-lg-2">
                <form action="" method="" id="">
                    @csrf
                    <div class="row m-0">
                        <!-- Inputs -->
                        <div class="col-lg-3 mb-3 px-4 pl-lg-0">
                            <label class="label__fs20_bold black_bold" for="fecha-iicio">Fecha de inicio</label>
                            <input class="input__text" id="fecha-iicio" type="date">
                        </div>
                        <div class="col-lg-3 mb-3 px-4 pl-lg-0">
                            <label class="label__fs20_bold black_bold" for="fecha-fin">Fecha final</label>
                            <input class="input__text" id="fecha-fin" type="date">
                        </div>
                        <div class="col-lg-3 mb-3 px-4 pl-lg-0">
                            <label class="label__fs20_bold black_bold" for="identificacion">Identificación</label>
                            <select class="input__text" id="identificacion" name="">
                                <option value=""></option>
                                <option value="identificación 1">identificación 1</option>
                                <option value="identificación 2">identificación 2</option>
                            </select>
                        </div>
                        <!-- Button search -->
                        <div class="col-lg-3 mb-3 btn__down_search_sm">
                            <button type="submit" class="bg_green_two">Buscar</button>
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
                                        <h4 class="h4_card_fs18_bold black_bolder">Nombre de convenio</h4>
                                        <h4 class="h4_card_fs16_reg black_bolder">Bogotá</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 pr-lg-0 d-flex flex-column justify-content-center">
                                <div>
                                    <span class="h4_card_fs16_reg black_bolder">Dirección:</span>
                                    <span class="h4_card_fs16_reg black_bolder">Carrera 30 # 0 - 00</span>
                                </div>
                                <div>
                                    <span class="h4_card_fs16_reg black_bolder">Teléfono:</span>
                                    <span class="h4_card_fs16_reg black_bolder">+57 313 000 00 00</span>
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
                    <button type="submit" class="bg_green_two" style="width: 84px">Exportar</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('plugins/chartJs/chart.min.js') }}"></script>

    <script>
        var ctx = document.getElementById("myChart");
        var myChart = new Chart(ctx, {
            type: 'doughnut',
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
            },
            options: {
                // circumference: 100 * Math.PI
                // scales: {
                //     yAxes: [{
                //         ticks: {
                //             beginAtZero:true
                //         }
                //     }]
                // }
            }
        });
    </script>

    <script>
        // Función para el slider de la línea de opciones de la landing page instituciones
        const swiper_gestion = new Swiper(".swiper_gestion", {
        //loop: false,
    
        // autoplay: {
        // delay: 4500,
        // disableOnInteraction: false,
        // },

        autoHeight: true,
    
        // If we need pagination
        pagination: {
        el: '.swiper-pagination',
        },

        // Navigation arrows
        navigation: {
        nextEl: '.btnNext_pag_slider',
        prevEl: '.btnPrev_pag_slider',
        },
    
        breakpoints: {
        // when window width is >= 320px
        320: {
            slidesPerView: 1,
            slidesPerGroup: 1,
            spaceBetween: 30,
        },

        // when window width is >= 700px
        700: {
            slidesPerView: 2,
            slidesPerGroup: 1,
        },

        // when window width is >= 1024px
        1024: {
            //enabled: false,
            slidesPerView: 3,
            slidesPerGroup: 1,
            spaceBetween: 5,
        },
        // when window width is >= 1920px
        1600: {
            //enabled: false,
            slidesPerView: 4,
            slidesPerGroup: 1,
        },
        }
        });
    </script>
    <!-- Ocultar y mostrar los filtros por (documento, rango, servicio y especialidad) -->
    <script>
        $(document).ready(function(){
            $("#document").click(function(){
                $("#filtroDoc").removeClass('d-none').addClass('d-block');
                $("#filtroRang").removeClass('d-block').addClass('d-none');
                $("#filtroServ").removeClass('d-block').addClass('d-none');
                $("#filtroEspe").removeClass('d-block').addClass('d-none');
            });

            $("#rango").click(function(){
                $("#filtroRang").removeClass('d-none').addClass('d-block');
                $("#filtroDoc").removeClass('d-block').addClass('d-none');
                $("#filtroServ").removeClass('d-block').addClass('d-none');
                $("#filtroEspe").removeClass('d-block').addClass('d-none');
            });

            $("#servicio").click(function(){
                $("#filtroServ").removeClass('d-none').addClass('d-block');
                $("#filtroDoc").removeClass('d-block').addClass('d-none');
                $("#filtroRang").removeClass('d-block').addClass('d-none');
                $("#filtroEspe").removeClass('d-block').addClass('d-none');
            });

            $("#especialidad").click(function(){
                $("#filtroEspe").removeClass('d-none').addClass('d-block');
                $("#filtroServ").removeClass('d-block').addClass('d-none');
                $("#filtroDoc").removeClass('d-block').addClass('d-none');
                $("#filtroRang").removeClass('d-block').addClass('d-none');
            });
        });
    </script>
@endsection