<?php

namespace Singlephon\Corelink\Commands;

use App\Models\Service;
use Illuminate\Console\Command;
use Singlephon\Corelink\Intentions\Security;
use Singlephon\Corelink\Resources\RegisterServiceResource;
use Singlephon\Corelink\Sync\RegisterServiceSyncable;

class CreateServiceCommand extends Command
{
    use Security;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'corelink:register {url} {key}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Register a nodelink service';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $url = $this->argument('url');
        $key = $this->argument('key');

        $service = new Service();
        $service->url = $url;
        $service->key = $key;

        $registerKey = $this->checksumGenerate($url, $key);
        $registerService = new RegisterServiceSyncable($service, new RegisterServiceResource($service, $registerKey));
        $this->info($registerService->sync('default')['sad']);

    }
}
