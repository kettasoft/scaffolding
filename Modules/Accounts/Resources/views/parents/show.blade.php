<x-layout :title="$parent->name" :breadcrumbs="['dashboard.parents.show', $parent]">

    <div class="row">
        <div class="col col-12 col-sm-12 col-md-7 col-lg-7">
            @component(layout('dashboard') . 'components.box')
                @slot('bodyClass', 'p-0')
                <table class="table table-middle">
                    <tbody>
                        <tr>
                            <th width="200">@lang('accounts::parents.attributes.name')</th>
                            <td>{{ $parent->name }}</td>
                        </tr>
                        <tr>
                            <th width="200">@lang('accounts::parents.attributes.email')</th>
                            <td>{{ $parent->email ?? '----' }}</td>
                        </tr>
                        <tr>
                            <th width="200">@lang('accounts::parents.attributes.phone')</th>
                            <td>{{ $parent->phone }}</td>
                        </tr>
                        <tr>
                            <th width="200">@lang('accounts::parents.attributes.created_at')</th>
                            <td>{{ $parent->created_at->format('Y-m-d h:i A') }}</td>
                        </tr>
                        <tr>
                            <th width="200">@lang('accounts::parents.attributes.verified')</th>
                            <td>@include('accounts::parents.partials.flags.verified')</td>
                        </tr>
                        <tr>
                            <th width="200">@lang('accounts::parents.attributes.verified_at')</th>
                            <td>@include('accounts::parents.partials.flags.verified_at')</td>
                        </tr>
                        <tr>
                            <th width="200">@lang('accounts::parents.attributes.last_login_at')</th>
                            <td>{{ $parent->last_login_at ? $parent->last_login_at->format('Y-m-d h:i A') : '...' }}</td>
                        </tr>
                        <tr>
                            <th width="200">@lang('accounts::parents.attributes.preferred_locale')</th>
                            <td>{{ $parent->preferred_locale == 'ar' ? 'العربية' : 'English' }}</td>
                        </tr>
                        <tr>
                            <th width="200">@lang('accounts::parents.attributes.avatar')</th>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-70 symbol-sm flex-shrink-0">
                                        @if ($parent->getFirstMedia('avatars'))
                                            <file-preview
                                                :media="{{ $parent->getMediaResource('avatars') }}"></file-preview>
                                        @else
                                            <img src="{{ $parent->getAvatar() }}" class="" alt="{{ $parent->name }}">
                                        @endif
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>

                @slot('footer')
                    @include('accounts::parents.partials.actions.edit')
                    @include('accounts::parents.partials.actions.delete')
                    @include('accounts::parents.partials.actions.block')
                @endslot
            @endcomponent
        </div>

        <div class="col col-12 col-sm-12 col-md-5 col-lg-5">
            @component(layout('dashboard') . 'components.box')
                <div class="card">
                    <div class="card-header">
                        <h3>Children</h3>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Special title treatment</h5>
                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            @endcomponent
        </div>
    </div>

</x-layout>>
