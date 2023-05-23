<?php

namespace Singlephon\Corelink\Services;

use Singlephon\Corelink\Intentions\Serviceable;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class PasswordServices extends Serviceable
{
    /**
     * @param User $model
     * @return Collection
     */
    protected function list($model): Collection
    {
        return $model->services()->get();
    }
}
