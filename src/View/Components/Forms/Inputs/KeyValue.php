<?php

namespace Agenciafmd\Ui\View\Components\Forms\Inputs;

use Illuminate\Support\Facades\View;
use Illuminate\View\Component;

class KeyValue extends Component
{
    public string $formField;

    public string $uuid;

    public function __construct(
        public string $name = '',
        public string $label = '',
        public string $hint = '',
        public string $keyPlaceholder = 'Key',
        public string $valuePlaceholder = 'Value',
    ) {
        $this->uuid = str(serialize($this))
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
            @forelse($this->form->{$formField} as $key => $item)
                <div wire:key="{{ $name }}-{{ $key }}-{{ $uuid }}"
                     class="col-md-12 px-0 form-group">
                    <div class="row">
                        <div class="col-12 col-md-6 mb-3">
                            <input wire:model.blur="{{ $name }}.{{ $key }}.key" {{ $attributes->merge([
                                                    'type' => 'text',
                                                    'id' => "{$name}-{$key}-key-{$uuid}",
                                                    'placeholder' => $keyPlaceholder,
                                                ])->class([
                                                    'form-control',
                                                    'is-invalid' => $errors->has("{$name}.{$key}.key"),
                                            ])
                                        }}
                                    />
                            <x-form.error field="{{ $name }}.{{ $key }}.key"/>
                        </div>
                        <div class="col mb-3">
                            <input wire:model.blur="{{ $name }}.{{ $key }}.value" {{ $attributes->merge([
                                                    'type' => 'text',
                                                    'id' => "{$name}-{$key}-value-{$uuid}",
                                                    'placeholder' => $valuePlaceholder,
                                                ])->class([
                                                    'form-control',
                                                    'is-invalid' => $errors->has("{$name}.{$key}.value"),
                                            ])
                                        }}
                                    />
                            <x-form.error field="{{ $name }}.{{ $key }}.value"/>
                        </div>
                        <div class="col-auto mb-3">
                            <button wire:click.prevent="keyValueRemove('{{ $formField }}', {{ $key }})"
                                    wire:loading.class="btn-danger btn-loading"
                                    wire:loading.class.remove="btn-outline-danger"
                                    wire:target="keyValueRemove('{{ $formField }}', {{ $key }})"
                                    class="btn btn-icon btn-outline-danger"
                                    type="button">
                                    <x-bs-icon name="x-lg"/>
                            </button>
                        </div>
                    </div>
                </div>
                <x-form.hint message="{{ $hint }}"/>
            @empty
                <x-form.error class="d-block" field="{{ $name }}"/>
            @endforelse
            <div class="form-group mb-0">
                <div class="d-grid">
                    <button wire:click.prevent="keyValueAdd('{{ $formField }}')"
                            wire:loading.class="btn-loading"
                            wire:target="add"
                            class="btn btn-secondary"
                            type="button">
                        {{ str(__('admix-ui::fields.add'))->lower()->ucfirst() }}
                    </button>
                </div>
            </div>
        HTML;
    }
}
