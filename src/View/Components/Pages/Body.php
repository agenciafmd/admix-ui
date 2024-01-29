<?php

namespace Agenciafmd\Ui\View\Components\Pages;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Body extends Component
{
    public function render(): string|View
    {
        return <<<'HTML'
                <div class="page-body">
                    <div class="container-xl">
                        {{ $slot }}
                    </div>
                </div>
            HTML;
    }
}
