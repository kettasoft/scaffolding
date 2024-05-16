<x-layout :title="trans('settings::settings.tabs.mail')" :breadcrumbs="['dashboard.settings.index']">

    {{ BsForm::resource('settings::settings')->put(route('dashboard.settings.update'), ['files' => true]) }}
    @component(layout('dashboard').'components.box')

        @slot('title', trans('settings::settings.tabs.mail'))

        @include('settings::settings.partials.mail-form')

        {{ BsForm::submit()->label(trans('settings::settings.actions.save'))->attribute('class','btn btn-danger mb-2') }}
    @endcomponent
    {{ BsForm::close() }}

</x-layout>

