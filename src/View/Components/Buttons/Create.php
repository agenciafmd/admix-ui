<?php

namespace Agenciafmd\Ui\View\Components\Buttons;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Create extends Component
{
    public string $label;
    public string $href;

    public function __construct(string $label = null, string $href = null)
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
                        <use xlink:href="{{ asset('vendor/admix/images/tabler-sprite.svg') }}#tabler-plus"/>
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
        return Str::of($this->label)
            ->stripTags()
            ->squish()
            ->lower()
            ->ucfirst();
    }
}