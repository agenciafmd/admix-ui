<?php

namespace Agenciafmd\Ui\View\Components\Forms\Inputs;

use Illuminate\Support\Facades\View;
use Illuminate\View\Component;

class ToggleNotification extends Component
{
    public string $uuid;

    public function __construct(
        public string $name = '',
        public string $label = '',
        public string $hint = '',
        public string $inline = '',
        public string $notification = '',
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
            <div class="divide-y">
            @foreach($values as $key => $value)
                <div>
                    <label class="row">
                        <span class="col">{{ str($value['name'])->lower()->ucfirst() }}</span>
                        <span class="col-auto">
                            <label class="form-check @if($inline) form-check-inline @endif form-check-single form-switch">
                                <input type="checkbox" @if($value['value'] == 'Push Notifications') checked @endif name="{{ $name }}" wire:model="{{ $name }}" {{ $attributes->merge([
                                                'id' => $name . $uuid,
                                                'value' => $value['value'],
                                            ])->class([
                                                'form-check-input',
                                                'is-invalid' => $errors->has($name),
                                        ])
                                    }}
                                />
                            </label>
                        </span>
                   </label>
                </div>
            @endforeach
            <x-form.error field="{{ $name }}"/>
            <x-form.hint message="{{ $hint }}"/>
            </div>
        HTML;
    }
}
