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
            <div x-data="{ count: 0 }" x-init="count = $refs.fieldToCount.value.length">
                @if($label)
                    <x-form.label for="{{ $name . $uuid }}" @class(['required' => $attributes->has('required')])>
                        {{ str($label)->lower()->ucfirst() }}
                        @if($attributes->has('maxlength'))
                            <span class="form-label-description">
                            <span x-html="count"></span>/<span x-html="$refs.fieldToCount.maxLength"></span></span>
                        @endif
                    </x-form.label>
                @endif
                <textarea wire:model.blur="{{ $name }}" 
                    {{ $attributes->merge([
                            'id' => $name . $uuid,
                            'rows' => $rows,
                        ])->class([
                            'form-control',
                            'is-invalid' => $errors->has($name),
                        ])
                    }}
                    x-ref="fieldToCount" 
                    x-on:keyup="count = $refs.fieldToCount.value.length"
                ></textarea>
                <x-form.error field="{{ $name }}"/>
                <x-form.hint message="{{ $hint }}"/>
            </div>
        HTML;
    }
}
