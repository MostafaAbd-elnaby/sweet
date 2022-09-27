<?php

namespace App\Listeners;

use App\Events\ProductTrackingTransform;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class transform
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ProductTrackingTransform  $event
     * @return void
     */
    public function handle(ProductTrackingTransform $event)
    {
        var_dump('ProductTrackingTransform');
    }
}
