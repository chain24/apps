<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 18.11.26
 * Time: 16:41
 */

namespace App\Services;


use App\Contracts\TestContract;

class TestService implements TestContract
{

    public function callMe($controller)
    {
        dd('Call Me From TestServiceProvider In '.$controller);
    }
}