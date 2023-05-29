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
        $query = $registerService->sync('default');

        if (!$query['status']) {
            $this->warn('Failed when register application');
            return;
        }

        $service->name = $query['data']['name'];
        $service->version = $query['data']['version'];
        $service->production = true;

        $isServiceExist = Service::query()->where('name', $service->name)->where('url', $service->url)->get();
        /** TODO: Add app test version api */
        if (count($isServiceExist)) {
            $this->alert('Service <fg=white;options=bold>'. $service->name .'</> already exists');
            return;
        }
        $service->save();
        $this->info('...<fg=white;options=bold>' . $service->name . '</> successfully registered');
    }
}
