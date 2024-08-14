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
                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="icon d-sm-none d-block m-0"
                         width="24"
                         height="24"
                         viewBox="0 0 24 24"
                         stroke-width="2"
                         stroke="currentColor"
                         fill="none"
                         stroke-linecap="round"
                         stroke-linejoin="round"
                    >
                        <use xlink:href="{{ asset('vendor/admix-ui/images/tabler-sprite.svg') }}#tabler-trash"/>
                    </svg>
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
