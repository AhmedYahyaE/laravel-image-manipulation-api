<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/dashboard';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) { // This rate limiting is applied to the routes in api.php file ONLY (not in web.php routes)
            // Rate Limiting: is the number of requests that a single IP can make to server in one minute. If the user is "guest", the Rate Limiting is for the their IP, but if the user is authenticated, Rate Limiting is for that specific user. Also, you can user instead of perMinute() method, you can use perDay(), perHour(), ... methods. Check    https://laravel.com/docs/9.x/rate-limiting    AND    https://laravel.com/docs/9.x/routing#rate-limiting
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip()); // PerMinute()
            // return Limit::perMinute(6)->by($request->user()?->id ?: $request->ip()); // PerMinute()
            // return Limit::perDay(6)->by($request->user()?->id ?: $request->ip()); // PerDay()
            // return Limit::perHour(6)->by($request->user()?->id ?: $request->ip()); // PerHour()
            //  Limit::perMinutes(6)->by($request->user()?->id ?: $request->ip()); // PerMinutes()
        });
    }
}