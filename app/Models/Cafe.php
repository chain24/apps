<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cafe extends Model
{
    public function isDuplicateAddCafes( $data )
    {
        if ( is_array($data) && $data ){
            return Cafe::where($data)->first();
        }
        return false;
    }

    public function brewMethods()
    {
        return $this->belongsToMany(BrewMethod::class, 'cafes_brew_methods', 'cafe_id', 'brew_method_id');
    }
}
