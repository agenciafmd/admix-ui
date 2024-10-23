<?php

namespace Agenciafmd\Ui\View\Components\Buttons;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Trash extends Component
{
    public string $label;

    public string $href;

    public function __construct(?string $label = null, ?string $href = null)
    {
        $this->label = __('Trash :name', ['name' => $label]);
        $this->href = $href;
    }

    public function render(): string|View
    {
        return <<<'HTML'
            <a href="{{ $href }}"
                    {{ $attributes->class(['btn btn-warning']) }}
                    {{ $attributes }}>
                @if($slot->isEmpty())
                    <x-tblr-icon name="trash" class="icon d-sm-none d-block m-0"/>
                    <span class="d-none d-sm-block">
                        {{ $fallback }}
                    </span>
                @else
                    {{ $slot }}
                @endif
            </a>
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
