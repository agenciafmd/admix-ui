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
    ) {
    }

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
                <div class="page-body">
                    <div class="container-xl">
                        <x-form>
                            <div class="card">
                                <div class="row g-0">
                                    <div class="col-12 col-md-8 border-end">
                                        <div class="card-body">
                                            {{ $slot }}
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4 d-flex flex-column">
                                        <div class="card-body">
                                            {{ $complement }}
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer bg-transparent mt-auto">
                                    <div class="btn-list justify-content-end">
                                        @if($actions)
                                            {{ $actions }}
                                        @else
                                            <x-btn/>
                                            <x-btn.primary/>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </x-form>
                    </div>
                </div>
            </div>
        HTML;
    }
}
