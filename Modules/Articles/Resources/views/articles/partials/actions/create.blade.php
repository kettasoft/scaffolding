@if(auth()->user()->hasPermission('create_articles'))
    <a href="{{ route('dashboard.articles.create') }}"
       class="btn btn-primary font-weight-bolder">
        <i class="fas fa fa-fw fa-plus"></i>
        @lang('articles::articles.actions.create')
    </a>
@else
    <button
        type="button"
        disabled
        class="btn btn-primary font-weight-bolder">
        <i class="fas fa fa-fw fa-plus"></i>
        @lang('articles::articles.actions.create')
    </button>
@endif
