<?php

namespace BabaSultan23\SpatieRoleFullCode;

use Illuminate\Support\ServiceProvider;

class SpatieRoleFullCodeServiceProvider extends ServiceProvider
{

    public function register()
    {
        // Helper dosyalarını dahil etmek
        $this->registerHelpers();
    }

    protected function registerHelpers()
    {
        foreach (glob(__DIR__ . '/Helper/**/*.php') as $filename) {
            require_once $filename;
        }
    }


    public function boot()
    {
        // View dosyalarını yayınlamak
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'spatie-role-full-code');

        // Route dosyalarını yüklemek
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');

        // Publish komutları eklemek
        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/spatie-role-full-code'),
        ], 'views');
    }
}
