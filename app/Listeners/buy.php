<?php

namespace App\Listeners;

use App\Events\ProductTrackingBuy;
use App\Models\products_traker;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class buy
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
     * @param  ProductTrackingBuy  $event
     * @return void
     */
    public function handle(ProductTrackingBuy $event)
    {
        collect($event->bill->products)->each(function ( $product ) use ($event) {
            $products_traker = new products_traker();
            $products_traker->products_id = $product['id'];
            $products_traker->products_name = $product['name_ar'];
            $products_traker->description = 'شراء';
            $products_traker->qut = $product['qut'];
            $products_traker->price = $product['purchasing_price'];
            $products_traker->bills_id = $event->bill->id;
            $products_traker->save();
        });
    }
}
