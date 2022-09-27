<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;

    protected $table = "settings";

    protected $casts = [
        'sliders' => AsCollection::class,
        'books' => AsCollection::class,
        'info' => AsCollection::class,
        'about' => AsCollection::class,
    ];
}
