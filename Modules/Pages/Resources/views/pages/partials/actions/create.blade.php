@if(auth()->user()->hasPermission('create_pages'))
    <a href="{{ route('dashboard.pages.create') }}"
       class="btn btn-primary font-weight-bolder">
        <i class="fas fa fa-fw fa-plus"></i>
        @lang('pages::pages.actions.create')
    </a>
@else
    <button
        type="button"
        disabled
        class="btn btn-primary font-weight-bolder">
        <i class="fas fa fa-fw fa-plus"></i>
        @lang('pages::pages.actions.create')
    </button>
@endif
