<div class="navbar-custom">
    <div class="container-fluid">
        <ul class="list-unstyled topnav-menu float-end mb-0">

            <li class="dropdown notification-list topbar-dropdown">
                <a class="nav-link dropdown-toggle nav-user me-0" data-bs-toggle="dropdown" href="#" role="button"
                    aria-haspopup="false" aria-expanded="false">
                    <img src="https://cdn-icons-png.flaticon.com/512/847/847969.png" alt="user-image"
                        class="rounded-circle">
                    <span class="pro-user-name d-sm-inline d-none ms-1">
                        {{ Auth::user()->full_name }}
                        <i class="uil uil-angle-down"></i>
                    </span>
                </a>

                <!-- Dropdown Menu di Navbar -->
                <div class="dropdown-menu dropdown-menu-end profile-dropdown">
                    <div class="dropdown-header noti-title">
                        <h6 class="text-overflow m-0">Welcome!</h6>
                    </div>

                    <div class="dropdown-divider"></div>

                    <!-- Logout Form -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item notify-item">
                            <i data-feather="log-out" class="icon-dual icon-xs me-1"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>

            </li>

            <li class="dropdown notification-list">
                <button class="nav-link" data-bs-toggle="offcanvas" data-bs-target="#theme-settings-offcanvas"
                    type="button">
                    <i class="mdi mdi-cog-outline font-22"></i>
                    <i data-feather="settings"></i>
                </button>
            </li>

        </ul>

        <!-- LOGO -->
        <div class="logo-box">
            <a href="index.html" class="logo logo-dark">
                <span class="logo-sm">
                    <img src="{{ asset('template/frontend/img/logo/logo-hangout.png') }}"" alt=""
                        height="24">
                </span>
                <span class="logo-lg">
                    <img src="{{ asset('template/frontend/img/logo/logo-hangout.png') }}"" alt=""
                        height="24">
                </span>
            </a>

            <a href="index.html" class="logo logo-light">
                <span class="logo-sm">
                    <img src="{{ asset('template/frontend/img/logo/logo-hangout.png') }}"" alt=""
                        height="24">
                </span>
                <span class="logo-lg">
                    <img src="{{ asset('template/frontend/img/logo/logo-hangout.png') }}"" alt=""
                        height="24">
                </span>
            </a>
        </div>

        <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
            <li>
                <button class="button-menu-mobile">
                    <i data-feather="menu"></i>
                </button>
            </li>

            <li>
                <a class="navbar-toggle nav-link" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                    <div class="lines">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </a>
            </li>
        </ul>

        <div class="clearfix"></div>
    </div>
</div>
