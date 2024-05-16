@if(auth()->user()->hasPermission('show_admins'))
    <a href="{{ route('dashboard.admins.show', $admin) }}"
       class="btn btn-outline-warning  btn-sm">
        <i class="fas fa fa-fw fa-eye"></i>
    </a>
@else
    <button
        type="button"
        disabled
        class="btn btn-outline-warning  btn-sm">
        <i class="fas fa fa-fw fa-eye"></i>
    </button>
@endcan
