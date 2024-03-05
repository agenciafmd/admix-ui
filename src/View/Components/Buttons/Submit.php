<?php

namespace Agenciafmd\Ui\View\Components\Buttons;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Submit extends Component
{
    public function __construct(
        public string $label = '',
        public string $action = '',
        public string $method = 'POST',
    )
    {
        $this->label = $label ?: __('Send');
        $this->method = strtoupper($method);
    }

    public function render(): string|View
    {
        return <<<'HTML'
            <form method="POST" @if($action) action="{{ $action }}" @endif>
                @csrf
                @method($method)
            
                <button type="submit" {{ $attributes }}>
                    {{ $slot }}
                </button>
            </form>
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
