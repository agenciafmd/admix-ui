<?php

namespace Agenciafmd\Ui\View\Components\Forms;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Hint extends Component
{
    public function __construct(
        public string $message = ''
    ) {
    }

    public function render(): string|View
    {
        return <<<'HTML'
            @if(!$slot->isEmpty() || $message)
                <small {{ $attributes->class(['form-hint']) }}>
                    {{ ($slot->isEmpty()) ? $fallback : $slot }}
                </small>
            @endif
        HTML;
    }

    public function fallback(): string
    {
        return str($this->message)
            ->stripTags()
            ->squish();
    }
}
