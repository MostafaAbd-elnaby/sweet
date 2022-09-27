<?php

namespace App\Listeners;

use App\Providers\PurchaseProduct;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendAdminNotification
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
     * @param  PurchaseProduct  $event
     * @return void
     */
    public function handle(PurchaseProduct $event)
    {
        //
    }
}
