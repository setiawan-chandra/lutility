<?php

namespace Kastanaz\Lutility\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Kastanaz\Lutility\Concerns\HasPermissions;
use Kastanaz\Lutility\Concerns\HasPackageFactory;

class Role extends Model
{
    use HasPackageFactory, HasUuids, HasPermissions;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array<string>|bool
     */
    protected $guarded = [];

    /**
     * Scope Super Admin
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSuperAdmin(\Illuminate\Database\Eloquent\Builder $query): \Illuminate\Database\Eloquent\Builder
    {
        return $query->where('level', config('lutility.permission.role.level.superadmin'));
    }

    /**
     * Scope Admin
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAdmin(\Illuminate\Database\Eloquent\Builder $query): \Illuminate\Database\Eloquent\Builder
    {
        return $query->where('level', config('lutility.permission.role.level.admin'));
    }

    /**
     * Scope User
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeUser(\Illuminate\Database\Eloquent\Builder $query): \Illuminate\Database\Eloquent\Builder
    {
        return $query->where('level', config('lutility.permission.role.level.user'));
    }

    /**
     * Check if Role is Super Admin
     *
     * @return boolean
     */
    public function isSuperAdmin(): bool
    {
        return $this->level == config('lutility.permission.role.level.superadmin');
    }
}
