<?php

namespace Agenciafmd\Ui\Console\Commands;

use Illuminate\Console\Command;

class UiUpdateCommand extends Command
{
    protected $signature = 'admix:ui-update {--tag=dev : Versão do tabler que será instalada}';

    protected $description = 'Atualiza o tabler para a versão desejada';

    public function handle(): int
    {
        $this->line('');
        $this->components->error('Implementar / Olhar o admix:install');

        return static::SUCCESS;
    }
}
