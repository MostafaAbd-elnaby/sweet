<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class trader extends Model
{
    use HasFactory;

    protected $table = 'traders';

    public function products()
    {
        return $this->belongsToMany(products::class)->using(dailyrestrictions::class);
    }

}
