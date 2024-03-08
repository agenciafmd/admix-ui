<?php

namespace Agenciafmd\Ui\View\Components\Buttons;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Primary extends Component
{
    public function __construct(
        public string $label = '',
        public bool $spinner = true,
    ) {
        $this->label = $label ?: __('Save');
    }

    public function render(): string|View
    {
        return <<<'HTML'
            <button {{ $attributes->merge([
                        'wire:loading.attr' => 'disabled',
                        'wire:target' => 'submit',
                        'type' => 'submit',
                    ])->class(['btn btn-primary']) }}>
                @if($spinner)
                    <span wire:loading wire:target="submit" class="spinner-border spinner-border-sm me-2"></span>
                @endif
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
