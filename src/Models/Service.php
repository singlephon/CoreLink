<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\Service
 *
 * @property int $id
 * @property string $name
 * @property string $url
 * @property mixed|null $data_model
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static Builder|Service newModelQuery()
 * @method static Builder|Service newQuery()
 * @method static Builder|Service query()
 * @method static Builder|Service whereCreatedAt($value)
 * @method static Builder|Service whereDataModel($value)
 * @method static Builder|Service whereId($value)
 * @method static Builder|Service whereName($value)
 * @method static Builder|Service whereUpdatedAt($value)
 * @method static Builder|Service whereUrl($value)
 * @mixin \Eloquent
 * @property float $version
 * @method static Builder|Service whereVersion($value)
 * @property string $key
 * @method static Builder|Service whereKey($value)
 * @property int|null $production
 * @property-read Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static Builder|Service whereProduction($value)
 */
class Service extends Model
{
    protected $fillable = [
        'name',
        'url',
        'version',
        'key'
    ];

    protected $hidden = [
        'key'
    ];

    /**
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_services');
    }

    public function user(User $user): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_services')->where('id', $user->id);
    }
    */

    public static function findByName(string $name, int $production = 1): Builder|Service|null
    {
        return Service::query()->where([
            ['name', $name],
            ['production', $production]
        ])->first();
    }

    public static function assertKey(string $key, ?self $service): bool
    {
        return ($service->key ?? null) == $key;
    }

}
