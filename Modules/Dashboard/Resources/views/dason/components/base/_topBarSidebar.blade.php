<div class="topnav">
    <div class="container-fluid">
        {{-- <vue-custom-scrollbar :settings="{
            suppressScrollY: true,
            suppressScrollX: false,
            wheelPropagation: false,
        }"> --}}
            <nav class="navbar navbar-light navbar-expand-lg topnav-menu">

                <div class="collapse navbar-collapse" id="topnav-menu-content">
                    <ul class="navbar-nav flex-wrap">

                        @include('dashboard::sidebar')

                    </ul>
                </div>
            </nav>
        {{-- </vue-custom-scrollbar> --}}
    </div>
</div>
