<?php

namespace Agenciafmd\Ui\View\Components\Forms\Inputs;

use Illuminate\Support\Facades\View;
use Illuminate\View\Component;

class Easymde extends Component
{
    public string $uuid;

    public function __construct(
        public string $name = '',
        public string $label = '',
        public string $hint = '',
        public array $options = [],
    ) {
        $this->uuid = '-' . str(serialize($this))
            ->pipe('md5')
            ->limit(5, '')
            ->toString();
    }

    public function options(): array
    {
        return array_merge([
            'forceSync' => true,
            'autoDownloadFontAwesome' => false,
            'toolbarButtonClassPrefix' => 'mde',
            'toolbar' => [
                'bold',
                'italic',
                'strikethrough',
                '|',
                //                'heading',
                //                'heading-smaller',
                //                'heading-bigger',
                'heading-1',
                'heading-2',
                'heading-3',
                '|',
                'quote',
                'unordered-list',
                'ordered-list',
                '|',
                'link',
                'image',
                //                'upload-image',
                'table',
                'horizontal-rule',
                '|',
                'preview',
                'side-by-side',
                'fullscreen',
                '|',
                'guide',
            ],
        ], $this->options);
    }

    public function jsonOptions(): string
    {
        if (empty($this->options())) {
            return '';
        }

        return ', ...' . json_encode((object) $this->options());
    }

    public function render(): string|View
    {
        /* this.easyMDE = new EasyMDE({ element: $root, ...{&quot;forceSync&quot;:true,&quot;autoDownloadFontAwesome&quot;:true,&quot;placeholder&quot;:&quot;Write something...&quot;} {{ $jsonOptions() }} }); */
        return <<<'HTML'
                @if($label)
                    <x-form.label for="{{ $name . $uuid }}" @class(['required' => $attributes->has('required')])>
                        {{ str($label)->lower()->ucfirst() }}
                        @if($attributes->has('maxlength'))
                            <span class="form-label-description">
                            <span x-html="count"></span>/<span x-html="$refs.fieldToCount.maxLength"></span></span>
                        @endif
                    </x-form.label>
                @endif

                <div wire:ignore>
                    <textarea
                        x-data="{
                            easyMDE: null
                        }"
                        x-init="
                            this.easyMDE = new EasyMDE({ element: $root {{ $jsonOptions() }} });
                            this.easyMDE.codemirror.on('change', () => {
                                $wire.$set('{{ $name }}', this.easyMDE.value(), {{ $isLive ?? false }})
                            });
                        "
                        wire:model.blur="{{ $name }}"
                        {{ $attributes->merge([
                                    'id' => $name . $uuid,
                                ])->class([
                                    'form-control',
                                    'is-invalid' => $errors->has($name),
                            ])
                        }}
                    ></textarea>
                </div>
                <x-form.error class="d-block" field="{{ $name }}"/>
                <x-form.hint message="{{ $hint }}"/>
        HTML;
    }
}
