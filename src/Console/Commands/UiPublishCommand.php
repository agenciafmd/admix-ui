<?php

namespace Agenciafmd\Ui\Console\Commands;

use Illuminate\Console\Command;

class UiPublishCommand extends Command
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
