<?php

namespace Kastanaz\Lutility\Concerns;

use Throwable;
use Illuminate\Support\Facades\Log;
use Kastanaz\Lutility\Models\Progress;
use Kastanaz\Lutility\Contracts\Repositories\ProgressRepositoryContract;

trait ProgressableJob
{
    /**
     * Progress Model Instance
     *
     * @var Progress $progress
     */
    protected Progress $progress;

    /**
     * Get Progress By ID
     *
     * @param string $progress
     * @return Progress
     */
    public function getProgressById(string $progress): Progress
    {
        return app(ProgressRepositoryContract::class)->getOneById($progress);
    }

    /**
     * Set Progress as Complete
     *
     * @return void
     */
    protected function completeProgress(): void
    {
        $this->progress->setAsCompleted();
    }

    /**
     * Handle a job failure.
     *
     * @param  \Throwable  $exception
     * @return void
     */
    public function failed(Throwable $exception)
    {
        Log::error($exception->getMessage());

        $this->progress->setAsFailed();
    }
}
