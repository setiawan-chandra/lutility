<?php

namespace Kastanaz\Lutility\Concerns;

use Kastanaz\Lutility\Models\Progress;

trait ProgressableModel
{
    /**
     * Get all of the post's comments.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function progress(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(Progress::class, 'progressable');
    }

    /**
     * Create Progress Task
     *
     * @param string $actorType
     * @param string $actorId
     * @param string $description
     * @return Progress
     */
    public function createProgress(string $actorType, string $actorId, string $description): Progress
    {
        return Progress::generate($this->id, $this::class, $description, $actorType, $actorId);
    }
}
