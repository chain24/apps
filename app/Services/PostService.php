<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 18.11.26
 * Time: 17:22
 */

namespace App\Services;


use App\Contracts\PostContract;
use App\Contracts\PostMapper;
use App\Contracts\PostServiceContract;

class PostService implements PostServiceContract
{

    protected $postMapper;
    public function __construct(PostMapper $postMapper)
    {
        $this->postMapper = $postMapper;
    }

    /**
     * 查找所有的帖子集合
     * @return mixed
     */
    public function findAllPosts()
    {
        return $this->postMapper->findAll();
    }

    /**
     * 查找单个帖子
     * @param $id
     * @return mixed
     */
    public function findPost($id)
    {
       return $this->postMapper->find($id);
    }

    /**
     * 修改和新增
     * @return mixed
     */
    public function savePost(PostContract $postContract)
    {
        // TODO: Implement savePost() method.
    }

    /**
     * 删除单个帖子
     * @param $id
     * @return mixed
     */
    public function deletePost($id)
    {
        // TODO: Implement deletePost() method.
    }
}