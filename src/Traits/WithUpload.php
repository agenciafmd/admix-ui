<?php

namespace Agenciafmd\Ui\Traits;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Encoders\AutoEncoder;
use Intervention\Image\ImageManager;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\File\UploadedFile;

trait WithUpload
{
    public function doUpload(string|UploadedFile $file, $collection, $customProperties = [], $optimize = []): Media
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

        /* optimize */
        if (count($optimize)) {
            if (config('media-library.image_driver') === 'gd') {
                $image = ImageManager::gd();
            } else {
                $image = ImageManager::imagick();
            }
            $image = $image->read($contents);
            if (isset($optimize['width']) && isset($optimize['height'])) {
                if (isset($optimize['type']) && $optimize['type'] === 'scale') {
                    $image = $image
                        ->scale($optimize['width'], $optimize['height']);
                } else {
                    $image = $image->coverDown($optimize['width'], $optimize['height']);
                }
            }
            if (isset($optimize['format']) && $optimize['format'] === 'jpg') {
                $image = $image->toJpeg(quality: $optimize['quality'] ?? 95, progressive: true, strip: true);
                $extension = 'jpg';
            } else {
                $image = $image->encode(new AutoEncoder(quality: $optimize['quality'] ?? 95, progressive: true, strip: true));
            }
            $contents = (string) $image;
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
