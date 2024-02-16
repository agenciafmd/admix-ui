<?php

namespace Agenciafmd\Ui\View\Components\Forms\Inputs;

use Illuminate\Support\Facades\View;
use Illuminate\View\Component;

class Textarea extends Component
{
    public string $uuid;

    public function __construct(
        public string $name = '',
        public string $label = '',
        public string $hint = '',
        public int $rows = 10,
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
            <textarea wire:model="{{ $name }}" {{ $attributes->merge([
                                    'id' => $name . $uuid,
                                    'rows' => $rows,
                                ])->class([
                                    'form-control',
                                    'is-invalid' => $errors->has($name),
                            ])
                        }}
                    ></textarea>
            <x-form.error field="{{ $name }}"/>
            <x-form.hint message="{{ $hint }}"/>
        HTML;
    }
}
