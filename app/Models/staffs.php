<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class staffs extends Authenticatable
{
    use HasRoles;
    protected $appends = ['branchs_name', 'departments_name'];


    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'permission' => AsCollection::class
    ];

    public function getBranchsNameAttribute ()
    {
        $branch = branchs::find($this->branchs_id);
        return $branch ? $branch->name_ar : 'كل الفروع';

    }

    public function getDepartmentsNameAttribute ()
    {
        $department = departments::find($this->departments_id);
        return $department ? $department->name : 'كل الفروع';

    }
    public function setPermissionAttribute ( $value )
    {
        $this->attributes['permission'] = json_encode($value);
    }
}

