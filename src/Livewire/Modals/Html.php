<?php

namespace Agenciafmd\Ui\Livewire\Modals;

use Illuminate\Contracts\View\View;

class Html extends Modal
{
    public string $title = '';

    public string $message = '';

    protected $listeners = [
        'showHtml' => 'showHtml',
    ];

    public function showHtml(string $message): void
    {
        $this->show = true;
        $this->title = __('Information');
        $this->message = $message;
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
                             x-bind:style="{'display': show ? 'block' : 'none'}"> <!-- type="info" -->
                        {!! $message !!}
                    </x-modal>
                </div>
            </div>
            HTML;
    }
}
