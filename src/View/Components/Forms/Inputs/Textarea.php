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
        public int $rows = 5,
        public int $cols = 100,
        public int $maxlength = 1000,
    ) {
        $this->uuid = '-' . str(serialize($this))
            ->pipe('md5')
            ->limit(5, '')
            ->toString();
    }

    // solução provisória para skipar a quebra da tag textarea ocorrida no markdown
    public function render(): string|View
    {
        return <<<'HTML'
            @if($label)
                <x-form.label for="{{ $name . $uuid }}" @class(['required' => $attributes->has('required')])>
                    {{ str($label)->lower()->ucfirst() }}
                </x-form.label>
            @endif
            <fmdtextarea wire:model="{{ $name }}" {{ $attributes->merge([
                                    'id' => $name . $uuid,
                                    'rows' => $rows,
                                    'cols' => $cols,
                                    'maxlength' => $maxlength,
                                    'placeholder' => 'teste',
                                ])->class([
                                    'form-control',
                                    'is-invalid' => $errors->has($name),
                            ])
                        }} required></fmdtextarea>
            <x-form.error field="{{ $name }}"/>
            <x-form.hint message="{{ $hint }}"/>
        HTML;
    }
}
