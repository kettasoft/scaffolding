<x-layout :title="trans('posts::posts.plural')" :breadcrumbs="['dashboard.posts.index']">

    @include('posts::posts.partials.filter')

    @component(layout('dashboard') . 'components.table-box')
        @slot('title', trans('posts::posts.actions.list'))
        @slot('tools')
            @include('posts::posts.partials.actions.create')
        @endslot

        <thead>
            <tr>
                <th>@lang('posts::posts.attributes.title')</th>
                <th>@lang('posts::posts.attributes.auther')</th>
                <th style="width: 160px">...</th>
            </tr>
        </thead>
        <tbody>
            @forelse($posts as $post)
                <tr>
                    <td>
                        <a href="{{ route('dashboard.posts.show', $post) }}" class="text-decoration-none text-ellipsis">
                            {{ Illuminate\Support\Str::limit($post->title, $limit = 50, $end = '...') }}
                        </a>
                    </td>
                    <td>
                        <a href="{{ $post->user->dashboardProfile() }}" class="text-decoration-none text-ellipsis">
                            {{ Illuminate\Support\Str::limit($post->user->name, $limit = 50, $end = '...') }}
                        </a>
                    </td>

                    <td style="width: 160px">
                        @include('posts::posts.partials.actions.show')
                        @include('posts::posts.partials.actions.edit')
                        @include('posts::posts.partials.actions.delete')
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="100" class="text-center">@lang('posts::posts.empty')</td>
                </tr>
            @endforelse
        </tbody>

        @if ($posts->hasPages())
            @slot('footer')
                {{ $posts->links() }}
            @endslot
        @endif
    @endcomponent

</x-layout>
