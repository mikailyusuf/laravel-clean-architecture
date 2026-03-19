<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            \App\Domain\Repositories\UserRepositoryInterface::class,
            \App\Infrastructure\Persistence\Repositories\UserRepository::class
        );

        $this->app->bind(
            \App\Domain\Repositories\OrderRepositoryInterface::class,
            \App\Infrastructure\Persistence\Repositories\OrderRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
