<?php

namespace App\Providers;

use App\Models\Report;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::unguard(true);
        Model::shouldBeStrict(!$this->app->isProduction());
        Model::preventLazyLoading(!$this->app->isProduction());
        Model::preventSilentlyDiscardingAttributes(!$this->app->isProduction());

        Blade::if('admin', function () {
            return Auth::user()->isAdmin();
        });

        Route::bind('report', function (string $value) {
            return Report::withoutGlobalScopes()
                ->where('slug', $value)
                ->with(['earnings' => function ($query) {
                    $query->withoutGlobalScopes();
                }])->firstOrFail();
        });
    }
}
