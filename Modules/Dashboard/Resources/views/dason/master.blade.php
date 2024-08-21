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
    @if (Locales::getDir() === 'rtl')
        {{-- <link href="{{ asset(mix('css/dason.rtl.css'))}}" id="app-style" rel="stylesheet"/> --}}
    @else
        @vite(['Modules/Dashboard/Resources/assets/js/dason/dason.js', 'Modules/Dashboard/Resources/assets/scss/dason/dason.scss'])
        {{-- <link href="{{ asset(mix('css/dason.css')) }}" id="app-style" rel="stylesheet" /> --}}
    @endif

    @stack('css')

</head>

<body data-layout="horizontal" data-topbar="light">

    <!-- <body data-layout="horizontal"> -->

    <!-- Begin page -->
    <!-- Begin page -->
    <div id="vue">
        @include('dashboard::dason.components.base.topBar')
        {{-- @include('dashboard::dason.components.base.topBar._topnav') --}}
        {{-- @include('dashboard::dason.components.base.sidebar') --}}
        {{-- @include('dashboard::dason.components.base.sidebar') --}}
        @include('dashboard::dason.components.base._topBarSidebar')
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0 font-size-18">{{ $title }}</h4>

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
                    <!-- end page title -->
                    @include('flash::message')
                    {{ $slot }}
                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->
            @include('dashboard::dason.components.base.footer')
        </div>
        <!-- end main content-->
    </div>
    <!-- END layout-wrapper -->
    <!-- END wrapper -->

    {{-- right sidebar file here  --}}
    {{-- @include('layouts.right-sidebar') --}}

    @routes
    <!-- JAVASCRIPT -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/printThis/1.15.0/printThis.js"></script>

    @stack('js')
</body>

</html>
