<?php

namespace Agenciafmd\Ui\View\Components\Modal;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Title extends Component
{
    public function __construct(
        public string $title = '',
    ) {
    }

    public function render(): string|View
    {
        return <<<'HTML'
                <h3 {{ $attributes->class(['modal-title']) }}>
                    {{ ($slot->isEmpty()) ? $fallback : $slot }}
                </h3>
            HTML;
    }

    public function fallback(): string
    {
        return str($this->title)
            ->stripTags()
            ->squish()
            ->lower()
            ->ucfirst();
    }
}
