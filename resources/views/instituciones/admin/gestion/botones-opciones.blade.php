
<!-- Carrusel de opciones -->
<div class="swiper-container swiper_gestion">
    <div class="swiper-wrapper">
        <li class="swiper-slide">
            <a id="serv" href="{{ route('institucion.gestion.primer-reporte') }}" class="btn_inact_slider {{ request()->routeIs('institucion.gestion.primer-reporte') ? 'btn__activ' : '' }}" data-index="0">
                Ver convenio con saldo por pagar
            </a>
        </li>

        <li class="swiper-slide">
            <a id="serv" href="{{ route('institucion.gestion.segundo-reporte') }}" class="btn_inact_slider {{ request()->routeIs('institucion.gestion.segundo-reporte') ? 'btn__activ' : '' }}" data-index="1">
                Ver convenio con todo el movimiento
            </a>
        </li>

        <li class="swiper-slide">
            <a id="serv" href="{{ route('institucion.gestion.tercer-reporte') }}" class="btn_inact_slider {{ request()->routeIs('institucion.gestion.tercer-reporte') ? 'btn__activ' : '' }}" data-index="2">
                Ver los convenios con todos los movimientos
            </a>
        </li>

        <li class="swiper-slide">
            <a id="serv" href="{{ route('institucion.gestion.cuarto-reporte' )}}" class="btn_inact_slider {{ request()->routeIs('institucion.gestion.cuarto-reporte') ? 'btn__activ' : '' }}" data-index="3">
                Gestión de recaudado
            </a>
        </li>

        <li class="swiper-slide">
            <a id="serv" href="{{ route('institucion.gestion.quinto-reporte') }}" class="btn_inact_slider {{ request()->routeIs('institucion.gestion.quinto-reporte') ? 'btn__activ' : '' }}" data-index="4">
                Cartera convenios por cobrar
            </a>
        </li>

        <li class="swiper-slide">
            <a id="serv" href="{{ route('institucion.gestion.sexto-reporte') }}" class="btn_inact_slider {{ request()->routeIs('institucion.gestion.sexto-reporte') ? 'btn__activ' : '' }}" data-index="5">
                Ventas por convenios y pacientes
            </a>
        </li>

        <li class="swiper-slide">
            <a id="serv" href="{{ route('institucion.gestion.septimo-reporte') }}" class="btn_inact_slider {{ request()->routeIs('institucion.gestion.septimo-reporte') ? 'btn__activ' : '' }}" data-index="6">
                Informe de ventas por servicio
            </a>
        </li>

        <li class="swiper-slide">
            <a id="serv" href="{{ route('institucion.gestion.octavo-reporte') }}" class="btn_inact_slider {{ request()->routeIs('institucion.gestion.octavo-reporte') ? 'btn__activ' : '' }}" data-index="7">
                Informe de ventas por especialidades
            </a>
        </li>

        <li class="swiper-slide">
            <a id="serv" href="{{ route('institucion.gestion.noveno-reporte') }}" class="btn_inact_slider {{ request()->routeIs('institucion.gestion.noveno-reporte') ? 'btn__activ' : '' }}" data-index="8">
                Informes de ventas comparativos agrupados
            </a>
        </li>

        <li class="swiper-slide">
            <a id="serv" href="{{ route('institucion.gestion.decimo-reporte') }}" class="btn_inact_slider {{ request()->routeIs('institucion.gestion.decimo-reporte') ? 'btn__activ' : '' }}" data-index="9">
                Informe de ventas por tipo de pago
            </a>
        </li>

        <li class="swiper-slide">
            <a id="serv" href="{{ route('institucion.gestion.undecimo-reporte') }}" class="btn_inact_slider {{ request()->routeIs('institucion.gestion.undecimo-reporte') ? 'btn__activ' : '' }}" data-index="10">
                Número de citas por servicio
            </a>
        </li>

        <li class="swiper-slide">
            <a id="serv" href="{{ route('institucion.gestion.duodecimo-reporte') }}" class="btn_inact_slider {{ request()->routeIs('institucion.gestion.duodecimo-reporte') ? 'btn__activ' : '' }}" data-index="11">
                Número de citas por especialidades
            </a>
        </li>

        <li class="swiper-slide">
            <a id="serv" href="{{ route('institucion.gestion.decimotercero-reporte') }}" class="btn_inact_slider {{ request()->routeIs('institucion.gestion.decimotercero-reporte') ? 'btn__activ' : '' }}" data-index="12">
                Número de citas por profesional
            </a>
        </li>
    </div>
    <!-- If we need navigation buttons -->
    <div class="swiper-button-prev btnPrev_pag_slider"></div>
    <div class="swiper-button-next btnNext_pag_slider"></div> 
</div>