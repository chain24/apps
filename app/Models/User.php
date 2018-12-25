<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    // 与 Cafe 间的多对多关联
    public function likes()
    {
        return $this->belongsToMany(Cafe::class, 'users_cafes_likes', 'user_id', 'cafe_id');
    }
}
