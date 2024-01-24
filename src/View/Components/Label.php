<?php

namespace Agenciafmd\Ui\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Label extends Component
{
    public function __construct(
        public string $for = '',
    ) {
    }

    public function render(): string|View
    {
        return <<<'HTML'
            <label for="{{ $for }}" {{ $attributes->class(['form-label']) }}>
                @if($slot->isEmpty())
                    {{ $fallback }}
                @else
                    {{ $slot }}
                @endif
            </label>
        HTML;
    }

    public function fallback(): string
    {
        return Str::of($this->for)
            ->ucfirst()
            ->replace('_', ' ');
    }
}
