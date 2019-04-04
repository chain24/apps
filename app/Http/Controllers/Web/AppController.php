<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AppController extends Controller
{
    public function getApp()
    {
        return view('app');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

}
