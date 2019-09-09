<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        $this->mapModulesRoutes();
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }
    
    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }
    
    /**
     * Define the routes for the application modules.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapModulesRoutes()
    {
        Route::namespace('App\Modules\Index')
             ->group(base_path('App/Modules/Index/IndexRouter.php'));
     
        Route::namespace('App\Modules\Hotel')
             ->group(base_path('App/Modules/Hotel/HotelRouter.php'));

        Route::namespace('App\Modules\Keyword')
             ->group(base_path('App/Modules/Keyword/KeywordRouter.php'));

        Route::namespace('App\Modules\Review')
             ->group(base_path('App/Modules/Review/ReviewRouter.php'));

        Route::namespace('App\Modules\Rule')
             ->group(base_path('App/Modules/Rule/RuleRouter.php'));

        Route::namespace('App\Modules\Service')
             ->group(base_path('App/Modules/Service/ServiceRouter.php'));
    }
}
