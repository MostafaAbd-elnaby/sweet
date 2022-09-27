<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class departments extends Model
{
    use HasFactory;

    public function getCountAttribute ( $val ) {
        $count = staffs::where('departments_id', $this->id)->count();
        return $count ? $count : 0;
    }
}
