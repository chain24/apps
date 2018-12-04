<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 18.11.26
 * Time: 17:16
 */

namespace App\Contracts;


interface PostServiceContract
{
    /**
     * 查找所有的帖子集合
     * @return mixed
     */
    public function findAllPosts();

    /**
     * 查找单个帖子
     * @param $id
     * @return mixed
     */
    public function findPost($id);


    /**
     * 修改和新增
     * @param PostContract $postContract
     * @return mixed
     */
    public function savePost(PostContract $postContract);

    /**
     * 删除单个帖子
     * @param $id
     * @return mixed
     */
    public function deletePost($id);
}