<?php

namespace Agenciafmd\Ui\View\Components\LivewireTables;

use Illuminate\Support\Facades\Cache;
use Illuminate\View\Component;

class Scripts extends Component
{
    public string $content;

    public function __construct()
    {
        $this->content = Cache::rememberForever('livewire-tables-scripts', static function () {
            $content = '';
            collect([
                'laravel-livewire-tables.min.js',
                'laravel-livewire-tables-thirdparty.min.js',
            ])->each(function ($file) use (&$content) {
                $content .= @file_get_contents(base_path('vendor/rappasoft/laravel-livewire-tables/resources/js/' . $file));
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
        <script>
            {!! $content !!}
        </script>
        blade;
    }
}
