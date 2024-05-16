@component(layout('dashboard').'components.sidebarItem')
    @slot('can', ['permission' => 'read_pages'])
    @slot('url', route('dashboard.pages.index'))
    @slot('name', trans('pages::pages.plural'))
    @slot('isActive', request()->routeIs('*pages*'))
    @slot('icon', 'fas fa-file')
    @slot('tree', [
        [
            'name' => trans('pages::pages.actions.list'),
            'url' => route('dashboard.pages.index'),
            'can' => ['permission' => 'read_pages'],
            'isActive' => request()->routeIs('*pages.index'),
            'module' => 'Pages',
        ],
        [
            'name' => trans('pages::pages.actions.create'),
            'url' => route('dashboard.pages.create'),
            'can' => ['permission' => 'create_pages'],
            'isActive' => request()->routeIs('*pages.create'),
            'module' => 'Pages',
        ],
    ])
@endcomponent
