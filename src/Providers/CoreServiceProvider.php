<?php

namespace Deraak\Core\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class CoreServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->registerPublishes();
        $this->registerResources();
    }

    public function register()
    {
        $this->registerSingletons()
            ->registerBinds()
            ->registerFacades()
            ->loadCommands();
    }

    protected function loadCommands()
    {
        // $this->commands([
        //     CoreCommand::class
        // ]);
    }

    protected function registerPublishes(): CoreServiceProvider
    {
        $this->publishConfigs()
            ->publishMigrations()
            ->publishAssets()
            ->publishLangs()
            ->publishViews()
            ->publishAll();

        return $this;
    }

    protected function publishConfigs(): CoreServiceProvider
    {
        $this->publishes([
            __DIR__ . "/../../config/deraak-core.php" => config_path('deraak-core.php')
        ], 'deraak-core-config');

        return $this;
    }

    protected function publishMigrations(): CoreServiceProvider
    {
        // $this->publishes([
        //     __DIR__ . "/../../database/migrations/2021_06_25_130755_create_core_table.php"                            => database_path('migrations/2021_06_25_130755_create_core_table.php'),
        // ], 'deraak-core-migrations');

        return $this;
    }

    protected function publishAssets(): CoreServiceProvider
    {
        // $this->publishes([
        //     __DIR__ . "/../../assets/" => public_path('vendor/deraak/core')
        // ], 'deraak-core-assets');

        return $this;
    }

    protected function publishLangs(): CoreServiceProvider
    {
        // $this->publishes([
        //     __DIR__ . "/../../resources/lang" => resource_path("lang/core")
        // ], 'deraak-core-langs');

        return $this;
    }

    protected function publishViews(): CoreServiceProvider
    {
        // $this->publishes([
        //     __DIR__ . "/../../resources/views" => resource_path("views/vendor/core")
        // ], 'deraak-core-views');

        return $this;
    }

    protected function publishAll(): CoreServiceProvider
    {
        $this->publishes(self::$publishes[CoreServiceProvider::class], 'deraak-core-publish-all');

        return $this;
    }

    protected function registerResources(): CoreServiceProvider
    {
        $this->registerMigrations()
            ->registerTranslations()
            ->registerViews()
            ->registerApiRoutes()
            ->registerAdminApiRoutes();


        return $this;
    }

    protected function registerSingletons(): CoreServiceProvider
    {
        // $this->app->singleton(Core::class, function ($app) {
        //     return new CoreClass();
        // });

        return $this;
    }

    protected function registerBinds(): CoreServiceProvider
    {
        // $this->app->bind(Core::class, function ($app) {
        //     return new CoreClass();
        // });

        return $this;
    }

    protected function registerFacades(): CoreServiceProvider
    {
        // bind math facade
        $this->app->bind('math', function ($app) {
            $className = "Deraak\\Core\\Support\\Math\\Math";
            return new $className();
        });

        // bind json facade
        $this->app->bind('json', function ($app) {
            $className = "Deraak\\Core\\Support\\Json\\Json";
            return new $className();
        });

        return $this;
    }

    protected function registerMigrations(): CoreServiceProvider
    {
        $this->loadMigrationsFrom(__DIR__ . "/../../database/migrations");
        return $this;
    }

    protected function registerTranslations(): CoreServiceProvider
    {
        $this->loadTranslationsFrom(__DIR__ . "/../../resources/lang", 'core');
        return $this;
    }

    protected function registerViews(): CoreServiceProvider
    {
        $this->loadViewsFrom(__DIR__ . "/../../resources/views", 'core');
        return $this;
    }

    protected function registerApiRoutes(): CoreServiceProvider
    {
        Route::group($this->apiRouteConfiguration(), function () {
            $this->loadRoutesFrom(__DIR__ . "/../../routes/api.php");
        });
        return $this;
    }

    protected function registerAdminApiRoutes(): CoreServiceProvider
    {
        Route::group($this->adminApiRouteConfiguration(), function () {
            $this->loadRoutesFrom(__DIR__ . "/../../routes/admin-api.php");
        });
        return $this;
    }

    protected function apiRouteConfiguration(): array
    {
        return [
            'domain'        => config('deraak-core.domain', null),
            'namespace'     => NULL,
            'prefix'        => config('deraak-core.path', 'deraak-core'),
            'as'            => 'deraak-core.',
            'middleware'    => config('deraak-core.apiMiddlewares.group', 'api'),
        ];
    }

    protected function adminApiRouteConfiguration(): array
    {
        return [
            'domain'        => config('deraak-core.domain', null),
            'namespace'     => NULL,
            'prefix'        => config('deraak-core.path', 'deraak-core'),
            'as'            => 'deraak-core.',
            'middleware'    =>  config('deraak-core.adminApiMiddlewares.group', 'web'),
        ];
    }
}
