<?php

namespace App\Listeners;

use App\Events\ProductTrackingSale;
use App\Models\products_traker;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Queue\InteractsWithQueue;

class sale
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
     * @param  ProductTrackingSale  $event
     * @return void
     */
    public function handle(ProductTrackingSale $event)
    {
        collect($event->bill->products)->each(function ( $product ) use ($event) {
            $products_traker = new products_traker();
            $products_traker->products_id = $product['id'];
            $products_traker->products_name = $product['name_ar'];
            $products_traker->description = 'بيع';
            $products_traker->qut = $product['qut'];
            $products_traker->price = $product['price'];
            $products_traker->bills_id = $event->bill->id;
            $products_traker->save();
        });
    }
}
