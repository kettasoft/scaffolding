<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Search -->
    {{--    <form --}}
    {{--        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search"> --}}
    {{--        <div class="input-group"> --}}
    {{--            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." --}}
    {{--                   aria-label="Search" aria-describedby="basic-addon2"> --}}
    {{--            <div class="input-group-append"> --}}
    {{--                <button class="btn btn-primary" type="button"> --}}
    {{--                    <i class="fas fa-search fa-sm"></i> --}}
    {{--                </button> --}}
    {{--            </div> --}}
    {{--        </div> --}}
    {{--    </form> --}}

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        <!-- Nav Item - languages -->

        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <img class="" src="{{ Locales::getFlag() }}" alt="Header Language" height="16">
            </a>
            <!-- Dropdown - Alerts -->
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="alertsDropdown" style="width: 10rem!important">
                @foreach (Locales::get() as $locale)
                    <a class="dropdown-item d-flex align-items-center"
                        href="{{ route('dashboard.locale', $locale->code) }}">
                        <div class="mr-3">
                            <img src="{{ $locale->flag }}" alt="user-image" class="mr-1" height="12">
                        </div>
                        <div>
                            <span class="font-weight-bold">{{ $locale->name }}</span>
                        </div>
                    </a>
                @endforeach
            </div>
        </li>

        <!-- divider -->
        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ auth()->user()->name }}</span>
                <img class="img-profile rounded-circle" src="{{ auth()->user()->getAvatar() }}">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="{{ route('dashboard.admins.show', auth()->user()) }}">
                    <i class="fi fi-br-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    @lang('accounts::admins.my_profile')
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fi fi-br-power fa-sm fa-fw mr-2 text-gray-400"></i>
                    @lang('admin.auth.logout')
                </a>
            </div>
        </li>

    </ul>

</nav>
<!-- End of Topbar -->
