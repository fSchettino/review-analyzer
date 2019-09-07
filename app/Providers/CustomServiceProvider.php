<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class CustomServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Hotel interfaces bindings
        $this->app->bind(
            'App\Modules\Hotel\Interfaces\HotelServiceInterface',
            'App\Modules\Hotel\HotelService'
        );
        
        $this->app->bind(
            'App\Modules\Hotel\Interfaces\HotelRepositoryInterface',
            'App\Modules\Hotel\HotelRepository'
        );

        // Keyword interfaces bindings
        $this->app->bind(
            'App\Modules\Keyword\Interfaces\KeywordServiceInterface',
            'App\Modules\Keyword\KeywordService'
        );
        
        $this->app->bind(
            'App\Modules\Keyword\Interfaces\KeywordRepositoryInterface',
            'App\Modules\Keyword\KeywordRepository'
        );

        // Review interfaces bindings
        $this->app->bind(
            'App\Modules\Review\Interfaces\ReviewServiceInterface',
            'App\Modules\Review\ReviewService'
        );

        $this->app->bind(
            'App\Modules\Review\Interfaces\ReviewRepositoryInterface',
            'App\Modules\Review\ReviewRepository'
        );

        // Rule interfaces bindings
        $this->app->bind(
            'App\Modules\Rule\Interfaces\RuleServiceInterface',
            'App\Modules\Rule\RuleService'
        );

        $this->app->bind(
            'App\Modules\Rule\Interfaces\RuleRepositoryInterface',
            'App\Modules\Rule\RuleRepository'
        );

        // Service interfaces bindings
        $this->app->bind(
            'App\Modules\Service\Interfaces\ServiceServiceInterface',
            'App\Modules\Service\ServiceService'
        );

        $this->app->bind(
            'App\Modules\Service\Interfaces\ServiceRepositoryInterface',
            'App\Modules\Service\ServiceRepository'
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
