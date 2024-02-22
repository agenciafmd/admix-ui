<?php

namespace Agenciafmd\Ui\View\Components\Modal;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Footer extends Component
{
    public function render(): string|View
    {
        return <<<'HTML'
                <div {{ $attributes->class(['modal-footer']) }}>
                    {{ $slot }}
                </div>        
            HTML;
    }
}
