<x-layout :title="trans('posts::posts.actions.create')" :breadcrumbs="['dashboard.posts.create']">

    {{ BsForm::resource('posts::posts')->post(route('dashboard.posts.store'), ['files' => true, 'data-parsley-validate']) }}
    @component(layout('dashboard') . 'components.box')
        @slot('title', trans('posts::posts.actions.create'))

        @include('posts::posts.partials.form')

        @slot('footer')
            {{ BsForm::submit()->label(trans('posts::posts.actions.save')) }}
        @endslot
    @endcomponent
    {{ BsForm::close() }}

</x-layout>
