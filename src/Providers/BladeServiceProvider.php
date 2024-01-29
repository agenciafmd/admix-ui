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
            $data = str($expression)
                ->replace('[', '{')
                ->replace(']', '}')
                ->replace('=>', ':')
                ->replace("'", '"')
                ->trim()
                ->toString();
            $data = json_decode($data, true);
            $class = $data['class'] ?? 'col-6';

            return str('
<div class="card mb-3 bg-light-subtle">
    <div class="card-body">
        <div class="container">
            <div class="row justify-content-center">
                <div class="' . $class . '">
            ')
                ->squish()
                ->toString();
        });

        Blade::directive('enddemo', static function ($expression) {
            return str('
                </div>
            </div>
        </div>
    </div>
</div>            
            ')
                ->squish()
                ->toString();
        });
    }

    public function bootViews(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'admix-ui');
    }

    public function bootComponents(): void
    {
        $prefix = config('admix-ui.prefix');

        Blade::component($prefix . 'btn', Components\Buttons\Button::class);
        Blade::component($prefix . 'btn.primary', Components\Buttons\Primary::class);
        Blade::component($prefix . 'card.body', Components\Card\Body::class);
        Blade::component($prefix . 'card', Components\Card\Card::class);
        Blade::component($prefix . 'card.footer', Components\Card\Footer::class);
        Blade::component($prefix . 'card.header', Components\Card\Header::class);
        Blade::component($prefix . 'card.subtitle', Components\Card\Subtitle::class);
        Blade::component($prefix . 'card.title', Components\Card\Title::class);
        Blade::component($prefix . 'form.error', Components\Forms\Error::class);
        Blade::component($prefix . 'form', Components\Forms\Form::class);
        Blade::component($prefix . 'form.hint', Components\Forms\Hint::class);
        Blade::component($prefix . 'form.plaintext', Components\Forms\Inputs\Plaintext::class);
        Blade::component($prefix . 'form.input', Components\Forms\Inputs\Input::class);
        Blade::component($prefix . 'form.label', Components\Forms\Label::class);
        Blade::component($prefix . 'page.form', Components\Pages\Form::class);
        Blade::component($prefix . 'page.header', Components\Pages\Header::class);
    }
}
