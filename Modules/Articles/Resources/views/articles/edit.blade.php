<x-layout :title="Illuminate\Support\Str::limit($article->name, $limit = 50, $end = '...')"
          :breadcrumbs=" ['dashboard.articles.edit', $article]">

    {{ BsForm::resource('articles::articles')->putModel($article, route('dashboard.articles.update', $article), ['files' => true,'data-parsley-validate']) }}
    @component(layout('dashboard').'components.box')
        @slot('title', trans('articles::articles.actions.edit'))

        @include('articles::articles.partials.form')

        @slot('footer')
            {{ BsForm::submit()->label(trans('articles::articles.actions.save')) }}
        @endslot
    @endcomponent
    {{ BsForm::close() }}

</x-layout>
