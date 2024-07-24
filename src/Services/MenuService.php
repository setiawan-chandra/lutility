<?php

namespace Kastanaz\Lutility\Services;

class MenuService
{
    /**
     * Get All Menu From Model
     *
     * @return Collection
     */
    public function getAll(): \Illuminate\Database\Eloquent\Collection
    {
        return config('lutility.menu.model')::get();
    }

    /**
     * Get Authorized Menu
     *
     * @return Collection
     */
    public function getAuthorized(): \Illuminate\Support\Collection
    {
        if (!auth()->user()) {
            return collect([]);
        }
        return $this->getAll()->filter(function($item) {
            return auth()->user()->can($item->permission);
        });
    }

}
