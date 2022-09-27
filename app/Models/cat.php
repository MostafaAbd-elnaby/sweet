<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class cat extends Model
{

    protected $guarded = [];

    protected $appends = ['hide_img'];

    public function children()
    {
        return $this->hasMany(cat::class, 'parent_id');
    }

    public function products()
    {
        return $this->belongsToMany(products::class)->with('brands');
    }

    public function getHideImgAttribute()
    {
        return Str::contains($this->img, 'category') ? false : true;
    }

    public function getImgAttribute($val)
    {
        return asset('storage/' . $val);
    }

    public function setSlugAttribute($val)
    {
        $this->attributes['slug'] = Str::slug($val, '-');
    }

}
