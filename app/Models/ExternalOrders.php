<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExternalOrders extends Model
{
    use HasFactory;
    protected $table = 'external_orders';
    protected $casts = [
        'products' => AsCollection::class,
    ];

    public function setOrderNumAttribute()
    {
        $order_num = ExternalOrders::select('order_num')->latest('id')->first();
        if (!$order_num) {
            $num = 1000 + 1;
        }
        else {
            if ($order_num->order_num < 1000)
                $num = 1000 + 1;
            else
                $num = $order_num->order_num + 1;
        }
        return $this->attributes['order_num'] = $num;
    }
}
