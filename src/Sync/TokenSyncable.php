<?php

namespace Singlephon\Corelink\Sync;

use Illuminate\Support\Facades\Http;
use Singlephon\Corelink\Intentions\Syncable;

class TokenSyncable extends Syncable
{

    protected function routes(): array
    {
        return [
            'default' => '/common/token'
        ];
    }

    public function sync(?string $route): array
    {
        $fullRoute = $this->getUrl($route);
        $data = Http::withBody($this->resource->toJson(), 'application/json')
            ->post($fullRoute)
            ->json();

        return ['token' => $data['token']];
    }


}
