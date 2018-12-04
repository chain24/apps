<?php

namespace App\Providers;

use App\Services\PostService;
use Illuminate\Support\ServiceProvider;

class PostServiceProvider extends ServiceProvider
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
        $this->app->singleton('serviceContract',function (){
            $PostMapper = $this->app->get('App\Contracts\PostMapper');
            return new PostService($PostMapper);
        });

        $this->app->bind('App\Contracts\PostServiceContract',function (){
            $PostMapper = $this->app->get('App\Contracts\PostMapper');
            return new PostService($PostMapper);
        });
    }
}
