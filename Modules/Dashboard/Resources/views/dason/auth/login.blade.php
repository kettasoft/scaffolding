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

        .login-submit {
            background: linear-gradient(0deg, #F7971E -0.01%, #FFD200 99.99%);
            -webkit-text-fill-color: transparent;
            -webkit-background-clip: text;
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
                                        {{-- <span class="d-block logo-txt mt-3">{{ app_name() }}</span> --}}
                                    </a>
                                </div>
                                <div class="auth-content my-auto">
                                    {{-- Form title --}}
                                    <div class="text-center">
                                        <h5 class="mb-0">@lang('admin.auth.login.title')</h5>
                                        <p class="text-muted mt-2">@lang('admin.auth.login.info')</p>
                                    </div>
                                    {{-- Form --}}
                                    <form class="mt-4 pt-2" action="{{ route('login') }}" method="POST">
                                        @csrf
                                        {{-- Email field --}}
                                        <div class="form-floating form-floating-custom mb-4">
                                            <input type="email"
                                                   class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                                   id="email"
                                                   name="email"
                                                   placeholder="@lang('admin.auth.login.email')"
                                                   required
                                                   autocomplete="off"
                                                   autofocus>
                                            <label for="email">@lang('admin.auth.login.email')</label>
                                            <div class="form-floating-icon">
                                                <i data-feather="users"></i>
                                            </div>
                                            @if($errors->has('email'))
                                                <span class="invalid-feedback" role="alert">
                                                             <strong>{{ $errors->first('email') }}</strong>
                                                        </span>
                                            @endif
                                        </div>

                                        {{-- Password field --}}
                                        <div
                                            class="form-floating form-floating-custom mb-3 auth-pass-inputgroup">
                                            <input type="password"
                                                   class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}"
                                                   id="password-input"
                                                   name="password"
                                                   placeholder="@lang('admin.auth.login.password')"
                                                   required
                                                   autocomplete="current-password">
                                            <button type="button"
                                                    class="btn btn-link position-absolute h-100 end-0 top-0"
                                                    id="password-addon">
                                                <i class="mdi mdi-eye-outline font-size-18 text-muted"></i>
                                            </button>
                                            <label for="password-input">@lang('admin.auth.login.password')</label>
                                            <div class="form-floating-icon">
                                                <i data-feather="lock"></i>
                                            </div>
                                            @if($errors->has('password'))
                                                <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('password') }}</strong>
                                                        </span>
                                            @endif
                                        </div>

                                        {{-- Remember me checkbox --}}
                                        <div class="row mb-4">
                                            <div class="col d-flex justify-content-between">
                                                <div class="form-check font-size-15">
                                                    <input class="form-check-input" type="checkbox"
                                                           {{ old('remember') ? 'checked' : '' }} name="remember"
                                                           id="remember-check">
                                                    <label class="form-check-label font-size-13" for="remember-check">
                                                        @lang('admin.auth.login.remember')
                                                    </label>
                                                </div>
                                                <div class="font-size-13">
                                                    <a href="{{ route('password.request') }}" class="login-submit">Forgot
                                                        Password</a>
                                                </div>
                                            </div>

                                        </div>

                                        {{-- Submit button --}}
                                        <div class="mb-5">
                                            <button style="background: linear-gradient(0deg, #F7971E -0.01%, #FFD200 99.99%);" class="btn text-light border-0 w-100 waves-effect waves-light"
                                                    type="submit">@lang('admin.auth.login.submit')
                                            </button>
                                        </div>

                                        <div class="mb-0 text-center">
                                            @lang('accounts::auth.attributes.dont_have_account') <a
                                                href="{{ route('register') }}"
                                                class="fw-bold login-submit">@lang('accounts::auth.attributes.signup')</a>
                                        </div>
                                    </form>
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
