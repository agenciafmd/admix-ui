<?php

namespace Agenciafmd\Ui\View\Components\Forms\Inputs;

use Illuminate\Support\Facades\View;
use Illuminate\View\Component;

class Toggle extends Component
{
    public string $uuid;

    public function __construct(
        public string $name = '',
        public string $label = '',
        public string $hint = '',
        public string $labelOn = '',
        public string $labelOff = '',
    ) {
        $this->uuid = '-' . str(serialize($this))
            ->pipe('md5')
            ->limit(5, '')
            ->toString();
    }

    public function render(): string|View
    {
//        $classCollection = Str::of($attributes->get('class'))->explode(' ');
//        $labelClass = $classCollection->filter(function (string $value, string $key) {
//            return Str::of($value)->startsWith('form-switch');
//        })->values();
//        $inputClass = $classCollection->filter(function (string $value, string $key) {
//            return !Str::of($value)->startsWith('form-switch');
//        })->values();
//        <label class="form-check form-switch">
//            <input class="form-check-input" type="checkbox" checked="">
//            <span class="form-check-label">Option 1</span>
//        </label>


        return <<<'HTML'
            <label @class([
                    'form-check',
                    'form-switch',
                    'required' => $attributes->has('required'),
                ])>
                <input wire:model.change="{{ $name }}" {{ $attributes->merge([
                                    'type' => 'checkbox',
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
                @if($labelOn)
                    <span class="form-check-label form-check-label-on">{{ str($labelOn)->lower()->ucfirst() }}</span>
                @endif
                @if($labelOff)
                    <span class="form-check-label form-check-label-off">{{ str($labelOff)->lower()->ucfirst() }}</span>
                @endif
            </label>
            <x-form.error field="{{ $name }}"/>
            <x-form.hint message="{{ $hint }}"/>
        HTML;
    }
}
