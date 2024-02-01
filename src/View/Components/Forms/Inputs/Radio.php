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
        public string $inline = '',
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
            @foreach($values as $key => $value)
                <label class="form-check @if($inline) form-check-inline @endif">
                    <input type="radio" name="{{ $name }}" wire:model="{{ $name }}" {{ $attributes->merge([
                                    'id' => $name . $uuid,
                                    'value' => $key,
                                ])->class([
                                    'form-check-input',
                                    'is-invalid' => $errors->has($name),
                            ])
                        }}
                    />
                    <span for="{{ $name . $uuid }}" @class(['required' => $attributes->has('required')])>
                        {{ str($value)->lower()->ucfirst() }}
                    </span>
                </label>
            @endforeach
            <x-form.error field="{{ $name }}"/>
            <x-form.hint message="{{ $hint }}"/>
        HTML;
    }
}
