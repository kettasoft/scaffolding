@component(layout('dashboard') . 'components.sidebarItem')
    @slot('can', ['permission' => 'read_posts'])
    @slot('url', route('dashboard.posts.index'))
    @slot('name', trans('posts::posts.plural'))
    @slot('isActive', request()->routeIs('*posts*'))
    @slot('icon', 'fas fa-newspaper')
    @slot('tree', [
        [
        'name' => trans('posts::posts.actions.list'),
        'url' => route('dashboard.posts.index'),
        'can' => ['permission' => 'read_posts'],
        'isActive' => request()->routeIs('*posts.index'),
        'module' => 'Posts',
        ],
        [
        'name' => trans('posts::posts.actions.create'),
        'url' => route('dashboard.posts.create'),
        'can' => ['permission' => 'create_posts'],
        'isActive' => request()->routeIs('*posts.create'),
        'module' => 'Posts',
        ],
        ])
    @endcomponent
