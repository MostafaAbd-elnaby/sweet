<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class copone_offers extends Model
{
    use HasFactory;

    protected $appends = ['products'];

    public function getProductsAttribute()
    {
        $products = products::where('copone_offers', $this->id)->get(['id', 'name_ar', 'name_en', 'img']);
        return $products;
    }
}
