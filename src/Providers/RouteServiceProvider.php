<?php

namespace Agenciafmd\Ui\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->routes(static function () {
            Route::middleware('web')
                ->group(__DIR__ . '/../../routes/web.php');
        });
    }
}
