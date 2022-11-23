<?php

namespace Agenciafmd\Admix\UI\Providers;

use Agenciafmd\Admix\UI\Console\UIPublishCommand;
use Agenciafmd\Admix\UI\Console\UIUpdateCommand;
use Illuminate\Support\ServiceProvider;

class ConsoleServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                UIPublishCommand::class,
                UIUpdateCommand::class,
            ]);
        }
    }
}
