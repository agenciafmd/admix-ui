<?php

namespace Agenciafmd\Ui\View\Components\Modal;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Close extends Component
{
    public function render(): string|View
    {
        return <<<'HTML'
                <button {{ $attributes->merge([
                    'type' => 'button',
                    'data-bs-dismiss' => 'modal', 
                    'aria-label' => 'Close',                
                ])->class([
                    'btn-close',
                ]) }}></button>
            HTML;
    }
}
