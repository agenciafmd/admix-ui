<?php

namespace Agenciafmd\Admix\UI\Providers;

use Illuminate\Support\ServiceProvider;

class AdmixUIServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->providers();
    }

    public function register(): void
    {
        //
    }

    protected function providers()
    {
        $this->app->register(ConsoleServiceProvider::class);
    }
}
