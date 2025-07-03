<?php

namespace Agenciafmd\Ui\View\Components\Forms\Inputs;

use Illuminate\Support\Facades\View;
use Illuminate\View\Component;

class Video extends Component
{
    public string $formField;

    public string $uuid;

    public string $accept = 'video/mp4';

    public bool $isSingle = true;

    public function __construct(
        public string $name = '',
        public string $label = '',
        public ?string $hint = null,
        public ?string $addFilesText = 'Adicionar video'
    ) {
        $this->uuid = str(serialize($this))
            ->pipe('md5')
            ->limit(5, '')
            ->toString();

        $this->formField = str($this->name)->afterLast('.');
    }

    public function modelName(): ?string
    {
        return $this->name . '_files';
    }

    public function validationMessage(string $message): string
    {
        return str($message)->after('field');
    }

    public function render(): string|View
    {
        return <<<'HTML'
            <div 
                x-data="{
                    removeMedia(uuid, url){
                        $wire.removeMedia(uuid, '{{ $modelName() }}', '{{ $formField }}', url)
                    },
                    change() {
                        if (this.processing) {
                            return
                        }

                        this.$refs.files.click()
                    },
                    refreshMediaSources(){
                        $wire.refreshMediaSources('{{ $modelName() }}', '{{ $formField }}')
                    },
                }"
                
                x-on:livewire-upload-finish="refreshMediaSources()"
                >
                    @if($label)
                        <x-form.label for="{{ $name . $uuid }}" @class(['required' => $attributes->has('required')])>
                            {{ str($label)->lower()->ucfirst() }}
                        </x-form.label>
                    @endif
                    @php
                        if(!$hint) {
                            $defaultHint = [];
                            $rules = collect($this->form->rules()[str_replace('form.', '', $modelName()) . '.*']);
                            foreach($rules as $rule) {
                                if(is_string($rule)) {
                                    if(Str::of($rule)->startsWith('max')) {
                                        $size = Str::of($rule)->explode(':')->last() / 1024;
                                        $defaultHint[] = __('Max size :sizeMB.', ['size' => $size]);
                                    }
                                }
                            };
                            $defaultHint = implode(" ", $defaultHint);
                        }
                     @endphp
                    <x-form.hint
                        message="{{ $hint ?? $defaultHint . ' Dimensões máximas 1280x720px.' }}"
                        class="mb-2"
                    />
                    
                    @foreach($this->form->{$formField} as $key => $video)
                        <div class="card">
                            <video autoplay muted loop
                                id="{{ $name }}-{{ $uuid }}">
                                <source src="{{ $video['url'] }}" type="video/mp4"
                                @click="document.getElementById('file-{{ $uuid }}-{{ $key }}').click()">
                                Your browser does not support the video tag.
                            </video>
                            <x-form.error field="{{ $name }}" class="d-block"/>
                            @error($modelName() . '.' . $key)
                                <div class="invalid-feedback d-block mt-3">{{ $validationMessage($message) }}</div>
                            @enderror
                            <div class="card-footer">
                                <div class="d-flex">
                                    <a class="btn -btn-icon link-muted" 
                                       @click="removeMedia('{{ $video['uuid'] }}', '{{ $video['url'] }}')" 
                                       title="{{ __('Remove') }}">
                                        <x-tblr-icon name="trash" class="icon d-sm-none d-block m-0"/>
                                        <span class="d-none d-sm-block">
                                            {{ __('Remove') }}
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                     @if($this->form->{$formField}->count() <= 0)
                        <a @click="$refs.files.click()" class="btn btn-info w-100 mb-1">
                            <x-tblr-icon name="upload" class="icon"/>
                            {{ __($addFilesText) }}
                        </a>
                    @endif
                
                    <input
                        id="{{ $uuid }}"
                        type="file"
                        x-ref="files"
                        class="d-none"
                        accept="{{ $accept }}"
                        wire:model="{{ $modelName() }}.*"/>
                        
                    @error($name)
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
            </div>
        HTML;
    }
}
