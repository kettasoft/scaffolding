<!DOCTYPE html>
<html dir="{{ Locales::getDir() }}" lang="{{ app()->getLocale() }}">
<head>
    <title>{{ $title ? $title .' | '. app_name() : app_name() }}</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="{{ app_favicon() }}" type="image/x-icon"/>

    <!-- sb -->
    @if(Locales::getDir() == 'rtl')
        <link rel="stylesheet" href="{{ asset(mix('css/sb.rtl.css')) }}">
    @else
        <link rel="stylesheet" href="{{ asset(mix('css/sb.css')) }}">
    @endif

    @stack('css')
</head>
<body class="page-top">
<div id="app">
    <div id="wrapper">

    @include('dashboard::sb.components.base.sidebar')

    <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

            @include('dashboard::sb.components.base.header')

            <!-- Begin Page Content -->
                <div class="container-fluid">
                    @include('flash::message')
                    {{ $slot }}

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
        @include('dashboard::sb.components.base.footer')
        <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
@include('dashboard::sb.components.base.toTop')

<!-- Logout Modal-->
    @include('dashboard::sb.components.base.logoutModal')
</div>
<!-- Scripts -->
<script src="{{ asset(mix('js/sb.js')) }}"></script>

@stack('js')
</body>
</html>
