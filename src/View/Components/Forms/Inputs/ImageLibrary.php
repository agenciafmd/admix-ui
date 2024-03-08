<?php

namespace Agenciafmd\Ui\View\Components\Forms\Inputs;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class ImageLibrary extends Component
{
    public string $uuid;

    public string $mimes = 'image/png, image/jpeg';

    public function __construct(
        public ?string $label = null,
        public ?string $hint = null,
        public ?bool $hideErrors = false,
        public ?bool $hideProgress = false,
        public ?string $changeText = 'Change',
        public ?string $cropText = 'Crop',
        public ?string $removeText = 'Remove',
        public ?string $cropTitleText = 'Crop image',
        public ?string $cropCancelText = 'Cancel',
        public ?string $cropSaveText = 'Crop',
        public ?string $addFilesText = 'Add images',
        public ?array $cropConfig = [],
        public Collection $preview = new Collection(),

    ) {
        $this->uuid = 'mary' . md5(serialize($this));
    }

    public function modelName(): ?string
    {
        return $this->attributes->wire('model');
    }

    public function libraryName(): ?string
    {
        return $this->attributes->wire('library');
    }

    public function validationMessage(string $message): string
    {
        return str($message)->after('field');
    }

    public function cropSetup(): string
    {
        return json_encode(array_merge([
            'autoCropArea' => 1,
            'viewMode' => 2,
            'dragMode' => 'move',
            'checkCrossOrigin' => false,
            'aspectRatio' => 16 / 9,
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
                                console.log('destroy');
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
                            $wire.removeMedia(uuid, '{{ $modelName() }}', '{{ $libraryName() }}', url).then(() => this.indeterminate = false)
                        },
                        refreshMediaOrder(order){
                            $wire.refreshMediaOrder(order, '{{ $libraryName() }}')
                        },
                        refreshMediaSources(){
                            this.indeterminate = true
                            $wire.refreshMediaSources('{{ $modelName() }}', '{{ $libraryName() }}').then(() => this.indeterminate = false)
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
                        <x-form.label for="{{ $modelName() . $uuid }}" @class(['required' => $attributes->has('required')])>
                            {{ str($label)->lower()->ucfirst() }}
                        </x-form.label>
                    @endif

                    <!-- PREVIEW AREA -->
                    <div
                        :class="(processing || indeterminate) && 'opacity-50 pe-none'"
                        @class(["card mb-2", "d-none" => $preview->count() == 0])
                    >
                        <div
                            x-data="{ sortable: null }"
                            x-init="sortable = new Sortable($el, { animation: 150, ghostClass: 'bg-gray-300', onEnd: (ev) => refreshMediaOrder(sortable.toArray()) })"
                            class="list-group card-list-group cursor-move"
                        >
                            @foreach($preview as $key => $image)
                                <div class="list-group-item" data-id="{{ $image['uuid'] }}">
                                    <div wire:key="preview-{{ $image['uuid'] }}" class="row g-2 align-items-center" title="{{ $changeText }}">
                                        <div class="col-auto">
                                            <img src="{{ $image['url'] }}" class="rounded" alt="{{ $image['url'] }}" width="40" height="40"
                                                @click="document.getElementById('file-{{ $uuid}}-{{ $key }}').click()"
                                                id="image-{{ $modelName().'.'.$key  }}-{{ $uuid }}">

                                            <!-- HIDDEN FILE INPUT -->
                                            <input
                                                type="file"
                                                id="file-{{ $uuid}}-{{ $key }}"
                                                wire:model="{{ $modelName().'.'.$key  }}"
                                                accept="{{ $attributes->get('accept') ?? $mimes }}"
                                                class="d-none"
                                                @change="progress = 1"
                                                />
                                        </div>
                                        <!-- TODO colocaremos aqui os inputs de meta -->
                                        <!--div class="col">
                                            Górą ty
                                            <div class="text-secondary">
                                                GOLEC UORKIESTRA,
                                                Gromee,
                                                Bedoes
                                            </div>
                                        </div-->
                                        <div class="col-auto">
                                            <!-- ACTIONS -->
                                            <div class="absolute flex flex-col gap-2 top-3 left-3 cursor-pointer  p-2 rounded-lg">
                                                <a class="link-muted" @click="removeMedia('{{ $image['uuid'] }}', '{{ $image['url'] }}')" title="{{ $removeText }}"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M18 6l-12 12" /><path d="M6 6l12 12" /></svg></a>
                                                <a class="link-muted" @click="crop('image-{{ $modelName().'.'.$key  }}-{{ $uuid }}')" title="{{ $cropText }}"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-scissors" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 7m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" /><path d="M6 17m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" /><path d="M8.6 8.6l10.4 10.4" /><path d="M8.6 15.4l10.4 -10.4" /></svg></a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- VALIDATION -->
                                     @error($modelName().'.'.$key)
                                        <div class="invalid-feedback d-block">{{ $validationMessage($message) }}</div>
                                     @enderror
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- CROP MODAL -->
                    <div @click.prevent="" x-ref="crop" wire:ignore>
                        <x-modal id="cropModal{{ $uuid }}" x-ref="cropModal" title="{{ $cropTitleText }}">
                            <img src="#" crossOrigin="Anonymous" />
                            <x-slot:footer>
                                <x-btn label="{{ $cropCancelText }}" class="me-auto" data-bs-dismiss="modal"/>
                                <x-btn label="{{ $cropSaveText }}" class="btn-primary" @click="save()"/>
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
                    <a @click="$refs.files.click()" class="btn btn-info w-100 mb-1" :class="(processing || indeterminate) && 'disabled'">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-upload" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" /><path d="M7 9l5 -5l5 5" /><path d="M12 4l0 12" /></svg>
                        Adicionar arquivos
                    </a>

                    <!-- MAIN FILE INPUT -->
                    <input
                        id="{{ $uuid }}"
                        type="file"
                        x-ref="files"
                        class="d-none"
                        wire:model="{{ $modelName() }}.*"
                        accept="{{ $attributes->get('accept') ?? $mimes }}"
                        @change="progress = 1"
                        multiple />

                    <!-- ERROR -->
                    @if (! $hideErrors)
                        @error($libraryName())
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    @endif

                    <!-- HINT -->
                    <x-form.hint message="{{ $hint }}"/>
                </div>
            HTML;
    }
}