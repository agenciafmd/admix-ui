<?php

namespace Agenciafmd\Ui\Traits;

use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\File\UploadedFile;

trait WithUpload
{
    public function doUpload(string|UploadedFile $file, $collection, $customProperties = []): Media
    {
        $name = str($this->attributes['name'] . '-' . date('YmdHisv'))
            ->slug()
            ->__toString();

        if (is_string($file)) {
            $extension = str(pathinfo($file)['extension'])
                ->lower()
                ->__toString();
            $contents = Storage::get($file);
        } else {
            $extension = str($file->getFilename())
                ->afterLast('.')
                ->lower()
                ->__toString() ?: 'jpg';
            $contents = $file->get();
        }
        $fileName = "{$name}.{$extension}";

        return $this->addMediaFromString($contents)
            ->usingName($name)
            ->usingFileName($fileName)
            ->withCustomProperties(array_merge([
                // 'uuid' => Str::uuid()
            ], $customProperties))
            ->withResponsiveImages()
            ->toMediaCollection($collection);
    }
}
