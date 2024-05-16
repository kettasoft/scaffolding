@if(auth()->user()->hasPermission('download_backups'))
    <a href="{{ route('dashboard.backups.download', $backup['file_name']) }}"
       class="btn btn-outline-primary  btn-sm">
        <i class="fas fa fa-fw fa-download"></i>
    </a>
@else
    <button
        type="button"
        disabled
        class="btn btn-outline-primary  btn-sm">
        <i class="fas fa-edit fa fa-fw"></i>
    </button>
@endcan
