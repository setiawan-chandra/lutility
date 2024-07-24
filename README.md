# LUTILITY

This package laravel utility (lutility) contain utilities that cover feature like menu, permission, role, repository, and others.

## Installation

You can install the package via composer:

Add git source repository to `composer.json`:
```
"repositories": [
    {
        "type": "vcs",
        "url": "https://github.com/djgroup88/lutility.git"
    }
],
"minimum-stability": "dev",
"prefer-stable": true
```

Start installing the package:
```bash
composer require kastanaz/lutility
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="lutility-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="lutility-config"
```

This is the contents of the published config file:

```php
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
        'list' => [
            'general' => [
                'site_name' => [SettingTypeEnum::String, env('APP_NAME', 'Laravel')],
                'site_logo' => [SettingTypeEnum::Image],
                'favicon' => [SettingTypeEnum::Image],
            ]
        ]
    ],

    'menu' => [
        'model' => \Kastanaz\Lutility\Models\Menu::class,

        'guards' => [
            'user' => \App\Models\User::class,
        ],

        'list' => [
            'user' => [
            ],
        ]
    ],
];
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [kastanaz](https://github.com/kastanaz)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
