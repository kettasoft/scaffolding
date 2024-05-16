@component(layout('dashboard') . 'components.sidebarItem')
    @slot('can', ['permission' => 'read_parents'])
    @slot('url', route('dashboard.parents.index'))
    @slot('name', trans('accounts::parents.plural'))
    @slot('isActive', request()->routeIs('*parents*'))
    @slot('icon', 'fas fa-users')
    @slot('tree', [
        [
        'name' => trans('accounts::parents.actions.list'),
        'url' => route('dashboard.parents.index'),
        'can' => ['permission' => 'read_parents'],
        'isActive' => request()->routeIs('*parents.index'),
        'module' => 'Accounts',
        ],
        [
        'name' => trans('accounts::parents.actions.create'),
        'url' => route('dashboard.parents.create'),
        'can' => ['permission' => 'create_parents'],
        'isActive' => request()->routeIs('*parents.create'),
        'module' => 'Accounts',
        ],
        ])
    @endcomponent
