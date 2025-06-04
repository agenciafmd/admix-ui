<?php

namespace Agenciafmd\Ui\View\Components\Forms\Inputs;

use Illuminate\Support\Facades\View;
use Illuminate\View\Component;

class Password extends Component
{
    public string $uuid;

    public function __construct(
        public string $name = '',
        public string $label = '',
        public string $hint = '',
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
                <x-form.label for="{{ $name . $uuid }}" @class(['required' => $attributes->has('required')])>
                    {{ str($label)->lower()->ucfirst() }}
                </x-form.label>
            @endif
            <div @class([
                    'input-group', 
                    'input-group-flat',
                    'is-invalid' => $errors->has($name),
                ]) x-data="{ isPassword: true }">
                <input wire:model.blur="{{ $name }}" :type="isPassword ? 'password' : 'text'" 
                    {{ $attributes->merge([
                            'id' => $name . $uuid,
                            'autocomplete' => 'off',
                        ])->class([
                            'form-control',
                            'is-invalid' => $errors->has($name),
                        ])
                    }}
                >
                <span class="input-group-text ps-0">
                    <a @click="isPassword = !isPassword"
                       :class="isPassword ? 'd-block' : 'd-none'"
                       class="link-secondary cursor-pointer"
                       title="{{ __('Show password') }}"
                       data-bs-toggle="tooltip">
                        <!-- Download SVG icon from http://tabler-icons.io/i/eye -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                             stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                             stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M12 12m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"/>
                            <path d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7"/>
                        </svg>
                    </a>
                    <a @click="isPassword = !isPassword"
                       :class="!isPassword ? 'd-block' : 'd-none'"
                       class="link-secondary cursor-pointer"
                       title="{{ __('Hide password') }}"
                       data-bs-toggle="tooltip">
                        <!-- Download SVG icon from http://tabler-icons.io/i/eye-off -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                             stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                             stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M10.585 10.587a2 2 0 0 0 2.829 2.828"></path>
                            <path d="M16.681 16.673a8.717 8.717 0 0 1 -4.681 1.327c-3.6 0 -6.6 -2 -9 -6c1.272 -2.12 2.712 -3.678 4.32 -4.674m2.86 -1.146a9.055 9.055 0 0 1 1.82 -.18c3.6 0 6.6 2 9 6c-.666 1.11 -1.379 2.067 -2.138 2.87"></path>
                            <path d="M3 3l18 18"></path>
                        </svg>
                    </a>
                </span>
                <x-form.error field="{{ $name }}"/>
            </div>
            <x-form.hint message="{{ $hint }}"/>
        HTML;
    }
}
