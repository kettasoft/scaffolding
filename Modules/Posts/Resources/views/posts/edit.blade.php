<x-layout :title="Illuminate\Support\Str::limit($post->name, $limit = 50, $end = '...')" :breadcrumbs="['dashboard.posts.edit', $post]">

    {{ BsForm::resource('posts::posts')->putModel($post, route('dashboard.posts.update', $post), ['files' => true, 'data-parsley-validate']) }}
    @component(layout('dashboard') . 'components.box')
        @slot('title', trans('posts::posts.actions.edit'))

        @include('posts::posts.partials.form')

        @slot('footer')
            {{ BsForm::submit()->label(trans('posts::posts.actions.save')) }}
        @endslot
    @endcomponent
    {{ BsForm::close() }}

</x-layout>
