<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Cafe extends Model
{
    //Cafe 模型类与 BrewMethod 模型类之间的多对多关联
    public function brewMethods()
    {
        return $this->belongsToMany(BrewMethod::class,'cafes_brew_methods','cafe_id','brew_method_id');
    }
    //关联分店
    public function children()
    {
        return $this->hasMany(Cafe::class,'parent','id');
    }
    //归属总店
    public function parent()
    {
        return $this->hasOne(Cafe::class,'id','parent');
    }
    //Cafe模型类与user_like 用户喜欢模型关联
    public function likes()
    {
        return $this->belongsToMany(User::class,'users_cafes_likes','cafe_id','user_id');
    }
    public function userLike()
    {
        return $this->belongsToMany(User::class, 'users_cafes_likes', 'cafe_id', 'user_id')->where('user_id', auth()->id());
    }
}
