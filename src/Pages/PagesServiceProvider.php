<?php

namespace CapstoneLogic\Pages;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class PagesServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->mergeConfigFrom(__DIR__ .'/../config/pages.php', 'capstonelogic.pages');
        $this->publishes([__DIR__ .'/../config/config.php' => config_path('capstonelogic.pages.php')], 'pages-config');
        
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations/');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace('CapstoneLogic\Pages')
            ->group(__DIR__ . '/../routes/api.php');
    }
}
