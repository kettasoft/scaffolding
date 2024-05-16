<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users'    => false,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'super_admin' => [
            'roles'     => 'c,r,u,d,s',
            'admins'    => 'c,r,u,d,s,b',
            'customers' => 'c,r,u,d,s,b',
            'settings'  => 'c,r,u,d',
            'backups'   => 'c,r,d,dl',
            'articles'  => 'c,r,u,d,s',
            'pages'     => 'c,r,u,d,s',
            'countries' => 'c,r,u,d,s',
            'cities'    => 'c,r,u,d,s',
        ],
        'admin'       => [
            'roles'     => 'c,r,u,d,s',
            'admins'    => 'c,r,u,d,s,b',
            'customers' => 'c,r,u,d,s,b',
            'settings'  => 'c,r,u,d',
            'backups'   => 'c,r,d,dl',
            'articles'  => 'c,r,u,d,s',
            'pages'     => 'c,r,u,d,s',
            'countries' => 'c,r,u,d,s',
            'cities'    => 'c,r,u,d,s',
        ],
        'user'        => [
            //
        ],
    ],

    'permissions_map' => [
        'c'  => 'create',
        'a'  => 'accept',
        'rj'  => 'reject',
        'r'  => 'read',
        'u'  => 'update',
        'd'  => 'delete',
        's'  => 'show',
        'b'  => 'block',
        'dl' => 'download',
        'so' => 'sort',
    ]
];
