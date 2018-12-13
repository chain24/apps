<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cafe extends Model
{
    //Cafe 模型类与 BrewMethod 模型类之间的多对多关联
    public function brewMethods()
    {
        return $this->belongsToMany(BrewMethod::class,'cafes_brew_methods','cafe_id','brew_method_id');
    }
}
