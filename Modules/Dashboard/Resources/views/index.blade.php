<x-layout :title="trans('dashboard::dashboard.home')" :breadcrumbs="['dashboard.home']">

    <div class="row">
        <div class="col-lg-12">
            <div class="card no-card-border gutter-b">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <h3 class="m-b-0">@lang('dashboard::dashboard.welcome')</h3>
                            @php
                                \Date::setLocale(app()->getLocale());
                                $of = trans('dashboard::dashboard.of');
                                $date = \Date::now()->format('l jS ' . $of .' F Y');
                            @endphp
                            <span>{{ $date }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-layout>

