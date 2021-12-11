<?php

namespace App\Providers;

use App\Models\{Category, Page, SettingsKey};
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        view()->composer('layouts.app', function($view){
            $settings = SettingsKey::whereIn('slug', ['contact', 'content'])
                ->with('settings')
                ->get()
                ->map(fn($key)=>$key->settings)
                ->collapse()
                ->keyBy('slug');
            $view->with(['settings' => $settings]);
        });

        view()->composer('parts.categories', function($view){
            $view->with(['categories' => Category::active()->get()]);
        });

        view()->composer('parts.footer', function($view){
            $view->with(['pages' => page::active()->get()]);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
