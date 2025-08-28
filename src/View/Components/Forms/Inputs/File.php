<?php

namespace Agenciafmd\Ui\View\Components\Forms\Inputs;

use Illuminate\Support\Facades\View;
use Illuminate\View\Component;

class File extends Component
{
    public string $formField;

    public string $uuid;

    public string $accept = 'application/pdf';

    public function __construct(
        public string $name = '',
        public string $label = '',
        public ?string $hint = null,
        public ?bool $hideContent = false,
        public ?string $addFilesText = 'Adicionar arquivo'
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

    public function metaName(): ?string
    {
        return $this->name . '_meta';
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
                                if(is_string($rule)) {
                                    if(Str::of($rule)->startsWith('mimes:')) {
                                        $defaultHint[] = __('Permitted file types: :types.', [
                                            'types' => Str::of($rule)->after(':'),
                                        ]);
                                    }
                                }
                            };
                            $defaultHint = implode(" ", $defaultHint);
                        }
                        
                        $fileInfo = collect($this->form->book_files)->flatten()->first();
                     @endphp
                    <x-form.hint
                        message="{{ $hint ?? $defaultHint }}"
                        class="mb-2"
                    />
                                        
                    @foreach($this->form->{$formField} as $key => $file)
                        <div class="card">
                            <div class="card-header justify-content-center cursor-pointer flex-column gap-3"
                                 @click="document.getElementById('file-{{ $uuid}}-{{ $key }}').click()">
                                <span>
                                    <x-tblr-icon name="file"
                                                 class="ic-xl w-8 h-8"/>
                                </span>
                                 @if($fileInfo)
                                    <small class="text-center">
                                        {{ round($fileInfo?->getSize() / 1000 / 1000, 2) . ' MB' }}
                                    </small>
                                 @endif
                                 <small class="text-center">
                                    {{ $fileInfo?->getClientOriginalName() ?? $file['path'] }}
                                 </small>
                            </div>
                            <input
                                type="file"
                                id="file-{{ $uuid}}-{{ $key }}"
                                wire:model="{{ $modelName() . '.' . $key }}"
                                accept="{{ $attributes->get('accept') ?? $accept }}"
                                class="d-none"
                                @change="progress = 1"
                            />
                            <div @class([
                                    'card-body',
                                    'd-none' => $hideContent,
                                ])>
                                @if($slot->isEmpty())
                                    <div class="mb-3">
                                        <x-form.input wire:model="{{ $metaName() . '.' . $key . '.title' }}" id="title-{{ $file['uuid'] }}" placeholder="Nome"/>
                                    </div>
                                    <div class="-mb-3">
                                        <x-form.input wire:model="{{ $metaName() . '.' . $key . '.alt' }}" id="alt-{{ $file['uuid'] }}" placeholder="Descrição"/>
                                    </div>
                                @else
                                    {!! str($slot)->replace('{key}', $key) !!}
                                @endif
                                @error($modelName() . '.' . $key)
                                <div class="invalid-feedback d-block mt-3">{{ $validationMessage($message) }}</div>
                                @enderror
                            </div>
                            @if($hideContent)
                                @error($modelName() . '.' . $key)
                                    <div class="card-body">
                                        <div class="invalid-feedback d-block">{{ $validationMessage($message) }}</div>
                                    </div>
                                @enderror
                            @endif
                            <div class="card-footer">
                                <div class="d-flex">
                                    <a class="btn -btn-icon link-muted" 
                                       @click="removeMedia('{{ $file['uuid'] }}', '{{ $file['url'] }}')" 
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
