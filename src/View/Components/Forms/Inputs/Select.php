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
        public array $options = [],
        public array $defaultClass = [
            'form-select',
        ],
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
            <select wire:model.change="{{ $name }}" 
                {{ $attributes->merge([
                        'id' => $name . $uuid,
                    ])->class(array_merge($defaultClass, [
                        'is-invalid' => $errors->has($name),
                    ]))
                }}
            >
            @foreach($options as $option)
                <option value="{{ $option['value'] }}" @disabled(isset($option['disabled']) && ($option['disabled']))>{{ $option['label'] }}</option>
            @endforeach
            </select>
            <x-form.error field="{{ $name }}"/>
            <x-form.hint message="{{ $hint }}"/>
        HTML;
    }
}
