<?php

namespace Agenciafmd\Ui\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

class AsMediaLibrary implements CastsAttributes
{
    public function get(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        return ($model->hasMedia($key))
            ? $model->getMedia($key)
                ->map(function ($media) {
                    return [
                        'uuid' => $media->uuid,
                        'url' => $media->getUrl(),
                        'path' => $media->file_name,
                    ];
                })
            : collect();
    }

    public function set(Model $model, string $key, mixed $value, array $attributes): mixed
    {
//        dd($model, $key, $value, $attributes);
        return false;
    }
}