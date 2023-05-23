<?php

namespace Singlephon\Corelink\Intentions;

use Singlephon\Corelink\Sync\ServiceSyncable;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class Serviceable
{
    private Collection $services;
    private string $resource;
    private bool $dynamic;
    private $model;

    public function __construct (string $resource, $model, bool $dynamic, ?Collection $services = null)
    {
        $this->resource = $resource;
        $this->model = $model;
        $this->dynamic = $dynamic;
        $this->services = $services ?: $this->list($model);
    }

    /**
     * Send data to children servers
     *
     * Important!: Must realize queue in case false status
     * @return array
     */
    public function send (): array
    {
        $res = [];
        foreach ($this->services as $service)
        {
            $resource = $this->dynamic ? Version::getResource($service, $this->resource) : $this->resource;
            if (class_exists($resource))
                $res[] = (new ServiceSyncable($service, new $resource($this->model)
                          ))->sync(Service::getActionType($this->extendedClassName()));
        }
        return $res;
    }

    public function extendedClassName(): string
    {
        return get_class($this);
    }

    /**
     * Should return list of services
     * @param Model $model
     * @return Collection path to services by model
     */
    abstract protected function list (Model $model): Collection;
}
