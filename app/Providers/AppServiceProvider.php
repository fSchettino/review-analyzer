<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Hotel bindings
        $this->app->bind(
            'App\Http\Interfaces\HotelsServiceInterface',
            'App\Http\Services\HotelsService'
        );
        
        $this->app->bind(
            'App\Http\Interfaces\HotelRepositoryInterface',
            'App\Http\Repositories\HotelRepository'
        );
        
        // Keyword bindings
        $this->app->bind(
            'App\Http\Interfaces\KeywordsServiceInterface',
            'App\Http\Services\KeywordsService'
        );
        
        $this->app->bind(
            'App\Http\Interfaces\KeywordRepositoryInterface',
            'App\Http\Repositories\KeywordRepository'
        );

        // Review bindings
        $this->app->bind(
            'App\Http\Interfaces\ReviewsServiceInterface',
            'App\Http\Services\ReviewsService'
        );

        $this->app->bind(
            'App\Http\Interfaces\ReviewRepositoryInterface',
            'App\Http\Repositories\ReviewRepository'
        );

        // Rule bindings
        $this->app->bind(
            'App\Http\Interfaces\RulesServiceInterface',
            'App\Http\Services\RulesService'
        );

        $this->app->bind(
            'App\Http\Interfaces\RuleRepositoryInterface',
            'App\Http\Repositories\RuleRepository'
        );

        // Service bindings
        $this->app->bind(
            'App\Http\Interfaces\ServicesServiceInterface',
            'App\Http\Services\ServicesService'
        );

        $this->app->bind(
            'App\Http\Interfaces\ServiceRepositoryInterface',
            'App\Http\Repositories\ServiceRepository'
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }
}
