<?php

namespace Agenciafmd\Ui\View\Components\Buttons;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Create extends Component
{
    public string $label;

    public string $href;

    public function __construct(?string $label = null, ?string $href = null)
    {
        $this->label = __('Create :name', ['name' => $label]);
        $this->href = $href;
    }

    public function render(): string|View
    {
        return <<<'HTML'
            <a href="{{ $href }}"
                    {{ $attributes->class(['btn btn-primary']) }}
                    {{ $attributes }}>
                @if($slot->isEmpty())
                    <x-tblr-icon name="plus" class="icon d-sm-none d-block m-0"/>
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
