<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use function Lambdish\Phunctional\map;

class RouteServiceProvider extends ServiceProvider
{

    private $myCustomRouteFilesWeb = [
        'apps/backend/restaurant/Reservations/Config/routes/web.php',
        'apps/backend/restaurant/Tables/Config/routes/web.php',
        'apps/backend/restaurant/User/Config/routes/web.php',
        'apps/backend/restaurant/Dashboard/Config/routes/web.php',
        'apps/backend/restaurant/Clients/Config/routes/web.php',
        'apps/backend/restaurant/Notifications/Config/routes/web.php',
        'routes/web.php'
    ];

    private $myCustomRouteFilesApi = [
        'apps/backend/restaurant/Reservations/Config/routes/api.php',
        'apps/backend/restaurant/Tables/Config/routes/api.php',
        'apps/backend/restaurant/User/Config/routes/api.php',
        'routes/api.php'
    ];
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/dashboard';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    // protected $namespace = 'App\\Http\\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            //todo: Route Api App
            map(function ($file) {
                Route::prefix('api')
                    ->middleware('api')
                    ->namespace($this->namespace)
                    ->group(base_path($file));
            }, $this->myCustomRouteFilesApi );

            //todo: Route Web App
            map(function ($file) {
                Route::middleware('web')
                    ->namespace($this->namespace)
                    ->group(base_path($file));
            }, $this->myCustomRouteFilesWeb );
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }
}
