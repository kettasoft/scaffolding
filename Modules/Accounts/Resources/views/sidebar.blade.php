@component(layout('dashboard') . 'components.sidebarItem')
    @slot('can', ['permission' => 'read_admins'])
    @slot('url', '#')
    @slot('name', trans('accounts::users.plural'))
    @slot('isActive', request()->routeIs('accounts*'))
    @slot('icon', 'fas fa-users')
    @slot('tree', [
        [
        'name' => trans('accounts::admins.actions.list'),
        'url' => route('dashboard.admins.index'),
        'can' => ['permission' => 'read_admins'],
        'isActive' => request()->routeIs('*admins.*'),
        'module' => 'Accounts',
        ],
        ])
    @endcomponent
