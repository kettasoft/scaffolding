<x-layout :title="trans('accounts::admins.plural')" :breadcrumbs="['dashboard.admins.index']">

    @include('accounts::admins.partials.filter')

    @component(layout('dashboard').'components.table-box')

        @slot('title', trans('accounts::admins.actions.list'))

        @slot('tools')
            @include('accounts::admins.partials.actions.create')
        @endslot

        <thead>
        <tr>
            <th>@lang('accounts::admins.attributes.name')</th>
            <th>@lang('accounts::admins.attributes.email')</th>
            <th>@lang('accounts::admins.attributes.phone')</th>
            <th>@lang('accounts::admins.attributes.verified')</th>
            <th>@lang('accounts::admins.attributes.created_at')</th>
            <th>...</th>
        </tr>
        </thead>

        <tbody>
        @forelse($admins as $admin)
            <tr>
                <td>
                    <a href="{{ route('dashboard.admins.show', $admin) }}"
                       class="text-decoration-none text-ellipsis">
                            <span class="index-flag">
                                @if($admin->blocked_at)
                                    @include('accounts::admins.partials.flags.blocked')
                                @else
                                    @include('accounts::admins.partials.flags.svg')
                                @endif
                            </span>
                        <img src="{{ $admin->getAvatar() }}"
                             alt="Product 1"
                             class="img-circle img-size-32 mr-2">
                        {{ $admin->name }}
                    </a>
                </td>
                <td>{{ $admin->email }}</td>
                <td>{{ $admin->phone }}</td>
                <td>@include('accounts::admins.partials.flags.verified')</td>
                <td>{{ $admin->created_at->format('Y-m-d') }}</td>

                <td>
                    @include('accounts::admins.partials.actions.show')
                    @include('accounts::admins.partials.actions.edit')
                    @include('accounts::admins.partials.actions.delete')
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="100" class="text-center">@lang('accounts::admins.empty')</td>
            </tr>
        @endforelse
        </tbody>

        @if($admins->hasPages())
            @slot('footer')
                {{ $admins->links() }}
            @endslot
        @endif

    @endcomponent

</x-layout>
