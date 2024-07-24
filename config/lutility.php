<?php

use Kastanaz\Lutility\Enums\SettingTypeEnum;

return [
    'permission' => [

        /*
        |--------------------------------------------------------------------------
        | Role
        |--------------------------------------------------------------------------
        |
        | This value contain the role configuration of the application. You can
        | determine value like model, level and many more configuration.
        |
        */

        'role' => [
            'model' => \Kastanaz\Lutility\Models\Role::class,
            'level' => [
                'superadmin' => 1,
                'admin' => 2,
                'user' => 3
            ],
        ],

        /*
        |--------------------------------------------------------------------------
        | Permission
        |--------------------------------------------------------------------------
        |
        | This value contain the permission configuration of the application.
        | determine value like model, list permission, and other config.
        |
        */

        'permission' => [
            'model' => \Kastanaz\Lutility\Models\Permission::class,
            'list' => [
                [
                    'name' => 'profile',
                    'alias' => 'Profile',
                    'actions' => ['read', 'update'],
                ],
                [
                    'name' => 'user',
                    'alias' => 'User',
                    'actions' => ['create', 'read', 'update', 'delete', 'restore', 'manage_all']
                ]
            ]
        ]
    ],

    'setting'  => [
        'upload_disk' => [
            'image' => 'public'
        ],

        'list' => [
            'site_name' => [SettingTypeEnum::String, env('APP_NAME', 'Laravel')],
            'site_logo' => [SettingTypeEnum::Image],
            'favicon' => [SettingTypeEnum::Image],
        ]
    ],

    'menu' => [
        'model' => \Kastanaz\Lutility\Models\Menu::class,

        'guards' => [
            'user' => \App\Models\User::class,
            // 'member' => \App\Models\Member::class,
        ],

        'list' => [
            'user' => [
                // [
                //     'name' => 'dashboard',
                //     'alias' => 'Dashboard',
                //     'icon' => 'pi pi-fw pi-home',
                //     'route' => 'user.dashboard',
                //     'group' => 'Home'
                // ],
            ],
            // 'member' => [
            //     [
            //         'name' => 'dashboard',
            //         'alias' => 'Dashboard',
            //         'icon' => 'pi pi-fw pi-home',
            //         'route' => 'member.dashboard',
            //         'group' => 'Home'
            //     ],
            // ]
        ]
    ],
];
