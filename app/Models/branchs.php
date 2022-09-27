<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class branchs extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = ['products_count'];

    public function products()
    {
        return $this->belongsToMany(products::class);
    }

    public function getProductsCountAttribute()
    {
        return DB::table('branchs_products')->where('branchs_id', $this->id)->count();
    }
}
