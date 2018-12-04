<?php

namespace App\Providers;

use App\Services\PostMapperService;
use Illuminate\Support\ServiceProvider;

class PostMapperServiceProvider extends ServiceProvider
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
        $this->app->singleton('PostMapper',function (){
            return new PostMapperService();
        });

        $this->app->bind('App\Contracts\PostMapper',function (){
            return new PostMapperService();
        });
    }
}
