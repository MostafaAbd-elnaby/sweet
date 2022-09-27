<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dailyRestrictions extends Model
{
    use HasFactory;

    protected $table = 'daily_restrictions';

    public function getTraderIdAttribute( $key )
    {
        return trader::find($key) ?? 'لا يوجد';
    }
}
