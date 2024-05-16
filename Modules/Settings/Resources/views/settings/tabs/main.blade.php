<x-layout :title="trans('settings::settings.tabs.main')" :breadcrumbs="['dashboard.settings.index']">

    {{ BsForm::resource('settings::settings')->put(route('dashboard.settings.update'), ['files' => true]) }}
    @component(layout('dashboard').'components.box')

        @slot('title', trans('settings::settings.tabs.main'))

        @include('settings::settings.partials.main-form')

        {{ BsForm::submit()->label(trans('settings::settings.actions.save'))->attribute('class','btn btn-danger mb-2') }}
    @endcomponent
    {{ BsForm::close() }}

</x-layout>

