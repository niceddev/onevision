<?php

namespace App\Providers;

use App\Contracts\Parser\PostInterface;
use App\Repositories\DummyJSONRepository;
use Illuminate\Support\ServiceProvider;

class ExternalServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(PostInterface::class, DummyJSONRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
