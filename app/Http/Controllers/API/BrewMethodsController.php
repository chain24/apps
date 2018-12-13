<?php

namespace App\Http\Controllers\API;

use App\Models\BrewMethod;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BrewMethodsController extends Controller
{

    /**
     * 获取所有的cafe冲泡方法
     * 请求API 、api/v1/brew-method
     * Get
     * @return \Illuminate\Http\JsonResponse
     */
    public function getBrewMethods()
    {
        $brewMethods = BrewMethod::withCount('cafes')->get();
        return response()->json($brewMethods);
    }
}
