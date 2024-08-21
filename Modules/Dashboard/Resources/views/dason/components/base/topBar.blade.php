<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            @include('dashboard::dason.components.base.topBar._logo')

            @include('dashboard::dason.components.base.topBar._collapse')

            <!-- App Search-->
            @include('dashboard::dason.components.base.topBar._search')
        </div>

        <div class="d-flex">
            {{--            @include('dashboard::dason.components.base.topBar._search_mobile')--}}

            @include('dashboard::dason.components.base.topBar._language')

            @if (auth()->user()->hasPermission('read_messenger'))
                @include('dashboard::dason.components.base.topBar._messages')
            @endif

            @include('dashboard::dason.components.base.topBar._notification')

            {{--            @include('dashboard::dason.components.base.topBar._right_sidebar')--}}

            @include('dashboard::dason.components.base.topBar._admin_info')

        </div>
    </div>
</header>
