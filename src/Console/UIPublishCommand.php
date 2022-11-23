<?php

namespace Agenciafmd\Admix\UI\Console;

use Illuminate\Console\Command;

class UIPublishCommand extends Command
{
    protected $signature = 'admix:ui-publish';

    protected $description = 'Publica os arquivos do admix-ui em public/vendor/admix-ui';

    public function handle(): int
    {
        $this->line('');
        $this->components->error('Implementar / Olhar o admix:install');

        return static::SUCCESS;
    }
}