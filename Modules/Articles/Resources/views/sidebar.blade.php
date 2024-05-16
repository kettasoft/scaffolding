@component(layout('dashboard').'components.sidebarItem')
    @slot('can', ['permission' => 'read_articles'])
    @slot('url', route('dashboard.articles.index'))
    @slot('name', trans('articles::articles.plural'))
    @slot('isActive', request()->routeIs('*articles*'))
    @slot('icon', 'fas fa-newspaper')
    @slot('tree', [
        [
            'name' => trans('articles::articles.actions.list'),
            'url' => route('dashboard.articles.index'),
            'can' => ['permission' => 'read_articles'],
            'isActive' => request()->routeIs('*articles.index'),
            'module' => 'Articles',
        ],
        [
            'name' => trans('articles::articles.actions.create'),
            'url' => route('dashboard.articles.create'),
            'can' => ['permission' => 'create_articles'],
            'isActive' => request()->routeIs('*articles.create'),
            'module' => 'Articles',
        ],
    ])
@endcomponent
