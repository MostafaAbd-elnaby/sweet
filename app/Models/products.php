<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class products extends Model
{

    use HasFactory;

    protected $appends = ['cats_name', 'branchs'];

    protected $hidden = ['pivot'];

    protected $guarded = [];

    protected $casts = [
        'keywords' => AsCollection::class,
        'sizes' => AsCollection::class,
        'weight' => AsCollection::class,
        'volume' => AsCollection::class,
        'colors' => 'array',
    ];


    public function cat()
    {
        return $this->belongsToMany(cat::class);
    }

    public function brand()
    {
        return $this->belongsToMany(brand::class);
    }

    public function getImgAttribute($val)
    {
        return asset('storage/' . $val);
    }

    public function getImgsAttribute($val)
    {
        return $oldImgs = collect(json_decode($val, true))->map( function ( $img ) {
             return asset('storage/' . $img);
        } );

    }

    public function collections()
    {

        return $this->belongsToMany(collections::class);
    }

    public function branchs()
    {
        return $this->belongsToMany(branchs::class);
    }

    public function rating()
    {
        return $this->hasMany(rating::class)->with('clients');
    }

    public function trader()
    {
        return $this->belongsToMany(trader::class)->using(dailyrestrictions::class);
    }

    public function getRatAttribute()
    {
        $sum = rating::where('products_id', $this->id)->sum('rate');
        $count = rating::where('products_id', $this->id)->count();
        if ($sum > 0)
            return round($sum / $count);
        else
            return 0;
    }

    public function getCatsNameAttribute()
    {
        $cats = $this->cat->map(function ($val) {
            return [
                'name_en' => $val['name_en'],
                'name_ar' => $val['name_ar'],
            ];
        });
        return $cats;
    }
    public function getKeywordsAttribute($val)
    {
        return $val !== null ? $val : [];
    }

    public function getCoponeOffersAttribute($val)
    {
        $offer = copone_offers::find($val);
        $null = ['id' => false];
        return $offer ? $offer : $null ;
    }

    public function getDescEnAttribute($val)
    {
        return $val !== null ? $val : ' ';
    }

    public function getDescArAttribute($val)
    {
        return $val !== null ? $val : ' ';
    }

    public function getBranchsAttribute($val)
    {
        $branchs_products = DB::table('branchs_products')->where('products_id', $this->id)->get();
        return $branchs_products->map(function ($val, $k) {
            return [
                "id"      => $val->id,
                "stoke"   => $val->stoke,
                "name_ar" => branchs::find($val->branchs_id)->name_ar,
                "name_en" => branchs::find($val->branchs_id)->name_en,
                "branchs_id" => $val->branchs_id,
            ];
        });
    }



    public function getInternalAttribute($val)
    {
        return $val ? true : false;
    }
    public function getIsPrintableAttribute($val)
    {
        return $val ? true : false;
    }

    public function getPriceAttribute($val)
    {
        return $val === null ? 0 : $val;
    }

    public function getPurchasingPriceAttribute($val)
    {
        return $val === null ? 0 : $val;
    }

//    public function getSizesAttribute($val)
//    {
//        return json_decode($val);
//    }
//    public function getWeightAttribute($val)
//    {
//        return json_decode($val);
//    }
//    public function getVolumeAttribute($val)
//    {
//        return json_decode($val);
//    }

//    public function getIsPrintableAttribute($val)
//    {
//        $this->attributes['is_printable'] = $val === 'true';
//    }


    public function getActiveAttribute($val)
    {
        return $val ? true : false;
    }
    public function setActiveAttribute($val)
    {
        $this->attributes['active'] = $val ? 1 : 0;
    }

    public function scopeActive($query)
    {
        return $query->orWhere('active', true);
    }


}
