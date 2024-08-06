<?php

namespace Agenciafmd\Ui\View\Components\Pages;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Header extends Component
{
    public function __construct(
        public string $title = '',
        public string $actions = '',
    ) {}

    public function render(): string|View
    {
        return <<<'HTML'
            <div class="page-header d-print-none">
                <div class="container-xl">
                    <div class="row g-2 align-items-center">
                        <div class="col">
                            <h2 {{ $attributes->class(['page-title']) }}>
                                {{ ($slot->isEmpty()) ? $fallback : $slot }}
                            </h2>
                        </div>
                        <div class="col-auto ms-auto d-print-none">
                            {{ $actions }}
                        </div>
                    </div>
                </div>
            </div>
        HTML;
    }

    public function fallback(): string
    {
        return str($this->title)
            ->stripTags()
            ->squish();
    }
}
