<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 19.4.3
 * Time: 17:36
 */

namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function getUser()
    {
        return Auth::guard('api')->user();
    }
}