@if(auth()->user()->hasPermission('delete_backups'))
    <a href="#backup-{{ $backup['last_modified'] }}-delete-model"
       class="btn btn-outline-danger  btn-sm"
       data-toggle="modal">
        <i class="fas fa-trash"></i>
    </a>

    <!-- Modal -->
    <div class="modal fade" id="backup-{{ $backup['last_modified'] }}-delete-model" tabindex="-1" role="dialog"
         aria-labelledby="modal-title-{{ $backup['last_modified'] }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"
                        id="modal-title-{{ $backup['last_modified'] }}">@lang('backups::backups.dialogs.delete.title')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @lang('backups::backups.dialogs.delete.info')
                </div>
                <div class="modal-footer">
                    {{ BsForm::delete(route('dashboard.backups.destroy', $backup['file_name'])) }}
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        @lang('backups::backups.dialogs.delete.cancel')
                    </button>
                    <button type="submit" class="btn btn-danger">
                        @lang('backups::backups.dialogs.delete.confirm')
                    </button>
                    {{ BsForm::close() }}
                </div>
            </div>
        </div>
    </div>
@else
    <button
        type="button"
        disabled
        class="btn btn-outline-danger  btn-sm">
        <i class="fas fa-trash"></i>
    </button>
@endif
