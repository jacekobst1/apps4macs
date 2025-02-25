<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

final class HorizonFlush extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'horizon:flush';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear failed_jobs db table and flush redis queue';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->call('queue:flush');
        Redis::command('flushdb');
        DB::table('job_batches')->truncate();
    }
}
