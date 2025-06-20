<?php

namespace Agenciafmd\Ui\View\Components\Forms\Inputs;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
use Illuminate\View\Component;

class IconValue extends Component
{
    public string $formField;

    public string $uuid;

    public array $options;

    public function __construct(
        public string $name = '',
        public string $label = '',
        public string $hint = '',
        public string $keyPlaceholder = '-',
        public string $valuePlaceholder = 'Value',
        public string $iconsPath = 'vendor/admix-ui/vendor/libs/bootstrap-icons',
    ) {
        $this->uuid = str(serialize($this))
            ->pipe('md5')
            ->limit(5, '')
            ->toString();

        $this->formField = str($this->name)->afterLast('.');

        $this->options = cache()->rememberForever('icon-value-options', function () {
            $files = File::allFiles(public_path($this->iconsPath));

            return collect($files)
                ->filter(function ($file) {
                    return $file->getExtension() === 'svg';
                })
                ->map(function ($file) {
                    return str($file->getFilename())
                        ->beforeLast('.svg')
                        ->__toString();
                })->map(function ($icon) {
                    $customProperty = '<span><img src="/' . $this->iconsPath . '/%s.svg" alt="%s" loading="lazy" width="19" height="19"></span>';
                    $label = str($icon)
                        ->replace('-', ' ')
                        ->ucfirst()
                        ->__toString();

                    return [
                        'value' => $icon,
                        'label' => $label,
                        'custom-property' => str($customProperty)->replaceArray('%s', [$icon, $label])->__toString(),
                    ];
                })
                ->prepend([
                    'value' => '',
                    'label' => $this->keyPlaceholder,
                    'custom-property' => '',
                ])
                ->values()
                ->toArray();
        });
    }

    public function render(): string|View
    {
        return <<<'HTML'
            @if($label)
                <x-form.label for="{{ $name . $uuid }}" @class(['required' => $attributes->has('required')])>
                    {{ str($label)->lower()->ucfirst() }}
                </x-form.label>
            @endif
            @forelse($this->form->{$formField} as $key => $item)
                <div wire:key="{{ $name }}-{{ $key }}-{{ $uuid }}"
                     class="col-md-12 px-0 form-group">
                    <div class="row">
                        <div class="col-12 col-md-6 mb-3">
                            <x-form.tom-select
                                    name="{{ $name }}.{{ $key }}.key"
                                    :options="$options"
                            />
                        </div>
                        <div class="col mb-3">
                            <input wire:model.blur="{{ $name }}.{{ $key }}.value" {{ $attributes->merge([
                                                    'type' => 'text',
                                                    'id' => "{$name}-{$key}-value-{$uuid}",
                                                    'placeholder' => $valuePlaceholder,
                                                ])->class([
                                                    'form-control',
                                                    'is-invalid' => $errors->has("{$name}.{$key}.value"),
                                            ])
                                        }}
                                    />
                            <x-form.error field="{{ $name }}.{{ $key }}.value"/>
                        </div>
                        <div class="col-auto mb-3">
                            <button wire:click.prevent="keyValueRemove('{{ $formField }}', {{ $key }})"
                                    wire:loading.class="btn-danger btn-loading"
                                    wire:loading.class.remove="btn-outline-danger"
                                    wire:target="keyValueRemove('{{ $formField }}', {{ $key }})"
                                    class="btn btn-icon btn-outline-danger"
                                    type="button">
                                    <x-bs-icon name="x-lg"/>
                            </button>
                        </div>
                    </div>
                </div>
                <x-form.hint message="{{ $hint }}"/>
            @empty
                <x-form.error class="d-block" field="{{ $name }}"/>
            @endforelse
            <div class="form-group mb-0">
                <div class="d-grid">
                    <button wire:click.prevent="keyValueAdd('{{ $formField }}')"
                            wire:loading.class="btn-loading"
                            wire:target="add"
                            class="btn btn-secondary"
                            type="button">
                        {{ str(__('admix-ui::fields.add'))->lower()->ucfirst() }}
                    </button>
                </div>
            </div>
        HTML;
    }
}
