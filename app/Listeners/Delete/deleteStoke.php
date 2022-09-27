<?php

namespace App\Listeners\Delete;

use App\Events\deleteBill;
use App\Models\products;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class deleteStoke
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
     * @param  deleteBill  $event
     * @return void
     */
    public function handle(deleteBill $event)
    {
        $bill = $event->bill;
        return $bill->type === "in" ? $this->pay($bill) : $this->sall($bill);
    }

    public function pay($bill) {
        return collect($bill->products)->each(function ( $product ) use ($bill) {
            DB::table('branchs_products')
                ->where(['products_id' => $product['id'], 'branchs_id' => $bill->branchs_id])->update([
                    'stoke' => DB::raw('stoke-'. $product['qut'])
                ]);
            products::find($product['id'])->update(['purchasing_price' => $product['purchasing_price']]);
        });
    }

    public function sall($bill) {
        return collect($bill->products)->each(function ( $product ) use ($bill) {
            DB::table('branchs_products')
                ->where(['products_id' => $product['id'], 'branchs_id' => $bill->branchs_id])
                ->increment('stoke', $product['qut']);
        });
    }
}
