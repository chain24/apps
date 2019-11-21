<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Blog\Posts
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Posts newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Posts newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Posts query()
 * @mixin \Eloquent
 */
class Posts extends Model
{
    protected $table = 'posts';
    public $timestamps = false;
}
