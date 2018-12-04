<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 18.11.27
 * Time: 9:18
 */

namespace App\Services;


use App\Contracts\PostContract;
use App\Contracts\PostMapper;
use App\Models\Blog\Posts;
use Illuminate\Support\Facades\DB;

class PostMapperService implements PostMapper
{

    /**
     * @param int|string $id
     * @return PostContract
     * @throws \InvalidArgumentException
     */
    public function find($id)
    {
       $post = DB::table('posts')->where('id',$id)->first();
    }

    /**
     * @return array|PostContract[]
     */
    public function findAll()
    {
        $posts = DB::table('posts')->get();
        return $posts;
    }

    /**
     * @param PostContract
     * @return mixed
     */
    public function save(PostContract $post)
    {
        // TODO: Implement save() method.
    }

    /**
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        // TODO: Implement delete() method.
    }
}