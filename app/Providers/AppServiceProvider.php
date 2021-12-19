<?php

namespace App\Providers;

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
        $this->app->bind(
            'App\Services\CartServiceInterface',
            'App\Services\CartService'
        );
        $this->app->bind(
            'App\Services\AlphaServiceInterface',
            'App\Services\AlphaService'
        );
        $this->app->bind(
            'App\Repositories\CartRepositoryInterface',
            'App\Repositories\CartRepository'
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $locale = 'ru';
        $locale_CODE = 'ru_RU';
        setlocale(LC_ALL, $locale . '.utf-8', $locale_CODE . '.utf-8', $locale, $locale_CODE);
        // setlocale(LC_TIME, 'ru_RU');
        // setlocale(LC_TIME, 'ru_RU.UTF-8');
        // \Carbon\Carbon::setLocale(config('app.locale'));
    }
}
