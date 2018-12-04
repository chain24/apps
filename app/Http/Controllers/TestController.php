<?php

namespace App\Http\Controllers;

use App\Contracts\TestContract;
use Illuminate\Http\Request;
class TestController extends Controller
{
    //
    protected $test;
    public function __construct(TestContract $test)
    {
        $this->test = $test;
    }
    public function index()
    {
        //$test = App::make('test');
        $this->test->callMe('TestController');
    }
}
