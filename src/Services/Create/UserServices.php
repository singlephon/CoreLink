<?php

namespace Singlephon\Corelink\Services\Create;

use Singlephon\Corelink\Intentions\Serviceable;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserServices extends Serviceable
{
    /**
     * @param User $model
     * @return Collection
     */
    protected function list($model): Collection
    {
        return $model->get();
    }
}
