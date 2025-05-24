<div class="left-side-menu">
    <div class="h-100" data-simplebar>
        <div class="user-box text-center">
            <img src="https://cdn-icons-png.flaticon.com/512/847/847969.png" alt="user-img" title="User"
                class="rounded-circle avatar-md">
            <div class="dropdown">
                <a href="javascript: void(0);" class="dropdown-toggle h5 mt-2 mb-1 d-block" data-bs-toggle="dropdown">
                    {{ Auth::user()->full_name }}
                </a>
                <div class="dropdown-menu user-pro-dropdown">
                    <a href="{{ route('profile.edit') }}" class="dropdown-item notify-item">
                        <i data-feather="settings" class="icon-dual icon-xs me-1"></i>
                        <span>Pengaturan Akun</span>
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item notify-item">
                            <i data-feather="log-out" class="icon-dual icon-xs me-1"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </div>
            <p class="text-muted">Admin</p>
        </div>

        <div id="sidebar-menu">
            <ul class="side-menu">

                <li>
                    <a href="{{ route('dashboard') }}">
                        <i data-feather="activity"></i>
                        <span> Dashboard </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('hangout.index') }}">
                        <i data-feather="map"></i>
                        <span> Data Hangout </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('visitor.index') }}">
                        <i data-feather="users"></i>
                        <span> Visitor </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('users.index') }}">
                        <i data-feather="shield"></i>
                        <span> Users Admin </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('profile.edit') }}">
                        <i data-feather="settings"></i>
                        <span> Pengaturan Akun </span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="clearfix"></div>
    </div>
</div>
