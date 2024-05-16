<x-layout :title="$page->name"
          :breadcrumbs=" ['dashboard.pages.edit', $page]">

    {{ BsForm::resource('pages::pages')->putModel($page, route('dashboard.pages.update', $page), ['files' => true,'data-parsley-validate']) }}
    @component(layout('dashboard').'components.box')
        @slot('title', trans('pages::pages.actions.edit'))

        @include('pages::pages.partials.form')

        @slot('footer')
            {{ BsForm::submit()->label(trans('pages::pages.actions.save')) }}
        @endslot
    @endcomponent
    {{ BsForm::close() }}

</x-layout>
