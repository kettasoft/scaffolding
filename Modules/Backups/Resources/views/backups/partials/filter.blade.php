{{ BsForm::resource('backups::backups')->get(url()->current()) }}
@component(layout('dashboard').'components.accordion')
    @slot('title', trans('backups::backups.actions.filter'))

    <div class="row">
        <div class="col-md-3">
            {{ BsForm::text('title')->value(request('title')) }}
        </div>
        <div class="col-md-3">
            {{ BsForm::number('perBackup')
                ->value(request('perBackup', 15))
                ->min(1)
                 ->label(trans('backups::backups.perBackup')) }}
        </div>
    </div>

    @slot('footer')
        <button type="submit" class="btn btn-primary btn-sm">
            <i class="fas fa fa-fw fa-filter"></i>
            @lang('backups::backups.actions.filter')
        </button>
    @endslot
@endcomponent
{{ BsForm::close() }}
