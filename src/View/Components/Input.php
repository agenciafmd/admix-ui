<?php

namespace Agenciafmd\Ui\View\Components;

use Illuminate\Support\Facades\View;
use Illuminate\View\Component;

class Input extends Component
{
    public string $uuid;

    public function __construct(
        public string $name = '',
        public string $label = '',
        public string $hint = '',
    ) {
        $this->uuid = '-' . str(serialize($this))
            ->pipe('md5')
            ->limit(5, '')
            ->toString();
    }

    public function render(): string|View
    {
        return <<<'HTML'
            @if($label)
                <x-label for="{{ $name . $uuid }}">
                    {{ str($label)->ucfirst() }}
                </x-label>
            @endif
            <input wire:model="{{ $name }}" {{ $attributes->merge([
                                    'type' => 'text',
                                    'id' => $name . $uuid,
                                ])->class([
                                    'form-control',
                                    'is-invalid' => $errors->has($name),
                            ])
                        }}
                    />
            <x-error field="{{ $name }}"/>
            <x-hint message="{{ $hint }}"/>
        HTML;
    }
}
