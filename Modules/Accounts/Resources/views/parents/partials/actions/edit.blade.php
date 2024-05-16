@if (auth()->user()->hasPermission('update_parents'))
    <a href="{{ route('dashboard.parents.edit', $parent) }}" class="btn btn-outline-primary btn-sm">
        <i class="fas fa-edit fa fa-fw"></i>
    </a>
@else
    <button type="button" disabled class="btn btn-primary btn-sm">
        <i class="fas fa-edit fa fa-fw"></i>
    </button>
@endcan
