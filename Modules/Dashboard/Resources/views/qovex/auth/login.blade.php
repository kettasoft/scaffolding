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
    @vite(['Modules/Dashboard/Resources/assets/js/qovex/qovex.js', 'Modules/Dashboard/Resources/assets/scss/qovex/qovex.scss'])

    @stack('css')
</head>

<body>

    <div id="vue">
        <div class="home-btn d-none d-sm-block">
            <a href="{{ route('home') }}" class="text-dark"><i class="fas fa-home h2"></i></a>
        </div>
        <div class="account-pages my-5 pt-sm-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card overflow-hidden">
                            <div class="bg-login text-center"
                                style="background-image: url({{ app_login_background() }});">
                                <div class="bg-login-overlay"></div>
                                <div class="position-relative">
                                    <h5 class="text-white font-size-20">@lang('admin.auth.login.title')</h5>
                                    <p class="text-white-50 mb-0">@lang('admin.auth.login.info').</p>
                                    <a href="{{ route('home') }}" class="logo logo-dark mt-4">
                                        <img src="{{ app_login_logo() }}" alt="" height="50">
                                    </a>
                                </div>
                            </div>
                            <div class="card-body pt-5">
                                <div class="p-2">
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="form-group">
                                            <label for="username">@lang('admin.auth.login.email')</label>
                                            <input id="email" type="email"
                                                class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                                name="email" required autocomplete="email"
                                                placeholder="@lang('admin.auth.login.email')" autofocus>
                                            @if ($errors->has('email'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label for="password">@lang('admin.auth.login.password')</label>
                                            <input id="password" type="password" placeholder="@lang('admin.auth.login.password')"
                                                class="form-control  {{ $errors->has('password') ? ' is-invalid' : '' }}"
                                                name="password" required autocomplete="current-password">
                                            @if ($errors->has('password'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="custom-control custom-checkbox">
                                            <div class="d-flex justify-content-between">
                                                <div class="">
                                                    <input type="checkbox" class="custom-control-input" name="remember"
                                                        id="customControlInline"
                                                        {{ old('remember') ? 'checked' : '' }}>
                                                    <label class="custom-control-label"
                                                        for="customControlInline">@lang('admin.auth.login.remember')</label>
                                                </div>
                                                {{-- <div class="">
                                                    <a href="{{ route('password.request') }}">Forgot password ?</a>
                                                </div> --}}
                                            </div>
                                        </div>

                                        <div class="mt-3">
                                            <button class="btn btn-primary btn-block " id="login"
                                                type="submit">@lang('admin.auth.login.submit')</button>
                                        </div>

                                        <div class="mt-4 text-center">
                                            <a href="{{ route('password.request') }}" class="text-muted"><i
                                                    class="mdi mdi-lock mr-1"></i>
                                                {{ __('Forgot Your Password?') }}</a>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    @stack('js')
</body>

</html>
