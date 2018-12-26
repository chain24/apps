<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 18.12.26
 * Time: 10:34
 */

namespace App\Utilities;


use App\Models\Cafe;
use App\Models\Tag;

class Tagger
{
    public static function tagCafe(Cafe $cafe,$tags,$userId)
    {
        foreach ($tags as $tag){
            $name = trim($tag);
            $newCafeTag = Tag::firstOrNew(array('name' => $name));
            $newCafeTag->name = $name;
            $newCafeTag->save();
            //关联标签和咖啡店
            $cafe->tags()->syncWithoutDetaching([$newCafeTag->id => ['user_id' => $userId]]);
        }
    }
}