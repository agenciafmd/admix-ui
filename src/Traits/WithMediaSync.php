<?php

namespace Agenciafmd\Ui\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

trait WithMediaSync
{
    // Remove media
    public function removeMedia(string $uuid, string $filesModelName, string $library, string $url): void
    {
        $filesModelName = str($filesModelName)
            ->afterLast('.')
            ->toString();

        // Updates library
        $this->form->{$library} = $this->form->{$library}->filter(static fn($image) => $image['uuid'] != $uuid);

        // Remove file
        $name = str($url)
            ->after('preview-file/')
            ->before('?expires')
            ->__toString();
        $this->form->{$filesModelName} = collect($this->form->{$filesModelName})
            ->filter(static fn($file) => $file->getFilename() != $name)
            ->all();
    }

    // Set order
    public function refreshMediaOrder(array $order, string $library): void
    {
        $this->form->{$library} = $this->form->{$library}->sortBy(static function ($item) use ($order) {
            return array_search($item['uuid'], $order);
        });
    }

    // Bind temporary files with respective previews and replace existing ones, if necessary
    public function refreshMediaSources(string $filesModelName, string $library): void
    {
        $filesModelName = str($filesModelName)
            ->afterLast('.')
            ->__toString();

        // New files area
        foreach ($this->form->{$filesModelName}['*'] ?? [] as $key => $file) {
            $this->form->{$library} = $this->form->{$library}->add([
                'uuid' => Str::uuid()
                    ->__toString(),
                'url' => $file->temporaryUrl(),
            ]);

            $key = $this->form->{$library}->keys()
                ->last();
            $this->form->{$filesModelName}[$key] = $file;
        }

        // Reset new files area
        unset($this->form->{$filesModelName}['*']);

        //Replace existing files
        foreach ($this->form->{$filesModelName} as $key => $file) {
            $media = $this->form->{$library}->get($key);
            $media['url'] = $file->temporaryUrl();

            $this->form->{$library} = $this->form->{$library}->replace([$key => $media]);
        }

        $this->validateOnly($filesModelName . '.*');
    }

    // Storage files into permanent area and updates the model with fresh sources
    public function syncMedia(
        Model $model,
        string $library = 'library',
        string $files = 'files',
    ): void {
        foreach ($this->{$files} as $index => $file) {
            $name = str($model->name . '-' . date('YmdHisv'))
                ->slug()
                ->__toString();
            $extension = str($file->getFilename())
                ->afterLast('.')
                ->lower()
                ->__toString();
            $fileName = "{$name}.{$extension}";

            $customProperties = [];
            $media = $model->addMedia($file)
                ->usingName($name)
                ->usingFileName($fileName)
                // esse uuid não é necessário
                ->withCustomProperties(array_merge(['uuid' => Str::uuid()], $customProperties))
                ->withResponsiveImages()
                ->toMediaCollection($library);

            $this->{$library} = $this->{$library}->replace([
                $index => [
                    'uuid' => $media->uuid,
                    'url' => $media->getUrl(),
                    'path' => $media->file_name,
                ],
            ]);
        }

        $presentMedias = $model->media()
            ->whereIn('uuid', $this->{$library}->pluck('uuid')
                ->toArray())
            ->get();
        $model->clearMediaCollectionExcept($library, $presentMedias);

        $startAt = 1;
        foreach ($this->{$library} as $media) {
            $media = Media::query()
                ->where('uuid', $media['uuid'])
                ->first();
            $media->order_column = $startAt++;
            $media->save();
        }

        // Resets files
        $this->{$files} = [];
    }
}
