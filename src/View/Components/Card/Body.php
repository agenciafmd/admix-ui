<?php

namespace Agenciafmd\Ui\View\Components\Card;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Body extends Component
{
    public function render(): string|View
    {
        return <<<'HTML'
                <div {{ $attributes->class(['card-body']) }}>
                    {{ $slot }}
                </div>        
            HTML;
    }
}
