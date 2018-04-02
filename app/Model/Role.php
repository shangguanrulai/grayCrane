<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'role';

    public $primaryKey = 'id';

    protected $guarded = [];
    public function permission()
    {
        return $this->belongsToMany('App\Model\Perm','role_permission','role_id','permission_id');
    }

}
