<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 18.11.26
 * Time: 17:28
 */

namespace App\Contracts;


interface PostMapper
{
    /**
     * @param int|string $id
     * @return PostContract
     * @throws \InvalidArgumentException
     */
    public function find($id);

    /**
     * @return array|PostContract[]
     */
    public function findAll();

    /**
     * @param PostContract
     * @return mixed
     */
    public function save(PostContract $post);

    /**
     * @param $id
     * @return bool
     */
    public function delete($id);
}