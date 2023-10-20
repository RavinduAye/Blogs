<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Blog\BlogRepository;
use App\Repositories\Blog\BlogRepositoryInterface;

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
    }

    public function registerBlogRepository()
    {
        $this->app->bind(BlogRepositoryInterface::class, BlogRepository::class);
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
