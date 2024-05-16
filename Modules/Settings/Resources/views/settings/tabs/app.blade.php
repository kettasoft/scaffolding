<x-layout :title="trans('settings::settings.tabs.app')" :breadcrumbs="['dashboard.settings.index']">

    {{ BsForm::resource('settings::settings')->put(route('dashboard.settings.update'), ['files' => true]) }}
    @component(layout('dashboard').'components.box')

        @slot('title', trans('settings::settings.tabs.app'))

        @include('settings::settings.partials.app-form')

        {{ BsForm::submit()->label(trans('settings::settings.actions.save'))->attribute('class','btn btn-danger mb-2') }}
    @endcomponent
    {{ BsForm::close() }}

</x-layout>

