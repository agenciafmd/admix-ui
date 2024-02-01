<?php

namespace Agenciafmd\Ui\View\Components\Forms\Inputs;

use Illuminate\Support\Facades\View;
use Illuminate\View\Component;

class Select extends Component
{
    public string $uuid;

    public function __construct(
        public string $name = '',
        public string $label = '',
        public string $hint = '',
        public array $values = [],
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
            <select wire:model="{{ $name }}" {{ $attributes->merge([
                                    'type' => 'text',
                                    'id' => $name . $uuid,
                                ])->class([
                                    'form-select',
                                    'is-invalid' => $errors->has($name),
                            ])
                        }}
                    >
                    <option value="">-</option>
                    @foreach($values as $key => $value)
                        <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                    </select>
            <x-form.error field="{{ $name }}"/>
            <x-form.hint message="{{ $hint }}"/>
        HTML;
    }
}
