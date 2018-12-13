<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrewMethod extends Model
{
    protected $table = 'brew_methods';
    //定义cafe 与 brew_methods之间多对多的关系
    public function cafes()
    {
        return $this->belongsToMany(Cafe::class, 'cafes_brew_methods','brew_method_id', 'cafe_id');
    }
}
