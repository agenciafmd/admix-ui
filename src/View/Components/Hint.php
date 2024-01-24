<?php

namespace Agenciafmd\Ui\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Hint extends Component
{
    public function __construct(
        public string $message = ''
    )
    {
    }

    public function render(): string|View
    {
        return <<<'HTML'
            @if(!$slot->isEmpty() || $message)
                <small {{ $attributes->class(['form-hint']) }}>
                    @if($slot->isEmpty())
                        {{ $fallback }}
                    @else
                        {{ $slot }}
                    @endif
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