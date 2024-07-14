<nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">

        <!-- Brand -->
        <div class="sidenav-header  d-flex  align-items-center">
            <a class="navbar-brand" href="{{ route('home') }}">

                <img src="{{ asset('dashboard/assets/img/daihatsu.png') }}" height="100" class="navbar-brand-img"
                    alt="...">
            </a>
            <div class=" ml-auto ">
                <!-- Sidenav toggler -->
                <div class="sidenav-toggler d-none d-xl-block" data-action="sidenav-unpin" data-target="#sidenav-main">
                    <div class="sidenav-toggler-inner">
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="navbar-inner">
            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                <!-- Nav items -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link @yield('active-dashboard')" href="{{ route('view-dashboard') }}">
                            <i class="ni ni-shop text-dark"></i>
                            <span class="nav-link-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @yield('active-profile')" href="{{ route('view-profile') }}">
                            <i class="ni ni-chart-bar-32 text-dark"></i>
                            <span class="nav-link-text">Profile</span>
                        </a>
                    </li>
                    @if(auth()->user()->role_id < 2 OR auth()->user()->role_id == 3)
                        <li class="nav-item">
                            <a class="nav-link @yield('active-laporan')" href="{{ route('add-laporan') }}">
                                <i class="fa fa-archive text-dark"></i>
                                <span class="nav-link-text">Laporan</span>
                            </a>
                        </li>
                    @endif
                        <li class="nav-item">
                            <a class="nav-link @yield('active-schedule')" href="{{ route('schedule.index') }}">
                                <i class="fa fa-calendar-alt text-dark"></i>
                                <span class="nav-link-text">Schedule Assesment</span>
                            </a>
                        </li>
                    <li class="nav-item">
                        <a class="nav-link @yield('active-assesment')" href="{{ route('view-assesment') }}">
                            <i class="fa fa-sign text-dark"></i>
                            <span class="nav-link-text">Assesment</span>
                        </a>
                    </li>

                    @if (auth()->user()->role_id == 3)
                        <li class="nav-item">
                            <a class="nav-link @yield('active-ums')" href="#navbar-ums" data-toggle="collapse"
                                role="button" aria-expanded="@yield('expanded-ums')" aria-controls="navbar-ums">
                                <i class="ni ni-single-02 text-dark"></i>
                                <span class="nav-link-text">User Management</span>
                            </a>
                            <div class="collapse @yield('show-ums')" id="navbar-ums">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item @yield('show-ums-users')">
                                        <a href="{{ route('view-ums-users') }}" class="nav-link">
                                            <span class="sidenav-mini-icon"> U </span>
                                            <span class="sidenav-normal"> Users </span>
                                        </a>
                                    </li>
                                    <li class="nav-item @yield('show-ums-role')">
                                        <a href="{{ route('view-ums-role') }}" class="nav-link">
                                            <span class="sidenav-mini-icon"> R </span>
                                            <span class="sidenav-normal"> Roles </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    @else
                    @endif
                </ul>
            </div>
        </div>
    </div>
</nav>
