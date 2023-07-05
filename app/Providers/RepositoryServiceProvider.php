<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\IPostRepository;
use App\Repositories\PostRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(IPostRepository::class, PostRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
