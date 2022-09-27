<?php

namespace App\Listeners\Add;

use App\Events\createBill;
use App\Models\dailyRestrictions;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Queue\InteractsWithQueue;

class restrictions
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
     * @param  createBill  $event
     * @return void
     */
    public function handle(createBill $event)
    {
        $bill = $event->bill;
        $dailyRestrictions_count = dailyRestrictions::count();
        $total = $dailyRestrictions_count !== 0 ?
            dailyRestrictions::latest()->value('total') : 0;
        $daily_restrictions = new dailyRestrictions();
        $daily_restrictions->bills_id   = $bill->bill_num;
        $daily_restrictions->trader_id   = $bill->trader_id;

        if ($bill->type === "in") {
            $daily_restrictions->type        = "شراء";
            $daily_restrictions->description = "شراء منتجات من تاجر";
            $daily_restrictions->put_to     = $bill->payed;
            $daily_restrictions->take_from  = 0;
            $daily_restrictions->total      =  $total - $bill->payed;
        }
        elseif ( $bill->type === "out_trader" ) {
            $daily_restrictions->type        = "بيع لتاجر";
            $daily_restrictions->description = "بيع منتجات لتاجر";
            $daily_restrictions->take_from  = $bill->payed;
            $daily_restrictions->put_to     = 0;
            $daily_restrictions->total      = $total + $bill->payed;
        }
        else {
            $daily_restrictions->type        = "بيع";
            $daily_restrictions->description = "بيع منتجات لعميل";
            $daily_restrictions->take_from  = $bill->payed;
            $daily_restrictions->put_to     = 0;
            $daily_restrictions->total      = $total + $bill->payed;
        }
        return $daily_restrictions->save();

    }
}
