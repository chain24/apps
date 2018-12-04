<?php

namespace App\Http\Controllers\Blog;

use App\Contracts\PostServiceContract;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ListController extends Controller
{
    protected $serviceContract;
    public function __construct(PostServiceContract $serviceContract)
    {
        $this->serviceContract = $serviceContract;
    }

    public function index()
    {
        $data = $this->serviceContract->findAllPosts();
        return view('blog.list.index',['data' => $data]);
    }

}
