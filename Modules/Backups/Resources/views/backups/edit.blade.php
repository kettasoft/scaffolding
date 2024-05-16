@extends(layout('dashboard').'default')

@section('title')
    {{ $backup->title }}
@endsection

@section('content')
    @component(layout('dashboard').'components.backup')
        @slot('title', $backup->name)
        @slot('breadcrumbs', ['dashboard.backups.edit', $backup])

        {{ BsForm::resource('backups::backups')->putModel($backup, route('dashboard.backups.update', $backup), ['files' => true,'data-parsley-validate']) }}
        @component(layout('dashboard').'components.box')
            @slot('title', trans('backups::backups.actions.edit'))

            @include('backups::backups.partials.form')

            @slot('footer')
                {{ BsForm::submit()->label(trans('backups::backups.actions.save')) }}
            @endslot
        @endcomponent
        {{ BsForm::close() }}

    @endcomponent
@endsection
