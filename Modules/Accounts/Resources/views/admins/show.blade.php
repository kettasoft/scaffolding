<x-layout :title="$admin->name" :breadcrumbs="['dashboard.admins.show', $admin]">

    @component(layout('dashboard').'components.box')
        @slot('bodyClass', 'p-0')

        <table class="table table-middle">
            <tbody>
            <tr>
                <th width="200">@lang('accounts::admins.attributes.name')</th>
                <td>{{ $admin->name }}</td>
            </tr>
            <tr>
                <th width="200">@lang('accounts::admins.attributes.email')</th>
                <td>{{ $admin->email }}</td>
            </tr>
            <tr>
                <th width="200">@lang('accounts::admins.attributes.phone')</th>
                <td>{{ $admin->phone }}</td>
            </tr>
            <tr>
                <th width="200">@lang('accounts::admins.attributes.preferred_locale')</th>
                <td>{{ $admin->preferred_locale == 'ar' ? 'العربية' : 'English' }}</td>
            </tr>
            <tr>
                <th width="200">@lang('accounts::admins.attributes.avatar')</th>
                <td>
                    <div class="d-flex align-items-center">
                        <div class="symbol symbol-70 symbol-sm flex-shrink-0">
                            @if($admin->getFirstMedia('avatars'))
                                <file-preview :media="{{ $admin->getMediaResource('avatars') }}"></file-preview>
                            @else
                                <img src="{{ $admin->getAvatar() }}"
                                     class=""
                                     alt="{{ $admin->name }}">
                            @endif
                        </div>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>

        @slot('footer')
            @include('accounts::admins.partials.actions.edit')
            @include('accounts::admins.partials.actions.delete')
            {{--                @include('accounts::admins.partials.actions.block')--}}
        @endslot
    @endcomponent

</x-layout>
