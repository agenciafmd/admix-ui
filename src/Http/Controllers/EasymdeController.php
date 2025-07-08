<?php

namespace Agenciafmd\Ui\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Encoders\AutoEncoder;
use Intervention\Image\ImageManager;

class EasymdeController
{
    public function upload(Request $request): JsonResponse
    {
        if (!$request->hasFile('image')) {
            return response()->json([
                'error' => 'noFileGiven',
            ], 400);
        }

        $validator = Validator::make(request()->all(), [
            'image' => [
                'required',
                'image',
            ],
        ]);
        if ($validator->fails()) {
            return response()->json([
                'error' => 'typeNotAllowed',
            ], 415);
        }

        $validator = Validator::make(request()->all(), [
            'image' => [
                'max:' . config('admix-ui.easymde.upload.max_size'), // 5MB
            ],
        ]);
        if ($validator->fails()) {
            return response()->json([
                'error' => 'fileTooLarge',
            ], 413);
        }

        $file = request()->file('image');
        if (!$file->isValid()) {
            return response()->json([
                'error' => 'importError',
            ], 500);
        }

        $quality = config('admix-ui.easymde.upload.quality', 90);
        $maxWidth = config('admix-ui.easymde.upload.max_width', 1920);
        $maxHeight = config('admix-ui.easymde.upload.max_height', 1080);

        $path = 'easymde/' . date('Y/m/d');
        $originalName = $file->getClientOriginalName();
        $fileName = str($originalName)
            ->beforeLast('.')
            ->slug()
            ->append('-' . time())
            ->append('.' . strtolower($file->getClientOriginalExtension()))
            ->toString();

        $tempFile = $file->store('temp', 'local');
        $tempPath = Storage::disk('local')->path($tempFile);
        $image = ImageManager::imagick()
            ->read($tempPath);
        $encodedImage = $image
            ->scale($maxWidth, $maxHeight)
            ->encode(new AutoEncoder(quality: $quality, progressive: true));
        Storage::put("{$path}/{$fileName}", (string) $encodedImage);

        return response()->json([
            'data' => [
                'filePath' => Storage::url("{$path}/{$fileName}"),
            ],
        ]);
    }
}
