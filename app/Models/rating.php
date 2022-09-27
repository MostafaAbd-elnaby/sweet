<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class rating extends Model
{
    protected $fillable = [
        'comment',
        'rate',
    ];

    public function products()
    {
        return $this->belongsTo(products::class, 'products_id');
    }

    public function clients()
    {
        return $this->belongsTo(clients::class);
    }

}
