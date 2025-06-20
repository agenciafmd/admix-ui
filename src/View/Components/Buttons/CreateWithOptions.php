<?php

namespace Agenciafmd\Ui\View\Components\Buttons;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CreateWithOptions extends Component
{
    public string $label;

    public array $options;

    public function __construct(?string $label = null, ?array $options = null)
    {
        $this->options = $options;
        $this->label = __('Create :name', ['name' => $label]);
    }

    public function render(): string|View
    {
        return <<<'HTML'
            <button 
                    x-on:click="window.Livewire.dispatchTo('modal.options', 'showLocationOptions', { options: @js($options) })"
                    {{ $attributes->class(['btn btn-primary']) }}
                    {{ $attributes }}
                    >
                @if($slot->isEmpty())
                    <x-tblr-icon name="plus" class="icon d-sm-none d-block m-0"/>
                    <span class="d-none d-sm-block">
                        {{ $fallback }}
                    </span>
                @else
                    {{ $slot }}
                @endif
            </button>
        HTML;
    }

    public function fallback(): string
    {
        return str($this->label)
            ->stripTags()
            ->squish()
            ->lower()
            ->ucfirst();
    }
}
