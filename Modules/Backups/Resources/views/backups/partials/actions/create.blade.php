@if(auth()->user()->hasPermission('create_backups'))
    <form action="{{ route('dashboard.backups.create') }}" method="get" class="CreateBackupForm">
        @csrf
        <button type="submit" class="btn btn-primary font-weight-bolder theme-button" name="backup_type"
                value="full_backup">
            <i class="fas fa fa-fw fa-plus"></i>
            @lang('backups::backups.actions.full_backup')
        </button>
        <button type="submit" class="btn btn-primary font-weight-bolder theme-button" name="backup_type"
                value="files_backup">
            <i class="fas fa fa-fw fa-plus"></i>
            @lang('backups::backups.actions.files_backup')
        </button>
        <button type="submit" class="btn btn-primary font-weight-bolder theme-button" name="backup_type"
                value="db_backup">
            <i class="fas fa fa-fw fa-plus"></i>
            @lang('backups::backups.actions.db_backup')
        </button>
    </form>
@else
    <button
        type="button"
        disabled
        class="btn btn-primary font-weight-bolder">
        <i class="fas fa fa-fw fa-plus"></i>
        @lang('backups::backups.actions.create')
    </button>
@endif
