<?php

namespace App\Events;

use App\Models\bills;
use App\Models\msgs;
use App\Models\products;
use App\Models\products_trader;
use App\Models\trader;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PurchaseProduct
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $products_trader;

    public function __construct(products_trader $products_trader)
    {
        $this->products_trader = $products_trader;
        $this->createBill();
        $this->SendAdminNotification();
    }

    public function createBill () {
        $bill = new bills();

        $data = $this->products_trader;

        $bill->products = [
            [
                "name" => '',
                "price" => '',
                "qu" => '',
                "item_total" => ''
            ],
            [
                "name" => '',
                "price" => '',
                "qu" => '',
                "item_total" => ''
            ]
        ];
        $bill->user_id     = $data->user_id;

        if ( $data->type === 'in' )
            $bill->trader_id   = $data->trader_id;
        else
            $bill->client_id   = $data->client_id;

        $bill->type        = $data->type;
        $bill->cost        = $data->calcCost();
        $bill->price       = $data->type === 'in' ? 0 : $data->price;
        $bill->profit      = $data->type === 'in' ? 0 : $this->calcProfit($bill->cost, $data->price);
        $bill->qu          = $data->qu;
        $bill->nots        = $data->nots;

        $bill->save();
    }

    public function SendAdminNotification () {
        $msgs = new msgs();
        $data = $this->products_trader;
        $user = User::select('name')->find($data->user_id);
        // $products = products::select('name_ar')->find($data->products_id);
        $trader = trader::select('name')->find($data->trader_id);
        $massege =  $trader . " كتاب من " . $data->qu . " بشراء " . $user->name . "قام";
        $msgs->name  = $user->name;
        $msgs->msg	 = $massege;
        $msgs->seen	 = 0;
        $msgs->save();
    }

    public function calcProfit ( $cost, $price ) {

        return $cost - $price;

    }

    public function calcCost ( $cost, $qu ) {

        return $cost * $qu;

    }
}
