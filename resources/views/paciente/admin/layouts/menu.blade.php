@php
$user = Auth::user();
@endphp
<div id="sidebar" class="active">
    <div class="sidebar-wrapper active ps ps--active-y">
        <div class="sidebar-menu">
            <div class="sidebar__header">
                <img src="{{ asset($user->profecional->fotoperfil ?? 'img/menu/avatar.png') }}" alt="user.png">
                <div class="user_data">
                    <h2>Alejandra de Santa María</h2>
                </div>
            </div>

            <ul class="menu">
                <li class="sidebar-item  has-sub">
                    <a id="menu_panel" href="{{ route('profesional.panel') }}">
                        <button>Menu</button>
                    </a>
                </li>

                <li class="sidebar-item  has-sub">
                    <a id="pago" class="" href='{{ route('profesional.pagos') }}'>
                        <button>Mis citas</button>
                    </a>
                </li>

                <li class="sidebar-item  has-sub">
                    <a id="pacientes" class="" href='{{ route('profesional.pacientes') }}'>
                        <button>Mis pagos</button>
                    </a>
                </li>

                <li class="sidebar-item  has-sub">
                    <a id="contactos" class="" href='{{ route('profesional.contactos.index') }}'>
                        <button>Actualizar datos</button>
                    </a>
                </li>

                <li class="sidebar-item  has-sub">
                    <a id="fav" class="" href='{{ route('profesional.favoritos') }}'>
                        <button>Mis profesionales</button>
                    </a>
                </li>

                <li class="sidebar-item  has-sub">
                    <a id="fav" class="" href='{{ route('profesional.favoritos') }}'>
                        <button>Mis favoritos</button>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
