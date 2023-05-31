<?php

namespace Singlephon\Corelink\Sync;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Singlephon\Corelink\Intentions\Syncable;

class PingPongSyncable extends Syncable
{
    /**
     * @return array
     */
    protected function routes(): array
    {
        return [
            'pong' => '/nodelink/ping/pong',
            // ...
        ];
    }

    public function sync(?string $route): array
    {
        $fullRoute = $this->getUrl($route);
        $message = 'OK';
        try {
            $access = Http::get($fullRoute)->json();
        } catch (ConnectionException $exception) {
            $access = false;
            $message = $exception->getMessage();
        }

        return [
            'ping' => $access,
            'message' => $message,
        ];
    }
}
