<div class="vertical-menu">
    <div class="navbar-brand-box">
        <a href="{{ url('dashboard') }}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ URL::asset('/assets/images/logo-sm.png') }}" alt="" height="32">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('/assets/images/hospital.png') }}" alt="" height="45">
            </span>
        </a>

        <a href="{{ url('dashboard') }}" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ URL::asset('/assets/images/logo-sm.png') }}" alt="" height="32">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('/assets/images/hospital.png') }}" alt="" height="45">
            </span>
        </a>
    </div>

    <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect vertical-menu-btn">
        <i class="fa fa-fw fa-bars"></i>
    </button>

    <div data-simplebar class="sidebar-menu-scroll">

        <div id="sidebar-menu">
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>
                <li>
                    <a href="{{ url('dashboard') }}">
                        <i class="uil-home-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                @role('receptionist')
                    @include('layouts.menu.receptionist')
                @endrole

                @role('nurse')
                    @include('layouts.menu.nurse')
                @endrole

                @role('doctor')
                    @include('layouts.menu.doctor')
                @endrole

                @role('pharmacist')
                    @include('layouts.menu.pharmacist')
                @endrole
            </ul>
        </div>
    </div>
</div>
