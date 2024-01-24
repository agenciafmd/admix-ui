<?php

namespace Agenciafmd\Ui\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\Support\ViewErrorBag;
use Illuminate\View\Component;

class Error extends Component
{
    public function __construct(
        public string $field,
        public string $bag = 'default',
    ) {
    }

    public function render(): string|View
    {
        return <<<'HTML'
            @error($field, $bag)
                <div {{ $attributes->class(['invalid-feedback']) }}>
                    @if ($slot->isEmpty())
                        {{ $message }}
                    @else
                        {{ $slot }}
                    @endif
                </div>
            @enderror
        HTML;
    }

    // validar se isso está certo
    public function messages(ViewErrorBag $errors): array
    {
        $bag = $errors->getBag($this->bag);

        return $bag->has($this->field) ? $bag->get($this->field) : [];
    }
}
