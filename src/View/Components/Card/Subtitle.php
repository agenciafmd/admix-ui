<?php

namespace Agenciafmd\Ui\View\Components\Card;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Subtitle extends Component
{
    public function __construct(
        public string $subtitle = '',
    ) {}

    public function render(): string|View
    {
        return <<<'HTML'
                <p {{ $attributes->class(['card-subtitle']) }}>
                    {{ ($slot->isEmpty()) ? $fallback : $slot }}
                </p>
                
                @pushonce('styles')
                    <style>
                        .card-title .card-subtitle {
                            margin-left: 0;
                        }
                
                        .card-subtitle {
                            margin-bottom: .5rem;
                        }
                    </style>
                @endpushonce
            HTML;
    }

    public function fallback(): string
    {
        return str($this->subtitle)
            ->stripTags()
            ->squish()
            ->lower()
            ->ucfirst();
    }
}
