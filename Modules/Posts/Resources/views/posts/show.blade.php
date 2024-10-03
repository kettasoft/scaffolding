<x-layout :title="Illuminate\Support\Str::limit($post->name, $limit = 50, $end = '...')" :breadcrumbs="['dashboard.posts.show', $post]">

    <div class="row">
        <div class="col-md-6">
            @component(layout('dashboard') . 'components.box')
                @slot('bodyClass', 'p-0')

                <table class="table table-middle">
                    <tbody>
                        <tr>
                            <th width="200">@lang('posts::posts.attributes.title')</th>
                            <td>{{ $post->title }}</td>
                        </tr>
                        <tr>
                            <th width="200">@lang('posts::posts.attributes.content')</th>
                            <td>{{ strip_tags($post->content) }}</td>
                        </tr>
                        <tr>
                            <th width="200">@lang('posts::posts.attributes.auther')</th>
                            <td>{{ $post->user->name }}</td>
                        </tr>
                        <tr>
                            <th width="200">@lang('posts::posts.attributes.image')</th>
                            <td>
                                @if ($post->getFirstMedia('default'))
                                    <file-preview :media="{{ $post->getMediaResource('default') }}"></file-preview>
                                @else
                                    <img src="{{ $post->getAvatar() }}" class="img img-size-64" alt="{{ $post->name }}">
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>

                @slot('footer')
                    @include('posts::posts.partials.actions.edit')
                    @include('posts::posts.partials.actions.delete')
                @endslot
            @endcomponent

        </div>
    </div>

</x-layout>>
