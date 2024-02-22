<?php

namespace Agenciafmd\Ui\View\Components\Forms;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Form extends Component
{
    public function render(): string|View
    {
        return <<<'HTML'
            <form {{ $attributes->merge(['wire:submit.prevent' => 'save']) }}>
                {{ $slot }}
            </form>
        HTML;
    }
}
