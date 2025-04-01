<?php

namespace Agenciafmd\Ui\View\Components\Forms\Inputs;

use Illuminate\Support\Facades\View;
use Illuminate\View\Component;

class PendedInput extends Component
{
    public string $uuid;

    public function __construct(
        public string $name = '',
        public string $label = '',
        public string $hint = '',
        public string $prepend = '',
        public string $append = '',
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
                <x-form.label for="{{ $name . $uuid }}" @class(['required' => $attributes->has('required')])>
                    {{ str($label)->lower()->ucfirst() }}
                </x-form.label>
            @endif
            <div @class([
                    'input-group', 
                    'input-group-flat',
                    'is-invalid' => $errors->has($name),
                ])>
                @if($prepend)
                    <span class="input-group-text">{{ $prepend }}</span>
                @endif
                <input wire:model.blur="{{ $name }}" {{ $attributes->merge([
                                        'type' => 'text',
                                        'id' => $name . $uuid,
                                    ])->class([
                                        'form-control',
                                        'ps-0' => $prepend,
                                        'text-end pe-0' => $append,
                                        'is-invalid' => $errors->has($name),
                                ])
                            }}
                        />
                @if($append)
                    <span class="input-group-text">{{ $append }}</span>
                @endif
            </div>            
            <x-form.error field="{{ $name }}"/>
            <x-form.hint message="{{ $hint }}"/>
        HTML;
    }
}
