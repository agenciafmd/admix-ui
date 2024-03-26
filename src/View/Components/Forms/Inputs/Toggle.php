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
        public bool $large = false,
        public bool $single = false,
    ) {
        $this->uuid = '-' . str(serialize($this))
            ->pipe('md5')
            ->limit(5, '')
            ->toString();
    }

    public function render(): string|View
    {
        return <<<'HTML'
            @if($single)
                <label @class([
                        'row',
                        'required' => $attributes->has('required'),
                    ])>
                    <span class="col">{{ str($label)->lower()->ucfirst() }}</span>
                        <span class="col-auto">
                        <label class="form-check form-check-single form-switch">
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
                        </label>
                    </span>
                </label>
            @else
                <label @class([
                        'form-check',
                        'form-switch',
                        'form-switch-lg' => $large,
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
            @endif
            <x-form.error field="{{ $name }}"/>
            <x-form.hint message="{{ $hint }}"/>
        HTML;
    }
}
