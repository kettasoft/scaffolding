<x-layout :title="$admin->name" :breadcrumbs="['dashboard.admins.edit', $admin]">

    {{ BsForm::resource('accounts::admins')->putModel($admin, route('dashboard.admins.update', $admin), ['files' => true,'data-parsley-validate']) }}
    @component(layout('dashboard').'components.box')
        @slot('title', trans('accounts::admins.actions.edit'))

        @include('accounts::admins.partials.form')

        @slot('footer')
            {{ BsForm::submit()->label(trans('accounts::admins.actions.save')) }}
        @endslot
    @endcomponent
    {{ BsForm::close() }}

</x-layout>

