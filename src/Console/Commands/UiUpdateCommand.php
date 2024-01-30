<?php

namespace Agenciafmd\Ui\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Process\Pipe;
use Illuminate\Support\Facades\Process;

class UiUpdateCommand extends Command
{
    protected $signature = 'admix:ui-update {--tag= : Versão do tabler que será instalada}';

    protected $description = 'Atualiza o tabler para a versão desejada';

    public function handle(): int
    {
        $tag = $this->option('tag') ?? config('admix-ui.tabler.version');

        $this->components->info('Atualizando o tabler para a versão ' . $tag);

        $result = Process::pipe(static function (Pipe $pipe) use ($tag) {
            $pipe->path(config('admix-ui.tabler.path'))
                ->command('rm -rf tabler');
            $pipe->path(config('admix-ui.tabler.path'))
                ->command('git clone --depth 1 --branch ' . $tag . ' git@github.com:tabler/tabler.git');
            $pipe->path(config('admix-ui.tabler.path'))
                ->command('rm -rf tabler/.git');
        });

        return $result->successful() ? static::SUCCESS : static::FAILURE;
    }
}
