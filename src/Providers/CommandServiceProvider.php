<?php

namespace Agenciafmd\Ui\Providers;

use Agenciafmd\Ui\Commands\UiPublishCommand;
use Agenciafmd\Ui\Commands\UiUpdateCommand;
use Illuminate\Support\ServiceProvider;

class CommandServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if (!$this->app->runningInConsole()) {
            return;
        }

        $this->commands([
            UiPublishCommand::class,
            UiUpdateCommand::class,
        ]);
    }
}
