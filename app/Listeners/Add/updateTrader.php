<?php

namespace App\Listeners\Add;

use App\Events\createBill;
use App\Models\trader;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class updateTrader
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
        if ($bill->type === "out")
            return;

        $trader = trader::find($bill->trader_id);
        $bill->type === "in" ?
            $trader->increment('creditor', $bill->reast) :
            $trader->increment('debit', $bill->reast);
        $trader = trader::find($bill->trader_id);
        $trader->total =  abs($trader->creditor - $trader->debit);
        return $trader->save();
    }
}
