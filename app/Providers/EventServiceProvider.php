<?php

namespace App\Providers;

use App\Events\createBill;
use App\Events\deleteBill;
use App\Events\editBill;
use App\Events\ProductTrackingBuy;
use App\Events\ProductTrackingSale;
use App\Events\ProductTrackingTransform;
use App\Listeners\Add\restrictions;
use App\Listeners\Add\updateStoke;
use App\Listeners\Add\updateTrader;
use App\Listeners\buy;
use App\Listeners\Delete\deleterestrictions;
use App\Listeners\Delete\deleteStoke;
use App\Listeners\Delete\deleteTrader;
use App\Listeners\Edit\editrestrictions;
use App\Listeners\Edit\editStoke;
use App\Listeners\Edit\editTrader;
use App\Listeners\sale;
use App\Listeners\transform;
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
        createBill::class => [
            updateStoke::class,
            updateTrader::class,
            restrictions::class
        ],
        editBill::class => [
            editStoke::class,
            editTrader::class,
            editrestrictions::class
        ],
        deleteBill::class => [
            deleteStoke::class,
            deleteTrader::class,
            deleterestrictions::class
        ],
        ProductTrackingSale::class => [
            sale::class,
        ],
        ProductTrackingBuy::class => [
            buy::class,
        ],
        ProductTrackingTransform::class => [
            transform::class
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
