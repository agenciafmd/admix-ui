<?php

namespace Agenciafmd\Ui\View\Components\Buttons;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Button extends Component
{
    public function __construct(
        public string $label = '',
    ) {
        $this->label = $label ?: __('Cancel');
    }

    public function render(): string|View
    {
        return <<<'HTML'
            <a {{ $attributes->merge(['href' => (session()->get('backUrl')) ?: '#'])->class(['btn']) }}>
                {{ ($slot->isEmpty()) ? $fallback : $slot }}
            </a>
        HTML;
    }

    public function fallback(): string
    {
        return str($this->label)
            ->stripTags()
            ->squish()
            ->lower()
            ->ucfirst();
    }
}
