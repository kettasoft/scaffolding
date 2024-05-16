<x-layout :title="trans('accounts::parents.actions.create')" :breadcrumbs="['dashboard.parents.create']">

    {{ BsForm::resource('accounts::parents')->post(route('dashboard.parents.store'), ['files' => true, 'data-parsley-validate']) }}
    @component(layout('dashboard') . 'components.box')
        @slot('title', trans('accounts::parents.actions.create'))

        @include('accounts::parents.partials.form')

        @slot('footer')
            {{ BsForm::submit()->label(trans('accounts::parents.actions.save')) }}
        @endslot
    @endcomponent
    {{ BsForm::close() }}

</x-layout>
