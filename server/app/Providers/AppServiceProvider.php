<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Blog\BlogRepository;
use App\Repositories\Blog\BlogRepositoryInterface;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerBlogRepository();
        $this->registerUserRepository();
    }

    public function registerBlogRepository()
    {
        $this->app->bind(BlogRepositoryInterface::class, BlogRepository::class);
    }

    public function registerUserRepository()
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
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
