<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Cafe
 *
 * @property int $id
 * @property string $name
 * @property string $address
 * @property string $city
 * @property string $state
 * @property string $zip
 * @property float $latitude
 * @property float $longitude
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $parent
 * @property string $location_name
 * @property int $roaster
 * @property string $website
 * @property string $description
 * @property int|null $added_by
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\BrewMethod[] $brewMethods
 * @property-read int|null $brew_methods_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cafe newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cafe newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cafe query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cafe whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cafe whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cafe whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cafe whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cafe whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cafe whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cafe whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cafe whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cafe whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cafe whereZip($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cafe whereAddedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cafe whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cafe whereLocationName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cafe whereParent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cafe whereRoaster($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cafe whereWebsite($value)
 */
class Cafe extends Model
{
    public function brewMethods()
    {
        return $this->belongsToMany(BrewMethod::class, 'cafes_brew_methods', 'cafe_id', 'brew_method_id');
    }

    // 关联分店
    public function children()
    {
        return $this->hasMany(Cafe::class, 'parent', 'id');
    }

    // 归属总店
    public function parent()
    {
        return $this->hasOne(Cafe::class, 'id', 'parent');
    }
}
