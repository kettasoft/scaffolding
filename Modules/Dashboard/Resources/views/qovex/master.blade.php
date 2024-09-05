<!DOCTYPE html>
<html dir="{{ Locales::getDir() }}" lang="{{ app()->getLocale() }}">

<head>
    <title>{{ $title ? $title . ' | ' . app_name() : app_name() }}</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="{{ app_favicon() }}" type="image/x-icon" />

    <!-- for websocket -->
    <meta name="PUSHER_APP_KEY" content="{{ config('broadcasting.connections.pusher.key') }}">
    <meta name="PUSHER_APP_CLUSTER" content="{{ config('broadcasting.connections.pusher.options.cluster') }}">
    <meta name="PUSHER_APP_HOST" content="{{ config('broadcasting.connections.pusher.options.host') }}">
    <meta name="PUSHER_APP_PORT" content="{{ config('broadcasting.connections.pusher.options.port') }}">
    <meta name="PUSHER_APP_ENCRYPTED" content="{{ config('broadcasting.connections.pusher.options.useTLS') }}">

    <!-- styles -->

    @vite(['Modules/Dashboard/Resources/assets/js/qovex/qovex.js', 'Modules/Dashboard/Resources/assets/scss/qovex/qovex.scss'])

    @stack('css')

    @if (config('recaptcha.api_site_key'))
        {!! htmlScriptTagJsApi() !!}
    @endif
</head>

<body data-layout="detached" data-topbar="colored">
    @include('dashboard::qovex.components.base._loader')
    <!-- Begin page -->
    <div class="container-fluid">
        <div id="layout-wrapper">
            <header id="page-topbar">
                <div class="navbar-header">
                    <div class="container-fluid">
                        <div class="float-right">

                            {{-- languages --}}
                            @include('dashboard::qovex.components.base._languages')

                            {{-- full screen --}}
                            @include('dashboard::qovex.components.base._fullscreen')

                            {{-- notifications --}}
                            @include('dashboard::qovex.components.base._notifications')

                            {{-- admin info --}}
                            @include('dashboard::qovex.components.base._adminInfo')

                            {{-- side bar toggle --}}
                            @include('dashboard::qovex.components.base._sideBarToggle')
                        </div>
                        <div>
                            <!-- LOGO -->
                            @include('dashboard::qovex.components.base._logo')

                            {{-- mobile menu toggle --}}
                            @include('dashboard::qovex.components.base._mobileMenuToggle')

                            <!-- App Search-->
                            @include('dashboard::qovex.components.base._search')

                            <!-- Mega Menu-->
                            @include('dashboard::qovex.components.base._megaMenu')

                        </div>

                    </div>
                </div>
            </header>

            <!-- ========== Left Sidebar Start ========== -->
            <div class="vertical-menu">

                <div class="h-100">
                    {{-- admin user info --}}
                    @include('dashboard::qovex.components.base._sideBarAdminInfo')

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <!-- Left Menu Start -->
                        <ul class="metismenu list-unstyled" id="side-menu">
                            {{--                <li class="menu-title">Menu</li> --}}

                            @include('dashboard::sidebar')

                        </ul>
                    </div>
                    <!-- Sidebar -->
                </div>
            </div>
            <!-- Left Sidebar End -->
            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">
                <div class="page-content" id="vue">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="page-title mb-0 font-size-18">{{ $title }}</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        @isset($breadcrumbs)
                                            {{ Breadcrumbs::render(...$breadcrumbs) }}
                                        @endisset
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    {{ $slot }}
                </div>
                <!-- End Page-content -->
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6" style="direction: ltr">
                                {{ date('Y') }}
                                © {{ app_name() }}.
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
            <!-- end main content-->
        </div>
        <!-- END layout-wrapper -->
    </div>
    <!-- END container-fluid -->

    <!-- JAVASCRIPT -->
    @routes

    @stack('js')
</body>

</html>
