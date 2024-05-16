<x-layout :title="trans('accounts::parents.plural')" :breadcrumbs="['dashboard.parents.index']">

    @include('accounts::parents.partials.filter')

    @component(layout('dashboard') . 'components.table-box')

        @slot('title', trans('accounts::parents.actions.list'))

        @slot('tools')
            @include('accounts::parents.partials.actions.create')
        @endslot

        <thead>
            <tr>
                <th>@lang('accounts::parents.attributes.name')</th>
                <th class="d-none d-md-table-cell">@lang('accounts::parents.attributes.email')</th>
                <th>@lang('accounts::parents.attributes.phone')</th>
                <th>@lang('accounts::parents.attributes.verified')</th>
                <th>@lang('accounts::parents.attributes.created_at')</th>
                <th style="width: 160px">...</th>
            </tr>
        </thead>
        <tbody>
            @forelse($parents as $parent)
                <tr>
                    <td>
                        <a href="{{ route('dashboard.parents.show', $parent) }}" class="text-decoration-none">
                            <div class="d-flex align-items-center">
                                <div class="symbol symbol-30 symbol-circle symbol-xl-30">
                                    <div class="symbol-label" style="background-image:url({{ $parent->getAvatar() }})">
                                    </div>
                                    <i class="symbol-badge symbol-badge-bottom bg-success"></i>
                                    @if ($parent->blocked_at)
                                        @include('accounts::parents.partials.flags.blocked')
                                    @else
                                        @include('accounts::parents.partials.flags.svg')
                                    @endif
                                </div>
                                <div class="ml-4">
                                    <div class="text-dark-75  mb-0">
                                        {{ $parent->name }}
                                    </div>
                                </div>
                            </div>
                        </a>
                    </td>

                    <td class="d-none d-md-table-cell">
                        {{ $parent->email }}
                    </td>
                    <td>{{ $parent->phone }}</td>
                    <td>@include('accounts::parents.partials.flags.verified')</td>
                    <td>{{ $parent->created_at->format('Y-m-d') }}</td>

                    <td style="width: 160px">
                        @include('accounts::parents.partials.actions.show')
                        @include('accounts::parents.partials.actions.edit')
                        @include('accounts::parents.partials.actions.delete')
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="100" class="text-center">@lang('accounts::parents.empty')</td>
                </tr>
            @endforelse
        </tbody>

        @if ($parents->hasPages())
            @slot('footer')
                {{ $parents->links() }}
            @endslot
        @endif
    @endcomponent

</x-layout>
