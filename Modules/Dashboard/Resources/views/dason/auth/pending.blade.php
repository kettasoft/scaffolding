<!DOCTYPE html>
<html dir="{{ Locales::getDir() }}" lang="{{ app()->getLocale() }}">
<head>
    <title> @lang('admin.auth.login.title') : {{ app_name() }}</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="{{ app_favicon() }}" type="image/x-icon"/>

    <!-- styles -->
    @if(Locales::getDir() === 'rtl')
        <link href="{{ asset(mix('css/dason.rtl.css'))}}" id="app-style" rel="stylesheet"/>
    @else
        <link href="{{ asset(mix('css/dason.css'))}}" id="app-style" rel="stylesheet"/>
    @endif

    <style>
        .login-bg {
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
            display: none
        }

        form {
            max-width: 400px;
            margin: auto
        }

        body {
            height: 100vh;
        }
    </style>

    @stack('css')
</head>
<body>

<div id="vue">
    <div class="auth-page">
        <div class="container-fluid p-0">
            <div class="row g-0">

                <div class="col-xxl-6 col-lg-6 col-md-12">
                    <div class="auth-full-page-content d-flex p-sm-5 p-4">
                        <div class="w-100">
                            <div class="d-flex flex-column h-100">
                                <div class="mb-4 mb-md-5 text-center">
                                    <a href="{{ route('home') }}" class="d-block auth-logo">
                                        <img src="{{ app_login_logo() }}" alt="{{ app_name() }}" height="70">
                                        <span
                                            class="d-block logo-txt mt-3">{{ app_name() }}</span>
                                    </a>
                                </div>
                                <div class="auth-content my-auto">
                                    {{-- Form title --}}
                                    <div class="text-center">
                                        <h2 class="mb-4">Request Pending Review</h2>
                                        <p class="mb-1">Thank you for your submission!</p>
                                        <p>Your request is currently pending review by our administrative team.</p>
                                        <img src="{{ asset('images/backgrounds/pending.svg') }}" alt="">

                                        <form action="{{ route('logout') }}" method="post" class="mt-5">
                                            @csrf
                                            <button class="btn btn-secondary w-100" type="submit">Back to Home</button>
                                        </form>
                                    </div>
                                    {{-- Form --}}

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end auth full page content -->
                </div>
                <div class="login-bg col-xxl-6 col-lg-6 col-md-5 d-lg-block"
                     style="background-image: url({{app_login_background()}})"></div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container fluid -->
    </div>
</div>
@routes
<!-- JAVASCRIPT -->
<script src="{{ asset('js/dason.js')}}"></script>

@stack('js')
</body>
</html>
