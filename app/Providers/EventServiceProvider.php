<?php

namespace App\Providers;

use App\Models\{Category, Image, Item, Order, Page, Property, Purchase, Unit};
use App\Observers\{CategoryObserver, ImageObserver, ItemObserver, OrderObserver, PageObserver, PropertyObserver, PurchaseObserver, UnitObserver};
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
        Category::observe(CategoryObserver::class);
        Image::observe(ImageObserver::class);
        Item::observe(ItemObserver::class);
        Order::observe(OrderObserver::class);
        Page::observe(PageObserver::class);
        Property::observe(PropertyObserver::class);
        Purchase::observe(PurchaseObserver::class);
        Unit::observe(UnitObserver::class);
    }
}
