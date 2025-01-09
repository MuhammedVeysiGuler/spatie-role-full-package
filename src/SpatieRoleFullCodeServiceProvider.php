<?php

namespace SpatieRoleFullCode;

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
        //$this->loadRoutesFrom(__DIR__ . '/../routes/web.php');

        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/spatie-role-full-code'),
        ], 'views');

        // Controller dosyalarını yayınlamak
        $this->publishes([
            __DIR__ . '/../src/Controller' => app_path('Http/Controllers'),
        ], 'controllers');

        // Helper dosyalarını yayınlamak
        $this->publishes([
            __DIR__ . '/../src/Helper' => app_path('Helper'),
        ], 'helpers');

        // Route dosyalarını yayımlamak
        $this->publishes([
            __DIR__ . '/../routes/web.php' => base_path('routes/spatie-role-full-code.php'),
        ], 'routes');

        $this->publishes([
            __DIR__ . '/database/seeders/PermissionSeeder.php' => database_path('seeders/PermissionSeeder.php'),
        ], 'seeders');
    }
}
