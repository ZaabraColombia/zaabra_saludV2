@php
$user = Auth::user();
@endphp
<div class="active" id="sidebar">
    <div class="sidebar-wrapper active ps ps--active-y">
        <div class="sidebar-menu">
            <div class="sidebar__header">
                <img src="{{ asset($user->foto_perfil_institucion ?? 'img/menu/avatar.png') }}" alt="user.png">
                <div class="user_data">
                    <h2 style="color: #019F86">Dr.(a) {{ $user->nombre_completo }}</h2>
                    <h3>{{ $user->especialidad_pricipal->nombreEspecialidad ?? '' }}</h3>
                </div>
            </div>

            <ul class="menu">
                <!-- Calendario -->
                <li class="sidebar-item  has-sub items_green">
                    <a id="calendario" class="" href='{{ route('institucion.profesional.calendario.index') }}'>
                        <button class="{{ request()->routeIs('institucion.profesional.calendario.*') ? 'btn_active_inst' : '' }}">Calendario</button>
                    </a>
                </li>

                <!-- Citas -->
                <li class="sidebar-item has-sub items_green">
                    <a id="" href="{{ route('institucion.profesional.citas')}}">
                        <button class="{{ request()->routeIs('institucion.profesional.citas') ? 'btn_active_inst' : '' }}">Citas</button>
                    </a>
                </li>

                <!-- Catálogos -->
                <li class="sidebar-item has-sub items_green accordion" id="accordionExample">
                    <button id="headingOne" class="{{ request()->routeIs('institucion.profesional.catalogos.*') ? 'btn_active_inst' : '' }}" type="button" data-toggle="collapse"
                            data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                        Catálogos<i class="icon_angle fas fa-angle-down pl-2"></i>
                    </button>

                    <ul id="collapseOne" class="collapse sub_menu_green {{ request()->routeIs('institucion.profesional.catalogos.*') ? 'show' : '' }}"
                        aria-labelledby="headingOne" data-parent="#accordionExample">
                        <li class="submenu-item ">
                            <a id="cie10" class="{{ request()->routeIs('institucion.profesional.catalogos.cie10') ? 'txt_active_green' : '' }}"
                                href='{{ route('institucion.profesional.catalogos.cie10') }}'>Diagnósticos (CIE - 10)</a>
                        </li>
                        <li class="submenu-item ">
                            <a id="cups" class="{{ request()->routeIs('institucion.profesional.catalogos.cups') ? 'txt_active_green' : '' }}"
                                href='{{ route('institucion.profesional.catalogos.cups') }}'>Procedimientos (CUPS)</a>
                        </li>
                        <li class="submenu-item ">
                            <a id="cums" class="{{ request()->routeIs('institucion.profesional.catalogos.cums') ? 'txt_active_green' : '' }}"
                                href='{{ route("institucion.profesional.catalogos.cums") }}'>Vademecum actualizado COLOMBIA INVIMA (CUMS)</a>
                        </li>
                    </ul>
                </li>

                <!-- Logo Mipress -->
                <li class="sidebar-item  has-sub items_logos_green" style="width: 180px">
                    <a id="fav" class="" target="_blank" href="https://mipres.sispro.gov.co/MIPRESNOPBS/Login.aspx?ReturnUrl=%2fMIPRESNOPBS">
                        <button class="d-flex justify-content-start pl-3">
                            <img src="{{ asset('/img/agenda/panelPrincipal/profesionales/mipres-zaabra.png') }}" alt="" width="100px">
                        </button>
                    </a>
                </li>

                <!-- Logo Medihistoria -->
                <li class="sidebar-item  has-sub items_logos_green" style="width: 180px">
                    <a id="fav" class="" target="_blank" href="">
                        <button class="d-flex justify-content-start p-3">
                            <img src="{{ asset('/img/agenda/panelPrincipal/profesionales/logo_medhistoria_banner.png') }}" alt="" width="160px" height="27px">
                        </button>
                    </a>
                </li>

                <!-- Logo PLM -->
                <li class="sidebar-item  has-sub items_logos_green" style="width: 180px">
                    <a id="fav" class="" target="_blank" href="https://www.prescripciontotal.com.co/consultorio-generico/login">
                        <button class="d-flex justify-content-start pl-3">
                            <img src="{{ asset('/img/agenda/panelPrincipal/profesionales/plm.png') }}" alt="" width="100px">
                        </button>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>

@section('scripts')
<script>
</script>
@endsection



