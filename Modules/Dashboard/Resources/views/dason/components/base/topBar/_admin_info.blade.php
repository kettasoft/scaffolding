<div class="dropdown d-inline-block">
    <button type="button" class="btn header-item bg-soft-light border-start border-end" id="page-header-user-dropdown"
        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <img class="rounded-circle header-profile-user" src="{{ auth()->user()->getAvatar() }}" alt="Header Avatar">
        <span class="d-none d-xl-inline-block ms-1 fw-medium">{{ auth()->user()->name }}</span>
        <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
    </button>
    <div class="dropdown-menu dropdown-menu-end">
        <!-- item-->
        @php $route = 'dashboard.' . auth()->user()->type . 's.show' @endphp
        <a class="dropdown-item" href="{{ route($route, auth()->user()) }}">
            <i class="fi fi-br-user font-size-16 align-middle me-1"></i>
            @lang('accounts::admins.my_profile')
        </a>

        <div class="dropdown-divider"></div>
        <a class="dropdown-item text-danger" href="#"
            onclick="event.preventDefault();document.getElementById('logout-form').submit()">
            <i class="fi fi-br-power font-size-16 align-middle me-1 text-danger"></i>
            <span key="t-logout">
                @lang('admin.auth.logout')
            </span>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</div>
