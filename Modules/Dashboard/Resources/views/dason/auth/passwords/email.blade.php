<!DOCTYPE html>
<html dir="{{ Locales::getDir() }}" lang="{{ app()->getLocale() }}">

<head>
    <title> @lang('admin.auth.login.title') : {{ app_name() }}</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="{{ app_favicon() }}" type="image/x-icon" />

    <!-- styles -->
    @if (Locales::getDir() === 'rtl')
        <link href="{{ asset(mix('css/dason.rtl.css')) }}" id="app-style" rel="stylesheet" />
    @else
        <link href="{{ asset(mix('css/dason.css')) }}" id="app-style" rel="stylesheet" />
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
                                            <span class="d-block logo-txt mt-3">{{ app_name() }}</span>
                                        </a>
                                    </div>
                                    <div class="auth-content my-auto">
                                        {{-- Form title --}}
                                        <div class="text-center">
                                            <h3 class="mb-0">@lang('admin.auth.forget.title')</h3>
                                            <p class="text-muted mt-2">@lang('admin.auth.login.info')</p>
                                        </div>
                                        {{-- Form --}}
                                        <form class="forget-form text-center" action="{{ route('password.email') }}"
                                            method="post">
                                            @csrf
                                            @if ($errors->has('email'))
                                                <div class="alert alert-danger">{{ $errors->first('email') }}</div>
                                            @elseif(session('status'))
                                            <div class="alert alert-success">
                                                    {{ session('status') }}
                                                </div>
                                            @else
                                                <div class="alert alert-primary">
                                                    @lang('admin.auth.forget.info')
                                                </div>
                                            @endif
                                            <div class="form-floating form-floating-custom mb-4">
                                                <input type="email" id="email" name="email"
                                                    value="{{ old('email') }}" placeholder="@lang('admin.auth.forget.email')"
                                                    required="required" autocomplete="email" autofocus="autofocus"
                                                    class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}">
                                                <label for="email">Email</label>
                                                <div class="form-floating-icon">
                                                    <i data-feather="mail"></i>
                                                </div>
                                            </div>
                                            <div class="mb-5">
                                                <button class="btn btn-secondary w-100" type="submit">
                                                    @lang('admin.auth.forget.submit')
                                                </button>
                                            </div>
                                            <div class="form-group mt-3">
                                                <p class="semibold-text mb-0">
                                                    <a href="{{ route('login') }}" data-toggle="flip">
                                                        {{-- <i class="fa fa-angle-left fa-fw mr-2"></i> --}}
                                                        {{-- Remember It ? <a href="{{ route('login') }}" class="text-primary">Login</a> --}}
                                                        @lang('admin.auth.login.title')
                                                    </a>
                                                </p>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end auth full page content -->
                    </div>
                    <div class="login-bg col-xxl-6 col-lg-6 col-md-5 d-lg-block"
                        style="background-image: url({{ app_login_background() }})"></div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container fluid -->
        </div>
    </div>

    <!-- JAVASCRIPT -->
    <script src="{{ asset('js/dason.js') }}"></script>

    @stack('js')
</body>

</html>
