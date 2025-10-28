<?php

namespace Kastanaz\Lutility\Providers;

use Kastanaz\Lutility\Models\BasePermission;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        foreach (BasePermission::all() as $permission) {

            foreach ($permission->actions as $action) {
                Gate::define("{$action}-{$permission->name}", function ($user) use ($permission, $action) {
                    return $user->role ? $user->role->hasPermissionTo($permission->name, $action) : false;
                });
            }

        }
    }
}
