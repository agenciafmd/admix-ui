<?php

namespace Agenciafmd\Ui\View\Components\Pages;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Form extends Component
{
    public function __construct(
        public string $title = '',
        public string $headerActions = '',
        public string $complement = '',
        public string $actions = '',
    ) {}

    public function render(): string|View
    {
        return <<<'HTML'
            <div class="page-wrapper">
                <x-page.header>
                    {{ $title }}
                    <x-slot:actions>
                        {{ $headerActions }}
                    </x-slot:actions>
                </x-page.header>
                <x-page.body>
                    <x-form>
                        <x-card>
                            <div class="row g-0">
                                <div class="col-12 col-md-8 border-end">
                                    <x-card.body>
                                        {{ $slot }}
                                    </x-card.body>
                                </div>
                                <div class="col-12 col-md-4 d-flex flex-column">
                                    <x-card.body>
                                        {{ $complement }}
                                    </x-card.body>
                                </div>
                            </div>
                            <x-card.footer>
                                <div class="d-flex">
                                    @if($actions)
                                        {{ $actions }}
                                    @else
                                        <x-btn.link/>
                                        <x-btn.primary class="ms-auto"/>
                                    @endif
                                </div>
                            </x-card.footer>
                        </x-card>
                    </x-form>
                </x-page.body>
            </div>
        HTML;
    }
}
