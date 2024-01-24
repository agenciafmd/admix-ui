<?php

namespace Agenciafmd\Ui\Providers;

use Agenciafmd\Ui\View\Components;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->bootBladeComponents();
        $this->bootBladeDirectives();
        $this->bootViews();
        $this->bootComponents();
    }

    public function bootBladeComponents(): void
    {
        Blade::componentNamespace('Agenciafmd\\Ui\\View\\Components', 'admix-ui');
    }

    public function bootBladeDirectives(): void
    {
        Blade::directive('demo', static function ($expression) {
            return str('
<div class="card mb-3 bg-light-subtle">
    <div class="card-body">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-6">
            ')->squish()->toString();
        });

        Blade::directive('enddemo', static function ($expression) {
            return str('
                </div>
            </div>
        </div>
    </div>
</div>            
            ')->squish()->toString();
        });
    }

    public function bootViews(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'admix-ui');
    }

    public function bootComponents(): void
    {
        $prefix = config('admix-ui.prefix');

        Blade::component($prefix . 'error', Components\Error::class);
        Blade::component($prefix . 'hint', Components\Hint::class);
        Blade::component($prefix . 'input', Components\Input::class);
        Blade::component($prefix . 'label', Components\Label::class);
    }
}
