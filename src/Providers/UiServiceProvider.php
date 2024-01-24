<?php

namespace Agenciafmd\Ui\Providers;

use Illuminate\Support\ServiceProvider;

class UiServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->bootProviders();
    }

    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/admix-ui.php', 'admix-ui');
    }

    public function bootProviders(): void
    {
        $this->app->register(BladeServiceProvider::class);
        $this->app->register(CommandServiceProvider::class);
        $this->app->register(RouteServiceProvider::class);
    }
}
