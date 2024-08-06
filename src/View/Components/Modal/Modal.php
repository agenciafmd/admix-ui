<?php

namespace Agenciafmd\Ui\View\Components\Modal;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Modal extends Component
{
    public function __construct(
        public string $title = '',
        public string $header = '',
        public string $footer = '',
    ) {}

    public function render(): string|View
    {
        return <<<'HTML'
            <div {{ $attributes->merge([
                'tabindex' => '-1',
                'role' => 'dialog',
                'aria-hidden' => 'true',
            ])->class([
                'modal', 
                'modal-blur', 
                'fade',
            ]) }}>
                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <x-modal.header>
                            @if($title)
                                <x-modal.title>{{ $title }}</x-modal.title>
                                <x-modal.close />
                            @else
                                {{ $header }}
                            @endif
                        </x-modal.header>
                        <x-modal.body>
                            {{ $slot }}
                        </x-modal.body>
                        @if($footer)
                            <x-modal.footer>
                                {{ $footer }}
                            </x-modal.footer>
                        @endif
                    </div>
                </div>
            </div>        
            HTML;
    }
}
