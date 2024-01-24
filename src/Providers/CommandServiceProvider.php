<?php

namespace Agenciafmd\Ui\Providers;

use Agenciafmd\Ui\Console\Commands\UiPublishCommand;
use Agenciafmd\Ui\Console\Commands\UiUpdateCommand;
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
