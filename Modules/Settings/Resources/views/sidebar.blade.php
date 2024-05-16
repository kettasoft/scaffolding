@component(layout('dashboard').'components.sidebarItem')
    @slot('can', ['permission' => 'read_settings'])
    @slot('url', route('dashboard.settings.index'))
    @slot('name', trans('settings::settings.plural'))
    @slot('isActive', request()->routeIs('*settings*'))
    @slot('icon', 'fas fa-cog')
    @php($trees = [
        [
            'name' => trans('settings::settings.tabs.main'),
            'url' => route('dashboard.settings.index', ['tab' => 'main']),
            'can' => ['permission' => 'read_settings'],
            'isActive' => request()->routeIs('*settings*')  && request('tab') == 'main',
            'module' => 'Settings',
            'icon' => 'mdi mdi-cogs'
        ],
        [
            'name' => trans('settings::settings.tabs.contacts'),
            'url' => route('dashboard.settings.index', ['tab' => 'contacts']),
            'can' => ['permission' => 'read_settings'],
            'isActive' => request()->routeIs('*settings*')  && request('tab') == 'contacts',
            'module' => 'Settings',
            'icon' => 'mdi mdi-contacts'
        ],
        [
            'name' => trans('settings::settings.tabs.app'),
            'url' => route('dashboard.settings.index', ['tab' => 'app']),
            'can' => ['permission' => 'read_settings'],
            'isActive' => request()->routeIs('*settings*')  && request('tab') == 'app',
            'module' => 'Settings',
            'icon' => 'mdi mdi-cellphone-android'
        ],
        [
            'name' => trans('settings::settings.tabs.social'),
            'url' => route('dashboard.settings.index', ['tab' => 'social']),
            'can' => ['permission' => 'read_settings'],
            'isActive' => request()->routeIs('*settings*')  && request('tab') == 'social',
            'module' => 'Settings',
            'icon' => 'fab fa-facebook'
        ],
        [
            'name' => trans('settings::settings.tabs.mail'),
            'url' => route('dashboard.settings.index', ['tab' => 'mail']),
            'can' => ['permission' => 'read_settings'],
            'isActive' => request()->routeIs('*settings*')  && request('tab') == 'mail',
            'module' => 'Settings',
            'icon' => 'mdi mdi-inbox-full'
        ],
        [
            'name' => trans('settings::settings.tabs.themes'),
            'url' => route('dashboard.settings.index', ['tab' => 'themes']),
            'can' => ['permission' => 'read_settings'],
            'isActive' => request()->routeIs('*settings*')  && request('tab') == 'themes',
            'module' => 'Settings',
            'icon' => 'mdi mdi-flip-horizontal'
        ],
        [
            'name' => trans('roles::roles.plural'),
            'url' => route('dashboard.roles.index'),
            'can' => ['permission' => 'read_roles'],
            'isActive' => request()->routeIs('*roles.index'),
            'module' => 'Roles',
            'icon' => 'mdi mdi-shield-lock-outline',
            'tree' => [
                [
                    'name' => trans('roles::roles.actions.list'),
                    'url' => route('dashboard.roles.index'),
                    'can' => ['permission' => 'read_roles'],
                    'isActive' => request()->routeIs('*roles.index'),
                    'module' => 'Roles',
                ],
                [
                    'name' => trans('roles::roles.actions.create'),
                    'url' => route('dashboard.roles.create'),
                    'can' => ['permission' => 'create_roles'],
                    'isActive' => request()->routeIs('*roles.create'),
                    'module' => 'Roles',
                ],
            ]
        ],
    ])
    @slot('tree', $trees)
@endcomponent
