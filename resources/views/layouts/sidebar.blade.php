@section('sidebar')
<div class="app-sidebar sidebar-shadow">
    <div class="app-header__logo">
        <div class="logo-src"></div>
        <div class="header__pane ml-auto">
            <div>
                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic"
                    data-class="closed-sidebar">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <div class="app-header__mobile-menu">
        <div>
            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
        </div>
    </div>
    <div class="app-header__menu">
        <span>
            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                <span class="btn-icon-wrapper">
                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                </span>
            </button>
        </span>
    </div>
    <div class="scrollbar-sidebar">
        <div class="app-sidebar__inner">
            <ul class="vertical-nav-menu">
                @if(Auth::user()->level == 'admin')
                    <li class="app-sidebar__heading">Beranda</li>
                    <li>
                        <a href="{{ route('dashboard') }}"
                            class="{{ (request()->is('admin/dashboard*')) ? 'mm-active' : '' }}">
                            <i class="metismenu-icon pe-7s-rocket"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="app-sidebar__heading">Manajemen</li>
                    <li
                        class="{{ (request()->is('admin/users*')) ? 'mm-active' : '' }}">
                        <a href="#"
                            {{ (request()->is('admin/users*')) ? 'aria-expanded="true"' : 'aria-expanded="false"' }}>
                            <i class="metismenu-icon pe-7s-users"></i>
                            Manajemen Pengguna
                            <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                        </a>
                        <ul
                            {{ (request()->is('admin/users/list')) ? 'mm-show' : '' }}>
                            <li>
                                <a href="{{ route('list_users') }}">
                                    <i class="metismenu-icon"></i>
                                    Daftar Pengguna
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li
                        class="{{ (request()->is('admin/guest*')) ? 'mm-active' : '' }}">
                        <a href="#"
                            {{ (request()->is('admin/guest*')) ? 'aria-expanded="true"' : 'aria-expanded="false"' }}>
                            <i class="metismenu-icon pe-7s-users"></i>
                            Manajemen Tamu
                            <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                        </a>
                        <ul
                            {{ (request()->is('admin/guest/list')) ? 'mm-show' : '' }}>
                            <li>
                                <a href="{{route('guestShow')}}">
                                    <i class="metismenu-icon"></i>
                                    Daftar Tamu
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                {{-- @if(Auth::user()->level == 'sekolah')
                    <li class="app-sidebar__heading">Beranda</li>
                    <li>
                        <a href="{{ route('dashboard_sekolah') }}"
                            class="{{ (request()->is('sekolah/dashboard*')) ? 'mm-active' : '' }}">
                            <i class="metismenu-icon pe-7s-rocket"></i>
                            Beranda
                        </a>
                    </li>
                @endif --}}
            </ul>

        </div>
    </div>
</div>
