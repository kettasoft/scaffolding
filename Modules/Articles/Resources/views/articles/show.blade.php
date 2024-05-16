<x-layout :title="Illuminate\Support\Str::limit($article->name, $limit = 50, $end = '...')"
          :breadcrumbs="['dashboard.articles.show',$article]">

    <div class="row">
        <div class="col-md-6">
            @component(layout('dashboard').'components.box')
                @slot('bodyClass', 'p-0')

                <table class="table table-middle">
                    <tbody>
                    <tr>
                        <th width="200">@lang('articles::articles.attributes.name')</th>
                        <td>{{ $article->name }}</td>
                    </tr>
                    <tr>
                        <th width="200">@lang('articles::articles.attributes.image')</th>
                        <td>
                            @if($article->getFirstMedia('default'))
                                <file-preview :media="{{ $article->getMediaResource('default') }}"></file-preview>
                            @else
                                <img src="{{ $article->getAvatar() }}"
                                     class="img img-size-64"
                                     alt="{{ $article->name }}">
                            @endif
                        </td>
                    </tr>
                    </tbody>
                </table>

                @slot('footer')
                    @include('articles::articles.partials.actions.edit')
                    @include('articles::articles.partials.actions.delete')
                @endslot
            @endcomponent

        </div>
    </div>

</x-layout>>
