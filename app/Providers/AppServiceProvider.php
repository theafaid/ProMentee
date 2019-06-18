<?php

namespace App\Providers;

use App\Cacheable\CacheableCountries;
use App\Cacheable\CacheableFields;
use App\Cacheable\CacheableUsersRelations;
use App\Eloquent\EloquentCountries;
use App\Eloquent\EloquentFields;
use App\Eloquent\EloquentUserRelations;
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
        $this->app->bind('User', function(){
            return new CacheableUsersRelations;
        });
        $this->app->bind('Countries', function(){
            return new CacheableCountries(new EloquentCountries);
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
