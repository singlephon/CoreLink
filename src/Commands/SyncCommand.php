<?php

namespace Singlephon\Corelink\Commands;

use Illuminate\Console\Command;

class SyncCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'corelink:syncable {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make syncable CoreLink class';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');

        (new CreateSyncable($name))->make();
        $this->info('CoreLink folder structuring end.');
    }
}
