<x-layout :title="trans('accounts::admins.actions.create')" :breadcrumbs="['dashboard.admins.create']">

    {{ BsForm::resource('accounts::admins')->post(route('dashboard.admins.store'), ['files' => true,'data-parsley-validate']) }}
    @component(layout('dashboard').'components.box')
        @slot('title', trans('accounts::admins.actions.create'))

        @include('accounts::admins.partials.form')

        @slot('footer')
            {{ BsForm::submit()->label(trans('accounts::admins.actions.save')) }}
        @endslot
    @endcomponent
    {{ BsForm::close() }}

</x-layout>

