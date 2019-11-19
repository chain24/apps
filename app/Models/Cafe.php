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
}
