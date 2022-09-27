<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class collections extends Model
{
    protected $fillable = [
        'name_en',
        'name_ar',
        'slug',
        'is_home',
        'is_ads',
    ];

    public function products()
    {
        return $this->belongsToMany(products::class)->with('rating');
    }


    public function getIsHomeAttribute($val)
    {
        return $val ? true : false;
    }

    public function getIsAdsAttribute($val)
    {
        return $val ? true : false;
    }

    public function setIsHomeAttribute($val)
    {
        $this->attributes['is_home'] = $val === 'true' ? 1 : 0;
    }

    public function setIsAdsAttribute($val)
    {
        $this->attributes['is_ads'] = $val === 'true' ? 1 : 0;
    }


    public function getImageAttribute($val)
    {
        return asset('storage/' . $val);
    }

    public function setSlugAttribute($val)
    {
        $this->attributes['slug'] = Str::slug($val, '-');
    }
}
