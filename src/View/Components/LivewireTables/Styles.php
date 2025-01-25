<?php

namespace Agenciafmd\Ui\View\Components\LivewireTables;

use Illuminate\Support\Facades\Cache;
use Illuminate\View\Component;

class Styles extends Component
{
    public string $content;

    public function __construct()
    {
        $this->content = Cache::rememberForever('livewire-tables-styles', static function () {
            $content = '';
            collect([
                'laravel-livewire-tables.min.css',
                'laravel-livewire-tables-thirdparty.min.css',
            ])->each(function ($file) use (&$content) {
                $content .= @file_get_contents(base_path('vendor/rappasoft/laravel-livewire-tables/resources/css/' . $file));
            });

            return $content;
        });
    }

    public function render(): string
    {
        if (!$this->content) {
            return '';
        }

        return <<<'blade'
        <style>
            {!! $content !!}
        </style>
        blade;
    }
}
