<?php

namespace App\Http\Controllers\Post;

use App\Events\PostViewEvent;
use App\Models\Post\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class PostController extends Controller
{
    private $cacheExpires = 5*60;
    public function showPost(Request $request,$id)
    {
        //Redis缓存中没有该post,则从数据库中取值,并存入Redis中,该键值key='posts:cache'.$id生命时间5分钟
        $post = Cache::remember('posts:cache:'.$id, $this->cacheExpires, function () use ($id) {
            return Post::whereId($id)->first();
        });

        //获取客户端请求的IP
        $ip = $request->ip();

        //触发浏览次数统计时间
        event(new PostViewEvent($post, $ip));

        return view('posts.show', compact('post'));
    }
}
