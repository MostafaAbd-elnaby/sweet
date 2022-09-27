<?php

namespace App\Listeners\Delete;

use App\Events\deleteBill;
use App\Models\trader;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class deleteTrader
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
        if ($bill->type === "out")
            return;
        $trader = trader::find($bill->trader_id);
        $bill->type === "in" ?
            $trader->decrement('creditor', $bill->reast) :
            $trader->decrement('debit', $bill->reast);
        $trader = trader::find($bill->trader_id);
        $trader->total =  abs($trader->creditor - $trader->debit);
        return $trader->save();
    }
}
