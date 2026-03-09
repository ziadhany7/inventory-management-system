<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Container\Attributes\Auth;

use App\Repositories\Interfaces\StockRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;

use App\Repositories\Eloquent\StockRepository;
use App\Repositories\Eloquent\UserRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Repositories
        $this->app->bind(StockRepositoryInterface::class, StockRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }
    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
