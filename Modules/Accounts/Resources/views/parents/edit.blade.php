<x-layout :title="$parent->name" :breadcrumbs="['dashboard.admins.edit', $parent]">

    {{ BsForm::resource('accounts::parents')->putModel($parent, route('dashboard.parents.update', $parent), ['files' => true, 'data-parsley-validate']) }}
    @component(layout('dashboard') . 'components.box')
        @slot('title', trans('accounts::parents.actions.edit'))

        @include('accounts::parents.partials.form')

        @slot('footer')
            {{ BsForm::submit()->label(trans('accounts::parents.actions.save')) }}
        @endslot
    @endcomponent
    {{ BsForm::close() }}

</x-layout>
