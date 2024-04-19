<?php

namespace Agenciafmd\Ui\Livewire\Modals;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class Modal extends Component
{
    public bool $show = false;
    public string $type = 'primary';

    protected $listeners = [
        'show' => 'show',
    ];

    public function show(): void
    {
        $this->show = true;
    }

    public function render(): string|View
    {
        return <<<'HTML'
            <!-- placeholder -->
        HTML;
    }
}