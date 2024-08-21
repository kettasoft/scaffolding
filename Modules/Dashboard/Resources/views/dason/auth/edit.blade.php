<x-layout :title="trans('accounts::users.pending')" :breadcrumbs="['dashboard.accounts.pending.edit', auth()->user()]">

    {{ BsForm::resource('accounts::panding')->putModel(auth()->user(), route('dashboard.rejected.update', auth()->user()->id), ['files' => true,'data-parsley-validate']) }}
    @component(layout('dashboard').'components.box')
        @slot('title', trans('accounts::pending.actions.edit'))

        @include('accounts::pending.partials.form')

        @slot('footer')
            {{ BsForm::submit()->label(trans('accounts::pending.actions.save')) }}
        @endslot
    @endcomponent
    {{ BsForm::close() }}

</x-layout>
