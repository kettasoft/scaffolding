@if (auth()->user()->hasPermission('create_parents'))
    <a href="{{ route('dashboard.parents.create', request()->only('type')) }}" class="btn btn-primary font-weight-bolder">
        <i class="fas fa fa-fw fa-plus"></i>
        @lang('accounts::parents.actions.create')
    </a>
@else
    <button type="button" disabled class="btn btn-primary font-weight-bolder">
        <i class="fas fa fa-fw fa-plus"></i>
        @lang('accounts::admins.actions.create')
    </button>
@endif
