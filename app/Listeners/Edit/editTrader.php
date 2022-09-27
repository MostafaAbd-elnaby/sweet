<?php

namespace App\Listeners\Edit;

use App\Events\editBill;
use App\Models\trader;


class editTrader
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
        if ($bill->type === "out")
            return ;
        $trader = trader::find($bill->trader_id);
        $bill->type === "in" ?
            $trader->increment('creditor', $bill->reast) :
            $trader->increment('debit', $bill->reast);
        $trader = trader::find($bill->trader_id);
        $trader->total =  abs($trader->creditor - $trader->debit);
        return $trader->save();
    }
}
