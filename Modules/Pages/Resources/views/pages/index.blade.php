<x-layout :title="trans('pages::pages.plural')" :breadcrumbs="['dashboard.pages.index']">

    @include('pages::pages.partials.filter')

    @component(layout('dashboard').'components.table-box')
        @slot('title', trans('pages::pages.actions.list'))
        @slot('tools')
            @include('pages::pages.partials.actions.create')
        @endslot

        <thead>
        <tr>
            <th>@lang('pages::pages.attributes.title')</th>
            <th class="d-none d-md-table-cell">@lang('pages::pages.attributes.link')</th>
            <th style="width: 160px">...</th>
        </tr>
        </thead>
        <tbody>
        @forelse($pages as $page)
            <tr>
                <td>
                    <a href="{{ route('dashboard.pages.show', $page) }}"
                       class="text-decoration-none text-ellipsis">
                        {{ $page->title }}
                    </a>
                </td>
                <td class="d-none d-md-table-cell">
                    {{ $page->link }}
                </td>

                <td style="width: 160px">
                    @include('pages::pages.partials.actions.show')
                    @include('pages::pages.partials.actions.edit')
                    @include('pages::pages.partials.actions.delete')
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="100" class="text-center">@lang('pages::pages.empty')</td>
            </tr>
        @endforelse
        </tbody>

        @if($pages->hasPages())
            @slot('footer')
                {{ $pages->links() }}
            @endslot
        @endif
    @endcomponent

</x-layout>>
