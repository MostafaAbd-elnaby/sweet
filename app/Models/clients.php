<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class clients extends Authenticatable
{
    use Notifiable;

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getIsBlogerAttribute( $val )
    {
        return $val ? true : false;
    }

    public function setsBlogerAttribute( $val )
    {
        return $this->attributes['is_bloger'] = $val ? 1 : 0;
    }
}
