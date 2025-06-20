<?php

namespace Agenciafmd\Ui\Livewire\Modals;

use Illuminate\Contracts\View\View;

class Options extends Modal
{
    public string $title = '';

    public string $message = '';

    public string $location = '';

    public array $options = [];

    protected $listeners = [
        'showLocationOptions' => 'showLocationOptions',
    ];

    public function showLocationOptions(array $options): void
    {
        $this->show = true;
        $this->type = 'primary';
        $this->title = __('Location');
        $this->options = $options;
    }

    public function validateAndDispatch(): void
    {
        $this->validate(
            rules: ['location' => 'required'],
            attributes: ['location' => __('admix-banners::fields.location')],
        );

        $this->dispatch('createWithLocation', $this->location);
    }

    public function render(): string|View
    {
        return <<<'HTML'
            <div>
                <div x-data="{ show: $wire.entangle('show'), location: $wire.entangle('location') }"
                     x-show="show"
                     x-on:keydown.escape.window="show = false">
                    <x-modal wire:model="show"
                             :title="$title"
                             x-bind:class="{'show': show}"
                             x-bind:aria-hidden="show ? false : true"
                             x-bind:style="{'display': show ? 'block' : 'none'}">
                             <select wire:model.change="location"
                                 @class([
                                    'form-select',
                                    'is-invalid' => $errors->has('location')
                                ])
                             >
                                @foreach($options as $option)
                                    <option value="{{ $option['value'] }}">{{ $option['label'] }}</option>
                                @endforeach
                            </select>
                            <x-form.error field="location"/>
                        <x-slot name="footer">
                            <button x-on:click="show = false" class="btn me-auto">{{ __('Cancel') }}</button>
                            <button wire:click="validateAndDispatch"
                                    class="btn btn-{{ $type }}">
                                {{ __('Create') }}
                            </button>
                        </x-slot>
                    </x-modal>
                </div>
            </div>
            HTML;
    }
}
