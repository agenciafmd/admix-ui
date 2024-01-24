<?php

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;

if (!app()->environment(['production'])) {
    Route::get('docs/{file?}', static function (string $file = 'installation') {
        $mdFile = __DIR__ . '/../docs/' . str($file)->slug() . '.md';
        $mdContent = '';
        if (file_exists($mdFile)) {
            $mdContent = file_get_contents($mdFile);
        }

        $content = Blade::render($mdContent);
        $view['markdown'] = str($content)
            ->markdown()
            ->toString();

        return view('admix-ui::docs', $view);
    })
        ->name('admix-ui.docs');
}
