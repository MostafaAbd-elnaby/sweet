<?php

namespace App\Listeners\Edit;

use App\Events\editBill;
use App\Models\dailyRestrictions;

class editrestrictions
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
     * @param  editBill  $event
     * @return void
     */
    public function handle(editBill $event)
    {
        $bill = $event->bill;
        $dailyRestrictions_count = dailyRestrictions::count();
        if ($dailyRestrictions_count === 1)
            $total = dailyRestrictions::latest()->value('total');
        else
            $total = dailyRestrictions::latest()->offset(1)->value('total');
        $daily_restrictions = dailyRestrictions::where('bills_id', $bill->bill_num)->first();

        if ($bill->type === "in") {
            $daily_restrictions->type        = "شراء";
            $daily_restrictions->description = "شراء منتجات من تاجر";
            $daily_restrictions->put_to     = $bill->payed;
            $daily_restrictions->take_from  = 0;
            $daily_restrictions->total      =  $total - $daily_restrictions->put_to;
        }
        elseif ( $bill->type === "out_trader" ) {
            $daily_restrictions->type        = "بيع لتاجر";
            $daily_restrictions->description = "بيع منتجات لتاجر";
            $daily_restrictions->take_from  = $bill->payed;
            $daily_restrictions->put_to     = 0;
            $daily_restrictions->total      = $total + $daily_restrictions->take_from;
        }
        else {
            $daily_restrictions->type        = "بيع";
            $daily_restrictions->description = "بيع منتجات لعميل";
            $daily_restrictions->take_from  = $bill->payed;
            $daily_restrictions->put_to     = 0;
            $daily_restrictions->total      = $total + $daily_restrictions->take_from;
        }
        return $daily_restrictions->save();
    }
}
