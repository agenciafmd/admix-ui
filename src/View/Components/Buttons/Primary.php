<?php

namespace Agenciafmd\Ui\View\Components\Buttons;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Primary extends Component
{
    public function __construct(
        public string $label = '',
    ) {
        $this->label = $label ?: __('Save');
    }

    public function render(): string|View
    {
        return <<<'HTML'
            <button {{ $attributes->merge(['type' => 'submit'])->class(['btn btn-primary']) }}>
                {{ ($slot->isEmpty()) ? $fallback : $slot }}
            </button>
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
