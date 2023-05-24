<?php

namespace Singlephon\Corelink\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;


class InitialStructure extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'corelink:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Initialize CoreLink folder structure by Common Source Service';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Making folders...');

        $folders = [
            'services' => 'App/CoreLink/Services',
            'resources' => 'App/CoreLink/Resources',
            'sync' => 'App/CoreLink/Sync'
        ];

        foreach ($folders as $alias => $folder) {
            if (!File::exists($folder)) {
                $this->line("........Creating $folder");
                File::makeDirectory($folder, 0777, true);
                if ($alias == 'services') {
                    $serviceMaker = new CreateService('');
                    $serviceMaker->make();
                }
            }
        }

        $this->info('CoreLink folder structuring end.');
    }

}
