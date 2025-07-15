<?php

namespace Agenciafmd\Ui\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Dimensions;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

trait WithMediaSync
{
    // Remove media
    public function removeMedia(string $uuid, string $filesModelName, string $collection, string $url): void
    {
        $filesModelName = str($filesModelName)
            ->afterLast('.')
            ->toString();

        // Updates library
        $this->form->{$collection} = $this->form->{$collection}->filter(static fn ($image) => $image['uuid'] !== $uuid);

        // Remove file
        $name = str($url)
            ->after('preview-file/')
            ->before('?expires')
            ->__toString();
        $this->form->{$filesModelName} = collect($this->form->{$filesModelName})
            ->filter(static fn ($file) => $file->getFilename() !== $name)
            ->all();
    }

    // Set order
    public function refreshMediaOrder(array $order, string $collection): void
    {
        $this->form->{$collection} = $this->form->{$collection}->sortBy(static function ($item) use ($order) {
            return array_search($item['uuid'], $order);
        });
    }

    // Bind temporary files with respective previews and replace existing ones, if necessary
    public function refreshMediaSources(string $filesModelName, string $collection): void
    {
        $filesModelName = str($filesModelName)
            ->afterLast('.')
            ->__toString();

        // New files area
        foreach ($this->form->{$filesModelName}['*'] ?? [] as $key => $file) {
            $this->form->{$collection} = $this->form->{$collection}->add([
                'uuid' => Str::uuid()
                    ->__toString(),
                'url' => $file->temporaryUrl(),
            ]);

            $key = $this->form->{$collection}->keys()
                ->last();
            $this->form->{$filesModelName}[$key] = $file;
        }

        // Reset new files area
        unset($this->form->{$filesModelName}['*']);

        // Replace existing files
        foreach ($this->form->{$filesModelName} as $key => $file) {
            $media = $this->form->{$collection}->get($key);
            $media['url'] = $file->temporaryUrl();

            $this->form->{$collection} = $this->form->{$collection}->replace([$key => $media]);
        }

        $this->validateOnly($filesModelName . '.*');
    }

    // Storage files into permanent area and updates the model with fresh sources
    public function syncMedia(
        Model $model,
        string $collection = 'collection',
        array $optimize = [
            'type' => 'cover',
            'format' => 'jpg',
            'quality' => 95,
        ]
    ): void {
        $files = $collection . '_files';
        $meta = $collection . '_meta';
        $arrayMeta = $this->{$meta};

        if (!isset($optimize['width']) && !isset($optimize['height'])) {
            $rules = collect($this->rules()["{$collection}_files.*"]);
            foreach ($rules as $rule) {
                if ($rule instanceof Dimensions) {
                    $dimensionRules = collect($rule)->mapWithKeys(function ($value, $key) {
                        return $value;
                    });
                    if (isset($dimensionRules['max_width']) && isset($dimensionRules['max_height'])) {
                        $optimize['width'] = $dimensionRules['max_width'];
                        $optimize['height'] = $dimensionRules['max_height'];
                    }
                }
            }
        }

        foreach ($this->{$files} as $index => $file) {
            $media = $model->doUpload($file, $collection, $arrayMeta[$index] ?? [], $optimize);

            $this->{$collection} = $this->{$collection}->replace([
                $index => [
                    'uuid' => $media->uuid,
                    'url' => $media->getUrl(),
                    'path' => $media->file_name,
                    'meta' => $media->custom_properties,
                ],
            ]);
        }

        $presentMedias = $model->media()
            ->whereIn('uuid', $this->{$collection}->pluck('uuid')
                ->toArray())
            ->get();
        $model->clearMediaCollectionExcept($collection, $presentMedias);

        $startAt = 1;
        foreach ($this->{$collection} as $key => $media) {
            $media = Media::query()
                ->where('uuid', $media['uuid'])
                ->first();
            $media->order_column = $startAt++;
            $media->custom_properties = $arrayMeta[$key] ?? [];
            $media->save();
        }

        // Resets files
        $this->{$files} = [];
    }

    public function syncMedias(Model $model, array $collections, array $optimizes): void
    {
        foreach ($collections as $i => $collection) {
            $this->syncMedia($model, $collection, $optimizes[$i] ?? [
                'type' => 'cover',
                'format' => 'jpg',
                'quality' => 95,
            ]);
        }
    }
}
