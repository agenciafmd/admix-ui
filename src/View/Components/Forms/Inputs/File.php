<?php

namespace Agenciafmd\Ui\View\Components\Forms\Inputs;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class File extends Component
{
    public string $uuid;
    public string $accept = 'application/pdf';
    public bool $isSingle = true;

    public function __construct(
        public string $name = '',
        public ?string $collection = '',
        public ?string $label = null,
        public ?string $hint = null,
        public ?bool $hideErrors = false,
        public ?bool $hideProgress = false,
        public ?bool $fullWidth = false,
        public ?string $addFilesText = 'Add files',
    ) {
        $this->collection = $this->collection ?: str($this->name)
            ->after('.')
            ->toString();

        $this->uuid = '-mary-' . str(serialize($this))
                ->pipe('md5')
                ->limit(5, '')
                ->toString();
    }

    public function modelName(): ?string
    {
        return $this->name . '_files';
    }

    public function render(): View|Closure|string
    {
        return <<<'HTML'
            <div
                x-data="{
                    progress: 0,
                    indeterminate: false,
                    init () {
                        this.$watch('progress', value => {
                            this.indeterminate = value > 99
                        })
                    },
                    get processing () {
                        return this.progress > 0 && this.progress < 100
                    },
                    change() {
                        if (this.processing) return
                        this.$refs.files.click()
                    },
                    refreshMediaSources(){
                        this.indeterminate = true
                        $wire.refreshMediaSources('{{ $modelName() }}', '{{ $collection }}').then(() => this.indeterminate = false)
                    },
                    removeMedia(uuid, url){
                        this.indeterminate = true
                        $wire.removeMedia(uuid, '{{ $modelName() }}', '{{ $collection }}', url).then(() => this.indeterminate = false)
                    },
                }"
                x-on:livewire-upload-progress="progress = $event.detail.progress;"
                x-on:livewire-upload-finish="refreshMediaSources()"
                {{ $attributes->whereStartsWith('class') }}
            >
                @if($label)
                    <x-form.label
                        for="{{ $modelName() . $uuid }}"
                        @class(['required' => $attributes->has('required')])
                    >
                        {{ str($label)->lower()->ucfirst() }}
                    </x-form.label>
                @endif

                <x-form.hint
                    message="{{ $hint }}"
                    class="mb-2"
                />
        <!-- PREVIEW AREA -->
                <div
                    :class="(processing || indeterminate) && 'opacity-50 pe-none'"
                    @class([
                        'card',
                        '-mb-2',
                        'border-0', 
                        'd-none' => $this->form->{$collection}->count() === 0
                    ])
                >
                    <div
                        @if(!$isSingle)
                            x-data="{ sortable: null }"
                            x-init="sortable = new Sortable($el, { animation: 150, ghostClass: 'bg-gray-300', onEnd: (ev) => refreshMediaOrder(sortable.toArray()) })"
                        @endif
                        @class([
                            'row',
                            '-list-group',
                            '-card-list-group',
                            '-cursor-move' => !$isSingle,
                        ])
                    >
                        @foreach($this->form->{$collection} as $key => $image)
                       <div @class([
                                    'col-md-12' => $fullWidth,
                                    'col-md-6' => !$fullWidth && $isSingle,
                                    'col-md-4' => !$fullWidth && !$isSingle,
                                    'mb-3' => !$fullWidth && !$isSingle,
                                    'cursor-move' => !$isSingle,
                                 ]) data-id="{{ $image['uuid'] }}"
                                 >
                                <div class="card">
                                    <img src="https://placehold.co/300x300?text=PDF" 
                                            class="-img-responsive -img-responsive-4x3 -ratio-4x3"
                                            alt="{{ $image['url'] }}" 
                                            -width="160" 
                                            @click="document.getElementById('file-{{ $uuid }}-{{ $key }}').click()"
                                            id="image-{{ $modelName() . '.' . $key  }}-{{ $uuid }}">
                                        <!-- HIDDEN FILE INPUT -->
                                    <input
                                        type="file"
                                        id="file-{{ $uuid}}-{{ $key }}"
                                        wire:model="{{ $modelName() . '.' . $key }}"
                                        accept="{{ $attributes->get('accept') ?? $accept }}"
                                        class="d-none"
                                        @change="progress = 1"
                                    />
                                    <div class="card-footer">
                                        <div class="d-flex">
                                            <a class="btn -btn-icon link-muted" 
                                            @click="removeMedia('{{ $image['uuid'] }}', '{{ $image['url'] }}')" 
                                            title="{{ __('Remove') }}">
                                                <x-tblr-icon name="trash" class="icon d-sm-none d-block m-0"/>
                                                <span class="d-none d-sm-block">
                                                {{ __('Remove') }}
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                           </div>
                        @endforeach
                    </div>
               </div>
                @if(! $hideProgress && $slot->isEmpty())
                    <div x-cloak class="progress mb-2" :class="(!processing && !indeterminate) && 'invisible'">
                        <div class="progress-bar" :style="{ width: progress + '%' }"></div>
                    </div>
                @endif
                <!-- ADD FILES -->
                @if(($isSingle && $this->form->{$collection}->count() <= 0) || (!$isSingle))
                <a @click="$refs.files.click()" class="btn btn-info w-100 mb-1" :class="(processing || indeterminate) && 'disabled'">
                    <x-tblr-icon name="upload" class="icon"/>
                    {{ __($addFilesText) }}
                </a>
                @endif
                <input
                    id="{{ $uuid }}"
                    type="file"
                    x-ref="files"
                    class="d-none"
                    wire:model="{{ $modelName() }}.*"
                    accept="{{ $attributes->get('accept') ?? $accept }}"
                    @change="progress = 1"
                    @if(!$isSingle) multiple @endif />

                @if (! $hideErrors)
                    @error('form.' . $collection)
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                @endif
            </div>
        HTML;
    }
}