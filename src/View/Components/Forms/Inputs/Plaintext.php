<?php

namespace Agenciafmd\Ui\View\Components\Forms\Inputs;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Plaintext extends Component
{
    public string $uuid;

    public function __construct(
        public string $value = '',
        public string $label = '',
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
                <x-form.label for="plaintext-{{ $label . $uuid }}">
                    {{ str($label)->lower()->ucfirst() }}
                </x-form.label>
            @endif
            <div class="form-control-plaintext" id="plaintext-{{ $label . $uuid }}">{{ $value }}</div>
        HTML;
    }
}
