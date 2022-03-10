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
                        <button>Menu</button>
                    </a>
                </li>

                <li class="sidebar-item  has-sub">
                    <a id="pago" href='{{ route('paciente.pagos') }}'>
                        <button>Mis citas</button>
                    </a>
                </li>

                <li class="sidebar-item  has-sub">
                    <a id="pacientes" href='{{ route('paciente.pacientes') }}'>
                        <button>Mis pagos</button>
                    </a>
                </li>

                <li class="sidebar-item  has-sub">
                    <a id="contactos" href='{{ route('paciente.contactos.index') }}'>
                        <button>Actualizar datos</button>
                    </a>
                </li>

                <li class="sidebar-item  has-sub">
                    <a id="fav" href='{{ route('paciente.favoritos') }}'>
                        <button>Mis profesionales</button>
                    </a>
                </li>

                <li class="sidebar-item  has-sub">
                    <a id="fav" href='{{ route('paciente.favoritos') }}'>
                        <button>Mis favoritos</button>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
