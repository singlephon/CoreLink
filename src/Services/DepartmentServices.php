<?php

namespace Singlephon\Corelink\Services;

use Singlephon\Corelink\Intentions\Serviceable;
use App\Models\Service;
use Illuminate\Support\Collection;

class DepartmentServices extends Serviceable
{
    /**
     * Return path to services by model
     * @param Services $model
     * @return Collection
     */
    protected function list($model): Collection
    {
        return Service::all();
    }
}
