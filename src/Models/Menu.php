<?php

namespace Kastanaz\Lutility\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use \Sushi\Sushi;

    /**
     * Model Schema
     *
     * @var array
     */
    protected $schema = [
        'id' => 'integer',
        'name' => 'string',
        'alias' => 'string',
        'icon' => 'string',
        'route' => 'string',
        'group' => 'string',
        'permission' => 'string',
        'model' => 'string',
    ];

    /**
     * Source Rows Data
     *
     * @return void
     */
    public function getRows()
    {
        $guards = config('lutility.menu.guards');

        $menus = [];

        foreach ($guards as $guard => $model) {
            foreach (config("lutility.menu.list.{$guard}") as $menu) {
                $menu['model'] = $model;
                $menu['permission'] = $menu['permission'] ?? null;

                $menus[] = $menu;
            }
        }

        return $menus;
    }
}
