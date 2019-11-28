<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
/**
 * App\Models\Tag
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @mixin \Eloquent
 */
class Tag extends Model
{
    protected $fillable = [
        'name'
    ];

    public function cafes()
    {
        return $this->belongsToMany(Cafe::class, 'cafes_users_tags', 'tag_id', 'user_id');
    }
}
