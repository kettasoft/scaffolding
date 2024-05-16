@extends(layout('dashboard').'default')

@section('title')
    @lang('backups::backups.actions.create')
@endsection

@section('content')
    @component(layout('dashboard').'components.backup')
        @slot('title', trans('backups::backups.plural'))
        @slot('breadcrumbs', ['dashboard.backups.create'])

        {{ BsForm::resource('backups::backups')->post(route('dashboard.backups.store'), ['files' => true,'data-parsley-validate']) }}
        @component(layout('dashboard').'components.box')
            @slot('title', trans('backups::backups.actions.create'))

            @include('backups::backups.partials.form')

            @slot('footer')
                {{ BsForm::submit()->label(trans('backups::backups.actions.save')) }}
            @endslot
        @endcomponent
        {{ BsForm::close() }}

    @endcomponent
@endsection
