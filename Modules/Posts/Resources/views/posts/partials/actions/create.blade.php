@if (auth()->user()->hasPermission('create_posts'))
    <a href="{{ route('dashboard.posts.create') }}" class="btn btn-primary font-weight-bolder">
        <i class="fas fa fa-fw fa-plus"></i>
        @lang('posts::posts.actions.create')
    </a>
@else
    <button type="button" disabled class="btn btn-primary font-weight-bolder">
        <i class="fas fa fa-fw fa-plus"></i>
        @lang('posts::posts.actions.create')
    </button>
@endif
