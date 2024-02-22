<?php

namespace Agenciafmd\Ui\View\Components\Modal;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Body extends Component
{
    public function render(): string|View
    {
        return <<<'HTML'
                <div {{ $attributes->class(['modal-body']) }}>
                    {{ $slot }}
                </div>        
            HTML;
    }
}
