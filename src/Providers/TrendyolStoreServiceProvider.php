<?php

namespace efast\TrendyolStoreApi\Providers;

use efast\TrendyolStoreApi\TrendyolStore;
use Illuminate\Support\ServiceProvider;

class TrendyolStoreServiceProvider extends ServiceProvider{

    public function boot(){

        $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');
        $this->loadRoutesFrom(__DIR__.'/../../routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/../../Resources/views', 'trendyol-store');

        $this->publishes([
            __DIR__. '/../config/trendyol_store.php' => config_path('trendyol-store.php'),
        ], 'trendyol_store_config');

        $this->publishes([
            __DIR__. '/../../Resources/views/' => resource_path('views/vendor/trendyol-store'),
        ], 'trendyol_store_views');

    }

    public function register()
    {

        $this->mergeConfigFrom(__DIR__. '/../config/trendyol_store.php', 'trendyol_store'); //kullanıcı düzenleme yapmışsa korur.

        $this->app->singleton('TrendyolStore', function ($app){
            $trendyolStore = new TrendyolStore();
        });

    }

    public function provides()
    {
        return [TrendyolStore::class];
    }

}

