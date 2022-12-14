<?php

namespace App\Console\Commands;

use App\Jobs\DiscordSyncJob;
use App\Jobs\SlackSyncJob;
use App\Models\Account;
use Illuminate\Console\Command;

class ExecuteSyncCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'execute:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Account::query()
//            ->where('platform', 'slack')
            ->chunk(100, function ($accounts) {
                foreach ($accounts as $account) {
                    if ($account->platform == 'slack') {
                        dispatch(new SlackSyncJob($account));
                    } elseif ($account->platform == 'discord') {
                        dispatch(new DiscordSyncJob($account));
                    }
                }
            });

        return 0;
    }
}
