<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class products_commintes extends Model
{
    use HasFactory;
    protected $appends = ['reviewrName'];

    public function getReviewrNameAttribute( $val )
    {
        return clients::find($this->client_id)->name;
    }
}

