<?php

namespace Agenciafmd\Ui\Livewire\Modals;

use Illuminate\Contracts\View\View;

class Confirm extends Modal
{
    public string $title = '';

    public string $message = '';

    public string $action = '';

    protected $listeners = [
        'showConfirmationToDelete' => 'showConfirmationToDelete',
    ];

    public function showConfirmationToDelete(int $id): void
    {
        $this->show = true;
        $this->type = 'danger';
        $this->title = __('Attention!');
        $this->message = __('Are you sure you want to delete this record?');
        $this->action = "\$dispatch('bulkDelete', { id: {$id} });";
    }

    public function render(): string|View
    {
        return <<<'HTML'
            <div>
                <div x-data="{ show: $wire.entangle('show') }"
                     x-show="show"
                     x-on:keydown.escape.window="show = false">
                    <x-modal wire:model="show"
                             :title="$title"
                             x-on:click="show = false"
                             x-bind:class="{'show': show}"
                             x-bind:aria-hidden="show ? false : true"
                             x-bind:style="{'display': show ? 'block' : 'none'}">
                        {!! $message !!}
                        
                        <x-slot name="footer">
                            <button x-on:click="show = false" class="btn me-auto">{{ __('No') }}</button>
                            <button wire:click="{{ $action }}" class="btn btn-{{ $type }}">{{ __('Yes') }}</button>
                        </x-slot>
                    </x-modal>
                </div>
            </div>
            HTML;
    }
}
