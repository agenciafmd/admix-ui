<?php

namespace Agenciafmd\Ui\View\Components\Forms\Inputs;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ImageLibrary extends Component
{
    public string $uuid;

    public string $accept = 'image/png, image/jpeg';

    public bool $isSingle = false;

    public function __construct(
        public string $name = '',
        public ?string $collection = '',
        public ?string $label = null,
        public ?string $hint = null,
        public ?bool $hideErrors = false,
        public ?bool $hideProgress = false,
        public ?bool $hideContent = false,
        public ?bool $hideCrop = false,
        public ?bool $fullWidth = false,
        public ?string $addFilesText = 'Add images',
        public ?array $cropConfig = [],
    ) {
        $this->collection = $this->collection ?: str($this->name)
            ->after('.')
            ->toString();

        /* source: https://mary-ui.com/docs/components/image-library */
        $this->uuid = '-mary-' . str(serialize($this))
            ->pipe('md5')
            ->limit(5, '')
            ->toString();
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

    /*
     * https://github.com/fengyuanchen/cropperjs/blob/main/README.md#options
     * */
    public function cropSetup(): string
    {
        return json_encode(array_merge([
            'autoCropArea' => 1,
            'viewMode' => 2,
            'guides' => false,
            'dragMode' => 'move',
            'checkCrossOrigin' => false,
            'aspectRatio' => 16 / 9,
            'minContainerWidth' => 670,
            'minContainerHeight' => 505,
        ], $this->cropConfig), JSON_THROW_ON_ERROR);
    }

    public function render(): View|Closure|string
    {
        return <<<'HTML'
             <div
                x-data="{
                    progress: 0,
                    indeterminate: false,
                    cropper: null,
                    imageCrop: null,
                    croppingId: null,
                    bsCropModal: null,

                    init () {
                        this.imageCrop = this.$refs.crop?.querySelector('img')

                        /* FMD */
                        this.bsCropModal = bootstrap.Modal.getOrCreateInstance($refs.cropModal);
                        $refs.cropModal.addEventListener('hidden.bs.modal', event => {
                            this.cropper?.destroy();
                            /*console.log('destroy');*/
                        });

                        this.$watch('progress', value => {
                            this.indeterminate = value > 99
                        })
                        
                    },
                    get processing () {
                        return this.progress > 0 && this.progress < 100
                    },
                    close() {
                        this.bsCropModal.hide();

                        /*
                        $refs.maryCropModal.close()
                        this.cropper?.destroy()
                        */
                    },
                    change() {
                        if (this.processing) {
                            return
                        }

                        this.$refs.files.click()
                    },
                    refreshImage() {

                    },
                    crop(id) {
                        this.bsCropModal.show();
                        this.cropper?.destroy()
                        this.croppingId = id.split('-')[1]
                        this.imageCrop.src = document.getElementById(id).src

                        this.cropper = new Cropper(this.imageCrop, {{ $cropSetup() }});

                        /*
                        $refs.maryCropModal.showModal()

                        this.cropper?.destroy()
                        this.croppingId = id.split('-')[1]
                        this.imageCrop.src = document.getElementById(id).src

                        this.cropper = new Cropper(this.imageCrop, {{ $cropSetup() }});
                        */
                    },
                    removeMedia(uuid, url){
                        this.indeterminate = true
                        $wire.removeMedia(uuid, '{{ $modelName() }}', '{{ $collection }}', url).then(() => this.indeterminate = false)
                    },
                    refreshMediaOrder(order){
                        $wire.refreshMediaOrder(order, '{{ $collection }}')
                    },
                    refreshMediaSources(){
                        this.indeterminate = true
                        $wire.refreshMediaSources('{{ $modelName() }}', '{{ $collection }}').then(() => this.indeterminate = false)
                    },
                    async save() {
                        this.bsCropModal.hide();
                        this.progress = 1

                        this.cropper.getCroppedCanvas().toBlob((blob) => {
                            @this.upload(this.croppingId, blob,
                                (uploadedFilename) => { this.refreshMediaSources() },
                                (error) => {  },
                                (event) => { this.progress = event.detail.progress;  }
                            )
                        })

                        /*
                        $refs.maryCropModal.close();
                        this.progress = 1

                        this.cropper.getCroppedCanvas().toBlob((blob) => {
                            @this.upload(this.croppingId, blob,
                                (uploadedFilename) => { this.refreshMediaSources() },
                                (error) => {  },
                                (event) => { this.progress = event.detail.progress;  }
                            )
                        })
                        */
                    }
                 }"

                x-on:livewire-upload-progress="progress = $event.detail.progress;"
                x-on:livewire-upload-finish="refreshMediaSources()"

                {{ $attributes->whereStartsWith('class') }}
            >
                <!-- STANDARD LABEL -->
                @if($label)
                    <x-form.label 
                        for="{{ $modelName() . $uuid }}" 
                        @class([
                            'required' => $attributes->has('required')
                        ])
                    >
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
                            if($rule instanceof \Illuminate\Validation\Rules\Dimensions) {
                                $dimensionRules = collect($rule)->mapWithKeys(function ($value, $key) {
                                    return $value;
                                });
                                
                                if(isset($dimensionRules['min_width']) && isset($dimensionRules['min_height'])) {
                                    $defaultHint[] = __('Min dimensions :widthx:heightpx.', [
                                            'width' => $dimensionRules['min_width'],
                                            'height' => $dimensionRules['min_height'],
                                        ]);
                                }
                                
                                if(isset($dimensionRules['max_width']) && isset($dimensionRules['max_height'])) {
                                    $defaultHint[] = __('Max dimensions :widthx:heightpx.', [
                                            'width' => $dimensionRules['max_width'],
                                            'height' => $dimensionRules['max_height'],
                                        ]);
                                }
                            }
                        };
                        $defaultHint = implode(" ", $defaultHint);
                    }
                @endphp
                <x-form.hint 
                    message="{{ $hint ?? $defaultHint }}"
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
                                 ]) data-id="{{ $image['uuid'] }}">
                                <div class="card">
                                    <img src="{{ $image['url'] }}" 
                                            class="-img-responsive -img-responsive-4x3 -ratio-4x3"
                                            alt="{{ $image['url'] }}" 
                                            -width="160" 
                                            @click="document.getElementById('file-{{ $uuid}}-{{ $key }}').click()"
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
                                    <div @class([
                                            'card-body',
                                            'd-none' => $hideContent,
                                        ])>
                                        @if($slot->isEmpty())
                                            <div class="mb-3">
                                                <x-form.input wire:model="{{ $metaName() . '.' . $key . '.title' }}" id="title-{{ $image['uuid'] }}" placeholder="Nome"/>
                                            </div>
                                            <div class="-mb-3">
                                                <x-form.input wire:model="{{ $metaName() . '.' . $key . '.alt' }}" id="alt-{{ $image['uuid'] }}" placeholder="Descrição"/>
                                            </div>
                                        @else
                                            {!! str($slot)->replace('{key}', $key) !!}
                                        @endif
                                        <!-- VALIDATION -->
                                        @error($modelName() . '.' . $key)
                                        <div class="invalid-feedback d-block mt-3">{{ $validationMessage($message) }}</div>
                                        @enderror
                                    </div>
                                    @if($hideContent)
                                        <!-- VALIDATION -->
                                        @error($modelName() . '.' . $key)
                                            <div class="card-body">
                                                <div class="invalid-feedback d-block">{{ $validationMessage($message) }}</div>
                                            </div>
                                        @enderror
                                    @endif
                                    <!-- Card footer -->
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
                                            @if(!$hideCrop)
                                                <a class="btn -btn-icon link-muted ms-auto" 
                                                   @click="crop('image-{{ $modelName() . '.' . $key  }}-{{ $uuid }}')" 
                                                   title="{{ __('Crop') }}">
                                                    <x-tblr-icon name="scissors" class="icon d-sm-none d-block m-0"/>
                                                    <span class="d-none d-sm-block">
                                                        {{ __('Crop') }}
                                                    </span>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- CROP MODAL -->
                <div @click.prevent="" x-ref="crop" wire:ignore>
                    <x-modal id="cropModal{{ $uuid }}" x-ref="cropModal" title="{{ __('Crop image') }}">
                        <img src="#" crossOrigin="Anonymous" />
                        <x-slot:footer>
                            <x-btn label="{{ __('Cancel') }}" class="me-auto" data-bs-dismiss="modal"/>
                            <x-btn label="{{ __('Crop') }}" class="btn-primary" @click="save()"/>
                        </x-slot:footer>
                    </x-modal>
                </div>
                
                <!-- PROGRESS BAR  -->
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

                <!-- MAIN FILE INPUT -->
                <input
                    id="{{ $uuid }}"
                    type="file"
                    x-ref="files"
                    class="d-none"
                    wire:model="{{ $modelName() }}.*"
                    accept="{{ $attributes->get('accept') ?? $accept }}"
                    @change="progress = 1"
                    @if(!$isSingle) multiple @endif />

                <!-- ERROR -->
                @if (! $hideErrors)
                    @error('form.' . $collection)
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                @endif
            </div>
        HTML;
    }
}
