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
            __DIR__ . '/../../tabler' => public_path('vendor/admix-ui/tabler'),
            __DIR__ . '/../../resources/dist/images' => public_path('vendor/admix-ui/images'),
            __DIR__ . '/../../resources/dist/libs' => public_path('vendor/admix-ui/vendor/libs'),
        ], ['admix-ui:assets']);

        $this->publishes([
            __DIR__ . '/../../config/livewire-tables.php' => base_path('config/livewire-tables.php'),
            __DIR__ . '/../../config/media-library.php' => base_path('config/media-library.php'),
        ], ['admix-ui:config']);

        $this->publishes([
            __DIR__ . '/../../resources/views/livewire-tables/vendor/components' => base_path('resources/views/vendor/livewire-tables/components'),
        ], ['admix-ui:views']);
    }
}
