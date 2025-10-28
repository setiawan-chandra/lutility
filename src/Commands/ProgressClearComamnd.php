<?php

namespace Kastanaz\Lutility\Commands;

use Illuminate\Console\Command;
use Kastanaz\Lutility\Contracts\Repositories\ProgressRepositoryContract;

class ProgressClearComamnd extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'progress:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'clear all progress data';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $total = 0;

        foreach (app(ProgressRepositoryContract::class)->getBy() as $progress) {

            $progress->delete();
            $total++;

        }

        $this->info("clear {$total} progress complete.");
    }
}
