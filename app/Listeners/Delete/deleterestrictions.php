<?php

namespace App\Listeners\Delete;

use App\Events\deleteBill;
use App\Models\dailyRestrictions;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class deleterestrictions
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
        $daily_restrictions = dailyRestrictions::where('bills_id', $bill->bill_num)->first();
        return $daily_restrictions->delete();
    }
}
