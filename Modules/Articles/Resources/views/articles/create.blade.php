<x-layout :title="trans('articles::articles.actions.create')" :breadcrumbs="['dashboard.articles.create']">

    {{ BsForm::resource('articles::articles')->post(route('dashboard.articles.store'), ['files' => true,'data-parsley-validate']) }}
    @component(layout('dashboard').'components.box')
        @slot('title', trans('articles::articles.actions.create'))

        @include('articles::articles.partials.form')

        @slot('footer')
            {{ BsForm::submit()->label(trans('articles::articles.actions.save')) }}
        @endslot
    @endcomponent
    {{ BsForm::close() }}

</x-layout>
