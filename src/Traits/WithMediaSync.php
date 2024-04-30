<?php

namespace Agenciafmd\Ui\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
            ->toString();
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
    public function refreshMediaSources(string $filesModelName, string $library)
    {
        $filesModelName = str($filesModelName)
            ->afterLast('.')
            ->toString();

        // New files area
        foreach ($this->form->{$filesModelName}['*'] ?? [] as $key => $file) {
            $this->form->{$library} = $this->form->{$library}->add([
                'uuid' => Str::uuid()
                    ->toString(), 'url' => $file->temporaryUrl()
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
        string $storage_subpath = '',
        $model_field = 'library',
        string $visibility = 'public',
        string $disk = 'public'
    ): void {
        // Store files
        foreach ($this->{$files} as $index => $file) {
            $media = $this->{$library}->get($index);
            $name = $this->getFileName($media);

            $file = Storage::disk($disk)
                ->putFileAs($storage_subpath, $file, $name, $visibility);
            $url = Storage::disk($disk)
                ->url($file);

            // Update library
            $media['url'] = $url . '?updated_at=' . time();
            $media['path'] = str($storage_subpath)
                ->finish('/')
                ->append($name)
                ->toString();
            $this->{$library} = $this->{$library}->replace([$index => $media]);
        }

        // Delete removed files from library
        $diffs = $model->{$model_field}?->filter(fn($item) => $this->{$library}->doesntContain('uuid',
            $item['uuid'])) ?? [];

        foreach ($diffs as $diff) {
            Storage::disk($disk)
                ->delete($diff['path']);
        }

        // Updates model
        $model->update([$model_field => $this->{$library}]);

        // Resets files
        $this->{$files} = [];
    }

    private function getFileName(?array $media): ?string
    {
        $name = $media['uuid'] ?? null;
        $extension = str($media['url'] ?? null)
            ->afterLast('.')
            ->before('?expires')
            ->toString();

        return "{$name}.{$extension}";
    }
}
