<?php

namespace Agenciafmd\Ui\View\Components\Forms;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Label extends Component
{
    public function __construct(
        public string $for = '',
    ) {}

    public function render(): string|View
    {
        return <<<'HTML'
            <label {{ $attributes->merge(['for' => $for])->class(['form-label']) }}>
                {{ ($slot->isEmpty()) ? $fallback : $slot }}
            </label>
        HTML;
    }

    public function fallback(): string
    {
        return str($this->for)
            ->ucfirst()
            ->replace('_', ' ');
    }
}
