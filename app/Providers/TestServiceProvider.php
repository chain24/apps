<?php

namespace App\Providers;

use App\Services\TestService;
use Illuminate\Support\ServiceProvider;

class TestServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //使用singleton绑定单例
        $this->app->singleton('test',function (){
            return new TestService();
        });
        //使用bind绑定实例到接口以便注入依赖
        $this->app->bind('App\Contracts\TestContract',function (){
            return new TestService();
        });
    }
}
