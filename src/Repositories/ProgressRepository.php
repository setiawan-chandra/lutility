<?php

namespace Kastanaz\Lutility\Repositories;

use Kastanaz\Lutility\Models\Progress;
use Kastanaz\Lutility\Repositories\BaseRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Kastanaz\Lutility\Contracts\Repositories\ProgressRepositoryContract;

class ProgressRepository extends BaseRepository implements ProgressRepositoryContract
{
    /**
     * Construct
     *
     * @param Progress $model
     */
    public function __construct(Progress $model)
    {
        $this->model = $model;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function query(): \Illuminate\Database\Eloquent\Builder
    {
        return parent::query()
            ->when($this->actor, function($query, $value) {
                $query->where([
                    'actor_type' => $value::class,
                    'actor_id' => $value->id
                ]);
            });
    }

    /**
     * paginate function
     *
     * @param  array  $where
     * @param  int  $perPage
     * @return LengthAwarePaginator
     */
    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return $this->query()->orderBy('created_at', 'desc')->paginate($perPage);
    }
}
