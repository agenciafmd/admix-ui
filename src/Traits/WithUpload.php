<?php

namespace Agenciafmd\Ui\Traits;

use Spatie\MediaLibrary\MediaCollections\Models\Media;

trait WithUpload
{
    public function doUpload($file, $collection, $customProperties = []): Media
    {
        $name = str($this->attributes['name'] . '-' . date('YmdHisv'))
            ->slug()
            ->__toString();
        $extension = str($file->getFilename())
            ->afterLast('.')
            ->lower()
            ->__toString() ?: 'jpg';
        $fileName = "{$name}.{$extension}";

        return $this->addMedia($file)
            ->usingName($name)
            ->usingFileName($fileName)
            ->withCustomProperties(array_merge([
                // 'uuid' => Str::uuid()
            ], $customProperties))
            ->withResponsiveImages()
            ->toMediaCollection($collection);
    }
}
