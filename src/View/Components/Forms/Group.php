<?php

namespace Agenciafmd\Ui\View\Components\Forms;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Group extends Component
{
    public function __construct(
        public string $name = '',
        public string $label = '',
        public string $hint = '',
    ) {}

    public function render(): string|View
    {
        return <<<'HTML'
            @if($label)
                <x-form.label for="{{ $name }}" @class(['required' => $attributes->has('required')])>
                    {{ str($label)->lower()->ucfirst() }}
                </x-form.label>
            @endif
        
            {{ $slot }}

            <x-form.error field="{{ $name }}"/>
            <x-form.hint message="{{ $hint }}"/>
        HTML;
    }
}
