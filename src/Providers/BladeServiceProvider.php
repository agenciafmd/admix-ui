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
        Blade::component($prefix . 'btn.create', Components\Buttons\Create::class);
        Blade::component($prefix . 'btn.create-with-options', Components\Buttons\CreateWithOptions::class);
        Blade::component($prefix . 'btn.link', Components\Buttons\Link::class);
        Blade::component($prefix . 'btn.primary', Components\Buttons\Primary::class);
        Blade::component($prefix . 'btn.submit', Components\Buttons\Submit::class);
        Blade::component($prefix . 'btn.trash', Components\Buttons\Trash::class);
        Blade::component($prefix . 'card.body', Components\Card\Body::class);
        Blade::component($prefix . 'card', Components\Card\Card::class);
        Blade::component($prefix . 'card.footer', Components\Card\Footer::class);
        Blade::component($prefix . 'card.header', Components\Card\Header::class);
        Blade::component($prefix . 'card.subtitle', Components\Card\Subtitle::class);
        Blade::component($prefix . 'card.title', Components\Card\Title::class);
        Blade::component($prefix . 'form.error', Components\Forms\Error::class);
        Blade::component($prefix . 'form', Components\Forms\Form::class);
        Blade::component($prefix . 'form.group', Components\Forms\Group::class);
        Blade::component($prefix . 'form.hint', Components\Forms\Hint::class);
        Blade::component($prefix . 'form.label', Components\Forms\Label::class);
        Blade::component($prefix . 'form.checkbox', Components\Forms\Inputs\Checkbox::class);
        Blade::component($prefix . 'form.color', Components\Forms\Inputs\Color::class);
        Blade::component($prefix . 'form.date', Components\Forms\Inputs\Date::class);
        Blade::component($prefix . 'form.datetime', Components\Forms\Inputs\Datetime::class);
        Blade::component($prefix . 'form.easymde', Components\Forms\Inputs\Easymde::class);
        Blade::component($prefix . 'form.email', Components\Forms\Inputs\Email::class);
        Blade::component($prefix . 'form.input', Components\Forms\Inputs\Input::class);
        Blade::component($prefix . 'form.key-value', Components\Forms\Inputs\KeyValue::class);
        Blade::component($prefix . 'form.image', Components\Forms\Inputs\Image::class);
        Blade::component($prefix . 'form.image-library', Components\Forms\Inputs\ImageLibrary::class);
        Blade::component($prefix . 'form.number', Components\Forms\Inputs\Number::class);
        Blade::component($prefix . 'form.password', Components\Forms\Inputs\Password::class);
        Blade::component($prefix . 'form.pended-input', Components\Forms\Inputs\PendedInput::class);
        Blade::component($prefix . 'form.plaintext', Components\Forms\Inputs\Plaintext::class);
        Blade::component($prefix . 'form.radio', Components\Forms\Inputs\Radio::class);
        Blade::component($prefix . 'form.select', Components\Forms\Inputs\Select::class);
        Blade::component($prefix . 'form.textarea', Components\Forms\Inputs\Textarea::class);
        Blade::component($prefix . 'form.time', Components\Forms\Inputs\Time::class);
        Blade::component($prefix . 'form.toggle', Components\Forms\Inputs\Toggle::class);
        Blade::component($prefix . 'form.tom-select', Components\Forms\Inputs\TomSelect::class);
        Blade::component($prefix . 'modal.body', Components\Modal\Body::class);
        Blade::component($prefix . 'modal.close', Components\Modal\Close::class);
        Blade::component($prefix . 'modal.footer', Components\Modal\Footer::class);
        Blade::component($prefix . 'modal.header', Components\Modal\Header::class);
        Blade::component($prefix . 'modal', Components\Modal\Modal::class);
        Blade::component($prefix . 'modal.title', Components\Modal\Title::class);
        Blade::component($prefix . 'page.body', Components\Pages\Body::class);
        Blade::component($prefix . 'page.form', Components\Pages\Form::class);
        Blade::component($prefix . 'page.header', Components\Pages\Header::class);

        Blade::component('livewire-tables:styles', Components\LivewireTables\Styles::class);
        Blade::component('livewire-tables:scripts', Components\LivewireTables\Scripts::class);
    }
}
