<?php

namespace Agenciafmd\Ui\Providers;

use Illuminate\Support\ServiceProvider;

class UiServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->bootProviders();
        $this->publish();
    }

    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/admix-ui.php', 'admix-ui');
    }

    public function bootProviders(): void
    {
        $this->app->register(BladeServiceProvider::class);
        $this->app->register(CommandServiceProvider::class);
        $this->app->register(LivewireServiceProvider::class);
        $this->app->register(RouteServiceProvider::class);
    }

    private function publish(): void
    {
        $this->publishes([
            __DIR__ . '/../../resources/views/livewire-tables/vendor/components' => base_path('resources/views/vendor/livewire-tables/components'),
        ], ['admix-ui:views-livewire-tables']);

        $this->publishes([
            __DIR__ . '/../../tabler' => public_path('vendor/admix-ui/tabler'),
        ], 'admix-ui:assets');
    }
}
