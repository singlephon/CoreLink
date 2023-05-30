<?php

namespace Singlephon\Corelink\Commands;

use App\CoreLink\Sync\PingPongSyncable;
use App\Models\Service;
use Illuminate\Console\Command;
use Singlephon\Corelink\Resources\TokenServiceResource;
use Symfony\Component\Console\Command\Command as CommandAlias;

class TestNodeLinkApplications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'corelink:node {name?} {--ping} {--primary} {--complex}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Simple Ping-pong request to all services';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $argument = $this->argument('name');
        $options = $this->options();

        if ($options['ping'])
            $this->ping($argument);

        /** TODO: Implement another Ping stuffs in Nodelink  */

        if ($options['primary'])
            $this->ping($argument);

        if ($options['complex'])
            $this->ping($argument);

    }


    public function ping(?string $service = null)
    {
        $services = $service ? Service::query()->where('name', $service)->get() : Service::all();
        if ($services->isEmpty()) {
            $this->error("Couldn't find nodelink service by name <options=bold;bg=red;>$service</>");
            return CommandAlias::INVALID;
        }
        $response = [];
        foreach ($services as $service)
        {
            $syncable = new PingPongSyncable($service);
            $sync = $syncable->sync('pong');

            $status = $this->colorText($sync['message'], ConsoleColor::Green);
            if (!$sync['ping'])
                $status = $this->colorText($sync['message'], ConsoleColor::Red);

            $response[] = [
                $service->name,
                $status
            ];
        }
        $this->table(
            ['service', 'status'],
            $response
        );
    }

    public function colorText(string $text, ConsoleColor $color)
    {
        return "<fg=$color->value>" . $text . '</>';
    }
}


