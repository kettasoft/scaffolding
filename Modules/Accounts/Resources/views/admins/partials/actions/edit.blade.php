@if(auth()->user()->hasPermission('update_admins'))
    <a href="{{ route('dashboard.admins.edit', $admin) }}"
       class="btn btn-outline-primary  btn-sm">
        <i class="fas fa-edit fa fa-fw"></i>
    </a>
@else
    <button
        type="button"
        disabled
        class="btn btn-outline-primary  btn-sm">
        <i class="fas fa-edit fa fa-fw"></i>
    </button>
@endcan
