<?php

namespace Singlephon\Corelink\Intentions;

use App\Models\Service;
use Illuminate\Support\Str;

class Version
{
    public static function toDirectory(float $version): string
    {
        return Str::replace('.', '_', (string) $version);
    }

    public static function getResource(Service $service, string $serviceable): string
    {
        $resource = class_basename($serviceable);
        $version = static::toDirectory($service->version);
        return "App\\Http\\Resources\\$service->name\\V$version\\$resource";
    }
}
