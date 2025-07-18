<?php

namespace Agenciafmd\Ui\Providers;

use Agenciafmd\Ui\Livewire\Modals;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\Compilers\BladeCompiler;
use Livewire\Livewire;

class LivewireServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->callAfterResolving(BladeCompiler::class, static function (BladeCompiler $blade) {
            Livewire::component('modal.confirm', Modals\Confirm::class);
            Livewire::component('modal.options', Modals\Options::class);
            Livewire::component('modal.html', Modals\Html::class);
        });
    }

    public function register(): void
    {
        //
    }
}
