<?php

namespace Agenciafmd\Ui\View\Components\Forms;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Error extends Component
{
    public function __construct(
        public string $field,
        public string $bag = 'default',
    ) {}

    public function render(): string|View
    {
        return <<<'HTML'
            @error($field, $bag)
                <div {{ $attributes->class(['invalid-feedback']) }}>
                    {{ $message }}
                </div>
            @enderror
        HTML;
    }
}
