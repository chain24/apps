<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\BrewMethod
 *
 * @property int $id
 * @property string $method
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|Cafe[] $cafes
 * @property-read int|null $cafes_count
 * @method static Builder|BrewMethod newModelQuery()
 * @method static Builder|BrewMethod newQuery()
 * @method static Builder|BrewMethod query()
 * @method static Builder|BrewMethod whereCreatedAt($value)
 * @method static Builder|BrewMethod whereId($value)
 * @method static Builder|BrewMethod whereMethod($value)
 * @method static Builder|BrewMethod whereUpdatedAt($value)
 * @mixin Eloquent
 */
class BrewMethod extends Model
{
    // 定义与 Cafe 模型间的多对多关联
    public function cafes()
    {
        return $this->belongsToMany(Cafe::class, 'cafes_brew_methods', 'brew_method_id', 'cafe_id');
    }
}
