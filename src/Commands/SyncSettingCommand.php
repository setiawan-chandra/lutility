<?php

namespace Kastanaz\Lutility\Commands;

use Illuminate\Console\Command;
use Kastanaz\Lutility\Models\Setting;

class SyncSettingCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:setting {--reset}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'synchronize setting in config with database';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $total = 0;

        if ($this->option('reset')) {
            Setting::truncate();
        }

        foreach (config('lutility.setting.list') as $key => $value) {

            Setting::firstOrCreate(['key' => $key], ['value' => $value[1] ?? null]);
            $total++;

        }

        $this->info("Sync {$total} setting complete.");
    }
}
