<?php

namespace Singlephon\Corelink\Commands;

use Illuminate\Console\Command;

class MakeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'corelink:make {name} {--resource} {--service}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a CoreLink class(es)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $resource = $this->option('resource');
        $service = $this->option('service');

        $name = $this->argument('name');

        if ($resource)
            (new CreateResource($name))->make();
        if ($service)
            (new CreateService($name))->make();

        if (!$service and !$resource)
        {
            (new CreateResource($name))->make();
            (new CreateService($name))->make();
        }
        $this->info('CoreLink folder structuring end.');
    }
}
