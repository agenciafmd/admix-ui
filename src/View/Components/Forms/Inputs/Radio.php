<?php

namespace Agenciafmd\Ui\View\Components\Forms\Inputs;

use Illuminate\Support\Facades\View;
use Illuminate\View\Component;

class Radio extends Component
{
    public string $uuid;

    public function __construct(
        public string $name = '',
        public string $label = '',
        public string $hint = '',
        public bool $inline = false,
    ) {
        $this->uuid = '-' . str(serialize($this))
            ->pipe('md5')
            ->limit(5, '')
            ->toString();
    }

    public function render(): string|View
    {
        return <<<'HTML'
            <label @class([
                    'form-check',
                    'required' => $attributes->has('required'),
                    'form-check-inline' => $inline
                ])>
                <input wire:model.change="{{ $name }}" {{ $attributes->merge([
                                    'type' => 'radio',
                                    'name' => $name,
                                    'id' => $name . $uuid,
                                ])->class([
                                    'form-check-input',
                                    'is-invalid' => $errors->has($name),
                            ])
                        }}
                    />
                @if($label)
                    <span class="form-check-label">{{ str($label)->lower()->ucfirst() }}</span>
                @endif
            </label>
            <x-form.error field="{{ $name }}"/>
            <x-form.hint message="{{ $hint }}"/>
        HTML;
    }
}
