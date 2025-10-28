<?php

namespace Kastanaz\Lutility\Contracts;

use Kastanaz\Lutility\Models\Progress;
use Illuminate\Database\Eloquent\Relations\MorphMany;

interface ProgressModelContract
{
    /**
     * Get all of the post's comments.
     *
     * @return MorphMany
     */
    public function progress(): MorphMany;

    /**
     * Create Progress Task
     *
     * @param string $actorType
     * @param string $actorId
     * @param string $description
     * @return Progress
     */
    public function createProgress(string $actorType, string $actorId, string $description): Progress;
}
