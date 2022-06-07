<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contract\Service\Post\PostServiceInterface;
use App\Service\Post\PostService;
use App\Contract\Service\User\UserServiceInterface;
use App\Service\User\UserService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // $this->app->bind(PostServiceInterface::class ,PostService::class);
        // $this->app->bind(UserServiceInterface::class, UserService::class);
       $this->app->bind('App\Contract\Dao\User\UserDaoInterface' , 'App\Dao\User\UserDao');
       $this->app->bind('App\Contract\Service\User\UserServiceInterface' , 'App\Service\User\UserService');
       $this->app->bind('App\Contract\Dao\Post\PostDaoInterface' , 'App\Dao\Post\PostDao');
       $this->app->bind('App\Contract\Service\Post\PostServiceInterface' , 'App\Service\Post\PostService');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
