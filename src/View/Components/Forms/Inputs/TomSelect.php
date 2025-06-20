<?php

namespace Agenciafmd\Ui\View\Components\Forms\Inputs;

use Illuminate\Support\Facades\View;
use Illuminate\View\Component;

class TomSelect extends Component
{
    public string $formField;

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
        $this->formField = str($this->name)->afterLast('.');
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
                'is-invalid' => $errors->has($name),
            ])>
                <div wire:ignore>
                    <select wire:model.change="{{ $name }}" 
                        x-data="{ 
                            value: $wire.entangle('{{ $name }}'),
                        }"
                        x-init="
                            const tomSelect = new TomSelect($refs.{{ $formField }}, {
                                plugins: ['dropdown_input'],
                                allowEmptyOption: true,
                                copyClassesToDropdown: false,
                                dropdownParent: 'body',
                                controlInput: '<input>',
                                render: {
                                    item: function (data, escape) {
                                        if (data.customProperties) {
                                            return '<div><span class=\'dropdown-item-indicator\'>' + data.customProperties + '</span>' + escape(data.text) + '</div>';
                                        }
                                        return '<div>' + escape(data.text) + '</div>';
                                    },
                                    option: function (data, escape) {
                                        if (data.customProperties) {
                                            return '<div><span class=\'dropdown-item-indicator\'>' + data.customProperties + '</span>' + escape(data.text) + '</div>';
                                        }
                                        return '<div>' + escape(data.text) + '</div>';
                                    },
                                }                            
                            });
                            tomSelect.on('change', (value) => {
                                this.value = value;
                                console.log(this.hasErrors);
                            });
                        "
                        x-ref="{{ $formField }}"
                        x-cloak    
                        {{ $attributes->merge([
                                'id' => $name . $uuid,
                                'autocomplete' => 'off',
                            ])->class(array_merge($defaultClass, [
                                'is-invalid' => $errors->has($name),
                            ]))
                        }}
                    >
                    @foreach($options as $option)
                        <option 
                            value="{{ $option['value'] }}" 
                            @disabled(isset($option['disabled']) && ($option['disabled']))
                            @isset($option['custom-property'])
                                data-custom-properties="{{ $option['custom-property'] }}"
                            @endif
                        >
                            {{ $option['label'] }}
                        </option>
                    @endforeach
                    </select>
                </div>
            </div>
            <x-form.error field="{{ $name }}"/>
            <x-form.hint message="{{ $hint }}"/>
        HTML;
    }
}
