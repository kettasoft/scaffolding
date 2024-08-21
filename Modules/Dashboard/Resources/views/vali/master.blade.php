<!DOCTYPE html>
<html dir="{{ Locales::getDir() }}" lang="{{ app()->getLocale() }}">

<head>
    <title>{{ $title ? $title . ' | ' . app_name() : app_name() }}</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="PUSHER_APP_KEY" content="{{ config('broadcasting.connections.pusher.key') }}">
    <meta name="PUSHER_APP_CLUSTER" content="{{ config('broadcasting.connections.pusher.options.cluster') }}">
    <meta name="PUSHER_APP_HOST" content="{{ config('broadcasting.connections.pusher.options.host') }}">
    <meta name="PUSHER_APP_PORT" content="{{ config('broadcasting.connections.pusher.options.port') }}">
    <meta name="PUSHER_APP_ENCRYPTED" content="{{ config('broadcasting.connections.pusher.options.useTLS') }}">

    <link rel="icon" href="{{ app_favicon() }}" type="image/x-icon" />

    <!-- Vali -->
    @if (Locales::getDir() == 'rtl')
        @vite(['Modules/Dashboard/Resources/assets/js/vali/vali.js', 'Modules/Dashboard/Resources/assets/scss/vali/vali.rtl.scss'])
    @else
        @vite(['Modules/Dashboard/Resources/assets/js/vali/vali.js', 'Modules/Dashboard/Resources/assets/scss/vali/vali.scss'])
    @endif

    @stack('styles')
</head>

<body class="app sidebar-mini">
    <div id="app">
        <!-- Navbar-->
        <header class="app-header">
            <a class="app-header__logo" href="{{ url('/') }}" target="_blank">
                <img src="{{ app_logo() }}" alt="{{ app_name() }}" height="30">
            </a>
            <!-- Sidebar toggle button-->
            <a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
            <!-- Navbar Right Menu-->
            <ul class="app-nav">
                @impersonating
                    <li class="dropdown">
                        <a class="app-nav__item text-decoration-none" href="{{ route('impersonate.leave') }}"
                            aria-expanded="true">
                            <span class="d-none d-md-inline">
                                @lang('users.impersonate.leave')
                            </span>
                        </a>
                    </li>
                @endImpersonating

                <!-- Language Menu-->
                <li class="dropdown">
                    <a class="app-nav__item text-decoration-none" href="#" data-toggle="dropdown"
                        aria-label="Open Profile Menu">
                        <img src="{{ Locales::getFlag() }}" alt="">
                        <span class="d-none d-md-inline">
                            {{ Locales::getName() }}
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right p-0">
                        @foreach (Locales::get() as $locale)
                            <a href="{{ route('dashboard.locale', $locale->code) }}"
                                class="dropdown-item {{ app()->getLocale() == $locale->code ? 'active' : '' }}">
                                <img src="{{ $locale->flag }}" alt="">
                                {{ $locale->name }}
                            </a>
                        @endforeach
                    </div>
                </li>
                <!--Notification Menu-->
                {{--            <vali-notification-dropdown></vali-notification-dropdown> --}}
                <!-- User Menu-->
                <li class="dropdown">
                    <a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu">
                        <i class="fa fa-user fa-lg"></i>
                    </a>
                    <ul class="dropdown-menu settings-menu dropdown-menu-right">
                        <li>
                            <a class="dropdown-item" href="{{ auth()->user()->dashboardProfile() }}">
                                <i class="fi fi-br-user mr-2"></i>
                                @lang('accounts::admins.my_profile')
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#"
                                onclick="event.preventDefault();document.getElementById('logoutForm').submit()">
                                <i class="fi fi-br-power mr-2"></i>
                                @lang('admin.auth.logout')
                            </a>
                            <form style="display: none;" action="{{ route('logout') }}" method="post" id="logoutForm">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </header>
        <!-- Sidebar menu-->
        <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
        <aside class="app-sidebar">
            <div class="app-sidebar__user">
                <a href="{{ auth()->user()->dashboardProfile() }}">
                    <img class="app-sidebar__user-avatar" src="{{ auth()->user()->getFirstMediaUrl('avatars') }}"
                        alt="{{ auth()->user()->name }}">
                </a>
                <div>
                    <p class="app-sidebar__user-name">
                        <a class="text-white" href="{{ auth()->user()->dashboardProfile() }}">
                            {{ auth()->user()->name }}
                        </a>
                    </p>
                    <p class="app-sidebar__user-designation">
                        <a class="text-white" href="{{ auth()->user()->dashboardProfile() }}">
                            {{ auth()->user()->email }}
                        </a>
                    </p>
                </div>
            </div>
            <ul class="app-menu">
                @include('dashboard::sidebar')
            </ul>
        </aside>
        <main class="app-content">
            <div class="app-title">
                <div>
                    <h1>{{ $title }}</h1>
                </div>
                @isset($breadcrumbs)
                    {{ Breadcrumbs::render(...$breadcrumbs) }}
                @endisset
            </div>
            @include('flash::message')
            {{ $slot }}
        </main>
    </div>
    <!-- Scripts -->
    <script src="{{ asset(mix('js/vali.js')) }}"></script>

    @stack('scripts')
</body>

</html>
