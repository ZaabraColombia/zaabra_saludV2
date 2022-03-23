@php
$user = Auth::user();
@endphp
<div id="sidebar" class="active">
    <div class="sidebar-wrapper active ps ps--active-y">
        <div class="sidebar-menu">
            <div class="sidebar__header">
                <img src="{{ asset($user->paciente->foto ?? 'img/menu/avatar.png') }}" alt="user.png">
                <div class="user_data">
                    <h2>{{ $user->nombre_completo }}</h2>
                </div>
            </div>

            <ul class="menu">
                <li class="sidebar-item  has-sub">
                    <a id="menu_panel" href="{{ route('paciente.panel') }}">
                        <button class="{{ request()->routeIs('paciente.panel') ? 'btn_active' : '' }}">Menú</button>
                    </a>
                </li>

                <li class="sidebar-item  has-sub">
                    <a id="fav" href='{{ route('paciente.profesionales') }}'>
                        <button class="{{ request()->routeIs('paciente.profesionales') ? 'btn_active' : '' }}">Mis profesionales</button>
                    </a>
                </li>

                <li class="sidebar-item  has-sub">
                    <a id="contactos" href='{{ route('paciente.perfil') }}'>
                        <button class="{{ request()->routeIs('paciente.perfil') ? 'btn_active' : '' }}">Actualizar datos</button>
                    </a>
                </li>

                <li class="sidebar-item  has-sub">
                    <a id="pago" href='{{ route('paciente.citas') }}'>
                        <button class="{{ request()->routeIs('paciente.citas') ? 'btn_active' : '' }}">Mis citas</button>
                    </a>
                </li>

                <li class="sidebar-item  has-sub">
                    <a id="pacientes" href='{{ route('paciente.pagos') }}'>
                        <button class="{{ request()->routeIs('paciente.pagos') ? 'btn_active' : '' }}">Mis pagos</button>
                    </a>
                </li>

                <li class="sidebar-item  has-sub">
                    <a id="fav" href='{{ route('paciente.favoritos') }}'>
                        <button class="{{ request()->routeIs('paciente.favoritos') ? 'btn_active' : '' }}">Mis favoritos</button>
                    </a>
                </li>

                <li class="sidebar-item  has-sub">
                    <a id="fav" href='{{ route('paciente.contactos.index') }}'>
                        <button class="{{ request()->routeIs('paciente.contactos') ? 'btn_active' : '' }}">Mis contactos</button>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
