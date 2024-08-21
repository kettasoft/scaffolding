<div class="topnav">
    <div class="container-fluid">
        <nav class="navbar navbar-light navbar-expand-lg topnav-menu">

            <div class="collapse navbar-collapse" id="topnav-menu-content">
                <ul class="navbar-nav">
                    @component(layout('dashboard') . 'components.sidebarItem')
                        @slot('url', route('dashboard.home'))
                        @slot('name', trans('dashboard::dashboard.home'))
                        @slot('icon', 'fas fa-layer-group')
                        @slot('isActive', request()->routeIs('dashboard.home'))
                    @endcomponent
                    @if (\Module::collections()->has('Accounts'))
                        @include('accounts::sidebar')
                    @endif
                    @if (\Module::collections()->has('Quotations'))
                        @include('quotations::sidebar')
                    @endif
                    @if (\Module::collections()->has('Categories'))
                        @include('categories::sidebar')
                    @endif
                    @if (\Module::collections()->has('Specializations'))
                        @include('specializations::sidebar')
                    @endif
                    @if (\Module::collections()->has('Countries'))
                        @include('countries::sidebar')
                    @endif
                    @if (\Module::collections()->has('PackageType'))
                        @include('packageType::sidebar')
                    @endif
                    @if (\Module::collections()->has('ProductType'))
                        @include('productType::sidebar')
                    @endif
                    @if (\Module::collections()->has('Products'))
                        @include('products::sidebar')
                    @endif
                    @if (\Module::collections()->has('PaymentMethods'))
                        @include('paymentMethods::sidebar')
                    @endif
                    @if (\Module::collections()->has('Articles'))
                        @include('articles::sidebar')
                    @endif
                    @if (\Module::collections()->has('Pages'))
                        @include('pages::sidebar')
                    @endif
                    @if (\Module::collections()->has('Settings'))
                        @include('settings::sidebar')
                    @endif
                </ul>
            </div>
        </nav>
    </div>
</div>
