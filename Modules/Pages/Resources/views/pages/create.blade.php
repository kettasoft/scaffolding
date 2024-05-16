<x-layout :title="trans('pages::pages.actions.create')" :breadcrumbs="['dashboard.pages.create']">

    {{ BsForm::resource('pages::pages')->post(route('dashboard.pages.store'), ['files' => true,'data-parsley-validate']) }}
    @component(layout('dashboard').'components.box')
        @slot('title', trans('pages::pages.actions.create'))

        @include('pages::pages.partials.form')

        @slot('footer')
            {{ BsForm::submit()->label(trans('pages::pages.actions.save')) }}
        @endslot
    @endcomponent
    {{ BsForm::close() }}

</x-layout>
