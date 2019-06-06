<?php

namespace App\Providers;

use App\Cacheable\CacheableFields;
use App\Eloquent\EloquentFields;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('Fields', function(){
            return new CacheableFields(new EloquentFields);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Schema::defaultStringLength(191);
    }
}
