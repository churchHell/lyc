<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{

    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        \App\Models\Category::observe(\App\Observers\CategoryObserver::class);
        \App\Models\Image::observe(\App\Observers\ImageObserver::class);
        \App\Models\Item::observe(\App\Observers\ItemObserver::class);
        \App\Models\Order::observe(\App\Observers\OrderObserver::class);
        \App\Models\Page::observe(\App\Observers\PageObserver::class);
        \App\Models\Property::observe(\App\Observers\PropertyObserver::class);
        \App\Models\Purchase::observe(\App\Observers\PurchaseObserver::class);
        \App\Models\Status::observe(\App\Observers\StatusObserver::class);
        \App\Models\Unit::observe(\App\Observers\UnitObserver::class);
    }
}
